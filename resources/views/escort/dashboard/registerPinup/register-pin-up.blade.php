
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
@php
    $startDate = new DateTime('now');
    $endDate = new DateTime('+6 months');

    $mondays = array();

    while ($startDate < $endDate) {
        if ($startDate->format('N') == 1) { // Monday is represented by '1' in ISO-8601
            $mondays[] = $startDate->format('d-m-Y');
        }

        $startDate->modify('+1 day');
    }
@endphp
@section('content')
<div class="container-fluid pl-3 pl-lg-5 register-pin-up mb-5">
    <!--middle content start here-->
        <div class="row">
            <div class="col-md-12">
                <div class="v-main-heading h3" style="display: inline-block;">Register for Pin-up</div>
                <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>
            </div>
            <div class="col-md-12 mt-4 pl-4 mycont">
                <div class="row collapse" id="notes">
                    <div class="col-md-12 mb-5">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                <p>Upon registration you will be:</p>
                                <ol class="">
                                    <li>Added to the Home Page Pin Up list for your nominated Location.</li>
                                    <li>Notified when your turn comes up; and</li>
                                    <li>Have a W-Alert sent to you for your confirmation that you still wish to proceed.</li>
                                    <li>Your posting will commence from the following Monday.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>




                <form id="pin_ups" action="{{ route('escort.pin_up.checkout')}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <button type="button" class="nex_sterp_btn" id="add">Add</button>
                        </div>
                        <div class="col-sm-12 listing_area">
                            <div class="row tab-input- pl-2 pt-4 eachListing">
                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    <div class="form-group row tab-about-me-row-padding saveDraft">
                                        <span class="removeCross" style="position: absolute; left: -25px;" title="click to remove"><img src="{{ asset('assets/app/img/cross.png')}}"></span>
                                        <label class="col-sm-5 font-weight-400" for="exampleFormControlSelect1">Choose State:</label>
                                        <div class="col-sm-7 pl-0">
                                            <select name="data[0][state_id]" class="custom-select mr-sm-2 state" required>
                                                <option value="">Select One</option>
                                                @foreach(config('escorts.profile.states') as $key => $state)
                                                    <option value="{{$key}}"  @if(!in_array($key, $escorts->pluck('state_id')->toArray()))  disabled style="background-color:#76767687"@endif>{{$state['stateName']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    <div class="form-group row tab-about-me-row-padding saveDraft">
                                        <label class="col-sm-5 font-weight-400" for="exampleFormControlSelect1">Choose Profile:</label>
                                        <div class="col-sm-7 pl-0">
                                            <select name="data[0][escort_id]" class="custom-select mr-sm-2 escort" required disabled>
                                                <option value="">Select Profile</option>
                                                {{--@foreach($escorts as $escort)
                                                    <option value="{{$escort->id}}">{{$escort->name}} ({{$escort->profile_name}})</option>
                                                @endforeach--}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    <div class="form-group row tab-about-me-row-padding saveDraft">
                                        <label class="col-sm-5 font-weight-400" for="exampleFormControlSelect1">Week start:</label>
                                        <div class="col-sm-7 pl-0">
                                            <select name="data[0][week_start]" class="custom-select mr-sm-2 week_start"  required disabled>
                                                <option value="">Select Week</option>
                                                @foreach($mondays as $monday)
                                                    <option value="{{$monday}}">{{$monday}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-right"><button type="submit" class="save_profile_btn" id="escort-form-submit-btn">Proceed to Payment</button></div>
                    </div>

                </form>

                <br>
                <br>




                <div id="accordion" class="myacording-design">
                    <div class="card">
                      <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#Conditions">
                          Conditions
                        </a>
                      </div>
                      <div id="Conditions" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                        <p style="font-size: 20px;">Registration </p>
                        <p>In order for you to be considered for the Home Page Pin Up, you must register your interest. Registratioin does not guarantee you will be posted on the Home Page.

</p>

    <p style="font-size: 20px;">Availability </p>
                        <p>The Home Page Pin Up service is only available for one week at a time. You can register as many times as you like, however, Pin Up availablity is subject to your ranking in the list.

</p>
    <p style="font-size: 20px;">Notification </p>
                        <p>Three days before your turn to be posted as the Pin Up becomes available, we will send you an W-Alert requesting confirmation that you still wish to proceed.

</p>

    <p style="font-size: 20px;">Pricing </p>
                        <p>The Pin Up service is charged at the rate of $475.00 for the week. Once you confirm you wish to proceed with the listing, your Card will be charged. You will receive confirmation of your payment and a W-Alert with details of when the Pin Up will be posted.
                       </p>


                      </div>
                      </div>
                    </div>
                </div>
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

    {{--$('#userProfile').parsley({--}}

    {{--});--}}



    {{--$('#userProfile').on('submit', function(e) {--}}
    {{--    e.preventDefault();--}}

    {{--    var form = $(this);--}}

    {{--    if (form.parsley().isValid()) {--}}

    {{--        var url = form.attr('action');--}}
    {{--        var data = new FormData(form[0]);--}}
    {{--        $.ajax({--}}
    {{--            method: form.attr('method'),--}}
    {{--            url: url,--}}
    {{--            data: data,--}}
    {{--            contentType: false,--}}
    {{--            processData: false,--}}
    {{--            headers: {--}}
    {{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
    {{--            },--}}
    {{--            success: function(data) {--}}
    {{--                if (!data.error) {--}}
    {{--                    $.toast({--}}
    {{--                        heading: 'Success',--}}
    {{--                        text: 'Details successfully saved',--}}
    {{--                        icon: 'success',--}}
    {{--                        loader: true,--}}
    {{--                        position: 'top-right', // Change it to false to disable loader--}}
    {{--                        loaderBg: '#9EC600' // To change the background--}}
    {{--                    });--}}

    {{--                } else {--}}
    {{--                    $.toast({--}}
    {{--                        heading: 'Error',--}}
    {{--                        text: 'Records Not update',--}}
    {{--                        icon: 'error',--}}
    {{--                        loader: true,--}}
    {{--                        position: 'top-right', // Change it to false to disable loader--}}
    {{--                        loaderBg: '#9EC600' // To change the background--}}
    {{--                    });--}}

    {{--                }--}}
    {{--            },--}}

    {{--        });--}}
    {{--    }--}}
    {{--});--}}
    {{--$('#city').select2({--}}
    {{--    allowClear: true,--}}
    {{--    placeholder :'Select City',--}}
    {{--    createTag: function(params) {--}}
    {{--        var term = $.trim(params.term);--}}

    {{--        if (term === '') {--}}
    {{--            return null;--}}
    {{--        }--}}
    {{--        return {--}}
    {{--            id: term,--}}
    {{--            text: term,--}}
    {{--            newTag: false // add additional parameters--}}
    {{--        }--}}
    {{--    },--}}
    {{--    tags: false,--}}
    {{--    minimumInputLength: 2,--}}
    {{--    tokenSeparators: [','],--}}
    {{--    ajax: {--}}
    {{--        url: "{{ route('city.list') }}",--}}
    {{--        dataType: "json",--}}
    {{--        type: "GET",--}}
    {{--        data: function(params) {--}}
    {{--            console.log(params);--}}
    {{--            var queryParameters = {--}}
    {{--                query: params.term,--}}
    {{--                state_id: $('#state').val()--}}
    {{--            }--}}
    {{--            return queryParameters;--}}
    {{--        },--}}
    {{--        processResults: function(data) {--}}
    {{--            return {--}}
    {{--                results: $.map(data, function(item) {--}}

    {{--                    return {--}}
    {{--                        text: item.name,--}}
    {{--                        id: item.id--}}
    {{--                    }--}}
    {{--                })--}}
    {{--            };--}}
    {{--        }--}}
    {{--    }--}}
    {{--});--}}

    {{--$('#state').select2({--}}
    {{--    allowClear: true,--}}
    {{--    placeholder :'Select State',--}}
    {{--    createTag: function(params) {--}}
    {{--        var term = $.trim(params.term);--}}

    {{--        if (term === '') {--}}
    {{--            return null;--}}
    {{--        }--}}
    {{--        return {--}}
    {{--            id: term,--}}
    {{--            text: term,--}}
    {{--            newTag: false // add additional parameters--}}
    {{--        }--}}
    {{--    },--}}
    {{--    tags: false,--}}
    {{--    minimumInputLength: 2,--}}
    {{--    tokenSeparators: [','],--}}
    {{--    ajax: {--}}
    {{--        url: "{{ route('state.list') }}",--}}
    {{--        dataType: "json",--}}
    {{--        type: "GET",--}}
    {{--        data: function(params) {--}}
    {{--            console.log(params);--}}
    {{--            var queryParameters = {--}}
    {{--                query: params.term,--}}
    {{--                country_id: $('#country').val()--}}
    {{--            }--}}
    {{--            return queryParameters;--}}
    {{--        },--}}
    {{--        processResults: function(data) {--}}
    {{--            return {--}}
    {{--                results: $.map(data, function(item) {--}}

    {{--                    return {--}}
    {{--                        text: item.name,--}}
    {{--                        id: item.id--}}
    {{--                    }--}}
    {{--                })--}}
    {{--            };--}}
    {{--        }--}}
    {{--    }--}}
    {{--});--}}


    {{--$('#country').on('change', function(e) {--}}
    {{--    if($(this).val()) {--}}
    {{--        $('#state').prop('disabled', false);--}}
    {{--        $('#state').select2('open');--}}
    {{--    } else {--}}
    {{--        $('#state').prop('disabled', true);--}}
    {{--    }--}}
    {{--});--}}

    {{--$('#state').on('change', function(e) {--}}
    {{--    if($(this).val()) {--}}
    {{--        $('#city').prop('disabled', false);--}}
    {{--        $('#city').select2('open');--}}
    {{--    } else {--}}
    {{--        $('#city').prop('disabled', true);--}}
    {{--    }--}}
    {{--});--}}


</script>
<script type="text/javascript">

    var listing_count = 1;
    var listing_area_html = '';
    var weekDates = '@json($mondays)';
    $(document).ready(function(e) {
        listing_area_html = $(".listing_area").html();
        $(document).on('click', '.removeCross', function(e) {
            if($(document).find('.eachListing').length > 1) {
                $(this).closest('.eachListing').remove();
            } else {
                alert('At-least one required');
            }
        });


        $(document).on('change', '.state', function(e) {
            var profileDD = $(this).closest('.eachListing').find('.escort');
            profileDD.attr('disabled', true);
            var weekStartDD = $(this).closest('.eachListing').find('.week_start');
            weekStartDD.attr('disabled', true);
            if($(this).val()) {
                _changeProfileDD(profileDD, $(this).val());
            }
            if($(this).val()) {
                _changeWeekDD(weekStartDD, $(this).val());
            }
        });
        /*$(document).on('change', '.escort', function(e) {
            var weekStartDD = $(this).closest('.eachListing').find('.week_start');
            weekStartDD.attr('disabled', false);
            if($(this).val()) {
                var stateID = $(this).closest('.eachListing').find('.state').val();
                _changeWeekDD(weekStartDD, stateID);
            }
        });*/
    });

    $("#pin_ups").on('submit', function(e) {
        var stateDateArr = [];
        var rowCount = 1;
        $.each($(".eachListing"), function(id, listRow) {
            var week = $(listRow).find('.week_start').val();
            var state = $(listRow).find('.state').val();
            console.log(state+'-'+week);
            if(stateDateArr.includes(state+'-'+week)) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Week date Already Selected',
                    text: 'Please change or delete the item no ' + rowCount
                });
                rowCount++;
                return false;
            } else {
                stateDateArr.push(state+'-'+week);
                rowCount++;
            }
        });
    });

    function _changeProfileDD(profileDD, stateId) {
        var url = "{{ route('escort.dashboard.pinUpDropdownData') }}";
        profileDD.attr('disabled', false);
        $.ajax({
            url : url,
            data: {
                "type": 'profileList',
                "stateId": stateId,
            },
            method : "GET",
            success: function(data) {
                var optionString = '<option value="">Select Profile</option>';
                $.each(data, function(id, escortName) {
                    optionString += '<option value='+id+'>'+escortName+'</option>';
                    $(profileDD).html(optionString);
                });
            },
            error: function (data) {
                // console.log("error a",data);
            },

        });
    }
    function _changeWeekDD(weekStartDD, stateId) {
        var url = "{{ route('escort.dashboard.pinUpDropdownData') }}";
        weekStartDD.attr('disabled', false);
        $.ajax({
            url : url,
            data: {
                "type": 'weekList',
                "stateId": stateId,
            },
            method : "GET",
            success: function(data) {
                var optionString = '<option value="">Select Week</option>';
                $.each(JSON.parse(weekDates), function(id, weekDate) {
                    if(!data.includes(weekDate)) {
                        optionString += '<option value='+weekDate+'>'+weekDate+'</option>';
                    }
                    $(weekStartDD).html(optionString);
                });
            },
            error: function (data) {
                // console.log("error a",data);
            },
        });
    }



    $('#add').on('click', function(e) {
        e.preventDefault();
        create_listing_html();
    });
    function create_listing_html() {
        var html = listing_area_html;
        html = html.replace('data[0][state_id]', 'data['+listing_count+'][state_id]');
        html = html.replace('data[0][escort_id]', 'data['+listing_count+'][escort_id]');
        html = html.replace('data[0][week_start]', 'data['+listing_count+'][week_start]');
        $(".listing_area").append(html);
        listing_count++;
    }
</script>
@endpush
