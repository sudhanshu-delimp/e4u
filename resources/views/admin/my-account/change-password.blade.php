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
   align-items: center;
   }

.swal-footer {
  display: flex;
  justify-content: center; /* horizontally center */
  align-items: center;     /* vertically center */
  padding: 20px;           /* optional spacing */
}

.swal-button-container {
  display: flex;
  align-items: center;
  justify-content: center;
}

.swal-button--ok {
  /* background-color: #3085d6; */
  color: #fff;
  border: none;
  padding: 10px 25px;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
}
.swal-button:not([disabled]):hover {
    background-color: #ff3c5f;
}


    .toggle-password {
        position: absolute;
        top: 28px;
        right: 15px;
        cursor: pointer;
        z-index: 2;
        color: #6c757d;
    }

    form.v-form-design label {
        font-weight: 500;
    }
</style>
@stop
@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <div class="container-fluid  pl-3 pl-lg-5 pr-3 pr-lg-5 change-pass-sec">
            <!--middle content start here-->
            <div class="row">
                <div class="custom-heading-wrapper col-md-12">
                    <h1 class="h1">Change password </h1>
                    <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" style="font-size:16px"><b>Help?</b> </span>
                </div>
                <div class="mb-4 col-md-12">
                    <div class="card collapse" id="notes">
                        <div class="card-body">
                            <h3 class="NotesHeader"><b>Notes:</b> </h3>
                            <ol>

                            </ol>
                        </div>
                    </div>
                </div>
                <!-- ALERT MESSAGE -->
                <div class="col-md-12 mb-3">
                    <div id="profileAlert" class="alert d-none rounded" role="alert"></div>
                </div>
                <div class="col-md-12 mb-5">

                    {{-- Success Message --}}
                    @if(session('success'))
                    <div class="alert alert-success text-left">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form class="v-form-design" id="userProfile" action="{{ route('admin.update.password')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group position-relative">
                                            <label for="current_password">Current password</label>
                                            <input type="password" class="form-control" value="{{ old('password') }}" name="current_password" id="passwordN" placeholder="Current password" data-parsley-required-message="Current password is required" required>
                                            <span class="toggle-password" toggle="#passwordN">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                            @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <div class="pt-1">
                                                <small id="emailHelp"><i>Case sensitive</i></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group position-relative">
                                            <label for="new_password">New password</label>
                                            <input type="password" required class="form-control" value="{{ old('new_password') }}" name="new_password" id="new_password" placeholder="New password" aria-describedby="emailHelp" required autocomplete="new-password" data-parsley-required-message="Password is required" data-parsley-pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&amp;*?])[A-Za-z\d#$@!%&amp;*?]{8,30}$/" data-parsley-pattern-message="Password must be of at least 8 character, must contain both upper-case and lower-case character, at least one number and special character">
                                            <span class="toggle-password" toggle="#new_password">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                            <div class="termsandconditions_text_color">
                                                @error('new_password')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="pt-1">
                                                <small id="emailHelp"><i>Must be a minimum of eight (8) characters long</i></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group position-relative">
                                            <label for="confirm_password">Confirm password</label>
                                            <input type="password" class="form-control" placeholder="Confirm password" id="confirm_password" aria-describedby="emailHelp" name="password_confirmation" data-parsley-equalto="#new_password" data-parsley-equalto-message="Confirm password should be the same password." required="true" autocomplete="new-password" data-parsley-required-message="Confirm password is required">
                                            <span class="toggle-password" toggle="#confirm_password">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                            <div class="termsandconditions_text_color">
                                                @error('confirm_password')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>



<div class="modal fade upload-modal" id="success_popup" tabindex="-1" aria-labelledby="confirmPopupLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content basic-modal">
            <div class="modal-header border-0">
                <h5 class="modal-title d-flex align-items-center" id="confirmPopupLabel">
                    <img src="{{ asset('assets/dashboard/img/unblock.png') }}" alt="resolved" class="custompopicon">
                    <span class="success-modal-title">Password</span>
                </h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" style="background: none; border: none;">
                    <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                </button>
            </div>

            <div class="modal-body pb-0 teop-text text-center">
                <h6 class="popu_heading_style mt-2">
                    <span class="Lname success-modal-text resMsg"> </span>
                </h6>
            </div>

            <div class="modal-footer justify-content-center border-0 pb-4">
                <button type="button" class="btn-success-modal" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<!-- file upload plugin start here -->



<!-- file upload plugin end here -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/plugins/sweetalert/sweetalert2@11.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    document.querySelectorAll('.toggle-password').forEach(function(el) {
        el.addEventListener('click', function() {
            var selector = this.getAttribute('toggle');
            var input = document.querySelector(selector);
            if (!input) {
                console.error("Invalid selector:", selector);
                return;
            }
            var icon = this.querySelector('i');
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        });
    });
</script>

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
                    if (data.status === true) {
                        // Show the modal
                        var myModal = new bootstrap.Modal(document.getElementById('success_popup'));
                        myModal.show();

                        // Update the message inside the modal
                        var resMsgElement = document.querySelector('.resMsg');
                        if (resMsgElement) {
                            resMsgElement.textContent = data.message;
                        }

                        var form = document.getElementById('userProfile');
                        if (form) {
                            form.reset(); // This clears all input fields
                        }

                    } else {
                        // Error handling
                        swal({
                            title: "Oops!",
                            text: data.message,
                            icon: "error",
                            closeModal: true,
                            buttons: {
                                cancel: false,
                                ok: true,
                            },
                        });

                    }
                }

            });
        }
    });


</script>

@endpush
