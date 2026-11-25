


<div class="d-flex justify-content-between mb-2">
    <span>Billing Frequency:</span>
    <span>Monthly</span>
</div>

<div class="d-flex justify-content-between mb-2">
    <span>Monthly Subscription Fee:</span>
    <span id="monthly-fee">{{ formatCurrency($monthlyFee) }}</span>
</div>

{{-- <div class="d-flex justify-content-between mb-2">
    <span>GST per Month:</span>
    <span>{{ formatCurrency($gstAmount) }}</span>
</div> --}}



<div class="d-flex justify-content-between mb-2">
    <span>Subscription Duration:</span>
    <span id="subscription-duration">{{ $duration }} Months</span>
</div>

<div class="d-flex justify-content-between mb-2">
    <span>Total Subscription Cost (Excl. GST):</span>
    <span id="total-subscription-cost">
        {{ formatCurrency($totalSubscriptionCost) }}
    </span>
</div>
<div class="d-flex justify-content-between mb-2 fw-bold">
    <span> GST:</span>
    <span id="total_fee">{{ formatCurrency($totalGstAmount) }}</span>
</div>
<hr>

<div class="d-flex justify-content-between align-items-center mb-2">
    <span>Total Subscription Cost (Incl. GST):</span>
    <strong>{{ formatCurrency($totalSubscriptionCost + ($gstAmount * $duration)) }}</strong>
</div>
<hr>

{{-- <div class="d-flex justify-content-between align-items-center fw-bold">
    <strong>Total Due:</strong>
    <strong class="paymentTotal totalDue" style="border-top: 1px solid;">
        {{ formatCurrency($amountDueToday) }}
    </strong>
</div> --}}

 

