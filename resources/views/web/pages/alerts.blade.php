@extends('layouts.web')
@section('style')
    <style>
        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            /* Safari */
            animation: spin 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endsection
@section('content')
    <section class="padding_top_eight_px padding_bottom_eight_px">
        <div class="container">
            <h1 class="home_heading_first margin_btm_twenty_px">Alerts</h1>

            <div class="accordion-container">

                <div class="set">
                    <a>
                        Employment
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content custom--alertlist">
                            @if (!empty($alertData['Employment']))
                                @foreach ($alertData['Employment'] as $item)
                                    @if ($item)
                                        <div>
                                            <p><strong>{{ $item['subject'] ?? '' }}</strong></p>
                                            <p>{!!  $item['description'] ?? '' !!}</p>
                                            <p class="c-red"><b>Note</b>: {{ $item['message'] ?? '' }}</p>
                                            <p class=""><b>Published</b>:
                                                {{ $item->created_at->format('jS F Y') ?? '' }}
                                            </p>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="set">
                    <a>
                        New Features
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content custom--alertlist">
                            @if (!empty($alertData['New Features']))
                                @foreach ($alertData['New Features'] as $item)
                                    @if ($item)
                                        <div>
                                            <p><strong>{{ $item['subject'] ?? '' }}</strong></p>
                                            <p>{!! $item['description'] ?? '' !!}</p>
                                            <p class="c-red"><b>Note</b>: {{ $item['message'] ?? '' }}</p>
                                            <p class=""><b>Published</b>:
                                                {{ $item->created_at->format('jS F Y') ?? '' }}
                                            </p>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="set">
                    <a class="">
                        Scammer Alerts
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content" style="display: none;">
                        <div class="accodien_manage_padding_content">
                            @if (!empty($alertData['Scammer Alerts']))
                                @foreach ($alertData['Scammer Alerts'] as $item)
                                    @if ($item)
                                        <div>
                                            <p><strong>{{ $item['subject'] ?? '' }}</strong></p>
                                            <p>{!! $item['description'] ?? '' !!}</p>
                                            <p class="c-red"><b>Note</b>: {{ $item['message'] ?? '' }}</p>
                                            <p class=""><b>Published</b>:
                                                {{ $item->created_at->format('jS F Y') ?? '' }}
                                            </p>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="set">
                    <a class="">
                        Website Updates
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content" style="display: none;">
                        <div class="accodien_manage_padding_content">
                            @if (!empty($alertData['Website Updates']))
                                @foreach ($alertData['Website Updates'] as $item)
                                    @if ($item)
                                        <div>
                                            <p><strong>{{ $item['subject'] ?? '' }}</strong></p>
                                            <p>{!! $item['description'] ?? '' !!}</p>
                                            <p class="c-red"><b>Note</b>: {{ $item['message'] ?? '' }}</p>
                                            <p class=""><b>Published</b>:
                                                {{ $item->created_at->format('jS F Y') ?? '' }}
                                            </p>
                                        </div>
                                    @endif
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>

                <div class="set">
                    <a>Changes to this Policy

                        <i class="fa fa-angle-down"></i>
                    </a>

                    <div class="content ">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cms-accordion-content-area">
                                            <!-- level 1 list -->
                                            <p>
                                                We may change or modify these Terms and Conditions in the future. We
                                                will note the date that revisions were last made at the bottom of this
                                                page. Any revision will take effect upon its posting. It is your
                                                responsibility to check the <a href="{{ url('terms-conditions') }}">Terms
                                                    and Conditions</a> from time to time to review the most current
                                                version.
                                            </p>
                                            <p>
                                                Escorts4U archives all previous versions of the Terms and Conditions
                                            </p>
                                            <p><b>This policy was last updated 03-06-2025</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        var skipSliderage = document.getElementById("skipstepage");
        var skipValuesage = [
            document.getElementById("skip-value-lower-age"),
            document.getElementById("skip-value-upper-age")
        ];

        noUiSlider.create(skipSliderage, {
            start: [0, 30],
            connect: true,
            behaviour: "drag",
            step: 1,
            range: {
                min: 18,
                max: 60
            },
            format: {
                from: function(value) {
                    return parseInt(value);
                },
                to: function(value) {
                    return parseInt(value);
                }
            }
        });

        skipSliderage.noUiSlider.on("update", function(values, handle) {
            skipValuesage[handle].innerHTML = values[handle];
        });
    </script>
@endpush
