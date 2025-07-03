@extends('layouts.admin')
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
            <div class="row">
            <div class="col-md-9">
                  <div class="v-main-heading h3" style="display: inline-block; padding-top: 0;"><h1>Classification Laws</h1></div>
                     <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>
                  </div>
            </div>

            <div class="row collapse" id="notes">
                  <div class="col-md-9 mb-5">
                     <div class="card">
                        <div class="card-body">
                              <h3 class="NotesHeader"><b>Notes:</b> </h3>
                              <ol>
                              <li>The following table is a list of all the legislation that applies to the various Locations.</li>
                              <li>To view the law, click the link and the legislation will open in a new tab for you to
                              browse.</li>
                              </ol>
                        </div>
                     </div>
                  </div>
            </div>
               <div class="col-md-9">
                  <!-- /.container-fluid -->
                  <div class="row">
                     <div class="col-md-12">
                       
                        <div id="accordion" class="myacording-design">
                           <div class="card">
                              <div class="card-header">
                                 <a class="card-link collapsed" data-toggle="collapse" href="#about_me" aria-expanded="false">
                                 Legislation
                                 </a>
                              </div>
                              <div id="about_me" class="collapse" data-parent="#accordion" style="">
                                 <div class="card-body p-0">
                                    <div class="table-responsive pl-2 pt-3 list-sec" id="sailorTableArea">
                                       <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                                         
                                          <table id="myTable price-sec" class="table table-striped dataTable no-footer" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                             <thead>
                                                <tr role="row" style="border-top: 2px solid #e3e6f0;">
                                                   <th class="sorting_disabled" rowspan="1" colspan="1" style=" text-align: center; width: 100px; text-align: left;border-right: 1px solid #e3e6f0; font-weight:bold;" aria-label="
                                                      Profile Name">State
                                                   </th>
                                                   <th class="sorting_disabled" rowspan="1" colspan="1" style=" text-align: left;border-right: 1px solid #e3e6f0; font-weight:bold;" aria-label="
                                                      Profile Name
                                                      ">Legislation <sup>(1)</sup>
                                                   </th>
                                                   <th class="sorting_disabled" rowspan="1" colspan="1" style=" text-align: center;border-right: 1px solid #e3e6f0; font-weight:bold; width: 120px" aria-label="Date Created">Regulations</th>
                                                  
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <tr role="row">
                                                   <td style="font-weight:bold; color:#000;"> Federal</td>
                                                   <td style="text-align:left; color:#ff3c5f;"> Classification (Publications, Films and Computer Games) Act
                                                   (Cth) 1995 </td>
                                                   <td style="text-align:center;"> None </td>
                                                </tr>
                                                <tr role="row">
                                                   <td style="font-weight:bold; color:#000;"> ACT </td>
                                                   <td style="text-align:left; color:#ff3c5f;"> Classification (Publications, Films and Computer Games)
                                                   (Enforcement) Act 1995 </td>
                                                   <td style="text-align:center;"> None </td>
                                                </tr>
                                                <tr role="row">
                                                   <td style="font-weight:bold; color:#000;"> NSW </td>
                                                   <td style="text-align:left; color:#ff3c5f;"> Classification (Publications, Films and Computer Games)
                                                   (Enforcement) Act 1995 </td>
                                                   <td style="text-align:center;"> None </td>
                                                </tr>
                                                <tr role="row">
                                                   <td style="font-weight:bold; color:#000;"> NT </td>
                                                   <td style="text-align:left; color:#ff3c5f;"> Classification of Publications, Films and Computer Games Act None </td>
                                                   <td style="text-align:center;"> None </td>
                                                </tr>
                                                <tr role="row">
                                                   <td style="font-weight:bold; color:#000;">Qld </td>
                                                   <td style="text-align:left; color:#ff3c5f;"> Classification of Computer Games and Images Act 1995
                                                      Classification of Films Act 1991
                                                        Classification of Publications Act 1991
                                                   </td>
                                                   <td style="text-align:center;"> None </td>
                                                </tr>
                                                <tr role="row">
                                                   <td style="font-weight:bold; color:#000;"> SA</td>
                                                   <td style="text-align:left; color:#ff3c5f;"> Classification (Publications, Films and Computer Games)
                                                   (Enforcement) Act 1995 </td>
                                                   <td style="text-align:center;"> None </td>
                                                </tr>
                                                <tr role="row">
                                                   <td style="font-weight:bold; color:#000;"> Tas </td>
                                                   <td style="text-align:left; color:#ff3c5f;"> Classification (Publications, Films and Computer Games)
                                                   (Enforcement) Act 1995 </td>
                                                   <td style="text-align:center;"> None </td>
                                                </tr>
                                                <tr role="row">
                                                   <td style="font-weight:bold; color:#000;"> Vic </td>
                                                   <td style="text-align:left; color:#ff3c5f;"> Classification (Publications, Films and Computer Games)
                                                   (Enforcement) Act 1995</td>
                                                   <td style="text-align:center;"> None </td>
                                                </tr>
                                                <tr role="row">
                                                   <td style="font-weight:bold; color:#000;"> WA </td>
                                                   <td style="text-align:left; color:#ff3c5f;"> Classification (publications, films and computer games)
                                                   Enforcement Act 1995</td>
                                                   <td style="text-align:center;"> None </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                    <div class="card border-0 mb-0 pb-0">
                                       <div class="card-body border-0 p-0 mt-2">
                                          <div class="card border-0 p-0 mb-0">
                                             <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                             <ol class="mb-0">
                                                <li>Classification Laws published in the relevant jurisdiction as at 1st September 2019.</li>
                                             </ol>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
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
                                          <div class="db_accordian_content">
                                             <h5>Essential principles</h5>
                                             <p>Three essential principles underlie the use of the Guidelines:</p>
                                             <ul>
                                                <li>the importance of context</li>
                                                <li>assessing impact</li>
                                                <li>the six classifiable elements</li>
                                             </ul>
                                             
                                             <h5>Importance of context</h5>
                                             <p>Context is crucial in determining whether a classifiable element is justified by the story-line
                                                or themes (the intensity of the photograph or video and the perception by the community). In
                                                particular, the way in which important social issues are dealt with may require a mature or
                                                adult perspective. This means that material that falls into a particular classification category
                                                in one context may fall outside it in another. In the case of this website and the photos and
                                                video that Advertisers submit, the distinction between R 18+ and X 18+.
                                             </p>

                                             <h5>Assessing impact</h5>
                                             <p>Assessing the impact of material requires considering not only the treatment of individual
                                                classifiable elements but also their cumulative effect. It also requires considering the purpose
                                                and tone of a sequence.</p>
                                                <p><em>Impact maybe higher where a photo or video scene:</em></p>
                                             <ul>
                                                <li>contains greater detail, including the use of close-ups and slow motion</li>
                                                <li>uses accentuation techniques, such as lighting, perspective and resolution</li>
                                                <li>uses special effects, such as lighting and sound, resolution, colour, size of image, characterisation and tone</li>
                                                <li>is prolonged</li>
                                                <li>is repeated frequently</li>
                                                <li>is realistic, rather than stylised</li>
                                                <li>encourages interactivity</li>
                                             </ul>
                                             <p><em>Interactivity includes the use of incentives and rewards, technical features and competitive
                                             intensity. As a general rule:</em></p>
                                             <ul>
                                                <li>except in material restricted to adults, nudity and sexual activity must not be related to
                                                incentives or rewards</li>
                                                <li>material that contains drug use and sexual violence related to incentives or rewards is
                                                Refused Classification and is rejected</li>
                                             </ul>

                                             <h5>The classifiable elements</h5>
                                             <p>The six classifiable elements in a film are:</p>
                                             <ul>
                                                <li>themes</li>
                                                <li>violence</li>
                                                <li>sex</li>
                                                <li>language</li>
                                                <li>drug use</li>
                                                <li>nudity</li>
                                             </ul>
                                             <p>The classification takes account of the context and impact of each of these elements,
                                                including their frequency and intensity, and their cumulative effect. It also takes account of the
                                                purpose and tone of a sequence, and how material is treated.</p>         

                                             <h5>Classifiable elements</h5>
                                             <h5>Themes</h5>
                                             <p>There are virtually no restrictions on the treatment of themes.</p>

                                             <h5>Violence</h5>
                                             <p>Violence is permitted. Sexual violence may be implied, if justified by context.</p>

                                             <h5>Sex</h5>
                                             <p>Sexual activity may be realistically simulated. The general rule is "simulation, yes - the real
                                             thing, no".</p>

                                             <h5>Language</h5>
                                             <p>There are virtually no restrictions on language.</p>
                                             <h5>Drug Use</h5>
                                             <p>Drug use is permitted.</p>
                                             <h5>Nudity</h5>
                                             <p>Nudity is permitted.</p>

                                             <h5>Definitions relating to guidelines</h5>
                                             <p><b>Sexual Activity</b> means matters pertaining to sexual acts, but not limited to sexual intercourse.</p>
                                             <p><b>Sexual Violence</b> means sexual assault or aggression, in which the victim does not consent.</p>
                                             <p><b>Violence</b> means acts of violence, the threat or effects of violence.</p>
                                          </div>
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