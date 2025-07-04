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
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <div class="v-main-heading h3 mb-2 pt-4 d-flex align-items-center"><h1 class="p-0">Change Features</h1>
                <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 my-2">
                <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                    <ol></ol>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
           
            <div class="col-md-12 mt-4" id="profile_and_tour_options">

                <form class="v-form-design" method="POST" action="{{ route('set-viewer-preference') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">

                          @php
                            $features = $preference && $preference->features ? json_decode($preference->features) : [];
                            $notifications = $preference && $preference->notifications ? json_decode($preference->notifications) : [];
                            $interests = $preference && $preference->interests ? json_decode($preference->interests) : [];
                          @endphp

                            <!-- Features -->
                            <div class="form-group">
                                <label>Features (enabled by default)</label><br>
                                <div class="form-check">
                                    <input class="form-check-input" id="feature_favorites" type="checkbox" {{ in_array('favorites', $features) ? 'checked' : ''}} name="features[]" value="favorites">
                                    <label class="form-check-label" for="feature_favorites">Flag your favorite Escorts and view your Favorites
                                        list</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" {{ in_array('reviews', $features) ? 'checked' : ''}} type="checkbox" id="feature_reviews" name="features[]" value="reviews">
                                    <label class="form-check-label" for="feature_reviews">Write Reviews</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" {{ in_array('alerts', $features) ? 'checked' : ''}} type="checkbox" id="feature_alerts" name="features[]" value="alerts">
                                    <label class="form-check-label" for="feature_alerts">Receive Alert Notifications</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" {{ in_array('chatting', $features) ? 'checked' : ''}} type="checkbox" id="feature_chatting" name="features[]" value="chatting">
                                    <label class="form-check-label" for="feature_chatting">Participate in direct chatting with Escorts</label>
                                </div>
                            </div>

                            <!-- Alert Notifications -->
                            <div class="form-group">
                                <label>Alert notifications</label><br>
                                <div class="form-check">
                                    @php
                                        $prefNotification = isset($preference->notifications) ? json_decode($preference->notifications) : [];
                                    @endphp
                                    <input class="form-check-input" type="checkbox" {{ (isset($preference->notifications) && in_array('email', $prefNotification)) ? 'checked' : ''}} id="notifications_email" name="notifications[]" value="email">
                                    <label class="form-check-label" for="notifications_email">Email</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" {{ in_array('text', $notifications) ? 'checked' : ''}} type="checkbox" id="notifications_text" name="notifications[]" value="text">
                                    <label class="form-check-label" for="notifications_text">Text</label>
                                </div>
                            </div>

                            <!-- Interests -->
                            <div class="form-group">
                                <label>What are your interests?</label><br>
                                <div class="form-check">
                                    <input class="form-check-input" id="inetrest_female" type="checkbox" {{ in_array('6', $interests) ? 'checked' : ''}} name="interests[]" value="6">
                                    <label class="form-check-label" for="inetrest_female">Female</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="inetrest_male" type="checkbox" {{ in_array('1', $interests) ? 'checked' : ''}} name="interests[]" value="1">
                                    <label class="form-check-label" for="inetrest_male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" {{ in_array('3', $interests) ? 'checked' : ''}} id="inetrest_trans" type="checkbox" name="interests[]" value="3">
                                    <label class="form-check-label" for="inetrest_trans">Trans</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" {{ in_array('5', $interests) ? 'checked' : ''}} id="inetrest_bdsm" type="checkbox" name="interests[]" value="5">
                                    <label class="form-check-label" for="inetrest_bdsm">BDSM</label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" {{ in_array('4', $interests) ? 'checked' : ''}} id="inetrest_cross" type="checkbox" name="interests[]" value="4">
                                  <label class="form-check-label" for="inetrest_cross">Cross dresser</label>
                              </div>
                               
                            </div>

                        </div>
                    </div>

                    <input type="submit" value="Save" class="btn btn-primary shadow-none" name="submit">
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
