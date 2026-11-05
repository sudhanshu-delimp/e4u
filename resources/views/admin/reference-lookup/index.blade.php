@extends('layouts.admin')
@section('style')
<style>
    /* ================= HEADER ================= */
    .header {
        display: flex;
        align-items: center;
        gap: 14px;
        padding-bottom: 24px;
        border-bottom: 1px solid #f1f5f9;
    }

    .header-icon {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background-color: #fff1f2;
        border: 1px solid #ffe4e6;
        color: #f43f5e;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .header-title {
        font-size: 20px;
        font-weight: 700;
        color: #0f172a;
        letter-spacing: -0.3px;
    }

    /* ================= 2-COLUMN GRID ================= */
    .split-grid {
        display: grid;
        grid-template-columns: 1fr 1.35fr;
        gap: 36px;
        margin-top: 32px;
    }

    /* ================= LEFT COLUMN: FORM ================= */
    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 10px;
    }

    .input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    /* Pink Vertical Accent Indicator from screenshot */
    .input-accent-pill {
        position: absolute;
        left: 10px;
        top: 10px;
        bottom: 10px;
        width: 4px;
        background-color: #f43f5e;
        border-radius: 999px;
        pointer-events: none;
    }

    .input-field {
        width: 100%;
        padding: 13px 16px 13px 26px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        font-size: 14px;
        font-family: inherit;
        color: #0f172a;
        outline: none;
        transition: all 0.2s ease;
    }

    .input-field:focus {
        border-color: #fb7185;
        box-shadow: 0 0 0 3px rgba(244, 63, 94, 0.12);
    }

    .input-field::placeholder {
        color: #94a3b8;
    }

    .input-helper {
        font-size: 12px;
        font-style: italic;
        color: #94a3b8;
        margin-top: 8px;
    }

    .btn-submit {
        width: 100%;
        margin-top: 16px;
        padding: 12px 18px;
        background-color: #0f172a;
        color: #ffffff;
        border: none;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        font-family: inherit;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: background-color 0.2s;
    }

    .btn-submit:hover {
        background-color: #1e293b;
    }

    /* Quick Test Buttons */
    .quick-tags {
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid #f1f5f9;
    }

    .quick-tags-title {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #94a3b8;
        margin-bottom: 8px;
        display: block;
    }

    .tag-btn {
        font-family: monospace;
        font-size: 12px;
        background-color: #f1f5f9;
        border: 1px solid #e2e8f0;
        color: #475569;
        padding: 5px 10px;
        border-radius: 8px;
        cursor: pointer;
        margin-right: 6px;
        transition: all 0.15s ease;
    }

    .tag-btn:hover {
        background-color: #fff1f2;
        color: #f43f5e;
        border-color: #ffe4e6;
    }

    /* ================= RIGHT COLUMN: STATES ================= */
    .dashed-box {
        border: 1.5px dashed #cbd5e1;
        border-radius: 20px;
        padding: 40px 28px;
        min-height: 350px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        background-color: #ffffff;
    }

    /* Pink Squircle Icon Box */
    .squircle-icon {
        width: 68px;
        height: 68px;
        background-color: #fff1f2;
        border: 1px solid #ffe4e6;
        border-radius: 22px;
        color: #f43f5e;
        font-size: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .state-title {
        font-size: 18px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 8px;
    }

    .state-desc {
        font-size: 13px;
        color: #64748b;
        max-width: 320px;
        line-height: 1.5;
        margin-bottom: 24px;
    }

    /* Waiting Pill with Amber Dot */
    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 999px;
        padding: 6px 16px;
        font-size: 12px;
        font-weight: 600;
        color: #475569;
    }

    .dot-amber {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: #f59e0b;
        animation: pulse 1.5s infinite;
    }

    /* Result Found View */
    .result-box {
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 28px;
        background-color: #ffffff;
        min-height: 350px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .result-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 16px;
    }

    .type-badge {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        background-color: #fff1f2;
        color: #f43f5e;
        border: 1px solid #ffe4e6;
        padding: 3px 8px;
        border-radius: 6px;
        display: inline-block;
        margin-bottom: 6px;
    }

    .ref-title {
        font-size: 20px;
        font-weight: 700;
        font-family: monospace;
        color: #0f172a;
    }

    .verified-pill {
        font-size: 12px;
        font-weight: 600;
        background-color: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
        padding: 4px 10px;
        border-radius: 999px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .dot-green {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background-color: #10b981;
    }

    .meta-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin: 20px 0;
    }

    .meta-item span {
        display: block;
    }

    .meta-label {
        font-size: 11px;
        color: #94a3b8;
        margin-bottom: 3px;
    }

    .meta-val {
        font-size: 14px;
        font-weight: 600;
        color: #0f172a;
    }

    .meta-val.price {
        font-size: 16px;
        color: #f43f5e;
    }

    .result-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-top: 1px solid #f1f5f9;
        padding-top: 16px;
    }

    .btn-clear {
        background: none;
        border: none;
        color: #94a3b8;
        font-size: 12px;
        cursor: pointer;
    }

    .btn-clear:hover {
        color: #475569;
    }

    .btn-view-details {
        background-color: #f43f5e;
        color: #ffffff;
        border: none;
        padding: 10px 18px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 600;
        font-family: inherit;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(244, 63, 94, 0.2);
        transition: background-color 0.2s;
    }

    .btn-view-details:hover {
        background-color: #e11d48;
    }

    /* Modal Styling */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(15, 23, 42, 0.4);
        backdrop-filter: blur(2px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 100;
        padding: 20px;
    }

    .modal-card {
        background: #ffffff;
        width: 100%;
        max-width: 480px;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 14px;
        margin-bottom: 16px;
    }

    .btn-close {
        background: #f1f5f9;
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        cursor: pointer;
        color: #64748b;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 14px;
        background-color: #f8fafc;
        border-radius: 8px;
        font-size: 13px;
        margin-bottom: 8px;
    }

    /* Utility */
    .hidden {
        display: none !important;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.4;
        }
    }

    /* ================= RESPONSIVE ================= */
    @media (max-width: 820px) {
        .split-grid {
            grid-template-columns: 1fr;
            gap: 28px;
        }

    }
</style>
@stop
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <div class="row">
        <div class="custom-heading-wrapper col-md-12">
            <h1 class="h1">Reference Lookup</h1>
            <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes"
                aria-expanded="true">Help?</span>
        </div>
        <div class="col-md-12">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <h3 class="NotesHeader"><b>Notes:</b></h3>
                    <ol>
                    </ol>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">

            <!-- Main Container -->
            <div class="common-card">
                    <div class="card-top">
                        <div class="card-icon">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>

                        <div class="card-heading">
                            <h2>Advertiser Details & Reference Lookup</h2>
                        </div>
                    </div>

                <!-- 2 Column Body -->
                <div class="split-grid">

                    <!-- LEFT: Search Section -->
                    <div>
                        <label for="referenceInput" class="form-label">Reference ID / Member ID</label>

                        <form id="lookupForm" onsubmit="handleSearch(event)">
                            <div class="input-wrapper">
                                <!-- Distinctive Rose Vertical Accent -->
                                <span class="input-accent-pill"></span>
                                <input
                                    type="text"
                                    id="referenceInput"
                                    class="input-field"
                                    placeholder="Enter Reference ID"
                                    autocomplete="off"
                                    required />
                            </div>
                            <p class="input-helper">Enter reference ID to find transaction record.</p>

                            <button type="submit" class="btn-submit">
                                <i class="fa-solid fa-magnifying-glass" style="font-size: 12px;"></i>
                                <span>Search Transaction</span>
                            </button>
                        </form>

                        <!-- Quick Suggestions -->
                        <div class="quick-tags">
                            <span class="quick-tags-title">Quick Demo IDs:</span>
                            <button type="button" onclick="quickFill('TXN-98421')" class="tag-btn">TXN-98421</button>
                            <button type="button" onclick="quickFill('ORD-55210')" class="tag-btn">ORD-55210</button>
                        </div>
                    </div>

                    <!-- RIGHT: Result / Empty State Area -->
                    <div>

                        <!-- 1. EMPTY STATE (Exact match to screenshot) -->
                        <div id="emptyState" class="dashed-box">
                            <div class="squircle-icon">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                            <h2 class="state-title">No Advertiser Selected</h2>
                            <p class="state-desc">
                                Enter a valid Member ID or Reference ID on the left to view transaction details, select services, and inspect history.
                            </p>
                            <div class="status-pill">
                                <span class="dot-amber"></span>
                                <span>Waiting for Member ID</span>
                            </div>
                        </div>

                        <!-- 2. FOUND RESULT VIEW -->
                        <div id="resultBox" class="result-box hidden">
                            <div>
                                <div class="result-header">
                                    <div>
                                        <span id="resBadge" class="type-badge">Payment Transaction</span>
                                        <div id="resRef" class="ref-title">TXN-98421</div>
                                    </div>
                                    <div class="verified-pill">
                                        <span class="dot-green"></span>
                                        <span>Found & Active</span>
                                    </div>
                                </div>

                                <div class="meta-grid">
                                    <div class="meta-item">
                                        <span class="meta-label">Customer / Member</span>
                                        <span id="resCustomer" class="meta-val">Alexander Wright</span>
                                    </div>
                                    <div class="meta-item">
                                        <span class="meta-label">Transaction Total</span>
                                        <span id="resAmount" class="meta-val price">$320.00 USD</span>
                                    </div>
                                    <div class="meta-item">
                                        <span class="meta-label">Processed Date</span>
                                        <span id="resDate" class="meta-val">24 Oct 2023, 11:40 AM</span>
                                    </div>
                                    <div class="meta-item">
                                        <span class="meta-label">Payment Gateway</span>
                                        <span id="resGateway" class="meta-val">Stripe (Visa 4242)</span>
                                    </div>
                                </div>
                            </div>

                            <div class="result-footer">
                                <button onclick="resetView()" class="btn-clear">Clear Result</button>
                                <button onclick="openModal()" class="btn-view-details">
                                    <span>View Full Details</span>
                                    <i class="fa-solid fa-arrow-right" style="font-size: 11px;"></i>
                                </button>
                            </div>
                        </div>

                        <!-- 3. NOT FOUND STATE -->
                        <div id="notFoundBox" class="dashed-box hidden" style="border-color: #fca5a5; background-color: #fef2f2;">
                            <div class="squircle-icon" style="background-color: #fee2e2; color: #ef4444; border-color: #fecaca;">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                            </div>
                            <h2 class="state-title" style="color: #991b1b;">Record Not Found</h2>
                            <p class="state-desc" style="color: #b91c1c;">No matching record exists for this Reference. Please re-check the entered value.</p>
                            <button onclick="resetView()" class="tag-btn" style="background: white;">Try Again</button>
                        </div>

                    </div>

                </div>
            </div>

            <!-- Detail Inspection Modal -->
            <div id="modal" class="modal-overlay hidden">
                <div class="modal-card">
                    <div class="modal-header">
                        <div>
                            <h3 style="font-size: 16px; font-weight: 700; color: #0f172a;">Transaction Overview</h3>
                            <span id="modalRef" style="font-size: 12px; font-family: monospace; color: #94a3b8;">TXN-98421</span>
                        </div>
                        <button onclick="closeModal()" class="btn-close"><i class="fa-solid fa-xmark"></i></button>
                    </div>

                    <div class="detail-row">
                        <span style="color: #64748b;">Processing Status</span>
                        <strong style="color: #10b981;">Completed (Settled)</strong>
                    </div>
                    <div class="detail-row">
                        <span style="color: #64748b;">Associated Email</span>
                        <strong style="color: #0f172a;" id="modalEmail">alexander@acme.corp</strong>
                    </div>
                    <div class="detail-row">
                        <span style="color: #64748b;">Internal Audit Trace</span>
                        <strong style="font-family: monospace; color: #475569;">#AUD-99410-X</strong>
                    </div>

                    <button onclick="closeModal()" class="btn-submit" style="margin-top: 18px; width: 100%;">
                        Close Inspection
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')



<!-- Script for Mock Searching -->

<script>
    const database = {
        "TXN-98421": {
            badge: "Payment Transaction",
            ref: "TXN-98421",
            customer: "Alexander Wright",
            email: "alexander@acme.corp",
            amount: "$320.00 USD",
            date: "24 Oct 2023, 11:40 AM",
            gateway: "Stripe (Visa 4242)"
        },
        "ORD-55210": {
            badge: "Sales Order",
            ref: "ORD-55210",
            customer: "Emma Watson",
            email: "emma@hollywood.co",
            amount: "$1,150.00 USD",
            date: "23 Oct 2023, 03:15 PM",
            gateway: "Wire Transfer"
        }
    };

    const emptyState = document.getElementById('emptyState');
    const resultBox = document.getElementById('resultBox');
    const notFoundBox = document.getElementById('notFoundBox');
    const input = document.getElementById('referenceInput');

    function quickFill(val) {
        input.value = val;
        handleSearch(new Event('submit'));
    }

    function handleSearch(e) {
        e.preventDefault();
        const val = input.value.trim().toUpperCase();

        emptyState.classList.add('hidden');
        resultBox.classList.add('hidden');
        notFoundBox.classList.add('hidden');

        if (database[val]) {
            const item = database[val];
            document.getElementById('resBadge').innerText = item.badge;
            document.getElementById('resRef').innerText = item.ref;
            document.getElementById('resCustomer').innerText = item.customer;
            document.getElementById('resAmount').innerText = item.amount;
            document.getElementById('resDate').innerText = item.date;
            document.getElementById('resGateway').innerText = item.gateway;
            document.getElementById('modalRef').innerText = item.ref;
            document.getElementById('modalEmail').innerText = item.email;

            resultBox.classList.remove('hidden');
        } else {
            notFoundBox.classList.remove('hidden');
        }
    }

    function resetView() {
        input.value = '';
        resultBox.classList.add('hidden');
        notFoundBox.classList.add('hidden');
        emptyState.classList.remove('hidden');
    }

    function openModal() {
        document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }
</script>
@endpush