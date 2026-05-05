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

        input[type="radio"].is-invalid+label {
            color: red !important;
        }

        #swal2-title {
            font-size: x-large;
        }

        .parsley-errors-list {
            text-align: left !important;
            margin-left: 0 !important;
            padding-left: 0 !important;
        }

        .parsley-errors-list li {
            text-align: left !important;
        }

        #deliveryAddressForm input,
        #deliveryAddressForm select,
        #deliveryAddressForm textarea {
            color: #000 !important;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5 add-punterbox-report">
        <!--middle content start here-->

        {{-- Page Heading   --}}
        <div class="row">
            <div class="d-flex justify-content-between align-items-center col-md-12">
                <div class="custom-heading-wrapper">
                    <h1 class="h1">Cart</h1>
                    <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
                </div>
                <div class="product_view">
                    <span class="back-to-product" id="viewCart">
                        <a href="{{ route('escort.products') }}"> <i class="fa fa-arrow-left"></i> Back</a>
                    </span>
                </div>
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
                        <div id="loader" style="display:none; text-align:center; padding:20px;">
                            <img src="loader.gif" width="60">
                            <p>Loading products...</p> ̰
                        </div>
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
                            <tbody class="table-content"> </tbody>

                            <tfoot class="bg-first">
                                <tr>
                                    <th colspan="5" class="text-right font-weight-bold">
                                        Total:
                                    </th>
                                    <th>
                                        <span id="grand-total">0.00</span>
                                    </th>
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


                            <form action="/" id="deliveryAddressForm" data-parsley-validate>

                                <div class="row">

                                    <!-- Mobile -->
                                    <div class="col-6">
                                        <label><b>Mobile Number</b></label>
                                        <input type="text" class="form-control" name="phone" placeholder="0145 028 758"
                                            required data-parsley-type="digits" data-parsley-minlength="10"
                                            data-parsley-required-message="Mobile number is required"
                                            data-parsley-type-message="Only digits allowed"
                                            data-parsley-minlength-message="Mobile must be at least 10 digits">
                                    </div>

                                    <!-- Email -->
                                    <div class="col-6">
                                        <label><b>Email</b></label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="you@domain.com.au" required
                                            data-parsley-required-message="Email is required"
                                            data-parsley-type-message="Enter a valid email address">
                                    </div>

                                    <!-- Address -->
                                    <!-- Address -->
                                    <div class="col-md-12 my-2">
                                        <label><b>Address</b></label>
                                        <input type="text" class="form-control" name="address"
                                            placeholder="Unit 1, 1 The Street" required
                                            data-parsley-required-message="Address is required">
                                    </div>

                                    <!-- Address 2 (Optional) -->
                                    <div class="col-md-12 my-2">
                                        <label><b>Address 2 (Optional)</b></label>
                                        <input type="text" class="form-control" name="address_2"
                                            placeholder="Suburb WA 6000"
                                            data-parsley-required-message="Address 2 is required">
                                    </div>
                                    <!-- City -->
                                    <div class="col-md-6 my-2">
                                        <label><b>City</b></label>
                                        <input type="text" class="form-control" name="city" placeholder="City"
                                            required data-parsley-required-message="City is required">
                                    </div>

                                    <!-- Pincode -->
                                    <div class="col-md-6 my-2">
                                        <label><b>Pincode</b></label>
                                        <input type="text" class="form-control" name="pincode" placeholder="600001"
                                            required data-parsley-type="digits"
                                            data-parsley-required-message="Pincode is required"
                                            data-parsley-type-message="Only digits allowed">
                                    </div>
                                    <div class="col-md-6 my-2">
                                        <label><b>Landmark</b></label>
                                        <input type="text" class="form-control" name="landmark"
                                            placeholder="Near ABC Mall">
                                    </div>
                                    <!-- Special Instructions -->

                                    <div class="col-md-6 my-2">
                                        <input type="radio" name="delivery_type" id="door" value="door"
                                            required checked data-parsley-required-message="Choose a delivery type">
                                        <label for="door"><b>Delivery to the door</b></label>

                                        <input type="radio" name="delivery_type" id="post" value="post">
                                        <label for="post"><b>Post</b></label>
                                    </div>

                                    <!-- Billing Address Toggle -->
                                    <div class="col-12 mt-3">
                                        <input type="checkbox" id="sameAddress" name="sameAddress"
                                            onclick="toggleBilling()">
                                        <label for="sameAddress"><b>Billing address same as delivery</b></label>
                                    </div>
                                </div>

                                <!-- Billing Section -->
                                <div id="billingSection" class="mt-4">

                                    <div class="d-sm-flex align-items-center justify-content-between my-3">
                                        <h2><b>Billing Address</b></h2>
                                    </div>

                                    <div class="row">

                                        <!-- Phone -->
                                        <div class="col-6">
                                            <label><b>Mobile Number</b></label>
                                            <input type="text" name="billing_phone" class="form-control"
                                                placeholder="0145 028 758" required data-parsley-type="digits"
                                                data-parsley-minlength="10"
                                                data-parsley-required-message="Billing phone is required">
                                        </div>

                                        <!-- Email -->
                                        <div class="col-6">
                                            <label><b>Email</b></label>
                                            <input type="email" name="billing_email" class="form-control"
                                                placeholder="you@domain.com.au" required
                                                data-parsley-required-message="Billing email is required">
                                        </div>

                                        <!-- Address Line 1 -->
                                        <div class="col-md-12 my-2">
                                            <label><b>Address Line 1</b></label>
                                            <input type="text" name="billing_address_line1" class="form-control"
                                                placeholder="Unit 1, 1 The Street" required
                                                data-parsley-required-message="Billing address line 1 is required">
                                        </div>

                                        <!-- Address Line 2 (optional) -->
                                        <div class="col-md-12 my-2">
                                            <label><b>Address Line 2</b></label>
                                            <input type="text" name="billing_address_line2" class="form-control"
                                                placeholder="Apartment, suite, etc (optional)">
                                        </div>

                                        <!-- City -->
                                        <div class="col-6">
                                            <label><b>City</b></label>
                                            <input type="text" name="billing_city" class="form-control"
                                                placeholder="City" required
                                                data-parsley-required-message="Billing city is required">
                                        </div>

                                        <!-- Pincode -->
                                        <div class="col-6">
                                            <label><b>Pincode</b></label>
                                            <input type="text" name="billing_pincode" class="form-control"
                                                placeholder="600001" required data-parsley-type="digits"
                                                data-parsley-required-message="Billing pincode is required">
                                        </div>

                                        <!-- Landmark (optional) -->
                                        <div class="col-md-12">
                                            <label><b>Landmark</b></label>
                                            <input type="text" name="billing_landmark" class="form-control"
                                                placeholder="Near school, mall, etc">
                                        </div>


                                        <div class="col-md-12 my-2">
                                            <label><b>Any Special Instructions?</b></label>
                                            <textarea class="form-control common_textarea" name="special_instructions" rows="5"
                                                placeholder="Like building access if we are delivering to your door."required
                                                data-parsley-required-message="Special instructions are required"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--right side bar end-->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card p-4" id="orderDetails">

                        <!-- Order Summary -->
                        <h2 class="mb-4"><strong>Order Summary</strong></h2>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span id="subtotal">$ 0.00</span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Post:</span>
                            <span id="post">$ 0.00</span>

                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Tax:</span>
                            <span id="tax">$ 0.00</span>

                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-3">
                            <strong>Total:</strong>
                            <strong id="total">$ 0.00</strong>

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
            <div id="payment-element"></div>

<button id="payBtn">Pay Now</button>

<div id="result"></div>
            <div class="my-3 d-flex gap-20 justify-content-end">
                {{-- <button class="btn-common mt-3" onclick="goToStep(1)"> <i class="fas fa-arrow-left text-white pr-2"></i>
                    Back</button> --}}
                {{-- <button class="btn-common mt-3" onclick="goToStep(3)"></button> --}}
                <button onclick="prev()" class="btn-common" id="btnBack"> <i
                        class="fas fa-arrow-left text-white pr-2"></i>
                    Back</button>
                <button onclick="next()" class="btn-common" id="makeOrder">Place Order</button>

                {{-- <span id="place_loader" style="display:none;">
                  <i class="fa fa-user"></i> Processing...
                </span> --}}

            </div>

        </div>

        <!-- Step 3 -->
        <div id="step3" class="step-content text-center py-5">
            <h2>Order Completed</h2>
            <p>Thank you for your purchase!</p>
            <button onclick="prev()" class="btn-common"> <i class="fas fa-arrow-left text-white pr-2"></i> Back</button>
            <button onclick="finish()" class="btn-common">Finish</button>
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
    <div class="modal fade upload-modal " id="imageModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <div class="modal-body text-center position-relative">

                    <!-- Loader -->
                    <div id="imageLoader" class="position-absolute top-50 start-50 translate-middle">
                        <div class="spinner-border" role="status"></div>
                    </div>

                    <!-- Image -->
                    <img id="modalImage" src="" class="img-fluid d-none">

                </div>

            </div>
        </div>
    </div>
@endsection
@push('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>

    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
    <script>
        let loginUserId = '{{ Auth::user()->id }}';
    </script>
    <script type="text/javascript" src="{{ asset('escort/js/main.js') }}"></script>

    <script>
        let cart = getCart();
        let productIds = Object.keys(cart) ?? '[]';
        let finalCart = getFinalCart();

        let isDirty = false;

        // detect changes
        document.querySelectorAll("input, textarea, select").forEach(el => {
            el.addEventListener("change", () => {
                isDirty = true;
            });
        });

        window.addEventListener("beforeunload", function(e) {
            if (isDirty) {
                e.preventDefault();
                e.returnValue = "";
            }
        });


        function loadProducts() {

            $("#loader").show();
            $.ajax({
                url: "{{ route('escort.get.products') }}",
                type: "POST",
                data: {
                    ids: productIds,
                    _token: "{{ csrf_token() }}"
                },

                success: function(response) {
                    $("#loader").hide();

                    let rows = "";
                    let grandTotal = 0; // ✅ total accumulator
                    if (response.products.length > 0 && Object.keys(cart).length>0) {
                        console.log(cart,'sdf');

                        response.products.forEach(product => {

                            let qty = cart[product.id].qty;
                            let price = parseFloat(product.price) || 0;
                            let total = price * qty;

                            grandTotal += total; // ✅ add to grand total

                            rows += `
                <tr>
                    <td class="theme-color">
                        <div class="form-check d-flex align-items-center text-center">
                            <input class="form-check-input mr-2 product-check" type="checkbox" data-id="${product.id}" data-price="${price}" ${finalCart.includes(product.id) ? "checked" : "" }>
                            <img src="${product.image}" data-image="${product.image}" data-title="${product.description}" class="product-image" style="width:50px">
                        </div>
                    </td>

                    <td class="theme-color">${product.code}</td>

                    <td class="theme-color">
                        <b>${product.description}</b><br>
                        <b>QTY: ${product.qty} ${product.size && product.size!="N/A" ? `Size: ${product.size}` : ''}</b>
                    </td>

                    <td class="theme-color text-center">
                        $${price.toFixed(2)}
                    </td>

                    <td class="theme-color qty">
                       
                         <select class="qty-select" data-id="${product.id}" data-price="${product.price}">
                            ${[1,2,3,4,5].map(q =>
                                `<option value="${q}" ${q == qty ? 'selected' : ''}>${q}</option>`
                            ).join('')}
                        </select>
                    </td>

                   <td class="theme-color text-center total-cell" data-id="${product.id}">
                      $${total.toFixed(2)}
                  </td>
                </tr>
                `;
                        });
                    } else {
                        rows = '<tr><td colspan="6"  class="text-center">Cart is empty</td></tr>';
                    }

                    $(".table-content").html(rows);
                    // ✅ update footer total
                    // $("#grand-total").text("$" + grandTotal.toFixed(2));
                    calculateTotals();
                },

                error: function(xhr, status, error) {
                    $("#loader").hide();

                    // Log the actual error in console for debugging
                    // Handle unauthorized
                    if (xhr.status === 401) {
                        Swal.fire({
                            icon: "warning",
                            title: "Unauthorized",
                            text: "Your login session expired. Please log in again."
                        });
                        return;
                    }

                    // Handle 500 server error
                    if (xhr.status === 500) {
                        Swal.fire({
                            icon: "error",
                            title: "Server Error",
                            text: "Something went wrong on the server. Try again later."
                        });
                        return;
                    }

                    $("#loader").hide();

                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Something went wrong. Please try again."
                    });
                }
            });
        }
        let steps = localStorage.getItem('checkout_step_' + loginUserId);
        console.log(steps);
        if (steps == 1) {
            loadProducts();

        }

        $(document).on("change", ".qty-select", function() {
            let id = $(this).data("id");
            let qty = parseInt($(this).val());

            // Update only qty
            if (cart[id]) {
                cart[id].qty = qty;
            }

            saveCart(cart);

            // Call calculation function
            calculateTotals();
        });

        function calculateTotals() {
            let grandTotal = 0;

            // Loop through ALL rows
            $(".qty-select").each(function() {
                let id = $(this).data("id");
                let row = $(this).closest("tr");

                let qty = parseInt($(this).val());
                let price = parseFloat(row.find("td:nth-child(4)").text().replace("$", ""));

                // Check if this product is checked
                let isChecked = $(`.product-check[data-id="${id}"]`).is(":checked");
                let rowTotal = qty * price;
                if (isChecked) {
                    // Calculate row total only if checked


                    $(`.total-cell[data-id="${id}"]`).text("$" + rowTotal.toFixed(2));

                    grandTotal += rowTotal;
                } else {
                    // If NOT checked, set row total to $0.00 (or leave it blank)
                    $(`.total-cell[data-id="${id}"]`).text("$" + rowTotal.toFixed(2));
                }
            });

            // Update footer grand total
            $("#grand-total").text("$" + grandTotal.toFixed(2));
        }
        let step = 1;
        localStorage.setItem('checkout_step_' + loginUserId, step);

        const step1 = document.getElementById('pro-step-1');
        const step2 = document.getElementById('pro-step-2');
        const step3 = document.getElementById('pro-step-3');
        const bar1 = document.getElementById('bar1');
        const bar2 = document.getElementById('bar2');

        function showStep() {
            document.querySelectorAll('.step-content').forEach(el => el.classList.remove('active'));
            document.getElementById("step" + step).classList.add("active");
        }

        $(document).on("change", ".product-check", function() {
            let finalCart = getFinalCart();

            let id = $(this).data("id");
            if (this.checked) {
                if (!finalCart.includes(id))
                    finalCart.push(id);
            } else {
                finalCart = finalCart.filter(itemId => itemId !== id);
            }
            // localStorage.setItem("finalCart", JSON.stringify(finalCart));
            saveFinalCart(finalCart);
            calculateTotals();

        });

        function next() {
            if (step === 1) {
                let finalCart = getFinalCart();

                if (Object.keys(finalCart).length === 0) {
                    Swal.fire('Please select at least one product before continuing.', '', 'error');
                    return;
                }
                updateOrderSummary();
                updateDeliveryAddress();

                step = 2;
                localStorage.setItem("checkout_step_" + loginUserId, step); // <<< save step

                step1.classList.remove("is-active");
                bar1.style.width = "100%"; // fill progress bar
                step2.classList.add("is-active");
            } else if (step === 2) {
                let isValid = true;
                if (!validateStep2()) return false;

                if (!isValid)
                    return false;

                let data = saveStep2Data();

                submitStep2Ajax(data, function() {
                    // Move to step 3 on success
                    step = 3;
                    localStorage.setItem("checkout_step_" + loginUserId, step);

                    step2.classList.remove("is-active");
                    bar2.style.width = "100%";
                    step3.classList.add("is-active");
                    showStep();
                    flushLocalStorage();

                });
            }
            showStep();
        }

        function submitStep2Ajax(formData, callback) {
            let orderData = {};
            let btn = $("#makeOrder");
            // let loader = $("#place_loader");
            $("#btnBack").prop("disabled", true);

            btn.prop("disabled", true).text("Please wait...");
            // loader.show();
            // get details from local stoarge
            let cart = getCart();
            let finalCart = getFinalCart();

            // get final cart item 
            let itemDetails = Object.fromEntries(
                Object.entries(cart).filter(([key, value]) => finalCart.includes(parseInt(key)))
            );

            // delivery type
            formData.delivery_type = $('input[name="delivery_type"]:checked').val();

            // get payment details like tax sub total toatal amount for corss check in backend before make payment
            let paymentDetails = getPaymentDetails();

            // set details to make order
            orderData.deliveryDetails = formData;
            orderData.itemDetails = itemDetails;
            orderData.paymentDetails = paymentDetails;

            $.ajax({
                url: "{{ route('escort.make.order') }}",
                type: "POST",
                data: orderData,
                dataType: "json",
                success: function(response) {
                    if (response.status == true) {
                        if (typeof callback === "function") callback();
                    } else {
                        Swal.fire(response.message, '', 'error');

                    }
                },

                error: function() {
                    Swal.fire('Something went wrong. Try again.', '', 'error');

                },

                complete: function() {
                    $("#btnBack").prop("disabled", false);
                    btn.prop("disabled", false).text("Place Order");
                    // loader.hide();

                }
            });
        }

        function saveStep2Data() {
            let data = $('#deliveryAddressForm').serializeArray();
            let result = {};

            data.forEach(item => {
                result[item.name] = item.value;
            });

            // localStorage.setItem("deliveryAddress", JSON.stringify(result));
            saveDeliveryDetails(result);
            return result; // return to use in AJAX
        }

        function validateStep2() {
            let form = $('#deliveryAddressForm').parsley();
            form.validate();
            return form.isValid();
        }

        $('#sameAddress').on('change', function() {
            if ($(this).is(':checked')) {
                $('#billingSection')
                    .find('input, textarea, select')
                    .attr('disabled', true)
                    .removeAttr('required')
                    .parsley().reset();
            } else {
                $('#billingSection')
                    .find('input, textarea, select')
                    .attr('disabled', false)
                    .each(function() {
                        if ($(this).data('required') === true || $(this).attr('name').includes('billing_')) {
                            $(this).attr('required', true);
                        }
                    });
            }
        });

        function toggleBilling() {
            if ($("#sameAddress").is(":checked")) {
                $("#billingSection").hide().find("input, textarea").attr("disabled", true);
            } else {
                $("#billingSection").show().find("input, textarea").attr("disabled", false);
            }
        }
        document.addEventListener("DOMContentLoaded", function() {
            let savedStep = localStorage.getItem("checkout_step_" + loginUserId);

            if (savedStep) {
                step = parseInt(savedStep);
            } else {
                step = 1; // default
            }
            if (step == 2) {
                updateOrderSummary();
                updateDeliveryAddress();
            }
            applyStepUI(step);
        });

        function applyStepUI(step) {
            if (step >= 1) {
                step1.classList.add("is-active");
            }

            if (step >= 2) {
                step1.classList.remove("is-active");
                bar1.style.width = "100%";
                step2.classList.add("is-active");
            }

            if (step >= 3) {
                step2.classList.remove("is-active");
                bar2.style.width = "100%";
                step3.classList.add("is-active");
            }

            showStep();
        }

        function updateDeliveryAddress() {
            let saved = getDeliveryDetails();

            if (saved) {
                // Fill text inputs & textarea
                for (let key in saved) {
                    let field = $(`[name="${key}"]`);

                    // Handle radio buttons
                    if (field.attr("type") === "radio") {
                        $(`input[name="${key}"][value="${saved[key]}"]`).prop("checked", true);
                    } else {
                        field.val(saved[key]);
                    }
                }
            }
        }

        function updateOrderSummary() {
            let cart = getCart()
            let finalCart = getFinalCart();
            // calculate subtotal according final cart
            let subtotal = 0;
            finalCart.forEach(id => {
                if (cart[id]) {
                    subtotal += cart[id].qty * parseFloat(cart[id].price);
                }
            });

            let post = 0.00;
            let tax = parseFloat("{{ config('escorts.product_tax') }}");
            let type = $('input[name="delivery_type"]:checked').val();

            if (type == 'post') {
                post = parseFloat("{{ config('escorts.delivery_charge_post') }}");
            } else if (type == 'door') {
                post = parseFloat("{{ config('escorts.delivery_charge_door') }}");
            }

            let total = subtotal + post + tax;
            // set amount details after calculation in html format
            $("#orderDetails #subtotal").text("$ " + subtotal.toFixed(2));
            $("#orderDetails #post").text("$ " + post.toFixed(2));
            $("#orderDetails #tax").text("$ " + tax.toFixed(2));
            $("#orderDetails #total").text("$ " + total.toFixed(2));



            // set data to local storage for make order 
            let paymentData = {
                total_payble: total.toFixed(2),
                tax_payble: tax.toFixed(2),
                subtotal_payble: subtotal.toFixed(2)
            };

            // localStorage.setItem("paymentDetails", JSON.stringify(paymentData));
            savePaymentDetails(paymentData)

        }
        $('input[name="delivery_type"]').on('change', function() {
            saveStep2Data();
            updateOrderSummary();
        });

        $(document).ready(function() {
            let deliveryDetails = getDeliveryDetails();
            $('input[name="delivery_type"]').prop('checked', false).removeAttr('checked');

            // STEP 2: Check the correct one
            $('input[name="delivery_type"][value="' + deliveryDetails.delivery_type + '"]')
                .prop('checked', true)
                .attr('checked', 'checked'); // only if you need HTML updated
        })

        function prev() {
            if (step === 2) {

                step = 1;
                localStorage.setItem("checkout_step_" + loginUserId, step); // <<< save step

                step2.classList.remove("is-active");
                step1.classList.add("is-active");
                bar1.style.width = "0%"; // reset bar
            } else if (step === 3) {
                // move to 1 step because if yopu are at 3 that's mean order is completed
                localStorage.setItem("checkout_step_" + loginUserId, 2); // <<< save step

                finish();
                // step = 2;
                // localStorage.setItem("checkout_step_"+ loginUserId, step); // <<< save step

                // step3.classList.remove("is-active");
                // step2.classList.add("is-active");
                // bar2.style.width = "0%"; // reset bar
            }
            showStep();
        }

        function finish() {
            localStorage.removeItem('checkout_step');
            alert("Process Completed!");
            window.location.href = "{{ route('escort.products') }}"; // reset();
        }

        // function reset() {
        //     step = 1;
        //     localStorage.setItem("checkout_step_"+ loginUserId, step); // <<< save step

        //     step1.classList.add("is-active");
        //     step2.classList.remove("is-active");
        //     step3.classList.remove("is-active");

        //     bar1.style.width = "0%";
        //     bar2.style.width = "0%";

        //     showStep();
        // }

        // $('#userProfile').parsley({

        // });
    </script>
@endpush
