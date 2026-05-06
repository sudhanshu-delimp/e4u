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
        //@set_time_limit(0);
        //ini_set('memory_limit', '1G');

        $batch = PdfBatch::find($this->batchId);
        $batch->update(['status' => 'processing']);

   
        $agent = User::with('agent_detail')->find($this->agentId);

   
        $signature = '';
        if (!empty($agent->agent_detail) && !empty($agent->agent_detail->signature_file)) {
            $file = $agent->agent_detail->signature_file;
            $signature = url('storage/' . ltrim($file, '/'));
            \Log::warning("Signature: centre {$signature}");
        }

        $viewPath = $this->docType === '1'
            ? 'agent.dashboard.marketing.modal.doc1'
            : 'agent.dashboard.marketing.modal.doc2';

        $centres = MassageExcel::whereIn('id', $this->centreIds)->get()->keyBy('id');
        $ordered = collect($this->centreIds)
            ->map(fn($id) => $centres->get($id))
            ->filter()
            ->values();

        // ── SINGLE PDF ────────────────────────────────────────────────────────
        if ($ordered->count() === 1) {
            $centre = $ordered->first();

            $pdfContent = PDF::loadView($viewPath, [
                'data' => $this->buildData($centre, $agent, $signature),
            ])
            ->setPaper('a4')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled'      => true,
                'dpi'                  => 96,
                'chroot'               => public_path(),
            ])
            ->output();

            if (empty($pdfContent)) {
                $batch->update(['status' => 'failed']);
                return;
            }

            $filename = $this->sanitizeName($centre['bussiness_name']) . '_report.pdf';
            $path     = storage_path('app/' . $filename);
            file_put_contents($path, $pdfContent);

            $batch->update([
                'processed' => 1,
                'status'    => 'completed',
                'file_path' => $path,
                'file_type' => 'pdf',
            ]);

            return;
        }

        // ── MULTIPLE → ZIP ────────────────────────────────────────────────────
        $tempDir = storage_path('app/temp_' . uniqid());
        mkdir($tempDir, 0755, true);

        $pdfFiles = [];

        foreach ($ordered as $index => $centre) {
            try {
                $pdfContent = PDF::loadView($viewPath, [
                    'data' => $this->buildData($centre, $agent, $signature),
                ])
                ->setPaper('a4')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled'      => true,
                    'dpi'                  => 96,
                    'chroot'               => public_path(),
                ])
                ->output();

                if (empty($pdfContent)) {
                  //  \Log::warning("Empty PDF skipped: centre {$centre->id}");
                    $batch->increment('processed');
                    continue;
                }

                $name = ($index + 1) . '_' . $this->sanitizeName($centre->bussiness_name) . '.pdf';
                $path = $tempDir . DIRECTORY_SEPARATOR . $name;

                file_put_contents($path, $pdfContent);

               // \Log::info("PDF created: $name size=" . filesize($path));

                $pdfFiles[] = ['path' => $path, 'name' => $name];
                $batch->increment('processed');

                unset($pdfContent);
                gc_collect_cycles();

            } catch (\Exception $e) {
              //  \Log::error("PDF failed centre {$centre->id}: " . $e->getMessage());
                $batch->increment('processed');
                continue;
            }
        }

        if (empty($pdfFiles)) {
            $batch->update(['status' => 'failed']);
          //  \Log::error('No PDFs generated — ZIP aborted');
            return;
        }

        // ── ZIP ───────────────────────────────────────────────────────────────
        $zipName = 'report_' . time() . '.zip';
        $zipPath = storage_path('app/' . $zipName);

        $zip    = new ZipArchive();
        $result = $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        if ($result !== true) {
          //  \Log::error('ZipArchive open failed: ' . $result);
            $batch->update(['status' => 'failed']);
            return;
        }

        $addedCount = 0;
        foreach ($pdfFiles as $file) {
            if (file_exists($file['path']) && filesize($file['path']) > 0) {
                $zip->addFile($file['path'], $file['name']);
                $addedCount++;
            } else {
              //  \Log::warning("Skipped invalid PDF: " . $file['name']);
            }
        }

        $zip->close();

       // \Log::info("ZIP created: $zipName | PDFs added: $addedCount | Size: " . filesize($zipPath));

        // Validate
        if (!file_exists($zipPath) || filesize($zipPath) == 0) {
          //  \Log::error('ZIP invalid after close');
            $batch->update(['status' => 'failed']);
            return;
        }

        // Cleanup
        foreach ($pdfFiles as $file) {
            if (file_exists($file['path'])) unlink($file['path']);
        }

        if (is_dir($tempDir)) rmdir($tempDir);

        $batch->update([
            'status'    => 'completed',
            'file_path' => $zipPath,
            'file_type' => 'zip',
        ]);
    }

// ── Helper — Data build karo ──────────────────────────────────────────────

    private function buildData($centre, $agent, $signature): array
    {
        $address = $this->splitAddress($centre['address'] ?? '');

        return [
            'bussiness_name'        => $centre['bussiness_name'],
            'name_of_agent'         => $agent['business_name'],
            'agent_email_address'   => $agent['email'],
            'date'                  => date('d-m-Y'),
            'name_of_massage_parler'=> $centre['bussiness_name'],
            'address1'              => $address['address1'],
            'address2'              => $address['address2'],
            'agent_signature'       => $signature,
            'agent_mobile_number'   => $agent['phone'] ?? '',
            'email'                 => $agent['email'] ?? '',
        ];
    }


    private function getPfdDynamicName($centre)
    {
        $agent = User::with('agent_detail')->find($this->agentId);
        $address = $this->splitAddress($centre['address'] ?? '');

        $signature = '';
       
        if (!empty($agent->agent_detail) && !empty($agent->agent_detail->signature_file)) {
            $file = $agent->agent_detail->signature_file;
            $absolutePath = public_path('storage/' . ltrim($file, '/'));
            
            if (file_exists($absolutePath)) {
                $signature = $absolutePath;  
            }
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

    private function sanitizeName($name)
    {
        return substr(preg_replace('/[^A-Za-z0-9_\-]/', '_', $name), 0, 50);
    }
}
