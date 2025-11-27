@extends('layouts.staff')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
    <style>
        .swal-button {
            background-color: #242a2c;
        }
    </style>
@stop
@section('content')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
                <!--middle content start here-->
                <!--middle content end here-->
                <div class="row">
                    <div class="custom-heading-wrapper col-md-12">
                        <h1 class="h1">My Account </h1>
                        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                            style="font-size:16px"><b>Help?</b> </span>
                    </div>
                    <div class="mb-4 col-md-12">
                        <div class="card collapse" id="notes">
                            <div class="card-body">
                                <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                {{-- <ol>
                            <li></li>
                          </ol> --}}
                            </div>
                        </div>
                    </div>

                    <!-- ALERT MESSAGE -->
                    <div class="col-md-12 mb-3">
                        <div id="formAlert" class="alert d-none rounded" role="alert"></div>
                    </div>
                    <div class="col-md-12 mb-5">
                        <div id="accordion" class="myacording-design">
                            <div class="card">

                                <div class="card-body" style="border: none;margin-top: 0px;padding-top: 0px;">
                                    <form id="userProfile" class="v-form-design"
                                        action="{{ route('staff.account.update', [$staff->id]) }}" method="POST">
                                        @csrf
                                        <!-- Start Personal Details -->
                                        <input type="hidden" name="user_id" value="{{ $staff->id }}">
                                        <div class="row">
                                            <div class=" mb-3 w-100">
                                                <h5 class="border-bottom pb-1 text-blue-primary">Personal Details</h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10 px-0">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email" class="my-agent">Full name</label>
                                                            <input type="text" class="form-control" placeholder=" "
                                                                name="name" aria-describedby="emailHelp"
                                                                value="{{ $staff->name }}">
                                                            <span class="text-danger error-name"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email" class="my-agent">Address</label>
                                                            <input type="text" class="form-control rounded-0"
                                                                placeholder="Address" name="address" id="address"
                                                                value="{{ $staff->staff_detail->address }}">
                                                            <span class="text-danger error-address"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email" class="my-agent">Phone</label>
                                                            <input type="text" class="form-control rounded-0"
                                                                placeholder="Phone" name="phone" id="phone"
                                                                value="{{ $staff->phone }}">
                                                            <span class="text-danger error-phone"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <label
                                                                class="form-control form-back">{{ $staff->email }}</label>
                                                            <input name="email" id="email" type="hidden"
                                                                value="{{ $staff->email }}">
                                                            <span class="text-danger error-email"></span>
                                                        </div>
                                                    </div>



                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">Gender </label>
                                                            <select class="form-control" name="gender" id="gender">
                                                                <option value="">Select Gender</option>
                                                                @foreach (config('escorts.profile.genders') as $key => $gender)
                                                                    <option value="{{ $key }}"
                                                                        {{ $staff->gender == $key ? 'selected' : '' }}>
                                                                        {{ $gender }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger error-gender"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Personal Details -->

                                        <!-- Start Next of Kin -->
                                        <div class="row">
                                            <div class=" mb-3 w-100">
                                                <h5 class="border-bottom pb-1 text-blue-primary">Next of Kin (Emergency
                                                    Contact)</h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10 px-0">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email" class="my-agent">Kin of Name</label>
                                                            <input type="text" name="kin_name" id="kin_name"
                                                                class="form-control rounded-0" placeholder="Kin of Name"
                                                                value="{{ $staff->staff_detail->kin_name }}">
                                                            <span class="text-danger error-kin_name"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email" class="my-agent">Relationship</label>
                                                            <input type="text" name="kin_relationship"
                                                                id="kin_relationship" class="form-control rounded-0"
                                                                placeholder="Relationship"
                                                                value="{{ $staff->staff_detail->kin_relationship }}">
                                                            <span class="text-danger error-kin_relationship"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email" class="my-agent">Mobile</label>
                                                            <input type="text" name="kin_mobile" id="kin_mobile"
                                                                class="form-control rounded-0" placeholder="Mobile"
                                                                value="{{ $staff->staff_detail->kin_mobile }}">
                                                            <span class="text-danger error-kin_mobile"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email" class="my-agent">Email
                                                                (optional)</label>
                                                            <input type="email" name="kin_email"
                                                                class="form-control rounded-0"
                                                                placeholder="Email (optional)"
                                                                value="{{ $staff->staff_detail->kin_email }}">
                                                            <span class="text-danger error-kin_email"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Next of Kin -->

                                        <!-- Start Other Details -->
                                        <div class="row">
                                            <div class=" mb-3 w-100">
                                                <h5 class="border-bottom pb-1 text-blue-primary">Other Details</h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10 px-0">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email" class="my-agent">Security Level</label>
                                                            <select class="form-control rounded-0" name="security_level2"
                                                                id="security_level_edit" disabled>
                                                                <option value="">Security Level</option>
                                                                @foreach (config('staff.security_level') as $seckey => $secLevel)
                                                                    <option value="{{ $seckey }}"
                                                                        {{ $staff->staff_detail->security_level == $seckey ? 'selected' : '' }}>
                                                                        {{ $secLevel }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger error-security_level"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email" class="my-agent">Position</label>
                                                            <select class="form-control rounded-0" name="position2"
                                                                id="position_edit" disabled>
                                                                <option value="">Position</option>
                                                                @foreach (config('staff.position') as $pkey => $position)
                                                                    <option value="{{ $pkey }}"
                                                                        {{ $staff->staff_detail->position == $pkey ? 'selected' : '' }}>
                                                                        {{ $position }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger error-position"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email" class="my-agent">Location</label>
                                                            <select class="form-control rounded-0" name="location"
                                                                id="location">
                                                                <option value="">Select Location</option>
                                                                @foreach (config('escorts.profile.cities') as $skey => $city)
                                                                    <option value="{{ $skey }}"
                                                                        {{ $staff->city_id == $skey ? 'selected' : '' }}>
                                                                        {{ $city }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger error-location"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email" class="my-agent">Commenced Date
                                                                (DD/MM/YYYY)</label>
                                                            <input type="text" name="commenced_date"
                                                                id="commenced_date" class="form-control rounded-0"
                                                                placeholder="Commenced Date (DD/MM/YYYY)"
                                                                onfocus="(this.type='date')"
                                                                onblur="if(this.value==''){this.type='text'}"
                                                                value="{{ $staff->staff_detail->commenced_date }}">
                                                            <span class="text-danger error-commenced_date"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email" class="my-agent">Employment
                                                                Status</label>
                                                            <select class="form-control rounded-0"
                                                                name="employment_status" id="employment_status">
                                                                <option value="">Select Employment Status</option>
                                                                @foreach (config('staff.employment_status') as $empkey => $empStatus)
                                                                    <option value="{{ $empkey }}"
                                                                        {{ $staff->staff_detail->employment_status == $empkey ? 'selected' : '' }}>
                                                                        {{ $empStatus }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger error-employment_status"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email" class="my-agent">Employment
                                                                Agreement?</label>
                                                            <select class="form-control rounded-0"
                                                                name="employment_agreement" id="employment_agreement">
                                                                <option value="">Employment Agreement?</option>
                                                                <option value="yes"
                                                                    {{ $staff->staff_detail->employment_agreement == 'yes' ? 'selected' : '' }}>
                                                                    Yes
                                                                </option>
                                                                <option value="no"
                                                                    {{ $staff->staff_detail->employment_agreement == 'no' ? 'selected' : '' }}>
                                                                    No
                                                                </option>
                                                            </select>
                                                            <span class="text-danger error-employment_agreement"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Other Details -->
                                        <!-- StartBuilding Security -->
                                        <div class="row">
                                            <div class=" mb-3 w-100">
                                                <h5 class="border-bottom pb-1 text-blue-primary">Building Security</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-10 px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email" class="my-agent">Access Code
                                                            Provided?</label>
                                                        <select class="form-control rounded-0" name="building_access_code"
                                                            id="building_access_code">
                                                            <option value="">Access Code Provided?</option>
                                                            <option value="yes"
                                                                {{ $staff->staff_detail->building_access_code == 'yes' ? 'selected' : '' }}>
                                                                Yes
                                                            </option>
                                                            <option value="no"
                                                                {{ $staff->staff_detail->building_access_code == 'no' ? 'selected' : '' }}>
                                                                No
                                                            </option>
                                                        </select>
                                                        <span class="text-danger error-building_access_code"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email" class="my-agent">Key Provided?</label>
                                                        <select class="form-control rounded-0" name="keys_issued"
                                                            id="keys_issued">
                                                            <option value="">Key Provided?</option>
                                                            <option value="yes"
                                                                {{ $staff->staff_detail->keys_issued == 'yes' ? 'selected' : '' }}>
                                                                Yes</option>
                                                            <option value="no"
                                                                {{ $staff->staff_detail->keys_issued == 'no' ? 'selected' : '' }}>
                                                                No</option>
                                                        </select>
                                                        <span class="text-danger error-keys_issued"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email" class="my-agent">Car Park?</label>
                                                        <select class="form-control rounded-0" name="car_parking"
                                                            id="car_parking">
                                                            <option value="">Car Park?</option>
                                                            <option value="yes"
                                                                {{ $staff->staff_detail->car_parking == 'yes' ? 'selected' : '' }}>
                                                                Yes</option>
                                                            <option value="no"
                                                                {{ $staff->staff_detail->car_parking == 'no' ? 'selected' : '' }}>
                                                                No</option>
                                                        </select>
                                                        <span class="text-danger error-car_parking"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- End Building Security -->
                                            <input type="submit" value="save"
                                                class="btn btn-primary shadow-none float-right" name="submit">
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Main Content -->
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span> </span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
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
        // new
        $('#userProfile').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);

            if (form.parsley().isValid()) {

                var url = form.attr('action');
                var data = new FormData(form[0]);
                $('span.text-danger').text('');

                swal_waiting_popup({
                    'title': 'Saving Staff Details'
                });

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
                        var alertBox = $('#formAlert');
                        var notes = $('#notes');
                        $('span.text-danger').text('');
                        if (!data.error) {
                            Swal.close();
                            alertBox
                                .removeClass('d-none alert-danger')
                                .addClass('alert-success')
                                .html('Your details have been updated successfully.');
                            $('html, body').animate({
                                scrollTop: notes.offset()
                                    .top // Get the top offset of the target div
                            }, 500);
                        } else {
                            alertBox
                                .removeClass('d-none alert-success')
                                .addClass('alert-danger')
                                .html('Error occured while updating data.');
                        }

                        // Optional: Auto-hide after 4 seconds
                        setTimeout(function() {
                            alertBox.addClass('d-none');
                        }, 10000);
                    },
                    error: function(xhr) {
                        Swal.close();
                        console.log(xhr);
                        if (xhr.status === 422) {
                            $('span.text-danger').text('');
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                $('.error-' + field).text(messages[0]);
                            });
                        } else {
                            alertBox
                                .removeClass('d-none alert-success')
                                .addClass('alert-danger')
                                .html('Oops... something went wrong. Please try again.');
                        }
                    },
                });
            }
        });

        $("#close").click(function() {
            $("#my_account_modal").hide();
            location.reload();
        });
        $('#city').select2({
            allowClear: true,
            placeholder: 'Select City',
            createTag: function(params) {
                var term = $.trim(params.term);

                if (term === '') {
                    return null;
                }
                return {
                    id: term,
                    text: term,
                    newTag: false // add additional parameters
                }
            },
            tags: false,
            minimumInputLength: 2,
            tokenSeparators: [','],
            ajax: {
                url: "{{ route('city.list') }}",
                dataType: "json",
                type: "GET",
                data: function(params) {
                    console.log(params);
                    var queryParameters = {
                        query: params.term,
                        state_id: $('#state').val()
                    }
                    return queryParameters;
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {

                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });

        $('#state').select2({
            allowClear: true,
            placeholder: 'Select State',
            createTag: function(params) {
                var term = $.trim(params.term);

                if (term === '') {
                    return null;
                }
                return {
                    id: term,
                    text: term,
                    newTag: false // add additional parameters
                }
            },
            tags: false,
            minimumInputLength: 2,
            tokenSeparators: [','],
            ajax: {
                url: "{{ route('state.list') }}",
                dataType: "json",
                type: "GET",
                data: function(params) {
                    console.log(params);
                    var queryParameters = {
                        query: params.term,
                        country_id: $('#country').val()
                    }
                    return queryParameters;
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {

                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });


        $('#country').on('change', function(e) {
            if ($(this).val()) {
                $('#state').prop('disabled', false);
                $('#state').select2('open');
            } else {
                $('#state').prop('disabled', true);
            }
        });

        $('#state').on('change', function(e) {
            if ($(this).val()) {
                $('#city').prop('disabled', false);
                $('#city').select2('open');
            } else {
                $('#city').prop('disabled', true);
            }
        });
    </script>
@endpush
