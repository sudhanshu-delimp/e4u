@extends('layouts.center')
@section('style')
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between">
            <div class="custom-heading-wrapper">
                <h1 class="h1">Customise Dashboard</h1>
                <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></h6>
            </div>
            <div class="back-to-dashboard">
                <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                    <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                </a>
            </div>
        </div>

        <div class="row">
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
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <label class="card-label shadow-sm">
                    <input type="checkbox" name="My_Legbox_Viewers" data-key="My_Legbox_Viewers" value="1"
                        class="toggle-view">
                    <div class="selectable-card">
                        <div class="card-title-row">
                            <div class="card-title">Media Views</div>
                            <div class="card-image">
                                <img src="{{ asset('assets/dashboard/img/boxicon/center/media-views-today.png') }}"
                                    alt="Media Views">
                            </div>
                        </div>
                        <div class="card-desc">View a complete summary of your Media Views.</div>
                    </div>
                </label>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <label class="card-label shadow-sm">
                    <input type="checkbox" name="My_Legbox_Viewers" data-key="My_Legbox_Viewers" value="1"
                        class="toggle-view">
                    <div class="selectable-card">
                        <div class="card-title-row">
                            <div class="card-title">Support Tickets</div>
                            <div class="card-image">
                                <img src="{{ asset('assets/dashboard/img/boxicon/center/suppor-tickets.png') }}"
                                    alt="Support Tickets">
                            </div>
                        </div>
                        <div class="card-desc">View a complete summary of your Support Tickets.</div>
                    </div>
                </label>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <label class="card-label shadow-sm">
                    <input type="checkbox" name="My_Legbox_Viewers" data-key="My_Legbox_Viewers" value="1"
                        class="toggle-view">
                    <div class="selectable-card">
                        <div class="card-title-row">
                            <div class="card-title">Profile Views</div>
                            <div class="card-image">
                                <img src="{{ asset('assets/dashboard/img/boxicon/center/profile-views-today.png') }}"
                                    alt="Profile Views">
                            </div>
                        </div>
                        <div class="card-desc">View a complete summary of your Profile Views.</div>
                    </div>
                </label>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <label class="card-label shadow-sm">
                    <input type="checkbox" name="My_Legbox_Viewers" data-key="My_Legbox_Viewers" value="1"
                        class="toggle-view">
                    <div class="selectable-card">
                        <div class="card-title-row">
                            <div class="card-title">Recommendations</div>
                            <div class="card-image">
                                <img src="{{ asset('assets/dashboard/img/boxicon/center/recommendations-this-week.png') }}"
                                    alt="Recommendations">
                            </div>
                        </div>
                        <div class="card-desc">View a complete summary of your Recommendations.</div>
                    </div>
                </label>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <label class="card-label shadow-sm">
                    <input type="checkbox" name="My_Legbox_Viewers" data-key="My_Legbox_Viewers" value="1"
                        class="toggle-view">
                    <div class="selectable-card">
                        <div class="card-title-row">
                            <div class="card-title">Reviews Posted</div>
                            <div class="card-image">
                                <img src="{{ asset('assets/dashboard/img/boxicon/center/reviews-posted-this-week.png') }}"
                                    alt="Reviews Posted">
                            </div>
                        </div>
                        <div class="card-desc">View a complete summary of your Reviews Posted.</div>
                    </div>
                </label>
            </div>

        </div>
    @endsection
    @section('script')
    @endsection
