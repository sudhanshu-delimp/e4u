@extends('layouts.admin')
@section('content')
@section('style')
<style>
    .setup-influencer button.btn-add {
    padding: 5px 15px;
    border-radius: 0px 5px 5px 0px !important;
    font-size: 14px !important;
}
    .setup-influencer .remove-btn{
    padding: 5px 15px;
    border-radius: 0px 5px 5px 0px !important;
    font-size: 14px !important;
    }
     .setup-influencer .remove-btn i{

    color: #fff;
     }
     .setup-influencer .btn-add i{

    color: #fff;
     }
     .setup-influencer td{

     }
     .setup-influencer .table th{
        border: 1px solid #e3e6f0;
     }
</style>
@endsection


<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    {{-- Page Heading --}}
    <div class="row">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1">Manage Influencers</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <p class="notes"><b>Notes:</b> </p>
                    <ol>
                        <li>Approve the appointment of Influencers here.
                        </li>
                        <li>Manage the status of Influencers.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}

    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12 mt-2">
                    <div class="table-responsive">
                              <table class="table mb-3 w-100" id="ManageInfTable">
                                 <thead class="table-bg">
                                    <tr>
                                    <th scope="col">Member ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Agent (if applicable)</th>
                                    <th scope="col">Home State</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Appointed</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody class="table-content">
                                       <tr>
                                          <td>E60458</td>
                                          <td>Mary</td>
                                          <td>Wayne Primrose</td>
                                          <td>Western Australia</td>
                                          <td>0438 028 728</td>
                                          <td>mary@gmail.com </td>
                                          <td>12-12-2024</td>
                                          <td>Pending</td>
                                          <td>
                                             <div class="dropdown no-arrow">
                                                 <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                     <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                 </a>
                                                 <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-144px, 20px, 0px);" x-placement="bottom-end">
                                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-target="#editInfluencer" data-toggle="modal"> 
                                                    <i class="fa fa-pen"></i> Edit </a>

                                                   <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-target="#setUp" data-toggle="modal"> 
                                                        <i class="fa fa-wrench"></i> Set Up</a>

                                                    <div class="dropdown-divider"></div>

                                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#">   <i class="fa fa-ban"></i> Suspend</a>
                                                    <div class="dropdown-divider"></div>
                                                   
                                                   
                                                    <a class="dropdown-item view-account-btn d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#viewInfluencer">  <i class="fa fa-eye "></i> View Account</a>
                                                </div>
                                             </div>
                                         </td>
                                       </tr>
                                 </tbody>
                                 <tfoot class="bg-first">
                                    <tr>
                                        <th colspan="3" class="text-left">Server time: <span>10:23:51 am</span></th>
                                        <th colspan="3" class="text-center">Refresh time:<span>seconds</span></th>
                                        <th colspan="3" class="text-right">Up time: <span>214 days & 09 hours 12 minutes</span></th>
                                    </tr>
                                </tfoot>
                              </table>
                           </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- Set up fluencer --}}
<div class="modal fade upload-modal" id="setUp" tabindex="-1" role="dialog" aria-labelledby="setUpLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title"> <img src="{{ asset('assets/dashboard/img/influencer.png')}}" class="custompopicon"> Set Up Influencers</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body setup-influencer">
            <form id="influencerForm">
                <div class="row">                   

                    <div class="col-6 mb-3">
                        <input type="text" class="form-control rounded-0" placeholder="Member ID">
                    </div>

                    <div class="col-6 mb-3">
                        <input type="text" class="form-control rounded-0" placeholder="Name" required>
                    </div>

                    <div class="col-6 mb-3">
                        <input type="text" class="form-control rounded-0" placeholder="Agent Name (if applicable)">
                    </div>

                    <div class="col-6 mb-3">
                        <input type="text" class="form-control rounded-0" placeholder="Home State" required>
                    </div>

                    <div class="col-6 mb-3">
                        <input type="text" class="form-control rounded-0" placeholder="Mobile" required>
                    </div>

                    <div class="col-6 mb-3">
                        <input type="email" class="form-control rounded-0" placeholder="Email" required>
                    </div>

                    <div class="col-12 mb-3">
                        <textarea class="form-control rounded-0" placeholder="Comments" rows="3"></textarea>
                    </div>

                    <!-- Social Media -->
                    <div class="col-12 mb-2">
                        <label for="smedia">Social Media Addresses</label>
                    
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="text" class="form-control rounded-0" placeholder="Social Media URL">
                            </div>
                            <div class="input-group-append">
                                <button class="btn-add" type="button" onclick="addSocialField()">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            
                        </div>
                    </div>
                    
                    

                   <div class="col-12 p-0">
                     <div id="socialContainer"></div>
                   </div>

                    <!-- Fee Discount -->
                    <div class="col-12 mb-3">
                        <label>Fee Discount</label>
                        <select class="form-control rounded-0">
                            <option value="">Select Discount</option>
                            <!-- 5.00% to 10.00% step 0.50 -->
                            <option>5.00%</option>
                            <option>5.50%</option>
                            <option>6.00%</option>
                            <option>6.50%</option>
                            <option>7.00%</option>
                            <option>7.50%</option>
                            <option>8.00%</option>
                            <option>8.50%</option>
                            <option>9.00%</option>
                            <option>9.50%</option>
                            <option>10.00%</option>
                        </select>
                    </div>

                    <!-- Membership Type -->
                    <div class="col-6 mb-3">
                        <label>Membership Type</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="membership" checked>
                            <label class="form-check-label">Platinum</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="membership">
                            <label class="form-check-label">Gold</label>
                        </div>
                    </div>

                    <!-- E4U Stamp -->
                    <div class="col-6 mb-3">
                        <label>E4U Stamp</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="e4u" checked>
                            <label class="form-check-label">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="e4u">
                            <label class="form-check-label">No</label>
                        </div>
                    </div>

                </div>

                <!-- Footer Buttons -->
                <div class="modal-footer p-0 pl-2 pb-4">
                    <button type="button" class="btn-success-modal mr-2" onclick="window.print()">Print</button>
                    <button type="submit" class="btn-success-modal">Save & Close</button>
                </div>
            </form>

         </div>
      </div>
   </div>
</div>
{{-- end --}}

{{-- Set up edit Influencer --}}
<div class="modal fade upload-modal" id="editInfluencer" tabindex="-1" role="dialog" aria-labelledby="editInfluencerLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title"> <img src="{{ asset('assets/dashboard/img/influencer.png')}}" class="custompopicon"> Edit Account</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body setup-influencer">
           <form id="influencerEditForm">
            <div class="row">

                <!-- Read-only fields -->
                <div class="col-6 mb-3">
                    <input type="text" class="form-control rounded-0" placeholder="Member ID" readonly>
                </div>

                <div class="col-6 mb-3">
                    <input type="text" class="form-control rounded-0" placeholder="Name" readonly>
                </div>

                <div class="col-6 mb-3">
                    <input type="text" class="form-control rounded-0" placeholder="Agent Name (if applicable)" readonly>
                </div>

                <div class="col-6 mb-3">
                    <input type="text" class="form-control rounded-0" placeholder="Home State" readonly>
                </div>

                <div class="col-6 mb-3">
                    <input type="text" class="form-control rounded-0" placeholder="Mobile" readonly>
                </div>

                <div class="col-6 mb-3">
                    <input type="email" class="form-control rounded-0" placeholder="Email" readonly>
                </div>

                <div class="col-12 mb-3">
                    <textarea class="form-control rounded-0" placeholder="Comments" rows="3" readonly></textarea>
                </div>

                <!-- Social Media (view only) -->
                <div class="col-12 mb-3">
                    <label>Social Media Addresses</label>
                    <input type="text" class="form-control rounded-0 mb-2" placeholder="Social Media URL" readonly>
                    <input type="text" class="form-control rounded-0" placeholder="Social Media URL" readonly>
                </div>

                <!-- Editable: Fee Discount -->
                <div class="col-12 mb-3">
                    <label>Fee Discount</label>
                    <select class="form-control rounded-0">
                        <option value="">Select Discount</option>
                        <option>5.00%</option>
                        <option>5.50%</option>
                        <option>6.00%</option>
                        <option>6.50%</option>
                        <option>7.00%</option>
                        <option>7.50%</option>
                        <option>8.00%</option>
                        <option>8.50%</option>
                        <option>9.00%</option>
                        <option>9.50%</option>
                        <option>10.00%</option>
                    </select>
                </div>

                <!-- Editable: Membership Type -->
                <div class="col-6 mb-3">
                    <label for="membership">Membership Type</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" 
                            name="membership" id="membershipPlatinum" checked>
                        <label class="form-check-label" for="membershipPlatinum">
                            Platinum
                        </label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" 
                            name="membership" id="membershipGold">
                        <label class="form-check-label" for="membershipGold">
                            Gold
                        </label>
                    </div>
                </div>

                <!-- Editable: E4U Influencer Stamp -->
                <div class="col-6 mb-3">
                    <label>E4U Influencer Stamp</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" 
                            name="e4u" id="e4uYes" checked>
                        <label class="form-check-label" for="e4uYes">
                            Yes
                        </label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" 
                            name="e4u" id="e4uNo">
                        <label class="form-check-label" for="e4uNo">
                            No
                        </label>
                    </div>
                </div>

            </div>

            <!-- Footer Buttons -->
            <div class="modal-footer p-0 pl-2 pb-4">
                <button type="submit" class="btn-success-modal">Update</button>
            </div>
        </form>



         </div>
      </div>
   </div>
</div>
{{-- end --}}

{{-- Set up view Influencer --}}
<div class="modal fade upload-modal" id="viewInfluencer" tabindex="-1" role="dialog" aria-labelledby="viewInfluencerLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title"> <img src="{{ asset('assets/dashboard/img/influencer.png')}}" class="custompopicon"> View Account</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body setup-influencer view_staff_details">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">

                    <tbody>
                        <tr>
                            <th>Member ID</th>
                            <td>123456</td>
                        </tr>

                        <tr>
                            <th>Name</th>
                            <td>John Doe</td>
                        </tr>

                        <tr>
                            <th>Agent Name</th>
                            <td>Agent XYZ</td>
                        </tr>

                        <tr>
                            <th>Home State</th>
                            <td>California</td>
                        </tr>

                        <tr>
                            <th>Mobile</th>
                            <td>+1 234 567 890</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>john@example.com</td>
                        </tr>

                        <tr>
                            <th>Comments</th>
                            <td>
                                This is a sample comment added for view-only mode.
                            </td>
                        </tr>

                        <tr>
                            <th>Social Media Addresses</th>
                            <td>
                                https://instagram.com/xyz <br>
                                https://twitter.com/xyz
                            </td>
                        </tr>

                        <tr>
                            <th>Fee Discount</th>
                            <td>5.00%</td>
                        </tr>

                        <tr>
                            <th>Membership Type</th>
                            <td>Platinum</td>
                        </tr>

                        <tr>
                            <th>E4U Stamp</th>
                            <td>Yes</td>
                        </tr>
                    </tbody>

                </table>
            </div>

            <!-- Footer Button -->
            <div class="modal-footer p-0 pl-2 pb-4 mt-2">
                <button type="button" class="btn-success-modal" onclick="window.print()">Print</button>
            </div>
         </div>
      </div>
   </div>
</div>
{{-- end --}}
@endsection
@section('script')
<!-- opr_accordian_table JS -->
<script src="{{ asset('assets/dashboard/vendor/jquery/jquery.min.js') }}"></script>


<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
function addSocialField() {
    const container = document.getElementById('socialContainer');

    const div = document.createElement('div');
    div.className = 'row w-100 m-0 align-items-center mb-2';

    div.innerHTML = `
        <div class="col-12">
             <div class="input-group">
                            <div class="custom-file">
                                <input type="text" class="form-control rounded-0" placeholder="Social Media URL">
                            </div>
                            <div class="input-group-append">
                                <button class="btn-cancel-modal remove-btn" type="button" onclick="removeSocialField(this)"><i class="fa fa-times"></i></button>
                            </div>
                        </div>    
        </div>
        
    `;

    container.appendChild(div);
}

function removeSocialField(el) {
    el.closest('.row').remove();
}
</script>



<script>
    var table = $("#ManageInfTable").DataTable({
        language: {
            search: "Search: _INPUT_",
            searchPlaceholder: "Search by Member ID"
        },
        info: true,
        paging: true,
        lengthChange: true,
        searching: true,
        bStateSave: true,
        order: [
            [1, 'desc']
        ],
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],
        pageLength: 10,

           columns: [
               { data: 'member_id', name: 'member_id', searchable: true, orderable:true ,defaultContent: 'NA'},
               { data: 'name', name: 'name', searchable: true, orderable:true ,defaultContent: 'NA'},
               { data: 'agent', name: 'agent', searchable: true, orderable:false ,defaultContent: 'NA'},
               { data: 'territory', name: 'territory', searchable: true, orderable:true ,defaultContent: 'NA'},
               { data: 'mobile', name: 'mobile', searchable: true, orderable:true,defaultContent: 'NA' },
               { data: 'email', name: 'email', searchable: true, orderable:true,defaultContent: 'NA' },
               { data: 'appointed', name: 'appointed', searchable: true, orderable:true,defaultContent: 'NA' },
               { data: 'status', name: 'status', searchable: false, orderable:true,defaultContent: 'NA' },
               { data: 'action', name: 'edit', searchable: false, orderable:false, defaultContent: 'NA', class:'text-center' },
           ],
    });
</script>
@endsection
