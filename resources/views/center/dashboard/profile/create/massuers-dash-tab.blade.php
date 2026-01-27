
<div class="tab-pane fade" id="massuers" role="tabpanel" aria-labelledby="massuers-tab">
    <div class="col-lg-12">
        <div class="member-id pl-0 pl-0 pb-2 pt-3">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 10C12.42 10 16 11.79 16 14V16H0V14C0 11.79 3.58 10 8 10Z" fill="#C2CFE0" />
            </svg>
            <span>Member ID: {{auth()->user()->member_id}}</span>
        </div>
    </div>
    <div class="about_me_drop_down_info p-4 profile-sec">
        <div class="fill_profile_headings_global">
            <div class="row">
                <div class="col-lg-6">
                    <h2>Default Masseurs</h2>
                </div>
                <!-- end col -->
                <div class="col-lg-6 text-right">
                <button type="button"  data-toggle="modal" data-target="#select_profile" class="save_profile_btn">Change Masseurs</button>
                {{-- <button type="button" data-toggle="modal" data-target="#create_new_profile" class="save_profile_btn">Add Masseurs</button> --}}
                </div>
            </div>
            <!-- end row -->

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive pt-3" id="sailorTableArea">
                    <table id="selected_masseur"  class="table" width="100%">
                        <thead class="bg-first">
                            <tr>
                                <th>Profile</th>
                                <!-- <th>Available Time</th> -->
                                <th>Available Days</th>
                                <th>Nationality</th>
                                <th> Ethnicity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            <!-- <tr>
                                <td><img src="{{ asset('assets/dashboard/img/avatar.png') }}" class="custompopicon"></td>
                                <td>8am - 7pm</td>
                                <td><span class="available_d"><span style="color:red;">M</span>T<span style="color:red;">W</span>THF</span></td>
                                <td>Australian </td>
                                <td>Thai</td>
                               
                                <td>
                                    <div class="edit_option">
                                        <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                                <a class="dropdown-item d-flex justify-content-start gap-10" href="#"><i class="fa fa-fw fa-pen"></i> Edit </a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item d-flex justify-content-start gap-10" href="#"><i class="fa fa-fw fa-trash"></i> Remove </a>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                           

                            <tr>
                                <td><img src="{{ asset('assets/dashboard/img/avatar.png') }}" class="custompopicon"></td>
                                <td>8am - 7pm</td>
                                <td><span class="available_d"><span style="color:red;">M</span>T<span style="color:red;">W</span>THF</span></td>
                                <td>Australian </td>
                                <td>Thai</td>
                               
                                <td>
                                <div class="edit_option">
                                    <div class="dropdown no-arrow archive-dropdown">
                                        <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                            <a class="dropdown-item d-flex justify-content-start gap-10" href="#"><i class="fa fa-fw fa-pen"></i> Edit </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex justify-content-start gap-10" href="#"><i class="fa fa-fw fa-trash"></i> Remove </a>
                                         <a class="dropdown-item d-flex justify-content-start gap-10" href="#">Duplicate <i class="fa fa-fw fa-clone"></i> </a> --> 
                                        </div>
                                    </div>
                                </div>
                                </td>
                            </tr> 
                            <!-- end tr -->


                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end col -->
        </div>
        
    </div>
   
    <!-- check out btns -->
    <div class="tab_btm_btns_preview_and_next">
        <div class="row py-3">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 a_text_white_hover previous_bt_center_in_sm">
                <a href="javascript:void(0)" class="prev_step_btn" id="contact-tab-prev" data-toggle="tab" role="tab" aria-controls="contact" aria-selected="false">
                <i class="fas fa-arrow-left"></i>&nbsp;Previous Step</a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 text-right a_text_white_hover previous_bt_center_in_sm">                
                <!-- <a href="#" class="save_profile_btn">Preview Profile</a> -->
                <input type="hidden" name="massage_profile_id"   id="massage_profile_id">              
                <button type="submit" id="submit_form_massage" class=" btn_width_hundred save_profile_btn">Save Profile</button>
            </div>
            
        </div>
    </div>
</div>





<!-- modal change profile -->
<div class="modal fade upload-modal create_n_p" id="select_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"> <img src="{{ asset('assets/dashboard/img/add-mass.png') }}" class="custompopicon"> Change Masseurs</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body">                       
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive py-3 list-sec" >
                            <table id="masseurs_Tab" class="table table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="ckbox">
                                                <input type="checkbox" id="checkbox1">
                                            </div>
                                        </th>
                                        <th>Profile</th>
                                        <!-- <th>Available Time</th> -->
                                        <th>Available Days</th>
                                        <th>Ethnicity</th>
                                        <th>Nationality</th>
                                        <!-- <th class="text-center">Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>


                                   

                                    


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-md-12 text-right pr-4">
                        <button type="btn" class="btn-cancel-modal"  class="close" data-dismiss="modal" aria-label="Close">Close</button>   
                        <button type="button" class="btn-success-modal add_masseurs">Save</button>   
                    </div>
                    <!-- end col -->

                </div>                
            </div>
        </div>
    </div>
</div>
<!-- end -->