
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
<div class="container-fluid">
<div class="col-md-10">
                <div class="row">
                      
         <div class="col-md-12">
            <div class="v-main-heading h3" style="display: inline-block;"><h1 class="p-0 m-0">Archives</h1></div>
            <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></h6>
         </div>
         <div class="col-md-12 my-4">
            <div class="card collapse" id="notes" style="">
               <div class="card-body">
                  <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                  <p></p>
                  <ol>
                        
                  </ol>
               </div>
            </div>
         </div>
            </div> 
        </div>
<div class="col-md-10">
<div class="row">
                                <div class="col-md-2">
                    <div class="card archive-sec">

                      <a href ="{{route('cen.archive.profile')}}">
                      <figure class="figure m-0">
  
  <img src="{{ asset('assets/dashboard/img/Vector.png') }}" class="figure-img img-fluid rounded" alt=" ">
  <figcaption class="figure-caption"><p>Profiles</p></figcaption>
</figure>
</a>
                    </div>
                </div>


<!-- <div class="col-md-2">
                    <div class="card archive-sec">
                      
                      <a href="{{route('cen.archive.tours')}}">
<figure class="figure m-0">
  <img src="{{ asset('assets/dashboard/img/Vector-blank.png') }}" class="figure-img img-fluid rounded" alt=" ">
  <figcaption class="figure-caption"><p>Tours</p></figcaption>
</figure>
</a>
                    </div>
                </div> -->

                <div class="col-md-2">
                    <div class="card archive-sec">
                      <a href="{{route('cen.archive-medias')}}">
                      <figure class="figure m-0">
  <img src="{{ asset('assets/dashboard/img/Vector-blank.png') }}" class="figure-img img-fluid rounded" alt=" ">
  <figcaption class="figure-caption"><p>Media</p></figcaption>
</figure>
</a>
                    </div>
                </div>
                <!-- <div class="col-md-2">
                    <div class="card archive-sec">
                      
                      <figure class="figure m-0">
  <img src="{{ asset('assets/dashboard/img/Vector-blank.png') }}" class="figure-img img-fluid rounded" alt=" ">
  <figcaption class="figure-caption"><a href="{{url('#')}}">Current Listings</a></figcaption>
</figure>
                    </div>
                </div> -->
                <!-- <div class="col-md-2">
                    <div class="card archive-sec">
                      
                      <figure class="figure m-0">

  <img src="{{ asset('assets/dashboard/img/Vector-blank.png') }}" class="figure-img img-fluid rounded" alt=" ">

  <figcaption class="figure-caption"><a href="#">History</a></figcaption>
</figure>
                    </div>
                </div> -->
                            </div></div>
                            
                            <div class="col-md-10 mt-4">
                <div id="accordion" class="myacording-design mb-5">

                  <div class="card">
                    <div class="card-header">
                      <a class="card-link" data-toggle="collapse" href="#additional_information">
                        Guidelines
                      </a>
                    </div>
                    <div id="additional_information" class="collapse" data-parent="#accordion">
                      <div class="card-body pl-0 arch-acrd">
                        <div class="form-group">
                      <h5>Profiles &amp; Media Storage</h5>
<p>All of your Profiles and Media are stored here. When editing a Profile or Tour or uploading
Media, select:</p>
                    </div>
<ul class="mb-0">
                            <li>Your Profile by going to the folder Location the Profile is stored in</li>
                            
                        <li>Your Tour by going to the ‘Current Listings’ folder </li><li> The relevant Media folder to upload or remove photos and video, or to verified your photos</li></ul>
<h5 class="pt-2">Managing your Archive Folder</h5>
<div class="form-group">
<p>Things you should know:</p>
                    </div>

<ul class="mb-0">
<li>Create multiple folders to store your Profiles and Media in</li>
<li>Your Home State folder is your default folder where you store your first Profile</li>
<li>Copy your Home State Profile to create other Profiles or just use the Profile creator</li>
<li>Move your folders around into a convenient order. Your Home State folder will always
remain at the front of the folders</li>
<li>Any Profile or Media you delete will be stored in your ‘History’ folder. Deleted Profiles
and Media are stored in your History folder for 6 months and then deleted
permanently</li>
<li>Any folder you delete will be permanently deleted including all content</li>
</ul>

<div class="form-group pt-2">
<p>Some Profile & Tour tips:</p>
                    </div>
<ul class="mb-0">                 
<li>Name your Profile folder after a Location - ‘NSW’ or ‘ACT or ‘WA’’</li>
<li>Name your Profiles after the city within the Location folder - ‘Sydney01' and Sydney02’ or ‘Canberra01’ and ‘Canberra02’ or ‘Perth01’ and ‘Perth02’</li>
<li>When you create a Tour folder, by default the folder will be labeled ‘Tours [year]’</li>
</ul>

<div class="form-group pt-2">
<p>Some Media tips:</p>
                    </div>

<ul class="mb-0">                 
<li>Label your photo images and video after an event</li>
<li>Get your photo images verified by E4U</li>
<li>Name your image that you select to appear in your Profile that displays on the Search
Page ‘Thumbnail’</li>
</ul>

<h5 class="pt-2">How to verify your Media (Photos and Videos)
</h5>
<p>To get the best results with your Viewers for when they are looking at your Profile we
recommend you get your Media verified by us. The E4U Verification Icon will indicate to
Users that your Media within your Profile is authentic.</p>
<p>It is a simple process to follow from within the Archive Folder. To authenticate any of your
Media we require you to:</p>

<ul class="mb-0">
<li> Open ‘Profiles & Archives - Media’ and select Photos.</li>
<li> Upload your photos and click the ‘Verify Media’ button.</li>
<li> Upload your identification you are relying on to verify your photos. Acceptable forms
of identification include:</li>
<ul style="list-style: outside;">
    <li>Two (2) selfies with your User Name and Membership ID printed (can be hand
written) on a sheet of paper held up to the side of you and not obscuring any part of
you</li>
<li> A drivers licence which matches your User Name and Home State </li>
<li> A passport which matches your User Name and Home State </li>
</ul>
<li>Repeat the above procedure for video, opening ‘Profiles & Archives - Media’ and
select Videos. </li>
</ul>

<p class="mt-4">Please Note: </p>
<ul>
<li>Your identification images will not be available as Media in any Profile.</li>
<li>Any fake photo uploaded for verification will disqualify the remaining photos for
verification. We will notify you and request you replace the fake photo.</li>
<li>A Viewer can undertake a reverse image search and may report your Profile to us as a
Profile with fake Media. Your Profile may be suspended where this occurs.</li>
</ul>
                      </div>
                    </div>
                  </div>        

                </div>
            </div>
</div>

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
            { data: 'profile_name', name: 'profile_name', searchable: false, orderable:true ,defaultContent: 'NA'},
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
        console.log($(source).data('url'));
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
