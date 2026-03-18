<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\MassageExcelImport;
use App\Models\MassageExcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class AgentExcelDataManageController extends Controller
{
    public function dataList()
    {
        return view('admin.management.data-list-centres.index');
    }

    public function massageCenterInport(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls,csv|max:2048'
        ]);

        $file = $request->file('excel_file');
        $path = $file->store('temp/massage-excel', 'local');

        try {
            Excel::import(new MassageExcelImport, storage_path('app/' . $path));
            $importedCount = MassageExcel::where('created_at', '>=', now()->subMinutes(2))->count();

            //Delete Local file
            Storage::disk('local')->delete($path);
            return success_response(true, "MassageExcel imported successfully! {$importedCount} records added.", 200, []);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            Storage::disk('local')->delete($path);
            return error_response($e->getMessage(), 500, null, []);
        }
    }
}
