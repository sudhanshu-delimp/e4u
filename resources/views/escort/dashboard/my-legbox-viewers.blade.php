@extends('layouts.escort')
@section('style')
<style>
    .table td{
        vertical-align: middle;        
        padding: 12px !important;
    }
    #viewerTable_length{
        float: left;
        padding: 10px 0px;
    }
    #viewerTable_filter{
        float:right;
        padding: 10px 0px;
    }
    #viewerTable_filter input[type='search']{
        width:55% !important;
    }
</style>
@endsection
@section('content')
    <div class="container-fluid pl-lg-4">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="v-main-heading h3 mb-2 pt-4 d-flex align-items-center"><h1 class="p-0">Legbox Viewers</h1>
                <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></h6>
            </div>
        </div>        
        <div class="row">
            <div class="col-md-12 my-2">
                <div class="card collapse" id="notes" style="">
                   <div class="card-body">
                      <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                      <p></p>
                      <ol>
                            <li>Registered Viewers who have flagged you in their Legbox are listed here. You can
                                also see your Viewers <a href="{{url('escort-dashboard/send-notofications')}}" class="custom_links_design">here</a>.</li>
                                <li>The status for each Viewer is Summarised here and includes Notifications and
                                    Contact.</li>
                                <li>The Viewer can set their preferences for Notifications and Contact. You can also set
                                    your preferences here, which will override the Viewer’s settings.</li>
                                <li>If you Block a Viewer, the Viewer will not be able to view any of your Profiles or
                                    communicate with you, while logged onto the Website. That includes Notifications
                                    when you are on Tour.</li>
                      </ol>
                   </div>
                </div>
            </div>
        </div>
        
        <div class="row my-2">
            <!-- My Legbox -->
            <div class="col-md-12 mb-4">
                <div class="mb-2 d-flex align-items-center justify-content-end flex-wrap gap-10">
                
                    <div class="total_listing">
                        <div><span>Total Viewers Legbox : </span></div>
                        <div><span>01</span></div>
                    </div>
                </div>
                <div class="table-responsive custom-responsive">
                    <table id="viewerTable" class="table table-bordered custom--newtable" width="100%">
                        <thead class="bg-first">
                        <tr>
                            <th class="text-left">Viewer ID </th>
                            <th class="text-left">Home State</th>
                            <th class="text-center">Notifications
                                Enabled</th>
                            <th class="text-center">Contact
                                Enabled</th>
                            <th class="text-center">Contact
                                Method</th>
                            <th class="text-center">Viewer
                                Communication</th>
                            <th class="text-center">My Playbox
                                Subscription</th>
                            <th class="text-center">lock
                                Viewer</th>
                            <th class="text-center remove--icon">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            
                            <td class="text-center">V60587</td>
                            <td class="text-center">Western Australia</td>
                            <td class="text-center">[Yes or No] </td>
                            <td class="text-center">[Yes] </td>
                            <td class="text-center">[Text] </td>
                            <td>0438 028 728</td>
                            <td class="text-center">[Yes]</td>
                            <td class="text-center">[Slider]</td>
                            
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
                                            <a class="dropdown-item" href="#" >Disable Contact</a>
                                        
                                            <div class="dropdown-divider"></div>
                                            
                                        <a class="dropdown-item" href="#" >Disable Notifications</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            
                            <td class="text-center">V30789</td>
                            <td class="text-center">Victoria</td>
                            <td class="text-center">[Yes or No] </td>
                            <td class="text-center">[Yes] </td>
                            <td class="text-center">[Text] </td>
                            <td>viewer@gmail.com </td>
                            <td class="text-center">[Yes]</td>
                            <td class="text-center">[Slider]</td>
                            
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
                                            <a class="dropdown-item" href="#" >Disable Contact</a>
                                        
                                            <div class="dropdown-divider"></div>
                                            
                                        <a class="dropdown-item" href="#" >Disable Notifications</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        
                        </tbody>
                  </table>
                </div>
              </div>
        </div>
    </div>
@endsection
@section('script')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#viewerTable').DataTable({
                responsive: true,
                language: {
                    search: "<label>Search:</label> _INPUT_",
                    searchPlaceholder: "Search by ID or Profile Name",
                    lengthMenu: "Show _MENU_ entries",
                    zeroRecords: "No matching records found",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries available",
                    infoFiltered: "(filtered from _MAX_ total entries)"
                },
                paging: true
            });
        });
      </script>
      
@endsection
