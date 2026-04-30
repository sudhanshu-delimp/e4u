<div class="modal-body">
                 <div class="row">
                 
    <div class="col-sm-12">
        @php
            $id = $user->id;
            $businessName = isset($user->shareholder->business_name) ? $user->shareholder->business_name : 'NA';
            $member_id = isset($user->member_id) ? $user->member_id : 'NA';
            $dateOfEntry = isset($user->date_of_entry) ? showDateWithFormat($user->date_of_entry, 'd-m-Y') : 'NA';
            $memberType = isset($user->member_type) ? ucfirst($user->member_type) : 'NA';
            $threshold = isset($user->threshold) ? ucfirst($user->threshold) : 'No';
            $numberOfShares = isset($user->number_of_shares) ? $user->number_of_shares : 'NA';
            $shareholding = isset($user->shareholding) ? $user->shareholding : 'NA';
            $heldOnTrust = isset($user->held_on_trust) ? ucfirst($user->held_on_trust) : 'NO';

        @endphp

        <!-- Details Table -->
        <table class="table table-bordered mb-3">
            <tr>
                <th style="width:40%;">Shareholder</th>
                <td>{{ $businessName }}</td>
            </tr>
            <tr>
                <th>Date of Entry</th>
                <td>{{ $dateOfEntry }}</td>
            </tr>
            <tr>
                <th>Type</th>
                <td>{{ $memberType }}</td>
            </tr>
            <tr>
                <th>Shares</th>
                <td>{{ $numberOfShares }}</td>
            </tr>
            <tr>
                <th>Shareholding</th>
                <td>{{ $shareholding }}%</td>
            </tr>
            <tr>
                <th>Threshold</th>
                <td>{{ $threshold }}</td>
            </tr>
            <tr>
                <th>Beneficially Held</th>
                <td>{{ $heldOnTrust }}</td>
            </tr>
        </table>
            <div class="d-flex justify-content-end modal-footer">
                <form action="{{ route('admin.print_shareholder') }}" method="post" target="_blank">
                    {{ csrf_field() }}
                    <input name="user_id" type="hidden" id="user_print_id" class="user_print_id"
                        value="{{ $id }}">
                    <button type="submit" class="print-btn m-0">🖨️ Print Report</button>
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal"
                        aria-label="Close">Close</button>
                </form>
            </div>
    </div>
  </div>
</div>
