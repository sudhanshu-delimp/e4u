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
<div class="container-fluid pl-3 pl-lg-5">
   <!--middle content start here-->
   <div class="row">
      <div class="col-md-12">
         <div class="v-main-heading h3" style="display: inline-block;">Add Report</div>
          <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>
      </div>
      <div class="col-md-12 mt-4 mb-5">
         <div class="row collapse" id="notes">
            <div class="col-md-12 mb-4">
               <div class="card">
                  <div class="card-body">
                     <p><b>Notes:</b> </p>
                     <ul>
                        <li>The NUM register (NUM) is a free service to all Escorts.</li>
                        <li>Complete the form to add an incident. Ensure all details are correct and compliant with the <a href="#" class="text-danger">Code of Conduct</a>.</li>
                        <li>The NUM is a closed publication for Escorts only, based on real incident reports.</li>
                        <li><strong>Incident Nature filter meanings:</strong>
                          <ul>
                            <li><strong>Time waster</strong>: client who didn’t turn up or keeps postponing.</li>
                            <li><strong>Con man</strong>: client didn’t pay after the appointment.</li>
                            <li><strong>Dangerous</strong>: aggressive or drug-using client.</li>
                            <li><strong>Assault</strong>: client who assaulted you.</li>
                          </ul>
                        </li>
                      </ul>
                  </div>
               </div>
            </div>
         </div>
         <!-- Report Form -->
         <div class="card mt-4" style="max-width: 800px;">
            <div class="card-header text-white" style="background: #0c223d !important;">
              Submit Client Report
            </div>
            <div class="card-body">
              <form class="needs-validation" action="#" method="POST" enctype="multipart/form-data" novalidate="">
                <!-- Incident Date -->
                <div class="form-group">
                   <label for="incident_date">Incident Date <span class="text-danger">*</span></label>
                   <input type="date" class="form-control" id="incident_date" name="incident_date" required="">
                </div>
                <!-- Incident State -->
                <div class="form-group">
                   <label for="incident_state">Incident State <span class="text-danger">*</span></label>
                   <select class="form-control custom-select" id="incident_state" name="incident_state" required="">
                      <option value="" selected="" disabled="">Please Choose</option>
                      <option value="act">ACT</option>
                      <option value="nsw">NSW</option>
                      <option value="nt">NT</option>
                      <option value="qld">QLD</option>
                      <option value="sa">SA</option>
                      <option value="tas">Tas</option>
                      <option value="vic">VIC</option>
                      <option value="wa">WA</option>
                   </select>
                </div>
                <!-- Incident Location -->
                <div class="form-group">
                   <label for="incident_location">Incident Location <span class="text-danger">*</span></label>
                   <input type="text" class="form-control" id="incident_location" name="incident_location" required="">
                   <small class="form-text text-muted">Which city were you in</small>
                </div>
                <!-- Offender's Name -->
                <div class="form-group">
                   <label for="offenders_name">Offender's Name</label>
                   <input type="text" class="form-control" id="offenders_name" name="offenders_name">
                   <small class="form-text text-muted">If known</small>
                </div>
                <!-- Offender's Mobile -->
                <div class="form-group">
                   <label for="offenders_mobile">Offender's Mobile <span class="text-danger">*</span></label>
                   <input type="text" class="form-control" id="offenders_mobile" name="offenders_mobile" pattern="\d{10}" maxlength="10" required="" placeholder="1234567890">
                   <small class="form-text text-muted">No spaces or any other characters - just numbers</small>
                </div>
                <!-- Offender's Email -->
                <div class="form-group">
                   <label for="offenders_email">Offender's Email</label>
                   <input type="email" class="form-control" id="offenders_email" name="offenders_email">
                   <small class="form-text text-muted">If known</small>
                </div>
                <!-- Incident Nature -->
                <div class="form-group">
                   <label for="incident_nature">Incident Nature <span class="text-danger">*</span></label>
                   <select class="form-control custom-select" id="incident_nature" name="incident_nature" required="">
                      <option value="" disabled="" selected="">Please Choose</option>
                      <option value="Time Waster">Time Waster</option>
                      <option value="Con man">Con man</option>
                      <option value="Dangerous">Dangerous</option>
                      <option value="Assault">Assault</option>
                   </select>
                </div>
                <!-- What Happened -->
                <div class="form-group">
                   <label for="what_happened">What Happened <span class="text-danger">*</span></label>
                   <textarea class="form-control" id="what_happened" name="what_happened" rows="4" required=""></textarea>
                </div>
                <!-- Rating -->
                <div class="form-group">
                   <label>Rating <span class="text-danger">*</span></label><br>
                   <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="rating" id="rating1" value="1" required="">
                      <label class="form-check-label" for="rating1">Do not approach</label>
                   </div>
                   <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="rating" id="rating2" value="2" required="">
                      <label class="form-check-label" for="rating2">Exercise caution</label>
                   </div>
                   <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="rating" id="rating3" value="3" required="">
                      <label class="form-check-label" for="rating3">Safe</label>
                   </div>
                </div>
                <!-- Submit Button -->
                <button type="submit" class="save_profile_btn">Add Report</button>
                <p class="mt-3">Your report will remain <em>Pending</em> until approved by our Operations team.</p>
             </form>
            </div>
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
