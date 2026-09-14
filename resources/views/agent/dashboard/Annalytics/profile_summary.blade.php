  <div class="modal fade upload-modal bd-example-modal-lg" id="profile_summary" tabindex="-1" role="dialog"
        aria-labelledby="profile_summaryLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profile_summary"><img
                            src="{{ asset('assets/dashboard/img/profile-summary.png') }}" class="custompopicon">Profile
                        Summary - {{  $listing->user?->member_id  }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive profile_summary">
                        <table  cellpadding="8" cellspacing="0" width="100%"
                            style="border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;" class="table-striped">

                            <thead>
                                <!-- Table Headings -->
                                <tr style="background-color: #0c223d; color: white; font-weight: bold; text-align:center">
                                    <td style="text-align:center;">Masseur ID</td>
                                    <td style="text-align:center;">Start Date</td>
                                    <td style="text-align:center;">Finish Date</td>
                                    <td style="text-align:center;">Days</td>
                                    <td style="text-align:center; width:110px">Listing Fee</td>
                                </tr>
                            </thead>

                            <tbody>
                                <!-- Main Row -->
                                <tr>
                                    <td style="text-align:center; font-weight:bold;"></td>
                                    <td style="text-align:center;">{{  date('d-m-Y',strtotime($listing['start_date'])) }}</td>
                                    <td style="text-align:center;">{{  date('d-m-Y',strtotime($listing['end_date'])) }}</td>
                                    <td style="text-align:center;">{{ $days }}</td>
                                    <td style="text-align:right;"><div class="num_value">$<span>{{  $listing['paid_rate']  }} </span></div></td>
                                </tr>



                                @if($masseures && count($masseures)>0)

                                    @php
                                        $totalAllDays = 0; 
                                    @endphp
                                
                                    @foreach($masseures as $masseure)
                                    @php
                                    $openDays = countOpenDays($listing['start_date'], $listing['end_date'], $masseure->masseur_availibility);
                                    $totalAllDays += $openDays; 
                                    @endphp
                                    <tr >
                                        <td style="text-align:center;">{{ isset($masseure->masseur->member_id) ? $masseure->masseur->member_id  : 'NA' }}</td>
                                        <td style="text-align:center;">{{  date('d-m-Y',strtotime($listing['start_date'])) }}</td>
                                        <td style="text-align:center;">{{  date('d-m-Y',strtotime($listing['end_date'])) }}</td>
                                        <td style="text-align:center;"> {{  countOpenDays($listing['start_date'], $listing['end_date'], $masseure->masseur_availibility) }}</td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                
                                @endif
                              
                               

                                

                                <!-- Footer -->
                                <tr style="font-weight:bold;">
                                    <td colspan="3" style="text-align:right;">Total days Masseurs:</td>
                                    <td style="text-align:center;">{{ $totalAllDays }}</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer justify-content-end mt-3">
                        
                        <button type="button" class="btn-cancel-modal"  onclick="printProfileSummary()">Print</button>
                        <button type="button" class="btn-success-modal" data-dismiss="modal" value="close"
                            id="close_change">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



<script>
function printProfileSummary() {
    var printContents = document.getElementById('profile_summary').querySelector('.modal-content').outerHTML;
    var originalTitle = document.title;
    document.title = "Profile_Summary_{{ $listing->user?->member_id }}";
    var existingFrame = document.getElementById('printFrame');
    if (existingFrame) {
        existingFrame.remove();
    }

    // Create hidden iframe
    var iframe = document.createElement('iframe');
    iframe.id = 'printFrame';
    iframe.style.position = 'fixed';
    iframe.style.right = '0';
    iframe.style.bottom = '0';
    iframe.style.width = '0';
    iframe.style.height = '0';
    iframe.style.border = '0';

    document.body.appendChild(iframe);

    var doc = iframe.contentWindow.document;

    doc.write('<html><head><title>Profile_Summary_{{ $listing->user?->member_id }}</title>');
    doc.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">');
    doc.write('<style>');
    doc.write(`
        @page { 
            margin: 0; 
        }
        body { 
            font-family: Arial, sans-serif; 
            background: #fff !important; 
            padding: 20px; 
        }
        img, .custompopicon, .modal-footer, .close { 
            display: none !important; 
        }
        table { 
            width: 100% !important; 
            border-collapse: collapse !important; 
        }
        thead tr, .modal-header { 
            background-color: #0c223d !important; 
            color: #ffffff !important; 
            -webkit-print-color-adjust: exact; 
            print-color-adjust: exact; 
        }
        thead td, thead th { 
            color: #ffffff !important; 
            font-weight: bold; 
        }
        .table-striped tbody tr:nth-of-type(odd) { 
            background-color: rgba(0,0,0,.05) !important; 
        }
        th, td { 
            padding: 8px !important; 
            border-bottom: 1px solid #dee2e6; 
        }
    `);
    doc.write('</style></head><body>');
    doc.write(printContents);
    doc.write('</body></html>');
    doc.close();

    setTimeout(function () {
        iframe.contentWindow.focus();
        iframe.contentWindow.print();
        document.title = originalTitle;
    }, 500);
}
</script>