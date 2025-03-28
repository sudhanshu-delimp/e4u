
<div class="container-fluid">
   <div class="row">
         <div class="col-sm-10 col-md-10 col-lg-10">
            <div class="container-fluid" style="padding:0">
               <nav aria-label="breadcrumb">
                     <ol class="breadcrumb bread-sec pl-0">
                        <li class="breadcrumb-item"><a href="{{ route('agent.manage.escorts.list')}}" style=""><i class="fas fa-long-arrow-alt-left"></i>&nbsp;&nbsp;Back To</a></li>
                        <li class="breadcrumb-item active" aria-current="page">to Advertiser list</li>
                     </ol>
               </nav>
               <div class="d-sm-flex align-items-center justify-content-between mb-4">
                     <h1 class="h3 mb-0 font-weight-bold">Manage Profile <lable id="mp_name"></lable></h1>
               </div>
               <div class="row">
                     <div class="col-lg-4 col-md-12 col-sm-12">
                        {{-- <form class="search-form-bg navbar-search">
                           <div class="input-group">
                                 <input type="text" class="search-form-bg-i form-control border-0 small" placeholder="Search " aria-label="Search" aria-describedby="basic-addon2">
                                 <div class="input-group-append"><button class="btn-right-icon" type="button"><i class="fas fa-search fa-sm"></i></button></div>
                           </div>
                        </form> --}}
                     </div>
                     <div class="col-lg-8 col-md-12 col-sm-12">
                        <div class="bothsearch-form" id="createProfile">

                        </div>
                     </div>
               </div>
            </div>
            <br>
            <div class="row">
               <div class="col-md-12">
                     <div class="panel with-nav-tabs panel-warning">
                        <div class="panel-body">
                           <div class="tab-content">
                                 <div class="tab-pane fade in active show" id="tab1warning">
                                 <div class="table-responsive-xl" id="table-sec">
                                    <table class="table" id="onlyEscortList">
                                             <thead class="table-bg">
                                                <tr>
                                                   <th scope="col">Profile Name</th>
                                                   <th scope="col">Mobile Number</th>
                                                   <th scope="col">Type</th>
                                                   <th scope="col">Membership</th>
                                                   <th scope="col">Home State</th>
                                                   <th scope="col">Age</th>
                                                   <th scope="col">Vaccine</th>
                                                   <th scope="col">Action</th>
                                                </tr>
                                             </thead>
                                             <tbody class="table-content">
                                                <tr class="row-color">
                                                   <td><img src="{{ asset('assets/app/img/profile-image.png')}}">Kathryn Murphy</td>
                                                   <td class="theme-color">0434043981</td>
                                                   <td class="theme-color">Female</td>
                                                   <td class="theme-color">Gold</td>
                                                   <td class="theme-color">SA</td>
                                                   <td class="theme-color">25</td>
                                                   <td class="theme-color">Vaccinated, up to date</td>
                                                   <td class="theme-color">
                                                         <div class="dropdown no-arrow">
                                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a>
                                                            <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                               <a class="dropdown-item" id="manage-profile" href="#">Edit Profile</a>
                                                               <div class="dropdown-divider"></div>
                                                               <a class="dropdown-item" href="#">Delete Profile</a>
                                                            </div>
                                                         </div>
                                                   </td>
                                                </tr>
                                             </tbody>
                                       </table>

                                    </div>
                                 </div>
                           </div>
                        </div>
                     </div>
               </div>
            </div>
         </div>
   </div>
</div>
