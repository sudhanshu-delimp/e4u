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
   
   {{-- Page Heading   --}}
   <div class="row">
      <div class="d-flex align-items-center justify-content-start mt-5 flex-wrap col-lg-12">
          <h1 class="h1">Report a Mug</h1>
          <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
      </div>
      <div class="col-md-12 my-2">
          <div class="card collapse" id="notes" style="">
          <div class="card-body">
              <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
              <ol>
                  <li>
                     The National Ugly Mugs register (<b>NUM</b>) is a free service to all Advertisers. You can
                     use the NUM service at any time.
                  </li>
                  <li>
                        If you have enabled, under your <a href="{{route('escort.profile.notifications')}}" class="termsandconditions_text_color custom_links_design">Account</a> settings, to be notified when a new listing
                        is added to the NUM, you are charged a monthly Fee.
                  </li>
                  <li>
                        Complete the form to add an incident to the NUM. When completing the form
                        please ensure all of the details are correct and you have selected the correct option
                        to describe the incident.
                  </li>
                  <li>The NUM is a closed publication for Advertisers only. Each entry contains personal
                        reports, provided by the Advertiser, of incidents involving problem clients. The
                        NUM makes these reports available to help other Advertisers avoid problem clients,
                        and as an extension of the "word of mouth" warnings given by Advertisers between
                        each other.</li>
                  <li>
                        Escorts4U makes no claims:
                        <ol type="a" class="ol_lower_alpha_bracket">
                           <li>as to the accuracy or legitimacy of the allegations; and</li>
                           <li>nor do we investigate the authenticity of the reports (provided in confidence by
                              Advertisers)</li>
                        </ol>
                  </li>
                  <li>The NUM is not to be used to make a complaint about another Advertiser.</li>
              </ol>
          </div>
          </div>
      </div>
  </div>
  {{-- end --}}
   <div class="row">
      <div class="col-md-12 mt-4 mb-5">
         <form id="ugly_mug_registration" class=" ">
            <div class="row">
               <div class="col-md-7">
                  <h3><b>Make a report:</b></h3>
                  <div class="pl-4">
                      <div class="form-group w-75">
                          <label for="incident_date"><b>When did this happen?</b><span style="color:red">*</span></label>
                          <input id="incident_date" name="incident_date" type="text" data-options="maxDate:+0d" class="form-control date-picker" data-parsley-required="true" data-parsley-required-message=" Please select incident date">
                      </div>
                      <div class="form-group w-75">
                          <label for="place_name"><b>Where did this happen?</b> </label>
                          <input id="place_name" placeholder="Where did this happen?" name="place_name" type="text" class="form-control">
                      </div>
                      <div class="form-group w-75">
                          <label for="offenders_email"><b>Offenders Email</b></label>
                          <input id="offenders_email" placeholder="Offenders Email" name="email" type="email" class="form-control" data-parsley-type="email" data-parsley-type-message="Type a valid email" data-parsley-trigger="focusout">
                      </div>
                      <div class="form-group w-75">
                          <label for="offenders_name"><b>Offenders Name</b></label>
                          <input id="offenders_name" placeholder="Offenders Name" name="name" type="text" class="form-control">
                      </div>
                      <div class="form-group w-75">
                          <label for="offenders_mobile"><b>Offenders Mobile</b> <span style="color:red">*</span></label>
                          <input id="offenders_mobile" placeholder="Offenders Mobile" name="mobile" type="text" class="form-control" data-parsley-required="true" data-parsley-required-message="Please enter Offenders Mobile">
                      </div>
                      <div class="form-group w-75">
                          <label for="explain_incident"><b>What happened?</b></label>
                          <textarea id="explain_incident" name="explain_incident" class="form-control" placeholder="Max 500 Characters..." rows="3"></textarea>
                      </div>
                      <div class="form-group w-75">
                          <input id="submit" type="submit" value="Submit Report" class="new-btn-sec btn btn-primary shadow-none" name="submit">
                          <div class="spinner-border" hidden></div>
                      </div>
                  </div>
               </div>
            </div>
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

<script>
    $('#ugly_mug_registration').parsley({});

    $("#ugly_mug_registration").on('submit', function(e){
        e.preventDefault();

        var form = $(this);
        if (form.parsley().isValid()) {
            $("#submit").hide();
            $(".spinner-border").attr('hidden', false);
            var url = "{{route('escort.numdashboard')}}";
            var data = new FormData(form[0]);
            $.ajax({
                method: 'GET',
                url: url,
                dataType: "json",
                data: data,
                contentType: false,
                processData: false,
                success: function(data) {
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
                    $("#submit").show();
                },

            });
        }
    });
</script>
@endpush
