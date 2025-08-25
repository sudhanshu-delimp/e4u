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
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead style="background-color: #0C223D; color: #ffffff;">
                      <tr>
                        <th class="text-left">Playmates</th>
                        <th class="text-left">Current Location</th>
                        <th class="text-center">Member ID</th>
                        <th class="text-center">Profiles</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
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
                      {{-- <tr>
                        <td>
                            <div class="d-flex align-items-center">
                               
                                <div class="playmate-avatar">
                                    <img
                                    src="{{ asset('assets/app/img/ellipse-5.png') }}"
                                    class="img-fluid rounded-circle"
                                    alt=" ">
                                </div>
                            </div>
                        </td>
                        <td>Queensland</td>
                        <td class="text-center">E40123</td>
                        <td class="text-center">2</td>
                        
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
                      <tr>
                        <td style="border:none;" colspan="2"></td>
                        <td class="text-right" style="font-weight: bold;">Total:</td>
                        <td style="text-align: center; font-weight: bold;">{{$allTotalPlaymates}}</td>
                        <td style="border:none;"></td>
                    </tr>
                    
                    </tbody>
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
          <table class="table table-bordered table-striped text-center">
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
              <tr>
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
              </tr>
              {{-- <tr>
                <td><input type="checkbox"></td>
                <td>[P002]</td>
                <td>Perth02</td>
                <td>E40123</td>
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
              </tr>
              <tr>
                <td><input type="checkbox"></td>
                <td>[P003]</td>
                <td>Perth03</td>
                <td>E30123</td>
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
          <button type="button" class="btn-success-modal">Remove</button>
        </div>
      </div>
    </div>
  </div>
  
         
        
          <!-- Remove playmates Modal -->

          <div class="modal fade upload-modal" id="removePlaymateModal" tabindex="-1" role="dialog" aria-labelledby="removePlaymateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
               <div class="modal-content basic-modal">
                  <div class="modal-header">
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
                     <p class="mb-0"> Are you sure you want to remove this Playmate?
                       </p>
                  </div>
                  <div class="modal-footer pr-3 mx-auto">
                     <button type="button" class="btn-cancel-modal" data-dismiss="modal">Cancel</button>
                     <button type="submit" class="btn-success-modal">Confirm Remove</button>
                  </div>
               </div>
            </div>
         </div>
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
    </style>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            // $('#save_button').on('click', function(e) {
            //     e.preventDefault(); // prevent the default form submission

            //     let formData = $('#task_form').serialize(); // serialize form data
            //     let actionUrl = $('#task_form').attr('action');  // let actionUrl = "{{ route('dashboard.ajax-add-task')}}";

            //     console.log(formData, actionUrl, ' jitemn');

            //     callAjax(formData, actionUrl);
                
            // });

        });

        $(document).on('click', '.listPlaymateModal', function() {
            $('#listPlaymateModal').modal('show');
            var userId = $(this).attr('data-user-id');
            var escortIds = $(this).attr('data-escort-ids');
            var memberId = $(this).attr('data-member-ids');
            var userName = $(this).attr('data-user-name');

            let data = {
                user_id: userId,
                escort_ids: escortIds,
                member_id: memberId,
                user_name: userName,
            };

            fetchPlaymatesDataByAjax(data);

        });

        function fetchPlaymatesDataByAjax(formData)
        {
            let fetchUrl = "{{ route('escort.get.my-playmates-by-ajax')}}";
            // var formData = new from();
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
                    //alert('Task marked as completed successfully.');
                    // Optionally close modal or reset form
                    var html = '';
                    if(response.data.length > 0){
                        response.data.forEach(function(escort){
                            html += `
                            <tr>
                                <td><input type="checkbox" name="" value=""></td>
                                <td>`+escort.id+`</td>
                                <td>`+escort.profile_name+`</td>
                                <td>`+escort.user.member_id+`</td>
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
                                                    <a class="view_escort_profile dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal"
                                                    data-target="#listPlaymateModal"> <i class="fa fa-eye"></i> View</a>
                                                
                                                    <div class="dropdown-divider"></div>
                                                    
                                                <a class="remove_escort_profile dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal"
                                                data-target="#removePlaymateModal"> <i class="fa fa-trash"></i> Remove</a>
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

        function fetchAjaxEditData(formData)
        {
            let editUrl = "{{ route('dashboard.ajax-edit-task')}}";

             $.ajax({
                url: actionUrl, // form action URL
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                },
                success: function(response) {
                    // handle success
                    alert('Task marked as completed successfully.');
                    // Optionally close modal or reset form
                },
                error: function(xhr) {
                    // handle error
                    alert('Something went wrong. Please try again.');
                }
            });
        }

        function callAjax(formData, actionUrl) {
            $.ajax({
                url: actionUrl, // form action URL
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                },
                success: function(response) {
                    console.log(response);
                    // console.log('response');

                    if(response.task_name == 'open'){
                        $('.totalOpenTask').text(response.data.open);
                        $('.totalInprogressTask').text(response.data.inprogress);
                        $('.totalCompletedTask').text(response.data.completed);
                        return true;
                    }

                    if(response.task_name == 'add_task'){
                        loadTasks(1);
                        $('#taskModal').modal('hide');
                        return true;
                    }

                    //alert('Task marked as completed successfully.');
                    // Optionally close modal or reset form
                },
                error: function(xhr) {
                    // handle error
                    alert('Something went wrong. Please try again.');
                }
            });
        }

     
    </script>
@endsection
