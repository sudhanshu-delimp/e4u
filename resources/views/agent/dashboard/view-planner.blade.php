@extends('layouts.agent')
@section('style')
<style>
    .appointment-box h4{
        color: #0c223d;
        font-size: 25px;
    }
    .custom-calendar h2{
        color: #0c223d;
    }
    .fc-event {
    cursor: pointer !important;
    }
</style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        
        
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3 col-sm-12">
                        <div class="appointment-box my-1">
                            <div class="card shadow-sm py-4 px-5 text-center">
                                <h4>Appointments Today</h4>
                                <span id="summaryToday">0</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                        <div class="appointment-box my-1">
                            <div class="card shadow-sm py-4 px-5 text-center">
                                <h4>Appointments This Week</h4>
                                <span id="summaryWeek">0</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                        <div class="appointment-box my-1">
                            <div class="card shadow-sm py-4 px-5 text-center">
                                <h4>Appointments This Month</h4>
                                <span id="summaryMonth">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 my-5 custom-calendar">
                <div id="calendar"></div>
            </div>
        </div>
        <!-- Page Heading -->
    </div>  

    <!-- Appointment Detail Modal -->

    <div class="modal fade upload-modal" id="appointmentDetailModal" tabindex="-1" role="dialog"
    aria-labelledby="appointmentDetailModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-apointment-details" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="appointmentDetailModalLabel"><img src="{{ asset('assets/dashboard/img/view-ppointment.png') }}" class="custompopicon">Appointment Details </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body">
                <div id="appointmentDetailBody">
                    <div class="text-center py-4">Loading...</div>
                </div>
            </div>
            <div class="modal-body p-1 agent-tour">
                <div class="text-center" id="success_form_html">
                    <div class="modal-footer">
                        <button type="button" class="btn-success-modal" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
        initialView: 'dayGridMonth',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        navLinks: true,
        selectable: false,
        eventDisplay: 'block',
        displayEventTime: false,
       // editable: true,
        eventDurationEditable: false,
        snapDuration: '00:30:00',
        events: {
          url: '{{ route('agent.appointment.calendar.events') }}',
          method: 'GET',
          failure: function() {
            console.error('Failed to load calendar events.');
          }
        },
     
        eventClick: function(info) {
          info.jsEvent.preventDefault();
          const id = info.event.id;
          if (!id) return;
          $('#appointmentDetailBody').html('<div class="text-center py-4">Loading...</div>');
          $('#appointmentDetailModal').modal('show');
          var detailUrl = '{{ route('agent.appointment.details', ['id' => '___ID___']) }}'.replace('___ID___', id);
          $.ajax({
            url: detailUrl,
            method: 'GET',
            dataType: 'json',
            success: function(resp) {
                console.log(resp);
              if (!resp || resp.status !== true) {
                $('#appointmentDetailBody').html('<div class="text-danger">Failed to load details.</div>');
                return;
              }
              var d = resp.data || {};
              var ucfirst = function(s){ s = s || ''; return s.charAt(0).toUpperCase() + s.slice(1); };
              var html = '\
                <table class="table table-sm table-bordered mb-0">\
                  <tr><th style="width:30%">Date</th><td>'+(d.date || '')+'</td></tr>\
                  <tr><th>Time</th><td>'+(d.time || '')+'</td></tr>\
                  <tr><th>Advertiser</th><td>'+(d.advertiser || '')+'</td></tr>\
                  <tr><th>Address</th><td>'+(d.address || '')+'</td></tr>\
                  <tr><th>Point of Contact</th><td>'+(d.point_of_contact || '')+'</td></tr>\
                  <tr><th>Mobile</th><td>'+(d.mobile || '')+'</td></tr>\
                  <tr><th>Summary</th><td>'+(d.summary || '')+'</td></tr>\
                  <tr><th>Source</th><td>'+ucfirst(d.source)+'</td></tr>\
                  <tr><th>Status</th><td>'+ucfirst(d.status)+'</td></tr>\
                  <tr><th>Importance</th><td>'+ucfirst(d.importance)+'</td></tr>\
                  <tr><th>Created</th><td>'+(d.create_date || '')+'</td></tr>\
                </table>';
              $('#appointmentDetailBody').html(html);
            },
            error: function() {
              $('#appointmentDetailBody').html('<div class="text-danger">Failed to load details.</div>');
            }
          });
        }
      });
      calendar.render();
    });


    // append appointment count date
    function countAppointmentDate(){
        $.ajax({
            url: "{{route('agent.appointment.count.day.week.month')}}",
            type: "GET",
            dataType : 'json',
            success: function(response){
                console.log(response);
                $('#summaryToday').html(response.data.today_count);
                $('#summaryWeek').html(response.data.week_count);
                $('#summaryMonth').html(response.data.month_count);
            },
            error: function(xhr, status, error){
                console.error(error);
            }
        });
       
    }
    countAppointmentDate();

  </script>
@endsection
