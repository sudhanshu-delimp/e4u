 {{-- single Modal --}}
    <div class="modal fade upload-modal bd-example-modal-lg" id="single_list" tabindex="-1" role="dialog"
        aria-labelledby="single_listLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="single_list"><img
                            src="{{ asset('assets/dashboard/img/profile-report.png') }}" class="custompopicon">Massage
                        Centre Report (Single)
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">

                   
                        <div class="table-responsive profile_summary">
                            <table cellpadding="8" cellspacing="0" width="100%"
                                style="border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">

                                <thead class="bg-first">
                                    <tr>
                                        <td>ID</td>
                                        <td>Business Name</td>
                                        <td>Address</td>
                                        <td>Post Code</td>
                                        <td>Mobile Number</td>
                                        <td>Business Number</td>
                                        <td>Select</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>369</td>
                                        <td>Body Heat Massage</td>
                                        <td>62 Gordon Rd East Osborne Park</td>
                                        <td>6000</td>
                                        <td>0456 665 012</td>
                                        <td>9236 2587</td>
                                        <td style="text-align: center;">
                                            <input type="checkbox" class="single-report-checkbox" value="369" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>256</td>
                                        <td>Healthland</td>
                                        <td>510 Murray St Perth</td>
                                        <td>6000</td>
                                        <td>0426 610 881</td>
                                        <td>9325 2011</td>
                                        <td style="text-align: center;">
                                            <input type="checkbox" class="single-report-checkbox" value="256" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>147</td>
                                        <td>Esquire Spa and Massage</td>
                                        <td>11 Aberdeen St Perth</td>
                                        <td>6000</td>
                                        <td></td>
                                        <td></td>
                                        <td style="text-align: center;">
                                            <input type="checkbox" class="single-report-checkbox" value="147" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    <div class="d-flex justify-content-end gap-10 mt-3">
                        <button type="button" class="btn-success-modal">Print</button>
                        <button type="button" class="btn-cancel-modal" data-dismiss="modal" value="close"
                            id="close_change">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}