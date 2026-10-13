 <div class="tab-pane fade  active show" id="one" role="tabpanel" aria-labelledby="one-tab">
     <div class="row my-3">
         <div class="col-lg-4">
             <div class="common-card">
                 <div class="card-top">
                     <div class="card-icon">
                         <svg  viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20 14V7C20 5.34315 18.6569 4 17 4H7C5.34315 4 4 5.34315 4 7V17C4 18.6569 5.34315 20 7 20H13.5M20 14L13.5 20M20 14H15.5C14.3954 14 13.5 14.8954 13.5 16V20" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M8 8H16" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M8 12H12" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                     </div>

                     <div class="card-heading">
                         <h2>Report Information</h2>
                     </div>
                 </div>

                 <hr class="custom-hr">
                 <div class="common-stars">
                     <div class="stats-detail">
                         <div class="stats-label">
                             Advertisers
                         </div>
                         <div class="stats-value">All Advertisers</div>
                     </div>

                     <div class="stats-detail">
                         <div class="stats-label">Report Generated</div>
                         <div class="stats-value">09-10-2026</div>
                     </div>

                     <div class="stats-detail">
                         <div class="stats-label">Produced For</div>
                         <div class="stats-value">Well Done Accounts </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-lg-4">
             <div class="common-card">
                 <div class="card-top">
                     <div class="card-icon">
                         <svg  viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="none"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g fill="#ff3c5f"> <path d="M12 2a1 1 0 011 1v10a1 1 0 11-2 0V3a1 1 0 011-1zM8 6a1 1 0 011 1v6a1 1 0 11-2 0V7a1 1 0 011-1zM5 10a1 1 0 00-2 0v3a1 1 0 102 0v-3z"></path> </g> </g></svg>
                     </div>

                     <div class="card-heading">
                         <h2>Earnings Overview</h2>
                     </div>
                 </div>

                 <hr class="custom-hr">
                 <div class="common-stars">
                     

                     <div class="stats-detail">
                         <div class="stats-label">Total Earnings</div>
                         <div class="stats-value">{{formatCurrency($feeSummery['totalEarning']) ?? ''}}</div>
                     </div>

                    

                     <div class="stats-detail">
                         <div class="stats-label">Average (P / Advertiser)</div>
                         <div class="stats-value">{{formatCurrency($feeSummery['averageEarning']) ?? 0}}</div>
                     </div>

                     <div class="stats-detail">
                         <div class="stats-label">Total Advertisers</div>
                         <div class="stats-value">{{$feeSummery['totalAdvertiser'] ?? 0}}</div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-lg-4">
             <div class="common-card">
                 <div class="card-top">
                     <div class="card-icon">
                         <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 5H7M14 5L20 5M14 5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5C10 6.10457 10.8954 7 12 7C13.1046 7 14 6.10457 14 5ZM10 12H16M16 12C16 13.1046 16.8954 14 18 14C19.1046 14 20 13.1046 20 12C20 10.8954 19.1046 10 18 10C16.8954 10 16 10.8954 16 12ZM4 12H7M11 19H20M6 17C7.10457 17 8 17.8954 8 19C8 20.1046 7.10457 21 6 21C4.89543 21 4 20.1046 4 19C4 17.8954 4.89543 17 6 17Z" stroke="#ff3c5f" stroke-width="2.088" stroke-linecap="round"></path> </g></svg>
                     </div>

                     <div class="card-heading">
                         <h2>Report Filters</h2>
                     </div>
                 </div>

                 <hr class="custom-hr">
                 <div class="common-stars common-form">
                     <div class="stats-detail">
                         <div class="stats-label">
                             Current FY
                         </div>
                         <div class="stats-value">
                            <select class="form-control" disabled>
                               
                                <option value="{{$feeSummery['selectedFY'] ?? ''}}">{{$feeSummery['selectedFY'] ?? ''}}</option>
                             
                            </select>   
                         </div>
                     </div>

                     <div class="stats-detail">
                         <div class="stats-label">Select FY</div>
                         <div class="stats-value">
                            <select class="form-control" id="select-fy" name="select-fy">
                                @foreach ($feeSummery['availableFYs'] as $year)
                                <option {{ request('fee_summery_advertiser_fy') == $year ? 'selected' : '' }} value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                     </div>

                     <div class="stats-detail">
                         <div class="stats-label">Display Type</div>
                         <div class="stats-value">
                             <select class="form-control" name="display_type" id="display_type">
                                     <option value="member_id"
                                         {{ request('display_type', 'member_id') == 'member_id' ? 'selected' : '' }}>
                                         Member ID</option>
                                     <option value="membership_type"
                                         {{ request('display_type') == 'membership_type' ? 'selected' : '' }}>
                                         Membership Type</option>
                                     <option value="highest_spend"
                                         {{ request('display_type') == 'highest_spend' ? 'selected' : '' }}>Highest Spend</option>
                                     <option value="lowest_spend"
                                         {{ request('display_type') == 'lowest_spend' ? 'selected' : '' }}>
                                         Lowest Spend</option>
                                     <option value="highest_fee"
                                         {{ request('display_type') == 'highest_fee' ? 'selected' : '' }}>
                                         Highest Fees</option>
                                     <option value="lowest_fee"
                                         {{ request('display_type') == 'lowest_fee' ? 'selected' : '' }}>
                                         Lowest Fees</option>
                                 </select>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="table-responsive my-4 common-card">
         <table class="table table-bordered">
             <thead class="bg-first">
                 <tr class="text-center">
                     <th colspan="3"><b>Advertisers</b></th>
                     <th colspan="6"><b>Advertisers Gross Spend (Year to Date)
                             Earnings
                         </b>
                     </th>
                     <th colspan="3"><b>Earnings</b></th>
                 </tr>
                 <tr class="text-center">
                     <th><b>Member ID</b></th>
                     <th><b>Advertiser</b></th>
                     <th><b>Joined</b> </th>
                     <th><b>Platinum</b></th>
                     <th><b>Gold</b></th>
                     <th><b>Silver</b></th>
                     <th><b>PinUp</b></th>
                     <th><b>Fixed</b></th>
                     <th><b>Total Spend</b></th>
                     <th><b>Fees</b></th>
                     <th><b>Action</b></th>
                 </tr>
                 <tr>
             </thead>
             <tbody id="appendFeesSummaryAdvertiseraa">
                 @foreach($feeSummery['earnings'] as $summery)
                 <tr>
                     <td class="text-left">{{$summery->member_id ?? ''}} </td>
                     <td class="text-left">{{$summery->advertiser_name ?? ''}}</td>
                     <td class="text-center">{{$summery->joined_date ?? ''}}</td>
                     <td class="text-right">{{formatCurrency($summery->platinum_spend) ?? ''}}</td>
                     <td class="text-right">{{formatCurrency($summery->gold_spend) ?? ''}}</td>
                     <td class="text-right">{{formatCurrency($summery->silver_spend) ?? ''}}</td>
                     <td class="text-right">{{formatCurrency($summery->pinup_spend) ?? ''}}</td>
                     <td>{{formatCurrency($summery->fixed_spend) ?? ''}} </td>
                     <td class="text-right">{{formatCurrency($summery->total_spend)}}</td>
                     <td class="text-right">{{formatCurrency($summery->fees)}}</td>
                     <td class="text-center">
                         <div class="dropdown no-arrow">
                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                             </a>
                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                 aria-labelledby="dropdownMenuLink" style="">
                                 <button type="button" class="dropdown-item d-flex align-items-center justify-content-start gap-10 view-advertiser-report" data-advertiser-id="{{$summery->user_id}}" data-advertiser-type="{{$summery->membership_type}}">
                                     <i class="fa fa-eye"></i> View Report
                                 </button>
                                 <div class="dropdown-divider"></div>
                                 <button type="button" class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                     data-toggle="modal" data-target="#">
                                     <i class="fa fa-print"></i> Print Report
                                 </button>
                             </div>
                         </div>
                     </td>
                 </tr>
                 @endforeach
                 {{-- <tr>
                     <td class="text-left">M612465</td>
                     <td class="text-left">Lin’s Massage</td>
                     <td class="text-center">01/01/2022</td>
                     <td> </td>
                     <td> </td>
                     <td> </td>
                     <td> </td>
                     <td class="text-right">$ 1,950.00</td>
                     <td class="text-right">$ 1,950.00</td>
                     <td class="text-right">$ 97.50</td>
                     <td class="text-center">
                         <div class="dropdown no-arrow">
                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                             </a>
                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                 aria-labelledby="dropdownMenuLink" style="">
                                 <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                     href="#" data-toggle="modal" data-target="#message-report"> <i
                                         class="fa fa-eye"></i> View Masseur Report
                                 </a>
                                 <div class="dropdown-divider"></div>
                                 <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                     href="#" data-toggle="modal" data-target="#"> <i class="fa fa-print"></i>
                                     Print Masseur Report</a>

                             </div>
                         </div>
                     </td>
                 </tr> --}}
             </tbody>
         </table>
     </div>
 </div>