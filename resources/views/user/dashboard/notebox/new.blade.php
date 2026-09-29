@extends('layouts.userDashboard')
@section('style')
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
            <h1 class="h1">Add Notebox</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <h3 class="NotesHeader"><b>Notes:</b></h3>
                    <ol>
                        <li>The My Notebox feature is a free service to Viewers that you can use any time.</li>
                        <li>To commence a new Notebox, select the Escort Type you want to create – Female,
                            Male or Trans etc.</li>
                        <li>Complete the form to add a new record to your Notebox list. When completing the form
                            please ensure all of the details are correct and you have selected the correct option
                            under Review Status to describe the Escort’s status, as well as for your personal Rating.</li>
                        <li>My Notebox is a closed publication for you only. Each Notebox contains personal
                            information about the Escort which only you can see (like a diary note).</li>
                        <li>Review Status filters meanings:
                            <ul style="list-style-type: disc;">
                                <li>Average means looks ok and pleasant enough but the sex was wanting.</li>
                                <li>Dog means an absolutely ugly and disgusting Escort.</li>
                                <li>Great fuck means had a great and wonderful time.</li>
                                <li>Waste of time means the Escort was nothing like they represented in their Profile.</li>
                            </ul>
                        </li>
                        <li>Rating scale is a linear numeric scale where Viewers can rate the likelihood of meeting
                            the Escort again. The question the Viewer should pose when applying the rating is
                            <i>‘Would I meet with this Escort again?’</i>. The scale is calibrated 0 to 5 with 0 meaning
                            ‘Not at all likely’ and 5 meaning ‘Extremely likely’.
                        </li>
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
                                    <label class="form-label fw-semibold" for="escort_type">Escort Type <span style="color:#FF3C5F;">*</span></label>
                                    <select class="form-control" required="required" name="escort_type" id="escort_type">
                                        <option value="" selected="">Choose</option>
                                        @foreach ($genders as $key => $gender)
                                        <option value="{{ $key }}" {{$profile_data && $profile_data->getRawOriginal('gender') == $key ? 'selected' : ''}}>{{ $gender }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="stage_name">Stage Name <span style="color:#FF3C5F;">*</span> </label>
                                    <input type="text" class="form-control" name="stage_name" value="{{$profile_data && $profile_data->name ? $profile_data->name : ''}}" id="stage_name" required="required">
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="member_id">Member ID <span style="color:#FF3C5F;">*</span> </label>
                                    <input type="text" class="form-control" name="member_id" value="{{$profile_data && $profile_data->member_id ? $profile_data->member_id : ''}}" id="member_id" required="required">
                                </div>


                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="mobile">Mobile <span style="color:#FF3C5F;">*</span></label>
                                    <input type="text" class="form-control" value="{{$profile_data && $profile_data->user ? $profile_data->user->phone : ''}}" oninput="
                                        this.value = this.value.replace(/[^0-9 ]/g, '');
                                        let digits = this.value.replace(/\s/g, '');
                                        if (digits.length > 10) {
                                            this.value = this.value.slice(0, -1);
                                        }"
                                        id="mobile" name="mobile" required="required">
                                </div>
                                @php
                                $duration = $profile_data
                                ? $profile_data->durations()->where('name', '1 Hour')->first()
                                : null;

                                $incallPrice = $duration?->pivot?->incall_price;
                                @endphp
                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="advertised_price_per_hour">Advertised price per hour <span style="color:#FF3C5F;">*</span> </label>

                                    <div class="currency-input-wrapper">
                                        <span class="currency-symbol">$</span>
                                        <input type="text" class="form-control currency-input" id="advertised_price_per_hour" value="{{$incallPrice}}" name="advertised_price_per_hour" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="state">State <span style="color:#FF3C5F;">*</span></label>
                                    <select class="form-control" required="required" name="state" id="state">
                                        <option value="" selected="">Choose</option>
                                        @foreach ($states as $key => $state)
                                        <option value="{{ $key }}" {{$profile_data && $profile_data->state_id == $key ? 'selected' : ''}}>{{ $state['stateName'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="location">Location <span style="color:#FF3C5F;">*</span></label>
                                    <input type="text" class="form-control" name="location" id="location" value="{{$profile_data && $profile_data->address ? $profile_data->address : ''}}" required="required">
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="meeting_type">Meeting type </label>
                                    <select class="form-control" name="meeting_type" id="meeting_type">
                                        <option value="" selected="">Choose</option>
                                        <option value="one-on-one">One on one</option>
                                        <option value="Threesome (FFM)">Threesome (FFM)</option>
                                        <option value="Threesome (FMM)">Threesome (FMM)</option>
                                        <option value="Threesome (FTM)">Threesome (FTM)</option>
                                        <option value="Threesome (MFM)">Threesome (MFM)</option>
                                        <option value="Threesome (MMM)">Threesome (MMM)</option>
                                        <option value="Threesome (MTM)">Threesome (MTM)</option>
                                        <option value="Threesome (TFM)">Threesome (TFM)</option>
                                        <option value="Threesome (TMM)">Threesome (TMM)</option>
                                        <option value="Threesome (TTM)">Threesome (TTM)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="extras_charged">Extras charged</label>
                                    <select class="form-control" name="extras_charged" id="extras_charged">
                                        <option value="" selected="">Choose</option>
                                        <option value="Yes, additionally">Yes, additionally</option>
                                        <option value="No, all included">No, all included</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="photos_authenticity">Photos authenticity </label>
                                    <select class="form-control" name="photos_authenticity" id="photos_authenticity">
                                        <option value="" selected="">Choose</option>
                                        <option value="100% Real - Verified">100% Real - Verified</option>
                                        <option value="Real, slightly retouched">Real, slightly retouched</option>
                                        <option value="Real, grossly retouched">Real, grossly retouched</option>
                                        <option value="Real, but outdated">Real, but outdated</option>
                                        <option value="Not real">Not real</option>
                                        <option value="No photos available - Unverified">No photos available - Unverified</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="ethnicity">Ethnicity</label>
                                    <select class="form-control" name="ethnicity" id="ethnicity">
                                        <option value="" selected="">Choose</option>
                                        <option value="Asian">Asian</option>
                                        <option value="Caucasian">Caucasian</option>
                                        <option value="Polynesian">Polynesian</option>
                                        <option value="Indian">Indian</option>
                                        <option value="African">African</option>
                                        <option value="Middle Eastern">Middle Eastern</option>
                                        <option value="Australian Aboriginal">Australian Aboriginal</option>
                                        <option value="American Indian">American Indian</option>
                                        <option value="Mixed groups">Mixed groups</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="nationality">Nationality </label>
                                    <select class="form-control" name="nationality" id="nationality">
                                        <option value="" selected>Choose</option>
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antarctica">Antarctica</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Aruba">Aruba</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bermuda">Bermuda</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Bouvet Island">Bouvet Island</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                        <option value="British Virgin Islands">British Virgin Islands</option>
                                        <option value="Brunei">Brunei</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Cape Verde">Cape Verde</option>
                                        <option value="Cayman Islands">Cayman Islands</option>
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Christmas Island">Christmas Island</option>
                                        <option value="Cocos [Keeling] Islands">Cocos [Keeling] Islands</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo [DRC]">Congo [DRC]</option>
                                        <option value="Congo [Republic]">Congo [Republic]</option>
                                        <option value="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                                        <option value="Croatia">Croatia</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Falkland Islands [Islas Malvinas]">Falkland Islands [Islas Malvinas]</option>
                                        <option value="Faroe Islands">Faroe Islands</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="French Guiana">French Guiana</option>
                                        <option value="French Polynesia">French Polynesia</option>
                                        <option value="French Southern Territories">French Southern Territories</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Gaza Strip">Gaza Strip</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Gibraltar">Gibraltar</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Greenland">Greenland</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guadeloupe">Guadeloupe</option>
                                        <option value="Guam">Guam</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guernsey">Guernsey</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guinea-Bissau">Guinea-Bissau</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hong Kong">Hong Kong</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Iran">Iran</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Isle of Man">Isle of Man</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jersey">Jersey</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Kosovo">Kosovo</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Laos">Laos</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libya">Libya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Macau">Macau</option>
                                        <option value="Macedonia [FYROM]">Macedonia [FYROM]</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall Islands">Marshall Islands</option>
                                        <option value="Martinique">Martinique</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mayotte">Mayotte</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Micronesia">Micronesia</option>
                                        <option value="Moldova">Moldova</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montenegro">Montenegro</option>
                                        <option value="Montserrat">Montserrat</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar [Burma]">Myanmar [Burma]</option>
                                        <option value="Namibia">Namibia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherlands">Netherlands</option>
                                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                                        <option value="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Niue">Niue</option>
                                        <option value="Norfolk Island">Norfolk Island</option>
                                        <option value="North Korea">North Korea</option>
                                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau">Palau</option>
                                        <option value="Palestinian Territories">Palestinian Territories</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Pitcairn Islands">Pitcairn Islands</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Puerto Rico">Puerto Rico</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Réunion">Réunion</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russia">Russia</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="Saint Helena">Saint Helena</option>
                                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                        <option value="Saint Lucia">Saint Lucia</option>
                                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                        <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="São Tomé and Príncipe">São Tomé and Príncipe</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Serbia">Serbia</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra Leone">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                                        <option value="South Korea">South Korea</option>
                                        <option value="Spain">Spain</option>
                                        <option value="Sri Lanka">Sri Lanka</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                        <option value="Swaziland">Swaziland</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syria">Syria</option>
                                        <option value="Taiwan">Taiwan</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania">Tanzania</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Timor-Leste">Timor-Leste</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tokelau">Tokelau</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="U.S. Minor Outlying Islands">U.S. Minor Outlying Islands</option>
                                        <option value="U.S. Virgin Islands">U.S. Virgin Islands</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                        <option value="Uruguay">Uruguay</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Vatican City">Vatican City</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Vietnam">Vietnam</option>
                                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                                        <option value="Western Sahara">Western Sahara</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="estimated_age">Estimated age</label>
                                    <select class="form-control" name="estimated_age" id="estimated_age">
                                        <option value="" selected="">Choose</option>
                                        <option value="18-20">18 - 20</option>
                                        <option value="21-25">21 - 25</option>
                                        <option value="26-30">26 - 30</option>
                                        <option value="31-35">31 - 35</option>
                                        <option value="36-40">36 - 40</option>
                                        <option value="41-45">41 - 45</option>
                                        <option value="over 45">Over 45</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="body_shape">Body shape </label>
                                    <select class="form-control" name="body_shape" id="body_shape">
                                        <option value="" selected="">Choose</option>
                                        <option value="Athletic">Athletic</option>
                                        <option value="Curvy">Curvy</option>
                                        <option value="fat">Fat</option>
                                        <option value="Full-figured">Full-figured</option>
                                        <option value="Large">Large</option>
                                        <option value="Petite">Petite</option>
                                        <option value="Slim">Slim</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="overall_looks">Overall looks</label>
                                    <select class="form-control" name="overall_looks" id="overall_looks">
                                        <option value="" selected="">Choose</option>
                                        <option value="An absolute Goddess">An absolute Goddess</option>
                                        <option value="Attractive">Attractive</option>
                                        <option value="Average">Average</option>
                                        <option value="Beautiful">Beautiful</option>
                                        <option value="Easy on the eye">Easy on the eye</option>
                                        <option value="Fit and muscular">Fit and muscular</option>
                                        <option value="Model material">Model material</option>
                                        <option value="Not attractive">Not attractive</option>
                                        <option value="Plain">Plain</option>
                                        <option value="Porn star material">Porn star material</option>
                                        <option value="Pretty">Pretty</option>
                                        <option value="Very attractive">Very attractive</option>
                                        <option value="Very pretty">Very pretty</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for='overall_personality'>Overall personality</label>
                                    <select class="form-control" name="overall_personality" id="overall_personality">
                                        <option value="" selected="">Choose</option>
                                        <option value="Arrogant">Arrogant</option>
                                        <option value="Bitchy">Bitchy</option>
                                        <option value="Boring">Boring</option>
                                        <option value="Bossy">Bossy</option>
                                        <option value="Cheeky">Cheeky</option>
                                        <option value="Cold">Cold</option>
                                        <option value="Engaging">Engaging</option>
                                        <option value="Fake">Fake</option>
                                        <option value="Friendly">Friendly</option>
                                        <option value="Fun">Fun</option>
                                        <option value="Liar">Liar</option>
                                        <option value="Lovely">Lovely</option>
                                        <option value="Nut-case">Nut case</option>
                                        <option value="Outgoing">Outgoing</option>
                                        <option value="Over-rates">Over rates</option>
                                        <option value="Pleasant">Pleasant</option>
                                        <option value="Quiet">Quiet</option>
                                        <option value="Rude">Rude</option>
                                        <option value="Shy">Shy</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="bd">B&D </label>
                                    <select class="form-control" name="bd" id="bd">
                                        <option value="" selected="">Choose</option>
                                        <option value="Dominant">Dominant</option>
                                        <option value="Submissive">Submissive</option>
                                        <option value="Dominant and/or submissive">Dominant and/or submissive</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="blowjob">Blowjob </label>
                                    <select class="form-control" name="blowjob" id="blowjob">
                                        <option value="" selected="">Choose</option>
                                        <option value="Yes, fellatio">Yes, fellatio</option>
                                        <option value="Yes, CBJ">Yes, CBJ</option>
                                        <option value="Yes, BBBJ">Yes, BBBJ</option>
                                        <option value="Yes, BBBJ and CIM">Yes, BBBJ and CIM</option>
                                        <option value="No">No</option>
                                        <option value="Unsure">Unsure</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="oral_on_escort"> Oral on Escort</label>
                                    <select class="form-control" name="oral_on_escort" id="oral_on_escort">
                                        <option value="" selected="">Choose</option>
                                        <option value="Yes, DATY on offer">Yes, DATY on offer</option>
                                        <option value="Yes, with dam">Yes, with dam</option>
                                        <option value="Yes, without dam">Yes, without dam</option>
                                        <option value="No">No</option>
                                        <option value="Unsure">Unsure</option>
                                        <option value="Natural (on Trans / CD)">Natural (on Trans / CD)</option>
                                        <option value="Covered (on Trans / CD)">Covered (on Trans / CD)</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="anal_sex">Anal sex</label>
                                    <select class="form-control" name="anal_sex" id="anal_sex">
                                        <option value="" selected="">Choose</option>
                                        <option value="Yes, protected anal sex Escort">Yes, protected anal sex Escort</option>
                                        <option value="Yes, raw anal sex Escort">Yes, raw anal sex Escort</option>
                                        <option value="Yes, protected anal sex both of us">Yes, protected anal sex both of us</option>
                                        <option value="Yes, raw anal sex both of us">Yes, raw anal sex both of us</option>
                                        <option value="Only on me, protected">Only on me, protected</option>
                                        <option value="Only on me, raw">Only on me, raw</option>
                                        <option value="Subject to size">Subject to size</option>
                                        <option value="Not always">Not always</option>
                                        <option value="no">No</option>
                                        <option value="Unsure">Unsure</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="overall_performance">Overall performance</label>
                                    <select class="form-control" name="overall_performance" id="overall_performance">
                                        <option value="" selected="">Choose</option>
                                        <option value="Money down the drain">Money down the drain</option>
                                        <option value="Should not have bothered">Should not have bothered</option>
                                        <option value="Not really worth it">Not really worth it</option>
                                        <option value="Did not make an effort">Did not make an effort</option>
                                        <option value="We didn’t click">We didn’t click</option>
                                        <option value="Was rushed">Was rushed</option>
                                        <option value="It was ok">It was ok</option>
                                        <option value="Pretty good">Pretty good</option>
                                        <option value="Great service">Great service</option>
                                        <option value="Fantastic time">Fantastic time</option>
                                        <option value="Out of this world">Out of this world</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="met_profile_undertakings">Met Profile undertakings </label>
                                    <select class="form-control" name="met_profile_undertakings" id="met_profile_undertakings">
                                        <option value="" selected="">Choose</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="drug_consumption"> Drug consumption</label>
                                    <select class="form-control" name="drug_consumption" id="drug_consumption">
                                        <option value="" selected="">Choose</option>
                                        <option value="No">No</option>
                                        <option value="Yes, meth">Yes, meth</option>
                                        <option value="Yes, poppers">Yes, poppers</option>
                                        <option value="Yes, meth and poppers">Yes, meth and poppers</option>
                                        <option value="Yes, coke">Yes, coke</option>
                                        <option value="Don’t know">Don’t know</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="platform">Platform</label>
                                    <input name="platform" id="platform" class="form-control" type="text" placeholder="If known">
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="profile_link">Profile link</label>
                                    <input name="profile_link" class="form-control" id="profile_link" type="text" placeholder="If known (may be referred to as a link or a Membership ID or Ref)">
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold" for="status_type">Review Status <span style="color:#FF3C5F;">*</span></label>
                                    <select class="form-control" required="required" name="status_type" id="status_type">
                                        <option value="" selected="">Choose</option>
                                        <option value="Average">Average</option>
                                        <option value="Dog">Dog</option>
                                        <option value="Great fuck">Great fuck</option>
                                        <option value="Waste of time">Waste of time</option>
                                    </select>
                                </div>
                            </div>
                            <div class="inner-field-row">

                                <div class="form-group">
                                    <label class="form-label" for="summary_of_encounter">Summary of encounter</label>
                                    <textarea class="form-control custom-texarea" name="summary_of_encounter" id="summary_of_encounter" placeholder="Write a short summary of your experience..."></textarea>
                                </div>
                                <div class="form-group">

                                    <label class="form-label fw-semibold" for="attachmentInput">
                                        Profile Pic
                                    </label>

                                    <input type="hidden"
                                        id="existing_profile_pic"
                                        name="existing_profile_pic"
                                        value="{{ $exist_profile?->path ?? '' }}">

                                    <label for="attachmentInput" class="file-upload-box">

                                        <div id="previewWrap"
                                            class="h-100 d-flex align-items-center justify-content-center {{ !empty($exist_profile?->path) ? '' : 'hide-img' }}">

                                            <img id="previewImg"
                                                src="{{ !empty($exist_profile?->path) ? asset($exist_profile->path) : '' }}"
                                                alt="Preview"
                                                class="img-fluid rounded"
                                                style="max-height:120px; max-width:100%; object-fit:contain;">

                                        </div>

                                        <div id="uploadState">
                                            <input type="file"
                                                id="attachmentInput"
                                                name="profile_pic"
                                                accept="image/*"
                                                class="form-control file-input"
                                                onchange="previewAttachment(event)">
                                        </div>

                                        <div class="upload-content">

                                            <div class="upload-icon {{ !empty($exist_profile?->path) ? 'd-none' : '' }}">
                                                <svg width="25px" height="25px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>

                                                    <g id="SVGRepo_iconCarrier">
                                                        <path stroke="#ff3c5f" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v9m0-9l3 3m-3-3l-3 3m8.5 2c1.519 0 2.5-1.231 2.5-2.75 0-1.264-.854-2.33-2.016-2.65A5 5 0 008.37 8.108a3.5 3.5 0 00-1.87 6.746">
                                                        </path>
                                                    </g>

                                                </svg>
                                            </div>

                                            <span class="upload-title">Upload a file</span>

                                            <span class="upload-text" id="fileNameText">
                                                Drag & drop your file here or <strong>browse</strong>
                                            </span>

                                            <span class="upload-hint">
                                                Max size 4MB. JPG or PNG Allowed
                                            </span>

                                        </div>

                                    </label>
                                </div>

                            </div>
                            <div class="inner-field-row">

                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <label class="form-label fw-semibold d-block">Rating <span style="color:#FF3C5F;">*</span></label>
                                        <div class="d-flex flex-wrap">

                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" name="rating" id="r1" value="1">
                                                <label class="form-check-label" for="r1">1</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" name="rating" id="r2" value="2">
                                                <label class="form-check-label" for="r2">2</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" name="rating" id="r3" value="3">
                                                <label class="form-check-label" for="r3">3</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" name="rating" id="r4" value="4">
                                                <label class="form-check-label" for="r4">4</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" name="rating" id="r5" value="5" checked>
                                                <label class="form-check-label" for="r5">5</label>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="common-footer">
                            <button type="submit" class="common-save-btn mr-2">Submit</button>
                            <button type="reset" class="common-reset-btn resetImgBtn">Reset</button>
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
        $('#previewImg').removeClass('d-none');
        var file = $(event.target)[0].files[0];
        var previewWrap = $('#previewWrap');
        var previewImg = $('#previewImg');
        var uploadState = $('#uploadState');
        var uploadIcon = $('.upload-icon');

        if (!file) {
            previewImg.attr('src', '');
            previewWrap.addClass('hide-img');
            uploadState.removeClass('hide-img');
            uploadIcon.removeClass('d-none');
            return;
        }

        // 4MB validation
        var maxSize = 4 * 1024 * 1024;

        if (file.size > maxSize) {
            Swal.fire({
                icon: 'error',
                title: 'File too large',
                text: 'Image size must not exceed 4MB.'
            });

            $(event.target).val('');
            previewImg.attr('src', '');
            previewWrap.addClass('hide-img');
            uploadState.removeClass('hide-img');
            uploadIcon.removeClass('d-none');

            return;
        }

        var reader = new FileReader();

        reader.onload = function(e) {
            previewImg.attr('src', e.target.result);

            // Show preview
            previewWrap.removeClass('hide-img');

            // Hide file input
            uploadState.addClass('hide-img');

            // Hide upload SVG
            uploadIcon.addClass('d-none');
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
                url: "{{ route('user.notebox.store') }}",
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

                        form[0].reset();
                        $('#previewImg')
                            .attr('src', '')
                            .addClass('hide-img');
                        $('#previewWrap')
                            .addClass('hide-img')
                            .removeClass('d-flex');

                        $('#uploadState').removeClass('hide-img');


                    } else {

                        Swal.fire({
                            icon: 'warning',
                            title: 'Notebox Already Exists',
                            text: 'A Notebox already exists for this Member ID. Do you want to edit the Notebox?',
                            showCancelButton: true,
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No'
                        }).then((result) => {

                            if (result.isConfirmed) {
                                window.location.href =
                                    "{{ url('user-dashboard/notebox/edit') }}/" + response.data.id;
                                return;
                            }

                            window.location.href = "{{ route('user.list') }}";
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

    $('.resetImgBtn').on('click', function(){
        $('.upload-icon').removeClass('d-none');
        $('#previewImg').addClass('d-none');
        $('#existing_profile_pic').val('');
    });
</script>
@endpush