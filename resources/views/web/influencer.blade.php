@extends('layouts.web')
@section('style')
<style>
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
    }
    #membershipForm label{
      font-weight:bold;
    }
    .btn-primary {
      background-color: #0C223D;
      border-color: #0C223D;
    }
    .btn-primary:hover {
      background-color: #0C223D;
      border-color: #0C223D;
    }
    .btn-outline-light{
       
      background-color: #0C223D;
      border-color: #0C223D;
    }
    .btn-outline-light:hover {
      background-color: #0C223D;
      border-color: #0C223D;
      color: #fff;
    }
    .form-control {
      border: 1px solid #d1d3e2;
    }
</style>
@endsection
@section('content')
<section class="padding_top_eight_px padding_bottom_eight_px footer-links-si">
   <div class="container">
      <h1 class="home_heading_first">Become an Influencer</h1>
       <p>Have you got a great social media profile, like X or Instagram, or perhaps TikTok and you are
a registered Advertiser on E4U? If you meet our criteria, we will discount your Fees when
you list a Profile or create a Tour with us. The discounts are generous.
</p>
 
      <p>Fill out the form below with your details and we will be in touch to explain how our ‘Become
an Influencer’ program works.
 
      </p>
     
      <form id="membershipForm">
 
<div class="mb-3">
  <label for="membershipId" class="form-label">Membership ID <span class="text-danger">*</span></label>
  <input type="text" class="form-control" id="membershipId" placeholder="Membership ID" name="membershipId" required >
</div>
 
<div class="mb-3">
  <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
  <input type="email" class="form-control" id="email" placeholder="Email Address" name="email" required>
</div>
 
<div class="mb-3">
  <label class="form-label">Social Media Address(es) <span class="text-danger">*</span></label>
  <div id="socialMediaContainer">
    <input type="url" class="form-control mb-2" name="socialMedia[]" placeholder="Social Media Address(es)" required>
  </div>
  <button type="button" class="btn btn-outline-light btn-sm" onclick="addSocialMedia()">Add
  Address</button>
</div>
 
<div class="mb-3">
  <label for="comments" class="form-label">Comments</label>
  <textarea class="form-control" id="comments" name="comments" placeholder="Message" rows="3"></textarea>
</div>
 
<div class="form-check mb-3">
  <input class="form-check-input" type="checkbox" id="ccEmail" name="ccEmail">
  <label class="form-check-label" for="ccEmail">CC email to me</label>
</div>
 
 
 
<button type="submit" class="btn btn-primary">Send Request</button>
</form>
     
   </div>
</section>
@endsection
@push('scripts')
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
 
  function addSocialMedia() {
    const container = document.getElementById('socialMediaContainer');
    const input = document.createElement('input');
    input.type = 'url';
    input.name = 'socialMedia[]';
    input.required = true;
    input.className = 'form-control mb-2';
    input.placeholder = 'Social Media Address';
    container.appendChild(input);
  }
 
</script>
@endpush