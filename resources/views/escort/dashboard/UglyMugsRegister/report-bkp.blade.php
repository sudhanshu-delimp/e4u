@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<style type="text/css">
   .parsley-errors-list {
   list-style: none;
   color: rgb(248, 0, 0)
   }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5">
   <!--middle content start here-->
   <div class="row">
      <div class="col-md-12">
         <div class="v-main-heading h3">Report a Mug</div>
      </div>
      <div class="col-md-12 mt-4 mb-5">
         <div class="row">
            <div class="col-md-12 mb-4">
               <div class="card">
                  <div class="card-body">
                     <p><b>Notes:</b> </p>
                     <p class="mb-1">The National Ugly Mug register (NUM) is a closed publication for Escorts only. Each entry contains personal reports, provided by Escorts, of incidents involving problem clients. The NUM makes these reports available to help other Escorts avoid problem clients, and as an extension of the "word of mouth" warnings given by Escorts between each other.</p>
                     <p>Escorts4U makes no claims:</p>
                     <ul style="padding-left: 1.8rem;">
                        <li>As to the accuracy or legitimacy of the allegations; and</li>
                        <li>Nor do we investigate the authenticity of the reports (provided in confidence by Escorts)</li>
                     </ul>
                     <p>The NUM is not to be used to make a complaint about another Escort.</p>
                  </div>
               </div>
            </div>
         </div>
         <form class=" ">
            <div class="row">
               <div class="col-md-7">
                  <h3><b>TODO:</b></h3>
                  <ul>
                     <li>Get user default values ✅</li>
                     <li>Make a proccessing script for the num reports</li>
                     <li>Error/Success messages</li>
                     <li>Name/ID lookup for offender (frosting on the cake.) ~</li>
                  </ul>
                  <div class="form-group w-75">
                     <label for="email"><b>Your ID</b> </label>
                     <input id="name" placeholder="Your ID" name="name" type="text" class="form-control">
                  </div>
                  <div class="form-group w-75">
                     <label for="email"><b>Your Name</b> </label>
                     <input id="name" placeholder="Your Name" name="name" type="text" class="form-control">
                  </div>
                  <div class="form-group w-75">
                     <label for="email"><b>When did this happen?</b><span style="color:red">*</span></label>
                     <input id="name" placeholder="Email" name="name" type="date" class="form-control">
                  </div>
                  <div class="form-group w-75">
                     <label for="email"><b>Where did this happen?</b> </label>
                     <input id="name" placeholder="Where did this happen?" name="name" type="text" class="form-control">
                  </div>
                  <div class="form-group w-75">
                     <label for="email"><b>Offenders Email</b></label>
                     <input id="name" placeholder="Offenders Email" name="name" type="text" class="form-control" >
                  </div>
                  <div class="form-group w-75">
                     <label for="email"><b>Offenders Name</b></label>
                     <input id="name" placeholder="Offenders Name" name="name" type="text" class="form-control">
                  </div>
                  <div class="form-group w-75">
                     <label for="email"><b>Offenders Mobile</b> <span style="color:red">*</span></label>
                     <input id="name" placeholder="Offenders Mobile" name="name" type="text" class="form-control">
                  </div>
                  <div class="form-group w-75">
                     <label for="exampleFormControlTextarea1"><b>What happened?</b></label>
                     <textarea class="form-control" placeholder="Max 500 Characters..." rows="3"></textarea>
                  </div>
                  <div class="form-group w-75">
                     <input type="submit" value="Submit Report" class="new-btn-sec btn btn-primary shadow-none" name="submit">
                  </div>
               </div>
               <div class="col-md-5">
                  <h3><b>Don't know their details? Look them up</b></h3>
                  <button type="button" class="e4u-modal-open mt-2" data-toggle="modal" data-target="#exampleModal">
                  Search for an offender
                  <i class="fa fa-search" aria-hidden="true"></i>
                  </button>
               </div>
            </div>
         </form>
      </div>
   </div>
   <!--middle content end here-->
</div>
<div class="modal fade upload-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Find a Viewer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
            </button>
         </div>
         <div class="modal-body">
            <div class="row pl-3">
               <div class="col-md-6">
                  <div class="form-group mb-2 pt-2">
                     <label for="staticEmail2"><b>Search</b></label>
                  </div>
                  <div class="form-group mb-2">
                     <input type="text" name="name" required="" data-parsley-required-message=" Please enter Tour Name" class="form-control mb-2" id=" " placeholder=" " value="" data-parsley-errors-container="#Tname">
                     <i>Find a Viewer with their Username, ID or Mobile number</i>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="card-body pt-2" style="
                     ">
                     <p class="mb-0"><b>Selected User </b></p>
                     <table id="myTable" class="table table-striped dataTable no-footer border-0" width="100%" role="grid" aria-describedby="myTable_info" style="">
                        <tbody>
                           <tr role="row" class="border-0 bg-transparent
                              ">
                              <td class="border-0 pb-0 pl-0 text-black">ID:</td>
                              <td class="border-0 pb-0 text-black">261</td>
                           </tr>
                           <tr role="row" class="border-0 bg-transparent
                              ">
                              <td class="border-0 pb-0 pl-0 text-black">Name:</td>
                              <td class="border-0 pb-0 text-black">Juli</td>
                           </tr>
                           <tr role="row" class="border-0 bg-transparent
                              ">
                              <td class="border-0 pb-0 pl-0 text-black">Mobile:</td>
                              <td class="border-0 pb-0 text-black">0987654321</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="col-md-12">
                  <table style="width: 100%;background: #0C223D;color: #fff;">
                     <tbody>
                        <tr>
                           <th class="p-2">ID</th>
                           <th class="p-2">Name</th>
                           <th class="p-2">Mobile</th>
                        </tr>
                        <tr>
                           <td class="p-2">Magazzini</td>
                           <td class="p-2">Giovanni</td>
                           <td class="p-2">Italy</td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-primary">Continue</button>
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
