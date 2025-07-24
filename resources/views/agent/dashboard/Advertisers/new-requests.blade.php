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

    @if($lists->isNotEmpty())
   <div class="row">
      <div class="col-lg-12">
         <div class="custom-search-form">
            <form id="searchForm">
               <label for="search">Search : </label> <input type="search" id="search" name="search" placeholder="Search by Member ID">
            </form>
         </div>
      </div>
   </div>
   @endif


   <div class="col-md-12 pt-4">
      <div id="data-container">
         @include('agent.dashboard.Advertisers.agent-requests-list')
      </div>
   </div>
</div>
</div>

<div id="popupContainer"></div>


@endsection
@push('script')

<script>


   function fetchData(page = 1, search = '') {

         $.ajax({
            url: "{{ route('agent.new-requests') }}" + "?page=" + page + "&search=" + search,
            type: "GET",
            success: function(data) {
               $('#data-container').html(data);
               return true;
            },
            error: function() {
               alert('Something went wrong.');
            }
         });
      }

   $(document).ready(function() {
      let debounce;
      $('#search').on('keyup', function() {
         clearTimeout(debounce);
         let search = $(this).val();
         debounce = setTimeout(function() {
            if (search.length >= 4) {
            fetchData(1, search);
            }
         }, 500);
      });

      $(document).on('click', '.pagination a', function(e) {
         e.preventDefault();
         let page = $(this).attr('href').split('page=')[1].split('&')[0];
         let search = $('#search').val();
         fetchData(page, search);
      });
   });


   // ########### Accept Request #################
   $(document).on("click",".accept", async function() {
      $('#popupContainer').html('');
      let data = {'action': 'accept'}
      let id  = $(this).attr('id');
      if (await isConfirm(data)) {
            ajaxRequest({
               url: "{{ route('agent.process-request') }}",
               method : 'POST',
               data: {
                  id: id,
                  request_type: data.action
               },
               success: function(response) {
                  if (response.success) {
                  let popupHTML = $('#accept-popup-template-'+id).html();
                  $('#popupContainer').html(popupHTML);
                  fetchData(1, '');
                  $('#requestAccepted-' + id).modal('show');
                  }
                  else
                  {
                   Swal.fire('Error', 'Error occured whiile accepting request.', 'error');
                  }
               },
               error: function(xhr) {
                  Swal.fire('Error', 'Error occured whiile making request.', 'error');
               }
            });
      }
   })

   // ########### Reject  Request #################
   $(document).on("click",".reject", async function() {
      let data = {'action': 'reject'}
      let id  = $(this).attr('id');
      $('#popupContainer').html('');
      if (await isConfirm(data)) {
            ajaxRequest({
               url: "{{ route('agent.process-request') }}",
               method : 'POST',
               data: {
                  id: id,
                  request_type: data.action
               },
               success: function(response) {
                  if (response.success) {
                  let popupHTML = $('#reject-popup-template-'+id).html();
                  $('#popupContainer').html(popupHTML);
                  fetchData(1, '');
                  $('#requestRejected-' + id).modal('show');
                  }
                  else
                  {
                   Swal.fire('Error', 'Error occured whiile rejecting request.', 'error');
                  }
               },
               error: function(xhr) {
                  Swal.fire('Error', 'Error occured whiile making request.', 'error');
               }
            });
      }
   })

   document.getElementById('searchForm').addEventListener('keydown', function(event) {
      if (event.key === 'Enter') {
         event.preventDefault();
      }
   });
</script>
@endpush