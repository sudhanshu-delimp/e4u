<p><strong>Order Summary</strong></p>
<div class="d-flex justify-content-between mb-2">
    <span>Your Order:</span>
    <span id="base-amount">{{ formatCurrency($totalSubscriptionCost) }}</span>
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
    <span id="total_fee">{{ formatCurrency($totalFee) }}</span>
</div>

<div class="d-flex justify-content-between align-items-center fw-bold">
    <span>Wallet Used:</span>
    <span id="walletUsed" class="{{ $type == 'apply_wallet' ? 'text-danger' : '' }}">

        {{ $type == 'apply_wallet' ? '(-' . formatCurrency($walletAmount) . ')' : formatCurrency($walletAmount) }}
    </span>
</div>

<div class="d-flex justify-content-between align-items-center fw-bold">
    <strong>Total Due:</strong>
    <strong class="paymentTotal totalDue" style="border-top:1px solid">
        {{ formatCurrency($amountDue) }}
    </strong>
</div>
<input type="hidden" id="amountDue" value="{{ $amountDue }}">
<input type="hidden" id="totalGstAmount" value="{{ $totalGstAmount }}">
<input type="hidden" id="duration" value="{{ $duration }}">
<input type="hidden" id="walletUsedAmount" value="{{ $walletAmount }}">
