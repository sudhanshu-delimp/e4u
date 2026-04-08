const mmRoot = $('#manage-route');
const endpoint = {
    csrf_token: mmRoot.data('csrf-token'),
    success_image: mmRoot.data('success-image'),
    error_image: mmRoot.data('error-image'),
    postcodes_url: mmRoot.data('postcodes-url'),
    generate_url: mmRoot.data('generate-url'),
    recipients_url: mmRoot.data('recipients-url'),
    agent_state: mmRoot.data('agent-state'),
};


$(document).ready(function() {

    // ===================== DataTables =====================
    var previewTable = $("#previewTable").DataTable({
        language: {
            search: "Search: _INPUT_",
            searchPlaceholder: "Search by ID or Post Code"
        },
        processing: false,
        serverSide: false,
        paging: true,
        lengthChange: true,
        searching: true,
        bStateSave: true,
        ordering: false,
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],
        pageLength: 10,
        columns: [{
                data: 'id',
                name: 'id',
                searchable: true,
                orderable: true,
                defaultContent: 'NA'
            },
            {
                data: 'bussiness_name',
                name: 'bussiness_name',
                searchable: true,
                orderable: false,
                defaultContent: 'NA'
            },
            {
                data: 'address',
                name: 'address',
                searchable: true,
                orderable: false,
                defaultContent: 'NA'
            },
            {
                data: 'post_code',
                name: 'post_code',
                searchable: true,
                orderable: true,
                defaultContent: 'NA'
            },
            {
                data: 'mobile_number',
                name: 'mobile_number',
                searchable: false,
                orderable: false,
                defaultContent: 'NA'
            },
            {
                data: 'business_number',
                name: 'business_number',
                searchable: false,
                orderable: false,
                defaultContent: 'NA'
            },
        ],
    });

    var reportsTable = $("#reportsTable").DataTable({
        language: {
            search: "Search: _INPUT_",
            searchPlaceholder: "Search by ID or Post Code"
        },
        processing: false,
        serverSide: false,
        paging: true,
        lengthChange: true,
        searching: true,
        bStateSave: true,
        ordering: false,
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],
        pageLength: 10,
        columns: [{
                data: 'id',
                name: 'id',
                searchable: true,
                orderable: true,
                defaultContent: 'NA'
            },
            {
                data: 'date_generated',
                name: 'date_generated',
                searchable: true,
                orderable: false,
                defaultContent: 'NA'
            },
            {
                data: 'post_code',
                name: 'post_code',
                searchable: true,
                orderable: true,
                defaultContent: 'NA'
            },
            {
                data: 'listings',
                name: 'listings',
                searchable: true,
                orderable: true,
                defaultContent: 'NA'
            },
            {
                data: 'merged',
                name: 'merged',
                searchable: true,
                orderable: true,
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
    });

    // ===================== Postcode Type Toggle =====================
    $('input[name="postcodeType"]').change(function() {
        var val = $(this).val();
        $('#singlePostCodeField').toggleClass('d-none', val !== 'single');
        $('#multiplePostCodeFields').toggleClass('d-none', val !== 'multiple');
        $('#allPostCodeField').toggleClass('d-none', val !== 'all');
        // Clear previous inputs
        $('#singlePostCode').val('');
        $('#fromPostCode').val('');
        $('#toPostCode').val('');
        $('#postcodeDropdown').removeClass('show').empty();
        $('#fromPostcodeDropdown').removeClass('show').empty();
        $('#toPostcodeDropdown').removeClass('show').empty();
        $('#rangeFeedback').empty();
    });

    // ===================== Single Postcode Autocomplete =====================
    var searchTimeout = null;
    $('#singlePostCode').on('input', function() {
        var q = $(this).val().trim();
        var dropdown = $('#postcodeDropdown');

        if (searchTimeout) clearTimeout(searchTimeout);

        if (q.length < 2) {
            dropdown.removeClass('show').empty();
            return;
        }

        searchTimeout = setTimeout(function() {
            $.ajax({
                url: endpoint.postcodes_url,
                data: { q: q },
                success: function(res) {
                    dropdown.empty();
                    if (res.data && res.data.length > 0) {
                        res.data.forEach(function(item) {
                            dropdown.append(
                                '<a class="dropdown-item postcode-option" href="javascript:void(0)" data-value="' + item.post_code + '">' + item.post_code + '</a>'
                            );
                        });
                        dropdown.addClass('show');
                    } else {
                        dropdown.removeClass('show');
                    }
                },
                error: function() {
                    dropdown.removeClass('show');
                }
            });
        }, 300);
    });

    // Select from dropdown
    $(document).on('click', '.postcode-option', function() {
        var val = $(this).data('value');
        $('#singlePostCode').val(val);
        $('#postcodeDropdown').removeClass('show').empty();
    });

    // Close dropdown on blur (with delay for click)
    $('#singlePostCode').on('blur', function() {
        setTimeout(function() {
            $('#postcodeDropdown').removeClass('show');
        }, 200);
    });

    // ===================== Multiple Range Autocomplete =====================
    var fromTimeout = null;
    var toTimeout = null;

    function setupRangeAutocomplete(inputId, dropdownId, timeoutRef) {
        $('#' + inputId).on('input', function() {
            var q = $(this).val().trim();
            var dropdown = $('#' + dropdownId);

            if (timeoutRef === 'from') {
                if (fromTimeout) clearTimeout(fromTimeout);
            } else {
                if (toTimeout) clearTimeout(toTimeout);
            }

            if (q.length < 2) {
                dropdown.removeClass('show').empty();
                validateRange();
                return;
            }

            var timer = setTimeout(function() {
                $.ajax({
                    url: endpoint.postcodes_url,
                    data: { q: q },
                    success: function(res) {
                        dropdown.empty();
                        if (res.data && res.data.length > 0) {
                            res.data.forEach(function(item) {
                                dropdown.append(
                                    '<a class="dropdown-item range-postcode-option" href="javascript:void(0)" data-target="' + inputId + '" data-dropdown="' + dropdownId + '" data-value="' + item.post_code + '">' + item.post_code + '</a>'
                                );
                            });
                            dropdown.addClass('show');
                        } else {
                            dropdown.removeClass('show');
                        }
                    },
                    error: function() {
                        dropdown.removeClass('show');
                    }
                });
            }, 300);

            if (timeoutRef === 'from') fromTimeout = timer;
            else toTimeout = timer;

            validateRange();
        });

        $('#' + inputId).on('blur', function() {
            setTimeout(function() {
                $('#' + dropdownId).removeClass('show');
            }, 200);
            validateRange();
        });
    }

    setupRangeAutocomplete('fromPostCode', 'fromPostcodeDropdown', 'from');
    setupRangeAutocomplete('toPostCode', 'toPostcodeDropdown', 'to');

    // Select from range dropdowns
    $(document).on('click', '.range-postcode-option', function() {
        var val = $(this).data('value');
        var targetInput = $(this).data('target');
        var targetDropdown = $(this).data('dropdown');
        $('#' + targetInput).val(val);
        $('#' + targetDropdown).removeClass('show').empty();
        validateRange();
    });

    // ===================== Multiple Range Validation =====================

    function validateRange() {
        var from = $('#fromPostCode').val().trim();
        var to = $('#toPostCode').val().trim();
        var feedback = $('#rangeFeedback');

        if (!from || !to) {
            feedback.empty();
            return;
        }

        var fromNum = parseInt(from, 10);
        var toNum = parseInt(to, 10);

        if (isNaN(fromNum) || isNaN(toNum)) {
            feedback.html('<span class="range-error"><i class="fa fa-times-circle"></i> Please enter valid numeric postcodes.</span>');
            return;
        }

        if (toNum <= fromNum) {
            feedback.html('<span class="range-error"><i class="fa fa-times-circle"></i> "To" postcode must be greater than "From" postcode.</span>');
            return;
        }

        var steps = toNum - fromNum;
        feedback.html('<span class="range-success"><i class="fa fa-check-circle"></i> Range: ' + fromNum + ' to ' + toNum + ' &mdash; ' + steps + ' postcode steps</span>');
    }

    // ===================== Trial Run Toggle =====================
    $('input[name="trialRun"]').change(function() {
        var val = $('input[name="trialRun"]:checked').val();
        $('#showRecipients').prop('disabled', val !== 'on');
    });

    // ===================== Show Recipients (Trial Run) =====================
    $('#showRecipients').click(function() {
        var type = $('input[name="postcodeType"]:checked').val();
        var params = { type: type };

        if (type === 'single') {
            var pc = $('#singlePostCode').val().trim();
            if (!pc) { showAlert('error', 'Please enter a postcode.'); return; }
            params.post_code = pc;
        } else if (type === 'multiple') {
            var from = $('#fromPostCode').val().trim();
            var to = $('#toPostCode').val().trim();
            if (!from || !to) { showAlert('error', 'Please enter From and To postcodes.'); return; }
            if (parseInt(to) <= parseInt(from)) { showAlert('error', '"To" must be greater than "From".'); return; }
            params.from = from;
            params.to = to;
        }

        $.ajax({
            url: endpoint.recipients_url,
            data: params,
            beforeSend: function() {
                $('#showRecipients').prop('disabled', true).text('Loading...');
            },
            success: function(res) {
                if (res.data) {
                    previewTable.clear().rows.add(res.data).draw();
                    $('#previewCard').removeClass('d-none');
                }
            },
            error: function() {
                showAlert('error', 'Failed to load recipients.');
            },
            complete: function() {
                $('#showRecipients').prop('disabled', false).text('Show Recipients');
            }
        });
    });

    // ===================== Proceed (Generate) =====================
    $('#proceedBtn').click(function() {

        var type = $('input[name="postcodeType"]:checked').val();
        var trialRun = $('input[name="trialRun"]:checked').val();
        var params = { type: type };

        if (type === 'single') {
            var pc = $('#singlePostCode').val().trim();
            if (!pc) { showAlert('error', 'Please enter a postcode.'); return; }
            params.post_code = pc;
        } else if (type === 'multiple') {
            var from = $('#fromPostCode').val().trim();
            var to = $('#toPostCode').val().trim();
            if (!from || !to) { showAlert('error', 'Please enter From and To postcodes.'); return; }
            if (parseInt(to) <= parseInt(from)) { showAlert('error', '"To" must be greater than "From".'); return; }
            params.from = from;
            params.to = to;
        }

        $.ajax({
            url: endpoint.generate_url,
            data: params,
            beforeSend: function() {
                $('#proceedBtn').prop('disabled', true).text('Generating...');
            },
            success: function(res) {
                if (res.data) {
                    var postCodeLabel = type;
                    if (type === 'single') postCodeLabel = params.post_code;
                    else if (type === 'multiple') postCodeLabel = params.from + ' - ' + params.to;
                    else postCodeLabel = 'All (' + (endpoint.agent_state || 'State') + ')';

                    var now = new Date();
                    var dateStr = ('0' + now.getDate()).slice(-2) + '/' + ('0' + (now.getMonth() + 1)).slice(-2) + '/' + now.getFullYear();
                    var reportId = Math.floor(Math.random() * 9000) + 1000;

                    var reportRow = {
                        id: reportId,
                        date_generated: dateStr,
                        post_code: postCodeLabel,
                        listings: res.data.length,
                        merged: 'No',
                        action: '<div class="dropdown no-arrow">' +
                            '<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a>' +
                            '<div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in">' +
                            '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-target="#mergeType" data-toggle="modal"><i class="fa fa-bezier-curve"></i> Merge</a>' +
                            '<div class="dropdown-divider"></div>' +
                            '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" target="_blank"> <i class="fa fa-print"></i>'+
                                    'Print</a>' +
                                    '<div class="dropdown-divider"></div>' +
                            '<a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-target="#view_list" data-toggle="modal"><i class="fa fa-eye"></i> View</a>' +
                            '</div></div>'
                    };

                   reportsTable.row.add(reportRow).draw();

                    if (trialRun === 'on') {
                        previewTable.clear().rows.add(res.data).draw();
                        $('#previewCard').removeClass('d-none');
                    }

                    showAlert('success', 'List generated successfully! ' + res.data.length + ' listings found.');
                }
            },
            error: function() {
                showAlert('error', 'Failed to generate list.');
            },
            complete: function() {
                $('#proceedBtn').prop('disabled', false).text('Proceed');
            }
        });
    });

    // ===================== Close Preview =====================
    $('#closePreview').click(function() {
        $('#previewCard').addClass('d-none');
    });

    // ===================== Alert Helper =====================
    function showAlert(type, message) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({ icon: type, title: message, timer: 2500, showConfirmButton: false });
        } else {
            alert(message);
        }
    }

});