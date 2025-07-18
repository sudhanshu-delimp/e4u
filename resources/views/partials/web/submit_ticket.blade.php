<div class="container-fluid register-pin-up mb-5  pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!--middle content start here-->
    <div class="row">
        <div class="custom-heading-wrapper col-md-12">
            <h1 class="h1">Submit ticket</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4 mycont">
            <div class="card collapse" id="notes">
                <div class="card-body">
                    <h3 class="NotesHeader"><b>Notes:</b></h3>
                    <ol>
                        <li>To help us assist you better, when describing your problem or enquiry, please try to provide as much information as
                            possible.
                        </li>
                        <li>Upload any documents or images you have.</li>
                        <li>Allow us a couple of days to respond.</li>
                    </ol>
                </div>
            </div>
            <br>
            <form class="mb-4 w-50" id="supportTicket" method="post" action="{{route('support-ticket.create')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="sel1"><b>Department</b></label>
                    <select class="form-control" name="department" required>
                        <option id="placeholder" selected="" disabled="" value="">Choose Department</option>
                        @foreach(config("$prefix.supportTicket.departments") as $department)
                            <option value="{{$department}}">{{$department}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="sel1"><b>Priority</b></label>
                    <?php

                    ?>
                    <select class="form-control" name="priority" >
                        @foreach(config('common.supportTicket.priorities') as $priority)
                            <option value="{{$priority}}">{{$priority}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="sel1"><b>Service type</b></label>
                    <select class="form-control" name="service_type" required>
                        <option id="placeholder" selected="" disabled="" value="">Choose Service</option>
                        @foreach(config("$prefix.supportTicket.services") as $service)
                            <option value="{{$service}}">{{$service}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="sel1"><b>Subject</b></label>
                    <input type="text" class="form-control" placeholder=" " name="subject"   required/>
                </div>
                <div class="form-group">
                    <label for="sel1"><b>Message</b></label>
                    <textarea class="form-control" rows="5" id="comment" name="message" required></textarea>
                </div>

                <div class="form-group">
                    <label for="sel1"><b>Document / Image upload</b>
                    </label>
                    <p>If you have any other documentation that can assist us with your query, including images,
                        please upload them.</p>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="support_ticket_file" name="file">
                        <label class="custom-file-label" for="customFileLang">Insert file upload</label>
                    </div>
                </div>


                <input type="submit" name="submit" id="submitTicketBtn" class="btn btn-primary create-tour-sec dctour mt-3"
                       value="Submit ticket">
            </form>
        </div>
    </div>
    <!--middle content end here-->
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
