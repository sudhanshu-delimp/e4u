      @php
          $appointedDate = '';
          $agreementDate = '';

          $detail = $supplier->supplier_detail;
          $bankDetail = $supplier->supplier_bank_detail;

          if (!empty($detail->date_appointed)) {
              $appointedDate = showDateWithFormat($detail->date_appointed, 'd-m-Y');
          }

          if (!empty($detail->agreement_date)) {
              $agreementDate = showDateWithFormat($detail->agreement_date, 'd-m-Y');
          }
      @endphp

      <div class="row">
          <div class="col-sm-12">
              <!-- Avatar + Name -->
              <div class="d-flex align-items-center mb-3">
                  <img src="{{ asset('assets/img/default_user.png') }}" alt="Avatar" class="rounded-circle mr-3"
                      width="50" height="50">
                  <h6 class="mb-0">{{ $supplier->business_name }}</h6>
              </div>
              <!-- Merchant Details -->
              <h6 class=" text-blue-primary">Merchant Details</h6>
              <table class="table table-bordered mb-3">

                  <tr>
                      <th width="40%">Merchant ID</th>
                      <td width="60%">{{ $supplier->member_id }}</td>
                  </tr>
                  <tr>
                      <th>Date Appointed</th>
                      <td>{{ $appointedDate }}</td>
                  </tr>
                  <tr>
                      <th>ABN</th>
                      <td>{{ $supplier->abn }}</td>
                  </tr>
                  <tr>
                      <th>Business Address</th>
                      <td>{{ $supplier->business_address }}</td>
                  </tr>
                  <tr>
                      <th>Business Number</th>
                      <td>{{ $supplier->business_number }}</td>
                  </tr>
                  <tr>
                      <th>Point of Contact</th>
                      <td>{{ $detail->point_of_contact }}</td>
                  </tr>
                  <tr>
                      <th>Mobile</th>
                      <td>{{ $supplier->phone }}</td>
                  </tr>
                  <tr>
                      <th>Private Email</th>
                      <td>{{ $supplier->email }}/td>
                  </tr>
                  <tr>
                      <th>Location</th>
                      <td>{{ $supplier->state->name }}</td>
                  </tr>
                  <tr>
                      <th>Concierge Service</th>
                      <td>{{ $detail->concierge_service }}</td>
                  </tr>
              </table>
              <!-- Agreement Details -->
              <h6 class=" text-blue-primary">Agreement Details</h6>
              <table class="table table-bordered mb-3">
                  <tr>
                      <th width="40%">Agreement Date</th>
                      <td width="60%">{{ $agreementDate }}</td>
                  </tr>
                  <tr>
                      <th>Term</th>
                      <td>{{ $detail->term }}</td>
                  </tr>
              </table>
              <!-- Bank Account -->
              <h6 class=" text-blue-primary">Bank Account</h6>
              <table class="table table-bordered mb-3">
                  <tr>
                      <th width="40%">Bank</th>
                      <td width="60%">{{ $bankDetail->bank_name }}</td>
                  </tr>
                  <tr>
                      <th>Account Name</th>
                      <td>{{ $bankDetail->account_name }}</td>
                  </tr>
                  <tr>
                      <th>BSB</th>
                      <td>{{ $bankDetail->bsb }}</td>
                  </tr>
                  <tr>
                      <th>Account Number</th>
                      <td>{{ $bankDetail->account_number }}</td>
                  </tr>
              </table>
          </div>

          <div class="col-lg-12">
              <!-- Footer Buttons -->
              <div class="d-flex justify-content-end my-2">
                  <form action="{{ route('admin.print_supplier') }}" method="post" target="_blank">
                      {{ csrf_field() }}
                      <input name="user_id" type="hidden" id="user_print_id" class="user_print_id"
                          value="{{ $supplier->id }}">
                      <button type="submit" class="print-btn m-0">🖨️ Print Report</button>
                      <button type="button" class="btn-cancel-modal" data-dismiss="modal"
                          aria-label="Close">Close</button>
                  </form>
              </div>
          </div>
      </div>
