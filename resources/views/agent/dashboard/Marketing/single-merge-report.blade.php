@extends('layouts.agent')
@section('style')
    <style>
        .card-box{
            border: 1px solid #e3e6f0;
            border-radius: 8px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
            display: none
        }

        .btn-filter{
            padding: 7px 10px !important;
            background-color: #0c223d;
            color: #fff;
        }
        .btn-filter:hover{
            background-color: #ff3c5f;
            color: #fff;
        }
         .btn-reset{
            padding: 7px 10px !important;
            background: #ff3c5f !important;
            color: #fff !important;
        }
          .btn-reset i{
            color: #fff !important;
          }
            .btn-reset:hover{
            background-color: #ff3c5f !important;
            opacity: .9;
            
        }


  .clear-icon {
        display: inline-block;
    }

    .rotate-icon {
        animation: spinIcon 0.5s ease-in-out;
    }

    @keyframes spinIcon {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
    </style>
@endsection

@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">

        <div class="row">
            <div class="d-sm-flex align-items-center justify-content-between col-md-12">
                <div class="custom-heading-wrapper">
                    <h1 class="h1">Single Merge Reports</h1>                   
                </div>

            </div>
        </div>


       <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="top-controls d-flex flex-wrap justify-content-between align-items-center gap-10 py-4">

                       <!-- Left Side -->
                        <div>
                            <h5 class="mb-0 font-weight-bold">Single Reports</h5>
                        </div>

                        <!-- Right Side Controls -->
                        <div class="d-flex flex-wrap align-items-end gap-3">
                           
                            

                            <!-- Action Buttons -->
                            <div class="btn-group-custom d-flex justify-content-between gap-10 ml-3">
                                <button type="button" class="btn-filter" id="getSelectedBtn">Get Selected</button>
                                <button type="button" class="btn-reset" id="clearSelectionBtn"><i class="fas fa-redo clear-icon"></i></button>
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
                                    <td class="text-center"><input type="checkbox" class="record-checkbox" value="369"></td>
                                    <td>369</td>
                                    <td>Body Heat Massage</td>
                                    <td>62 Gordon Rd East Osborne Park</td>
                                    <td>6000</td>
                                    <td>0456 665 012</td>
                                    <td>9236 2587</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><input type="checkbox" class="record-checkbox" value="256"></td>
                                    <td>256</td>
                                    <td>Healthland</td>
                                    <td>510 Murray St Perth</td>
                                    <td>6000</td>
                                    <td>0426 610 881</td>
                                    <td>9325 2011</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><input type="checkbox" class="record-checkbox" value="147"></td>
                                    <td>147</td>
                                    <td>Esquire Spa and Massage</td>
                                    <td>11 Aberdeen St Perth</td>
                                    <td>6000</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-center"><input type="checkbox" class="record-checkbox" value="421"></td>
                                    <td>421</td>
                                    <td>Relax Wellness Spa</td>
                                    <td>22 King St Perth</td>
                                    <td>6001</td>
                                    <td>0412 111 222</td>
                                    <td>9222 4444</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><input type="checkbox" class="record-checkbox" value="587"></td>
                                    <td>587</td>
                                    <td>Lotus Thai Therapy</td>
                                    <td>88 William St Perth</td>
                                    <td>6002</td>
                                    <td>0433 999 444</td>
                                    <td>9333 1010</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><input type="checkbox" class="record-checkbox" value="601"></td>
                                    <td>601</td>
                                    <td>Golden Touch Spa</td>
                                    <td>14 Hay St Perth</td>
                                    <td>6003</td>
                                    <td>0411 222 333</td>
                                    <td>9211 4567</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><input type="checkbox" class="record-checkbox" value="602"></td>
                                    <td>602</td>
                                    <td>Urban Zen Massage</td>
                                    <td>45 Wellington St Perth</td>
                                    <td>6004</td>
                                    <td>0422 333 444</td>
                                    <td>9223 5678</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><input type="checkbox" class="record-checkbox" value="603"></td>
                                    <td>603</td>
                                    <td>Royal Thai Healing</td>
                                    <td>77 Roe St Northbridge</td>
                                    <td>6003</td>
                                    <td>0434 555 666</td>
                                    <td>9234 6789</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><input type="checkbox" class="record-checkbox" value="604"></td>
                                    <td>604</td>
                                    <td>Calm Essence Spa</td>
                                    <td>120 Newcastle St Perth</td>
                                    <td>6000</td>
                                    <td>0400 111 999</td>
                                    <td>9245 7890</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><input type="checkbox" class="record-checkbox" value="605"></td>
                                    <td>605</td>
                                    <td>Tranquil Bodyworks</td>
                                    <td>9 Murray St Perth</td>
                                    <td>6001</td>
                                    <td>0410 777 123</td>
                                    <td>9256 1234</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><input type="checkbox" class="record-checkbox" value="606"></td>
                                    <td>606</td>
                                    <td>Silk Route Therapy</td>
                                    <td>31 Beaufort St Perth</td>
                                    <td>6002</td>
                                    <td>0420 888 234</td>
                                    <td>9267 2345</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><input type="checkbox" class="record-checkbox" value="607"></td>
                                    <td>607</td>
                                    <td>Heavenly Hands Spa</td>
                                    <td>16 Barrack St Perth</td>
                                    <td>6000</td>
                                    <td>0430 999 345</td>
                                    <td>9278 3456</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><input type="checkbox" class="record-checkbox" value="608"></td>
                                    <td>608</td>
                                    <td>Perth Wellness Hub</td>
                                    <td>201 Adelaide Tce Perth</td>
                                    <td>6004</td>
                                    <td>0440 111 456</td>
                                    <td>9289 4567</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><input type="checkbox" class="record-checkbox" value="609"></td>
                                    <td>609</td>
                                    <td>Lotus Harmony Spa</td>
                                    <td>88 St Georges Tce Perth</td>
                                    <td>6000</td>
                                    <td>0450 222 567</td>
                                    <td>9290 5678</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><input type="checkbox" class="record-checkbox" value="610"></td>
                                    <td>610</td>
                                    <td>Inner Peace Massage</td>
                                    <td>43 Fitzgerald St Perth</td>
                                    <td>6003</td>
                                    <td>0460 333 678</td>
                                    <td>9301 6789</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><input type="checkbox" class="record-checkbox" value="611"></td>
                                    <td>611</td>
                                    <td>Ocean Breeze Therapy</td>
                                    <td>12 Lake St Perth</td>
                                    <td>6002</td>
                                    <td>0470 444 789</td>
                                    <td>9312 7890</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><input type="checkbox" class="record-checkbox" value="612"></td>
                                    <td>612</td>
                                    <td>Dream Thai Retreat</td>
                                    <td>55 James St Northbridge</td>
                                    <td>6003</td>
                                    <td>0480 555 890</td>
                                    <td>9323 8901</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><input type="checkbox" class="record-checkbox" value="613"></td>
                                    <td>613</td>
                                    <td>Wellness Point Spa</td>
                                    <td>102 Pier St Perth</td>
                                    <td>6000</td>
                                    <td>0490 666 901</td>
                                    <td>9334 9012</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><input type="checkbox" class="record-checkbox" value="614"></td>
                                    <td>614</td>
                                    <td>Natural Touch Therapy</td>
                                    <td>66 Charles St Perth</td>
                                    <td>6001</td>
                                    <td>0401 777 012</td>
                                    <td>9345 0123</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><input type="checkbox" class="record-checkbox" value="615"></td>
                                    <td>615</td>
                                    <td>Healing Vibes Studio</td>
                                    <td>25 Palmerston St Perth</td>
                                    <td>6004</td>
                                    <td>0412 888 123</td>
                                    <td>9356 1234</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Hidden field -->
                    <input type="hidden" id="selected_records" name="selected_records">

                    <div class="mt-4">
                        
                        <div id="selectedOutput">
                            <div class="d-flex justify-content-between align-items-center mb-3 gap-10">
                                <h5 class="mb-0 font-weight-bold">Filtered Data</h5>
                                <div class="d-flex justify-content-between align-items-center mb-3 gap-10">
                                    <button type="button" class="btn-success-modal">Save</button>
                                    <button type="button" class="btn-success-modal">Print</button>
                                    </div>
                                </div>
                            <table class="table table-bordered table-striped">
                                <thead class="table-bg">
                                    <tr>
                                        <th>ID</th>
                                        <th>Business Name</th>
                                        <th>Address</th>
                                        <th>Post Code</th>
                                        <th>Mobile Number</th>
                                        <th>Business Number</th>
                                    </tr>
                                </thead>
                                <tbody id="selectedTableBody">
                                    <tr>
                                        <td colspan="6" class="text-center">No records selected yet...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
            language: {
            search: "Search: _INPUT_",
            searchPlaceholder: "Search by Post Code"
        },
        info: true,
        paging: true,
        lengthChange: true,
        searching: true,
        bStateSave: true,
        order: [
            [1, 'desc']
        ],
       pageLength: 10,
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        });

        let selectionMode = 'single';

        // =========================
        // POST CODE RANGE FILTER
        // =========================
        $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
            // Sirf is table par apply ho
            if (settings.nTable.id !== 'dateRecordsTable') {
                return true;
            }

            let from = parseInt($('#postcodeFrom').val(), 10);
            let to = parseInt($('#postcodeTo').val(), 10);

            // Table column index for Post Code
            // 0 = checkbox
            // 1 = ID
            // 2 = Business Name
            // 3 = Address
            // 4 = Post Code
            let postCode = parseInt(data[4]) || 0;

            if (
                (isNaN(from) && isNaN(to)) ||
                (isNaN(from) && postCode <= to) ||
                (from <= postCode && isNaN(to)) ||
                (from <= postCode && postCode <= to)
            ) {
                return true;
            }

            return false;
        });

        

        // Clear Filter Button
        $('#clearPostcodeFilter').on('click', function () {
            $('#postcodeFrom').val('');
            $('#postcodeTo').val('');
            table.draw();
        });

        // Optional: auto filter while typing
        $('#postcodeFrom, #postcodeTo').on('keyup change', function () {
            table.draw();
        });

        // =========================
        // MODE CHANGE
        // =========================
        $('input[name="selectionMode"]').on('change', function () {
            selectionMode = $(this).val();

            // Clear all selections on mode switch
            $('.record-checkbox').prop('checked', false);
            $('#dateRecordsTable tbody tr').removeClass('table-success-custom');
            $('#selected_records').val('');
            resetSelectedTable();

            
        });

        // Trigger default mode setup
        $('input[name="selectionMode"]:checked').trigger('change');

        // =========================
        // ROW CHECKBOX CHANGE
        // =========================
        $(document).on('change', '.record-checkbox', function () {

            if (selectionMode === 'single') {
                $('.record-checkbox').not(this).prop('checked', false);
            }

            highlightSelectedRows();
            updateSelectedRecords();
        });


        // CLEAR SELECTION
       $('#clearSelectionBtn').on('click', function () {
    const $icon = $(this).find('.clear-icon');

    // icon animation trigger
    $icon.addClass('rotate-icon');

    // clear selections
    $('.record-checkbox').prop('checked', false);
    highlightSelectedRows();
    updateSelectedRecords();
    resetSelectedTable();

    // postcode range bhi clear karna ho to
    $('#postcodeRange').val('');
    table.draw();

    // animation reset
    setTimeout(() => {
        $icon.removeClass('rotate-icon');
    }, 500);
});

        // =========================
        // GET SELECTED DATA
        // =========================
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

            renderSelectedTable(selectedData);
            console.log("Selected Data:", selectedData);
        });

        // =========================
        // HIGHLIGHT SELECTED ROWS
        // =========================
        function highlightSelectedRows() {
            $('#dateRecordsTable tbody tr').removeClass('table-success-custom');

            $('.record-checkbox:checked').each(function () {
                $(this).closest('tr').addClass('table-success-custom');
            });
        }

        // =========================
        // STORE SELECTED IDS
        // =========================
        function updateSelectedRecords() {
            let selectedIds = [];

            $('.record-checkbox:checked').each(function () {
                selectedIds.push($(this).val());
            });

            $('#selected_records').val(selectedIds.join(','));
            console.log("Selected IDs:", selectedIds);
        }

        // =========================
        // RENDER SELECTED DATA TABLE
        // =========================
        function renderSelectedTable(selectedData) {
            let html = '';

            selectedData.forEach(function (record) {
                html += `
                    <tr>
                        <td>${record.id}</td>
                        <td>${record.business_name}</td>
                        <td>${record.address}</td>
                        <td>${record.post_code}</td>
                        <td>${record.mobile_number}</td>
                        <td>${record.business_number}</td>
                    </tr>
                `;
            });

            $('#selectedTableBody').html(html);
            $('#selectedOutput').show();
        }

        // =========================
        // RESET SELECTED TABLE
        // =========================
        function resetSelectedTable() {
            $('#selectedTableBody').html(`
                <tr>
                    <td colspan="6" class="text-center">No records selected yet...</td>
                </tr>
            `);
            $('#selectedOutput').hide();
        }

    });
</script>

@endpush
