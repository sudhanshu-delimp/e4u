@extends('layouts.admin')
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content-->
   <div class="row">      
      <div class="custom-heading-wrapper col-md-12">
         <h1 class="h1"> Membership</h1>
         <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
      </div>
      <div class="col-md-12 mb-4">
         <div class="card collapse" id="notes">
               <div class="card-body">
                  <h3 class="NotesHeader"><b>Notes:</b> </h3>
                  <ol>
                     <li>This form will be pre-populated with your details according to what you have
                           entered in <a href="{{ route('escort.profile.information') }}" class="custom_links_design">My Account</a>. You can alter any of the information.</li>
                     
                     <li>Payment is based on the monthly Fee for the Email service.</li>
                     <li>Complete the form to request the Email service. When completing the form please
                           ensure all of the details are correct and you have selected the correct option for
                           communications.
                     </li>
                  </ol>
               </div>
         </div>
      </div>
      <div class="col-md-12">
         <div class="row mb-3">
            <div class="col-lg-4 col-md-12 col-sm-12">
                  
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 d-flex justify-content-end" style="gap: 50px;">
               
                  <div class="total_listing">
                     <div><span>Total Memberships: </span></div>
                     <div><span>9,258</span></div>
                  </div>
            </div>
         </div>
         
         <div class="table-responsive membership--inner">
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th colspan="6">Year to Year Growth <br>(Days: 158) [number of days into the year]</th>
                     <th colspan="3">Total Membership <br> (Last FY)</th>
                     <th colspan="3">Historical Membership <br> (End of last FY)</th>
                  </tr>
                  <tr>
                     <th colspan="3">Current</th>
                     <th class="pb-0 border-0" colspan="1">Total </th>
                     <th colspan="2">Variation</th>
                     <th class="pb-0 border-0">Total </th>
                     <th colspan="2">Variation</th>
                     <th class="pb-0 border-0">Total</th>
                     <th colspan="2">Overall Growth</th>
                  </tr>
                  <tr>
                     <th>Location</th>
                     <th>Member</th>
                     <th>Total</th>
                     <th class="pt-0">Last FY</th>
                     <th>Units</th>
                     <th>%</th>
                     <th class="pt-0">Units</th>
                     <th>Units</th>
                     <th>%</th>
                     <th class="pt-0">Units</th>
                     <th>Units</th>
                     <th>%</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td class="border-right-0 text-black">+ Total Summary</td>
                     <td class="border-0"></td>
                     <td class="border-0"></td>
                     <td class="border-0"></td>
                     <td class="border-0"></td>
                     <td class="border-0"></td>
                     <td class="border-0"></td>
                     <td class="border-0"></td>
                     <td class="border-0"></td>
                     <td class="border-0"></td>
                     <td class="border-0"></td>
                     <td class="border-left-0">V</td>
                  </tr>  
                  <tr>
                     <td>ACT</td>
                     <td>All</td>
                     <td>387</td>
                     <td>296</td>
                     <td>
                        <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 91</div>
                     </td>
                     <td>
                        <div class="d-flex justify-content-between"><span class="arrow-down">↑</span> 30.7</div>
                     </td>
                     <td>653</td>
                     <td>266</td>
                     <td>
                        <div class="d-flex justify-content-between"><span class="arrow-down">↑</span> 40.7</div>
                     </td>
                     <td>4,211</td>
                     <td>
                        <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 387</div>
                     </td>
                     <td>
                        <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 10.1</div>
                     </td>
                  </tr>
                  <tr>
                     <td>NSW</td>
                     <td>All</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                  </tr>
                  <tr>
                     <td>Vic</td>
                     <td>All</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                  </tr>
                  <tr>
                     <td>Qld</td>
                     <td>All</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                  </tr>
                  <tr>
                     <td>SA</td>
                     <td>All</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                  </tr>
                  <tr>
                     <td>WA</td>
                     <td>All</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                  </tr>
                  <tr>
                     <td>Tas</td>
                     <td>All</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                  </tr>
                  <tr>
                     <td>NT</td>
                     <td>All</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                  </tr>
                  <tr class="fw-bold table-primary">
                     <td></td>
                     <td>Total</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                     <td>9,258</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                  </tr>
               </tbody>
            </table>

            <table class="table table-bordered">
            <tbody>
               <tr>
                  <td class="border-right-0 text-black">+ ACT (Prefix 1)</td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0">V</td>
               </tr>
               <tr>
                  <td>Escorts</td>
                  <td>Female</td>
                  <td>235</td>
                  <td>205</td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 30</div>
                  </td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 14.6 </div>
                  </td>
                  <td>450</td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-down">↑</span> 219 </div>
                  </td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-down">↑</span> 47.8 </div>
                  </td>
                  <td>2,725</td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 235 </div>
                  </td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 9.4 </div>
                  </td>
               </tr>
               <tr>
                  <td></td>
                  <td>Male</td>
                  <td>5</td>
                  <td>2</td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span>3</div>
                  </td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 150.0 </div>
                  </td>
                  <td>8</td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-down">↑</span> 3 </div>
                  </td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-down">↑</span> 37.5 </div>
                  </td>
                  <td>120</td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span>5</div>
                  </td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span>4.3</div>
                  </td>
               </tr>
               <tr>
                  <td></td>
                  <td>Trans</td>
                  <td>50</td>
                  <td>33</td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 17 </div>
                  </td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 51.5 </div>
                  </td>
                  <td>68</td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-down">↑</span> 16 </div>
                  </td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-down">↑</span>26.5 </div>
                  </td>
                  <td>252</td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span>50</div>
                  </td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span>24.8</div>
                  </td>
               </tr>
               <tr>
                  <td></td>
                  <td>Couple</td>
                  <td>2</td>
                  <td>1</td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span>1</div>
                  </td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 100.0 </div>
                  </td>
                  <td>5</td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-down">↑</span> 3 </div>
                  </td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-down">↑</span> 60.0</div>
                  </td>
                  <td>18</td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span>2</div>
                  </td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span>12.5</div>
                  </td>
               </tr>
               <tr class="fw-bold">
                  <td></td>
                  <td>Sub-total:</td>
                  <td>292</td>
                  <td>241</td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 51 </div>
                  </td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 21.2 </div>
                  </td>
                  <td>536</td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-down">↑</span>244</div>
                  </td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-down">↑</span>45.5</div>
                  </td>
                  <td>2,863</td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span>292</div>
                  </td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span>11.4</div>
                  </td>
               </tr>
               <tr>
                  <td>Massage Centres</td>
                  <td></td>
                  <td>95</td>
                  <td>55</td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 40</div>
                  </td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 72.7 </div>
                  </td>
                  <td>117</td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-down">↑</span>22</div>
                  </td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-down">↑</span>18.8</div>
                  </td>
                  <td>1,348</td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span>95</div>
                  </td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span>7.6</div>
                  </td>
               </tr>
               <tr class="fw-bold table-primary">
                  <td></td>
                  <td>Total:</td>
                  <td>387</td>
                  <td>296</td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 91 </div>
                  </td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 30.7 </div>
                  </td>
                  <td>653</td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-down">↑</span>266</div>
                  </td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-down">↑</span>40.7</div>
                  </td>
                  <td>4,211</td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span>387</div>
                  </td>
                  <td>
                     <div class="d-flex justify-content-between"><span class="arrow-up">↑</span>10.1</div>
                  </td>
               </tr>
            </tbody>
         </table>

         <table class="table table-bordered">
            <tbody>
               <tr>
                  <td class="border-right-0 text-black">+ NSW (Prefix 2)</td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0">V</td>
               </tr>  
               
            </tbody>
         </table>

         <table class="table table-bordered">
            <tbody>
               <tr>
                  <td class="border-right-0 text-black">+ Vic (Prefix 3)</td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0">V</td>
               </tr>  
               
            </tbody>
         </table>

         <table class="table table-bordered">
            <tbody>
               <tr>
                  <td class="border-right-0 text-black">+ Qld (Prefix 4) </td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0">V</td>
               </tr>  
               
            </tbody>
         </table>

         <table class="table table-bordered">
            <tbody>
               <tr>
                  <td class="border-right-0 text-black">+ SA (Prefix 5) </td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0">V</td>
               </tr>  
               
            </tbody>
         </table>

         <table class="table table-bordered">
            <tbody>
               <tr>
                  <td class="border-right-0 text-black">+ WA (Prefix 6) </td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0">V</td>
               </tr>  
               
            </tbody>
         </table>

         <table class="table table-bordered">
            <tbody>
               <tr>
                  <td class="border-right-0 text-black">+ Tas (Prefix 7)</td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0">V</td>
               </tr>  
               
            </tbody>
         </table>

         <table class="table table-bordered">
            <tbody>
               <tr>
                  <td class="border-right-0 text-black">+ NT (Prefix 8) </td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0 border-right-0"></td>
                  <td class="border-left-0">V</td>
               </tr>  
               
            </tbody>
         </table>
         </div>
      </div>
   </div>
</div>
@endsection
@section('script')
<script>
    
</script>
@endsection
