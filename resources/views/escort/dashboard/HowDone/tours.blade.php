@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<style type="text/css">
    .parsley-errors-list {
    list-style: none;
    color: rgb(248, 0, 0)
    }
    .how--work {
    margin: 40px auto;
    padding: 0 20px;
    display: grid;
    grid-template-columns: 270px 1fr;
    gap: 24px;
    width: 100%;
    position: relative;
}

.toc {
    position: sticky;
    top: 10px;
    align-self: start;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 18px;
    box-shadow: 0 10px 24px rgba(2,6,23,.06);
    padding: 16px;
}
.toc a {
    display: block;
    padding: 5px 10px;
    border-radius: 10px;
    color: #0c223d !important;
    text-decoration: none;
    border: 1px solid transparent;
    font-weight: 500;
}
.toc a:hover{
    color: #FF3C5F !important;
}
.card > .head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 20px;
    border-bottom: 1px solid #e5e7eb;
}
.card h2 {
    margin: 0;
    font-size: 22px;
    font-weight: 500;
}

.pill {
    font-size: 12px;
    padding: 3px 8px;
    border-radius: 999px;
    border: 1px solid #e5e7eb;
    color: #4b5563;
}
.card > .head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 20px;
    border-bottom: 1px solid #e5e7eb;
}
.card h2 {
    margin: 0;
    font-size: 22px;
    font-weight: 500;
}

.pill {
    font-size: 12px;
    padding: 3px 8px;
    border-radius: 999px;
    border: 1px solid #e5e7eb;
    color: #4b5563;
}
.card .inner {
    padding: 14px 20px 22px;
}
details[open] {
    /* background: linear-gradient(180deg, #fafbff, #ffffff); */
}
details {
    background: #fafbff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 15px 20px;
    margin: 20px 0;
}

details > summary {
    list-style: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    font-weight: 600;
}
details[open] > summary:first-of-type {
    list-style-type: disclosure-open;
}
.chip {
    font-size: 12px;
    padding: 2px 8px;
    border-radius: 999px;
    background: rgba(125, 211, 252, .15);
    color: var(--accent);
    border: 1px solid rgba(125, 211, 252, .3);
}

.summary-title {
    display: flex;
    align-items: center;
    gap: 10px;
}

.steps p {
    margin-block-start: 1em;
    margin-block-end: 1em;
}

.card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 18px;
    box-shadow: 0 10px 24px rgba(2, 6, 23, .06);
    padding: 0;
}
.callout {
    padding: 12px 14px;
    border: 1px dashed #e5e7eb;
    border-radius: 14px;
    background: rgba(94, 161, 255, .08);
}

.summary-title:hover {
    color: #FF3C5F;
}

.summary-title ul {
    padding: 8px 0 8px 24px;
}

.steps ul {
    margin: 8px 0 8px 8px;
}
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <div class="row">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1">Tours</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
        </div>
    </div>

@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
    
@endpush
