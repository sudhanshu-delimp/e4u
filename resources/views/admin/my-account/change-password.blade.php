@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/parsley/src/parsley.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">

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
<div class="container-fluid  pl-3 pl-lg-5 change-pass-sec">
  <!--middle content start here-->
  



  <div class="row">
    <div class="col-md-12">
      <div class="v-main-heading">
            <h1>Change password <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" style="font-size:16px"><b>Help?</b> </span></h1>
      </div>
      <div class="my-4">
            <div class="card collapse" id="notes">
              <div class="card-body">
                  <h3 class="NotesHeader"><b>Notes:</b> </h3>
                  <ol>
                    
                  </ol>
              </div>
            </div>
      </div>
    </div>
    <!-- ALERT MESSAGE -->
    <div class="col-md-12 my-3">
        <div id="profileAlert" class="alert d-none rounded" role="alert"></div>
    </div>
    <div class="col-md-12 mb-5">
      <form class="v-form-design" id="userProfile" action="{{ route('admin.update.password')}}" method="POST" novalidate="">
        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="current_password">Current password</label>
                  <input type="password" class="form-control" name="password" placeholder="Current password" data-parsley-required-message="Current password is required" required="">
                  <small id="emailHelp" class="form-text text-muted">Case sensative</small>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="new_password">New password</label>
                  <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New password" aria-describedby="emailHelp" required="" autocomplete="new-password" data-parsley-required-message="Password is required" data-parsley-pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&amp;*?])[A-Za-z\d#$@!%&amp;*?]{8,30}$/" data-parsley-pattern-message="Password must be of at least 8 character, must contain both upper-case and lower-case character, at least one number and special character">
                  <div class="termsandconditions_text_color">
                    <!-- error sms here -->
                                      </div>
                  <small id="emailHelp" class="form-text text-muted">MUST be a minimum of six (8) characters long</small>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="confirm_password">Confirm password</label>
                  <input type="password" class="form-control" placeholder="Confirm password" id="confirm_password" aria-describedby="emailHelp" name="password_confirmation" data-parsley-equalto="#new_password" data-parsley-equalto-message="Confirm password should be the same password." required="" autocomplete="new-password" data-parsley-required-message="Confirm password is required">
                  <div class="termsandconditions_text_color">
                    <!-- error sms here -->
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
        <input type="submit" value="Save Password" class="btn btn-primary shadow-none mt-4" name="submit">
      </form>
    </div>
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
    var alertBox = $('#profileAlert');

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
            // Success
            alertBox
              .removeClass('d-none alert-danger')
              .addClass('alert-success')
              .html("Details successfully saved.");

            // Optionally reload after a short delay
            setTimeout(function() {
              alertBox.addClass('d-none');
              location.reload(); // Or remove if you want to stay on page
            }, 4000);

          } else {
            // Error
            alertBox
              .removeClass('d-none alert-success')
              .addClass('alert-danger')
              .html("Records not updated. Please try again.");

            setTimeout(function() {
              alertBox.addClass('d-none');
            }, 10000);
          }
        }
      });
    }
  });


  // $('#userProfile').on('submit', function(e) {
  //   e.preventDefault();

  //   var form = $(this);

  //   if (form.parsley().isValid()) {

  //     var url = form.attr('action');
  //     var data = new FormData(form[0]);
  //     $.ajax({
  //       method: form.attr('method'),
  //       url: url,
  //       data: data,
  //       contentType: false,
  //       processData: false,
  //       headers: {
  //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //       },
  //       success: function(data) {
  //         console.log(data);
  //         if (data.error == true) {
  //           $.toast({
  //             heading: 'Success',
  //             text: 'Details successfully saved',
  //             icon: 'success',
  //             loader: true,
  //                           position: 'top-right', // Change it to false to disable loader
  //                           loaderBg: '#9EC600' // To change the background
  //                         });
  //                         location.reload();

  //         } else {
  //           $.toast({
  //             heading: 'Error',
  //             text: 'Records Not update',
  //             icon: 'error',
  //             loader: true,
  //                           position: 'top-right', // Change it to false to disable loader
  //                           loaderBg: '#9EC600' // To change the background
  //                         });

  //         }
  //       },

  //     });
  //   }
  // });





</script>

@endpush