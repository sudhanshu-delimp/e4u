<div class="container-fluid register-pin-up mb-5  pl-3 pl-lg-5 pr-3 pr-lg-5">
    <div class="row">
        <div class="d-sm-flex align-items-center justify-content-between col-md-12">
            <div class="custom-heading-wrapper">
                <h1 class="h1">Submit</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b>
                </span>
            </div>
            @if (request('from') == 'dashboard')
                <div class="back-to-dashboard">
                    <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                        <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                    </a>
                </div>
            @endif
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <h3 class="NotesHeader"><b>Notes:</b></h3>
                    <ol>
                        <li>To help us assist you better, when describing your problem or enquiry, please try to provide
                            as much information as
                            possible.
                        </li>
                        <li>Upload any documents or images you have.</li>
                        <li>Allow us a couple of days to respond.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 common-card">

        <form class="common-form" id="supportTicket" method="post" action="{{ route('support-ticket.create') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="row inner-row">
                <div class="col-lg-12">
                    <div class="inner-field-row">
                        <div class="form-group">
                            <label for="sel1"><b>Department</b></label>
                            <select class="form-control" name="department" required>
                                <option id="placeholder" selected="" disabled="" value="">Choose Department
                                </option>
                                @foreach (config("$prefix.supportTicket.departments") as $department)
                                    <option value="{{ $department }}">{{ $department }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sel1"><b>Priority</b></label>
                            <?php
                            
                            ?>
                            <select class="form-control" name="priority">
                                @foreach (config('common.supportTicket.priorities') as $priority)
                                    <option value="{{ $priority }}">{{ $priority }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sel1"><b>Service type</b></label>
                            <select class="form-control" name="service_type" required>
                                <option id="placeholder" selected="" disabled="" value="">Choose Service
                                </option>
                                @foreach (config("$prefix.supportTicket.services") as $service)
                                    <option value="{{ $service }}">{{ $service }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sel1"><b>Subject</b></label>
                            <input type="text" class="form-control" placeholder=" " name="subject" required />
                        </div>
                    </div>
                    <div class="inner-field-row">
                        <div class="form-group">
                            <label for="sel1"><b>Message</b></label>
                            <textarea class="form-control custom-texarea" rows="5" id="comment" name="message" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="support_ticket_file"><b>Document / Image upload</b>
                            </label>
                            <label for="support_ticket_file" class="file-upload-box">
                                <input type="file" class="file-input" id="support_ticket_file" name="file">
                                <div class="upload-content">
                                    <div class="upload-icon">
                                        <svg width="25px" height="25px" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg" fill="none">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>

                                            <g id="SVGRepo_iconCarrier">
                                                <path stroke="#ff3c5f" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 10v9m0-9l3 3m-3-3l-3 3m8.5 2c1.519 0 2.5-1.231 2.5-2.75 0-1.264-.854-2.33-2.016-2.65A5 5 0 008.37 8.108a3.5 3.5 0 00-1.87 6.746">
                                                </path>
                                            </g>

                                        </svg>
                                    </div>
                                    <span class="upload-title">Upload a file</span>
                                    <span class="upload-text">
                                        Drag & drop your file here or <strong>browse</strong>
                                    </span>
                                    <span class="upload-hint">PDF, DOC, DOCX, JPG or PNG</span>
                                </div>
                            </label>
                            <p class="cp-hint">
                                <small><i>If you have any other documentation that can assist us with your query,
                                        including images,
                                        please upload them.</i></small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="common-footer col-lg-12">
                    <input type="submit" name="submit" id="submitTicketBtn" class="common-save-btn"
                        value="Submit ticket">
                </div>
            </div>





        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#supportTicket').on('submit', function() {
            $('#submitTicketBtn')
                .prop('disabled', true)
                .val('Sending please wait...');
        });
    });
</script>
