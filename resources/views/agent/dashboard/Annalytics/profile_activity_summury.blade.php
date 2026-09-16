<div class="modal fade upload-modal bd-example-modal-lg" id="profile_activity_summury" tabindex="-1" role="dialog"
        aria-labelledby="activity_summaryLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="activity_summary"><img
                            src="{{ asset('assets/dashboard/img/profile-summary.png') }}" class="custompopicon">Activity
                        Summary -  {{ $views['member_id']}}</h5>
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
                                    <td style="font-weight: bold; background:#0c223d; color:#fff;">This Week:</td>
                                    <td style="text-align:center;">
                                        {{ isset($views['this_week']['profile_views']) ? $views['this_week']['profile_views'] : 0 }}
                                    </td>
                                    <td style="text-align:center;">
                                        {{ isset($views['this_week']['media_views']) ? $views['this_week']['media_views'] : 0 }}
                                    </td>
                                    <td style="text-align:center;">0</td>
                                    <td style="text-align:center;">{{ isset($views['this_week']['legbox_count']) ? $views['this_week']['legbox_count'] : 0 }}</td>
                                </tr>

                        <!-- Row 2 -->
                        <tr>
                            <td style="font-weight: bold; background:#0c223d; color:#fff;">Year to Date: 
                            </td>
                            <td style="text-align:center;">{{ isset($views['year_to_date']['profile_views']) ? $views['year_to_date']['profile_views'] : 0 }}</td>
                            <td style="text-align:center;">{{ isset($views['year_to_date']['media_views']) ? $views['year_to_date']['media_views'] : 0 }}</td>
                            <td style="text-align:center;">0</td>
                            <td style="text-align:center;">{{ isset($views['year_to_date']['legbox_count']) ? $views['year_to_date']['legbox_count'] : 0 }}</td>
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
                            <td style="text-align:center;">{{ isset($views['this_week']['review_count']) ? $views['this_week']['review_count'] : 0 }}</td>
                            <td style="text-align:center;">{{ isset($views['this_week']['report_count']) ? $views['this_week']['report_count'] : 0 }}</td>
                            <td style="text-align:center;">4</td>
                        </tr>

                        <!-- Row 2 -->
                        <tr>
                            <td style="font-weight: bold;  background:#0c223d; color:#fff;">Year to Date:
                            </td>
                            <td style="text-align:center;">84</td>
                            <td style="text-align:center;">{{ isset($views['year_to_date']['review_count']) ? $views['year_to_date']['review_count'] : 0 }}</td>
                            <td style="text-align:center;">{{ isset($views['year_to_date']['report_count']) ? $views['year_to_date']['report_count'] : 0 }}</td>
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

<style>
@media print {
   
    @page {
        size: A4 portrait;
        margin: 5mm;
    }

    html, body {
        background: #ffffff !important;
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        height: auto !important;
        overflow: visible !important;
    }

   
    body > * {
        display: none !important;
    }

   
    body > #profile_activity_summury,
    #profile_activity_summury,
    #profile_activity_summury * {
        display: block !important;
        visibility: visible !important;
    }

   
    #profile_activity_summury {
        position: absolute !important;
        left: 0 !important;
        top: 0 !important;
        width: 100vw !important;
        max-width: 100vw !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    #profile_activity_summury .modal-dialog,
    #profile_activity_summury .modal-content,
    #profile_activity_summury .modal-body {
        width: 100% !important;
        max-width: 100% !important;
        min-width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        border: none !important;
        box-shadow: none !important;
        border-radius: 0 !important;
    }

  
    #profile_activity_summury .modal-header {
        width: 100% !important;
        box-sizing: border-box !important;
        background-color: #0c223d !important;
        color: #ffffff !important;
        border-radius: 0 !important;
        padding: 12px 15px !important;
        margin: 0 !important;
        border: none !important;
        display: block !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    #profile_activity_summury .modal-title {
        color: #ffffff !important;
        font-size: 16px !important;
        display: block !important;
    }

   
    #profile_activity_summury .modal-title img,
    #profile_activity_summury .modal-title .custompopicon {
        display: none !important;
        visibility: hidden !important;
    }

    
    #profile_activity_summury table {
        display: table !important;
        width: 100% !important;
        min-width: 100% !important;
        margin: 0 !important;
        border-collapse: collapse !important;
        box-sizing: border-box !important;
        table-layout: auto !important; 
    }

    #profile_activity_summury tr {
        display: table-row !important;
        width: 100% !important;
    }

    #profile_activity_summury td {
        display: table-cell !important;
        padding: 10px 12px !important;
        box-sizing: border-box !important;
    }

   
    tr[style*="background-color: #0c223d"],
    td[style*="background:#0c223d"] {
        background-color: #0c223d !important;
        color: #ffffff !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    
    #profile_activity_summury .modal-header .close,
    #profile_activity_summury .modal-header button,
    #profile_activity_summury .modal-header img.img_resize_in_smscreen,
    .modal-footer, 
    #save_change,
    #close_change,
    .modal-backdrop {
        display: none !important;
        visibility: hidden !important;
    }
}
</style>

<script>
 $(document).on('click', '#save_change', function (e) {

    e.preventDefault();
    var modalHtml = $('#profile_activity_summury .modal-content').clone();
    modalHtml.find('.close, .modal-footer, .custompopicon, img').remove();
    var iframe = document.createElement('iframe');
    iframe.style.position = 'fixed';
    iframe.style.right = '0';
    iframe.style.bottom = '0';
    iframe.style.width = '0px';
    iframe.style.height = '0px';
    iframe.style.border = 'none';
    document.body.appendChild(iframe);
    var doc = iframe.contentWindow.document;

    doc.open();
    doc.write('<!DOCTYPE html><html><head><title>&nbsp;</title>');
    doc.write('<style>');
    doc.write('@page { size: A4 portrait; margin: 0 !important; }');
    doc.write('body { font-family: Arial, sans-serif; margin: 0 !important; padding: 20mm 15mm 15mm 15mm !important; width: 100% !important; background: #ffffff !important; box-sizing: border-box !important; }');
    doc.write('.modal-dialog, .modal-content, .modal-body { width: 100% !important; max-width: 100% !important; margin: 0 !important; padding: 0 !important; border: none !important; box-shadow: none !important; }');
    doc.write('.modal-header { background-color: #0c223d !important; color: #ffffff !important; padding: 12px 15px; width: 100% !important; box-sizing: border-box !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }');
    doc.write('.modal-title { font-size: 18px; font-weight: bold; margin: 0; color: #ffffff !important; }');
    doc.write('table { width: 100% !important; min-width: 100% !important; border-collapse: collapse !important; margin: 0 !important; table-layout: fixed !important; box-sizing: border-box !important; }');
    doc.write('td, th { border: 1px solid #0c223d; padding: 10px; text-align: center; }');
    doc.write('tr[style*="background-color: #0c223d"], td[style*="background:#0c223d"] { background-color: #0c223d !important; color: #ffffff !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }');
    doc.write('</style></head><body>');
    doc.write(modalHtml.html());
    doc.write('</body></html>');
    doc.close();
    
    setTimeout(function () {
        iframe.contentWindow.focus();
        iframe.contentWindow.print();
        setTimeout(function() {
            document.body.removeChild(iframe);
        }, 500);
    }, 300);
});
</script>