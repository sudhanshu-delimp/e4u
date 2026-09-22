<div class="modal fade upload-modal" id="view-listing" tabindex="-1" role="dialog" aria-labelledby="view-listingLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
        <div class="modal-content basic-modal">
       
            <div class="modal-body pb-0">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div id="listingModalContent">
                       
                            <h3>Advertiser Summary</h3>
                            <div style="border: 1px solid #ccc; padding: 8px; text-align:left;">
                                <img
                                    src="{{ $escort_info->avatar_img
                                        ? asset('avatars/' . $escort_info->avatar_img)
                                        : asset('assets/dashboard/img/no-image-light.png') }}"
                                    id="escort-thumbnail"
                                    alt="thumbnail"
                                    style="width:100px;"
                                >
                            </div>
                            <table style="width:100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">
                                <tbody>
                                    <tr>
                                        <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Member ID</strong></td>
                                        <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">{{ $escort_info?->member_id ?? '---' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Name</strong></td>
                                        <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">
                                            {{ $escort_info?->name ?? '---' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Mobile</strong></td>
                                        <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">{{ $escort_info?->phone ?? '---' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Email</strong></td>
                                        <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">{{ $escort_info?->email ?? '---' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Home State</strong></td>

                                        <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">
                                            {{ $escort_info->state->iso2 ? $escort_info->state->iso2 : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>Appointed</strong></td>
                                        <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">{{  isset($escort_info->agent_assign_date) ? date('d-m-Y', strtotime($escort_info->agent_assign_date)) : 'NA' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
          
        </div>
    </div>
</div>
</div>
