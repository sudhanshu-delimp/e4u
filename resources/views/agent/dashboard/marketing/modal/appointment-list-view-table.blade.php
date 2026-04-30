  

  @foreach ($centers as $item)
  <li class="list-group-item d-flex justify-content-between align-items-center">
      <div>
          <h6 class="mb-1">{{$item["bussiness_name"] ?? ''}}</h6>
          <small class="text-muted">{{$item['address'] ?? ''}}</small>
      </div>
      <a href="{{ route('agent.my.appointment.list') }}#new_appointment_model" target="_blank" class="btn-appointment">Make
          Appointment
       </a>
  </li>
  @endforeach
