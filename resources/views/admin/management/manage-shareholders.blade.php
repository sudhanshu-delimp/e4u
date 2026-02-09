@extends('layouts.admin')
@section('style')
@stop
@section('content')
<div id="wrapper">
   <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
         
         <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
            <div class="row">
               <div class="custom-heading-wrapper col-md-12">
                  <h1 class="h1">Manage Shareholders</h1>
                     <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
               </div>
               <div class="col-md-12 mb-5 collapse" id="notes">
                  <div class="card">
                     <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol class="level-1">
                          
                            </ol>
                          </li>
                        </ol>
                     </div>
                  </div>
               </div>
            </div>
      </div>
   </div>
</div>
@endsection

@push('script')
  
@endpush