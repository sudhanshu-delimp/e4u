
@extends('layouts.center')
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
    <div class="row">                                   
        <div class="custom-heading-wrapper col-lg-12">
            <h1 class="h1">Products</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
            <div class="card-body">
                <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                <p></p>
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
                </div>
                <!-- /.container-fluid -->

            </div>
            <!--middle content end here-->
            <!--right side bar start from here-->


        </div>
        <!-- Progress Bar -->
            <div class="row mx-1">
                <ul class="list-unstyled multi-steps">
                    <li id="pro-step-1" class="is-active">Order
                        <div class="pro-status-bar pro-status-bar--success">
                            <div class="pro-status-bar__bar" id="bar1"></div>
                        </div>
                    </li>
                    <li id="pro-step-2">Shipping
                        <div class="pro-status-bar pro-status-bar--success">
                            <div class="pro-status-bar__bar" id="bar2"></div>
                        </div>
                    </li>
                    <li id="pro-step-3">Payment</li>
                </ul>
            </div>

        <!-- Step 1 -->
        <div id="step1" class="step-content active">
            {{-- step 1 --}}
            <div class="row mt-4">

                <div class="col-md-12">


                    <div class="d-sm-flex align-items-center justify-content-between mb-3 mt-4">
                        <h2><b>Order Products</b></h2>
                    </div>
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
                                    <td class="theme-color sorting_1">
                                        <div class="form-check d-flex align-items-center img_modal text-center">
                                            <input class="form-check-input mr-2" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault"></label>
                                            <img src="{{ asset('assets/app/img/condom.png')}}" data-toggle="modal" data-target="#imageModal">
                                            <span class="tooltip-desc">Click to enlarge.</span>
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


                            </tbody>

                            <tfoot class="bg-first">
                                <tr>
                                    <th colspan="5" class="text-right font-weight-bold">
                                        Total:
                                    </th>
                                    <th><span class="pr-2">$</span> 80.00</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button class="btn-common" onclick="next()">Proceed to Checkout <i
                        class="fas fa-arrow-right text-white pl-2"></i></button>
            </div>
        </div>

        <!-- Step 2 -->
        <div id="step2" class="step-content">
            {{-- step 2 --}}
            <div class="row mt-5">

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
                                        <input type="text" class="form-control" placeholder="you@domain.com.au"
                                            required>
                                    </div>
                                    <div class="col-md-12 my-2">
                                        <label for="Address"><b>Address</b></label>
                                        <input type="text" class="form-control"
                                            placeholder="Unit 1, 1 The Street, Suburb WA 6000" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="Instructions"><b>Any Special Instructions?</b></label>
                                        <textarea type="textarea" class="form-control common_textarea" rows="5"
                                            placeholder="Like building access if we are delivering to your door." required></textarea>
                                        {{-- <div class="row my-3"> --}}
                                        <div class="col-lg-12">
                                            <input type="radio" id="html1" name="fav_language" value="HTML1"
                                                required>
                                            <label for="Delivery"><b>Delivery to the door</b></label>

                                            <input type="radio" id="css1" name="fav_language" value="CSS1"
                                                style="margin-left: 17px;" required>
                                            <label for="Post"><b>Post</b></label>

                                            <div class="d-flex gap-10"><b>Note:</b>
                                                <p class="text-small mb-0">If
                                                    delivery to the door, we will
                                                    contact you 15 minutes before
                                                    delivery. </p>
                                            </div>
                                        </div>
                                        {{-- <div class="d-flex justify-content-end mr-0">
                                            <button type="submit" class="btn-common">Place Order</button>
                                        </div> --}}
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
                                Support Agent if appointed, or contact our support centre on <strong>0403 614 211</strong>.
                            </p>
                        </div>

                        <!-- Payment Logos -->
                        <div class="d-flex justify-content-center align-items-center mt-4">
                            <img src="{{ asset('assets/dashboard/img/visa.png') }}" alt="Visa" class="me-3">
                            <img src="{{ asset('assets/dashboard/img/master-card.png') }}" alt="MasterCard">
                        </div>

                    </div>
                </div>
            </div>
            <div class="text-right my-3">
                {{-- <button class="btn-common mt-3" onclick="goToStep(1)"> <i class="fas fa-arrow-left text-white pr-2"></i>
                    Back</button> --}}
                {{-- <button class="btn-common mt-3" onclick="goToStep(3)"></button> --}}
                <button onclick="prev()" class="btn-common"> <i class="fas fa-arrow-left text-white pr-2"></i> Back</button>
                <button onclick="next()" class="btn-common">Place Order</button>
            </div>

        </div>

        <!-- Step 3 -->
        <div id="step3" class="step-content text-center py-5">
            <h2>Order Completed</h2>
            <p>Thank you for your purchase!</p>
            <button onclick="prev()" class="btn-common"> <i class="fas fa-arrow-left text-white pr-2"></i> Back</button>
            <button onclick="finish()" class="btn-common">Finish</button>
        </div>
</div>

    <!-- Modal -->
    <div class="modal fade upload-modal" id="imageModal" tabindex="-1" role="dialog"
        aria-labelledby="imageModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModal"><img
                            src="{{ asset('assets/dashboard/img/view-product.png') }}" alt="alert"
                            class="custompopicon">
                        Four Seasons - Close Fitting
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="text-center">
                        <p>
                            Naked closer fitting condoms for a secure fit with less chance of slipping off during the
                            experience.
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
<!-- file upload plugin start here -->



    <!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script>
    let step = 1;

    const step1 = document.getElementById('pro-step-1');
    const step2 = document.getElementById('pro-step-2');
    const step3 = document.getElementById('pro-step-3');
    const bar1 = document.getElementById('bar1');
    const bar2 = document.getElementById('bar2');

    function showStep() {
        document.querySelectorAll('.step-content').forEach(el => el.classList.remove('active'));
        document.getElementById("step" + step).classList.add("active");
    }

    function next() {
        if (step === 1) {
            step = 2;
            step1.classList.remove("is-active");
            bar1.style.width = "100%"; // fill progress bar
            step2.classList.add("is-active");
        } else if (step === 2) {
            step = 3;
            step2.classList.remove("is-active");
            bar2.style.width = "100%"; // fill progress bar
            step3.classList.add("is-active");
        }
        showStep();
    }

    function prev() {
        if (step === 2) {
            step = 1;
            step2.classList.remove("is-active");
            step1.classList.add("is-active");
            bar1.style.width = "0%"; // reset bar
        } else if (step === 3) {
            step = 2;
            step3.classList.remove("is-active");
            step2.classList.add("is-active");
            bar2.style.width = "0%"; // reset bar
        }
        showStep();
    }

    function finish() {
        alert("Process Completed!");
        reset();
    }

    function reset() {
        step = 1;
        step1.classList.add("is-active");
        step2.classList.remove("is-active");
        step3.classList.remove("is-active");

        bar1.style.width = "0%";
        bar2.style.width = "0%";

        showStep();
    }
</script>

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

@endpush
