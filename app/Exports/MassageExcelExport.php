<?php

namespace App\Exports;

use App\Models\MassageExcel;
use Maatwebsite\Excel\Concerns\FromCollection;

class MassageExcelExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;

    public function __construct($id)
    {
       $this->id = $id;
    }


    public function collection()
    {
        return MassageExcel::where('state_id', $this->id)->select('bussiness_name','address','post_code', 'state_abbr', 'mobile_number', 'business_number', 'email', 'website')->get();
    }

    public function headings(): array
    {
        return ['Business Name', 'Address', 'Post Code', 'Location', 'Mobile Number', 'Business Number', 'Email', 'Website'];
    }
}
