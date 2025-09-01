@extends('layouts.center') @section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<style type="text/css">
    .parsley-errors-list {
    list-style: none;
    color: rgb(248, 0, 0);
    padding: 0;
    }
    .parsley-errors-list li{
    font-size: 14px;
    line-height: 18px;
    margin-top: 6px;
    }
</style>
@endsection
@section('content')
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
            <!--middle content-->
            <div class="row">
                <div class="custom-heading-wrapper col-md-12">
                    <h1 class="h1">New Profile ddd</h1>
                    <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <p></p>
                        <ol>
                                
                        </ol>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                   <div class="row">
                      <div class="col-lg-2">
                         <div class="form_process">
                            <div class="steps_to_filled_from">Step 1</div>
                            <p>About us</p>
                         </div>
                      </div>
                      <div class="col-lg-3">
                         <div class="form_process">
                            <div class="steps_to_filled_from">Step 2</div>
                            <p>Services &amp; Rates</p>
                         </div>
                      </div>
                    
                      <div class="col-lg-3">
                        <div class="form_process">
                           <div class="steps_to_filled_from">Step 3</div>
                           <p>Open times</p>
                        </div>
                     </div>
                      
                      <div class="col-lg-3">
                         <div class="form_process">
                            <div class="steps_to_filled_from">Step 4</div>
                            <p>Massure</p>
                         </div>
                      </div>
                      {{-- <div class="col-lg-3">
                         <div class="form_process">
                            <div class="steps_to_filled_from">Step 5</div>
                            <p>Check fee summary and pay</p>
                         </div>
                      </div> --}}
                      <div class="col-lg-1">
                        <p id="percent" style="font-size: 48px;font-weight: 700;">25%</p>
                      </div>
                   </div>
                   <div class="manage_process_bar_padding">
                      <div class="progress define_process_bar_width">
                         <div class="progress-bar define_process_bar_color" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                         </div>
                      </div>
                   </div>
                </div>
             </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Begin Page Content -->
                    <div class="row">
                        <div class="col-md-12 remove_padding_in_ph" id="tabs">
                            <ul class="dk-tab nav gap_between_btns" id="myTab" role="tablist">
                                <li class="nav-item m-0">
                                   <a class="nav-link active" id="home-tab" data-toggle="tab" href="#aboutme" role="tab" aria-controls="home" aria-selected="true">About us</a>
                                </li>
                                <li class="nav-item m-0">
                                   <a class="nav-link" id="profile-tab" data-toggle="tab" href="#services" role="tab" aria-controls="profile" aria-selected="false">Services &amp; Rates</a>
                                </li>
                                <li class="nav-item m-0">
                                   <a class="nav-link" id="contact-tab" data-toggle="tab" href="#available" role="tab" aria-controls="contact" aria-selected="false">Open Times</a>
                                </li>
                                <li class="nav-item m-0">
                                   <a class="nav-link" id="massuers-tab" data-toggle="tab" href="#massuers" role="tab" aria-controls="massuers" aria-selected="false">Massuers</a>
                                </li>
                                {{-- <li class="nav-item m-0">
                                   <a class="nav-link" id="pricing-tab" data-toggle="tab" href="#pricing" role="tab" aria-controls="contact" aria-selected="false">Check fee summary and pay</a>
                                </li> --}}
                                
                                
                            </ul>
                            <form id="my_massage_profile" action="{{ route('center.setting.profile',request()->segment(3) ) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="tab-content tab-content-bg" id="myTabContent">
                                    
                                    @include('center.dashboard.profile.partials.aboutme-dash-tab')
                                    @include('center.dashboard.profile.partials.services-dash-tab')
                                    @include('center.dashboard.profile.partials.available-dash-tab')
                                    @include('center.dashboard.profile.partials.pricing-dash-tab')
                                    @include('center.dashboard.profile.partials.massuers-dash-tab')
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal programmatic" id="change_all" style="display: none">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color border-0">
                {{-- <h5 class="modal-title" id="exampleModalLabel" style="color:white">Logout</h5> --}}
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                </span>
                </button>
            </div>
            <div class="modal-body">    
                <input type="hidden" id="current" name="current">
                <input type="hidden" id="previous" name="previous">
                <input type="hidden" id="label" name="label">
                <input type="hidden" id="trigger-element">
                <h3 class="mb-4 mt-5"><span id="Lname"></span> </h3>
                <h3 class="mb-4 mt-5"><span id="log"></span> </h3>
                <div class="modal-footer">
                    <button type="button" class="btn main_bg_color site_btn_primary" data-dismiss="modal" value="close" id="close_change">Close</button>
                    <button type="button" class="btn main_bg_color site_btn_primary" id="save_change">save</button>
                </div>
            </div>
        </div>
    </div>
</div>
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
@endsection 
@push('script')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/src/extra/validator/comparison.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>  
<script src="{{ asset('assets/dashboard/vendor/ckeditor/ckeditor.js') }}"></script>
<script>
        // var textarea = document.getElementById('editor1');
        // let editor = CKEDITOR.replace(textarea);
        var textarea = document.getElementById('editor1');
        
        
        let editor = CKEDITOR.replace(textarea);

        editor.on('instanceReady', function () {
            $.each(CKEDITOR.instances, function (instance) {
                //console.log($(CKEDITOR.instances[instance]).length);
                CKEDITOR.instances[instance].on("change", function (e) {
                    var desc = CKEDITOR.instances['editor1'].getData();
                    console.log("text=",desc.length);
                    
                    for (instance in CKEDITOR.instances) {
                        CKEDITOR.instances[instance].updateElement();
                       
                        let validateee = $('#my_massage_profile').parsley().validate({group: 'ckeditor'});
                        if(validateee != true) {
                            $(".who_am_i").attr('id',"who_am_i");
                        }
                        if(validateee == true) {
                            $(".who_am_i").attr('id',"update_who_am_i");
                        }
                        console.log("ddd--",validateee);
                        
                    }
                });
            });
        });
        
        // CKEDITOR.instances.editor1.on('key', function(e) {

        //     let utuyu = $('#my_massage_profile').parsley().validate({group: 'ckeditor'})
        //     console.log(utuyu);
        // });

        

        
        //console.log(editor.getData().replace(/<[^>]*>|\s/g, '').length);

        window.onload = function() {
            CKEDITOR.instances.editor1.on( 'key', function(event) {
               
                var deleteKey = 46;
                var backspaceKey = 8;
                var keyCode = event.data.keyCode;
               
                var str = CKEDITOR.instances.editor1.getData();
                if (str.length > 257) {
                    console.log(str.length);
                    if (keyCode === deleteKey || keyCode === backspaceKey) {
                        return true;
                    } else
                    { 
                        return false; 
                    }
                    //CKEDITOR.instances.editor1.setData(str.substring(0, 12));
                }
            } );
            CKEDITOR.instances.editor1.on( 'paste', function(event) {
                // event.editor.on('paste', function(evt) { 
                //     evt.data.dataValue = evt.data.dataValue.replace(/&nbsp;/g,'');
                //     evt.data.dataValue = evt.data.dataValue.replace(/<p><\/p>/g,'');
                    
                //     console.log(evt.data.dataValue);
                   
                // }, null, null, 9);
                var deleteKey = 46;
                var backspaceKey = 8;
                var keyCode = event.data.keyCode;
               
                var str = CKEDITOR.instances.editor1.getData();
                if (str.length > 257) {
                    console.log(str.length);
                    if (keyCode === deleteKey || keyCode === backspaceKey) {
                        return true;
                    } else
                    { 
                        return false; 
                    }
                    //CKEDITOR.instances.editor1.setData(str.substring(0, 12));
                }
            } );
        };
    
        $('#select2-dropdown').select2({
            createTag: function (params) {
                var term = $.trim(params.term);
    
                if (term === '') {
                    return null;
                }
                return {
                    id: term,
                    text: term,
                    newTag: true // add additional parameters
                }
            },
            tags: false,
            minimumInputLength: 2,
            tokenSeparators: [','],
            ajax: {
                url: "{{ route('country.list') }}",
                dataType: "json",
                type: "GET",
                data: function (params) {
                    console.log(params);
                    var queryParameters = {
                        query: params.term
                    }
                    return queryParameters;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
    
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });
</script>
<script>
    $('#update_about_me').parsley({
    
    });
   
$(document).ready(function() {
    $('#update_about_me').on('submit', function(e) {
        e.preventDefault();
    
        var form = $(this);
    
        if (form.parsley().isValid()) {
    
            var url = form.attr('action');
            console.log("url=" + url);
            var data = new FormData($('#update_about_me')[0]);
            $('#update-about-me').prop('disabled', true);
            $('#update-about-me').html('<div class="spinner-border"></div>');
            $.ajax({
                method: form.attr('method'),
                url:url,
                data:data,
                contentType: false,
                processData: false,
                //headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if(!data.error){
                        // $.toast({
                        //     heading: 'Success',
                        //     text: 'Record successfully update',
                        //     icon: 'success',
                        //     loader: true,
                        //     position: 'top-right',      // Change it to false to disable loader
                        //     loaderBg: '#9EC600'  // To change the background
                        // });
                        $('.Lname').html("Saved");
                        $("#my_account_modal").show();
                        $('#update-about-me').prop('disabled', false);
                        $('#update-about-me').html('Updated');
                    } else {
                        // $.toast({
                        //     heading: 'Error',
                        //     text: data.message,
                        //     icon: 'error',
                        //     loader: true,
                        //     position: 'top-right',      // Change it to false to disable loader
                        //     loaderBg: '#9EC600'  // To change the background
                        // });
                        $('.Lname').html("Oops.. sumthing wrong Please try again");
                        $("#my_account_modal").show();
                        $('#update-about-me').prop('disabled', false);
                        $('#update-about-me').html('Update');
                    }
                },
                'error': function(error){
                    data = error.responseJSON;
                    $.toast({
                        heading: 'Error',
                        text: data.message,
                        icon: 'error',
                        loader: true,
                        position: 'top-right',      // Change it to false to disable loader
                        loaderBg: '#FF3C5F'  // To change the background
                    });
                    $('#update-about-me').prop('disabled', false);
                    $('#update-about-me').html('Updated');
                }
            });
        }
    });
});
    $('#read_more').on('submit', function(e) {
        e.preventDefault();
    
        var form = $(this);
    
        if (form.parsley().isValid()) {
    
            var url = form.attr('action');
            var data = new FormData($('#read_more')[0]);

            $('#read-more').prop('disabled', true);
            $('#read-more').html('<div class="spinner-border"></div>');
            $.ajax({
                method: form.attr('method'),
                url:url,
                data:data,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if(!data.error){
                        // $.toast({
                        //     heading: 'Success',
                        //     text: 'Record successfully update',
                        //     icon: 'success',
                        //     loader: true,
                        //     position: 'top-right',      // Change it to false to disable loader
                        //     loaderBg: '#9EC600'  // To change the background
                        // });
                        $('.Lname').html("Saved");
                        $("#my_account_modal").show();
                        $('#read-more').prop('disabled', false);
                        $('#read-more').html('Updated');
                        //location.reload();
                    } else {
                        // $.toast({
                        //     heading: 'Error',
                        //     text: 'Records Not update',
                        //     icon: 'error',
                        //     loader: true,
                        //     position: 'top-right',      // Change it to false to disable loader
                        //     loaderBg: '#9EC600'  // To change the background
                        // });
                        $('.Lname').html("Oops.. sumthing wrong Please try again");
                        $("#my_account_modal").show();
                        $('#read-more').prop('disabled', false);
                        $('#read-more').html('Update');
                    }
                }
            });
        }
    });
    
    $('#update_abut_who_am_i').on('submit', function(e) {
    
        let about = editor.getData();
        var form = $(this);
        if (form.parsley().isValid()) {

            $('#update_who_am_i').prop('disabled', true);
            $('#update_who_am_i').html('<div class="spinner-border"></div>');
            var url = form.attr('action');
            var data = new FormData();
            data.append('about',about);
            //data.append('user_id',5);
            data.append('_token',$('input[name="_token"]').val());
            e.preventDefault();
    
            $.ajax({
                method: form.attr('method'),
                url:url,
                data:data,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                success: function (data) {
                    console.log(data);
                    if(!data.error){
                        // $.toast({
                        //     heading: 'Success',
                        //     text: 'Record successfully update',
                        //     icon: 'success',
                        //     loader: true,
                        //     position: 'top-right',      // Change it to false to disable loader
                        //     loaderBg: '#9EC600'  // To change the background
                        // });
                        $('.Lname').text("Saved");
                        $("#my_account_modal").show();
                        $('#update_who_am_i').prop('disabled', false);
                        $('#update_who_am_i').html('Updated');
                    } else {
                        // $.toast({
                        //     heading: 'Error',
                        //     text: 'Records Not update',
                        //     icon: 'error',
                        //     loader: true,
                        //     position: 'top-right',      // Change it to false to disable loader
                        //     loaderBg: '#9EC600'  // To change the background
                        // });
                        $('.Lname').html("Oops.. sumthing wrong Please try again");
                        $("#my_account_modal").show();
                        $('#update_who_am_i').prop('disabled', false);
                        $('#update_who_am_i').html('Update');
                    }
                }
            });
        }
    });
    
    $('#language').change(function(){
        var languageValue = $('#language').val();
        $("#show_language").show();
        $(".select_lang").hide();
        var selectedLanguage = $(this).children("option:selected", this).data("name");
        $("#show_language").append("<span class='languages_choosed_from_drop_down'>"+ selectedLanguage +" </span>");
        // $("#show_language").append("  <div class='selecated_languages' style='display: inline-block'><span class='languages_choosed_from_drop_down'>"+ selectedLanguage +" </span> </div> ");
        $("#container_language").append("<input type='hidden' name='language[]' value="+ languageValue +">");
        $("#language option[value='"+languageValue+"']").remove();
    });
    
    $(document).ready(function(){
       $('body').on('click', '.akh1', function() {
            var id = $(this).attr('id');
            var val = $(this).data('val');
            var name = $(this).data('sname');
            $('#hideenclassOne_'+val).remove();

            $("#service_id_one").append("<option id='"+name+"' value='"+val+"'>"+name+"</option>"); 
            console.log("click "+name);
        });
    });
    
    
    $(document).ready(function(){
       $('body').on('click', '.akh2', function() {
            var id = $(this).attr('id');
            var val = $(this).data('val');
            var name = $(this).data('sname');
            $('#hideenclassTwo_'+val).remove();
    
            $("#service_id_two").append("<option id='"+name+"' value='"+val+"'>"+name+"</option>"); 
            console.log("click "+name);
            console.log("id= "+id);
            console.log("val= "+val);
        });
    });
    $(document).ready(function(){
       $('body').on('click', '.akh3', function() {
            var id = $(this).attr('id');
            var val = $(this).data('val');
            var name = $(this).data('sname');
            $('#hideenclassThree_'+val).remove();

            $("#service_id_three").append("<option id='"+name+"' value='"+val+"'>"+name+"</option>"); 
            console.log("click "+name);
        });
    });
///////////////clear reset ////////////////////  
   
    
    $('body').on('change','#service_id_one', function(){
        var selectedIdOne = $('#service_id_one').val();
        var getNameOne = $(this).children(":selected").attr("id");
        if(selectedIdOne){
            $("#selected_service_one").append(" <li id='hideenclassOne_"+ selectedIdOne+"'><div class='my_service_anal' ><span class='dollar-sign'>"+getNameOne+"</span><input type='number' class='dollar-before input_border' name='price[]' placeholder='0' min='0' oninput='this.value = Math.abs(this.value)' step=10 max=200><input type='hidden' name='service_id[]' value="+ selectedIdOne +" placeholder=''><input type='hidden' name='category_id[]' value='1'><span><i class='fas fa-times-circle akh1' data-sname='"+getNameOne+"' data-val="+ selectedIdOne+"  id='id_"+ selectedIdOne+"' value="+selectedIdOne+"></i></span></div></li> ");
            $("#service_id_one option[value="+ selectedIdOne +"]").attr('disabled','disabled');
            $("#service_id_one option[value="+ selectedIdOne +"]").remove();
            console.log('change='+selectedIdOne);
        }
    });
    
    
    $('body').on('change','#service_id_two', function(){
        var selectedIdTwo = $('#service_id_two').val();
        var getNameTwo = $(this).children(":selected").attr("id");
        if(selectedIdTwo){
            $("#selected_service_two").append(" <li id='hideenclassTwo_"+ selectedIdTwo+"'><div class='my_service_anal hideenclassTwo"+selectedIdTwo+"'><span class='dollar-sign'>"+getNameTwo+"</span><input type='number' class='dollar-before input_border' name='price[]' placeholder='0' min='0' oninput='this.value = Math.abs(this.value)' step=10 max=200><input type='hidden' name='service_id[]' value="+ selectedIdTwo +" placeholder=''><input type='hidden' name='category_id[]' value='2'><span><i class='fas fa-times-circle akh2'  data-sname='"+getNameTwo+"' data-val="+ selectedIdTwo+"  id='id_"+ selectedIdTwo+"' value="+selectedIdTwo+"></i></span></div></li> ");
            $("#service_id_two option[value="+ selectedIdTwo +"]").attr('disabled','disabled');
            $("#service_id_two option[value="+ selectedIdTwo +"]").remove();
            console.log('change='+selectedIdTwo);
        }
    });
    
   
    //saveProfilename
    $('body').on('click','#saveProfilename', function(e){
        e.preventDefault();
        var profile_name = $('#profile_name').val();
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var membership = $('#membership').val();

        var loc = $(location).attr('pathname');
        var numbersArray = loc.split('/');
            console.log( numbersArray[2]);
            
        if(numbersArray[2] == 'profile')
        {
            $('#update_about_me').submit();
            window.location.href ="{{ route('center.profile.basic.update', $escort->id) }}";
        }
        if(numbersArray[2] == 'create-profile')
        {
            // $('#myServices').submit();
            // $('#storeRate').submit();
            // $('#myability').submit();
            // $('#read_more').submit();
            $.post({
                    type: 'POST',
                    url: "{{ route('center.setting.profile') }}",
                    data: {
                        profile_name: profile_name,
                        start_date: start_date,
                        end_date: end_date,
                        //membership: membership,

                    },
                    headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                }).done(function (data) {
                    console.log(data.error);
                    console.log("console="+data.escortId);
                    if(data.error == 1){
                        $.toast({
                            heading: 'Success',
                            text: 'Record successfully update',
                            icon: 'success',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                        var url = "{{ route('center.profile.basic.update',':id') }} ";
                        url = url.replace(':id', data.escortId);
                        console.log(url);
                        window.location.href =url;
                        
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
                });

           // window.location.href ="{{ route('escort.setting.profile') }}";
        }
        
        
       
        
    });

    //start available //
    $('.available_to').click( function() {
    var val = $(this).val();
    console.log($(this).val());
    $(this).is(':checked') ? $('#'+val).show() : $('#'+val).hide();
    });
    
    //end  to
    //start playType //
    $('.playType').click( function() {
    var val = $(this).val();
    var name = $(this).data('name');
    $(".show_playType").show();
    console.log(name);
    // $(this).is(':checked') ? $("#show_playType").append("<div class='selecated_languages playT' style='display: inline-block' id='"+val+"'><span class='languages_choosed_from_drop_down'>"+ name +" </span> </div> ") : $('.playT #'+val).remove();
        
    //$(this).is(':checked') ? $('#show_playType').show() : $('#'+val).hide();
    if($(this).is(':checked'))
    {
        $("#show_playType").append("<div class='selecated_languages playT' style='display: inline-block' id='"+val+"'><span class='languages_choosed_from_drop_down'>"+ name +" <small class="remove-lang">×</small></span> </div> ")
    } 
    else 
    {
        $('#show_playType #'+val).remove();
    } 
    });
    
    //end  to
    $(".membership_type").each(function( index){
        $('body').on('click','#type_'+index, function(e){
            e.preventDefault();
            var href = $("#membershipType").attr('action');
            var plan_type = $(this).data('value');
            //var data = new FormData($('#membershipType')[0]);
            var id = $('#hidden-escort-id').val();
            console.log()
            $.ajax({
                url : href,
                method : "POST",
                data : {'plan_type': plan_type},
                //contentType: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    console.log(data);
                    if(data.error == 1){
                        $.toast({
                            heading: 'Success',
                            text: 'Record successfully update',
                            icon: 'success',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
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
                },
    
        });
    
    });
    });
    

    
    
    
    
    
    // $('#read_more').parsley({
    
    // });
    // $('#myability').parsley({
    
    // });
    // $('#myPolicy').parsley({
    
    // });
    $('#my_massage_profile').parsley({
    
    });
    
    
    // $('.resetdays').each(function( index ){
    //     var days = $(this).attr('id');
    //     $('#'+ days).click(function(){
    //         console.log($(this).data('day'));
            
    //         $("."+$(this).data('day')+" option:selected").removeAttr("selected");
    //     });
    // });
    
    
    $('#banner-image-upload').on('change', function(e) {
        $('#banner-image-preview').attr('src', URL.createObjectURL(e.target.files[0]));
    });
    
    $('#banner-video-upload').on('change', function(e) {
        $('#banner-video-preview').show();
        $('#banner-video-preview').attr('src', URL.createObjectURL(e.target.files[0]));
    });

    $("#start_date").on('click', function() 
    {
        var today = new Date();
        console.log(today);
        var start_date = moment(today).format('YYYY-MM-DD');  
        
            $("#start_date").attr({
            "min" : start_date,          // values (or variables) here
            }); 
    });
    $("#end_date").on('click', function() 
    {
        var today = new Date();
        var st_date = $("#start_date").val();
        if(st_date) {
            var result_date = new Date(st_date);
            var start_date = moment(result_date).format('YYYY-MM-DD');  
        } else {
            var start_date = null;
        }
        
        
        
        var today_date = moment(today).format('YYYY-MM-DD');  
        if(start_date) {
             $("#end_date").attr({
            "min" : start_date,          // values (or variables) here
            });  
           
        } else {
            $("#end_date").attr({
            "min" : today_date,          // values (or variables) here
            }); 
            

        }
            

    });
    $(document).ready(function(){

        $("#end_date").prop( "disabled", true );

        $('body').on('change','#start_date', function()
        {
            $("#end_date").prop( "disabled", false );
           
            var val = $(this).val();
            
            var result = new Date(val);
            var ss = result.setDate(result.getDate() + 1);
            var first_date = moment(ss).format('YYYY-MM-DD');  
            $("#end_date").val('');
                $("#start_date").attr({
                "min" : val, 
                "value" : val,         // values (or variables) here
                });
                // $("#end_date").attr({
                // "min" : first_date, 
                // "value" : first_date,         // values (or variables) here
                // });
                //$('#start_date_tab').html(val);
            
                console.log(first_date);
                console.log(val);
            
        });

        $('body').on('change','#end_date', function()
        {
        
            var val = $(this).val();
        
            var result = new Date(val);
            var ss = result.setDate(result.getDate() - 1);
            var first_date = moment(ss).format('YYYY-MM-DD');  
            
                // $("#start_date").attr({
                // "min" : first_date, 
                // "value" : first_date,         // values (or variables) here
                // });
                $("#end_date").attr({
                "min" : val, 
                "value" : val,         // values (or variables) here
                });
                //$('#start_date_tab').html(val);
                console.log(first_date);
                console.log(val);
            
        });
    });

    $('#play-mates-modal').on('shown.bs.modal', function (e) {

        var name, city, source = e.relatedTarget;

        $('#hidden_escort_id').val($(source).data('id'));
        console.log("id is here" + $(source).data('id'));

        if(name = $(source).data('name')) {
            $('#playmate-modal-name').html('Playmates for ' + $(source).data('name'));
        }

        if(city = $(source).data('city')) {
            $('#playmate-modal-location').html('<svg width="14" height="21" viewBox="0 0 14 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 10C6.33696 10 5.70107 9.73661 5.23223 9.26777C4.76339 8.79893 4.5 8.16304 4.5 7.5C4.5 6.83696 4.76339 6.20107 5.23223 5.73223C5.70107 5.26339 6.33696 5 7 5C7.66304 5 8.29893 5.26339 8.76777 5.73223C9.23661 6.20107 9.5 6.83696 9.5 7.5C9.5 7.8283 9.43534 8.15339 9.3097 8.45671C9.18406 8.76002 8.99991 9.03562 8.76777 9.26777C8.53562 9.49991 8.26002 9.68406 7.95671 9.8097C7.65339 9.93534 7.3283 10 7 10V10ZM7 0.5C5.14348 0.5 3.36301 1.2375 2.05025 2.55025C0.737498 3.86301 0 5.64348 0 7.5C0 12.75 7 20.5 7 20.5C7 20.5 14 12.75 14 7.5C14 5.64348 13.2625 3.86301 11.9497 2.55025C10.637 1.2375 8.85652 0.5 7 0.5V0.5Z" fill="#FF3C5F"></path></svg>' + $(source).data('city'));
        }

        $.ajax({
            url: $(source).data('url'),
            success: function (data) {
                $('#playmate-template').html(data);
            }
        });
    });

    $('#play-mates-modal').on('hidden.bs.modal', function () {
        $('#playmate-template').html('<div class="spinner-border text-secondary" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div>');
        $('#playmate-modal-name').html('');
        $('#playmate-modal-location').html('');
    });

    
    

    $('#search-playmate-input').on('change', function(e) {
        
        if($(this).val()) {
            $('#playmate_submit_button').show();
        } else {
            $('#playmate_submit_button').hide();
        }
    });
    
    function formatEscortList (data) {
        console.log('ckjoiujk;',data);
        return $('<span><img class="profile-user-img img-responsive img-circle img-profile rounded-circle small-round-fixed" src="'+data.text+'"> '+data.name+' || '+data.member_id+'</span>');

    }

    $('#add-playmate-form').on('submit', function(e) {
        e.preventDefault();
        $('#playmate_submit_button').attr('disabled', true);
        $('#playmate_submit_button').html('<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>')
        var $this = $(this);
        var escort_id = $('#hidden_escort_id').val();
        var member_id = $('#search-playmate-input').val();
        var url = $this.attr('action');
       
        $.post({
            type: $this.attr('method'),
            url: url,
            data: {
                escort_id: escort_id,
                playmate_id: member_id
            },
            success: function (data) {
                $('#search-playmate-input').val('');
                $('#playmate_submit_button').hide();
                $('#playmate-template').html(data);
            },
            error: function (data) {
                console.log(data);
            },
        }).done(function (data) {
            $('#playmate_submit_button').attr('disabled', false);
            $('#playmate_submit_button').html('Add Playmate');

            //$("#search-playmate-input").select2("val", "");
            $("#search-playmate-input").empty().trigger('change')
            
        });
    });

    $(document).on('click', '.remove-playmate', function(e) {
        e.preventDefault();

        var $this = $(this);
        var escort_id = $this.data('escort_id');
        var playmate_id = $this.data('playmate_id');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Remove',
            cancelButtonText: 'Cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post({
                    type: 'POST',
                    url: "{{ route('escort.playmates.remove') }}",
                    data: {
                        escort_id: escort_id,
                        playmate_id: playmate_id
                    },
                }).done(function (data) {
                    if(data.error == 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message
                        });
                    } else {
                        swalWithBootstrapButtons.fire({
                            icon: 'success',
                            title: '',
                            text: data.message
                        });
                       // location.reload();
                        $('#playmate-template').html(data.template);
                    }
                });
            }
        });
    });

   
    $("body").on('click','.nex_sterp_btn',function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $(this).removeClass('active');
        $(".nav-link").removeClass('active');
        
        $("#"+id).addClass('active');
        console.log("id=" +id)
    });

    $('.covidreport').on('change', function(e) {
        if($(this).val() == 1 || $(this).val() == 2) {
            $('#covid-file-block').show();
        } else {
            $('#covid-file-block').hide();
        }
    })
    // var numInput = document.querySelector('input');
    // $(document).on("paste","input[type='number']", function(e) {
    // if (e.originalEvent.clipboardData.getData('text').match(/[^\d(\.\d)*$]/))
    // e.preventDefault(); //prevent the default behaviour 
    // })
    // .on("keypress", function(e) {
    // if (e.keyCode != 46 && e.keyCode > 31  && (e.keyCode < 48 || e.keyCode > 57))
    //  e.preventDefault();
    // });

    $(function () {
        var previous;

        $(".change_default").focus(function () {
            previous = this.value;
            //var label = jQuery(this).closest(".form-group").find("label").text();
            
            console.log("label "+label);
        }).change(function() {
            // Do soomething with the previous value after the change
            var Current = $(this).val();
            var label = $(this).attr('id');
            $('#trigger-element').val( $(this).attr('name'));
            $('#label').val(label);
            $('#current').val(Current);
            $('#previous').val(previous);
            //$(".Lname").text("current value "+Current+ " previous ="+previous);
            $("#Lname").html("<p>Would you like to update <b>"+label+"</b> to your Additional information?</p>");
            
            $('#change_all').modal('show');
            previous = this.value;
        });
    });

    $("#change_all").on("hidden.bs.modal", function (e) {

        if ($('#change_all').hasClass('programmatic')) {
            console.log('hide', e.relatedTarget);
            var trigger_elem =  $('#trigger-element').val();
            $('select[name="'+trigger_elem+'"]').val($('#previous').val());
        }
        
        //console.log(trigger_elem, $('select[name="'+trigger_elem+'"]'));
    });
    $(document).ready(function(){
        
        $('#save_change').on("click", function(e) {
            $('#change_all').removeClass('programmatic');
            console.log('save', e.relatedTarget);
            $('#change_all').modal('hide');
        });
        // close modal on clicking close button
        

    });
    // $(document).ready(function(){
    //     $('.resetdays').click(function(){
    //         var p_element = $(this);
    //         var id = $(this).attr('id');
    //         var element_class = p_element.attr('data-day');
    //         console.log("select."+element_class);
    //         $('select.'+element_class).prop('selectedIndex',0);
            
    //     });
    // });

    $(document).ready(function(){
        $('.resetdays').click(function(){
            var p_element = $(this);
            var id = $(this).attr('id');
            var element_class = p_element.attr('data-day');
            console.log("select."+element_class);
            $('select.'+element_class).prop('selectedIndex',0);
            $('select.'+element_class).attr('disabled', false)
            //$('input[name="covidreport"]').removeAttr('checked');
            //var ch = $(" input[name='mytime[]']:checked").val();
            var ch = $('input.'+element_class+":checked").val();
            $('input.'+element_class+":checked").prop('checked', false);
            console.log(ch);
            
        });
        
        // $('.sunday').click(function(){
        //     var p_element = $(this);
        //     $('select.sunday').prop('selectedIndex',0);
        //     $('select.sunday').off('click');
            
        //     console.log("select. ");
        // });
        
    });
    
    $('.monday').on('change',function(){
            var p_element = $(this).attr('id');
            $('select.'+p_element).prop('selectedIndex',0);
            $('select.'+p_element).attr('disabled', true);
        })
        $('.tuesday').on('change',function(){
            var p_element = $(this).attr('id');
            $('select.'+p_element).prop('selectedIndex',0);
            $('select.'+p_element).attr('disabled', true);
        })
        $('.wednesday').on('change',function(){
            var p_element = $(this).attr('id');
            $('select.'+p_element).prop('selectedIndex',0);
            $('select.'+p_element).attr('disabled', true);
        })
        $('.thursday').on('change',function(){
            var p_element = $(this).attr('id');
            $('select.'+p_element).prop('selectedIndex',0);
            $('select.'+p_element).attr('disabled', true);
        })
        $('.friday').on('change',function(){
            var p_element = $(this).attr('id');
            $('select.'+p_element).prop('selectedIndex',0);
            $('select.'+p_element).attr('disabled', true);
        })
        $('.saturday').on('change',function(){
            var p_element = $(this).attr('id');
            $('select.'+p_element).prop('selectedIndex',0);
            $('select.'+p_element).attr('disabled', true);
        })
        $('.sunday').on('change',function(){
            var p_element = $(this).attr('id');
            $('select.'+p_element).prop('selectedIndex',0);
            $('select.'+p_element).attr('disabled', true);
           // $('select.'+p_element).remove();
            //$('.sunday').find('select').find('option[value]').remove();
            //console.log(p_element);
        })
    $("#close").click(function()
    {
        $("#my_account_modal").hide();
        //location.reload();
    });
    $(document).ready(function(){
        $("body").on("click","#update_who_am_i",function(){
            $('.comman_msg').html("Update");
            $("#comman_modal").modal('show');
        });
        $("body").on("click","#read-more",function(){
            $('.comman_msg').html("Update");
            $("#comman_modal").modal('show');
            
        });
        $("body").on("click","#my_services",function(){
            $('.comman_msg').html("Update");
            $("#comman_modal").modal('show');
           
        });
        $("body").on("click","#store_rate",function(){
            $('.comman_msg').html("Update");
            $("#comman_modal").modal('show');
           
        });
        $("body").on("click","#my_abilities",function(){
            $('.comman_msg').html("Saved");
            $("#comman_modal").modal('show');
            
        });
        
        $("body").on("submit","#my_massage_profile",function(e){
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var data = new FormData($('#my_massage_profile')[0]);
            
            //console.log(data);
            console.log("submit form");
            
   
            $.ajax({
                method: form.attr('method'),
                url:url,
                data:data,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    console.log(data);
                    console.log(data.my_data.new_profile);
                    console.log("hiiii");
                    if(data.my_data.new_profile == 1){
                        if(data.my_data.msg != null) {
                            $('.comman_msg').text(data.my_data.msg);
                        } else {
                            $('.comman_msg').html("Saved");
                        }
                        
                        $("#comman_modal").modal('show');
                        //window.location.href = data.my_data.url;
                        $('#comman_modal').on('hidden.bs.modal', function () {
                            window.location.href = data.my_data.url;
                        });
                       
                       
                    } else {
                        //console.log("else hiiiii");
                    }
                },
                error: function (data) {
                
                    var errors = $.parseJSON(data.responseText);
                    console.log(errors);
                    $('.comman_msg').html("<p>"+errors.message+"</p>");
                    $("#comman_modal").modal('show');
                    $('#comman_modal').on('hidden.bs.modal', function () {
                        location.reload();
                    });
                
                }
            });

        });
        $("body").on("click","#new_saveProfilename",function(e){
            e.preventDefault();
            $('.show_input_box').show();
            $('.stage_name').hide();
            $('.mobile_num').hide();
            $('.add_class').hide();
            console.log("hiiii")
        });
        $("body").on("click","#home-tab2",function(){
            
            // $('.define_process_bar_color').attr('style','width :25%');//.percent
            // $('#percent').html('25%');
           
            console.log("home-tab")
        });
        $("body").on("click","#contact-tab2",function(){
            var href = $(this).attr('href');
            // $('.define_process_bar_color').attr('style','width :75%');//.percent
            // $('#percent').html('75%');
           //console.log("contact-tab"+href)
        });
        $("body").on("click","#profile-tab2",function(){
            // var name = $("#profile_name").val();
            
            // $('.define_process_bar_color').attr('style','width :50%');//.percent
            // $('#percent').html('50%');
            
           
            
        });
        $("body").on("click","#pricing-tab33",function(){  
            var href = $(this).attr('href');  
            // $('.define_process_bar_color').attr('style','width :100%');//.percent
            // $('#percent').html('100%');
            var name = $("#profile_name").val();
            $('#pro_name_tab').html(name);

            var end = new Date($("#end_date").val());
            var start = new Date($("#start_date").val());
            //var diff = new Date(end - start);
            if(isNaN(start)) {
                console.log("is not");
            } else {
                
                var diff = end.getTime() - start.getTime();
                var days = diff / (1000 * 3600 * 24); 
                $('#duration_tab').html(days);
                if(days !== null && days <= 21) {
                    var rate = days*30/days;
                    var total_rate = days*30;
                    var dis = 0;
                    $('#rate_tab').html("$ "+rate.toFixed(2));
                    console.log("<=21");
                } else {
                    var above_day = days - 21;
                    var rate = (above_day*28.5 + 21*30)/days;
                    var total_rate = (above_day*28.5 +630);
                    
                    var dis = above_day*1.5;

                    $('#rate_tab').html("$ "+rate.toFixed(2)); 
                    console.log(">21"+days);
                }
                
                $('#dis_tab').html("$ "+dis.toFixed(2));
                $('#total_rate').html("$ "+total_rate.toFixed(2));
                var  fee = 30.0033;
                $('#fee_tab').html("$ "+fee.toFixed(2));

            }
                console.log("start ->"+start);

            // get days
            
            

            //
            var day = $('#duration_tab').html();
            
            
            
            //console.log("pricing-tab");
            //console.log(start+"----"+end);
            //console.log(diff);
        });
        $('body').on('change','#city_id', function(){
            var selectedId = $('#city_id').val();
            var getName = $(this).children(":selected").attr("id");
            $('#location_tab').html(getName);
        
        });
        $("body").on("click","#defaultImg",function(){  
            var url = "{{ route('center.get.default.images')}}"; 
            $.ajax({
                type: 'POST',
                url:url,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    console.log(data);
                    if(data.error == true){
                        console.log(data.path[8]);
                        
                        $("#blah1").attr('src',data.path[1]['path']);
                        $("#blah2").attr('src',data.path[2]['path']);
                        $("#blah3").attr('src',data.path[3]['path']);
                        $("#blah4").attr('src',data.path[4]['path']);
                        $("#blah5").attr('src',data.path[5]['path']);
                        $("#blah6").attr('src',data.path[6]['path']);
                        $("#blah7").attr('src',data.path[7]['path']);
                        $("#blah8").attr('src',data.path[8]['path']);
                        
                        $("#img1").attr('src',data.path[1]['path']);$("#mediaId1").val(data.path[1]['id']);
                        $("#img2").attr('src',data.path[2]['path']);$("#mediaId2").val(data.path[2]['id']);
                        $("#img3").attr('src',data.path[3]['path']);$("#mediaId3").val(data.path[3]['id']);
                        $("#img4").attr('src',data.path[4]['path']);$("#mediaId4").val(data.path[4]['id']);
                        $("#img5").attr('src',data.path[5]['path']);$("#mediaId5").val(data.path[5]['id']);
                        $("#img6").attr('src',data.path[6]['path']);$("#mediaId6").val(data.path[6]['id']);
                        $("#img7").attr('src',data.path[7]['path']);$("#mediaId7").val(data.path[7]['id']);
                        $("#mediaId8").val(data.path[8]['id']);
                        //$("#img9").attr('src',data.path[9]['path']);
                        //$("#blah9").attr('src',data.path[9]['path']);$("#mediaId9").val(data.path[9]['id']);
                                            
                        
                    } else {
                        
                    }
                }
                
            });
        });
        $("body").on("click","#defaultImg2",function(){  
            var url = "{{ route('center.get.default.images')}}"; 
            $.ajax({
                type: 'POST',
                url:url,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    console.log(data);
                    if(data.error == true){
                        console.log(data.path[8]);
                        
                        
                        $("#img9").attr('src',data.path[9]['path']);
                        $("#blah9").attr('src',data.path[9]['path']);
                        $("#mediaId9").val(data.path[9]['id']);
                        $("#blah0").attr('src',data.path[8]['path']);              
                        
                    } else {
                        
                    }
                }
                
            });
        });

        $("body").on('click','#manageImgId',function(){
            //
            $(".pic").each(function(e){
                var id = $(this).data('id');
                var src = $(this).attr('src');
                console.log("id ="+id);
                $("#img"+id).attr('src',src);
            });
            $("#upload-sec").modal('hide');
            $("#upload-sec-banner").modal('hide');
            console.log("manageImgId =");
        });
        // $(document).ready(function(){
        //    $('.pic'). each(function(e){
        //         var id = $(this).data('id');
        //         var src = $(this).attr('src');
        //         console.log("id ="+id);
        //         $("#img"+id).attr('src',src);
        //     });
        // })
           
    })

    
    
    $(document).ready(function() {

            $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

               // e.target // newly activated tab
                //e.relatedTarget // previous active tab
                    var ckeditorGroup = $('#my_massage_profile').parsley().validate({group: 'ckeditor'});
                    if($('#my_massage_profile').parsley().validate({group: 'ckeditor'}) == false) {
                        e.target
                         $('#home-tab').addClass('active');
                        e.preventDefault();
                    }
                    if($('#my_massage_profile').parsley(
                        { excluded: "input[type=number], input[type=hidden]" }
                        
                        ).validate({group: 'goup_one'})){
                        e.target
                        if(e.target.id == "profile-tab"  && ckeditorGroup != false ) {
                            $('.define_process_bar_color').attr('style','width :40%');//.percent
                            $('#percent').html('40%');
                        } else if(e.target.id == "contact-tab"  && ckeditorGroup != false ) {
                            $('.define_process_bar_color').attr('style','width :80%');//.percent
                            $('#percent').html('80%');
                        }
                        else if(e.target.id == "massuers-tab"  && ckeditorGroup != false ) {
                            $('.define_process_bar_color').attr('style','width :60%');//.percent
                            $('#percent').html('60%');
                        } 
                        else if(e.target.id == "pricing-tab"  && ckeditorGroup != false ) {
                            $('.define_process_bar_color').attr('style','width :100%');//.percent
                            $('#percent').html('100%');

                            var name = $("#profile_name").val();
                            $('#pro_name_tab').html(name);

                            var end = new Date($("#end_date").val());
                            var start = new Date($("#start_date").val());
                            var diff = end.getTime() - start.getTime();
                            var days = diff / (1000 * 3600 * 24); 
                            $('#duration_tab').html(days);
                            if(days !== null && days <= 21) {
                                var rate = days*30/days;
                                var total_rate = days*30;
                                var dis = 0;
                                $('#rate_tab').html("$ "+rate.toFixed(2));
                                //console.log("<=21");
                            } else {
                                var above_day = days - 21;
                                var rate = (above_day*28.5 + 21*30)/days;
                                var total_rate = (above_day*28.5 +630);
                                
                                var dis = above_day*1.5;

                                $('#rate_tab').html("$ "+rate.toFixed(2)); 
                                //console.log(">21"+days);
                            }
                            
                            $('#dis_tab').html("$ "+dis.toFixed(2));
                            $('#total_rate').html("$ "+total_rate.toFixed(2));
                            var fee = 30;
                            $('#fee_tab').html("$ "+ fee.toFixed(2));
                            $("#poli_payment2").click(function(e){
                                // var massage_profileId = $('#profile_id').val();
                                {{--// var url = "{{ route('center.poly.paymentUrl',':id')}}";
                                //var url = "{{ route('center.poly.paymentUrl')}}"; 
                                --}}
                                //url = url.replace(':id',massage_profileId);
                                // $('#poli_payment').prop('disabled', true);
                                // $('#poli_payment').html('<div class="spinner-border"></div>');
                                // $.ajax({
                                //     method: 'GET',
                                //     url:url,
                                //     data:{
                                //         Amount : total_rate,
                                //         CurrencyCode:"AUD",
                                //         MerchantReference:"123",
                                //         start_date:start,
                                //         end_date:end,
                                //         days:days,
                                    
                                        
                                //     },
                                //    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                //     success: function (data) {
                                //         console.log(data.json.NavigateURL);
                                        
                                //         window.location.href = data.json.NavigateURL;
                                //     }
                                    
                                // });
                            })
                            $("#poli_payment").click(function(e){
                                $('#poli_payment').prop('disabled', true);
                                $('#poli_payment').html('<div class="spinner-border"></div>');
                                var massage_profileId = $('#profile_id').val();
                                var url = "{{ route('center.poli.paymentUrl',':id')}}";
                                url = url.replace(':id',massage_profileId);
                                console.log("url = "+url);
                                
                                $('<form/>', { action: url, method: 'POST' }).append($('<input>', {type: 'hidden', name: '_token', value: '{{csrf_token()}}'}),).appendTo('body').submit();   
                                   
                            })
                        } else {
                            $('.define_process_bar_color').attr('style','width :20%');//.percent
                            $('#percent').html('20%');
                        }
                    } else {
                        console.log("id--"+e.target.id);
                        e.preventDefault();
                        $('#home-tab').addClass("active");
                        $("#profile-tab").removeClass('active');
                     
                        
                    }
                console.log("kkk",e);
                //console.log(e.relatedTarget);
            })
        
    });
   

    $('#payment').change(function(){
       var payment_typeValue = $('#payment_type').val();
       $("#show_payment_type").show();
       $(".select_pay").hide();
       console.log(payment_typeValue);
       var selectedPayment = $(this).children("option:selected", this).data("name");
       $("#show_payment_type").append(" <div class='select_pay' style='display: inline-block'><span class=' languages_choosed_from_drop_down'>"+ selectedPayment +" </span> </div> ");
    //    $("#container_payment").append("<input type='hidden' name='payment_type[]' value="+ payment_typeValue +">");
   });
</script>
@endpush