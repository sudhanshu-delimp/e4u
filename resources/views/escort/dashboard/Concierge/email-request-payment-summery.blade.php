<p><strong>Order Summary</strong></p>
<div class="d-flex justify-content-between mb-2">
    <span>Your Order:</span>
    <span id="monthly-fee">{{ formatCurrency($totalSubscriptionCost) }}</span>
</div>

<div class="d-flex justify-content-between align-items-center">
    <strong>GST:</strong>
    <strong class="taxAmount" style="border:none;padding:0">
        {{ formatCurrency($totalGstAmount) }}
    </strong>
</div>

<hr>

<div class="d-flex justify-content-between align-items-center fw-bold">
    <span>Total Fee:</span>
    <span id="total_fee">{{ formatCurrency($amountDueToday) }}</span>
</div>

<div class="d-flex justify-content-between align-items-center fw-bold">
    <span>Wallet Used:</span>
    <span id="walletUsed">
        {{ formatCurrency(0) }}
    </span>
</div>

<div class="d-flex justify-content-between align-items-center fw-bold">
    <strong>Total Due:</strong>
    <strong class="paymentTotal totalDue" style="border-top:1px solid">
        {{ formatCurrency($amountDueToday) }}
    </strong>
</div>
