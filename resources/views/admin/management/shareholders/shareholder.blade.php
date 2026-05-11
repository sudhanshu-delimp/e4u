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
                    @if($shareholders->count() > 0)
                    <button type="button" class="btn-common" data-toggle="modal" data-target="#addShareholder">Add New
                        Shareholding</button>
                    @endif    
                </div>
            </div>

            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table mb-3 w-100" id="manage_shareholding_table">
                        <thead class="table-bg">
                            <tr>
                                <th>Member ID</th>
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
                $(".error-trust_deed_file").text("");
                if ($(this).val() === 'yes') {
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
            if ($('input[name="held_on_trust"]:checked').val() === 'no') {
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
                        data: 'numberOfShares',
                        name: 'numberOfShares',
                        searchable: true,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'sharePurchase',
                        name: 'sharePurchase',
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

            $(document).on('submit', 'form[name="add_shareholding"]', function(e) {
                e.preventDefault();
                let form = $(this);
                let formData = new FormData(this);
                $('span.text-danger').text('');

                swal_waiting_popup({
                    'title': 'Saving Shareholding Details'
                });
                //  return false

                $.ajax({
                    url: "{{ route('admin.add.shareholding') }}",
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        table.ajax.reload(null, false);
                        Swal.close();
                        $('span.text-danger').text('');
                        $('#addShareholder').modal('hide');
                        //$('#editShareholder').modal('hide');
                        $('#staffEditModal').modal('hide');
                        $('#add_shareholding')[0].reset();
                        swal_success_popup(response.message);
                    },
                    error: function(xhr) {

                        Swal.close();
            
                        if (xhr.status === 422) {
                            $('span.text-danger').text('');
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                if (field.includes('.')) {
                                    // 👉 ARRAY FIELD (key_contact_person.0)
                                    let parts = field.split('.');
                                    let name = parts[0] + '[]';
                                    let index = parts[1];
                                    let input = $('[name="' + name + '"]').eq(index);
                                    //input.addClass('is-invalid');
                                    input.next('.text-danger').text(messages[0]);
                                    $('.error-' + field.replace('.', '\\.')).text(messages[0]);

                                } else {
                                    $('.error-' + field).text(messages[0]);
                                }
                            });
                        } else {
                            swal_error_popup(xhr.responseJSON.message ||
                                'Something went wrong');
                        }
                    }
                });
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
                            initJsDatePickerEdit();
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
