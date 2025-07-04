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
              <form>
                <div class="form-group">
                  <label for="clientMobile">Client's Mobile Number</label>
                  <input type="text" class="form-control" id="clientMobile" placeholder="0400123456">
                </div>
          
                <div class="form-group">
                  <label for="incidentNature">Incident Nature</label>
                  <select class="form-control" id="incidentNature">
                    <option>Time waster</option>
                    <option>Con man</option>
                    <option>Dangerous</option>
                    <option>Assault</option>
                  </select>
                </div>
          
                <div class="form-group">
                  <label for="rating">Rating</label>
                  <select class="form-control" id="rating">
                    <option>Low</option>
                    <option>Medium</option>
                    <option>High</option>
                  </select>
                </div>
          
                <div class="form-group">
                  <label for="incidentDetails">Incident Details</label>
                  <textarea class="form-control" id="incidentDetails" rows="5" placeholder="Describe the incident..."></textarea>
                </div>
          
                <button type="submit" class="save_profile_btn">Submit Report</button>
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
