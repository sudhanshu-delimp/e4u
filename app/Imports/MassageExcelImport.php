<?php

namespace App\Imports;

use App\Models\MassageCenterTerritory;
use App\Models\MassageExcel;
use Illuminate\Support\Collection;
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
    public function collection(Collection $rows)
    {
        $stateConfig = config('escorts.profile.states');
        $stateAbbrToId = [];
        $stateName = [];

        foreach ($stateConfig as $stateId => $data) {
            $stateAbbrToId[strtoupper($data['stateAbbr'])] = $stateId;
            $stateName[$stateId] = $data['stateName'];
        }


        $dataInsert = [];
        foreach ($rows as $index => $row) {
            if ($index == 0) continue;
            if (!$this->checkArray($row)) continue;
            $stateId = $stateAbbrToId[strtoupper($row[3])];

            if (!$stateId) continue;
            $now = now();

            $dataInsert[] = [
                'bussiness_name' => $row[0],
                'address' => $row[1],
                'post_code' => $row[2],
                'state_abbr' => strtoupper($row[3]),
                'state_id' => $stateId,
                'territory_name' => $stateName[$stateId] ?? null,
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
                ['status' => 'Pending']
            );
        }

        foreach ($chunks as $chunk) {
            try {
                MassageExcel::insert($chunk);
            } catch (\Exception $e) {
                \Log::error('Error inserting chunk: ' . $e->getMessage());
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
