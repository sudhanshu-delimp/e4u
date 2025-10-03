@extends('layouts.agent')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!-- Page Heading -->
        <div class="row">
            <div class="custom-heading-wrapper col-md-12">
                <h1 class="h1">Services - KPIs</h1>
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
        {{-- content --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="guideline-info">
                    <ol>
                       <li>Purpose
                        <p>The purpose of these Guidelines is to set out the Services the Support Agent (<b>Agent</b>) will
                            provide under the Agent Agreement (<b>Agreement</b>), ensuring a consistent approach to the
                            delivery of those Services by all Agents.</p>
                       </li>


                       <li>Background
                        <p>These Guidelines were developed in response to the provisions set out in the Agreement,
                            summarising the KPIs for ease of understanding.</p>
                       </li>


                       <li>Applicability
                        <p>These Guidelines apply to all Approved Agents engaged in activities or processes associated
                            with providing the Services, effective from your date of registration as an Agent.</p>
                       </li>


                       <li>Statement
                        <p>When undertaking any activity aligned with the Agreement you must conduct yourself in
                            accordance with these Guidelines.</p>
                       </li>


                       <li>Guideline Requirements
                        <p>As an Agent you are required to undertake the execution of the Services, in respect to:</p>
                        <ol class="level-2">
                            <li>Escorts, when engaged:
                                <ul>
                                    <li>present, promote and sell the Advertising Services and Concierge Services using
                                        solid arguments</li>
                                    <li>establish, develop and maintain positive business relationships; and</li>
                                    <li>to the extent that the Agent is able to, reach out through cold calling</li>
                                </ul>
                            </li>
                            <li>Massage Centre:
                                <ul>
                                    <li>identify, contact and recruit</li>
                                    <li>present, promote and sell the Advertising Services and Concierge Services using
                                        solid arguments</li>
                                    <li>perform cost-benefit and needs analysis to meet their needs</li>
                                    <li>establish, develop and maintain positive business relationships</li>
                                    <li>reach out through cold calling</li>
                                    <li>co-ordinate sales effort with E4U where appropriate
                                    </li>
                                </ul>
                            </li>
                            <li>Generally:
                                <ul>
                                    <li>have the required knowledge base</li>
                                    <li>expedite the notification of User problems and complaints to E4U so as to
                                        maximise a speedy resolution</li>
                                    <li>analyse the territory/market potential, track sales and status reports through the
                                        Agent Console</li>
                                    <li>provide E4U with reports on Advertiser needs, problems, interests, competitive
                                        activities, and potential for new products and services</li>
                                    <li>keep abreast of best practices and promotional trends</li>
                                    <li>continuously improve through feedback</li>
                                </ul>
                            </li>
                        </ol>
                       </li>
                        <li>Related Documents
                            <p>These Guidelines should be read in conjunction with:</p>
                            <ul>
                                <li>Terms and Conditions.</li>
                                <li>Any written Agreement you have entered into with E4U or related entity.</li>
                            </ul>
                        </li>
                        <li>Contact
                            <p>For further information regarding these Guidelines, please contact the Managing Director at:</p>
                            <a href="mailto:wayne@blackboxtech.com.au" class="custom_links_design">wayne@blackboxtech.com.au</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        {{-- end --}}
    </div>
@endsection
@section('script')
   
@endsection
