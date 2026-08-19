@extends('layouts.escort')
@section('style')
<style>
    .child-table thead th {
        background-color: #022c3d !important;
        color: #fff;
        padding-left: 5px;
    }

    .btn-primary {
        border-color: unset !important;
    }

    td.dt-control {
        cursor: pointer;
        text-align: center;
    }

    td.dt-control::before {
        content: "\2BC5";
        font-weight: bold;
    }

    tr.shown td.dt-control::before {
        content: "\2BC6";
    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between">
        <div class="custom-heading-wrapper">
            <h1 class="h1">My Tours Schedule</h1>
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
                   <h3 class="NotesHeader"><b>Notes:</b></h3>

                    <ol>
                        <li>All of your Tours are listed here for a twelve month period. To View a Tour that is older than 12 months, <a href="{{url('escort-dashboard/list-tour/past')}}" class="custom_links_design">click here</a>.</li>
                        <li>Click the Action function to View Tour and add a Pin Up for any of the Locations within your Tour, or Tour Summary for a summary of all of the important elements of your Tour, including the current leg of the Tour.</li>
                        <li>Click 'Open' to view each of the Tour legs and the Status.  Select the Action feature to Cancel a Tour leg.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive pl-1 pt-3 list-sec" id="sailorTableArea">
                <table id="sailorTable" class="table table-striped" width="100%">
                    <thead>
                        <tr>
                            <th>Open</th>
                            <th>ID</th>
                            <th>Tour Name</th>
                            <th>Locations</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Days</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('escort.dashboard.tourSchedule.modal.summary')
@include('escort.dashboard.tourSchedule.modal.cancel')
@include('escort.dashboard.tourSchedule.modal.cancel_confirmation')
@endsection
@section('script')
<script>
    var table;
    var active_tour_id;
    var cancel_on;
    $(document).ready(function() {
        table = $('#sailorTable').DataTable({
            serverSide: true,
            processing: true,
            pageLength: {{$datatable_entries }},
            lengthMenu: [10, 25, 50, 75, 100],
            "language": {
                "zeroRecords": "There is no record of the search criteria you entered.",
                searchPlaceholder: "Search by ID or Profile Name"
            },
            initComplete: function() {
                //  if ($('#returnToReportBtn').length === 0) {
                //     $('.dataTables_filter').append(
                //           '<button id="returnToReportBtn" class="create-tour-sec my-3">Return to Report</button>'
                //     );
                //  }
                $('#returnToReportBtn').on('click', function() {
                    var table = $('#sailorTable').DataTable();
                    table.search('').draw();
                });
            },

            ajax: {
                url: "{{ route('escort.tour.dataTable','purchased') }}",
                data: function(d) {

                }
            },
            columns: [{
                    className: 'dt-control',
                    orderable: false,
                    data: null,
                    defaultContent: ''
                },
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'locations_numbers',
                    name: 'locations_numbers',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'start_date',
                    name: 'start_date',
                    searchable: false
                },
                {
                    data: 'end_date',
                    name: 'end_date',
                    searchable: false
                },
                {
                    data: 'days_number',
                    name: 'days_number',
                    searchable: false
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'Action',
                    orderable: false,
                    searchable: false,
                    class: 'text-center'
                },
            ],
            order: [4, 'asc'],
        });

        $('#sailorTable tbody').on('click', 'td.dt-control', function() {
            let tr = $(this).closest('tr');
            let row = table.row(tr);
            let id = row.data().id;
            console.log(id);
            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass('shown');
                return;
            }
            // Close other open rows (optional)
            table.rows('.shown').every(function() {
                this.child.hide();
                $(this.node()).removeClass('shown');
            });
            row.child(`
        <div class="p-3">
            <table class="table table-sm table-bordered w-100 child-table" id="child-table-${id}">
                <thead class="bg-first">
                    <tr>
                        <th>Location</th>
                        <th>Days</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" class="text-center">Loading...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    `).show();

            tr.addClass('shown');
            loadChildTable(id);
        });
    });
    var loadChildTable = function(tour_id) {
        active_tour_id = tour_id;
        $.ajax({
            url: '{{route("escort.tour.location_listing")}}',
            type: "POST",
            dataType: "json",
            data: {
                tour_id
            },
            beforeSend: function() {

            },
        }).done(function(response) {
            console.log(response);
            if (response.success) {
                $(`#child-table-${tour_id} tbody`).html(response.html);
            }
        }).fail(function(xhr, status, error) {
            console.error("Error:", error);
        });
    }

    $("#tour_location_cancel").on('show.bs.modal', function(event) {
        let button = $(event.relatedTarget);
        cancel_on = button.data('item-type');
        let actionUrl = cancel_on == 'tour' ? "{{route('escort.tour.cancel')}}" : "{{route('escort.tour.cancel_tour_location')}}";
        $(this).find('input[name="item_id"]').val(button.data('item-id'));
        $(this).find('#cancelTourForm').attr('action', actionUrl);


    });

    $("#cancelTourForm").on('submit', function(e) {
        e.preventDefault();
        let form = $(this);
        let url = form.attr('action');
        $.ajax({
            url: url,
            method: form.attr('method'),
            data: form.serialize(),
            success: function(response) {
                $("#tour_location_cancel").modal('hide');
                $("#cancel_tour_confirm").modal('show');
                cancel_on == 'tour' ? table.draw() : loadChildTable(active_tour_id);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });

    });

    $("#tour_summary").on('show.bs.modal', function(event) {
        let modal = $(this);
        let button = $(event.relatedTarget);
        let tourId = button.data('item-id');
        $.ajax({
            url: '{{route("escort.dashboard.get-tour-summary-ajax")}}',
            method: 'post',
            dataType: 'json',
            data: {
                tourId
            },
            beforeSend: function() {

            },
            success: function(response) {
                modal.find('.modal-body').html(response.html);
                console.log(modalObj);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    });
</script>
@endsection