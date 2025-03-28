
@extends('layouts.userDashboard')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">

<style type="text/css">
    .parsley-errors-list {
        list-style: none;
        color: rgb(248, 0, 0)
    }
</style>
@endsection
@section('content')
<div class="container-fluid">
    <!--middle content start here-->
    <div class="row">
        <div class="col-sm-9 col-md-9 col-lg-9 ">
            <div class="about_me_drop_down_info box_shadow_fill_profile">
                <div class="about_me_heading_in_first_tab fill_profile_headings_global">
                    <h2>Update Account</h2>
                </div>
                <div class="padding_20_all_side">
                    <form id="userProfile" action="{{ route('user.update.password')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Enter New Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Make sure you select something unique" name="password" required autocomplete="new-password" data-parsley-required-message="@lang('errors/validation/required.password')" data-parsley-pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/" data-parsley-pattern-message="@lang('errors/validation/valid.password')">
                                    <div class="termsandconditions_text_color">
                                        <!-- error sms here -->
                                        @error('password')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="conformPassword">{{ __('Confirm Password') }}</label>
                                    <input type="password" class="form-control" id="conformPassword" placeholder="Confirm Password" name="password_confirmation" data-parsley-equalto="#exampleInputPassword1" data-parsley-equalto-message="Conform password should be the same password" required autocomplete="new-password" data-parsley-required-message="@lang('errors/validation/required.conform_password')">
                                    <div class="termsandconditions_text_color">
                                        <!-- error sms here -->
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12 text-right"><button type="submit" class="save_profile_btn" id="escort-form-submit-btn">Save</button></div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
    <!--middle content end here-->
</div>

@endsection
@push('script')
<!-- file upload plugin start here -->



    <!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>


<script type="text/javascript">

    $('#userProfile').parsley({

    });



    $('#userProfile').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);

        if (form.parsley().isValid()) {

            var url = form.attr('action');
            var data = new FormData(form[0]);
            $.ajax({
                method: form.attr('method'),
                url: url,
                data: data,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (!data.error) {
                        $.toast({
                            heading: 'Success',
                            text: 'Details successfully saved',
                            icon: 'success',
                            loader: true,
                            position: 'top-right', // Change it to false to disable loader
                            loaderBg: '#9EC600' // To change the background
                        });

                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'Records Not update',
                            icon: 'error',
                            loader: true,
                            position: 'top-right', // Change it to false to disable loader
                            loaderBg: '#9EC600' // To change the background
                        });

                    }
                },

            });
        }
    });





</script>

@endpush
