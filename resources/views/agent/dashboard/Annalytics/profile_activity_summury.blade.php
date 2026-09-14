<div class="modal fade upload-modal bd-example-modal-lg" id="profile_activity_summury" tabindex="-1" role="dialog"
        aria-labelledby="activity_summaryLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="activity_summary"><img
                            src="{{ asset('assets/dashboard/img/profile-summary.png') }}" class="custompopicon">Activity
                        Summary - E60165 </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <table border="1" cellpadding="10" cellspacing="0" width="100%"
                        style="border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">


                        <!-- Table Headings -->
                        <tr style="background-color: #0c223d; color: white; font-weight: bold; text-align:center">
                            <td style="text-align:center;">Period</td>
                            <td style="text-align:center;">Profile Views</td>
                            <td style="text-align:center;">Media Views</td>
                            <td style="text-align:center;">Playbox Views</td>
                            <td style="text-align:center;">Legbox</td>
                        </tr>

                        <!-- Row 1 -->
                        <tr>
                            <td style="font-weight: bold; background:#0c223d; color:#fff;">This Week:
                            </td>
                            <td style="text-align:center;">{{ $views['this_week']['profile_views'] ?? 0 }}</td>
                            <td style="text-align:center;">{{ $views['this_week']['media_views'] ?? 0 }}</td>
                            <td style="text-align:center;">10</td>
                            <td style="text-align:center;">2</td>
                        </tr>

                        <!-- Row 2 -->
                        <tr>
                            <td style="font-weight: bold; background:#0c223d; color:#fff;">Year to Date:
                            </td>
                            <td style="text-align:center;">{{ $views['year_to_date']['profile_views'] ?? 0 }}</td>
                            <td style="text-align:center;">{{ $views['year_to_date']['media_views'] ?? 0 }}</td>
                            <td style="text-align:center;">201</td>
                            <td style="text-align:center;">42</td>
                        </tr>
                        <!-- Table Headings -->
                        <tr style="background-color: #0c223d; color: white; font-weight: bold; text-align:center">
                            <td style="border-bottom:0px"></td>
                            <td style="text-align:center;">Recommendations</td>
                            <td style="text-align:center;">Reviews</td>
                            <td style="text-align:center;">Reports</td>
                            <td style="text-align:center;">Social Media</td>
                        </tr>
                        <!-- Row 1 -->
                        <tr>
                            <td style="font-weight: bold;  background:#0c223d; color:#fff;">This Week:
                            </td>
                            <td style="text-align:center;">6</td>
                            <td style="text-align:center;">1</td>
                            <td style="text-align:center;">1</td>
                            <td style="text-align:center;">4</td>
                        </tr>

                        <!-- Row 2 -->
                        <tr>
                            <td style="font-weight: bold;  background:#0c223d; color:#fff;">Year to Date:
                            </td>
                            <td style="text-align:center;">84</td>
                            <td style="text-align:center;">6</td>
                            <td style="text-align:center;">12</td>
                            <td style="text-align:center;">125</td>
                        </tr>
                        <!-- Footer Row -->
                    </table>
                    <div class="modal-footer justify-content-end mt-3">
                       
                        <button type="button" class="btn-cancel-modal" id="save_change">Print</button>
                        <button type="button" class="btn-success-modal" data-dismiss="modal" value="close"
                            id="close_change">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>