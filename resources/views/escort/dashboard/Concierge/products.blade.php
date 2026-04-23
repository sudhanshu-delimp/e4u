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
                    <h1 class="h1">Products</h1>
                    <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>                    
                </div>
                <div class="product_view e4u-tooltip">
                    <span class="view_cart" id="viewCart">
                        <i class="fa fa-shopping-cart"></i>
                        <small class="item_count">10</small>
                        <span class="vtooltip">View Cart</span>
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
        <div class="row d-flex">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 flex">
                <div class="card product-card">
                    <div class="product-image-wrapper">
                        <img src="{{ asset('assets/dashboard/img/product/placeholder.png') }}" class="card-img-top"
                            alt="...">
                    </div>
                    <div class="card-body">
                        <div class="header">
                            <h4>Four Seasons - Naked bulk pack</h4>
                            <span class="price">$ 45.00</span>
                        </div>
                        <div class="p_description">
                            <p>Four Seasons - Close Fitting<br>
                                Naked closer fitting condoms for a secure fit with less chance of
                                slipping off during the experience.<br>
                                QTY: 144 Size: 49mm</p>
                        </div>

                        <div class="p_color">
                            <label for="color">Color:</label>
                            <input type="radio" id="color1" name="color" value="gold">
                            <label for="color1">Gold</label>
                            <input type="radio" id="color2" name="color" value="pink">
                            <label for="color2">Pink</label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="p_quantity">
                                <label for="quantity">Quantity:</label>
                                <input type="number" id="quantity" name="quantity" min="1" max="149"
                                    value="1">
                            </div>
                            <div class="p_size">
                                <label for="size">Size:</label>
                                <select id="size" name="size">
                                    <option value="close_fit">Closer Fit</option>
                                    <option value="regular">Regular</option>
                                    <option value="large">Large</option>
                                    <option value="king_size">King Size</option>
                                </select>
                            </div>
                        </div>
                            <button type="button" class="add_to_cart">Add to Cart</button>
                    </div>
                </div>
            </div>

             <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 d-flex">
                <div class="card product-card">
                    <div class="product-image-wrapper">
                        <img src="{{ asset('assets/dashboard/img/product/placeholder.png') }}" class="card-img-top"
                            alt="...">
                    </div>
                    <div class="card-body">
                        <div class="header">
                            <h4>Lifestyles - Bulk pack</h4>
                            <span class="price">$ 45.00</span>
                        </div>
                        <div class="p_description">
                            <p>Four Seasons - Close Fitting<br>
                                Naked closer fitting condoms for a secure fit with less chance of
                                slipping off during the experience.<br>
                                QTY: 144 Size: 49mm</p>
                        </div>

                        <div class="p_color">
                            <label for="color">Color:</label>
                            <input type="radio" id="color1" name="color" value="gold">
                            <label for="color1">Gold</label>
                            <input type="radio" id="color2" name="color" value="pink">
                            <label for="color2">Pink</label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="p_quantity">
                                <label for="quantity">Quantity:</label>
                                <input type="number" id="quantity" name="quantity" min="1" max="149"
                                    value="1">
                            </div>
                            <div class="p_size">
                                <label for="size">Size:</label>
                                <select id="size" name="size">
                                    <option value="close_fit">Closer Fit</option>
                                    <option value="regular">Regular</option>
                                    <option value="large">Large</option>
                                    <option value="king_size">King Size</option>
                                </select>
                            </div>
                        </div>
                            <button type="button" class="add_to_cart">Add to Cart</button>
                    </div>
                </div>
            </div>

             <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 d-flex">
                <div class="card product-card">
                    <div class="product-image-wrapper">
                        <img src="{{ asset('assets/dashboard/img/product/placeholder.png') }}" class="card-img-top"
                            alt="...">
                    </div>
                    <div class="card-body">
                        <div class="header">
                            <h4>Glyde Maxi - bulk pack</h4>
                            <span class="price">$ 35.00</span>
                        </div>
                        <div class="p_description">
                            <p>Four Seasons - Close Fitting<br>
                                Naked closer fitting condoms for a secure fit with less chance of
                                slipping off during the experience.<br>
                                QTY: 144 Size: 49mm</p>
                        </div>

                        <div class="p_color">
                            <label for="color">Color:</label>
                            <input type="radio" id="color1" name="color" value="gold">
                            <label for="color1">Gold</label>
                            <input type="radio" id="color2" name="color" value="pink">
                            <label for="color2">Pink</label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="p_quantity">
                                <label for="quantity">Quantity:</label>
                                <input type="number" id="quantity" name="quantity" min="1" max="149"
                                    value="1">
                            </div>
                            <div class="p_size">
                                <label for="size">Size:</label>
                                <select id="size" name="size">
                                    <option value="close_fit">Closer Fit</option>
                                    <option value="regular">Regular</option>
                                    <option value="large">Large</option>
                                    <option value="king_size">King Size</option>
                                </select>
                            </div>
                        </div>
                            <button type="button" class="add_to_cart">Add to Cart</button>
                    </div>
                </div>
            </div>


             <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 d-flex">
                <div class="card product-card">
                    <div class="product-image-wrapper">
                        <img src="{{ asset('assets/dashboard/img/product/placeholder.png') }}" class="card-img-top"
                            alt="...">
                    </div>
                    <div class="card-body">
                        <div class="header">
                            <h4>Wet Stuff - Lubricant</h4>
                            <span class="price">$ 30.00</span>
                        </div>
                        <div class="p_description">
                            <p>Four Seasons - Close Fitting<br>
                                Naked closer fitting condoms for a secure fit with less chance of
                                slipping off during the experience.<br>
                                QTY: 144 Size: 49mm</p>
                        </div>

                        <div class="p_color">
                            <label for="color">Color:</label>
                            <input type="radio" id="color1" name="color" value="gold">
                            <label for="color1">Gold</label>
                            <input type="radio" id="color2" name="color" value="pink">
                            <label for="color2">Pink</label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="p_quantity">
                                <label for="quantity">Quantity:</label>
                                <input type="number" id="quantity" name="quantity" min="1" max="149"
                                    value="1">
                            </div>
                            <div class="p_size">
                                <label for="size">Size:</label>
                                <select id="size" name="size">
                                    <option value="close_fit">Closer Fit</option>
                                    <option value="regular">Regular</option>
                                    <option value="large">Large</option>
                                    <option value="king_size">King Size</option>
                                </select>
                            </div>
                        </div>
                            <button type="button" class="add_to_cart">Add to Cart</button>
                    </div>
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
@endsection
@push('script')

<script>
    const viewCart = document.querySelector('#viewCart');
    viewCart.addEventListener("click", function(){
        window.location.href = "{{route('escort.view-cart')}}";
    })

</script>

@endpush
