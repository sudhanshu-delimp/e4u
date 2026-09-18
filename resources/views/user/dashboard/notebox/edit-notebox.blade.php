@extends('layouts.userDashboard')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<style type="text/css">
    .parsley-errors-list {
        list-style: none;
        color: rgb(248, 0, 0);
        padding-left: 0px !important;
    }

    .hide-img {
        display: none !important;
    }
    
    .currency-input-wrapper {
        position: relative;
    }

    .currency-symbol {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #0c223d;
        font-size: 14px;
        font-weight: 500;
        z-index: 2;
        pointer-events: none;
    }

    .currency-input-wrapper .currency-input {
        padding-left: 30px;
    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!--middle content start here-->
    <!-- Page Heading -->
    <div class="row">
        <div class="custom-heading-wrapper col-md-12">
            <h1 class="h1">Edit Notebox</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <h3 class="NotesHeader"><b>Notes:</b></h3>
                    <ol>
                        <li>The Notebox register (<b>Notebox</b>) is a free service to all Viewers. You can use the
                            Notebox service at any time.</li>
                        <li>Edit any of the information you have set out in this Notebox. Once you have completed
                            your changes, click the ‘Update Notebox’ button.
                        </li>
                        <li>Noteboxes are closed publications for Viewers only. Each Notebox contains personal
                            information about the Escort. E4U does not make Noteboxes available to other Members.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="common-card">
                <form class="common-form" id="notebox-form" novalidate>
                    <div class="row inner-row">
                        <div class="col-lg-12">
                            <div class="inner-field-row">
                                <div class="form-group">
                                    <label class="form-label" for="escort_type">Escort Type <span
                                            style="color:#FF3C5F;">*</span></label>
                                    <select class="form-control" required="required" name="escort_type"
                                        id="escort_type">
                                        <option value="" disabled selected="">Choose</option>
                                        @foreach ($genders as $key => $gender)
                                        <option value="{{ $key }}"
                                            {{ $report && $report->getRawOriginal('escort_type') == $key ? 'selected' : '' }}>
                                            {{ $gender }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="stage_name">Stage Name <span
                                            style="color:#FF3C5F;">*</span> </label>
                                    <input type="text" class="form-control" name="stage_name" id="stage_name"
                                        required="required" value="{{ $report->stage_name }}">
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="member_id">Member ID <span style="color:#FF3C5F;">*</span> </label>
                                    <input type="text" class="form-control" name="member_id" value="{{$report && $report->member_id ? $report->member_id : ''}}" id="member_id" required="required">
                                </div>

                                <input type="hidden" name="notebox_id" value="{{ $report->id }}">

                                <div class="form-group">
                                    <label class="form-label" for="mobile">Mobile <span
                                            style="color:#FF3C5F;">*</span></label>
                                    <input type="text" class="form-control"
                                        oninput="
                                            this.value = this.value.replace(/[^0-9 ]/g, '');
                                            let digits = this.value.replace(/\s/g, '');
                                            if (digits.length > 10) {
                                                this.value = this.value.slice(0, -1);
                                            }"
                                        id="mobile" name="mobile" required="required"
                                        value="{{ $report->getOriginal('mobile') }}">
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="advertised_price_per_hour">Advertised
                                        price
                                        per hour <span style="color:#FF3C5F;">*</span> </label>
                                         <div class="currency-input-wrapper">
                                            <span class="currency-symbol">$</span>
                                            <input type="text" class="form-control currency-input" id="advertised_price_per_hour"
                                            name="advertised_price_per_hour" required="required"
                                            value="{{ $report->advertised_price_per_hour !== null && $report->advertised_price_per_hour !== '' ? number_format($report->advertised_price_per_hour, 2) : '' }}" inputmode="decimal">
                                         </div>
                                </div>
                                

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="state">State <span
                                            style="color:#FF3C5F;">*</span></label>
                                    <select class="form-control" required="required" name="state" id="state">
                                        <option value="" disabled selected="">Choose</option>
                                        @foreach ($states as $key => $state)
                                        <option value="{{ $key }}"
                                            {{ $report && $report->state == $key ? 'selected' : '' }}>
                                            {{ $state['stateName'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="location">Location <span style="color:#FF3C5F;">*</span></label>
                                    <input type="text" class="form-control" name="location" id="location"
                                        required="required" value="{{ $report->location }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="meeting_type">Meeting type </label>
                                    <select class="form-control" name="meeting_type" id="meeting_type">
                                        <option value="" disabled selected="">Choose</option>
                                        <option {{ $report->meeting_type == 'one-on-one' ? 'selected' : '' }}
                                            value="one-on-one">One on one</option>
                                        <option {{ $report->meeting_type == 'Threesome (FFM)' ? 'selected' : '' }} value="Threesome (FFM)">
                                            Threesome (FFM)</option>
                                        <option {{ $report->meeting_type == 'Threesome (FMM)' ? 'selected' : '' }} value="Threesome (FMM)">
                                            Threesome (FMM)</option>
                                        <option {{ $report->meeting_type == 'Threesome (FTM)' ? 'selected' : '' }} value="Threesome (FTM)">
                                            Threesome (FTM)</option>
                                        <option {{ $report->meeting_type == 'Threesome (MFM)' ? 'selected' : '' }} value="Threesome (MFM)">
                                            Threesome (MFM)</option>
                                        <option {{ $report->meeting_type == 'Threesome (MMM)' ? 'selected' : '' }} value="Threesome (MMM)">
                                            Threesome (MMM)</option>
                                        <option {{ $report->meeting_type == 'Threesome (MTM)' ? 'selected' : '' }} value="Threesome (MTM)">
                                            Threesome (MTM)</option>
                                        <option {{ $report->meeting_type == 'Threesome (TFM)' ? 'selected' : '' }} value="Threesome (TFM)">
                                            Threesome (TFM)</option>
                                        <option {{ $report->meeting_type == 'Threesome (TMM)' ? 'selected' : '' }} value="Threesome (TMM)">
                                            Threesome (TMM)</option>
                                        <option {{ $report->meeting_type == 'Threesome (TTM)' ? 'selected' : '' }} value="Threesome (TTM)">
                                            Threesome (TTM)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="extras_charged">Extras charged</label>
                                    <select class="form-control" name="extras_charged" id="extras_charged">
                                        <option value="" selected="">Choose</option>
                                        <option {{ $report->extras_charged == 'Yes, additionally' ? 'selected' : '' }}
                                            value="Yes, additionally">
                                            Yes, additionally</option>
                                        <option {{ $report->extras_charged == 'No, all included' ? 'selected' : '' }}
                                            value="No, all included">No, all included</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="photos_authenticity">Photos
                                        authenticity
                                    </label>
                                    <select class="form-control" name="photos_authenticity" id="photos_authenticity">
                                        <option value="" selected="">Choose</option>
                                        <option {{ $report->photos_authenticity == '100% Real - Verified' ? 'selected' : '' }}
                                            value="100% Real - Verified">100% Real - Verified</option>
                                        <option
                                            {{ $report->photos_authenticity == 'Real, slightly retouched' ? 'selected' : '' }}
                                            value="Real, slightly retouched">Real, slightly retouched</option>
                                        <option
                                            {{ $report->photos_authenticity == 'Real, grossly retouched' ? 'selected' : '' }}
                                            value="Real, grossly retouched">Real, grossly retouched</option>
                                        <option
                                            {{ $report->photos_authenticity == 'Real, but outdated' ? 'selected' : '' }}
                                            value="Real, but outdated">Real, but outdated</option>
                                        <option {{ $report->photos_authenticity == 'Not real' ? 'selected' : '' }}
                                            value="Not real">Not real</option>
                                        <option
                                            {{ $report->photos_authenticity == 'No photos available - Unverified' ? 'selected' : '' }}
                                            value="No photos available - Unverified">No photos available - Unverified</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="ethnicity">Ethnicity</label>
                                    <select class="form-control" name="ethnicity" id="ethnicity">
                                        <option value="" selected="">Choose</option>
                                        <option {{ $report->ethnicity == 'asian' ? 'selected' : '' }} value="asian">
                                            Asian
                                        </option>
                                        <option {{ $report->ethnicity == 'Caucasian' ? 'selected' : '' }}
                                            value="Caucasian">Caucasian</option>
                                        <option {{ $report->ethnicity == 'Polynesian' ? 'selected' : '' }}
                                            value="Polynesian">Polynesian</option>
                                        <option {{ $report->ethnicity == 'Indian' ? 'selected' : '' }} value="Indian">
                                            Indian</option>
                                        <option {{ $report->ethnicity == 'African' ? 'selected' : '' }}
                                            value="African">
                                            African</option>
                                        <option {{ $report->ethnicity == 'Middle Eastern' ? 'selected' : '' }}
                                            value="Middle Eastern">Middle Eastern</option>

                                        <option {{ $report->ethnicity == 'Australian Aboriginal' ? 'selected' : '' }}
                                            value="Australian Aboriginal">Australian Aboriginal</option>

                                        <option {{ $report->ethnicity == 'American Indian' ? 'selected' : '' }}
                                            value="American Indian">American Indian</option>
                                        <option {{ $report->ethnicity == 'Mixed groups' ? 'selected' : '' }}
                                            value="Mixed groups">Mixed groups</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="nationality">Nationality </label>
                                    <select class="form-control" name="nationality" id="nationality">
                                        <option value="" selected="">Choose</option>
                                        <option {{ $report->nationality == 'Afghanistan' ? 'selected' : '' }} value="Afghanistan">
                                            Afghanistan</option>
                                        <option {{ $report->nationality == 'Albania' ? 'selected' : '' }} value="Albania">
                                            Albania</option>
                                        <option {{ $report->nationality == 'Algeria' ? 'selected' : '' }} value="Algeria">
                                            Algeria</option>
                                        <option {{ $report->nationality == 'American Samoa' ? 'selected' : '' }} value="American Samoa">
                                            American Samoa</option>
                                        <option {{ $report->nationality == 'Andorra' ? 'selected' : '' }} value="Andorra">
                                            Andorra</option>
                                        <option {{ $report->nationality == 'Angola' ? 'selected' : '' }} value="Angola">
                                            Angola
                                        </option>
                                        <option {{ $report->nationality == 'Anguilla' ? 'selected' : '' }} value="Anguilla">
                                            Anguilla</option>
                                        <option {{ $report->nationality == 'Antarctica' ? 'selected' : '' }} value="Antarctica">
                                            Antarctica</option>
                                        <option {{ $report->nationality == 'Antigua and Barbuda' ? 'selected' : '' }} value="Antigua and Barbuda">
                                            Antigua and Barbuda</option>
                                        <option {{ $report->nationality == 'Argentina' ? 'selected' : '' }} value="Argentina">
                                            Argentina</option>
                                        <option {{ $report->nationality == 'Armenia' ? 'selected' : '' }} value="Armenia">
                                            Armenia</option>
                                        <option {{ $report->nationality == 'Aruba' ? 'selected' : '' }} value="Aruba">
                                            Aruba
                                        </option>
                                        <option {{ $report->nationality == 'Australia' ? 'selected' : '' }} value="Australia">
                                            Australia</option>
                                        <option {{ $report->nationality == 'Austria' ? 'selected' : '' }} value="Austria">
                                            Austria</option>
                                        <option {{ $report->nationality == 'Azerbaijan' ? 'selected' : '' }} value="Azerbaijan">
                                            Azerbaijan</option>
                                        <option {{ $report->nationality == 'Bahamas' ? 'selected' : '' }} value="Bahamas">
                                            Bahamas</option>
                                        <option {{ $report->nationality == 'Bahrain' ? 'selected' : '' }} value="Bahrain">
                                            Bahrain</option>
                                        <option {{ $report->nationality == 'Bangladesh' ? 'selected' : '' }} value="Bangladesh">
                                            Bangladesh</option>
                                        <option {{ $report->nationality == 'Barbados' ? 'selected' : '' }} value="Barbados">
                                            Barbados</option>
                                        <option {{ $report->nationality == 'Belarus' ? 'selected' : '' }} value="Belarus">
                                            Belarus</option>
                                        <option {{ $report->nationality == 'Belgium' ? 'selected' : '' }} value="Belgium">
                                            Belgium</option>
                                        <option {{ $report->nationality == 'Belize' ? 'selected' : '' }} value="Belize">
                                            Belize
                                        </option>
                                        <option {{ $report->nationality == 'Benin' ? 'selected' : '' }} value="Benin">
                                            Benin
                                        </option>
                                        <option {{ $report->nationality == 'Bermuda' ? 'selected' : '' }} value="Bermuda">
                                            Bermuda</option>
                                        <option {{ $report->nationality == 'Bhutan' ? 'selected' : '' }} value="Bhutan">
                                            Bhutan
                                        </option>
                                        <option {{ $report->nationality == 'Bolivia' ? 'selected' : '' }} value="Bolivia">
                                            Bolivia</option>
                                        <option {{ $report->nationality == 'Bosnia and Herzegovina' ? 'selected' : '' }} value="Bosnia and Herzegovina">
                                            Bosnia
                                            and Herzegovina</option>
                                        <option {{ $report->nationality == 'Botswana' ? 'selected' : '' }} value="Botswana">
                                            Botswana</option>
                                        <option {{ $report->nationality == 'Bouvet Island' ? 'selected' : '' }} value="Bouvet Island">
                                            Bouvet
                                            Island</option>
                                        <option {{ $report->nationality == 'Brazil' ? 'selected' : '' }} value="Brazil">
                                            Brazil
                                        </option>
                                        <option {{ $report->nationality == 'British Indian Ocean Territory' ? 'selected' : '' }} value="British Indian Ocean Territory">
                                            British Indian Ocean Territory</option>
                                        <option {{ $report->nationality == 'British Virgin Islands' ? 'selected' : '' }} value="British Virgin Islands">
                                            British Virgin Islands</option>
                                        <option {{ $report->nationality == 'Brunei' ? 'selected' : '' }} value="Brunei">
                                            Brunei
                                        </option>
                                        <option {{ $report->nationality == 'Bulgaria' ? 'selected' : '' }} value="Bulgaria">
                                            Bulgaria</option>
                                        <option {{ $report->nationality == 'Burkina Faso' ? 'selected' : '' }} value="Burkina Faso">
                                            Burkina Faso</option>
                                        <option {{ $report->nationality == 'Burundi' ? 'selected' : '' }} value="Burundi">
                                            Burundi</option>
                                        <option {{ $report->nationality == 'Cambodia' ? 'selected' : '' }} value="Cambodia">
                                            Cambodia</option>
                                        <option {{ $report->nationality == 'Cameroon' ? 'selected' : '' }} value="Cameroon">
                                            Cameroon</option>
                                        <option {{ $report->nationality == 'Canada' ? 'selected' : '' }} value="Canada">
                                            Canada
                                        </option>
                                        <option {{ $report->nationality == 'Cape Verde' ? 'selected' : '' }} value="Cape Verde">
                                            Cape
                                            Verde</option>
                                        <option {{ $report->nationality == 'Cayman Islands' ? 'selected' : '' }} value="Cayman Islands">
                                            Cayman
                                            Islands</option>
                                        <option {{ $report->nationality == 'Central African Republic' ? 'selected' : '' }} value="Central African Republic">
                                            Central African Republic</option>
                                        <option {{ $report->nationality == 'Chad' ? 'selected' : '' }} value="Chad">
                                            Chad
                                        </option>
                                        <option {{ $report->nationality == 'Chile' ? 'selected' : '' }} value="Chile">
                                            Chile
                                        </option>
                                        <option {{ $report->nationality == 'China' ? 'selected' : '' }} value="China">
                                            China
                                        </option>
                                        <option {{ $report->nationality == 'Christmas Island' ? 'selected' : '' }} value="Christmas Island">
                                            Christmas Island</option>

                                        <option {{ $report->nationality == 'Cocos [Keeling] Islands' ? 'selected' : '' }} value="Cocos [Keeling] Islands">
                                            Cocos [Keeling] Islands
                                        </option>

                                        <option {{ $report->nationality == 'Colombia' ? 'selected' : '' }} value="Colombia">
                                            Colombia
                                        </option>

                                        <option {{ $report->nationality == 'Comoros' ? 'selected' : '' }} value="Comoros">
                                            Comoros
                                        </option>

                                        <option {{ $report->nationality == 'Congo [DRC]' ? 'selected' : '' }} value="Congo [DRC]">
                                            Congo [DRC]
                                        </option>

                                        <option {{ $report->nationality == 'Congo [Republic]' ? 'selected' : '' }} value="Congo [Republic]">
                                            Congo [Republic]
                                        </option>

                                        <option {{ $report->nationality == 'Cook Islands' ? 'selected' : '' }} value="Cook Islands">
                                            Cook Islands
                                        </option>

                                        <option {{ $report->nationality == 'Costa Rica' ? 'selected' : '' }} value="Costa Rica">
                                            Costa Rica
                                        </option>

                                        <option {{ $report->nationality == "Côte d'Ivoire" ? 'selected' : '' }} value="Côte d'Ivoire">
                                            Côte d'Ivoire
                                        </option>

                                        <option {{ $report->nationality == 'Croatia' ? 'selected' : '' }} value="Croatia">
                                            Croatia
                                        </option>

                                        <option {{ $report->nationality == 'Cuba' ? 'selected' : '' }} value="Cuba">
                                            Cuba
                                        </option>

                                        <option {{ $report->nationality == 'Cyprus' ? 'selected' : '' }} value="Cyprus">
                                            Cyprus
                                        </option>

                                        <option {{ $report->nationality == 'Czech Republic' ? 'selected' : '' }} value="Czech Republic">
                                            Czech Republic
                                        </option>

                                        <option {{ $report->nationality == 'Denmark' ? 'selected' : '' }} value="Denmark">
                                            Denmark
                                        </option>

                                        <option {{ $report->nationality == 'Djibouti' ? 'selected' : '' }} value="Djibouti">
                                            Djibouti
                                        </option>

                                        <option {{ $report->nationality == 'Dominica' ? 'selected' : '' }} value="Dominica">
                                            Dominica
                                        </option>

                                        <option {{ $report->nationality == 'Dominican Republic' ? 'selected' : '' }} value="Dominican Republic">
                                            Dominican Republic
                                        </option>

                                        <option {{ $report->nationality == 'Ecuador' ? 'selected' : '' }} value="Ecuador">
                                            Ecuador
                                        </option>

                                        <option {{ $report->nationality == 'Egypt' ? 'selected' : '' }} value="Egypt">
                                            Egypt
                                        </option>

                                        <option {{ $report->nationality == 'El Salvador' ? 'selected' : '' }} value="El Salvador">
                                            El Salvador
                                        </option>

                                        <option {{ $report->nationality == 'Equatorial Guinea' ? 'selected' : '' }} value="Equatorial Guinea">
                                            Equatorial Guinea
                                        </option>

                                        <option {{ $report->nationality == 'Eritrea' ? 'selected' : '' }} value="Eritrea">
                                            Eritrea
                                        </option>

                                        <option {{ $report->nationality == 'Estonia' ? 'selected' : '' }} value="Estonia">
                                            Estonia
                                        </option>

                                        <option {{ $report->nationality == 'Ethiopia' ? 'selected' : '' }} value="Ethiopia">
                                            Ethiopia
                                        </option>

                                        <option {{ $report->nationality == 'Falkland Islands [Islas Malvinas]' ? 'selected' : '' }} value="Falkland Islands [Islas Malvinas]">
                                            Falkland Islands [Islas Malvinas]
                                        </option>

                                        <option {{ $report->nationality == 'Faroe Islands' ? 'selected' : '' }} value="Faroe Islands">
                                            Faroe Islands
                                        </option>

                                        <option {{ $report->nationality == 'Fiji' ? 'selected' : '' }} value="Fiji">
                                            Fiji
                                        </option>

                                        <option {{ $report->nationality == 'Finland' ? 'selected' : '' }} value="Finland">
                                            Finland
                                        </option>

                                        <option {{ $report->nationality == 'France' ? 'selected' : '' }} value="France">
                                            France
                                        </option>

                                        <option {{ $report->nationality == 'French Guiana' ? 'selected' : '' }} value="French Guiana">
                                            French Guiana
                                        </option>

                                        <option {{ $report->nationality == 'French Polynesia' ? 'selected' : '' }} value="French Polynesia">
                                            French Polynesia
                                        </option>

                                        <option {{ $report->nationality == 'French Southern Territories' ? 'selected' : '' }} value="French Southern Territories">
                                            French Southern Territories
                                        </option>

                                        <option {{ $report->nationality == 'Gabon' ? 'selected' : '' }} value="Gabon">
                                            Gabon
                                        </option>

                                        <option {{ $report->nationality == 'Gambia' ? 'selected' : '' }} value="Gambia">
                                            Gambia
                                        </option>

                                        <option {{ $report->nationality == 'Gaza Strip' ? 'selected' : '' }} value="Gaza Strip">
                                            Gaza Strip
                                        </option>

                                        <option {{ $report->nationality == 'Georgia' ? 'selected' : '' }} value="Georgia">
                                            Georgia
                                        </option>

                                        <option {{ $report->nationality == 'Germany' ? 'selected' : '' }} value="Germany">
                                            Germany
                                        </option>

                                        <option {{ $report->nationality == 'Ghana' ? 'selected' : '' }} value="Ghana">
                                            Ghana
                                        </option>

                                        <option {{ $report->nationality == 'Gibraltar' ? 'selected' : '' }} value="Gibraltar">
                                            Gibraltar
                                        </option>

                                        <option {{ $report->nationality == 'Greece' ? 'selected' : '' }} value="Greece">
                                            Greece
                                        </option>

                                        <option {{ $report->nationality == 'Greenland' ? 'selected' : '' }} value="Greenland">
                                            Greenland
                                        </option>

                                        <option {{ $report->nationality == 'Grenada' ? 'selected' : '' }} value="Grenada">
                                            Grenada
                                        </option>

                                        <option {{ $report->nationality == 'Guadeloupe' ? 'selected' : '' }} value="Guadeloupe">
                                            Guadeloupe
                                        </option>

                                        <option {{ $report->nationality == 'Guam' ? 'selected' : '' }} value="Guam">
                                            Guam
                                        </option>

                                        <option {{ $report->nationality == 'Guatemala' ? 'selected' : '' }} value="Guatemala">
                                            Guatemala
                                        </option>

                                        <option {{ $report->nationality == 'Guernsey' ? 'selected' : '' }} value="Guernsey">
                                            Guernsey
                                        </option>

                                        <option {{ $report->nationality == 'Guinea' ? 'selected' : '' }} value="Guinea">
                                            Guinea
                                        </option>

                                        <option {{ $report->nationality == 'Guinea-Bissau' ? 'selected' : '' }} value="Guinea-Bissau">
                                            Guinea-Bissau
                                        </option>

                                        <option {{ $report->nationality == 'Guyana' ? 'selected' : '' }} value="Guyana">
                                            Guyana
                                        </option>

                                        <option {{ $report->nationality == 'Haiti' ? 'selected' : '' }} value="Haiti">
                                            Haiti
                                        </option>

                                        <option {{ $report->nationality == 'Heard Island and McDonald Islands' ? 'selected' : '' }} value="Heard Island and McDonald Islands">
                                            Heard Island and McDonald Islands
                                        </option>

                                        <option {{ $report->nationality == 'Honduras' ? 'selected' : '' }} value="Honduras">
                                            Honduras
                                        </option>

                                        <option {{ $report->nationality == 'Hong Kong' ? 'selected' : '' }} value="Hong Kong">
                                            Hong Kong
                                        </option>

                                        <option {{ $report->nationality == 'Hungary' ? 'selected' : '' }} value="Hungary">
                                            Hungary
                                        </option>

                                        <option {{ $report->nationality == 'Iceland' ? 'selected' : '' }} value="Iceland">
                                            Iceland
                                        </option>

                                        <option {{ $report->nationality == 'India' ? 'selected' : '' }} value="India">
                                            India
                                        </option>

                                        <option {{ $report->nationality == 'Indonesia' ? 'selected' : '' }} value="Indonesia">
                                            Indonesia
                                        </option>

                                        <option {{ $report->nationality == 'Iran' ? 'selected' : '' }} value="Iran">
                                            Iran
                                        </option>

                                        <option {{ $report->nationality == 'Iraq' ? 'selected' : '' }} value="Iraq">
                                            Iraq
                                        </option>

                                        <option {{ $report->nationality == 'Ireland' ? 'selected' : '' }} value="Ireland">
                                            Ireland
                                        </option>

                                        <option {{ $report->nationality == 'Isle of Man' ? 'selected' : '' }} value="Isle of Man">
                                            Isle of Man
                                        </option>

                                        <option {{ $report->nationality == 'Israel' ? 'selected' : '' }} value="Israel">
                                            Israel
                                        </option>

                                        <option {{ $report->nationality == 'Italy' ? 'selected' : '' }} value="Italy">
                                            Italy
                                        </option>

                                        <option {{ $report->nationality == 'Jamaica' ? 'selected' : '' }} value="Jamaica">
                                            Jamaica
                                        </option>

                                        <option {{ $report->nationality == 'Japan' ? 'selected' : '' }} value="Japan">
                                            Japan
                                        </option>

                                        <option {{ $report->nationality == 'Jersey' ? 'selected' : '' }} value="Jersey">
                                            Jersey
                                        </option>

                                        <option {{ $report->nationality == 'Jordan' ? 'selected' : '' }} value="Jordan">
                                            Jordan
                                        </option>

                                        <option {{ $report->nationality == 'Kazakhstan' ? 'selected' : '' }} value="Kazakhstan">
                                            Kazakhstan
                                        </option>

                                        <option {{ $report->nationality == 'Kenya' ? 'selected' : '' }} value="Kenya">
                                            Kenya
                                        </option>

                                        <option {{ $report->nationality == 'Kiribati' ? 'selected' : '' }} value="Kiribati">
                                            Kiribati
                                        </option>

                                        <option {{ $report->nationality == 'Kosovo' ? 'selected' : '' }} value="Kosovo">
                                            Kosovo
                                        </option>

                                        <option {{ $report->nationality == 'Kuwait' ? 'selected' : '' }} value="Kuwait">
                                            Kuwait
                                        </option>

                                        <option {{ $report->nationality == 'Kyrgyzstan' ? 'selected' : '' }} value="Kyrgyzstan">
                                            Kyrgyzstan
                                        </option>

                                        <option {{ $report->nationality == 'Laos' ? 'selected' : '' }} value="Laos">
                                            Laos
                                        </option>

                                        <option {{ $report->nationality == 'Latvia' ? 'selected' : '' }} value="Latvia">
                                            Latvia
                                        </option>

                                        <option {{ $report->nationality == 'Lebanon' ? 'selected' : '' }} value="Lebanon">
                                            Lebanon
                                        </option>

                                        <option {{ $report->nationality == 'Lesotho' ? 'selected' : '' }} value="Lesotho">
                                            Lesotho
                                        </option>

                                        <option {{ $report->nationality == 'Liberia' ? 'selected' : '' }} value="Liberia">
                                            Liberia
                                        </option>

                                        <option {{ $report->nationality == 'Libya' ? 'selected' : '' }} value="Libya">
                                            Libya
                                        </option>

                                        <option {{ $report->nationality == 'Liechtenstein' ? 'selected' : '' }} value="Liechtenstein">
                                            Liechtenstein
                                        </option>

                                        <option {{ $report->nationality == 'Lithuania' ? 'selected' : '' }} value="Lithuania">
                                            Lithuania
                                        </option>

                                        <option {{ $report->nationality == 'Luxembourg' ? 'selected' : '' }} value="Luxembourg">
                                            Luxembourg
                                        </option>

                                        <option {{ $report->nationality == 'Macau' ? 'selected' : '' }} value="Macau">
                                            Macau
                                        </option>

                                        <option {{ $report->nationality == 'Macedonia [FYROM]' ? 'selected' : '' }} value="Macedonia [FYROM]">
                                            Macedonia [FYROM]
                                        </option>

                                        <option {{ $report->nationality == 'Madagascar' ? 'selected' : '' }} value="Madagascar">
                                            Madagascar
                                        </option>

                                        <option {{ $report->nationality == 'Malawi' ? 'selected' : '' }} value="Malawi">
                                            Malawi
                                        </option>

                                        <option {{ $report->nationality == 'Malaysia' ? 'selected' : '' }} value="Malaysia">
                                            Malaysia
                                        </option>

                                        <option {{ $report->nationality == 'Maldives' ? 'selected' : '' }} value="Maldives">
                                            Maldives
                                        </option>

                                        <option {{ $report->nationality == 'Mali' ? 'selected' : '' }} value="Mali">
                                            Mali
                                        </option>

                                        <option {{ $report->nationality == 'Malta' ? 'selected' : '' }} value="Malta">
                                            Malta
                                        </option>

                                        <option {{ $report->nationality == 'Marshall Islands' ? 'selected' : '' }} value="Marshall Islands">
                                            Marshall Islands
                                        </option>

                                        <option {{ $report->nationality == 'Martinique' ? 'selected' : '' }} value="Martinique">
                                            Martinique
                                        </option>

                                        <option {{ $report->nationality == 'Mauritania' ? 'selected' : '' }} value="Mauritania">
                                            Mauritania
                                        </option>

                                        <option {{ $report->nationality == 'Mauritius' ? 'selected' : '' }} value="Mauritius">
                                            Mauritius
                                        </option>

                                        <option {{ $report->nationality == 'Mayotte' ? 'selected' : '' }} value="Mayotte">
                                            Mayotte
                                        </option>

                                        <option {{ $report->nationality == 'Mexico' ? 'selected' : '' }} value="Mexico">
                                            Mexico
                                        </option>

                                        <option {{ $report->nationality == 'Micronesia' ? 'selected' : '' }} value="Micronesia">
                                            Micronesia
                                        </option>

                                        <option {{ $report->nationality == 'Moldova' ? 'selected' : '' }} value="Moldova">
                                            Moldova
                                        </option>

                                        <option {{ $report->nationality == 'Monaco' ? 'selected' : '' }} value="Monaco">
                                            Monaco
                                        </option>

                                        <option {{ $report->nationality == 'Mongolia' ? 'selected' : '' }} value="Mongolia">
                                            Mongolia
                                        </option>

                                        <option {{ $report->nationality == 'Montenegro' ? 'selected' : '' }} value="Montenegro">
                                            Montenegro
                                        </option>

                                        <option {{ $report->nationality == 'Montserrat' ? 'selected' : '' }} value="Montserrat">
                                            Montserrat
                                        </option>

                                        <option {{ $report->nationality == 'Morocco' ? 'selected' : '' }} value="Morocco">
                                            Morocco
                                        </option>

                                        <option {{ $report->nationality == 'Mozambique' ? 'selected' : '' }} value="Mozambique">
                                            Mozambique
                                        </option>

                                        <option {{ $report->nationality == 'Myanmar [Burma]' ? 'selected' : '' }} value="Myanmar [Burma]">
                                            Myanmar [Burma]
                                        </option>

                                        <option {{ $report->nationality == 'Namibia' ? 'selected' : '' }} value="Namibia">
                                            Namibia
                                        </option>

                                        <option {{ $report->nationality == 'Nauru' ? 'selected' : '' }} value="Nauru">
                                            Nauru
                                        </option>

                                        <option {{ $report->nationality == 'Nepal' ? 'selected' : '' }} value="Nepal">
                                            Nepal
                                        </option>

                                        <option {{ $report->nationality == 'Netherlands' ? 'selected' : '' }} value="Netherlands">
                                            Netherlands
                                        </option>

                                        <option {{ $report->nationality == 'Netherlands Antilles' ? 'selected' : '' }} value="Netherlands Antilles">
                                            Netherlands Antilles
                                        </option>

                                        <option {{ $report->nationality == 'New Caledonia' ? 'selected' : '' }} value="New Caledonia">
                                            New Caledonia
                                        </option>

                                        <option {{ $report->nationality == 'New Zealand' ? 'selected' : '' }} value="New Zealand">
                                            New Zealand
                                        </option>

                                        <option {{ $report->nationality == 'Nicaragua' ? 'selected' : '' }} value="Nicaragua">
                                            Nicaragua
                                        </option>

                                        <option {{ $report->nationality == 'Niger' ? 'selected' : '' }} value="Niger">
                                            Niger
                                        </option>

                                        <option {{ $report->nationality == 'Nigeria' ? 'selected' : '' }} value="Nigeria">
                                            Nigeria
                                        </option>

                                        <option {{ $report->nationality == 'Niue' ? 'selected' : '' }} value="Niue">
                                            Niue
                                        </option>

                                        <option {{ $report->nationality == 'Norfolk Island' ? 'selected' : '' }} value="Norfolk Island">
                                            Norfolk Island
                                        </option>

                                        <option {{ $report->nationality == 'North Korea' ? 'selected' : '' }} value="North Korea">
                                            North Korea
                                        </option>

                                        <option {{ $report->nationality == 'Northern Mariana Islands' ? 'selected' : '' }} value="Northern Mariana Islands">
                                            Northern Mariana Islands
                                        </option>

                                        <option {{ $report->nationality == 'Norway' ? 'selected' : '' }} value="Norway">
                                            Norway
                                        </option>

                                        <option {{ $report->nationality == 'Oman' ? 'selected' : '' }} value="Oman">
                                            Oman
                                        </option>

                                        <option {{ $report->nationality == 'Pakistan' ? 'selected' : '' }} value="Pakistan">
                                            Pakistan
                                        </option>

                                        <option {{ $report->nationality == 'Palau' ? 'selected' : '' }} value="Palau">
                                            Palau
                                        </option>

                                        <option {{ $report->nationality == 'Palestinian Territories' ? 'selected' : '' }} value="Palestinian Territories">
                                            Palestinian Territories
                                        </option>

                                        <option {{ $report->nationality == 'Panama' ? 'selected' : '' }} value="Panama">
                                            Panama
                                        </option>

                                        <option {{ $report->nationality == 'Papua New Guinea' ? 'selected' : '' }} value="Papua New Guinea">
                                            Papua New Guinea
                                        </option>

                                        <option {{ $report->nationality == 'Paraguay' ? 'selected' : '' }} value="Paraguay">
                                            Paraguay
                                        </option>

                                        <option {{ $report->nationality == 'Peru' ? 'selected' : '' }} value="Peru">
                                            Peru
                                        </option>

                                        <option {{ $report->nationality == 'Philippines' ? 'selected' : '' }} value="Philippines">
                                            Philippines
                                        </option>

                                        <option {{ $report->nationality == 'Pitcairn Islands' ? 'selected' : '' }} value="Pitcairn Islands">
                                            Pitcairn Islands
                                        </option>

                                        <option {{ $report->nationality == 'Poland' ? 'selected' : '' }} value="Poland">
                                            Poland
                                        </option>

                                        <option {{ $report->nationality == 'Portugal' ? 'selected' : '' }} value="Portugal">
                                            Portugal
                                        </option>

                                        <option {{ $report->nationality == 'Puerto Rico' ? 'selected' : '' }} value="Puerto Rico">
                                            Puerto Rico
                                        </option>

                                        <option {{ $report->nationality == 'Qatar' ? 'selected' : '' }} value="Qatar">
                                            Qatar
                                        </option>

                                        <option {{ $report->nationality == 'Réunion' ? 'selected' : '' }} value="Réunion">
                                            Réunion
                                        </option>

                                        <option {{ $report->nationality == 'Romania' ? 'selected' : '' }} value="Romania">
                                            Romania
                                        </option>

                                        <option {{ $report->nationality == 'Russia' ? 'selected' : '' }} value="Russia">
                                            Russia
                                        </option>

                                        <option {{ $report->nationality == 'Rwanda' ? 'selected' : '' }} value="Rwanda">
                                            Rwanda
                                        </option>

                                        <option {{ $report->nationality == 'Saint Helena' ? 'selected' : '' }} value="Saint Helena">
                                            Saint Helena
                                        </option>

                                        <option {{ $report->nationality == 'Saint Kitts and Nevis' ? 'selected' : '' }} value="Saint Kitts and Nevis">
                                            Saint Kitts and Nevis
                                        </option>

                                        <option {{ $report->nationality == 'Saint Lucia' ? 'selected' : '' }} value="Saint Lucia">
                                            Saint Lucia
                                        </option>

                                        <option {{ $report->nationality == 'Saint Pierre and Miquelon' ? 'selected' : '' }} value="Saint Pierre and Miquelon">
                                            Saint Pierre and Miquelon
                                        </option>

                                        <option {{ $report->nationality == 'Saint Vincent and the Grenadines' ? 'selected' : '' }} value="Saint Vincent and the Grenadines">
                                            Saint Vincent and the Grenadines
                                        </option>

                                        <option {{ $report->nationality == 'Samoa' ? 'selected' : '' }} value="Samoa">
                                            Samoa
                                        </option>

                                        <option {{ $report->nationality == 'San Marino' ? 'selected' : '' }} value="San Marino">
                                            San Marino
                                        </option>

                                        <option {{ $report->nationality == 'São Tomé and Príncipe' ? 'selected' : '' }} value="São Tomé and Príncipe">
                                            São Tomé and Príncipe
                                        </option>

                                        <option {{ $report->nationality == 'Saudi Arabia' ? 'selected' : '' }} value="Saudi Arabia">
                                            Saudi Arabia
                                        </option>

                                        <option {{ $report->nationality == 'Senegal' ? 'selected' : '' }} value="Senegal">
                                            Senegal
                                        </option>

                                        <option {{ $report->nationality == 'Serbia' ? 'selected' : '' }} value="Serbia">
                                            Serbia
                                        </option>

                                        <option {{ $report->nationality == 'Seychelles' ? 'selected' : '' }} value="Seychelles">
                                            Seychelles
                                        </option>

                                        <option {{ $report->nationality == 'Sierra Leone' ? 'selected' : '' }} value="Sierra Leone">
                                            Sierra Leone
                                        </option>

                                        <option {{ $report->nationality == 'Singapore' ? 'selected' : '' }} value="Singapore">
                                            Singapore
                                        </option>

                                        <option {{ $report->nationality == 'Slovakia' ? 'selected' : '' }} value="Slovakia">
                                            Slovakia
                                        </option>

                                        <option {{ $report->nationality == 'Slovenia' ? 'selected' : '' }} value="Slovenia">
                                            Slovenia
                                        </option>

                                        <option {{ $report->nationality == 'Solomon Islands' ? 'selected' : '' }} value="Solomon Islands">
                                            Solomon Islands
                                        </option>

                                        <option {{ $report->nationality == 'Somalia' ? 'selected' : '' }} value="Somalia">
                                            Somalia
                                        </option>

                                        <option {{ $report->nationality == 'South Africa' ? 'selected' : '' }} value="South Africa">
                                            South Africa
                                        </option>

                                        <option {{ $report->nationality == 'South Georgia and the South Sandwich Islands' ? 'selected' : '' }} value="South Georgia and the South Sandwich Islands">
                                            South Georgia and the South Sandwich Islands
                                        </option>

                                        <option {{ $report->nationality == 'South Korea' ? 'selected' : '' }} value="South Korea">
                                            South Korea
                                        </option>

                                        <option {{ $report->nationality == 'Spain' ? 'selected' : '' }} value="Spain">
                                            Spain
                                        </option>

                                        <option {{ $report->nationality == 'Sri Lanka' ? 'selected' : '' }} value="Sri Lanka">
                                            Sri Lanka
                                        </option>

                                        <option {{ $report->nationality == 'Sudan' ? 'selected' : '' }} value="Sudan">
                                            Sudan
                                        </option>

                                        <option {{ $report->nationality == 'Suriname' ? 'selected' : '' }} value="Suriname">
                                            Suriname
                                        </option>

                                        <option {{ $report->nationality == 'Svalbard and Jan Mayen' ? 'selected' : '' }} value="Svalbard and Jan Mayen">
                                            Svalbard and Jan Mayen
                                        </option>

                                        <option {{ $report->nationality == 'Swaziland' ? 'selected' : '' }} value="Swaziland">
                                            Swaziland
                                        </option>

                                        <option {{ $report->nationality == 'Sweden' ? 'selected' : '' }} value="Sweden">
                                            Sweden
                                        </option>

                                        <option {{ $report->nationality == 'Switzerland' ? 'selected' : '' }} value="Switzerland">
                                            Switzerland
                                        </option>

                                        <option {{ $report->nationality == 'Syria' ? 'selected' : '' }} value="Syria">
                                            Syria
                                        </option>

                                        <option {{ $report->nationality == 'Taiwan' ? 'selected' : '' }} value="Taiwan">
                                            Taiwan
                                        </option>

                                        <option {{ $report->nationality == 'Tajikistan' ? 'selected' : '' }} value="Tajikistan">
                                            Tajikistan
                                        </option>

                                        <option {{ $report->nationality == 'Tanzania' ? 'selected' : '' }} value="Tanzania">
                                            Tanzania
                                        </option>

                                        <option {{ $report->nationality == 'Thailand' ? 'selected' : '' }} value="Thailand">
                                            Thailand
                                        </option>

                                        <option {{ $report->nationality == 'Timor-Leste' ? 'selected' : '' }} value="Timor-Leste">
                                            Timor-Leste
                                        </option>

                                        <option {{ $report->nationality == 'Togo' ? 'selected' : '' }} value="Togo">
                                            Togo
                                        </option>

                                        <option {{ $report->nationality == 'Tokelau' ? 'selected' : '' }} value="Tokelau">
                                            Tokelau
                                        </option>

                                        <option {{ $report->nationality == 'Tonga' ? 'selected' : '' }} value="Tonga">
                                            Tonga
                                        </option>

                                        <option {{ $report->nationality == 'Trinidad and Tobago' ? 'selected' : '' }} value="Trinidad and Tobago">
                                            Trinidad and Tobago
                                        </option>

                                        <option {{ $report->nationality == 'Tunisia' ? 'selected' : '' }} value="Tunisia">
                                            Tunisia
                                        </option>

                                        <option {{ $report->nationality == 'Turkey' ? 'selected' : '' }} value="Turkey">
                                            Turkey
                                        </option>

                                        <option {{ $report->nationality == 'Turkmenistan' ? 'selected' : '' }} value="Turkmenistan">
                                            Turkmenistan
                                        </option>

                                        <option {{ $report->nationality == 'Turks and Caicos Islands' ? 'selected' : '' }} value="Turks and Caicos Islands">
                                            Turks and Caicos Islands
                                        </option>

                                        <option {{ $report->nationality == 'Tuvalu' ? 'selected' : '' }} value="Tuvalu">
                                            Tuvalu
                                        </option>

                                        <option {{ $report->nationality == 'U.S. Minor Outlying Islands' ? 'selected' : '' }} value="U.S. Minor Outlying Islands">
                                            U.S. Minor Outlying Islands
                                        </option>

                                        <option {{ $report->nationality == 'U.S. Virgin Islands' ? 'selected' : '' }} value="U.S. Virgin Islands">
                                            U.S. Virgin Islands
                                        </option>

                                        <option {{ $report->nationality == 'Uganda' ? 'selected' : '' }} value="Uganda">
                                            Uganda
                                        </option>

                                        <option {{ $report->nationality == 'Ukraine' ? 'selected' : '' }} value="Ukraine">
                                            Ukraine
                                        </option>

                                        <option {{ $report->nationality == 'United Arab Emirates' ? 'selected' : '' }} value="United Arab Emirates">
                                            United Arab Emirates
                                        </option>

                                        <option {{ $report->nationality == 'United Kingdom' ? 'selected' : '' }} value="United Kingdom">
                                            United Kingdom
                                        </option>

                                        <option {{ $report->nationality == 'United States' ? 'selected' : '' }} value="United States">
                                            United States
                                        </option>

                                        <option {{ $report->nationality == 'Uruguay' ? 'selected' : '' }} value="Uruguay">
                                            Uruguay
                                        </option>

                                        <option {{ $report->nationality == 'Uzbekistan' ? 'selected' : '' }} value="Uzbekistan">
                                            Uzbekistan
                                        </option>

                                        <option {{ $report->nationality == 'Vanuatu' ? 'selected' : '' }} value="Vanuatu">
                                            Vanuatu
                                        </option>

                                        <option {{ $report->nationality == 'Vatican City' ? 'selected' : '' }} value="Vatican City">
                                            Vatican City
                                        </option>

                                        <option {{ $report->nationality == 'Venezuela' ? 'selected' : '' }} value="Venezuela">
                                            Venezuela
                                        </option>

                                        <option {{ $report->nationality == 'Vietnam' ? 'selected' : '' }} value="Vietnam">
                                            Vietnam
                                        </option>

                                        <option {{ $report->nationality == 'Wallis and Futuna' ? 'selected' : '' }} value="Wallis and Futuna">
                                            Wallis and Futuna
                                        </option>

                                        <option {{ $report->nationality == 'Western Sahara' ? 'selected' : '' }} value="Western Sahara">
                                            Western Sahara
                                        </option>

                                        <option {{ $report->nationality == 'Yemen' ? 'selected' : '' }} value="Yemen">
                                            Yemen
                                        </option>

                                        <option {{ $report->nationality == 'Zambia' ? 'selected' : '' }} value="Zambia">
                                            Zambia
                                        </option>

                                        <option {{ $report->nationality == 'Zimbabwe' ? 'selected' : '' }} value="Zimbabwe">
                                            Zimbabwe
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="estimated_age">Estimated age</label>
                                    <select class="form-control" name="estimated_age" id="estimated_age">
                                        <option value="" selected="">Choose</option>
                                        <option {{ $report->estimated_age == '18-20' ? 'selected' : '' }}
                                            value="18-20">
                                            18 - 20</option>
                                        <option {{ $report->estimated_age == '21-25' ? 'selected' : '' }}
                                            value="21-25">
                                            21 - 25</option>
                                        <option {{ $report->estimated_age == '26-30' ? 'selected' : '' }}
                                            value="26-30">
                                            26 - 30</option>
                                        <option {{ $report->estimated_age == '31-35' ? 'selected' : '' }}
                                            value="31-35">
                                            31 - 35</option>
                                        <option {{ $report->estimated_age == '36-40' ? 'selected' : '' }}
                                            value="36-40">
                                            36 - 40</option>
                                        <option {{ $report->estimated_age == '41-45' ? 'selected' : '' }}
                                            value="41-45">
                                            41 - 45</option>
                                        <option {{ $report->estimated_age == 'over-45' ? 'selected' : '' }}
                                            value="over-45">Over 45</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="body_shape">Body shape </label>
                                    <select class="form-control" name="body_shape" id="body_shape">
                                        <option value="" selected="">Choose</option>
                                        <option {{ $report->body_shape == 'athletic' ? 'selected' : '' }}
                                            value="athletic">Athletic</option>
                                        <option {{ $report->body_shape == 'Curvy' ? 'selected' : '' }}
                                            value="Curvy">
                                            Curvy</option>
                                        <option {{ $report->body_shape == 'Fat' ? 'selected' : '' }} value="Fat">
                                            Fat
                                        </option>
                                        <option {{ $report->body_shape == 'Full-figured' ? 'selected' : '' }}
                                            value="Full-figured">Full-figured</option>

                                        <option {{ $report->body_shape == 'Large' ? 'selected' : '' }}
                                            value="Large">
                                            Large</option>
                                        <option {{ $report->body_shape == 'Petite' ? 'selected' : '' }}
                                            value="Petite">
                                            Petite</option>
                                        <option {{ $report->body_shape == 'Slim' ? 'selected' : '' }} value="Slim">
                                            Slim
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="overall_looks">Overall looks</label>
                                    <select class="form-control" name="overall_looks" id="overall_looks">
                                        <option value="" selected="">Choose</option>
                                        <option
                                            {{ $report->overall_looks == 'An absolute Goddess' ? 'selected' : '' }}
                                            value="An absolute Goddess">An absolute Goddess</option>
                                            
                                        <option {{ $report->overall_looks == 'Attractive' ? 'selected' : '' }}
                                            value="Attractive">Attractive</option>

                                        <option {{ $report->overall_looks == 'Average' ? 'selected' : '' }}
                                            value="Average">Average</option>

                                        <option {{ $report->overall_looks == 'Beautiful' ? 'selected' : '' }}
                                            value="Beautiful">Beautiful</option>

                                        <option {{ $report->overall_looks == 'Easy on the eye' ? 'selected' : '' }}
                                            value="Easy on the eye">Easy on the eye</option>

                                        <option {{ $report->overall_looks == 'Fit and muscular' ? 'selected' : '' }}
                                            value="Fit and muscular">Fit and muscular</option>

                                        <option {{ $report->overall_looks == 'Model material' ? 'selected' : '' }}
                                            value="Model material">Model material</option>

                                        <option {{ $report->overall_looks == 'Not attractive' ? 'selected' : '' }}
                                            value="Not attractive">Not attractive</option>

                                        <option {{ $report->overall_looks == 'Plain' ? 'selected' : '' }}
                                            value="Plain">
                                            Plain</option>
                                        <option {{ $report->overall_looks == 'Porn star material' ? 'selected' : '' }}
                                            value="Porn star material">Porn star material</option>
                                        <option {{ $report->overall_looks == 'Pretty' ? 'selected' : '' }}
                                            value="Pretty">Pretty</option>

                                        <option {{ $report->overall_looks == 'Very attractive' ? 'selected' : '' }}
                                            value="Very attractive">Very attractive</option>

                                        <option {{ $report->overall_looks == 'Very pretty' ? 'selected' : '' }}
                                            value="Very pretty">Very pretty</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for='overall_personality'>Overall
                                        personality</label>
                                    <select class="form-control" name="overall_personality" id="overall_personality">
                                        <option value="" selected="">Choose</option>
                                        <option {{ $report->overall_personality == 'Arrogant' ? 'selected' : '' }}
                                            value="Arrogant">Arrogant</option>

                                        <option {{ $report->overall_personality == 'Bitchy' ? 'selected' : '' }}
                                            value="Bitchy">Bitchy</option>

                                        <option {{ $report->overall_personality == 'Boring' ? 'selected' : '' }}
                                            value="Boring">Boring</option>
                                        <option {{ $report->overall_personality == 'Bossy' ? 'selected' : '' }}
                                            value="Bossy">Bossy</option>
                                        <option {{ $report->overall_personality == 'Cheeky' ? 'selected' : '' }}
                                            value="Cheeky">Cheeky</option>
                                        <option {{ $report->overall_personality == 'Cold' ? 'selected' : '' }}
                                            value="Cold">Cold</option>

                                        <option {{ $report->overall_personality == 'Engaging' ? 'selected' : '' }}
                                            value="Engaging">Engaging</option>

                                        <option {{ $report->overall_personality == 'Fake' ? 'selected' : '' }}
                                            value="Fake">Fake</option>

                                        <option {{ $report->overall_personality == 'Friendly' ? 'selected' : '' }}
                                            value="Friendly">Friendly</option>

                                        <option {{ $report->overall_personality == 'Fun' ? 'selected' : '' }}
                                            value="Fun">Fun</option>

                                        <option {{ $report->overall_personality == 'Liar' ? 'selected' : '' }}
                                            value="Liar">Liar</option>
                                        <option {{ $report->overall_personality == 'Lovely' ? 'selected' : '' }}
                                            value="Lovely">Lovely</option>

                                        <option {{ $report->overall_personality == 'Nut case' ? 'selected' : '' }}
                                            value="Nut case">Nut case</option>

                                        <option {{ $report->overall_personality == 'Outgoing' ? 'selected' : '' }}
                                            value="Outgoing">Outgoing</option>

                                        <option {{ $report->overall_personality == 'Over rates' ? 'selected' : '' }}
                                            value="Over rates">Over rates</option>

                                        <option {{ $report->overall_personality == 'Pleasant' ? 'selected' : '' }}
                                            value="Pleasant">Pleasant</option>

                                        <option {{ $report->overall_personality == 'Quiet' ? 'selected' : '' }}
                                            value="Quiet">Quiet</option>

                                        <option {{ $report->overall_personality == 'Rude' ? 'selected' : '' }}
                                            value="Rude">Rude</option>

                                        <option {{ $report->overall_personality == 'Shy' ? 'selected' : '' }}
                                            value="Shy">Shy</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="bd">B&D </label>
                                    <select class="form-control" name="bd" id="bd">
                                        <option value="" selected="">Choose</option>
                                        <option {{ $report->bd == 'Dominant' ? 'selected' : '' }} value="Dominant">
                                            Dominant</option>
                                        <option {{ $report->bd == 'Submissive' ? 'selected' : '' }}
                                            value="Submissive">
                                            Submissive</option>
                                        <option {{ $report->bd == 'Dominant and/or submissive' ? 'selected' : '' }} value="Dominant and/or submissive">Dominant and/or submissive</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="blowjob">Blowjob </label>
                                    <select class="form-control" name="blowjob" id="blowjob">
                                        <option value="" selected="">Choose</option>

                                        <option {{ $report->blowjob == 'Yes, fellatio' ? 'selected' : '' }}
                                            value="Yes, fellatio">Yes, fellatio</option>

                                        <option {{ $report->blowjob == 'Yes, CBJ' ? 'selected' : '' }}
                                            value="Yes, CBJ">
                                            Yes, CBJ</option>

                                        <option {{ $report->blowjob == 'Yes, BBBJ' ? 'selected' : '' }}
                                            value="Yes, BBBJ">
                                            Yes, BBBJ</option>

                                        <option {{ $report->blowjob == 'Yes, BBBJ and CIM' ? 'selected' : '' }}
                                            value="Yes, BBBJ and CIM">Yes, BBBJ and CIM</option>

                                        <option {{ $report->blowjob == 'No' ? 'selected' : '' }} value="No">No
                                        </option>

                                        <option {{ $report->blowjob == 'Unsure' ? 'selected' : '' }} value="Unsure">
                                            Unsure</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="oral_on_escort"> Oral on Escort</label>
                                    <select class="form-control" name="oral_on_escort" id="oral_on_escort">
                                        <option value="" selected="">Choose</option>

                                        <option {{ $report->oral_on_escort == 'Yes, DATY on offer' ? 'selected' : '' }}
                                            value="Yes, DATY on offer">Yes, DATY on offer</option>

                                        <option {{ $report->oral_on_escort == 'Yes, with dam' ? 'selected' : '' }}
                                            value="Yes, with dam">Yes, with dam</option>

                                        <option {{ $report->oral_on_escort == 'Yes, without dam' ? 'selected' : '' }}
                                            value="Yes, without dam">Yes, without dam</option>

                                        <option {{ $report->oral_on_escort == 'No' ? 'selected' : '' }}
                                            value="No">No
                                        </option>

                                        <option {{ $report->oral_on_escort == 'Unsure' ? 'selected' : '' }}
                                            value="Unsure">Unsure</option>

                                        <option

                                            {{ $report->oral_on_escort == 'Natural (on Trans / CD)' ? 'selected' : '' }}
                                            value="Natural (on Trans / CD)">Natural (on Trans / CD)</option>

                                        <option
                                            {{ $report->oral_on_escort == 'Covered (on Trans / CD)' ? 'selected' : '' }}
                                            value="Covered (on Trans / CD)">Covered (on Trans / CD)</option>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="anal_sex">Anal sex</label>
                                    <select class="form-control" name="anal_sex" id="anal_sex">
                                        <option value="" selected="">Choose</option>
                                        <option
                                            {{ $report->anal_sex == 'es, protected anal sex Escort' ? 'selected' : '' }}
                                            value="es, protected anal sex Escort">Yes, protected anal sex Escort
                                        </option>

                                        <option {{ $report->anal_sex == 'Yes, raw anal sex Escort' ? 'selected' : '' }}
                                            value="Yes, raw anal sex Escort">Yes, raw anal sex Escort</option>

                                        <option
                                            {{ $report->anal_sex == 'Yes, protected anal sex both of us' ? 'selected' : '' }}
                                            value="Yes, protected anal sex both of us">Yes, protected anal sex both of
                                            us
                                        </option>

                                        <option
                                            {{ $report->anal_sex == 'Yes, raw anal sex both of us' ? 'selected' : '' }}
                                            value="Yes, raw anal sex both of us">Yes, raw anal sex both of us</option>

                                        <option {{ $report->anal_sex == 'Only on me, protected' ? 'selected' : '' }}
                                            value="Only on me, protected">Only on me, protected</option>

                                        <option {{ $report->anal_sex == 'Only on me, raw' ? 'selected' : '' }}
                                            value="Only on me, raw">Only on me, raw</option>

                                        <option {{ $report->anal_sex == 'Subject to size' ? 'selected' : '' }}
                                            value="Subject to size">Subject to size</option>

                                        <option {{ $report->anal_sex == 'Not always' ? 'selected' : '' }}
                                            value="Not always">Not always</option>

                                        <option {{ $report->anal_sex == 'No' ? 'selected' : '' }} value="No">No
                                        </option>

                                        <option {{ $report->anal_sex == 'Unsure' ? 'selected' : '' }} value="Unsure">
                                            Unsure</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="overall_performance">Overall
                                        performance</label>
                                    <select class="form-control" name="overall_performance" id="overall_performance">
                                        <option {{ $report->overall_performance == '' ? 'selected' : '' }}
                                            value="">Choose</option>
                                        <option

                                            {{ $report->overall_performance == 'Money down the drain' ? 'selected' : '' }}
                                            value="Money down the drain">Money down the drain</option>

                                        <option
                                            {{ $report->overall_performance == 'Should not have bothered' ? 'selected' : '' }}
                                            value="Should not have bothered">Should not have bothered</option>

                                        <option
                                            {{ $report->overall_performance == 'Not really worth it' ? 'selected' : '' }}
                                            value="Not really worth it">Not really worth it</option>

                                        <option
                                            {{ $report->overall_performance == 'Did not make an effort' ? 'selected' : '' }}
                                            value="Did not make an effort">Did not make an effort</option>

                                        <option
                                            {{ $report->overall_performance == 'We didn’t click' ? 'selected' : '' }}
                                            value="We didn’t click">We didn’t click</option>

                                        <option {{ $report->overall_performance == 'Was rushed' ? 'selected' : '' }}
                                            value="Was rushed">Was rushed</option>

                                        <option {{ $report->overall_performance == 'It was ok' ? 'selected' : '' }}
                                            value="It was ok">It was ok</option>

                                        <option {{ $report->overall_performance == 'Pretty good' ? 'selected' : '' }}
                                            value="Pretty good">Pretty good</option>

                                        <option
                                            {{ $report->overall_performance == 'Great service' ? 'selected' : '' }}
                                            value="Great service">Great service</option>

                                        <option
                                            {{ $report->overall_performance == 'Fantastic time' ? 'selected' : '' }}
                                            value="Fantastic time">Fantastic time</option>

                                        <option
                                            {{ $report->overall_performance == 'Out of this world' ? 'selected' : '' }}
                                            value="Out of this world">Out of this world</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="met_profile_undertakings">Met Profile
                                        undertakings </label>
                                    <select class="form-control" name="met_profile_undertakings"
                                        id="met_profile_undertakings">
                                        <option {{ $report->met_profile_undertakings == '' ? 'selected' : '' }}
                                            value="">Choose</option>
                                        <option {{ $report->met_profile_undertakings == 'Yes' ? 'selected' : '' }}
                                            value="Yes">Yes</option>
                                        <option {{ $report->met_profile_undertakings == 'No' ? 'selected' : '' }}
                                            value="No">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="drug_consumption"> Drug
                                        consumption</label>
                                    <select class="form-control" name="drug_consumption" id="drug_consumption">
                                        <option {{ $report->drug_consumption == '' ? 'selected' : '' }}
                                            value="">
                                            Choose</option>
                                        <option {{ $report->drug_consumption == 'No' ? 'selected' : '' }}
                                            value="No">No</option>

                                        <option {{ $report->drug_consumption == 'Yes, meth' ? 'selected' : '' }}
                                            value="Yes, meth">Yes, meth</option>
                                        <option {{ $report->drug_consumption == 'Yes, poppers' ? 'selected' : '' }}
                                            value="Yes, poppers">Yes, poppers</option>
                                        <option
                                            {{ $report->drug_consumption == 'Yes, meth and poppers' ? 'selected' : '' }}
                                            value="Yes, meth and poppers">Yes, meth and poppers</option>
                                        <option {{ $report->drug_consumption == 'Yes, coke' ? 'selected' : '' }}
                                            value="Yes, coke">Yes, coke</option>
                                        <option {{ $report->drug_consumption == 'Don’t know' ? 'selected' : '' }}
                                            value="Don’t know">Don’t know</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="platform">Platform</label>
                                    <input name="platform" id="platform" class="form-control"
                                        value="{{ $report->platform }}" type="text" placeholder="If known">
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="profile_link">Profile link</label>
                                    <input name="profile_link" class="form-control" id="profile_link"
                                        value="{{ $report->profile_link }}" type="text"
                                        placeholder="If known (may be referred to as a link or a Membership ID or Ref)">
                                </div>
                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="status_type">Review Status <span
                                            style="color:#FF3C5F;">*</span></label>
                                    <select class="form-control" required="required" name="status_type"
                                        id="status_type">
                                        <option value="" selected="">Choose</option>
                                        <option {{ $report->status_type == 'Average' ? 'selected' : '' }}
                                            value="Average">Average</option>
                                        <option {{ $report->status_type == 'Dog' ? 'selected' : '' }} value="Dog">
                                            Dog
                                        </option>
                                        <option {{ $report->status_type == 'Great fuck' ? 'selected' : '' }}
                                            value="Great fuck">Great fuck</option>
                                        <option {{ $report->status_type == 'Waste of time' ? 'selected' : '' }}
                                            value="Waste of time">Waste of time</option>
                                    </select>
                                </div>

                            </div>

                            <div class="inner-field-row">
                                <div class="form-group">
                                    <label class="form-label" for="summary_of_encounter">Summary of encounter </label>
                                    <textarea class="form-control custom-texarea" name="summary_of_encounter" id="summary_of_encounter"
                                        placeholder="Write a short summary of your experience...">{{ $report->summary_of_encounter }}</textarea>
                                </div>



                                <div class="form-group">
                                    <label class="form-label" for="attachmentInput">Profile Pic</label>

                                    <label for="attachmentInput" class="file-upload-box">

                                        <!-- Preview state -->
                                        <div id="previewWrap"
                                            class="h-100 d-flex align-items-center justify-content-center {{ $report->profile_pic ? '' : 'hide-img' }}">

                                            @if ($report->profile_pic)
                                            <img id="previewImg"
                                                src="{{$report->profile_pic }}"
                                                alt="Profile Pic" class="img-fluid rounded"
                                                style="max-height:81px; max-width:100%; width:auto; height:auto; object-fit:contain;">
                                            @else
                                            <img id="previewImg" src="" alt="Profile Pic"
                                                class="img-fluid rounded"
                                                style="max-height:81px; max-width:100%; width:auto; height:auto; object-fit:contain;">
                                            @endif

                                        </div>
                                        <input type="hidden"
                                            name="existing_profile_pic"
                                            value="{{ $report?->profile_pic ?? '' }}">

                                        <!-- Empty state -->
                                        <div id="uploadState">
                                            <input type="file" id="attachmentInput" name="profile_pic"
                                                accept=".jpg,.jpeg,.png,image/jpeg,image/png"
                                                class="form-control file-input" onchange="previewAttachment(event)">
                                        </div>
                                        <div class="upload-content">
                                            <span class="upload-title">Upload a file</span>
                                            <span class="upload-text" id="fileNameText">
                                                Drag & drop your file here or <strong>browse</strong>
                                            </span>
                                            <span class="upload-hint">Max size 4MB. JPG or PNG Allowed</span>
                                        </div>

                                    </label>
                                </div>
                            </div>

                            <div class="inner-field-row">
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <label class="form-label fw-semibold d-block">Rating <span
                                                style="color:#FF3C5F;">*</span></label>
                                        <div class="d-flex flex-wrap">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" name="rating"
                                                    id="r1" value="1"
                                                    {{ $report->rating == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="r1">1</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" name="rating"
                                                    id="r2" value="2"
                                                    {{ $report->rating == '2' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="r2">2</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" name="rating"
                                                    id="r3" value="3"
                                                    {{ $report->rating == '3' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="r3">3</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" name="rating"
                                                    id="r4" value="4"
                                                    {{ $report->rating == '4' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="r4">4</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" name="rating"
                                                    id="r5" value="5"
                                                    {{ $report->rating == '5' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="r5">5</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="common-footer">
                                <button type="submit" class="common-save-btn mr-2">Submit</button>
                                <!-- <button type="reset" class="common-reset-btn">Reset</button> -->
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!--middle content end here-->
    </div>
    @endsection
    @push('script')
    <!-- file upload plugin start here -->
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script>
        $('#notebox-form').parsley();

        $('#notebox-form').find('[required], [data-parsley-required]').each(function() {

            var field = $(this);
            var fieldId = field.attr('id');

            var label = $('label[for="' + fieldId + '"]')
                .clone()
                .children()
                .remove()
                .end()
                .text()
                .trim();

            if (!label) {
                label = field.attr('name') ?
                    field.attr('name').replace(/_/g, ' ') :
                    'This field';
            }

            // Remove * from field name
            label = label.replace(/\*/g, '').trim();

            field.attr(
                'data-parsley-required-message',
                label + ' is required.'
            );
        });

        function previewAttachment(event) {

            var file = event.target.files[0];

            if (!file) {
                return;
            }

            var allowedTypes = ['image/jpeg', 'image/png'];
            var maxSize = 4 * 1024 * 1024; // 4MB

            // Validate file type
            if (!allowedTypes.includes(file.type)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid file',
                    text: 'Only JPG, JPEG and PNG images are allowed.'
                });

                $(event.target).val('');
                return;
            }

            // Validate file size
            if (file.size > maxSize) {
                Swal.fire({
                    icon: 'error',
                    title: 'File too large',
                    text: 'Image size must not exceed 4MB.'
                });

                $(event.target).val('');
                return;
            }

            var previewWrap = $('#previewWrap');
            var previewImg = $('#previewImg');
            var uploadState = $('#uploadState');

            var reader = new FileReader();

            reader.onload = function(e) {
                previewImg.attr('src', e.target.result);

                previewWrap.removeClass('hide-img');
            };

            reader.readAsDataURL(file);
        }

        $(document).ready(function() {

            $('#notebox-form').parsley();

            // Custom required messages
            $('#notebox-form')
                .find('[required], [data-parsley-required]')
                .each(function() {

                    var field = $(this);
                    var fieldId = field.attr('id');

                    var label = $('label[for="' + fieldId + '"]')
                        .clone()
                        .children()
                        .remove()
                        .end()
                        .text()
                        .trim();

                    if (!label) {
                        label = field.attr('name') ?
                            field.attr('name').replace(/_/g, ' ') :
                            'This field';
                    }

                    label = label.replace(/\*/g, '').trim();

                    field.attr(
                        'data-parsley-required-message',
                        label + ' is required.'
                    );
                });


            // Submit form using AJAX
            $('#notebox-form').on('submit', function(e) {

                e.preventDefault();

                var form = $(this);

                // Parsley validation
                if (!form.parsley().isValid()) {
                    form.parsley().validate();
                    return false;
                }

                var formData = new FormData(this);
                var submitBtn = form.find('.save_profile_btn');

                submitBtn.prop('disabled', true).text('Submitting...');

                $.ajax({
                    url: "{{ route('user.notebox.update') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function(response) {

                        submitBtn.prop('disabled', false).text('Submit');

                        if (response.success) {

                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                confirmButtonColor: '#FF3C5F'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "{{ route('user.list') }}";
                                }
                            });

                        } else {

                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message || 'Something went wrong.',
                                confirmButtonColor: '#FF3C5F'
                            });
                        }
                    },

                    error: function(xhr) {

                        submitBtn.prop('disabled', false).text('Submit');

                        if (xhr.status === 422) {

                            var errors = xhr.responseJSON.errors;
                            var errorMessage = '';

                            $.each(errors, function(field, messages) {
                                errorMessage += messages[0] + '\n';
                            });

                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                text: errorMessage,
                                confirmButtonColor: '#FF3C5F'
                            });

                        } else {

                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Something went wrong. Please try again.',
                                confirmButtonColor: '#FF3C5F'
                            });
                        }
                    }
                });

                return false;
            });

        });
    </script>


    @if(session('notebox_exists'))
    <script>
        $(document).ready(function() {

            Swal.fire({
                icon: 'warning',
                title: 'Notebox Already Exists',
                text: 'A Notebox already exists for this Member ID. Do you want to edit the Notebox?',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                cancelButtonColor: "#d33",
                confirmButtonColor: '#ff3c5f'
            }).then((result) => {

                if (result.isConfirmed) {
                    // Stay on the current edit page
                    return;
                }

                //  Notebox list
                window.location.href = "{{ route('user.list') }}";
            });

        });
    </script>
    @endif
    @endpush