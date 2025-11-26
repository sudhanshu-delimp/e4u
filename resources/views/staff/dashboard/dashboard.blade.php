@extends('layouts.staff')
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
                        <li>Click the card to view information.</li> 
                        <li>Some features can be changed here as well as from the relevant subject page. Where
                                you make a change, the relevant subject page will be updated.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{route('staff.escort-listings')}}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/admin/escort-listings.png') }}" class="my-svg-icons" alt="Escort Listings">
                    </div>
                    <h2>
                        Escort Listings
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('staff.massage-centre-listings')}}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/admin/mcc.png') }}" class="my-svg-icons" alt="Massage Centre Listings">
                    </div>
                    <h2>
                        Massage Centre Listings
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{route('staff.pin-up-listings')}}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/admin/pinup.png') }}" class="my-svg-icons" alt="Pin Up Listings">
                    </div>
                    <h2>
                        Pin Up Listings
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{route('staff.agent-requests')}}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/admin/agent-requests.png') }}" class="my-svg-icons" alt=" Agent Requests">
                    </div>
                    <h2>
                        Agent Requests
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a  href="{{route('staff.registrations-reports')}}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/admin/registratios.png') }}" class="my-svg-icons" alt="Registrations">
                    </div>
                    <h2>
                        Registrations
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{route('staff.logged-in-users')}}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/admin/user-loged-in.png') }}" class="my-svg-icons" alt="Users Logged In">
                    </div>
                    <h2>
                        Users Logged In
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{route('staff.support-ticket.list')}}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/admin/support-tickets.png') }}" class="my-svg-icons" alt="Support Tickets">
                    </div>
                    <h2>
                        Support Tickets
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}

      
    </div>
</div>

@endsection
@section('script')
<script>
    
</script>
@endsection
