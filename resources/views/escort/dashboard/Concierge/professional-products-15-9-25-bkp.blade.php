
@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">

<style type="text/css">
    .parsley-errors-list {
        list-style: none;
        color: rgb(248, 0, 0)
    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5 add-punterbox-report">
    <!--middle content start here-->
                    
    {{-- Page Heading   --}}
    <div class="row">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1">Products</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
            <div class="card-body">
                <p class="mb-1" style="font-size: 20px;"><b>Notes:</b> </p>
                <ol>
                    <li>Order your products here for delivery to your door or by post.</li>
                    <li>Please ensure:
                        <ol class="level-2">
                            <li>your order is complete and the details are correct</li>
                            <li>there is access to your stay if we are delivering</li>
                            <li>you have you mobile nearby. We will call you 15 minutes out</li>
                        </ol>
                    </li>
                    <li>SMS 2FA applies to payment.</li>
                </ol>
            </div>
            </div>
        </div>
    </div>
    {{-- end --}}

    <!--middle content-->
    <div class="row">
        <div class="col-sm-9">
            <!-- Begin Page Content -->
            <div class="container-fluid" style="padding: 0px 0px;">

                
                <div class="d-sm-flex align-items-center justify-content-between mb-3">
                    <h2><b>Partnership</b></h2>
                </div>
                <p>Escorts4U has partnered with the Condom Man to offer a convenient delivery service to the
                    door, within the Perth CBD, and Express Post to other capital cities.
                    </p>

                <div class="d-sm-flex align-items-center justify-content-between mb-3 mt-4">
                    <h2><b>Order Products</b></h2> 
                </div>
                {{-- <p><b>Please ensure:</b></p>
                <ul class="product-list">
                    <li>Your order is complete and the details are correct</li>
                    <li>There is access to your stay</li>
                    <li>You have you mobile nearby. We will call you 5 minutes out</li>
                    <li>You have the exact cash to pay for your order</li>
                </ul> --}}
            </div>
            <!-- /.container-fluid -->

        </div>
        <!--middle content end here-->
        <!--right side bar start from here-->


    </div>
{{-- 
    <div class="row">
        <div class="col-lg-6 col-sm-12 col-md-12">
            <form action="" class="ordingring-products">
                <div>
                    <input class="form-check-input ml-0" type="checkbox" value=""
                                        id="flexCheckDefault">
                    <label for="html">Condom</label>
                </div>

                <div>
                    <input class="form-check-input ml-0" type="checkbox" value=""
                                        id="flexCheckDefault">
                    <label for="css">Lubricants</label>
                </div>

                <div>
                    <input class="form-check-input ml-0" type="checkbox" value=""
                                        id="flexCheckDefault">
                    <label for="javascript">Massage Oil</label>
                </div>
                
            </form>

        </div>
    </div> --}}
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="table-responsive-xl">
                <table class="table table-bordered display" width="100%">
                    <thead class="bg-first">
                        <tr>
                            <th scope="col" class="text-center font-weight-bold">Product
                            </th>
                            <th scope="col" class="text-center font-weight-bold">Code</th>
                            <th scope="col" class="text-center font-weight-bold">Description </th>
                            <th scope="col" class="text-center font-weight-bold">Unit Price<sup>(1)</sup></th>
                            <th scope="col" class="text-center font-weight-bold">Qty</th>
                            <th scope="col" class="text-center font-weight-bold">Total
                            </th>

                        </tr>
                    </thead>
                    <tbody class="table-content">

                        <tr class="">
                            <td class="theme-color">                                
                                <div class="img_modal text-center"  data-toggle="modal" data-target="#imageModal">
                                    <img src="{{ asset('assets/app/img/condom.png') }}">
                                    <span class="tooltip-desc">Click to enlarge</span>
                                </div>
                            </td>

                            <td class="theme-color">FSCF</td>
                            <td class="theme-color"><b>Four Seasons - Close Fitting</b><br>
                                Naked closer fitting condoms for a secure fit with less chance of
                                slipping off during the experience.<br>
                                <b>QTY: 144 Size: 49mm</b>
                            </td>
                            <td class="theme-color"><span class="pr-2">$</span> 40.00</td>
                            <td class="theme-color qty">
                                <form action="">
                                    <select name="cars" id="cars">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>


                                </form>
                            </td>
                            <td class="theme-color"> <span class="pr-2">$</span> 80.00</td>

                        </tr>

                        
                        <tfoot class="bg-first">
                            <tr>
                                <th colspan="5" class="text-right font-weight-bold">
                                    Total:
                                </th>
                                <th><span class="pr-2">$</span> 80.00</th>    
                            </tr>
                        </tfoot>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        {{-- <div class="col-lg-6 col-sm-12 col-md-12 left-sidebar-bg">
            <form action="">
                <div id="accordion" class="myacording-design mb-5">
                    <div class="card">
                        <div class="card-header">
                            <a class="card-link collapsed" data-toggle="collapse" href="#order" aria-expanded="false">
                            Important information about your order and products
                            </a>
                        </div>
                        <div id="order" class="collapse" data-parent="#accordion" style="">
                            <div class="card-body pb-0">
                                <p><b>Q? Can I change my order?</b></p>
                                <p>Yes. Please contact the Condom Man before he arrives to discuss your chnages. There is no guarantee the changes can be met.</p>
                                <p><b>Q? Can I return any of the products?</b></p>
                                <p>No. Please check the products on delivery. You will be provided with a copy of your order to match up the delivery.</p>
                                <p><b>Product Quality</b></p>
                                <p>Condom Man can supply everything that you may be looking for to enhance your sex life or to protect yourself, including:</p>
                                <ul class="prof-sec">
                                    <li>Condoms - all types, sizes, colours &amp; flavours</li>
                                    <li>Lubricants - all water-based, safe to use with condoms</li>
                                    <li>Massage Oils - we will advise which ones are suitable to use also as lubricants</li>
                                </ul>
                                <p>Condom Man only supplys products that are tested and reliable, and conform to the most rigorous testing and Australian standards, such as:</p>
                                <ul class="prof-sec">
                                    <li>Ansell</li>
                                    <li>Four Season</li>
                                    <li>Glyde</li>
                                    <li>Durex</li>
                                    <li>"Wet Stuff" from Gel Works</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <a class="card-link collapsed" data-toggle="collapse" href="#Confidentiality" aria-expanded="false">
                            Confidentiality
                            </a>
                        </div>
                        <div id="Confidentiality" class="collapse" data-parent="#accordion" style="">
                            <div class="card-body pb-0">
                                <p><b>Q? Who will see my order?</b></p>
                                <p>When you lodge an order, an email is sent directly to Condom Man.</p>
                                <p><b>Q? Who will I be discussing my order with?</b></p>
                                <p>You will be contacted directly by Condom Man. All conversations will remain confidential between you and Condom Man. Escorts4U does not have any communications with Condom Man regarding your order.</p>
                                <p><b>Q? Can I contact Condom Man directly?</b></p>
                                <p>Yes. See contact details below.</p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <a class="card-link collapsed" data-toggle="collapse" href="#contact" aria-expanded="false">
                            Contact details
                            </a>
                        </div>
                        <div id="contact" class="collapse" data-parent="#accordion" style="">
                            <div class="card-body pb-0">
                                <p>You can contact Condom Man through either of the following methods:</p>
                                    <p>Condom Man<br>
                                    PO Box 1569<br>
                                    Bibra Lake DC WA 6965<br></p>
                                    <p>T: +61 418 957 236<br>
                                    E: info@condomman.com.au<br>
                                    W: <a target="_blank" href="https://www.condomman.com.au"><span class="custom_links_design">www.condomman.com.au</span></a></p>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div> --}}

        <div class="col-lg-8 col-sm-12 col-md-12 right-sidebar-bg" style="background: none">
            <div class="card p-4">
                <div class="d-sm-flex align-items-center justify-content-between mb-3">
                    <h2><b>Delivery Address</b></h2>
                </div>
                <div class="form-row">
                    <form action="/">
                       <div class="row">
                            <div class="col-6">
                                <label for="Mobile Number"><b>Mobile Number</b></label>
                                <input type="text" class="form-control" placeholder="0145 028 758" required>
                            </div>
                            <div class="col-6">
                                <label for="email"><b>Email</b></label>
                                <input type="text" class="form-control" placeholder="you@domain.com.au" required>
                            </div>
                            <div class="col-md-12 my-2">
                                <label for="Address"><b>Address</b></label>
                                <input type="text" class="form-control" placeholder="Unit 1, 1 The Street, Suburb WA 6000" required>
                            </div>
                            <div class="col-md-12">
                                <label for="Instructions" ><b>Any Special Instructions?</b></label>
                                <textarea type="textarea" class="form-control common_textarea" rows="5" placeholder="Like building access if we are delivering to your door." required></textarea>
                                <div class="row my-3">
                                    <div class="col-lg-8">
                                        <input type="radio" id="html1" name="fav_language" value="HTML1" required>
                                        <label for="Delivery"><b>Delivery to the door</b></label>
            
                                        <input type="radio" id="css1" name="fav_language" value="CSS1"
                                            style="margin-left: 17px;" required>
                                        <label for="Post"><b>Post</b></label>
                                    </div>
            
                                    <div class="col-lg-4 d-flex gap-10"><b>Note:</b> <small class="text-small">If delivery to the door, we will
                                        contact you 15 minutes before
                                        delivery. </small>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mr-0">
                                    <button type="submit" class="btn-common">Place Order</button>
                                </div>
                            </div>  
                       </div> 
                    </form>    
                </div>
            </div>            
        </div>
        <!--right side bar end-->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card p-4">
              
              <!-- Order Summary -->
              <h2 class="mb-4"><strong>Order Summary</strong></h2>
              <div class="d-flex justify-content-between mb-2">
                <span>Subtotal:</span>
                <span>$ 20.00</span>
              </div>
              <div class="d-flex justify-content-between mb-2">
                <span>Post:</span>
                <span>$ 25.00</span>
              </div>
              <div class="d-flex justify-content-between mb-2">
                <span>Tax:</span>
                <span>$ 5.00</span>
              </div>
              <hr>
              <div class="d-flex justify-content-between mb-3">
                <strong>Total:</strong>
                <strong>$ 50.00</strong>
              </div>
      
              <!-- Support Info -->
              <div class="support mt-3">
                <p><strong>Need a hand?</strong></p>
                <p class="small mb-0">
                    If you need any help with your order you can contact your
                    Support Agent is appointed, or contact our support centre on <strong>0403 614 211</strong>.
                </p>
              </div>
      
              <!-- Payment Logos -->
              <div class="d-flex justify-content-center align-items-center mt-4">
                <img src="{{ asset('assets/dashboard/img/visa.png') }}" alt="Visa" class="me-3">
                <img src="{{ asset('assets/dashboard/img/master-card.png')}}" alt="MasterCard">
              </div>
      
            </div>
        </div>
    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span> </span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    <!--middle content end here-->
</div>
<!-- Modal -->        
<div class="modal fade upload-modal" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
aria-hidden="true"
data-backdrop="static" 
data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content basic-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModal"><img src="{{ asset('assets/dashboard/img/view-product.png')}}" alt="alert" class="custompopicon">
                    Four Seasons - Close Fitting
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}"
                            class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center">
                    <p>
                        Naked closer fitting condoms for a secure fit with less chance of slipping off during the experience.
                    </p>
                    <img src="{{ asset('assets/app/img/condom.png') }}" class="w-50 p-4">
                    
                </div>
                <div class="text-center">
                    <button class="btn-cancel-modal" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        
        </div>
    </div>
</div>

@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>

<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script type="text/javascript">

    $('#userProfile').parsley({

    });



    $('#userProfile').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);

        if (form.parsley().isValid()) {

            var url = form.attr('action');
            var data = new FormData(form[0]);
            $.ajax({
                method: form.attr('method'),
                url: url,
                data: data,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (!data.error) {
                        $.toast({
                            heading: 'Success',
                            text: 'Details successfully saved',
                            icon: 'success',
                            loader: true,
                            position: 'top-right', // Change it to false to disable loader
                            loaderBg: '#9EC600' // To change the background
                        });

                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'Records Not update',
                            icon: 'error',
                            loader: true,
                            position: 'top-right', // Change it to false to disable loader
                            loaderBg: '#9EC600' // To change the background
                        });

                    }
                },

            });
        }
    });
    $('#city').select2({
        allowClear: true,
        placeholder :'Select City',
        createTag: function(params) {
            var term = $.trim(params.term);

            if (term === '') {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: false // add additional parameters
            }
        },
        tags: false,
        minimumInputLength: 2,
        tokenSeparators: [','],
        ajax: {
            url: "{{ route('city.list') }}",
            dataType: "json",
            type: "GET",
            data: function(params) {
                console.log(params);
                var queryParameters = {
                    query: params.term,
                    state_id: $('#state').val()
                }
                return queryParameters;
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {

                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            }
        }
    });

    $('#state').select2({
        allowClear: true,
        placeholder :'Select State',
        createTag: function(params) {
            var term = $.trim(params.term);

            if (term === '') {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: false // add additional parameters
            }
        },
        tags: false,
        minimumInputLength: 2,
        tokenSeparators: [','],
        ajax: {
            url: "{{ route('state.list') }}",
            dataType: "json",
            type: "GET",
            data: function(params) {
                console.log(params);
                var queryParameters = {
                    query: params.term,
                    country_id: $('#country').val()
                }
                return queryParameters;
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {

                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            }
        }
    });


    $('#country').on('change', function(e) {
        if($(this).val()) {
            $('#state').prop('disabled', false);
            $('#state').select2('open');
        } else {
            $('#state').prop('disabled', true);
        }
    });

    $('#state').on('change', function(e) {
        if($(this).val()) {
            $('#city').prop('disabled', false);
            $('#city').select2('open');
        } else {
            $('#city').prop('disabled', true);
        }
    });


</script>
<script>
   $(document).ready(function() {
       $('#productTable').DataTable({
           responsive: true,
           language: {
               search: "Search: _INPUT_",
               searchPlaceholder: "Search by ID or Profile Name...",
               lengthMenu: "Show _MENU_ entries",
               zeroRecords: "No matching records found",
               info: "Showing _START_ to _END_ of _TOTAL_ entries",
               infoEmpty: "No entries available",
               infoFiltered: "(filtered from _MAX_ total entries)"
           },
           initComplete: function() {
                    if ($('#returnToReportBtn').length === 0) {
                        $('.dataTables_filter').append(
                            '<button id="returnToReportBtn" class="create-tour-sec my-3">Return to Report</button>'
                        );
                    }
                    $('#returnToReportBtn').on('click', function() {
                        var table = $('#productTable').DataTable();
                        table.search('').draw();
                    });
                },
                "language": {
                    "zeroRecords": "There is no record of the search criteria you entered.",
                    searchPlaceholder: "Search by ID or Profile Name"
                },
           paging: true
       });
   });
 </script>
   

@endpush
