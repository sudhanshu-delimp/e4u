@extends('layouts.userDashboard')

@section('style')
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between">
        <div class="custom-heading-wrapper">
            <h1 class="h1">Logs & Status</h1>
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

                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Heading -->
    <div class="col-md-12">
                <div id="globalAlert" class="alert d-none rounded " role="alert"></div>
    </div>
    <div class="row mt-2">

        <!-- Logs & Status -->
       
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
                            <td class="text-center" colspan="2">0</td>
                        </tr>
                        <tr>
                            <td class="icon-col"><i class="far fa-clock"></i></td>
                            <td>Last login</td>
                            <td class="text-center" colspan="2">30-09-2025 | 12:26:48 PM</td>
                        </tr>
                        <tr>
                            <td class="icon-col"><i class="fas fa-map"></i></td>
                            <td>Home State</td>
                            <td class="text-center" colspan="2">Western Australia</td>
                        </tr>
                        <tr>
                            <td class="icon-col"><i class="fas fa-key"></i></td>
                            <td>Password expiry</td>
                            <td class="text-center" id="passwordExpiryText">Renew every 30 days	</td>
                            <td class="text-center">
                                <button type="submit" class="save_profile_btn" data-target="#resetPasswordDate" data-toggle="modal">Change</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{--reset password expiry date modal  --}}
<div class="modal fade upload-modal" id="resetPasswordDate" tabindex="-1" role="dialog" aria-labelledby="resetPasswordDatelabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <img src="{{ asset('assets/dashboard/img/reset-password.png')}}" class="custompopicon">
                    <span class="text-white">Reset Password Expiry</span>
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            
            <div class="modal-body pb-0 agent-tour">
                <form method="post" id="passwordExpiry"   action="{{route('update.password.duration')}}" novalidate> 
                    <!-- Password Expiry Options -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="label">Password Expiry</label><br>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="password_expiry" id="expiry_never"  value="never">
                                <label class="form-check-label" for="expiry_never">Never</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="password_expiry" id="expiry_30" value="30">
                                <label class="form-check-label" for="expiry_30">Renew every 30 days</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="password_expiry" id="expiry_60" value="60">
                                <label class="form-check-label" for="expiry_60">Renew every 60 days</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="password_expiry" id="expiry_90" value="90">
                                <label class="form-check-label" for="expiry_90">Renew every 90 days</label>
                            </div>
                            <hr>
                            <small class="text-muted">
                                Unless you set your preferred Password Expiry, by default your password will renew every 30 days.
                            </small>
                        </div>
                    </div>

                    <!-- Save Button -->
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <button type="submit" class="btn-success-modal float-right ml-2" id="save_button">Save</button>
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
<script type="text/javascript" src="{{ asset('js/for_multiple_console/logs_and_status_blade.js') }}"></script>


@endsection