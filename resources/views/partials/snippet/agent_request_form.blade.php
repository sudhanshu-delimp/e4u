
 @if(auth()->user()->is_agent_assign=='1' && auth()->user()->assigned_agent_id!=null)
     <div class="row">
        <div class="col-md-12 my-4">
             <p class="mb-0" style="font-size: 20px;color:red"><b>Note : You have already been assigned an Agent.</b> </p>
        </div>
     </div>
    @endif



<form action="{{route('agent.agent-request')}}" method="post" name="agent_request_frm" id="agent_request_frm">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group w-50">
                                <label for="email"><b>First Name</b> </label>
                                <input id="name" placeholder="First Name" name="first_name" type="text" class="form-control" required="">
                            </div>
                            <div class="form-group w-50">
                                <label for="email"><b>Last Name</b> </label>
                                <input id="name" placeholder="Last Name" name="last_name" type="text" class="form-control" >

                            </div>

                            <div class="form-group w-50">
                                <label for="email"><b>Email</b></label>
                                <input id="name" placeholder="Email Address" name="email" type="text" class="form-control" required>

                            </div>

                            <div class="form-group w-50">
                                <label for="email"><b>Mobile Number</b> </label>
                                <input id="name" placeholder="Mobile Number" name="mobile_number" type="text" class="form-control" required>
                            </div>

                            {{-- <div class="form-group custom-radio mb-0">
                                <label for="email"><b>Contact preference</b> </label><br>
                                <input type="radio" name="contact_by_email" value="1">
                                <label class="m-0" for="html">Show me Agent list</label><br>
                                <input type="radio" id="css" name="contact_by_mobile" value="1">
                                <label for="css">Have Agent contact me (select method below)</label><br>
                            </div> --}}

                            <div class="form-group">
                                <label for="email"><b>Agent</b></label><br>
                                <div class="form-check m-0">
                                    <input class="form-check-input" type="checkbox"  name="contact_by_email" value="1">
                                    <label class="form-check-label" for="Method_Message">Contact me by email</label>
                                </div>
                                <div class="form-check m-0">
                                    <input class="form-check-input" type="checkbox" name="contact_by_mobile" value="1">
                                    <label class="form-check-label" for="Method_Text">Contact me by mobile</label>
                                </div>
                            </div>
                            <div class="form-group w-50">
                                <label for="exampleFormControlTextarea1">
                                    <b>Comments</b> (please provide any additional information to assist us)
                                </label>
                                <textarea class="form-control" id="comments" name="comments" placeholder="Up to 300 characters"></textarea>
                            </div>
                        </div>
                    </div>

                     @if(auth()->user()->is_agent_assign == '0' || auth()->user()->assigned_agent_id == null)
                    <input type="submit" id="submitTicketBtn" value="Submit Request" class="new-btn-sec btn btn-primary shadow-none" name="submit">
                    @endif

                    @csrf
                    @include('partials.snippet.error')
                </form>