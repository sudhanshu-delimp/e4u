@extends('layouts.web')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<style>
   .parsley-errors-list {
    list-style: none;
    color: rgb(248, 0, 0)
    }
    .loader {
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    width: 120px;
    height: 120px;
    -webkit-animation: spin 2s linear infinite; /* Safari */
    animation: spin 2s linear infinite;
    }
    /* Safari */
    @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
    }
    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
    }
</style>
@endsection
@section('content')
<section class="padding_top_eight_px padding_bottom_eight_px">
    <div class="container">
        <h1 class="home_heading_first margin_btm_twenty_px">Feedback</h1>
        <h3>Let us know your thoughts</h3>
        <p>We value your feedback and appreciate any contribution on how to improve and manage our Website.</p>
        <form id="myfeedback" method="POST" action="{{route('web.feedback.save')}}">
         @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4"><span style="color:red">* </span>Subject</label>
                    <select class="form-control border_for_form" id="fb-subject" name="subject_id" required="">
                        <option id="placeholder" selected="" disabled="" value="">--- Select ---</option>
                        @foreach(config('escorts.profile.subjects') as $key => $subject)
                           <option value="{{$key}}">{{$subject}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                     <label for="inputPassword4"><span style="color:red">* </span>Option</label>
                     <select class="form-control border_for_form" id="fb-options" name="option_id" >
                        <option value="" selected="" disabled>--- Please choose from above ---</option>
                     </select>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Comment</label>
                <textarea class="form-control border_for_form" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="inputAddress"><span style="color:red">* </span>Email address</label>
                <input type="email" name="email" required class="form-control border_for_form" id="inputEmail4" placeholder="Email address" data-parsley-required-message="@lang('errors/validation/required.email')" data-parsley-type-message="@lang('errors/validation/valid.email')">
                <div class="termsandconditions_text_color">
                    @error('email')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
            </div>
            <button type="submit" id="" class="btn site_btn_primary mb-3">Submit Feedback</button>
            <div class="form-check form-check-inline mb-2 ml-sm-2">
                <input class="form-check-input" type="checkbox" id="inlineFormCheck">
                <label class="form-check-label" for="inlineFormCheck">
                cc Yourself
                </label>
            </div>
        </form>
        
    </div>
</section>
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/src/extra/validator/comparison.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script>
    var skipSliderage = document.getElementById("skipstepage");
    var skipValuesage = [
    document.getElementById("skip-value-lower-age"),
    document.getElementById("skip-value-upper-age")
    ];
    
    noUiSlider.create(skipSliderage, {
    start: [0, 30],
    connect: true,
    behaviour: "drag",
    step: 1,
    range: {
       min: 18,
       max: 60
    },
    format: {
       from: function (value) {
          return parseInt(value);
       },
       to: function (value) {
          return parseInt(value);
       }
    }
    });
    
    skipSliderage.noUiSlider.on("update", function (values, handle) {
    skipValuesage[handle].innerHTML = values[handle];
    });
    
</script>
<script>
   $('#fb-subject').change(function(){
      var subject_id = $(this).val();
      let dropdown = $('#fb-options');
      dropdown.empty();
      var form = $(this);
         if (form.parsley().isValid()) {
            $.ajax({
               method: "POST",
               url:"{{ route('web.option')}}",
               data:{subject_id :subject_id },
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               success: function (data) {
                  $.each(data, function (key, entry) {
                     dropdown.append($('<option></option>').attr('value', entry.id).text(entry.name));
                  })
               
                  if(!data.error){
                     console.log(data);
                  } else {
                  console.log(data);
                  }
               }
            });
         }
     
      
     
   })
   $('#myfeedback').on('submit', function(e) {
        e.preventDefault();
    
            var form = $(this);
            var url = form.attr('action');
            var data = new FormData($('#myfeedback')[0]);
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
                        $('#myfeedback')[0].reset();
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
    $('#myfeedback').parsley({
    
   });
</script>
@endpush