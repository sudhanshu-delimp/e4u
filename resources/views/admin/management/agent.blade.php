@extends('layouts.admin')
@section('style')
    <style>
        form label {
            margin-bottom: 0px;
        }

        .right-sign {
            border-left: 0 !important;
            margin-left: -2px;
        }

        .left-sign {
            border-right: 0 !important;
            margin-right: -2px !important;
        }

        .avertising-input {
            border-right: 0 !important;
        }

        .registration-input {
            border-left: 0 !important;
        }

        ;

        .view_agent_details .table td {
            padding: 10px .75rem !important;
        }

        .view_agent_details .table td,
        .view_agent_details .table th {
            padding: 10px .75rem !important;
        }

        /* ==============================
   Documents Upload
================================= */

.documents-upload-wrapper {
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    background: #fff;
    padding: 24px;
}

.documents-upload-header h6 {
    font-size: 18px;
    font-weight: 600;
    color: #102a43;
}

.document-upload-card {
    height: 100%;
    padding: 20px;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    background: #fff;
    transition: all 0.2s ease;
}

.document-upload-card:hover {
    border-color: #d9dee5;
    box-shadow: 0 4px 14px rgba(16, 42, 67, 0.06);
}


/* Header */

.document-card-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 18px;
}

.document-icon {
    width: 42px;
    height: 42px;
    min-width: 42px;
    border-radius: 10px;
    background: #fff0f3;
    color: #ff3c5f;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 18px;
}

.document-card-header h6 {
    color: #102a43;
    font-size: 15px;
    font-weight: 600;
}

.document-card-header p {
    color: #7b8794;
    font-size: 12px;
}


/* Upload Area */

.document-upload-area {
    position: relative;

    min-height: 145px;
    width: 100%;

    border: 2px dashed #d8dee7;
    border-radius: 10px;
    background: #fafbfc;

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    cursor: pointer;

    transition: all 0.2s ease;
}

.document-upload-area:hover {
    border-color: #ff3c5f;
    background: #fff8fa;
}

.upload-icon {
    width: 42px;
    height: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #ff3c5f;
    font-size: 28px;

    margin-bottom: 8px;
}

.upload-title {
    color: #102a43;
    font-size: 14px;
    font-weight: 600;
}

.upload-subtitle {
    margin-top: 4px;
    color: #8795a1;
    font-size: 11px;
}


/* Hide native file input but keep functionality */

.document-file-input {
    position: absolute;
    inset: 0;

    width: 100%;
    height: 100%;

    opacity: 0;
    cursor: pointer;
}


/* Existing File */

.existing-file {
    padding: 10px 12px;

    border: 1px solid #edf0f3;
    border-radius: 8px;

    background: #f8fafc;
}


/* Signature */

.signature-existing {
    margin-top: 14px;
}

.signature-existing-label {
    margin-bottom: 7px;

    color: #6b7280;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
}

.signature-image-box {
    min-height: 90px;

    padding: 10px;

    border: 1px solid #edf0f3;
    border-radius: 8px;

    background: #fafbfc;

    display: flex;
    align-items: center;
    justify-content: flex-start;
}

.signature-image-box img {
    max-width: 200px;
    max-height: 80px;

    object-fit: contain;
}


/* Mobile */

@media (max-width: 767px) {

    .documents-upload-wrapper {
        padding: 16px;
    }

    .document-upload-card {
        padding: 16px;
    }

}
    </style>
@stop
@section('content')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            @php
                $securityLevel = isset(auth()->user()->staff_detail->security_level)
                    ? auth()->user()->staff_detail->security_level
                    : 0;
                $addAccess = staffPageAccessPermission($securityLevel, 'add');
                $addAccessEnabled = isset($addAccess['yesNo']) && $addAccess['yesNo'] == 'yes';

                $editAccess = staffPageAccessPermission($securityLevel, 'edit');
                $editAccessEnabled = isset($editAccess['yesNo']) && $editAccess['yesNo'] == 'yes';
            @endphp
            <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
                <!--middle content-->
                <div class="row">
                    <div class="custom-heading-wrapper col-md-12">
                        <h1 class="h1">Manage Agents</h1>
                        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                            style="font-size:16px"><b>Help?</b> </span>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="card collapse" id="notes">
                            <div class="card-body">
                                <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                <ol>
                                    <li>Create and manage Agents here.</li>
                                    <li>Manage status of Agents.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row pb-3">
                            @if ($addAccessEnabled)
                                <div class="col-md-12 col-sm-12">
                                    <div class="bothsearch-form" style="gap: 10px;">
                                        <button type="button" class="create-tour-sec dctour add-agent-btn"
                                            data-toggle="modal">Add New Agent</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="table-responsive-xl">
                            <table class="table mb-3 w-100" id="agent_data_table">
                                <thead class="table-bg">
                                    <tr>
                                        <th>Agent ID</th>
                                        <th>Agent</th>
                                        <th style="width: 7%">Territory</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th style="width: 4%">Clients</th>
                                        <th style="width: 180px">Last Login</th>
                                        <th>Status</th>
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
            <!--middle content end here-->
        </div>
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span> </span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>





    <div class="modal fade upload-modal" id="viewAgentdetails" tabindex="-1" role="dialog"
        aria-labelledby="Edit_CompetitorLabel" aria-hidden="true"></div>
    <div class="modal fade upload-modal" id="printAgentdetails" tabindex="-1" role="dialog"
        aria-labelledby="Edit_CompetitorLabel" aria-hidden="true"></div>
    <div class="modal fade upload-modal" id="addNewAgent" tabindex="-1" role="dialog"
        aria-labelledby="Edit_CompetitorLabel" aria-hidden="true"></div>
    <div id="print-container" style="display:none;"></div>
@includeif('admin.modal.change-password')
@endsection
@push('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
    <script>
        var adv_commissionfee = "{{ $commissionfee[0]['amount'] }}";
        var massg_commissionfee = "{{ $commissionfee[1]['amount'] }}";

        var commissionAdvertisingType = "{{ $commissionfee[0]['amount_type'] }}";
        var commissionRegistrationType = "{{ $commissionfee[1]['amount_type'] }}";
        $(document).ready(function(e) {
            var table = $("#agent_data_table").DataTable({
                language: {
                    search: "Search: _INPUT_",
                    searchPlaceholder: "Search by Agent ID",
                },

                processing: true,
                serverSide: true,
                lengthChange: true,
                searchable: false,
                bStateSave: false,

                ajax: {
                    url: "{{ route('admin.agent_list_data_table') }}",
                    data: function(d) {
                        d.type = 'player';
                    }
                },
                columns: [{
                        data: 'member_id',
                        name: 'member_id',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'business_name',
                        name: 'business_name',
                        searchable: true,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'territory',
                        name: 'territory',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'email',
                        name: 'email',
                        searchable: false,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'no_of_client',
                        name: 'no_of_client',
                        searchable: true,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'last_login',
                        name: 'last_login',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'status_text',
                        name: 'status_text',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA'
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

                order: [
                    [1, 'desc']
                ],
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                pageLength: 10,
            });




            ///////// Suspend Agent //////////////////////////////
            $(document).on('click', '.account-suspend-btn', async function(e) {
                if (await isConfirm({
                        'action': 'Suspend',
                        'text': ' Suspend This Account.'
                    })) {
                    ajaxRequest({
                        url: "{{ route('admin.suspend-agent') }}",
                        method: 'POST',
                        data: {
                            id: $(this).data('id'),
                            request_type: 'suspend'
                        },
                        success: function(response) {
                            console.log(response)
                            if (response.status) {
                                swal_success_popup(response.message);
                                table.ajax.reload(null, false);
                            } else {
                                swal_error_popup(response.message);
                            }
                        },
                        error: function(xhr) {
                            swal_error_popup('Error occured whiile making request');
                        }
                    });

                }
            })

            ///////// View Agent //////////////////////////////
            $(document).on('click', '.view-account-btn', function(e) {
                var requestId = $(this).data('id');
                var rowData = table.row($(this).parents('tr')).data();
                const safeData = JSON.stringify(rowData).replace(/'/g, "&apos;").replace(/"/g, "&quot;");

                console.log(rowData);

                let user_img = "{{ asset('assets/img/default_user.png') }}";
                let avatar_base = "{{ asset('avatars') }}/";
                if (rowData.avatar_img !== "" && rowData.avatar_img !== null)
                    user_img = avatar_base + rowData.avatar_img;


                var modal_html = `<div id="account-row-${requestId}" class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="confirmationPopup"> <img src="{{ asset('assets/dashboard/img/view-merchant.png') }}" style="width:40px; margin-right:10px;" alt="Request Accepted"> 
                                    View Account
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                                    </button>
                                 </div>
                                 <div class="modal-body pb-0 ">
                                       <div class="row">
                                          <div class="col-sm-12 view_agent_details">
                                                
                                                <!-- Avatar -->
                                                <div class="d-flex align-items-center mb-3">
                                                   <img src="${user_img}" alt="Avatar" class="rounded-circle mr-3" width="50" height="50">
                                                   <h6 class="mb-0">${(rowData.member_id ? rowData.member_id : 'NA')}</h6>
                                                </div>
                                       
                                                <!-- Details Table -->
                                                <table class="table table-bordered mb-3">
                                                   <tr><th style="width:40px;"><b>Business Name</b></th><td style="width:60px;">${(rowData.business_name) ? rowData.business_name : 'NA'}</td></tr>
                                                      <tr><th><b>ABN</b></th><td>${(rowData.abn) ? rowData.abn : 'NA'}</td></tr>
                                                       <tr><th><b>Business Address</b></th><td>${(rowData.business_address) ? rowData.business_address : 'NA'}</td></tr>
                                                    <tr><th><b>Business Number</b></th><td>${(rowData.business_number) ? rowData.business_number : 'NA'}</td></tr>
                                                     <tr><th><b>Contact Person</b></th><td>${(rowData.contact_person) ? rowData.contact_person : 'NA'}</td></tr>
                                                   <tr><th><b>Mobile</b></th><td>${(rowData.business_number) ? rowData.business_number : 'NA'}</td></tr>
                                                   <tr><th><b>Private Email</b></th><td>${(rowData.email) ? rowData.email : 'NA'}</td></tr>
                                                    <tr><th><b>E4U Email</b></th><td>${(rowData.email2) ? rowData.email2 : 'NA'}</td></tr>
                                                     <tr><th><b>Territory</b></th><td>${(rowData?.state.name) ? rowData.state.name : 'NA'}</td></tr>

                                                      <tr><th><b>Agreement Date</b></th><td>${(rowData.agent_detail?.agreement_date) ? rowData.agent_detail.agreement_date.split('-').reverse().join('-') : 'NA'}</td></tr>
                                                       <tr><th><b>Term</b></th><td>${(rowData.agent_detail?.term) ? rowData.agent_detail.term : 'NA'}</td></tr>
                                                        <tr><th><b>Commission Advertising</b></th><td>${(rowData.agent_detail?.commission_advertising_percent) ? rowData.agent_detail.commission_advertising_percent +'%': '0%'}</td></tr>
                                                         <tr><th><b>Commission Registration</b></th><td>${(rowData.agent_detail?.commission_registration_amount) ? '$'+rowData.agent_detail.commission_registration_amount : '$0'}</td></tr>
                                                </table>
                                       
                                                
                                                   
                                          </div>
                                       </div>
                                 </div>
                                 <div class="d-flex justify-content-end modal-footer">
                                                   <!-- Print Button -->

                                                    <button class="btn-success-modal d-block btn-print" data-agent='${safeData}'>
                                                         <i class="fa fa-print text-white"></i> Print
                                                   </button>

                                                
                                                   <button type="button" class="btn-cancel-modal ml-2" data-dismiss="modal" aria-label="Close">Close</button>
                                                </div>
                              </div>
                           </div>`;


                $('#printAgentdetails').html(modal_html);
                $('#printAgentdetails').modal('show');



            });

            ///////// Edit Agent //////////////////////////////
            $(document).on('click', '.edit-agent-btn', function(e) {
                var requestId = $(this).data('id');
                var rowData = table.row($(this).parents('tr')).data();
                const states = @json(config('escorts.profile.states'));
                const savedStateId = rowData.state_id;
                let viewerContactType = rowData.viewer_contact_type || [];




                let optionsHtml = '<option>Select Territory</option>';
                Object.entries(states).forEach(([key, state]) => {
                    const selected = (String(key) === String(savedStateId)) ? 'selected' : '';
                    optionsHtml += `<option value="${key}" ${selected}>${state.stateName}</option>`;
                });

                if (!viewerContactType) {
                    viewerContactType = [];
                } else if (typeof viewerContactType === "string") {
                    try {
                        viewerContactType = JSON.parse(viewerContactType);
                    } catch (e) {
                        viewerContactType = [];
                    }
                }

                const update_button = rowData.status === 'Pending' ?
                    '<button type="button" class="btn-success-modal mr-2 mt-3 approve_account" data-id=' +
                    rowData.id + '>Approve</button>' : '';

                const selectedValues = Array.isArray(viewerContactType) ? viewerContactType.map(String) :
            [];
                const agent_details = (rowData.agent_detail && Object.keys(rowData.agent_detail).length >
                    0) ? rowData.agent_detail : null;
                const agreement_file = agent_details?.agreement_file ?
                    `<a href="{{ asset('storage') }}/${agent_details.agreement_file}" target="_blank" title="Click here to download agreement file" id="downloadAgreement"> <svg width="24px" height="24px" viewBox="0 0 24 26" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M5.625 15C5.625 14.5858 5.28921 14.25 4.875 14.25C4.46079 14.25 4.125 14.5858 4.125 15H5.625ZM4.875 16H4.125H4.875ZM19.275 15C19.275 14.5858 18.9392 14.25 18.525 14.25C18.1108 14.25 17.775 14.5858 17.775 15H19.275ZM11.1086 15.5387C10.8539 15.8653 10.9121 16.3366 11.2387 16.5914C11.5653 16.8461 12.0366 16.7879 12.2914 16.4613L11.1086 15.5387ZM16.1914 11.4613C16.4461 11.1347 16.3879 10.6634 16.0613 10.4086C15.7347 10.1539 15.2634 10.2121 15.0086 10.5387L16.1914 11.4613ZM11.1086 16.4613C11.3634 16.7879 11.8347 16.8461 12.1613 16.5914C12.4879 16.3366 12.5461 15.8653 12.2914 15.5387L11.1086 16.4613ZM8.39138 10.5387C8.13662 10.2121 7.66533 10.1539 7.33873 10.4086C7.01212 10.6634 6.95387 11.1347 7.20862 11.4613L8.39138 10.5387ZM10.95 16C10.95 16.4142 11.2858 16.75 11.7 16.75C12.1142 16.75 12.45 16.4142 12.45 16H10.95ZM12.45 5C12.45 4.58579 12.1142 4.25 11.7 4.25C11.2858 4.25 10.95 4.58579 10.95 5H12.45ZM4.125 15V16H5.625V15H4.125ZM4.125 16C4.125 18.0531 5.75257 19.75 7.8 19.75V18.25C6.61657 18.25 5.625 17.2607 5.625 16H4.125ZM7.8 19.75H15.6V18.25H7.8V19.75ZM15.6 19.75C17.6474 19.75 19.275 18.0531 19.275 16H17.775C17.775 17.2607 16.7834 18.25 15.6 18.25V19.75ZM19.275 16V15H17.775V16H19.275ZM12.2914 16.4613L16.1914 11.4613L15.0086 10.5387L11.1086 15.5387L12.2914 16.4613ZM12.2914 15.5387L8.39138 10.5387L7.20862 11.4613L11.1086 16.4613L12.2914 15.5387ZM12.45 16V5H10.95V16H12.45Z" fill="#ff3c5f"></path> </g></svg> Download</a> 
                    
                    <a href="javascript:void(0)" style="margin-left:50px;" title="Click here to delete agreement file" class="deleteUploadedFile" data-id="${rowData.id}" data-type="agreement" id="deleteAgreement"> <svg width="22px" height="22px" viewBox="0 0 24 26" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 12V17" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M14 12V17" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M4 7H20" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M6 10V18C6 19.6569 7.34315 21 9 21H15C16.6569 21 18 19.6569 18 18V10" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg> Delete</a>` :
                    '';
                const signature_file = agent_details?.signature_file ?
                    `<a href="{{ asset('storage') }}/${agent_details.signature_file}" target="_blank" title="Click here to download agreement file" id="downloadSignature"> <svg width="24px" height="24px" viewBox="0 0 24 26" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M5.625 15C5.625 14.5858 5.28921 14.25 4.875 14.25C4.46079 14.25 4.125 14.5858 4.125 15H5.625ZM4.875 16H4.125H4.875ZM19.275 15C19.275 14.5858 18.9392 14.25 18.525 14.25C18.1108 14.25 17.775 14.5858 17.775 15H19.275ZM11.1086 15.5387C10.8539 15.8653 10.9121 16.3366 11.2387 16.5914C11.5653 16.8461 12.0366 16.7879 12.2914 16.4613L11.1086 15.5387ZM16.1914 11.4613C16.4461 11.1347 16.3879 10.6634 16.0613 10.4086C15.7347 10.1539 15.2634 10.2121 15.0086 10.5387L16.1914 11.4613ZM11.1086 16.4613C11.3634 16.7879 11.8347 16.8461 12.1613 16.5914C12.4879 16.3366 12.5461 15.8653 12.2914 15.5387L11.1086 16.4613ZM8.39138 10.5387C8.13662 10.2121 7.66533 10.1539 7.33873 10.4086C7.01212 10.6634 6.95387 11.1347 7.20862 11.4613L8.39138 10.5387ZM10.95 16C10.95 16.4142 11.2858 16.75 11.7 16.75C12.1142 16.75 12.45 16.4142 12.45 16H10.95ZM12.45 5C12.45 4.58579 12.1142 4.25 11.7 4.25C11.2858 4.25 10.95 4.58579 10.95 5H12.45ZM4.125 15V16H5.625V15H4.125ZM4.125 16C4.125 18.0531 5.75257 19.75 7.8 19.75V18.25C6.61657 18.25 5.625 17.2607 5.625 16H4.125ZM7.8 19.75H15.6V18.25H7.8V19.75ZM15.6 19.75C17.6474 19.75 19.275 18.0531 19.275 16H17.775C17.775 17.2607 16.7834 18.25 15.6 18.25V19.75ZM19.275 16V15H17.775V16H19.275ZM12.2914 16.4613L16.1914 11.4613L15.0086 10.5387L11.1086 15.5387L12.2914 16.4613ZM12.2914 15.5387L8.39138 10.5387L7.20862 11.4613L11.1086 16.4613L12.2914 15.5387ZM12.45 16V5H10.95V16H12.45Z" fill="#ff3c5f"></path> </g></svg> Download</a> 

                    <a href="javascript:void(0)" style="margin-left:50px;" title="Click here to delete signature file" class="deleteUploadedFile" data-id="${rowData.id}" data-type="signature" id="deleteSignature"> <svg width="22px" height="22px" viewBox="0 0 24 26" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 12V17" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M14 12V17" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M4 7H20" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M6 10V18C6 19.6569 7.34315 21 9 21H15C16.6569 21 18 19.6569 18 18V10" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg> Delete</a>` :
                    '';
                const signature_image = agent_details?.signature_file ?
                    "{{ asset('storage') }}/" + agent_details.signature_file : '';

                let viewer_contact_type_1 = false;
                let viewer_contact_type_2 = false;
                let viewer_contact_type_3 = false;

                if (Array.isArray(selectedValues) && selectedValues.length > 0) {
                    selectedValues.forEach(val => {
                        switch (val) {
                            case "1":
                                viewer_contact_type_1 = true;
                                break;
                            case "2":
                                viewer_contact_type_2 = true;
                                break;
                            case "3":
                                viewer_contact_type_3 = true;
                                break;
                        }
                    });
                }



                var modal_html = `
               <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                  <div class="modal-content basic-modal">

                     <!-- Modal Header -->
                     <div class="modal-header">
                           <h5 class="modal-title" id="edit_agent_data">
                              <img src="{{ asset('assets/dashboard/img/update-agent.png') }}" class="custompopicon">
                              Update Agent (${rowData.member_id})
                           </h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">
                                 <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                              </span>
                           </button>
                     </div>

                     <!-- Modal Body -->
                     <div class="modal-body">
                           <form name="update_agent" method="POST" action="{{ route('admin.update-agent') }}" enctype="multipart/form-data">
                              <div class="row">

                                 <!-- ==================== Personal Details ==================== -->
                                 <div class="col-12 my-2">
                                       <h6 class="border-bottom pb-1 text-blue-primary">Personal Details</h6>
                                 </div>

                                 <div class="col-6 mb-3">
                                       <label class="form-label" for="business_name">Business Name</label>
                                       <input type="text" class="form-control rounded-0"  name="business_name" id="business_name" value="${(rowData.business_name ? rowData.business_name : '')}">
                                       <span class="text-danger error-business_name"></span>
                                 </div>

                                 <div class="col-6 mb-3">
                                       <label class="form-label" for="abn">ABN</label>
                                       <input type="text" class="form-control rounded-0" maxlength="11"  name="abn" id="abn" value="${(rowData.abn ? removeAnythingExceptNumber(rowData.abn) : '')}">
                                       <span class="text-danger error-abn"></span>
                                 </div>

                                 <div class="col-6 mb-3">
                                       <label class="form-label" for="business_address">Business Address</label>
                                       <input type="text" class="form-control rounded-0"  name="business_address" id="business_address" value="${(rowData.business_address ? rowData.business_address : '')}">
                                       <span class="text-danger error-business_address"></span>
                                 </div>

                                 <div class="col-6 mb-3">
                                       <label class="form-label" for="business_number">Business Number</label>
                                       <input type="text" class="form-control rounded-0 formatMobile"  name="business_number" id="business_number" value="${(rowData.business_number ? removeAnythingExceptNumber(rowData.business_number) : '')}">
                                       <span class="text-danger error-business_number"></span>
                                 </div>

                                 <div class="col-6 mb-3">
                                       <label class="form-label" for="contact_person">Contact Person</label>
                                       <input type="text" class="form-control rounded-0" name="contact_person" id="contact_person" value="${(rowData.contact_person ? rowData.contact_person : '')}">
                                       <span class="text-danger error-contact_person"></span>
                                 </div>

                                 <div class="col-6 mb-3">
                                       <label class="form-label" for="phone">Mobile</label>
                                       <input type="text" class="form-control rounded-0"  name="phone" id="phone" value="${(rowData.phone ? removeAnythingExceptNumber(rowData.phone) : '')}">
                                       <span class="text-danger error-phone"></span>
                                 </div>

                                 <div class="col-6 mb-3">
                                       <label class="form-label" for="email">Private Email</label>
                                       <input type="email" class="form-control rounded-0"  name="email" id="email" value="${(rowData.email ? rowData.email : '')}">
                                       <span class="text-danger error-email"></span>
                                 </div>

                                 <div class="col-6 mb-3">
                                       <label class="form-label" for="email2">E4U Email</label>
                                       <input type="email" class="form-control rounded-0" placeholder="E4U Email" name="email2" id="email2" value="${(rowData.email2 ? rowData.email2 : '')}">
                                       <span class="text-danger error-email2"></span>
                                 </div>

                                 <div class="col-6 mb-3">
                                       <label class="form-label" for="state_id">Territory</label>
                                       <select class="form-control rounded-0" name="state_id" id="state_id">
                                          ${optionsHtml}
                                       </select>
                                 </div>

                                 <!-- Method of Contact -->
                                 <div class="col-12 mb-3 d-flex align-items-center justify-content-start gap-10 flex-wrap">
                                       <h6 class="mb-0 text-blue-primary">Method of Contact:</h6>
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" id="viewer_contact_type_1" name="viewer_contact_type[]" value="1" ${viewer_contact_type_1 ? 'checked' : ''}>
                                          <label class="form-check-label" for="viewer_contact_type_1">Text</label>
                                       </div>
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" id="viewer_contact_type_2" name="viewer_contact_type[]" value="2" ${viewer_contact_type_2 ? 'checked' : ''}>
                                          <label class="form-check-label" for="viewer_contact_type_2">Email</label>
                                       </div>
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" id="viewer_contact_type_3" name="viewer_contact_type[]" value="3" ${viewer_contact_type_3 ? 'checked' : ''}>
                                          <label class="form-check-label" for="viewer_contact_type_3">Call Me</label>
                                       </div>
                                 </div>

                                 <!-- ==================== Agreement Details ==================== -->
                                 <div class="col-12 my-2">
                                       <h6 class="border-bottom pb-1 text-blue-primary">Agreement Details</h6>
                                 </div>

                                 <div class="col-6 mb-3">
                                       <label class="form-label" for="agreement_date">Agreement Date</label>
                                       <input type="text" class="form-control rounded-0 js_datepicker" name="agreement_date" placeholder="DD-MM-YYYY" id="agreement_date" value="${agent_details?.agreement_date ? agent_details.agreement_date.split('-').reverse().join('-') : ''}">
                                       <span class="text-danger error-agreement_date"></span>
                                 </div>

                                 <div class="col-6 mb-3">
                                       <label class="form-label" for="term">Term</label>
                                       <input type="text" class="form-control rounded-0"  name="term" id="term" value="${agent_details?.term ?? ''}">
                                 </div>

                                 <div class="col-6 mb-3">
                                       <label class="form-label" for="option_peroid">Option Period</label>
                                       <input type="text" class="form-control rounded-0"  name="option_peroid" id="option_peroid" value="${agent_details?.option_peroid ?? ''}">
                                 </div>

                                 <div class="col-6 mb-3">
                                       <label class="form-label" for="option_exercised">Option Exercised</label>
                                       <input type="text" class="form-control rounded-0"  name="option_exercised" id="option_exercised" value="${agent_details?.option_exercised ?? ''}">
                                 </div>

                                 <!-- ==================== Commission ==================== -->
                                 <div class="col-12 my-2">
                                       <h6 class="border-bottom pb-1 text-blue-primary">Commission</h6>
                                 </div>

                                 <div class="col-6 mb-3">
                                    <label class="form-label" for="commission_advertising_percent">Advertising</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control avertising-input" name="commission_advertising_percent" id="commission_advertising_percent" value="${agent_details?.commission_advertising_percent ?? adv_commissionfee}" maxlength="5">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text form-control right-sign">%</div>
                                        </div>
                                         <input type="hidden" name="commission_advertising_type" value="percent"/>
                                    </div> 
                                     <span class="text-danger error-commission_advertising_percent"></span>
                                 </div>
                                 <div class="col-6 mb-3">
                                       <label class="form-label" for="commission_registration_amount">Massage Centre (Registration)</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                             <div class="input-group-text form-control left-sign" >$</div>
                                            </div>
                                            <input type="text" class="form-control rounded-0 registration-input" name="commission_registration_amount" id="commission_registration_amount" value="${agent_details?.commission_registration_amount ?? massg_commissionfee}" maxlength="5">
                                            <input type="hidden" name="commission_registration_type" value="fixed"/>
                                         </div>
                                       <span class="text-danger error-commission_registration_amount"></span>
                                 </div>
        

                                 <!-- ==================== File Uploads ==================== -->

                                <div class="col-12 mb-3">
                                    <div class="documents-upload-wrapper">

                                        <!-- Section Header -->
                                        <div class="documents-upload-header mb-4">
                                            <h6 class="mb-1 text-blue-primary">
                                                Documents & Files
                                            </h6>
                                            <p class="mb-0 text-muted small">
                                                Upload or manage your agreement and signature files.
                                            </p>
                                        </div>

                                        <div class="row">

                                            <!-- ==================== Agreement File ==================== -->
                                            <div class="col-md-6 mb-4">
                                                <div class="document-upload-card">

                                                    <div class="document-card-header">
                                                        <div>
                                                            <h6 class="mb-1">
                                                                Agreement File
                                                            </h6>
                                                        </div>
                                                    </div>

                                                    <!-- Upload Area -->
                                                    <label
                                                        for="agreement_file"
                                                        class="document-upload-area"
                                                    >
                                                        <div class="upload-icon">
                                                              <svg width="25px" height="25px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">

                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>

                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path stroke="#ff3c5f" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v9m0-9l3 3m-3-3l-3 3m8.5 2c1.519 0 2.5-1.231 2.5-2.75 0-1.264-.854-2.33-2.016-2.65A5 5 0 008.37 8.108a3.5 3.5 0 00-1.87 6.746">
                                                                    </path>
                                                                </g>

                                                            </svg>
                                                        </div>

                                                        <span class="upload-title">
                                                            Choose Agreement File
                                                        </span>

                                                        <span class="upload-subtitle">
                                                            PDF, DOC, DOCX up to 10MB
                                                        </span>

                                                        <input
                                                            type="file"
                                                            name="agreement_file"
                                                            id="agreement_file"
                                                            class="document-file-input"
                                                        >
                                                        
                                                    </label>
                                                    <span class="text-danger error-agreement_file"></span>
                                                    
                                                    <!-- Existing Agreement / Preview -->
                                                    <div id="file_preview" class="mt-3"></div>

                                                    ${agreement_file ? `
                                                        <div class="existing-file mt-3" id="downloadAgreement">
                                                            ${agreement_file}
                                                        </div>
                                                    ` : ''}

                                                </div>
                                            </div>


                                            <!-- ==================== Signature File ==================== -->
                                            <div class="col-md-6 mb-4">
                                                <div class="document-upload-card">

                                                    <div class="document-card-header">
                                                      
                                                        <div>
                                                            <h6 class="mb-1">
                                                                Signature File
                                                            </h6>
                                                        </div>
                                                    </div>

                                                    <!-- Upload Area -->
                                                    <label
                                                        for="signature_file"
                                                        class="document-upload-area"
                                                    >
                                                        <div class="upload-icon">
                                                            <svg width="25px" height="25px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">

                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>

                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path stroke="#ff3c5f" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v9m0-9l3 3m-3-3l-3 3m8.5 2c1.519 0 2.5-1.231 2.5-2.75 0-1.264-.854-2.33-2.016-2.65A5 5 0 008.37 8.108a3.5 3.5 0 00-1.87 6.746">
                                                                    </path>
                                                                </g>

                                                            </svg>
                                                        </div>

                                                        <span class="upload-title">
                                                            Choose Signature File
                                                        </span>

                                                        <span class="upload-subtitle">
                                                            PNG, JPG up to 5MB
                                                        </span>

                                                        <input
                                                            type="file"
                                                            name="signature_file"
                                                            id="signature_file"
                                                            accept="image/*"
                                                            class="document-file-input"
                                                        >
                                                      
                                                    </label>
                                                      <span class="text-danger error-signature_file"></span>
                                                    <!-- New Signature Preview -->
                                                    <div id="signature_preview" class="mt-3"></div>

                                                    <!-- Existing Signature Image -->
                                                    ${signature_image ? `
                                                        <div class="signature-existing mt-3"  id="signatureImage">
                                                           
                                                            <div class="signature-image-box">
                                                                <img
                                                                    src="${signature_image}"
                                                                    alt="Signature"
                                                                   
                                                                >
                                                            </div>
                                                            <!-- Existing Signature File -->
                                                            ${signature_file ? `
                                                                <div class="existing-file mt-3">
                                                                    ${signature_file}
                                                                </div>
                                                            ` : ''}
                                                        </div>
                                                    ` : ''}

                                                    

                                                    

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                              </div>

                              <!-- Modal Footer -->
                              <div class="modal-footer p-0 pl-2 pb-4">
                                 <input type="hidden" name="user_id" value="${(rowData.id ? rowData.id : '')}">
                                 ${update_button}
                                 <button type="submit" class="btn-success-modal mr-2 mt-3">Update</button>
                              </div>

                           </form>
                     </div>

                  </div>
               </div>`;

                $('#viewAgentdetails').html(modal_html);
                $('#viewAgentdetails').modal({
                    backdrop: 'static',
                    keyboard: false
                });

            });


            ///////// Update Agent //////////////////////////////
            $(document).on('submit', 'form[name="update_agent"]', function(e) {
                e.preventDefault();

                let form = $(this);
                let formData = new FormData(this);

                $('.error-email2').text('');
                $('.error-email').text('');

                swal_waiting_popup({
                    'title': 'Validating email..'
                });
                $.ajax({
                    url: "{{ route('admin.update-agent') }}",
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        table.ajax.reload(null, false);
                        Swal.close();
                        $('span.text-danger').text('');
                        $('#viewAgentdetails').modal('hide');
                        swal_success_popup(response.message);
                    },
                    error: function(xhr) {
                        Swal.close();
                        if (xhr.status === 422) {
                            $('span.text-danger').text('');
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                $('.error-' + field).text(messages[0]);
                            });
                        } else {
                            swal_error_popup(xhr.responseJSON.message ||
                                'Something went wrong');
                        }
                    }
                });

                //  $.ajax({
                //      url: "{{ route('admin.check-agent-email') }}",
                //      method: "POST",
                //      data: formData,
                //      contentType: false,
                //      processData: false,
                //      success: function(res) {
                //          if (res.status) {
                //              swal_waiting_popup({
                //                  'title': 'Updating agent details..'
                //              });

                //          }
                //      },
                //      error: function(xhr) {
                //          Swal.close();
                //          if (xhr.status === 422) {
                //              let errors = xhr.responseJSON.errors;
                //              if (errors.email) {
                //                  $('.error-email').text(errors.email[0]);
                //              }
                //              if (errors.email2) {
                //                  $('.error-email2').text(errors.email2[0]);
                //              }
                //          }
                //      }
                //  });
            });

            ///////// Approve Agent //////////////////////////////
            $(document).on('click', '.approve_account', function(e) {

                swal_waiting_popup({
                    'title': 'Approving Account'
                });
                $.ajax({
                    url: "{{ route('admin.approve-agent-account') }}",
                    method: 'POST',
                    data: {
                        'user_id': $(this).attr('data-id'),
                        'status': '1'
                    },
                    success: function(response) {
                        table.ajax.reload(null, false);
                        Swal.close();
                        $('#viewAgentdetails').modal('hide');
                        swal_success_popup(response.message);
                    },
                    error: function(xhr) {

                        Swal.close();
                        $('#viewAgentdetails').modal('hide');
                        swal_error_popup(xhr.responseJSON.message);
                    }
                });
            })

            //////// Activate Account ////////////////////////////
            $(document).on('click', '.active-account-btn', async function(e) {

                if (await isConfirm({
                        'action': 'Activate',
                        'text': ' Activate This Account.'
                    })) {
                    swal_waiting_popup({
                        'title': 'Activating Account'
                    });
                    $.ajax({
                        url: "{{ route('admin.active-agent-account') }}",
                        method: 'POST',
                        data: {
                            'user_id': $(this).attr('data-id'),
                            'status': '1'
                        },
                        success: function(response) {
                            table.ajax.reload(null, false);
                            Swal.close();
                            swal_success_popup(response.message);
                        },
                        error: function(xhr) {
                            Swal.close();
                            swal_error_popup(xhr.responseJSON.message);
                        }
                    });
                }
            })




            ///////// Add New Agent //////////////////////////////

            $(document).on('click', '.add-agent-btn', function(e) {
                const states = @json(config('escorts.profile.states'));
                let optionsHtml = '<option>Select Territory</option>';
                Object.entries(states).forEach(([key, state]) => {
                    optionsHtml += `<option value="${key}" >${state.stateName}</option>`;
                });

                var new_agent_modal = `
                     <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                        <div class="modal-content basic-modal">

                           <!-- Modal Header -->
                           <div class="modal-header">
                                 <h5 class="modal-title" id="edit_agent_data">
                                    <img src="{{ asset('assets/dashboard/img/update-agent.png') }}" class="custompopicon"> 
                                    New Agent Details
                                 </h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">
                                       <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                                    </span>
                                 </button>
                           </div>

                           <!-- Modal Body -->
                           <div class="modal-body">
                                 <form name="add_agent" method="POST" action="{{ route('admin.add-agent') }}" enctype="multipart/form-data">
                                    <div class="row">

                                       <!-- ==================== Personal Details ==================== -->
                                       <div class="col-12 my-2">
                                             <h6 class="border-bottom pb-1 text-blue-primary">Personal Details</h6>
                                       </div>

                                       <div class="col-6 mb-3">
                                             <label class="form-label" for="business_name">Business Name</label>
                                             <input type="text" class="form-control rounded-0"  name="business_name" id="business_name">
                                             <span class="text-danger error-business_name"></span>
                                       </div>

                                       <div class="col-6 mb-3">
                                             <label class="form-label" for="abn">ABN</label>
                                             <input type="text" class="form-control rounded-0" name="abn" id="abn" maxlength="11">
                                             <span class="text-danger error-abn"></span>
                                       </div>

                                       <div class="col-6 mb-3">
                                             <label class="form-label" for="business_address">Business Address</label>
                                             <input type="text" class="form-control rounded-0"  name="business_address" id="business_address">
                                       </div>

                                       <div class="col-6 mb-3">
                                             <label class="form-label" for="business_number">Business Number</label>
                                             <input type="text" class="form-control rounded-0"  name="business_number" id="business_number">
                                             <span class="text-danger error-business_number"></span>
                                       </div>

                                       <div class="col-6 mb-3">
                                             <label class="form-label" for="contact_person">Contact Person</label>
                                             <input type="text" class="form-control rounded-0"  name="contact_person" id="contact_person">
                                             <span class="text-danger error-contact_person"></span>
                                       </div>

                                       <div class="col-6 mb-3">
                                             <label class="form-label" for="phone">Mobile</label>
                                             <input type="text" class="form-control rounded-0 formatMobile"  name="phone" id="phone">
                                             <span class="text-danger error-phone"></span>
                                       </div>

                                       <div class="col-6 mb-3">
                                             <label class="form-label" for="email">Private Email</label>
                                             <input type="email" class="form-control rounded-0"  name="email" id="email">
                                             <span class="text-danger error-email"></span>
                                       </div>

                                       <div class="col-6 mb-3">
                                             <label class="form-label" for="email2">E4U Email</label>
                                             <input type="email" class="form-control rounded-0"  name="email2" id="email2">
                                             <span class="text-danger error-email2"></span>
                                       </div>

                                       <div class="col-6 mb-3">
                                             <label class="form-label" for="state_id">Territory</label>
                                             <select class="form-control rounded-0" name="state_id" id="state_id">
                                                ${optionsHtml}
                                             </select>
                                             <span class="text-danger error-state_id"></span>
                                       </div>

                                       <!-- Method of Contact -->
                                       <div class="col-12 mb-3 d-flex align-items-center justify-content-start gap-10 flex-wrap">
                                             <h6 class="mb-0 text-blue-primary">Method of Contact:</h6>
                                             <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="viewer_contact_type_1" name="viewer_contact_type[]" value="1">
                                                <label class="form-check-label" for="viewer_contact_type_1">Text</label>
                                             </div>
                                             <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="viewer_contact_type_2" name="viewer_contact_type[]" value="2">
                                                <label class="form-check-label" for="viewer_contact_type_2">Email</label>
                                             </div>
                                             <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="viewer_contact_type_3" name="viewer_contact_type[]" value="3">
                                                <label class="form-check-label" for="viewer_contact_type_3">Call Me</label>
                                             </div>
                                       </div>

                                       <!-- ==================== Agreement Details ==================== -->
                                       <div class="col-12 my-2">
                                             <h6 class="border-bottom pb-1 text-blue-primary">Agreement Details</h6>
                                       </div>

                                       <div class="col-6 mb-3">
                                             <label class="form-label" for="agreement_date">Agreement Date</label>
                                             <input type="text"  class="form-control rounded-0 js_datepicker" name="agreement_date" id="agreement_date" placeholder="DD-MM-YYYY">
                                             <span class="text-danger error-agreement_date"></span>
                                       </div>

                                       <div class="col-6 mb-3">
                                             <label class="form-label" for="term">Term</label>
                                             <input type="text" class="form-control rounded-0" name="term" id="term">
                                       </div>

                                       <div class="col-6 mb-3">
                                             <label class="form-label" for="option_peroid">Option Period</label>
                                             <input type="text" class="form-control rounded-0" name="option_peroid" id="option_peroid">
                                       </div>

                                       <div class="col-6 mb-3">
                                             <label class="form-label" for="option_exercised">Option Exercised</label>
                                             <input type="text" class="form-control rounded-0"  name="option_exercised" id="option_exercised">
                                       </div>

                                       <!-- ==================== Commission ==================== -->
                                       <div class="col-12 my-2">
                                             <h6 class="border-bottom pb-1 text-blue-primary">Commission</h6>
                                       </div>

                                       <div class="col-6 mb-3">
                                    <label class="form-label" for="commission_advertising_percent">Advertising</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control avertising-input" name="commission_advertising_percent" id="commission_advertising_percent" value="${adv_commissionfee}" maxlength="5">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text form-control right-sign">%</div>
                                        </div>
                                         <input type="hidden" name="commission_advertising_type" value="percent"/>
                                    </div> 
                                     <span class="text-danger error-commission_advertising_percent"></span>
                                 </div>
                                 <div class="col-6 mb-3">
                                       <label class="form-label" for="commission_registration_amount">Massage Centre (Registration)</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                             <div class="input-group-text form-control left-sign" >$</div>
                                            </div>
                                            <input type="text" class="form-control rounded-0 registration-input" name="commission_registration_amount" id="commission_registration_amount" value="${massg_commissionfee}" maxlength="5">
                                            <input type="hidden" name="commission_registration_type" value="fixed"/>
                                         </div>
                                       <span class="text-danger error-commission_registration_amount"></span>
                                 </div>

                                       <!-- ==================== File Uploads ==================== -->
                                       <div class="col-6 mb-3">
                                             <label class="form-label" for="agreement_file">Upload Agreement File</label>
                                             <input type="file" name="agreement_file" id="agreement_file">
                                             <div id="file_preview" class="mt-2"></div>
                                              <span class="text-danger error-agreement_file"></span>
                                       </div>

                                       <div class="col-6 mb-3">
                                             <label class="form-label" for="signature_file">Upload Signature File</label>
                                             <input type="file" name="signature_file" id="signature_file" accept="image/*">
                                             <div id="signature_preview" class="mt-2"></div>
                                             <span class="text-danger error-signature_file"></span>
                                       </div>

                                    </div>

                                    <!-- Modal Footer -->
                                    <div class="modal-footer p-0 pl-2 pb-4">
                                       <button type="submit" class="btn-success-modal mr-2 mt-3">Save</button>
                                    </div>

                                 </form>
                           </div>

                        </div>
                     </div>`;

                $('#addNewAgent').html(new_agent_modal);
                $('#addNewAgent').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });


            $(document).on('submit', 'form[name="add_agent"]', function(e) {
                e.preventDefault();
                let form = $(this);
                let formData = new FormData(this);
                $('span.text-danger').text('');

                swal_waiting_popup({
                    'title': 'Saving Agent Details'
                });
                //  return false

                $.ajax({
                    url: "{{ route('admin.add-agent') }}",
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        table.ajax.reload(null, false);
                        Swal.close();
                        $('span.text-danger').text('');
                        $('#addNewAgent').modal('hide');
                        swal_success_popup(response.message);
                    },
                    error: function(xhr) {
                        Swal.close();
                        if (xhr.status === 422) {
                            $('span.text-danger').text('');
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                $('.error-' + field).text(messages[0]);
                            });
                        } else {
                            swal_error_popup(xhr.responseJSON.message ||
                                'Something went wrong');
                        }
                    }
                });
            });


            // $(document).on('change', '#agreement_file', function(e) {
            //  const file = e.target.files[0];
            //  const preview = $('#file_preview');
            //  preview.html(''); 
            //  if (!file) return;
            //  const fileType = file.type;

            //  if (fileType.startsWith('image/')) {
            //      const reader = new FileReader();
            //      reader.onload = function(e) {
            //          preview.append('<img src="' + e.target.result + '" style="max-width:200px; max-height:200px;" />');
            //      };
            //      reader.readAsDataURL(file);
            //  } else if (fileType === 'application/pdf') {
            //      const fileURL = URL.createObjectURL(file);
            //      preview.append('<iframe src="' + fileURL + '" style="width:100%; height:400px;" frameborder="0"></iframe>');
            //  } else {
            //      preview.append('<p>File selected: ' + file.name + '</p>');
            //  }
            // });

            ////////// End Submit Form ////////////////////////

            /* Delete agreement or signature file */
        $(document).on('click', '.deleteUploadedFile', async function(e) {

           
            if (await isConfirm({
                    'action': 'Delete',
                    'text': ' Are you sure want to delete this file.'
                })) {
                swal_waiting_popup({
                    'title': 'Deleting the file'
                });
                var userId = $(this).attr('data-id');
                var type = $(this).attr('data-type');
                $.ajax({
                    url: "{{ route('admin.agent.delete.file') }}",
                    method: 'POST',
                    data: {
                        'userId': userId,
                        'type': type
                    },
                    success: function(response, textStatus, xhr) {
                        console.log("response:", response.message);
                        table.ajax.reload(null, false);
                        Swal.close();
                        if(response.status) {
                            displaySwal(xhr);
                            if(type == 'agreement') {
                                $("#deleteAgreement, #downloadAgreement").hide();
                            } else {
                                $("#downloadSignature, #deleteSignature, #signatureImage").hide();
                            }
                        } else {
                            displaySwal(xhr);  
                        }
                    },
                    error: function(xhr) {
                        Swal.close();
                        //swal_error_popup(xhr.responseJSON.message);
                         displaySwal(xhr);  
                    }
                });
            }
        })



        });


        $(document).on('click', '.btn-print', function() {
            var avatarsPath = "{{ asset('avatars') }}";
            var defaultUser = "{{ asset('assets/img/default_user.png') }}";
            var rowData = $(this).data('agent');
            let user_img = rowData.avatar_img ? avatarsPath + '/' + rowData.avatar_img : defaultUser;

            var printContent = `<style>*{font-family: Arial !important; font-size: 16px !important;color: #333 !important;}
                table{border:1px #cccccc solid;font-family:Arial !important;color: #333 !important;} table th{width:30%; padding: 10px .75rem;border:1px #cccccc solid; text-align:left;font-family:Arial;} 
                table td{width:70%; padding: 10px .75rem;border:1px #cccccc solid; white-space:nowrap;} h2{font-size: 22px;font-weight: 800px;font-family:Arial;} body {font-family: Arial !important;font-size: 81.25%;}
                </style>
        <div style="font-family:Arial !important; max-width:100%; overflow:hidden; box-sizing:border-box;">
         <h2>Agent Report</h2>
        <table style="border:none; border-collapse:collapse; width:auto; margin-bottom:5px;font-family:Arial;">
            <tr>
                <td style=" border:none;text-align:left; margin-left:0; padding-left:0;">
                    <img src="${user_img}" style="margin-left:0px;padding-left:0; margin-right:10px; max-height:50px; max-width:50px; object-fit:cover;">
                </td>
                <td style=" border:none;padding-left:0;">
                    <h4 style="padding-left:0;margin:0; font-size:16px;">${rowData.member_id || 'NA'}</h4>
                </td>
            </tr>
        </table>
         <table style="width:100%; border-collapse:collapse; table-layout:fixed; font-size:14px;font-family:Arial;" border="1">
        <tr>
            <th><b>Business Name</b></th>
            <td>${(rowData.business_name) ? rowData.business_name : 'NA'}</td>
        </tr>
            <tr>
               <th><b>ABN</b></th>
            <td>${(rowData.abn) ? rowData.abn : 'NA'}</td>
        </tr>
        <tr>
            <th><b>Business Address</b></th>
            <td>${(rowData.business_address) ? rowData.business_address : 'NA'}</td>
        </tr>
        <tr>
            <th><b>Business Number</b></th>
            <td>${(rowData.business_number) ? rowData.business_number : 'NA'}</td>
        </tr>
        <tr>
            <th><b>Contact Person</b></th>
            <td>${(rowData.contact_person) ? rowData.contact_person : 'NA'}</td>
        </tr>
        <tr>
            <th><b>Mobile</b></th>
            <td>${(rowData.business_number) ? rowData.business_number : 'NA'}</td>
        </tr>
        <tr>
            <th><b>Private Email</b></th>
            <td>${(rowData.email) ? rowData.email : 'NA'}</td></tr>
        <tr>
            <th><b>E4U Email</b></th>
            <td>${(rowData.email2) ? rowData.email2 : 'NA'}</td></tr>
        <tr>
            <th><b>Territory</b></th>
            <td>${(rowData?.state.name) ? rowData.state.name : 'NA'}</td>
        </tr>
        <tr>
            <th><b>Agreement Date</b></th>
            <td>${(rowData.agent_detail?.agreement_date) ? rowData.agent_detail.agreement_date.split('-').reverse().join('-') : 'NA'}</td>
        </tr>
        <tr>
           <th><b>Term</b><</th>
            <td>${(rowData.agent_detail?.term) ? rowData.agent_detail.term : 'NA'}</td>
        </tr>
        <tr>
            <th><b>Commission Advertising</b></th>
            <td>${(rowData.agent_detail?.commission_advertising_percent) ? rowData.agent_detail.commission_advertising_percent +'%': '0%'}</td>
        </tr>
        <tr>
            <th><b>Commission Registration</b></th>
            <td>${(rowData.agent_detail?.commission_registration_amount) ? '$'+rowData.agent_detail.commission_registration_amount : '$0'}</td>
        </tr>
        </table>
    </div>`;


            $.ajax({
                url: "{{ route('admin.generate-agent-info-pdf') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    html: printContent.trim()
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response) {
                    var blob = new Blob([response], {
                        type: 'application/pdf'
                    });
                    var blobUrl = URL.createObjectURL(blob);
                    window.open(blobUrl);
                },
                error: function(xhr, status, error) {
                    alert('PDF generation failed: ' + error);
                }
            });
        });



        $('#addNewAgent, #viewAgentdetails').on('shown.bs.modal', function() {
            $('.js_datepicker').datepicker({
                dateFormat: "dd-mm-yy",
                minDate: 0
            });
        });

        
    </script>
@endpush
