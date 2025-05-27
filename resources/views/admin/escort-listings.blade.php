@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<style type="text/css">
.parsley-errors-list {
    list-style: none;
    color: rgb(248, 0, 0)
}

#cke_1_contents {
    height: 150px !important;
}
</style>
@endsection
@section('content')
<div class="container-fluid">
    <!--middle content-->
    <div class="row">
        <div class="col-md-12">
            <div class="v-main-heading">
                <h1> Escort Listings <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                        style="font-size:16px"><b>Help?</b> </span></h1>
            </div>
            <div class=" my-4">
                <div class="card collapse" id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>All current (published) Listings are displayed in this table.</li>
                            <li>You have limited Action access according to your security level.</li>
                            <li>Prefixes:</li>
                            <p>1. ACT 2. NSW 3. Vic 4. Qld 5. SA 6. W A 7. Tas 8. NT</p>
                        </ol>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 ">
            <div class="row my-3">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <form class="search-form-bg navbar-search">
                        <div class="input-group">
                            <input type="text" class="search-form-bg-i form-control border-0 small"
                                placeholder="Search " aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn-right-icon" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 d-flex justify-content-end" style="gap: 50px;">
                  
                    <div class="total_listing">
                        <div><span>Total Listings : </span></div>
                        <div><span>4,456</span></div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-bg">
                        <tr>
                            <th scope="col">
                                Member ID

                            </th>
                            <th scope="col">
                                Member

                            </th>
                            <th scope="col">
                                Listing
                            </th>
                            <th scope="col">
                                Profile Name
                            </th>
                            <th scope="col">Type</th>
                            <th scope="col">Listed</th>
                            <th scope="col">De-listed</th>
                            <th scope="col">Days</th>
                            <th scope="col">Left</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-content">
                        <tr class="row-color">
                            <td width="10%" class="theme-color">M60178</td>
                            <td class="theme-color">Lins Massage</td>
                            <td class="theme-color">Perth</td>
                            <td class="theme-color">Perth 01</td>
                            <td class="theme-color">Platinum</td>
                            <td class="theme-color">23-05-2025</td>
                            <td class="theme-color">17-06-2025</td>
                            <td class="theme-color">14</td>
                            <td class="theme-color">15</td>
                            <td>
                                <div class="dropdown no-arrow ml-3">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink" style="">
                                        <!-- <a class="dropdown-item" href="#">Published <i class="fa fa-check text-dark"
                                                style="float: right;"></i></a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Withdrawn <i class="fa fa-times text-dark"
                                                style="float: right;"></i></a> -->
                                        <!-- <div class="dropdown-divider"></div> -->
                                        <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">View Listing <i class="fa fa-eye text-dark"
                                                style="color: var(--peach);" data-toggle="modal" data-target="#view-listing"></i></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination float-right pt-4">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">«</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">»</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
       <div class="col-sm-12 col-md-12 col-lg-12">
       <div class="timer_section">
            <p>Server time: <span>[10:23:51 am]</span></p>
            <p>Refresh time:<span> [seconds]</span></p>
            <p>Up time: <span>[214 days & 09 hours 12 minutes]</span></p>
        </div>
       </div>
    </div>
</div>

<!--middle content end here-->
<!--right side bar start from here-->
</div>
<!--right side bar end-->
</div>

<div class="modal fade upload-modal" id="view-listing" tabindex="-1" role="dialog" aria-labelledby="view-listingLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content basic-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="view-listing"><img src="{{ asset('assets/app/img/data-listing.png')}}" alt="alert" style="width:29px;">
                    Listing
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}"
                            class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-0">
                <form>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div id="listingModalContent">
                            <table style="width:100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">
                                <tbody>
                                    <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;"><strong>Member ID</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;">M60178</td>
                                    </tr>
                                    <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;"><strong>Member</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;">Lins Massage</td>
                                    </tr>
                                    <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;"><strong>Listing</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;">Perth</td>
                                    </tr>
                                    <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;"><strong>Profile Name</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;">Perth 01</td>
                                    </tr>
                                    <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;"><strong>Type</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;">Platinum</td>
                                    </tr>
                                    <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;"><strong>Listed Date</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;">23-05-2025</td>
                                    </tr>
                                    <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;"><strong>De-listed Date</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;">17-06-2025</td>
                                    </tr>
                                    <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;"><strong>Days</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;">14</td>
                                    </tr>
                                    <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;"><strong>Days Left</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:right;">15</td>
                                    </tr>
                                </tbody>
                            </table>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- <div class="modal-footer pb-4 mb-2">
                <button type="button" class="btn btn-primary">Publish</button>
            </div> -->
        </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/4.15.1/standard-all/ckeditor.js"></script>
<script>
CKEDITOR.replace('editor1', {
    fullPage: true,
    extraPlugins: 'docprops',
    // Disable content filtering because if you use full page mode, you probably
    // want to  freely enter any HTML content in source mode without any limitations.
    allowedContent: true,
    height: 320
});
</script>
@endsection
@push('script')
@endpush