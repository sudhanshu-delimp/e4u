  <table class="table table-bordered reconciliation_table">
      <thead class="table-bg">
          <tr>
              <th>Product ID</th>
              <th>Advertiser</th>
              <th class="text-center">Territory</th>
              <th class="text-center">Delivery</th>
              <th>Retail</th>
              <th>Company</th>
              <th>Supplier</th>
          </tr>
      </thead>
      <tbody>
          {{-- <tr>
              <td>CM01</td>
              <td>E60125</td>
              <td class="text-center">WA</td>
              <td class="text-center">Door</td>
              <td>
                  <div class="num_value">$<span>50.00</div>
              </td>
              <td>
                  <div class="num_value">$<span>10.00</div>
              </td>
              <td>
                  <div class="num_value">$<span>40.00</div>
              </td>
          </tr> --}}
          @forelse ($items->groupBy(fn($item) => $item->product->code) as $productCode => $productItems)

              {{-- Product Items --}}
              @foreach ($productItems as $item)
                  <tr>
                      <td>{{ $item->product->code }}</td>
                      <td>{{ $item->productOrder->user->member_id }}</td>
                      <td class="text-center">
                          {{ $item->productOrder->user->state->name }}
                      </td>
                      <td class="text-center">
                          {{ $item->productOrder->delivery_type }}
                      </td>
                      <td>
                          <div class="num_value">
                              $<span>{{ number_format($item->price, 2) }}</span>
                          </div>
                      </td>
                      <td>
                          <div class="num_value">
                              $<span>{{ number_format($item->retail_price, 2) }}</span>
                          </div>
                      </td>
                      <td>
                          <div class="num_value">
                              $<span>
                                  {{ number_format($item->price - $item->retail_price, 2) }}
                              </span>
                          </div>
                      </td>
                  </tr>
              @endforeach

              {{-- Product Subtotal --}}
              <tr>
                  <td colspan="4" class="text-right">
                      <strong> Subtotal:</strong>
                  </td>

                  <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                      <div class="num_value">
                          $<span>{{ number_format($productItems->sum('price'), 2) }}</span>
                      </div>
                  </td>

                  <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                      <div class="num_value">
                          $<span>{{ number_format($productItems->sum('retail_price'), 2) }}</span>
                      </div>
                  </td>

                  <td style="border-top: 2px solid #444; font-weight:bold; text-align:left;">
                      <div class="num_value">
                          $<span>
                              {{ number_format($productItems->sum('price') - $productItems->sum('retail_price'), 2) }}
                          </span>
                      </div>
                  </td>
              </tr>

          @empty
              <tr>
                  <td colspan="7" class="text-center">
                      Not found
                  </td>
              </tr>
          @endforelse



      </tbody>

      <tfoot>
          <!-- ========= Total ========= -->
          <tr>
              <td class="mt-5" colspan="7"></td>
          </tr>

          @php
              $totalPrice = $items->sum('price');
              $totalRetailPrice = $items->sum('retail_price');
              $totalProfit = $totalPrice - $totalRetailPrice;
          @endphp

          <tr>
              <td colspan="4" class="text-right">
                  <strong>Total:</strong>
              </td>

              <td
                  style="border-top: 2px solid #444; border-bottom: 6px double #444; font-weight:bold; text-align:left;">
                  <div class="num_value">
                      $<span>{{ number_format($totalPrice, 2) }}</span>
                  </div>
              </td>

              <td
                  style="border-top: 2px solid #444; border-bottom: 6px double #444; font-weight:bold; text-align:left;">
                  <div class="num_value">
                      $<span>{{ number_format($totalRetailPrice, 2) }}</span>
                  </div>
              </td>

              <td
                  style="border-top: 2px solid #444; border-bottom: 6px double #444; font-weight:bold; text-align:left;">
                  <div class="num_value">
                      $<span>{{ number_format($totalProfit, 2) }}</span>
                  </div>
              </td>
          </tr><br>
      </tfoot>
  </table>

  <input type="hidden" id="report_id" value="{{$report_id}}">
