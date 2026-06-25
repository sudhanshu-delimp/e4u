<p><strong>Order Summary</strong></p>
<div class="d-flex justify-content-between mb-2">
    <span>Subtotal:</span>
    <span class="paymentSubtotal">{{ formatCurrency($sub_total_amount) }}</span>
</div>
@if(!in_array($action, ['wallet']))
<div class="d-flex justify-content-between align-items-center mb-2">
    <span>Wallet Used:</span>
    <span>{{ formatCurrency($wallet_amount) }}</span>
</div>
@endif
@if(in_array($action, ['listing','extend','tour']))
<div class="d-flex justify-content-between align-items-center mb-2">
    <span>Loyalty Discount:</span>
    <span>{{ formatCurrency($loyalty_amount) }}</span>
</div>
@endif
<hr>
<div class="d-flex justify-content-between align-items-center">
    <strong>Total Fee:</strong>
    <strong class="paymentTotal">{{ formatCurrency($total_amount) }}</strong>
</div>
<div class="d-flex justify-content-between align-items-center">
    <strong>GST:</strong>
    <strong class="taxAmount">{{formatCurrency($gstAmount)}}</strong>
</div>
<div class="d-flex justify-content-between align-items-center">
    <strong>Total Due:</strong>
    <strong class="paymentTotal totalDue">{{formatCurrency($totalDueAmount)}}</strong>
</div>