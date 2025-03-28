@extends('layouts.agent') 
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<style type="text/css">
    .parsley-errors-list {
    list-style: none;
    color: rgb(248, 0, 0)
    }
</style>
@endsection @section('content')
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <!--middle content-->
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form_process">
                                <div class="steps_to_filled_from">step 1</div>
                                <p>About me</p>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form_process">
                                <div class="steps_to_filled_from">step 2</div>
                                <p>My Services & Rates</p>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form_process">
                                <div class="steps_to_filled_from">step 3</div>
                                <p>My Availability</p>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form_process">
                                <div class="steps_to_filled_from">step 4</div>
                                <p>Check fee summary and pay</p>
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <div class="filled_from_in_persantage">25%</div>
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
                <div class="col-lg-9">
                    <!-- Begin Page Content -->
                    <div class="row">
                        <div class="col-md-12 remove_padding_in_ph">
                            <ul class="dk-tab nav gap_between_btns" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#aboutme" role="tab" aria-controls="home" aria-selected="true">About me</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#services" role="tab" aria-controls="profile" aria-selected="false">My Services & Rates</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#available" role="tab" aria-controls="contact" aria-selected="false">My Availability</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pricing-tab" data-toggle="tab" href="#pricing" role="tab" aria-controls="contact" aria-selected="false">Check fee summary and pay</a>
                                </li>
                            </ul>
                            <div class="tab-content tab-content-bg" id="myTabContent">
                                @include('agent.dashboard.profile.partials.aboutme-dash-tab')
                                @include('agent.dashboard.profile.partials.services-dash-tab')
                                @include('agent.dashboard.profile.partials.available-dash-tab')
                                @include('agent.dashboard.profile.partials.pricing-dash-tab')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Content Wrapper -->
<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <!--<img src="..." class="rounded mr-2" alt="...">-->
        <strong class="mr-auto">Bootstrap</strong>
        <small>11 mins ago</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">Hello, world! This is a toast message.</div>
</div>
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/src/extra/validator/comparison.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>  
<script>
        // var editor_id2 = document.getElementById("editor2");
        // var editor_id3 = document.getElementById("editor3");
        // let editor2 = CKEDITOR.replace(editor_id2);
        // let editor3 = CKEDITOR.replace(editor_id3);
    
    
        var textarea = document.getElementById('editor1');
        let editor = CKEDITOR.replace(textarea);
    
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
    $('#update_about_me').on('submit', function(e) {
        e.preventDefault();
    
        var form = $(this);
    
        if (form.parsley().isValid()) {
    
            var url = form.attr('action');
            var data = new FormData($('#update_about_me')[0]);
            $('#update-about-me').prop('disabled', true);
            $('#update-about-me').html('<div class="spinner-border"></div>');
            $.ajax({
                method: form.attr('method'),
                url:url,
                data:data,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if(!data.error){
                        $.toast({
                            heading: 'Success',
                            text: 'Record successfully update',
                            icon: 'success',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                        $('#update-about-me').prop('disabled', false);
                        $('#update-about-me').html('Updated');
                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'Records Not update',
                            icon: 'error',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
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
                        $.toast({
                            heading: 'Success',
                            text: 'Record successfully update',
                            icon: 'success',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                        $('#read-more').prop('disabled', false);
                        $('#read-more').html('Updated');
                        location.reload();
                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'Records Not update',
                            icon: 'error',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
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
                        $.toast({
                            heading: 'Success',
                            text: 'Record successfully update',
                            icon: 'success',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                        $('#update_who_am_i').prop('disabled', false);
                        $('#update_who_am_i').html('Updated');
                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'Records Not update',
                            icon: 'error',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
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
        $("#show_language").append("  <div class='selecated_languages' style='display: inline-block'><span class='languages_choosed_from_drop_down'>"+ selectedLanguage +" </span> </div> ");
        $("#container_language").append("<input type='hidden' name='language[]' value="+ languageValue +">");
    });
    
    $( "#selected_service_one li" ).each(function( index, element ) {
        var val = $(this).attr('id');
        $("#service_id_one option[value="+ val +"]").attr('disabled','disabled');
    
        $('body').on('click', "#id_"+val, function() {
            $("#service_id_one option[value="+ val +"]").attr('disabled', false);
            $('li .hideenclassOne'+val).parent().remove();
            $('#service_id_one').val('');
            console.log("li-" + val);
        });
    });
    
    $( "#selected_service_two li" ).each(function( index ) {
        var val = $(this).attr('id');
        $("#service_id_two option[value="+ val +"]").attr('disabled','disabled');
    
        $('body').on('click', "#idTwo_"+val, function() {
            $("#service_id_two option[value="+ val +"]").attr('disabled', false);
            $('li .hideenclassTwo'+val).parent().remove();
            $('#service_id_two').val('');
            console.log(val);
        });
    });
    $( "#selected_service_three li" ).each(function( index ) {
        var val = $(this).attr('id');
        $("#service_id_three option[value="+ val +"]").attr('disabled','disabled');
    
        $('body').on('click', "#idThree_"+val, function() {
            $("#service_id_three option[value="+ val +"]").attr('disabled', false);
            $('li .hideenclassThree'+val).parent().remove();
            $('#service_id_three').val('');
            console.log(val);
        });
    });
    
    $('body').on('change','#service_id_one', function(){
        var selectedIdOne = $('#service_id_one').val();
        var getNameOne = $(this).children(":selected").attr("id");
        if(selectedIdOne){
            $("#selected_service_one").append(" <li id="+selectedIdOne+"><div class='my_service_anal hideenclassOne"+selectedIdOne+"'><span class='dollar-sign'>"+getNameOne+"</span><input type='number' class='dollar-before input_border' name='price[]' placeholder='' min='0' oninput='this.value = Math.abs(this.value)'><input type='hidden' name='service_id[]' value="+ selectedIdOne +" placeholder=''><span><i class='fas fa-times-circle' id='id_"+ selectedIdOne+"' value="+selectedIdOne+"></i></span></div></li> ");
            $("#service_id_one option[value="+ selectedIdOne +"]").attr('disabled','disabled');
            console.log('change='+selectedIdOne);
        }
    });
    
    $('body').on('change','#service_id_two', function(){
        var selectedIdTwo = $('#service_id_two').val();
        var getNameTwo = $(this).children(":selected").attr("id");
        if(selectedIdTwo){
            $("#selected_service_two").append(" <li id="+selectedIdTwo+"><div class='my_service_anal hideenclassTwo"+selectedIdTwo+"'><span class='dollar-sign'>"+getNameTwo+"</span><input type='number' class='dollar-before input_border' name='price[]' placeholder='' min='0' oninput='this.value = Math.abs(this.value)'><input type='hidden' name='service_id[]' value="+ selectedIdTwo +" placeholder=''><span><i class='fas fa-times-circle' id='id_"+ selectedIdTwo+"' value="+selectedIdTwo+"></i></span></div></li> ");
            $("#service_id_two option[value="+ selectedIdTwo +"]").attr('disabled','disabled');
            console.log('change='+selectedIdTwo);
        }
    });
    
    $('body').on('change','#service_id_three', function(){
        var selectedIdThree = $('#service_id_three').val();
        var getNameThree = $(this).children(":selected").attr("id");
        if(selectedIdThree){
            $("#selected_service_three").append(" <li id="+selectedIdThree+"><div class='my_service_anal hideenclassThree"+selectedIdThree+"'><span class='dollar-sign'>"+getNameThree+"</span><input type='number' class='dollar-before  input_border' name='price[]' placeholder='' min='0' oninput='this.value = Math.abs(this.value)'><input type='hidden' name='service_id[]' value="+ selectedIdThree +" placeholder=''><span><i class='fas fa-times-circle' id='id_"+ selectedIdThree+"' value="+selectedIdThree+"></i></span></div></li> ");
            $("#service_id_three option[value="+ selectedIdThree +"]").attr('disabled','disabled');
            console.log('change='+selectedIdThree);
        }
    });
    //start available //
    $('.available_to').click( function() {
    var val = $(this).val();
    console.log($(this).val());
    $(this).is(':checked') ? $('#'+val).show() : $('#'+val).hide();
    });
    
    //end available to
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
    
    $('#myServices').on('submit', function(e) {
        e.preventDefault();
    
            var form = $(this);
            var url = form.attr('action');
            var data = new FormData($('#myServices')[0]);
            console.log(data);
            $('#my_services').prop('disabled', true);
            $('#my_services').html('<div class="spinner-border"></div>');
    
            $.ajax({
                method: form.attr('method'),
                url:url,
                data:data,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if(!data.error){
                        $.toast({
                            heading: 'Success',
                            text: 'Record successfully update',
                            icon: 'success',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                        $('#my_services').prop('disabled', false);
                        $('#my_services').html('Updated');
                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'Records Not update',
                            icon: 'error',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                        $('#my_services').prop('disabled', false);
                        $('#my_services').html('Update');
                    }
                },
                error: function (data) {
                    $.toast({
                        heading: 'Error!',
                        text: data.responseJSON.message,
                        icon: 'error',
                        loader: true,
                        position: 'top-right',      // Change it to false to disable loader
                        loaderBg: '#9EC600'  // To change the background
                    });
                    $('#my_services').prop('disabled', false);
                    $('#my_services').html('Updated');
                }
            });
        //}
    });
    
    $('#storeRate').on('submit', function(e) {
        e.preventDefault();
    
        var form = $(this);
        var url = form.attr('action');
        var data = new FormData($('#storeRate')[0]);
        console.log(data);
        $('#store_rate').prop('disabled', true);
        $('#store_rate').html('<div class="spinner-border"></div>');
        $.ajax({
            method: form.attr('method'),
            url:url,
            data:data,
            contentType: false,
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                if(!data.error){
                    $.toast({
                        heading: 'Success',
                        text: 'Record successfully update',
                        icon: 'success',
                        loader: true,
                        position: 'top-right',      // Change it to false to disable loader
                        loaderBg: '#9EC600'  // To change the background
                    });
                    $('#store_rate').prop('disabled', false);
                    $('#store_rate').html('Updated');
                } else {
                    $.toast({
                        heading: 'Error',
                        text: 'Records Not update',
                        icon: 'error',
                        loader: true,
                        position: 'top-right',      // Change it to false to disable loader
                        loaderBg: '#9EC600'  // To change the background
                    });
                    $('#store_rate').prop('disabled', false);
                    $('#store_rate').html('Update');
                }
            }
        });
    });
    
    $('#myability').on('submit', function(e) {
        e.preventDefault();
    
        var form = $(this);
    
        if (form.parsley().isValid()) {
            
            $('#my_abilities').prop('disabled', true);
            $('#my_abilities').html('<div class="spinner-border"></div>');
            var url = form.attr('action');
            var data = new FormData($('#myability')[0]);
            console.log(data);
    
            $.ajax({
                method: form.attr('method'),
                url:url,
                data:data,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if(!data.error){
                        $.toast({
                            heading: 'Success',
                            text: 'Record successfully update',
                            icon: 'success',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                        $('#my_abilities').prop('disabled', false);
                        $('#my_abilities').html('Updated');
                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'Records Not update',
                            icon: 'error',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                        $('#my_abilities').prop('disabled', false);
                        $('#my_abilities').html('Update');
                    }
                }
            });
        }
    });
    
    
    
    $('#read_more').parsley({
    
    });
    $('#myability').parsley({
    
    });
    $('#myPolicy').parsley({
    
    });
    
    
    $('.resetdays').each(function( index ){
        var days = $(this).attr('id');
        $('#'+ days).click(function(){
            console.log($(this).data('day'));
            $("."+$(this).data('day')+" option:selected").removeAttr("selected");
        });
    });
    
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
        var start_date = moment(today).format('YYYY-MM-DD');  
        
            $("#start_date").attr({
            "min" : start_date,          // values (or variables) here
            });
    });

    $('#start_date').on('change', function()
    {
        $("#end_date").show();
        var val = $(this).val();
        var result = new Date(val);
        var ss = result.setDate(result.getDate() + 1);
        var first_date = moment(ss).format('YYYY-MM-DD');  
        
            $("#end_date").attr({
            "min" : first_date,
            "value" : first_date,       // values (or variables) here
            });
            console.log(first_date);
            console.log(val);
           
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

    
    $('#search-playmate-input').select2({
        //dropdownParent: $("#play-mates-modal"),
        width: '100%',
        dropdownCssClass: "bigdrop",
        placeholder: {
            id: 0, // the value of the option
            text: "{{ asset('assets/app/img/service-provider/Frame-408.png') }}",
            name: 'Search playmate',
            member_id: 'Type name or member id',
        },
        allowClear: true,
        language: {
            inputTooShort: function() {
                return 'Enter Member Id or Name';
            }
        },
        createTag: function(params) {
            var term = $.trim(params.term);
            console.log(term);
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
            url: "{{ route('agent.playmatesId.find',$escort->id) }}",
            dataType: "json",
            type: "POST",
            data: function(params) {

                var queryParameters = {
                    query: params.term,
                    escort_id: $('#h_escort_id').val()
                }
               
                return queryParameters;
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {

                        return {
                            text: item.default_image,
                            name: item.name,
                            member_id: item.member_id,
                            id: item.id
                        }
                    })
                };
            }
        },
        templateResult: formatEscortList,
        templateSelection: formatEscortList
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
                    url: "{{ route('agent.playmates.remove') }}",
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
        console.log("id=" +id)
    })

    

// Listen for input event on numInput.
    var numInput = document.querySelector('input');
    $('input[type="number"]').on("paste", function(e) {
    if (e.originalEvent.clipboardData.getData('text').match(/[^\d(\.\d)*$]/))
    e.preventDefault(); //prevent the default behaviour 
    })
    .on("keypress", function(e) {
    if (e.keyCode != 46 && e.keyCode > 31  && (e.keyCode < 48 || e.keyCode > 57))
     e.preventDefault();
    });
</script>
@endpush