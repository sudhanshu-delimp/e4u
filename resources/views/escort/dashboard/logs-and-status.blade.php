@extends('layouts.escort')

@section('style')

<style>

    .playmate-heading{
    background:#162b4d;
    color:#fff;
    font-size:22px;
    font-weight:600;
}

.playmate-total-row{
    background:#fafafa;
}

.playmate-count{
    display: inline-flex; 
    justify-content: center;
    align-items: center;
    min-width: 38px;
    padding: 0 12px;
}

.playmate-list{
    display:flex;
    align-items:center;
    padding:5px 0;
}

.playmate-icon{
    margin-right:-12px;
    transition:.3s;
}

.playmate-icon:hover{
    z-index:10;
}

.playmate-icon img{
    width:40px;
    height:40px;
    border-radius:50%;
    border:3px solid #fff;
    object-fit:cover;
    transition:.3s;
}

.playmate-icon img:hover{
    transform:translateY(-4px) scale(1.08);
}
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between">
        <div class="custom-heading-wrapper">
            <h1 class="h1">Logs</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="back-to-dashboard">
            <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                    <p></p>
                    <ol>
                        <li>You can change your Password settings here. You will be notified by your preferred
                            method when your Password is due to expire.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div id="globalAlert" class="alert d-none rounded " role="alert"></div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-6 mb-4">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead style="background-color: #0C223D; color: #ffffff;">
                        <tr>
                            <th colspan="3" class="text-center">Followers Online (Legbox)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="icon-col"><i class="fas fa-map-marker-alt"></i></td>
                            <td>In my Location</td>
                            <td class="text-center">{{$result['same_state_count']}}</td>
                        </tr>
                        <tr>
                            <td class="icon-col"><i class="fas fa-globe"></i></td>
                            <td>Outside my Location</td>
                            <td class="text-center">{{$result['outside_state_count']}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Finance -->
        <div class="col-md-6 mb-4">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead style="background-color: #0C223D; color: #ffffff;">
                        <tr>
                            <th colspan="3" class="text-center">My Wallet</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="icon-col"><i class="fas fa-credit-card"></i></td>
                            <td>Credit</td>
                            <td class="text-center">$ {{formatCurrency($user->wallet->balance)}}</td>
                        </tr>
                        <tr>
                            <td class="icon-col"><i class="fas fa-gift"></i></td>
                            <td>Loyalty days</td>
                            <td class="text-center">{{$user->wallet->earn_days .' '. ($user->wallet->earn_days > 1 ? 'Days':'Day')}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Logs & Status -->
        @if ($logAndStatus)
        <div class="col-md-6 mb-4">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead style="background-color: #0C223D; color: #ffffff;">
                        <tr>
                            <th colspan="4" class="text-center">Logs & Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="icon-col"><i class="fas fa-sign-in-alt"></i></td>
                            <td>Login count</td>
                            <td class="text-center" colspan="2">{{ $logAndStatus->login_count ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="icon-col"><i class="far fa-clock"></i></td>
                            <td>Last login</td>
                            <td class="text-center" colspan="2">{{ $getLastLoginTime ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="icon-col"><i class="fas fa-map"></i></td>
                            <td>Home State</td>
                            <td class="text-center" colspan="2">{{ $state ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="icon-col"><i class="fas fa-key"></i></td>
                            <td>Password expiry</td>
                            <td class="text-center" id="passwordExpiryText">{{ $passwordExpiryText ?? '' }}</td>
                            <td class="text-center">
                                <button type="submit" class="save_profile_btn" data-target="#resetPasswordDate"
                                    data-toggle="modal">Change</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @endif


       <div class="col-md-6 mb-4">
    <div class="table-responsive">
        <table class="table table-bordered playmate-table mb-0">
            <thead>
                <tr>
                    <th colspan="3" class="text-center playmate-heading">
                        <i class="fas fa-user-friends mr-2"></i> My Playmates
                    </th>
                </tr>
            </thead>

            <tbody>

                <tr class="playmate-total-row">
                    <td class="icon-col">
                        <i class="fas fa-users"></i>
                    </td>

                    <td>
                       Total Playmates
                    </td>

                    <td class="text-center">
                        <span class="playmate-count" id="playmate-total-count">
                            {{ $playmateCount }}
                        </span>
                    </td>
                </tr>

                <tr>
                    <td class="icon-col align-middle">
                        <i class="fas fa-user-friends"></i>
                    </td>

                    <td colspan="2">
                        <div class="playmate-list">

                            @foreach($user->playmateHistory->unique('playmate_id') as $item)

                                <div class="playmate-icon">

                                    <a href="javascript:void(0)"
                                       class="remove-playmate"
                                       data-id="{{ $item->id }}"
                                       data-escort_id="{{ $item->escort_id }}"
                                       data-playmate_id="{{ $item->playmate_id }}"
                                       title="{{ $item->playmate->name }}">

                                        <img
                                            src="{{ $item->playmate->DefaultImage ? asset($item->playmate->DefaultImage) : asset('assets/app/img/icons-profile.png') }}"
                                            alt="Playmate">
                                    </a>
                                </div>
                            @endforeach

                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

    </div>
</div>
{{-- reset password expiry date modal  --}}
<div class="modal fade upload-modal" id="resetPasswordDate" tabindex="-1" role="dialog"
    aria-labelledby="resetPasswordDatelabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <img src="{{ asset('assets/dashboard/img/reset-password.png') }}" class="custompopicon">
                    <span class="text-white">Reset Password Expiry</span>
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>

            <div class="modal-body pb-0 agent-tour">
                <form method="post" id="passwordExpiry" action="{{ route('update.password.duration') }}" novalidate>
                    <!-- Password Expiry Options -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="label">Password Expiry</label><br>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="password_expiry" id="expiry_never"
                                    value="never" @if ($passwirdExpire['password_expiry_days']=='never' ) checked @endif>
                                <label class="form-check-label" for="expiry_never">Never</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="password_expiry" id="expiry_30"
                                    value="30" @if ($passwirdExpire['password_expiry_days']=='30' ) checked @endif>
                                <label class="form-check-label" for="expiry_30">Renew every 30 days</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="password_expiry" id="expiry_60"
                                    value="60" @if ($passwirdExpire['password_expiry_days']=='60' ) checked @endif>
                                <label class="form-check-label" for="expiry_60">Renew every 60 days</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="password_expiry" id="expiry_90"
                                    value="90" @if ($passwirdExpire['password_expiry_days']=='90' ) checked @endif>
                                <label class="form-check-label" for="expiry_90">Renew every 90 days</label>
                            </div>
                            <hr>
                            <small class="text-muted">
                                Unless you set your preferred Password Expiry, by default your password will renew every
                                30 days.
                            </small>
                        </div>
                    </div>

                    <!-- Save Button -->
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <button type="submit" class="btn-success-modal float-right ml-2"
                                    id="save_button">Save</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
{{-- end --}}

@endsection
@section('script')
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script> --}}
<script type="text/javascript" src="{{ asset('js/for_multiple_console/logs_and_status_blade.js') }}"></script>

<script>

    $(document).on('click', '.remove-playmate', function (e) {
    e.preventDefault();

    let $this = $(this);
    let id = $this.data('id');
    let url = `/escort-dashboard/remove-playmate/${id}`;

    Swal.fire({
        title: 'Remove this Playmate?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Remove',
        cancelButtonText: 'Cancel'
    }).then((result) => {

        if (!result.isConfirmed) return;

        $.ajax({
            url: url,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                dashboard: 1
            },
            success: function (data) {

                Swal.fire({
                    icon: 'success',
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false
                });

                $this.closest('.playmate-icon').fadeOut(300, function () {
                    $(this).remove();
                });

                let count = parseInt($('#playmate-total-count').text()) || 0;
                if (count > 0) {
                    $('#playmate-total-count').text(count - 1);
                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    text: 'Something went wrong.'
                });
            }
        });

    });
});
</script>
@endsection