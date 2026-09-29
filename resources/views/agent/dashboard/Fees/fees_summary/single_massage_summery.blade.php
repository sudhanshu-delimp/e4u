<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="message-report"><img src="{{ asset('assets/dashboard/img/statement-report.png') }}"
                class="custompopicon">
            Massage
            Centre Report: Lin’s Massage (Member ID: M612465)
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                    class="img-fluid img_resize_in_smscreen"></span>
        </button>
    </div>
    <div class="modal-body">
        <div class="col-md-12">
            <div class="row mb-2">
                <div class="col-sm-5 pl-0">
                    <div class="card border-0">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead class="bg-first">
                                    <tr>
                                        <th rowspan="2"><b>Financial Year
                                            </b>
                                        </th>
                                        <th colspan="4" style="text-align: center;"><b>Spend</b></th>
                                    </tr>
                                    <tr>
                                        <th><b>Value</b></th>
                                        <th><b>Listings</b></th>
                                        <th><b>Total Days</b></th>
                                    </tr>
                                </thead>
                                <tbody id="collapse-accordion">

                                    <tr>
                                    <tr data-toggle="toggle-row" data-target=".group-01"
                                        data-parent="#collapse-accordion" style="cursor: pointer;">
                                        <td>
                                            <div
                                                class="d-flex align-items-center justify-content-between font-weight-bold">
                                                <span>2025 / 2026</span> <i class="fa fa-chevron-down"></i>
                                            </div>
                                        </td>
                                        <td class="text-right">$ 600.00</td>
                                        <td class="text-right">6</td>
                                        <td class="text-right">120</td>
                                    </tr>
                                    <tr class="collapse-row group-01">
                                        <td><b>WA</b></td>
                                        <td class="text-right">$ 600.00</td>
                                        <td class="text-right">6</td>
                                        <td class="text-right">120</td>
                                    </tr>
                                    <tr class="collapse-row group-01">
                                        <td class="text-right"><b>Totals</b></td>
                                        <td class="text-right total_row"><b>$ 600.00</b></td>
                                        <td class="text-right total_row"><b>6</b></td>
                                        <td class="text-right total_row"><b>120</b></td>
                                    </tr>

                                    <tr data-toggle="toggle-row" data-target=".group-02"
                                        data-parent="#collapse-accordion" style="cursor: pointer;">
                                        <td>
                                            <div
                                                class="d-flex align-items-center justify-content-between font-weight-bold">
                                                <span>2024 / 2025</span> <i class="fa fa-chevron-down"></i>
                                            </div>
                                        </td>
                                        <td class="text-right">$ 600.00</td>
                                        <td class="text-right">6</td>
                                        <td class="text-right">120</td>
                                    </tr>

                                    <tr class="collapse-row group-02">
                                        <td><b>WA</b></td>
                                        <td class="text-right">$ 600.00</td>
                                        <td class="text-right">6</td>
                                        <td class="text-right">120</td>
                                    </tr>
                                    <tr class="collapse-row group-02">
                                        <td class="text-right"><b>Totals</b></td>
                                        <td class="text-right total_row"><b>$ 600.00</b></td>
                                        <td class="text-right total_row"><b>6</b></td>
                                        <td class="text-right total_row"><b>120</b></td>
                                    </tr>
                                    <tr data-toggle="toggle-row" data-target=".group-03"
                                        data-parent="#collapse-accordion" style="cursor: pointer;">
                                        <td>
                                            <div
                                                class="d-flex align-items-center justify-content-between font-weight-bold">
                                                <span>2023 / 2024</span> <i class="fa fa-chevron-down"></i>
                                            </div>
                                        </td>
                                        <td class="text-right">$ 0.00</td>
                                        <td class="text-right">0</td>
                                        <td class="text-right">0</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right"><b>Totals</b></td>
                                        <td class="text-right total_row"><b>$ 1,200.00</b></td>
                                        <td class="text-right total_row"><b>12</b></td>
                                        <td class="text-right total_row"><b>240</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7 pl-0 pr-0">
                    <div class="card border-0">
                        <div class="table-responsive-xl">
                            <table class="table table-bordered mb-0">
                                <thead class="bg-first">
                                    <tr>
                                        <th colspan="18" style="text-align: center;"><b>Statistics</b>
                                            <span style=" float: right;"><b>Left = Listings Right =
                                                    Days</b></span>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="2"><b>Masseur 1</b></th>
                                        <th colspan="2"><b>Masseur 2</b></th>
                                        <th colspan="2"><b>Masseur 3</b></th>
                                        <th colspan="2"><b>Masseur 4</b></th>
                                        <th colspan="2"><b>Masseur 5</b></th>
                                        <th colspan="2"><b>Masseur 6</b></th>
                                        <th colspan="2"><b>Masseur 7</b></th>
                                        <th colspan="2"><b>Masseur 8</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- row 01 --}}
                                    <tr>
                                        <td>10</td>
                                        <td>123</td>
                                        <td>8</td>
                                        <td>89</td>
                                        <td>8</td>
                                        <td>50</td>
                                        <td>1</td>
                                        <td>23</td>
                                        <td>7</td>
                                        <td>44</td>
                                        <td>9</td>
                                        <td>27</td>
                                        <td>14</td>
                                        <td>14</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>


                                    <tr class="collapse-row group-01">
                                        <td>10</td>
                                        <td>123</td>
                                        <td>8</td>
                                        <td>89</td>
                                        <td>8</td>
                                        <td>50</td>
                                        <td>1</td>
                                        <td>23</td>
                                        <td>7</td>
                                        <td>44</td>
                                        <td>9</td>
                                        <td>27</td>
                                        <td>14</td>
                                        <td>14</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr class="collapse-row group-01">
                                        <td class="total_row">10</td>
                                        <td class="total_row">123</td>
                                        <td class="total_row">8</td>
                                        <td class="total_row">89</td>
                                        <td class="total_row">8</td>
                                        <td class="total_row">50</td>
                                        <td class="total_row">1</td>
                                        <td class="total_row">23</td>
                                        <td class="total_row">7</td>
                                        <td class="total_row">44</td>
                                        <td class="total_row">9</td>
                                        <td class="total_row">27</td>
                                        <td class="total_row">14</td>
                                        <td class="total_row">14</td>
                                        <td class="total_row">0</td>
                                        <td class="total_row">0</td>
                                    </tr>
                                    {{-- end --}} {{-- row02 --}}
                                    <tr>
                                        <td>10</td>
                                        <td>123</td>
                                        <td>8</td>
                                        <td>89</td>
                                        <td>8</td>
                                        <td>50</td>
                                        <td>1</td>
                                        <td>23</td>
                                        <td>7</td>
                                        <td>44</td>
                                        <td>9</td>
                                        <td>27</td>
                                        <td>14</td>
                                        <td>14</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr class="collapse-row group-02">
                                        <td>10</td>
                                        <td>123</td>
                                        <td>8</td>
                                        <td>89</td>
                                        <td>8</td>
                                        <td>50</td>
                                        <td>1</td>
                                        <td>23</td>
                                        <td>7</td>
                                        <td>44</td>
                                        <td>9</td>
                                        <td>27</td>
                                        <td>14</td>
                                        <td>14</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                    <tr class="collapse-row group-02">
                                        <td class="total_row">10</td>
                                        <td class="total_row">123</td>
                                        <td class="total_row">8</td>
                                        <td class="total_row">89</td>
                                        <td class="total_row">8</td>
                                        <td class="total_row">50</td>
                                        <td class="total_row">1</td>
                                        <td class="total_row">23</td>
                                        <td class="total_row">7</td>
                                        <td class="total_row">44</td>
                                        <td class="total_row">9</td>
                                        <td class="total_row">27</td>
                                        <td class="total_row">14</td>
                                        <td class="total_row">14</td>
                                        <td class="total_row">0</td>
                                        <td class="total_row">0</td>
                                    </tr>
                                    {{-- end --}} {{-- row03 --}}
                                    <tr>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    {{-- 3nd --}}
                                    <tr>
                                        <td class="total_row"><b>20</b></td>
                                        <td class="total_row"><b>246</b></td>
                                        <td class="total_row"><b>16</b></td>
                                        <td class="total_row"><b>178</b></td>
                                        <td class="total_row"><b>16</b></td>
                                        <td class="total_row">100</td>
                                        <td class="total_row">2</td>
                                        <td class="total_row">46</td>
                                        <td class="total_row">14</td>
                                        <td class="total_row">88</td>
                                        <td class="total_row">18</td>
                                        <td class="total_row">54</td>
                                        <td class="total_row">28</td>
                                        <td class="total_row">28</td>
                                        <td class="total_row">0</td>
                                        <td class="total_row">0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
