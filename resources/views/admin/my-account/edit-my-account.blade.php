@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
    <style>
        .swal-button {
            background-color: #242a2c;
        }
        .input_not_edit{
            font-size: 13px !important;
            color: #6e707e !important;
            border-bottom: 1px solid #5D6D7E;
            margin-bottom: 0px !important;
    line-height: 19px;
    background: #f2f2f2;
        }
    </style>
@stop
@section('content')
@php
$securityLevels = config('staff.security_level');
$securityLevel = isset($staff->staff_detail->security_level) ? $staff->staff_detail->security_level : '';
$staffType = $staff->type;
$genders = config('escorts.profile.genders');
$genderName = isset($genders[$staff->gender]) ? $genders[$staff->gender] : '';

$securityLevelName = isset($securityLevels[$staff->staff_detail->security_level]) ? $securityLevels[$staff->staff_detail->security_level] : '';

  $employmentStatuss = config('staff.employment_status');
        $employmentStatus = isset($employmentStatuss[$staff->staff_detail->employment_status])
            ? $employmentStatuss[$staff->staff_detail->employment_status] : '';
$cities = config('escorts.profile.cities');
$cityName = isset($cities[$staff->city_id]) ? $cities[$staff->city_id] : '';

$positions = config('staff.position');
$positionLabel = isset($positions[$staff->staff_detail->position]) ? $positions[$staff->staff_detail->position] : '';
  $genders = config('escorts.profile.genders');
$gender = isset($genders[$staff->gender]) ? $genders[$staff->gender] : '';

 $setting = $staff->staff_setting??null;
$idle_preference_times = config('staff.idle_preference_time');
$idle_preference_time = "";
    $twofa = "";
if(isset( $setting) && (isset($setting->idle_preference_time))) {
    $idle_preference_time = isset($idle_preference_times[(string)$setting->idle_preference_time]) ? $idle_preference_times[$setting->idle_preference_time] : "";
}
$twofas = config('staff.twofa');
if(isset( $setting) && isset($setting->twofa)) {
$twofa = isset($twofas[$setting->twofa]) ? $twofas[$setting->twofa] : "";
}

@endphp  
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
                                <ol>
                                    <li>Keep your account details up to date.</li>
                                    <li>You can change your password <a href="{{ route('admin.change.password') }}" class="custom_links_design">here</a>.</li>
                                </ol>
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
                                        action="{{ route('admin.account.update', [$staff->id]) }}" method="POST">
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
                                                            <label for="name" class="my-agent">Full name</label>
                                                            <p class="input_not_edit">{{$staff->name }}</p>   
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
                                                            <label for="email" class="my-agent">Mobile</label>
                                                            <input type="text" class="form-control rounded-0"
                                                                placeholder="Phone" name="phone" id="phone"
                                                                value="{{ $staff->phone }}">
                                                            <span class="text-danger error-phone"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <p class="input_not_edit">{{$staff->email }}</p> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">Gender </label>
                                                             <p class="input_not_edit">{{$gender }}</p> 
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
                                                            <p class="input_not_edit">{{$securityLevelName }}</p> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email" class="my-agent">Position</label>
                                                            <p class="input_not_edit">{{$positionLabel }}</p> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email" class="my-agent">Location</label>
                                                            <p class="input_not_edit">{{$cityName }}</p> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                           <label for="email" class="my-agent">Commenced Date</label>
                                                                
                                                            <p class="input_not_edit">{{ showDateWithFormat($staff->staff_detail->commenced_date, "d-m-Y")  }}</p> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email" class="my-agent">Employment Status</label>
                                                            <p class="input_not_edit">{{$employmentStatus }}</p> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email" class="my-agent">Employment Agreement?</label>
                                                             <p class="input_not_edit">{{ ucfirst($staff->staff_detail->employment_agreement) }}</p> 
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
                                        <div class="row">
                                            <div class="col-md-10 px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email" class="my-agent">Access Code
                                                            Provided?</label>
                                                             
                                                            <p class="input_not_edit">{{ ucfirst($staff->staff_detail->building_access_code) }}</p> 
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email" class="my-agent">Key Provided?</label>
                                                     
                                                            <p class="input_not_edit">{{ ucfirst($staff->staff_detail->keys_issued) }}</p> 
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email" class="my-agent">Car Park?</label>
                                                             <p class="input_not_edit">{{ ucfirst($staff->staff_detail->car_parking) }}</p> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                            <!-- End Building Security -->

                                                      <!-- Start 2FA -->
                                  
                                        <div class="row">
                                            <div class="col-md-10 px-0">
                                            <p>&nbsp;</p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email" class="my-agent">Idle Time Preference</label>
                                                              <p class="input_not_edit">{{$idle_preference_time }}</p> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-10 px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email" class="my-agent">2FA Authentication</label>
                                                              <p class="input_not_edit">{{$twofa }}</p> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                            <!-- End 2FA -->
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

    <script>
    $(document).ready(function() {
        $("#security_level_edit").on("change", function() {
            let level = $(this).val();
            // Auto-select position = same value as security_level
            $("#position_edit").val(level).trigger("change");
            $("#position_edit").prop("disabled", true);
        });
    });
</script>
@endpush
