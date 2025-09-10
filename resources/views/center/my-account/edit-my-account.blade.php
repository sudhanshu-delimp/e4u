@extends('layouts.center')
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
            <div class="row">
              <div class="custom-heading-wrapper col-md-12">
                <h1 class="h1">My Accounts</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
               </div>
               <div class="col-md-12 mb-4">
                  <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                      <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <ol>
                          <li>Your Advertiser's Profile Information will pre-populate any Massage Profile you create.</li>
                          <li>Select your preferred method of contact by a Viewer for your Massage Profiles.</li>
                      </ol>
                    </div>
                  </div>              
                </div>
                <div class="col-md-12">
                    <div id="accordion" class="myacording-design">
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link collapsed" data-toggle="collapse" href="#about_me" aria-expanded="false">
                                About us
                                </a>
                            </div>
                            <div id="about_me" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body">
                                    <form id="userProfile" class="v-form-design" action="{{ route('center.account.update',[$escort->id])}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-10 px-0">
                                                <div class="row">
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                       <label for="membership_num">Membership Number</label>
                                                       <span class="form-control form-back">E60104</span>
                                                       
                                                    </div>
                                                 </div>
                                                 <div class="col-md-6">
                                                  <div class="form-group">
                                                     <label for="membership_num form-back">Date Joined</label>
                                                     
                                                     <label class="form-control form-back" placeholder=" " aria-describedby="emailHelp">24/06/2023</label>
                                                  </div>
                                               </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="Display Name" class="common_help_icon common-tooltip">Display Name
                                                              <img class="delay_tooltip tooltip-icon" src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}">
                                                              <span class="tooltip-text">Insert here the trading / business name of the Business.</span>
                                                                
                                                            </label>
                                                            <input type="text" class="form-control" placeholder=" " name="name" aria-describedby="emailHelp" value="{{ $escort->name }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                          <label for="Entity Name" class="common_help_icon common-tooltip">Entity Name
                                                            <img class="delay_tooltip tooltip-icon" src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}">
                                                          <span class="tooltip-text">What is the name of the corporate entity that owns the Business Name, like ABC Pty Ltd</span>
                                                            
                                                          </label>
                                                          <input type="text" class="form-control" placeholder=" " name="" aria-describedby="emailHelp" value="">
                                                      </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email" class="my-agent">Our Address </label>
                                                            <input type="text" class="form-control" placeholder=" " name="" aria-describedby="emailHelp" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <label type="text" class="form-control form-back" placeholder=" " name="email" aria-describedby="emailHelp" value="{{ $escort->email }}">{{ $escort->email }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="Business No.">Business No.</label>
                                                            <label type="text" class="form-control form-back" placeholder=" " name="phone" aria-describedby="emailHelp" value="{{ $escort->phone }}">{{ $escort->phone }}</label>
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="email">Mobile No.</label>
                                                          <label type="text" class="form-control form-back" placeholder=" " name="phone" aria-describedby="emailHelp" value="{{ $escort->phone }}">{{ $escort->phone }}</label>
                                                      </div>
                                                  </div>

                                                
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="Gender" class="my-agent common_help_icon common-tooltip">Home State
                                                              <img class="delay_tooltip tooltip-icon" src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}">
                                                              <span class="tooltip-text">This is the State you reside in. If you created your Account while you were in another State, log a <a href="{{ url('submit_ticket') }}">Support Ticket</a> and we will correct your setting.</span>
                                                            </label>
                                                            <label  class="form-control form-back" placeholder="Western Australia" aria-describedby="emailHelp" id="stateNew" name="state_id" value="{{$escort->state_id}}">
                                                              {{ $escort->state_id ? config('escorts.profile.states')[$escort->state_id]['stateName'] : ''}}
                                                          </label>
                                                            {{-- <select class="form-control" name="state_id">
                                                            @foreach(config('escorts.profile.states') as $key => $state)
                                                                <option value="{{$key}}" {{$key == $escort->state_id ? 'selected' : ''}}>{{$state['stateName']}}</option>
                                                            @endforeach
                                                            </select> --}}
                                                        </div>
                                                    </div>


                                                     <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">My Agent</label>
                                                            <label type="text" class="form-control form-back" placeholder=" " name="phone" aria-describedby="emailHelp" value="{{ $escort->my_agent ? $escort->my_agent->member_id : 'NA' }}">
                                                           
                                                              
                                                              @if(auth()->user()->my_agent)
                                                                {{ auth()->user()->my_agent->member_id }}
                                                              @else
                                                                  <a href="{{ url('/center-dashboard/agent-request') }}"> Request one</a>
                                                              @endif

                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                      <div class="form-group">
                                                        <label for="email">Method of contact:</label>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" checked  type="checkbox" name="contact_type[]" id="Method_Message" value="1"  @if(!empty($escort->contact_type)) {{(in_array(1 , $escort->contact_type)) ? 'checked' : null }} @endif>
                                                            <label class="form-check-label" for="Method_Message">Message (via Console)</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="contact_type[]" id="Method_Text" value="2"  @if(!empty($escort->contact_type)) {{(in_array(2 , $escort->contact_type)) ? 'checked' : null }} @endif>
                                                            <label class="form-check-label" for="Method_Text">Text</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="contact_type[]" id="Method_Email" value="3"  @if(!empty($escort->contact_type)) {{(in_array(3 , $escort->contact_type)) ? 'checked' : null }} @endif>
                                                            <label class="form-check-label" for="Method_Email">Email</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="contact_type[]" id="Method_call_me" value="4" @if(!empty($escort->contact_type)) {{(in_array(4 , $escort->contact_type)) ? 'checked' : null }} @endif>
                                                            <label class="form-check-label" for="Method_call_me">Call me</label>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                         <label for="PayID Name" class="common_help_icon common-tooltip">PayID Name
                                                            <img class="delay_tooltip tooltip-icon" src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}">
                                                         <span class="tooltip-text">Complete this information if you use PayID with your clients.</span>
                                                            
                                                         </label>
                                                         <input type="text" class="form-control" name="payID_name" placeholder="Insert your Bank Account name">
                                                      </div>
                                                   </div>
                                                   <div class="col-md-6">
                                                    <div class="form-group">
                                                       <label for="PayID Number">PayID Number</label>
                                                       <input type="text" class="form-control" name="paID_no" placeholder="Insert your PayID Number">
                                                    </div>
                                                 </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" value="save" class="btn btn-primary shadow-none float-right" name="submit">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link collapsed" data-toggle="collapse" href="#profile_and_tour_options" aria-expanded="false">
                                Profile contact options
                                </a>
                            </div>
                            <div id="profile_and_tour_options" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body">

                                    <form class="v-form-design" id="profile_tour_options" action="{{ route('center.account.profile.contact.update',[$escort->id])}}" method="POST">

                                        <div class="row">
                                            <div class="col-md-12">
                                              <div class="form-group">
                                                <label for="email">Profile creator settings</label><br>
                                                <div class="form-check form-check-inline">
                                                   <input name="profile_creator[]" class="form-check-input" type="checkbox" id="Method_Message" value="1" checked="">
                                                   <label class="form-check-label" for="Method_Message">Include Profile Information</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                   <input name="profile_creator[]" class="form-check-input" type="checkbox" id="Method_Text" value="2">
                                                   <label class="form-check-label" for="Method_Text">Include Profile Information and allow to over ride</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                   <input name="profile_creator[]" class="form-check-input" type="checkbox" id="Method_Email" value="3" checked="">
                                                   <label class="form-check-label" for="Method_Email">Include social media information</label>
                                                </div>
                                             </div>
                                                {{-- <div class="form-group">
                                                    <label for="email">How can Viewers contact me</label>
                                                    <div class="switch-sec">
                                                        <label class="switch">
                                                        <input type="checkbox" checked="">
                                                        <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                    <div class="pt-1"><i>When creating a Massage Profile, your Profile settings are by default set to your My Account information. You can over ride those settings in the Profile creator, or disable them here.
                                                        </i>
                                                    </div>
                                                </div> --}}
                                                <div class="form-group">
                                                    <label for="email">How can Viewers contact us</label><br>
                                                    <div class="form-check form-check-inline">
                                                        <input name="viewer_contact_type[]" class="form-check-input" type="checkbox" id="Method_Message" value="1" @if(!empty($escort->viewer_contact_type)) {{(in_array(1 , $escort->viewer_contact_type)) ? 'checked' : null }} @endif>
                                                        <label class="form-check-label" for="Method_Message">Call us</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                      <input class="form-check-input" name="viewer_contact_type[]" type="checkbox" id="Method_Email" value="3">
                                                      <label class="form-check-label" for="Method_Email">Email us (only for private communications with a Viewer)</label>
                                                   </div>
                                                    <div class="form-check form-check-inline">
                                                        <input name="viewer_contact_type[]" class="form-check-input" type="checkbox" id="Method_Text" value="2" @if(!empty($escort->viewer_contact_type)) {{(in_array(2 , $escort->viewer_contact_type)) ? 'checked' : null }} @endif>
                                                        <label class="form-check-label" for="Method_Text">Text us</label>
                                                    </div>
                                                    {{-- <div class="pt-1"><i>You can select both options if you want.</i></div> --}}
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <input type="submit" value="Save" class="btn btn-primary shadow-none float-right" name="submit">
                                    </form>
                                </div>
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
    
    $('#userProfile').on('submit', function(e) {
      e.preventDefault();
    
      var form = $(this);
      $("#modal-title").text("Abou Us");
      $("#modal-icon").attr("src", "/assets/dashboard/img/info.png");
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
              var msg = "Saved";
              $('.comman_msg').html(msg);
              $("#comman_modal").modal('show');
              //$("#my_account_modal").show();
              
              //
            } else {
              $('.Lname').html("Oops.. sumthing wrong Please try again");
              var msg = "Oops.. sumthing wrong Please try again";
              $('.comman_msg').html(msg);
              $("#comman_modal").modal('show');
    
            }
          },
    
        });
      }
    });
    $("#close").click(function()
      {
          $("#my_account_modal").hide();
          location.reload();
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

    /////////////////////
  $('#profile_tour_options').on('submit', function(e) {
      e.preventDefault();
    
        var form = $(this);
        
      $("#modal-title").text("Profile Contact Options");
      $("#modal-icon").attr("src", "/assets/dashboard/img/info.png");
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
      
    });   
</script>
@endpush