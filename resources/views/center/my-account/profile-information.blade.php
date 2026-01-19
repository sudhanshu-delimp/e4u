@extends('layouts.center')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/parsley/src/parsley.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style>
    .swal-button {
    background-color: #242a2c;
    }
    .custom-x-link{        
    background: #0c223d;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    }
    .custom-x-link .twitter-x-logo{
        width:18px;
    }
    .myacording-design {
        width: 100% !important;
        max-width: 100% !important;
    }
</style>
@stop
@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
            <div class="row">
                <div class="custom-heading-wrapper col-md-12">
                    <h1 class="h1">Profile Information</h1>
                    <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
                 </div>
                <div class="col-md-12 mb-4">
                    <div class="card collapse" id="notes" style="">
                        <div class="card-body">
                            <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                            <p>Please complete as much as you can about yourself. When creating a Massage Profile, your Profile Information will:</p>
                            <ol>
                                <li>Pre-populate the forms.</li>
                                <li>Make the process much quicker and easier for you; and
                                </li>
                                <li>You can always elect to over-write any Profile Information when creating a Massage Profile form which will then update your Profile Information if you ellect to.
                                </li>
                                <li>You can also upload photos and video into your Advertiser's archives. The benefits to you by doing this are:
                                </li>
                                <li>We will verify your photos, ensuring they are complient.</li>
                                <li>Your photos will be immediately available to include in any of your Advertiser's Profile/s.</li>
                                <li>Your Massage Profile can be posted immediately without the need for us to check any photos for complience.</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="accordion" class="myacording-design">
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link collapsed" data-toggle="collapse" href="#additional_information" aria-expanded="false">
                                Additional information about us
                                </a>
                            </div>
                            <div id="additional_information" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body pb-0">
                                    <div class="tab-pane fade show active" id="aboutme" role="tabpanel" aria-labelledby="home-tab">
                                        <form id="update_about_me" action="{{ route('center.update-massage-profile') }}" method="POST" enctype="multipart/form-data" novalidate="">
                                            @csrf 
                                            <!-- upload video  -->
                                            <div class="about_me_drop_down_info ">
                                                <div class="padding_20_all_side pb-0">
                                                    <!--New Row from here-->
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                                            <div class="form-group row tab-about-me-row-padding">
                                                                <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">
                                                                Building<span style="color:red">*</span></label>
                                                                <div class="col-sm-8">
            
                                                                        <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="building" required>
                                                                        <option value="" selected="">-- Not Set --</option>
                                                                        @foreach(config('escorts.profile.Building') as $key =>$buldingName)
                                                                        <option value="{{$key}}" {{ ($massage_profile->building == $key)? 'selected' : ''}}>{{$buldingName}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                                            <div class="form-group row tab-about-me-row-padding">
                                                                <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Parking</label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="parking">
                                                                        <option value="" selected="">-- Not Set --</option>
                                                                       
                                                                        @foreach(config('escorts.profile.Parking') as $key =>$ParkingName)
                                                                        <option value="{{$key}}" {{ ($massage_profile->parking == $key)? 'selected' : ''}} >{{$ParkingName}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                                            <div class="form-group row tab-about-me-row-padding">
                                                                <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Entry</label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-control form-control-sm select_tag_remove_box_sadow" id="ethnicity" name="entry">
                                                                        <option value="" selected="">-- Not Set --</option>
                                                                        
                                                                        @foreach(config('escorts.profile.Entry') as $key =>$EntryName)
                                                                        <option value="{{$key}}" {{ ($massage_profile->entry == $key)? 'selected' : ''}}>{{$EntryName}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                                            <div class="form-group row tab-about-me-row-padding">
                                                                <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Type</label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-control form-control-sm select_tag_remove_box_sadow" id="furniture_types" name="furniture_types">
                                                                        <option value="" selected="">-- Not Set --</option>
                                                                        @foreach(config('escorts.profile.furniture_types') as $key =>$furniture_type)
                                                                        <option value="{{$key}}" {{ ($massage_profile->furniture_types == $key)? 'selected' : ''}} >{{$furniture_type}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                                            <div class="form-group row tab-about-me-row-padding">
                                                                <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">
                                                                Shower</label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="shower">
                                                                        <option value="" selected="">-- Not Set --</option>
                                                                        @foreach(config('escorts.profile.Shower') as $key =>$Type)
                                                                        <option value="{{$key}}" {{ ($massage_profile->shower == $key)? 'selected' : ''}} >{{$Type}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                                            <div class="form-group row tab-about-me-row-padding">
                                                                <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Ambiance</label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="ambiance">
                                                                        <option value="" selected="">-- Not Set --</option>
                                                                        @foreach(config('escorts.profile.Ambiance') as $key =>$AmbianceName)
                                                                        <option value="{{$key}}" {{ ($massage_profile->ambiance == $key)? 'selected' : ''}} >{{$AmbianceName}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                                            <div class="form-group row tab-about-me-row-padding">
                                                                <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Security</label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-control form-control-sm select_tag_remove_box_sadow" id="securityss" name="security">
                                                                        <option value="" selected="">-- Not Set --</option>
                                                                        @foreach(config('escorts.profile.Security') as $key =>$SecurityName)
                                                                        <option value="{{$key}}" {{ ($massage_profile->security == $key)? 'selected' : ''}} >{{$SecurityName}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                                            <div class="form-group row tab-about-me-row-padding">
                                                                <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Payment</label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-control form-control-sm select_tag_remove_box_sadow" id="payment" name="payment">
                                                                        <option value="" selected="">-- Not Set --</option>
                                                                        @foreach(config('escorts.profile.Payments') as $key =>$PaymentType)
                                                                        <option value="{{$key}}" {{ ($massage_profile->payment == $key)? 'selected' : ''}} data-name="{{ $PaymentType }}">{{$PaymentType}}</option>
                                                                        @endforeach>
                                                                    </select>
                                                                </div>
                                                                
                                                                <!-- @if(!empty($massage_profile->payment)) 
                                                                <div class='select_pay'>
                                                                    <span class='languages_choosed_from_drop_down'>{!!config("escorts.profile.Payments.$massage_profile->payment") !!}</span>
                                                                </div>
                                                                @endif -->
                                                               
                                                                <!-- <div class="col-sm-12">
                                                                
                                                                    <div id="show_payment_type" style="display:none">
                                                                        <div class='select_pay' style='display: inline-block'>
                                                                            <span class='languages_choosed_from_drop_down'> </span> </div>
                                                                    </div>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                                            <div class="form-group row tab-about-me-row-padding">
                                                                <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Loyalty program
                                                                </label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-control form-control-sm select_tag_remove_box_sadow" id="ethnicity" name="loyalty">
                                                                        <option value="" selected="">-- Not Set --</option>
                                                                        @foreach(config('escorts.profile.Loyalty') as $key =>$LoyaltyType)
                                                                        <option value="{{$key}}" {{ ($massage_profile->loyalty == $key)? 'selected' : ''}} >{{$LoyaltyType}}</option>
                                                                        @endforeach>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                                            <div class="form-group row tab-about-me-row-padding">
                                                                <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Languages
                                                                </label>
                                                                <div class="col-sm-8">
                                                                    <select class="form-control form-control-sm select_tag_remove_box_sadow" id="language" name="languages">
                                                                        <option value="" selected="">-- Not Set --</option>
                                                                        @foreach(config('escorts.profile.languages') as $key =>$language)
                                                                        <option value="{{$key}}"  @if(!empty($massage_profile->language)) @if(in_array($key ,$massage_profile->language)) selected @endif @endif data-name="{{ $language }}">{{$language}}</option>
                                                                        @endforeach>
                                                                    </select>
                                                                    @if(!empty($massage_profile->language)) @foreach($massage_profile->language as $language)
                                                                    <div class='selecated_languages select_lang'>
                                                                        <span class='languages_choosed_from_drop_down'>{!!config("escorts.profile.languages.$language") !!} <small class='remove-lang'>×</small></span>
                                                                        
                                                                    </div>
                                                                    @endforeach @endif
                                                                    <div id="container_language">
                                                                    </div>
                                                                    <div id="show_language" style="display:none">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 text-right">
                                                             <input type="hidden" name="type" id="type" value="about_us">
                                                             <input type="hidden" name="massage_id" id="massage_id" value="{{$massage_profile->id}}">
                                                              <button id="read-more" type="submit" class="save_profile_btn">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card custom-help-contain">
                            <div class="card-header">
                                <a class="collapsed card-link" data-toggle="collapse" href="#my_rates">
                                Our rates
                                </a>
                            </div>
                            <div id="my_rates" class="collapse" data-parent="#accordion">
                                
                                <div class="card-body pb-0">
                                    
                                    @include('center.my-account.partials.rate-dash-tab')
                                   
                                </div>
                            </div>
                        </div>
                        <div class="card custom-help-contain">
                            <div class="card-header">
                                <a class="collapsed card-link" data-toggle="collapse" href="#my_available_times">
                                Our open times
                                </a>
                            </div>
                            <div id="my_available_times" class="collapse" data-parent="#accordion">
                                <div class="card-body pb-0">                                    
                                    @include('center.my-account.partials.available-dash-tab')
                                </div>
                            </div>
                        </div>
                    <div class="card custom-help-contain">
                        <div class="card-header">
                            <a class="collapsed card-link" data-toggle="collapse" href="#my_service_tags">
                            Our service (tags)
                            </a>
                        </div>
                        <div id="my_service_tags" class="collapse" data-parent="#accordion">
                            <div class="card-body pb-0">
                                <div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="about_me_drop_down_info ">
                                        <div class="fill_profile_headings_global col-md-12 p-0  custom--social-head">
                                            <h2>Our Service (Tags)</h2>
                                            <span class="custom--help"><b>Help?</b></span>
                                        </div>
                                        <div class="custom-note-section">
                                            <div class="card" style="">
                                                <div class="card-body">
                                                <h3 class="NotesHeader"><b>Notes:</b> </h3> 
                                                    <ol class=" mb-0">
                                                        <li>By completing these settings, the information set out under Service Tags will by default
                                                        appear in your Profile creator.</li>
                                                        <li>Any value you attach to a Service Tag is a separate value and is not included in your
                                                            Rates.</li>
                                                        <li>You can over ride these settings when creating a Profile, provided you have enabled
                                                            the the  <a href="{{ route('centre.notifications-and-features') }}" class="custom_links_design">feature</a>.</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="padding_20_all_side pb-0">
                                            <form id="myProfileServiceForm" name="myProfileServiceForm" action="{{route('center.update-massage-profile')}}" method="POST" enctype="multipart/form-data">
                                                @csrf                
                                                <div class="pt-0 pb-0">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-12 col-sm-12 full-width-for-ipad-select">
                                                            <div class="form-group row">
                                                                <label class="font-weight-500 col-sm-5" for="exampleFormControlSelect1">Massage services </label>
                                                                <div class="col-sm-7">
                                                                    <select class="form-control form-control-sm select_tag_remove_box_sadow" id="service_id_one">
                                                                        <option value="" selected="" disable="">--Select--</option>
                                                                        @foreach(config('escorts.profile.massage-services') as $key =>$services)
                                                                            @if(! in_array($key, $massage_profile->massage_services()->pluck('service_id')->toArray()))
                                                                                <option id="{{ $services}}" value="{{$key}}" >{{$services}}</option>
                                                                            @endif
                                                                        @endforeach
                                                                        
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="manage_tag_style">
                                                                <ul id="selected_service_one">
                                                                    {{-- @foreach ($massage_profile->services()->where('category_id', 1)->get() as $value) --}}
                                                                    @foreach ($massage_profile->massage_services()->where('category_id', 1)->get() as $value)
                                                                        <li class="mb-2" id="hideenclassOne_{{$value->service_id}}">
                                                                            <div class='my_service_anal hideenclassOne{{$value->id}}'>
                                                                                <span class="dollar-sign">
                                                                                {{config('escorts.profile.massage-services')[$value->service_id]  }}
                                                                                </span>
                                                                                <input type='number' class='dollar-before input_border' name='price[]' placeholder='' value="{{$value->price}}" min=0 step=10 max=200>
                                                                                <input type='hidden' name='service_id[]' value="{{$value->service_id}}">
                                                                                <input type="hidden" name="category_id[]" value="{{$value->category_id}}">
                                                                                <span id="span_id" data-id="{{$value->id}}">
                                                                                <i class='fas fa-times-circle akh1' id="id_{{$value->id}}" value="{{$value->service_id}}" data-sname="{{config('escorts.profile.massage-services')[$value->service_id]  }}" data-val="{{$value->service_id}}"></i>
                                                                                </span>
                                                                            </div>
                                                                        </li>
                                                                        @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pt-2 pb-2">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label class="font-weight-500 col-sm-5" for="exampleFormControlSelect1">Other service types </label>
                                                                <div class="col-sm-7">
                                                                    <select class="form-control form-control-sm select_tag_remove_box_sadow" id="service_id_two">
                                                                        <option value="" selected="" disable="">--Select--</option>
                                                                        @foreach(config('escorts.profile.other-services') as $key =>$services)
                                                                            @if(! in_array($key, $massage_profile->massage_services()->pluck('service_id')->toArray()))
                                                                                <option id="{{ $services}}" value="{{$key}}" >{{$services}}</option>
                                                                            @endif
                                                                        @endforeach
                                                                        
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="manage_tag_style">
                                                                
                                                                <ul id="selected_service_two">
                                                                    @foreach ($massage_profile->massage_services()->where('category_id', 2)->get() as $value)
                                                                        <li class="mb-2" id="hideenclassTwo_{{$value->service_id}}">
                                                                            <div class='my_service_anal hideenclassTwo{{$value->id}}'>
                                                                                <span class="dollar-sign">
                                                                                {{config('escorts.profile.other-services')[$value->service_id]  }}
                                                                                </span>
                                                                                <input type='number' class='dollar-before input_border' name='price[]' placeholder='' value="{{$value->price}}" min=0 step=10 max=200>
                                                                                <input type='hidden' name='service_id[]' value="{{$value->service_id}}">
                                                                                <input type="hidden" name="category_id[]" value="{{$value->category_id}}">
                                                                                <span id="span_id" data-id="{{$value->id}}">
                                                                                <i class='fas fa-times-circle akh2' id="id_{{$value->id}}" value="{{$value->service_id}}" data-sname="{{config('escorts.profile.other-services')[$value->service_id]  }}" data-val="{{$value->service_id}}"></i>
                                                                                </span>
                                                                            </div>
                                                                        </li>
                                                                        @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 text-right">
                                                        <input type="hidden" name="type" id="type" value="service">
                                                        <input type="hidden" name="massage_id" id="massage_id" value="{{$massage_profile->id}}">
                                                        <button id="read-more" type="submit" class="save_profile_btn">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card custom-help-contain">
                        <div class="card-header">
                            <a class="collapsed card-link" data-toggle="collapse" href="#my_social_media">
                                Our Social Media
                            </a>
                        </div>
                        <div id="my_social_media" class="collapse" data-parent="#accordion">
                            <div class="card-body pb-0">                                
                                @include('center.my-account.partials.social-media-dash-tab')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--middle content end here-->
    </div>
    <!--middle content end here-->
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
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script>

    $(document).on('click', '.save_profile_btn', function (e) {
        e.preventDefault();
            
                let form = $(this).closest('form'); 
                let formData = new FormData(form[0]);
                var url = form.attr('action');
                let type = formData.get('type'); 

                let formId = form.attr('id');
                console.log('Form ID:', formId);

                form.validate({
                    ignore: [],
                    errorElement: 'span',
                    errorClass: 'text-danger',
                    highlight: function (element) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function (element) {
                        $(element).removeClass('is-invalid');
                    }
                });

               
                if (!form.valid()) {
                    return false;
                }


            if(type=='service')
            {
                var selected_service_one_li = $('#selected_service_one li').length;
                var selected_service_two_li = $('#selected_service_two li').length;

                if(selected_service_one_li==0)
                {
                    swal_error_warning('Massage Services','Please select massage service.')
                    return false;
                }
                
                else if(selected_service_two_li==0)
                {
                    swal_error_warning('Other Service Types','Please select another service type.')
                    return false;
                }
            }
            

            if(type=='rates')
            {   
                var existRates = checkRates();
                if (!existRates) 
                {
                 swal_error_warning('Rates','You must complete at least one rate value to proceed.')
                 return false;
                }
            }


            if(type=='availibility')
            {
                var hasError  = validateAvailability();
                if (hasError) {
                    swal_error_warning('Our Open Time','Please select a time range or choose an availability option for each day.')
                    return false;
                }
            }

             

            $.ajax({
                method: form.attr('method'),
                url:url,
                data:formData,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    $(this).prop('disabled', false);
                    $(this).html('Update');
                    if(!data.error){
                        swal_success_popup(data.message);
                            setTimeout(function () {
                               //location.reload();
                            }, 2000); 
                    } else {
                    swal_error_popup('Oops.. sumthing wrong Please try again');
                    }
                }
            });
        
    });



    function checkRates()
    {
                const selectors = [
                'input[name="massage_price[]"]',
                'input[name="incall_price[]"]',
                'input[name="outcall_price[]"]'
                ];

                let isValid = false;
                const allInputs = selectors.flatMap(selector => 
                Array.from(document.querySelectorAll(selector))
                );

                for (const input of allInputs) {
                const val = parseFloat(input.value);
                
                if (!isNaN(val) && val > 0) {
                    isValid = true;
                    break;
                }
                }
                return isValid;
    }

    $('.resetdays').on('click', function () {
    let row = $(this).closest('.parent-row');
    row.find('select').val('').prop('disabled', false);
    row.find('input[type="radio"]').prop('checked', false);
    });






    ////////////// For Our Open Times ///////////////// 

    function validateAvailability() 
    {

        let isFormValid = true;

        $('.profile_time_availibility .parent-row').each(function () {

            let row = $(this);

            let status = row.find('input[type="radio"]:checked').val() || '';

            let fromHH   = row.find('select[name*="[hh_from]"]').val();
            let fromAMPM = row.find('select[name*="[ampm_from]"]').val();
            let toHH     = row.find('select[name*="[hh_to]"]').val();
            let toAMPM   = row.find('select[name*="[ampm_to]"]').val();

            row.removeClass('border border-danger');

            let hasFrom = fromHH && fromAMPM;
            let hasTo   = toHH && toAMPM;

            
            if (!status && !hasFrom && !hasTo) {
                isFormValid = false;
                row.addClass('border border-danger');
                return;
            }

            
            if (status === 'til_late' && !hasFrom) {
                isFormValid = false;
                row.addClass('border border-danger');
                return;
            }

            
            if (!status && hasFrom && !hasTo) {
                isFormValid = false;
                row.addClass('border border-danger');
                return;
            }

            if (status === '24_hours' || status === 'closed') {
                return;
            }
        });

        console.log('isFormValid', isFormValid);
        if (!isFormValid) {
                    return true;
                    }
            return false;

    }

    function getRow(row) 
    {
            return {
                from: row.find('select[name*="[hh_from]"], select[name*="[ampm_from]"]'),
                to: row.find('select[name*="[hh_to]"], select[name*="[ampm_to]"]'),
                radios: row.find('input[type="radio"]')
            };
    }

    $('.profile_time_availibility').on('change', 'input[type="radio"]', function () {

        let row = $(this).closest('.parent-row');
        let val = $(this).val();
        let { from, to } = getRow(row);

        if (val === 'til_late') {
            from.prop('disabled', false);
            to.val('').prop('disabled', true);
        } else {
            from.val('').prop('disabled', true);
            to.val('').prop('disabled', true);
        }
    });


    $('.profile_time_availibility').on(
        'change',
        'select[name*="[hh_from]"], select[name*="[ampm_from]"]',
        function () {

            let row = $(this).closest('.parent-row');
            let { from, to, radios } = getRow(row);

            radios.prop('checked', false);   // uncheck radios
            from.prop('disabled', false);
            to.prop('disabled', false);
        }
    );

    ////////////// End For Our Open Times ///////////////// 


    $(document).on('click', '.remove-lang , span.custom--help', function () {
        $(this).closest('.selecated_languages').remove();            
        $(this).closest('.custom-help-contain').toggleClass('help-note-toggle');
    });


    $(document).on('change','#service_id_one', function(){
        var selectedIdOne = $('#service_id_one').val();
        var getNameOne = $(this).children(":selected").attr("id");console.log(getNameOne);
        if(selectedIdOne){
            $("#selected_service_one").append(" <li id='hideenclassOne_"+ selectedIdOne+"'><div class='my_service_anal' ><span class='dollar-sign'>"+getNameOne+"</span><input type='number' class='dollar-before input_border' name='price[]' placeholder='0' value=0 min='0' oninput='this.value = Math.abs(this.value)' step=10 max=200><input type='hidden' name='category_id[]' value='1'><input type='hidden' name='service_id[]' value="+ selectedIdOne +" placeholder=''><span><i class='fas fa-times-circle akh1' data-sname='"+getNameOne+"' data-val="+ selectedIdOne+"  id='id_"+ selectedIdOne+"' value="+selectedIdOne+"></i></span></div></li> ");
            $("#service_id_one option[value="+ selectedIdOne +"]").attr('disabled','disabled');
            $("#service_id_one option[value="+ selectedIdOne +"]").remove();
            console.log('changewwwwww='+selectedIdOne);
        }
    });
    
    $(document).on('change','#service_id_two', function(){
        var selectedIdTwo = $('#service_id_two').val();
        var getNameTwo = $(this).children(":selected").attr("id");
        if(selectedIdTwo){
            $("#selected_service_two").append(" <li id='hideenclassTwo_"+selectedIdTwo+"'><div class='my_service_anal hideenclassTwo"+selectedIdTwo+"'><span class='dollar-sign'>"+getNameTwo+"</span><input type='number' class='dollar-before input_border' name='price[]' placeholder='0' min='0' oninput='this.value = Math.abs(this.value)' step=10 max=200 value=0><input type='hidden' name='category_id[]' value='2'><input type='hidden' name='service_id[]' value="+ selectedIdTwo +"><span><i class='fas fa-times-circle akh2'  data-sname='"+getNameTwo+"' data-val="+ selectedIdTwo+"  id='id_"+ selectedIdTwo+"' value="+selectedIdTwo+"></i></span></div></li> ");
            $("#service_id_two option[value="+ selectedIdTwo +"]").attr('disabled','disabled');
            $("#service_id_two option[value="+ selectedIdTwo +"]").remove();
            console.log('change='+selectedIdTwo);
        }
    });




















    

        // var editor_id2 = document.getElementById("editor2");
        // var editor_id3 = document.getElementById("editor3");
        // let editor2 = CKEDITOR.replace(editor_id2);
        // let editor3 = CKEDITOR.replace(editor_id3);
    
    
        // var textarea = document.getElementById('editor1');
        // let editor = CKEDITOR.replace(textarea);
    
        // $('#select2-dropdown').select2({
        //     createTag: function (params) {
        //         var term = $.trim(params.term);
    
        //         if (term === '') {
        //             return null;
        //         }
        //         return {
        //             id: term,
        //             text: term,
        //             newTag: true // add additional parameters
        //         }
        //     },
        //     tags: false,
        //     minimumInputLength: 2,
        //     tokenSeparators: [','],
        //     ajax: {
        //         url: "{{ route('country.list') }}",
        //         dataType: "json",
        //         type: "GET",
        //         data: function (params) {
        //             console.log(params);
        //             var queryParameters = {
        //                 query: params.term
        //             }
        //             return queryParameters;
        //         },
        //         processResults: function (data) {
        //             return {
        //                 results: $.map(data, function (item) {
    
        //                     return {
        //                         text: item.name,
        //                         id: item.id
        //                     }
        //                 })
        //             };
        //         }
        //     }
        // });
</script>





<script>


    


    // $('#update_about_me').on('submit', function(e) {
    //     e.preventDefault();
    
    //     var form = $(this);
        
    //     $("#modal-title").text("Additional Information");
    //     $("#modal-icon").attr("src", "/assets/dashboard/img/info.png");
    //     if (form.parsley().isValid()) {
    
    //         var url = form.attr('action');
    //         var data = new FormData($('#update_about_me')[0]);
    //         $('#update-about-me').prop('disabled', true);
    //         $('#update-about-me').html('<div class="spinner-border"></div>');
    //         $.ajax({
    //             method: form.attr('method'),
    //             url:url,
    //             data:data,
    //             contentType: false,
    //             processData: false,
    //             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    //             success: function (data) {
    //                 if(!data.error){
                        
    //                     // $('.Lname').text(msg);
    //                     // $("#my_account_modal").show();
    //                     var msg = "Saved";
    //                     $('.comman_msg').text(msg)
    //                     $("#comman_modal").modal('show');
    //                     $('#update-about-me').prop('disabled', false);
    //                     $('#update-about-me').html('Save');
    //                 } else {
    //                     $('.Lname').text(data.message);
    //                     var msg = data.message;
    //                     $('.comman_msg').text(msg)
    //                     $("#comman_modal").modal('show');
    //                     $('#update-about-me').prop('disabled', false);
    //                     $('#update-about-me').html('Save');
    //                 }
    //             },
    //             'error': function(error){
    //                 data = error.responseJSON;
    //                 $.toast({
    //                     heading: 'Error',
    //                     text: data.message,
    //                     icon: 'error',
    //                     loader: true,
    //                     position: 'top-right',      // Change it to false to disable loader
    //                     loaderBg: '#FF3C5F'  // To change the background
    //                 });
    //                 $('#update-about-me').prop('disabled', false);
    //                 $('#update-about-me').html('Save');
    //             }
    //         });
    //     }
    // });


    // $('#socials_link').on('submit', function(e) {
    //     e.preventDefault();
    
    //     var form = $(this);
        
    //     $("#modal-title").text("My Social Media");
    //     $("#modal-icon").attr("src", "/assets/dashboard/img/social-info.png");
    //     if (form.parsley().isValid()) {
    
    //         var url = form.attr('action');
    //         var data = new FormData($('#socials_link')[0]);
    //         $('#update-about-me').prop('disabled', true);
    //         $('#update-about-me').html('<div class="spinner-border"></div>');
    //         $.ajax({
    //             method: form.attr('method'),
    //             url:url,
    //             data:data,
    //             contentType: false,
    //             processData: false,
    //             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    //             success: function (data) {
    //                 if(!data.error){
    //                     var msg = "Saved";
    //                     $('.comman_msg').text(msg)
    //                     $("#comman_modal").modal('show');
    //                     $('#update-about-me').prop('disabled', false);
    //                     $('#update-about-me').html('Save');
    //                 } else {
    //                     $('.Lname').html("Oops.. sumthing wrong Please try again");
    //                     var msg = "Oops.. sumthing wrong Please try again";
    //                     $('.comman_msg').text(msg)
    //                     $("#comman_modal").modal('show');
    //                     $('#update-about-me').prop('disabled', false);
    //                     $('#update-about-me').html('Save');
    //                 }
    //             },
    //             'error': function(error){
    //                 data = error.responseJSON;
    //                 $.toast({
    //                     heading: 'Error',
    //                     text: data.message,
    //                     icon: 'error',
    //                     loader: true,
    //                     position: 'top-right',      // Change it to false to disable loader
    //                     loaderBg: '#FF3C5F'  // To change the background
    //                 });
    //                 $('#update-about-me').prop('disabled', false);
    //                 $('#update-about-me').html('Save');
    //             }
    //         });
    //     }
    // });
    
    // $('#read_more').on('submit', function(e) {
    //     e.preventDefault();
    
    //     var form = $(this);
       
    //     if (form.parsley().isValid()) {
    
    //         var url = form.attr('action');
    //         var data = new FormData($('#read_more')[0]);
    
    //         $('#read-more').prop('disabled', true);
    //         $('#read-more').html('<div class="spinner-border"></div>');
    //         $.ajax({
    //             method: form.attr('method'),
    //             url:url,
    //             data:data,
    //             contentType: false,
    //             processData: false,
    //             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    //             success: function (data) {
    //                 if(!data.error){
                        
    //                     $('.Lname').html("Saved");
    //                     $("#my_account_modal").show();
    //                     $('#read-more').prop('disabled', false);
    //                     $('#read-more').html('Save');
    //                     //location.reload();
    //                 } else {
                        
    //                     $('.Lname').html("Oops.. sumthing wrong Please try again");
    //                     $("#my_account_modal").show();
    //                     $('#read-more').prop('disabled', false);
    //                     $('#read-more').html('Save');
    //                 }
    //             }
    //         });
    //     }
    // });
    
    // $('#update_abut_who_am_i').on('submit', function(e) {
    
    //     let about = editor.getData();
    //     var form = $(this);
    //     if (form.parsley().isValid()) {
    
    //         $('#update_who_am_i').prop('disabled', true);
    //         $('#update_who_am_i').html('<div class="spinner-border"></div>');
    //         var url = form.attr('action');
    //         var data = new FormData();
    //         data.append('about',about);
    //         //data.append('user_id',5);
    //         data.append('_token',$('input[name="_token"]').val());
    //         e.preventDefault();
    
    //         $.ajax({
    //             method: form.attr('method'),
    //             url:url,
    //             data:data,
    //             contentType: false,
    //             processData: false,
    //             headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val() },
    //             success: function (data) {
    //                 console.log(data);
    //                 if(!data.error){
    //                     $('.Lname').html("Saved");
    //                     $("#my_account_modal").show();
    //                     $('#update_who_am_i').prop('disabled', false);
    //                     $('#update_who_am_i').html('Update');
    //                 } else {
    //                     $('.Lname').html("Oops.. sumthing wrong Please try again");
    //                     $("#my_account_modal").show();
    //                     $('#update_who_am_i').prop('disabled', false);
    //                     $('#update_who_am_i').html('Update');
    //                 }
    //             }
    //         });
    //     }
    // });
    
    // $('#language').change(function(){
    //     var languageValue = $('#language').val();
    //     $("#show_language").show();
    //     $(".select_lang").hide();
    //     var selectedLanguage = $(this).children("option:selected", this).data("name");
    //     $("#show_language").append("  <div class='selecated_languages' style='display: inline-block'><span class='languages_choosed_from_drop_down'>"+ selectedLanguage +" <small class='remove-lang'>×</small></span> </div> ");
    //     $("#container_language").append("<input type='hidden' name='language[]' value="+ languageValue +">");
    //     $("#language option[value='"+languageValue+"']").remove();
    // });

    // $(document).ready(function(){
    //    $('body').on('click', '.akh1', function() {
    //         var id = $(this).attr('id');
    //         var val = $(this).data('val');
    //         var name = $(this).data('sname');
    //         $('#hideenclassOne_'+val).remove();
    
    //         $("#service_id_one").append("<option id='"+name+"' value='"+val+"'>"+name+"</option>"); 
    //         console.log("click "+name);
    //     });
    // });
    
    // $(document).ready(function(){
    //    $('body').on('click', '.akh2', function() {
    //         var id = $(this).attr('id');
    //         var val = $(this).data('val');
    //         var name = $(this).data('sname');
    //         $('#hideenclassTwo_'+val).remove();
    
    //         $("#service_id_two").append("<option id='"+name+"' value='"+val+"'>"+name+"</option>"); 
    //         console.log("click "+name);
    //         console.log("id= "+id);
    //         console.log("val= "+val);
    //     });
    // });

    // $(document).ready(function(){
    //    $('body').on('click', '.akh3', function() {
    //         var id = $(this).attr('id');
    //         var val = $(this).data('val');
    //         var name = $(this).data('sname');
    //         $('#hideenclassThree_'+val).remove();
    
    //         $("#service_id_three").append("<option id='"+name+"' value='"+val+"'>"+name+"</option>"); 
    //         console.log("click "+name);
    //     });
    // });
    ///////////////clear reset ////////////////////  
    
    
    // $(document).on('change','#service_id_one', function(){
    //     var selectedIdOne = $('#service_id_one').val();
        
    //     var getNameOne = $(this).children(":selected").attr("id");console.log(getNameOne);
    //     if(selectedIdOne){
    //         $("#selected_service_one").append(" <li id='hideenclassOne_"+ selectedIdOne+"'><div class='my_service_anal' ><span class='dollar-sign'>"+getNameOne+"</span><input type='number' class='dollar-before input_border' name='price[]' placeholder='0' value=0 min='0' oninput='this.value = Math.abs(this.value)' step=10 max=200><input type='hidden' name='category_id[]' value='1'><input type='hidden' name='service_id[]' value="+ selectedIdOne +" placeholder=''><span><i class='fas fa-times-circle akh1' data-sname='"+getNameOne+"' data-val="+ selectedIdOne+"  id='id_"+ selectedIdOne+"' value="+selectedIdOne+"></i></span></div></li> ");
    //         $("#service_id_one option[value="+ selectedIdOne +"]").attr('disabled','disabled');
    //         $("#service_id_one option[value="+ selectedIdOne +"]").remove();
    //         console.log('changewwwwww='+selectedIdOne);
    //     }
    // });
    
    // $('body').on('change','#service_id_two', function(){
    //     var selectedIdTwo = $('#service_id_two').val();
    //     var getNameTwo = $(this).children(":selected").attr("id");
    //     if(selectedIdTwo){
    //         $("#selected_service_two").append(" <li id='hideenclassTwo_"+selectedIdTwo+"'><div class='my_service_anal hideenclassTwo"+selectedIdTwo+"'><span class='dollar-sign'>"+getNameTwo+"</span><input type='number' class='dollar-before input_border' name='price[]' placeholder='0' min='0' oninput='this.value = Math.abs(this.value)' step=10 max=200 value=0><input type='hidden' name='category_id[]' value='2'><input type='hidden' name='service_id[]' value="+ selectedIdTwo +"><span><i class='fas fa-times-circle akh2'  data-sname='"+getNameTwo+"' data-val="+ selectedIdTwo+"  id='id_"+ selectedIdTwo+"' value="+selectedIdTwo+"></i></span></div></li> ");
    //         $("#service_id_two option[value="+ selectedIdTwo +"]").attr('disabled','disabled');
    //         $("#service_id_two option[value="+ selectedIdTwo +"]").remove();
    //         console.log('change='+selectedIdTwo);
    //     }
    // });
    
    // $('body').on('click','#service_id_three', function(){
    //     var selectedIdThree = $('#service_id_three').val();
    //     var getNameThree = $(this).children(":selected").attr("id");
    //     if(selectedIdThree){
    //         $("#selected_service_three").append(" <li id='hideenclassThree_"+ selectedIdThree+"'><div class='my_service_anal hideenclassThree"+selectedIdThree+"'><span class='dollar-sign'>"+getNameThree+"</span><input type='number' class='dollar-before  input_border' name='price[]' placeholder='0' min='0' oninput='this.value = Math.abs(this.value)' step=10 max=200><input type='hidden' name='service_id[]' value="+ selectedIdThree +" placeholder=''><span><i class='fas fa-times-circle akh3'  data-sname='"+getNameThree+"' data-val="+ selectedIdThree+"  id='id_"+ selectedIdThree+"' value="+selectedIdThree+"></i></span></div></li> ");
    //         $("#service_id_three option[value="+ selectedIdThree +"]").attr('disabled','disabled');
    //         $("#service_id_three option[value="+ selectedIdThree +"]").remove();
    //         console.log('change='+selectedIdThree);
    //     }
    // });


    //saveProfilename
    // $('body').on('click','#saveProfilename', function(e){
    //     e.preventDefault();
    //     var profile_name = $('#profile_name').val();
    //     var start_date = $('#start_date').val();
    //     var end_date = $('#end_date').val();
    //     var membership = $('#membership').val();
    //     if($('#update_about_me').submit()) {
    //         console.log(" name = "+profile_name);
    //         window.location.href ="{{ route('escort.profile.basic.update', $massage_profile->id) }}";
    //     }
        
       
        
    // });
    
    //start available //
//     $('.available_to').click( function() {
//     var val = $(this).val();
//     console.log($(this).val());
//     $(this).is(':checked') ? $('#'+val).show() : $('#'+val).hide();
//     });
    
//     //end  to
//     //start playType //
//     $('.playType').click( function() {
//     var val = $(this).val();
//     var name = $(this).data('name');
//     $(".show_playType").show();
//     console.log(name);
//     // $(this).is(':checked') ? $("#show_playType").append("<div class='selecated_languages' style='display: inline-block'><span class='languages_choosed_from_drop_down'>"+ name +" </span> </div> ") : '';
        
//     // $(this).is(':checked') ? $('#show_playType').show() : $('#show_playType').hide();
//     // });
//     if($(this).is(':checked'))
//     {
//         $("#show_playType").append("<div class='selecated_languages playT' style='display: inline-block' id='"+val+"'><span class='languages_choosed_from_drop_down'>"+ name +" </span> </div> ")
//     } 
//     else 
//     {
//         $('#show_playType #'+val).remove();
//     } 
//     });
    
//     //end  to
//     $(".membership_type").each(function( index){
//         $('body').on('click','#type_'+index, function(e){
//             e.preventDefault();
//             var href = $("#membershipType").attr('action');
//             var plan_type = $(this).data('value');
//             //var data = new FormData($('#membershipType')[0]);
//             var id = $('#hidden-escort-id').val();
//             console.log()
//             $.ajax({
//                 url : href,
//                 method : "POST",
//                 data : {'plan_type': plan_type},
//                 //contentType: false,
//                 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//                 success: function (data) {
//                     console.log(data);
//                     if(data.error == 1){
//                         $.toast({
//                             heading: 'Success',
//                             text: 'Record successfully update',
//                             icon: 'success',
//                             loader: true,
//                             position: 'top-right',      // Change it to false to disable loader
//                             loaderBg: '#9EC600'  // To change the background
//                         });
//                     } else {
//                         $.toast({
//                             heading: 'Error',
//                             text: 'Records Not update',
//                             icon: 'error',
//                             loader: true,
//                             position: 'top-right',      // Change it to false to disable loader
//                             loaderBg: '#9EC600'  // To change the background
//                         });
//                     }
//                 },
    
//         });
    
//     });
//     });
    
//     $('#myServices').on('submit', function(e) {
//         e.preventDefault();
    
//             var form = $(this);
//             $("#modal-title").text("Our Service (tags)");
//             $("#modal-icon").attr("src", "/assets/dashboard/img/my-service-tag.png");
//             var url = form.attr('action');
//             var data = new FormData($('#myServices')[0]);
//             console.log(data);
//             $('#my_services').prop('disabled', true);
//             $('#my_services').html('<div class="spinner-border"></div>');
    
//             $.ajax({
//                 method: form.attr('method'),
//                 url:url,
//                 data:data,
//                 contentType: false,
//                 processData: false,
//                 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//                 success: function (data) {
//                     if(!data.error){
//                         $('.Lname').html("Saved");
//                         var msg = "Saved";
//                         $('.comman_msg').text(msg)
//                         $("#comman_modal").modal('show');
//                         $('#my_services').prop('disabled', false);
//                         $('#my_services').html('Save');
//                     } else {
//                         $('.Lname').html("Oops.. sumthing wrong Please try again");
//                         var msg = "Oops.. sumthing wrong Please try again";
//                         $('.comman_msg').text(msg)
//                         $("#comman_modal").modal('show');
//                         $('#my_services').prop('disabled', false);
//                         $('#my_services').html('Save');
//                     }
//                 },
//                 error: function (data) {
//                     $.toast({
//                         heading: 'Error!',
//                         text: data.responseJSON.message,
//                         icon: 'error',
//                         loader: true,
//                         position: 'top-right',      // Change it to false to disable loader
//                         loaderBg: '#9EC600'  // To change the background
//                     });
//                     $('#my_services').prop('disabled', false);
//                     $('#my_services').html('Save');
//                 }
//             });
//         //}
//     });
    
//     $('#storeRate').on('submit', function(e) {
//         e.preventDefault();
    
//         var form = $(this);
//         $("#modal-title").text("Our Rates");
//         $("#modal-icon").attr("src", "/assets/dashboard/img/price-list.png");
//         var url = form.attr('action');
//         var data = new FormData($('#storeRate')[0]);
//         console.log(data);
//         $('#store_rate').prop('disabled', true);
//         $('#store_rate').html('<div class="spinner-border"></div>');
//         $.ajax({
//             method: form.attr('method'),
//             url:url,
//             data:data,
//             contentType: false,
//             processData: false,
//             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//             success: function (data) {
//                 if(!data.error){
//                     var msg = "Saved";
//                     $('.comman_msg').text(msg)
//                     $("#comman_modal").modal('show');
//             //
//                     $('#store_rate').prop('disabled', false);
//                     $('#store_rate').html('Save');
//                 } else {
                    
//                     $('.Lname').html("Oops.. sumthing wrong Please try again");
//                     var msg = "Oops.. sumthing wrong Please try again";
//                     $('.comman_msg').text(msg)
//                     $("#comman_modal").modal('show');
//                     $('#store_rate').prop('disabled', false);
//                     $('#store_rate').html('Save');
//                 }
//             }
//         });
//     });
    
//     $('#myability').on('submit', function(e) {
//         e.preventDefault();
    
//         var form = $(this);
        
//         $("#modal-title").text("Our Open Times");
//             $("#modal-icon").attr("src", "/assets/dashboard/img/available-time.png");
//         if (form.parsley().isValid()) {
            
//             $('#my_abilities').prop('disabled', true);
//             $('#my_abilities').html('<div class="spinner-border"></div>');
//             var url = form.attr('action');
//             var data = new FormData($('#myability')[0]);
//             console.log(data);
    
//             $.ajax({
//                 method: form.attr('method'),
//                 url:url,
//                 data:data,
//                 contentType: false,
//                 processData: false,
//                 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//                 success: function (data) {
//                     if(!data.error){
//                         var msg = "Saved";
//                         $('.comman_msg').text(msg)
//                         $("#comman_modal").modal('show');
//                         $('#my_abilities').prop('disabled', false);
//                         $('#my_abilities').html('Save');
//                     } else {
//                         $('.Lname').html("Oops.. sumthing wrong Please try again");
//                         var msg = "Oops.. sumthing wrong Please try again";
//                         $('.comman_msg').text(msg)
//                         $("#comman_modal").modal('show');
//                         $('#my_abilities').prop('disabled', false);
//                         $('#my_abilities').html('Save');
//                     }
//                 }
//             });
//         }
//     });
    
    
    
//     $('#read_more').parsley({
    
//     });
//     $('#myability').parsley({
    
//     });
//     $('#myPolicy').parsley({
    
//     });
    
    
//     // $('.resetdays').each(function( index ){
//     //     var days = $(this).attr('id');
//     //     console.log("day->"+days);
//     //     $('#'+ days).click(function(){
//     //         console.log($(this).data('day'));
//     //         $("."+$(this).data('day')+" option:selected").removeAttr("selected");
//     //     });
//     // });
    
//     $('#banner-image-upload').on('change', function(e) {
//         $('#banner-image-preview').attr('src', URL.createObjectURL(e.target.files[0]));
//     });
    
//     $('#banner-video-upload').on('change', function(e) {
//         $('#banner-video-preview').show();
//         $('#banner-video-preview').attr('src', URL.createObjectURL(e.target.files[0]));
//     });
    
//     $("#start_date").on('click', function() 
//     {
//         var today = new Date();
//         var start_date = moment(today).format('YYYY-MM-DD');  
        
//             $("#start_date").attr({
//             "min" : start_date,          // values (or variables) here
//             });
//     });
    
//     $('#start_date').on('change', function()
//     {
//         $("#end_date").show();
//         var val = $(this).val();
//         var result = new Date(val);
//         var ss = result.setDate(result.getDate() + 1);
//         var first_date = moment(ss).format('YYYY-MM-DD');  
        
//             $("#end_date").attr({
//             "min" : first_date, 
//             "value" : first_date,         // values (or variables) here
//             });
//             console.log(first_date);
//             console.log(val);
           
//     });
    
//     $('#play-mates-modal').on('shown.bs.modal', function (e) {
    
//         var name, city, source = e.relatedTarget;
    
//         $('#hidden_escort_id').val($(source).data('id'));
//         console.log("id is here" + $(source).data('id'));
    
//         if(name = $(source).data('name')) {
//             $('#playmate-modal-name').html('Playmates for ' + $(source).data('name'));
//         }
    
//         if(city = $(source).data('city')) {
//             $('#playmate-modal-location').html('<svg width="14" height="21" viewBox="0 0 14 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 10C6.33696 10 5.70107 9.73661 5.23223 9.26777C4.76339 8.79893 4.5 8.16304 4.5 7.5C4.5 6.83696 4.76339 6.20107 5.23223 5.73223C5.70107 5.26339 6.33696 5 7 5C7.66304 5 8.29893 5.26339 8.76777 5.73223C9.23661 6.20107 9.5 6.83696 9.5 7.5C9.5 7.8283 9.43534 8.15339 9.3097 8.45671C9.18406 8.76002 8.99991 9.03562 8.76777 9.26777C8.53562 9.49991 8.26002 9.68406 7.95671 9.8097C7.65339 9.93534 7.3283 10 7 10V10ZM7 0.5C5.14348 0.5 3.36301 1.2375 2.05025 2.55025C0.737498 3.86301 0 5.64348 0 7.5C0 12.75 7 20.5 7 20.5C7 20.5 14 12.75 14 7.5C14 5.64348 13.2625 3.86301 11.9497 2.55025C10.637 1.2375 8.85652 0.5 7 0.5V0.5Z" fill="#FF3C5F"></path></svg>' + $(source).data('city'));
//         }
    
//         $.ajax({
//             url: $(source).data('url'),
//             success: function (data) {
//                 $('#playmate-template').html(data);
//             }
//         });
//     });
    
//     $('#play-mates-modal').on('hidden.bs.modal', function () {
//         $('#playmate-template').html('<div class="spinner-border text-secondary" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div>');
//         $('#playmate-modal-name').html('');
//         $('#playmate-modal-location').html('');
//     });
    
//     $('#search-playmate-input').on('change', function(e) {
        
//         if($(this).val()) {
//             $('#playmate_submit_button').show();
//         } else {
//             $('#playmate_submit_button').hide();
//         }
//     });
    
//     function formatEscortList (data) {
//         console.log('ckjoiujk;',data);
//         return $('<span><img class="profile-user-img img-responsive img-circle img-profile rounded-circle small-round-fixed" src="'+data.text+'"> '+data.name+' || '+data.member_id+'</span>');
    
//     }
    
//     $('#add-playmate-form').on('submit', function(e) {
//         e.preventDefault();
//         $('#playmate_submit_button').attr('disabled', true);
//         $('#playmate_submit_button').html('<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>')
//         var $this = $(this);
//         var escort_id = $('#hidden_escort_id').val();
//         var member_id = $('#search-playmate-input').val();
//         var url = $this.attr('action');
       
//         $.post({
//             type: $this.attr('method'),
//             url: url,
//             data: {
//                 escort_id: escort_id,
//                 playmate_id: member_id
//             },
//             success: function (data) {
//                 $('#search-playmate-input').val('');
//                 $('#playmate_submit_button').hide();
//                 $('#playmate-template').html(data);
//             },
//             error: function (data) {
//                 console.log(data);
//             },
//         }).done(function (data) {
//             $('#playmate_submit_button').attr('disabled', false);
//             $('#playmate_submit_button').html('Add Playmate');
    
//             //$("#search-playmate-input").select2("val", "");
    
//             $("#search-playmate-input").empty().trigger('change')
            
//         });
//     });
    
//     $(document).on('click', '.remove-playmate', function(e) {
//         e.preventDefault();
    
//         var $this = $(this);
//         var escort_id = $this.data('escort_id');
//         var playmate_id = $this.data('playmate_id');
//         const swalWithBootstrapButtons = Swal.mixin({
//             customClass: {
//                 confirmButton: 'btn btn-success',
//                 cancelButton: 'btn btn-danger'
//             },
//             buttonsStyling: false
//         });
    
//         swalWithBootstrapButtons.fire({
//             title: 'Are you sure?',
//             icon: 'warning',
//             showCancelButton: true,
//             confirmButtonText: 'Remove',
//             cancelButtonText: 'Cancel!',
//             reverseButtons: true
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 $.post({
//                     type: 'POST',
//                     url: "{{ route('escort.playmates.remove') }}",
//                     data: {
//                         escort_id: escort_id,
//                         playmate_id: playmate_id
//                     },
//                 }).done(function (data) {
//                     if(data.error == 0) {
//                         Swal.fire({
//                             icon: 'error',
//                             title: 'Oops...',
//                             text: data.message
//                         });
//                     } else {
//                         swalWithBootstrapButtons.fire({
//                             icon: 'success',
//                             title: '',
//                             text: data.message
//                         });
//                        // location.reload();
//                         $('#playmate-template').html(data.template);
//                     }
//                 });
//             }
//         });
//     });
    
//     $("body").on('click','.nex_sterp_btn',function(e){
//         e.preventDefault();
//         var id = $(this).attr('id');
//         $(this).removeClass('active');
//         $(".nav-link").removeClass('active');
//         console.log("id=" +id)
//     });
    
//     $('.covidreport').on('change', function(e) {
//         if($(this).val() == 1 || $(this).val() == 2) {
//             $('#covid-file-block').show();
//         } else {
//             $('#covid-file-block').hide();
//         }
//     })
//     // var numInput = document.querySelector('input');
//     // $(document).on("paste","input[type='number']", function(e) {
//     // if (e.originalEvent.clipboardData.getData('text').match(/[^\d(\.\d)*$]/))
//     // e.preventDefault(); //prevent the default behaviour 
//     // })
//     // .on("keypress", function(e) {
//     // if (e.keyCode != 46 && e.keyCode > 31  && (e.keyCode < 48 || e.keyCode > 57))
//     //  e.preventDefault();
//     // });
//     $(document).ready(function(){
//         $('.resetdays').click(function(){
//             var p_element = $(this);
//             var id = $(this).attr('id');
//             var element_class = p_element.attr('data-day');
//             console.log("select."+element_class);
//             $('select.'+element_class).prop('selectedIndex',0);
//             $('select.'+element_class).attr('disabled', false)
//             //$('input[name="covidreport"]').removeAttr('checked');
//             //var ch = $(" input[name='mytime[]']:checked").val();
//             var ch = $('input.'+element_class+":checked").val();
//             $('input.'+element_class+":checked").prop('checked', false);
//             console.log(ch);
            
//         });
        
//         // $('.sunday').click(function(){
//         //     var p_element = $(this);
//         //     $('select.sunday').prop('selectedIndex',0);
//         //     $('select.sunday').off('click');
            
//         //     console.log("select. ");
//         // });
        
//     });
    
//         $('.monday').on('change',function(){
//             var p_element = $(this).attr('id');
//             $('select.'+p_element).prop('selectedIndex',0);
//             $('select.'+p_element).attr('disabled', true);
//         })
//         $('.tuesday').on('change',function(){
//             var p_element = $(this).attr('id');
//             $('select.'+p_element).prop('selectedIndex',0);
//             $('select.'+p_element).attr('disabled', true);
//         })
//         $('.wednesday').on('change',function(){
//             var p_element = $(this).attr('id');
//             $('select.'+p_element).prop('selectedIndex',0);
//             $('select.'+p_element).attr('disabled', true);
//         })
//         $('.thursday').on('change',function(){
//             var p_element = $(this).attr('id');
//             $('select.'+p_element).prop('selectedIndex',0);
//             $('select.'+p_element).attr('disabled', true);
//         })
//         $('.friday').on('change',function(){
//             var p_element = $(this).attr('id');
//             $('select.'+p_element).prop('selectedIndex',0);
//             $('select.'+p_element).attr('disabled', true);
//         })
//         $('.saturday').on('change',function(){
//             var p_element = $(this).attr('id');
//             $('select.'+p_element).prop('selectedIndex',0);
//             $('select.'+p_element).attr('disabled', true);
//         })
//         $('.sunday').on('change',function(){
//             var p_element = $(this).attr('id');
//             $('select.'+p_element).prop('selectedIndex',0);
//             $('select.'+p_element).attr('disabled', true);
//            // $('select.'+p_element).remove();
//             //$('.sunday').find('select').find('option[value]').remove();
//             //console.log(p_element);
//         })
        
       
        
       
    
//     $("#close").click(function()
//     {
//         $("#my_account_modal").hide();
//         //location.reload();
//     });
//     $('#payment').change(function(){
//        var payment_typeValue = $('#payment_type').val();
//        $("#show_payment_type").show();
//        $(".select_pay").hide();
//        console.log(payment_typeValue);
//        var selectedPayment = $(this).children("option:selected", this).data("name");
//        $("#show_payment_type").append(" <div class='select_pay' style='display: inline-block'><span class=' languages_choosed_from_drop_down'>"+ selectedPayment +" </span> </div> ");
//     //    $("#container_payment").append("<input type='hidden' name='payment_type[]' value="+ payment_typeValue +">");
//    });
</script>


<script>
    // $(document).ready(function () {
    //     $(document).on('click', '.remove-lang , span.custom--help', function () {
    //         $(this).closest('.selecated_languages').remove();            
    //         $(this).closest('.custom-help-contain').toggleClass('help-note-toggle');
    //     });
	// });
</script>


@endpush