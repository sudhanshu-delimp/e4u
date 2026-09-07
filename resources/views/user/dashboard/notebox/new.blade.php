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
                     under Status Type to describe the Escort’s status, as well as for your personal Rating.</li>
                  <li>My Notebox is a closed publication for you only. Each Notebox contains personal
                     information about the Escort which only you can see (like a diary note).</li>
                  <li>Status Type filters meanings:
                     <ul style="list-style-type: disc;">
                        <li>Average means looks ok and pleasant enough but the sex was wanting.</li>
                        <li>Dog means an absolutely ugly and disgusting Escort.</li>
                        <li>Great fuck means had a great and wonderful time.</li>
                        <li>Waste of time means the Escort was nothing like they represented in their profile.</li>
                     </ul>
                  </li>
                  <li>Rating scale is a linear numeric scale where Punters can rate the likelihood of meeting
                     the Escort again. The question the Viewer should pose when applying the rating is
                     ‘Would I meet with this Escort again?’. The scale is calibrated 0 to 10 with 0 meaning
                     ‘Not at all likely’ and 10 meaning ‘Extremely likely’.</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   <!-- Page Heading -->
   <div class="row">
      <div class="col-md-12">
         <div>

            <form class="border rounded-3 p-4 p-md-5 shadow-sm bg-white" id="notebox-form" novalidate>
               <div class="row">
                  <div class="col-md-3 mb-3">
                     <label class="form-label fw-semibold" for="escort_type">Escort Type <span style="color:#FF3C5F;">*</span></label>
                     <select class="form-control" required="required" name="escort_type" id="escort_type">
                        <option value="" selected="">Choose</option>
                        <option value="female">Female</option>
                        <option value="male">Male</option>
                        <option value="trans">Trans</option>
                        <option value="cross-dresser">Cross Dresser</option>
                     </select>
                  </div>
                  <div class="col-md-3 mb-3">
                     <label class="form-label fw-semibold" for="stage_name">Stage Name <span style="color:#FF3C5F;">*</span> </label>
                     <input type="text" class="form-control" name="stage_name" id="stage_name" required="required">
                  </div>


                  <div class="col-md-3 mb-3">
                     <label class="form-label fw-semibold" for="mobile">Mobile <span style="color:#FF3C5F;">*</span></label>
                     <input type="text" class="form-control" maxlength="10" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" id="mobile" name="mobile" required="required">
                  </div>

                  <div class="col-md-3 mb-3">
                     <label class="form-label fw-semibold" for="advertised_price_per_hour">Advertised price per hour <span style="color:#FF3C5F;">*</span> </label>
                     <input type="text" class="form-control" id="advertised_price_per_hour" name="advertised_price_per_hour" required="required">

                  </div>
               </div>

               <div class="row">
                  <div class="col-md-3 mb-3">
                     <label class="form-label fw-semibold" for="state">State <span style="color:#FF3C5F;">*</span></label>
                     <select class="form-control" required="required" name="state" id="state">
                        <option value="" selected="">Choose</option>
                        <option value="act">ACT</option>
                        <option value="nsw">NSW</option>
                        <option value="nt">NT</option>
                        <option value="qld">QLD</option>
                        <option value="sa">SA</option>
                        <option value="tas">Tas</option>
                        <option value="vic">VIC</option>
                        <option value="wa">WA</option>
                     </select>
                  </div>
                  <div class="col-md-3 mb-3">
                     <label class="form-label fw-semibold" for="location">Location</label>
                     <input type="text" class="form-control" name="location" id="location" required="required">
                  </div>

                  <div class="col-md-3 mb-3">
                     <label class="form-label fw-semibold" for="meeting_type">Meeting type </label>
                     <select class="form-control" name="meeting_type" id="meeting_type">
                        <option value="" selected="">Choose</option>
                        <option value="one-on-one">One on one</option>
                        <option value="ffm">Threesome (FFM)</option>
                        <option value="fmm">Threesome (FMM)</option>
                        <option value="ftm">Threesome (FTM)</option>
                        <option value="mfm">Threesome (MFM)</option>
                        <option value="mmm">Threesome (MMM)</option>
                        <option value="mtm">Threesome (MTM)</option>
                        <option value="tfm">Threesome (TFM)</option>
                        <option value="tmm">Threesome (TMM)</option>
                        <option value="ttm">Threesome (TTM)</option>
                     </select>
                  </div>
                  <div class="col-md-3 mb-3">
                     <label class="form-label fw-semibold" for="extras_charged">Extras charged</label>
                     <select class="form-control" name="extras_charged" id="extras_charged">
                        <option value="" selected="">Choose</option>
                        <option value="yes">Yes, additionally</option>
                        <option value="no">No, all included</option>
                     </select>
                  </div>

                  <div class="col-md-3 mb-3">
                     <label class="form-label fw-semibold" for="photos_authenticity">Photos authenticity </label>
                     <select class="form-control" name="photos_authenticity" id="photos_authenticity">
                        <option value="" selected="">Choose</option>
                        <option value="real">100% real</option>
                        <option value="real-slightly-retouched">Real, slightly retouched</option>
                        <option value="real-grossly-retouched">Real, grossly retouched</option>
                        <option value="real-but-outdated">Real, but outdated</option>
                        <option value="not-real">Not real</option>
                        <option value="no-photos-available">No photos available</option>
                     </select>
                  </div>
                  <div class="col-md-3 mb-3">
                     <label class="form-label fw-semibold" for="ethnicity">Ethnicity</label>
                     <select class="form-control" name="ethnicity" id="ethnicity">
                        <option value="" selected="">Choose</option>
                        <option value="asian">Asian</option>
                        <option value="caucasian">Caucasian</option>
                        <option value="polynesian">Polynesian</option>
                        <option value="indian">Indian</option>
                        <option value="african">African</option>
                        <option value="middle-eastern">Middle Eastern</option>
                        <option value="australian-aboriginal">Australian Aboriginal</option>
                        <option value="american-ndian">American Indian</option>
                        <option value="mixed-groups">Mixed groups</option>
                     </select>
                  </div>

                  <div class="col-md-3 mb-3">
                     <label class="form-label fw-semibold" for="nationality">Nationality </label>
                     <select class="form-control" name="nationality" id="nationality">
                        <option value="" selected="">Choose</option>
                        <option value="af">Afghanistan</option>
                        <option value="al">Albania</option>
                        <option value="dz">Algeria</option>
                        <option value="as">American Samoa</option>
                        <option value="ad">Andorra</option>
                        <option value="ao">Angola</option>
                        <option value="ai">Anguilla</option>
                        <option value="aq">Antarctica</option>
                        <option value="ag">Antigua and Barbuda</option>
                        <option value="ar">Argentina</option>
                        <option value="am">Armenia</option>
                        <option value="aw">Aruba</option>
                        <option value="au">Australia</option>
                        <option value="at">Austria</option>
                        <option value="az">Azerbaijan</option>
                        <option value="bs">Bahamas</option>
                        <option value="bh">Bahrain</option>
                        <option value="bd">Bangladesh</option>
                        <option value="bb">Barbados</option>
                        <option value="by">Belarus</option>
                        <option value="be">Belgium</option>
                        <option value="bz">Belize</option>
                        <option value="bj">Benin</option>
                        <option value="bm">Bermuda</option>
                        <option value="bt">Bhutan</option>
                        <option value="bo">Bolivia</option>
                        <option value="ba">Bosnia and Herzegovina</option>
                        <option value="bw">Botswana</option>
                        <option value="bv">Bouvet Island</option>
                        <option value="br">Brazil</option>
                        <option value="io">British Indian Ocean Territory</option>
                        <option value="vg">British Virgin Islands</option>
                        <option value="bn">Brunei</option>
                        <option value="bg">Bulgaria</option>
                        <option value="bf">Burkina Faso</option>
                        <option value="bi">Burundi</option>
                        <option value="kh">Cambodia</option>
                        <option value="cm">Cameroon</option>
                        <option value="ca">Canada</option>
                        <option value="cv">Cape Verde</option>
                        <option value="ky">Cayman Islands</option>
                        <option value="cf">Central African Republic</option>
                        <option value="td">Chad</option>
                        <option value="cl">Chile</option>
                        <option value="cn">China</option>
                        <option value="cx">Christmas Island</option>
                        <option value="cc">Cocos [Keeling] Islands</option>
                        <option value="co">Colombia</option>
                        <option value="km">Comoros</option>
                        <option value="cd">Congo [DRC]</option>
                        <option value="cg">Congo [Republic]</option>
                        <option value="ck">Cook Islands</option>
                        <option value="cr">Costa Rica</option>
                        <option value="ci">Côte d'Ivoire</option>
                        <option value="hr">Croatia</option>
                        <option value="cu">Cuba</option>
                        <option value="cy">Cyprus</option>
                        <option value="cz">Czech Republic</option>
                        <option value="dk">Denmark</option>
                        <option value="dj">Djibouti</option>
                        <option value="dm">Dominica</option>
                        <option value="do">Dominican Republic</option>
                        <option value="ec">Ecuador</option>
                        <option value="eg">Egypt</option>
                        <option value="sv">El Salvador</option>
                        <option value="gq">Equatorial Guinea</option>
                        <option value="er">Eritrea</option>
                        <option value="ee">Estonia</option>
                        <option value="et">Ethiopia</option>
                        <option value="fk">Falkland Islands [Islas Malvinas]</option>
                        <option value="fo">Faroe Islands</option>
                        <option value="fj">Fiji</option>
                        <option value="fi">Finland</option>
                        <option value="fr">France</option>
                        <option value="gf">French Guiana</option>
                        <option value="pf">French Polynesia</option>
                        <option value="tf">French Southern Territories</option>
                        <option value="ga">Gabon</option>
                        <option value="gm">Gambia</option>
                        <option value="gz">Gaza Strip</option>
                        <option value="ge">Georgia</option>
                        <option value="de">Germany</option>
                        <option value="gh">Ghana</option>
                        <option value="gi">Gibraltar</option>
                        <option value="gr">Greece</option>
                        <option value="gl">Greenland</option>
                        <option value="gd">Grenada</option>
                        <option value="gp">Guadeloupe</option>
                        <option value="gu">Guam</option>
                        <option value="gt">Guatemala</option>
                        <option value="gg">Guernsey</option>
                        <option value="gn">Guinea</option>
                        <option value="gw">Guinea-Bissau</option>
                        <option value="gy">Guyana</option>
                        <option value="ht">Haiti</option>
                        <option value="hm">Heard Island and McDonald Islands</option>
                        <option value="hn">Honduras</option>
                        <option value="hk">Hong Kong</option>
                        <option value="hu">Hungary</option>
                        <option value="is">Iceland</option>
                        <option value="in">India</option>
                        <option value="id">Indonesia</option>
                        <option value="ir">Iran</option>
                        <option value="iq">Iraq</option>
                        <option value="ie">Ireland</option>
                        <option value="im">Isle of Man</option>
                        <option value="il">Israel</option>
                        <option value="it">Italy</option>
                        <option value="jm">Jamaica</option>
                        <option value="jp">Japan</option>
                        <option value="je">Jersey</option>
                        <option value="jo">Jordan</option>
                        <option value="kz">Kazakhstan</option>
                        <option value="ke">Kenya</option>
                        <option value="ki">Kiribati</option>
                        <option value="xk">Kosovo</option>
                        <option value="kw">Kuwait</option>
                        <option value="kg">Kyrgyzstan</option>
                        <option value="la">Laos</option>
                        <option value="lv">Latvia</option>
                        <option value="lb">Lebanon</option>
                        <option value="ls">Lesotho</option>
                        <option value="lr">Liberia</option>
                        <option value="ly">Libya</option>
                        <option value="li">Liechtenstein</option>
                        <option value="lt">Lithuania</option>
                        <option value="lu">Luxembourg</option>
                        <option value="mo">Macau</option>
                        <option value="mk">Macedonia [FYROM]</option>
                        <option value="mg">Madagascar</option>
                        <option value="mw">Malawi</option>
                        <option value="my">Malaysia</option>
                        <option value="mv">Maldives</option>
                        <option value="ml">Mali</option>
                        <option value="mt">Malta</option>
                        <option value="mh">Marshall Islands</option>
                        <option value="mq">Martinique</option>
                        <option value="mr">Mauritania</option>
                        <option value="mu">Mauritius</option>
                        <option value="yt">Mayotte</option>
                        <option value="mx">Mexico</option>
                        <option value="fm">Micronesia</option>
                        <option value="md">Moldova</option>
                        <option value="mc">Monaco</option>
                        <option value="mn">Mongolia</option>
                        <option value="me">Montenegro</option>
                        <option value="ms">Montserrat</option>
                        <option value="ma">Morocco</option>
                        <option value="mz">Mozambique</option>
                        <option value="mm">Myanmar [Burma]</option>
                        <option value="na">Namibia</option>
                        <option value="nr">Nauru</option>
                        <option value="np">Nepal</option>
                        <option value="nl">Netherlands</option>
                        <option value="an">Netherlands Antilles</option>
                        <option value="nc">New Caledonia</option>
                        <option value="nz">New Zealand</option>
                        <option value="ni">Nicaragua</option>
                        <option value="ne">Niger</option>
                        <option value="ng">Nigeria</option>
                        <option value="nu">Niue</option>
                        <option value="nf">Norfolk Island</option>
                        <option value="kp">North Korea</option>
                        <option value="mp">Northern Mariana Islands</option>
                        <option value="no">Norway</option>
                        <option value="om">Oman</option>
                        <option value="pk">Pakistan</option>
                        <option value="pw">Palau</option>
                        <option value="ps">Palestinian Territories</option>
                        <option value="pa">Panama</option>
                        <option value="pg">Papua New Guinea</option>
                        <option value="py">Paraguay</option>
                        <option value="pe">Peru</option>
                        <option value="ph">Philippines</option>
                        <option value="pn">Pitcairn Islands</option>
                        <option value="pl">Poland</option>
                        <option value="pt">Portugal</option>
                        <option value="pr">Puerto Rico</option>
                        <option value="qa">Qatar</option>
                        <option value="re">Réunion</option>
                        <option value="ro">Romania</option>
                        <option value="ru">Russia</option>
                        <option value="rw">Rwanda</option>
                        <option value="sh">Saint Helena</option>
                        <option value="kn">Saint Kitts and Nevis</option>
                        <option value="lc">Saint Lucia</option>
                        <option value="pm">Saint Pierre and Miquelon</option>
                        <option value="vc">Saint Vincent and the Grenadines</option>
                        <option value="ws">Samoa</option>
                        <option value="sm">San Marino</option>
                        <option value="st">São Tomé and Príncipe</option>
                        <option value="sa">Saudi Arabia</option>
                        <option value="sn">Senegal</option>
                        <option value="rs">Serbia</option>
                        <option value="sc">Seychelles</option>
                        <option value="sl">Sierra Leone</option>
                        <option value="sg">Singapore</option>
                        <option value="sk">Slovakia</option>
                        <option value="si">Slovenia</option>
                        <option value="sb">Solomon Islands</option>
                        <option value="so">Somalia</option>
                        <option value="za">South Africa</option>
                        <option value="gs">South Georgia and the South Sandwich Islands</option>
                        <option value="kr">South Korea</option>
                        <option value="es">Spain</option>
                        <option value="lk">Sri Lanka</option>
                        <option value="sd">Sudan</option>
                        <option value="sr">Suriname</option>
                        <option value="sj">Svalbard and Jan Mayen</option>
                        <option value="sz">Swaziland</option>
                        <option value="se">Sweden</option>
                        <option value="ch">Switzerland</option>
                        <option value="sy">Syria</option>
                        <option value="tw">Taiwan</option>
                        <option value="tj">Tajikistan</option>
                        <option value="tz">Tanzania</option>
                        <option value="th">Thailand</option>
                        <option value="tl">Timor-Leste</option>
                        <option value="tg">Togo</option>
                        <option value="tk">Tokelau</option>
                        <option value="to">Tonga</option>
                        <option value="tt">Trinidad and Tobago</option>
                        <option value="tn">Tunisia</option>
                        <option value="tr">Turkey</option>
                        <option value="tm">Turkmenistan</option>
                        <option value="tc">Turks and Caicos Islands</option>
                        <option value="tv">Tuvalu</option>
                        <option value="um">U.S. Minor Outlying Islands</option>
                        <option value="vi">U.S. Virgin Islands</option>
                        <option value="ug">Uganda</option>
                        <option value="ua">Ukraine</option>
                        <option value="ae">United Arab Emirates</option>
                        <option value="gb">United Kingdom</option>
                        <option value="us">United States</option>
                        <option value="uy">Uruguay</option>
                        <option value="uz">Uzbekistan</option>
                        <option value="vu">Vanuatu</option>
                        <option value="va">Vatican City</option>
                        <option value="ve">Venezuela</option>
                        <option value="vn">Vietnam</option>
                        <option value="wf">Wallis and Futuna</option>
                        <option value="eh">Western Sahara</option>
                        <option value="ye">Yemen</option>
                        <option value="zm">Zambia</option>
                        <option value="zw">Zimbabwe</option>
                     </select>
                  </div>


                  <div class="col-md-3 mb-3">
                     <label class="form-label fw-semibold" for="estimated_age">Estimated age</label>
                     <select class="form-control" name="estimated_age" id="estimated_age">
                        <option value="" selected="">Choose</option>
                        <option value="18-20">18 - 20</option>
                        <option value="21-25">21 - 25</option>
                        <option value="26-30">26 - 30</option>
                        <option value="31-35">31 - 35</option>
                        <option value="36-40">36 - 40</option>
                        <option value="41-45">41 - 45</option>
                        <option value="over-45">Over 45</option>
                     </select>
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-3 mb-3">
                     <label class="form-label fw-semibold" for="body_shape">Body shape </label>
                     <select class="form-control" name="body_shape" id="body_shape">
                        <option value="" selected="">Choose</option>
                        <option value="athletic">Athletic</option>
                        <option value="curvy">Curvy</option>
                        <option value="fat">Fat</option>
                        <option value="full-figured">Full-figured</option>
                        <option value="large">Large</option>
                        <option value="petite">Petite</option>
                        <option value="slim">Slim</option>
                     </select>
                  </div>
                  <div class="col-md-3 mb-3">
                     <label class="form-label fw-semibold" for="overall_looks">Overall looks</label>
                     <select class="form-control" name="overall_looks" id="overall_looks">
                        <option value="" selected="">Choose</option>
                        <option value="an-absolute-goddess">An absolute Goddess</option>
                        <option value="attractive">Attractive</option>
                        <option value="average">Average</option>
                        <option value="beautiful">Beautiful</option>
                        <option value="easy-on-the-eye">Easy on the eye</option>
                        <option value="fit-and-muscular">Fit and muscular</option>
                        <option value="model-material">Model material</option>
                        <option value="not-attractive">Not attractive</option>
                        <option value="plain">Plain</option>
                        <option value="porn-star-material">Porn star material</option>
                        <option value="pretty">Pretty</option>
                        <option value="very-attractive">Very attractive</option>
                        <option value="very-pretty">Very pretty</option>
                     </select>
                  </div>

                  <div class="col-md-3 mb-3">
                     <label class="form-label fw-semibold" for='overall_personality'>Overall personality</label>
                     <select class="form-control" name="overall_personality" id="overall_personality">
                        <option value="" selected="">Choose</option>
                        <option value="arrogant">Arrogant</option>
                        <option value="bitchy">Bitchy</option>
                        <option value="boring">Boring</option>
                        <option value="bossy">Bossy</option>
                        <option value="cheeky">Cheeky</option>
                        <option value="cold">Cold</option>
                        <option value="engaging">Engaging</option>
                        <option value="fake">Fake</option>
                        <option value="friendly">Friendly</option>
                        <option value="fun">Fun</option>
                        <option value="liar">Liar</option>
                        <option value="lovely">Lovely</option>
                        <option value="nut-case">Nut case</option>
                        <option value="outgoing">Outgoing</option>
                        <option value="overrates">Overrates</option>
                        <option value="pleasant">Pleasant</option>
                        <option value="quiet">Quiet</option>
                        <option value="rude">Rude</option>
                        <option value="shy">Shy</option>
                     </select>
                  </div>

                  <div class="col-md-3 mb-3">
                     <label class="form-label fw-semibold" for="bd">B&D </label>
                     <select class="form-control" name="bd" id="bd">
                        <option value="" selected="">Choose</option>
                        <option value="dominant">Dominant</option>
                        <option value="submissive">Submissive</option>
                        <option value="both">Dominant and/or submissive</option>
                     </select>
                  </div>

               </div>


               <div class="row">
                  <div class="col-md-3 mb-3">
                     <label class="form-label fw-semibold" for="blowjob">Blowjob </label>
                     <select class="form-control" name="blowjob" id="blowjob">
                        <option value="" selected="">Choose</option>
                        <option value="yes-fellatio">Yes, fellatio</option>
                        <option value="yes-cbj">Yes, CBJ</option>
                        <option value="yes-bbbj">Yes, BBBJ</option>
                        <option value="yes-bbbj-and-cim">Yes, BBBJ and CIM</option>
                        <option value="no">No</option>
                        <option value="unsure">Unsure</option>
                     </select>
                  </div>
                  <div class="col-md-3 mb-3">
                     <label class="form-label fw-semibold" for="oral_on_escort"> Oral on Escort</label>
                     <select class="form-control" name="oral_on_escort" id="oral_on_escort">
                        <option value="" selected="">Choose</option>
                        <option value="yes-daty-on-offer">Yes, DATY on offer</option>
                        <option value="yes-with-dam">Yes, with dam</option>
                        <option value="yes-without-dam">Yes, without dam</option>
                        <option value="no">No</option>
                        <option value="unsure">Unsure</option>
                        <option value="natural-on-trans-cd">Natural (on Trans / CD)</option>
                        <option value="covered-on-trans-cd">Covered (on Trans / CD)</option>
                     </select>
                  </div>

                  <div class="col-md-3 mb-3">
                     <label class="form-label fw-semibold" for="anal_sex">Anal sex</label>
                     <select class="form-control" name="anal_sex" id="anal_sex">
                        <option value="" selected="">Choose</option>
                        <option value="yes-protected-anal-sex-escort">Yes, protected anal sex Escort</option>
                        <option value="yes-raw-anal-sex-escort">Yes, raw anal sex Escort</option>
                        <option value="yes-protected-anal-sex-both-of-us">Yes, protected anal sex both of us</option>
                        <option value="yes-raw-anal-sex-both-of-us">Yes, raw anal sex both of us</option>
                        <option value="only-on-me-protected">Only on me, protected</option>
                        <option value="only-on-me-raw">Only on me, raw</option>
                        <option value="subject-to-size">Subject to size</option>
                        <option value="not-always">Not always</option>
                        <option value="no">No</option>
                        <option value="unsure">Unsure</option>
                     </select>
                  </div>

                  <div class="col-md-3 mb-3">
                     <label class="form-label fw-semibold" for="overall_performance">Overall performance</label>
                     <select class="form-control" name="overall_performance" id="overall_performance">
                        <option value="" selected="">Choose</option>
                        <option value="money-down-the-drain">Money down the drain</option>
                        <option value="should-not-have-bothered">Should not have bothered</option>
                        <option value="not-really-worth-it">Not really worth it</option>
                        <option value="did-not-make-an-effort">Did not make an effort</option>
                        <option value="we-didnt-click">We didn’t click</option>
                        <option value="was-rushed">Was rushed</option>
                        <option value="it-was-ok">It was ok</option>
                        <option value="pretty-good">Pretty good</option>
                        <option value="great-service">Great service</option>
                        <option value="fantastic-time">Fantastic time</option>
                        <option value="out-of-this-world">Out of this world</option>
                     </select>
                  </div>

               </div>

               <div class="row">
                  <div class="col-md-3 mb-3">
                     <label class="form-label fw-semibold" for="met_profile_undertakings">Met Profile undertakings </label>
                     <select class="form-control" name="met_profile_undertakings" id="met_profile_undertakings">
                        <option value="" selected="">Choose</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                     </select>
                  </div>
                  <div class="col-md-3 mb-3">
                     <label class="form-label fw-semibold" for="drug_consumption"> Drug consumption</label>
                     <select class="form-control" name="drug_consumption" id="drug_consumption">
                        <option value="" selected="">Choose</option>
                        <option value="yes-meth">Yes, meth</option>
                        <option value="yes-poppers">Yes, poppers</option>
                        <option value="yes-meth-and-poppers">Yes, meth and poppers</option>
                        <option value="yes-coke">Yes, coke</option>
                        <option value="dont-know">Don’t know</option>
                     </select>
                  </div>

                  <div class="col-md-3 mb-3">
                     <label class="form-label fw-semibold" for="platform">Platform</label>
                     <input name="platform" id="platform" class="form-control" type="text" placeholder="If known">
                  </div>

                  <div class="col-md-3 mb-3">
                     <label class="form-label fw-semibold" for="profile_link">Profile link</label>
                     <input name="profile_link" class="form-control" id="profile_link" type="text" placeholder="If known (may be referred to as a link or a Membership ID or Ref)">
                  </div>

               </div>
               <div class="row">
                  <div class="col-md-6 mb-3">
                     <label class="form-label fw-semibold" for="summary_of_encounter">Summary of encounter <span style="color:#FF3C5F;">*</span></label>
                     <textarea class="form-control" name="summary_of_encounter" id="summary_of_encounter" rows="8" placeholder="Write a short summary of your experience..."></textarea>
                  </div>



                  <div class="col-md-6 mb-3">
                     <label class="form-label fw-semibold" for="attachmentInput">Profile Pic</label>
                     <div class="border border-2 border-dashed rounded-3 p-3 text-center d-flex flex-column justify-content-center"
                        style="border-style:dashed !important; background-color:#f8f9fa; height:180px; overflow:hidden;">

                        <!-- Preview state -->
                        <div id="previewWrap" class="h-100 d-flex align-items-center justify-content-center hide-img">
                           <img id="previewImg" src="" alt="Preview" class="img-fluid rounded" style="max-height:150px; max-width:100%; object-fit:contain;">
                        </div>

                        <!-- Empty state -->
                        <div id="uploadState">
                           <i id="uploadIcon" class="fa-solid fa-cloud-arrow-up fs-3 mb-2 d-block" style="color:#FF3C5F;"></i>
                           <div id="fileNameText" class="text-secondary small mb-2">Drag & drop a file, or</div>
                           <input type="file" id="attachmentInput" name="profile_pic" accept="image/*" class="form-control form-control-sm w-auto d-inline-block mx-auto" onchange="previewAttachment(event)">
                        </div>
                     </div>
                     <div class="form-text mt-1">Max size 4MB. JPG / PNG allowed.</div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4 mb-3">
                     <label class="form-label fw-semibold" for="status_type">Status Type <span style="color:#FF3C5F;">*</span></label>
                     <select class="form-control" required="required" name="status_type" id="status_type">
                        <option value="" selected="">Choose</option>
                        <option value="average">Average</option>
                        <option value="dog">Dog</option>
                        <option value="great-fuck">Great fuck</option>
                        <option value="waste-of-time">Waste of time</option>
                     </select>
                  </div>

                  <div class="col-md-8 mb-3">
                     <label class="form-label fw-semibold d-block">Rating <span style="color:#FF3C5F;">*</span></label>
                     <div class="d-flex flex-wrap">

                        <div class="form-check">
                           <input type="radio" name="rating" id="r1" value="1">
                           <label class="form-check-label" for="r1">1</label>
                        </div>
                        <div class="form-check">
                           <input type="radio" name="rating" id="r2" value="2">
                           <label class="form-check-label" for="r2">2</label>
                        </div>
                        <div class="form-check">
                           <input type="radio" name="rating" id="r3" value="3">
                           <label class="form-check-label" for="r3">3</label>
                        </div>
                        <div class="form-check">
                           <input type="radio" name="rating" id="r4" value="4">
                           <label class="form-check-label" for="r4">4</label>
                        </div>
                        <div class="form-check">
                           <input type="radio" name="rating" id="r5" value="5">
                           <label class="form-check-label" for="r5">5</label>
                        </div>
                        <div class="form-check">
                           <input type="radio" name="rating" id="r6" value="6">
                           <label class="form-check-label" for="r6">6</label>
                        </div>
                        <div class="form-check">
                           <input type="radio" name="rating" id="r7" value="7">
                           <label class="form-check-label" for="r7">7</label>
                        </div>
                        <div class="form-check">
                           <input type="radio" name="rating" id="r8" value="8">
                           <label class="form-check-label" for="r8">8</label>
                        </div>
                        <div class="form-check">
                           <input type="radio" name="rating" id="r9" value="9">
                           <label class="form-check-label" for="r9">9</label>
                        </div>
                        <div class="form-check">
                           <input type="radio" name="rating" checked id="r10" value="10">
                           <label class="form-check-label" for="r10">10</label>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="d-flex gap-3">
                  <button type="submit" class="save_profile_btn mr-2">Submit</button>
                  <button type="reset" class="btn btn-outline-secondary px-4">Reset</button>
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

    var file = $(event.target)[0].files[0];
    var previewWrap = $('#previewWrap');
    var previewImg = $('#previewImg');
    var uploadState = $('#uploadState');

    if (!file) {
        previewImg.attr('src', '');
        previewWrap.addClass('hide-img');
        uploadState.removeClass('hide-img');
        return;
    }

    var reader = new FileReader();

    reader.onload = function(e) {
        previewImg.attr('src', e.target.result);

        previewWrap.removeClass('hide-img');
        uploadState.addClass('hide-img');
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
               url: "{{ route('notebox.store') }}",
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
                     });

                     // Reset form
                     form[0].reset();

                     // Reset image preview
                     $('#previewImg')
                        .attr('src', '')
                        .addClass('hide-img');

                     $('#previewWrap')
                        .addClass('hide-img')
                        .removeClass('d-flex');

                     $('#uploadState').removeClass('hide-img');

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
   @endpush