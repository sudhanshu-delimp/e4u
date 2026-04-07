const mmRoot = $('#manage-route');
const endpoint = {
    csrf_token: mmRoot.data('csrf-token'),
    success_image: mmRoot.data('success-image'),
    error_image: mmRoot.data('error-image'),
    marketing_database_centres: mmRoot.data('marketing-database-centres'),
    marketing_view_database_center: mmRoot.data('marketing-view-database-center'),
    marketing_download_database_center: mmRoot.data('marketing-download-database-center'),
    count_active_post_code : mmRoot.data('count-active-post-code'),
    download_pdf: mmRoot.data('download-pdf')

};


$(document).ready(function() {
    //
    
    // Init DataTable
    var table = $("#previewTable").DataTable({
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



    var table = $("#reportsTable").DataTable({
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
                data: 'bussiness_no',
                name: 'bussiness_no',
                searchable: false,
                orderable: false,
                defaultContent: 'NA',
            },
        ],
    });

    
});