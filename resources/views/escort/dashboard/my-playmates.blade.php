@extends('layouts.escort')
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between">
            <div class="custom-heading-wrapper">
                <h1 class="h1">My Playmates</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
            </div>
            <div class="back-to-dashboard">
                <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                    <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                </a>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                   <div class="card-body">
                      <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                      <p></p>
                      <ol>
                            <li>Your Playmates are listed here which you can view and manage.</li>
                            <li>To remove a Playmate from your Playmate list, simply click the 'Remove' link in Action.
                                Please note that when you remove a Playmate, they are also removed from all of your
                                Profiles where the Playmate is currently attached to.</li>
                            <li>You can also view your Profiles that a Playmate is attached to by clicking the 'List' link
                                in Action.</li>
                      </ol>
                   </div>
                </div>
            </div>
        </div>
        <div class="row my-2">
           
          
            <!-- My Playmates -->
            <div class="col-md-12 mb-4">
                <div class="table-responsive-xl">
                  <table class="table table-bordered" id="playmateListTable" style="border: none;">
                    <thead style="background-color: #0C223D; color: #ffffff;">
                      <tr>
                        <th class="text-left">Playmates</th>
                        <th class="text-left">Current Location</th>
                        <th class="text-center">Member ID</th>
                        <th class="text-center">Profiles</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody style="border: 1px solid #ddd;">
                        @php
                            $allTotalPlaymates = 0;
                        @endphp
                        @foreach($usersWithPlaymates as $key => $userPlayemate)
                        
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="playmate-avatar">
                                            <img
                                            src="{{ asset('assets/app/img/' . ($userPlayemate['user']->avatar_img ?? 'ellipse-5.png')) }}"
                                            class="img-fluid rounded-circle"
                                            alt=" ">
                                        </div>
                                    </div>
                                </td>
                                <td>{{$userPlayemate['user']->state->name}}</td>
                                <td class="text-center">{{$userPlayemate['user']->member_id }}</td>
                                <td class="text-center">{{count($userPlayemate['playmates']) }}</td>
                                
                                <td class="theme-color text-center bg-white">
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button"
                                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i
                                                class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink" style="">
                                                <a class="listPlaymateModal dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-user-name="{{Str::title($userPlayemate['user']->name ?? 'NA')}}" data-member-ids="{{$userPlayemate['user']->member_id}}" data-user-id="{{$userPlayemate['user']->id}}" data-escort-ids='{{json_encode($userPlayemate['playmates'])}}'> <i class="fa fa-list"></i> List</a>
                                            
                                                <div class="dropdown-divider"></div>
                                                
                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal"
                                            data-target="#removePlaymateModal"> <i class="fa fa-trash"></i> Remove</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @php
                                $allTotalPlaymates += count($userPlayemate['playmates']);
                            @endphp
                      @endforeach
                    
                    </tbody>
                    <tfoot style="" >
                        <tr>
                            <td style="border-bottom: none;" colspan="2"></td>
                            <td class="" style="font-weight: bold;">Total:</td>
                            <td class="totalPlaymatesCount" style="font-weight: bold; border: 1px solid #ddd;">{{$allTotalPlaymates}}</td>
                        </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
        </div>
        
         <!-- List Playmates Modal (Static Data) -->
<div class="modal fade upload-modal" id="listPlaymateModal" tabindex="-1" role="dialog" aria-labelledby="listPlaymateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
  
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="removePlaymateModalLabel">
                <a href="{{route('home')}}"><img src="{{ asset('assets/dashboard/img/boxicon/icon_my-playmates.png') }}" style="width:45px; padding-right:10px;"><span class="text-white user_name">Bunny</span></a>
                
             </h5>
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
                <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
            </span>
          </button>
        </div>
  
        <!-- Modal Body with Static Table -->
        <div class="modal-body">
          <table class="table table-bordered table-striped text-center" >
            <thead style="background-color: #0C223D; color: #ffffff;">
              <tr>
                <th class="text-left">Select</th>
                <th class="text-left">Profile ID</th>
                <th class="text-left">Profile Name</th>
                <th class="text-left">Member ID</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody class="user_playmates_data">
              {{-- <tr>
                <td><input type="checkbox"></td>
                <td>[P001]</td>
                <td>Perth01</td>
                <td>E60123</td>
                <td class="theme-color text-center bg-white">
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button"
                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i
                                class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink" style="">
                                    <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal"
                                    data-target="#listPlaymateModal"> <i class="fa fa-list"></i> List</a>
                                
                                    <div class="dropdown-divider"></div>
                                    
                                <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal"
                                data-target="#removePlaymateModal"> <i class="fa fa-trash"></i> Remove</a>
                                </div>
                    </div>
                </td>
              </tr> --}}
            </tbody>
          </table>
        </div>
  
        <!-- Modal Footer -->
        <div class="modal-footer justify-content-end">
          <button type="button" class="btn-success-modal removeMultipleEscort">Remove</button>
        </div>
      </div>
    </div>
  </div>
  
         
        
          <!-- Remove playmates Modal -->

          <div class="modal fade upload-modal" id="removePlaymateModal" tabindex="-1" role="dialog" aria-labelledby="removePlaymateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
               <div class="modal-content basic-modal">
                  <div class="modal-header">
                    <input type="hidden" class="playmate_user_id"  value="">
                    <input type="hidden" class="playmate_escort_ids" value="">
                     <h5 class="modal-title" id="removePlaymateModalLabel">
                        <img src="{{ asset('assets/dashboard/img/boxicon/icon_my-playmates.png') }}" class="custompopicon"> Remove this Playmate?
                     </h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                           <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                        </span>
                     </button>
                  </div>
                  <div class="modal-body text-center">
                     <h4 class=" body_text mb-0"> Are you sure you want to remove this Playmate?
                     </h4>
                  </div>
                  <div class="modal-footer pr-3 mx-auto">
                     <button type="button" class="btn-cancel-modal" data-dismiss="modal">Cancel</button>
                     <button type="submit" class="btn-success-modal confirm_remove_btn">Confirm Remove</button>
                  </div>
               </div>
            </div>
         </div>
          <!-- Remove success playmates Modal -->

          <div class="modal fade upload-modal child_popup_remove_single_playmate_profile_css" id="removePlaymateSuccessModal" tabindex="-1" role="dialog" aria-labelledby="removePlaymateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
               <div class="modal-content basic-modal">
                  <div class="modal-header">
                    <input type="hidden" class="playmate_user_id"  value="">
                    <input type="hidden" class="playmate_escort_ids" value="">
                     <h5 class="modal-title" id="removePlaymateModalLabel">
                        <img src="{{ asset('assets/dashboard/img/boxicon/icon_my-playmates.png') }}" class="custompopicon"> Playmate Removed
                     </h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                           <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                        </span>
                     </button>
                  </div>
                  <div class="modal-body text-center">
                     <h4 class=" body_text mb-0"> Playmates removed successfully.
                     </h4>
                  </div>
                  <div class="modal-footer pr-3 mx-auto text-center">
                     <button type="button" class="btn-cancel-modal" data-dismiss="modal">OK</button>
                  </div>
               </div>
            </div>
         </div>

        <!-- View escort Listing Modal -->
        <div class="modal fade upload-modal bd-example-modal-lg" id="view-listing" tabindex="-1" role="dialog" aria-labelledby="emailReportLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-custom" role="document">
                <div class="modal-content basic-modal modal-lg">
                    <div class="modal-header">
                        <h5 class="modal-title" id="emailReport">Playmate Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                        </button>
                    </div>
                    <div class="modal-body" id="escortPopupModalBody">
                        <iframe src="" id="escortPopupModalBodyIframe" frameborder="0" style="width:100%; height:80vh;" allowfullscreen></iframe>
                        

                    </div>
                </div>
            </div>
        </div>
            <!-- end -->
@endsection
@section('style')
    <style>
        .toggle-task-form {
            font-size: 16px;
            /* color: #007bff; */
            display: inline-block;
            margin: 20px 0px;
        }

        .agent-tour .card {
            padding: 5px 12px !important;
        }

        .page-item:hover .fa {
            color: white !important;
        }

        .page-item:hover .page-link {
            color: white;
        }
        .child_popup_remove_single_playmate_profile_css{
            background: rgba(0, 0, 0, 0.35)
        }
        .upload-modal h4 {
            color: #000;
            font-size: 18px;
            font-weight: 500;
            line-height: 27px;
        }
    </style>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script>
        var globalEscortIds = {};
        var playmateListTable = $('#playmateListTable').DataTable({
            responsive: false,
            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Member ID...",
                lengthMenu: "Show _MENU_ entries",
                zeroRecords: "No matching records found",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "No entries available",
                infoFiltered: "(filtered from _MAX_ total entries)"
            },
            paging: true,
            searchable: true,
            serverSide: true,
            searching: false,
            ajax: {
                url: "{{ route('escort.get.user-playmates-by-ajax') }}",
                dataSrc: function(json) {
                        $(".totalPlaymatesCount").text(json.totalPlaymatesCount);
                        return json.data; // MUST return the data array for DataTables
                    },
                data: function(data) {
                }
            },
            columns: [
                { data: 'playmate', name: 'playmate'},                         // 0
                { data: 'current_location', name: 'current_location'},                         // 0
                { data: 'member_id', name: 'member_id' },  
                { data: 'profile', name: 'profile' },                     // 9
                { data: 'action', name: 'action', orderable: false, searchable: false } // 10
            ]
        });

        $(document).on('click', '.listPlaymateModal', function() {
            $('#listPlaymateModal').modal('show');
            var userId = $(this).attr('data-user-id');
            var escortIds = $(this).attr('data-escort-ids');
            var memberId = $(this).attr('data-member-ids');
            var userName = $(this).attr('data-user-name');
            $('.user_name').text(userName);

            let data = {
                escort_ids: escortIds,
            };

            globalEscortIds = data;

            fetchPlaymatesDataByAjax(data);

        });

        $(document).on('click', '.removePlaymateParentClass', function() {
            $('#removePlaymateModal').modal('show');
            var userId = $(this).attr('data-user-id');
            var escortIds = $(this).attr('data-escort-ids');

            $('.playmate_user_id').val(userId);
            $('.playmate_escort_ids').val(escortIds);

        });

        $(document).on('click', '.child_popup_remove_single_playmate_profile', function() {
            $('#removePlaymateModal').modal('show');
            $('#removePlaymateModal').addClass('child_popup_remove_single_playmate_profile_css');
            var userId = $(this).attr('data-user-id');
            var escortIds = JSON.stringify([$(this).attr('data-escort-id')]);

            $('.playmate_user_id').val(userId);
            $('.playmate_escort_ids').val(escortIds);
        });

        $(document).on('click', '.removeMultipleEscort', function() {
            $('#removePlaymateModal').modal('show');
            $('#removePlaymateModal').addClass('child_popup_remove_single_playmate_profile_css');

            let escortIds = [];

            $('.user_playmates_data tr').each(function () {
                let isChecked = $(this).find('input[type="checkbox"]').is(':checked');
                if (isChecked) {
                    let escortId = $(this).find('.child_popup_remove_single_playmate_profile').data('escort-id');
                    if (escortId) {
                        escortIds.push(escortId);
                    }
                }
            });

            var userId = "{{auth()->user() ? auth()->user()->id : ''}}";
            jsonEscortIds = JSON.stringify(escortIds);

            $('.playmate_user_id').val(userId);
            $('.playmate_escort_ids').val(jsonEscortIds);

            let data = {
                user_id: userId,
                escort_ids: jsonEscortIds,
            };
        });

        $(document).on('click', '.confirm_remove_btn', function() {
            var userId = $('.playmate_user_id').val();
            var escortIds = $('.playmate_escort_ids').val();

            let data = {
                user_id: userId,
                escort_ids: escortIds,
            };
            
            removePlaymatesByAjax(data);

        });

        $(document).on('click', '.view_escort_profile ', function(e) {
            var escortId = $(this).attr('data-escort-id');
            console.log(escortId, 'escortId');
            var url = '{{ route("profile.description", ":id") }}'.replace(':id', escortId)

            setTimeout(() => {
                $("#escortPopupModalBodyIframe").attr('src', url);
                $('#view-listing').modal('show');
            }, 200);
            

        });

        function fetchPlaymatesDataByAjax(formData)
        {
            let fetchUrl = "{{ route('escort.get.my-playmates-by-ajax')}}";
             $.ajax({
                url: fetchUrl, // form action URL
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                },
                success: function(response) {
                    console.log(response);
                    // handle success
                    var html = '';
                    if(response.data.length > 0){
                        response.data.forEach(function(escort){
                            html += `
                            <tr>
                                <td><input type="checkbox" name="" value=""></td>
                                <td>`+escort.id+`</td>
                                <td>`+escort.name+`</td>
                                <td>`+escort.user.member_id+`</td>
                                <td class="theme-color text-center bg-white">
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button"
                                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i
                                                class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="view_playmate_profile dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                    aria-labelledby="dropdownMenuLink" style="">
                                                    <a class="view_escort_profile dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-escort-id="`+escort.id+`" > <i class="fa fa-eye"></i> View</a>
                                                
                                                    <div class="dropdown-divider"></div>
                                                    
                                                <a class="child_popup_remove_single_playmate_profile dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-escort-id="`+escort.id+`" data-user-id="`+{{auth()->user() ? auth()->user()->id : ''}}+`"> <i class="fa fa-trash"></i> Remove</a>
                                                </div>
                                    </div>
                                </td>
                            </tr>`;
                        });
                    }

                    $('.user_playmates_data').html(html);
                    
                },
                error: function(xhr) {
                    // handle error
                    alert('Something went wrong. Please try again.');
                }
            });
        }

        function removePlaymatesByAjax(formData)
        {
            let actionUrl = "{{ route('escort.remove.my-playmates-by-ajax')}}";

             $.ajax({
                url: actionUrl, // form action URL
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                },
                success: function(response) {
                    if(response.success){
                        $('#removePlaymateModal').modal('hide');
                        $('#removePlaymateSuccessModal').modal('show');
                        playmateListTable.ajax.reload();

                        let data = globalEscortIds;
                        console.log(data, 'globalEscortIds');
                    }
                },
                error: function(xhr) {
                    // handle error
                    alert('Something went wrong. Please try again.');
                }
            });
        }

     
    </script>
@endsection
