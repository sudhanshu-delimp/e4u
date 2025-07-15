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
                     <form>
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
<div class="modal fade upload-modal" id="Agent_Name" tabindex="-1" role="dialog" aria-labelledby="Edit_CompetitorLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="Agent_Name">History Request </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0">
            <div class="card mb-4 border-0">
               <div class="card-body">
                  <div class="row">
                     <div class="col mt-0">
                        <div class="d-flex align-items-center">
                           <div class="avatar avatar-xl pr-3 mt-1">
                              <img src="{{ asset('assets/img/agn-img.png')}}">
                           </div>
                           <div class="ms-3 name">
                              <h5 class="primery_color normal_heading mb-0" data-toggle="modal" data-target="#Agent_Name"><a class="collapse-item" href="#"><b>Carla Brasil</b></a></h5>
                              <h6 class="text-muted mb-0 small">
                                 Member ID : E03152
                                 <span class="px-3">Ref : E98065</span>
                                 <span>Request Date : 19/08/2022</span>

                              </h6>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card-body pt-4">
                     <div class="row">
                        <div class="col-md-6 list-sec pt-3">
                           <h6><b>Mobile :</b> <span class="ml-2">0123456789</span></h6>
                           <h6><b>Email :</b> <span>jhoannamae@e4u.com</span></h6>

                        </div>
                        <div class="col-md-6 list-sec pt-3">
                           <h6><b>Home State :</b> <span class="ml-2">SA</span></h6>
                           <h6><b>Contact Method :</b> <span class="ml-2">By Mobile</span></h6>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12 list-sec pt-1">
                           <h6><b>Comments:</b> </h6>
                           <h6 class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Diam egestas erat diam mauris, purus auctor nibh tincidunt. Imperdiet lectus in ut phasellus id vulputate vestibulum purus. Nibh sapien arcu, urna lobortis commodo. Nunc consequat dui imperdiet vitae.</h6>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-lg-12">
                           <button type="button" class="btn-cancel-modal" data-dismiss="modal" aria-label="Close">Close</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
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

@push('script')
<script>
   function fetchData(page = 1, search = '') {

      $.ajax({
         url: "{{ route('agent.history-requests') }}" + "?page=" + page + "&search=" + search,
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

   $(document).ready(function() {
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