@extends('layouts.agent')
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content end here-->
   {{-- Page Heading   --}}
   <div class="row">
      <div class="custom-heading-wrapper col-lg-12">
         <h1 class="h1">History Requests</h1>
         <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
      </div>
      <div class="col-md-12 mb-4">
         <div class="card collapse" id="notes" style="">
            <div class="card-body">
               <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
               <ol>
                  <li>You can view all the Advertiser requests to you for services <b>(Request)</b> here.</li>
                  <li>You can view the full details of the Request by clicking the 'View' icon. The Request will
                     display all the details first provided by the Advertiser in the Request.</li>
                  <li>The Request will also note if the invitation was accepted or rejected.</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   {{-- end --}}
   <div class="row">
      <div class="col-md-12 pt-2">
         <div class="w-100">
            <div class="row">

            @if($lists->isNotEmpty())
               <div class="col-lg-12">
                  <div class="custom-search-form">
                     <form id="searchForm">
                        <label for="search">Search : </label> <input type="search" id="search" name="search" placeholder="Search by Member ID">
                     </form>
                  </div>
               </div>
               @endif

               
               <div class="col-sm-12">
                  <div id="data-container">
                     @include('agent.dashboard.Advertisers.history-requests-list')
                  </div>
               </div>

            </div>
         </div>
      </div>
   </div>
</div>
</div>
@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<style>
.avatar_img img{
width: 60px;
height: 60px;
}
 </style>  
@endsection


@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
@endpush

@push('script')
<script>
   function fetchData(page = 1, search = '') {

      $.ajax({
         url: "{{ route('agent.history-requests') }}" + "?page=" + page + "&search=" + search,
         type: "GET",
         beforeSend: function() {
         },
         success: function(data) {
            $('#data-container').html(data);
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

document.getElementById('searchForm').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
    }
});
</script>
@endpush