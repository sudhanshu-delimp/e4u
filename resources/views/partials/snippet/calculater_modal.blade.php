<div class="modal upload-modal fade" id="membershipModal" tabindex="-1">
   <div class="modal-dialog modal-lg modal-dialog-centered">
     <div class="modal-content">
       
       <!-- Modal Header -->
       <div class="modal-header">
         <h5 class="modal-title text-white">
           <img src="{{ asset('assets/dashboard/img/add-profile.png') }}" class="custompopicon"> 
           Profile / Tour Ready Reckoner
         </h5>
         <button type="button" class="close" data-dismiss="modal">
           <span aria-hidden="true">
             <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
           </span>
         </button>
       </div>

       <!-- Modal Body -->
       <div class="modal-body">
         <form>
           
           <!-- State -->
           <div class="row g-3 mb-3">

                <div class="col-md-4">
                    <label>Location</label>
                    <select id="state" name="state" class="form-control">
                    @foreach($states as $stateCode => $stateData)
                        <option value="{{ $stateCode }}">{{ $stateData['stateAbbr'] }}</option>
                    @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" name="cal_start_date" id="cal_start_date">
                    <div class="invalid-feedback d-none">Start date is required or invalid.</div>                              
                </div>

                <div class="col-md-4">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" id="end_date" name="end_date" class="form-control" name="cal_end_date" id="cal_end_date">
                <div class="invalid-feedback d-none">End date is required or invalid.</div>
                </div>


            </div>

           

           <!-- Start Date & End Date in one row -->
           <div class="row g-3 mb-3">
             
           </div>


           <!-- Start Date & End Date in one row -->
           <div class="row g-3 mb-3">
             <div class="col-md-6">
               <label for="start_date" class="form-label">Membership Type </label>
              <select  class="form-control" name="cal_memship_type" id="cal_memship_type">
                 @foreach($membership_types as $membership)
                 <option value="{{ $membership['id'] }}">{{ $membership['name'] }}</option>
                @endforeach  
            </select>
             </div>
             <div class="col-md-6">
               <label for="end_date" class="form-label">Profile</label>
               <select  class="form-control" name="cal_members" id="cal_members">
                  @foreach($no_of_members as $key => $members)
                  <option value="{{ $members }}">{{ $members }}</option>
                    @endforeach  
                </select>
             </div>
           </div>

        
           <!-- Save Button -->
           <div class="text-right">
             <button type="submit" class="btn btn-primary create-tour-sec dctour m-0">Add</button>
           </div>

         </form>
       </div>

     </div>
   </div>
</div>