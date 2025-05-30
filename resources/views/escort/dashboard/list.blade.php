@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<style type="text/css">
   .select2-container .select2-choice, .select2-result-label {
   font-size: 1.5em;
   height: 52px !important;
   overflow: auto;
   }
   .select2-arrow, .select2-chosen {
   padding-top: 6px;
   }
   span.select2.select2-container.select2-container--default > span.selection > span {
   height: 52px !important;
   }
    .brb_icon {
        color: white;
        background-color: #e5365a;
        border-radius: 15%;
        padding: 0 5px;
    }
.parsley-errors-list {
    list-style: none;
    color: rgb(248, 0, 0);
    padding: 0;
    }
    .parsley-errors-list li{
    font-size: 14px;
    line-height: 18px;
    margin-top: 6px;
    }
</style>

@endsection
@section('content')
<div class="d-flex flex-column container-fluid pl-3 pl-lg-5">
    <div class="row">
        <div class="col-md-12">
            <div class="v-main-heading h3" style="display: inline-block;">{{($type == 'past') ? 'Archive' : 'Listed'}} Profiles</div>
            <h6 class="helpNoteLink" data-toggle="collapse" data-target="#profile_and_tour_options"><b>Help?</b> </h6>
        </div>
        <div class="col-md-12 mt-4 collapse" id="profile_and_tour_options">
            <div class="row">
                <div class="col-md-12 mb-5">
                    <div class="card" id="notes">
                        <div class="card-body">
                          <h3 class="NotesHeader"><b>Notes:</b> </h3>
                          <ol>
                              <li>Use this feature to review and make changes to your Profiles.</li>
                              <li>You can view and edit a Profile by selecting 'Action'. By selecting the Action function, you will be able to View, Edit or Delete the Profile.</li>
                              <li>To suspend a Profile listing go to <a href="/escort-dashboard/listings/upcoming" class="custom_links_design">View Listings</a></li>
                          </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="content">
        <div class="container-fluid">
        {{--
        <div class="row">
           <div class="col-md-3">
              <nav class="date-border navbar navbar-expand navbar-light">
                 <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                          role="button" data-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="false">
                       Status
                       </a>
                       <div class="dropdown-menu dropdown-menu-right animated--grow-in"
                          aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="#">Done</a>
                          <a class="dropdown-item" href="#">Remain</a>
                       </div>
                    </li>
                 </ul>
              </nav>
           </div>
           <div class="col-md-2">
           </div>
           <div class="col-md-3">
           </div>
           <div class="col-md-4">
              <form class="search-form-bg navbar-search" style="float: right;">
                 <div class="input-group">
                    <input type="text" class="search-form-bg-i form-control border-0 small"
                       placeholder="Search " aria-label="Search"
                       aria-describedby="basic-addon2">
                    <div class="input-group-append">
                       <button class="btn-right-icon" type="button">
                       <i class="fas fa-search fa-sm"></i>
                       </button>
                    </div>
                 </div>
              </form>
           </div>
        </div>
        --}}
     </div>
     <!-- /.container-fluid --><br>
     <div class="row">
        <div class="col-md-12">
           <div class="box-body table table-hover">
               @if($type != 'past')
               <div>
                   <button style="padding: 10px;" class="btn btn-info" data-toggle="modal" data-target="#add_brb">Add BRB</button>
               </div>
               @endif
              <table class="table table-hover" id="sailorTable">
                 <thead id="table-sec" class="table-bg">
                    <tr>
                       <th>ID</th>
                       <th>Profile Name</th>
                        <th>Location</th>
                       <th>Stage Name</th>
                       <th>Membership</th>
                       <th>Mobile Number</th>
                       <!-- <th>Competitor</th>-->
                       <th>Date Created</th>
                       <th>Status</th>
                       <!--<th>Joined E4U</th>-->
                       <th >Action</th>
                    </tr>
                 </thead>
              </table>
              <div>
              </div>
           </div>
        </div>
     </div>
  </div>
  <!--middle content end here-->
  <!--right side bar start from here-->
</div>
<div class="modal fade upload-modal" id="add_brb" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="brb_form">
            <div class="modal-content" style="width: 800px;position: absolute;top: 30px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Add BRB</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><img id="modal_close" src="{{ asset('assets/app/img/cross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container p-0">
                                    <div class="form-group row">
                                        <label class="col-sm-3" for=""> Profile:</label>
                                        <div class="col-sm-8">
                                            <select class="form-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp" id="profile_id" name="profile_id" data-parsley-errors-container="#profile-errors" required data-parsley-required-message="Select Profile">
                                                <option value="">Select Profile</option>
                                                @foreach($active_escorts as $profile)
                                                    <option value="{{$profile['id']}}" profile_name="{{$profile['profile_name']}}">{{$profile['id']}} - {{$profile['name']}} @if(isset($profile['state']['name']))- {{$profile['state']['name']}}@endif</option>
                                                @endforeach
                                            </select>
                                            <span id="profile-errors"></span>
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3" for=""> BRB Date & Time:</label>
                                        <div class="col-sm-4">
                                            <input type="date" required min="{{date('Y-m-d')}}" class="form-control form-control-sm removebox_shdow" name="brb_date" data-parsley-type="" data-parsley-type-message="">
                                            <span id="brb-time-errors"></span>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="time"  class="form-control form-control-sm removebox_shdow" name="brb_time" required data-parsley-time required>
                                            <span id="brb-time-errors"></span>
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3" for=""> BRB Note:</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control form-control-sm" name="brb_note" id="brb_note" required></textarea>
                                        </div>
                                        <div class="col-sm-2=1"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="text-align: center; display: block;">
                        <button type="submit" class="btn btn-primary" id="save_brb">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal programmatic" id="delete_profile" style="display: none">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content custome_modal_max_width">
         <div class="modal-header main_bg_color border-0">
            <span style="color:white">Delete profile</span>
            {{--
            <h5 class="modal-title" id="exampleModalLabel" style="color:white">Logout</h5>
            --}}
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
            <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
            </span>
            </button>
         </div>
         <div class="modal-body">
            <input type="hidden" id="current" name="current">
            <input type="hidden" id="previous" name="previous">
            <input type="hidden" id="label" name="label">
            <input type="hidden" id="trigger-element">
            <h3 class="mb-4 mt-5"><span id="Lname"></span> </h3>
            <h3 class="mb-4 mt-5"><span id="log"></span> </h3>
            <div class="modal-footer">
               <button type="button" class="btn main_bg_color site_btn_primary" data-dismiss="modal" value="close" id="close_change">Close</button>
               <button type="button" class="btn main_bg_color site_btn_primary" id="save_change">Delete</button>
            </div>
         </div>
      </div>
   </div>
</div>
@include('escort.dashboard.partials.playmates-modal')
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
   $(document).ready( function () {
       var shouldHide = '{{$type == "past" ? false :true}}';
       var table = $("#sailorTable").DataTable({
           "language": {
               "zeroRecords": "No record(s) found.",
               searchPlaceholder: "Search by Id or profile name..."
           },
           processing: true,
           serverSide: true,
           lengthChange: true,
           searchable:false,
           bStateSave: false,
            drawCallback: function(settings) {
                    var api = this.api();
                   // var records = api.data().length;
                    var length = table.page.info().recordsTotal;

                    if (length <= 10) {
                        $('.dataTables_paginate').hide();
                    } else {
                        $('.dataTables_paginate').show();
                    }
                },

           ajax: {
               url: "{{ route('escort.list.dataTable', $type) }}",
               data: function (d) {
                   d.type = 'player';
               }


           },
           columns: [
               { data: 'id', name: 'id', searchable: false, orderable:true ,defaultContent: 'NA'},
               { data: 'pro_name', name: 'profile_name', searchable: true, orderable:true ,defaultContent: 'NA'},
                { data: 'state_name', name: 'state_name', searchable: false, orderable:true ,defaultContent: 'NA'},
               { data: 'name', name: 'name', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'membership', name: 'membership', searchable: false, orderable:true ,defaultContent: 'NA', visible: shouldHide},
               //{ data: 'city_name', name: 'city_name', searchable: false, orderable:true ,defaultContent: 'NA'},
              
               { data: 'phone', name: 'phone', searchable: false, orderable:true,defaultContent: 'NA' },
               { data: 'start_date_parsed', name: 'created_at', searchable: false, orderable:false,defaultContent: 'NA' },
               { data: 'enabled', name: 'enabled', searchable: false, orderable:true,defaultContent: 'NA' },
               { data: 'action', name: 'edit', searchable: false, orderable:false, defaultContent: 'NA' },
           ],
           order: [1,'asc'],
       });
       $('#sailorTable_filter label').append('<i class="fa fa-search "></i>');

   } );

   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
   $(document).on('click','.delete-center122', function(e){
       e.preventDefault();
       var $this = $(this);
       var table = $('#sailorTable').DataTable();
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
   $(document).on('click','.delete-center', function(e){
       e.preventDefault();
       var $this = $(this);
       $("#Lname").html("<p>Would you like to Delete?</p>");

       $('#delete_profile').modal('show');

       $("#save_change").click(function(e){
           console.log($this.attr('href'));
           $.ajax({
                   method: "POST",
                   url:$this.attr('href'),
                   contentType: false,
                   processData: false,
                   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                   success: function (data) {
                       location.reload();
                   }

           })
       });
   });
   $(document).on('click','.brb-inactivate', function(e){
       e.preventDefault();
       var $this = $(this);
       $.ajax({
           method: "POST",
           url:$this.attr('href'),
           contentType: false,
           processData: false,
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           success: function (data) {
               console.log(data.success);
               if(data.response.success) {
                   location.reload();
               } else {
                   Swal.fire(
                       'Oops!',
                       data.response.message,
                       'error'
                   );
               }
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

   $('#search-playmate-input').select2({
       dropdownParent: $("#play-mates-modal"),
       width: '100%',
       dropdownCssClass: "bigdrop",
       placeholder: {
           id: 0, // the value of the option
           text: "{{ asset('assets/app/img/service-provider/Frame-408.png') }}",
           name: 'Search playmate',
           member_id: 'Type name or member id',
       },
       allowClear: true,
       language: {
           inputTooShort: function() {
               return 'Enter Member Id or Name';
           }
       },
       createTag: function(params) {
           var term = $.trim(params.term);

           if (term === '') {
               return null;
           }
           return {
               id: term,
               text: term,
               newTag: true // add additional parameters
           }
       },
       tags: false,
       minimumInputLength: 2,
       tokenSeparators: [','],
       ajax: {
           url: "{{ route('escort.playmates.find') }}",
           dataType: "json",
           type: "POST",
           data: function(params) {

               var queryParameters = {
                   query: params.term,
                   escort_id: $('#hidden_escort_id').val()
               }
               return queryParameters;
           },
           processResults: function(data) {
               return {
                   results: $.map(data, function(item) {

                       return {
                           text: item.default_image,
                           name: item.name,
                           member_id: item.member_id,
                           id: item.id
                       }
                   })
               };
           }
       },
       templateResult: formatEscortList,
       templateSelection: formatEscortList
   });

   $('#search-playmate-input').on('change', function(e) {
       console.log('ll',$(this).val());
       if($(this).val()) {
           $('#playmate_submit_button').show();
       } else {
           $('#playmate_submit_button').hide();
       }
   });

   function formatEscortList (data) {
       console.log('ckjoiujk;',data);
       return $('<span><img class="profile-user-img img-responsive img-circle img-profile rounded-circle small-round-fixed" src="'+data.text+'"> '+data.name+' || '+data.member_id+'</span>');
   }

   $('#add-playmate-form').on('submit', function(e) {
       e.preventDefault();
       $('#playmate_submit_button').attr('disabled', true);
       $('#playmate_submit_button').html('<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>')
       var $this = $(this);
       var escort_id = $('#hidden_escort_id').val();
       var member_id = $('#search-playmate-input').val();
       var url = $this.attr('action');
       $.post({
           type: $this.attr('method'),
           url: url,
           data: {
               escort_id: escort_id,
               playmate_id: member_id
           },
           success: function (data) {
               $('#search-playmate-input').val('');
               $('#playmate_submit_button').hide();
               $('#playmate-template').html(data);
           },
           error: function (data) {
               console.log(data);
           },
       }).done(function (data) {
           $('#playmate_submit_button').attr('disabled', false);
           $('#playmate_submit_button').html('Add Playmate');

           //$("#search-playmate-input").select2("val", "");

           $("#search-playmate-input").empty().trigger('change')
       });
   });

   $(document).on('click', '.remove-playmate', function(e) {
       e.preventDefault();

       var $this = $(this);
       var escort_id = $this.data('escort_id');
       var playmate_id = $this.data('playmate_id');
       const swalWithBootstrapButtons = Swal.mixin({
           customClass: {
               confirmButton: 'btn btn-success',
               cancelButton: 'btn btn-danger'
           },
           buttonsStyling: false
       });

       swalWithBootstrapButtons.fire({
           title: 'Are you sure?',
           icon: 'warning',
           showCancelButton: true,
           confirmButtonText: 'Remove',
           cancelButtonText: 'Cancel!',
           reverseButtons: true
       }).then((result) => {
           if (result.isConfirmed) {
               $.post({
                   type: 'POST',
                   url: "{{ route('escort.playmates.remove') }}",
                   data: {
                       escort_id: escort_id,
                       playmate_id: playmate_id
                   },
               }).done(function (data) {
                   if(data.error == 0) {
                       Swal.fire({
                           icon: 'error',
                           title: 'Oops...',
                           text: data.message
                       });
                   } else {
                       swalWithBootstrapButtons.fire({
                           icon: 'success',
                           title: '',
                           text: data.message
                       });

                       $('#playmate-template').html(data.template);
                   }
               });
           }
       });
   });

    window.Parsley.addValidator('time', {
    validateString: function(value) {
      // Regex to validate time in HH:MM format (24-hour)
      return /^([01]\d|2[0-3]):([0-5]\d)$/.test(value);
    },
    messages: {
      en: 'Please enter a valid time (HH:MM).'
    }
  });
 $('#brb_form').parsley({});

   $("#brb_form").on('submit', function (e) {
       e.preventDefault();
       var form = $(this);
       var profileId = $("#profile_id").val();
       
       // if (form.parsley().isValid()) {
           //var url = '/escort-dashboard/escort-brb/add';
           var url = "{{ route('escort.brb.add') }}";
           var data = new FormData(form[0]);
           var selectedProfileName = $('#profile_id option:selected').attr('profile_name');

           $.ajax({
               method: 'POST',
               url: url,
               data: data,
               contentType: false,
               processData: false,
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               success: function(data) {
                   if (data.response.success) {
                       Swal.fire({
                           icon: "success",
                           text: data.response.message
                       });
                       $("#brb_form")[0].reset();
                       $('#add_brb').modal('hide');
                       var txy = selectedProfileName + ' <sup title="Brb at '+data.response.brbtime+'" class="brb_icon">BRB</sup>';
                       $("#brb_"+profileId).html(txy);
                   } else {
                       Swal.fire({
                           icon: "error",
                           text: data.response.message
                       });
                   }
               },

           });
       // }
   });

   $("#modal_close").on('click', function(e) {
       $("#brb_form")[0].reset();
   });
</script>
@endpush
