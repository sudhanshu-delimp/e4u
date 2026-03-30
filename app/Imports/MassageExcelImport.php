<?php

namespace App\Imports;

use App\Models\MassageCenterTerritory;
use App\Models\MassageExcel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;


class MassageExcelImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function checkArray($array)
    {
        return $array->filter(function ($value) {
            return !is_null($value);
        })->count() > 0;
    }

    public function getStateIdByName($stateName, $stateConfig = null)
    {
        $stateConfig = $stateConfig ?? config('escorts.profile.states');

        foreach ($stateConfig as $stateId => $stateData) {
            if (strtoupper($stateData['stateName']) === strtoupper($stateName)) {
                return $stateId;
            }
        }

        return null;
    }

    public function getStateNameByAbbr($stateAbbr, $stateConfig = null)
    {
        $stateConfig = $stateConfig ?? config('escorts.profile.states');

        foreach ($stateConfig as $stateData) {
            if (strtoupper($stateData['stateAbbr'] ?? '') === strtoupper(trim($stateAbbr))) {
                return $stateData['stateName'] ?? null;
            }
        }

        return null;
    }

    public function collection(Collection $rows)
    {
        $stateConfig = config('escorts.profile.states');
        $stateAbbrToId = [];

        foreach ($stateConfig as $stateId => $data) {
            $stateAbbrToId[strtoupper($data['stateAbbr'])] = $stateId;
        }


        $dataInsert = [];
        foreach ($rows as $index => $row) {
            if ($index == 0) continue;
            if (!$this->checkArray($row)) continue;
            $stateAbbr = strtoupper(trim($row[3] ?? ''));
            $stateId = $stateAbbrToId[$stateAbbr] ?? null;

            if (!$stateId) continue;
            $now = now();
            $territoryName = $this->getStateNameByAbbr($stateAbbr, $stateConfig);

            $dataInsert[] = [
                'bussiness_name' => $row[0],
                'address' => $row[1],
                'post_code' => $row[2],
                'state_abbr' => $stateAbbr,
                'state_id' => $stateId,
                'territory_name' => $territoryName,
                'mobile_number' => str_replace(' ', '', $row[4]) ?? '',
                'business_number' => str_replace(' ', '', $row[5]) ?? '',
                'email' => $row[6] ?? '',
                'website' => $row[7] ?? '',
                'created_at' => $now,
                'updated_at' => $now
            ];
        }

        $chunks  = array_chunk($dataInsert, 1000);

        $territories = collect($dataInsert)->pluck('territory_name')->unique();
        foreach ($territories as $territory) {
            MassageCenterTerritory::updateOrCreate(
                ['territory_name' => $territory],
                [
                    'status' => 'Pending',
                    'state_id' => $this->getStateIdByName($territory, $stateConfig),
                ]
            );
        }

        foreach ($chunks as $chunk) {
            try {
                MassageExcel::insert($chunk);
            } catch (\Exception $e) {
                Log::error('Error inserting chunk: ' . $e->getMessage());
            }
        }
    }


    public function rules()
    {
        $validAbbrs = array_column(config('escorts.profile.states'), 'stateAbbr');

        return [
            'bussiness_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'post_code' => 'required|string|max:20',
            'state_id' => ['required', 'string', Rule::in($validAbbrs)],
            'mobile_number' => 'nullable|string|max:15',
            'business_number' => 'nullable|string|max:15',
            'email' => 'nullable|string',
            'website' =>  'nullable|url|max:255',
        ];
    }
}
