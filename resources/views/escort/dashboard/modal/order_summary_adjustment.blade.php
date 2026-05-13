<p><strong>Order Summary</strong></p>
<div class="d-flex justify-content-between mb-2">
<span>Subtotal:</span>
<span class="paymentSubtotal">AU$ {{number_format($sub_total_amount, 2)}}</span>
</div>
<div class="d-flex justify-content-between mb-2">
<span>Wallet Used:</span>
<span>AU$ {{number_format($wallet_amount, 2)}}</span>
</div>
<div class="d-flex justify-content-between mb-2">
<span>Loyalty Discount:</span>
<span>AU$ {{number_format($loyalty_amount, 2)}}</span>
</div>
<hr>
<div class="d-flex justify-content-between">
<strong>Total:</strong>
<strong class="paymentTotal">AU$ {{number_format($total_amount, 2)}}</strong>
</div>