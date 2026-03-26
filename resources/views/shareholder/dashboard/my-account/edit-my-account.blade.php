@extends('layouts.shareholder')
@section('content')
@section('style')
@endsection


<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1">My Account</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                    
                    <ol>
                        <li>Use this feature to keep up to date your personal details.</li>
                        <li>Make sure you take the time to complete everything, it will help you manage your
                            Account much better, especially with communication. If you are not sure about any of the
                            settings, get in touch with our Help Centre by raising a <a href="{{ route('shareholder.submit') }}"
                                            class="custom_links_design">Support Ticket</a>.
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    


    <div class="row">
    <!-- ALERT MESSAGE -->
    <div class="col-md-12 mb-3">
        <div id="formAlert" class="alert d-none rounded" role="alert"></div>
    </div>

    <div class="col-md-12 mb-5">
        <div id="accordion" class="myacording-design">
            <div class="card">

                <div class="card-body" style="border: none;margin-top: 0px;padding-top: 0px;">
                    <form id="userProfile" class="v-form-design" action="#" method="POST">

                        <input type="hidden" name="user_id" value="1">

                        <!-- Personal Details -->
                        <div class="row">
                            <div class=" mb-3 w-100">
                                <h5 class="border-bottom pb-1 text-blue-primary">Personal Details</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10 px-0">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="my-agent">Shareholder</label>
                                            <input type="text" class="form-control rounded-0"
                                                name="shareholder" id="shareholder"
                                                value="123 Main Street">
                                            <span class="text-danger error-shareholder"></span>
                                        </div>
                                    </div>

                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="my-agent">Address</label>
                                            <input type="text" class="form-control rounded-0"
                                                name="address" id="address"
                                                value="123 Main Street">
                                            <span class="text-danger error-address"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="my-agent">Contact</label>
                                            <input type="text" class="form-control rounded-0"
                                                name="contact" id="contact"
                                                value="9876543210">
                                            <span class="text-danger error-contact"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="my-agent">Mobile</label>
                                            <input type="text" class="form-control rounded-0"
                                                name="phone" id="phone"
                                                value="9876543210">
                                            <span class="text-danger error-phone"></span>
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="my-agent">Email</label>
                                            <input type="text" class="form-control rounded-0"
                                                name="email" id="email"
                                                value="9876543210">
                                            <span class="text-danger error-email"></span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        

                        <!-- Building Security -->
                        <div class="row">
                            <div class=" mb-3 w-100">
                                <h5 class="border-bottom pb-1 text-blue-primary">Method of Contact</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10 px-0">
                                <div class="row">
                                    <div class="col-md-6">
                                         <div class="form-group">
                                            <div class="form-check form-check-inline ml-0">
                                            <input class="form-check-input" type="checkbox" id="text" name="contact_type[]" value="2">
                                            <label class="form-check-label" for="text">Text</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="email" name="contact_type[]" value="3" checked>
                                                <label class="form-check-label" for="email">Email</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="call_me" name="contact_type[]" value="4" >
                                                <label class="form-check-label" for="call_me">Call me</label>
                                            </div>
                                         </div>    
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Building Security -->
                        <div class="row">
                            <div class=" mb-3 w-100">
                                <h5 class="border-bottom pb-1 text-blue-primary">Idle Time Preference</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10 px-0">
                                <div class="row">
                                    <div class="col-md-6">
                                         <div class="form-group">
                                            <!-- Idle Time -->
                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="radio" name="idle_preference_time" checked>
                                                <label class="form-check-label">15 minutes</label>
                                            </div>

                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="radio" name="idle_preference_time">
                                                <label class="form-check-label">30 minutes</label>
                                            </div>

                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="radio" name="idle_preference_time">
                                                <label class="form-check-label">60 minutes</label>
                                            </div>

                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="radio" name="idle_preference_time">
                                                <label class="form-check-label">Never</label>
                                            </div>
                                            <div>
                                                <i id="emailHelp">Set the Idle time before you are logged out of your Console.</i>
                                            </div> 
                                         </div>  
                                            
                                    </div>
                                </div>
                            </div>
                        </div>


                         <!-- Building Security -->
                        <div class="row">
                            <div class=" mb-3 w-100">
                                <h5 class="border-bottom pb-1 text-blue-primary">2FA Authentification</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10 px-0">
                                <div class="row">
                                    <div class="col-md-12">
                                         <div class="form-group">
                                             <!-- 2FA -->
                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="radio" name="twofa" >
                                                <label class="form-check-label">Email</label>
                                            </div>

                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="radio" name="twofa" checked>
                                                <label class="form-check-label">Text</label>
                                            </div>
                                            <div>
                                                <i id="emailHelp">How your authentication code will be sent to you.</i>
                                            </div>
                                         </div>  
                                           
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                       

                        <input type="submit" value="save"
                            class="btn btn-primary shadow-none float-right" name="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@section('script')
<script>
    
</script>
@endsection
