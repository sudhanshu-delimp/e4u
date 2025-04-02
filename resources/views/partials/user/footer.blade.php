<footer class="footer_bg_color padding_fifty_top_and_btm ">
   <section class="footer_mange_padding">
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-12">
                   <a href="#"><img src="{{ asset('assets/app/img/logo.png') }}" class="img-fluid" alt="logo"></a>
               </div>
           </div>
           <div class="row">
               <div class="col-lg-5 footer_text_color_white">
                   <h4>Advertising Statement</h4>
                   <p>This Website permits adults to advertise their companionship to other adults. Escorts4U does not provide a booking service or arrange for meetings between Advertisers and Viewers. We do not act as an intermediary or play any role in any transaction.</p>
                   <p>Any price indicated in an Advertiser's Profile relates to their time only and nothing else. Any service offered or whatever else that may occur is a mutual decision between consenting adults and is private between them. It is your responsibility to be cognisant of and to comply with the Local Laws.</p>
               </div>
               <div class="col-lg-3 footer_text_color_white">
                   <h4>Legal</h4>
                   <div class="row">
                       <div class="col-sm-6">
                           <ul class="list-group footer_list_style_none">
                               <li><a href="#">Acceptable use Policy</a></li>
                               <li><a href="#">Copyright Statement</a></li>
                               <li><a href="#">Covid-19 Statement</a></li>
                               <li><a href="#">Disclaimer Statement</a></li>
                               <li><a href="#">Law Enforcement</a></li>
                           </ul>
                       </div>
                       <div class="col-sm-6">
                           <ul class="list-group footer_list_style_none">
                               <li><a href="#">Privacy Policy</a></li>
                               <li><a href="#">Refund Policy</a></li>
                               <li><a href="#">Spam Policy</a></li>
                               <li><a href="#">Terms & Conditions</a></li>
                               <li></li>
                           </ul>
                       </div>
                   </div>
               </div>
               <div class="col-lg-3 footer_text_color_white">
                   <h4>Community</h4>
                   <div class="row">
                       <div class="col-sm-6">
                           <ul class="list-group footer_list_style_none">
                               <li><a href="#">Abbreviations, Icons & Lingo</a></li>
                               <li><a href="#">Alerts</a></li>
                               <li><a href="#">Blog</a></li>
                               <li><a href="#">Contact Us</a></li>
                               <li><a href="#">Etiquette</a></li>
                               <li><a href="#">FAQs</a></li>
                           </ul>
                       </div>
                       <div class="col-sm-6">
                           <ul class="list-group footer_list_style_none">
                               <li><a href="#">Feedback</a></li>
                               <li><a href="#">Help for Advertisers</a></li>
                               <li><a href="#">Help for Agents</a></li>
                               <li><a href="#">Help for Massage Centers</a></li>
                               <li><a href="#">Help for Viewers</a></li>
                           </ul>
                       </div>
                   </div>
               </div>
               <div class="col-lg-1">
                   <ul class="list-group footer_list_style_none">
                       <li><a class="footer_reg_btn" href="#">Register</a></li>
                       <li><a class="footer_login_btn primery_color" href="#">login</a></li>
                   </ul>
               </div>
           </div>
           <div class="footer_copy_right">
               <div class="row">
                   <div class="col-lg-9 col-md-9 footer_text_color_white">
                       &copy; E4U . 2022
                   </div>
                   <div class="col-lg-3 col-md-3">
                       <span class="footer_text_color_white">Follow us:</span>
                       <ul class="footer_social_icons">
                           <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                           <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                           <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                       </ul>
                   </div>
               </div>
           </div>
       </div>
   </section>
</footer>
<script src="{{ asset('assets/app/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/app/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/app/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/app/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/app/js/jqueryuijs.js') }}"></script>
<script>

$(document).ready(function() {

var loginForm = $("#loginForm");
loginForm.submit(function(e) {
   e.preventDefault();
   var form = $(this);
   var url = form.attr('action');
   var formData = new FormData($("#loginForm")[0]);
   console.log(formData);
   var token = $('input[name="_token"]').attr('value');
   //alert(token);
   $.ajax({
      url: url,
      type: 'POST',
      data: formData,
      dataType: "JSON",
      contentType: false,
      processData: false,
      headers: {
         'X-CSRF-Token': token
      },
      success: function(data) {
         window.location.href = "{{ url('') }}";
         console.log(data);
      },
      error: function(data) {

         console.log("error: ", data.responseJSON.errors);
         errorsHtml = '<div class="alert alert-danger"><ul>';

         $.each(data.responseJSON.errors, function(key, value) {
            errorsHtml += '<li>' + value + '</li>'; //showing only the first error.
         });

         errorsHtml += '</ul></di>';
         $('#formerror').html(errorsHtml);
      }
   });
});

$('#my').on('hide.bs.modal', function() {
   $('#loginForm')[0].reset();
   $('#loginForm .alert').remove();

})

//alert('Successfully Loaded');
});

</script>
</body>
</html>