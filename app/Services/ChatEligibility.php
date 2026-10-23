<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class ChatEligibility
{
    // Settings flag columns. Change here if the wrong flag is used.
    private const ESCORT_FLAG = 'features_allow_viewers_to_send_you_a_text_message'; // escort_settings
    private const VIEWER_FLAG = 'features_direct_chatting_with_escorts';              // viewer_settings
    private const MASSAGE_FLAG = 'features_allow_viewers_to_send_you_a_text_message'; // massage_settings

    public function __construct(private ChatPermission $permission) {}

    /**
     * Type values that this user may search for in the New chat modal.
     *
     * users.type is a MySQL ENUM of strings, so the values must be strings.
     * Integers would be compared against the enum index, not the label.
     */
    public function targetTypes(User $user): array
    {
        return array_map('strval', $this->permission->allowedTargetTypes($user));
    }

    /**
     * Can these two users keep chatting (an existing chat or a new one)?
     * Checks the type rules, blocks and the Agent appointment.
     */
    public function canContinue(User $a, User $b): bool
    {
        return $this->permission->canChat($a, $b)
            && ! $this->isBlockedEitherWay($a->id, $b->id)
            && $this->isAppointed($a, $b);
    }

    /**
     * Can $starter start a new chat with $target?
     * Returns ['ok' => bool, 'reason' => string|null].
     */
    public function canStart(User $starter, User $target): array
    {
        if (! $this->permission->canChat($starter, $target)) {
            return $this->deny('This user cannot be messaged.');
        }

        if ($this->isBlockedEitherWay($starter->id, $target->id)) {
            return $this->deny('You cannot message this user.');
        }

        if (! $this->isAppointed($starter, $target)) {
            return $this->deny(
                $this->isAgent($starter)
                    ? 'This advertiser has not appointed you as their Agent.'
                    : 'You can only message your appointed Agent.'
            );
        }

        // Escort or Massage Centre <-> Viewer: the same checks apply whoever starts the chat
        if ($this->permission->needsViewerChecks($starter, $target)) {
            return $this->advertiserToViewer($starter, $target);
        }

        if ($this->permission->needsViewerChecks($target, $starter)) {
            return $this->advertiserToViewer($target, $starter);
        }

        return ['ok' => true, 'reason' => null];
    }

    protected function isAgent(User $user): bool
    {
        return (int) $user->type === (int) config('chat.types.agent');
    }

    /**
     * Agent <-> advertiser chats need the advertiser to have appointed that agent
     * (users.assigned_agent_id = the agent's users.id). Other pairs are not affected.
     */
    protected function isAppointed(User $a, User $b): bool
    {
        $aIsAgent = $this->isAgent($a);
        $bIsAgent = $this->isAgent($b);

        // Not an agent pair
        if ($aIsAgent === $bIsAgent) {
            return true;
        }

        $agent      = $aIsAgent ? $a : $b;
        $advertiser = $aIsAgent ? $b : $a;

        if ((int) $advertiser->assigned_agent_id === (int) $agent->id) {
            return true;
        }

        // The Agent Console builds "My Escorts" from this table
        return DB::table('agent_escorts')
            ->where('agent_id', $agent->id)
            ->where('escort_id', $advertiser->id)
            ->exists();
    }

    /**
     * Escort or Massage Centre <-> Viewer rules:
     * 1. The advertiser has messaging enabled in their own settings
     * 2. The viewer has direct chatting enabled
     * 3. The advertiser is in the viewer's Legbox and not blocked there
     */
    protected function advertiserToViewer(User $advertiser, User $viewer): array
    {
        $isMassage = (int) $advertiser->type === (int) config('chat.types.massage_center');

        $advertiserOn = DB::table($isMassage ? 'massage_settings' : 'escort_settings')
            ->where('user_id', $advertiser->id)
            ->value($isMassage ? self::MASSAGE_FLAG : self::ESCORT_FLAG);

        if ((string) $advertiserOn !== '1') {
            return $this->deny('Enable messaging in your Notifications & Features settings first.');
        }

        $viewerOn = DB::table('viewer_settings')
            ->where('user_id', $viewer->id)
            ->value(self::VIEWER_FLAG);

        if ((string) $viewerOn !== '1') {
            return $this->deny('This viewer has not enabled direct chatting.');
        }

        if (! $this->viewerHasAdvertiser($viewer, $advertiser)) {
            return $this->deny('This viewer does not have you in their Legbox.');
        }

        return ['ok' => true, 'reason' => null];
    }

    /**
     * Does this viewer have the escort or massage centre in their Legbox?
     * Escorts are saved in my_legbox (escorts.id, with a blocked flag),
     * massage centres in massage_legbox (massage_profiles.id).
     */
    public function viewerHasAdvertiser(User $viewer, User $advertiser): bool
    {
        if ($this->isMassage($advertiser)) {
            return DB::table('massage_legbox')
                ->where('user_id', $viewer->id)
                ->whereIn('massage_id', DB::table('massage_profiles')->where('user_id', $advertiser->id)->pluck('id'))
                ->exists();
        }

        return DB::table('my_legbox')
            ->where('user_id', $viewer->id)
            ->whereIn('escort_id', DB::table('escorts')->where('user_id', $advertiser->id)->pluck('id'))
            ->where(function ($q) {
                $q->whereNull('is_blocked')->orWhere('is_blocked', 0);
            })
            ->exists();
    }

    /**
     * users.id of every viewer who has this escort or massage centre in their Legbox.
     */
    public function viewerIdsFor(User $advertiser)
    {
        if ($this->isMassage($advertiser)) {
            return DB::table('massage_legbox')
                ->whereIn('massage_id', DB::table('massage_profiles')->where('user_id', $advertiser->id)->pluck('id'))
                ->pluck('user_id');
        }

        return DB::table('my_legbox')
            ->whereIn('escort_id', DB::table('escorts')->where('user_id', $advertiser->id)->pluck('id'))
            ->where(function ($q) {
                $q->whereNull('is_blocked')->orWhere('is_blocked', 0);
            })
            ->pluck('user_id');
    }

    /**
     * users.id of every escort and massage centre in this viewer's Legbox.
     */
    public function advertiserIdsIn(User $viewer)
    {
        $escortIds = DB::table('my_legbox')
            ->where('user_id', $viewer->id)
            ->where(function ($q) {
                $q->whereNull('is_blocked')->orWhere('is_blocked', 0);
            })
            ->pluck('escort_id');

        $massageIds = DB::table('massage_legbox')->where('user_id', $viewer->id)->pluck('massage_id');

        return DB::table('escorts')->whereIn('id', $escortIds)->pluck('user_id')
            ->merge(DB::table('massage_profiles')->whereIn('id', $massageIds)->pluck('user_id'));
    }

    protected function isMassage(User $user): bool
    {
        return (int) $user->type === (int) config('chat.types.massage_center');
    }

    protected function isBlockedEitherWay(int $a, int $b): bool
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

    protected function deny(string $reason): array
    {
        return ['ok' => false, 'reason' => $reason];
    }
}
