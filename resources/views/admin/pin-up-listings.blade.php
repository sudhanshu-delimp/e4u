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
                    <div><span id="total_listings">0</span></div>
                </div>
            </div>
            <div class="table-responsive-xl">
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
                       
                    </tbody>
                    <tfoot class="bg-first t-foot">
                        <tr>
                            <th colspan="2">
                                    Server time: <span>[10:23:51 am]</span>
                            </th>
                            <th colspan="2" class="text-center">
                                    Refresh time:<span> [seconds]</span>
                            </th>
                            <th colspan="4" class="text-right">
                                    Up time: <span>[214 days & 09 hours 12 minutes]</span>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
       <div class="col-sm-12 col-md-12 col-lg-12">
            
        </div>
    </div>
</div>
@endsection
@push('script')

<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
  var table;
  table = $("#pinUpListingTable").DataTable({
    processing: true,
    serverSide: true,
    lengthChange: false,
    searching: false,
    pageLength: 20,
    ajax: {
        url: `{{route('admin.global_monitoring.get_pinup_listing')}}`,
        type: 'GET',
        error: function(xhr) {
            console.log(xhr);
                let message = 'Something went wrong while fetching data.';
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    message = xhr.responseJSON.error;
                }
                alert(message);
        }
    },
    drawCallback: function(settings) {
        var json = settings.json;
        if (json) {
            $('#total_listings').text(json.recordsTotal);
        }
    },
    columns: [
        { data: 'member_id' },
        { data: 'escort_name' },
        { data: 'location' },
        { data: 'profile_id' },
        { data: 'start_date' },
        { data: 'end_date' },
        { data: 'status' },
        { data: 'option' },
    ]
});

 </script>
@endpush