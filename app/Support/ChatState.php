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

    /**
     * Name shown in the chat for a user.
     * Agents have no users.name, their name is in business_name.
     * Falls back to the Member ID when no name is stored.
     */
    public static function displayName($user): string
    {
        foreach (['name', 'business_name', 'entity_name'] as $field) {
            $value = trim((string) ($user->{$field} ?? ''));

            if ($value !== '') {
                return $value;
            }
        }

        return (string) ($user->member_id ?? '');
    }
}