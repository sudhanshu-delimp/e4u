@extends('layouts.shareholder')
@section('content')
@section('style')
</style>
@endsection


<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1">Portfolio</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                    <ol>
                        <li>The Company’s portfolio details are set out here.</li>
                        <li>The Directors are available to Shareholders to discuss any aspects of the Company’s
                            portfolio.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>



    {{-- content start --}}


    <div class="row Sh_portfolio">
        <div class="col-lg-12">
            <h2>Overview</h2>
            <p>The Company’s business interests extend across a range of service types with the common thread within the
                Website’s objectives in delivering
                the Advertising Services, Concierge Services and the My Playbox service.</p>
            <p>The aim of the Company is to maximise its business investments through the provision of corporate support
                and expertise in an efficient and
                cost effective manner, as well as seeking out new opportunities, including the expansion of existing
                projects.</p>
        </div>
    </div>

    <div class="sh_devider">

    </div>

    <div class="row Sh_portfolio">
        <div class="col-lg-6">
            <div class="text-center portfolio-img">
                <img src="{{ asset('assets/dashboard/img/shareholder/portfolio-logo.PNG') }}" alt="">
            </div>
            <p>Specialist migration agency in the provision of visa and education
                placement services for individuals seeking to migrate to Australia
                as well as, in certain instances, obtaining Australian residency.</p>
            <p>Through innovation, PEAMS has developed a unique service to a
                preferred profession. It prides itself with the understanding that
                every client is unique, with their own set of circumstances and
                migration goals.</p>
            <p>Through commitment, PEAMS provides a personalised approach
                to address specific needs both to the open market and via the E4U
                Website, pursuant to its Management Agreement with the
                Company.</p>
            <p>The Company has the following key positions:</p>
            <ul>
                <li>Board representation</li>
                <li>Shareholding - 85%</li>
                <li>Management Agreement</li>
            </ul>
        </div>
        <div class="col-lg-6">
            <div class="text-center">
                <h3>E4U</h3>
                <h3>International Presence</h3>
            </div>
            <p>Through its business partners, the Company has established a
                number of related Websites throughout the world, including:</p>

            <ul>
                <li>Canada</li>
                <li>India</li>
                <li>New Zealand</li>
                <li>The United Kingdom</li>
                <li>United Arab Emirates</li>
            </ul>

            <p>The Company continues to look for opportunities to expand into
                other countries.</p>
            <p>The E4U Website’s architecture provides all of the online
                infrastructure required to establish the Website in these various
                locations, requiring only subtle changes to fit into the jurisdiction.</p>
            <p>Where it is required, corporate entities have been established.
            </p>
        </div>
    </div>

    {{-- end --}}
</div>
@endsection
@section('script')
<script></script>
@endsection
