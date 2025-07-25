@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style>
    .swal-button {
    background-color: #242a2c;
    }
</style>
@stop
@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
            <!--middle content start here-->
            <!--middle content end here-->
            <div class="row">
                <div class="custom-heading-wrapper col-md-12">                    
                    <h1 class="h1">My Account  </h1>
                    <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" style="font-size:16px"><b>Help?</b> </span>
                </div>
                <div class="mb-4 col-md-12">
                    <div class="card collapse" id="notes">
                      <div class="card-body">
                          <h3 class="NotesHeader"><b>Notes:</b> </h3>
                          <ol>
                            <li>Your Advertiser's Profile Information will pre-populate any Massage Profile you create</li>
                            <li>Select your preferred method of contact by a Viewer for your Massage Profiles</li>
                          </ol>
                      </div>
                    </div>
                </div>
                
                <!-- ALERT MESSAGE -->
                <div class="col-md-12 mb-3">
                  <div id="formAlert" class="alert d-none rounded" role="alert"></div>
                </div>
                <div class="col-md-12 mb-5">
                    <div id="accordion" class="myacording-design">
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link collapsed" data-toggle="collapse" href="#about_me" aria-expanded="false">
                                About us
                                </a>
                            </div>
                            <div id="about_me" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body">
                                    <form id="userProfile" class="v-form-design" action="{{ route('admin.account.update',[$escort->id])}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-10 px-0">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                          <label for="email" class="my-agent">Display name </label>
                                                            <input type="text" class="form-control" placeholder=" " name="name" aria-describedby="emailHelp" value="{{ $escort->name }}">
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">Your address</label>
                                                            <input type="text" class="form-control" placeholder=" " name="" aria-describedby="emailHelp" value="">
                                                        </div>
                                                    </div> --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <label class="form-control form-back">{{ $escort->email }}</label>

                                                            {{-- <input type="text" class="form-control" placeholder=" " name="email" aria-describedby="emailHelp" value="{{ $escort->email }}"> --}}
                                                            <input type="hidden"  value="{{ $escort->email }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                           <label for="email">Gender </label>
                                                            <select class="form-control" name="gender">
                                                              @foreach(config('escorts.profile.genders') as $key => $gender)
                                                                  <option value="{{$key}}" {{$key == $escort->gender ? 'selected' : ''}}>{{$gender}}</option>
                                                              @endforeach
                                                              </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">Mobile</label>
                                                            <span class="form-control form-back">{{ $escort->phone }}</span>
                                                            {{-- <input type="text" class="form-control" placeholder=" " name="phone" aria-describedby="emailHelp" value="{{ $escort->phone }}"> --}}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="Gender" class="my-agent">Home State <img src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}"></label>
                                                            <label  class="form-control form-back" placeholder="Western Australia" aria-describedby="emailHelp" id="stateNew" name="state_id" value="{{$escort->state_id}}">
                                                              {{ $escort->state_id ? config('escorts.profile.states')[$escort->state_id]['stateName'] : ''}}
                                                          </label>
                                                            {{-- <select class="form-control" name="state_id">
                                                            @foreach(config('escorts.profile.states') as $key => $state)
                                                                <option value="{{$key}}" {{$key == $escort->state_id ? 'selected' : ''}}>{{$state['stateName']}}</option>
                                                            @endforeach
                                                            </select> --}}
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" value="save" class="btn btn-primary shadow-none float-right" name="submit">
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card">
                            <div class="card-header">
                                <a class="card-link collapsed" data-toggle="collapse" href="#profile_and_tour_options" aria-expanded="false">
                                Profile contact options
                                </a>
                            </div>
                            <div id="profile_and_tour_options" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body">
                                    <form class="v-form-design">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="email">How can Viewers contact me</label>
                                                    <div class="switch-sec">
                                                        <label class="switch">
                                                        <input type="checkbox" checked="">
                                                        <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                    <div class="pt-1"><i>When creating a Massage Profile, your Profile settings are by default set to your My Account information. You can over ride those settings in the Profile creator, or disable them here.
                                                        </i>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">How can Viewers contact us</label><br>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="Method_Message" value="option1">
                                                        <label class="form-check-label" for="Method_Message">Call us</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="Method_Text" value="option1">
                                                        <label class="form-check-label" for="Method_Text">Text us</label>
                                                    </div>
                                                    <div class="pt-1"><i>You can select both options if you want.</i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" value="Save Contact Options" class="btn btn-primary shadow-none float-right" name="submit">
                                    </form>
                                </div>
                            </div>
                        </div> --}}
                      </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span> </span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
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
    // new
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
            var alertBox = $('#formAlert');

            if (!data.error) {
              alertBox
                .removeClass('d-none alert-danger')
                .addClass('alert-success')
                .html('Preference updated successfully.');
            } else {
              alertBox
                .removeClass('d-none alert-success')
                .addClass('alert-danger')
                .html('Oops... something went wrong. Please try again.');
            }

            // Optional: Auto-hide after 4 seconds
            setTimeout(function() {
              alertBox.addClass('d-none');
            }, 10000);
          },
        });
      }
    });
    // end

    // old 
    // $('#userProfile').on('submit', function(e) {
    //   e.preventDefault();
    
    //   var form = $(this);
    
    //   if (form.parsley().isValid()) {
    
    //     var url = form.attr('action');
    //     var data = new FormData(form[0]);
    //     $.ajax({
    //       method: form.attr('method'),
    //       url: url,
    //       data: data,
    //       contentType: false,
    //       processData: false,
    //       headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //       },
    //       success: function(data) {
    //         if (!data.error) {
    //           $('.Lname').html("Saved");
    //           //$("#my_account_modal").modal('show');
    //           $("#my_account_modal").show();
    //           //
    //         } else {
    //           $('.Lname').html("Oops.. sumthing wrong Please try again");
    //           $("#my_account_modal").show();
    
    //         }
    //       },
    
    //     });
    //   }
    // });
    $("#close").click(function()
      {
          $("#my_account_modal").hide();
          location.reload();
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