@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<style type="text/css">
.parsley-errors-list {
    list-style: none;
    color: rgb(248, 0, 0)
}

#cke_1_contents {
    height: 150px !important;
}
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!--middle content-->
    <div class="row">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1"> Logged in Users </h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                    style="font-size:16px"><b>Help?</b> </span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes">
                <div class="card-body">
                    <h3 class="NotesHeader"><b>Notes:</b> </h3>
                    <ol>
                        <li>All logged in Users are displayed in this table. Visitors to the Website are displayed
                        under ‘Visitors’.</li>
                        <li>You have limited Action access according to your security level.</li>
                        <li>Legend:</li>
                        <p>E: Escort M: Massage Centre A: Agent V: Viewer S: Staff</p>
                        <p>Prefixes:</p>
                        <p>1. ACT 2. NSW 3. Vic 4. Qld 5. SA 6. W A 7. Tas 8. NT</p>
                    </ol>

                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 ">
            <div class="row my-3">
                <div class="col-md-12 col-sm-12 d-flex justify-content-end">
                  
                    <div class="total_listing">
                        <div><span>Total Users : </span></div>
                        <div><span>95</span></div>
                    </div>
                </div>
            </div>
            <div class="massage_table_class">
                <table class="table" id="logedinUserTable" style="width:100%;">
                    <thead class="table-bg">
                        <tr>
                            <th scope="col">
                                Member ID

                            </th>
                            <th scope="col">
                                Member

                            </th>
                            <th scope="col">
                            IP Address
                            </th>
                            <th scope="col">
                            Platform
                            </th>
                            <th scope="col">Page</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-content">
                        <tr class="row-color">
                            <td width="10%" class="theme-color">M60178</td>
                            <td class="theme-color">Lins Massage</td>
                            <td class="theme-color">123.176.113.164</td>
                            <td class="theme-color">Firefox</td>
                            <td class="theme-color">/escort-dashboard</td>
                            <td>
                                <div class="dropdown no-arrow ml-3">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink" style="">
                                        <!-- <a class="dropdown-item" href="#">Published <i class="fa fa-check text-dark"
                                                style="float: right;"></i></a>
                                        <div class="dropdown-divider"></div> -->
                                        <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#"> <i class="fa fa-eye"></i> View Listing </a>
                                                <div class="dropdown-divider"></div>
                                        <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#"> <i class="fa fa-trash"></i> Suspend  </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="timer_section w-100">
                    <p>Server time: <span>[10:23:51 am]</span></p>
                    <p>Refresh time:<span> [seconds]</span></p>
                    <p>Up time: <span>[214 days & 09 hours 12 minutes]</span></p>
                </div>
            </div>
        </div>
       {{-- <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="timer_section">
                    <p>Server time: <span>[10:23:51 am]</span></p>
                    <p>Refresh time:<span> [seconds]</span></p>
                    <p>Up time: <span>[214 days & 09 hours 12 minutes]</span></p>
                </div>
        </div> --}}
        <div class="col-md-12">
            <div class="my-account-card">
            <div class="card-head">                  
                    
                <h2>My Account details </h2>
                    <button class="print-btn" onclick="window.print()">🖨️ Print Report</button>
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Member ID</label>
                        <span>M60178</span>
                    </div>
                    <div class="info-item">
                        <label>Member</label>
                        <span>Lins Massage</span>
                    </div>
                    <div class="info-item">
                        <label>IP Address</label>
                        <span>123.176.113.164</span>
                    </div>
                    <div class="info-item">
                        <label>Platform</label>
                        <span>Firefox</span>
                    </div>
                    <div class="info-item">
                        <label>Page</label>
                        <span>/escort-dashboard</span>
                    </div>
                    <div class="info-item">
                        <label>Listed Profiles (Escort)</label>
                        <span>08</span>
                    </div>
                    <div class="info-item">
                        <label>Published Masseurs (Massage Centre)</label>
                        <span>02</span>
                    </div>
                    <div class="info-item">
                        <label>Listed Advertisers (Agent)</label>
                        <span>01</span>
                    </div>
                    <div class="info-item">
                        <label>Legboxes (Viewer)</label>
                        <span>04</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
   var table = $("#logedinUserTable").DataTable({
    language: {
        search: "Search: _INPUT_",
        searchPlaceholder: "Search by Ref No..."
    },
    info: true,
    paging: true,
    lengthChange: true,
    searching: true,
    bStateSave: true,
    order: [[1, 'desc']],
    lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
    pageLength: 10
});

 </script>
@endpush