@extends('layouts.admin')
@section('style')
@stop
@section('content')
        <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
            <div class="row">
                <div class="custom-heading-wrapper col-md-12">
                    <h1 class="h1">Position Descriptions</h1>
                    <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes"
                        aria-expanded="true">Help?</span>
                </div>
                <div class="col-md-12">
                    <div class="card collapse" id="notes" style="">
                        <div class="card-body">
                           <h3 class="NotesHeader"><b>Notes:</b></h3>
                            <ol></ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end --}}
            <div class="row">
                <div class="col-md-12">
                    <h3><b>Coming Soon...</b></h3>
                </div>
            </div>
        </div>
@endsection
