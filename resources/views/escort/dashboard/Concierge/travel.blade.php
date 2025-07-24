
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
<div id="wrapper">
   <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
         <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
             {{-- Page Heading   --}}
             <div class="row">
                <div class="d-flex align-items-center justify-content-start mt-5 flex-wrap col-lg-12">
                    <h1 class="h1">Travel</h1>
                    <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
                </div>
                <div class="col-md-12 my-4">
                    <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <ol></ol>
                    </div>
                    </div>
                </div>
            </div>
            {{-- end --}}
            <!--middle content-->
            <div class="row">
               <div class="col-md-12">
                   <div>
                       <h2><b>Partnership</b></h2>
                       Escorts4U has partnered with a leading online flight booking provider (<b>Partner</b>) to provide
                       practical and convenient advice and assistance for all of your travel requirements
                       throughout Australia.
                   </div>
                   <div class="pt-4">
                       <h2><b>Launch of the Travel service</b></h2>
                       Escorts4U will be launching its Travel service in version 2.0 of the Website. The service
                       will enable you to:
                       <ul>
                           <li>book online flights anywhere in Australia and overseas (live)</li>
                           <li>qualify for 'preferred status' to receive discounted pricing</li>
                       </ul>
                       We will let you know as soon as the service is launched.
                   </div>

                   
            </div>
               </div>
               <!--middle content end here-->
               <!--right side bar start from here-->
            </div>
         </div>
      </div>
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
