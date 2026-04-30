@extends('layouts.admin')
@section('style')
    <style>
        form label {
            margin-bottom: 0px
        }
    </style>
@stop
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <div class="row">
            <div class="custom-heading-wrapper col-md-12">
                <h1 class="h1">Shareholders</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
            </div>
            <div class="col-md-12 mb-5 collapse" id="notes">
                <div class="card">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol class="level-1">
                            <li>Set up and manage Member shareholdings here.</li>
                            <li>A Shareholder must first be created in, and are managed from, <a
                                    href="{{ route('admin.manage-shareholders') }}"
                                    class="custom_links_design">Shareholders</a>. </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pb-3">

            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                <div class="bothsearch-form" style="gap: 10px;">
                    <button type="button" class="btn-common" data-toggle="modal" data-target="#addShareholder">Add New
                        Shareholding</button>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table mb-3 w-100" id="manage_shareholding_table">
                        <thead class="table-bg">
                            <tr>
                                <th>ID</th>
                                <th>Shareholder</th>
                                <th>Date of Entry</th>
                                <th>Type</th>
                                <th>Shares</th>
                                <th>Shareholding</th>
                                <th>Threshold</th>
                                <th>Beneficially Held</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-content">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

     <!--View Account shareholder popupform -->
    <div class="modal fade upload-modal" id="viewShareholderPopUpModel" tabindex="-1" role="dialog"
        aria-labelledby="viewShareholderLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewShareholderTitle"><img
                            src="{{ asset('assets/dashboard/img/add-member.png') }}" class="custompopicon">View Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-content" id="modalViewSShareholderContent"></div>
            </div>
        </div>
    </div>

    @include('admin.management.shareholders.add_shareholding')
   {{--  @include('admin.management.shareholders.modal.view_shareholding_modal')
    @include('admin.management.shareholders.modal.trust_deed_modal') --}}

     <div class="modal fade upload-modal" id="staffEditModal" tabindex="-1" role="dialog"
        aria-labelledby="editStaffnewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStaffnewTitle"><img
                            src="{{ asset('assets/dashboard/img/add-member.png') }}" class="custompopicon">Edit Shareholding
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                
                    <div class="modal-content" id="modalStaffEditContent"></div>
                
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
    <script>
        $(document).ready(function() {

            // Auto-fill shareholder name and member ID from dropdown
            $('#shareholder_id').on('change', function() {
                
                let selected = $(this).find(':selected');
                let name = selected.data('name') || '';
                let memberId = selected.data('memberid') || '';

                $('#name').val(name);
                $('#member_id').val(memberId);
            });

            // Show / Hide Trust Fields
            $('input[name="held_on_trust"]').on('change', function() {
                if ($(this).val() === 'Yes') {
                    $('.trust-fields').removeClass('d-none');
                    $('#trustee').prop('disabled', false);
                    $('#trust_deed').prop('disabled', false);
                } else {
                    $('.trust-fields').addClass('d-none');
                    $('#trustee').prop('disabled', true).val('');
                    $('#trust_deed').prop('disabled', true).val('');
                }
            });

            // Initialize hidden state on load
            if ($('input[name="held_on_trust"]:checked').val() === 'No') {
                $('.trust-fields').addClass('d-none');
                $('#trustee').prop('disabled', true);
                $('#trust_deed').prop('disabled', true);
            }

            var table = $("#manage_shareholding_table").DataTable({
                language: {
                    search: "Search: _INPUT_",
                    searchPlaceholder: "Search by ID",
                },
                processing: true,
                serverSide: true,
                lengthChange: true,
                searchable: false,
                bStateSave: false,

                ajax: {
                    url: "{{ route('admin.shareholding_list_data_table') }}",
                    data: function(d) {
                        d.type = 'player';
                    }
                },

                columns: [{
                        data: 'member_id',
                        name: 'member_id',
                        searchable: true,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'businessName',
                        name: 'businessName',
                        searchable: true,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'dateOfEntry',
                        name: 'dateOfEntry',
                        searchable: true,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'memberType',
                        name: 'memberType',
                        searchable: true,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'number_of_shares',
                        name: 'number_of_shares',
                        searchable: true,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'shareholding',
                        name: 'shareholding',
                        searchable: true,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'threshold',
                        name: 'threshold',
                        searchable: false,
                        orderable: false,
                        defaultContent: 0
                    },
                    {
                        data: 'held_on_trust',
                        name: 'held_on_trust',
                        searchable: false,
                        orderable: false,
                        defaultContent: 0
                    },

                    {
                        data: 'action',
                        name: 'edit',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA',
                        class: 'text-center'
                    },
                ],
                order: [
                    [1, 'desc']
                ],
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                pageLength: 10,
            });


            /*** View the shareholding */
            $(document).on('click', '#viewShareholderBtn', function() {
                let id = $(this).data('id');
                $('#staffEditModal').modal('hide');
                $.ajax({
                    url: BASE_URL + "/admin-dashboard/view-shareholding/" + id,
                    type: 'GET',
                    success: function(response) {
                        if ($.trim(response) === "") {
                            swal_error_popup("Shareholding data not found");
                        } else {
                            $('#modalViewSShareholderContent').html(response);
                            $('#viewShareholderPopUpModel').modal('show');
                        }
                    },
                    error: function() {
                        alert("Error loading form");
                    }
                });
            });

            /*** Edit the shareholing */
            $(document).on('click', '#getShareholder', function() {
                let id = $(this).data('id');
                $('#viewShareholderPopUpModel').modal('hide');
                $.ajax({
                    url: BASE_URL + "/admin-dashboard/get_shareholding/" + id,
                    type: 'GET',
                    success: function(response) {
                        if ($.trim(response) === "") {
                            swal_error_popup("Shareholding data not found");
                        } else {
                            $('#modalStaffEditContent').html(response);
                            $('#staffEditModal').modal('show');
                        }
                    },
                    error: function() {
                        alert("Error loading form");
                    }
                });
            });
        });
    </script>
@endpush
