<?php

namespace App\Support;

class ChatState
{
    /**
     * State abbreviation (ACT, NSW...) for a users.state_id value.
     */
    public static function abbr($stateId): ?string
    {
        if (! $stateId) {
            return null;
        }

        return config("escorts.profile.states.{$stateId}.stateAbbr");
    }

    /**
     * Avatar colour for a users.state_id value.
     */
    public static function color($stateId): string
    {
        $abbr = self::abbr($stateId);

        return config("chat.state_colors.{$abbr}", config('chat.default_color'));
    }
}