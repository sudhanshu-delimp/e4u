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
            <div class="v-main-heading h3">Submit ticket</div>
        </div>
        <div class="col-md-12 mt-4 pl-4 mycont">
        <div class="card">
            <div class="card-body">
                <h3 class="NotesHeader"><b>Notes:</b> </h3>
                <p>To help us assist you better:</p>
                <ol class="pl-4">
                    <li>!!!When describing your problem or enquiry, please try to provide as much information as possible</li>
                    <li>Upload any documents or images you have</li>
                    <li>Allow us a couple of days to respond</li>
                </ol>
            </div>
        </div>
        <br>
            <form class="mb-4 w-50">
                <div class="form-group">
  <label for="sel1"><b>Department</b></label>
  <select class="form-control">
    <option id="placeholder" selected="" disabled="" value="">Choose Department</option>
<option>Accounts</option>
<option>Photo verification</option>
<option>Support</option>
<option>Technical</option>
<option>Website Report</option>
  </select>
</div>
<div class="form-group">
  <label for="sel1"><b>Priority</b></label>
  <select class="form-control">
<option>Normal</option>
<option>Urgent</option>
<option>High</option>
<option>Low</option>
  </select>
</div>
<div class="form-group">
  <label for="sel1"><b>Service type</b></label>
  <select class="form-control">
<option id="placeholder" selected="" disabled="" value="">Choose Service</option>
<option>Alert notifications</option>
<option>Escort Agent</option>
<option>Viewer review</option>
<option>Ugly Mugs register</option>
<option>Other</option>
  </select>
</div>
<div class="form-group">
  <label for="sel1"><b>Subject</b></label>
  <input type="text" class="form-control" placeholder=" " name="subject" value="">
  </select>
</div>
<div class="form-group">
  <label for="sel1"><b>Message</b></label>
  <textarea class="form-control" rows="5" id="comment"></textarea>
  </select>
</div>

<div class="form-group">
  <label for="sel1"><b>Document / Image upload</b>
</label>
<p>If you have any other documentation that can assist us with your query, including images, please upload them.</p>
  <div class="custom-file">
  <input type="file" class="custom-file-input">
  <label class="custom-file-label" for="customFileLang">Insert file upload</label>
</div>
  </select>
</div>


               
                <input type="submit" name="submit" class="btn btn-primary create-tour-sec dctour mt-3" value="Submit ticket">
            </form>
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