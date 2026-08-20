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
            <div class="custom-heading-wrapper col-md-12">
                <h1 class="h1">Change Features</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                    aria-expanded="true"><b>Help?</b></span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b></h3>
                        <ol>
                            <li>Use this feature to enable and disable your feature preferences.</li>
                            <li>Please note that for an Advertiser to participate in any of these features, they must
                                have enabled the corresponding feature in their preference settings.</li>

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

                <form id="change_features_id" name="change_features" method="POST" action="{{ route('change-features') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="common-grid">
                                <!-- Features -->
                                <div class="form-group common-card">
                                    <div class="card-top">
                                        <div class="card-icon">
                                            <svg viewBox="0 0 24 24" fill="none">
                                                <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="1.8"
                                                    stroke-linecap="round" />

                                                <circle cx="9" cy="6" r="2" fill="white"
                                                    stroke="currentColor" stroke-width="1.8" />

                                                <circle cx="15" cy="12" r="2" fill="white"
                                                    stroke="currentColor" stroke-width="1.8" />

                                                <circle cx="10" cy="18" r="2" fill="white"
                                                    stroke="currentColor" stroke-width="1.8" />
                                            </svg>
                                        </div>

                                        <div class="card-heading">
                                            <h2>Features</h2>
                                        </div>
                                    </div>

                                    <div class="option-list">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="feature_alerts"
                                                name="features_push_notifications_from_escorts" value="1"
                                                {{ isset($setting->viewer_settings) && $setting->viewer_settings->features_push_notifications_from_escorts == '1' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="feature_alerts">Receive Alert
                                                Notifications from Escorts</label>
                                        </div>

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="feature_chatting"
                                                name="features_direct_chatting_with_escorts" value="1"
                                                {{ isset($setting->viewer_settings) && $setting->viewer_settings->features_direct_chatting_with_escorts == '1' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="feature_chatting">Participate in direct
                                                chatting with Escorts</label>
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
                                            <label class="custom-control-label" for="feature_legbox">Enable My
                                                Legbox</label>
                                        </div>

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="feature_notebox"
                                                name="features_enable_my_notebox" value="1"
                                                {{ isset($setting->viewer_settings) && $setting->viewer_settings->features_enable_my_notebox == '1' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="feature_notebox">Enable My
                                                Notebox</label>
                                        </div>
                                    </div>
                                    <div class="card-note">
                                        <span class="note-icon">i</span>
                                        <p><i>These features are enabled by default unless you disable them.</i></p>
                                    </div>
                                </div>

                                <!-- Listings Preferences -->
                                <div class="form-group common-card">
                                    <div class="card-top">
                                        <div class="card-icon">


                                            <svg fill="#ff3c5f" height="200px" width="200px" version="1.1"
                                                id="Icons" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32"
                                                xml:space="preserve">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <g>
                                                        <path
                                                            d="M29,6H17c-0.6,0-1-0.4-1-1s0.4-1,1-1h12c0.6,0,1,0.4,1,1S29.6,6,29,6z">
                                                        </path>
                                                    </g>
                                                    <g>
                                                        <path
                                                            d="M24,10h-7c-0.6,0-1-0.4-1-1s0.4-1,1-1h7c0.6,0,1,0.4,1,1S24.6,10,24,10z">
                                                        </path>
                                                    </g>
                                                    <g>
                                                        <path
                                                            d="M29,22H17c-0.6,0-1-0.4-1-1s0.4-1,1-1h12c0.6,0,1,0.4,1,1S29.6,22,29,22z">
                                                        </path>
                                                    </g>
                                                    <g>
                                                        <path
                                                            d="M24,26h-7c-0.6,0-1-0.4-1-1s0.4-1,1-1h7c0.6,0,1,0.4,1,1S24.6,26,24,26z">
                                                        </path>
                                                    </g>
                                                    <g>
                                                        <path d="M8,30c-3.3,0-6-2.7-6-6s2.7-6,6-6s6,2.7,6,6S11.3,30,8,30z">
                                                        </path>
                                                    </g>
                                                    <path
                                                        d="M8,2C4.7,2,2,4.7,2,8s2.7,6,6,6s6-2.7,6-6S11.3,2,8,2z M8,10c-1.1,0-2-0.9-2-2s0.9-2,2-2s2,0.9,2,2S9.1,10,8,10z">
                                                    </path>
                                                </g>
                                            </svg>
                                        </div>

                                        <div class="card-heading">
                                            <h2>Listings Preferences</h2>
                                        </div>
                                    </div>
                                    <div class="radio-options">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"
                                                name="listings_preferences_view" id="gridView" value="1"
                                                {{ isset($setting->viewer_settings) && $setting->viewer_settings->listings_preferences_view == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gridView">Grid View</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"
                                                name="listings_preferences_view" id="listView" value="2"
                                                {{ isset($setting->viewer_settings) && $setting->viewer_settings->listings_preferences_view == '2' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="listView">List View</label>
                                        </div>
                                    </div>


                                    <div class="card-note">
                                        <span class="note-icon">i</span>
                                        <p><i>Select your preferred option on how you view Advertiser
                                                Listings.</i></p>
                                    </div>
                                </div>

                                <!-- Interests -->
                                @php
                                    $allSelected =
                                        isset($setting->viewer_settings) &&
                                        $setting->viewer_settings->interests_with_female &&
                                        $setting->viewer_settings->interests_with_male &&
                                        $setting->viewer_settings->interests_with_trans &&
                                        $setting->viewer_settings->interests_with_cross_dresser &&
                                        $setting->viewer_settings->interests_with_couples;

                                @endphp

                                <div class="form-group common-card">
                                    <div class="card-top">
                                        <div class="card-icon">
                                            <svg viewBox="0 0 24 24" fill="none">
                                                <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="1.8"
                                                    stroke-linecap="round" />

                                                <circle cx="9" cy="6" r="2" fill="white"
                                                    stroke="currentColor" stroke-width="1.8" />

                                                <circle cx="15" cy="12" r="2" fill="white"
                                                    stroke="currentColor" stroke-width="1.8" />

                                                <circle cx="10" cy="18" r="2" fill="white"
                                                    stroke="currentColor" stroke-width="1.8" />
                                            </svg>
                                        </div>

                                        <div class="card-heading">
                                            <h2>What are Your Interests?</h2>
                                            <p>These settings apply to your Home State.</p>
                                        </div>
                                    </div>
                                    <div class="option-list">
                                        <div class="custom-control custom-switch ">
                                            <input class="custom-control-input" id="interest_all" type="checkbox"
                                                {{ $allSelected ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="interest_all">All</label>
                                        </div>

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
                                    </div>
                                    <div class="card-note">
                                        <span class="note-icon">i</span>
                                        <p><i>By selecting a particular interest, we can refine your Escort
                                                Listings View page.</i></p>
                                    </div>
                                </div>

                                {{-- Show Entries --}}
                                <div class="form-group common-card disabled-link">
                                    <div class="card-top">
                                        <div class="card-icon">
                                            <svg viewBox="0 0 24 24" fill="none">
                                                <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="1.8"
                                                    stroke-linecap="round" />
                                                <circle cx="7" cy="6" r="1.5" fill="currentColor" />
                                                <circle cx="7" cy="12" r="1.5" fill="currentColor" />
                                                <circle cx="7" cy="18" r="1.5" fill="currentColor" />
                                            </svg>
                                        </div>

                                        <div class="card-heading">
                                            <h2>Show Entries</h2>
                                        </div>
                                    </div>

                                    <div class="entries-setting">

                                        <span class="entries-label">
                                            Your default setting is:
                                        </span>

                                        <select class="entries-select" name="show_entries">
                                            <option value="10"
                                                {{ isset($setting->viewer_settings) && $setting->viewer_settings->show_entries == '10' ? 'selected' : '' }}>
                                                10
                                            </option>
                                            <option value="25"
                                                {{ isset($setting->viewer_settings) && $setting->viewer_settings->show_entries == '25' ? 'selected' : '' }}>
                                                25
                                            </option>

                                            <option value="50"
                                                {{ isset($setting->viewer_settings) && $setting->viewer_settings->show_entries == '50' ? 'selected' : '' }}>
                                                50
                                            </option>

                                            <option value="75"
                                                {{ isset($setting->viewer_settings) && $setting->viewer_settings->show_entries == '75' ? 'selected' : '' }}>
                                                75
                                            </option>

                                            <option value="100"
                                                {{ isset($setting->viewer_settings) && $setting->viewer_settings->show_entries == '100' ? 'selected' : '' }}>
                                                100
                                            </option>
                                        </select>

                                    </div>

                                    <div class="card-note">
                                        <span class="note-icon">i</span>
                                        <p>
                                            <i>Select your preferred number of entries for Report pages.</i>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="common-footer">
                        <input type="submit" value="Save" class="common-save-btn" name="submit">
                    </div>
                </form>


            </div>
        </div>
        <!--middle content end here-->
    </div>
@endsection
@push('script')
    <script>
        $(document).on('submit', 'form[name="change_features"]', function(e) {
            e.preventDefault();
            let form = $('#change_features_id')[0];
            let formData = new FormData(form);
            let url = $('#change_features_id').attr('action');
            swal_waiting_popup({
                'title': 'Updating Settings'
            });
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.close();
                    swal_success_popup(response.message);
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                },
                error: function(xhr) {
                    Swal.close();
                    console.log(xhr);
                    swal_error_popup(xhr.responseJSON.message || 'Something went wrong');
                }
            });
        });


        $(document).ready(function() {
            const interestCheckboxes = $(
                '#interest_female, #interest_male, #interest_trans, #interest_cross, #interest_couples'
            );
            // All checkbox change
            $('#interest_all').on('change', function() {
                interestCheckboxes.prop('checked', $(this).is(':checked'));
            });
            // Individual checkbox change
            interestCheckboxes.on('change', function() {
                const allChecked = interestCheckboxes.length === interestCheckboxes.filter(':checked')
                    .length;
                $('#interest_all').prop('checked', allChecked);
            });

        });
    </script>
@endpush
