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
         <div class="v-main-heading h3" style="display: inline-block;">Search & Manage Reports</div>
          <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>
      </div>
      <div class="col-md-12 mt-4 mb-5">
         <div class="row collapse" id="notes">
            <div class="col-md-12 mb-4">
               <div class="card">
                  <div class="card-body">
                     <p><b>Notes:</b> </p>
                     <ul>
                        <li>You can view, edit or remove your submitted Reports.</li>
                        <li>Search by mobile number or scroll through pages.</li>
                        <li>Reports marked "Pending" are not visible to others until reviewed and published.</li>
                      </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="card mt-4">
            <div class="card-header table-bg text-white">
               Search Report by Mobile Number
            </div>
            <div class="card-body">
               <div class="container-fluid" style="padding: 0px 0px;">
                  <div class="row">
                     <div class="col-lg-4 col-md-12 col-sm-12">
                       
                        <form class="search-form-bg navbar-search">
                           <div class="input-group">
                              <input type="text" class="search-form-bg-i form-control border-0 small" placeholder="Search " aria-label="Search" aria-describedby="basic-addon2">
                              <div class="input-group-append">
                                 <button class="btn-right-icon" type="button">
                                 <i class="fas fa-search fa-sm"></i>
                                 </button>
                              </div>
                           </div>
                        </form>
                     </div>
                     
                  </div>
               </div>
          
              <!-- Reports Table -->
              <div class="table-responsive">
                <table class="table table-bordered table-hover mt-3">
                  <thead class="table-bg">
                    <tr>
                      <th>Mobile Number</th>
                      <th>Incident Nature</th>
                      <th>Status</th>
                      <th>Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-content">
                    <tr>
                      <td>0400123456</td>
                      <td>Time waster</td>
                      <td><span class="badge badge-warning p-2">Pending</span></td>
                      <td>01/07/2025</td>
                      <td>
                        <div class="dropdown no-arrow">
                           <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                           </a>
                           <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                               <a class="dropdown-item align-item-custom" href="#"> <i class="fa fa-edit"></i> Edit</a>

                               <div class="dropdown-divider"></div>

                               <a class="dropdown-item align-item-custom" href="#"> <i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                           </div>
                       </div>
                      </td>
                    </tr>
                    <!-- Add more rows dynamically -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          
      </div>
   </div>
   <!--middle content end here-->
</div>

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
