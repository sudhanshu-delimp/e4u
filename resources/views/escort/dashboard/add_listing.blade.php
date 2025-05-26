@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<style type="text/css">
    .parsley-errors-list {
    list-style: none;
    color: rgb(248, 0, 0)
    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5">
   <div class="row">
        <div class="col-md-12">
            <div class="v-main-heading h3" style="display: inline-block;">Add New Listing</div>
            <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>
        </div>
        <div class="col-md-12 mt-4" id="profile_and_tour_options">
            <div class="row collapse" id="notes">
                <div class="col-md-12 mb-5">
                    <div class="card">
                        <div class="card-body">
                          <h3 class="NotesHeader"><b>Notes:</b> </h3>
                          <ol>
                              <li>Use this feature to create a new Profile listing. The Profile, with verified Media, will be published immediately upon payment having been processed.</li>
                              <li>The Membership Type will default to Platinum. You can change the Membership Type by selecting the preferred Membership Type from the drop down list.</li>
                              <li>Make sure you have <a href="https://e4udev.perth-cake1.powerwebhosting.com.au/escort-dashboard/create-profile" class="custom_links_design">created</a> your Profile before you commence a new listing. All your Profiles will appear in the drop down list for the Location you are presently in. You can create as many listings as you like. Go to <a href="https://e4udev.perth-cake1.powerwebhosting.com.au/escort-dashboard/create-tour" class="custom_links_design">New Tour</a> if you want to create a Tour.</li>
                          </ol>
                        </div>
                    </div>
                </div>
            </div>
            <form id="socials_link" action="{{ route('escort.account.listing_checkout')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 text-right">
                        <button type="button" class="nex_sterp_btn" id="add_listing">Add Listing</button>
                    </div>
                    <div class="col-sm-12 listing_area">
                        <div class="row tab-input- pl-2 pt-4 eachListing">
                            <div class="col-lg-3 col-md-12 col-sm-12">
                                <div class="form-group row tab-about-me-row-padding saveDraft">
                                    <span class="removeCross" style="position: absolute; left: -25px;" title="click to remove"><img src="{{ asset('assets/app/img/cross.png')}}"></span>
                                    <label class="col-sm-5 font-weight-400" for="exampleFormControlSelect1">Choose Profile:</label>
                                    <div class="col-sm-7 pl-0">
                                        <select name="data[0][escort_id]" class="custom-select mr-sm-2"
                                                id="escort_profile" required>
                                            <option value="">Select One</option>
                                            @foreach($escorts as $escort)
                                                <option value="{{$escort->id}}">{{$escort->name}} ({{$escort->profile_name}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 col-sm-12">
                                <div class="form-group row tab-about-me-row-padding saveDraft">
                                    <label class="col-sm-5 font-weight-400" for="exampleFormControlSelect1">Start date:</label>
                                    <div class="col-sm-7 pl-0">
                                        <input type="date" name="data[0][start_date]"  data-provide="datepicker"
                                               class="form-control form-control-sm select_tag_remove_box_sadow profile_start"
{{--                                               value="{{ $escort->start_date ? date('Y-m-d',strtotime($escort->start_date)) : ''}}"--}}
                                               id="start_date" onkeydown="return false" required=""
                                               data-parsley-required-message="-select date-" data-parsley-group="goup_one">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 col-sm-12">
                                <div class="form-group row tab-about-me-row-padding saveDraft">
                                    <label class="col-sm-5 font-weight-400" for="exampleFormControlSelect1">End date:</label>
                                    <div class="col-sm-7 pl-0">
                                        <input type="date" name="data[0][end_date]" class="form-control form-control-sm select_tag_remove_box_sadow profile_end"
{{--                                               value="{{ $escort->end_date ? date('Y-m-d',strtotime($escort->end_date)) : ''}}"--}}
                                               id="end_date" onkeydown="return false" required=""
                                               data-parsley-required-message="-select date-" data-parsley-group="goup_one">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 col-sm-12">
                                <div class="form-group row tab-about-me-row-padding saveDraft">
                                    <label class="col-sm-5 font-weight-400" for="exampleFormControlSelect1">Membership Type:</label>
                                    <div class="col-sm-7">
                                        <select name="data[0][membership]" id="" required
                                                data-parsley-required-message="-select membership-" data-parsley-group="goup_one"
                                                style="width: 100%;" class="membership_type">
                                            <option value="">-Not Set-</option>
                                            <option value="1" selected {{--{{(!$escort->membership || $escort->membership == 1) ? 'selected' : ''}}--}}>Platinum</option>
                                            <option value="2" {{--{{($escort->membership == 2) ? 'selected' : ''}}--}}>Gold</option>
                                            <option value="3" {{--{{($escort->membership == 3) ? 'selected' : ''}}--}}>Silver</option>
                                            <option value="4" {{--{{($escort->membership == 4) ? 'selected' : ''}}--}}>Free</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-right"><button type="submit" class="save_profile_btn" id="escort-form-submit-btn">Proceed to Payment</button></div>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="text/javascript">

    var listing_count = 1;
    var listing_area_html = '';
    $(document).ready(function(e) {
        listing_area_html = $(".listing_area").html();
        $(document).on('click', '.removeCross', function(e) {
            if($(document).find('.eachListing').length > 1) {
                $(this).closest('.eachListing').remove();
            } else {
                alert('At-least one listing required');
            }
        });
    });
    $('#add_listing').on('click', function(e) {
        e.preventDefault();
        create_listing_html();
    });
    function create_listing_html() {
        var html = listing_area_html;
        html = html.replace('data[0][start_date]', 'data['+listing_count+'][start_date]');
        html = html.replace('data[0][end_date]', 'data['+listing_count+'][end_date]');
        html = html.replace('data[0][membership]', 'data['+listing_count+'][membership]');
        html = html.replace('data[0][escort_id]', 'data['+listing_count+'][escort_id]');
        $(".listing_area").append(html);
        listing_count++;
    }
</script>
@endpush
