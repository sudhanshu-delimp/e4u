@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/parsley/src/parsley.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
{{--
<style type="text/css">
   .parsley-errors-list {
   list-style: none;
   color: rgb(248, 0, 0)
   }
</style>
--}}
@endsection
@section('content')
<div class="container-fluid">
   <div class="col-md-12">
      <div class="row">
         <div class="col-md-12">
            @if(request()->segment(2) != "list-tour")
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb bread-sec pl-0">
                  <li class="breadcrumb-item"><a href="{{ url('escort-dashboard/archive-tours') }}" style="
                     "><i class="fas fa-long-arrow-alt-left"></i>&nbsp;&nbsp;Back To</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Manage Escorts - Tours</li>
               </ol>
            </nav>
            @endif
            <div class="align-items-center justify-content-between mb-4">
               <div class="h3 mb-0 text-gray-800" style="display: inline-block;">{{ucfirst($type)}} Tours</div>
               <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>

                {{--               <h1>{!! Session::has('msg') ? Session::get("msg") : '' !!}</h1>--}}
            </div>
         </div>
      </div>
		<div class="row collapse" id="notes">
			<div class="col-md-12 mb-5">
				<div class="card">
					<div class="card-body">
					  <h3 class="NotesHeader"><b>Notes:</b> </h3>
					  <ol>
						  <li>Use this feature to edit your Tour.</li>
						  <li>You can change any Profile's start or finish date, Membership Type and remove a Profile from the Tour.</li>
						  <li>Any changes to the Tour will automatically adjust your Fee to reflect the changes, including any refund. Refunds will be added to your Account as a Credit to be used for future listings and Tours.</li>
					  </ol>
					</div>
				</div>
			</div>
		</div>
      <div class="row">
         {{--
         <div class="col-md-4 pl-3">
            <form class="search-form-bg navbar-search">
               <div class="input-group">
                  <input type="text" class="search-form-bg-i form-control border-0 small" placeholder="Search " aria-label="Search" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                     <button class="btn-right-icon" type="button">
                     <i class="fas fa-search fa-sm"></i>
                     </button>
                  </div>
               </div>
            </form>
         </div>
         --}}
         <div class="col-md-5">
         </div>
         <div class="col-md-4">
         </div>
         {{-- @if(request()->segment(2) != "edit-tour")
            @if(!empty(auth()->user()->tour_permissition_type) && in_array(1,auth()->user()->tour_permissition_type))
            <div class="col-md-3" style="padding-left: 7rem;">
               <button type="button" class="btn btn-primary create-tour-sec dctour" data-toggle="modal" data-target="#exampleModal"> Create New Tour</button>
            </div>
            @else

            <div class="col-md-3" style="padding-left: 7rem;">
               <button type="button" class="btn btn-primary create-tour-sec dctour" id="showNotification"> Create New Tour</button>
            </div>
            @endif
         @endif --}}


         <div class="modal fade upload-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title mb-0 dynamicTour" id="exampleModalLongTitle">Create New Tour</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                  </div>
                  <div id="addTourForm">
                     <form id="myTour" method="post" action="{{route('escort.store.tour')}}">
                        @csrf
                        <div class="modal-body">
                           <div class="row pl-3">
                              <div class="form-group mb-2 pt-2">
                                 <label for="staticEmail2">Tour Name <span style='color:red'>*</span></label>
                              </div>
                              <div class="form-group mx-sm-3 mb-2">
                                 <input type="text" name="name" required data-parsley-required-message=" Please enter Tour Name" class="form-control" id=" " placeholder=" " value="" data-parsley-errors-container="#Tname">
                              </div>
                           </div>
                           <span id="Tname"></span>
                           <!--  <div class="form-group mb-2">
                              <label for="staticEmail2">Tour Name</label>
                              </div>
                              <div class="form-group mx-sm-3 mb-2">
                              <input type="text" name="name" required data-parsley-required-message=" Please enter Tour Name" class="form-control" id=" " placeholder=" " value=""> </div> -->
                           <div id="accordion" class="myacording-design mb-0 pt-3 cv">
                              @include('escort.dashboard.archives.partials.tourModal')

                           </div>
                           <div class="col-md-12 p-0">
                              <button type="button" class="btn btn-primary create-tour-sec w-100 addLocation" data-count="1">Add Location <i class="fa fa-fw fa-plus" style="color: #fff;"></i> </button>
                           </div>
                        </div>
                        <div class="modal-footer border-0 pt-5" style="justify-content: flex-start;">
                           <button type="submit" class="btn btn-secondary create-tour-sec" id="poli_payment">Save</button>
                           <button type="button" class="btn btn-primary create-tour-sec resetTour">Reset</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal delete" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                  </div>
                  <div id="addTourForm2">
                     <form id="deleteMyTour" method="post" action="{{route('escort.delete.tour',':id')}}">
                        @csrf
                        <div class="col-md-12 p-0">
                           <span>Are you sure, You want to delete.  </span>
                        </div>
                        <input type="hidden" id="deleteId" value="">
                        <div class="modal-footer border-0 pt-5" style="justify-content: flex-start;">
                           <button type="submit" class="btn btn-secondary create-tour-sec">Ok</button>
                           <button type="button" class="btn btn-primary create-tour-sec" data-dismiss="modal" aria-label="Close">close</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal delete" id="pesrmissionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header main_bg_color border-0">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"> <span aria-hidden="true">
                     </span>
                     </button>
                  </div>
                  <div id="addTourForm1">
                     <div class="col-md-12 p-0">
                        <span id="msg">  </span>
                     </div>
                     <input type="hidden" id="deleteId" value="">
                     <div class="modal-footer border-0 pt-5" style="justify-content: flex-start;">
                        <button type="submit" class="btn btn-secondary create-tour-sec permission">Ok</button>
                        <button type="button" class="btn btn-primary create-tour-sec nopermission" data-dismiss="modal" aria-label="Close">close</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal delete" id="AccessModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header main_bg_color border-0">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"> <span aria-hidden="true">
                     </span>
                     </button>
                  </div>

                     <div class="col-md-12 p-0">
                        <span id="msg"> Access Denied </span>
                     </div>
                     <div class="modal-footer border-0 pt-5" style="justify-content: flex-start;">
                        {{-- <button type="submit" class="btn btn-secondary create-tour-sec permission">Ok</button> --}}
                        <button type="button" class="btn btn-primary create-tour-sec nopermission" data-dismiss="modal" aria-label="Close">close</button>
                     </div>

               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="table-responsive pl-1 pt-3 list-sec" id="sailorTableArea">
               <table id="sailorTable" class="table table-striped" width="100%">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Tour Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Days</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>

                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
   $('#myTour').parsley({

   });

   $(document).ready(function () {
   var table = $('#sailorTable').DataTable({
      serverSide: true,
      processing: true,
      ajax: {
         url: "{{ route('escort.tour.dataTable', $type) }}",
         data: function (d) {
            d.search = d.search.value;
            d.length = d.length;
            d.start = d.start;
            d.sort_by = d.columns[d.order[0].column].data;
            d.sort_dir = d.order[0].dir;
         }
      },
      columns: [
         { data: 'id', name: 'ID' },
         { data: 'name', name: 'Tour Name' },
         { data: 'start_date', name: 'Start Date' },
         { data: 'end_date', name: 'End Date' },
         { data: 'days', name: 'Days' },
         { data: 'action', name: 'Action', orderable: false, searchable: false },
      ]
   });

   // Add placeholder to search input
   $('#sailorTable_filter input').attr('placeholder', 'Search by ID or Tour Name');
});


   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
   $(document).on('click','.delete-center', function(e){
       e.preventDefault();
       var $this = $(this);
       var table = $('#myTable').DataTable();
       const swalWithBootstrapButtons = Swal.mixin({
       customClass: {
       confirmButton: 'btn btn-success',
       cancelButton: 'btn btn-danger'
       },
       buttonsStyling: false
       })

       swalWithBootstrapButtons.fire({
           title: 'Are you sure?',
           text: "You won't be able to revert this!",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonText: 'Yes, delete it!',
           cancelButtonText: 'No, cancel!',
           reverseButtons: true
       }).then((result) => {
           if (result.isConfirmed) {
               $.post({
                   type: 'POST',
                   url: $this.attr('href')
               }).done(function (data) {
                   if(data.error == 0)
                   {
                       Swal.fire({
                         icon: 'error',
                         title: 'Oops...',
                         text: 'Something went wrong!',
                         footer: '<a href="">Why do I have this issue?</a>'
                       })
                   }else {
                       swalWithBootstrapButtons.fire(
                       'Deleted!',
                       'Your file has been deleted.',
                       'success'
                       );

                       table.row( $this.parents('tr') ).remove().draw();
                   }


               });
           } else if (
           /* Read more about handling dismissals below */
           result.dismiss === Swal.DismissReason.cancel
           ) {
               swalWithBootstrapButtons.fire(
               'Cancelled',
               'Your imaginary file is safe :)',
               'error'
               )
           }
       });
   });

   $('#play-mates-modal').on('shown.bs.modal', function (e) {

       var name, city, source = e.relatedTarget;
       console.log($(source).data('url'));
       $('#hidden_escort_id').val($(source).data('id'));

       if(name = $(source).data('name')) {
           $('#playmate-modal-name').html('Playmates for ' + $(source).data('name'));
       }

       if(city = $(source).data('city')) {
           $('#playmate-modal-location').html('<svg width="14" height="21" viewBox="0 0 14 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 10C6.33696 10 5.70107 9.73661 5.23223 9.26777C4.76339 8.79893 4.5 8.16304 4.5 7.5C4.5 6.83696 4.76339 6.20107 5.23223 5.73223C5.70107 5.26339 6.33696 5 7 5C7.66304 5 8.29893 5.26339 8.76777 5.73223C9.23661 6.20107 9.5 6.83696 9.5 7.5C9.5 7.8283 9.43534 8.15339 9.3097 8.45671C9.18406 8.76002 8.99991 9.03562 8.76777 9.26777C8.53562 9.49991 8.26002 9.68406 7.95671 9.8097C7.65339 9.93534 7.3283 10 7 10V10ZM7 0.5C5.14348 0.5 3.36301 1.2375 2.05025 2.55025C0.737498 3.86301 0 5.64348 0 7.5C0 12.75 7 20.5 7 20.5C7 20.5 14 12.75 14 7.5C14 5.64348 13.2625 3.86301 11.9497 2.55025C10.637 1.2375 8.85652 0.5 7 0.5V0.5Z" fill="#FF3C5F"></path></svg>' + $(source).data('city'));
       }

       $.ajax({
           url: $(source).data('url'),
           success: function (data) {
               $('#playmate-template').html(data);
           }
       });
   });

   $('#play-mates-modal').on('hidden.bs.modal', function () {
       $('#playmate-template').html('<div class="spinner-border text-secondary" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div>');
       $('#playmate-modal-name').html('');
       $('#playmate-modal-location').html('');
   });

   $(function () {
       var count = 1;
       var startid = $("#startDate_").attr('id','startDate_'+count);
       var endid = $("#endDate_").attr('id','endDate_'+count);
       $('body').on('change', ".addMore_Location", function(e) {

           var stateId = $(this).val();
           var locationId = $(this).attr('id');
           var getIdValue = locationId.split('_');
           console.log(getIdValue[1]);
           var elem = $(this);
           //var addClass = $(".addAssign_").removeClass('addAssign_'+stateId);
           console.log("hello state=", stateId);
           var url = "{{ route('escort.stateId',':id') }}";
           url = url.replace(':id',stateId);
           console.log("count",count);
           $.ajax({
               url : url,
               method : "POST",
               success: function(data) {
                   console.log(data);
                   var optionString = '';
                   $.each(data.escorts, function(index, elem) {
                       optionString += '<option value='+elem.id+'>'+elem.name+'</option>';
                       console.log(elem);
                   });
                   $('.addAssign_'+getIdValue[1]).attr('id','assignProfile_'+data.id).html(optionString);
                   $("#assignProfile_"+data.id).attr('disabled',  false);

               },
               error: function (data) {
                   console.log("error a",data);
               },

           });
       });


       $('body').on('click', '.addLocation', function(e) {
           //$('#myTour').parsley({});


           //$('#myTour').submit()
           $('#myTour').parsley().validate();
           if ($('#myTour').parsley().isValid()) {
               count += 1;
               var row_count = $(this).data('count')+ count - 1;
               console.log("hello="+ row_count);

               if(row_count <= 8) {
                   {{--$('#accordion').append("@include('escort.dashboard.archives.partials.tourModalAppend')".trim());--}}
               }
           }


          $('#kstart_date_'+count).on('change', function()
           {
               console.log(count);
               $("#end_date_"+count).show();
               var val = $(this).val();
               var result = new Date(val);
               console.log("end date "+result);
               var ss = result.setDate(result.getDate() + 1);
               var first_date = moment(ss).format('YYYY-MM-DD');
               //$("#end_date_"+count).val(first_date);
               //     $("#start_date_"+count).attr({
               //    "min" : first_date,
               //     "value" : first_date,         // values (or variables) here
               //     });
               console.log(first_date);
           });

           console.log("val");
       })

       $("body").on('click','#kstart_date_'+count,function(){

               var today = new Date();

               var start_date = moment(today).format('YYYY-MM-DD');
               var startdate = moment();
               //startdate = startdate.subtract(1, "days");
               $("#start_date_"+count).val(startdate);
                   $("#start_date_"+count).attr({
                   "min" : start_date,          // values (or variables) here
                   });
                   console.log("ok date")

       });
       $("body").on('click','#kend_date_'+count,function(){

               var today = new Date();

               var start_date = moment(today).format('YYYY-MM-DD');
               var startdate = moment();
               //startdate = startdate.subtract(1, "days");
               $("#end_date_"+count).val(startdate);
                   $("#end_date_"+count).attr({
                   "min" : start_date,          // values (or variables) here
                   });

                   console.log("ok end date")
       });

       $("body").on('change','#2start_date_'+count,function(){
       // $('#start_date_'+count).on('change', function()
       // {
           console.log(count);
           $("#end_date_"+count).show();
           var val = $(this).val();
           var result = new Date(val);
           console.log("end date "+result);
           var ss = result.setDate(result.getDate() + 1);
           var first_date = moment(ss).format('YYYY-MM-DD');
           $("#end_date_"+count).val(first_date);
               // $("#end_date_"+count).attr({
               // "min" : first_date,
               // "value" : first_date,         // values (or variables) here
               // });
               console.log(first_date);
               console.log(val);

       });
      //  $('body').on('click','.akhReset',function(){
      //      var id = $(this).attr('id');
      //      var today = new Date();
      //      var start_date = moment(today).format('YYYY-MM-DD');
      //      var startdate = moment();
      //      $("#"+id).val(startdate);
      //      $("#"+id).attr({
      //      "min" : start_date,          // values (or variables) here
      //      });
      //      console.log(id);

      //  });
   });



   $("body").on('click', '#showNotification', function(e){
      $('#AccessModal').modal('show');
   })
   $("body").on('click', '#TourPermission', function(e){
      $('#AccessModal').modal('show');
   })



   $("body").on('submit', '#myTour', function(e){
       e.preventDefault();
       console.log("hiii");
       var form = $(this);
         // form.parsley().validate();
         // if(form.parsley().isValid()) {
           var url = form.attr('action');
           var data = new FormData($('#myTour')[0]);
           console.log(url);
           $('#pesrmissionModal').modal('show');
           $('#msg').html("Are you sure you want to save?");
           $('.nopermission').click(function(){
               location.reload();
           });
           $('.permission').click(function(){
               $('#pesrmissionModal').modal('hide');




               $.ajax({
                   method: form.attr('method'),
                   url:url,
                   data:data,
                   contentType: false,
                   processData: false,
                   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                   success: function (data) {
                       console.log(data);
                       if(!data.error){

                        $('#poli_payment').prop('disabled', true);
                                $('#poli_payment').html('<div class="spinner-border"></div>');
                                var tourId = data.tour.id;
                                var url = "{{ route('escort.tour.paymentUrl',':id')}}";
                                url = url.replace(':id',tourId);
                                console.log("url = "+url);

                                $('<form/>', { action: url, method: 'POST' }).append($('<input>', {type: 'hidden', name: '_token', value: '{{csrf_token()}}'}),).appendTo('body').submit();
                           // $.toast({
                           //     heading: 'Success',
                           //     text: 'Record successfully update',
                           //     icon: 'success',
                           //     loader: true,
                           //     position: 'top-right',      // Change it to false to disable loader
                           //     loaderBg: '#9EC600'  // To change the background
                           // });
                           //location.reload();
                       } else {
                           $.toast({
                               heading: 'Error',
                               text: 'Records Not update',
                               icon: 'error',
                               loader: true,
                               position: 'top-right',      // Change it to false to disable loader
                               loaderBg: '#9EC600'  // To change the background
                           });

                       }

                   }
               });
           });
       //}

   })

   $(document).ready(function(){
       $('body').on('click', '.editTour', function(e) {
           var id = $(this).data('id');

           console.log("");
           $('#exampleModal').modal('show');


           // $('#exampleModal').on('hidden.bs.modal', function(e){
           //     $(this).find('#myTour')[0].reset();
           // });
           var url = "{{ route('escort.tour.edit',':id')}}";
           //url.replace(':id', id);
           url = url.replace(':id',id);

           console.log(url);
           $.ajax({
               url : url,
               type : "post",
               contentType: false,
               processData: false,
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               success: function (data) {
                   $('#addTourForm').html(data.template);
               }

           });


           $("#exampleModalLongTitle").text('Edit Tour');
           //  $('#myTour').parsley({

           // });
       });
   });

   $('body').on('hidden.bs.modal','#exampleModal', function () {

       // console.log("dsfsdfsdfsdfs s fsd");
       // console.log($('#myTour')[0].reset());
       location.reload();
   });

   $('body').on('click','.resetTour', function () {
       $('#myTour')[0].reset();
      // $('input[type=date]').val('');
      var p_element = $(this);
      var element_class = p_element.attr('data-class');
       console.log("hii="+element_class);
       $('select.'+element_class).prop('selectedIndex',0);
       $('input[type=date]').val('');
       $('input[type=text]').val('');
       //location.reload();

   });

   $(".dctour").click(function(){
       $("#exampleModalLongTitle").text('Create New Tour');
   })
   //deleteMyTour
   $(document).ready(function(){
       $('body').on('click','.deleteTour', function () {
           var id = $(this).data('id');
           $('#deleteModal').modal('show');
           $('#deleteId').val(id);
           console.log("id =="+id);
           // console.log($('#myTour')[0].reset());
           //location.reload();
       });
   })



   $('#deleteMyTour').on('submit',function(e){
       e.preventDefault();
       var id = $('#deleteId').val();
       var form = $(this);
       var data = new FormData($('#deleteMyTour')[0]);
       var url = form.attr('action');
       url = url.replace(':id',id);
       console.log("url=" + url);
       $('#deleteModal').modal('hide');

       //console.log(url);
       $.ajax({
           type:"post",
           url:url,
           data:data,
           contentType: false,
           processData: false,
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           success: function(data){
               console.log(data);
               if(!data.error){
                   $.toast({
                       heading: 'Success',
                       text: 'Tour delete successfully',
                       icon: 'success',
                       loader: true,
                       position: 'top-right',      // Change it to false to disable loader
                       loaderBg: '#9EC600'  // To change the background
                   });
                  location.reload();
               } else {
                   $.toast({
                       heading: 'Error',
                       text: 'Records Not delete',
                       icon: 'error',
                       loader: true,
                       position: 'top-right',      // Change it to false to disable loader
                       loaderBg: '#9EC600'  // To change the background
                   });

               }
           }
       });
   });




   $('body').on('change','.akhReset', function()
        {



            var val = $(this).attr('id');
            var selectedDate = $("#"+val).val();

            var getCountValue = val.split('_');

            if(getCountValue[0] == "startDate") {
                var result = new Date(selectedDate);
                var ss = result.setDate(result.getDate() + 1);
                var first_date = moment(ss).format('YYYY-MM-DD');
                //$("#endDate_"+getCountValue[1]).val('');
                $("#endDate_"+getCountValue[1]).attr({
                "min" : first_date,
                "value" : first_date,         // values (or variables) here
                });
            }

                // $("#end_date").attr({
                // "min" : first_date,
                // "value" : first_date,         // values (or variables) here
                // });
                //$('#start_date_tab').html(val);

                console.log(first_date);
                console.log(val);

        });
</script>
@endpush
