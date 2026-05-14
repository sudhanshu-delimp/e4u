<p><strong>Order Summary</strong></p>
<div class="d-flex justify-content-between mb-2">
<span>Subtotal:</span>
<span class="paymentSubtotal">{{ formatCurrency($sub_total_amount) }}</span>
</div>
<div class="d-flex justify-content-between mb-2">
<span>Wallet Used:</span>
<span>{{ formatCurrency($wallet_amount) }}</span>
</div>
<div class="d-flex justify-content-between mb-2">
<span>Loyalty Discount:</span>
<span>{{ formatCurrency($loyalty_amount) }}</span>
</div>
<hr>
<div class="d-flex justify-content-between">
<strong>Total:</strong>
<strong class="paymentTotal">{{ formatCurrency($total_amount) }}</strong>
</div>