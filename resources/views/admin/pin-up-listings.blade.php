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
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5" >
    <!--middle content-->
    <div class="row">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1"> Pin Up Listings</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                    style="font-size:16px"><b>Help?</b> </span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes">
                <div class="card-body">
                    <h3 class="NotesHeader"><b>Notes:</b> </h3>
                    <ol>
                        <li>All current (published) Pin Up Listings are displayed in this table.</li>
                        <li>You have limited Action access according to your security level.</li>
                        <li>
                            <p>Prefixes:</p>
                            <p>1. ACT 2. NSW 3. Vic 4. Qld 5. SA 6. W A 7. Tas 8. NT.</p>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 ">
            <div class="my-3 col-md-12 col-sm-12 d-flex justify-content-end">
                <div class="total_listing">
                    <div><span>Total Listings : </span></div>
                    <div><span>8</span></div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table pin-table" id="pinUpListingTable">
                    <thead class="table-bg">
                        <tr>
                            <th scope="col">
                                Member ID

                            </th>
                            <th scope="col">
                                Member

                            </th>
                            <th scope="col">
                                Location
                            </th>
                            <th scope="col">
                                Profile ID
                            </th>
                            <th scope="col">Listed </th>
                            <th scope="col">De-listed </th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-content">
                        <tr class="row-color">
                            <td width="10%" class="theme-color">E10178</td>
                            <td class="theme-color">Joy</td>
                            <td class="theme-color">ACT</td>
                            <td class="theme-color">158</td>
                            <td class="theme-color">07-07-2025</td>
                            <td class="theme-color">3-07-2025</td>
                            <td class="theme-color">Current</td>
                            <td>
                                <div class="dropdown no-arrow ml-3">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink" style="">
                                        <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#"> <i class="fa fa-eye"></i> View Listing </a>
                                                <div class="dropdown-divider"></div>
                                        <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#"> <i class="fa fa-trash"></i> Suspend  </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="row-color">
                            <td width="10%" class="theme-color"></td>
                            <td class="theme-color"></td>
                            <td class="theme-color">SA</td>
                            <td class="theme-color"></td>
                            <td class="theme-color"></td>
                            <td class="theme-color"></td>
                            <td class="theme-color"></td>
                            <td>
                                <div class="dropdown no-arrow ml-3">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink" style="">
                                        <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#"> <i class="fa fa-eye"></i> View Listing </a>
                                                <div class="dropdown-divider"></div>
                                        <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#"> <i class="fa fa-trash"></i> Suspend  </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
       <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="timer_section">
                <p>Server time: <span>[10:23:51 am]</span></p>
                <p>Refresh time:<span> [seconds]</span></p>
                <p>Up time: <span>[214 days & 09 hours 12 minutes]</span></p>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/4.15.1/standard-all/ckeditor.js"></script>
<script>
CKEDITOR.replace('editor1', {
    fullPage: true,
    extraPlugins: 'docprops',
    // Disable content filtering because if you use full page mode, you probably
    // want to  freely enter any HTML content in source mode without any limitations.
    allowedContent: true,
    height: 320
});
</script>
@endsection
@push('script')

<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
   var table = $("#pinUpListingTable").DataTable({
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