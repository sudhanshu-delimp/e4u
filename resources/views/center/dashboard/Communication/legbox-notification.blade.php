
@extends('layouts.center')
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
          <div class="v-main-heading h3" style="display: inline-block;">
             <h1 class="p-0 m-0">Notifications - Viewers</h1>
          </div>
          <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></h6>
       </div>
       <div class="col-md-12 my-2">
          <div class="card collapse" id="notes" style="">
             <div class="card-body">
                <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                <ul>
                    <li>You can create a Notification shown at the top of Viewer Dashboards (who flagged you in Legbox).</li>
                    <li>Only Viewers who tagged you in their Legbox can view your Notification.</li>
                  </ul>
             </div>
          </div>
       </div>
    </div>
    <div class="row my-2">
       <!-- My Legbox -->
       <div class="col-md-12 mb-4">
          <div class="mb-3 d-flex align-items-center justify-content-between flex-wrap gap-10">
            <div class="form-group mb-0">
                <input type="text" class="form-control" placeholder="Search Notifications..." style="height: 45px;">
              </div>
              <div>
                <button class="btn btn-primary shadow-none create-tour-sec" data-toggle="modal" data-target="#notificationModal">+ Create Notification</button>
              </div>
          </div>

  <!-- Notifications Table -->
  <div class="table-responsive list-sec">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>Ref</th>
          <th>Start</th>
          <th>Finish</th>
          <th>Type</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>125</td>
          <td>08-06-2025</td>
          <td>09-06-2025</td>
          <td>Adhoc</td>
          <td>Published</td>
          <td class="action-icons">
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                    <a class="dropdown-item" href="#">Remove</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">View</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Print</a>
                </div>
             </div>
          </td>
        </tr>
        <tr>
          <td>124</td>
          <td>30-05-2025</td>
          <td>05-06-2025</td>
          <td>Template</td>
          <td>Published</td>
          <td class="action-icons">
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                    <a class="dropdown-item" href="#">Remove</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">View</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Print</a>
                </div>
             </div>
          </td>
        </tr>
        <tr>
          <td>123</td>
          <td>30-04-2025</td>
          <td>05-05-2025</td>
          <td>Template</td>
          <td>Completed</td>
          <td class="action-icons">
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                    <a class="dropdown-item" href="#">Remove</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">View</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Print</a>
                </div>
             </div>
          </td>
        </tr>
        <tr>
          <td>122</td>
          <td>18-05-2025</td>
          <td>18-05-2025</td>
          <td>Notice</td>
          <td>Removed</td>
          <td class="action-icons">
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                   <a class="dropdown-item" href="#">Remove</a>
                   <div class="dropdown-divider"></div>
                   <a class="dropdown-item" href="#">View</a>
                   <div class="dropdown-divider"></div>
                   <a class="dropdown-item" href="#">Print</a>
                </div>
             </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
       </div>
    </div>
    <!--middle content end here-->
 </div>

 <!-- Modal: Create Notification -->
 <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header create-tour-sec text-white">
          <h5 class="modal-title">Create Notification</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">×</button>
        </div>
        <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
          <form>
            <div class="form-group">
              <label>Date (Auto-generated)</label>
              <input type="text" class="form-control" value="30-06-2025" readonly>
            </div>
            <div class="form-group">
              <label>Heading</label>
              <input type="text" class="form-control font-weight-bold" placeholder="Enter heading...">
            </div>
            <div class="form-group">
              <label>Start Date</label>
              <input type="date" class="form-control">
            </div>
            <div class="form-group">
              <label>Finish Date</label>
              <input type="date" class="form-control">
            </div>
            <div class="form-group">
              <label>Type</label>
              <select class="form-control">
                <option value="adhoc">Adhoc</option>
                <option value="template">Template</option>
                <option value="notice">Notice</option>
              </select>
            </div>
            <div class="form-group">
              <label>Template</label>
              <select class="form-control">
                <option>Morning Special - 20% off all massages.</option>
                <option>We are open today.</option>
                <option>Holiday Special - 4 hands for the price of 2.</option>
                <option>Talk to our lovely Masseurs for anything special you need.</option>
                <option>Get a 10% discount if you mention you found us on E4U.</option>
              </select>
            </div>
            <div class="form-group">
              <label>Notice (Member ID)</label>
              <input type="text" class="form-control" placeholder="Enter Member ID if Notice">
            </div>
            <div class="form-group">
              <label>Content (max 250 characters)</label>
              <textarea class="form-control" maxlength="250" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary shadow-none create-tour-sec">Publish Notification</button>
          </form>
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


<script type="text/javascript">

    $('#userProfile').parsley({

    });



    $('#userProfile').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);

        if (form.parsley().isValid()) {

            var url = form.attr('action');
            var data = new FormData(form[0]);
            $.ajax({
                method: form.attr('method'),
                url: url,
                data: data,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (!data.error) {
                        $.toast({
                            heading: 'Success',
                            text: 'Details successfully saved',
                            icon: 'success',
                            loader: true,
                            position: 'top-right', // Change it to false to disable loader
                            loaderBg: '#9EC600' // To change the background
                        });

                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'Records Not update',
                            icon: 'error',
                            loader: true,
                            position: 'top-right', // Change it to false to disable loader
                            loaderBg: '#9EC600' // To change the background
                        });

                    }
                },

            });
        }
    });
    $('#city').select2({
        allowClear: true,
        placeholder :'Select City',
        createTag: function(params) {
            var term = $.trim(params.term);

            if (term === '') {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: false // add additional parameters
            }
        },
        tags: false,
        minimumInputLength: 2,
        tokenSeparators: [','],
        ajax: {
            url: "{{ route('city.list') }}",
            dataType: "json",
            type: "GET",
            data: function(params) {
                console.log(params);
                var queryParameters = {
                    query: params.term,
                    state_id: $('#state').val()
                }
                return queryParameters;
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {

                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            }
        }
    });

    $('#state').select2({
        allowClear: true,
        placeholder :'Select State',
        createTag: function(params) {
            var term = $.trim(params.term);

            if (term === '') {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: false // add additional parameters
            }
        },
        tags: false,
        minimumInputLength: 2,
        tokenSeparators: [','],
        ajax: {
            url: "{{ route('state.list') }}",
            dataType: "json",
            type: "GET",
            data: function(params) {
                console.log(params);
                var queryParameters = {
                    query: params.term,
                    country_id: $('#country').val()
                }
                return queryParameters;
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {

                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            }
        }
    });


    $('#country').on('change', function(e) {
        if($(this).val()) {
            $('#state').prop('disabled', false);
            $('#state').select2('open');
        } else {
            $('#state').prop('disabled', true);
        }
    });

    $('#state').on('change', function(e) {
        if($(this).val()) {
            $('#city').prop('disabled', false);
            $('#city').select2('open');
        } else {
            $('#city').prop('disabled', true);
        }
    });


</script>

@endpush
