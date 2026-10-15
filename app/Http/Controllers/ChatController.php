<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Events\MessagesRead;
use App\Events\UserTyping;
use App\Models\ChatAttachment;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\User;
use App\Services\ChatEligibility;
use App\Support\ChatState;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    // Filesystem disk (config/filesystems.php) where chat attachments are stored
    private const DISK = 'escorts';

    // Supported attachment extensions => [kind, mime used when the server cannot detect it]
    private const ATTACHMENT_EXTENSIONS = [
        // Images
        'jpg'  => ['image', 'image/jpeg'],
        'jpeg' => ['image', 'image/jpeg'],
        'jpe'  => ['image', 'image/jpeg'],
        'jfif' => ['image', 'image/jpeg'],
        'png'  => ['image', 'image/png'],
        'gif'  => ['image', 'image/gif'],
        'webp' => ['image', 'image/webp'],
        'bmp'  => ['image', 'image/bmp'],
        'avif' => ['image', 'image/avif'],
        'heic' => ['image', 'image/heic'],
        'heif' => ['image', 'image/heif'],
        'tif'  => ['image', 'image/tiff'],
        'tiff' => ['image', 'image/tiff'],
        'ico'  => ['image', 'image/x-icon'],
        // Videos
        'mp4'  => ['video', 'video/mp4'],
        'm4v'  => ['video', 'video/x-m4v'],
        'mov'  => ['video', 'video/quicktime'],
        'webm' => ['video', 'video/webm'],
        'ogv'  => ['video', 'video/ogg'],
        'mkv'  => ['video', 'video/x-matroska'],
        'avi'  => ['video', 'video/x-msvideo'],
        'wmv'  => ['video', 'video/x-ms-wmv'],
        'flv'  => ['video', 'video/x-flv'],
        '3gp'  => ['video', 'video/3gpp'],
        '3g2'  => ['video', 'video/3gpp2'],
        'mpg'  => ['video', 'video/mpeg'],
        'mpeg' => ['video', 'video/mpeg'],
    ];

    public function __construct(private ChatEligibility $eligibility)
    {
        $this->middleware('auth');
    }
       /**
     * Chat list. Query: filter=active|archived|deleted, location=australia|mine
     *
     * A chat is listed when it was added by this person (is_listed), or when it has messages
     * and was not deleted by this person. The appointed Agent is always listed first.
     */
    public function index(Request $request): JsonResponse
    {
        $me       = $request->user();
        $filter   = $request->query('filter', 'active');
        $location = $request->query('location', 'australia');

        // Current location, falling back to the home state when it is empty
        $myLocation = (int) ($me->current_state_id ?: $me->state_id);
        $myAgentId  = (int) $me->assigned_agent_id;

        $query = DB::table('chat_participants as p')
            ->join('chat_conversations as c', 'c.id', '=', 'p.conversation_id')
            ->where('p.user_id', $me->id)
            ->select(
                'c.id', 'c.user_one_id', 'c.user_two_id', 'c.last_message_id', 'c.last_message_at',
                'p.is_muted', 'p.is_archived', 'p.deleted_at'
            );

        if ($filter === 'deleted') {
            // Deleted by me, and not brought back by a newer message or by adding the member again
            $query->whereNotNull('p.deleted_at')
                ->where('p.is_listed', 0)
                ->where(function ($q) {
                    $q->whereNull('c.last_message_at')
                        ->orWhereColumn('c.last_message_at', '<=', 'p.deleted_at');
                });
        } else {
            $this->whereVisible($query);
            $query->where('p.is_archived', $filter === 'archived' ? 1 : 0);
        }

        $rows = $query
            ->orderByRaw('COALESCE(c.last_message_at, c.created_at) DESC')
            ->limit(50)
            ->get();

        $otherIds = $rows->map(fn ($r) => (int) $r->user_one_id === $me->id ? $r->user_two_id : $r->user_one_id);

        $users = User::query()
            ->whereIn('id', $otherIds)
            ->get([
                'id', 'name', 'business_name', 'entity_name', 'member_id', 'avatar_img',
                'state_id', 'current_state_id', 'last_online_at', 'type',
            ])
            ->keyBy('id');

        $lastMessages = ChatMessage::withTrashed()
            ->whereIn('id', $rows->pluck('last_message_id')->filter())
            ->get(['id', 'body', 'type', 'sender_id', 'created_at'])
            ->keyBy('id');

        $unread = $this->unreadCounts($me->id, $rows->pluck('id')->all());

        $australiaIds = collect(config('escorts.profile.states', []))
            ->filter(fn ($s) => str_starts_with($s['timeZone'] ?? '', 'Australia/'))
            ->keys()
            ->map(fn ($k) => (int) $k)
            ->all();

        $data = $rows->map(function ($r) use ($me, $users, $lastMessages, $unread, $myAgentId) {
            $otherId = (int) $r->user_one_id === $me->id ? (int) $r->user_two_id : (int) $r->user_one_id;
            $other   = $users->get($otherId);
            $last    = $lastMessages->get($r->last_message_id);

            if (! $other) {
                return null;
            }

            return [
                'id'           => $r->id,
                'user'         => [
                    'id'             => $other->id,
                    'name'           => ChatState::displayName($other),
                    'member_id'      => $other->member_id,
                    'avatar'         => $other->avatar_img,
                    'color'          => ChatState::color($other->state_id),
                    'type'           => (int) $other->type,
                    'location_id'    => (int) ($other->current_state_id ?: $other->state_id),
                    'last_online_at' => $other->last_online_at,
                ],
                'last'         => $last ? [
                    'preview'    => $this->preview($last),
                    'created_at' => \Carbon\Carbon::parse($last->created_at)->toIso8601String(),
                    'mine'       => (int) $last->sender_id === $me->id,
                ] : null,
                'unread'       => (int) ($unread[$r->id] ?? 0),
                'is_muted'     => (bool) $r->is_muted,
                'is_archived'  => (bool) $r->is_archived,
                'is_appointed' => $myAgentId > 0 && (int) $other->id === $myAgentId,
            ];
        })->filter();

        // Location radio:
        // "mine" = same state as me (all shown when my own location is unknown),
        // "australia" = any Australian state
        $data = $data->filter(function ($item) use ($location, $myLocation, $australiaIds) {
            $stateId = $item['user']['location_id'];

            if ($location === 'mine') {
                return $myLocation === 0 || $stateId === $myLocation;
            }

            return in_array($stateId, $australiaIds, true);
        });

        // The appointed Agent stays on top, the rest keep the latest-message order
        $data = $data->sortBy(fn ($item) => $item['is_appointed'] ? 0 : 1);

        return response()->json(['data' => $data->values()]);
    }

    /**
     * New chat modal: search members by Member ID.
     */
        /**
     * Add Member modal: everyone who can be chatted with and is not in my chat list yet.
     * An empty search returns the full list, otherwise it matches Member ID or name.
     */
    public function members(Request $request): JsonResponse
    {
        $me   = $request->user();
        $term = trim((string) $request->query('q', ''));

        $query = User::query()
            ->whereIn('type', $this->eligibility->targetTypes($me))
            ->where('id', '!=', $me->id);

        // Members who already have a chat in my list are not offered again
        $inList = $this->visibleChatUserIds($me->id);

        if ($inList) {
            $query->whereNotIn('id', $inList);
        }

        if ($term !== '') {
            $like = '%' . $term . '%';

            $query->where(function ($q) use ($like) {
                $q->where('member_id', 'like', $like)
                    ->orWhere('name', 'like', $like)
                    ->orWhere('business_name', 'like', $like);
            });
        }

        if ((int) $me->type === (int) config('chat.types.agent')) {
            // An Agent only sees advertisers who appointed them
            $query->where('assigned_agent_id', $me->id);
        } elseif ((int) $me->type === (int) config('chat.types.escort')) {
            // An escort sees viewers who have them in their Legbox, and their own appointed Agent
            $escortIds = DB::table('escorts')->where('user_id', $me->id)->pluck('id');

            $viewerIds = DB::table('my_legbox')
                ->whereIn('escort_id', $escortIds)
                ->where(function ($q) {
                    $q->whereNull('is_blocked')->orWhere('is_blocked', 0);
                })
                ->pluck('user_id');

            $query->where(function ($q) use ($viewerIds, $me) {
                $q->whereIn('id', $viewerIds)->orWhere('id', (int) $me->assigned_agent_id);
            });
        }

        $users = $query->orderBy('member_id')->limit(50)->get([
            'id', 'name', 'business_name', 'entity_name', 'member_id', 'avatar_img', 'state_id', 'type',
        ]);

        // The remaining rules (settings, blocks, appointment) are checked per person
        $data = $users
            ->filter(fn (User $u) => $this->eligibility->canStart($me, $u)['ok'])
            ->map(fn (User $u) => [
                'id'         => $u->id,
                'name'       => ChatState::displayName($u),
                'member_id'  => $u->member_id,
                'avatar'     => $u->avatar_img,
                'color'      => ChatState::color($u->state_id),
                'type_label' => config('chat.type_labels.' . (int) $u->type, ''),
            ])
            ->values();

        return response()->json(['data' => $data]);
    }

        /**
     * Start a chat (or reopen an existing one) with the given user.
     * The chat is listed for the person who adds the member right away,
     * the other person sees it once the first message is sent.
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ]);

        $me     = $request->user();
        $target = User::findOrFail($input['user_id']);

        $result = $this->eligibility->canStart($me, $target);

        if (! $result['ok']) {
            return response()->json(['message' => $result['reason']], 422);
        }

        $conversation = DB::transaction(function () use ($me, $target) {
            $conversation = ChatConversation::between($me->id, $target->id)
                ?? ChatConversation::forceCreate([
                    'user_one_id' => min($me->id, $target->id),
                    'user_two_id' => max($me->id, $target->id),
                ]);

            foreach ([$me->id, $target->id] as $userId) {
                $exists = DB::table('chat_participants')
                    ->where('conversation_id', $conversation->id)
                    ->where('user_id', $userId)
                    ->exists();

                if (! $exists) {
                    DB::table('chat_participants')->insert([
                        'conversation_id' => $conversation->id,
                        'user_id'         => $userId,
                    ]);
                }
            }

            // Show it in my list, even before a message exists
            DB::table('chat_participants')
                ->where('conversation_id', $conversation->id)
                ->where('user_id', $me->id)
                ->update(['is_listed' => 1, 'is_archived' => 0]);

            return $conversation;
        });

        return response()->json([
            'conversation_id' => $conversation->id,
            // Full user details so the header can show them before the first message
            'user'            => [
                'id'             => $target->id,
                'name'           => ChatState::displayName($target),
                'member_id'      => $target->member_id,
                'avatar'         => $target->avatar_img,
                'color'          => ChatState::color($target->state_id),
                'type'           => (int) $target->type,
                'location_id'    => (int) ($target->current_state_id ?: $target->state_id),
                'last_online_at' => $target->last_online_at,
            ],
        ]);
    }

    /**
     * Messages of one conversation, newest page first.
     * Query: before_id (cursor), limit (default 30, max 100).
     * Returned in ascending order so the UI can prepend the page.
     */
    public function messages(Request $request, int $conversation): JsonResponse
    {
        $me   = $request->user();
        $conv = $this->conversationFor($me->id, $conversation);

        $limit    = max(1, min((int) $request->query('limit', 30), 100));
        $beforeId = (int) $request->query('before_id', 0);

        $participant = DB::table('chat_participants')
            ->where('conversation_id', $conv->id)
            ->where('user_id', $me->id)
            ->first();

        $query = ChatMessage::query()
            ->where('conversation_id', $conv->id)
            ->with('attachments')
            ->orderByDesc('id');

        if ($beforeId > 0) {
            $query->where('id', '<', $beforeId);
        }

        // History I deleted earlier stays hidden for me only
        if ($participant && $participant->deleted_at) {
            $query->where('created_at', '>', $participant->deleted_at);
        }

        $rows    = $query->limit($limit + 1)->get();
        $hasMore = $rows->count() > $limit;
        $rows    = $rows->take($limit)->reverse()->values();

        return response()->json([
            'data'     => $rows->map(fn (ChatMessage $m) => $this->payload($m))->values(),
            'has_more' => $hasMore,
        ]);
    }

    /**
     * Send a message: text, one image/video, or both (file with a caption).
     */
    public function send(Request $request, int $conversation): JsonResponse
    {
        $me   = $request->user();
        $conv = $this->conversationFor($me->id, $conversation);

        $input = $request->validate([
            'body' => ['nullable', 'string', 'max:5000', 'required_without:file'],
            'file' => [
                'nullable',
                'file',
                'max:51200', // 50 MB, in kilobytes
                'required_without:body',
            ],
        ]);

        $otherId = $conv->otherUserId($me->id);
        $other   = User::findOrFail($otherId);

        // Rules are enforced on the server, hiding UI is not enough
        if (! $this->eligibility->canContinue($me, $other)) {
            return response()->json(['message' => 'You cannot message this user.'], 403);
        }

        $body = isset($input['body']) ? trim($input['body']) : '';
        $body = $body === '' ? null : $body;
        $file = $request->file('file');

        if (! $file && $body === null) {
            return response()->json(['message' => 'Message is empty.'], 422);
        }

        // Read file details before it is stored
        $kind      = null;
        $mime      = null;
        $size      = 0;
        $realPath  = null;
        $extension = null;

        if ($file) {
            // getRealPath() can return false on Windows when the temp folder is restricted,
            // so fall back to the plain upload path.
            $realPath = $file->getRealPath() ?: $file->getPathname();

            // The temporary upload file is missing or not readable
            if (! $file->isValid() || ! $realPath || ! is_readable($realPath)) {
                Log::warning('Chat upload rejected', [
                    'error_code'     => $file->getError(),
                    'error_message'  => $file->getErrorMessage(),
                    'pathname'       => (string) $file->getPathname(),
                    'client_name'    => $file->getClientOriginalName(),
                    'upload_max'     => ini_get('upload_max_filesize'),
                    'post_max'       => ini_get('post_max_size'),
                    'upload_tmp_dir' => ini_get('upload_tmp_dir'),
                    'sys_temp_dir'   => sys_get_temp_dir(),
                ]);

                return response()->json([
                    'message' => 'Upload failed: ' . $file->getErrorMessage(),
                ], 422);
            }

            $info = $this->detectAttachment($file);

            if (! $info) {
                return response()->json([
                    'message' => 'This file type is not supported. Send an image or a video.',
                ], 422);
            }

            $kind      = $info['kind'];
            $mime      = $info['mime'];
            $extension = $info['ext'];
            $size      = (int) $file->getSize();
        }

        $message = DB::transaction(function () use ($conv, $me, $body, $kind, $mime, $size, $realPath, $extension) {
            $message = ChatMessage::create([
                'conversation_id' => $conv->id,
                'sender_id'       => $me->id,
                'body'            => $body,
                'type'            => $kind ?? 'text',
            ]);

            if ($realPath) {
                $path = 'chat/' . $conv->id . '/' . Str::uuid() . '.' . $extension;

                $saved = Storage::disk(self::DISK)->put($path, file_get_contents($realPath));

                if (! $saved) {
                    throw new \RuntimeException('Attachment could not be saved.');
                }

                ChatAttachment::create([
                    'message_id' => $message->id,
                    'path'       => $path,
                    'kind'       => $kind,
                    'mime'       => $mime,
                    'size'       => $size,
                ]);
            }

            // $conv->update([
            //     'last_message_id' => $message->id,
            //     'last_message_at' => $message->created_at,
            // ]);

                        $conv->update([
                'last_message_id' => $message->id,
                'last_message_at' => $message->created_at,
            ]);

            // A new message brings an archived chat back for both people
            DB::table('chat_participants')
                ->where('conversation_id', $conv->id)
                ->update(['is_archived' => 0, 'is_listed' => 1]);

            return $message;
        });

        $message->load('attachments');

        $payload = $this->payload($message);

        broadcast(new MessageSent($payload, $otherId));

        return response()->json(['data' => $payload], 201);
    }

    /**
     * Mark everything in the conversation as read for me
     * and tell the sender so the ticks turn blue.
     */
    public function read(Request $request, int $conversation): JsonResponse
    {
        $me   = $request->user();
        $conv = $this->conversationFor($me->id, $conversation);

        $latestId = ChatMessage::query()->where('conversation_id', $conv->id)->max('id');

        if ($latestId) {
            DB::table('chat_participants')
                ->where('conversation_id', $conv->id)
                ->where('user_id', $me->id)
                ->update(['last_read_message_id' => $latestId]);

            $updated = ChatMessage::query()
                ->where('conversation_id', $conv->id)
                ->where('sender_id', '!=', $me->id)
                ->whereNull('read_at')
                ->update(['read_at' => now()]);

            if ($updated > 0) {
                broadcast(new MessagesRead(
                    $conv->id,
                    $me->id,
                    (int) $latestId,
                    $conv->otherUserId($me->id)
                ));
            }
        }

        return response()->json(['ok' => true]);
    }

    /**
     * "User is typing" signal for the other participant.
     */
    public function typing(Request $request, int $conversation): JsonResponse
    {
        $me   = $request->user();
        $conv = $this->conversationFor($me->id, $conversation);

        $otherId = $conv->otherUserId($me->id);

        if (! $this->isBlockedEitherWay($me->id, $otherId)) {
            broadcast(new UserTyping($conv->id, $me->id, $otherId));
        }

        return response()->json(['ok' => true]);
    }


        /**
     * Details of the person on the other side, for the Contact Info popup.
     */
    public function contact(Request $request, int $conversation): JsonResponse
    {
        $me   = $request->user();
        $conv = $this->conversationFor($me->id, $conversation);

        $user = User::findOrFail($conv->otherUserId($me->id));

        $locationId = (int) ($user->current_state_id ?: $user->state_id);
        $homeId     = (int) $user->state_id;

        return response()->json([
            'data' => [
                'id'             => $user->id,
                'name'           => ChatState::displayName($user),
                'phone'          => formatMobileNumber($user->phone),
                'member_id'      => $user->member_id,
                'avatar'         => $user->avatar_img,
                'color'          => ChatState::color($user->state_id),
                'type'           => config('chat.type_labels.' . (int) $user->type, ''),
                'location'       => config("escorts.profile.states.{$locationId}.stateName"),
                'home_state'     => config("escorts.profile.states.{$homeId}.stateName"),
                'member_since'   => $user->created_at ? $user->created_at->format('d-m-Y') : null,
                'last_online_at' => $user->last_online_at
                    ? $user->last_online_at->format('d-m-Y H:i A')
                    : null,            ],
        ]);
    }

    /**
     * Archive or unarchive a conversation for me only.
     * Body: archived (true to archive, false to bring it back).
     */
    public function archive(Request $request, int $conversation): JsonResponse
    {
        $me   = $request->user();
        $conv = $this->conversationFor($me->id, $conversation);

        $archived = $request->boolean('archived', true);

        DB::table('chat_participants')
            ->where('conversation_id', $conv->id)
            ->where('user_id', $me->id)
            ->update(['is_archived' => $archived ? 1 : 0]);

        return response()->json(['archived' => $archived]);
    }

       /**
     * Delete a conversation for me only. The other person keeps it and
     * every message stays in the database. A new message brings the chat back,
     * but the history before the delete stays hidden for me.
     */
    public function destroy(Request $request, int $conversation): JsonResponse
    {
        $me   = $request->user();
        $conv = $this->conversationFor($me->id, $conversation);

        $latestId = ChatMessage::withTrashed()->where('conversation_id', $conv->id)->max('id');

        DB::table('chat_participants')
            ->where('conversation_id', $conv->id)
            ->where('user_id', $me->id)
            ->update([
                'deleted_at'           => now(),
                'is_archived'          => 0,
                'is_listed'            => 0,
                'last_read_message_id' => $latestId,
            ]);

        return response()->json(['deleted' => true]);
    }

    /**
     * Stream an attachment, only for the two people in the conversation.
     */
    public function attachment(Request $request, int $attachment)
    {
        $row     = ChatAttachment::findOrFail($attachment);
        $message = ChatMessage::withTrashed()->findOrFail($row->message_id);

        $this->conversationFor($request->user()->id, $message->conversation_id);

        $disk = Storage::disk(self::DISK);

        abort_unless($disk->exists($row->path), 404);

        return $disk->response($row->path, null, [
            'Content-Type'  => $row->mime ?: 'application/octet-stream',
            'Cache-Control' => 'private, max-age=3600',
        ]);
    }

    // ---------------------------------------------------------------
    // Helpers
    // ---------------------------------------------------------------

    /**
     * Load a conversation and make sure the user belongs to it.
     */
    private function conversationFor(int $userId, int $conversationId): ChatConversation
    {
        $conv = ChatConversation::find($conversationId);

        abort_if(! $conv, 404);
        abort_if(! $conv->hasParticipant($userId), 403);

        return $conv;
    }


        /**
     * Limit a participants+conversations query to chats that are shown in the list:
     * added by this person, or having messages and not deleted by this person
     * (or deleted, but a newer message arrived).
     */
    private function whereVisible($query): void
    {
        $query->where(function ($q) {
            $q->where('p.is_listed', 1)
                ->orWhere(function ($withMessages) {
                    $withMessages->whereNull('p.deleted_at')->whereNotNull('c.last_message_at');
                })
                ->orWhere(function ($afterDelete) {
                    $afterDelete->whereNotNull('p.deleted_at')->whereColumn('c.last_message_at', '>', 'p.deleted_at');
                });
        });
    }

    /**
     * User ids of everyone I currently have a chat with in my active list.
     */
    private function visibleChatUserIds(int $userId): array
    {
        $query = DB::table('chat_participants as p')
            ->join('chat_conversations as c', 'c.id', '=', 'p.conversation_id')
            ->where('p.user_id', $userId)
            ->where('p.is_archived', 0);

        $this->whereVisible($query);

        return $query->get(['c.user_one_id', 'c.user_two_id'])
            ->map(fn ($r) => (int) $r->user_one_id === $userId ? (int) $r->user_two_id : (int) $r->user_one_id)
            ->unique()
            ->values()
            ->all();
    }

    private function isBlockedEitherWay(int $a, int $b): bool
    {
        return DB::table('chat_blocks')
            ->where(function ($q) use ($a, $b) {
                $q->where('blocker_id', $a)->where('blocked_id', $b);
            })
            ->orWhere(function ($q) use ($a, $b) {
                $q->where('blocker_id', $b)->where('blocked_id', $a);
            })
            ->exists();
    }

    /**
     * Unread message count per conversation for one user.
     */
    private function unreadCounts(int $userId, array $conversationIds)
    {
        if (empty($conversationIds)) {
            return collect();
        }

        return DB::table('chat_messages as m')
            ->join('chat_participants as p', function ($join) use ($userId) {
                $join->on('p.conversation_id', '=', 'm.conversation_id')
                    ->where('p.user_id', '=', $userId);
            })
            ->whereIn('m.conversation_id', $conversationIds)
            ->where('m.sender_id', '!=', $userId)
            ->whereNull('m.deleted_at')
            ->whereRaw('m.id > COALESCE(p.last_read_message_id, 0)')
            ->where(function ($q) {
                $q->whereNull('p.deleted_at')
                    ->orWhereColumn('m.created_at', '>', 'p.deleted_at');
            })
            ->groupBy('m.conversation_id')
            ->selectRaw('m.conversation_id, COUNT(*) as unread')
            ->pluck('unread', 'conversation_id');
    }

    private function preview($message): string
    {
        return match ($message->type) {
            'image' => 'Photo',
            'video' => 'Video',
            default => (string) $message->body,
        };
    }

    /**
     * Work out whether an uploaded file is an image or a video we accept.
     * Returns ['kind' => 'image|video', 'mime' => string, 'ext' => string] or null.
     */
    private function detectAttachment(UploadedFile $file): ?array
    {
        $mime  = strtolower((string) $file->getMimeType());
        $ext   = preg_replace('/[^a-z0-9]/', '', strtolower((string) $file->getClientOriginalExtension()));
        $known = self::ATTACHMENT_EXTENSIONS[$ext] ?? null;

        // SVG files can carry scripts, so they are not accepted
        if ($mime === 'image/svg+xml' || $ext === 'svg') {
            return null;
        }

        // The server recognised it as an image or a video
        if (str_starts_with($mime, 'image/') || str_starts_with($mime, 'video/')) {
            return [
                'kind' => str_starts_with($mime, 'image/') ? 'image' : 'video',
                'mime' => $mime,
                'ext'  => $known ? $ext : ($file->guessExtension() ?: ($ext ?: 'bin')),
            ];
        }

        // Some formats (HEIC, MKV, 3GP...) are reported as a generic binary on some servers.
        // Trust the extension only in that case.
        $generic = ['', 'application/octet-stream', 'binary/octet-stream'];

        if ($known && in_array($mime, $generic, true)) {
            return ['kind' => $known[0], 'mime' => $known[1], 'ext' => $ext];
        }

        return null;
    }

    private function payload(ChatMessage $m): array
    {
        return [
            'id'              => $m->id,
            'conversation_id' => $m->conversation_id,
            'sender_id'       => $m->sender_id,
            'body'            => $m->body,
            'type'            => $m->type,
            'read_at'         => $m->read_at?->toIso8601String(),
            'created_at'      => $m->created_at->toIso8601String(),
            'attachments'     => $m->attachments->map(fn ($a) => [
                'id'   => $a->id,
                'kind' => $a->kind,
                'mime' => $a->mime,
                'size' => $a->size,
                // The escorts disk root is public/escorts, so files open at /escorts/{path}
                'url'  => '/escorts/' . ltrim($a->path, '/'),
            ])->values()->all(),
        ];
    }
}