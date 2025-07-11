@extends('layouts.escort')

@section('style')

@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="v-main-heading h3 mb-2 pt-4 d-flex align-items-center"><h1 class="p-0">Agent Messages</h1>
                <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></h6>
            </div>
        </div>        
        <div class="row">
            <div class="col-md-12 my-2">
                <div class="card collapse" id="notes" style="">
                   <div class="card-body">
                      <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                      <p></p>
                      <ol>
                      </ol>
                   </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
@endsection
