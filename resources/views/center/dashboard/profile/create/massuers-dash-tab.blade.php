
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
                    <table id="sailorTable" class="table" width="100%">
                        <thead class="bg-first">
                            <tr>
                                <th>Profile</th>
                                <th>Available Time</th>
                                <th>Available Days</th>
                                <th>Nationality</th>
                                <th> Ethnicity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            <tr>
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
                            <!-- end tr -->

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
                                            <!-- <a class="dropdown-item d-flex justify-content-start gap-10" href="#">Duplicate <i class="fa fa-fw fa-clone"></i> </a> --> 
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


<!-- modal add masseurs -->
<div class="modal fade upload-modal create_n_p" id="create_new_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"> <img src="{{ asset('assets/dashboard/img/add-mass.png') }}" class="custompopicon"> Create New Masseurs Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-0">                        
                <div class="row">
                    <div class="col-12 col-sm-12 col-lg-5 col-md-5">
                            
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="plate">
                                            <label class="newbtn w-100">                                            
                                                <img class="img-fluid w-100" id="img1" src="{{ asset('assets/app/img/new-frame_profile_c.png') }}">
                                                
                                                <input name="img[1]" id="pic1" data-id="1" class="pis" onchange="readURL(this);" type="file">
                                                <input type="hidden" name="position[]" id="mediaId1">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 d-flex justify-content-between mt-2">
                                        <div class="plate">
                                            <label class="newbtn">
                                            <img class="img-fluid w-100" id="img2" src="{{ asset('assets/app/img/create_2.png') }}">
                                            <input name="img[2]" id="pic2" data-id="2" class="pis" onchange="readURL(this);" type="file">
                                            <input type="hidden" name="position[]" id="mediaId2">
                                            </label>
                                        </div>
                                        <!-- end plate -->

                                        <div class="plate">
                                            <label class="newbtn">
                                            <img class="img-fluid w-100" id="img2" src="{{ asset('assets/app/img/create_2.png') }}">
                                            <input name="img[3]" id="pic3" data-id="3" class="pis" onchange="readURL(this);" type="file">
                                            <input type="hidden" name="position[]" id="mediaId3">
                                            </label>
                                        </div>
                                        <!-- end plate -->
                                        <div class="plate">
                                            <label class="newbtn">
                                            <img class="img-fluid w-100" id="img2" src="{{ asset('assets/app/img/create_2.png') }}">
                                            <input name="img[4]" id="pic4" data-id="4" class="pis" onchange="readURL(this);" type="file">
                                            <input type="hidden" name="position[]" id="mediaId4">
                                            </label>
                                        </div>
                                        <!-- end plate -->
                                        
                                    
                                    </div>
                                </div>
                            
                        </div>
                        <!-- end col -->
                    <div class="col-12 col-lg-7 col-sm-12 col-md-7 p-lg-0 create_new_profile_form">
                        <form>
                            <div class="col-lg-12">
                                <div class="member-id pl-0 pl-0 pb-2 pt-3">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 10C12.42 10 16 11.79 16 14V16H0V14C0 11.79 3.58 10 8 10Z" fill="#FF3C5F" />
                                    </svg>
                                    <span>Member ID: {{auth()->user()->member_id}}</span>
                                
                                </div>
                            </div>
                            <div class="profiles-wrapper">
                                <div class="create-massuer-profile">
                                    <div class="form-group">
                                        <label for="Stage Name">Stage Name:</label>
                                        <input type="text" class="form-control" placeholder="Stage Name">
                                    </div> 
                                </div>
                            
                                <div class="create-massuer-profile">                                 
                                    <div class="form-group">
                                        <label for="Age">AGE:</label>
                                        <input type="text" class="form-control" placeholder="Enter Age">
                                    </div> 
                                </div>

                                <div class="create-massuer-profile">                                 
                                    <div class="form-group">
                                        <label for="Availabe Time">Availabe Time:</label>
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow" id="service_id_one">
                                            <option value="" selected="" disable=""></option>
                                            
                                        </select>
                                    </div> 
                                </div>

                                <div class="create-massuer-profile">                                 
                                    <div class="form-group">
                                        <label for="Nationality">Nationality:</label>
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow" id="service_id_one">
                                            <option value="" selected="" disable=""></option>
                                        </select>
                                    </div> 
                                </div>

                                <div class="create-massuer-profile">                                 
                                    <div class="form-group">
                                        <label for="type">Types:</label>
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow" id="service_id_one">
                                            @foreach(@config('escorts.profile.masseur-types') as $key =>$value)
                                                <option value="{{$key}}" {{ (request()->get('masseur_types') ==$key) ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                </div>

                                <div class="create-massuer-profile">                                 
                                    <div class="form-group">
                                        <label for="Availabe Days">Availabe Days:</label>
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow" id="service_id_one">
                                            <option value="" selected="" disable=""></option>
                                        </select>
                                    </div> 
                                </div>

                                <div class="create-massuer-profile">                                 
                                    <div class="form-group">
                                        <label for="Mobile Number">Mobile Number:</label>
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow" id="service_id_one">
                                            <option value="" selected="" disable=""></option>
                                        </select>
                                    </div> 
                                </div>

                                <div class="create-massuer-profile">                                 
                                    <div class="form-group">
                                        <label for="Vaccinated">Vaccinated:</label>
                                        <select class="form-control form-control-sm select_tag_remove_box_sadow" id="service_id_one">
                                            <option value="" selected="" disable=""></option>
                                        </select>
                                    </div> 
                                </div>
                                <div class="create-massuer-profile">                                 
                                    <div class="form-group">
                                        <label for="message">Message:</label>
                                        <textarea id="editor2" class="form-control" rows="2">
                                        </textarea>
                                    </div> 
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 text-right">
                                    <button type="button" class="btn-cancel-modal" class="close" data-dismiss="modal" aria-label="Close">Close</button>
                                    <button type="button" class="btn-success-modal">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end-->


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
                        <div class="table-responsive py-3 list-sec" id="sailorTableArea">
                            <table id="sailorTable" class="table table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="ckbox">
                                                <input type="checkbox" id="checkbox1">
                                            </div>
                                        </th>
                                        <th>Profile</th>
                                        <th>Available Time</th>
                                        <th>Available Days</th>
                                        <th>Ethnicity</th>
                                        <th>Nationality</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    <tr>
                                        <td>
                                            <div class="ckbox">
                                                <input type="checkbox" id="checkbox1">
                                            </div>
                                        </td>
                                        <td><img src="{{ asset('assets/dashboard/img/avatar.png') }}" class="custompopicon"></td>
                                        <td>8am - 7pm</td>
                                        <td><span class="available_d"><span style="color:red;">M</span>T<span style="color:red;">W</span>THF</span></td>
                                        <td>Australian</td>
                                        <td>Thai</td>
                                    
                                        <td class="text-center">
                                            <div class="dropdown no-arrow archive-dropdown">
                                                <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                                    <a class="dropdown-item d-flex justify-content-start gap-10" href="#"> <i class="fa fa-fw fa-pen"></i> Edit</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item d-flex justify-content-start gap-10" href="#"> <i class="fa fa-fw fa-trash"></i> Delete</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item d-flex justify-content-start gap-10" href="#"> <i class="fa fa-fw fa-clone"></i> Duplicate</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- end tr -->

                                    <tr>
                                        <td>
                                            <div class="ckbox">
                                                <input type="checkbox" id="checkbox1">
                                            </div>
                                        </td>
                                        <td><img src="{{ asset('assets/dashboard/img/avatar.png') }}" class="custompopicon"></td>
                                        <td>8am - 7pm</td>
                                        <td><span class="available_d"><span style="color:red;">M</span>T<span style="color:red;">W</span>THF</span></td>
                                        <td>Australian</td>
                                        <td>Thai</td>
                                    
                                        <td class="text-center">
                                            <div class="dropdown no-arrow archive-dropdown">
                                                <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                                    <a class="dropdown-item d-flex justify-content-start gap-10" href="#"> <i class="fa fa-fw fa-pen"></i> Edit</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item d-flex justify-content-start gap-10" href="#"> <i class="fa fa-fw fa-trash"></i> Delete</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item d-flex justify-content-start gap-10" href="#"> <i class="fa fa-fw fa-clone"></i> Duplicate</a>
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

                    <div class="col-md-12 text-right pr-4">
                        <button type="btn" class="btn-cancel-modal"  class="close" data-dismiss="modal" aria-label="Close">Close</button>   
                        <button type="btn" class="btn-success-modal">Save</button>   
                    </div>
                    <!-- end col -->

                </div>                
            </div>
        </div>
    </div>
</div>
<!-- end -->