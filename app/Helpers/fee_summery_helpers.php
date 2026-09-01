<?php



    function getStateName($stateId, $type = 'abbr')
    {
        $states = config('escorts.profile.states');

        if (!isset($states[$stateId])) {
            return null;
        }

        $state = $states[$stateId];

        return match ($type) {
            'name' => $state['stateName'] ?? null,
            'abbr' => $state['stateAbbr'] ?? null,
            'timezone' => $state['timeZone'] ?? null,
            default => $state,
        };
    }
