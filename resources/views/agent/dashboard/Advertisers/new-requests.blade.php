@extends('layouts.agent')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content end here-->
   {{-- Page Heading   --}}
   <div class="row">
      <div class="custom-heading-wrapper col-lg-12">
         <h1 class="h1">New Requests</h1>
         <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
      </div>
      <div class="col-md-12 mb-4">
         <div class="card collapse" id="notes" style="">
            <div class="card-body">
               <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
               <ol>
                  <li>When an Advertiser requests the services of an Agent <b>(Request)</b>, the Request will
                     appear here.</li>
                  <li>You can view the full details of the Request by clicking the accordion arrow. The
                     Request will provide you will all the details you need to decide whether or not you will
                     accept the invitation. The Advertiser’s preferred method of contact is also set out in the
                     Request.</li>
                  <li>If you accept to invitation, the Advertiser will be notified. You need to make contact with
                     the Advertiser within 24 hours.</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   {{-- end --}}
   <div class="row">

      <div class="col-lg-12">
         <div class="custom-search-form">
            <form>
               <label for="search">Search : </label> <input type="search" id="search" name="search" placeholder="Search by Member ID">
            </form>
         </div>
      </div>
   </div>


   <div class="col-md-12 pt-4">

      <div id="data-container">
         @include('agent.agent-requests-list')
      </div>

   </div>

</div>
</div>
{{-- Request Accepted Popup --}}
<div class="modal fade upload-modal" id="requestAccepted" tabindex="-1" role="dialog" aria-labelledby="requestAccepted" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="requestAccepted">Request Accepted</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0">
            <div class="row">
               <div class="col-12 mb-3">
                  <p>The invitation by [Carla Brasil] is confirmed and they have been notified of your acceptance.</p>
                  <p>Please ensure you make contact with [Name] within 24 hours in accordance with the
                     preferred method of contact.</p>
               </div>
            </div>
         </div>
         <div class="modal-footer text-center justify-content-center">
            <button type="button" class="btn-success-modal" data-dismiss="modal" aria-label="Close">Close</button>
         </div>
      </div>
   </div>
</div>
{{-- end --}}

{{-- Request Rejected Popup --}}
<div class="modal fade upload-modal" id="requestRejected" tabindex="-1" role="dialog" aria-labelledby="requestRejected" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="requestRejected">Request Rejected</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0">
            <div class="row">
               <div class="col-12 mb-3">
                  <p>Your rejection of the invitation by [Name] to become their Support Agent is confirmed and
                     they have been notified.</p>
               </div>
            </div>
         </div>
         <div class="modal-footer text-center justify-content-center">
            <button type="button" class="btn-success-modal" data-dismiss="modal" aria-label="Close">Close</button>
         </div>
      </div>
   </div>
</div>
{{-- end --}}
@endsection
@push('script')


<script>
   $(document).ready(function() {
      function fetchData(page = 1, search = '') {
         $.ajax({
            url: "{{ route('agent.new-requests') }}" + "?page=" + page + "&search=" + search,
            type: "GET",
            beforeSend: function() {
               // Optional: add loader here
            },
            success: function(data) {
               $('#data-container').html(data);
            },
            error: function() {
               alert('Something went wrong.');
            }
         });
      }


      let debounce;
      $('#search').on('keyup', function() {
         clearTimeout(debounce);
         let search = $(this).val();
         debounce = setTimeout(function() {
            fetchData(1, search);
         }, 500);
      });

      $(document).on('click', '.pagination a', function(e) {
         e.preventDefault();
         let page = $(this).attr('href').split('page=')[1].split('&')[0];
         let search = $('#search').val();
         fetchData(page, search);
      });
   });
</script>

@endpush