@extends('layouts.shareholder')
@section('content')
@section('style')
@endsection


<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!-- Page Heading -->
    <div class="row">
        <div class="cal-lg-12 w-100">
            @if ($agentNotifications)
                @foreach ($agentNotifications as $notification)
                    <x-global.notification-alert :heading="$notification['heading']" :content="$notification['content'] ?? $notification['template_name']" type="success" />
                @endforeach
            @endif
        </div>
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
                <a href="{{ route('shareholder.registrations') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/admin/registratios.png') }}"
                            alt="Registrations">
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
                <a href="{{ route('shareholder.revenue') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/center/our-spend.png') }}" alt="Revenue">
                    </div>
                    <h2>
                        Revenue
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
                        <img src="{{ asset('assets/dashboard/img/boxicon/operator/Commission-Agents.png') }}"
                            alt="Revenue Summary">
                    </div>
                    <h2>
                        Revenue Summary
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('shareholder.escort-listings') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/operator/Commission-Agents.png') }}"
                            alt="Global Monitoring Escorts">
                    </div>
                    <h2>
                        Global Monitoring Escorts
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('shareholder.escort-statistics') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/icon_escort-statistics.png') }}"
                            alt="Escort Statistics">
                    </div>
                    <h2>
                        Escort Statistics
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('shareholder.massage-centre-statistics') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/center/masseurs-statistics.png') }}"
                            alt="Massage Centre Statistics">
                    </div>
                    <h2>
                        Massage Centre Statistics
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}

        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('shareholder.directors') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/operator/Support-Tickets.png') }}"
                            alt="Directors">
                    </div>
                    <h2>
                        Directors
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('shareholder.shareholders') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/operator/AMA-Earning.png') }}"
                            alt="Share Registry">
                    </div>
                    <h2>
                        Share Registry
                    </h2>
                </a>

            </div>
        </div>
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('shareholder.submit') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/operator/Support-Tickets.png') }}"
                            alt=" Support Tickets">
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
<script></script>
@endsection
