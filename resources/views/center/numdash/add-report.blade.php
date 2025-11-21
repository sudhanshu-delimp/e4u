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
    .parsley-type {
        color: #e5365a;
        text-transform: capitalize;
        font-size: small;
    }
</style> 
@endsection 
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content start here-->
   <div class="row">
    <div class="col-md-12 custom-heading-wrapper">
        <h1 class="h1">Add Report</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
      </div>
      <div class="col-md-12 mv-4">
         <div class="row collapse" id="notes">
            <div class="col-md-12 mb-4">
               <div class="card">
                  <div class="card-body">
                     <p><b>Notes:</b> </p>
                     <ol>
                        <li>
                          The NUM register (NUM) is a free service to all Escorts. You can use the NUM service
                          at any time.
                        </li>
                        <li>
                          Complete the form to add an incident to the NUM. When completing the form please
                          ensure all of the details are correct and you have selected the correct option under
                          <strong>Incident Nature</strong> to describe the incident as well as for Rating. Please ensure your report
                          complies with the <strong><a href="{{ route('escort.code-of-conduct') }}" class="custom_links_design">Code of Conduct</a></strong>.
                        </li>
                        <li>
                          The NUM is a closed publication for Escorts only. Each entry contains personal reports,
                          provided by Escorts, of incidents involving problem clients. The NUM makes these
                          reports available to help other Escorts avoid problem clients, and as an extension of
                          the “word of mouth” warnings given by Escorts between each other.
                        </li>
                        <li>
                          Incident Nature filter meanings:
                          <ol class="level-2">
                            <li><strong>Time waster:</strong> A client who did not turn up at an agreed time, or keeps
                            putting off the appointment, promising to come at a later time but never turns up.</li>
                            <li><strong>Con man:</strong> A client that did not pay you for the agreed time for your
                            companionship.</li>
                            <li><strong>Dangerous:</strong> A client who is aggressive toward you, usually language based,
                            or undertakes dangerous behaviour such as using drugs in your presence.</li>
                            <li><strong>Assault:</strong> A client who has assaulted you.</li>
                            </ol>
                        </li>
                        <li>
                          E4U makes no claims:
                          <ol class="level-2">
                            <li>as to the accuracy or legitimacy of the allegations; and</li>
                            <li>nor do we investigate the authenticity of the Reports (provided in confidence by Escorts).</li>
                          </ol>
                        </li>
                      </ol>                      
                  </div>
               </div>
            </div>
         </div>
         <!-- Report Form -->
         <div class="row">
            <div class="col-md-9 add-punterbox-report">
               <form id="ugly_mug_registration" enctype="multipart/form-data" method="POST" action="route('escort.store-report')">
                  <div class="form-group">
                      <label class="required">Incident Date</label>
                      <input type="date" class="form-control" name="incident_date">
                  </div>
                    {{-- <div class="col-lg-6">
                        <div class="form-group row"> 
                            <label class="col-sm-4" for="exampleFormControlSelect1"><span style="color:red">* </span>Stage Name:</label>
                            <div class="col-sm-6">
                                <input type="txt" class="form-control form-control-sm removebox_shdow" placeholder="Name" required name="name" value="" data-parsley-required-message="Please enter name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4" for="exampleFormControlSelect1"><span style="color:red">* </span> State:</label>
                            <div class="col-sm-6">
                                <select class="form-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp" id="stateId" name="state_id" data-parsley-errors-container="#state-errors" required data-parsley-required-message="Select State">
                                    <option value="">-Select-</option>
                                    @foreach(config('escorts.profile.states') as $key => $state)
                                    <option value="{{$key}}">{{ $state['stateName'] }}</option>
                                    @endforeach
                                </select>
                                <span id="state-errors"></span>
                            </div>
                        </div>
                    </div> --}}
                  <div class="form-group">
                      <label class="required">Incident State</label>
                      <select class="custom-select" name="incident_state" >
                        <option selected>Please Choose</option>
                        @foreach ($states as $key => $state)
                              <option value="{{ $key }}" {{$key == auth()->user()->state_id ? 'selected' : ''}}>{{ $state['stateName'] }}</option>
                        @endforeach
                          </select>
                  </div>
      
                  <div class="form-group">
                      <label class="required">Incident Location</label>
                      <input type="text" class="form-control" name="incident_location" placeholder="Which city were you in">
                  </div>
      
                  <div class="form-group">
                      <label>Offender's Name</label>
                      <input type="text" class="form-control" name="offender_name" placeholder="If known">
                  </div>
      
                  <div class="form-group">
                      <label class="required">Offender's Mobile</label>
                      <input type="number" class="form-control" min="8" name="offender_mobile" placeholder="No spaces or any other characters - just numbers">
                  </div>
      
                  <div class="form-group">
                      <label>Offender's Email</label>
                      <input type="email" class="form-control" name="offender_email" placeholder="If known">
                  </div>
      
                  <div class="form-group">
                      <label class="required">Incident Type</label>
                      <select class="custom-select" name="incident_nature">
                        <option value="Time Waster" >Time Waster</option>
                        <option value="Con Man">Con Man</option>
                        <option value="Dangerous">Dangerous</option>
                        <option value="Assault">Assault</option>
                     </select>
                  </div>
      
                  {{-- <div class="form-group">
                      <label>Platform</label>
                      <input type="text" class="form-control" name="platform" placeholder="If known">
                  </div>
      
                  <div class="form-group">
                      <label>Profile Link</label>
                      <input type="text" class="form-control" name="profile_link" placeholder="Link or Membership ID or Ref">
                  </div> --}}
      
                  <div class="form-group">
                      <label class="required">What Happened</label>
                      <textarea class="form-control" name="what_happened" rows="4"></textarea>
                  </div>
      
                  <div class="form-group">
                      <label class="required d-block">Rating</label>
                      <div class="form-check d-flex align-items-center">
                          <input class="form-check-input" checked type="radio" name="rating" value="Do Not Book" id="rate1">
                          <label class="form-check-label" for="rate1">Do Not book</label>
                      </div>
                      <div class="form-check d-flex align-items-center">
                          <input class="form-check-input" type="radio" name="rating" value="Exercise Caution" id="rate2">
                          <label class="form-check-label" for="rate2">Exercise caution</label>
                      </div>
                      <div class="form-check d-flex align-items-center">
                          <input class="form-check-input" type="radio" value="Safe" name="rating" id="rate3">
                          <label class="form-check-label" for="rate3">Safe</label>
                      </div>
                  </div>
      
                  <button type="submit" class="save_profile_btn">Add Report</button>
                  <small class="d-block mt-2">Your report will remain <em>Pending</em> until approved by our Operations team.</small>
              </form>
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

<script>
    
    $("#ugly_mug_registration").on('submit', function(e){
        e.preventDefault();

        var form = $(this);
        if (form) {
            $("#submit").hide();
            $(".spinner-border").attr('hidden', false);
            var url = "{{route('center.store-report')}}";
            var data = new FormData(form[0]);
            $.ajax({
                method: 'POST',
                url: url,
                dataType: "json",
                data: data,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log('data', data);
                    
                    if (data.status) {
                        swal.fire(
                            'Ugly mug registration',
                            'Mug registered successfully',
                            'success'
                        );
                        form[0].reset();
                    } else {
                        swal.fire(
                            'Ugly mug registration',
                            'Oops.. something wrong Please try again',
                            'error'
                        );
                    }
                    $(".spinner-border").attr('hidden', true);
                    $(".error_text").text('');
                    $("#submit").show();
                },
                error: function(xhr){
                    console.log(xhr.status, );
                    
                    if(xhr.status === 422){
                        let errors = JSON.parse(xhr.responseText).errors;
                        $('.error-text').remove(); // remove old errors
                        $.each(errors, function(key, value){
                            let input = $('[name="'+key+'"]');
                            input.after('<span class="text-danger error-text error_text">'+value[0]+'</span>');
                        });
                    } else {
                        swal.fire(
                            'Ugly mug registration',
                            'Oops.. something wrong Please try again',
                            'error'
                        );
                    }
                }

            });
        }
    });
</script>
@endpush
