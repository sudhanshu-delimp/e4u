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
     * Label shown as "Type": the staff level for E4U staff
     * (staff_details.position: 1 Managing Director, 2 Director, 3 Staff), otherwise the user type.
     */
    public static function typeLabel($user, $position = null): string
    {
        if (in_array((int) $user->type, config('chat.admin_types', []), true)) {
            $levels = [1 => 'Managing Director', 2 => 'Director', 3 => 'Staff'];
            $level  = (int) $position;

            if (isset($levels[$level])) {
                return $levels[$level];
            }

            // Text positions are shown as they are, an unknown level number counts as Staff
            if (is_string($position) && trim($position) !== '' && ! is_numeric($position)) {
                return trim($position);
            }

            return 'Staff';
        }

        return (string) config('chat.type_labels.' . (int) $user->type, '');
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
