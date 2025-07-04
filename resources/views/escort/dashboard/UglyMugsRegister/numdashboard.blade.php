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
    .parsley-type {
        color: #e5365a;
        text-transform: capitalize;
        font-size: small;
    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5">
   <!--middle content start here-->
   <div class="row">
      <div class="col-md-12">
         <div class="v-main-heading h3" style="display: inline-block;">NUM Dashboard</div>
          <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>
      </div>
      <div class="col-md-12 mt-4 mb-5">
         <div class="row collapse" id="notes">
            <div class="col-md-12 mb-4">
               <div class="card">
                  <div class="card-body">
                     <p><b>Notes:</b> </p>
                     <ul>
                        <li>The National Ugly Mugs register (NUM) is a free service to all Escorts. You can use the NUM service at any time. Your details, when you undertake a search, are kept confidential.</li>
                        <li>You can only search for an offender by their mobile number. Search your next booking by their mobile number itself, e.g. <code>0400123456</code>. Do not include any prefixes like +61 or spaces.</li>
                        <li>E4U makes no claims:
                          <ul>
                            <li>as to the accuracy or legitimacy of the allegations contained in a Report;</li>
                            <li>nor do we investigate the authenticity of the Reports (provided in confidence by Escorts).</li>
                          </ul>
                        </li>
                      </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="card" style="max-width: 800px;">
            <div class="card-header bg-primary text-white" style="background: #0c223d !important;">
              Search Offender
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="searchMobile" class="font-weight-bold">Mobile Number</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="searchMobile" placeholder="e.g. 0400 123 456" maxlength="10" pattern="\d*" style="height: 45px;border-right: 0;">
                  <div class="input-group-append">
                    <button class="save_profile_btn" type="button">Search</button>
                  </div>
                </div>
                <small class="form-text text-muted">Enter 10-digit mobile number to search offender details.</small>
              </div>
            </div>
          </div>
        </div>
      </div>
   </div>
   <!--middle content end here-->
</div>
{{--<div class="modal fade upload-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div>--}}
@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>

<script>
    $('#ugly_mug_registration').parsley({});

    $("#ugly_mug_registration").on('submit', function(e){
        e.preventDefault();

        var form = $(this);
        if (form.parsley().isValid()) {
            $("#submit").hide();
            $(".spinner-border").attr('hidden', false);
            var url = "{{route('escort.mug.register')}}";
            var data = new FormData(form[0]);
            $.ajax({
                method: 'POST',
                url: url,
                dataType: "json",
                data: data,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status) {
                        swal.fire(
                            'Ugly mug registration',
                            'Mug registered successfully',
                            'success'
                        );
                        form[0].reset();
                    } else {
                        swal.fire(
                            'Ugly mug registration',
                            'Oops.. something wrong Please try again',
                            'error'
                        );
                    }
                    $(".spinner-border").attr('hidden', true);
                    $("#submit").show();
                },

            });
        }
    });
</script>
@endpush
