@extends('layouts.admin')
@section('content')
<div class="container-fluid">

                    <!--middle content-->
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-9 ">
                            <!-- Begin Page Content -->
                            <div class="container-fluid pl-lg-4">

                                <!-- Page Heading -->

                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <div class="v-main-heading h3">Administrator Dashboard</div>
                                </div>
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <h2 class="h4 mb-0 text-gray-800">Registration</h2>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                            <div class="container">
                                                <div class="row">

                                                    <div class="col-md-3 col-6">
                                                        <div class="admin-box">
                                                            <div>
                                                                <svg width="50" height="50" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect x="0.299805" y="0.5" width="45" height="45" rx="22.5" fill="#F0F0F0"></rect>
                                                                    <path d="M27.1598 25C27.2398 24.34 27.2998 23.68 27.2998 23C27.2998 22.32 27.2398 21.66 27.1598 21H30.5398C30.6998 21.64 30.7998 22.31 30.7998 23C30.7998 23.69 30.6998 24.36 30.5398 25H27.1598ZM25.3898 30.56C25.9898 29.45 26.4498 28.25 26.7698 27H29.7198C28.7598 28.65 27.2298 29.93 25.3898 30.56ZM25.1398 25H20.4598C20.3598 24.34 20.2998 23.68 20.2998 23C20.2998 22.32 20.3598 21.65 20.4598 21H25.1398C25.2298 21.65 25.2998 22.32 25.2998 23C25.2998 23.68 25.2298 24.34 25.1398 25ZM22.7998 30.96C21.9698 29.76 21.2998 28.43 20.8898 27H24.7098C24.2998 28.43 23.6298 29.76 22.7998 30.96ZM18.7998 19H15.8798C16.8298 17.34 18.3698 16.06 20.1998 15.44C19.5998 16.55 19.1498 17.75 18.7998 19ZM15.8798 27H18.7998C19.1498 28.25 19.5998 29.45 20.1998 30.56C18.3698 29.93 16.8298 28.65 15.8798 27ZM15.0598 25C14.8998 24.36 14.7998 23.69 14.7998 23C14.7998 22.31 14.8998 21.64 15.0598 21H18.4398C18.3598 21.66 18.2998 22.32 18.2998 23C18.2998 23.68 18.3598 24.34 18.4398 25H15.0598ZM22.7998 15.03C23.6298 16.23 24.2998 17.57 24.7098 19H20.8898C21.2998 17.57 21.9698 16.23 22.7998 15.03ZM29.7198 19H26.7698C26.4498 17.75 25.9898 16.55 25.3898 15.44C27.2298 16.07 28.7598 17.34 29.7198 19ZM22.7998 13C17.2698 13 12.7998 17.5 12.7998 23C12.7998 25.6522 13.8534 28.1957 15.7287 30.0711C16.6573 30.9997 17.7597 31.7362 18.973 32.2388C20.1862 32.7413 21.4866 33 22.7998 33C25.452 33 27.9955 31.9464 29.8709 30.0711C31.7462 28.1957 32.7998 25.6522 32.7998 23C32.7998 21.6868 32.5411 20.3864 32.0386 19.1732C31.5361 17.9599 30.7995 16.8575 29.8709 15.9289C28.9423 15.0003 27.8399 14.2638 26.6266 13.7612C25.4134 13.2587 24.113 13 22.7998 13Z" fill="black"></path>
                                                                </svg>

                                                                <h3 class="h3">20</h3>
                                                            </div>

                                                            <div style="margin-top: 0px;color: #5D6D7E;">
                                                                Online Member
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-6">
                                                        <div class="admin-box">
                                                            <div>
                                                                <svg width="50" height="50" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect x="0.799805" y="0.5" width="45" height="45" rx="22.5" fill="#F0F0F0"></rect>
                                                                    <path d="M27.2998 28.5001V30.5001H13.2998V28.5001C13.2998 28.5001 13.2998 24.5001 20.2998 24.5001C27.2998 24.5001 27.2998 28.5001 27.2998 28.5001ZM23.7998 19.0001C23.7998 18.3078 23.5945 17.6311 23.2099 17.0556C22.8254 16.48 22.2787 16.0314 21.6392 15.7665C20.9997 15.5016 20.2959 15.4323 19.617 15.5673C18.9381 15.7024 18.3144 16.0357 17.8249 16.5252C17.3354 17.0147 17.0021 17.6383 16.8671 18.3172C16.732 18.9962 16.8013 19.6999 17.0662 20.3394C17.3311 20.979 17.7797 21.5256 18.3553 21.9102C18.9309 22.2948 19.6076 22.5001 20.2998 22.5001C21.2281 22.5001 22.1183 22.1313 22.7747 21.4749C23.4311 20.8185 23.7998 19.9283 23.7998 19.0001ZM27.2398 24.5001C27.8546 24.9758 28.3576 25.5805 28.7135 26.2716C29.0694 26.9626 29.2695 27.7233 29.2998 28.5001V30.5001H33.2998V28.5001C33.2998 28.5001 33.2998 24.8701 27.2398 24.5001ZM26.2998 15.5001C25.6115 15.4962 24.9383 15.702 24.3698 16.0901C24.9772 16.9388 25.3039 17.9563 25.3039 19.0001C25.3039 20.0438 24.9772 21.0613 24.3698 21.9101C24.9383 22.2981 25.6115 22.5039 26.2998 22.5001C27.2281 22.5001 28.1183 22.1313 28.7747 21.4749C29.4311 20.8185 29.7998 19.9283 29.7998 19.0001C29.7998 18.0718 29.4311 17.1816 28.7747 16.5252C28.1183 15.8688 27.2281 15.5001 26.2998 15.5001Z" fill="#0C223D"></path>
                                                                </svg>


                                                                <h3>20+</h3>
                                                            </div>

                                                            <div style="margin-top: 0px;color: #5D6D7E;;">
                                                                Registered Member
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-6">
                                                        <div class="admin-box">
                                                            <div>
                                                                <svg width="50" height="50" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect x="0.799805" y="0.5" width="45" height="45" rx="22.5" fill="#F0F0F0"></rect>
                                                                    <path d="M16.7998 18C16.7998 15.79 18.5898 14 20.7998 14C23.0098 14 24.7998 15.79 24.7998 18C24.7998 20.21 23.0098 22 20.7998 22C18.5898 22 16.7998 20.21 16.7998 18ZM20.7998 24C16.3798 24 12.7998 25.79 12.7998 28V30H23.8898C23.8398 29.67 23.7998 29.34 23.7998 29C23.7998 27.36 24.4598 25.87 25.5398 24.78C24.2098 24.29 22.5798 24 20.7998 24ZM33.7998 29L30.7998 26V28H26.7998V30H30.7998V32L33.7998 29Z" fill="black"></path>
                                                                </svg>


                                                                <h3>5</h3>
                                                            </div>

                                                            <div style="margin-top: 0px;color: #5D6D7E;">
                                                                Awaiting Activation
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <h2 class="h4 mb-0 text-gray-800">E4u Team</h2>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive-xl">
                                            <table class="table">
                                                <thead class="table-bg">
                                                    <tr>
                                                        <th scope="col">

                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                <label class="form-check-label" for="flexCheckDefault"></label>
                                                            </div>

                                                        </th>
                                                        <th scope="col">Team Member <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                                            </svg>
                                                        </th>
                                                        <th scope="col">Position</th>
                                                        <th scope="col">Extension <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                                            </svg></th>
                                                        <th scope="col">Mobile</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Security Level
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody class="table-content">

                                                    <tr class="row-color">
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                <label class="form-check-label" for="flexCheckDefault"></label>
                                                            </div>
                                                        </th>
                                                        <td>
                                                            <img src="img/imageuser.png">Kathryn Murphy
                                                        </td>
                                                        <td class="theme-color">Managing Director</td>
                                                        <td class="theme-color">101</td>
                                                        <td class="theme-color">09818 22 2222</td>
                                                        <td class="theme-color">test@gmail.com</td>
                                                        <td>2</td>

                                                    </tr>
                                                    <tr class="row-color">
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                <label class="form-check-label" for="flexCheckDefault"></label>
                                                            </div>
                                                        </th>
                                                        <td>
                                                            <img src="img/imageuser.png">Kathryn Murphy
                                                        </td>
                                                        <td class="theme-color">Managing Director</td>
                                                        <td class="theme-color">101</td>
                                                        <td class="theme-color">09818 22 2222</td>
                                                        <td class="theme-color">test@gmail.com</td>
                                                        <td>2</td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.container-fluid --><br>

                        </div>
                        <!--middle content end here-->



                        <!--right side bar start from here-->
                        <div class="col-sm-12 col-md-12 col-lg-3 ">

                            <div class="sidebar-box-administrator">
                                <h2 class="h4 mb-0 text-gray-800">Server Status</h2>
                                <table class="sidebar-table">
                                    <tbody><tr>
                                        <td class="leftside-table">Server Time:</td>
                                        <td class="rightside-table">05:22</td>
                                    </tr>
                                    <tr>
                                        <td class="leftside-table">Up Time:</td>
                                        <td class="rightside-table">25 Days | 23hrs</td>
                                    </tr>
                                    <tr>
                                        <td class="leftside-table">Average Load:</td>
                                        <td class="rightside-table">85.9</td>
                                    </tr>

                                </tbody></table>
                            </div>
                            <div class="sidebar-box-administrator">
                                <h2 class="h4 mb-0 text-gray-800">Online Users</h2>
                                <table class="sidebar-table">
                                    <tbody><tr>
                                        <td class="leftside-table">Staff</td>
                                        <td class="rightside-table">01</td>
                                    </tr>
                                    <tr>
                                        <td class="leftside-table">Viewer</td>
                                        <td class="rightside-table">01</td>
                                    </tr>
                                    <tr>
                                        <td class="leftside-table">Agent</td>
                                        <td class="rightside-table">01</td>
                                    </tr>
                                    <tr>
                                        <td class="leftside-table">Advertiser</td>
                                        <td class="rightside-table">01</td>
                                    </tr>

                                </tbody></table>
                            </div>

                        </div>

                    </div>


                    <!--right side bar end-->
                </div>
@endsection
@section('script')
<script>
    
</script>
@endsection
