
@extends('layouts.userDashboard')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">

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
                    <form id="userProfile" action="{{ route('user.update.profile',[$profile->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" value="@if(!empty($profile->id)){{ $profile->id }} @endif">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-sm-5" for="exampleFormControlSelect1"><span style="color:red">*</span>Name:</label>
                                    <div class="col-sm-7">
                                        <input type="txt" class="form-control form-control-sm removebox_shdow" placeholder="Name" required name="name" value="{{ old('name', $profile->name) }}" data-parsley-required-message="Name is required">
                                    </div>
                                    <div class="termsandconditions_text_color">
                                        @error('name')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-5" for="exampleFormControlSelect1"><span style="color:red">*</span>Phone No:</label>
                                    <div class="col-sm-7">
                                        <input type="text" data-parsley-required-message="Phone is required" class="form-control form-control-sm removebox_shdow" placeholder="Phone No" required name="phone" value="{{ old('phone', $profile->phone) }}" data-parsley-type="number" data-parsley-type-message="Please Enter Your Mobile Number">
                                    </div>
                                    <div class="termsandconditions_text_color">
                                        @error('phone')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-sm-5" for="exampleFormControlSelect1"><span style="color:red">*</span>Gender:</label>
                                    <select class="col-sm-7" name="gender" required data-parsley-required-message="Gender is required">
                                        <option value='' selected disabled>-Select-</option>
                                        <option value=1 {{ ($profile->gender == 1)? 'selected' : ''}}>Male</option>
                                        <option value=0 {{($profile->gender== 0)? 'selected' : ''}}>Female</option>
                                        <option value=2 {{($profile->gender== 2)? 'selected' : ''}}>Other</option>
                                    </select>
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
