
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

<div class="container-fluid  pl-3 pl-lg-5 pr-3 pr-lg-5">
    <div class="row">    
       <div class="custom-heading-wrapper col-md-12">
          <h1 class="h1">Social Media</h1>
          <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
       </div>
       <div class="col-md-12 mb-4">
          <div class="card collapse" id="notes" style="">
             <div class="card-body">
                <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                <ol class="mb-0">
                    <li>By completing these settings, the information set out under My Social Media will by default be included and appear in your Profile when posted.
                    </li>
                    <li>You can over ride these settings when creating a Profile, provided you have enabled the feature (see My Account - Profile & Tour options).
                    </li>
                    </ol>
             </div>
          </div>
       </div>
    </div>
    <div class="row">
        <div class="card custom-help-contain help-note-toggle" style="width: 100%;">
            <div id="my_social_media" class="collapse show" data-parent="#accordion" style="">
               <div class="card-body" style="
                  ">
                  <div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="profile-tab" style="
                     ">
                     <form id="socials_link" action="#" method="POST" enctype="multipart/form-data" novalidate="" style="
                        ">
                        <div class="padding_20_all_side pb-0">
                           <div class="row">
                              <div class="col-lg-6">
                                 <div class="form-group row align-items-center">
                                    <label class="col-sm-2 col-lg-2 col-md-2 col-2" for="exampleFormControlSelect1"><span class="manage_social_profile_icons"><i class="fab fa-facebook-f"></i></span></label>
                                    <div class="col-sm-7 col-lg-7 col-md-7 col-10">
                                       <input type="text" class="form-control form-control-sm removebox_shdow" placeholder="Facebook" name="social_links[facebook]" data-parsley-type="url" data-parsley-type-message="Please provide a valid url" value="">
                                    </div>
                                 </div>
                                 <div class="form-group row align-items-center">
                                    <label class="col-sm-2 col-lg-2 col-md-2 col-2" for="exampleFormControlSelect1"><span class="manage_social_profile_icons"><i class="fab fa-instagram"></i></span></label>
                                    <div class="col-sm-7 col-lg-7 col-md-7 col-10">
                                       <input type="text" class="form-control form-control-sm removebox_shdow" placeholder="Instagram" name="social_links[insta]" data-parsley-type="url" data-parsley-type-message="Please provide a valid url" value="">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="form-group row align-items-center">
                                    <label class="col-sm-2 col-lg-2 col-md-2 col-2" for="exampleFormControlSelect1">
                                       <span class="manage_social_profile_icons">
                                          <div class="custom-x-link"> <img src="https://e4udev2.perth-cake1.powerwebhosting.com.au/assets/app/img/twitter-x.png" class="twitter-x-logo" alt="logo"> </div>
                                       </span>
                                    </label>
                                    <div class="col-sm-7 col-lg-7 col-md-7 col-10">
                                       <input type="text" class="form-control form-control-sm removebox_shdow" placeholder="X" name="social_links[twitter]" data-parsley-type="url" data-parsley-type-message="Please provide a valid url" value="">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12 text-right"><button type="submit" class="save_profile_btn" id="escort-form-submit-btn">Save</button></div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
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
