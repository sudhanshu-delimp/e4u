@extends('layouts.staff')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<style type="text/css">
.conversation {
    display: inline-block;
    margin: 10px 0px;
}
    .change_status button {
        color: #000;
        font-size: 13px;
        border: 1px solid;
        border-radius: 3px;
        padding: 10px 15px;
    }
    
    .custom-tabale-layout #supportTicketsTable_length {
        float: left;
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
    #supportTicketsTable td  {
          text-align: center;
    }
</style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <div class="row">
            <div class="d-sm-flex align-items-center justify-content-between col-md-12">
                <div class="custom-heading-wrapper">
                    <h1 class="h1">Support Tickets</h1>
                    <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b>
                    </h6>
                </div>
                 @if (request('from') !== 'sidebar')
            <div class="back-to-dashboard">
                <a href="{{ url()->previous() ?? route('staff.dashboard.home') }}">
                    <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                </a>
            </div>
             @endif 
            </div>
            <div class="col-md-12 mb-4" id="profile_and_tour_options">
                <div class="card collapse" id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>Use this feature to review and make changes to your Profiles.</li>
                            <li>You can view and edit a Profile by selecting 'Action'. By selecting the Action function, you will be able to View, Edit or Delete the Profile.</li>
                            <li>To suspend a Profile listing go to <a href="/escort-dashboard/listings/upcoming" class="custom_links_design">View Listings.</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box-body table-responsive custom-tabale-layout">
                    <table class="table table-hover" id="supportTicketsTable">
                        <thead id="table-sec" class="table-bg">
                            <tr>
                                <th> ID</th>
                                <th>Ticket ID</th>
                                <th>Member ID</th>
                                <th>Department</th>
                                <!-- <th>Priority</th> 
                                <th>Service Type</th>-->
                                <th>Subject</th>
                                <th>Date Created</th>
                                <th>Status</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                <div>
            </div>
        </div>
    </div>

<div class="modal fade upload-modal center" id="conversation_modal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLongTitle" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable"
         role="document"> {{--NOTE:: use  modal-dialog-scrollable instead of modal-dialog to make body scrollable only--}}
        <div class="modal-content" style="width: 900px;position: absolute; top:50px;">
            {{-- {{ route('escort.upload.gallery') }} --}}
            <div class="modal-content border-0">
                <div class="modal-header">
                    <span class="custom-pop-wrapper"><img src="/assets/app/img/history.png" class="custompopicon" alt="cross"><h5 class="modal-title" id="ticket_name">Support Ticket</h5></span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}"
                                                      class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body my-custom-modal-body" >
                    <div class="row">
                        <div class="col-sm-12 conv-main" id="conv-main">

                        </div>
                    </div>
                </div>
                <div class="reply-wrapper p-3">
                    <form id="sendMessage">
                       <div class="reply-message-box">
                        <textarea class="messageBox" name="message" id="message" rows="4" required></textarea>
                        <input type="hidden" name="reference_id" id="reference_id" >
                        <button class="btn-cancel-modal py-3" id="submit_message">Send</button>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Change Status Popup Popup -->
    <div class="modal fade upload-modal" id="statusConfirmModal" tabindex="-1" role="dialog" aria-labelledby="statusConfirmModallabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <img src="{{ asset('assets/dashboard/img/complete-appointment.png') }}" alt="Change Status Popup" class="custompopicon"> Change Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0 agent-tour">
                    <form method="post" id="task_form" action="#">
                        <div class="row" id="task_form_button">
                            <div class="col-md-12 mb-3">
                                <h4 id="task_desc">Are you sure you want to change the status?</h4>                        
            
                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-end">
                                                                    
                                        <div>                                        
                                            <button type="button" class="btn-cancel-modal" data-dismiss="modal" aria-label="Close" id="cancel_button">No</button>
                                            <button type="submit" class="btn-success-modal" id="confirmYes" >Yes</button>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>  
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
{{-- end --}}
@endsection
@push('script')
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
    var table;
    var ticketId = 0;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


   $(document).ready( function () {
        table = $("#supportTicketsTable").DataTable({
           "language": {
               "zeroRecords": "No record(s) found.",
               "searchPlaceholder": "Search by Ticket ID",
           },
           processing: true,
           serverSide: true,
           lengthChange: true,

           searchable:false,
           //searching:false,
           bStateSave: false,

           ajax: {
               url: "{{ route('staff.support-ticket.dataTable') }}",
               data: function (d) {
                   d.type = 'player';
               }
           },
           columns: [
               { data: 'id', name: 'id', searchable: true, orderable:true ,defaultContent: 'NA'},
               { data: 'ref_number', name: 'ref_number', searchable: true, orderable:true ,defaultContent: 'NA'},
               { data: 'member_id', name: 'member_id', searchable: true, orderable:false ,defaultContent: 'NA'},
               { data: 'department', name: 'department', searchable: true, orderable:true ,defaultContent: 'NA'},
              // { data: 'priority', name: 'priority', searchable: true, orderable:true ,defaultContent: 'NA'},
              // { data: 'service_type', name: 'service_type', searchable: false, orderable:true ,defaultContent: 'NA'},
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
           reference_id = $(this).closest('tr').find('td:eq(1)').html();
           //console.log('reference_id',reference_id);
           $('#reference_id').val(reference_id);
           let resolved = "";
           $("#conv-main").html('');
           $("#sendMessage").parent().show()
           $.ajax({
               method: "GET",
               url: "{{ route('staff.support-ticket.conversations') }}" + '/' + ticketId,
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               success: function (data) {
                     console.log(data.status_id);
                    if(data.status_id == 3 || data.status_id == 4) {
                    $("#sendMessage").parent().hide();
                    }
                    else
                    {
                    $("#sendMessage").parent().show();
                    }


                    if(data.status=='Resolved' || data.status=='Withdrawn')
                    {
                        if(data.status=='Resolved')
                        {
                        message = 'This Ticket is now resolved';
                        }
                        else
                        {
                        message = 'This Ticket has been withdrawn'; 
                        }

                        resolved = `<div class="col-sm-12 text-center complete_ticket mt-3" style="font-weight: 700; font-size: 20px;color: green;"> ${message}</div>`
                    }

                   var modalHeading = "<b>"+data.subject+'</b> - '+ date_time_format(data.created_on );
                   
                   $("#ticket_name").html(modalHeading);
                   var html =
                       // '<div class="col-sm-6 conversation"> </div>' +
                               '<div class="col-sm-6 conversation">' +
                               '    <div class="userMessage">' +
                                '       <p>'+data.message+'</p>'+
                                '   </div>'+
                       '       <span class="message_time"> Member ID: '+data.user.member_id+',  '+date_time_format(data.created_on)+'</span>'+
                       
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
                               '       <span class="message_time"> Member ID: '+conversation.user_from_admin.member_id+',   '+date_time_format(conversation.date_time)+'</span>'+
                               '</div>';
                       } else {
                           html +=
                               // '<div class="col-sm-6 conversation"> </div>' +
                               '<div class="col-sm-6 conversation">' +
                               '    <div class="userMessage">' +
                               '       <p>'+conversation.message+'</p>'+
                               '   </div>'+
                                '       <span class="message_time">Member ID: '+conversation.user_from_user.member_id+',   '+date_time_format(conversation.date_time)+'</span>'+
                               '</div>'+
                               '<div class="col-sm-6 conversation"> </div>';
                       }
                   });
                   $("#conv-main").html(html);
                    if(data.status=='Resolved' || data.status=='Withdrawn')
                    {
                    $('#conv-main').append(resolved);
                    }
               }
           })
       });
   });

    $("#submit_message").on('click', function (e) {
        e.preventDefault();
        var message = $("#message").val();
        var reference_id = $("#reference_id").val();

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
                message: message,
                reference_id:reference_id
            },
            url: "{{ route('staff.support-ticket.saveMessage') }}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                if(data.status == "success") {
                    Swal.fire(
                        'Message Sent!',
                        'Your message has been successfully sent.',
                        'success'
                    );
                    $("#conversation_modal").modal('hide');
                    $("#sendMessage")[0].reset();
                } else {
                    Swal.close();
                    Swal.fire(
                        'Oops!',
                        'Error while saving the message.',
                        'error'
                    );
                }
            }
        });
        // $("#sendMessage").reset();
    });




    $(document).on('click', '.change-status-btn', async function(e) {
    e.preventDefault();
     if (await isConfirm({ 'title' : 'NA','action': 'Change ','text':'Are you sure to change the status ?'})) { 
        let id = $(this).data('id');
        let status = $(this).data('status');
        change_status(id, status);
    }
    });


    


    function change_status(id, status_id) {
        $.ajax({
            method: "PUT",
            dataType: "json",
            url: "{{ route('staff.support-ticket.status.update', [':id', ':status_id']) }}".replace(':id',id).replace(':status_id',status_id),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
            if(data.status == "success") 
            {
                Swal.fire('Ticket Status!', 'Changed as ' + data.message, 'success');
                table.ajax.reload(null, false);
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
