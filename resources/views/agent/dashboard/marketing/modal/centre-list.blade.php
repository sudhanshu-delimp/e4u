<div class="report_container">

    {{-- Header --}}
    <div class="header">
        <h3>Merged Documents Ready</h3>
        <p>Document {{$doc_type ?? ''}} - {{ $centres->count() }} personalized documents ready</p>
    </div>

    {{-- Select All --}}
    <div class="select-all">
        <label style="cursor:pointer;">
            <input type="checkbox" id="selectAll">
            Select All
        </label>
    </div>

    {{-- Centre Items --}}
    @foreach ($centres as $centre)
        <div class="item" data-id="{{ $centre->id }}">

            <div class="left">
                <input type="checkbox" class="itemCheckbox" data-centre-id="{{ $centre->id }}"  data-report-id="{{ $reportId }}" data-doc-type="{{$doc_type}}">
                <div class="centre-info">
                    <strong>{{ $centre->bussiness_name }}</strong><br>
                    <small>{{ $centre->address }}</small>
                </div>
            </div>

            <div class="action_btn">
                <button class="btn-print-single" data-centre-id="{{ $centre->id }}" data-report-id="{{ $reportId }}" data-doc-type="{{$doc_type}}" >
                    Print
                </button>
                <a href="mailto:{{ $centre->email ?? '' }}" class="btn-email-single" data-email="{{ $centre->email ?? '' }}" data-doc-type="{{$doc_type}}" data-centre-id="{{ $centre->id }}" data-report-id="{{ $reportId }}">
                    Email
                </a>
            </div>
        </div>
    @endforeach

    {{-- Hidden - JS context ke liye --}}
    <input type="hidden" id="current_report_id" value="{{ $reportId }}">

</div>
