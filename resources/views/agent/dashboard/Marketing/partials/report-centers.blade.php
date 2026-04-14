<div class="table-responsive profile_summary">
    <table cellpadding="8" cellspacing="0" width="100%"
        style="border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">
        <thead class="bg-first">
            <tr>
                <td>ID</td>
                <td>Business Name</td>
                <td>Address</td>
                <td>Post Code</td>
                <td>Mobile Number</td>
                <td>Business Number</td>
                @if($action === 'view')
                    <td>Done</td>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($centers as $center)
                <tr>
                    <td>{{ $center->id }}</td>
                    <td>{{ $center->bussiness_name ?? 'NA' }}</td>
                    <td>{{ $center->address ?? 'NA' }}</td>
                    <td>{{ $center->post_code ?? 'NA' }}</td>
                    <td>{{ $center->mobile_number ?? 'NA' }}</td>
                    <td>{{ $center->business_number ?? 'NA' }}</td>
                    @if($action === 'view')
                        <td style="text-align: center;"><input type="checkbox" /></td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $action === 'view' ? 7 : 6 }}" class="text-center">No centres found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($action === 'view')
    <div class="d-flex justify-content-end mt-3">
        <button type="button" class="btn-cancel-modal" data-dismiss="modal">Close</button>
    </div>
@endif
