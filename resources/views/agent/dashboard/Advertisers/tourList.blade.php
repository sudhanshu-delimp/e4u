<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <div class="row">
        <div class="col-sm-10 col-md-10 col-lg-10">
            <div class="container-fluid" style="padding:0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bread-sec pl-0">
                        <li class="breadcrumb-item"><a href="#" style=""><i class="fas fa-long-arrow-alt-left"></i>&nbsp;&nbsp;Back To</a></li>
                        <li class="breadcrumb-item active" aria-current="page">to Advertiser list</li>
                    </ol>
                </nav>
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 font-weight-bold">Manage Tour <label id="mt_name"></label></h1>
                </div>
                <div class="row">
                    {{-- <div class="col-lg-4 col-md-12 col-sm-12">
                        <form class="search-form-bg navbar-search">
                            <div class="input-group">
                                <input type="text" class="search-form-bg-i form-control border-0 small" placeholder="Search " aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append"><button class="btn-right-icon" type="button"><i class="fas fa-search fa-sm"></i></button></div>
                            </div>
                        </form>
                    </div> --}}
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <div class="bothsearch-form"><button type="button" class="btn btn-primary create-tour-sec dctour" data-toggle="modal" data-target="#Tour_Name">Create New Tour </button></div>
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
                                        <table class="table" id="onlyTourList">
                                            <thead class="table-bg">
                                                <tr>
                                                    <th scope="col">Escort Name</th>
                                                    <th scope="col">Profile Name</th>
                                                    <th scope="col">Tour Name</th>
                                                    <th scope="col">Days</th>
                                                    <th scope="col">Total Cost<sup>(1)</sup></th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-content">
                                                <tr class="row-color">
                                                    <td><img src="{{ asset('assets/app/img/profile-image.png')}}">Kathryn Murphy</td>
                                                    <td class="theme-color">Kathy -Adelaide 1</td>
                                                    <td class="theme-color">Summer Tour</td>
                                                    <td class="theme-color">10</td>
                                                    <td class="theme-color">$80.00</td>
                                                    <td class="theme-color">
                                                        <div class="dropdown no-arrow">
                                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a>
                                                            <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal">Edit Tour</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item" href="#">Delete Tour</a>
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