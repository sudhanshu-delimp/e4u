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
    <!--middle content start here-->
    <div class="row">
        <div class="col-md-12">
            <div class="v-main-heading h3" style="display: inline-block;">Create New Tour</div>
            <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>
{{--            <h2>{!! Session::has('msg') ? Session::get("msg") : '' !!}</h2>--}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-4" id="profile_and_tour_options">
            <div class="row collapse" id="notes">
                <div class="col-md-12 mb-5">
                    <div class="card">
                        <div class="card-body">
                          <h3 class="NotesHeader"><b>Notes:</b> </h3>
                          <ol>
                              <li>Use this feature to create a new Tour. The Tour creator is fully automated and will remember your Profile and Location selections.</li>
                              <li>Make sure you have <a href="/escort-dashboard/view-archives">created</a> all the Profiles you want to use on this Tour before you start. You can add more than one Profile per Location. A Profile will be posted and removed at midnight.</li>
                              <li>If you want your Profile to appear one day before you arrive at the Location, make sure you have that <a href="/escort-dashboard/update-account">feature</a> enabled.</li>
                              <li>If you change your schedule and will be staying longer or leaving sooner than the scheduled dates in your Tour, remember to <a href="/escort-dashboard/edit-tour">update</a> your Tour to reflect the new dates.</li>
                          </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="addTourForm">
                        <form id="myTour" method="post" action="{{route('escort.store.tour')}}">
                            @csrf
                            <div class="modal-body">
                                <div class="row pl-3">
                                    <div class="form-group mb-2 pt-2">
                                        <label for="staticEmail2" class="small-icon">Tour Name
                                            <img class="delay_tooltip" src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}"  data-toggle="tooltip" data-html="true" data-placement="top" title="When naming a Tour use a title that will make it easy for you to find it in the future, like for example, 'July 2023 Tour'." data-boundary="window">
                                            <span style='color:red'>*</span>
                                        </label>
                                    </div>
                                    <div class="form-group mx-sm-3 mb-2">
                                        <input type="text" name="name" required data-parsley-required-message=" Please enter Tour Name" class="form-control" id=" " placeholder=" " value="" data-parsley-errors-container="#Tname">
                                    </div>
                                </div>
                                <span id="Tname"></span>
                                <!--  <div class="form-group mb-2">
                                    <label for="staticEmail2">Tour Name</label>
                                    </div>
                                    <div class="form-group mx-sm-3 mb-2">
                                    <input type="text" name="name" required data-parsley-required-message=" Please enter Tour Name" class="form-control" id=" " placeholder=" " value=""> </div> -->
                                <div id="accordion" class="myacording-design mb-0 pt-3">
                                    @include('escort.dashboard.archives.partials.tourModal')
                                </div>
                                <div class="col-md-12 p-0">
                                    <button type="button" class="btn btn-primary create-tour-sec w-100 addLocation" data-count="1">Add Profile or Next Location{{-- <i class="fa fa-fw fa-plus" style="color: #fff;"></i>--}} </button>
                                </div>
                            </div>
                            <div class="modal-footer border-0 pt-3" style="justify-content: flex-start;">
                                <button type="submit" class="btn btn-secondary create-tour-sec" id="poli_payment">Save</button>
                                <button type="button" class="btn btn-primary create-tour-sec resetTour">Reset</button>
                            </div>
                        </form>
                    </div>
                    <!--middle content end here-->
                    <div class="modal delete" id="pesrmissionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                              <div class="modal-header main_bg_color border-0">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"> <span aria-hidden="true">
                                 </span>
                                 </button>
                              </div>
                              <div id="addTourForm1">
                                 <div class="col-md-12 pt-3">
                                    <span id="msg">  </span>
                                 </div>
                                 <input type="hidden" id="deleteId" value="">
                                 <div class="modal-footer border-0 pt-3" style="justify-content: flex-start;">
                                    <button type="submit" class="btn btn-secondary create-tour-sec permission">Yes</button>
                                    <button type="button" class="btn btn-primary create-tour-sec nopermission" data-dismiss="modal" aria-label="Close">No</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                    <div class="modal delete" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                              <div class="modal-header main_bg_color border-0">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"> <span aria-hidden="true">
                                 </span>
                                 </button>
                              </div>
                                <div>
                                    <div class="col-md-12 pt-3">
                                        <span id="msg1">  </span>
                                    </div>

                                    <div class="modal-footer border-0 pt-3" style="justify-content: flex-start;">

                                        <button type="button" class="btn btn-primary create-tour-sec" data-dismiss="modal" aria-label="Close">close</button>
                                    </div>
                                </div>
                           </div>
                        </div>
                     </div>
                </div>
            </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript">
    $('#userProfile').parsley({

    });
    $('#myTour').parsley({});


    $('#city').select2({
        allowClear: true,
        placeholder :'Select City',
        createTag: function(params) {
            var term = $.trim(params.term);

            if (term === '') {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: false // add additional parameters
            }
        },
        tags: false,
        minimumInputLength: 2,
        tokenSeparators: [','],
        ajax: {
            url: "{{ route('city.list') }}",
            dataType: "json",
            type: "GET",
            data: function(params) {
                // console.log(params);
                var queryParameters = {
                    query: params.term,
                    state_id: $('#state').val()
                }
                return queryParameters;
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {

                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            }
        }
    });

    $('#state').select2({
        allowClear: true,
        placeholder :'Select State',
        createTag: function(params) {
            var term = $.trim(params.term);

            if (term === '') {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: false // add additional parameters
            }
        },
        tags: false,
        minimumInputLength: 2,
        tokenSeparators: [','],
        ajax: {
            url: "{{ route('state.list') }}",
            dataType: "json",
            type: "GET",
            data: function(params) {
                // console.log(params);
                var queryParameters = {
                    query: params.term,
                    country_id: $('#country').val()
                }
                return queryParameters;
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {

                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            }
        }
    });


    $('#country').on('change', function(e) {
        if($(this).val()) {
            $('#state').prop('disabled', false);
            $('#state').select2('open');
        } else {
            $('#state').prop('disabled', true);
        }
    });

    $('#state').on('change', function(e) {
        if($(this).val()) {
            $('#city').prop('disabled', false);
            $('#city').select2('open');
        } else {
            $('#city').prop('disabled', true);
        }
    });
    $(function () {
       var count = 1;
       var lastIDstate = '';
       var startid = $("#startDate_").attr('id','startDate_'+count);
       var endid = $("#endDate_").attr('id','endDate_'+count);

        // {{--$('body').on('change', "#addLocation_"+count, function(e) {--}}
        $('body').on('change', ".addMore_Location", function(e) {

            var stateId = $(this).val();
            var locationId = $(this).attr('id');
            var getIdValue = locationId.split('_');
            // console.log("getval=",getIdValue[1]);
            var elem = $(this);
            //var addClass = $(".addAssign_").removeClass('addAssign_'+stateId);
            // console.log("hello state=", stateId);
            var url = "{{ route('escort.stateId',':id') }}";
            url = url.replace(':id',stateId);
            // console.log("count",count);
            $.ajax({
                url : url,
                method : "POST",
                success: function(data) {
                    // console.log(data);
                    var optionString = '';
                    $.each(data.escorts, function(index, elem) {
                        optionString += '<option value='+elem.id+'>'+elem.name+'</option>';
                        //$('#cityId').html('<option value='+index+'>'+elem+'</option>');

                        // console.log(elem);
                    });
                    $('.addAssign_'+getIdValue[1]).attr('id','assignProfile_'+data.id).html(optionString);
                    $("#assignProfile_"+data.id).attr('disabled',  false);
                    //$('#assignProfile_').attr('id','assignProfile_'+data.id).html(optionString);

                    // $('#assignProfile_1').html(optionString);
                   // ('.sunday').find('.form-group').find('.custom-select').remove();
                //    var addClass = $(".addAssign_").addClass('addAssign_'+count);
                //    var addId = $("#assignProfile_"+data.id);
                    //   var newClass = elem.parent().parent().find('.'+addClass).attr("class", 'addAssign_'+data.id);
                    //elem.parent().parent().find(addClass).addClass('addAssign_'+data.id);
                    // elem.parent().parent().find('.addAssign_').removeClass('.'+addClass);
                    // $(".assignProfile_"+data.id).attr('disabled',  false);
                    // $('.addAssign_'+data.id).html(optionString);
                    // console.log("error state",data.id);
                    //{{--$("#assignProfile_1").attr('disabled',  false);--}}
                    //let foooooo = elem.parent().parent().find('select');
                    //console.log(foooooo);
                },
                error: function (data) {
                    // console.log("error a",data);
                },

            });
        });
       $('body').on('click', '.addLocation', function(e) {
           //$('#myTour').parsley({});


           //$('#myTour').submit()

           $('#myTour').parsley().validate();
           if ($('#myTour').parsley().isValid()) {
                count += 1;
                var row_count = $(this).data('count')+ count - 1;
                // console.log("hello="+ row_count);
                // console.log("helloCount="+ count);
                var up = count -1;
                lastIDstate = $('#addLocation_'+up).val();

                // console.log("get up location id="+ $('#addLocation_'+up).val());
                // console.log("kk", $("#addLocation_"+count).attr('option'));

               if(row_count >= 0 && row_count <= 8) {
                    let tourModalAppend = @include('escort.dashboard.archives.partials.tourModalAppend');
                    $('#accordion').append(tourModalAppend);
                    var up_date = $("#startDate_"+up).val();
                   let [day, month, year] = up_date.split('-');
                   var up_result = new Date(year, month - 1, day);
                    var up_inc_date = up_result.setDate(up_result.getDate() + 1);
                    var increse_date = moment(up_inc_date).format('YYYY-MM-DD');
                        $("#startDate_"+count).attr('data-min', increse_date);
                        int_datePicker($("#startDate_"+count));
                        $("#endDate_"+count).attr('data-min', increse_date);
                        int_datePicker($("#endDate_"+count));


                    $("#addLocation_"+row_count+" option").each(function(){
                        var thisOptionValue=$(this).val();
                        /*if(lastIDstate == thisOptionValue) {
                            $("#addLocation_"+row_count+" option[value='"+ thisOptionValue + "']").attr({'disabled': true,'style':'background-color:#76767687'});
                        }*/
                    });
                }

           }


          $('#kstart_date_'+count).on('change', function()
           {
               // console.log(count);
               $("#end_date_"+count).show();
               var val = $(this).val();
               var result = new Date(val);
               var ss = result.setDate(result.getDate() + 1);
               var first_date = moment(ss).format('YYYY-MM-DD');
               //$("#end_date_"+count).val(first_date);
               //     $("#start_date_"+count).attr({
               //    "min" : first_date,
               //     "value" : first_date,         // values (or variables) here
               //     });
               // console.log(first_date);
           });

           // console.log("val");
       })

       $("body").on('click','#kstart_date_'+count,function(){

               var today = new Date();

               var start_date = moment(today).format('YYYY-MM-DD');
               var startdate = moment();
               //startdate = startdate.subtract(1, "days");
               $("#start_date_"+count).val(startdate);
                   $("#start_date_"+count).attr({
                   "min" : start_date,          // values (or variables) here
                   });
                   // console.log("ok date")

       });
       $("body").on('click','#kend_date_'+count,function(){

               var today = new Date();

               var start_date = moment(today).format('YYYY-MM-DD');
               var startdate = moment();
               //startdate = startdate.subtract(1, "days");
               $("#end_date_"+count).val(startdate);
                   $("#end_date_"+count).attr({
                   "min" : start_date,          // values (or variables) here
                   });

                   // console.log("ok end date")
       });

       $("body").on('change','#2start_date_'+count,function(){
       // $('#start_date_'+count).on('change', function()
       // {
       //     console.log(count);
           $("#end_date_"+count).show();
           var val = $(this).val();
           var result = new Date(val);
           console.log("end date "+result);
           var ss = result.setDate(result.getDate() + 1);
           var first_date = moment(ss).format('YYYY-MM-DD');
           $("#end_date_"+count).val(first_date);
               // $("#end_date_"+count).attr({
               // "min" : first_date,
               // "value" : first_date,         // values (or variables) here
               // });
               // console.log(first_date);
               // console.log(val);

       });
       $('body').on('click','.akhReset33',function(){
           var id = $(this).attr('id');
           var today = new Date();
           var start_date = moment(today).format('YYYY-MM-DD');
           var startdate = moment();
           $("#"+id).val(startdate);
           $("#"+id).attr({
           "min" : start_date,          // values (or variables) here
           });
           // console.log(id);

       });

        $('body').on('click','.resetTour', function () {
        $('#myTour')[0].reset();
        // $('input[type=date]').val('');
        var p_element = $(this);
        var element_class = p_element.attr('data-class');
        // console.log("hii="+element_class);
        $('select.'+element_class).prop('selectedIndex',0);
        $('input[type=date]').val('');
        $('input[type=text]').val('');
        //location.reload();

        });

            //////////submit form
        $("body").on('submit', '#myTour', function(e){
        e.preventDefault();
        // console.log("hiii");
        var form = $(this);
        // form.parsley().validate();
            if(count >= 2) {
                var url = form.attr('action');
                var data = new FormData($('#myTour')[0]);
                // console.log(url);
                $('#pesrmissionModal').modal('show');
                $('#msg').html("Are you sure you want to save?");
                $('.nopermission').click(function(){
                    location.reload();
                });
                $('.permission').click(function(){
                    $('#pesrmissionModal').modal('hide');
                    $.ajax({
                        method: form.attr('method'),
                        url:url,
                        data:data,
                        contentType: false,
                        processData: false,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function (data) {
                            // console.log(data);
                            if(!data.error){

                                $('#poli_payment').prop('disabled', true);
                                $('#poli_payment').html('<div class="spinner-border"></div>');
                                var tourId = data.tour.id;
                                var url = "{{ route('escort.tour.paymentUrl',':id')}}";
                                url = url.replace(':id',tourId);
                                // console.log("url = "+url);

                                $('<form/>', { action: url, method: 'POST' }).append($('<input>', {type: 'hidden', name: '_token', value: '{{csrf_token()}}'}),).appendTo('body').submit();
                                    // $.toast({
                                    // heading: 'Success',
                                    // text: 'Record successfully update',
                                    // icon: 'success',
                                    // loader: true,
                                    // position: 'top-right',
                                    //   // Change it to false to disable loader
                                    // loaderBg: '#9EC600'  // To change the background
                                    // });
                                    //location.reload();
                                    // console.log(data);
                            } else {
                                $.toast({
                                    heading: 'Error',
                                    text: 'Records Not update',
                                    icon: 'error',
                                    loader: true,
                                    position: 'top-right',      // Change it to false to disable loader
                                    loaderBg: '#9EC600'  // To change the background
                                });
                            }

                        }
                    });
                });
            } else {
                $('#notificationModal').modal('show');
                $('#msg1').html("Please Add more then one location");

            }

        })
    });
   $('body').on('change','.akhReset', function()
        {



            var val = $(this).attr('id');
            var selectedDate = $("#"+val).val();

            var getCountValue = val.split('_');

            if(getCountValue[0] == "startDate") {
                // var newResult = new Date();
                // var newdate = result.setDate(newResult.getDate());
                // var new_first_date = moment(newdate).format('YYYY-MM-DD');
                let [day, month, year] = selectedDate.split('-');
                var result = new Date(year, month - 1, day);
                var endDate = result.setDate(result.getDate() + 1);
                var first_date = moment(endDate).format('DD-MM-YYYY');
                //$("#endDate_"+getCountValue[1]).val('');
                $("#endDate_"+getCountValue[1]).data( "min", moment(endDate).format('YYYY-MM-DD')).attr('value', first_date);
                $("#endDate_"+getCountValue[1]).datepicker("destroy");
                int_datePicker($("#endDate_"+getCountValue[1]));
                /*$("#startDate_"+getCountValue[1]).attr({
                    "min" : new Date(year, month - 1, day)
                });*/
            }

                // $("#end_date").attr({
                // "min" : first_date,
                // "value" : first_date,         // values (or variables) here
                // });
                //$('#start_date_tab').html(val);

                // console.log("fksdf=",first_date);
                // console.log("get cont-",getCountValue[1]);

        });
</script>
@endpush
