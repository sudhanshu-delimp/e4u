@extends('layouts.agent')
@section('style')
    <style>
         .card-box {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.08);
        }

        .table-success-custom {
            background-color: #d1f7d6 !important;
        }

        .top-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
        }

        .selection-group {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .dataTables_wrapper .dataTables_filter input {
            margin-left: 8px;
        }

        .btn-group-custom {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        #selectedOutput {
            background: #f1f3f5;
            border-radius: 8px;
            padding: 15px;
            font-size: 14px;
            white-space: pre-wrap;
            min-height: 80px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">

        <div class="row">
            <div class="d-sm-flex align-items-center justify-content-between col-md-12">
                <div class="custom-heading-wrapper">
                    <h1 class="h1">Date Records</h1>
                   
                </div>

            </div>
        </div>


       <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                <div class="top-controls">
                    <div>
                        <h5 class="mb-0">Select single or multiple reports</h5>
                    </div>

                    <div class="selection-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="selectionMode" id="singleMode" value="single" checked>
                            <label class="form-check-label" for="singleMode">Single</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="selectionMode" id="multipleMode" value="multiple">
                            <label class="form-check-label" for="multipleMode">Multiple</label>
                        </div>

                        <div class="btn-group-custom">
                            <button type="button" class="btn-success-modal" id="selectAllBtn">Select All</button>
                            <button type="button" class="btn-cancel-modal" id="clearSelectionBtn">Clear</button>
                            <button type="button" class="btn-success-modal" id="getSelectedBtn">Get Selected</button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="dateRecordsTable" class="table align-middle w-100">
                        <thead class="table-bg">
                            <tr>
                                <th style="width: 60px;">Select</th>
                                <th>ID</th>
                                <th>Business Name</th>
                                <th>Address</th>
                                <th>Post Code</th>
                                <th>Mobile Number</th>
                                <th>Business Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" class="record-checkbox" value="369">
                                </td>
                                <td>369</td>
                                <td>Body Heat Massage</td>
                                <td>62 Gordon Rd East Osborne Park</td>
                                <td>6000</td>
                                <td>0456 665 012</td>
                                <td>9236 2587</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" class="record-checkbox" value="256">
                                </td>
                                <td>256</td>
                                <td>Healthland</td>
                                <td>510 Murray St Perth</td>
                                <td>6000</td>
                                <td>0426 610 881</td>
                                <td>9325 2011</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" class="record-checkbox" value="147">
                                </td>
                                <td>147</td>
                                <td>Esquire Spa and Massage</td>
                                <td>11 Aberdeen St Perth</td>
                                <td>6000</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" class="record-checkbox" value="421">
                                </td>
                                <td>421</td>
                                <td>Relax Wellness Spa</td>
                                <td>22 King St Perth</td>
                                <td>6001</td>
                                <td>0412 111 222</td>
                                <td>9222 4444</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" class="record-checkbox" value="587">
                                </td>
                                <td>587</td>
                                <td>Lotus Thai Therapy</td>
                                <td>88 William St Perth</td>
                                <td>6002</td>
                                <td>0433 999 444</td>
                                <td>9333 1010</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Hidden field -->
                <input type="hidden" id="selected_records" name="selected_records">

                <div class="mt-4">
                    <h5>Selected Data Output</h5>
                    <div id="selectedOutput">No records selected yet...</div>
                </div>
            </div>
            </div>
       </div>
            
    </div>
@endsection

@push('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
<script>
    $(document).ready(function () {

        // Initialize DataTable
        const table = $('#dateRecordsTable').DataTable({
            pageLength: 5,
            ordering: true,
            searching: true,
            responsive: true
        });

        let selectionMode = 'single';

        // Mode change
        $('input[name="selectionMode"]').on('change', function () {
            selectionMode = $(this).val();

            // Clear all selections on mode switch
            $('.record-checkbox').prop('checked', false);
            $('#dateRecordsTable tbody tr').removeClass('table-success-custom');
            $('#selected_records').val('');
            $('#selectedOutput').text('No records selected yet...');

            // Enable/disable Select All button
            if (selectionMode === 'single') {
                $('#selectAllBtn').prop('disabled', true);
            } else {
                $('#selectAllBtn').prop('disabled', false);
            }
        });

        // Trigger default mode setup
        $('input[name="selectionMode"]:checked').trigger('change');

        // Row checkbox change
        $(document).on('change', '.record-checkbox', function () {

            if (selectionMode === 'single') {
                $('.record-checkbox').not(this).prop('checked', false);
            }

            highlightSelectedRows();
            updateSelectedRecords();
        });

        // Select All
        $('#selectAllBtn').on('click', function () {
            if (selectionMode === 'multiple') {
                $('.record-checkbox').prop('checked', true);
                highlightSelectedRows();
                updateSelectedRecords();
            }
        });

        // Clear Selection
        $('#clearSelectionBtn').on('click', function () {
            $('.record-checkbox').prop('checked', false);
            highlightSelectedRows();
            updateSelectedRecords();
            $('#selectedOutput').text('No records selected yet...');
        });

        // Get Selected Data
        $('#getSelectedBtn').on('click', function () {
            let selectedData = [];

            $('.record-checkbox:checked').each(function () {
                let row = $(this).closest('tr');

                selectedData.push({
                    id: row.find('td:eq(1)').text().trim(),
                    business_name: row.find('td:eq(2)').text().trim(),
                    address: row.find('td:eq(3)').text().trim(),
                    post_code: row.find('td:eq(4)').text().trim(),
                    mobile_number: row.find('td:eq(5)').text().trim(),
                    business_number: row.find('td:eq(6)').text().trim()
                });
            });

            if (selectedData.length === 0) {
                alert('Please select at least one record.');
                return;
            }

            $('#selectedOutput').text(JSON.stringify(selectedData, null, 4));
            console.log("Selected Data:", selectedData);
        });

        // Highlight selected rows
        function highlightSelectedRows() {
            $('#dateRecordsTable tbody tr').removeClass('table-success-custom');

            $('.record-checkbox:checked').each(function () {
                $(this).closest('tr').addClass('table-success-custom');
            });
        }

        // Store selected IDs
        function updateSelectedRecords() {
            let selectedIds = [];

            $('.record-checkbox:checked').each(function () {
                selectedIds.push($(this).val());
            });

            $('#selected_records').val(selectedIds.join(','));
            console.log("Selected IDs:", selectedIds);
        }

    });
</script>

@endpush
