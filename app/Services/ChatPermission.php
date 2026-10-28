<?php

namespace App\Services;

use App\Models\User;

class ChatPermission
{
    /**
     * Check one direction only: can $from message $to by type rules.
     */
    protected function allowed(int $fromType, int $toType): bool
    {
        $rules = config('chat.rules', []);

        return in_array($toType, $rules[$fromType] ?? [], true);
    }

    /**
     * Two-way check: both sides must permit the pair.
     */
    public function canChat(User $a, User $b): bool
    {
        if ($a->id === $b->id) {
            return false;
        }

        return $this->allowed((int) $a->type, (int) $b->type)
            && $this->allowed((int) $b->type, (int) $a->type);
    }

    /**
     * Agent can't be blocked, everyone else in the chat can.
     */
    public function canBlock(User $blocker, User $target): bool
    {
        if (! $this->canChat($blocker, $target)) {
            return false;
        }

        return ! in_array((int) $target->type, config('chat.unblockable', []), true);
    }

    /**
     * Types a given user may see in the "New chat" member search.
     */
    public function allowedTargetTypes(User $user): array
    {
        return config('chat.rules.' . (int) $user->type, []);
    }

    /**
     * Escort -> Viewer new chat needs extra checks (settings + Legbox).
     * The actual check is filled in once the settings/Legbox tables are known.
     */
    public function needsViewerChecks(User $starter, User $target): bool
    {
        return in_array((int) $starter->type, config('chat.requires_viewer_checks', []), true)
            && (int) $target->type === config('chat.types.viewer');
    }
}