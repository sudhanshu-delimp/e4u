@extends('layouts.agent')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
@endsection
@section('content')
<style type="text/css">
   .border {
   border: 1px solid #d1d3e2 !important;
   }
</style>
<div class="container-fluid pl-3 pl-lg-5">
   <!--middle content end here-->
   {{-- Page Heading   --}}
   <div class="row">
      <div class="d-flex align-items-center justify-content-start mt-5 flex-wrap col-lg-12">
         <h1 class="h1">Create Information Package</h1>
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
         <div class="row">
            <div class="col-md-12">
               <div class="col-md-12 mt-4 pl-0 pr-0">
                  <div class="row agent-tour">
                     <div class="col-md-4">
                        <div class="form-group">
                           <div class="input-group">
                              <input type="text" class="form-control small rounded-0 border-right-0" placeholder="Search " aria-label="Search" aria-describedby="basic-addon2">
                              <div class="input-group-append border">
                                 <button class="btn-right-icon bg-white" type="button">
                                 <i class="fas fa-search fa-sm"></i>
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <select class="custom-select rounded-0" name="membership" id="membership">
                              <option value="">Prospective Member</option>
                              <option value="1">Option 1</option>
                              <option value="2">Option 2</option>
                              <option value="3">Option 3</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <select class="custom-select rounded-0" name="membership" id="membership">
                              <option value="">Select Template</option>
                              <option value="1">Option 1</option>
                              <option value="2">Option 2</option>
                              <option value="3">Option 3</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="panel with-nav-tabs panel-warning">
                           <div class="panel-body">
                              <div class="tab-content">
                                 <div class="tab-pane fade in active show" id="tab1warning">
                                    <div class="card shadow-sm pb-4 rounded-0">
                                       <div class="card-body mb-1">
                                          <p class="mb-1 text-muted small">Cover Page</p>
                                          <p class="mb-0" style="font-size: 20px;"><b>Paul Logan</b> </p>
                                          <div class="table-responsive-xl">
                                             <table class="table">
                                                <tbody class="table-content">
                                                   <tr class="row-color mt-0">
                                                      <td class="font-weight-bold text-muted bg-white pl-0">Massage Centre:</td>
                                                      <td class="font-weight-normal text-muted bg-white">Candy Massage</td>
                                                   </tr>
                                                   <tr class="row-color mt-0">
                                                      <td class="font-weight-bold text-muted bg-white pl-0 pt-0">Email Address:</td>
                                                      <td class="font-weight-normal text-muted bg-white pt-0">paul@candymassage.com.au</td>
                                                   </tr>
                                                </tbody>
                                             </table>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="tab-pane fade" id="tab2warning">Mobile Sim Request</div>
                                 <div class="tab-pane fade" id="tab3warning">
                                    <div class="table-responsive-xl">Product Request</div>
                                 </div>
                                 <div class="tab-pane fade" id="tab4warning">
                                    <div class="table-responsive-xl">
                                       Login Attemps
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="panel with-nav-tabs panel-warning">
                           <div class="panel-body">
                              <div class="tab-content">
                                 <div class="tab-pane fade in active show" id="tab1warning">
                                    <div class="card shadow-sm rounded-0">
                                       <div class="card-body pb-0">
                                          <p class="mb-1 text-muted small">Page 1</p>
                                          <div class="table-responsive-xl">
                                             <table class="table">
                                                <tbody class="table-content">
                                                   <tr class="row-color mt-0">
                                                      <td class="font-weight-bold text-muted bg-white pl-0">Date:</td>
                                                      <td class="font-weight-normal text-muted bg-white">10-12-2022</td>
                                                   </tr>
                                                   <tr class="row-color mt-0">
                                                      <td class="font-weight-bold text-muted bg-white pl-0 pt-0">Massage Centre:</td>
                                                      <td class="font-weight-normal text-muted bg-white pt-0">paul@candymassage.com.au</td>
                                                   </tr>
                                                   <tr class="row-color mt-0">
                                                      <td class="font-weight-bold text-muted bg-white pl-0 pt-0">Address:</td>
                                                      <td class="font-weight-normal text-muted bg-white pt-0">910 Albany Highway East Victoria Park WA 610</td>
                                                   </tr>
                                                   <tr class="row-color mt-0">
                                                      <td class="font-weight-bold text-muted bg-white pl-0 pt-0">Salutation:</td>
                                                      <td class="font-weight-normal text-muted bg-white pt-0">Paul</td>
                                                   </tr>
                                                </tbody>
                                             </table>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="tab-pane fade" id="tab2warning">Mobile Sim Request</div>
                                 <div class="tab-pane fade" id="tab3warning">
                                    <div class="table-responsive-xl">Product Request</div>
                                 </div>
                                 <div class="tab-pane fade" id="tab4warning">
                                    <div class="table-responsive-xl">
                                       Login Attemps
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
      </div>
   </div>
</div>
@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
@endpush