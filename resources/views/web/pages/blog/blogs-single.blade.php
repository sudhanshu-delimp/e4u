@extends('layouts.web')
@section('style')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<style>
   
            .ui-datepicker table {
                display: none !important;
            }
            
            .ui-state-default.ui-state-highlight {
                background-color: var(--peach) !important;
                border-color: #ccc !important;
            }
            
            .ui-state-default.ui-state-active {
                background-color: var(--blue--text) !important;
                border-color: var(--blue--text) !important;
            }
            
            .filter-date:focus {
                outline: none;
                border: 2px solid var(--peach);
            }
            /* Header background */
            
            .ui-widget.ui-widget-content {
                width: 290px !important;
                width: 100%;
                border-radius: 5px;
                border: none !important;
            }
            
            .ui-datepicker .ui-datepicker-title {
                margin: 0 2.3em;
                line-height: 1.8em;
                text-align: center;
                display: flex;
                gap: 10px;
                justify-content: center;
            }
            
            .ui-datepicker {
                background: #ffffff;
                border-radius: 10px;
                border: 1px solid #ccc;
            }
            
            .ui-datepicker-header {
                background: #fff;
                color: #fff;
                border: none;
            }
            /* Month & Year dropdown */
            
            .ui-datepicker select {
                background: #022c3d;
                color: #fff;
                border: none;
                padding: 5px;
                border-radius: 5px;
            }
</style>
@endsection
@section('content')
<section class="section blog-wrap bg-gray">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="breadcrumb">
           <a href="{{ url('blogs') }}">Blog <svg fill="#ff3c5f"
                                                    width="10px" height="10px" viewBox="0 0 1920 1920"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <g fill-rule="evenodd">
                                                            <path
                                                                d="M0 92.168 92.299 0l959.931 959.935L92.299 1920 0 1827.57l867.636-867.635L0 92.168Z">
                                                            </path>
                                                            <path
                                                                d="M868 92.168 960.299 0l959.931 959.935L960.299 1920 868 1827.57l867.64-867.635L868 92.168Z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </svg></a>
            <span> Deep Throat Tips You Should Know </span>
            </div>

                        
         </div>
         <div class="col-lg-8 mb-5">
                  <div class="single-blog-item">
                     <img src="{{ asset('assets/app/img/blogs/b1.jpg') }}" alt="" class="img-fluid rounded">
                     <div class="blog-item-content mt-5">
                        <h2>Deep Throat Tips You Should Know</h2>
                        <div class="blog-item-meta bg-gray mb-4">
                           <span class="text-black text-capitalize mr-3">Posted:</span>
                           <span class="text-black text-capitalize mr-3">30th January 2026</span>
                        </div>
                        <hr>
                        <p>We often receive emails from new escorts entering the industry, or established escorts who will be working in Brisbane, the Gold Coast or other cities in Queensland for the first time, who are not familiar with the state legislation and the rules surrounding advertising in Queensland <b>(Local Laws).</b> In this blog, we will give you a little bit of information about the basic things that you need to be aware of, and links to important resources.</p>
                        <p>Queensland has very specific laws when it comes to sex work advertising. We will list some of these regulations below, but please be advised that this list is not exhaustive. It is the responsibility of each escort to be familiar with the <a href="#">Local Laws</a> in the state where you will be working.</p>
                        <h2>Qld Escorts cannot do any of the following:</h2>
                        <ul>
                           <li>cannot provide unprotected services (including oral)</li>
                           <li>cannot provide doubles with another escort</li>
                           <li>cannot use the word "massage" in your advertising</li>
                           <li>cannot list or describe your services in your advertising</li>
                        </ul>
                        <p>Escorts4U manages your profile settings and where it is appropriate, blocks the SERVICES section of your Profile in Queensland. However, it is important that you do not list services in the other sections of your profile (such as the About Me section), as that section will not be blocked in Queensland if it is non-complient.</p>
                        <h2>Qld Escort images cannot display the following:</h2>
                        <ul>
                           <li>The sexual organs or anus. You cannot display frontal or rear nudity of the genital
                              region
                           </li>
                           <li>A sexual act or simulated sexual act</li>
                           <li>A person under the age of 18 years</li>
                           <li>Pictures, drawings or references to alcohol (including images of wine bottles/glasses)</li>
                        </ul>
                        <p class="pera-note">NOTE: Escorts4U will censor images in Queensland Profiles if we see that they don't comply with the
                           Local Laws. However, it is the legal responsibility of Advertisers to check their images on their
                           Profile, and to ensure that they all comply with the Local Laws.
                        </p>
                        <p>If you are touring in Queensland, we will not display your selfie gallery or archive gallery
                           in your Profile in respect to Queensland.
                        </p>
                        <h2>More information:</h2>
                        <p>For detailed information about the Queensland sex work laws and what is not allowed, please visit the PLA website:</p>
                        <p class="blog-link"><a href="https://www.pla.qld.gov.au/advertising/guidelinesApproveFormAdvertPros.htm">https://www.pla.qld.gov.au/advertising/guidelinesApproveFormAdvertPros.htm</a></p>
                        <p>There is a lot of easy to read information about the Local Laws on the Scarlet Alliance website:</p>
                        <p class="blog-link"><a href="https://scarletalliance.org.au/resources/laws/qld/">https://scarletalliance.org.au/resources/laws/qld/</a></p>
                        <p class="blog-link">For any questions about Local Laws, please feel welcome to contact Respect Inc, which is the sex industry support group for Queensland: <a href="https://scarletalliance.org.au/resources/laws/qld/">www.respectqld.org.au.</a></p>
                     </div>
                  </div>
         </div>
         <div class="col-lg-4 mb-5">
                  <div class="single-blog-item">
                      <h2 class="blog_head">Blog Archive</h2>

                   <div class="arc_blog_list">

                     <!-- Search Form -->
                                    <form class="archive-form">
                                        <label for="archive-date">Search By Year & Month</label>
                                         <input type="text" class="filter-date" placeholder="Select Month and Year">
                                    </form>
                     <!-- Archive List -->
                     <div class="archive-list">
                        
                       <ul>
                           <li><a href="#"> Deep Throat Tips You Should Know</a></li>
                           <li><a href="#"> Edging Tips For Better Orgasms</a></li>
                           <li><a href="#"> Keeping Your Sanity - Tips For Escorts</a></li>
                           <li><a href="#"> How To Have Kinky Dreams</a></li>
                           <li><a href="#"> How To Pick An Outfit For Sex Work</a></li>
                           <li><a href="#"> Learn How To Master Conversation With An Escort</a></li>
                           <li><a href="#"> Tips On Avoiding Nausea After Sex</a></li>
                           <li><a href="#"> Summer Date Ideas With Your Elite Escort</a></li>
                           <li><a href="#"> Difference Between PSE and GFE You Should Know</a></li>
                           <li><a href="#"> Top Nightspots in Launceston To Take Your Escort</a></li>
                           <li><a href="#"> Tips for Giving an Unforgettable Massage</a></li>
                           <li><a href="#"> The Art of Teasing and Denial</a></li>
                           <li><a href="#"> Tips on Talking Dirty to Your Clients</a></li>
                        </ul>

                     </div>

                     </div>
                  </div>
         </div>
         <div class="col-lg-12 mb-5">
            <div class="posts-nav bg-white p-5 d-lg-flex d-md-flex justify-content-between ">
               <a class="post-prev align-items-center" href="#">
                  <div class="posts-prev-item mb-4 mb-lg-0">
                     <span class="nav-posts-desc text-color">- Previous Post</span>
                     <h6 class="nav-posts-title mt-1">
                        Donec consectetuer ligula <br>vulputate sem tristique.
                     </h6>
                  </div>
               </a>
               <div class="border"></div>
               <a class="posts-next" href="#">
                  <div class="posts-next-item pt-4 pt-lg-0">
                     <span class="nav-posts-desc text-lg-right text-md-right text-color d-block">- Next Post</span>
                     <h6 class="nav-posts-title mt-1">
                        Ut aliquam sollicitudin leo.
                     </h6>
                  </div>
               </a>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
@push('scripts')
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script>
        $(function(){

    $(".filter-date").datepicker({
        dateFormat: "MM yy",   // Example: February 2026
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,

        beforeShow: function(input, inst) {
            $(".ui-datepicker-calendar").hide();
        },

        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).val($.datepicker.formatDate('MM yy', new Date(year, month, 1)));
        }
    });

});
    </script>
@endpush