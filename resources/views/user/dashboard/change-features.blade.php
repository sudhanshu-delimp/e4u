
@extends('layouts.userDashboard')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/parsley/src/parsley.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">

{{-- <style type="text/css">
  .parsley-errors-list {
    list-style: none;
    color: rgb(248, 0, 0)
  }
</style> --}}
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5">
    <!--middle content start here-->
        <div class="row">
            <div class="col-md-12">
                <div class="v-main-heading h3">Change Features</div>
            </div>
            <div class="col-md-12 mt-4" id="profile_and_tour_options">

                <form class="v-form-design">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="email">Features (enabled by default)</label><br>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value=" ">
                        <label class="form-check-label" for="Method_Message">Flag your favourite Escorts and view your "Favorites" list</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=" ">
                        <label class="form-check-label" for="Method_Text">Write Reviews</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox"  value=" ">
                        <label class="form-check-label" for="Method_Email">Recieve Alert Notifications</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value=" ">
                        <label class="form-check-label" for="Method_Email">Participate in direct chatting with Escorts</label>
                      </div>
                      <div class="pt-1"><i>These features are provided by default unless you disable them</i></div>
                    </div>
                    <div class="form-group">
                      <label for="email">Alert notifications</label><br>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="Method_Message" value="option1">
                        <label class="form-check-label" for="Method_Message">Email</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="Method_Text" value="option1">
                        <label class="form-check-label" for="Method_Text">Text</label>
                      </div>
                      <div class="pt-1"><i>If you have enabled this feature, indicate you preferred method of notification

</i></div>
                    </div>

                    <div class="form-group">
                      <label for="email">What are your interests?</label><br>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="Method_Message" value="option1">
                        <label class="form-check-label" for="Method_Message">Female</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="Method_Text" value="option1">
                        <label class="form-check-label" for="Method_Text">Male</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="Method_Text" value="option1">
                        <label class="form-check-label" for="Method_Text">Trans</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="Method_Text" value="option1">
                        <label class="form-check-label" for="Method_Text">BDSM</label>
                      </div>
                       <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="Method_Text" value="option1">
                        <label class="form-check-label" for="Method_Text">Cross dresser</label>
                      </div>
                      <div class="pt-1"><i>By selecting a particular interest, we can refine your Escorts View page
</i></div>
                    </div>
                  </div>
                </div>
                <input type="submit" value="save" class="btn btn-primary shadow-none" name="submit">
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
          if (data.error == true) {
            var msg = "Saved";
            $('.comman_msg').text(msg);
            //$("#my_account_modal").show();
            $("#comman_modal").modal('show');
            $('input[type=password]').each(function() {
            $(this).val('');
            });
            //location.reload();

          } else {
            $('.comman_msg').html("Please enter your correct current password");
                        $("#comman_modal").modal('show');

          }
        },

      });
    }
  });





</script>

@endpush
