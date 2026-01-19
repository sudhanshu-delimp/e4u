@extends('layouts.shareholder')
@section('content')
@section('style')
<style>
    #FormsTable td{
        vertical-align: middle !important;
    }
</style>
@endsection


<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1">Financials</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                    <ol>
                        <li>All of the Company’s financial statements are available here.</li>
                        <li>Click the financial report you are looking for and it will download as a .pdf file for you to
view.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table" id="FormsTable" style="width: 100%">
                        <thead class="table-bg">
                            <tr>
                                <th>Financials</th>
                                <th>Half</th>
                                <th>Financial Year</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- 30-06-2025 --}}
                            <tr class="">
                                <td>
                                    <div class="guide-document">
                                        <i class="fa fa-file"></i>
                                        <div>
                                            <a href="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Balance-Sheet-as-at-30-06-2025.pdf') }}" target="_blank"
                                                class="custom_links_design" download >Balance Sheet (30-06-2025)</a>
                                            <br>    
                                            <a href="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Profit-and-Loss-01-07-2024-to-30-06-2025.pdf') }}" target="_blank"
                                                class="custom_links_design" download >Profit and Loss (30-06-2025)</a>
                                        </div>
                                    </div>
                                </td>
                                <td>2nd</td>
                                <td>2024-2025</td>

                            </tr>
                            {{-- 30-06-2025 --}}

                            {{-- 31-12-2024 --}}
                            <tr class="">
                                <td>
                                    <div class="guide-document">
                                        <i class="fa fa-file"></i>
                                        <div>
                                            <a href="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Balance-Sheet-as-at-31-12-2024.pdf') }}" target="_blank"
                                                class="custom_links_design" download >Balance Sheet (31-12-2024)</a>
                                            <br>    
                                            <a href="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Profit-and-Loss-01-07-2024-to-31-12-2024.pdf') }}" target="_blank"
                                                class="custom_links_design" download >Profit and Loss (31-12-2024)</a>
                                        </div>
                                    </div>
                                </td>
                                <td>1st</td>
                                <td>2024-2025</td>

                            </tr>
                            {{-- 31-12-2024 --}}


                            {{-- 30-12-2024 --}}
                            <tr class="">
                                <td>
                                    <div class="guide-document">
                                        <i class="fa fa-file"></i>
                                        <div>
                                            <a href="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Balance-Sheet-as-at-30-06-2024.pdf') }}" target="_blank"
                                                class="custom_links_design" download >Balance Sheet (30-06-2024)</a>
                                            <br>    
                                            <a href="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Profit-and-Loss-01-07-2023-to-30-06-2024.pdf') }}" target="_blank"
                                                class="custom_links_design" download >Profit and Loss (30-06-2024)</a>
                                        </div>
                                    </div>
                                </td>
                                <td>2nd</td>
                                <td>2023-2024</td>

                            </tr>
                            {{-- 30-12-2024 --}}


                            {{-- 31-12-2023 --}}
                            <tr class="">
                                <td>
                                    <div class="guide-document">
                                        <i class="fa fa-file"></i>
                                        <div>
                                            <a href="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Balance-Sheet-as-at-31-12-2023.pdf') }}" target="_blank"
                                                class="custom_links_design" download >Balance Sheet (31-12-2023)</a>
                                            <br>    
                                            <a href="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Profit-and-Loss-01-07-2023-to-31-12-2023.pdf') }}" target="_blank"
                                                class="custom_links_design" download >Profit and Loss (31-12-2023)</a>
                                        </div>
                                    </div>
                                </td>
                                <td>1st</td>
                                <td>2023-2024</td>

                            </tr>
                            {{-- 31-12-2023 --}}


                            {{-- 30-06-2023 --}}
                            <tr class="">
                                <td>
                                    <div class="guide-document">
                                        <i class="fa fa-file"></i>
                                        <div>
                                            <a href="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Balance-Sheet-as-at-30-06-2023.pdf') }}" target="_blank"
                                                class="custom_links_design" download >Balance Sheet (30-06-2023)</a>
                                            <br>    
                                            <a href="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Profit-and-Loss-01-07-2022-to-30-06-2023.pdf') }}" target="_blank"
                                                class="custom_links_design" download >Profit and Loss (30-06-2023)</a>
                                        </div>
                                    </div>
                                </td>
                                <td>2nd</td>
                                <td>2022-2023</td>

                            </tr>
                            {{-- 30-06-2025 --}}

                            {{-- 31-12-2022 --}}
                            <tr class="">
                                <td>
                                    <div class="guide-document">
                                        <i class="fa fa-file"></i>
                                        <div>
                                            <a href="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Balance-Sheet-as-at-31-12-2022.pdf') }}" target="_blank"
                                                class="custom_links_design" download >Balance Sheet (31-12-2022)</a>
                                            <br>    
                                            <a href="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Profit-and-Loss-01-07-2022-to-31-12-2022.pdf') }}" target="_blank"
                                                class="custom_links_design" download >Profit and Loss (31-12-2022)</a>
                                        </div>
                                    </div>
                                </td>
                                <td>1st</td>
                                <td>2022-2023</td>

                            </tr>
                            {{-- 31-12-2022 --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>

@endsection
@section('script')

<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
    var table = $('#FormsTable').DataTable({
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search by Edition",
            sSearch: 'Search:'
        },
        processing: false,
        serverSide: false,
        lengthChange: true,
        order: [],
        searchable: false,
        searching: true,
        bStateSave: true
    });
</script>
@endsection
