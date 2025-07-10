@extends('layouts.userDashboard')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<style type="text/css">
    .parsley-errors-list {
    list-style: none;
    color: rgb(248, 0, 0)
    }

    .help_center a{
     color:#FF3C5F;
     font-size: 16px;
    }

     .help_center a:hover {
      text-decoration:underline;
    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5">
    
    <!--middle content end here-->
     <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="v-main-heading h3 mb-2 pt-4 d-flex align-items-center"><h1 class="p-0">My Account</h1>
        <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></h6>
    </div>
 </div>



<div class="row">
    <div class="col-md-12 my-2">
        <div class="card collapse" id="notes" style="">
          <div class="card-body help_center">
              <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
              <ol>
                <li>Use this feature to complete all of your personal details - who you are, contact information how Users communicate with you.</li>
                <li>Make sure you take the time to complete everything, it will help you manage your Account much better, especially with communication. 
                  If you are not sure about any of the settings, get in touch with our <a href="./submitticket"  >Help Centre.</a></li>
                <li>There is some general information also available to you inside each of the My Account groups.</li>
            </ol>
          </div>
        </div>
    </div>
</div>



<!-- Page Heading -->
    <div class="row">
        <div class="col-md-12 mt-2 mb-5">
            <div id="accordion" class="myacording-design">
                <div class="card">
                    <div class="card-header">
                        <h2 class="primery_color normal_heading"><b>About me</b></h2>
                         
                    </div>
                    <div id="about_me" class="collapse show" data-parent="#accordion" style="">
                        <div class="card-body mt-3">
                            <form id="userProfile" class="v-form-design" action="{{ route('user.account.update',[$user->id])}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-10 px-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="membership_num">Membership Number</label>
                                                    <span class="form-control form-back" >{{ $user->memberId }}</span>
                                                    {{-- <input type="number" class="form-control" id="membership_num" placeholder="E123456" aria-describedby="emailHelp"> --}}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="membership_num">Date Joined</label>
                                                    {{-- <input type="date" class="form-control" placeholder=" " aria-describedby="emailHelp"> --}}
                                                    <label class="form-control form-back" placeholder=" " aria-describedby="emailHelp">{{Carbon\Carbon::parse($user->created_at)->format('d/m/Y')}}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="my_name" class="my-agent">My Name <img src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}"></label>
                                                    <input type="text" class="form-control" name="name" placeholder="Jane Doe" aria-describedby="emailHelp" value="{{ $user->name }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Gender" class="my-agent">Gender <img src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}"> </label>
                                                    <select class="form-control" name="gender">
                                                        <option>Select</option>
                                                        @foreach(config('escorts.profile.genders') as $key => $gender)
                                                        <option value="{{$key}}" {{ ($user->gender == $key)? 'selected' : ''}}>{{$gender}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mobile">Mobile</label>
                                                    <span class="form-control form-back">{{ $user->phone }}</span>
                                                    {{-- <input type="number" class="form-control" placeholder="+61 4.." name="phone" aria-describedby="emailHelp" value="{{$user->phone}}"> --}}
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="home_state">Home State</label>
                                                    <label  class="form-control form-back" placeholder="Western Australia" aria-describedby="emailHelp" id="stateNew" name="state_id" value="{{$user->state_id}}">{{config('escorts.profile.states')[$user->state_id]['stateName']}}</label>
                                                    {{-- <select class="form-control" placeholder="Western Australia" aria-describedby="emailHelp" id="stateNew" name="state_id" data-parsley-errors-container="#state-errors" required data-parsley-required-message="Select country">
                                                    @foreach( as $key => $state)
                                                    <option value="{{ $key}}" {{$user->state_id == $key ? 'selected' : ''}}>{{ $state['stateName'] }}</option>
                                                    @endforeach
                                                    </select> --}}
                                                    
                                                    <span id="state-errors"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Email <img src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}"></label>
                                                    {{-- @if(!empty($user->email))
                                                    <span class="form-control">{{$user->email}}</span>
                                                    @else
                                                    <input type="text" class="form-control" placeholder="JaneDoe@domain.com.au" name="email" aria-describedby="emailHelp" value="{{$user->email}}">
                                                    @endif --}}
                                                    
                                                    <label type="text" class="form-control form-back" placeholder="JaneDoe@domain.com.au" name="email" aria-describedby="emailHelp" >{{$user->email}}</label>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="my-agent" for="my_agent">My Agent</label>
                                                    <span class="form-control">{{ $user->escortsAgent ? $user->escortsAgent->name : '' }} - Agent ID: {{ $user->escortsAgent ? $user->escortsAgent->id : '' }}</span> 
                                                </div>
                                            </div> 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Method of contact - how we communicate with you</label><br>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="contact_type[]" id="Method_Message" value="1"  @if(!empty($user->contact_type)) {{(in_array(1 , $user->contact_type)) ? 'checked' : null }} @endif>
                                                        <label class="form-check-label" for="Method_Message">Message (via Console)</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="contact_type[]" id="Method_Text" value="2"  @if(!empty($user->contact_type)) {{(in_array(2 , $user->contact_type)) ? 'checked' : null }} @endif>
                                                        <label class="form-check-label" for="Method_Text">Text</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="contact_type[]" id="Method_Email" value="3"  @if(!empty($user->contact_type)) {{(in_array(3 , $user->contact_type)) ? 'checked' : null }} @endif>
                                                        <label class="form-check-label" for="Method_Email">Email</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="contact_type[]" id="Method_call_me" value="4" @if(!empty($user->contact_type)) {{(in_array(4 , $user->contact_type)) ? 'checked' : null }} @endif>
                                                        <label class="form-check-label" for="Method_call_me">Call me</label>
                                                    </div>
                                                </div>
                                            </div>--}}
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" value="save" class="btn btn-primary shadow-none float-right" name="submit">
                            </form>
                        </div>
<!--                         <div class="card-body">
                            <div id="accordion-2">
                                <div class="card">
                                    <div class="card-header" id="heading-1-2">
                                        <h5 class="mb-0">
                                            <a class="card-link collapsed" data-toggle="collapse" href="#collapse-1-2" aria-expanded="false">
                                            Important information 
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapse-1-2" class="collapse" data-parent="#accordion-2" aria-labelledby="heading-1-2" style="">
                                        <div class="card-body">
                                            <h5>General information</h5>
                                            <ol class="pl-3">
                                                <li>The information set out on this page is mandatory.</li>
                                                <li>
                                                    When you create a Profile
                                                    <ul>
                                                        <li>your name will appear in the Profile by default. You can change your name in the Profile to a Stage Name at anytime by selecting it from the drop down menu in the Profile creator, or by editing a saved Profile from your Archive Folder.</li>
                                                        <li>it will always default to your Home State unless you change the Location while creating the Profile by selecting the Location you want the Profile to appear in from the drop down menu in the Profile creator.</li>
                                                    </ul>
                                                </li>
                                                <li>If you select ‘Message’ as your preferred method of contact with us, you will receive a text message from us advising that you have a Message waiting for you. Log on to retrieve the message.</li>
                                                <li>If you have any queries regarding your appointed Agent, contact the Escorts4U help centre by raising a Support Ticket. Please include the Agent ID number. </li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
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
              console.log(data);
            if (data.error == true) {
              $('.comman_msg').html("Saved");
              //$("#my_account_modal").modal('show');
              //$("#my_account_modal").show();
              $("#comman_modal").modal('show');
             
            } else {
              $('.comman_msg').html("Oops.. sumthing wrong Please try again");
              $("#comman_modal").show();
    
            }
          },
    
        });
      }
    });
    // $("#close").click(function()
    //   {
    //       $("#my_account_modal").hide();
    //       location.reload();
    //   });
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