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

                <div class="col-lg-12">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <div class="custom-heading-wrapper">
                            <h1 class="h1">Profile Information </h1>
                            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span> </h6>
                        </div>
                        @if (request('from') == 'dashboard')
                            <div class="back-to-dashboard">
                                <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                                    <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-12 mb-4">
                    <div class="card collapse" id="notes" >
                        <div class="card-body">
                           <h3 class="NotesHeader"><b>Notes:</b></h3>
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
                        <div class="card common-card">
                            <div class="card-header">
                                <a class="card-link collapsed" data-toggle="collapse" href="#additional_information" aria-expanded="false">
                                Additional information about us
                                </a>
                            </div>
                            <div id="additional_information" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body">
                                    <div class="tab-pane fade show active" id="aboutme" role="tabpanel" aria-labelledby="home-tab">
                                        <form id="update_about_me" class="common-form" action="{{ route('center.update-massage-profile') }}" method="POST" enctype="multipart/form-data" novalidate="">
                                            @csrf 
                                            <div class="row inner-row">
                                                <div class="col-lg-12">
                                                    <div class="card-top">
                                                        <div class="card-icon">
                                                            <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                                                </g>

                                                                <g id="SVGRepo_iconCarrier">

                                                                    <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>

                                                                    <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>

                                                                </g>

                                                            </svg>
                                                        </div>
                                                        <div class="card-heading">
                                                            <h2>About Us</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="inner-field-row">
                                                        <div class="form-group ">
                                                            <label  for="exampleFormControlSelect1">
                                                            Building<span style="color:red">*</span></label>
                                                        
        
                                                                    <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="building" required>
                                                                    <option value="" selected="">-- Not Set --</option>
                                                                    @foreach(config('escorts.profile.Building') as $key =>$buldingName)
                                                                    <option value="{{$key}}" {{ ($massage_profile->building == $key)? 'selected' : ''}}>{{$buldingName}}</option>
                                                                    @endforeach
                                                                </select>
                                                        </div>
                                                    
                                                        <div class="form-group ">
                                                            <label  for="exampleFormControlSelect1">Parking</label>
                                                        
                                                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="parking">
                                                                    <option value="" selected="">-- Not Set --</option>
                                                                
                                                                    @foreach(config('escorts.profile.Parking') as $key =>$ParkingName)
                                                                    <option value="{{$key}}" {{ ($massage_profile->parking == $key)? 'selected' : ''}} >{{$ParkingName}}</option>
                                                                    @endforeach
                                                                </select>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label  for="exampleFormControlSelect1">Entry</label>
                                                        
                                                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="ethnicity" name="entry">
                                                                    <option value="" selected="">-- Not Set --</option>
                                                                    
                                                                    @foreach(config('escorts.profile.Entry') as $key =>$EntryName)
                                                                    <option value="{{$key}}" {{ ($massage_profile->entry == $key)? 'selected' : ''}}>{{$EntryName}}</option>
                                                                    @endforeach
                                                                </select>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label  for="exampleFormControlSelect1">Type</label>
                                                        
                                                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="furniture_types" name="furniture_types">
                                                                    <option value="" selected="">-- Not Set --</option>
                                                                    @foreach(config('escorts.profile.furniture_types') as $key =>$furniture_type)
                                                                    <option value="{{$key}}" {{ ($massage_profile->furniture_types == $key)? 'selected' : ''}} >{{$furniture_type}}</option>
                                                                    @endforeach
                                                                </select>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label  for="exampleFormControlSelect1">
                                                            Shower</label>
                                                        
                                                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="shower">
                                                                    <option value="" selected="">-- Not Set --</option>
                                                                    @foreach(config('escorts.profile.Shower') as $key =>$Type)
                                                                    <option value="{{$key}}" {{ ($massage_profile->shower == $key)? 'selected' : ''}} >{{$Type}}</option>
                                                                    @endforeach
                                                                </select>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label  for="exampleFormControlSelect1">Ambiance</label>
                                                        
                                                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="ambiance">
                                                                    <option value="" selected="">-- Not Set --</option>
                                                                    @foreach(config('escorts.profile.Ambiance') as $key =>$AmbianceName)
                                                                    <option value="{{$key}}" {{ ($massage_profile->ambiance == $key)? 'selected' : ''}} >{{$AmbianceName}}</option>
                                                                    @endforeach
                                                                </select>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label  for="exampleFormControlSelect1">Security</label>
                                                        
                                                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="securityss" name="security">
                                                                    <option value="" selected="">-- Not Set --</option>
                                                                    @foreach(config('escorts.profile.Security') as $key =>$SecurityName)
                                                                    <option value="{{$key}}" {{ ($massage_profile->security == $key)? 'selected' : ''}} >{{$SecurityName}}</option>
                                                                    @endforeach
                                                                </select>
                                                            
                                                        </div>
                                                        <div class="form-group ">
                                                            <label  for="exampleFormControlSelect1">Payment</label>
                                                        
                                                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="payment" name="payment">
                                                                    <option value="" selected="">-- Not Set --</option>
                                                                    @foreach(config('escorts.profile.Payments') as $key =>$PaymentType)
                                                                    <option value="{{$key}}" {{ ($massage_profile->payment == $key)? 'selected' : ''}} data-name="{{ $PaymentType }}">{{$PaymentType}}</option>
                                                                    @endforeach>
                                                                </select>
                                                            
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
                                                        <div class="form-group ">
                                                            <label  for="exampleFormControlSelect1">Loyalty program
                                                            </label>
                                                        
                                                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="ethnicity" name="loyalty">
                                                                    <option value="" selected="">-- Not Set --</option>
                                                                    @foreach(config('escorts.profile.Loyalty') as $key =>$LoyaltyType)
                                                                    <option value="{{$key}}" {{ ($massage_profile->loyalty == $key)? 'selected' : ''}} >{{$LoyaltyType}}</option>
                                                                    @endforeach>
                                                                </select>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label  for="exampleFormControlSelect1">Languages
                                                            </label>
                                                        
                                                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="language" name="languages">
                                                                    <option value="" selected="">-- Not Set --</option>
                                                                    @foreach(config('escorts.profile.languages') as $key =>$language)
                                                                    <option value="{{$key}}" {{ ($massage_profile->language == $key)? 'selected' : ''}} data-name="{{ $language }}">{{$language}}</option>
                                                                    @endforeach>
                                                                </select>
                                                                @if(!empty($massage_profile->language)) 
                                                                    <div style="display:flex;margin-top: 5px;">
                                                                            @foreach($massage_profile->language as $language)
                                                                        
                                                                            <div class='selecated_languages select_lang'>
                                                                                <span class='languages_choosed_from_drop_down'>{!!config("escorts.profile.languages.$language") !!} <small class='remove-lang'>×</small></span>
                                                                                
                                                                            </div>
                                                                            @endforeach 
                                                                    </div>
                                                                @endif
                                                                <div id="container_language">
                                                                </div>
                                                                <div id="show_language" style="display:none">
                                                                </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label  for="exampleFormControlSelect1">Contact us
                                                            </label>
                                                        
                                                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="contact" name="contact">
                                                                    <option value="" selected="">-- Not Set --</option>
                                                                    @foreach(config('escorts.profile.contact-me') as $key =>$contact)
                                                                    <option value="{{$key}}"   {{ ($massage_profile->contact == $key)? 'selected' : ''}} >{{$contact}}</option>
                                                                    @endforeach>
                                                                </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 text-right common-footer">
                                                        <input type="hidden" name="type" id="type" value="about_us">
                                                        <input type="hidden" name="massage_id" id="massage_id" value="{{$massage_profile->id}}">
                                                        <button id="read-more" type="submit" class="save_profile_btn common-save-btn">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                        


                        <div class="card custom-help-contain common-card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-toggle="collapse" href="#my_available_times">
                                Our open times
                                </a>
                            </div>
                            <div id="my_available_times" class="collapse" data-parent="#accordion">
                                <div class="card-body">                                    
                                    @include('center.my-account.partials.available-dash-tab')
                                </div>
                            </div>
                        </div>


                        <div class="card custom-help-contain common-card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-toggle="collapse" href="#my_rates">
                                Our rates
                                </a>
                            </div>
                            <div id="my_rates" class="collapse" data-parent="#accordion">
                                
                                <div class="card-body">
                                    
                                    @include('center.my-account.partials.rate-dash-tab')
                                   
                                </div>
                            </div>
                        </div>


                    <div class="card custom-help-contain common-card">
                        <div class="card-header">
                            <a class="collapsed card-link" data-toggle="collapse" href="#my_service_tags">
                            Our service (tags)
                            </a>
                        </div>
                        <div id="my_service_tags" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="about_me_drop_down_info ">
                                        <form id="myProfileServiceForm" class="common-form" name="myProfileServiceForm" action="{{route('center.update-massage-profile')}}" method="POST" enctype="multipart/form-data">
                                            @csrf    
                                            <div class="row inner-row">
                                                <div class="col-lg-12">
                                                    <div class="card-top">
                                                        <div class="card-icon">
                                                            <svg width="64px" height="64px" viewBox="0 0 33 33" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>tag-2</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-360.000000, -774.000000)" fill="#ff3c5f"> <path d="M390.097,789.321 C390.097,789.849 389.611,790.623 389.095,791.139 L378.823,801.378 L365.634,788.197 L375.89,777.974 C376.36,777.504 377.111,776.903 377.641,776.903 L389.139,776.903 C389.668,776.903 390.097,777.331 390.097,777.858 L390.097,789.321 L390.097,789.321 Z M375.89,804.304 C375.079,805.111 373.765,805.111 372.955,804.304 L362.684,794.063 C361.873,793.256 361.873,791.946 362.684,791.139 L364.166,789.66 L377.341,802.856 L375.89,804.304 L375.89,804.304 Z M390.097,774.993 L376.683,774.993 C375.624,774.993 375.431,775.455 374.422,776.511 L361.217,789.676 C359.596,791.291 359.596,793.911 361.217,795.526 L371.487,805.767 C373.108,807.382 375.735,807.382 377.356,805.767 L390.563,792.602 C391.412,791.754 392.014,791.332 392.014,790.276 L392.014,776.903 C392.014,775.849 391.155,774.993 390.097,774.993 L390.097,774.993 Z M383.959,786.019 C383.148,786.826 381.835,786.826 381.024,786.019 C380.214,785.211 380.214,783.901 381.024,783.093 C381.835,782.285 383.148,782.285 383.959,783.093 C384.77,783.901 384.77,785.211 383.959,786.019 L383.959,786.019 Z M379.558,781.63 C377.937,783.246 377.937,785.865 379.558,787.481 C381.178,789.097 383.806,789.097 385.427,787.481 C387.047,785.865 387.047,783.246 385.427,781.63 C383.806,780.015 381.178,780.015 379.558,781.63 L379.558,781.63 Z" id="tag-2" sketch:type="MSShapeGroup"> </path> </g> </g> </g></svg>
                                                        </div>
                                                        <div class="card-heading">
                                                            <h2>My Services <span class="custom--help"><b>Help?</b></span></h2>
                                                        </div>
                                                    </div>
                                                    <div class="custom-note-section">
                                                        <div class="card">
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
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="inner-field-row">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlSelect1">Massage services </label>
                                                            
                                                                <select class="form-control select_tag_remove_box_sadow" id="service_id_one">
                                                                    <option value="" selected="" disable="">--Select--</option>
                                                                    @foreach(config('escorts.profile.massage-services') as $key =>$services)
                                                                        @if(! in_array($key, $massage_profile->massage_services()->pluck('service_id')->toArray()))
                                                                            <option id="{{ $services}}" value="{{$key}}" >{{$services}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                    
                                                                </select>
                                                                <div class="manage_tag_style">
                                                                    <ul id="selected_service_one">
                                                                        {{-- @foreach ($massage_profile->services()->where('category_id', 1)->get() as $value) --}}
                                                                        @foreach ($massage_profile->massage_services()->where('category_id', 1)->get() as $value)
                                                                            <li class="mb-2" id="hideenclassOne_{{$value->service_id}}">
                                                                                <div class='my_service_anal hideenclassOne{{$value->id}}'>
                                                                                    <span class="dollar-sign">
                                                                                    {{config('escorts.profile.massage-services')[$value->service_id]  }}
                                                                                    </span>
                                                                                    <input type='number' class='dollar-before input_border' name='price[]' placeholder='' value="{{ (int) $value->price}}" min=0 step=10 max=200>
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
                                                        <div class="form-group">
                                                            <label for="exampleFormControlSelect1">Other service types </label>
                                                        
                                                            <select class="form-control  select_tag_remove_box_sadow" id="service_id_two">
                                                                <option value="" selected="" disable="">--Select--</option>
                                                                @foreach(config('escorts.profile.other-services') as $key =>$services)
                                                                    @if(! in_array($key, $massage_profile->massage_services()->pluck('service_id')->toArray()))
                                                                        <option id="{{ $services}}" value="{{$key}}" >{{$services}}</option>
                                                                    @endif
                                                                @endforeach
                                                                
                                                            </select>
                                                            <div class="manage_tag_style">                                                            
                                                                <ul id="selected_service_two">
                                                                    @foreach ($massage_profile->massage_services()->where('category_id', 2)->get() as $value)
                                                                        <li class="mb-2" id="hideenclassTwo_{{$value->service_id}}">
                                                                            <div class='my_service_anal hideenclassTwo{{$value->id}}'>
                                                                                <span class="dollar-sign">
                                                                                {{config('escorts.profile.other-services')[$value->service_id]  }}
                                                                                </span>
                                                                                <input type='number' class='dollar-before input_border' name='price[]' placeholder='' value="{{ (int) $value->price}}" min=0 step=10 max=200>
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
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 text-right common-footer">
                                                    <input type="hidden" name="type" id="type" value="service">
                                                    <input type="hidden" name="massage_id" id="massage_id" value="{{$massage_profile->id}}">
                                                    <button id="read-more" type="submit" class="save_profile_btn common-save-btn">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card custom-help-contain common-card">
                        <div class="card-header">
                            <a class="collapsed card-link" data-toggle="collapse" href="#my_social_media">
                                Our Social Media
                            </a>
                        </div>
                        <div id="my_social_media" class="collapse" data-parent="#accordion">
                            <div class="card-body ">                                
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

             
            resetUnsavedChanges();

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



    $('#language').change(function(){
        var languageValue = $('#language').val();
        $("#show_language").show();
        $(".select_lang").hide();
        var selectedLanguage = $(this).children("option:selected", this).data("name");
        $("#show_language").append("  <div class='selecated_languages' style='display: inline-block'><span class='languages_choosed_from_drop_down'>"+ selectedLanguage +" <small class='remove-lang'>×</small></span> </div> ");
        $("#container_language").append("<input type='hidden' name='language[]' value="+ languageValue +">");
        $("#language option[value='"+languageValue+"']").remove();
    });




$(document).on('input', '.allow_only_numeric', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
});


 //////////// For Our Service (Tags)  /////////////////////
$('body').on('click', '.akh1', function() {
var id = $(this).attr('id');
var val = $(this).data('val');
var name = $(this).data('sname');
$('#hideenclassOne_'+val).remove();

$("#service_id_one").append("<option id='"+name+"' value='"+val+"'>"+name+"</option>"); 
console.log("click "+name);
});

$('body').on('click', '.akh2', function() {
var id = $(this).attr('id');
var val = $(this).data('val');
var name = $(this).data('sname');
$('#hideenclassTwo_'+val).remove();

$("#service_id_two").append("<option id='"+name+"' value='"+val+"'>"+name+"</option>"); 
console.log("click "+name);
console.log("id= "+id);
console.log("val= "+val);
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


</script>


@endpush