  {{-- Modal: View database Centre --}}
    <div class="modal fade upload-modal" id="discount_history" tabindex="-1" aria-labelledby="discount_historyLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/history.png') }}" class="custompopicon"
                            alt="View Centre">
                      Discount History
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered" id="discountHistoryTable">
                        
                        <thead class="table-bg">
                            <tr>
                                <th>Granted</th>
                                <th>Days</th>
                                <th>Rate</th>
                                <th>Spend</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>01-01-2026</td>
                                <td>60</td>
                                <td>5%</td>
                                <td><div class="num_value">$<span>266.00</span></div></td>
                            </tr>
                             <tr>
                                <td>01-10-2025</td>
                                <td>30</td>
                                <td>10%</td>
                                <td><div class="num_value">$<span>216.00</span></div></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
               
            </div>
        </div>
    </div>
    {{-- end --}}
    @push('script')
    <script>
        let advertiserID = 0;
        let historyTable
        $('#discount_history').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let modal = $(this);
        advertiserID = button.data('user_id');

        historyTable = $('#discountHistoryTable').DataTable({
        searching: false,
        lengthChange: false,
        serverSide: true,
        processing: true,
        ordering: false,         
        ajax: {
            url: "{{ route('advertiser.get_advertiser_history') }}",
            data: function (d) {
                d.advertiser_id = advertiserID;
            }
        },
        columns: [
               { data: 'discount_start_date', searchable: false, orderable:false,defaultContent: 'NA' },
               { data: 'days', searchable: false, orderable:false,defaultContent: 'NA' },
               { data: 'rate', searchable: false, orderable:false,defaultContent: 'NA' },
               { data: 'spend', searchable: false, orderable:false,defaultContent: 'NA' },
           ],
    });
        });

    $('#discount_history').on('hidden.bs.modal', function () {
        if (historyTable) {
            historyTable.clear().destroy();
            historyTable = null; // important
        }
    });
    </script>
    @endpush
    