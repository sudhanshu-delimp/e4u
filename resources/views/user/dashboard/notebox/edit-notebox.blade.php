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
                                                    {{ $gender }}</option>
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
                                        <input type="text" class="form-control currency-input" id="advertised_price_per_hour"
                                            name="advertised_price_per_hour" required="required"
                                           value="{{ $report->advertised_price_per_hour !== null && $report->advertised_price_per_hour !== '' ? number_format($report->advertised_price_per_hour, 2) : '' }}" inputmode="decimal">

                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label fw-semibold" for="state">State <span
                                                style="color:#FF3C5F;">*</span></label>
                                        <select class="form-control" required="required" name="state" id="state">
                                            <option value="" disabled selected="">Choose</option>
                                            @foreach ($states as $key => $state)
                                                <option value="{{ $key }}"
                                                    {{ $report && $report->state == $key ? 'selected' : '' }}>
                                                    {{ $state['stateName'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label fw-semibold" for="location">Location</label>
                                        <input type="text" class="form-control" name="location" id="location"
                                            required="required" value="{{ $report->location }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label fw-semibold" for="meeting_type">Meeting type </label>
                                        <select class="form-control" name="meeting_type" id="meeting_type">
                                            <option value="" disabled selected="">Choose</option>
                                            <option {{ $report->meeting_type == 'one-on-one' ? 'selected' : '' }}
                                                value="one-on-one">One on one</option>
                                            <option {{ $report->meeting_type == 'ffm' ? 'selected' : '' }} value="ffm">
                                                Threesome (FFM)</option>
                                            <option {{ $report->meeting_type == 'fmm' ? 'selected' : '' }} value="fmm">
                                                Threesome (FMM)</option>
                                            <option {{ $report->meeting_type == 'ftm' ? 'selected' : '' }} value="ftm">
                                                Threesome (FTM)</option>
                                            <option {{ $report->meeting_type == 'mfm' ? 'selected' : '' }} value="mfm">
                                                Threesome (MFM)</option>
                                            <option {{ $report->meeting_type == 'mmm' ? 'selected' : '' }} value="mmm">
                                                Threesome (MMM)</option>
                                            <option {{ $report->meeting_type == 'mtm' ? 'selected' : '' }} value="mtm">
                                                Threesome (MTM)</option>
                                            <option {{ $report->meeting_type == 'tfm' ? 'selected' : '' }} value="tfm">
                                                Threesome (TFM)</option>
                                            <option {{ $report->meeting_type == 'tmm' ? 'selected' : '' }} value="tmm">
                                                Threesome (TMM)</option>
                                            <option {{ $report->meeting_type == 'ttm' ? 'selected' : '' }} value="ttm">
                                                Threesome (TTM)</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label fw-semibold" for="extras_charged">Extras charged</label>
                                        <select class="form-control" name="extras_charged" id="extras_charged">
                                            <option value="" selected="">Choose</option>
                                            <option {{ $report->extras_charged == 'yes' ? 'selected' : '' }}
                                                value="yes">
                                                Yes, additionally</option>
                                            <option {{ $report->extras_charged == 'no' ? 'selected' : '' }}
                                                value="no">No,
                                                all included</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label fw-semibold" for="photos_authenticity">Photos
                                            authenticity
                                        </label>
                                        <select class="form-control" name="photos_authenticity" id="photos_authenticity">
                                            <option value="" selected="">Choose</option>
                                            <option {{ $report->photos_authenticity == 'real' ? 'selected' : '' }}
                                                value="real">100% real</option>
                                            <option
                                                {{ $report->photos_authenticity == 'real-slightly-retouched' ? 'selected' : '' }}
                                                value="real-slightly-retouched">Real, slightly retouched</option>
                                            <option
                                                {{ $report->photos_authenticity == 'real-grossly-retouched' ? 'selected' : '' }}
                                                value="real-grossly-retouched">Real, grossly retouched</option>
                                            <option
                                                {{ $report->photos_authenticity == 'real-but-outdated' ? 'selected' : '' }}
                                                value="real-but-outdated">Real, but outdated</option>
                                            <option {{ $report->photos_authenticity == 'not-real' ? 'selected' : '' }}
                                                value="not-real">Not real</option>
                                            <option
                                                {{ $report->photos_authenticity == 'no-photos-available' ? 'selected' : '' }}
                                                value="no-photos-available">No photos available</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label fw-semibold" for="ethnicity">Ethnicity</label>
                                        <select class="form-control" name="ethnicity" id="ethnicity">
                                            <option value="" selected="">Choose</option>
                                            <option {{ $report->ethnicity == 'asian' ? 'selected' : '' }} value="asian">
                                                Asian
                                            </option>
                                            <option {{ $report->ethnicity == 'caucasian' ? 'selected' : '' }}
                                                value="caucasian">Caucasian</option>
                                            <option {{ $report->ethnicity == 'polynesian' ? 'selected' : '' }}
                                                value="polynesian">Polynesian</option>
                                            <option {{ $report->ethnicity == 'indian' ? 'selected' : '' }} value="indian">
                                                Indian</option>
                                            <option {{ $report->ethnicity == 'african' ? 'selected' : '' }}
                                                value="african">
                                                African</option>
                                            <option {{ $report->ethnicity == 'middle-eastern' ? 'selected' : '' }}
                                                value="middle-eastern">Middle Eastern</option>
                                            <option {{ $report->ethnicity == 'australian-aboriginal' ? 'selected' : '' }}
                                                value="australian-aboriginal">Australian Aboriginal</option>
                                            <option {{ $report->ethnicity == 'american-ndian' ? 'selected' : '' }}
                                                value="american-ndian">American Indian</option>
                                            <option {{ $report->ethnicity == 'mixed-groups' ? 'selected' : '' }}
                                                value="mixed-groups">Mixed groups</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label fw-semibold" for="nationality">Nationality </label>
                                        <select class="form-control" name="nationality" id="nationality">
                                            <option value="" selected="">Choose</option>
                                            <option {{ $report->nationality == 'af' ? 'selected' : '' }} value="af">
                                                Afghanistan</option>
                                            <option {{ $report->nationality == 'al' ? 'selected' : '' }} value="al">
                                                Albania</option>
                                            <option {{ $report->nationality == 'dz' ? 'selected' : '' }} value="dz">
                                                Algeria</option>
                                            <option {{ $report->nationality == 'as' ? 'selected' : '' }} value="as">
                                                American Samoa</option>
                                            <option {{ $report->nationality == 'ad' ? 'selected' : '' }} value="ad">
                                                Andorra</option>
                                            <option {{ $report->nationality == 'ao' ? 'selected' : '' }} value="ao">
                                                Angola
                                            </option>
                                            <option {{ $report->nationality == 'ai' ? 'selected' : '' }} value="ai">
                                                Anguilla</option>
                                            <option {{ $report->nationality == 'aq' ? 'selected' : '' }} value="aq">
                                                Antarctica</option>
                                            <option {{ $report->nationality == 'ag' ? 'selected' : '' }} value="ag">
                                                Antigua and Barbuda</option>
                                            <option {{ $report->nationality == 'ar' ? 'selected' : '' }} value="ar">
                                                Argentina</option>
                                            <option {{ $report->nationality == 'am' ? 'selected' : '' }} value="am">
                                                Armenia</option>
                                            <option {{ $report->nationality == 'aw' ? 'selected' : '' }} value="aw">
                                                Aruba
                                            </option>
                                            <option {{ $report->nationality == 'au' ? 'selected' : '' }} value="au">
                                                Australia</option>
                                            <option {{ $report->nationality == 'at' ? 'selected' : '' }} value="at">
                                                Austria</option>
                                            <option {{ $report->nationality == 'az' ? 'selected' : '' }} value="az">
                                                Azerbaijan</option>
                                            <option {{ $report->nationality == 'bs' ? 'selected' : '' }} value="bs">
                                                Bahamas</option>
                                            <option {{ $report->nationality == 'bh' ? 'selected' : '' }} value="bh">
                                                Bahrain</option>
                                            <option {{ $report->nationality == 'bd' ? 'selected' : '' }} value="bd">
                                                Bangladesh</option>
                                            <option {{ $report->nationality == 'bb' ? 'selected' : '' }} value="bb">
                                                Barbados</option>
                                            <option {{ $report->nationality == 'by' ? 'selected' : '' }} value="by">
                                                Belarus</option>
                                            <option {{ $report->nationality == 'be' ? 'selected' : '' }} value="be">
                                                Belgium</option>
                                            <option {{ $report->nationality == 'bz' ? 'selected' : '' }} value="bz">
                                                Belize
                                            </option>
                                            <option {{ $report->nationality == 'bj' ? 'selected' : '' }} value="bj">
                                                Benin
                                            </option>
                                            <option {{ $report->nationality == 'bm' ? 'selected' : '' }} value="bm">
                                                Bermuda</option>
                                            <option {{ $report->nationality == 'bt' ? 'selected' : '' }} value="bt">
                                                Bhutan
                                            </option>
                                            <option {{ $report->nationality == 'bo' ? 'selected' : '' }} value="bo">
                                                Bolivia</option>
                                            <option {{ $report->nationality == 'ba' ? 'selected' : '' }} value="ba">
                                                Bosnia
                                                and Herzegovina</option>
                                            <option {{ $report->nationality == 'bw' ? 'selected' : '' }} value="bw">
                                                Botswana</option>
                                            <option {{ $report->nationality == 'bv' ? 'selected' : '' }} value="bv">
                                                Bouvet
                                                Island</option>
                                            <option {{ $report->nationality == 'br' ? 'selected' : '' }} value="br">
                                                Brazil
                                            </option>
                                            <option {{ $report->nationality == 'io' ? 'selected' : '' }} value="io">
                                                British Indian Ocean Territory</option>
                                            <option {{ $report->nationality == 'vg' ? 'selected' : '' }} value="vg">
                                                British Virgin Islands</option>
                                            <option {{ $report->nationality == 'bn' ? 'selected' : '' }} value="bn">
                                                Brunei
                                            </option>
                                            <option {{ $report->nationality == 'bg' ? 'selected' : '' }} value="bg">
                                                Bulgaria</option>
                                            <option {{ $report->nationality == 'bf' ? 'selected' : '' }} value="bf">
                                                Burkina Faso</option>
                                            <option {{ $report->nationality == 'bi' ? 'selected' : '' }} value="bi">
                                                Burundi</option>
                                            <option {{ $report->nationality == 'kh' ? 'selected' : '' }} value="kh">
                                                Cambodia</option>
                                            <option {{ $report->nationality == 'cm' ? 'selected' : '' }} value="cm">
                                                Cameroon</option>
                                            <option {{ $report->nationality == 'ca' ? 'selected' : '' }} value="ca">
                                                Canada
                                            </option>
                                            <option {{ $report->nationality == 'cv' ? 'selected' : '' }} value="cv">
                                                Cape
                                                Verde</option>
                                            <option {{ $report->nationality == 'ky' ? 'selected' : '' }} value="ky">
                                                Cayman
                                                Islands</option>
                                            <option {{ $report->nationality == 'cf' ? 'selected' : '' }} value="cf">
                                                Central African Republic</option>
                                            <option {{ $report->nationality == 'td' ? 'selected' : '' }} value="td">
                                                Chad
                                            </option>
                                            <option {{ $report->nationality == 'cl' ? 'selected' : '' }} value="cl">
                                                Chile
                                            </option>
                                            <option {{ $report->nationality == 'cn' ? 'selected' : '' }} value="cn">
                                                China
                                            </option>
                                            <option {{ $report->nationality == 'cx' ? 'selected' : '' }} value="cx">
                                                Christmas Island</option>
                                            <option {{ $report->nationality == 'cc' ? 'selected' : '' }} value="cc">
                                                Cocos
                                                [Keeling] Islands</option>
                                            <option {{ $report->nationality == 'co' ? 'selected' : '' }} value="co">
                                                Colombia</option>
                                            <option {{ $report->nationality == 'km' ? 'selected' : '' }} value="km">
                                                Comoros</option>
                                            <option {{ $report->nationality == 'cd' ? 'selected' : '' }} value="cd">
                                                Congo
                                                [DRC]</option>
                                            <option {{ $report->nationality == 'cg' ? 'selected' : '' }} value="cg">
                                                Congo
                                                [Republic]</option>
                                            <option {{ $report->nationality == 'ck' ? 'selected' : '' }} value="ck">
                                                Cook
                                                Islands</option>
                                            <option {{ $report->nationality == 'cr' ? 'selected' : '' }} value="cr">
                                                Costa
                                                Rica</option>
                                            <option {{ $report->nationality == 'ci' ? 'selected' : '' }} value="ci">
                                                Côte
                                                d'Ivoire</option>
                                            <option {{ $report->nationality == 'hr' ? 'selected' : '' }} value="hr">
                                                Croatia</option>
                                            <option {{ $report->nationality == 'cu' ? 'selected' : '' }} value="cu">
                                                Cuba
                                            </option>
                                            <option {{ $report->nationality == 'cy' ? 'selected' : '' }} value="cy">
                                                Cyprus
                                            </option>
                                            <option {{ $report->nationality == 'cz' ? 'selected' : '' }} value="cz">
                                                Czech
                                                Republic</option>
                                            <option {{ $report->nationality == 'dk' ? 'selected' : '' }} value="dk">
                                                Denmark</option>
                                            <option {{ $report->nationality == 'dj' ? 'selected' : '' }} value="dj">
                                                Djibouti</option>
                                            <option {{ $report->nationality == 'dm' ? 'selected' : '' }} value="dm">
                                                Dominica</option>
                                            <option {{ $report->nationality == 'do' ? 'selected' : '' }} value="do">
                                                Dominican Republic</option>
                                            <option {{ $report->nationality == 'ec' ? 'selected' : '' }} value="ec">
                                                Ecuador</option>
                                            <option {{ $report->nationality == 'eg' ? 'selected' : '' }} value="eg">
                                                Egypt
                                            </option>
                                            <option {{ $report->nationality == 'sv' ? 'selected' : '' }} value="sv">
                                                El
                                                Salvador</option>
                                            <option {{ $report->nationality == 'gq' ? 'selected' : '' }} value="gq">
                                                Equatorial Guinea</option>
                                            <option {{ $report->nationality == 'er' ? 'selected' : '' }} value="er">
                                                Eritrea</option>
                                            <option {{ $report->nationality == 'ee' ? 'selected' : '' }} value="ee">
                                                Estonia</option>
                                            <option {{ $report->nationality == 'et' ? 'selected' : '' }} value="et">
                                                Ethiopia</option>
                                            <option {{ $report->nationality == 'fk' ? 'selected' : '' }} value="fk">
                                                Falkland Islands [Islas Malvinas]</option>
                                            <option {{ $report->nationality == 'fo' ? 'selected' : '' }} value="fo">
                                                Faroe
                                                Islands</option>
                                            <option {{ $report->nationality == 'fj' ? 'selected' : '' }} value="fj">
                                                Fiji
                                            </option>
                                            <option {{ $report->nationality == 'fi' ? 'selected' : '' }} value="fi">
                                                Finland</option>
                                            <option {{ $report->nationality == 'fr' ? 'selected' : '' }} value="fr">
                                                France</option>
                                            <option {{ $report->nationality == 'gf' ? 'selected' : '' }} value="gf">
                                                French Guiana</option>
                                            <option {{ $report->nationality == 'pf' ? 'selected' : '' }} value="pf">
                                                French Polynesia</option>
                                            <option {{ $report->nationality == 'tf' ? 'selected' : '' }} value="tf">
                                                French Southern Territories</option>
                                            <option {{ $report->nationality == 'ga' ? 'selected' : '' }} value="ga">
                                                Gabon
                                            </option>
                                            <option {{ $report->nationality == 'gm' ? 'selected' : '' }} value="gm">
                                                Gambia</option>
                                            <option {{ $report->nationality == 'gz' ? 'selected' : '' }} value="gz">
                                                Gaza
                                                Strip</option>
                                            <option {{ $report->nationality == 'ge' ? 'selected' : '' }} value="ge">
                                                Georgia</option>
                                            <option {{ $report->nationality == 'de' ? 'selected' : '' }} value="de">
                                                Germany</option>
                                            <option {{ $report->nationality == 'gh' ? 'selected' : '' }} value="gh">
                                                Ghana
                                            </option>
                                            <option {{ $report->nationality == 'gi' ? 'selected' : '' }} value="gi">
                                                Gibraltar</option>
                                            <option {{ $report->nationality == 'gr' ? 'selected' : '' }} value="gr">
                                                Greece</option>
                                            <option {{ $report->nationality == 'gl' ? 'selected' : '' }} value="gl">
                                                Greenland</option>
                                            <option {{ $report->nationality == 'gd' ? 'selected' : '' }} value="gd">
                                                Grenada</option>
                                            <option {{ $report->nationality == 'gp' ? 'selected' : '' }} value="gp">
                                                Guadeloupe</option>
                                            <option {{ $report->nationality == 'gu' ? 'selected' : '' }} value="gu">
                                                Guam
                                            </option>
                                            <option {{ $report->nationality == 'gt' ? 'selected' : '' }} value="gt">
                                                Guatemala</option>
                                            <option {{ $report->nationality == 'gg' ? 'selected' : '' }} value="gg">
                                                Guernsey</option>
                                            <option {{ $report->nationality == 'gn' ? 'selected' : '' }} value="gn">
                                                Guinea</option>
                                            <option {{ $report->nationality == 'gw' ? 'selected' : '' }} value="gw">
                                                Guinea-Bissau</option>
                                            <option {{ $report->nationality == 'gy' ? 'selected' : '' }} value="gy">
                                                Guyana</option>
                                            <option {{ $report->nationality == 'ht' ? 'selected' : '' }} value="ht">
                                                Haiti
                                            </option>
                                            <option {{ $report->nationality == 'hm' ? 'selected' : '' }} value="hm">
                                                Heard
                                                Island and McDonald Islands</option>
                                            <option {{ $report->nationality == 'hn' ? 'selected' : '' }} value="hn">
                                                Honduras</option>
                                            <option {{ $report->nationality == 'hk' ? 'selected' : '' }} value="hk">
                                                Hong
                                                Kong</option>
                                            <option {{ $report->nationality == 'hu' ? 'selected' : '' }} value="hu">
                                                Hungary</option>
                                            <option {{ $report->nationality == 'is' ? 'selected' : '' }} value="is">
                                                Iceland</option>
                                            <option {{ $report->nationality == 'in' ? 'selected' : '' }} value="in">
                                                India
                                            </option>
                                            <option {{ $report->nationality == 'id' ? 'selected' : '' }} value="id">
                                                Indonesia</option>
                                            <option {{ $report->nationality == 'ir' ? 'selected' : '' }} value="ir">
                                                Iran
                                            </option>
                                            <option {{ $report->nationality == 'iq' ? 'selected' : '' }} value="iq">
                                                Iraq
                                            </option>
                                            <option {{ $report->nationality == 'ie' ? 'selected' : '' }} value="ie">
                                                Ireland</option>
                                            <option {{ $report->nationality == 'im' ? 'selected' : '' }} value="im">
                                                Isle
                                                of Man</option>
                                            <option {{ $report->nationality == 'il' ? 'selected' : '' }} value="il">
                                                Israel</option>
                                            <option {{ $report->nationality == 'it' ? 'selected' : '' }} value="it">
                                                Italy
                                            </option>
                                            <option {{ $report->nationality == 'jm' ? 'selected' : '' }} value="jm">
                                                Jamaica</option>
                                            <option {{ $report->nationality == 'jp' ? 'selected' : '' }} value="jp">
                                                Japan
                                            </option>
                                            <option {{ $report->nationality == 'je' ? 'selected' : '' }} value="je">
                                                Jersey</option>
                                            <option {{ $report->nationality == 'jo' ? 'selected' : '' }} value="jo">
                                                Jordan</option>
                                            <option {{ $report->nationality == 'kz' ? 'selected' : '' }} value="kz">
                                                Kazakhstan</option>
                                            <option {{ $report->nationality == 'ke' ? 'selected' : '' }} value="ke">
                                                Kenya
                                            </option>
                                            <option {{ $report->nationality == 'ki' ? 'selected' : '' }} value="ki">
                                                Kiribati</option>
                                            <option {{ $report->nationality == 'xk' ? 'selected' : '' }} value="xk">
                                                Kosovo</option>
                                            <option {{ $report->nationality == 'kw' ? 'selected' : '' }} value="kw">
                                                Kuwait</option>
                                            <option {{ $report->nationality == 'kg' ? 'selected' : '' }} value="kg">
                                                Kyrgyzstan</option>
                                            <option {{ $report->nationality == 'la' ? 'selected' : '' }} value="la">
                                                Laos
                                            </option>
                                            <option {{ $report->nationality == 'lv' ? 'selected' : '' }} value="lv">
                                                Latvia</option>
                                            <option {{ $report->nationality == 'lb' ? 'selected' : '' }} value="lb">
                                                Lebanon</option>
                                            <option {{ $report->nationality == 'ls' ? 'selected' : '' }} value="ls">
                                                Lesotho</option>
                                            <option {{ $report->nationality == 'lr' ? 'selected' : '' }} value="lr">
                                                Liberia</option>
                                            <option {{ $report->nationality == 'ly' ? 'selected' : '' }} value="ly">
                                                Libya
                                            </option>
                                            <option {{ $report->nationality == 'li' ? 'selected' : '' }} value="li">
                                                Liechtenstein</option>
                                            <option {{ $report->nationality == 'lt' ? 'selected' : '' }} value="lt">
                                                Lithuania</option>
                                            <option {{ $report->nationality == 'lu' ? 'selected' : '' }} value="lu">
                                                Luxembourg</option>
                                            <option {{ $report->nationality == 'mo' ? 'selected' : '' }} value="mo">
                                                Macau
                                            </option>
                                            <option {{ $report->nationality == 'mk' ? 'selected' : '' }} value="mk">
                                                Macedonia [FYROM]</option>
                                            <option {{ $report->nationality == 'mg' ? 'selected' : '' }} value="mg">
                                                Madagascar</option>
                                            <option {{ $report->nationality == 'mw' ? 'selected' : '' }} value="mw">
                                                Malawi</option>
                                            <option {{ $report->nationality == 'my' ? 'selected' : '' }} value="my">
                                                Malaysia</option>
                                            <option {{ $report->nationality == 'mv' ? 'selected' : '' }} value="mv">
                                                Maldives</option>
                                            <option {{ $report->nationality == 'ml' ? 'selected' : '' }} value="ml">
                                                Mali
                                            </option>
                                            <option {{ $report->nationality == 'mt' ? 'selected' : '' }} value="mt">
                                                Malta
                                            </option>
                                            <option {{ $report->nationality == 'mh' ? 'selected' : '' }} value="mh">
                                                Marshall Islands</option>
                                            <option {{ $report->nationality == 'mq' ? 'selected' : '' }} value="mq">
                                                Martinique</option>
                                            <option {{ $report->nationality == 'mr' ? 'selected' : '' }} value="mr">
                                                Mauritania</option>
                                            <option {{ $report->nationality == 'mu' ? 'selected' : '' }} value="mu">
                                                Mauritius</option>
                                            <option {{ $report->nationality == 'yt' ? 'selected' : '' }} value="yt">
                                                Mayotte</option>
                                            <option {{ $report->nationality == 'mx' ? 'selected' : '' }} value="mx">
                                                Mexico</option>
                                            <option {{ $report->nationality == 'fm' ? 'selected' : '' }} value="fm">
                                                Micronesia</option>
                                            <option {{ $report->nationality == 'md' ? 'selected' : '' }} value="md">
                                                Moldova</option>
                                            <option {{ $report->nationality == 'mc' ? 'selected' : '' }} value="mc">
                                                Monaco</option>
                                            <option {{ $report->nationality == 'mn' ? 'selected' : '' }} value="mn">
                                                Mongolia</option>
                                            <option {{ $report->nationality == 'me' ? 'selected' : '' }} value="me">
                                                Montenegro</option>
                                            <option {{ $report->nationality == 'ms' ? 'selected' : '' }} value="ms">
                                                Montserrat</option>
                                            <option {{ $report->nationality == 'ma' ? 'selected' : '' }} value="ma">
                                                Morocco</option>
                                            <option {{ $report->nationality == 'mz' ? 'selected' : '' }} value="mz">
                                                Mozambique</option>
                                            <option {{ $report->nationality == 'mm' ? 'selected' : '' }} value="mm">
                                                Myanmar [Burma]</option>
                                            <option {{ $report->nationality == 'na' ? 'selected' : '' }} value="na">
                                                Namibia</option>
                                            <option {{ $report->nationality == 'nr' ? 'selected' : '' }} value="nr">
                                                Nauru
                                            </option>
                                            <option {{ $report->nationality == 'np' ? 'selected' : '' }} value="np">
                                                Nepal
                                            </option>
                                            <option {{ $report->nationality == 'nl' ? 'selected' : '' }} value="nl">
                                                Netherlands</option>
                                            <option {{ $report->nationality == 'an' ? 'selected' : '' }} value="an">
                                                Netherlands Antilles</option>
                                            <option {{ $report->nationality == 'nc' ? 'selected' : '' }} value="nc">
                                                New
                                                Caledonia</option>
                                            <option {{ $report->nationality == 'nz' ? 'selected' : '' }} value="nz">
                                                New
                                                Zealand</option>
                                            <option {{ $report->nationality == 'ni' ? 'selected' : '' }} value="ni">
                                                Nicaragua</option>
                                            <option {{ $report->nationality == 'ne' ? 'selected' : '' }} value="ne">
                                                Niger
                                            </option>
                                            <option {{ $report->nationality == 'ng' ? 'selected' : '' }} value="ng">
                                                Nigeria</option>
                                            <option {{ $report->nationality == 'nu' ? 'selected' : '' }} value="nu">
                                                Niue
                                            </option>
                                            <option {{ $report->nationality == 'nf' ? 'selected' : '' }} value="nf">
                                                Norfolk Island</option>
                                            <option {{ $report->nationality == 'kp' ? 'selected' : '' }} value="kp">
                                                North
                                                Korea</option>
                                            <option {{ $report->nationality == 'mp' ? 'selected' : '' }} value="mp">
                                                Northern Mariana Islands</option>
                                            <option {{ $report->nationality == 'no' ? 'selected' : '' }} value="no">
                                                Norway</option>
                                            <option {{ $report->nationality == 'om' ? 'selected' : '' }} value="om">
                                                Oman
                                            </option>
                                            <option {{ $report->nationality == 'pk' ? 'selected' : '' }} value="pk">
                                                Pakistan</option>
                                            <option {{ $report->nationality == 'pw' ? 'selected' : '' }} value="pw">
                                                Palau
                                            </option>
                                            <option {{ $report->nationality == 'ps' ? 'selected' : '' }} value="ps">
                                                Palestinian Territories</option>
                                            <option {{ $report->nationality == 'pa' ? 'selected' : '' }} value="pa">
                                                Panama</option>
                                            <option {{ $report->nationality == 'pg' ? 'selected' : '' }} value="pg">
                                                Papua
                                                New Guinea</option>
                                            <option {{ $report->nationality == 'py' ? 'selected' : '' }} value="py">
                                                Paraguay</option>
                                            <option {{ $report->nationality == 'pe' ? 'selected' : '' }} value="pe">
                                                Peru
                                            </option>
                                            <option {{ $report->nationality == 'ph' ? 'selected' : '' }} value="ph">
                                                Philippines</option>
                                            <option {{ $report->nationality == 'pn' ? 'selected' : '' }} value="pn">
                                                Pitcairn Islands</option>
                                            <option {{ $report->nationality == 'pl' ? 'selected' : '' }} value="pl">
                                                Poland</option>
                                            <option {{ $report->nationality == 'pt' ? 'selected' : '' }} value="pt">
                                                Portugal</option>
                                            <option {{ $report->nationality == 'pr' ? 'selected' : '' }} value="pr">
                                                Puerto Rico</option>
                                            <option {{ $report->nationality == 'qa' ? 'selected' : '' }} value="qa">
                                                Qatar
                                            </option>
                                            <option {{ $report->nationality == 're' ? 'selected' : '' }} value="re">
                                                Réunion</option>
                                            <option {{ $report->nationality == 'ro' ? 'selected' : '' }} value="ro">
                                                Romania</option>
                                            <option {{ $report->nationality == 'ru' ? 'selected' : '' }} value="ru">
                                                Russia</option>
                                            <option {{ $report->nationality == 'rw' ? 'selected' : '' }} value="rw">
                                                Rwanda</option>
                                            <option {{ $report->nationality == 'sh' ? 'selected' : '' }} value="sh">
                                                Saint
                                                Helena</option>
                                            <option {{ $report->nationality == 'kn' ? 'selected' : '' }} value="kn">
                                                Saint
                                                Kitts and Nevis</option>
                                            <option {{ $report->nationality == 'lc' ? 'selected' : '' }} value="lc">
                                                Saint
                                                Lucia</option>
                                            <option {{ $report->nationality == 'pm' ? 'selected' : '' }} value="pm">
                                                Saint
                                                Pierre and Miquelon</option>
                                            <option {{ $report->nationality == 'vc' ? 'selected' : '' }} value="vc">
                                                Saint
                                                Vincent and the Grenadines</option>
                                            <option {{ $report->nationality == 'ws' ? 'selected' : '' }} value="ws">
                                                Samoa
                                            </option>
                                            <option {{ $report->nationality == 'sm' ? 'selected' : '' }} value="sm">
                                                San
                                                Marino</option>
                                            <option {{ $report->nationality == 'st' ? 'selected' : '' }} value="st">
                                                São
                                                Tomé and Príncipe</option>
                                            <option {{ $report->nationality == 'sa' ? 'selected' : '' }} value="sa">
                                                Saudi
                                                Arabia</option>
                                            <option {{ $report->nationality == 'sn' ? 'selected' : '' }} value="sn">
                                                Senegal</option>
                                            <option {{ $report->nationality == 'rs' ? 'selected' : '' }} value="rs">
                                                Serbia</option>
                                            <option {{ $report->nationality == 'sc' ? 'selected' : '' }} value="sc">
                                                Seychelles</option>
                                            <option {{ $report->nationality == 'sl' ? 'selected' : '' }} value="sl">
                                                Sierra Leone</option>
                                            <option {{ $report->nationality == 'sg' ? 'selected' : '' }} value="sg">
                                                Singapore</option>
                                            <option {{ $report->nationality == 'sk' ? 'selected' : '' }} value="sk">
                                                Slovakia</option>
                                            <option {{ $report->nationality == 'si' ? 'selected' : '' }} value="si">
                                                Slovenia</option>
                                            <option {{ $report->nationality == 'sb' ? 'selected' : '' }} value="sb">
                                                Solomon Islands</option>
                                            <option {{ $report->nationality == 'so' ? 'selected' : '' }} value="so">
                                                Somalia</option>
                                            <option {{ $report->nationality == 'za' ? 'selected' : '' }} value="za">
                                                South
                                                Africa</option>
                                            <option {{ $report->nationality == 'gs' ? 'selected' : '' }} value="gs">
                                                South
                                                Georgia and the South Sandwich Islands</option>
                                            <option {{ $report->nationality == 'kr' ? 'selected' : '' }} value="kr">
                                                South
                                                Korea</option>
                                            <option {{ $report->nationality == 'es' ? 'selected' : '' }} value="es">
                                                Spain
                                            </option>
                                            <option {{ $report->nationality == 'lk' ? 'selected' : '' }} value="lk">
                                                Sri
                                                Lanka</option>
                                            <option {{ $report->nationality == 'sd' ? 'selected' : '' }} value="sd">
                                                Sudan
                                            </option>
                                            <option {{ $report->nationality == 'sr' ? 'selected' : '' }} value="sr">
                                                Suriname</option>
                                            <option {{ $report->nationality == 'sj' ? 'selected' : '' }} value="sj">
                                                Svalbard and Jan Mayen</option>
                                            <option {{ $report->nationality == 'sz' ? 'selected' : '' }} value="sz">
                                                Swaziland</option>
                                            <option {{ $report->nationality == 'se' ? 'selected' : '' }} value="se">
                                                Sweden</option>
                                            <option {{ $report->nationality == 'ch' ? 'selected' : '' }} value="ch">
                                                Switzerland</option>
                                            <option {{ $report->nationality == 'sy' ? 'selected' : '' }} value="sy">
                                                Syria
                                            </option>
                                            <option {{ $report->nationality == 'tw' ? 'selected' : '' }} value="tw">
                                                Taiwan</option>
                                            <option {{ $report->nationality == 'tj' ? 'selected' : '' }} value="tj">
                                                Tajikistan</option>
                                            <option {{ $report->nationality == 'tz' ? 'selected' : '' }} value="tz">
                                                Tanzania</option>
                                            <option {{ $report->nationality == 'th' ? 'selected' : '' }} value="th">
                                                Thailand</option>
                                            <option {{ $report->nationality == 'tl' ? 'selected' : '' }} value="tl">
                                                Timor-Leste</option>
                                            <option {{ $report->nationality == 'tg' ? 'selected' : '' }} value="tg">
                                                Togo
                                            </option>
                                            <option {{ $report->nationality == 'tk' ? 'selected' : '' }} value="tk">
                                                Tokelau</option>
                                            <option {{ $report->nationality == 'to' ? 'selected' : '' }} value="to">
                                                Tonga
                                            </option>
                                            <option {{ $report->nationality == 'tt' ? 'selected' : '' }} value="tt">
                                                Trinidad and Tobago</option>
                                            <option {{ $report->nationality == 'tn' ? 'selected' : '' }} value="tn">
                                                Tunisia</option>
                                            <option {{ $report->nationality == 'tr' ? 'selected' : '' }} value="tr">
                                                Turkey</option>
                                            <option {{ $report->nationality == 'tm' ? 'selected' : '' }} value="tm">
                                                Turkmenistan</option>
                                            <option {{ $report->nationality == 'tc' ? 'selected' : '' }} value="tc">
                                                Turks
                                                and Caicos Islands</option>
                                            <option {{ $report->nationality == 'tv' ? 'selected' : '' }} value="tv">
                                                Tuvalu</option>
                                            <option {{ $report->nationality == 'um' ? 'selected' : '' }} value="um">
                                                U.S.
                                                Minor Outlying Islands</option>
                                            <option {{ $report->nationality == 'vi' ? 'selected' : '' }} value="vi">
                                                U.S.
                                                Virgin Islands</option>
                                            <option {{ $report->nationality == 'ug' ? 'selected' : '' }} value="ug">
                                                Uganda</option>
                                            <option {{ $report->nationality == 'ua' ? 'selected' : '' }} value="ua">
                                                Ukraine</option>
                                            <option {{ $report->nationality == 'ae' ? 'selected' : '' }} value="ae">
                                                United Arab Emirates</option>
                                            <option {{ $report->nationality == 'gb' ? 'selected' : '' }} value="gb">
                                                United Kingdom</option>
                                            <option {{ $report->nationality == 'us' ? 'selected' : '' }} value="us">
                                                United States</option>
                                            <option {{ $report->nationality == 'uy' ? 'selected' : '' }} value="uy">
                                                Uruguay</option>
                                            <option {{ $report->nationality == 'uz' ? 'selected' : '' }} value="uz">
                                                Uzbekistan</option>
                                            <option {{ $report->nationality == 'vu' ? 'selected' : '' }} value="vu">
                                                Vanuatu</option>
                                            <option {{ $report->nationality == 'va' ? 'selected' : '' }} value="va">
                                                Vatican City</option>
                                            <option {{ $report->nationality == 've' ? 'selected' : '' }} value="ve">
                                                Venezuela</option>
                                            <option {{ $report->nationality == 'vn' ? 'selected' : '' }} value="vn">
                                                Vietnam</option>
                                            <option {{ $report->nationality == 'wf' ? 'selected' : '' }} value="wf">
                                                Wallis and Futuna</option>
                                            <option {{ $report->nationality == 'eh' ? 'selected' : '' }} value="eh">
                                                Western Sahara</option>
                                            <option {{ $report->nationality == 'ye' ? 'selected' : '' }} value="ye">
                                                Yemen
                                            </option>
                                            <option {{ $report->nationality == 'zm' ? 'selected' : '' }} value="zm">
                                                Zambia</option>
                                            <option {{ $report->nationality == 'zw' ? 'selected' : '' }} value="zw">
                                                Zimbabwe</option>
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
                                            <option {{ $report->body_shape == 'curvy' ? 'selected' : '' }}
                                                value="curvy">
                                                Curvy</option>
                                            <option {{ $report->body_shape == 'fat' ? 'selected' : '' }} value="fat">
                                                Fat
                                            </option>
                                            <option {{ $report->body_shape == 'full-figured' ? 'selected' : '' }}
                                                value="full-figured">Full-figured</option>
                                            <option {{ $report->body_shape == 'large' ? 'selected' : '' }}
                                                value="large">
                                                Large</option>
                                            <option {{ $report->body_shape == 'petite' ? 'selected' : '' }}
                                                value="petite">
                                                Petite</option>
                                            <option {{ $report->body_shape == 'slim' ? 'selected' : '' }} value="slim">
                                                Slim
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label fw-semibold" for="overall_looks">Overall looks</label>
                                        <select class="form-control" name="overall_looks" id="overall_looks">
                                            <option value="" selected="">Choose</option>
                                            <option
                                                {{ $report->overall_looks == 'an-absolute-goddess' ? 'selected' : '' }}
                                                value="an-absolute-goddess">An absolute Goddess</option>
                                            <option {{ $report->overall_looks == 'attractive' ? 'selected' : '' }}
                                                value="attractive">Attractive</option>
                                            <option {{ $report->overall_looks == 'average' ? 'selected' : '' }}
                                                value="average">Average</option>
                                            <option {{ $report->overall_looks == 'beautiful' ? 'selected' : '' }}
                                                value="beautiful">Beautiful</option>
                                            <option {{ $report->overall_looks == 'easy-on-the-eye' ? 'selected' : '' }}
                                                value="easy-on-the-eye">Easy on the eye</option>
                                            <option {{ $report->overall_looks == 'fit-and-muscular' ? 'selected' : '' }}
                                                value="fit-and-muscular">Fit and muscular</option>
                                            <option {{ $report->overall_looks == 'model-material' ? 'selected' : '' }}
                                                value="model-material">Model material</option>
                                            <option {{ $report->overall_looks == 'not-attractive' ? 'selected' : '' }}
                                                value="not-attractive">Not attractive</option>
                                            <option {{ $report->overall_looks == 'plain' ? 'selected' : '' }}
                                                value="plain">
                                                Plain</option>
                                            <option {{ $report->overall_looks == 'porn-star-material' ? 'selected' : '' }}
                                                value="porn-star-material">Porn star material</option>
                                            <option {{ $report->overall_looks == 'pretty' ? 'selected' : '' }}
                                                value="pretty">Pretty</option>
                                            <option {{ $report->overall_looks == 'very-attractive' ? 'selected' : '' }}
                                                value="very-attractive">Very attractive</option>
                                            <option {{ $report->overall_looks == 'very-pretty' ? 'selected' : '' }}
                                                value="very-pretty">Very pretty</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label fw-semibold" for='overall_personality'>Overall
                                            personality</label>
                                        <select class="form-control" name="overall_personality" id="overall_personality">
                                            <option value="" selected="">Choose</option>
                                            <option {{ $report->overall_personality == 'arrogant' ? 'selected' : '' }}
                                                value="arrogant">Arrogant</option>
                                            <option {{ $report->overall_personality == 'bitchy' ? 'selected' : '' }}
                                                value="bitchy">Bitchy</option>
                                            <option {{ $report->overall_personality == 'boring' ? 'selected' : '' }}
                                                value="boring">Boring</option>
                                            <option {{ $report->overall_personality == 'bossy' ? 'selected' : '' }}
                                                value="bossy">Bossy</option>
                                            <option {{ $report->overall_personality == 'cheeky' ? 'selected' : '' }}
                                                value="cheeky">Cheeky</option>
                                            <option {{ $report->overall_personality == 'cold' ? 'selected' : '' }}
                                                value="cold">Cold</option>
                                            <option {{ $report->overall_personality == 'engaging' ? 'selected' : '' }}
                                                value="engaging">Engaging</option>
                                            <option {{ $report->overall_personality == 'fake' ? 'selected' : '' }}
                                                value="fake">Fake</option>
                                            <option {{ $report->overall_personality == 'friendly' ? 'selected' : '' }}
                                                value="friendly">Friendly</option>
                                            <option {{ $report->overall_personality == 'fun' ? 'selected' : '' }}
                                                value="fun">Fun</option>
                                            <option {{ $report->overall_personality == 'liar' ? 'selected' : '' }}
                                                value="liar">Liar</option>
                                            <option {{ $report->overall_personality == 'lovely' ? 'selected' : '' }}
                                                value="lovely">Lovely</option>
                                            <option {{ $report->overall_personality == 'nut-case' ? 'selected' : '' }}
                                                value="nut-case">Nut case</option>
                                            <option {{ $report->overall_personality == 'outgoing' ? 'selected' : '' }}
                                                value="outgoing">Outgoing</option>
                                            <option {{ $report->overall_personality == 'overrates' ? 'selected' : '' }}
                                                value="overrates">Overrates</option>
                                            <option {{ $report->overall_personality == 'pleasant' ? 'selected' : '' }}
                                                value="pleasant">Pleasant</option>
                                            <option {{ $report->overall_personality == 'quiet' ? 'selected' : '' }}
                                                value="quiet">Quiet</option>
                                            <option {{ $report->overall_personality == 'rude' ? 'selected' : '' }}
                                                value="rude">Rude</option>
                                            <option {{ $report->overall_personality == 'shy' ? 'selected' : '' }}
                                                value="shy">Shy</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label fw-semibold" for="bd">B&D </label>
                                        <select class="form-control" name="bd" id="bd">
                                            <option value="" selected="">Choose</option>
                                            <option {{ $report->bd == 'dominant' ? 'selected' : '' }} value="dominant">
                                                Dominant</option>
                                            <option {{ $report->bd == 'submissive' ? 'selected' : '' }}
                                                value="submissive">
                                                Submissive</option>
                                            <option {{ $report->bd == 'both' ? 'selected' : '' }} value="both">Dominant
                                                and/or submissive</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label fw-semibold" for="blowjob">Blowjob </label>
                                        <select class="form-control" name="blowjob" id="blowjob">
                                            <option value="" selected="">Choose</option>
                                            <option {{ $report->blowjob == 'yes-fellatio' ? 'selected' : '' }}
                                                value="yes-fellatio">Yes, fellatio</option>
                                            <option {{ $report->blowjob == 'yes-cbj' ? 'selected' : '' }}
                                                value="yes-cbj">
                                                Yes, CBJ</option>
                                            <option {{ $report->blowjob == 'yes-bbbj' ? 'selected' : '' }}
                                                value="yes-bbbj">
                                                Yes, BBBJ</option>
                                            <option {{ $report->blowjob == 'yes-bbbj-and-cim' ? 'selected' : '' }}
                                                value="yes-bbbj-and-cim">Yes, BBBJ and CIM</option>
                                            <option {{ $report->blowjob == 'no' ? 'selected' : '' }} value="no">No
                                            </option>
                                            <option {{ $report->blowjob == 'unsure' ? 'selected' : '' }} value="unsure">
                                                Unsure</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label fw-semibold" for="oral_on_escort"> Oral on Escort</label>
                                        <select class="form-control" name="oral_on_escort" id="oral_on_escort">
                                            <option value="" selected="">Choose</option>
                                            <option {{ $report->oral_on_escort == 'yes-daty-on-offer' ? 'selected' : '' }}
                                                value="yes-daty-on-offer">Yes, DATY on offer</option>
                                            <option {{ $report->oral_on_escort == 'yes-with-dam' ? 'selected' : '' }}
                                                value="yes-with-dam">Yes, with dam</option>
                                            <option {{ $report->oral_on_escort == 'yes-without-dam' ? 'selected' : '' }}
                                                value="yes-without-dam">Yes, without dam</option>
                                            <option {{ $report->oral_on_escort == 'no' ? 'selected' : '' }}
                                                value="no">No
                                            </option>
                                            <option {{ $report->oral_on_escort == 'unsure' ? 'selected' : '' }}
                                                value="unsure">Unsure</option>
                                            <option
                                                {{ $report->oral_on_escort == 'natural-on-trans-cd' ? 'selected' : '' }}
                                                value="natural-on-trans-cd">Natural (on Trans / CD)</option>
                                            <option
                                                {{ $report->oral_on_escort == 'covered-on-trans-cd' ? 'selected' : '' }}
                                                value="covered-on-trans-cd">Covered (on Trans / CD)</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label fw-semibold" for="anal_sex">Anal sex</label>
                                        <select class="form-control" name="anal_sex" id="anal_sex">
                                            <option value="" selected="">Choose</option>
                                            <option
                                                {{ $report->anal_sex == 'yes-protected-anal-sex-escort' ? 'selected' : '' }}
                                                value="yes-protected-anal-sex-escort">Yes, protected anal sex Escort
                                            </option>
                                            <option {{ $report->anal_sex == 'yes-raw-anal-sex-escort' ? 'selected' : '' }}
                                                value="yes-raw-anal-sex-escort">Yes, raw anal sex Escort</option>
                                            <option
                                                {{ $report->anal_sex == 'yes-protected-anal-sex-both-of-us' ? 'selected' : '' }}
                                                value="yes-protected-anal-sex-both-of-us">Yes, protected anal sex both of
                                                us
                                            </option>
                                            <option
                                                {{ $report->anal_sex == 'yes-raw-anal-sex-both-of-us' ? 'selected' : '' }}
                                                value="yes-raw-anal-sex-both-of-us">Yes, raw anal sex both of us</option>
                                            <option {{ $report->anal_sex == 'only-on-me-protected' ? 'selected' : '' }}
                                                value="only-on-me-protected">Only on me, protected</option>
                                            <option {{ $report->anal_sex == 'only-on-me-raw' ? 'selected' : '' }}
                                                value="only-on-me-raw">Only on me, raw</option>
                                            <option {{ $report->anal_sex == 'subject-to-size' ? 'selected' : '' }}
                                                value="subject-to-size">Subject to size</option>
                                            <option {{ $report->anal_sex == 'not-always' ? 'selected' : '' }}
                                                value="not-always">Not always</option>
                                            <option {{ $report->anal_sex == 'no' ? 'selected' : '' }} value="no">No
                                            </option>
                                            <option {{ $report->anal_sex == 'unsure' ? 'selected' : '' }} value="unsure">
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
                                                {{ $report->overall_performance == 'money-down-the-drain' ? 'selected' : '' }}
                                                value="money-down-the-drain">Money down the drain</option>
                                            <option
                                                {{ $report->overall_performance == 'should-not-have-bothered' ? 'selected' : '' }}
                                                value="should-not-have-bothered">Should not have bothered</option>
                                            <option
                                                {{ $report->overall_performance == 'not-really-worth-it' ? 'selected' : '' }}
                                                value="not-really-worth-it">Not really worth it</option>
                                            <option
                                                {{ $report->overall_performance == 'did-not-make-an-effort' ? 'selected' : '' }}
                                                value="did-not-make-an-effort">Did not make an effort</option>
                                            <option
                                                {{ $report->overall_performance == 'we-didnt-click' ? 'selected' : '' }}
                                                value="we-didnt-click">We didn’t click</option>
                                            <option {{ $report->overall_performance == 'was-rushed' ? 'selected' : '' }}
                                                value="was-rushed">Was rushed</option>
                                            <option {{ $report->overall_performance == 'it-was-ok' ? 'selected' : '' }}
                                                value="it-was-ok">It was ok</option>
                                            <option {{ $report->overall_performance == 'pretty-good' ? 'selected' : '' }}
                                                value="pretty-good">Pretty good</option>
                                            <option
                                                {{ $report->overall_performance == 'great-service' ? 'selected' : '' }}
                                                value="great-service">Great service</option>
                                            <option
                                                {{ $report->overall_performance == 'fantastic-time' ? 'selected' : '' }}
                                                value="fantastic-time">Fantastic time</option>
                                            <option
                                                {{ $report->overall_performance == 'out-of-this-world' ? 'selected' : '' }}
                                                value="out-of-this-world">Out of this world</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label fw-semibold" for="met_profile_undertakings">Met Profile
                                            undertakings </label>
                                        <select class="form-control" name="met_profile_undertakings"
                                            id="met_profile_undertakings">
                                            <option {{ $report->met_profile_undertakings == '' ? 'selected' : '' }}
                                                value="">Choose</option>
                                            <option {{ $report->met_profile_undertakings == 'yes' ? 'selected' : '' }}
                                                value="yes">Yes</option>
                                            <option {{ $report->met_profile_undertakings == 'no' ? 'selected' : '' }}
                                                value="no">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label fw-semibold" for="drug_consumption"> Drug
                                            consumption</label>
                                        <select class="form-control" name="drug_consumption" id="drug_consumption">
                                            <option {{ $report->drug_consumption == '' ? 'selected' : '' }}
                                                value="">
                                                Choose</option>
                                            <option {{ $report->drug_consumption == 'yes-meth' ? 'selected' : '' }}
                                                value="yes-meth">Yes, meth</option>
                                            <option {{ $report->drug_consumption == 'yes-poppers' ? 'selected' : '' }}
                                                value="yes-poppers">Yes, poppers</option>
                                            <option
                                                {{ $report->drug_consumption == 'yes-meth-and-poppers' ? 'selected' : '' }}
                                                value="yes-meth-and-poppers">Yes, meth and poppers</option>
                                            <option {{ $report->drug_consumption == 'yes-coke' ? 'selected' : '' }}
                                                value="yes-coke">Yes, coke</option>
                                            <option {{ $report->drug_consumption == 'dont-know' ? 'selected' : '' }}
                                                value="dont-know">Don’t know</option>
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
                                        <label class="form-label fw-semibold" for="status_type">Status Type <span
                                                style="color:#FF3C5F;">*</span></label>
                                        <select class="form-control" required="required" name="status_type"
                                            id="status_type">
                                            <option value="" selected="">Choose</option>
                                            <option {{ $report->status_type == 'average' ? 'selected' : '' }}
                                                value="average">Average</option>
                                            <option {{ $report->status_type == 'dog' ? 'selected' : '' }} value="dog">
                                                Dog
                                            </option>
                                            <option {{ $report->status_type == 'great-fuck' ? 'selected' : '' }}
                                                value="great-fuck">Great fuck</option>
                                            <option {{ $report->status_type == 'waste-of-time' ? 'selected' : '' }}
                                                value="waste-of-time">Waste of time</option>
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
                                                        src="{{ asset('escorts/uploads/notebox/' . $report->profile_pic) }}"
                                                        alt="Profile Pic" class="img-fluid rounded"
                                                        style="max-height:81px; max-width:100%; width:auto; height:auto; object-fit:contain;">
                                                @else
                                                    <img id="previewImg" src="" alt="Profile Pic"
                                                        class="img-fluid rounded"
                                                        style="max-height:81px; max-width:100%; width:auto; height:auto; object-fit:contain;">
                                                @endif

                                            </div>

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
                                             <div class="form-check form-check-inline">
                                                   <input type="radio" class="form-check-input" name="rating"
                                                      id="r6" value="6"
                                                      {{ $report->rating == '6' ? 'checked' : '' }}>
                                                   <label class="form-check-label" for="r6">6</label>
                                             </div>
                                             <div class="form-check form-check-inline">
                                                   <input type="radio" class="form-check-input" name="rating"
                                                      id="r7" value="7"
                                                      {{ $report->rating == '7' ? 'checked' : '' }}>
                                                   <label class="form-check-label" for="r7">7</label>
                                             </div>
                                             <div class="form-check form-check-inline">
                                                   <input type="radio" class="form-check-input" name="rating"
                                                      id="r8" value="8"
                                                      {{ $report->rating == '8' ? 'checked' : '' }}>
                                                   <label class="form-check-label" for="r8">8</label>
                                             </div>
                                             <div class="form-check form-check-inline">
                                                   <input type="radio" class="form-check-input" name="rating"
                                                      id="r9" value="9"
                                                      {{ $report->rating == '9' ? 'checked' : '' }}>
                                                   <label class="form-check-label" for="r9">9</label>
                                             </div>

                                             <div class="form-check form-check-inline">
                                                   <input type="radio" class="form-check-input" name="rating"
                                                      id="r10" value="10"
                                                      {{ $report->rating == '10' ? 'checked' : '' }}>
                                                   <label class="form-check-label" for="r10">10</label>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>                                    
                                    
                                 <div class="common-footer">
                                    <button type="submit" class="common-save-btn mr-2">Submit</button>
                                    <button type="reset" class="common-reset-btn">Reset</button>
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
    @endpush
