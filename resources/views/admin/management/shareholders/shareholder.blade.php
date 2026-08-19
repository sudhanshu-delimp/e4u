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
            <div class="col-md-12 mb-5">
                <div class="card  collapse" id="notes">
                    <div class="card-body ">
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
                    <table class="table mb-3 w-100" id="manage_shareholder_table">
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
                        <tbody>
                            <tr>
                                <td>B60123</td>
                                <td>Waykar Pty Ltd </td>
                                <td>06-04-2023</td>
                                <td>Ordinary</td>
                                <td>27,500</td>
                                <td>55%</td>
                                <td>Yes</td>
                                <td>Yes</td>
                                <td>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="custom-tooltip-container"><a
                                                    class="dropdown-item align-item-custom toggle-massage-notification"
                                                    href="#" title="Click to disable notification">
                                                </a>
                                                <a class="dropdown-item align-item-custom" href="#"
                                                    onclick="window.print()">
                                                    <i class="fa fa-print" aria-hidden="true"></i>
                                                    Print</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item align-item-custom" href="#"
                                                    data-toggle="modal" data-target="#viewShareholding"> <i
                                                        class="fa fa-eye" aria-hidden="true"></i>
                                                    View Account</a>
                                            </div>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>B60258</td>
                                <td>Andrew Stephen </td>
                                <td>06-04-2023</td>
                                <td>Ordinary</td>
                                <td>500</td>
                                <td>0.1%</td>
                                <td>No</td>
                                <td>Yes</td>
                                <td>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="custom-tooltip-container"><a
                                                    class="dropdown-item align-item-custom toggle-massage-notification"
                                                    href="#" title="Click to disable notification">
                                                </a>
                                                <a class="dropdown-item align-item-custom" href="#"
                                                    onclick="window.print()"> <i class="fa fa-print" aria-hidden="true"></i>
                                                    Print</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item align-item-custom" href="#"
                                                    data-toggle="modal" data-target="#viewShareholding"> <i
                                                        class="fa fa-eye" aria-hidden="true"></i>
                                                    View Account</a>
                                            </div>
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
    @include('admin.management.shareholders.modal.add_shareholding_modal')
    @include('admin.management.shareholders.modal.view_shareholding_modal')
    @include('admin.management.shareholders.modal.trust_deed_modal')


@endsection
@push('script')
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
        });

        var table = $("#manage_shareholder_table").DataTable({
            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by ID"
            },
            info: true,
            paging: true,
            lengthChange: true,
            searching: true,
            bStateSave: true,
            order: [
                [1, 'desc']
            ],
            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            pageLength: 10,

            columns: [{
                    data: 'id',
                    name: 'id',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'shareholder',
                    name: 'shareholder',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'date',
                    name: 'date',
                    searchable: true,
                    orderable: false,
                    defaultContent: 'NA'
                },
                {
                    data: 'type',
                    name: 'type',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'share',
                    name: 'share',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'shareholding',
                    name: 'shareholding',
                    searchable: false,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'threshold',
                    name: 'threshold',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'beneficially',
                    name: 'beneficially',
                    searchable: false,
                    orderable: false,
                    defaultContent: 'NA',
                    class: 'text-center'
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false,
                    orderable: false,
                    defaultContent: 'NA',
                    class: 'text-center'
                },
            ],
        });
    </script>
@endpush
