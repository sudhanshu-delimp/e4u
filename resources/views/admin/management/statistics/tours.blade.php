@extends('layouts.admin')
@section('content')
<div class="container-fluid">
   <!--middle content-->
   <div class="row">
      
      <div class="col-md-12">
         <div class="v-main-heading h3" style="display: inline-block; padding-top: 0;"><h1> Tours</h1></div>
            <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>
     </div>
     <div class="col-md-12 ">
         <div class="card collapse  mb-4" id="notes">
             <div class="card-body">
                 <h3 class="NotesHeader"><b>Notes:</b> </h3>
                 <ol>
                     <li>Values are determined by the number of days into the financial year.</li>
                     <li>Total Last Year compared to Current Year.</li>
                     <li>Total Tours includes Current Year expressed as a percentage deviation.</li>
                     <li>Base equals the total Tours as at the 30th June, for the given period.</li>
                 </ol>
             </div>
         </div>
     </div>
    <div class="col-md-12">
        <div class="row my-3">
            <div class="col-lg-4 col-md-12 col-sm-12">
                
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 d-flex justify-content-end" style="gap: 50px;">
              
                <div class="total_listing">
                    <div><span>Current Tours: : </span></div>
                    <div><span>4,456</span></div>
                </div>
            </div>
        </div>
        
        <div class="table-responsive membership--inner">
           <table class="table table-bordered">
              <thead>
                 <tr>
                    <th colspan="9">Year to Year Growth <br>(Days: 158) [number of days into the year]</th>
                    <th colspan="3">Total Tours <br> (Last FY)</th>
                    <th colspan="3">Historical Tours <br> (End of last FY)</th>
                 </tr>
                 <tr>
                    <th colspan="6">Current</th>
                    <th class="pb-0 border-0" colspan="1">Total </th>
                    <th colspan="2">Variation</th>
                    <th class="pb-0 border-0">Total </th>
                    <th colspan="2">Variation</th>
                    <th class="pb-0 border-0">Total</th>
                    <th colspan="2">Overall Growth</th>
                 </tr>
                 <tr>
                    <th colspan="2">Location</th>
                    <th>Member</th>
                    <th>Current</th>
                    <th>Past</th>
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
                    <td class="border-right-0 text-black" colspan="14">+ Total Summary</td>
                   
                    <td class="border-left-0" style="text-align: right;">V</td>
                 </tr>  
                 <tr>
                    <td  style="text-align: left; border-right:0px;" colspan="2">ACT</td>
                    <td>All</td>
                    <td>152</td>
                    <td>1,762</td>
                    <td>1,914</td>
                    <td>1,787</td>
                    <td>
                       <div class="d-flex justify-content-between"><span class="arrow-up">↑</span>127</div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between"><span class="arrow-up">↑</span>7.1</div>
                     </td>
                     
                    <td>4,428</td>
                    <td>
                       <div class="d-flex justify-content-between"><span class="arrow-down">↓</span>2,514</div>
                    </td>
                    <td>
                       <div class="d-flex justify-content-between"><span class="arrow-down">↓</span>56.8</div>
                    </td>
                    <td>9,410</td>
                    <td>
                       <div class="d-flex justify-content-between"><span class="arrow-up">↑</span>1,914</div>
                    </td>
                    <td>
                       <div class="d-flex justify-content-between"><span class="arrow-up">↑</span>20.3</div>
                    </td>
                 </tr>
                 <tr>
                    <td  style="text-align: left; border-right:0px;" colspan="2">NSW </td>
                    
                    <td>All</td>
                    <td>[total]</td>
                    <td>[total]</td>
                    <td>[total]</td>
                    <td>[total]</td>
                    <td>[sum]</td>
                    <td>[sum]</td>
                    <td>[total]</td>
                    <td>[sum]</td>
                    <td>[sum]</td>
                    <td>[total]</td>
                    <td>[sum]</td>
                    <td>[sum]</td>
                 </tr>

                 <tr>
                    <td  style="text-align: left; border-right:0px;" colspan="2">NSW </td>
                    
                    <td>All</td>
                    <td>[total]</td>
                    <td>[total]</td>
                    <td>[total]</td>
                    <td>[total]</td>
                    <td>[sum]</td>
                    <td>[sum]</td>
                    <td>[total]</td>
                    <td>[sum]</td>
                    <td>[sum]</td>
                    <td>[total]</td>
                    <td>[sum]</td>
                    <td>[sum]</td>
                 </tr>

                 <tr>
                    <td  style="text-align: left; border-right:0px;" colspan="2">NSW</td>
                    
                    <td>All</td>
                    <td>[total]</td>
                    <td>[total]</td>
                    <td>[total]</td>
                    <td>[total]</td>
                    <td>[sum]</td>
                    <td>[sum]</td>
                    <td>[total]</td>
                    <td>[sum]</td>
                    <td>[sum]</td>
                    <td>[total]</td>
                    <td>[sum]</td>
                    <td>[sum]</td>
                 </tr>

                 <tr>
                    <td  style="text-align: left; border-right:0px;" colspan="2">NSW</td>
                    
                    <td>All</td>
                    <td>[total]</td>
                    <td>[total]</td>
                    <td>[total]</td>
                    <td>[total]</td>
                    <td>[sum]</td>
                    <td>[sum]</td>
                    <td>[total]</td>
                    <td>[sum]</td>
                    <td>[sum]</td>
                    <td>[total]</td>
                    <td>[sum]</td>
                    <td>[sum]</td>
                 </tr>

                 <tr>
                    <td  style="text-align: left; border-right:0px;" colspan="2">NSW</td>
                    
                    <td>All</td>
                    <td>[total]</td>
                    <td>[total]</td>
                    <td>[total]</td>
                    <td>[total]</td>
                    <td>[sum]</td>
                    <td>[sum]</td>
                    <td>[total]</td>
                    <td>[sum]</td>
                    <td>[sum]</td>
                    <td>[total]</td>
                    <td>[sum]</td>
                    <td>[sum]</td>
                 </tr>

                 <tr>
                    <td  style="text-align: left; border-right:0px;" colspan="2">NSW</td>
                    
                    <td>All</td>
                    <td>[total]</td>
                    <td>[total]</td>
                    <td>[total]</td>
                    <td>[total]</td>
                    <td>[sum]</td>
                    <td>[sum]</td>
                    <td>[total]</td>
                    <td>[sum]</td>
                    <td>[sum]</td>
                    <td>[total]</td>
                    <td>[sum]</td>
                    <td>[sum]</td>
                 </tr>
                 <tr>
                    <td  style="text-align: left; border-right:0px;" colspan="2">NSW</td>
                    
                    <td>All</td>
                    <td>[total]</td>
                    <td>[total]</td>
                    <td>[total]</td>
                    <td>[total]</td>
                    <td>[sum]</td>
                    <td>[sum]</td>
                    <td>[total]</td>
                    <td>[sum]</td>
                    <td>[sum]</td>
                    <td>[total]</td>
                    <td>[sum]</td>
                    <td>[sum]</td>
                 </tr>
                 
                 <tr class="fw-bold table-primary">
                    <td colspan="2"></td>
                    <td style="text-align: right">Total</td>
                    <td>1,258</td>
                    <td>[total]</td>
                    <td>[total]</td>
                    <td>[total]</td>
                    <td>[sum]</td>
                    <td>[sum]</td>
                    <td>[total]</td>
                    <td>[sum]</td>
                    <td>[sum]</td>
                    <td>[total]</td>
                    <td>[sum]</td>
                    <td>[sum]</td>
                 </tr>
              </tbody>
           </table>

           <table class="table table-bordered">
            <tbody>
              <tr>
                <td class="border-right-0 text-black" colspan="13">+ ACT (Prefix 1)</td>
                <td class="border-left-0" style="text-align: right">V</td>
              </tr>
              <tr>
                <td></td>
                <td>Female</td>
                <td>125</td>
                <td>1,588</td>
                <td>1,713</td>
                <td>1,615</td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 98</div>
                </td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 6.1</div>
                </td>
                <td>4,010</td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-down">↓</span> 2,297</div>
                </td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-down">↓</span> 57.3</div>
                </td>
                <td>8,523</td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 1,713</div>
                </td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 20.1</div>
                </td>
              </tr>
              <tr>
                <td></td>
                <td>Male</td>
                <td>15</td>
                <td>62</td>
                <td>77</td>
                <td>56</td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 21</div>
                </td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 37.5</div>
                </td>
                <td>140</td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-down">↓</span> 63</div>
                </td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-down">↓</span> 45.0</div>
                </td>
                <td>310</td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 77</div>
                </td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 24.8</div>
                </td>
              </tr>
              <tr>
                <td></td>
                <td>Trans</td>
                <td>10</td>
                <td>98</td>
                <td>108</td>
                <td>98</td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 10</div>
                </td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 10.2</div>
                </td>
                <td>245</td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-down">↓</span> 137</div>
                </td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-down">↓</span> 55.9</div>
                </td>
                <td>505</td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 108</div>
                </td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 21.4</div>
                </td>
              </tr>
              <tr>
                <td></td>
                <td>Couple</td>
                <td>2</td>
                <td>14</td>
                <td>16</td>
                <td>18</td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-down">↓</span> (2)</div>
                </td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 11.1</div>
                </td>
                <td>33</td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-down">↓</span> 17</div>
                </td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-down">↓</span> 51.5</div>
                </td>
                <td>72</td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 16</div>
                </td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 22.2</div>
                </td>
              </tr>
              <tr class="fw-bold table-primary">
                <td></td>
                <td>Total:</td>
                <td>152</td>
                <td>1,762</td>
                <td>1,9142</td>
                <td>1,787</td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 127</div>
                </td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 7.1</div>
                </td>
                <td>4,428</td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-down">↓</span> 2,514</div>
                </td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-down">↓</span> 56.8</div>
                </td>
                <td>9,410</td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 1,914</div>
                </td>
                <td>
                  <div class="d-flex justify-content-between"><span class="arrow-up">↑</span> 20.3</div>
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
     <div class="col-md-12">
        <div class="timer_section">
                <p>Server time: <span>[10:23:51 am]</span></p>
                <p>Refresh time:<span> [seconds]</span></p>
                <p>Up time: <span>[214 days & 09 hours 12 minutes]</span></p>
            </div>
       </div>
   </div>
   
   
   <!--right side bar end-->
</div>
@endsection
@section('script')
<script>
    
</script>
@endsection
