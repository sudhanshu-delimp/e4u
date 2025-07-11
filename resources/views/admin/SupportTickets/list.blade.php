@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<style type="text/css">
.conversation {
    display: inline-block;
    margin-bottom: 15px;
}
.adminMessage, .userMessage {
        padding: 10px;
        border-radius: 10px;
    }
.userMessage {
        background-color: lightgray;
    }
    .adminMessage {
        background-color: #ff3c5fc9;
        color: white;
    }
    .message_time {
        font-size: 10px;
        position: absolute;
        right: 5%;
        /*bottom: 0;*/
    }
    .modal-body {
        min-height: 200px;
    }
    .messageBox {
        border-radius: 10px;
    }
    .change_status button {
        color: #000;
        font-size: 13px;
        border: 1px solid;
        border-radius: 3px;
        padding: 10px 15px;
    }
    .custom-tabale-layout #supportTicketsTable_length {
        float: right;
    }
    .custom-tabale-layout #supportTicketsTable_length select {
        width: 100px;
    }
    .custom-tabale-layout #supportTicketsTable_filter input{
        margin-left: 10px;
    }
    .dataTables_paginate{
        float: right;
    }
    #supportTicketsTable_info{
        float: left;
    }
</style>
@endsection
@section('content')
<div class="d-flex flex-column container-fluid pl-3 pl-lg-5">
    <div class="row">
        <div class="col-md-12">
            <div class="v-main-heading h3" style="display: inline-block;">My Support Tickets</div>
           <h6 class="helpNoteLink" data-toggle="collapse" data-target="#profile_and_tour_options"><b>Help?</b> </h6>
        </div>
        <div class="col-md-12 mt-4 collapse" id="profile_and_tour_options">
            <div class="row">
                <div class="col-md-12 mb-5">
                    <div class="card" id="notes">
                        <div class="card-body">
                          <h3 class="NotesHeader"><b>Notes:</b> </h3>
                          <ol>
                              <li>Use this feature to review and make changes to your Profiles.</li>
                              <li>You can view and edit a Profile by selecting 'Action'. By selecting the Action function, you will be able to View, Edit or Delete the Profile.</li>
                              <li>To suspend a Profile listing go to <a href="/escort-dashboard/listings/upcoming" class="custom_links_design">View Listings</a></li>
                          </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="content">
        <div class="container-fluid">
        </div>
        <!-- /.container-fluid --><br>
        <div class="row">
            <div class="col-md-12">
                <div class="box-body table table-hover custom-tabale-layout">
                    <table class="table table-hover" id="supportTicketsTable">
                        <thead id="table-sec" class="table-bg">
                        <tr>
                            <th> ID</th>
                            <th>Ticket ID</th>
                            <th>Member ID</th>
                            <th>Department</th>
                            <th>Priority</th>
                            <th>Service Type</th>
                            <th>Subject</th>
{{--                            <th>Message</th>--}}
                            <th>Date Created</th>
                            <th>Status</th> 
                            <!--<th>Joined E4U</th>-->
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <!--middle content end here-->
  <!--right side bar start from here-->
</div>



<div class="modal fade upload-modal" id="conversation_modal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLongTitle" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable"
         role="document"> {{--NOTE:: use  modal-dialog-scrollable instead of modal-dialog to make body scrollable only--}}
        <div class="modal-content" style="width: 900px;position: absolute;">
            {{-- {{ route('escort.upload.gallery') }} --}}
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="ticket_name">Support Ticket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}"
                                                      class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 conv-main" id="conv-main">

                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid;">
                    <form id="sendMessage">
                        <textarea class="messageBox" name="message" id="message" rows="4" cols="50" required></textarea>
                        <button class="btn btn-info" id="submit_message">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('script')
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
    var ticketId = 0;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


   $(document).ready( function () {
       var table = $("#supportTicketsTable").DataTable({
           "language": {
               "zeroRecords": "No record(s) found."
           },
           processing: true,
           serverSide: true,
           lengthChange: true,

           searchable:false,
           //searching:false,
           bStateSave: false,

           ajax: {
               url: "{{ route('admin.support-ticket.dataTable') }}",
               data: function (d) {
                   d.type = 'player';
               }
           },
           columns: [
               { data: 'id', name: 'id', searchable: true, orderable:true ,defaultContent: 'NA'},
               { data: 'ref_number', name: 'ref_number', searchable: true, orderable:true ,defaultContent: 'NA'},
               { data: 'member_id', name: 'member_id', searchable: true, orderable:false ,defaultContent: 'NA'},
               { data: 'department', name: 'department', searchable: true, orderable:true ,defaultContent: 'NA'},
               { data: 'priority', name: 'priority', searchable: true, orderable:true ,defaultContent: 'NA'},
               { data: 'service_type', name: 'service_type', searchable: false, orderable:true ,defaultContent: 'NA'},
               { data: 'subject', name: 'start_date', searchable: true, orderable:true,defaultContent: 'NA' },
               // { data: 'message', name: 'enabled', searchable: false, orderable:true,defaultContent: 'NA' },
               { data: 'created_on', name: 'date_created', searchable: false, orderable:true,defaultContent: 'NA' },
               { data: 'status', name: 'status', searchable: false, orderable:true,defaultContent: 'NA' },
               { data: 'action', name: 'edit', searchable: false, orderable:false, defaultContent: 'NA' },
           ],
           order: [6, 'desc'],
       });


       $(document).on('click', ".view_ticket", function() {
        
           ticketId = $(this).closest('tr').find('td:first').html();
           $("#conv-main").html('');
           $("#sendMessage").parent().show()
           $.ajax({
               method: "GET",
               url: "{{ route('admin.support-ticket.conversations') }}" + '/' + ticketId,
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               success: function (data) {
                     console.log(data.status_id);
                    if(data.status_id == 3 || data.status_id == 4) {
                    $("#sendMessage").parent().hide();
                    }

                   var modalHeading = "<b>"+data.subject+'</b> - '+ date_time_format(data.created_on )+'<br>'+
                   "<span>"+data.user.name+'</span> ( '+ data.user.member_id +')';
                   
                   $("#ticket_name").html(modalHeading);
                   var html =
                       // '<div class="col-sm-6 conversation"> </div>' +
                               '<div class="col-sm-6 conversation">' +
                               '    <div class="userMessage">' +
                                '       <p>'+data.message+'</p>'+
                                '   </div>'+
                       '       <span class="message_time">'+date_time_format(data.created_on)+'</span>'+
                                '</div>'+
                       '<div class="col-sm-6 conversation"> </div>';
                   $(data.conversations).each(function( index, conversation ) {
                       if(conversation.admin_id) {
                           html +=// '<div class="col-sm-6 conversation"> </div>' +
                               '<div class="col-sm-6 conversation"> </div>' +
                               '<div class="col-sm-6 conversation">' +
                               '    <div class="adminMessage">' +
                               '       <p>'+conversation.message+'</p>'+
                               '   </div>'+
                               '       <span class="message_time">'+date_time_format(conversation.date_time)+'</span>'+
                               '</div>';
                       } else {
                           html +=
                               // '<div class="col-sm-6 conversation"> </div>' +
                               '<div class="col-sm-6 conversation">' +
                               '    <div class="userMessage">' +
                               '       <p>'+conversation.message+'</p>'+
                               '   </div>'+
                               '       <span class="message_time">'+date_time_format(conversation.date_time)+'</span>'+
                               '</div>'+
                               '<div class="col-sm-6 conversation"> </div>';
                       }
                   });
                   $("#conv-main").html(html);
               }
           })
       });
   });

    $("#submit_message").on('click', function (e) {
        e.preventDefault();
        var message = $("#message").val();

        let data = {
            'title' : 'Please wait...',
            'message' : 'your reply is sending.',
        }

        swal_waiting_popup(data);

        $.ajax({
            method: "POST",
            dataType: "json",
            data: {
                ticketId: ticketId,
                message: message
            },
            url: "{{ route('admin.support-ticket.saveMessage') }}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                if(data.status == "success") {
                    Swal.fire(
                        'Message Sent!',
                        'Your message sent successfully',
                        'success'
                    );
                    $("#conversation_modal").modal('hide');
                    $("#sendMessage")[0].reset();
                } else {
                    Swal.close();
                    Swal.fire(
                        'Oops!',
                        'Error while saving the message',
                        'error'
                    );
                }
            }
        });
        // $("#sendMessage").reset();
    });
   /*$(document).on('click','.delete-center', function(e){
       e.preventDefault();
       var $this = $(this);
       $("#Lname").html("<p>Would you like to Delete?</p>");

       $('#delete_profile').modal('show');

       $("#save_change").click(function(e){
           console.log($this.attr('href'));
           $.ajax({
                   method: "POST",
                   url:$this.attr('href'),
                   contentType: false,
                   processData: false,
                   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                   success: function (data) {
                       location.reload();
                   }

           })
       });*/


    $(document).on('click', '.change-status-btn', function(e) {
    e.preventDefault();
    if (confirm('Are you sure you want to change the status?')) {
        let id = $(this).data('id');
        let status = $(this).data('status');
        change_status(id, status);
    }
    });

    function change_status(id, status_id) {
        $.ajax({
            method: "PUT",
            dataType: "json",
            url: "{{ route('support-ticket.status.update', [':id', ':status_id']) }}".replace(':id',id).replace(':status_id',status_id),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
            if(data.status == "success") 
            {
                Swal.fire('Ticket Status!', data.message, 'success');
                setTimeout(function() {
                location.reload();
                }, 3000);
            } 
            else 
            {
            Swal.fire('Oops!', data.message, 'error');
            }
            }
        });
        return false;
    }
</script>
@endpush
