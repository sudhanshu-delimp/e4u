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

    .form-control, .form-check-input {
      background-color: #fff;
      color: #000;
      border-radius:5px;
      border:1px solid #d1d3e2;
    }
    
    #myfeedback label{
      font-weight:bold;
    }
    #myfeedback .form-group label {
        font-size:16px;
        line-height:unset;
        padding-bottom:0px;
        text-transform:capitalize;
    }
    .form-control {
      border: 1px solid #d1d3e2;
    }
</style>
@endsection
@section('content')
<section class="padding_top_eight_px padding_bottom_eight_px">
    <div class="container">
        <h1 class="home_heading_first margin_btm_twenty_px">Feedback</h1>
        <h3>Let us know your thoughts</h3>
        <p>We value your feedback and appreciate any contribution on how to improve and manage our Website.</p>
        <form id="myfeedback" method="POST" action="{{ route('web.feedback.save') }}">
            @csrf
            @php
             $feedbackSubjects = config('common.feedback_subject');
            @endphp
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fb-subject">Subject <span style="color:red">*</span></label>
                    <select class="form-control border_for_form" id="fb-subject" name="subject_id" required>
                        <option value="" selected disabled>--- Select ---</option>
                        @foreach($feedbackSubjects as $key => $feedbackname)
                        <option value="{{$key}}">{{$feedbackname}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="fb-options">Option</label>
                    <!-- This select will be shown/hidden based on subject -->
                    <select class="form-control border_for_form d-none" id="fb-options" name="option_id">
                         <option value="" selected disabled>--- Select ---</option>
                    </select>
                    <!-- Fallback text input -->
                    <input type="text" class="form-control border_for_form d-none" id="fb-option-text" name="option_text" placeholder="Write your option">
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail4">Email address <span style="color:red">*</span></label>
                <input type="email" name="email" required class="form-control border_for_form" id="inputEmail4" placeholder="Email address"
                    data-parsley-required-message="@lang('errors/validation/required.email')"
                    data-parsley-type-message="@lang('errors/validation/valid.email')">
                <div class="termsandconditions_text_color">
                    @error('email')
                        <strong>{{ $message }}</strong>
                    @enderror
                </div>
            </div>

<div class="form-group">
    <label for="exampleFormControlTextarea1">Comment</label>
    <textarea class="form-control border_for_form" name="comment" id="exampleFormControlTextarea1" rows="3" placeholder="Message"></textarea>
</div>

            <button type="submit" id="btnSubmit" class="common-btn mb-3">Submit Feedback</button>
        </form>

         <!-- changes to this policy -->
    <div class="container mt-4 px-0 chagneto-policy">
        <hr class="custom_hr">
         <h2 class="primery_color normal_heading">Changes to this Policy</h2>
         <p class="border-0">We may change or modify this Policy in the future. We will note the date that revisions were last made at the bottom of this page. Any revision will take effect upon its posting. It is your responsibility to check the <a href="{{ url('terms-conditions')}}" style="color:#FF3C5F">Terms and Conditions</a> and this Policy from time to time to
                              review the most current version.</p>
         <p>Escorts4U archives all previous versions of this Policy.</p>
         <p><b>This policy was last updated 04-06-2025</b></p>
    </div>
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
    
    /*noUiSlider.create(skipSliderage, {
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
    });*/
    
</script>
<script>
    const subjectSelect = document.getElementById('fb-subject');
    const optionSelect = document.getElementById('fb-options');
    const optionText = document.getElementById('fb-option-text');
    optionText.classList.remove('d-none');
    optionSelect.classList.add('d-none');


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
                  if(data.error){
                     optionText.classList.remove('d-none');
                     optionSelect.classList.add('d-none');
                     dropdown.append('<option value="" selected disabled>--- Select ---</option>');
                  } else {
                     $.each(data.result, function (key, entry) {
                     dropdown.append($('<option></option>').attr('value', entry.id).text(entry.name));
                    });
                      optionSelect.classList.remove('d-none');
                      optionText.classList.add('d-none');
                      optionText.value="";
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
            $('#btnSubmit').prop('disabled', true);
            $.ajax({
                method: form.attr('method'),
                url:url,
                data:data,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if(!data.error){
                       /* $.toast({
                            heading: 'Success',
                            text: 'Record successfully update',
                            icon: 'success',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });*/
                        $('#myfeedback')[0].reset();
                        window.location= "{{ route('feedback.thankyou') }}";
                    } else {
                        $('#btnSubmit').prop('disabled', false);
                        $.toast({
                            heading: 'Error',
                            text: 'Your Feedback request failed to send. Please try later..',
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
<script>

    // Define subjects with predefined options
    const subjectOptions = {
        //6
        "Request for Information": [
            "To become a Support Agent",
            "Concierge Services",
            "My Playbox"
        ],
        //7
        "Report a bug in the Website": [
            "Public page",
            "Escort listing page",
            "Massage Centre listing page",
            "Escort Console",
            "Massage Centre Console",
            "Agent Console",
            "Viewer Console"
        ]
    };

    // Default state: show text input, hide select
   
    /*subjectSelect.addEventListener('change', function () {
        const selected = this.value;

        if (subjectOptions[selected]) {
            // Populate and show the select box
            optionSelect.innerHTML = `<option disabled selected>--- Select Option ---</option>`;
            subjectOptions[selected].forEach(opt => {
                const option = document.createElement('option');
                option.value = opt;
                option.textContent = opt;
                optionSelect.appendChild(option);
            });

            // Show select, hide text input
            optionSelect.classList.remove('d-none');
            optionText.classList.add('d-none');
        } else {
            // Show input text field, hide select
            optionSelect.classList.add('d-none');
            optionText.classList.remove('d-none');
        }
    });*/
</script>

@endpush