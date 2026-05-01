 
// Get cart for specific user 
function getCart() {
  return JSON.parse(localStorage.getItem('cart_' + loginUserId) || '{}');
}

// Save cart for specific user
function saveCart(cart) {
  localStorage.setItem('cart_' + loginUserId, JSON.stringify(cart));
}

function getFinalCart() {
  return JSON.parse(localStorage.getItem('finalCart_' + loginUserId) || '[]');
}

function saveFinalCart(finalCart) {
  localStorage.setItem('finalCart_' + loginUserId, JSON.stringify(finalCart));
}

function getPaymentDetails() {
  return JSON.parse(localStorage.getItem('paymentDetails_' + loginUserId) || '{}');
}

function savePaymentDetails(paymentDetails) {
  localStorage.setItem('paymentDetails_' + loginUserId, JSON.stringify(paymentDetails));
}

function getDeliveryDetails() {
  return JSON.parse(localStorage.getItem('deliveryAddress_' + loginUserId) || '{}');
}

function saveDeliveryDetails(details) {
  localStorage.setItem('deliveryAddress_' + loginUserId, JSON.stringify(details));
}


function getCartCount() {
  let cart = getCart();
  // console.log(cart);
  return Object.values(cart).reduce((total, item) => total + item.qty, 0);
}


function renderCartUI() {
  let cart = getCart();

  for (const id in cart) {
    if ($("#product-" + id).length) {

      let price = cart[id].price; // ✅ read stored price
      $("#product-" + id).html(`
                <div class="qty-box text-center">
                    <button class="qty-decrease cartAction" 
                        data-id="${id}" 
                        data-price="${price}"
                        data-type="decrease">-</button>

                    <span class="qty" id="qty-${id}">${cart[id].qty}</span>

                    <button class="qty-increase cartAction" 
                        data-id="${id}" 
                        data-price="${price}"
                        data-type="increase">+</button>
                </div>
            `);
    }
  }
}
$(document).on('click', '.cartAction', function () {

  let id = $(this).data('id');
  let type = $(this).data('type');
  let price = $(this).data('price');
  let cart = getCart();

  let qty = cart[id]?.qty || 0;
  let message = "";

  if (type === "add" || type === "increase") {
    qty++;
    cart[id] = {
      qty: qty,
      price: price // ✅ FIX: store price here
    };
    message = (type === "add") ? "Added to Cart" : "Quantity Increased";
  }

  if (type === "decrease") {
    qty--;

    if (qty <= 0) {
      delete cart[id];
      message = "Removed from Cart";
    } else {
      cart[id] = {
        qty: qty,
        price: price // ✅ keep price here too
      };
      message = "Quantity Decreased";
    }
  }

  saveCart(cart);

  $('#cart-count').text(getCartCount());

  if (!cart[id]) {
    $("#product-" + id).html(`
            <button class="add_to_cart cartAction" data-id="${id}" data-price="${price}" data-type="add">
                Add to Cart
            </button>
        `);
  } else {
    $("#product-" + id).html(`
            <div class="qty-box text-center">
                <button class="qty-decrease cartAction" data-id="${id}" data-price="${price}" data-type="decrease">-</button>
                <span class="qty" id="qty-${id}">${cart[id].qty}</span>
                <button class="qty-increase cartAction" data-id="${id}" data-price="${price}" data-type="increase">+</button>
            </div>
        `);
  }

  Swal.fire({
    icon: "success",
    title: message,
    timer: 700,
    showConfirmButton: false
  });
});

$(document).on('click', '.product-image', function () {

  let title = $(this).data('title') ?? 'title';
  let image = $(this).data('image') ?? 'https://e4u.local/admin/products/escort.jpg';

  $('#modalTitle').text(title);

  // Show modal first
  let modal = new bootstrap.Modal(document.getElementById('imageModal'));
  modal.show();

  // Show loader, hide image
  $('#imageLoader').show();
  $('#modalImage').addClass('d-none');

  // Create new image object to detect load
  let img = new Image();
  img.src = image;

  img.onload = function () {
    $('#modalImage').attr('src', image);
    $('#imageLoader').hide();
    $('#modalImage').removeClass('d-none');
  };

  img.onerror = function () {
    $('#imageLoader').hide();
    Swal.fire('Failed to load image', '', 'error');

  };

});
