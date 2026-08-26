@extends('layouts.agent')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <style>
        .report-table {
            border: 0px;
            border-collapse: collapse;
            border-radius: 5px !important;
            padding: 25px;
        }

        .report-table th,
        .report-table td {
            border: none !important;
        }

        .report-table th {
            font-weight: bold;
        }

        .custom-height {
            height: 40px !important;
        }

        #mergeList .table .inner_details strong {
            width: 110px;
        }

        #mergeList table td {
            vertical-align: middle;
        }
    </style>

        <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        .card {
            background: #ffffff;
            border-radius: 18px;
            box-shadow: 0 25px 70px rgba(0,0,0,0.4);
            width: 100%;
            max-width: 820px;
            overflow: hidden;
        }

        /* ── Top Bar ── */
        .top-bar {
            background: linear-gradient(135deg, #667eea, #764ba2);
            padding: 28px 36px;
            color: white;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .top-bar .icon {
            font-size: 2.2rem;
            background: rgba(255,255,255,0.2);
            width: 58px; height: 58px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .top-bar h1  { font-size: 1.5rem; margin-bottom: 4px; }
        .top-bar p   { font-size: 0.88rem; opacity: 0.85; }

        /* ── Body ── */
        .body { padding: 32px 36px; }

        label {
            display: block;
            font-weight: 700;
            color: #4a5568;
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 10px;
        }

        label span {
            color: #667eea;
            font-size: 0.78rem;
            text-transform: none;
            letter-spacing: 0;
            font-weight: 500;
        }

        textarea {
            width: 100%;
            height: 380px;
            padding: 18px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-family: 'Courier New', monospace;
            font-size: 0.88rem;
            color: #2d3748;
            background: #f8fafc;
            resize: vertical;
            outline: none;
            transition: border-color 0.25s, box-shadow 0.25s;
            line-height: 1.6;
        }

        textarea:focus {
            border-color: #667eea;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(102,126,234,0.12);
        }

        /* ── Toolbar ── */
        .toolbar {
            display: flex;
            gap: 10px;
            margin-top: 10px;
            margin-bottom: 18px;
        }

        .toolbar button {
            padding: 7px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: #f8fafc;
            color: #4a5568;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .toolbar button:hover {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        /* ── Error ── */
        .error-box {
            background: #fff5f5;
            border: 1px solid #feb2b2;
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 18px;
            color: #c53030;
            font-size: 0.85rem;
        }

        /* ── Submit ── */
        .submit-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.05rem;
            font-weight: 700;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s;
            letter-spacing: 0.4px;
        }

        .submit-btn:hover  { opacity: 0.9; transform: translateY(-2px); }
        .submit-btn:active { transform: translateY(0); }

        /* ── Footer Note ── */
        .note {
            text-align: center;
            margin-top: 16px;
            color: #a0aec0;
            font-size: 0.82rem;
        }

        .note strong { color: #667eea; }
    </style>


@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content end here-->{{-- Page Heading   --}}
        <div class="row">
            <div class="custom-heading-wrapper col-md-12">
                <h1 class="h1">Saved Reports</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                       <h3 class="NotesHeader"><b>Notes:</b></h3>
                        <ol>
                            <li>Reports generated from <a href="{{ route('agent.marketing.prospect.list') }}"
                                    class="custom_links_design">Prospects List</a> are saved here.</li>
                            <li>Use these Lists to:
                                <ol>
                                    <li>merge into any of the marketing material provided.</li>
                                    <li>print as a working sheet.</li>
                                    <li>work from your computer screen.</li>
                                </ol>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


                @if ($errors->any())
            <div class="error-box">
                @foreach ($errors->all() as $error)
                    <div>⚠ {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('pdf.generate') }}" method="POST" target="_blank">
            @csrf

            {{-- ✅ SINGLE INPUT ONLY --}}
            <label>
                HTML Content
                <span>— paste your full HTML here</span>
            </label>

            {{-- Quick-fill toolbar --}}
            <div class="toolbar">
                <button type="button" onclick="loadSample()">📋 Load Sample HTML</button>
                <button type="button" onclick="clearInput()">🗑 Clear</button>
            </div>

            <textarea
                name="html_content"
                id="html_content"
                placeholder="Paste your HTML here... e.g.  <h1>Hello</h1><p>My PDF content</p>"
                spellcheck="false"
            >{{ old('html_content') }}</textarea>

            <br><br>

            <button type="submit" class="submit-btn">
                🔍 Convert & View PDF in Browser
            </button>
        </form>

        <p class="note">
            Opens in a <strong>new tab</strong> &bull; Rendered as <strong>A4 PDF</strong> via DomPDF
        </p>



    </div>





    <div id="manage-route" data-csrf-token="{{ csrf_token() }}"
        data-success-image="{{ asset('assets/dashboard/img/unblock.png') }}"
        data-error-image="{{ asset('assets/dashboard/img/alert.png') }}"
        data-save-report-list="{{ route('agent.marketing.save.report.list') }}"
      
        ></div>
@endsection
@push('script')

    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>


@endpush
