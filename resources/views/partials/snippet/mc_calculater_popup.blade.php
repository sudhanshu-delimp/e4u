

<form name="membership_modal_popup" id="membership_modal_popup" method="post"> 
<div class="modal upload-modal fade" id="membershipModal_mc" tabindex="-1">
   <div class="modal-dialog modal-lg modal-dialog-centered">
     <div class="modal-content">
       
       <!-- Modal Header -->
       <div class="modal-header">
         <h5 class="modal-title text-white">
           <img src="{{ asset('assets/dashboard/img/add-profile.png') }}" class="custompopicon"> 
           Profile Ready Reckoner
         </h5>
         <button type="button" class="close" data-dismiss="modal">
           <span aria-hidden="true">
             <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
           </span>
         </button>
       </div>

       <!-- Modal Body -->
       <div class="modal-body">
        
           <div class="row g-3 mb-3">

               

                <div class="col-md-4">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" id="start_date_mc" name="start_date_mc" class="form-control">
                    <div class="invalid-feedback d-none">Start date is required or invalid.</div>                              
                </div>

                <div class="col-md-4">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" id="end_date_mc" name="end_date_mc" class="form-control">
                <div class="invalid-feedback d-none">End date is required or invalid.</div>
                </div>

                <div class="col-md-4">
                <label for="end_date" class="form-label">Number of Masseurs</label>
                <select  class="form-control" name="cal_members_mc" id="cal_members_mc">
                            @for($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                    </select>
                </div>


            </div>

    
           <div class="text-right">
             <button type="submit" name="submit" class="btn btn-primary create-tour-sec dctour m-0">Add</button>
           </div>

         
       </div>

     </div>
   </div>
</div>

</form>

