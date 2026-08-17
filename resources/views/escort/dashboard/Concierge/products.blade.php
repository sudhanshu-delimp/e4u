@extends(auth()->user()->type == 4 ? 'layouts.center' : 'layouts.escort')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">

    <style type="text/css">
        .parsley-errors-list {
            list-style: none;
            color: rgb(248, 0, 0)
        }

        .cart-disabled {
            opacity: 0.4;
            pointer-events: none;
            /* Prevent click */
            cursor: default;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5 add-punterbox-report">
        <!--middle content start here-->

        {{-- Page Heading   --}}
        <div class="row">
            <div class="d-flex justify-content-between align-items-center flex-wrap col-md-12">
                <div class="custom-heading-wrapper">
                    <h1 class="h1">Products</h1>
                    <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
                </div>
                <div class="product_view e4u-tooltip">
                    <span class="view_cart" id="viewCart">
                        <i class="fa fa-shopping-cart"></i>
                        <small class="item_count" id="cart-count">0</small>
                        <span class="vtooltip">View Cart</span>
                    </span>
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b></h3>
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
        {{-- <div class="row">
            @if ($products->isNotEmpty())
                <div class="col-12 product-card-wrapper">

                    @foreach ($products as $item)
                        <div class="card product-card">
                            <div class="product-image-wrapper">
                                <img src="{{ asset('admin/products/escort.jpg') }}" class="card-img-top product-image"
                                    data-title="{{ strip_tags($item->description) }}"
                                    data-image="{{ asset('admin/products/escort.jpg') }}" style="cursor:pointer;">
                            </div>
                            <div class="card-body">
                                <div class="header">
                                    <p>{!! $item->description !!}
                                        <br>QTY: {{ $item->qty }}
                                        {{ !empty($item->size) && $item->size != 'N/A' ? 'Size:' . $item->size : '' }}
                                    </p>
                                    <span class="price">${{ $item->price }}</span>
                                </div>
                                <div class="product-box" id="product-{{ $item->id }}">

                                    @if (in_array($item->id, $cartItems))
                                        <div class="qty-box text-center">
                                            <button class="qty-decrease cartAction" data-id="{{ $item->id }}"
                                                data-type="decrease">-</button>

                                            <span class="qty" id="qty-{{ $item->id }}">
                                                {{ $item->cartItem->quantity ?? 1 }}
                                            </span>

                                            <button class="qty-increase cartAction" data-id="{{ $item->id }}"
                                                data-type="increase">+</button>
                                        </div>
                                    @else
                                        <button class="add_to_cart cartAction" data-id="{{ $item->id }}"
                                            data-type="add">
                                            Add to Cart
                                        </button>
                                    @endif

                                </div>
                            </div>


                        </div>
                    @endforeach
                @else
                    <p>Item Not Found</p>
            @endif
        </div> --}}

        <div class="row">
            @if ($products->isNotEmpty())
                <div class="col-12 product-card-wrapper">
                    @foreach ($products as $item)
                        <div class="card product-card">

                            <div class="product-image-wrapper">
                                <img src="{{ $item->image }}" class="card-img-top product-image"
                                    data-title="{{ strip_tags($item->description) }}" data-image="{{ $item->image }}"
                                    style="cursor:pointer;">
                            </div>

                            <div class="card-body">

                                <div class="header">
                                    <p>
                                        {!! $item->description !!}
                                        <br>QTY: {{ $item->qty }}
                                        {{ !empty($item->size) && $item->size != 'N/A' ? 'Size:' . $item->size : '' }}
                                    </p>
                                    <span class="price">${{ $item->price }}</span>
                                </div>

                                <!-- PRODUCT ACTION BOX -->
                                <div class="product-box" id="product-{{ $item->id }}">
                                    <button class="add_to_cart cartAction" data-id="{{ $item->id }}"
                                        data-price="{{ $item->price }}" data-type="add">
                                        Add to Cart
                                    </button>
                                </div>

                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <p>Item Not Found</p>
            @endif
        </div>

    </div>
    </div>
    <!-- End of Main Content -->
    <!-- Product Image Modal -->
    <div class="modal fade upload-modal " id="imageModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
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
        let loginUserId = "{{ session('parent_agent_id') ?? Auth::user()->id }}";
    </script>
    <script type="text/javascript" src="{{ asset('escort/js/main.js') }}"></script>
    <script>
        const viewCart = document.querySelector('#viewCart');
        viewCart.addEventListener("click", function() {

            localStorage.setItem('checkout_step_' + loginUserId, 1);

            window.location.href =
                "{{ auth()->user()->type == 4 ? route('center.view-cart') : route('escort.view-cart') }}";
        })

        $(document).ready(function() {
            renderCartUI();
            cartCount();
        });

        function cartCount() {
            let count = getCartCount();
            $('#cart-count').text(count);
            if (count == 0) {
                $('#viewCart').addClass('cart-disabled');
            } else {
                $('#viewCart').removeClass('cart-disabled');
            }
        }
    </script>
@endpush
