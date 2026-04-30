const mmRoot = $('#manage-route');
const endpoint = {
    csrf_token: mmRoot.data('csrf-token'),
    success_image: mmRoot.data('success-image'),
    error_image: mmRoot.data('error-image'),
    postcodes_url: mmRoot.data('postcodes-url'),
    generate_url: mmRoot.data('generate-url'),
    recipients_url: mmRoot.data('recipients-url'),
    reports_url: mmRoot.data('reports-url'),
    action_url: mmRoot.data('action-url'),
    clear_reports_url: mmRoot.data('clear-reports-url'),
    agent_state: mmRoot.data('agent-state'),
    save_report: mmRoot.data('save-report'),
    generate_pdf: mmRoot.data('generate-pdf'),
    update_save_report: mmRoot.data('update-save-report'),
    view_centerlist_url: mmRoot.data('view-centerlist-url'),
    save_report_list: mmRoot.data('save-report-list'),
    view_approspectlist:mmRoot.data('view-approspectlist'),

};






$(document).ready(function () {

    //Save Report table
    var saveReportTable = $("#save_report_table").DataTable({
        ajax: {
            url: endpoint.save_report_list,
            type: 'GET'
        },
        language: {
            search: "Search: _INPUT_",
            searchPlaceholder: "Search by Post Code"
        },
        processing: false,
        serverSide: true,
        paging: true,
        lengthChange: true,
        searching: true,
        bStateSave: true,
        ordering: true,
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
            data: 'date',
            name: 'date',
            searchable: false,
            defaultContent: 'NA'
        },
        {
            data: 'post_code_label',
            name: 'post_code_label',
            searchable: true,
            defaultContent: 'NA'
        },
        {
            data: 'listings_count',
            name: 'listings_count',
            defaultContent: 'NA'
        },
        {
            data: 'merged',
            name: 'merged',
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



    // DataTables
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

    //  Toggle Clear Button 
    function toggleClearBtn() {
        var hasData = reportsTable.rows().count() > 0;
        $('#clearReports').prop('disabled', !hasData);
        $('#saveReport').prop('disabled', !hasData);
    }
    toggleClearBtn();

    //  Postcode Type Toggle 
    $('input[name="postcodeType"]').change(function () {
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

    //  Single Postcode Autocomplete 
    var searchTimeout = null;
    $('#singlePostCode').on('input', function () {
        var q = $(this).val().trim();
        var dropdown = $('#postcodeDropdown');

        if (searchTimeout) clearTimeout(searchTimeout);

        if (q.length < 1) {
            dropdown.removeClass('show').empty();
            return;
        }

        searchTimeout = setTimeout(function () {
            $.ajax({
                url: endpoint.postcodes_url,
                data: { q: q },
                success: function (res) {
                    dropdown.empty();
                    if (res.data && res.data.length > 0) {
                        res.data.forEach(function (item) {
                            dropdown.append(
                                '<a class="dropdown-item postcode-option" href="javascript:void(0)" data-value="' + item.post_code + '">' + item.post_code + '</a>'
                            );
                        });
                        dropdown.addClass('show');
                    } else {
                        dropdown.removeClass('show');
                    }
                },
                error: function () {
                    dropdown.removeClass('show');
                }
            });
        }, 300);
    });

    // Select from dropdown
    $(document).on('click', '.postcode-option', function () {
        var val = $(this).data('value');
        $('#singlePostCode').val(val);
        $('#postcodeDropdown').removeClass('show').empty();
    });

    // Close dropdown on blur (with delay for click)
    $('#singlePostCode').on('blur', function () {
        setTimeout(function () {
            $('#postcodeDropdown').removeClass('show');
        }, 200);
    });

    //  Multiple Range Autocomplete 
    var fromTimeout = null;
    var toTimeout = null;

    function setupRangeAutocomplete(inputId, dropdownId, timeoutRef) {
        $('#' + inputId).on('input', function () {
            var q = $(this).val().trim();
            var dropdown = $('#' + dropdownId);

            if (timeoutRef === 'from') {
                if (fromTimeout) clearTimeout(fromTimeout);
            } else {
                if (toTimeout) clearTimeout(toTimeout);
            }

            if (q.length < 1) {
                dropdown.removeClass('show').empty();
                validateRange();
                return;
            }

            var timer = setTimeout(function () {
                $.ajax({
                    url: endpoint.postcodes_url,
                    data: { q: q },
                    success: function (res) {
                        dropdown.empty();
                        if (res.data && res.data.length > 0) {
                            res.data.forEach(function (item) {
                                dropdown.append(
                                    '<a class="dropdown-item range-postcode-option" href="javascript:void(0)" data-target="' + inputId + '" data-dropdown="' + dropdownId + '" data-value="' + item.post_code + '">' + item.post_code + '</a>'
                                );
                            });
                            dropdown.addClass('show');
                        } else {
                            dropdown.removeClass('show');
                        }
                    },
                    error: function () {
                        dropdown.removeClass('show');
                    }
                });
            }, 300);

            if (timeoutRef === 'from') fromTimeout = timer;
            else toTimeout = timer;

            validateRange();
        });

        $('#' + inputId).on('blur', function () {
            setTimeout(function () {
                $('#' + dropdownId).removeClass('show');
            }, 200);
            validateRange();
        });
    }

    setupRangeAutocomplete('fromPostCode', 'fromPostcodeDropdown', 'from');
    setupRangeAutocomplete('toPostCode', 'toPostcodeDropdown', 'to');

    // Select from range dropdowns
    $(document).on('click', '.range-postcode-option', function () {
        var val = $(this).data('value');
        var targetInput = $(this).data('target');
        var targetDropdown = $(this).data('dropdown');
        $('#' + targetInput).val(val);
        $('#' + targetDropdown).removeClass('show').empty();
        validateRange();
    });

    // Multiple Range Validation

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

    //Trial Run Toggle
    $('input[name="trialRun"]').change(function () {
        var val = $('input[name="trialRun"]:checked').val();
        $('#showRecipients').prop('disabled', val !== 'on');
    });

    // Show Recipients (Trial Run)
    $('#showRecipients').click(function () {
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
            beforeSend: function () {
                $('#showRecipients').prop('disabled', true).text('Loading...');
            },
            success: function (res) {
                if (res.data) {
                    previewTable.clear().rows.add(res.data).draw();
                    $('#previewCard').removeClass('d-none');
                }
            },
            error: function () {
                showAlert('error', 'Failed to load recipients.');
            },
            complete: function () {
                $('#showRecipients').prop('disabled', false).text('Show Recipients');
            }
        });
    });

    //  Proceed (Generate)
    $('#proceedBtn').click(function () {

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
            method: 'POST',
            data: $.extend({ _token: endpoint.csrf_token }, params),
            beforeSend: function () {
                $('#proceedBtn').prop('disabled', true).text('Generating...');
            },
            success: function (res) {
                if (res.data) {
                    reportsTable.row.add(res.data.report).draw();
                    toggleClearBtn();

                    if (trialRun === 'on') {
                        previewTable.clear().rows.add(res.data.preview).draw();
                        $('#previewCard').removeClass('d-none');
                    }

                    showAlert('success', res.message);
                }
            },
            error: function (xhr) {
                var msg = 'Failed to generate list.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
                showAlert('error', msg);
            },
            complete: function () {
                $('#proceedBtn').prop('disabled', false).text('Proceed');
            }
        });
    });

    // Close Preview
    $('#closePreview').click(function () {
        $('#previewCard').addClass('d-none');
    });


    //Clieck On Action Button ex : Merge, Print, View
    $(document).on('click', '.report-action', function (e) {
        e.preventDefault();

        let reportId = $(this).data('report-id');
        let actionType = $(this).data('report-action');
        if (actionType === 'Merge') {
            $('#mergeType').modal('show');
            //first store blacnk and then add value
            $('#report_id').val('');
            $('#report_id').val(reportId);
        } else if (actionType === 'View') {
            viewReport(reportId);
        } else if (actionType === 'Appointment') {
            //$('#appointmentModal').modal('show');
            viewAppointment(reportId);
        } else if (actionType === 'Search') {
            //alert('Search functionality coming soon!');
             $('#searchCenterModal').modal('show');
            // $('#search_report_id').val(reportId);
        }

    });

    $('#submitMergeTypeForm').submit(function (e) {
        e.preventDefault();
        let formData = $(this).serializeArray();
        let mergeType = $('input[name="mergeType"]:checked').val();
        let docId = $('input[name="doc_id"]:checked').val();


        $('#mergeType').modal('hide');
        $("#report_items_list").html('');
        $("#report_loader").show();

        $.ajax({
            url: endpoint.action_url,
            method: 'POST',
            _token: endpoint.csrf_token,
            data: {
                _token: endpoint.csrf_token,
                report_id: $('#report_id').val(),
                mergeType: mergeType,
                doc_id: docId,
            },
            success: function (res) {
                $('#view_report').modal('show');
                $('#report_loader').hide();
                if (res.status === true) {
                    $('#report_items_list').html(res.data.html);
                }
            },
            error: function (xhr) {
                var msg = 'Failed to generate list.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }

                $('#report_loader').hide();
                $('#report_items_list').html(`<p class="text-danger text-center py-3">${msg}</p>`);
            }

        });

    });


    $(document).on('change', '.itemCheckbox', function () {
        let total = $('.itemCheckbox').length;
        let checked = $('.itemCheckbox:checked').length;
        $('#selectAll').prop('checked', total === checked);
        updateCount();
    });

    function updateCount() {
        let n = $('.itemCheckbox:checked').length;
        if (n > 0) {
            $('#selectedCount').show().text(n + ' Selected');
        } else {
            $('#selectedCount').hide();
        }
    }


    // Item click → select/deselect

    $(document).on('click', '.item', function (e) {

        if ($(e.target).closest('.action_btn').length) {
            return;
        }

        if ($(e.target).hasClass('itemCheckbox')) {
            let isChecked = $(e.target).is(':checked');
            $(this).toggleClass('selected', isChecked);
            updateCount();
            syncSelectAll();
            return;
        }

        let checkbox = $(this).find('.itemCheckbox');
        let newState = !checkbox.is(':checked');

        checkbox.prop('checked', newState);
        $(this).toggleClass('selected', newState);

        updateCount();
        syncSelectAll();
    });


    //  Clear Reports
    $('#clearReports').click(function () {
        confirmDialog({
            title: 'Are you sure?',
            text: 'All generated reports will be permanently deleted.',
            confirmButtonText: 'Yes, clear all',
            fallbackMessage: 'Are you sure you want to clear all generated reports?',
            onConfirm: clearReportsAjax
        });
    });

    // Save Report
    $('#saveReport').click(function () {
        confirmDialog({
            title: 'Save Report',
            text: 'Do you want to save this report? It will be available in your saved reports section.',
            confirmButtonText: 'Yes, save it',
            onConfirm: saveReportAjax

        });
    });

    function saveReportAjax() {
        $.ajax({
            url: endpoint.save_report,
            method: 'GET',
            beforeSend: function () {
                $('#saveReport').prop('disabled', true).text('Saving...');
            },
            success: function (res) {
                reportsTable.clear().draw();
                //toggleClearBtn();
                showAlert('success', res.message || 'All reports cleared.');
            },
            error: function () {
                showAlert('error', 'Failed to clear reports.');
            },
            complete: function () {
                $('#saveReport').text('Save Report');
                $('#saveReport').prop('disabled', false);
                toggleClearBtn();
            }
        });
    }

    function clearReportsAjax() {
        $.ajax({
            url: endpoint.clear_reports_url,
            method: 'POST',
            data: { _token: endpoint.csrf_token },
            beforeSend: function () {
                $('#clearReports').prop('disabled', true).text('Clearing...');
            },
            success: function (res) {
                reportsTable.clear().draw();
                toggleClearBtn();
                showAlert('success', res.message || 'All reports cleared.');
            },
            error: function () {
                showAlert('error', 'Failed to clear reports.');
            },
            complete: function () {
                $('#clearReports').text('Clear');
                toggleClearBtn();
            }
        });
    }

    // Load Reports on Page Load 
    function loadReports() {
        if ($.fn.DataTable.isDataTable('#save_report_table')) {
            saveReportTable.ajax.reload(null, false);
        }
        $.ajax({
            url: endpoint.reports_url,
            success: function (res) {

                if (res.data && res.data.length) {
                    reportsTable.clear().rows.add(res.data).draw();
                }
                if (res.data.length == 0) {
                    reportsTable.clear().draw();
                }
                toggleClearBtn();
            }
        });
    }
    loadReports();

    // Alert Helper function
    function showAlert(type, message) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: type,
                //title: type === 'success' ? 'Success!' : type === 'error' ? 'Error!' : 'Warning!',
                text: message,
                timer: 2500,
                showConfirmButton: false
            });
        } else {
            alert(message);
        }
    }


    function confirmDialog(options) {
        const {
            title,
            text,
            icon = 'warning',
            confirmButtonText = 'Yes',
            cancelButtonText = 'Cancel',
            confirmButtonColor = '#d33',
            cancelButtonColor = '#6c757d',
            fallbackMessage,
            onConfirm,
            onCancel
        } = options;

        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title,
                text,
                icon,
                showCancelButton: true,
                confirmButtonColor,
                cancelButtonColor,
                confirmButtonText,
                cancelButtonText
            }).then(function (result) {
                if (result.isConfirmed) {
                    onConfirm?.();
                } else {
                    onCancel?.();
                }
            });
        } else {
            if (confirm(fallbackMessage || text)) {
                onConfirm?.();
            } else {
                onCancel?.();
            }
        }
    }


    // Select single center 
    $(document).on('click', '.btn-print-single', function () {
        let centreId = $(this).data('centre-id');
        let reportId = $(this).data('report-id');
        let docType = $(this).data('doc-type');

        triggerPDF([centreId], reportId, docType, 'print');
    });

    // Footer Print 
    $('#footerPrintBtn').on('click', function () {
        let ids = getSelectedIds();
        if (!ids.length) { showAlert('error', 'Please select at least one centre.'); return; }
        triggerPDF(ids, $('#current_report_id').val(), 'print');
    });

    $('#footerSaveBtn').on('click', function () {
        let ids = getSelectedIds();
        if (!ids.length) { showAlert('error', 'Please select at least one item.'); return; }
        triggerSave(ids, $('#current_report_id').val());
    });

    //Select All 
    $(document).on('change', '#selectAll', function () {
        let isChecked = $(this).is(':checked');

        $('.itemCheckbox').prop('checked', isChecked);
        $('.item').toggleClass('selected', isChecked);

        updateCount();
    });


    function getSelectedIds() {
        return $('.itemCheckbox:checked')
            .map(function () { return $(this).data('centre-id'); })
            .get();
    }

    function syncSelectAll() {
        let total = $('.itemCheckbox').length;
        let checked = $('.itemCheckbox:checked').length;
        $('#selectAll').prop('checked', total === checked && total > 0);
    }

    //PDF generate

    function triggerPDF(centreIds, reportId, docType, action) {

        // let btn          = action === 'print' ? '#footerPrintBtn' : '#footerSaveBtn';
        //let originalHtml = $(btn).html();
        let count = centreIds.length;

        // ✅ Sirf loader show + button disable
        // $(btn).prop('disabled', true);
        showLoader();

        $.ajax({
            url: endpoint.generate_pdf,
            method: 'POST',
            data: {
                _token: endpoint.csrf_token,
                centre_ids: centreIds,
                report_id: reportId,
                docType: docType,
                action: action,
            },
            xhrFields: { responseType: 'blob' },
            timeout: 300000,
            success: function (blob, status, xhr) {

                if (!blob || blob.size === 0) {
                    showAlert('error', 'PDF generation failed. Empty response.');
                    return;
                }

                if (blob.type === 'application/json') {
                    let reader = new FileReader();
                    reader.onload = function () {
                        let err = JSON.parse(reader.result);
                        showAlert('error', err.message || 'PDF generation failed.');
                    };
                    reader.readAsText(blob);
                    return;
                }

                let filename = xhr.getResponseHeader('X-Filename') || 'report.pdf';
                let isZip = xhr.getResponseHeader('X-Is-Zip') === 'true';
                let pdfCount = xhr.getResponseHeader('X-PDF-Count') || 1;
                let url = window.URL.createObjectURL(blob);

                downloadFile(url, filename);

                let msg = isZip
                    ? pdfCount + ' PDFs downloaded as ZIP!'
                    : 'PDF downloaded successfully!';
                showAlert('success', msg);
            },

            error: function () {
                showAlert('error', 'PDF generation failed. Please try again.');
            },

            complete: function () {
                hideLoader();
                //$(btn).prop('disabled', false).html(originalHtml);
            }
        });
    }


    function downloadFile(url, filename) {
        let a = document.createElement('a');
        a.href = url;
        a.download = filename;
        document.body.appendChild(a);
        a.click();
        a.remove();
        window.URL.revokeObjectURL(url);
    }


    function showLoader() {
        $('#loader').removeClass('d-none');
    }

    function hideLoader() {
        $('#loader').addClass('d-none');
    }

    //Save Report Center Data
    function triggerSave(centreIds, reportId) {
        $.ajax({
            url: endpoint.update_save_report,
            method: 'POST',
            data: {
                _token: endpoint.csrf_token,
                centre_ids: centreIds,
                report_id: reportId,
            },
            success: function (res) {
                if (res.status === true) {
                    $('#view_report').modal('hide');
                    loadReports();
                    showAlert('success', res.message || 'Report saved successfully!');
                }
            },
            error: function () {
                showAlert('error', 'Failed to save report. Please try again.');
            }
        });
    };



    function viewReport(id) {
        $.ajax({
            url: endpoint.view_centerlist_url.replace('__ID__', id),
            method: 'GET',
            success: function (res) {
                if (res.status === true) {
                    $('#centerlist_items').html(res.data.html);
                    $('#view_centerlist').modal('show');
                } else {
                    showAlert('error', 'Failed to load center list');
                }
            },
            error: function (err) {
                console.error(err);
                $('#centerlist_items').html('<p class="text-danger text-center py-3">Failed to load center list. Please try again.</p>');
            }
        });

    }


    //showing appointment list
    function viewAppointment(id) {
        $.ajax({
            url: endpoint.view_approspectlist.replace('__ID__', id),
            method: 'GET',
            success: function (res) {
                if (res.status === true) {
                    $('.append_appointment_list').html(res.data.html);
                    $('#appointmentModal').modal('show');
                } else {
                    showAlert('error', 'Failed to load appointment list');
                }
            },
            error: function (err) {
                 showAlert('error', 'Failed to load appointment list');
             
            }
        });
    }






});