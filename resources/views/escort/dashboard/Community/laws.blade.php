@extends('layouts.escort')
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
               <div class="col-md-12">
                    <div class="v-main-heading h3">
                        Local Laws
                        <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>
                    </div>
                   <div class="card collapse  mb-4" id="notes">
                       <div class="card-body">
                           <h3 class="NotesHeader"><b>Notes:</b> </h3>
                           <ol>
                               <li>The following table is a list of all of the legislation that applies to your Location.</li>
                               <li>To view the law, click the link and the legislation will open in a new tab for you to
                                   browse.</li>
                           </ol>
                       </div>
                   </div>
                </div>
            <div class="col-md-12 mt-4">
                  <div class="row">
                     <div class="col-md-12">
{{--                         <div class="card">--}}
                             <div id="about_me" class="collapse show" data-parent="#accordion" style="">
{{--                                 <div class="card-body p-0">--}}
                                     <div class="table-responsive pl-2 pt-3 list-sec" id="sailorTableArea">
                                             <table id="myTable price-sec" class="table dataTable" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                                 <thead class="text-center">
                                                 <tr role="row">
                                                     <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 212px;">State</th>
                                                     <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 212px;">Legislation<sup>(1)</sup></th>
                                                     <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 113px;">Regulations</th>
                                                     <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 113px;">Comments</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody>
                                                 <tr>
                                                     <td>Federal</td>
                                                     <td><a class="custom_links_design" target="_blank" href="http://www6.austlii.edu.au/cgi-bin/viewdoc/au/legis/cth/consol_act/cca1995115/sch1.html">Criminal Code Act 1995</a></td>
                                                     <td>None</td>
                                                     <td>Divisions 270 &amp; 271</td>
                                                 </tr>
                                                 <tr>
                                                     <td>ACT</td>
                                                     <td><a class="custom_links_design" target="_blank" href="http://www.legislation.act.gov.au/a/1992-64/default.asp">Sex Work Act 1992</a></td>
                                                     <td><a class="custom_links_design" target="_blank" href="http://www.legislation.act.gov.au/sl/1993-19/default.asp">Prostitution Regulation 1993</a></td>
                                                     <td>Regulations repealed 9th August 2018</td>
                                                 </tr>
                                                 <tr>
                                                     <td>NSW</td>
                                                     <td>As at 1st January 2021, there is no Prostitution legislation in place in the State of New South Wales.</td>
                                                     <td>None</td>
                                                     <td>None</td>
                                                 </tr>
                                                 <tr>
                                                     <td>NT</td>
                                                     <td><a class="custom_links_design" target="_blank" href="http://www.austlii.edu.au/au/legis/nt/consol_act/pra317/">Prostitution Regulation Act</a></td>
                                                     <td><a class="custom_links_design" target="_blank" href="http://www.austlii.edu.au/au/legis/nt/consol_reg/pr314/">Prostitution Regulations</a></td>
                                                     <td>None</td>
                                                 </tr>
                                                 <tr>
                                                     <td>QLD</td>
                                                     <td><a class="custom_links_design" target="_blank" href="https://www.legislation.qld.gov.au/view/html/inforce/current/act-1999-073">Prostitution Act 1999</a></td>
                                                     <td><a class="custom_links_design" target="_blank" href="https://www.legislation.qld.gov.au/view/html/inforce/current/sl-2014-0192">Prostitution Regulation 2000</a></td>
                                                     <td>Massage Centres must have their business telephone number registered with the Prostitution Licensing Authority and display their number in their Profile</td>
                                                 </tr>
                                                 <tr>
                                                     <td>SA:</td>
                                                     <td><a class="custom_links_design" target="_blank" href="http://www.austlii.edu.au/au/legis/sa/consol_act/clca1935262/">Criminal Law Consolidation Act 1935</a> and <a class="custom_links_design" target="_blank" href="http://www.austlii.edu.au/au/legis/sa/consol_act/soa1953189/index.html">Summary Offences Act 1953</a></td>
                                                     <td>None</td>
                                                     <td>None</td>
                                                 </tr>
                                                 <tr>
                                                     <td>TAS</td>
                                                     <td><a class="custom_links_design" target="_blank" href="http://www.austlii.edu.au/au/legis/tas/consol_act/sioa2005253/">Sex Industry Offences Act 2005</a></td>
                                                     <td>None</td>
                                                     <td>None</td>
                                                 </tr>
                                                 <tr>
                                                     <td>VIC</td>
                                                     <td><a class="custom_links_design" target="_blank" href="http://www.legislation.vic.gov.au/Domino/Web_Notes/LDMS/LTObject_Store/ltobjst8.nsf/DDE300B846EED9C7CA257616000A3571/818BBA0CE3EA0706CA257BC60007035D/$FILE/94-102aa080%20authorised.pdf">Sex Work Act 1994</a></td>
                                                     <td><a class="custom_links_design" target="_blank" href="http://www.legislation.vic.gov.au/Domino/Web_Notes/LDMS/LTObject_Store/LTObjSt7.nsf/DDE300B846EED9C7CA257616000A3571/11D809EA9BF85B86CA257B200017205D/$FILE/06-64sra012%20authorised.pdf">Sex Work Regulations 2006</a></td>
                                                     <td>You must display your SWA in your Profile</td>
                                                 </tr>
                                                 <tr>
                                                     <td>WA</td>
                                                     <td><a class="custom_links_design" target="_blank" href="http://www.austlii.edu.au/au/legis/wa/consol_act/pa2000205/">Prostitution Act 2000</a></td>
                                                     <td>None</td>
                                                     <td>None</td>
                                                 </tr>
                                                 </tbody>
                                             </table>

                                         <p class="pt-5"><strong>NOTE:</strong> 1. Local Laws published in the relevant jurisdiction as at 1st January 2024.</p>
                                         </div>
                                         <div class="mt-5">
                                             <b>Changes to this Guide</b><br>
                                             <span>This Guide was last updated on 02-2024.</span>
                                         </div>
{{--                                     </div>--}}
                                     {{--<div class="mt-5">
                                         <h3>Changes to this Guide</h3>
                                         <span>
                                                        This Guide was last updated on 02-2024.
                                                    </span>
                                     </div>--}}
                             </div>
{{--                         </div>--}}
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
@include('escort.dashboard.partials.playmates-modal')
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
@endpush
