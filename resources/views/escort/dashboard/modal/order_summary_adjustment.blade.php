<p><strong>Order Summary</strong></p>
<div class="d-flex justify-content-between mb-2">
    <span>Subtotal:</span>
    <span class="paymentSubtotal">{{ formatCurrency($sub_total_amount) }}</span>
</div>
<div class="d-flex justify-content-between mb-2">
    <span>GST:</span>
    <span class="paymentSubtotal">{{formatCurrency($gstAmount)}}</span>
</div>
<hr>
<div class="d-flex justify-content-between align-items-center">
    <strong>Total Fee:</strong>
    <strong class="paymentTotal">{{ formatCurrency($total_amount) }}</strong>
</div>
@if(!in_array($action, ['wallet']))
<div class="d-flex justify-content-between align-items-center">
    <strong>Wallet Used:</strong>
    <strong class="">-{{formatCurrency($wallet_amount)}}</strong>
</div>
@endif
@if(in_array($action, ['listing','extend','tour']))
<div class="d-flex justify-content-between align-items-center">
    <strong>Loyalty Discount:</strong>
    <strong class="">-{{formatCurrency($loyalty_amount)}}</strong>
</div>
@endif
<div class="d-flex justify-content-between align-items-center">
    <strong>Total Due:</strong>
    <strong class="paymentTotal totalDue" style="border-top:1px solid">{{formatCurrency($totalDueAmount)}}</strong>
</div>