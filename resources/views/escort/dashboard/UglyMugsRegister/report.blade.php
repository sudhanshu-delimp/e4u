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
                  {{--<ul>
                     <li>Get user default values ✅</li>
                     <li>Make a processing script for the num reports</li>
                     <li>Error/Success messages</li>
                     <li>Name/ID lookup for offender (frosting on the cake.) ~</li>
                  </ul>--}}
                  {{--<div class="form-group w-75">
                     <label for="email"><b>Your ID</b> </label>
                     <input id="name" placeholder="Your ID" name="name" type="text" class="form-control">
                  </div>
                  <div class="form-group w-75">
                     <label for="email"><b>Your Name</b> </label>
                     <input id="name" placeholder="Your Name" name="name" type="text" class="form-control">
                  </div>--}}
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
               {{--<div class="col-md-5">
                  <h3><b>Don't know their details? Look them up</b></h3>
                  <button type="button" class="e4u-modal-open mt-2" data-toggle="modal" data-target="#exampleModal">
                  Search for an offender
                  <i class="fa fa-search" aria-hidden="true"></i>
                  </button>
               </div>--}}
            </div>
         </form>
      </div>
   </div>
   <!--middle content end here-->
</div>
{{--<div class="modal fade upload-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Find a Viewer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
            </button>
         </div>
         <div class="modal-body">
            <div class="row pl-3">
               <div class="col-md-6">
                  <div class="form-group mb-2 pt-2">
                     <label for="staticEmail2"><b>Search</b></label>
                  </div>
                  <div class="form-group mb-2">
                     <input type="text" name="name" required="" data-parsley-required-message=" Please enter Tour Name" class="form-control mb-2" id=" " placeholder=" " value="" data-parsley-errors-container="#Tname">
                     <i>Find a Viewer with their Username, ID or Mobile number</i>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="card-body pt-2" style="
                     ">
                     <p class="mb-0"><b>Selected User </b></p>
                     <table id="myTable" class="table table-striped dataTable no-footer border-0" width="100%" role="grid" aria-describedby="myTable_info" style="">
                        <tbody>
                           <tr role="row" class="border-0 bg-transparent
                              ">
                              <td class="border-0 pb-0 pl-0 text-black">ID:</td>
                              <td class="border-0 pb-0 text-black">261</td>
                           </tr>
                           <tr role="row" class="border-0 bg-transparent
                              ">
                              <td class="border-0 pb-0 pl-0 text-black">Name:</td>
                              <td class="border-0 pb-0 text-black">Juli</td>
                           </tr>
                           <tr role="row" class="border-0 bg-transparent
                              ">
                              <td class="border-0 pb-0 pl-0 text-black">Mobile:</td>
                              <td class="border-0 pb-0 text-black">0987654321</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="col-md-12">
                  <table style="width: 100%;background: #0C223D;color: #fff;">
                     <tbody>
                        <tr>
                           <th class="p-2">ID</th>
                           <th class="p-2">Name</th>
                           <th class="p-2">Mobile</th>
                        </tr>
                        <tr>
                           <td class="p-2">Magazzini</td>
                           <td class="p-2">Giovanni</td>
                           <td class="p-2">Italy</td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-primary">Continue</button>
         </div>
      </div>
   </div>
</div>--}}
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
            var url = "{{route('escort.mug.register')}}";
            var data = new FormData(form[0]);
            $.ajax({
                method: 'POST',
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
