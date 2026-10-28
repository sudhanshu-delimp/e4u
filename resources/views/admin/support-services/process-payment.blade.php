@extends('layouts.admin')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <div class="row">
        <div class="custom-heading-wrapper col-md-12">
            <h1 class="h1">Process Payment</h1>
            <span class="helpNoteLink font-weight-bold"
                data-toggle="collapse"
                data-target="#notes"
                aria-expanded="true">
                Help?
            </span>
        </div>

        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes">
                <div class="card-body">
                    <h3 class="NotesHeader"><b>Notes:</b></h3>
                    <ol>
                        <li>Enter the Advertiser's Member ID to locate.</li>
                        <li>The Advertiser's details will appear.  Check you have the correct Member.</li>
                        <li>Select the service/s for billing to the Advertiser.</li>
                        <li>Proceed to Payment.  Enter Advertiser's Card details and process.</li>
                        <li>Advise the Advertiser of the payment outcome (Payment successful) and let the Member know they can view the transaction in:
                            <ol class="level-2">
                                <li>their Transaction Summary page in the Console; and</li>
                                <li>a Tax Invoice has been forwarded to their nominated email address, which can also be viewed in their Transaction Summary.</li>
                            </ol>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="common-card">
        <form id="advertiserForm"
            class="common-form"
            data-api-url="{{ url('/admin/advertisers') }}">

            @csrf

            <div class="row inner-row">

                <div class="col-12">
                    <div class="card-top">
                        <div class="card-icon">
                            <svg width="40" height="40"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                                    stroke="#ff3c5f"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                                    stroke="#ff3c5f"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>

                        <div class="card-heading">
                            <h2>Advertiser Details &amp; Service Selection</h2>
                        </div>
                    </div>
                </div>

                <!-- LEFT COLUMN -->
                <div class="col-lg-6 mb-3">
                    <div class="form-group">
                        <label for="memberId" class="form-label">
                            Member ID
                        </label>

                        <input type="text"
                            id="memberId"
                            class="form-control"
                            placeholder="Enter Member ID"
                            autocomplete="off"
                            required>

                        <small
                            class="cp-hint"
                            aria-live="polite">
                            <i id="lookupStatus">Enter Member ID to find advertiser.</i>
                        </small>
                    </div>

                    <div id="serviceSection" hidden>
                        <div class="form-group">
                            <label for="services" class="form-label">
                                Select Services
                            </label>
                            <select id="services" class="form-control select2">
                                @if($services->isNotEmpty())
                                    <option value="">Choose a service...</option>
                                    @foreach ($services as $category => $items)
                                        <optgroup label="{{ $category }}">
                                        @foreach ($items as $service)
                                            <option value="{{ $service->name }}" data-price="{{ $service->amount }}">{{ $service->name }}</option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                @else 
                                    <option value="">Sorry, no service found</option>
                                @endif
                            </select>

                            <small class="cp-hint">
                                <i>The selected service will be added to the list automatically.</i>
                            </small>
                        </div>

                        <div class="selected-service-wrap">
                            <strong>Selected Services</strong>

                            <div id="serviceChips" class="service-chips">
                                <span class="empty-services">
                                    No services selected yet.
                                </span>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- RIGHT COLUMN -->
                <div class="col-lg-6 mb-3">
                    <!-- Empty / Not Found State -->
                    <div id="noDetails" class="empty-state">

                        <div class="empty-state-icon">
                            <svg viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.7"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                aria-hidden="true">

                                <circle cx="11" cy="11" r="7.5"></circle>
                                <path d="m16.5 16.5 4 4"></path>
                                <path d="M8.5 9.5h5M8.5 12.5h3"></path>
                            </svg>
                        </div>

                        <h3 id="emptyStateTitle">No Advertiser Selected</h3>

                        <p id="emptyStateMessage">
                            Enter a valid Member ID on the left to view advertiser
                            details, select services and proceed with payment.
                        </p>

                        <div class="empty-state-hint">
                            <span class="empty-state-dot"></span>
                            Waiting for Member ID
                        </div>

                    </div>

                    <div id="rightColumn" hidden>
                        <div id="advertiserDetails" class="advertiser-details">

                            <div class="card-top">
                                <div class="card-heading details-title">
                                    <span class="card-icon">
                                        <svg viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                                                stroke="#ff3c5f"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                                                stroke="#ff3c5f"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </span>

                                    <h2>Advertiser Information</h2>
                                </div>
                            </div>

                            {{-- Member ID --}}
                            <div class="detail-row">
                                <div class="detail-label">
                                    <span class="card-icon">
                                        <svg viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            aria-hidden="true">
                                            <rect x="4" y="4" width="16" height="16" rx="3" />
                                            <path d="M8 9h8M8 12h5M8 15h6" />
                                        </svg>
                                    </span>
                                    <strong>Member ID</strong>
                                </div>

                                <span class="detail-value" id="detailId">—</span>
                            </div>

                            {{-- Business / Full Name --}}
                            <div class="detail-row">
                                <div class="detail-label">
                                    <span class="card-icon">
                                        <svg viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            aria-hidden="true">
                                            <circle cx="12" cy="8" r="4" />
                                            <path d="M4 21a8 8 0 0 1 16 0" />
                                        </svg>
                                    </span>
                                    <strong>Business / Full Name</strong>
                                </div>

                                <span class="detail-value" id="detailName">—</span>
                            </div>

                            {{-- Email --}}
                            <div class="detail-row">
                                <div class="detail-label">
                                    <span class="card-icon">
                                        <svg viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            aria-hidden="true">
                                            <rect x="3" y="5" width="18" height="14" rx="2" />
                                            <path d="m4 7 8 6 8-6" />
                                        </svg>
                                    </span>
                                    <strong>Email Address</strong>
                                </div>

                                <span class="detail-value" id="detailEmail">—</span>
                            </div>

                            {{-- Business / Mobile Number --}}
                            <div class="detail-row">
                                <div class="detail-label">
                                    <span class="card-icon">
                                        <svg viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            aria-hidden="true">
                                            <path d="M7 3H5a2 2 0 0 0-2 2c0 8.84 7.16 16 16 16a2 2 0 0 0 2-2v-2l-5-2-2 3a14 14 0 0 1-6-6l3-2-2-5H7z" />
                                        </svg>
                                    </span>
                                    <strong>Business / Mobile Number</strong>
                                </div>

                                <span class="detail-value" id="detailPhone">—</span>
                            </div>

                            {{-- Total and Pay button --}}
                            <div class="details-actions">
                                <div class="payable-summary">
                                    <div class="detail-label">
                                    <span class="card-icon">
                                        <svg viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            aria-hidden="true">
                                            <rect x="2" y="5" width="20" height="14" rx="3" />
                                            <path d="M2 10h20" />
                                            <path d="M6 15h4" />
                                        </svg>
                                    </span>
                                     <strong>Total Amount Payable</strong>
                                </div>
                                    <div class="payable-text">
                                       
                                        <strong id="rightTotalAmount">$0</strong>
                                    </div>
                                </div>

                                
                            </div>
                            <div class="text-right mt-4">
                                <button type="button" id="payBtn" class="next-btn">
                                    Pay
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <p id="message"
                        class="message"
                        role="status"
                        aria-live="polite"></p>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script>
    $('.select2').select2();
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('advertiserForm');
        const memberIdInput = document.getElementById('memberId');
        const serviceSection = document.getElementById('serviceSection');
        const servicesInput = document.getElementById('services');
        const rightColumn = document.getElementById('rightColumn');
        const noDetails = document.getElementById('noDetails');
        const emptyStateTitle = document.getElementById('emptyStateTitle');
        const emptyStateMessage = document.getElementById('emptyStateMessage');
        const status = document.getElementById('lookupStatus');
        const message = document.getElementById('message');
        const payBtn = document.getElementById('payBtn');
        const rightTotalAmount = document.getElementById('rightTotalAmount');
        const payableSummary = document.querySelector('.payable-summary');

        let selectedAdvertiser = null;
        let selectedServices = [];
        let selectedServicePrices = {};
        let debounceTimer = null;
        let requestController = null;
        let lookupSequence = 0;

        // function formatMoney(amount) {
        //     return '$' + amount.toLocaleString('en-US');
        // }

        function calculateTotal() {
            return selectedServices.reduce((sum, key) => {
                const option = Array.from(servicesInput.options)
                    .find(item => item.value === key);

                return sum + (option ? Number(option.dataset.price) || 0 : 0);
            }, 0);
        }

       
            function updateTotalAmount() {
                const total = calculateTotal();
                const hasServices = selectedServices.length > 0;

                rightTotalAmount.textContent = formatCurrency(total);

                payableSummary.classList.toggle('show-total', hasServices);

                payBtn.style.display = hasServices ? 'inline-block' : 'none';
            }


        function resetAdvertiser() {
            selectedAdvertiser = null;
            selectedServices = [];
            selectedServicePrices = {};

            serviceSection.hidden = true;
            rightColumn.hidden = true;
            noDetails.hidden = false;

            noDetails.classList.remove('not-found');

            emptyStateTitle.textContent = 'No Advertiser Selected';
            emptyStateMessage.textContent =
                'Enter a valid Member ID on the left to view advertiser details, select services and proceed with payment.';

            payBtn.style.display = 'none';
            servicesInput.value = '';

            renderServices();
        }

       
        function renderServices() {
            const target = document.getElementById('serviceChips');
            target.replaceChildren();

            // Selected services ko dropdown se hide karo
            Array.from(servicesInput.options).forEach(option => {
                if (!option.value) return;

                option.hidden = selectedServices.includes(option.value);
            });

            servicesInput.value = '';

            if (!selectedServices.length) {
                const empty = document.createElement('span');
                empty.className = 'empty-services';
                empty.textContent = 'No services selected yet.';
                target.append(empty);

                updateTotalAmount();
                return;
            }
               console.log(selectedServices); 
            selectedServices.forEach(key => {
                const option = Array.from(servicesInput.options)
                    .find(item => item.value === key);

                if (!option) return;

                const card = document.createElement('div');
                card.className = 'service-chip';

                const name = document.createElement('span');
                name.className = 'service-chip-name';
                name.textContent = option.textContent.split(' — ')[0];

                const price = document.createElement('strong');
                price.className = 'service-chip-price';
                price.textContent = formatCurrency(Number(option.dataset.price) || 0);

                const remove = document.createElement('button');
                remove.type = 'button';
                remove.className = 'service-remove';
                remove.setAttribute('aria-label', 'Remove ' + name.textContent);
                remove.title = 'Remove service';
                remove.textContent = '×';

                remove.addEventListener('click', () => {
                    selectedServices = selectedServices.filter(
                        service => service !== key
                    );
                    delete selectedServicePrices[key];
                    renderServices();
                });

                const info = document.createElement('div');
                info.className = 'service-chip-info';
                info.append(name, price);

                card.append(info, remove);
                target.append(card);
            });
            console.log(selectedServicePrices);
            console.log(memberIdInput.value.trim());
            updateTotalAmount();
        }


        function showAdvertiser(ad) {
            selectedAdvertiser = ad;

            document.getElementById('detailId').textContent =
                ad.member_id ?? ad.id ?? '—';

            document.getElementById('detailName').textContent =
                ad.name ?? '—';

            document.getElementById('detailEmail').textContent =
                ad.email || 'Not available';

            document.getElementById('detailPhone').textContent =
                ad.phone || 'Not available';

            rightColumn.hidden = false;
            noDetails.hidden = true;
            serviceSection.hidden = false;

            status.textContent =
                'Advertiser found. You can select services now.';

            message.textContent = '';
            message.className = 'message';

            renderServices();
        }

        async function lookupAdvertiser(member_id, sequence) {
            status.textContent = 'Searching advertiser…';
            $.ajax({
                url: `{{route('common.get_advertiser')}}`,
                method: 'POST',
                data: {member_id},
                beforeSend: function() {

                },
                success: function(response, textStatus, xhr) {
                    showAdvertiser(response.advertiser);
                },
                error: function(xhr) {
                    let response =  readXHR(xhr);
                    let message = response?.message || 'Something went wrong';
                    resetAdvertiser();
                    if (message.includes('Advertiser not found')) {
                        noDetails.classList.add('not-found');
                        emptyStateTitle.textContent = 'Advertiser Not Found';
                        emptyStateMessage.textContent =
                        'We could not find an advertiser with this Member ID. Please check the ID and try again.';
                    }
                    status.textContent = message;
                    message.className = 'message error';
                    message.textContent = message;
                },
                complete: function () {
                    // Hide loader if this is still the latest request
                    if (sequence !== lookupSequence) return;
                }
            })
        }   

        memberIdInput.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            lookupSequence++;

            if (requestController) {
                requestController.abort();
            }

            resetAdvertiser();

            message.textContent = '';
            message.className = 'message';

            const id = memberIdInput.value.trim();

            if (!id) {
                status.textContent = 'Enter Member ID to find advertiser.';
                return;
            }

            if (id.length < 3) {
                status.textContent = 'Keep typing…';
                return;
            }

            const sequence = lookupSequence;

            debounceTimer = setTimeout(() => {
                lookupAdvertiser(id, sequence);
            }, 450);
        });

        $('#services').on('select2:select', function (e) {
            const selectedOption = e.params.data.element;
            const value = e.params.data.id;
            if (value && selectedAdvertiser && !selectedServices.includes(value)) 
            {
             selectedServices.push(value);
             selectedServicePrices[value] = selectedOption.dataset.price;
            }

            // Reset Select2 selection
            $(this).val(null).trigger('change');

            renderServices();
        });

        payBtn.addEventListener('click', () => {
            if (!selectedAdvertiser) return;

            if (!selectedServices.length) {
                message.className = 'message error';
                message.textContent = 'Please select at least one service.';
                return;
            }

            const total = calculateTotal();

            // Demo only: connect this to your actual payment flow.
            alert(
                'Advertiser: ' + selectedAdvertiser.name +
                '\nSelected services: ' + selectedServices.length +
                '\nTotal payable: ' + formatCurrency(total)
            );
        });

        // Initial state: hide total until a service is selected.
        updateTotalAmount();
    });
</script>
@endpush