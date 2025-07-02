@extends('layouts.agent')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<style type="text/css">
   .select2-container .select2-choice, .select2-result-label {
   font-size: 1.5em;
   height: 52px !important; 
   overflow: auto;
   }
   .select2-arrow, .select2-chosen {
   padding-top: 6px;
   }
   span.select2.select2-container.select2-container--default > span.selection > span {
   height: 52px !important; 
   }
   .list-sec .table td, .table th{
   border: 1px solid #0c233d;
   }
</style>
@endsection
@section('content')
<div id="wrapper">
   <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
         <div class="container-fluid pl-3 pl-lg-5">
            <!--middle content-->
            {{-- Page Heading   --}}
            <div class="row">
               <div class="d-flex align-items-center justify-content-start mt-5 flex-wrap col-lg-12">
                  <h1 class="h1">Classification Laws</h1>
                  <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
               </div>
               <div class="col-md-12 my-2">
                  <div class="card collapse" id="notes" style="">
                     <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <ol>
                        
                        </ol>
                     </div>
                  </div>
               </div>
            </div>
            {{-- end --}}
            <div class="row">
               <div class="col-md-10">
                  <!-- Begin Page Content -->
                  <div class="container-fluid" style="padding: 0px 0px;">
                    
                     <h2 class="primery_color normal_heading"><b>Legislation</b></h2>
                  </div>
                  <!-- /.container-fluid --><br>
                  <div class="row">
                     <div class="col-md-12">
                        <table style="width:100%;line-height: 25px;">
                           <tbody>
                              <tr>
                                 <th style="width: 20%;">State</th>
                                 <th>Legislation<sup>(1)</sup></th>
                                 <th>Regulations</th>
                              </tr>
                              <tr>
                                 <td valign="top">Federal:</td>
                                 <td><a target="_blank" class="termsandconditions_text_color custom_links_design" href="http://www9.austlii.edu.au/cgi-bin/viewdb/au/legis/cth/consol_act/cfacga1995489/">Classification (Publications, Films and Computer Games) Act <i class="termsandconditions_text_color custom_links_design">(Cth)</i> 1995</a></td>
                                 <td></td>
                                 <td></td>
                              </tr>
                              <tr>
                                 <td valign="top">ACT:</td>
                                 <td><a target="_blank" class="termsandconditions_text_color custom_links_design" href="https://www.austlii.edu.au/cgi-bin/viewdb/au/legis/act/consol_act/cfacga1995596/">Classification (Publications, Films and Computer Games) (Enforcement) Act 1995</a></td>
                                 <td></td>
                                 <td></td>
                              </tr>
                              <tr>
                                 <td valign="top">NSW:</td>
                                 <td><a target="_blank" class="termsandconditions_text_color custom_links_design" href="https://www.austlii.edu.au/cgi-bin/viewdb/au/legis/nsw/consol_act/cfacgea1995596/">Classification (Publications, Films and Computer Games) (Enforcement) Act 1995</a></td>
                                 <td></td>
                                 <td></td>
                              </tr>
                              <tr>
                                 <td valign="top">NT:</td>
                                 <td><a target="_blank" class="termsandconditions_text_color custom_links_design" href="https://www.austlii.edu.au/cgi-bin/viewdb/au/legis/nt/consol_act/copfacga1985508/">Classification of Publications, Films and Computer Games Act</a></td>
                                 <td><a target="_blank" class="termsandconditions_text_color custom_links_design" href="https://www.austlii.edu.au/cgi-bin/viewdb/au/legis/nt/consol_reg/copfacgr1985617/">Regulations</a></td>
                                 <td></td>
                              </tr>
                              <tr>
                                 <td valign="top">Qld:</td>
                                 <td><a target="_blank" class="termsandconditions_text_color custom_links_design" href="https://www.austlii.edu.au/cgi-bin/viewdb/au/legis/qld/consol_act/cocgaia1995373/">Classification of Computer Games and Images Act 1995</a><br>
                                    <a target="_blank" class="termsandconditions_text_color custom_links_design" href="https://www.austlii.edu.au/cgi-bin/viewdb/au/legis/qld/consol_act/cofa1991220/">Classification of Films Act 1991</a><br>
                                    <a target="_blank" class="termsandconditions_text_color custom_links_design" href="https://www.austlii.edu.au/cgi-bin/viewdb/au/legis/qld/consol_act/cocgaia1995373/">Classification of Publications Act 1991</a><br>
                                 </td>
                                 <td></td>
                                 <td></td>
                              </tr>
                              <tr>
                                 <td valign="top">SA:</td>
                                 <td><a target="_blank" class="termsandconditions_text_color custom_links_design" href="https://www.austlii.edu.au/cgi-bin/viewdb/au/legis/sa/consol_act/cfacga1995489/">Classification (Publications, Films and Computer Games) (Enforcement) Act 1995</a></td>
                                 <td></td>
                                 <td></td>
                              </tr>
                              <tr>
                                 <td valign="top">Tas:</td>
                                 <td><a target="_blank" class="termsandconditions_text_color custom_links_design" href="https://www.austlii.edu.au/cgi-bin/viewdb//au/legis/tas/consol_act/cfacgea1995596/">Classification (Publications, Films and Computer Games) (Enforcement) Act 1995</a></td>
                                 <td></td>
                                 <td></td>
                              </tr>
                              <tr>
                                 <td valign="top">Vic:</td>
                                 <td><a target="_blank" class="termsandconditions_text_color custom_links_design" href="https://www.austlii.edu.au/cgi-bin/viewdb/au/legis/vic/consol_act/cfacga1995596/">Classification (Publications, Films and Computer Games) (Enforcement) Act 1995</a></td>
                                 <td></td>
                                 <td></td>
                              </tr>
                              <tr>
                                 <td valign="top">WA:</td>
                                 <td><a target="_blank" class="termsandconditions_text_color custom_links_design" href="http://www9.austlii.edu.au/cgi-bin/viewdb/au/legis/wa/consol_act/cfacgea1996596/">Classification (publications, films and computer games) Enforcement Act 1996</a></td>
                                 <td></td>
                                 <td></td>
                              </tr>
                           </tbody>
                        </table>
                        <p class="pt-5"><strong>NOTE:</strong> 1. Classification Laws published in the relevant jurisdiction as at 1st September 2019.</p>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div id="accordion" class="myacording-design">
                           <div class="card">
                              <div class="card-header">
                                 <a class="card-link collapsed" data-toggle="collapse" href="#LoyaltyProgram" aria-expanded="false">
                                  Guidelines
                                 </a>
                              </div>
                              <div id="LoyaltyProgram" class="collapse" data-parent="#accordion" style="">
                                 <div class="card-body p-0">
                                    <div class="card border-0 mb-0 pb-0">
                                       <div class="card-body border-0 p-0 mt-2">
                                          <p><b>Essential principles</b></p>
                                          <p>Three essential principles underlie the use of the Guidelines:</p>
                                          <ul style="list-style: unset;">
                                             <li>the importance of context</li>
                                             <li>assessing impact</li>
                                             <li>the six classifiable elements</li>
                                          </ul>
                                          <p class="pt-2"><b>Importance of context</b></p>
                                          <p>Context is crucial in determining whether a classifiable element is justified by the story-line or themes (the intensity of the photograph or video and the perception by the community). In particular, the way in which important social issues are dealt with may require a mature or adult perspective. This means that material that falls into a particular classification category in one context may fall outside it in another. In the case of this website and the photos and video that Advertisers submit, the distiction between R 18+ and X 18+.</p>
                                          <p class="pt-2"><b>Assessing impact</b></p>
                                          <p>Assessing the impact of material requires considering not only the treatment of individual classifiable elements but also their cumulative effect. It also requires considering the purpose and tone of a sequence.</p>
                                          <p><i>Impact maybe higher where a photo or video scene:</i></p>
                                          <ul style="list-style: unset;">
                                             <li>contains greater detail, including the use of close-ups and slow motion</li>
                                             <li>uses accentuation techniques, such as lighting, perspective and resolution</li>
                                             <li>uses special effects, such as lighting and sound, resolution, colour, size of image, characterisation and tone</li>
                                             <li>is prolonged</li>
                                             <li>is repeated frequently</li>
                                             <li>is realistic, rather than stylised</li>
                                             <li>encourages interactivity</li>
                                          </ul>
                                          <p><i>Interactivity includes</i> the use of incentives and rewards, technical features and competitive intensity. As a general rule:</p>
                                          <ul style="list-style: unset;">
                                             <li>except in material restricted to adults, nudity and sexual activity must not be related to incentives or rewards</li>
                                             <li>material that contains drug use and sexual violence related to incentives or rewards is Refused Classification and is <u>rejected</u></li>
                                          </ul>
                                          <p class="pt-2"><b>The classifiable elements</b></p>
                                          <p>The six classifiable elements in a film are:</p>
                                          <ul style="list-style: unset;">
                                             <li>themes</li>
                                             <li>violence</li>
                                             <li>sex</li>
                                             <li>language</li>
                                             <li>drug use</li>
                                             <li>nudity</li>
                                          </ul>
                                          <p>The classification takes account of the context and impact of each of these elements, including their frequency and intensity, and their cumulative effect. It also takes account of the purpose and tone of a sequence, and how material is treated.</p>
                                          <p class="pt-2"><b>Classifiable elements</b></p>
                                          <p><b>Themes</b><br>There are virtually no restrictions on the treatment of themes.</p>
                                          <p><b>Violence</b><br>Violence is permitted. Sexual violence may be implied, if justified by context.</p>
                                          <p><b>Sex</b><br>Sexual activity may be realistically simulated. The general rule is "simulation, yes - the real thing, no".</p>
                                          <p><b>Language</b><br>
                                             There are virtually no restrictions on language.
                                          </p>
                                          <p><b>Drug Use</b><br>
                                             Drug use is permitted.
                                          </p>
                                          <p><b>Nudity</b><br>
                                             Nudity is permitted.
                                          </p>
                                          <p class="pt-2"><b>Definitions relating to guidelines</b></p>
                                          <p><b>Sexual Activity</b><br>
                                             Matters pertaining to sexual acts, but not limited to sexual intercourse.
                                          </p>
                                          <p><b>Sexual Violence</b><br>
                                             Sexual assault or aggression, in which the victim does not consent.
                                          </p>
                                          <p><b>Violence</b><br>
                                             Acts of violence; the threat or effects of violence.
                                          </p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--middle content end here-->
               <!--right side bar start from here-->
            </div>
         </div>
      </div>
   </div>
</div>
@include('escort.dashboard.partials.playmates-modal')
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
@endpush