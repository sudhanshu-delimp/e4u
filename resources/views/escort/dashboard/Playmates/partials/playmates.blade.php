<style type="text/css">
    .parsley-errors-list {
        list-style: none;
    }

    .at-sec {
        position: relative;
        width: 450px;
    }

    .at-lable {
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .at-lable label {
        width: 70%;
        font-size: 16px;
        font-weight: 400;
        margin: 0;
    }

    .at-sec input {
        height: 36px;
        width: 100%;
        padding: 0px 10px 0px 30px;
        background: white url({{asset('avatars/Vector-24.svg')}}) 8px 8px no-repeat;
        border-radius: 3px;
        border: 1.8px solid #d1d3e2;
        font-size: 13px;
        font-weight: 400;
        color: #d1d3e2;
    }

    .at-sec input:focus {
        outline: none;
        border-color: #d1d3e2;
    }

    .at-sec li:focus + .results {
        display: block
    }

    .at-sec .results {
        display: none;
        position: absolute;
        top: 40px;
        left: 0;
        right: 0;
        z-index: 10;
        padding: 0;
        margin: 0;
        padding-left: 11.2rem;
        border-radius: 0.5px solid #C4C4C4;
    }

    .at-sec div.myacording-design .card .card-body ol li, div.myacording-design .card .card-body ul li, div.myacording-design .card .card-body p {
        margin-bottom: 0;
        background: #fff;
        box-shadow: 0px 4px 4px rgb(0 0 0 / 25%);
    }

    .at-sec .results li {
        display: block;
        width: 270px;
    }

    /*.at-sec .results li:first-child { margin-top: -1px }*/
    .at-sec .results li:first-child:before, .search .results li:first-child:after {
        display: block;
        content: '';
        width: 0;
        height: 0;
        position: absolute;
        left: 50%;
        margin-left: -5px;
        border: 5px outset transparent;
    }

    .at-sec .results li:first-child:after {
        border-bottom: 5px solid #fdfdfd;
        top: -10px;
    }

    .at-sec .results li:first-child:hover:before, .search .results li:first-child:hover:after {
        display: none
    }

    .at-sec .results li:last-child {
        margin-bottom: -1px
    }

    .at-sec .results a {
        display: block;
        position: relative;
        padding: 10px 40px 10px 10px;
        color: #000;
        font-weight: 500;
        font-size: 14px;
    }

    .at-sec .results a:hover {
        text-decoration: none;
        color: #fff;
        text-shadow: 0 -1px rgba(0, 0, 0, 0.3);
        border-color: #0C223D;
        background-color: #0C223D;
    }

    .active-play .at-lable {
        display: block;
    }

    .active-play ul {
        display: flex;
        padding: 0px;
        top: 0;
        position: relative;
        list-style: none;
        gap: 10px;
    }

    .active-play li {
        padding: 10px;
        border-radius: 3px;
        background: #0C223D !important;
    }

    .active-play a {
        color: #fff;
        display: flex;
        gap: 10px;
    }

</style>
<div class="container-fluid p-2">
    <div class="row">
        <div class="col-md-12  fill_profile_headings_global custom--social-head">
            <h2>My Playmates</h2>
            <span class="custom--help"><b>Help?</b></span>
        </div>
        <div class="custom-note-section">
            <div class="card" style="">
                <div class="card-body">
                <h3 class="NotesHeader"><b>Notes:</b> </h3> 
                    <ol class=" mb-0">
                        <li>
                            By activating this feature:
                            <ol type="a" class="ol_lower_alpha_bracket">
                                <li>your Profiles can be searched for by other Escorts; and</li>
                                <li>the Playmates listed under My Active Playmates will by default appear in your
                                    Profile creator. You should check with the Escort they are still available as a
                                    Playmate before creating a Profile. A Viewer will be able to view the Playmate’s
                                    Profile from your Profile.</li>
                            </ol>
                        </li>
                        <li>You can over ride these settings when creating a Profile, provided you
                            have enabled the feature (see My Account - Profile & Tour options).
                        </li>
                        <li>
                            You can search for other Escorts to link up as your Playmate by searching
                            either their Account Name or Membership ID. We recommend you search
                            by Membership ID which always appears at the top of any of the Escort's
                            Profiles.
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <div class="card-body border-0 pt-0 mt-0 p-0">
                <div class="mb-1">
                    @php
                        $playmate = auth()->user()->available_playmate
                    @endphp
                    <input type="checkbox" class="form-controll" value="Y" id="playmate"
                           name="available_playmate" {{(($playmate) ? "checked" : '' )}}/> <label for="playmate"
                                                                                                  style="display: inline;">I
                        am available as a Playmate</label>
                </div>
            </div>
            <div class="card-body active-play border-0 pt-0 mt-1 p-0">
                <div class="mt-0">
                    <div class="col-lg-12 my-3">
                        @if($user->playmateHistory->count()>0)
                        <h2 class="custom-head py-3">My Active Playmates</h2>
                        <ul class="results  mt-2 activePlaymate">
                                @foreach($user->playmateHistory->unique('playmate_id') as $item)
                                    <li id="rmlist_{{$item->id}}" class="d_my_tooltip playmate-{{$item->group_status}}"><a
                                            href="{{ route('profile.description',$item->playmate->id)}}" target="_blank">
                                            <img
                                                src="{{ $item->playmate->DefaultImage ? asset($item->playmate->DefaultImage) : asset('assets/app/img/icons-profile.png') }}"
                                                class="img-profile rounded-circle playmats-img">{{$item->playmate->user->member_id . ' - ' .$item->playmate->name}}
                                        </a>
                                        <span class="playmates_rmid" data-id="{{$item->id}}">×</span>
                                        <small class="mytool-tip">Remove</small>
                                    </li>
                                @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</div>
   
@push('script')

<script>
    let playmateExist = $(".activePlaymate li").length;
    $("#playmate").on('change', function(e) {
        let checkbox = $(this);

        // If playmate exists & user tries to uncheck it
        if (playmateExist > 0 && !checkbox.is(':checked')) {
            e.preventDefault();
            checkbox.prop('checked', true); // revert back until confirmed

            Swal.fire({
                title: "My Playmates",
                text: "If you disable Playmate, all active and inactive Playmates will be removed. Are you sure?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, disable it",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    checkbox.prop('checked', false); // now uncheck
                    updatePlaymate(0);
                    removeAllPlaymates();
                }
            });
        } else {
            // Normal update if checking or no playmate exists
            let isAvailable = checkbox.is(':checked') ? 1 : 0;
            updatePlaymate(isAvailable);
        }
    });


    let removeAllPlaymates = function () {
    let requests = []; // store all AJAX requests

    Swal.fire({
        title: 'Removing...',
        text: 'Please wait while we remove all playmates.',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $(".activePlaymate li .playmates_rmid").each(function () {
        let playmateId = $(this).data("id");
        let request = $.ajax({
            method: "POST",
            url: `{{ route('escort.remove.playmate', ':id') }}`.replace(':id', playmateId),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function (data) {
            if (!data.error) {
                $(`#rmlist_${playmateId}`).remove();
            }
        });

        requests.push(request);
    });

    // When all AJAX complete
    $.when.apply($, requests).then(function () {
        Swal.fire({
            icon: 'success',
            title: 'All removed!',
            text: 'All playmates have been successfully removed.',
            timer: 1500,
            showConfirmButton: false
        });
    }).fail(function () {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Failed to remove some playmates.'
        });
    });
};

    // let removeAllPlaymates = function(){
    //     let playmateIds = [];
    //     $(".activePlaymate li .playmates_rmid").each(function() {
    //        $.ajax({
    //         method: "POST",
    //         url: `{{ route('escort.remove.playmate', ':id') }}`.replace(':id', $(this).data("id")),
    //         headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         beforeSend: function () {
    //             Swal.fire({
    //                 title: 'Removing...',
    //                 text: 'Please wait while we remove this playmate.',
    //                 allowOutsideClick: false,
    //                 didOpen: () => {
    //                     Swal.showLoading();
    //                 }
    //             });
    //         },
    //         success: function (data) {
    //             if (!data.error) {
    //                 $(`#rmlist_${playmateId}`).remove();
    //                 Swal.fire({
    //                     icon: 'success',
    //                     title: 'Removed!',
    //                     text: data.message || 'Playmate removed successfully.',
    //                     timer: 1500,
    //                     showConfirmButton: false
    //                 });
    //             } else {
    //                 Swal.fire({
    //                     icon: 'error',
    //                     title: 'Error!',
    //                     text: data.message || 'Failed to remove playmate.'
    //                 });
    //             }
    //         }
    //        });
    //     });
    //     console.log(playmateIds);
    // }

    function updatePlaymate(isAvailable) {
        $.ajax({
            method: "GET",
            url: "{{ route('user.update.playmate') }}",
            data: {
                'available_playmate': isAvailable
            },
            success: function(data) {
                console.log("Playmate status updated");
            }
        });
    }

    $('body').on('click', '.playmates_rmid', function(e) {
    e.preventDefault();

    const $btn = $(this);
    const playmateId = $btn.data('id');
    const url = `{{ route('escort.remove.playmate', ':id') }}`.replace(':id', playmateId);

    // Optionally disable button to prevent multiple clicks
    Swal.fire({
        title: 'My Playmates',
        text: "Are you sure you want to remove this Playmate?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, remove it',
        cancelButtonText: 'Cancel',
    }).then((result) => {
        if (!result.isConfirmed) return;
        $btn.prop('disabled', true);
        $.ajax({
            method: "POST",
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                Swal.fire({
                    title: 'Removing...',
                    text: 'Please wait while we remove this playmate.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            success: function (data) {
                if (!data.error) {
                    $(`#rmlist_${playmateId}`).remove();
                    Swal.fire({
                        icon: 'success',
                        title: 'Removed!',
                        text: data.message || 'Playmate removed successfully.',
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: data.message || 'Failed to remove playmate.'
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.close();
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Something went wrong. Please try again.'
                });
            },
            complete: function() {
                $btn.prop('disabled', false); // re-enable button
            }
        });
    });
}); 
</script>
@endpush
