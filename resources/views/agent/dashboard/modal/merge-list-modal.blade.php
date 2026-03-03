 <!-- Merged List Modal -->
    <div class="modal fade upload-modal" id="mergeList" tabindex="-1" role="dialog" aria-labelledby="mergeListlabel"
        aria-hidden="true" data-backdrop="static">

        <div class="modal-dialog modal-dialog-centered" style="max-width: 1200px" role="document">
            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/merge.png') }}" class="custompopicon">
                        <span class="text-white">
                            Merged Information Document ([post code range])
                        </span>
                    </h5>

                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>

                <!-- Body -->
                <div class="modal-body" style="max-height:500px; overflow-y:auto;">

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="table-bg">
                                <tr>
                                    <th colspan="6">Agent Details</th>
                                    <th colspan="2">Centre Details</th>
                                    <th rowspan="2">Date</th>
                                    <th rowspan="2">Actions</th>
                                </tr>
                                <tr>
                                    <th>Business Name</th>
                                    <th>Name</th>
                                    <th>Email Address</th>
                                    <th>Signature</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Business Name</th>
                                    <th>Address </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>ABC Marketing</td>
                                    <td>John Smith</td>
                                    <td>123 Main Street</td>
                                    <td>Signed</td>
                                    <td>0400000000</td>
                                    <td>john@example.com</td>
                                    <td>Relax Spa</td>
                                    <td>123 Main Street</td>
                                    <td>02-03-2026</td>
                                    <td>
                                        <div class="d-flex justify-content-between flex-column gap-10">
                                            <div class="dropdown d-inline-block mr-1">
                                            <button class="btn-success-modal btn-sm dropdown-toggle"
                                                    type="button" data-toggle="dropdown">
                                                Print
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#"><i class="fa fa-print"></i> Full Document</a>
                                                <a class="dropdown-item" href="#"><i class="fa fa-print"></i> Current Page</a>
                                                <a class="dropdown-item" href="#"><i class="fa fa-print"></i> Pages: 6000 to 6004</a>
                                            </div>
                                        </div>

                                        <div class="dropdown d-inline-block">
                                            <button class="btn-success-modal btn-sm dropdown-toggle"
                                                    type="button" data-toggle="dropdown">
                                                Save
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#"><i class="fa fa-save"></i> Full Document</a>
                                                <a class="dropdown-item" href="#"><i class="fa fa-save"></i> Current Page</a>
                                                <a class="dropdown-item" href="#"><i class="fa fa-save"></i> Pages: 6000 to 6004</a>
                                            </div>
                                        </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn-success-modal">Print</button>
                    <button type="button" class="btn-success-modal">Save</button>
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal">
                        Close
                    </button>
                </div>

            </div>
        </div>
    </div>