@extends('layouts.escort')
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
<div class="container-fluid pl-3 pl-lg-5">
    <div class="row">
        <div class="col-md-12">
            <div class="v-main-heading h3">Profile Information</div>
        </div>
        <div class="col-md-12 mt-4">
            <div id="accordion" class="myacording-design mb-5">
                <div class="card pb-0">
                    <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#additional_information">
                        Additional information about me
                        </a>
                    </div>
                    <div id="additional_information" class="collapse" data-parent="#accordion">
                        <div class="card-body pb-0">
                            <ol class="pl-0 mb-0">
                                <li>By completing these settings, the information set out under Additional Information will by default appear in your Profile creator.</li>
                                <li>You can over ride these settings when creating a Profile, provided you have enabled the <span class="theme-text-color">feature</span> (see My Account - Profile & Tour options).</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#my_rates">
                        My Rates
                        </a>
                    </div>
                    <div id="my_rates" class="collapse" data-parent="#accordion">
                        <div class="card-body pb-0">
                            <ol class="pl-0 mb-0">
                                <li>By completing these settings, the information set out under My rates will by default appear in your Profile creator.</li>
                                <li>You can over ride these settings when creating a Profile, provided you have enabled the <span class="theme-text-color">feature</span>  (see My Account - Profile & Tour options).</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="card pb-0">
                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#my_available_times">
                        My available times
                        </a>
                    </div>
                    <div id="my_available_times" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <ol class="pl-0 mb-0">
                                <li>By completing these settings, the information set out under My available times will by default appear in your Profile creator.</li>
                                <li>Leave the time blank if you are unavailable. Select ‘By Appointment’ as an alternative to a particular time period.</li>
                                <li>You can over ride these settings when creating a Profile, provided you have enabled the <span class="theme-text-color">feature</span>  (see My Account - Profile & Tour options).</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#my_service_tags">
                        My Service (tags)
                        </a>
                    </div>
                    <div id="my_service_tags" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <ol class="pl-0 mb-0">
                                <li>By completing these settings, the information set out under Service Tags will by
                                    default appear in your Profile creator.
                                </li>
                                <li>Any value you attach to a Service Tag is a separate value and is not included in your
                                    rates.
                                </li>
                                <li>You can over ride these settings when creating a Profile, provided you have enabled
                                    the <span class="theme-text-color">feature</span> (see My Account - Profile & Tour options).
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="card pb-0">
                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#c">
                        My playmates
                        </a>
                    </div>
                    <div id="my_play_mates" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <ol class="pl-0 mb-0">
                                <li>By completing these settings, the information set out under My playmates will by
                                    default appear in your Profile creator. You should check with the Escort they are still
                                    available as a playmate before creating a Profile. A Viewer will be able to view the
                                    playmate’s Profile from your Profile.
                                </li>
                                <li>You can over ride these settings when creating a Profile, provided you have enabled
                                    the <span class="theme-text-color">feature</span>  (see My Account - Profile & Tour options).
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="card pb-0">
                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#my_social_media">
                        My Social Media
                        </a>
                    </div>
                    <div id="my_social_media" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <ol class="pl-0 mb-0">
                                <li>By completing these settings, the information set out under My social media will by
                                    default be included and appear in your Profile when posted.
                                </li>
                                <li>You can over ride these settings when creating a Profile, provided you have enabled
                                    the  <span class="theme-text-color">feature</span> (see My Account - Profile & Tour options).
                                </li>
                            </ol>
                        </div>
                    </div>
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
    $('#city').select2({
        allowClear: true,
        placeholder :'Select City',
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
        placeholder :'Select State',
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
        if($(this).val()) {
            $('#state').prop('disabled', false);
            $('#state').select2('open');
        } else {
            $('#state').prop('disabled', true);
        }
    });
    
    $('#state').on('change', function(e) {
        if($(this).val()) {
            $('#city').prop('disabled', false);
            $('#city').select2('open');
        } else {
            $('#city').prop('disabled', true);
        }
    });
    
    
</script>
@endpush