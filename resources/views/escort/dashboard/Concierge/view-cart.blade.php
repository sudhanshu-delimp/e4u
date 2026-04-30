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
                            <form action="/" id="deliveryAddressForm">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="Mobile Number"><b>Mobile Number</b></label>
                                        <input type="text" class="form-control" placeholder="0145 028 758" name="phone"
                                            required>
                                    </div>
                                    <div class="col-6">
                                        <label for="email"><b>Email</b></label>
                                        <input type="text" class="form-control" name="email"
                                            placeholder="you@domain.com.au" required>
                                    </div>
                                    <div class="col-md-12 my-2">
                                        <label for="Address"><b>Address</b></label>
                                        <input type="text" class="form-control" name="address"
                                            placeholder="Unit 1, 1 The Street, Suburb WA 6000" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="Instructions"><b>Any Special Instructions?</b></label>
                                        <textarea type="textarea" class="form-control common_textarea" name="special_instructions" rows="5"
                                            placeholder="Like building access if we are delivering to your door." required></textarea>
                                        {{-- <div class="row my-3"> --}}
                                        <div class="col-lg-12">
                                            <input type="radio" name="delivery_type" id="door" value="door"
                                                required checked>
                                            <label for="door"><b>Delivery to the door</b></label>

                                            <input type="radio" name="delivery_type" id="post" value="post"
                                                style="margin-left: 17px;" required>
                                            <label for="post" for="post"><b>Post</b></label>

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
        let cart = JSON.parse(localStorage.getItem('cart') || '{}');
        let productIds = Object.keys(cart);
        let finalCart = JSON.parse(localStorage.getItem("finalCart")) || [];

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

                    $(".table-content").html(rows);
                    // ✅ update footer total
                    // $("#grand-total").text("$" + grandTotal.toFixed(2));
                    calculateTotals();
                },

                error: function() {
                    $("#loader").hide();
                    Swal.fire('Error loading products', '', 'error');
                }
            });
        }
        loadProducts();

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
            let finalCart = JSON.parse(localStorage.getItem("finalCart")) || [];

            let id = $(this).data("id");
            if (this.checked) {
                if (!finalCart.includes(id))
                    finalCart.push(id);
            } else {
                finalCart = finalCart.filter(itemId => itemId !== id);
            }

            localStorage.setItem("finalCart", JSON.stringify(finalCart));
            calculateTotals();

        });

        function next() {
            if (step === 1) {
                let finalCart = JSON.parse(localStorage.getItem("finalCart")) || [];

                if (Object.keys(finalCart).length === 0) {
                    Swal.fire('Please select at least one product before continuing.', '', 'error');
                    return;
                }
                updateOrderSummary();
                updateDeliveryAddress();

                step = 2;
                localStorage.setItem("checkout_step", step); // <<< save step

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
                    localStorage.setItem("checkout_step", step);

                    step2.classList.remove("is-active");
                    bar2.style.width = "100%";
                    step3.classList.add("is-active");

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
            let cart = JSON.parse(localStorage.getItem("cart"));
            let finalCart = JSON.parse(localStorage.getItem("finalCart"));

            // get final cart item 
            let itemDetails = Object.fromEntries(
                Object.entries(cart).filter(([key, value]) => finalCart.includes(parseInt(key)))
            );

            // delivery type
            formData.delivery_type = $('input[name="delivery_type"]:checked').val();

            // get payment details like tax sub total toatal amount for corss check in backend before make payment
            let paymentDetails = JSON.parse(localStorage.getItem("paymentDetails"));

            // set details to make order
            orderData.deliverDetails = formData;
            orderData.itemDetails = itemDetails;
            orderData.paymentDetails = paymentDetails;

            $.ajax({
                url: "{{ route('escort.make.order') }}",
                type: "POST",
                data: orderData,
                dataType: "json",
                success: function(response) {
                    if (response.status === "success") {
                        if (typeof callback === "function") callback();
                    } else {
                        Swal.fire("Error: " + response.message, '', 'error');

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

            localStorage.setItem("deliveryAddress", JSON.stringify(result));

            return result; // return to use in AJAX
        }

        function validateStep2() {
            let isValid = true;

            $("#deliveryAddressForm")
                .find("input, textarea, select")
                .each(function() {
                    if ($(this).val().trim() === "") {
                        isValid = false;
                        $(this).addClass("is-invalid");
                    } else {
                        $(this).removeClass("is-invalid");
                    }
                });

            return isValid;
        }


        document.addEventListener("DOMContentLoaded", function() {
            let savedStep = localStorage.getItem("checkout_step");

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
            let saved = JSON.parse(localStorage.getItem("deliveryAddress"));

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
            let cart = JSON.parse(localStorage.getItem('cart')) || {};
            let finalCart = JSON.parse(localStorage.getItem('finalCart')) || [];
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

            localStorage.setItem("paymentDetails", JSON.stringify(paymentData));

        }
        $('input[name="delivery_type"]').on('change', function() {

            updateOrderSummary();
        });


        function prev() {
            if (step === 2) {
                step = 1;
                localStorage.setItem("checkout_step", step); // <<< save step

                step2.classList.remove("is-active");
                step1.classList.add("is-active");
                bar1.style.width = "0%"; // reset bar
            } else if (step === 3) {
                step = 2;
                localStorage.setItem("checkout_step", step); // <<< save step

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

        // $('#userProfile').parsley({

        // });



        // $('#userProfile').on('submit', function(e) {
        //     e.preventDefault();

        //     var form = $(this);

        //     if (form.parsley().isValid()) {

        //         var url = form.attr('action');
        //         var data = new FormData(form[0]);
        //         $.ajax({
        //             method: form.attr('method'),
        //             url: url,
        //             data: data,
        //             contentType: false,
        //             processData: false,
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             success: function(data) {
        //                 if (!data.error) {
        //                     $.toast({
        //                         heading: 'Success',
        //                         text: 'Details successfully saved',
        //                         icon: 'success',
        //                         loader: true,
        //                         position: 'top-right', // Change it to false to disable loader
        //                         loaderBg: '#9EC600' // To change the background
        //                     });

        //                 } else {
        //                     $.toast({
        //                         heading: 'Error',
        //                         text: 'Records Not update',
        //                         icon: 'error',
        //                         loader: true,
        //                         position: 'top-right', // Change it to false to disable loader
        //                         loaderBg: '#9EC600' // To change the background
        //                     });

        //                 }
        //             },

        //         });
        //     }
        // });
        // $('#city').select2({
        //     allowClear: true,
        //     placeholder: 'Select City',
        //     createTag: function(params) {
        //         var term = $.trim(params.term);

        //         if (term === '') {
        //             return null;
        //         }
        //         return {
        //             id: term,
        //             text: term,
        //             newTag: false // add additional parameters
        //         }
        //     },
        //     tags: false,
        //     minimumInputLength: 2,
        //     tokenSeparators: [','],
        //     ajax: {
        //         url: "{{ route('city.list') }}",
        //         dataType: "json",
        //         type: "GET",
        //         data: function(params) {
        //             console.log(params);
        //             var queryParameters = {
        //                 query: params.term,
        //                 state_id: $('#state').val()
        //             }
        //             return queryParameters;
        //         },
        //         processResults: function(data) {
        //             return {
        //                 results: $.map(data, function(item) {

        //                     return {
        //                         text: item.name,
        //                         id: item.id
        //                     }
        //                 })
        //             };
        //         }
        //     }
        // });

        // $('#state').select2({
        //     allowClear: true,
        //     placeholder: 'Select State',
        //     createTag: function(params) {
        //         var term = $.trim(params.term);

        //         if (term === '') {
        //             return null;
        //         }
        //         return {
        //             id: term,
        //             text: term,
        //             newTag: false // add additional parameters
        //         }
        //     },
        //     tags: false,
        //     minimumInputLength: 2,
        //     tokenSeparators: [','],
        //     ajax: {
        //         url: "{{ route('state.list') }}",
        //         dataType: "json",
        //         type: "GET",
        //         data: function(params) {
        //             console.log(params);
        //             var queryParameters = {
        //                 query: params.term,
        //                 country_id: $('#country').val()
        //             }
        //             return queryParameters;
        //         },
        //         processResults: function(data) {
        //             return {
        //                 results: $.map(data, function(item) {

        //                     return {
        //                         text: item.name,
        //                         id: item.id
        //                     }
        //                 })
        //             };
        //         }
        //     }
        // });


        // $('#country').on('change', function(e) {
        //     if ($(this).val()) {
        //         $('#state').prop('disabled', false);
        //         $('#state').select2('open');
        //     } else {
        //         $('#state').prop('disabled', true);
        //     }
        // });

        // $('#state').on('change', function(e) {
        //     if ($(this).val()) {
        //         $('#city').prop('disabled', false);
        //         $('#city').select2('open');
        //     } else {
        //         $('#city').prop('disabled', true);
        //     }
        // });
    </script>
    <script>
        // $(document).ready(function() {
        //     $('#productTable').DataTable({
        //         responsive: true,
        //         language: {
        //             search: "Search: _INPUT_",
        //             searchPlaceholder: "Search by ID or Profile Name...",
        //             lengthMenu: "Show _MENU_ entries",
        //             zeroRecords: "No matching records found",
        //             info: "Showing _START_ to _END_ of _TOTAL_ entries",
        //             infoEmpty: "No entries available",
        //             infoFiltered: "(filtered from _MAX_ total entries)"
        //         },
        //         initComplete: function() {
        //             if ($('#returnToReportBtn').length === 0) {
        //                 $('.dataTables_filter').append(
        //                     '<button id="returnToReportBtn" class="create-tour-sec my-3">Return to Report</button>'
        //                 );
        //             }
        //             $('#returnToReportBtn').on('click', function() {
        //                 var table = $('#productTable').DataTable();
        //                 table.search('').draw();
        //             });
        //         },
        //         "language": {
        //             "zeroRecords": "There is no record of the search criteria you entered.",
        //             searchPlaceholder: "Search by ID or Profile Name"
        //         },
        //         paging: true
        //     });
        // });
    </script>
@endpush
