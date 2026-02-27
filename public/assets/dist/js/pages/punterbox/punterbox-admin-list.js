$(document).ready(function () {
    let ajaxUrl = $('#PunterboxReportTable').data('ajax-url');
    var table = $('#PunterboxReportTable').DataTable({

        "language": {
            "zeroRecords": "No Record Found!",
            searchPlaceholder: "Search by Member ID"
        },
        paging: true,
        processing: false,
        serverSide: false,
        pageLength: 10,
        order: [[3, "desc"]],
        lengthMenu: [
            [10, 20, 50, 100],
            [10, 20, 50, 100]
        ],
        ordering: true,
        columnDefs: [
            { type: 'date', targets: 1 }
        ],
        ajax: {
            url: ajaxUrl,
            type: "POST",
            dataSrc: function (json) {
                $(".today_report").text(json.today);
                $(".month_report").text(json.this_month);
                $(".year_report").text(json.this_year);
                $(".all_time_report").text(json.all_time);
                return json.data; // ✅ Return the data array for DataTables to render
            }
        },
        columns: [{
            data: 'ref',
            name: 'ref'
        },
        {
            data: 'member_id',
            searchable: true,
            render: function (data, type) {
                if (type === 'sort' || type === 'type') {
                    return parseInt(data.replace(/\D/g, ''));
                }
                if (type === 'filter') {
                    return data;
                }
                return data;
            }
        },
        {
            data: 'member_name',
            name: 'member_name',
        },
        {
            data: 'incident_date',
            name: 'incident_date',
            render: function (data, type) {
                if (type === 'sort' || type === 'type') {
                    return data;
                }

                return formatDate(data);
            }
        },
        {
            data: 'location',
            name: 'location'
        },
        {
            data: 'status',
            name: 'status',
            type: 'status',
            searchable: false,

        },
        {
            data: 'actions',
            name: 'actions',
            orderable: false,
            searchable: false,
            class: 'text-center'
        }
        ]
    });

    // Handle expand/collapse
    $('#PunterboxReportTable tbody').on('click', '.view_report', function (e) {
        e.preventDefault();

        const tr = $(this).closest('tr');
        const row = table.row(tr);

        row.child(format(row.data())).show();
        tr.addClass('shown');
        $(this).addClass('open');
    });

    // CLOSE BUTTON HANDLER (only closes, no toggle)
    $(document).on('click', '.close_report_btn', function (e) {
        e.preventDefault();

        const tr = $(this).closest('tr').parent();
        const row = table.row(tr);

        tr.removeClass('shown');
        $(this).closest('tr').hide()
    });

    function formatDate(dateString) {
        if (!dateString) return 'N/A';
        const date = new Date(dateString);
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();
        return `${day}-${month}-${year}`;
    }

    function format(data) {
        return `
                    <div class="details-content p-3 bg-light border rounded">
                        <div class="mb-3 d-flex justify-content-end">
                            <button class="btn-sm btn-cancel-modal close_report_btn" type="button"> Close</button>
                        </div>
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <th>Ref:</th>
                                    <td class="border-0">${data.ref ?? 'N/A'}</td>
                                    <th>Incident Date:</th>
                                    <td class="border-0">${formatDate(data.incident_date) ?? 'N/A'}</td>
                                </tr>
                                <tr>
                                    <th>Member ID:</th>
                                    <td class="border-0">${data.user.member_id ?? 'N/A'}</td>
                                    <th>Member Name:</th>
                                    <td class="border-0">${data.user.name ?? 'N/A'}</td>
                                </tr>
                                <tr>
                                    <th>Incident Type:</th>
                                    <td class="border-0">${data.incident_nature ?? 'N/A'}</td>
                                    <th>Location:</th>
                                    <td class="border-0">${data.location ?? 'N/A'}</td>
                                </tr>
                                <tr>
                                    <th>Incident Create:</th>
                                    <td class="border-0">${formatDate(data.created_at) ?? 'N/A'}</td>
                                    <th>Status:</th>
                                    <td class="border-0">
                                        ${data.status ? data.status.replace(/<[^>]*>/g, '') : 'N/A'}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Summary of Incident:</th>
                                    <td colspan="3" class="border-0">${data.what_happened ?? 'N/A'}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                `;
    }

    $(document).on('click', '.update_status', function (e) {
        e.preventDefault();
        let reportId = $(this).data('id');
        let status = $(this).data('status');
        let ref = $(this).data('ref');
        //let st = status == 'published' ? 'publish' : 'reject';
        $(".action_reason_div").css('display', 'none');

        if (status == 'on_hold') {
            st = 'mark as on hold';
        } else if (status == 'rejected') {
            st = 'reject';
            $(".action_reason_div").css('display', 'block');
        } else if (status == 'pending') {
            st = 'pending';
        } else {
            st = 'publish';
        }

        $('#status_data_id').val(reportId);
        $('#status_data_value').val(status);
        $('.add_review_title').text(st);
    });

    $(document).on('click', '.saveStatus', function (e) {
        e.preventDefault();
        let reviewId = $('#status_data_id').val();
        let status = $('#status_data_value').val();
        let action_reason = $('#action_reason').val();
        var reviewData = {
            'id': reviewId,
            'status': status,
            'action_reason': action_reason,
        }

        $(".action_reason_div").css('display', 'none');

        let imageUrl = '{{ asset("assets/dashboard/img/rejected.png") }}';
        if (status == 'published') {
            $(".success-modal-title").text('Published');
            imageUrl = '{{ asset("assets/dashboard/img/published.png") }}';
            $("#custompopicon").attr('src', imageUrl);

            $(".success-modal-text").text('This report is now Published');

        } else if (status == 'rejected') {
            $(".success-modal-title").text('Rejected');
            imageUrl = '{{ asset("assets/dashboard/img/rejected.png") }}';
            $("#custompopicon").attr('src', imageUrl);
            $(".success-modal-text").text('This report is now Rejected.');
            $(".action_reason_div").css('display', 'block');
        } else if (status == 'on_hold') {
            $(".success-modal-title").text('On Hold');
            $("#custompopicon").attr('src', imageUrl);
            $(".success-modal-text").text('This report is now On Hold.');
        } else {
            $(".success-modal-title").text('Pending');
            $("#custompopicon").attr('src', imageUrl);
            $(".success-modal-text").text('We’re sorry to inform you that your report has been updated to pending.');
        }

        var url = "{{route('admin.num.status.ajax')}}";
        updateMemberReportStatus(reviewData, url);
    });

    function updateMemberReportStatus(reportData, routeUrl) {
        const reportId = $(this).data('id');

        $.ajax({
            url: routeUrl, // replace with your actual route
            method: 'POST',
            data: {
                'id': reportData.id,
                'status': reportData.status,
                'action_reason': reportData.action_reason,
            },
            success: function (response) {
                if (response.error == false) {

                    $('#PunterboxReportTable').DataTable().ajax.reload(null, false);
                    $("#confirm_publish_popup").modal('show');
                }
            },
            error: function (xhr) {
                console.error('Failed to fetch data');
                $('#view-listing .modal-body').html('<p class="text-danger">Error loading data...</p>');
            }
        });
    }

    $(document).on('click', '.close_report_btn', function (e) {
        e.preventDefault();
        $("#print-advertiser-reviews").hide();
    });
});