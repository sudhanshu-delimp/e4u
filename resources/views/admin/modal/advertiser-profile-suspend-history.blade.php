<div class="modal fade upload-modal" id="SuspendHistoryModal" tabindex="-1" role="dialog" aria-labelledby="SuspendHistoryModal" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/travel.png') }}" class="custompopicon">
                        <span class="text-white">Suspend Listing History - Profile ID: <span id="suspendProfileId"></span></span>
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table w-100" id="suspendHistoryTable" style="width:100%;">
                            <thead class="table-bg">
                            <tr>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Days</th>
                                <th>Date of Suspended</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@prepend('script')
<script>
    $('#SuspendHistoryModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let profileId = button.closest('tr').find('td:first').text().trim();
        let suspendUri = button.data('suspend-uri');
        $("#suspendProfileId").text(profileId);
        if ($.fn.DataTable.isDataTable('#suspendHistoryTable')) {
            $('#suspendHistoryTable').DataTable().destroy();
        }

        var table = $('#suspendHistoryTable').DataTable({
            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Member or Profile ID"
            },
            info: true,
            lengthChange: false,
            pageLength: 25,
            searching: false,
            order: [
                [4, 'asc']
            ],
            bStateSave: true,
            processing: true,
            serverSide: true,
            paging: true,
            ajax: {
                url: `${suspendUri}`,
                type: "POST",
            },
            columns: [
                {
                    data: 'start_date',
                    name: 'start_date',
                    searchable: false,
                    orderable: true
                },
                {
                    data: 'end_date',
                    name: 'end_date',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'days',
                    name: 'days',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'status',
                    name: 'status',
                    searchable: false,
                    orderable: false
                }
            ],
        });
    });

    
</script>
@endprepend