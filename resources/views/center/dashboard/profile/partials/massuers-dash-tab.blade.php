
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
                    <h2>Massuers</h2>
                </div>
                <!-- end col -->
                <div class="col-lg-6 text-right">
                <button type="button"  data-toggle="modal" data-target="#select_profile" class="save_profile_btn">Select Profile</button>
                <button type="button" data-toggle="modal" data-target="#create_new_profile" class="save_profile_btn">Add New Profile</button>
                </div>
            </div>
            <!-- end row -->

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive pl-2 pt-3 list-sec" id="sailorTableArea">
                    <table id="sailorTable" class="table table-striped" width="100%">
                        <thead>
                            <tr>
                                <!-- <th>
                                    <div class="ckbox">
                                        <input type="checkbox" id="checkbox1"> </div>
                                </th> -->
                                <th>Profile Name <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-left: 20px;">
                                        <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                    </svg></th>
                                <th>Available Time</th>
                                <th>Available Days</th>
                                <th>Types</th>
                                <th>Nationality</th>
                                <!-- <th>Subscription Status</th> -->
                                <th>Date Joined</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            <tr class="tr-sec">
                                <!-- <td>
                                    <div class="ckbox">
                                        <input type="checkbox" id="checkbox1"> </div>
                                </td> -->
                                <td><img src="{{ asset('avatars/imageuser.png') }}" class="img-profile rounded-circle">&nbsp;&nbsp; Massuers 001</td>
                                <td>8am - 7pm</td>
                                <td><span class="available_d"><span style="color:red;">M</span>T<span style="color:red;">W</span>THF</span></td>
                                <td>Thai</td>
                                <td>Australian</td>
                               <!-- <td>Active</td> -->
                                <td>10/05/2022</td>
                               
                                <td>
                                    <div class="edit_option">
                                        <div class="dropdown no-arrow archive-dropdown">
                                            <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style=""> <a class="dropdown-item" href="#">Edit <i class="fa fa-fw fa-pen" style="float: right;"></i></a> <a class="dropdown-item" href="#">Remove <i class="fa fa-fw fa-trash" style="float: right;"></i> </a> <!-- <a class="dropdown-item" href="#">Duplicate <i class="fa fa-fw fa-clone" style="float: right;"></i> </a> --> </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- end tr -->

                            <tr class="tr-third">
                                <!-- <td>
                                    <div class="ckbox">
                                        <input type="checkbox" id="checkbox1"> </div>
                                </td> -->
                                <td><img src="{{ asset('avatars/imageuser.png') }}" class="img-profile rounded-circle">&nbsp;&nbsp; Massuers 002</td>
                                <td>8am - 7pm</td>
                                <td><span class="available_d"><span style="color:red;">M</span>T<span style="color:red;">W</span>THF</span></td>
                                <td>Thai</td>
                                <td>Australian</td>
                               <!-- <td>Active</td> -->
                                <td>10/05/2022</td>
                               
                                <td>
                                <div class="edit_option">
                                    <div class="dropdown no-arrow archive-dropdown">
                                        <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style=""> <a class="dropdown-item" href="#">Edit <i class="fa fa-fw fa-pen" style="float: right;"></i></a><!-- <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i> </a> <a class="dropdown-item" href="#">Duplicate <i class="fa fa-fw fa-clone" style="float: right;"></i> </a>--> </div>
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

            <div class="col-md-12 text-right">
                <button type="btn" class="save_profile_btn">Save</button>   
            </div>
            <!-- end col -->

        </div>
        
    </div>
    {{-- <div class="tab_btm_btns_preview_and_next">
        <div class="row pt-3 pb-3">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 previous_bt_center_in_sm text-right a_text_white_hover">
                <a href="{{ route('profile.description',$escort->id)}}" class="save_profile_btn">Preview</a>
                <a href="#pricing" class="nex_sterp_btn" id="massuers-tab" data-toggle="tab" role="tab" aria-controls="contact" aria-selected="false">Next Step
                <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div> --}}
</div>


<!-- modal -->
<div class="modal fade upload-modal create_n_p" id="create_new_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Create New Massuers New Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/cross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-0">
                        
                <div class="row">
                    <div class="col-12 col-sm-12 col-lg-5 col-md-5">
                            
                                <div class="row">
                                    <div class="col-8 pr-0">
                                        <div class="plate"><label class="newbtn">                                            
                                            <img class="img-fluid w-100" id="img1" src="{{ asset('assets/app/img/frame_profile_c.png') }}">
                                            
                                            <input name="img[1]" id="pic1" data-id="1" class="pis" onchange="readURL(this);" type="file">
                                            <input type="hidden" name="position[]" id="mediaId1">
                            </label>
                                        </div>
                                    </div>
                                    <div class="col-4">
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
                        <div class="form-group row">
                            <div class="col-sm-7 row my-auto">
                                <div class="col-12 col-lg-5 col-sm-5 col-md-5 p-0 pr-1 pl-1">
                                <label class="new_style2">Stage Name:</label>
                                </div>
                                <!-- end col -->
                                <div class="col-sm-7 p-0">
                                <input type="text" class="form-control" placeholder="Stage Name">
                                </div>
                                <!-- end col  -->
                            </div>
                           <!-- <div class="col-sm-5 row pt-2">
                                <div class="col-12 col-lg-5 col-sm-5 col-md-5 p-0 pr-1 pl-1 text-right mt-auto mb-auto">
                                <img src="{{ asset('assets/app/img/handwithhart.png') }}">
                                </div>
                                <!-- end col -->
                               <!-- <div class="col-sm-7 p-0">
                                <label class="new_style">Massage:</label>
                                
                                <input type="text" class="form-control" placeholder="Enter Rate">
                                </div>
                                <!-- end col  --> 
                           <!-- </div> --> 
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 row">
                                <div class="col-12 col-lg-2 col-sm-2 col-md-2 p-0 pr-1 pl-1 my-auto">
                                <label class="new_style2">AGE:</label>
                                </div>
                                <!-- end col -->
                                <div class="col-sm-7 p-0">
                                <input type="text" class="form-control" placeholder="Enter Age">
                                </div>
                                <!-- end col  -->
                            </div>    
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 row">
                                <div class="col-12 col-lg-5 col-sm-5 col-md-5 p-0 pr-1 pl-1">
                                <label>Availabe Time:</label>
                                </div>
                                <!-- end col -->
                                <div class="col-sm-7 p-0">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="service_id_one">
                                    <option value="" selected="" disable=""></option>
                                    
                                </select>
                                </div>
                                <!-- end col  -->
                            </div>
                            <div class="col-sm-6 row">
                                <div class="col-12 col-lg-5 col-sm-5 col-md-5 p-0 pr-1 pl-1">
                                <label>Nationality:</label>
                                </div>
                                <!-- end col -->
                                <div class="col-sm-7 p-0">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="service_id_one">
                                    <option value="" selected="" disable=""></option>
                                </select>
                                </div>
                                <!-- end col  -->
                            </div>
                            
                            <div class="col-sm-6 row">
                                <div class="col-12 col-lg-5 col-sm-5 col-md-5 p-0 pr-1 pl-1">
                                <label>Types:</label>
                                   
                                </div>
                                <!-- end col -->
                                <div class="col-sm-7 p-0">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="service_id_one">
                                    @foreach(@config('escorts.profile.masseur-types') as $key =>$value)
                                        <option value="{{$key}}" {{ (request()->get('masseur_types') ==$key) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                </select>
                                </div>
                                <!-- end col  -->
                            </div>
                            
                            <div class="col-sm-6 row">
                                <div class="col-12 col-lg-5 col-sm-5 col-md-5 p-0 pr-1 pl-1">
                                <label>Availabe Days:</label>
                                </div>
                                <!-- end col -->
                                <div class="col-sm-7 p-0">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="service_id_one">
                                    <option value="" selected="" disable=""></option>
                                </select>
                                </div>
                                <!-- end col  -->
                            </div>
                            <div class="col-sm-6 row">
                                <div class="col-12 col-lg-5 col-sm-5 col-md-5 p-0 pr-1 pl-1">
                                <label>Mobile Number:</label>
                                </div>
                                <!-- end col -->
                                <div class="col-sm-7 p-0">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="service_id_one">
                                    <option value="" selected="" disable=""></option>
                                </select>
                                </div>
                                <!-- end col  -->
                            </div>

                            <div class="col-sm-6 row">
                                <div class="col-12 col-lg-5 col-sm-5 col-md-5 p-0 pr-1 pl-1">
                                <label>Vaccinated:</label>
                                </div>
                                <!-- end col -->
                                <div class="col-sm-7 p-0">
                                <select class="form-control form-control-sm select_tag_remove_box_sadow" id="service_id_one">
                                    <option value="" selected="" disable=""></option>
                                </select>
                                </div>
                                <!-- end col  -->
                            </div>
                            
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12 row">
                                <textarea id="editor2" class="form-control" rows="2">
                                </textarea> 
                            </div>
                            <div class="col-lg-12">
                                <div class="member-id pl-0 pl-0 pb-2 pt-3">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 10C12.42 10 16 11.79 16 14V16H0V14C0 11.79 3.58 10 8 10Z" fill="#FF3C5F" />
                                    </svg>
                                    <!-- <span>Member ID: {{auth()->user()->member_id}}</span> -->
                                    <span>Member ID: E4U208</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 text-right">
                                <button type="button" class="btn btn-primary px-4">Save</button>
                            </div>
                        </div>
                    </form>
                    </div>
                    <!-- end col -->

                </div>
            </div>

                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="manageImgId">Save</button>
                </div> -->
            </div>
        </div>
    </div>
</div>
<!-- end modal box popup -->


<!-- modal2 -->
<div class="modal fade upload-modal create_n_p" id="select_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Select Massuers Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/cross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body p-0 pt-4 pb-3">
                       
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive pl-0 pt-3 list-sec" id="sailorTableArea">
                        <table id="sailorTable" class="table table-striped" width="100%">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="ckbox">
                                            <input type="checkbox" id="checkbox1"> </div>
                                    </th>
                                    <th>Profile Name <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-left: 20px;">
                                            <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                        </svg></th>
                                    <th>Available Time</th>
                                    <th>Available Days</th>
                                    <th>Types</th>
                                    <th>Nationality</th>
                                    <th>Subscription Status</th>
                                    <th>Date Joined</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                <tr class="tr-sec">
                                    <td>
                                        <div class="ckbox">
                                            <input type="checkbox" id="checkbox1"> </div>
                                    </td>
                                    <td><img src="{{ asset('avatars/imageuser.png') }}" class="img-profile rounded-circle">&nbsp;&nbsp; Massuers 001</td>
                                    <td>8am - 7pm</td>
                                    <td><span class="available_d"><span style="color:red;">M</span>T<span style="color:red;">W</span>THF</span></td>
                                    <td>Thai</td>
                                    <td>Australian</td>
                                <td>Active</td>
                                    <td>10/05/2022</td>
                                
                                    <td>
                                        <div class="dropdown no-arrow archive-dropdown">
                                            <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style=""> <a class="dropdown-item" href="#">Edit <i class="fa fa-fw fa-pen" style="float: right;"></i></a> <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i> </a> <a class="dropdown-item" href="#">Duplicate <i class="fa fa-fw fa-clone" style="float: right;"></i> </a> </div>
                                        </div>
                                    </td>
                                </tr>
                                <!-- end tr -->

                                <tr class="tr-third">
                                    <td>
                                        <div class="ckbox">
                                            <input type="checkbox" id="checkbox1"> </div>
                                    </td>
                                    <td><img src="{{ asset('avatars/imageuser.png') }}" class="img-profile rounded-circle">&nbsp;&nbsp; Massuers 002</td>
                                    <td>8am - 7pm</td>
                                    <td><span class="available_d"><span style="color:red;">M</span>T<span style="color:red;">W</span>THF</span></td>
                                    <td>Thai</td>
                                    <td>Australian</td>
                                <td>Active</td>
                                    <td>10/05/2022</td>
                                
                                    <td>
                                        <div class="dropdown no-arrow archive-dropdown">
                                            <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style=""> <a class="dropdown-item" href="#">Edit <i class="fa fa-fw fa-pen" style="float: right;"></i></a> <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i> </a> <a class="dropdown-item" href="#">Duplicate <i class="fa fa-fw fa-clone" style="float: right;"></i> </a> </div>
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
                    <button type="btn" class="save_profile_btn">Save</button>   
                </div>
                <!-- end col -->

            </div>                
            </div>

                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="manageImgId">Save</button>
                </div> -->
            </div>
        </div>
    </div>
</div>
<!-- end modal2 box popup -->