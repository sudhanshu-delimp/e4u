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
        selectable: true,
        select: (info) => alert(`Selected: ${info.startStr} → ${info.endStr}`),
        events: [
          { title: 'Standup', start: '2025-08-26T10:00:00' },
          { title: 'Design Review', start: '2025-08-28', end: '2025-08-29' },
          { title: 'Out of Office', start: '2025-09-02', color: '#999' }
        ]
      });
      calendar.render();
    });
  </script>
@endsection
