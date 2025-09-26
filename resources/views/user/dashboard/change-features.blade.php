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

    <form class="v-form-design" id="change_features_id" name="change_features" method="POST" action="{{ route('change-features') }}">
    @csrf
    <div class="row">
        <div class="col-md-12">

            <!-- Features -->
            <div class="form-group">
                <h3 class="h3">Features</h3>

                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="feature_alerts"
                           name="features_push_notifications_from_escorts" value="1"
                           {{ isset($setting->viewer_settings) && $setting->viewer_settings->features_push_notifications_from_escorts == '1' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="feature_alerts">Receive Alert Notifications from Escorts</label>
                </div>

                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="feature_chatting"
                           name="features_direct_chatting_with_escorts" value="1"
                           {{ isset($setting->viewer_settings) && $setting->viewer_settings->features_direct_chatting_with_escorts == '1' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="feature_chatting">Participate in direct chatting with Escorts</label>
                </div>

                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="feature_reviews"
                           name="features_write_reviews" value="1"
                           {{ isset($setting->viewer_settings) && $setting->viewer_settings->features_write_reviews == '1' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="feature_reviews">Write Reviews</label>
                </div>

                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="feature_legbox"
                           name="features_enable_my_legbox" value="1"
                           {{ isset($setting->viewer_settings) && $setting->viewer_settings->features_enable_my_legbox == '1' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="feature_legbox">Enable My Legbox</label>
                </div>

                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="feature_notebox"
                           name="features_enable_my_notebox" value="1"
                           {{ isset($setting->viewer_settings) && $setting->viewer_settings->features_enable_my_notebox == '1' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="feature_notebox">Enable My Notebox</label>
                </div>

                <div class="pt-1"><i>These features are enabled by default unless you disable them.</i></div>
            </div>

            <!-- Listings Preferences -->
            <div class="form-group">
                <h3 class="h3">Listings Preferences</h3>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="listings_preferences_view" id="gridView" value="1"
                        {{ isset($setting->viewer_settings) && $setting->viewer_settings->listings_preferences_view == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="gridView">Grid View</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="listings_preferences_view" id="listView" value="2"
                        {{ isset($setting->viewer_settings) && $setting->viewer_settings->listings_preferences_view == '2' ? 'checked' : '' }}>
                    <label class="form-check-label" for="listView">List View</label>
                </div>

                <div class="pt-1"><i>Select your preferred option on how you view Advertiser Listings.</i></div>
            </div>

            <!-- Interests -->
            <div class="form-group">
                <h3 class="h3">What are your interests?</h3>

                <div class="custom-control custom-switch">
                    <input class="custom-control-input" id="interest_female" type="checkbox"
                           name="interests_with_female" value="1"
                           {{ isset($setting->viewer_settings) && $setting->viewer_settings->interests_with_female == '1' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="interest_female">Female</label>
                </div>

                <div class="custom-control custom-switch">
                    <input class="custom-control-input" id="interest_male" type="checkbox"
                           name="interests_with_male" value="1"
                           {{ isset($setting->viewer_settings) && $setting->viewer_settings->interests_with_male == '1' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="interest_male">Male</label>
                </div>

                <div class="custom-control custom-switch">
                    <input class="custom-control-input" id="interest_trans" type="checkbox"
                           name="interests_with_trans" value="1"
                           {{ isset($setting->viewer_settings) && $setting->viewer_settings->interests_with_trans == '1' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="interest_trans">Trans</label>
                </div>

                <div class="custom-control custom-switch">
                    <input class="custom-control-input" id="interest_cross" type="checkbox"
                           name="interests_with_cross_dresser" value="1"
                           {{ isset($setting->viewer_settings) && $setting->viewer_settings->interests_with_cross_dresser == '1' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="interest_cross">Cross dresser</label>
                </div>

                <div class="custom-control custom-switch">
                    <input class="custom-control-input" id="interest_couples" type="checkbox"
                           name="interests_with_couples" value="1"
                           {{ isset($setting->viewer_settings) && $setting->viewer_settings->interests_with_couples == '1' ? 'checked' : '' }}>
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
 
<script>
$(document).on('submit', 'form[name="change_features"]', function(e) 
{
e.preventDefault(); 
let form = $('#change_features_id')[0];
let formData = new FormData(form);
let url = $('#change_features_id').attr('action');
    swal_waiting_popup({'title':'Updating Settings'});
    $.ajax({
        url: url,
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false, 
        success: function(response) {
                Swal.close();
                swal_success_popup(response.message);
        },
        error: function(xhr) {
                Swal.close();
                console.log(xhr);
            swal_error_popup(xhr.responseJSON.message || 'Something went wrong');
        }
    });
});
</script>
@endpush
