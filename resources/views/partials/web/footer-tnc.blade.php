@section('style')
<style type="text/css">
   .parsley-errors-list {
   list-style: none;
   color: rgb(248, 0, 0)
   }
   
</style>
@endsection
<footer class="footer_bg_color padding_fifty_top_and_btm custom--footer">
   
   <section class="copy_right_footer_mange_padding">
      <div class="footer_copy_right tnc-footer">
         <div class="row">
            <div class="col-lg-9 col-md-9 footer_text_color_white">
               &copy; E4U . 2024
               <!-- <a class="admin-login" href="{{ route('admin.login') }}">Login as Admin</a> -->
            </div>
            <!-- <div class="col-lg-3 col-md-3 manage_alments_in_ds text-right">
               <span class="footer_text_color_white">Follow us:</span>
               <ul class="footer_social_icons">
                  <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                  <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                  <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
               </ul>
            </div> -->

         </div>
      </div>
   </section>
   <!-- The Modal -->
   
</footer>
</section>
<script src="{{ asset('assets/app/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/app/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/app/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/app/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/app/js/js.cookie.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/app/js/jqueryuijs.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.0/nouislider.min.js"></script>
<script>
   $('#agreeMyForm').parsley({

   });
   $(document).ready(function() {

       var loginForm = $("#loginForm");

       loginForm.submit(function(e) {

           e.preventDefault();
           var form = $(this);
           var url = form.attr('action');
           var formData = new FormData($("#loginForm")[0]);
           console.log(formData);
           var token = $('input[name="_token"]').attr('value');

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
                   window.location.href = "{{ route('find.all') }}";
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

       $('#global-login-modal').on('hide.bs.modal', function() {
           $('#loginForm')[0].reset();
           $('#loginForm .alert').remove();
       });
   });

</script>
<!-- script for tip crousal start here -->
<script type="text/javascript">
   var totalItems = $('.item-01').length;
   var currentIndex = $('div.carousel-item').index() + 1;
   var down_index;
   $('.num-01').html('' + currentIndex + '&nbsp;/&nbsp;' + totalItems + '');
   $(".next-01").click(function() {
     currentIndex_active = $('div.carousel-item.active').index() + 2;
     if (totalItems >= currentIndex_active) {
       down_index = $('div.carousel-item.active').index() + 2;
       $('.num-01').html('' + currentIndex_active + '&nbsp;/&nbsp;' + totalItems + '');
     } else {
       down_index = 1; //just to make 0 to go to else part when back button is clicked
       $('.num-01').html('1' + '&nbsp;/&nbsp;' + totalItems + '');

     }
   });

   $(".prev-01").click(function() {
     down_index = down_index - 1;
     if (down_index >= 1) {
       $('.num-01').html('' + down_index + '&nbsp;/&nbsp;' + totalItems + '');
     } else {
       down_index = totalItems; //last slide value
       $('.num-01').html('' + totalItems + '&nbsp;/&nbsp;' + totalItems + '');
     }
   });
   /////////////Cookie Policy//////////////////
   // $(document).ready(function(){
   //     $("#onloadpopup .close").click(function(){
   //         $("#onloadpopup").removeClass("show");
   //         $("#onloadpopup").css('display', 'none');
   //     });

   //     if ($.cookie('onloadpopup') === 'cooki-policy') {
   //         $("#onloadpopup").removeClass("show");
   //         $("#onloadpopup").css('display', 'none');
   //     } else {
   //         $.cookie('onloadpopup', 'cooki-policy', { expires: 5});
   //         $("#onloadpopup").modal('show');
   //     }
   // });

   ////////////
   $(document).ready(function(){
       $(function () {
           var stateId;
           var url = window.location.pathname;
           console.log(url);
          // $(".agree").attr('disabled',true);
           $('body').on('change','.loc',function(){
               var stateId = $(this).val();

           })
           // $("#defaultCheck1").click(function(){
           //     if (this.checked) {
           //         $(".agree").prop('disabled',false); // If checked enable item
           //    } else {
           //         $('#msg').html("<font color='red'>Please agree</font>");
           //         $('.agree').prop('disabled', true); // If checked disable item
           //     }

           //     console.log("working");
           // })



           $("body").on('click','.close',function(){



                   $.cookie('onloadpopup', 'cooki-policy', { expires: 5});

                 if ($('#customSwitch_1').is(":checked"))
                 {
                    $.cookie('Performance-Cookies', 'on', { expires: 5});
                 } else {

                    $.cookie('Performance-Cookies', 'off', { expires: 5});
                 }

                 if ($('#customSwitch_2').is(":checked"))
                 {
                    $.cookie('Functional-Cookies', 'on', { expires: 5});
                 } else {

                    $.cookie('Functional-Cookies', 'off', { expires: 5});
                 }

                   $("#myFrontpop").modal("hide");


                   $("#onloadpopup").modal('hide');
                   $("#cookies-notice").modal('hide');


           });
           $("body").on('click','.acceptCookies',function(){



                   $.cookie('onloadpopup', 'cooki-policy', { expires: 5});

                 if ($('#customSwitch_1').is(":checked"))
                 {
                    $.cookie('Performance-Cookies', 'on', { expires: 5});
                 } else {

                    $.cookie('Performance-Cookies', 'off', { expires: 5});
                 }

                 if ($('#customSwitch_2').is(":checked"))
                 {
                    $.cookie('Functional-Cookies', 'on', { expires: 5});
                 } else {

                    $.cookie('Functional-Cookies', 'off', { expires: 5});
                 }

                   $("#myFrontpop").modal("hide");


                   $("#onloadpopup").modal('hide');
                   $("#cookies-notice").modal('hide');



           });
           $("body").on('click','#closeCookies',function(){
              $.removeCookie("onloadpopup");
              $.removeCookie("Performance-Cookies");
              $.removeCookie("Functional-Cookies");

              window.location.href ="https://www.google.com/";
           });
           $("body").on('click','#saveAllCookies',function(){



                   $.cookie('onloadpopup', 'cooki-policy', { expires: 5});

                 if ($('#customSwitch_1').is(":checked"))
                 {
                    $.cookie('Performance-Cookies', 'on', { expires: 5});
                 } else {

                    $.cookie('Performance-Cookies', 'off', { expires: 5});
                 }

                 if ($('#customSwitch_2').is(":checked"))
                 {
                    $.cookie('Functional-Cookies', 'on', { expires: 5});
                 } else {

                    $.cookie('Functional-Cookies', 'off', { expires: 5});
                 }

                   $("#myFrontpop").modal("hide");


                   $("#onloadpopup").modal('hide');

                   $("#manage-consent").modal('hide');
                   $("#cookies-notice").modal('hide');


           });

           if($.cookie('onloadpopup') === 'cooki-policy') {
               $("#onloadpopup").modal('hide');
           } else {
               $("#onloadpopup").modal('show');
           }
           $("body").on('click','.agree',function(){

               if ($('#agreeMyForm').parsley().isValid()) {
                   var stateId = $('#location_state').data('value');
                   $.cookie('user-agreement', 'true', { expires: 5});

                   // $.cookie('state-id', stateId, { expires: 5});
                   $.cookie('state-id', stateId, { expires: 5});
                   $("#myFrontpop").modal("hide");

                   console.log($.cookie('user-agreement'));
                    //$("#onloadpopup").modal('show');
               }

           });


           if ($.cookie('user-agreement') === 'true') {
               // $("#myFrontpop").on('hidden.bs.modal', function (e) {
               // });
               // $("#myFrontpop").css('display', 'none');
               //$("#onloadpopup").modal('show');
           } else {
           // $.cookie('user-agreement', 'user-agreement', { expires: 5});
               if(url != "/acceptable-usage-policy") {
                   $("#myFrontpop").modal("show");
                   // $("#myFrontpop").on('shown.bs.modal', function (e) {
                   // });

               }

           }
       });
       console.log("footer");
       var token = $('input[name="_token"]').attr('value');

       $.post({
           type: 'POST',
           url: "{{ route('web.state.name') }}",
           headers: {
                       'X-CSRF-Token': token
                   },
       }).done(function (data) {
           if(data.error == true) {
               console.log(data.stateName);

              //var st_name = $('#location_state').find(":selected").text(data.stateName);
              //var st_name = $('select[name="location_state"]').find(":selected").text(data.stateName);
              $("#location_state").find(`option:contains(${data.stateName})`).prop('selected', true);

           } else {

           }
       });


   });
   console.log($.cookie('user-agreement'));
   ////////////
</script>
<script>
   $(document).ready(function(){
       $(window).scroll(function () {
       if ($(this).scrollTop() > 50) {
           $('#back-to-top-2').fadeIn();
           } else {
           $('#back-to-top-2').fadeOut();
           }
       });
       // scroll body to 0px on click
       $('#back-to-top-2').click(function () {
           $('body,html').animate({
           scrollTop: 0
           }, 400);
       return false;
       });

    // save btn
    $(".color-change-id").click(function() {
      var mycolor='background-color:#5D6D7E';
      $(".color-change-id").attr("style",mycolor);
    setTimeout(function() {
        $(".color-change-id").attr("style", 'background-color:#0c223d');
    }, 500);
     });
   });
</script>
<!-- <script>
   $(".accordion-container").click(function() {

     $('html,body').animate({
         scrollTop: $(".set").offset().top
       },
       'slow');
   });


</script> -->
@stack('scripts')
</body>
</html>

