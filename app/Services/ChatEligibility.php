<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class ChatEligibility
{
    // Settings flag columns. Change here if the wrong flag is used.
    private const ESCORT_FLAG = 'features_allow_viewers_to_send_you_a_text_message'; // escort_settings
    private const VIEWER_FLAG = 'features_direct_chatting_with_escorts';              // viewer_settings

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

        // Escort <-> Viewer: the same checks apply whoever starts the chat
        if ($this->permission->needsViewerChecks($starter, $target)) {
            return $this->escortToViewer($starter, $target);
        }

        if ($this->permission->needsViewerChecks($target, $starter)) {
            return $this->escortToViewer($target, $starter);
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
     * Escort -> Viewer rules:
     * 1. Escort has the feature enabled in escort_settings
     * 2. Viewer has the feature enabled in viewer_settings
     * 3. Escort is in the viewer's Legbox and not blocked there
     */
    protected function escortToViewer(User $escort, User $viewer): array
    {
        $escortOn = DB::table('escort_settings')
            ->where('user_id', $escort->id)
            ->value(self::ESCORT_FLAG);

        if ((string) $escortOn !== '1') {
            return $this->deny('Enable messaging in your Notifications & Features settings first.');
        }

        $viewerOn = DB::table('viewer_settings')
            ->where('user_id', $viewer->id)
            ->value(self::VIEWER_FLAG);

        if ((string) $viewerOn !== '1') {
            return $this->deny('This viewer has not enabled direct chatting.');
        }

        // my_legbox.escort_id is the escorts table id, so map from users.id first
        $escortIds = DB::table('escorts')
            ->where('user_id', $escort->id)
            ->pluck('id');

        $inLegbox = DB::table('my_legbox')
            ->where('user_id', $viewer->id)
            ->whereIn('escort_id', $escortIds)
            ->where(function ($q) {
                $q->whereNull('is_blocked')->orWhere('is_blocked', 0);
            })
            ->exists();

        if (! $inLegbox) {
            return $this->deny('This viewer does not have you in their Legbox.');
        }

        return ['ok' => true, 'reason' => null];
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
