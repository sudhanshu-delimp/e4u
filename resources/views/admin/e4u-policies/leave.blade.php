@extends('layouts.admin')
@section('style')
@stop
@section('content')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
            <div class="row">
                <div class="custom-heading-wrapper col-md-12">
                    <h1 class="h1">Leave policy</h1>
                    <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes"
                        aria-expanded="true">Help?</span>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="card collapse" id="notes" style="">
                        <div class="card-body">
                           <h3 class="NotesHeader"><b>Notes:</b></h3>
                            <ol>
                                <li>Blackbox Tech Pty Ltd (ACN 664 919 975) (<b>Blackbox</b>, <b>we</b>, or <b>our</b>).
                                </li>
                                <li>This leave policy should be read in conjunction with your Employment Contract.</li>
                                <li>We may change or modify this Policy in the future. We will note the date that revisions
                                    were last made at the bottom of this page. Any revision will take effect upon its
                                    posting.
                                    It is your responsibility to check this policy this Policy from time to time to review
                                    the most
                                    current version.
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end --}}
            <div class="row">
                <div class="col-md-12">
                    <div id="accordion" class="myacording-design">
                        {{-- Introduction --}}
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link collapsed" data-toggle="collapse" href="#Introduction"
                                    aria-expanded="false">
                                    Introduction
                                </a>
                            </div>
                            <div id="Introduction" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body p-0">
                                    <div class="custom--content-abb">
                                        <div class="content_wrapper tab_content my-4">
                                            <div class="content_details">
                                                <h3><b>1.&nbsp;&nbsp; Overview</b></h3>


                                                <p>
                                                    The purpose of this policy is to define when Employees are eligible for
                                                    leave and to outline
                                                    the process for requests, approvals and administration of annual,
                                                    personal and other leave.
                                                </p>
                                                <p>
                                                    To the extent of an inconsistency between the terms of this policy and
                                                    the conditions of your
                                                    award, if any, or your Employment Contract, the terms and conditions
                                                    more favorable to the
                                                    Employee, within reason, will prevail.


                                                </p>
                                            </div>

                                            <div class="content_details">
                                                <h3><b>2.&nbsp;&nbsp; Scope</b></h3>


                                                <p>
                                                    This policy applies to all Employees irrespective of their location when
                                                    carrying out their
                                                    duties.
                                                </p>
                                            </div>

                                            <div class="content_details">
                                                <h3><b>3.&nbsp;&nbsp; Definition</b></h3>


                                                <p>

                                                    <b>Employee</b> or <b>you</b> means and includes persons employed by
                                                    Blackbox on a
                                                    part time or
                                                    permanent basis, board members, service providers, contractors,
                                                    consultants, Agents and
                                                    visitors.

                                                </p>
                                                <p>
                                                    <b>Employment Contract</b> means a legally binding document that sets
                                                    out
                                                    the employment
                                                    minimum terms and conditions.
                                                </p>
                                                <p>
                                                    <b>Industrial Instrumen</b> means a legally binding document, including
                                                    an
                                                    award or enterprise
                                                    agreement, that sets out the employment minimum terms and conditions.
                                                </p>
                                            </div>

                                            <div class="content_details">
                                                <h3><b>4.&nbsp;&nbsp; Policy details</b></h3>


                                                <p>
                                                    Outline of Blackbox’s provision of leave which is designed for:
                                                </p>
                                                <ul>
                                                    <li>periods of rest and relaxation.</li>
                                                    <li>annual leave, personal/carer’s leave, parental leave,
                                                        compassionate/bereavement leave,
                                                        jury service leave and other leave as identified.</li>

                                                </ul>
                                                <p>
                                                    This policy establishes how the management of leave entitlements and
                                                    discretionary
                                                    provisions are managed throughout Blackbox in accordance with any
                                                    applicable Award and
                                                    legislation and, if applicable, relevant Blackbox policies. Employees
                                                    will consider the
                                                    operational needs of Blackbox together with their individual needs.
                                                </p>
                                                <p>The objectives of this policy are to ensure:</p>
                                                <ul>
                                                    <li>Employees are aware of leave entitlements, discretionary leave
                                                        provisions and
                                                        responsibilities.</li>
                                                    <li>Blackbox is committed to providing opportunities, where reasonable,
                                                        for Employees to
                                                        work in a family friendly environment, where it is practicable, and
                                                        balance their work life
                                                        commitments.</li>
                                                    <li>the promotion of a safe and healthy workplace at Blackbox.</li>
                                                    <li>the operational requirements of the local work area are taken into
                                                        account through
                                                        appropriate work planning.</li>

                                                </ul>
                                                <p>
                                                    This Code is to be considered a set of rules that Employees ans Agents
                                                    will use in
                                                    performing
                                                    their daily work with the organisation. A breach of this Code may be
                                                    discussed at any time
                                                    during the employment or engagement period and could bring immediate
                                                    disciplinary action
                                                    against the Employee and Agent pursuant to the Agent Agreement.</p>
                                                <p>The Code will be reviewed regularly and updated accordingly to reflect
                                                    changes both within
                                                    and outside the organisation.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link collapsed" data-toggle="collapse" href="#AnnualLeave"
                                    aria-expanded="false">
                                    Annual Leave
                                </a>
                            </div>
                            <div id="AnnualLeave" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body p-0">
                                    <div class="custom--content-abb">
                                        <div class="content_wrapper tab_content my-4">
                                            <div class="content_details">
                                                <h3 class="mb-3"><b>5.&nbsp;&nbsp; Annual Leave</b></h3>
                                                <h3><b>5.1&nbsp;&nbsp;Amount of Leave</b></h3>

                                                <p>
                                                    You are entitled to 4 weeks of annual leave each year in accordance with
                                                    the provisions of
                                                    the National Employment Standards (<b>NES</b>), plus additional leave in
                                                    accordance with the
                                                    Industrial Instrument, if any, or as outlined in your Employment
                                                    Contract.

                                                </p>
                                                <p>
                                                    Shift workers may be entitled to 5 weeks annual leave each year, subject
                                                    to qualification
                                                    under the applicable legislative instrument or their Employment
                                                    Contract.


                                                </p>
                                                <p>Annual leave accrues progressively throughout a year of service and is
                                                    cumulative.</p>
                                            </div>

                                            <div class="content_details">
                                                <h3><b>5.2&nbsp;&nbsp; Taking of Leave and Scheduling Considerations</b>
                                                </h3>


                                                <p>
                                                    Blackbox encourages you to take all of your holiday entitlement within a
                                                    calendar year. You
                                                    are encouraged to take annual leave over one or two continuous periods
                                                    as to provide a
                                                    meaningful break from work.
                                                </p>

                                                <p>
                                                    Annual leave dates will normally be allocated on a ‘first come, first
                                                    served’ basis whilst
                                                    ensuring that operational efficiency and appropriate staffing levels are
                                                    maintained throughout
                                                    the year.
                                                </p>
                                                <p>
                                                    Employee leave accruals will be monitored by human resources and payroll
                                                    to ensure that
                                                    excessive leave is not accrued. Human Resources will liaise on a regular
                                                    basis with the
                                                    relevant Manager and advise those Employees that have exceeded 6 weeks
                                                    accrued leave
                                                    to take their leave entitlements.
                                                </p>
                                                <p>
                                                    Where you wish to accrue more than 6 weeks of annual leave, you must
                                                    seek the approval
                                                    of the Managing Director. Otherwise Employees may be instructed to take
                                                    any excessive
                                                    leave at a time outlined by management.
                                                </p>
                                            </div>

                                            <div class="content_details">
                                                <h3><b>5.3&nbsp;&nbsp; Notice Requirements</b></h3>
                                                <p>
                                                    Except in the case of mutual consent to the contrary, the Employee and
                                                    Blackbox are required
                                                    to give the following notice of taking annual leave.
                                                </p>
                                                <div class="my-4">
                                                    <table class="table">
                                                        <thead class="table-bg">
                                                            <tr>
                                                                <th class="text-center font-weight-bold">Period of leave to
                                                                    be taken</th>
                                                                <th class="text-center font-weight-bold">Minimum notice
                                                                    requirement</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Less than a week</td>
                                                                <td>By agreement with management</td>
                                                            </tr>
                                                            <tr>
                                                                <td>1 week</td>
                                                                <td>3 weeks</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Over 1 week and up to 2 weeks</td>
                                                                <td>6 weeks</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Over 2 weeks and up to 3 weeks</td>
                                                                <td>8 weeks</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Over 3 weeks and up to 4 weeks</td>
                                                                <td>10 weeks</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Over 4 weeks</td>
                                                                <td>12 weeks</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>

                                            <div class="content_details">
                                                <h3><b>5.4&nbsp;&nbsp; Annual Leave Requests and Approval Processes</b></h3>


                                                <p>
                                                    You must complete the annual leave request form and have it signed by
                                                    your Manager before
                                                    you make any firm holiday arrangements. If prior approval is not sought
                                                    before firm holiday
                                                    arrangements are made then Blackbox is under no obligation to approve
                                                    leave if the required
                                                    process is not followed. It is the responsibility of your Manager to
                                                    forward the completed leave
                                                    form to Payroll.

                                                </p>
                                            </div>


                                            <div class="content_details">
                                                <h3><b>5.5&nbsp;&nbsp; Close Down</b></h3>


                                                <p>
                                                    Blackbox may choose to shut down whole or part of its operations over
                                                    the any gazetted
                                                    holiday period, including but not limited to, the Christmas and New Year
                                                    period. If we do, you
                                                    are required to reserve sufficient days from your annual leave
                                                    entitlement to cover the
                                                    Christmas / New Year shut-down period. If you have not accrued
                                                    sufficient holiday entitlement
                                                    to cover this period, you will be given unpaid leave of absence.
                                                    Blackbox commits to provide
                                                    reasonable notice of any planned close down.

                                                </p>
                                            </div>



                                            <div class="content_details">
                                                <h3><b>5.6&nbsp;&nbsp; Payment for Annual Leave</b></h3>


                                                <p>
                                                    Your annual leave pay will be at your normal basic pay unless shown
                                                    otherwise in your
                                                    Employment Contract. By request, you may elect to receive your annual
                                                    leave pay in
                                                    advance, however if the request is not received prior to the
                                                    commencement of the annual
                                                    leave being taken, you will be paid in the regular pay period.

                                                </p>
                                                <p>
                                                    You may be entitled to annual leave loading in accordance with your
                                                    Industrial Instrument, if
                                                    any, or Employment Contract. You may also request to ‘cash out’ your
                                                    accrued annual leave
                                                    entitlements which will be subject to approval from the Managing
                                                    Director. However, at all
                                                    times, you must have at least 4 weeks accrued annual leave in the
                                                    balance. You must give
                                                    at least 2 weeks notice to management prior to cashing out of any annual
                                                    leave.
                                                </p>
                                            </div>



                                            <div class="content_details">
                                                <h3><b>5.7&nbsp;&nbsp; Cashing out Annual Leave</b></h3>


                                                <p>
                                                    Subject to Blackbox’s agreement, you can cash out your annual leave. To
                                                    cash out annual
                                                    leave Employees need to have:

                                                </p>
                                                <ul>
                                                    <li>at least 4 weeks annual leave left after the cash out.</li>
                                                    <li>a signed written agreement with Blackbox that outlines the amount of
                                                        leave being cashed
                                                        out, the amount they will be paid and the date it will be paid.</li>
                                                </ul>
                                                <p>
                                                    The payment for cashed out leave has to be the same as what the Employee
                                                    would have
                                                    been paid if they took the leave. An Employee can not cash out more than
                                                    2 weeks each 12
                                                    month period.
                                                </p>
                                                <p>
                                                    Employee who come under a registered agreement the following rules
                                                    apply:
                                                </p>
                                                <ul>
                                                    <li>an Employee needs to have at least 4 weeks leave leftover.</li>
                                                    <li>a written agreement needs to be made each time annual leave is
                                                        cashed out.</li>
                                                    <li>Blackbox can not force or pressure an Employee to cash out annual
                                                        leave.</li>
                                                    <li>the payment for cashed out annual leave has to be the same as what
                                                        the employee would
                                                        have been paid if they took the leave.</li>
                                                </ul>
                                                <p>You may also request to ‘cash out’ your accrued annual leave entitlements
                                                    which will be
                                                    subject to approval from the Managing Director. However, at all times,
                                                    you must have at
                                                    least 4 weeks of leave in balance.</p>
                                                <p>The worker must give at least 2 weeks notice to management prior to
                                                    cashing out of any
                                                    annual leave.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{-- Personal Leave --}}
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link collapsed" data-toggle="collapse" href="#PersonalLeave"
                                    aria-expanded="false">
                                    Personal Leave
                                </a>
                            </div>
                            <div id="PersonalLeave" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body p-0">
                                    <div class="custom--content-abb">
                                        <div class="content_wrapper tab_content my-4">
                                            <div class="content_details">
                                                <h3 class="mb-3"><b>6.&nbsp;&nbsp; Personal Leave</b></h3>
                                                <h3><b>6.1&nbsp;&nbsp;Amount of Leave</b></h3>

                                                <p>
                                                    You are entitled to be paid for personal leave in accordance with the
                                                    NES, unless otherwise
                                                    stated in your Employment Contract or Industrial Instrument, if any.

                                                </p>
                                                <p>
                                                    Subject to your Employment Contract, personal leave does not accrue from
                                                    year to year.

                                                </p>
                                            </div>

                                            <div class="content_details">
                                                <h3><b>6.2&nbsp;&nbsp; Taking of Personal Leave</b>
                                                </h3>


                                                <p>
                                                    You are entitled to take personal leave:
                                                </p>
                                                <ul>
                                                    <li>because you are not fit for work due to a personal illness or
                                                        personal injury affecting you;
                                                        or</li>
                                                    <li>
                                                        to provide care or support to a member of your immediate family, or
                                                        a member of your
                                                        household who requires your care and support because of a sudden or
                                                        unexpected:
                                                        <ul>
                                                            <li>personal illness or injury affecting the Employee; or</li>
                                                            <li>emergency affecting the Employee.</li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                                <p>
                                                    If your entitlement to personal leave is exhausted, you may take two
                                                    days unpaid carer’s
                                                    leave for each occasion when a member of your immediate family or a
                                                    member of your
                                                    household requires your care and support because of a sudden or
                                                    unexpected:
                                                </p>
                                                <ul>
                                                    <li>personal illness or personal injury affecting the Employee; or</li>
                                                    <li>emergency affecting the Employee.</li>
                                                </ul>
                                            </div>

                                            <div class="content_details">
                                                <h3><b>6.3&nbsp;&nbsp; Notification of Personal (Sick) Leave</b></h3>
                                                <p>
                                                    It is not acceptable for Employees to send a message via a workmate,
                                                    send a text message
                                                    or leave a message on the answering machine/email.
                                                </p>
                                                <p>
                                                    Employees are required to speak directly to their Manager on the first
                                                    day of incapacity or in
                                                    their absence, the Managing Director. If neither of these persons are
                                                    available, a colleague
                                                    is to be advised of their Inability to attend for work.
                                                </p>
                                                <p>
                                                    Other than in exceptional circumstances, notification should be made
                                                    personally to your
                                                    Manager. You should try to give an indication of your expected return
                                                    date and notify
                                                    Blackbox as soon as possible if this date changes. The notification
                                                    procedures should be
                                                    followed on each day of absence, unless you are covered by a doctor’s
                                                    medical certificate.
                                                </p>

                                            </div>

                                            <div class="content_details">
                                                <h3><b>6.4&nbsp;&nbsp; Evidence of Incapacity</b></h3>


                                                <p>
                                                    Blackbox may require sufficient evidence to support your personal /
                                                    carer’s leave for each and
                                                    every absence. In particular, a medical certificate or statutory
                                                    declaration, if requested, is
                                                    required if:

                                                </p>
                                                <ul>
                                                    <li>you take more than two consecutive days leave; or</li>
                                                    <li>take a day on either side of a weekend or public holiday; or</li>
                                                    <li>take a day off either side of any approved annual leave, long
                                                        service leave or any other
                                                        leave.
                                                    </li>
                                                </ul>
                                                <p>
                                                    Blackbox may also request that you provide sufficient evidence for these
                                                    purposes where it
                                                    considers you have taken excessive personal leave or patterns of leave.
                                                </p>
                                                <p>
                                                    If you fail to provide a medical certificate or statutory declaration,
                                                    when requested, you may
                                                    not be paid for your absence and may be subject to disciplinary action.
                                                    Upon receipt of your
                                                    medical certificate, payroll will be notified to process any amounts
                                                    owing for your wages.
                                                </p>
                                            </div>


                                            <div class="content_details">
                                                <h3><b>6.5&nbsp;&nbsp; Return to Work</b></h3>


                                                <p>
                                                    You must notify your Manager as soon as you know of which day you will
                                                    be returning to
                                                    work, if this differs from a date of return previously notified.

                                                </p>
                                                <p>
                                                    On return to work after any period of personal leave, you may be
                                                    required to attend a return
                                                    to work interview to discuss the state of your health and fitness for
                                                    work.
                                                </p>
                                                <p>
                                                    Information arising from such an interview will be treated with the
                                                    strictest confidence. You
                                                    will be required to complete a personal leave form.
                                                </p>
                                            </div>



                                            <div class="content_details">
                                                <h3><b>6.6&nbsp;&nbsp;Managing Absenteeism</b></h3>


                                                <p>
                                                    Submission of a medical certificate may not always be regarded as
                                                    sufficient justification for
                                                    accepting your absence. Sickness is just one of a number of reasons for
                                                    absence and
                                                    although it is understandable that if you are sick you may need time
                                                    off, continual or repeated
                                                    absence through sickness may not be acceptable to Blackbox.

                                                </p>
                                                <p>
                                                    In deciding whether your absence is acceptable, Blackbox will take into
                                                    account the reasons
                                                    for your absences and extent of them, including any absence caused by
                                                    sickness / injury. We
                                                    cannot operate with an excessive level of absence as all absence, for
                                                    whatever reason,
                                                    reduces Blackbox’s ability to operate successfully.
                                                </p>
                                                <p>
                                                    Blackbox will not tolerate any non-genuine absences, and any such
                                                    instances will result in
                                                    disciplinary action being taken.
                                                </p>
                                                <p>
                                                    If considered necessary, we reserve the right to ask your permission to
                                                    contact your doctor
                                                    and / or for you to be independently medically examined.
                                                </p>
                                            </div>



                                            <div class="content_details">
                                                <h3><b>6.7&nbsp;&nbsp; Compassionate/Bereavement Leave</b></h3>


                                                <p>
                                                    Blackbox understands the health of an individual or a family member can
                                                    have significant
                                                    impact on you.

                                                </p>
                                                <p>
                                                    Full-time and part-time workers are entitled to three days’ paid
                                                    compassionate/bereavement
                                                    leave for each occasion when a member of your immediate family or a
                                                    member of your
                                                    household:
                                                </p>
                                                <ul>
                                                    <li>contracts or develops a personal illness that poses a serious threat
                                                        to their lif e; or</li>
                                                    <li>sustains a personal injury that poses a serious threat to their
                                                        life; or</li>
                                                    <li>dies.</li>
                                                </ul>
                                                <p>
                                                    Immediate family includes:
                                                </p>
                                                <ul>
                                                    <li>a spouse or domestic partner of the Employee. A domestic partner
                                                        means a person to
                                                        whom the Employee is not married but with whom the Employee is
                                                        living as a couple on
                                                        a genuine domestic basis (irrespective of gender); and</li>
                                                    <li>a child or an adult child, parent or spouse of the Employee.</li>
                                                </ul>
                                                <p>Blackbox may grant paid leave in other cases where, in its opinion,
                                                    special circumstances
                                                    exist. Special circumstances may include the death of a:</p>
                                                <ul>
                                                    <li>person with whom the employee had a close relationship.</li>
                                                    <li>step or foster parent or child.</li>
                                                    <li>relative who has taken the place of a parent.</li>
                                                    <li>relative residing with the worker at the time of the death.</li>
                                                    <li>person where the Employee is the only relative of the deceased
                                                        person and is the only
                                                        person available to make the funeral arrangements.</li>
                                                </ul>
                                                <p>Leave, with or without pay, in excess of that specified above may be
                                                    granted if Blackbox is
                                                    satisfied that three days is inadequate because of special circumstances
                                                    (for example, funeral
                                                    delay or extensive traveling involved).
                                                </p>
                                                <p>
                                                    In considering applications for compassionate/bereavement leave, it is
                                                    important to note that
                                                    each case will be considered on its merits. Blackbox may also grant up
                                                    to four hours ‘paid
                                                    time’ to attend the funeral of a very close non-family member. Any
                                                    requests of this nature will
                                                    be assessed on a case-by-case basis.
                                                </p>
                                                <p>Blackbox may require you to provide satisfactory evidence of the illness
                                                    or death of your
                                                    immediate family or household member.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--  Other Leave --}}
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link collapsed" data-toggle="collapse" href="#OtherLeave"
                                    aria-expanded="false">
                                    Other Leave
                                </a>
                            </div>
                            <div id="OtherLeave" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body p-0">
                                    <div class="custom--content-abb">
                                        <div class="content_wrapper tab_content my-4">
                                            <div class="content_details">
                                                <h3 class="mb-3"><b>7.&nbsp;&nbsp; Other Leave</b></h3>
                                                <h3><b>7.1&nbsp;&nbsp;Community Service Leave (including jury service)</b>
                                                </h3>

                                                <p>
                                                    You are entitled to community service leave in certain circumstances.

                                                </p>
                                                <p>
                                                    Community service leave is for eligible community service activities
                                                    such as SES, jury service
                                                    and volunteer fire fighting.

                                                </p>
                                                <p>Other than for the first 2 weeks of jury service leave, where Blackbox
                                                    will top up the pay of a
                                                    permanent worker, community service leave is unpaid.</p>
                                            </div>

                                            <div class="content_details">
                                                <h3><b>7.2&nbsp;&nbsp; Long Service Leave</b>
                                                </h3>


                                                <p>
                                                    You are entitled to long-service leave in accordance with the laws of
                                                    Western Australia or the
                                                    terms of your Industrial Instrument, if applicable. Long service leave
                                                    should be taken as soon
                                                    as reasonably practicable after you become entitled to it. The Employee
                                                    must give at least
                                                    8 weeks notice, which they intend to take any period of long service
                                                    leave.
                                                </p>
                                            </div>

                                            <div class="content_details">
                                                <h3><b>7.3&nbsp;&nbsp; Parental Leave</b></h3>
                                                <p>
                                                    Parental leave allows Employees to take time away from work for the
                                                    birth or adoption of a
                                                    child and care of a child.
                                                </p>
                                                <p>
                                                    There are two types of parental leave entitlements:

                                                </p>
                                                <ul>
                                                    <li>the Paid Parental Leave (<b>PPL</b>) scheme; and</li>
                                                    <li>the entitlement to unpaid parental leave. </li>
                                                </ul>
                                            </div>

                                            <div class="content_details">
                                                <h3><b>7.4&nbsp;&nbsp; Paid Parental Leave</b></h3>


                                                <p>
                                                    The PPL scheme is a Federal Government initiate which guarantees
                                                    employees payment for
                                                    leave for up to 18 weeks at the national minimum wage rate.

                                                </p>
                                                <p>
                                                    PPL can start from the date of birth or adoption of your child, or at a
                                                    later date. It must be
                                                    received in one continuous period and must all be used within 12 months
                                                    of the date of birth
                                                    or adoption of your child. Parental leave pay is taxable and can be
                                                    received before, after, or
                                                    at the same time as existing entitlements, such as annual leave.
                                                </p>
                                                <p>
                                                    All applications for federally funded PPL is to be made through the
                                                    Family Assistance Office
                                                    or any other nominated Government Department and not through Blackbox.
                                                    You may obtain
                                                    further information regarding paid PPL by contacting the Family
                                                    Assistance Office.
                                                </p>
                                            </div>


                                            <div class="content_details">
                                                <h3><b>7.5&nbsp;&nbsp; Dad and Partner Pay</b></h3>


                                                <p>
                                                    Under the Dad and Partner Pay (<b>DAPP</b>) scheme, fathers and partners
                                                    (including same-sex
                                                    partners) to newly born or adopted children can receive up to 2 weeks
                                                    pay from the federal
                                                    government at the national minimum wage.

                                                </p>
                                                <p>
                                                    While PPL is payment for the primary carer of the child, DAPP is payment
                                                    for the parent who
                                                    is not the primary carer.
                                                </p>
                                            </div>



                                            <div class="content_details">
                                                <h3><b>7.6&nbsp;&nbsp; Unpaid Parental Leave</b></h3>


                                                <p>
                                                    To be eligible for unpaid parental leave (<b>UPL</b>), you are required
                                                    to provide written notice
                                                    stating your intention to take UPL. The notice must specify the start
                                                    and end dates of the
                                                    proposed period of UPL.

                                                </p>
                                                <p>
                                                    Under the NES, employees who have at least 12 months of continuous
                                                    service as at the
                                                    expected date of birth of the child are entitled to 52 weeks of unpaid
                                                    parental leave. Casuals
                                                    with regular ongoing work are also entitled to UPL.
                                                </p>
                                                <p>
                                                    You may request an additional 52 weeks of leave which may be refused by
                                                    Blackbox on
                                                    reasonable business grounds.
                                                </p>
                                                <p>
                                                    Other forms of leave, such as annual leave and long service leave, may
                                                    be taken concurrently
                                                    with UPL, but when combined with the UPL, must not exceed the 52 week
                                                    period.
                                                </p>
                                                <p>
                                                    You must give Blackbox at least 10 weeks prior notice of your intention
                                                    to take UPL. This can
                                                    be done using our leave form.
                                                </p>
                                                <p>
                                                    When advising of your intention to take UPL, you must provide the
                                                    following:
                                                </p>
                                                <ul>
                                                    <li>a medical certificate indicating the expected date of birth of the
                                                        child, or, where the leave
                                                        is adoption related, the expected date of placement.</li>
                                                    <li>an expected return date; and</li>
                                                    <li>details of any parental leave your partner intends to take.</li>
                                                </ul>
                                                <p>
                                                    An Employee must take UPL in a single, continuous period. When an
                                                    Employee who is
                                                    pregnant takes UPL, her leave must commence:

                                                </p>
                                                <ul>
                                                    <li>on the day of the birth of the child; or</li>
                                                    <li>in the 6 week period before the expected birth date.</li>

                                                </ul>
                                                <p>
                                                    If a pregnant Employee is entitled to UPL and indicates they want to
                                                    work during the 6 weeks
                                                    before the expected birth date, Blackbox can direct them to start UPL
                                                    early if they are unfit
                                                    for work. This is known as directed leave.
                                                </p>
                                                <p>
                                                    After 24 months of continuous service, Blackbox will provide permanent
                                                    Employees 4 weeks
                                                    pay at your standard rate upon commencement of parental leave. Pro-rata
                                                    entitlements apply
                                                    for part-time Employees.
                                                </p>

                                                <p>
                                                    The period of PPL is not in addition to the period of unpaid parental
                                                    leave available under the
                                                    Fair Work Act. The period of PPL will be taken at the same time as the
                                                    corresponding portion
                                                    of unpaid leave.
                                                </p>
                                                <p>
                                                    An Employee can only extend the period of unpaid parental leave once
                                                    without Blackbox’s
                                                    agreement, to no more than 12 months. Employees must give at least 4
                                                    weeks written notice
                                                    before the end date of the original period of their parental leave. The
                                                    notice must specify the
                                                    new end date for the leave. If the period of unpaid parental leave has
                                                    been extended once,
                                                    it cannot be extended further without mutual agreement. Any extension
                                                    cannot result in the
                                                    worker exceeding the maximum 12-month period of parental leave
                                                    entitlement.
                                                </p>
                                            </div>



                                            <div class="content_details">
                                                <h3><b>7.7&nbsp;&nbsp; Unpaid Special Maternity Leave</b></h3>


                                                <p>
                                                    Special maternity leave is unpaid leave taken by a female Employee:
                                                </p>
                                                <ul>
                                                    <li>who is not fit for work because she has a pregnancy-related illness;
                                                        or</li>
                                                    <li>whose pregnancy has ended unexpectedly within 28 weeks of the
                                                        expected date of birth</li>
                                                </ul>
                                                <p>
                                                    To be eligible for special maternity leave, the Employee must first meet
                                                    the 12 months
                                                    continuous service requirements. They must provide a written notice
                                                    stating the period or
                                                    expected period of leave as soon as possible, which may be after the
                                                    leave has started.
                                                </p>
                                                <p>
                                                    If the Employee requires the special maternity leave because of a
                                                    pregnancy-related illness,
                                                    they must provide a medical certificate or other reasonable evidence
                                                    such as statutory
                                                    declaration, if requested.
                                                </p>
                                            </div>

                                            <div class="content_details">
                                                <h3><b>7.8&nbsp;&nbsp; Transferring a Pregnant Employee to a Safe Job</b>
                                                </h3>


                                                <p>
                                                    A pregnant worker may be entitled to be transferred from her current job
                                                    to an appropriate
                                                    safe job for an interval before she starts unpaid parental leave.
                                                </p>
                                                <p>A safe job is a job that a pregnant Employee may perform on a temporary
                                                    basis because it
                                                    is no longer safe to continue working in her original role. This may be
                                                    due to hazards
                                                    associated with her position, e.g. because the role requires physical
                                                    effort.</p>

                                                <p>
                                                    If a pregnant Employee is unable to work in her usual role and there are
                                                    no appropriate safe
                                                    jobs available, the Employee is entitled to take paid no safe job leave.
                                                </p>
                                            </div>

                                            <div class="content_details">
                                                <h3><b>7.9&nbsp;&nbsp; Obligation to Consult with the Employee during
                                                        Parental Leave</b></h3>


                                                <p>
                                                    Under the NES, Blackbox must take all reasonable steps to consult with
                                                    an Employee while
                                                    they are on UPL. This means Blackbox will communicate with the Employee
                                                    about any
                                                    decisions that will have a significant effect on the:
                                                </p>
                                                <ul>
                                                    <li>status;</li>
                                                    <li>pay; or</li>
                                                    <li>
                                                        location,
                                                    </li>
                                                </ul>
                                                <p>
                                                    of their pre-parental leave position.
                                                </p>
                                                <p>
                                                    If the Employee requires the special maternity leave because of a
                                                    pregnancy-related illness,
                                                    they must provide a medical certificate or other reasonable evidence
                                                    such as statutory
                                                    declaration, if requested.
                                                </p>
                                            </div>

                                            <div class="content_details">
                                                <h3><b>7.10&nbsp;&nbsp; Keeping in Touch Days</b></h3>


                                                <p>
                                                    Employees on UPL may take up to 10 ‘keeping in touch days’.
                                                </p>
                                                <p>
                                                    A keeping in touch day is a day on which an Employee performs work for
                                                    Blackbox to keep
                                                    in touch with their employment to facilitate their return to that role.
                                                </p>
                                                <p>
                                                    A worker can perform paid work up to 10 keeping in touch days while they
                                                    are taking unpaid
                                                    parental leave without breaking the continuity of their period of UPL.
                                                </p>
                                                <p>
                                                    Keeping in touch days can be used for such things as:
                                                </p>
                                                <ul>
                                                    <li>attending to directed administrative roles. Maintaining and
                                                        attending to their work
                                                        allocated email account where appropriate.</li>
                                                    <li>inviting the Employee on parental leave to attend any social events,
                                                        planning days, training
                                                        and development or team building days which occur during their
                                                        leave.</li>
                                                    <li>
                                                        arranging a meeting with the Employee when they are nearing the end
                                                        of their leave to
                                                        discuss the return-to-work expectations of the Employee, such as
                                                        hours of work, flexible
                                                        working arrangements, or any adjustments that will need to be made
                                                        to their role.
                                                    </li>
                                                </ul>

                                            </div>

                                            <div class="content_details">
                                                <h3><b>7.11&nbsp;&nbsp; Return to Work</b></h3>


                                                <p>
                                                    After a period of parental leave, an Employee is entitled to return to
                                                    the same position they
                                                    had before they went on leave (or the position they had before they were
                                                    transferred to a safe
                                                    job or received no safe job leave).
                                                </p>
                                                <p>
                                                    If the position no longer exists, the Employee is legally entitled to
                                                    return to an available
                                                    position for which they are qualified and suited, which is nearest in
                                                    status and pay to their
                                                    pre-parental leave position.
                                                </p>
                                                <p>
                                                    Eight weeks prior to an Employee’s scheduled return to work, they must
                                                    contact their Manager
                                                    in writing and advise them of their intentions whether or not they will
                                                    be returning to work.
                                                </p>
                                            </div>

                                            <div class="content_details">
                                                <h3><b>7.12&nbsp;&nbsp; Flexible Working Arrangements</b></h3>


                                                <p>
                                                    An Employee returning to work after UPL can request flexible working
                                                    arrangements (such
                                                    as changes in hours of work). Blackbox can only refuse such a request on
                                                    reasonable
                                                    business grounds.
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{-- Other Leave Types --}}
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link collapsed" data-toggle="collapse" href="#OtherLeaveType"
                                    aria-expanded="false">
                                    Other Leave Types
                                </a>
                            </div>
                            <div id="OtherLeaveType" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body p-0">
                                    <div class="custom--content-abb">
                                        <div class="cms-accordion-content-area">
                                            <div class="content_wrapper tab_content my-4">
                                                <div class="content_details">
                                                    <h3 class="mb-3"><b>8.&nbsp;&nbsp; Additional Discretionary Leave</b>
                                                    </h3>

                                                    <p>
                                                        While Employees are eligible for standard assistance such as
                                                        personal leave and
                                                        bereavement leave, Blackbox will consider all requests for
                                                        additional leave (paid or unpaid)
                                                        in addition to standard entitlements during personal crisis, within
                                                        the reasonable limits of
                                                        resources and operational requirements. Employees should speak with
                                                        their direct Manager
                                                        if such provisions are required
                                                    </p>
                                                </div>

                                                <div class="content_details">
                                                    <h3 class="mb-3"><b>9.&nbsp;&nbsp; Study Leave</b></h3>

                                                    <p>
                                                        Blackbox encourages and will support where possible, Employees
                                                        taking part in formal study
                                                        relevant to their work. Support will generally be in the form of
                                                        time off to attend classes and/or
                                                        examinations, but will need to be assessed in relation to
                                                        operational needs.
                                                    </p>
                                                    <p>
                                                        Generally, Blackbox will provide two days only of paid study leave
                                                        per semester for
                                                        examination preparation and examination attendance. Any leave in
                                                        excess of these two days
                                                        is to be taken as annual leave.
                                                    </p>
                                                    <p>
                                                        Study leave requires prior approval from your Manager and cannot be
                                                        taken or awarded prior
                                                        to any request being documented and subsequent approval being given.
                                                    </p>
                                                </div>

                                                <div class="content_details">
                                                    <h3 class="mb-3"><b>10.&nbsp;&nbsp; Public Holidays</b></h3>

                                                    <p>
                                                        You are entitled to be absent from work on a day or part day that is
                                                        a public holiday in
                                                        accordance with the Fair Work Act, unless reasonably required to
                                                        work by the Employer, or
                                                        it is a term of your Employment Contract.
                                                    </p>
                                                </div>

                                                <div class="content_details">
                                                    <h3 class="mb-3"><b>11.&nbsp;&nbsp; Purchased Leave</b></h3>

                                                    <p>
                                                        Permanent Employees with a minimum of 12 months continuous service
                                                        are entitled to
                                                        purchase annual leave (<b>Purchased Leave</b>) in addition to their
                                                        normal leave entitlement
                                                        subject to fulfilling the following requirements, whereby, Purchased
                                                        Leave:
                                                    </p>

                                                    <ol type="a" class="level-2">
                                                        <li>is a scheme which meets the requirements of Section 324 of the
                                                            Fair Work Act 2009
                                                            whereby employees enter into an agreement to buy and access up
                                                            to 4 weeks leave
                                                            in addition to their normal entitlement to paid annual leave.
                                                        </li>
                                                        <li>will be credited into an Employee's leave balance and will be
                                                            paid for via fortnightly
                                                            deductions commencing from the date approval is granted for the
                                                            Employee to
                                                            purchase leave. This leave must be paid for in full within the
                                                            same calendar year in
                                                            which it is approved.</li>
                                                        <li>by Employees automatically revert to their normal salary at the
                                                            end of the deduction
                                                            period, unless approval is obtained for subsequent purchased
                                                            leave arrangements for
                                                            a further period.</li>
                                                        <li>is available to Employees where they have at the time of
                                                            applying to purchase leave,
                                                            an annual leave balance and/or a long service leave entitlement
                                                            of less than 6 weeks.
                                                            Employees will not be eligible to purchase leave if the Employee
                                                            is receiving
                                                            WorkCover payments. Applications cannot be retrospectively
                                                            approved.</li>
                                                        <li>approved Purchased Leave is to be taken in one week (5 day)
                                                            blocks. The Purchased
                                                            Leave Application Form will require employees to clearly detail
                                                            the dates of intended
                                                            use of the purchased leave.
                                                        </li>
                                                        <li>Superannuation payments made by Blackbox and, where applicable,
                                                            by the Employee,
                                                            will be paid at the rate appropriate to the Employee's reduced
                                                            gross salary.</li>
                                                        <li>will not qualify for annual leave loading payments as specified
                                                            under clause 5.6.</li>
                                                        <li>deductions made for leave not accessed will be refunded if the
                                                            Employee terminates
                                                            their employment before taking any or all of the Purchased
                                                            Leave.</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{-- General --}}
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link collapsed" data-toggle="collapse" href="#General"
                                    aria-expanded="false">
                                    General
                                </a>
                            </div>
                            <div id="General" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body p-0">
                                    <div class="custom--content-abb">
                                         <div class="content_wrapper tab_content my-4">
                                                <div class="content_details">
                                                    <h3 class="mb-3"><b>12.&nbsp;&nbsp; Further Information</b>
                                                    </h3>

                                                    <p>
                                                        Please contact your Manager if you require additional information in relation to this policy.
                                                    </p>
                                                </div>

                                                <div class="content_details">
                                                    <hr style="background: #000; height:2px;">
                                                    <p> This policy was last updated 02-04-2026.</p>
                                                </div>
                                         </div>    
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- row end --}}
        </div>
        {{-- end Main Content --}}
    </div>
@endsection
