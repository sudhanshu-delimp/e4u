<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tax Invoice | E4U</title>

<style>
:root {
    --navy-900: #0c223d;
    --navy-800: #0c223d;
    --navy-700: #1e3a63;
    --navy-50: #f2f6fb;
    --slate-600: #4a5c74;
    --border: #cbd5e1;
    --border-light: #e2e8f0;
    --text-main: #132238;
    --text-muted: #53657d;
    --card-bg: #ffffff;
    --danger: #d92d43;
    --success: #1aa34d;
}

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    padding: 20px 12px;
    background: #eef2f7;
    color: var(--text-main);
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    font-size: 12.5px;
    line-height: 1.45;
    -webkit-print-color-adjust: exact;
    print-color-adjust: exact;
}

/* Toolbar */
.toolbar {
    max-width: 800px;
    margin: 0 auto 12px;
    display: flex;
    justify-content: flex-end;
}

.print-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 8px 16px;
    background: var(--navy-800);
    color: #fff;
    border: none;
    border-radius: 6px;
    font-size: 12.5px;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 2px 5px rgba(15, 30, 54, 0.15);
    transition: background 0.15s ease;
}

.print-btn:hover {
    background: var(--navy-700);
}

/* Main Invoice Card (Fixed Max 800px) */
.invoice {
    width: 100%;
    max-width: 800px;
    margin: 0 auto;
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 8px;
    box-shadow: 0 8px 24px rgba(16, 36, 64, 0.06);
    overflow: hidden;
}

/* Top Header */
.top-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: var(--navy-900);
    padding: 10px 16px;
    border-radius: 8px 8px 0px 0px;
    color: #fff;
}

.logo img {
    max-width: 95px;
    height: auto;
    display: block;
}

.invoice-title {
    font-size: 20px;
    font-weight: 700;
    color: #ffffff;
    letter-spacing: 0.6px;
    margin-bottom: 0px;
}

/* Main Header */
.header {
    display: grid;
    grid-template-columns: minmax(0, 1.45fr) 85px minmax(0, 1.05fr);
    align-items: center;
    padding: 14px 16px;
    border-bottom: 2px solid var(--border-light);
    gap: 12px;
}

/* Left: Company Details */
.company-details {
    min-width: 0;
}

.company-name {
    font-size: 14px;
    font-weight: 700;
    color: var(--navy-900);
    margin-bottom: 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.company-name .trading-name {
    font-weight: 400;
    color: var(--text-muted);
    font-size: 12.5px;
}

.company-info-block {
    font-size: 11px;
    line-height: 1.5;
    color: var(--text-muted);
}

.company-info-block p {
    margin-bottom: 2px;
}

.company-info-block p:last-child {
    margin-bottom: 0;
}

.company-info-block strong {
    color: var(--navy-900);
    margin-right: 3px;
}

.company-info-block a {
    color: #1a5ea9;
    text-decoration: none;
}

.company-info-block a:hover {
    text-decoration: underline;
}

/* Center: Scaled PAID Stamp */
.paid-wrap {
    display: flex;
    justify-content: center;
    align-items: center;
}

.paid-stamp {
    width: 74px;
    height: 74px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border: 2.5px double var(--success);
    outline: 1.5px dashed var(--success);
    outline-offset: -4px;
    border-radius: 50%;
    color: var(--success);
    transform: rotate(-9deg);
    opacity: 0.92;
    user-select: none;
    flex-shrink: 0;
}

.paid-stamp .stamp-text {
    font-size: 6px;
    font-weight: 800;
    letter-spacing: 0.6px;
}

.paid-stamp strong {
    font-size: 16px;
    font-weight: 900;
    letter-spacing: 1.2px;
    line-height: 1.1;
    border-top: 1px solid var(--success);
    border-bottom: 1px solid var(--success);
    padding: 1px 3px;
    margin: 1px 0;
}

/* Right: Invoice Meta */
.header-right {
    text-align: right;
    min-width: 0;
}

.invoice-meta-list {
    display: flex;
    flex-direction: column;
    gap: 3px;
    font-size: 11.5px;
}

.meta-item {
    display: flex;
    justify-content: flex-end;
    gap: 8px;
    white-space: nowrap;
}

.meta-label {
    color: var(--text-muted);
    font-weight: 600;
}

.meta-value {
    color: var(--navy-900);
    font-weight: 700;
    min-width: 80px;
    text-align: right;
}

/* ========================================================
   LOWER SECTION & TABLES
======================================================== */
.invoice-body {
    padding: 14px 16px 20px 16px;
}

/* Metadata Row */
.metadata-table-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 0px;
    gap: 12px;
}

.member-details-left {
    font-size: 12.5px;
    line-height: 1.5;
    color: var(--navy-900);
    padding-bottom: 20px;
    white-space: nowrap;
}

.member-details-left strong {
    font-weight: 700;
}

/* Fixed Metadata Table Borders (Left & Right now fully visible) */
.metadata {
    width: 62%;
    border-collapse: collapse;
    table-layout: fixed;
    text-align: center;
    border-top: 1px solid var(--border);
    border-left: 1px solid var(--border);
    border-right: 1px solid var(--border);
    border-bottom: none;
}

.metadata th {
    background: var(--navy-800);
    color: #ffffff;
    font-size: 10.5px;
    font-weight: 600;
    text-transform: uppercase;
    padding: 6px 4px;
    border: 1px solid var(--navy-700);
    border-top: 1px solid var(--navy-800);
}

.metadata td {
    padding: 6px 4px;
    font-size: 11.5px;
    background: #fafbfc;
    border: 1px solid var(--border);
    border-bottom: none;
}

/* Services Table */
.services {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
}

.services col:nth-child(1) { width: 12%; }
.services col:nth-child(2) { width: 11%; }
.services col:nth-child(3) { width: 37%; }
.services col:nth-child(4) { width: 8%; }
.services col:nth-child(5) { width: 10%; }
.services col:nth-child(6) { width: 10%; }
.services col:nth-child(7) { width: 12%; }

.services th {
    background: var(--navy-800);
    color: #ffffff;
    font-size: 10.5px;
    font-weight: 600;
    padding: 8px 6px;
    border: 1px solid var(--navy-700);
    text-align: center;
}

.services td {
    padding: 12px 8px;
    border: 1px solid var(--border);
    vertical-align: top;
    font-size: 12px;
}

.services tbody tr {
    background: #ffffff;
}

.text-center {
    text-align: center;
}

.money {
    display: flex;
    justify-content: space-between;
    font-variant-numeric: tabular-nums;
    white-space: nowrap;
}

/* TFOOT Attached Totals */
.services tfoot td {
    padding: 0;
    font-size: 12px;
    background: #ffffff;
}

.services tfoot .footer-left-cell {
    border: none !important;
    background: transparent !important;
    vertical-align: top;
    padding: 14px 14px 0 0;
}

.footer-bottom-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
}

.notes-card {
    border: 1px dashed #22c55e;
    border-radius: 4px;
    padding: 8px 12px;
    font-size: 11px;
    color: #15803d;
    line-height: 1.5;
    background: #ffffff;
    flex-grow: 1;
    max-width: 270px;
}

.notes-title {
    font-weight: 800;
    font-size: 11.5px;
    color: #15803d;
    margin-bottom: 2px;
}

.payment-info {
    font-size: 12px;
    font-weight: 700;
    color: #dc2626;
    white-space: nowrap;
}

.total-label {
    padding: 8px 10px !important;
    border: 1px solid var(--border);
    font-weight: 700;
    color: var(--navy-900);
    text-align: center;
}

.total-val {
    padding: 8px 10px !important;
    border: 1px solid var(--border);
    color: var(--text-main);
}

.balance-row td.balance-label {
    border: 2px solid var(--navy-900) !important;
    border-right: 1px solid var(--navy-900) !important;
    font-size: 14.5px;
    font-weight: 800;
    color: var(--navy-900);
    padding: 9px 12px !important;
    text-align: left;
    background: #fafbfc;
}

.balance-row td.balance-val {
    border: 2px solid var(--navy-900) !important;
    border-left: 1px solid var(--navy-900) !important;
    font-size: 14.5px;
    font-weight: 800;
    color: var(--navy-900);
    padding: 9px 10px !important;
    background: #fafbfc;
}

/* ========================================================
   PRINT STYLES (Fixed Main Invoice Border & Table Borders)
======================================================== */
@page {
    size: A4 landscape;
    margin: 6mm;
}

@media print {
    body {
        padding: 0 !important;
        background: #fff !important;
    }

    .toolbar {
        display: none !important;
    }

    /* Fixed: Ab print me poore invoice ka outer border aayega */
    .invoice {
        border: 1px solid var(--border) !important;
        box-shadow: none !important;
        padding: 0 !important;
        max-width: 100% !important;
    }

    .top-header, .header, .services {
        break-inside: avoid;
        page-break-inside: avoid;
    }
}
</style>
</head>

<body>

<div class="toolbar">
    <button class="print-btn" onclick="window.print()">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M6 9V2h12v7M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><path d="M6 14h12v8H6z"/></svg>
        Print Invoice
    </button>
</div>

<main class="invoice">

    <!-- Top Header -->
    <div class="top-header">
        <div class="logo">
            <img src="https://staging.e4u.host.powerwebhosting.com.au/assets/images/escorts4u-logo.png" alt="E4U Logo">
        </div>
        <h2 class="invoice-title">TAX INVOICE</h2>
    </div>

    <!-- Main Header -->
    <header class="header">
        <div class="company-details">
            <h1 class="company-name">Blackbox Tech Pty Ltd <span class="trading-name">t/as E4U</span></h1>
            <div class="company-info-block">
                <p><strong>B:</strong> 168 Guildford Road Maylands WA 6051</p>
                <p><strong>P:</strong> GPO Box T1756 Perth WA 6845</p>
                <p>
                    <strong>T:</strong> 1300 700 444 &nbsp;|&nbsp; 
                    <strong>E:</strong> <a href="mailto:admin@e4u.com.au">admin@e4u.com.au</a> &nbsp;|&nbsp; 
                    <strong>W:</strong> <a href="https://www.e4u.com.au" target="_blank">e4u.com.au</a>
                </p>
            </div>
        </div>

        <div class="paid-wrap">
            <div class="paid-stamp">
                <span class="stamp-text">THANK YOU</span>
                <strong>PAID</strong>
                <span class="stamp-text">THANK YOU</span>
            </div>
        </div>

        <div class="header-right">
            <div class="invoice-meta-list">
                <div class="meta-item">
                    <span class="meta-label">Invoice Date:</span>
                    <span class="meta-value">29-10-2026</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Invoice No:</span>
                    <span class="meta-value">0000001</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">ABN:</span>
                    <span class="meta-value">88 664 919 975</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Lower Section -->
    <div class="invoice-body">
        
        <!-- Metadata Row with Fixed Visible Borders -->
        <div class="metadata-table-wrapper">
            <div class="member-details-left">
                <div><strong>Member ID:</strong> E60568</div>
                <div><strong>Location:</strong> WA</div>
            </div>

            <table class="metadata">
                <thead>
                    <tr>
                        <th>Completed By</th>
                        <th>Currency</th>
                        <th>Home State</th>
                        <th>Member ID</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>[User]</td>
                        <td>[Currency]</td>
                        <td>[Home State]</td>
                        <td>[Member ID]</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Services Table with Attached Totals in TFOOT -->
        <table class="services">
            <colgroup>
                <col><col><col><col><col><col><col>
            </colgroup>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Service Type</th>
                    <th>Service Description</th>
                    <th>Qty<sup>(1)</sup></th>
                    <th>Rate</th>
                    <th>GST</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">28-06-2026</td>
                    <td class="text-center">Listing</td>
                    <td>
                        <strong>Platinum profile</strong> listed in [Location]<br>
                        <span style="color: var(--text-muted);">([Profile name])</span>
                    </td>
                    <td class="text-center">10</td>
                    <td>
                        <div class="money"><span>$</span><span>10.00</span></div>
                    </td>
                    <td>
                        <div class="money"><span>$</span><span>100.00</span></div>
                    </td>
                    <td>
                        <div class="money"><span>$</span><span>1,000.00</span></div>
                    </td>
                </tr>
            </tbody>

            <!-- Attached Totals & Notes -->
            <tfoot>
                <!-- Row 1: Subtotal -->
                <tr>
                    <td colspan="4" rowspan="3" class="footer-left-cell">
                        <div class="footer-bottom-content">
                            <div class="notes-card">
                                <div class="notes-title">Notes:</div>
                                <p>1. &nbsp;Quantity can be either days or units.</p>
                                <p>2. &nbsp;Card debited with your authority.</p>
                            </div>

                            <div class="payment-info">
                                Card<sup>(2)</sup>: xxxx [numbers]
                            </div>
                        </div>
                    </td>
                    <td colspan="2" class="total-label">Subtotal:</td>
                    <td class="total-val">
                        <div class="money"><span>$</span><span>1,000.00</span></div>
                    </td>
                </tr>

                <!-- Row 2: GST -->
                <tr>
                    <td colspan="2" class="total-label">GST:</td>
                    <td class="total-val">
                        <div class="money"><span>$</span><span>100.00</span></div>
                    </td>
                </tr>

                <!-- Row 3: Balance Due with Solid Outline -->
                <tr class="balance-row">
                    <td colspan="2" class="balance-label">Balance Due:</td>
                    <td class="balance-val">
                        <div class="money"><span>$</span><span>1,100.00</span></div>
                    </td>
                </tr>
            </tfoot>
        </table>

    </div>

</main>

</body>
</html>