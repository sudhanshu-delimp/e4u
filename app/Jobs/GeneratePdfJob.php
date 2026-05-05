<?php

namespace App\Jobs;

use App\Models\MassageExcel;
use App\Models\PdfBatch;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use ZipArchive;

class GeneratePdfJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $batchId;
    public $centreIds;
    public $docType;
    public $agentId;
    public function __construct($batchId,  $centreIds,  $docType, $agentId)
    {
        $this->batchId = $batchId;
        $this->centreIds = $centreIds;
        $this->docType = $docType;
        $this->agentId = $agentId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $batch = PdfBatch::find($this->batchId);
        $batch->update(['status' => 'processing']);

        $viewPath = $this->docType === '1'
            ? 'agent.dashboard.marketing.modal.doc1'
            : 'agent.dashboard.marketing.modal.doc2';

        $centres = MassageExcel::whereIn('id', $this->centreIds)->get()->keyBy('id');

        $ordered = collect($this->centreIds)
            ->map(fn($id) => $centres->get($id))
            ->filter()
            ->values();

        // ✅ SINGLE PDF
        if ($ordered->count() === 1) {

            $centre = $ordered->first();

            $pdf = PDF::loadView($viewPath, [
                'data' => $this->getPfdDynamicName($centre),
            ])->output();

            $filename = 'report_' . time() . '.pdf';
            $path = storage_path('app/' . $filename);
            //mkdir($path, 0755, true);

            file_put_contents($path, $pdf);

            $batch->update([
                'processed' => 1,
                'status'    => 'completed',
                'file_path' => $path,
                'file_type' => 'pdf'
            ]);

            return;
        }

        // ✅ MULTIPLE → ZIP
        $tempDir = storage_path('app/temp_' . uniqid());
        mkdir($tempDir, 0755, true);

        $pdfFiles = [];

        foreach ($ordered as $index => $centre) {

            $pdf = PDF::loadView($viewPath, [
                'data' => $this->getPfdDynamicName($centre),
            ])->output();

            $name = ($index + 1) . '_file.pdf';
            $path = $tempDir . '/' . $name;

            file_put_contents($path, $pdf);

            $pdfFiles[] = ['path' => $path, 'name' => $name];

            // ✅ progress update
            $batch->increment('processed');

            unset($pdf);
            gc_collect_cycles();
        }

        $zipName = 'report_' . time() . '.zip';
        $zipPath = storage_path('app/' . $zipName);

        $zip = new ZipArchive();
        $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($pdfFiles as $file) {
            $zip->addFile($file['path'], $file['name']);
        }

        $zip->close();

        foreach ($pdfFiles as $file) unlink($file['path']);
        rmdir($tempDir);

        $batch->update([
            'status'    => 'completed',
            'file_path' => $zipPath,
            'file_type' => 'zip'
        ]);
    }


    private function getPfdDynamicName($centre)
    {
        $agent = User::with('agent_detail')->find($this->agentId);
        $address = $this->splitAddress($centre['address'] ?? '');

        $signature = '';
        if ($agent && $agent->agent_detail && $agent->agent_detail->signature_file) {
            $signature = url('storage/' . $agent->agent_detail->signature_file);
        }

        return  [
            'bussiness_name' => $centre['bussiness_name'],
            'name_of_agent' => $agent['business_name'],
            'agent_email_address' => $agent['email'],
            'date' => date('d-m-Y'),
            'name_of_massage_parler' => $centre['bussiness_name'],
            'address1' => $address['address1'],
            'address2' => $address['address2'],
            'agent_signature' =>  $signature,
            'agent_mobile_number' => $agent['phone'] ?? '',
            'email' => $agent['email'] ?? '',
        ];
    }

    private function splitAddress($address)
    {
        $words = explode(' ', $address);
        $result = [
            'address1' => '',
            'address2' => ''
        ];

        //check empty 
        $postcode = array_pop($words);
        $state = array_pop($words);


        $result['address2'] = implode(' ', array_slice($words, -1)) . " $state $postcode";
        $result['address1'] = implode(' ', array_slice($words, 0, -1));

        return $result;
    }
}
