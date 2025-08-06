
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
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!--middle content start here-->
                    
    {{-- Page Heading   --}}
    <div class="row">
        <div class="d-flex align-items-center justify-content-start mt-5 flex-wrap col-lg-12">
            <h1 class="h1">Professional Products</h1>
            <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
        </div>
        <div class="col-md-12 my-4">
            <div class="card collapse" id="notes" style="">
            <div class="card-body">
                <p class="mb-1" style="font-size: 20px;"><b>Notes:</b> </p>
                <ol></ol>
            </div>
            </div>
        </div>
    </div>
    {{-- end --}}

    <!--middle content-->
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 ">
            <!-- Begin Page Content -->
            <div class="container-fluid" style="padding: 0px 0px;">

                
                <div class="d-sm-flex align-items-center justify-content-between mb-3">
                    <h3><b>Partnership</b></h3>
                </div>
                <p>Escorts4U has partnered with Condom Man ) to offer a delivery service to the
                    door, within the Perth CBD, and Express
                    Post to other capital cities.</p>

                <div class="d-sm-flex align-items-center justify-content-between mb-3 mt-4">
                    <h3><b>Ordering Products</b></h3> 
                </div>
                <p><b>Please ensure:</b></p>
                <ul class="product-list">
                    <li>Your order is complete and the details are correct</li>
                    <li>There is access to your stay</li>
                    <li>You have you mobile nearby. We will call you 5 minutes out</li>
                    <li>You have the exact cash to pay for your order</li>
                </ul>
            </div>
            <!-- /.container-fluid --><br>

        </div>
        <!--middle content end here-->
        <!--right side bar start from here-->


    </div>

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
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="table-responsive-xl">
                <table id="productTable" class="table table-bordered display" width="100%">
                    <thead class="bg-first">
                        <tr>
                            <th scope="col">Product
                            </th>
                            <th scope="col">Code</th>
                            <th scope="col">Description </th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Total
                            </th>

                        </tr>
                    </thead>
                    <tbody class="table-content">

                        <tr class="">
                            <td class="theme-color">
                                <div class="form-check d-flex align-items-center">
                                    <input class="form-check-input mr-2" type="checkbox" value=""
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault"></label>
                                    <img src="{{  asset('assets/app/img/condom.png') }}">
                                </div>

                            </td>

                            <td class="theme-color">FSCF</td>
                            <td class="theme-color"><b>Four Seasons - Close Fitting</b><br>
                                Naked closer fitting condoms for a secure fit with less chance of
                                slipping off during the experience.<br>
                                <b>QTY: 144 Size: 49mm</b>
                            </td>
                            <td class="theme-color">$ 40.00</td>
                            <td class="theme-color qty">
                                <form action="">
                                    <select name="cars" id="cars">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>


                                </form>
                            </td>
                            <td class="theme-color"> $ 80.00</td>

                        </tr>

                        <tr class="">
                            <td class="theme-color">
                                <div class="form-check d-flex align-items-center">
                                    <input class="form-check-input mr-2" type="checkbox" value=""
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault"></label>
                                    <img src="{{  asset('assets/app/img/condom.png') }}">
                                </div>

                            </td>

                            <td class="theme-color">FSCF</td>
                            <td class="theme-color"><b>Four Seasons - Close Fitting</b><br>
                                Naked closer fitting condoms for a secure fit with less chance of
                                slipping off during the experience.<br>
                                <b>QTY: 144 Size: 49mm</b>
                            </td>
                            <td class="theme-color">$ 40.00</td>
                            <td class="theme-color qty">
                                <form action="">
                                    <select name="cars" id="cars">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>


                                </form>
                            </td>
                            <td class="theme-color"> $ 80.00</td>

                        </tr>

                        <thead class="bg-first">
                            <tr>
                                <th>
                                    Total All
                                </th>
    
                                <th></th>
                                <th></th>
                                <th></th>
                                <th class="qty"></th>
                                <th> $ 160.00</th>
    
                            </tr>
                        </thead>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-6 col-sm-12 col-md-12 left-sidebar-bg">
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
        </div>

        <div class="col-lg-6 col-sm-12 col-md-12 right-sidebar-bg" style="background: none">
            <div class="d-sm-flex align-items-center justify-content-between mb-3">
                <h3><b>Ordering Products</b></h3>
            </div>


            <div class="form-row">
                <div class="col">
                    <label for="number"><b>Mobile Number</b></label>
                    <input type="number" class="form-control">
                </div>
                <div class="col">
                    <label for="email"><b>Email</b></label>
                    <input type="text" class="form-control">
                </div>
                <div class="col-md-12 my-2">
                    <label for="Address"><b>Address</b></label>
                    <input type="text" class="form-control">
                </div>
                <div class="col-md-12 my-1">
                    <label for="Instructions"><b>Any Special Instructions?</b></label>
                    <textarea type="textarea" class="form-control" rows="5"></textarea>
                    <div class="">
                        <div>
                            <input type="radio" id="html1" name="fav_language" value="HTML1">
                            <label for="Delivery"><b>Delivery to the door</b></label>

                            <input type="radio" id="css1" name="fav_language" value="CSS1"
                                style="margin-left: 17px;">
                            <label for="Post"><b>Post</label>
                        </div>

                        <div>
                            <input type="radio" id="javascript1" name="fav_language"
                                value="JavaScript1">
                                <label for="yourself"><b>CC yourself</b></label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mr-0">
                        <button type="button" class="bulk-btn new-btn-sec">Place Order</button>
                    </div>

                    </form>
                </div>
            </div>
            <!--right side bar end-->
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
           paging: true
       });
   });
 </script>
   

@endpush
