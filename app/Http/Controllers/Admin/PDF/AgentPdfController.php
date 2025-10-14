<?php

namespace App\Http\Controllers\Admin\PDF;

use PDF; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgentPdfController extends Controller
{
    public function generate_agent_info_pdf(Request $request)
    {
       $html = $request->input('html', '');
       $html = trim(preg_replace('/>\s+</', '><', $html));
       $pdf = PDF::loadHTML($html)->setPaper('a4', 'portrait');
       return $pdf->stream('agent-info.pdf');
    }
}
