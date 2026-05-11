@extends('layouts.shareholder')
@section('content')
@section('style')
@endsection

@php
    $name = isset(auth()->user()->contact_person) ? auth()->user()->contact_person : '';
    $businessName = isset(auth()->user()->business_name) ? auth()->user()->business_name : '';
    $membershipTypes = config('common.membership_type');
     $membershipType = "";
    if(isset($shareholding->member_type)){
    $membershipType = isset($membershipTypes[$shareholding->member_type])
        ? $membershipTypes[$shareholding->member_type]
        : '';
    }
    $dateOfEntry = isset($shareholding->date_of_entry)
        ? showDateWithFormat($shareholding->date_of_entry, 'd-m-Y')
        : 'NA';
    $memberType = isset($shareholding->member_type) ? ucfirst($shareholding->member_type) : 'NA';
    $threshold = isset($shareholding->threshold) ? ucfirst($shareholding->threshold) : 'NA';
    $numberOfShares = isset($shareholding->number_of_shares) ? number_format($shareholding->number_of_shares) : 'NA';
    $shareholdingPercent = isset($shareholding->shareholding) ? $shareholding->shareholding ."%" : 'NA';
    $heldOnTrust = isset($shareholding->held_on_trust) ? ucfirst($shareholding->held_on_trust) : 'NA';
    $deedfile = isset($shareholding->trust_deed_file) ? $shareholding->trust_deed_file : '';
@endphp


<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1">My Shareholding</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                    <p></p>
                    <ol>
                        <li>Use this feature to keep up to date your shareholding.</li>
                        <li>Go to <a href="{{ route('shareholder.share-value') }}" class="custom_links_design">Share
                                Value</a> for information on the value of your shares.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>






    <div class="row">
        <!-- ALERT MESSAGE -->
        <div class="col-md-12 mb-3">
            <div id="formAlert" class="alert d-none rounded" role="alert"></div>
        </div>

        <div class="col-md-12 mb-5">
            <div id="accordion" class="myacording-design">
                <div class="card">

                    <div class="card-body" style="border: none;margin-top: 0px;padding-top: 0px;">
                        <form id="userProfile" class="v-form-design" action="#" method="POST">

                            <input type="hidden" name="user_id" value="1">

                            <!-- Shareholder  Details -->
                            <div class="row">
                                <div class=" mb-3 w-100">
                                    <h5 class="border-bottom pb-1 text-blue-primary">Shareholder Details</h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-10 px-0">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="my-agent">Shareholder</label>
                                                <input type="text" disabled class="form-control rounded-0"
                                                    name="shareholder" id="shareholder" value="{{ $businessName }}">
                                                <span class="text-danger error-shareholder"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="my-agent">Date of Entry</label>
                                                <input type="text" disabled class="form-control rounded-0"
                                                    name="entry_date" id="entry_date" value="{{ $dateOfEntry }}">
                                                <span class="text-danger error-entry_date"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="my-agent">Membership Type</label>
                                                <input type="text" disabled class="form-control rounded-0"
                                                    name="member_type" id="member_type" value="{{ $membershipType }}">
                                                <span class="text-danger error-member_type"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="my-agent">Threshold</label>
                                                <input type="text" disabled class="form-control rounded-0"
                                                    name="threshold" id="threshold" value="{{ $threshold }}">
                                                <span class="text-danger error-threshold"></span>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="my-agent">Number of Shares</label>
                                                <input type="text" disabled class="form-control rounded-0"
                                                    name="no_share" id="no_share" value="{{ $numberOfShares }}">
                                                <span class="text-danger error-no_share"></span>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="my-agent">Shareholding</label>
                                                <input type="text" disabled class="form-control rounded-0"
                                                    name="shareholding" id="shareholding" value="{{ $shareholdingPercent }}">
                                                <span class="text-danger error-shareholding"></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>



                            <!-- Building Security -->
                            <div class="row">
                                <div class=" mb-3 w-100">
                                    <h5 class="border-bottom pb-1 text-blue-primary">Beneficial Status</h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-10 px-0">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="my-agent">Held on Trust </label>
                                                <input type="text" disabled class="form-control rounded-0"
                                                    name="held-on-trust" id="held-on-trust"
                                                    value="{{ $heldOnTrust }}">
                                                <span class="text-danger error-held-on-trust"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="my-agent">Trustee</label>
                                                <input type="text" disabled class="form-control rounded-0"
                                                    name="trustee" id="trustee" value="{{ $name }}">
                                                <span class="text-danger error-trustee"></span>
                                            </div>
                                        </div>
                                        @if( $deedfile)
                                        <div class="col-md-6 trust-fields">
                                        <label for="trustee">Download Trust Deed 
                                            <a href="{{ asset('storage') }}/{{ $deedfile }}" class="custom_links_design" download="" title="Click here to dowload or view Trust Deed file.">here</a>.</label>

                                        </div>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            <input type="submit" value="save" class="btn btn-primary shadow-none float-right"
                                name="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script></script>
@endsection
