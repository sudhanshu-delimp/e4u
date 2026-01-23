@extends('layouts.admin')
@section('style')
    <style type="text/css"></style>
<style>
@media print {
  body {
    margin: 20px;
  }
}
</style>

@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content-->
        <div class="row">
            <div class="d-sm-flex align-items-center justify-content-between col-md-12">
                <div class="custom-heading-wrapper">
                    <h1 class="h1">Communications</h1>
                    <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b>
                    </h6>
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>To view the Communication in full, click the View option from Action.</li>
                            <li>To print the Communication click the Print option from Action.</li>
                        </ol>

                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12 ">
                <div class="table-responsive">
                    <table class="table" id="communicationsReportTable">
                        <thead class="table-bg">
                            <tr>
                                <th>Ref</th>
                                <th>Date & Time</th>
                                <th>Recipient</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--middle content end here-->
        <!--right side bar start from here-->
    </div>
    <!--right side bar end-->
    </div>

    <div class="modal fade upload-modal" id="confirm-popup" tabindex="-1" role="dialog"
        aria-labelledby="confirmPopupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header border-0">
                    <input type="hidden" id="status_data_id">
                    <input type="hidden" id="status_data_value">
                    <h5 class="modal-title d-flex align-items-center" id="confirmPopupLabel">
                        <img src="{{ asset('assets/dashboard/img/question-mark.png') }}" alt="resolved"
                            class="custompopicon">
                        <span>Confirmation</span>
                    </h5>
                    <input type="hidden" id="status_data_id" name="status_data_id" value="">
                    <input type="hidden" id="status_data_value" name="status_data_value" value="">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>

                <div class="modal-body pb-0 teop-text text-center">
                    <h5 class="popu_heading_style mt-2">
                        Are you sure you want to perform this action.
                    </h5>

                </div>
                <div class="modal-footer justify-content-center border-0 pb-4">

                    <button type="button" class="btn-success-modal saveStatus" data-dismiss="modal"
                        aria-label="Close">Yes</button> <button type="button" class="btn-cancel-modal" data-dismiss="modal"
                        aria-label="Close">No</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade upload-modal bd-example-modal-lg" id="communicationReport" tabindex="-1" role="dialog"
        aria-labelledby="communicationReportLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal w-auto">
                <div class="modal-header">
                    <h5 class="modal-title" id="communicationReport"><img
                            src="{{ asset('assets/dashboard/img/post-office-report.png') }}" class="custompopicon">Post
                        Office Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body" id="append_email_template" style="max-height: 600px; overflow-y:auto;"></div>
                <div class="modal-footer mt-2">
                    {{-- <button class="btn-success-modal">Print</button> --}}
                    <button class="btn-success-modal" id="printEmail">
                        Print
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- end notes --}}

<iframe id="emailIframe"
        style="display:none;"></iframe>


    <div id="manage-route" data-scrf-token="{{ csrf_token() }}"
        data-success-image="{{ asset('assets/dashboard/img/unblock.png') }}"
        data-error-image="{{ asset('assets/dashboard/img/alert.png') }}"
        data-pdf-download="{{ route('admin.agent.pdf.download', ['id' => '__ID__']) }}"
        data-reports-communication-index="{{ route('admin.reports.communication.index') }}"
        data-reports-communication-show="{{ route('admin.reports.communication.show', ['id' => '__ID__']) }}" ">
@endsection


@push('script')
    <script>
        const mmRoot = $('#manage-route');
        endpoint = {
            csrf_token: mmRoot.data('scrf-token'),
            success_image: mmRoot.data('success-image'),
            error_image: mmRoot.data('error-image'),
            pdf_download: mmRoot.data('pdf-download'),
            reports_communication_index: mmRoot.data('reports-communication-index'),
            reports_communication_show: mmRoot.data('reports-communication-show'),
        }



        var table = $("#communicationsReportTable").DataTable({
            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Ref"
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: endpoint.reports_communication_index,
                type: 'GET'
            },
            columns: [{
                    data: 'ref',
                    name: 'ref',
                },
                {
                    data: 'to_email',
                    name: 'to_email',
                    searchable: false,
                    orderable: false,
                },
                {
                    data: 'subject',
                    name: 'subject',
                    searchable: false,
                    orderable: false,
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                },
            ],
            order: [],
            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            pageLength: 10
        });



        // Event delegation for dynamic action buttons
        $(document).on('click', '.js-view', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            $('#append_email_template').html('');
            $.ajax({
                url: endpoint.reports_communication_show.replace('__ID__', id),
                type: 'GET',
                success: function(response) {
                    if (response.success === true || response.status === true) {
                        const d = response.data || response;
                        $('#append_email_template').html(d.body);
                        $('#emailIframe').attr('srcdoc', d.body);
                        $('#communicationReport').modal('show');
                    } else {
                        $('#append_email_template').html('<div class="text-danger">Failed to load details.</div>');
                    }
                },
                error: function() {
                     $('#append_email_template').html('<div class="text-danger">Failed to load details.</div>');
                }
            });
        });


        $('#printEmail').on('click', function() {
            const iframe = document.getElementById('emailIframe');

            if (!iframe) return;

            iframe.contentWindow.focus();
            iframe.contentWindow.print();
        });
    </script>
@endpush
