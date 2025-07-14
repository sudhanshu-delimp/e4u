@extends('layouts.agent')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">

<style type="text/css">
    .select2-container .select2-choice, .select2-result-label {
        font-size: 1.5em;
        height: 52px !important; 
        overflow: auto;
    }

    .select2-arrow, .select2-chosen {
        padding-top: 6px;
    }

    span.select2.select2-container.select2-container--default > span.selection > span {
        height: 52px !important; 
    }
</style>

@endsection
@section('content')
<div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
         <!--middle content-->
         {{-- Page Heading   --}}
         <div class="row">
            <div class="custom-heading-wrapper col-lg-12">
               <h1 class="h1">Advertiser Profiles</h1>
               <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
            </div>
            <div class="col-md-12 mb-4">
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
            <div class="col-sm-12 col-md-12 col-lg-12">
               <!-- Begin Page Content -->
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
               <!-- /.container-fluid --><br>
               <div class="row">
                  <div class="col-md-12">
                     <div class="panel with-nav-tabs panel-warning">
                        <div class="panel-body">
                           <div class="tab-content">
                              <div class="tab-pane fade in active show" id="tab1warning">
                                 <div class="table-responsive-xl">
                                    <table class="table">
                                       <thead class="table-bg">
                                          <tr>
                                             <th scope="col">Member ID
                                             </th>
                                             <th scope="col">Name</th>
                                             <th scope="col">Location</th>
                                             <th scope="col">Revenue</th>
                                             <th scope="col">Mobile</th>
                                             
                                             
                                             <th scope="col">Home State</th><th scope="col">Contact Method</th><th scope="col">Action</th>
                                          </tr>
                                       </thead>
                                       <tbody class="table-content">
                                          <tr class="row-color">
                                             <td class="theme-color">E03153</td>
                                             <td class="theme-color">Carla Brasil</td>
                                             <td class="theme-color">WA</td>
                                             <td class="theme-color">Platinum</td>
                                             <td class="theme-color">0123456789</td>
                                             
                                             
                                             
                                             <td class="theme-color">SA</td><td class="theme-color">By email</td><td class="theme-color">
                                                <div class="dropdown no-arrow">
                                                   <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                   </a>
                                                   <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">

                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#replyticket">Create Profile</a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#viewticket">Edit Profile</a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#viewticket">Create Tour</a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#viewticket">Edit Tour</a>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                          
                                       </tbody>
                                    </table>
                                    <nav aria-label="Page navigation example">
                                       <ul class="pagination float-right pt-4">
                                          <li class="page-item">
                                             <a class="page-link" href="#" aria-label="Previous">
                                             <span aria-hidden="true">«</span>
                                             <span class="sr-only">Previous</span>
                                             </a>
                                          </li>
                                          <li class="page-item"><a class="page-link" href="#">1</a></li>
                                          <li class="page-item"><a class="page-link" href="#">2</a></li>
                                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                                          <li class="page-item">
                                             <a class="page-link" href="#" aria-label="Next">
                                             <span aria-hidden="true">»</span>
                                             <span class="sr-only">Next</span>
                                             </a>
                                          </li>
                                       </ul>
                                    </nav>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--middle content end here-->
            <!--right side bar start from here-->
         </div>
         <!--right side bar end-->
      </div>
        </div>
    </div>
</div>
@include('agent.dashboard.partials.playmates-modal')
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
    //$(document).ready( function () {
    var table = $('#myTable').DataTable({
        "language": {
            "zeroRecords": "No record(s) found."
        },
        processing: true,
        serverSide: true,
        lengthChange: true,
        order: [0,'asc'],
        searchable:false,
        //searching:false,
        bStateSave: false,

        ajax: {
            url: "{{ route('agent.escort.dataTable') }}",
            data: function (d) {
                d.type = 'player';
            }
        },
        columns: [
            { data: 'name', name: 'name', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'phone', name: 'phone', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'gender', name: 'gender', searchable: true, orderable:true,defaultContent: 'NA' },
            { data: 'plan_type', name: 'plan_type', searchable: true, orderable:true,defaultContent: 'NA' },
            { data: 'home_state', name: 'home_state', searchable: false, orderable:true,defaultContent: 'NA' },
            { data: 'age', name: 'age', searchable: false, orderable:true,defaultContent: 'NA' },
            { data: 'vaccine', name: 'vaccine', searchable: false, orderable:true,defaultContent: 'NA' },
            { data: 'action', name: 'action', searchable: false, orderable:false, defaultContent: 'NA' },
        ]
    });

    //} );

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click','.delete-center', function(e){
        e.preventDefault();
        var $this = $(this);
        var table = $('#myTable').DataTable();
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post({
                    type: 'POST',
                    url: $this.attr('href')
                }).done(function (data) {
                    if(data.error == 0)
                    {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Something went wrong!',
                          footer: '<a href="">Why do I have this issue?</a>'
                        })
                    }else {
                        swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        );

                        table.row( $this.parents('tr') ).remove().draw();
                    }


                });
            } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
                )
            }
        });
    });

    $('#play-mates-modal').on('shown.bs.modal', function (e) {

        var name, city, source = e.relatedTarget;

        $('#hidden_escort_id').val($(source).data('id'));

        if(name = $(source).data('name')) {
            $('#playmate-modal-name').html('Playmates for ' + $(source).data('name'));
        }

        if(city = $(source).data('city')) {
            $('#playmate-modal-location').html('<svg width="14" height="21" viewBox="0 0 14 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 10C6.33696 10 5.70107 9.73661 5.23223 9.26777C4.76339 8.79893 4.5 8.16304 4.5 7.5C4.5 6.83696 4.76339 6.20107 5.23223 5.73223C5.70107 5.26339 6.33696 5 7 5C7.66304 5 8.29893 5.26339 8.76777 5.73223C9.23661 6.20107 9.5 6.83696 9.5 7.5C9.5 7.8283 9.43534 8.15339 9.3097 8.45671C9.18406 8.76002 8.99991 9.03562 8.76777 9.26777C8.53562 9.49991 8.26002 9.68406 7.95671 9.8097C7.65339 9.93534 7.3283 10 7 10V10ZM7 0.5C5.14348 0.5 3.36301 1.2375 2.05025 2.55025C0.737498 3.86301 0 5.64348 0 7.5C0 12.75 7 20.5 7 20.5C7 20.5 14 12.75 14 7.5C14 5.64348 13.2625 3.86301 11.9497 2.55025C10.637 1.2375 8.85652 0.5 7 0.5V0.5Z" fill="#FF3C5F"></path></svg>' + $(source).data('city'));
        }

        $.ajax({
            url: $(source).data('url'),
            success: function (data) {
                $('#playmate-template').html(data);
            }
        });
    });

    $('#play-mates-modal').on('hidden.bs.modal', function () {
        $('#playmate-template').html('<div class="spinner-border text-secondary" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div>');
        $('#playmate-modal-name').html('');
        $('#playmate-modal-location').html('');
    });

    $('#search-playmate-input').select2({
        dropdownParent: $("#play-mates-modal"),
        width: '100%',
        dropdownCssClass: "bigdrop",
        placeholder: {
            id: 0, // the value of the option
            text: "{{ asset('assets/app/img/service-provider/Frame-408.png') }}",
            name: 'Search playmate',
            member_id: 'Type name or member id',
        },
        allowClear: true,
        language: {
            inputTooShort: function() {
                return 'Enter Member Id or Name';
            }
        },
        createTag: function(params) {
            var term = $.trim(params.term);

            if (term === '') {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: true // add additional parameters
            }
        },
        tags: false,
        minimumInputLength: 2,
        tokenSeparators: [','],
        ajax: {
            url: "{{ route('agent.playmates.find') }}",
            dataType: "json",
            type: "POST",
            data: function(params) {

                var queryParameters = {
                    query: params.term,
                    escort_id: $('#hidden_escort_id').val()
                }
                return queryParameters;
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {

                        return {
                            text: item.default_image,
                            name: item.name,
                            member_id: item.member_id,
                            id: item.id
                        }
                    })
                };
            }
        },
        templateResult: formatEscortList,
        templateSelection: formatEscortList
    });

    $('#search-playmate-input').on('change', function(e) {
        console.log('ll',$(this).val());
        if($(this).val()) {
            $('#playmate_submit_button').show();
        } else {
            $('#playmate_submit_button').hide();
        }
    });

    function formatEscortList (data) {
        console.log('ckjoiujk;',data);
        return $('<span><img class="profile-user-img img-responsive img-circle img-profile rounded-circle small-round-fixed" src="'+data.text+'"> '+data.name+' || '+data.member_id+'</span>');
    }

    $('#add-playmate-form').on('submit', function(e) {
        e.preventDefault();
        $('#playmate_submit_button').attr('disabled', true);
        $('#playmate_submit_button').html('<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>')
        var $this = $(this);
        var escort_id = $('#hidden_escort_id').val();
        var member_id = $('#search-playmate-input').val();
        var url = $this.attr('action');
        $.post({
            type: $this.attr('method'),
            url: url,
            data: {
                escort_id: escort_id,
                playmate_id: member_id
            },
            success: function (data) {
                $('#search-playmate-input').val('');
                $('#playmate_submit_button').hide();
                $('#playmate-template').html(data);
            },
            error: function (data) {
                console.log(data);
            },
        }).done(function (data) {
            $('#playmate_submit_button').attr('disabled', false);
            $('#playmate_submit_button').html('Add Playmate');

            //$("#search-playmate-input").select2("val", "");

            $("#search-playmate-input").empty().trigger('change')
        });
    });

    $(document).on('click', '.remove-playmate', function(e) {
        e.preventDefault();

        var $this = $(this);
        var escort_id = $this.data('escort_id');
        var playmate_id = $this.data('playmate_id');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Remove',
            cancelButtonText: 'Cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post({
                    type: 'POST',
                    url: "{{ route('agent.playmates.remove') }}",
                    data: {
                        escort_id: escort_id,
                        playmate_id: playmate_id
                    },
                }).done(function (data) {
                    if(data.error == 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message
                        });
                    } else {
                        swalWithBootstrapButtons.fire({
                            icon: 'success',
                            title: '',
                            text: data.message
                        });

                        $('#playmate-template').html(data.template);
                    }
                });
            }
        });
    });

</script>
@endpush
