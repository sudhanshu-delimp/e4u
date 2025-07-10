@extends('layouts.escort')
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
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-9">
                        <!-- Begin Page Content -->
                        <div class="container-fluid" style="padding: 0px 0px;">
                            <!-- Page Heading -->
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Archives</h1>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-6">
                                    <div class="archive-box">
                                        <a href="{{ route('escort.archives.profile-folder')}}">
                                            <img class="img-fluid hide-on-hover" src="{{ asset('/assets/dashboard/img/folder-img.png') }}">
                                            <img class="img-fluid show-on-hover" src="{{ asset('/assets/dashboard/img/folder-img-hover.png') }}">
                                            <span>Profiles</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-6">
                                    <div class="archive-box">
                                        <a href="{{ route('escort.archives.media-folder')}}">
                                            <img class="img-fluid hide-on-hover" src="{{ asset('/assets/dashboard/img/folder-img.png') }}">
                                            <img class="img-fluid show-on-hover" src="{{ asset('/assets/dashboard/img/folder-img-hover.png') }}">
                                            <span>Media</span>
                                        </a>
                                    </div>
                                </div><div class="col-lg-2 col-md-2 col-sm-6">
                                    <div class="archive-box">
                                        <a href="#">
                                            <img class="img-fluid hide-on-hover" src="{{ asset('/assets/dashboard/img/folder-img.png') }}">
                                            <img class="img-fluid show-on-hover" src="{{ asset('/assets/dashboard/img/folder-img-hover.png') }}">
                                            <span>Current Listings</span>
                                        </a>
                                    </div>
                                </div><div class="col-lg-2 col-md-2 col-sm-6">
                                    <div class="archive-box">
                                        <a href="#">
                                            <img class="img-fluid hide-on-hover" src="{{ asset('/assets/dashboard/img/folder-img.png') }}">
                                            <img class="img-fluid show-on-hover" src="{{ asset('/assets/dashboard/img/folder-img-hover.png') }}">
                                            <span>History</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                             <div class="col-lg-12 col-md-12 col-sm-12">
                                <div id="accordion">
                                    <div class="card">
                                        <div class="card-header guidline-div" id="headingOne" style="background: none;border: none;"> 
                                        <h5 class="mb-0">
                                            <button class="btn btn-link guidline" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                             Guidelines
                                            </button>
                                        </h5>
                                        </div>

                                        <div id="collapseOne" class="guid-line-para collapse show" aria-labelledby="headingOne" data-parent="#accordion" style="background: none;border: none;">
                                        <div class="card-body">
                                            <h6 class="guidline-bold guidline-bold">Profiles & Media Storage</h6>
                                            All of your Profiles and Media for your business and Masseurs are stored here. When editing a Profile or uploading Media, select:

                                            <ul>
                                                <li> Either Massage Centre or Masseur and the relevant Masseur sub-folder the Profile is stored in. The same applies to Media</li>
                                                <li> You can edit a posted Profile by going to the ‘Current Listings’ folder</li>
                                                <li> The relevant Media folder for the Massage Centre or Masseur to upload or remove photos and video, or to verify Masseur photos</li>
                                            </ul>

                                            <h6 class="guidline-bold guidline-bold">Things you should know:</h6>
                                            All of your Profiles and Media for your business and Masseurs are stored here. When editing a Profile or uploading Media, select:

                                            <ul>
                                                <li> Create multiple folders to store your Masseur Profiles and Media in</li>
                                                <li> Copy your Profile to create other Profiles or just use the Profile creator</li>
                                                <li> If you create two or more Massage Centre Profiles, use a good naming convention like your Location ‘Perth01’ and ‘Perth02’</li>
                                                <li >Move your Masseur folders around into a convenient order. </li>
                                                <li> Any Profile or Media you delete will be stored in your ‘History’ folder. Deleted Profiles and Media are stored in your History folder for 6 months and then deleted
permanently</li>
                                                <li> Any folder you delete will be permanently deleted including all content (like a Masseur Profile folder)</li>
                                                 
                                            </ul>
                                           
                                            Some Profile & Tour tips:

                                            <ul>
                                                <li> Create a Masseur Profile and Media folder for each Masseur. Much easier to manage when creating your Massage Centre Profile </li>
                                                <li> Name your Masseur Profiles and Media folders after the Masseur’s Profile Name, like ‘Coco’ and ‘Lisa’</li>
                                            </ul>

                                            Some Media tips:

                                            <ul>
                                                <li> Label your Masseurs photo images and videos after the Masseur’s name</li>
                                                <li> Get your Masseur photo images verified by E4U</li>
                                                <li> Name your image that you select to appear across the top of your Profile ‘Banner’ and your image that appears in the Profile that displays on the Search Page ‘Thumbnail’</li>
                                            </ul>


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
                    <div class="col-sm-12 col-md-12 col-lg-3">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('escort.dashboard.partials.playmates-modal')
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
            url: "{{ route('escort.list.dataTable') }}",
            data: function (d) {
                d.type = 'player';
            }
        },
        columns: [
            { data: 'key', name: 'key', searchable: false, orderable:true ,defaultContent: 'NA'},
            { data: 'name', name: 'name', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'city_name', name: 'city_name', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'phone', name: 'phone', searchable: true, orderable:true,defaultContent: 'NA' },
            { data: 'start_date_parsed', name: 'start_date_parsed', searchable: true, orderable:true,defaultContent: 'NA' },
            { data: 'enabled', name: 'enabled', searchable: false, orderable:true,defaultContent: 'NA' },
            { data: 'action', name: 'edit', searchable: false, orderable:false, defaultContent: 'NA' },
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
            url: "{{ route('escort.playmates.find') }}",
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
                    url: "{{ route('escort.playmates.remove') }}",
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
