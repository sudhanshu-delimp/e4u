@extends('layouts.center')
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
<div class="container-fluid pl-3 pl-lg-5 register-pin-up mb-5">
    <!--middle content start here-->
    <div class="row">
        <div class="col-md-12">
            <div class="v-main-heading h3">Register for Pin-up</div>
        </div>
        <div class="col-md-12 mt-4 pl-4 mycont">
            <h3 class="NotesHeader"><b>Notes:</b> </h3>
            <p>Upon registration you will be:</p>
            <ol class="pl-4">
                <li>Added to the Home Page Pin Up list</li>
                <li>Notified when your turn comes up; and</li>
                <li>Have a W-Alert sent to you for your confirmation that you still wish to proceed</li>
            </ol>
            <form class="v-form-design mb-4">
                <div class="form-group">
                    <label for="comment">Comments (Please provide any additional information that we need to know)</label>
                    <textarea class="form-control" rows="5" id="comment"></textarea>
                </div>
                <div class="form-group">
                    <label for="confirmation">Confirmation</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="Method_Message" value="option1">
                        <label class="form-check-label" for="Method_Message">I have read and understand the conditions</label>
                    </div>
                </div>
                <input type="submit" name="submit" class="btn btn-primary shadow-none" value="Send Request">
            </form>
            <div id="accordion" class="myacording-design">
                <div class="card">
                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#Conditions">
                        Conditions
                        </a>
                    </div>
                    <div id="Conditions" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            <p style="font-size: 20px;">Registration </p>
                            <p>In order for you to be considered for the Home Page Pin Up, you must register your interest. Registratioin does not guarantee you will be posted on the Home Page.
                            </p>
                            <p style="font-size: 20px;">Availability </p>
                            <p>The Home Page Pin Up service is only available for one week at a time. You can register as many times as you like, however, Pin Up availablity is subject to your ranking in the list.
                            </p>
                            <p style="font-size: 20px;">Notification </p>
                            <p>Three days before your turn to be posted as the Pin Up becomes available, we will send you an W-Alert requesting confirmation that you still wish to proceed.
                            </p>
                            <p style="font-size: 20px;">Pricing </p>
                            <p>The Pin Up service is charged at the rate of $475.00 for the week. Once you confirm you wish to proceed with the listing, your Card will be charged. You will receive confirmation of your payment and a W-Alert with details of when the Pin Up will be posted.
                            </p>
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