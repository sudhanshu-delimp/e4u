@extends('layouts.escort')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <style>
        .card ol li{
            margin: 5px 0px;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!-- Page Heading -->
        <div class="row">
            <div class="custom-heading-wrapper col-md-12">
                <h1 class="h1">Guidelines</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <ol>
                            <li>Use these Guidelines to help you understand your obligations under the E4U Terms
                                & Conditions - Influencer (<b>Agreement</b>).</li>
                            <li>If you have an appointed Agent, they can also assist you understand your obligations
                                under the Agreement.</li>
                            <li>Our Operations team monitors appointed E4U Influencers for compliance. If you
                                breach any of the terms under the Agreement, we will be in touch to guide you.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">

                <div id="accordion" class="myacording-design">
                    <div class="card">
                        <div class="card-header">
                           <h2>
                             <a class="card-link collapsed" data-toggle="collapse" href="#Agreement" aria-expanded="false">
                                Agreement
                            </a>
                           </h2>
                        </div>
                        <div id="Agreement" class="collapse" data-parent="#accordion" style="">
                            <div class="card-body">
                                <p>The E4U Terms and Conditions - Influencer are set out in the Terms and Conditions located
                                    in the Website’s footer (<b>Agreement</b>).</p>
                                <p>
                                    The Agreement addresses all of your obligations as well as our obligations.</p>
                                <p>
                                    These guidelines form a part of the Agreement.</p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h2>
                                <a class="card-link collapsed" data-toggle="collapse" href="#Guidelines" aria-expanded="false">
                                Guidelines
                            </a>
                            </h2>
                        </div>
                        <div id="Guidelines" class="collapse" data-parent="#accordion" style="">
                            <div class="card-body">
                                <p>The following are guidelines for you when conducting yourself as an Influencer and
                                    interacting
                                    with your audience on E4U approved social media platforms (<b>Platform/s</b>):</p>
                                <ol>
                                    <li>To the extent that the Agreement sets out, you will not breach any of the terms of
                                        the
                                        Agreement. If you breech the Agreement, at E4U’s discretion, you may be suspended.
                                        
                                    </li>
                                    <li>You will comply with the Australian Consumer Law.</li>
                                    <li>You will, on any Platform:
                                        <ol class="level-2">
                                            <li>Respond to genuine comments, questions and concerns in a timely manner,
                                                providing helpful and informative answers.</li>
                                            <li>Engage positively and professionally with your audience in accordance with
                                                the
                                                Agreement and these guidelines.</li>
                                            <li>Let your audience know if you do not have the answers to their questions
                                                assure them that you will find out for them, providing an expected response
                                                time
                                                if you know it. Remember to follow up once you know the answer.</li>
                                            <li>Use approved responses, where they may apply, provided by E4U when
                                                answering questions you are unsure about. For further guidance, reach out to
                                                your Agent (if one has been appointed) or raise a Support Ticket setting out
                                                the
                                                issue and asking for guidance.</li>
                                            <li>
                                                Escalate any negative or defamatory comments, messages or comment themes
                                                to our Operations team directly by email: <a href="mailto:admin@e4u.com.au"
                                                    class="termsandconditions_text_color custom_links_design">admin@e4u.com.au.</a>
                                            </li>
                                            <li>Hide or delete comments that breach the Agreement and community guidelines
                                                posted by the Platform. We recommend turning on advance comment filtering
                                                on the Platform.</li>
                                            <li>Be transparent about your partnership with Escorts4U by including our
                                                Platform
                                                hashtags, using in-platform features such as ‘branded content’ and tagging
                                                the
                                                E4U and related entity accounts in your posts.</li>
                                            <li>Review and follow the Australian Influencer Marketing Code of Practice for
                                                any
                                                additional guidelines that may apply.</li>
                                        </ol>
                                    </li>
                                    <li>You will not, on any Platform:
                                        <ol class="level-2">
                                            <li>Engage in arguments or controversial discussions that could damage the
                                                reputation of Escorts4U, the Company, any related entity (Group) or any
                                                campaign.</li>
                                            <li>Make any false or misleading claims.</li>
                                            <li>Respond to sarcastic or non-serious questions.</li>
                                            <li>Endorse or promote any political or controversial views.</li>
                                            <li>Post inappropriate content that may go against the Group values or that of
                                                the
                                                campaign.</li>
                                        </ol>
                                    </li>
                                    <li>Ensure that you obtain approval before posting any content related to a campaign we
                                        have briefed you on.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
    <script>
        var table = $('#GuidelineTable').DataTable({
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search by Document Title",
                sSearch: 'Search:'
            },
            processing: false,
            serverSide: false,
            lengthChange: true,
            order: [],
            searchable: false,
            searching: true,
            bStateSave: true
        });
    </script>
@endsection
