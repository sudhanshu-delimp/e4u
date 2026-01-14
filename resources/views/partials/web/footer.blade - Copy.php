<footer class="footer_bg_color padding_fifty_top_and_btm">
   <section class="footer_mange_padding">
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-12">
                   <a href="#" class="header_logo"><img src="{{ asset('assets/app/img/logo.png') }}"  alt="logo"></a>
               </div>
           </div>
           <div class="row">
               <div class="col-lg-3  col-sm-12 col-12  footer_text_color_white">
                   <h4>Advertising Statement</h4>
                   <p>This Website permits adults to advertise their companionship to other adults. Escorts4U does not provide a booking service or arrange for meetings between Advertisers and Viewers. We do not act as an intermediary or play any role in any transaction.</p>
                    
                   <p>Any price indicated in an Advertiser's Profile relates to their time only and nothing else. Any service offered or whatever else that may occur is a mutual decision between consenting adults and is private between them. It is your responsibility to be cognisant of and to comply with the Local Laws.</p>
               </div>
               <div class="col-lg-2 col-sm-12 col-12 footer_text_color_white">
                   <h4>Location</h4>
                   <div class="row">
                       <div class="col-lg-6 col-sm-6 col-6">
                           <ul class="list-group footer_list_style_none">
                                <li><a href="{{ url('all-escorts-list') }}">Adelaide</a></li>
                                <li><a href="{{ url('all-escorts-list') }}">Brisbane</a></li>
                                <li><a href="{{ url('all-escorts-list') }}">Canberra</a></li>
                                <li><a href="{{ url('all-escorts-list') }}">Darwin</a></li>
                                <li><a href="{{ url('all-escorts-list') }}">Hobart</a></li>
                                <li><a href="{{ url('all-escorts-list') }}">Melbourne</a></li>
                           </ul>
                       </div>
                       <div class="col-lg-6 col-sm-6 col-6">
                           <ul class="list-group footer_list_style_none">
                               
                              <li><a href="{{ url('all-escorts-list') }}">Perth</a></li>
                               <li><a href="{{ url('all-escorts-list') }}">Sydney</a></li>
                           </ul>
                       </div>
                   </div>
               </div>
               <div class="col-lg-3 col-sm-12 col-12 footer_text_color_white">
                   <h4>Legal</h4>
                   <div class="row">
                       <div class="col-lg-6 col-sm-6 col-6">
                           <ul class="list-group footer_list_style_none">
                               <li><a href="{{ url('acceptable-usage-policy')}}">Acceptable Usage Policy</a></li>
                               <li><a href="{{ url('copyright-statement')}}">Copyright Statement</a></li>
                               <li><a href="{{ url('covid-19-statement')}}">Covid-19  Statement</a></li>
                               <li><a href="{{ url('disclaimer-statement')}} ">Disclaimer Statement</a></li>
                               <li><a href="{{ url('law-enforcement')}} ">Law Enforcement</a></li>
                           </ul>
                       </div>
                       <div class="col-lg-6 col-sm-6 col-6">
                           <ul class="list-group footer_list_style_none">
                               <li><a href="{{ url('privacy-policy')}} ">Privacy Policy</a></li>
                               <li><a href="{{ url('refund-policy')}} ">Refund Policy</a></li>
                               <li><a href="{{ url('spam-policy')}} ">Spam Policy</a></li>
                               <li><a href="{{ url('terms-conditions')}} ">Terms & Conditions</a></li>
                            </ul>
                       </div>
                   </div>
               </div>
               <div class="col-lg-3 col-sm-12 col-12  footer_text_color_white">
                   <h4>Community</h4>
                   <div class="row">
                       <div class="col-lg-6 col-sm-6 col-6">
                           <ul class="list-group footer_list_style_none">
                               <li><a href="{{ url('abbreviations')}} ">Abbreviations</a></li>
                               <li><a href="#">Alerts</a></li>
                               <li><a href="#">Blog</a></li>
                               <li><a href="{{ url('contact-us')}} ">Contact Us</a></li>
                               <li><a href="{{ url('etiquette')}} ">Etiquette</a></li>
                               <li><a href="{{ url('faqs')}} ">FAQs</a></li>
                            </ul>
                       </div>
                       <div class="col-lg-6 col-sm-6 col-6">
                           <ul class="list-group footer_list_style_none">
                               <li><a href="{{ url('feedback')}}">Feedback</a></li>
                               <li><a href="{{ url('help-for-advertisers')}} ">Help for Advertisers</a></li>
                               <li><a href="{{ url('help-for-agents')}} ">Help for Agents</a></li>
                               <li><a href="{{ url('help-for-massage-centres')}} ">Help for Massage Centres</a></li>
                               <li><a href="{{ url('help-for-viewers')}} ">Help for Viewers</a></li>
                           </ul>
                       </div>
                   </div>
               </div>
               <div class="col-12 col-md-12 col-sm-12 col-lg-1 dk-right">
                   <ul class="footer_list_style_none footerbtn-flex mt-lg-5">
                       <li class="dropdown">
                        <a style="padding: 5px 15px;width:120px; text-align: center;" class="nav-link dropdown-toggle footer_reg_btn" id="navbarDropdownn" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="{{ route('register') }}">Register</a>
                            <div class="dropdown-menu register_dropdown" aria-labelledby="navbarDropdownn"> 
                                <a class="dropdown-item" href="{{ route('advertiser.register') }}">I am an Advertiser</a>
                                <a class="dropdown-item" href="{{ route('register') }}">I am a Viewer</a>
                                <a class="dropdown-item" href="{{ route('agent.register')}}">I am an Agent </a>
                            </div>
                        </li>
                        <li class="dropdown">
                        <a style="padding: 5px 15px; width:120px; text-align: center;" class="nav-link dropdown-toggle   footer_login_btn primery_color" id="navbarDropdownn" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="{{ route('register') }}">Log in</a>
                            <div class="dropdown-menu register_dropdown" aria-labelledby="navbarDropdownn"> 
                                <a class="dropdown-item" href="{{ route('advertiser.login') }}">I am an Advertiser</a>
                                <a class="dropdown-item" href="{{ route('viewer.login') }}">I am a Viewer</a>
                                <a class="dropdown-item" href="{{ route('advertiser.login') }}">I am an Agent</a>
                                {{--<a class="dropdown-item" href="#" data-toggle="modal" data-target="#global-login-modal">I am a Viewer</a>--}}
                            </div>
                        </li>
                         
                   </ul>
               </div>
           </div>
           <div class="footer_copy_right">
               <div class="row">
                   <div class="col-lg-9 col-md-9 footer_text_color_white">
                       &copy; E4U . 2022
                   </div>
                   <div class="col-lg-3 col-md-3 manage_alments_in_ds text-right">
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
</section>
<script src="{{ asset('assets/app/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/app/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/app/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/app/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/app/js/jqueryuijs.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.0/nouislider.min.js"></script>

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

</script>
@stack('scripts')
</body>
</html>
