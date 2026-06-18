
// Get cart for specific user 
function getCart() {
  return JSON.parse(localStorage.getItem('cart_' + loginUserId) || '{}');
}
function getOrderId() {
  return JSON.parse(localStorage.getItem('orderId_' + loginUserId) || '{}');
}

function getStep() {
  return JSON.parse(localStorage.getItem('checkout_step_' + loginUserId) || '{}');
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


function saveCardBilling(details) {
  localStorage.setItem('cardBilling_' + loginUserId, JSON.stringify(details));
}
function getCardBilling() {
  return JSON.parse(localStorage.getItem('cardBilling_' + loginUserId) || '{}');
}

function flushLocalStorage() {
  localStorage.removeItem('finalCart_' + loginUserId);
  localStorage.removeItem('cardBilling_' + loginUserId);

  localStorage.removeItem('orderId_' + loginUserId);
  localStorage.removeItem('cart_' + loginUserId);
  localStorage.removeItem('deliveryAddress_' + loginUserId);
  localStorage.removeItem('paymentDetails_' + loginUserId);
  localStorage.removeItem('checkout_step_' + loginUserId);
  localStorage.removeItem('isSameAddress_' + loginUserId);

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

    // 🔹 Max Limit = 5
    if ((type === "add" || type === "increase") && qty >= 5) {
        Swal.fire({
            icon: "warning",
            title: "Maximum Limit Reached",
            text: "You can only add up to 5 quantities.",
            timer: 1000,
            showConfirmButton: false
        });
        return; // ⛔ stop execution
    }

    if (type === "add" || type === "increase") {
        qty++;
        cart[id] = {
            qty: qty,
            price: price
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
                price: price
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

    cartCount();
});

$(document).on('click', '.product-image', function () {

  let title = $(this).data('title') ?? 'title';
  let image = $(this).data('image') ?? 'https://e4u.local/admin/products/escort.jpg';

  $('#modalTitle').html(title);

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
