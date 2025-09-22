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
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content start here-->
        <!-- Page Heading -->
        <div class="row">
            <div class="custom-heading-wrapper col-md-12"><h1 class="h1">Change Features</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                    <ol>
                        <li>Use this feature to enable and disable your feature preferences.</li>
                        <li>Please note that for an Advertiser to participate in any of these features, they must
                            have enabled the corresponding feature in their preference settings.</li>
                        <li>Note also the default setting for 2FA authentification.</li>
                    </ol>
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
           
            <div class="col-md-12" id="profile_and_tour_options">

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
                                <h3 class="h3">Features</h3>
                                {{-- <div class="form-check">
                                    <input class="form-check-input" id="feature_favorites" type="checkbox" {{ in_array('favorites', $features) ? 'checked' : ''}} name="features[]" value="favorites">
                                    <label class="form-check-label" for="feature_favorites">Flag your favorite Escorts and view your Favorites
                                        list</label>
                                </div> --}}
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="feature_alerts" name="features[]" value="alerts" checked>
                                    <label class="custom-control-label" for="feature_alerts">Receive Alert Notifications from Escorts</label>
                                </div>
                                
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="feature_chatting" name="features[]" value="chatting" checked>
                                    <label class="custom-control-label" for="feature_chatting">Participate in direct chatting with Escorts</label>
                                </div>
                                
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="feature_reviews" name="features[]" value="reviews" checked>
                                    <label class="custom-control-label" for="feature_reviews">Write Reviews</label>
                                </div>
                                
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="feature_legbox" name="features[]" value="legbox" checked>
                                    <label class="custom-control-label" for="feature_legbox">Enable My Legbox</label>
                                </div>
                                
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="feature_notebox" name="features[]" value="notebox" checked>
                                    <label class="custom-control-label" for="feature_notebox">Enable My Notebox</label>
                                </div>
                                
                                <div class="pt-1"><i>These features are enabled by default unless you disable them.</i></div>
                            </div>
                             <!-- Listings Preferences -->
                             <div class="form-group">
                                <h3 class="h3">Listings Preferences</h3>
                                <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="listView" id="gridView" value="grid" checked>
                                <label class="form-check-label" for="gridView">
                                    Grid View
                                </label>
                                </div>

                                <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="listView" id="listView" value="list">
                                <label class="form-check-label" for="listView">
                                    List View
                                </label>
                                </div>
                                
                                <div class="pt-1"><i>Select your preferred option on how you view Advertiser Listings.</i></div>
                            </div>
                            <!-- Alert Notifications -->
                            {{-- <div class="form-group">
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
                                <div class="pt-1"><i>These features are enabled by default unless you disable them.</i></div>
                            </div> --}}

                            <!-- Interests -->
                            <div class="form-group">
                                <h3 class="h3">What are your interests?</h3>
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" id="interest_female" type="checkbox" 
                                           name="interests[]" value="6" checked>
                                    <label class="custom-control-label" for="interest_female">Female</label>
                                </div>
                                
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" id="interest_male" type="checkbox" 
                                           name="interests[]" value="1" {{ in_array('1', $interests) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="interest_male">Male</label>
                                </div>
                                
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" id="interest_trans" type="checkbox" 
                                           name="interests[]" value="3" {{ in_array('3', $interests) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="interest_trans">Trans</label>
                                </div>
                                
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" id="interest_cross" type="checkbox" 
                                           name="interests[]" value="4" {{ in_array('4', $interests) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="interest_cross">Cross dresser</label>
                                </div>
                                
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" id="interest_couples" type="checkbox" 
                                           name="interests[]" value="5" {{ in_array('5', $interests) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="interest_couples">Couples</label>
                                </div>
                                
                              <div class="pt-1"><i>By selecting a particular interest, we can refine your Escorts View page.</i></div>
                            </div>

                        </div>
                    </div>

                    <input type="submit" value="Save" class="btn-common" name="submit">
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
