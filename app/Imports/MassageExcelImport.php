<?php

namespace App\Imports;

use App\Models\MassageExcel;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MassageExcelImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function collection(Collection $rows)
    {
        $stateConfig = config('escorts.profile.states');
        $stateAbbrToId = [];

        foreach($stateConfig as $stateId => $data){
            $stateAbbrToId[strtoupper($data['stateAbbr'])] = $stateId;
        }

        foreach($rows as $row){
            $strAbbr = $stateAbbrToId[strtoupper($row['Location'])];
            $stateId = $stateAbbrToId[$strAbbr] ?? '';

            if($stateId !== null){
                MassageExcel::create([
                    'bussiness_name' => $row[0],
                    'address' => $row[1],
                    'post_code' => $row[2],
                    'state_abbr' => $row[3],
                    'mobile_number' => $row[5],
                    'business_number' => $row[6],
                    'email' => $row[7],
                    'website' => $row[8],
                    'state_id' => $stateId,
                ]);
            }

        }
    }


    public function rules(){
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
