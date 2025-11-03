@extends('layouts.operator')
@section('content')
@section('style')
@endsection


<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1">Dashboard</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4">
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

    <div class="row mb-4">
      
      {{-- box start --}}
      <div class="col-lg-4 box-wrapper">
          <div class="my-custom-box shadow-sm">
              <a href="#">
                  <div class="box-icon">
                      <img src="{{ asset('assets/dashboard/img/boxicon/operator/Message-Agent.png') }}" alt="Message Agent">
                  </div>
                  <h2>
                     Message Agent
                  </h2>
              </a>

          </div>
      </div>
      {{-- end --}}
      
      {{-- box start --}}
      <div class="col-lg-4 box-wrapper">
          <div class="my-custom-box shadow-sm">
              <a href="#">
                  <div class="box-icon">
                      <img src="{{ asset('assets/dashboard/img/boxicon/operator/Manage-Agents.png') }}" alt="Manage Agent">
                  </div>
                  <h2>
                     Manage Agent
                  </h2>
              </a>

          </div>
      </div>
      {{-- end --}}
      {{-- box start --}}
      <div class="col-lg-4 box-wrapper">
          <div class="my-custom-box shadow-sm">
              <a href="#">
                  <div class="box-icon">
                      <img src="{{ asset('assets/dashboard/img/boxicon/operator/Commission-Agents.png') }}" alt="Commission Agents">
                  </div>
                  <h2>
                    Commission Agents
                  </h2>
              </a>

          </div>
      </div>
      {{-- end --}}
      {{-- box start --}}
      <div class="col-lg-4 box-wrapper">
          <div class="my-custom-box shadow-sm">
              <a href="#">
                  <div class="box-icon">
                      <img src="{{ asset('assets/dashboard/img/boxicon/operator/Advertiser-Summary.png') }}" alt="Advertiser Summary">
                  </div>
                  <h2>
                     Advertiser Summary
                  </h2>
              </a>

          </div>
      </div>
      {{-- end --}}
      {{-- box start --}}
      <div class="col-lg-4 box-wrapper">
          <div class="my-custom-box shadow-sm">
              <a href="#">
                  <div class="box-icon">
                      <img src="{{ asset('assets/dashboard/img/boxicon/operator/Agent-Statistics.png') }}" alt="Agent Statistics ">
                  </div>
                  <h2>
                     Agent Statistics
                  </h2>
              </a>

          </div>
      </div>
      {{-- end --}}
      
      {{-- end --}}
      {{-- box start --}}
      <div class="col-lg-4 box-wrapper">
         <div class="my-custom-box shadow-sm">
             <a href="#">
                 <div class="box-icon">
                     <img src="{{ asset('assets/dashboard/img/boxicon/operator/Support-Tickets.png') }}" alt=" Support Tickets">
                 </div>
                 <h2>
                 Support Tickets
                 </h2>
             </a>

         </div>
     </div>
     {{-- end --}}
      {{-- box start --}}
      <div class="col-lg-4 box-wrapper">
          <div class="my-custom-box shadow-sm">
              <a href="#">
                  <div class="box-icon">
                      <img src="{{ asset('assets/dashboard/img/boxicon/operator/AMA-Earning.png') }}" alt="AMA Earnings">
                  </div>
                  <h2>
                      AMA Earnings
                  </h2>
              </a>

          </div>
      </div>
  </div>
</div>

@endsection
@section('script')
<script>
    
</script>
@endsection
