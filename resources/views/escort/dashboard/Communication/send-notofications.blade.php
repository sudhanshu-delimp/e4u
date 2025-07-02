@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
@endsection
@section('content')
<div id="content-wrapper" class="d-flex flex-column">
   <!-- Main Content -->
   <div id="content">
      <div class="container-fluid pl-3 pl-lg-5">
         {{-- Page Heading   --}}
        <div class="row">
         <div class="d-flex align-items-center justify-content-start mt-5 flex-wrap col-lg-12">
             <h1 class="h1">Send Notifications</h1>
             <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
         </div>
         <div class="col-md-12 my-2">
             <div class="card collapse" id="notes" style="">
             <div class="card-body">
                 <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                 <ol>
                  <li>Use this feature for displaying a list of your Viewers who have flagged you in their Legbox.</li>
                  <li>You can send a notification to a Viewer or all of the Viewers.  Simply select and click the ‘Send Notification’ button and the Viewer will be notified of your impending visit to their Location according to their preferred method.</li>
                  <li>You can also search for a Viewer if you can't find them in your list.  The search criteria is by name only (always remember the Viewer may be using an alias).</li>
                  <li>Use the 'Block Viewer' feature to restrict a Viewer from communicating with you or from seeing any of your Profiles (the Viewer must be logged in for this feature to have effect).</li>
              
                 </ol>
             </div>
             </div>
         </div>
     </div>
     {{-- end --}}
         <!--middle content-->
         <div class="row mt-5">
            <div class="col-sm-8 col-md-8 col-lg-8 ">
               <!-- Begin Page Content -->
               <div class="container-fluid" style="padding: 0px 0px;">
                  <div class="row">
                     <div class="col-lg-4 col-md-12 col-sm-12">
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
                     <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="bothsearch-form" style="gap: 10px;">
                           <button type="button" class="btn btn-primary create-tour-sec" data-toggle="modal" data-target="#new-ban">Send Notification</button>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- /.container-fluid --><br>
               
               <div class="row">
                  <div class="col-md-12">
                     <div class="table-responsive-xl">
                        <table class="table">
                           <thead class="table-bg">
                              <tr>
                                 <th scope="col">
                                    <div class="ckbox">
                                       <input type="checkbox" id="checkbox1">
                                    </div>
                                 </th>
                                 <th scope="col">Viewer Name</th>
                                 <th scope="col">
                                    Home State
                                    <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-left: 5px;">
                                       <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                    </svg>
                                 </th>
                                 <th scope="col">Contact Method</th>
                                 <th scope="col">Block Viewer</th>
                              </tr>
                           </thead>
                           <tbody class="table-content">
                              <tr class="row-color">
                                 <td class="theme-color">
                                    <div class="ckbox">
                                       <input type="checkbox" id="checkbox1">
                                    </div>
                                 </td>
                                 <td class="theme-color"><img src="{{ asset('assets/app/img/profile-img.png')}}" class="img-profile rounded-circle playmats-img ">Skusta clee</td>
                                 <td class="theme-color">SA</td>
                                 <td class="theme-color">By email</td>
                                 <td class="theme-color">
                                    <div class="custom-control custom-switch">
                                       <input type="checkbox" class="custom-control-input" id="customSwitch_1">
                                       <label class="custom-control-label" for="customSwitch_1"></label>
                                    </div>
                                 </td>
                              </tr>
                              <tr class="row-color">
                                 <td class="theme-color">
                                    <div class="ckbox">
                                       <input type="checkbox" id="checkbox1">
                                    </div>
                                 </td>
                                 <td class="theme-color"><img src="{{ asset('assets/app/img/profile-img.png')}}" class="img-profile rounded-circle playmats-img ">Johny Bravo</td>
                                 <td class="theme-color">SA</td>
                                 <td class="theme-color">By Mobile</td>
                                 <td class="theme-color">
                                    <div class="custom-control custom-switch">
                                       <input type="checkbox" class="custom-control-input" id="customSwitch_2">
                                       <label class="custom-control-label" for="customSwitch_2"></label>
                                    </div>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <!--middle content end here-->
            <!--right side bar start from here-->
         </div>
         <!--right side bar end-->
      </div>
   </div>
   <!-- End of Main Content -->
   <!-- Footer -->
   <!-- End of Footer -->
</div>

<div class="modal fade upload-modal" id="new-ban" tabindex="-1" role="dialog" aria-labelledby="new-ban" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="new-ban">Send Notification</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0">
            <form>
               <div class="row">
                  <div class="col-12 mb-3">
                     <select class="form-control rounded-0">
                        <option>Select Home State</option>
                     </select>
                  </div>
                  <div class="col-12 mb-3">
                     <div class="form-group text-left" style="border: 2px dashed #e3e6f0;padding: 15px 10px 35px 10px;">
                     <label class="form-check-label" for="exampleCheck1" style="color: #323C47;">You are about to send notification to all viewers located in Home State. </label>
                     <!-- if only one selected -->
                      
                     <label class="form-check-label" for="exampleCheck1" style="color: #323C47;">You are about to send notification to <span>[Viewers name]</span>  and viewers located in <span>[Location]</span>. </label>
                           <div class="card-body px-0">
                              <h4 class="NotesHeader"><b>Notes:</b> </h4>
                                <ol>
                                  <li>The Viewer will only receive this Notification if they have the feature
                                  enabled.</li>
                                  <li>The Notification will identify you by your Membership ID and Stage Name.</li>
                              </ol>
                            </div>
                  </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer pr-3">
            <div class="col-10 pl-0">
               <div class="form-group">
                  <label class="form-check-label pr-4" for="exampleCheck1">Date:<span class="ml-1" style="font-weight: 300;">12/31/2022</span></label>
                  <label class="form-check-label pr-4" for="exampleCheck1">  No. of Viewers:<span class="ml-1" style="font-weight: 300;">[total]</span></label>
               </div>
            </div>
            <button type="button" class="btn btn-primary">Send</button>
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
