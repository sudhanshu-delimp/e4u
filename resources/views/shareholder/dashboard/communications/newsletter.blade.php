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
            <h1 class="h1">Newsletter</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>                    
                    <ol>
                        <li>All of the Company’s Newsletters are published here.</li>
                        <li>Click the Newsletter you are looking for and it will download as a .pdf file for you to view.</li>
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
                                <th>Newsletter</th>
                                <th>Edition</th>
                                <th>Published</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- start --}}
                            <tr class="">
                                <td>
                                    <div class="guide-document">
                                        <i class="fa fa-file"></i>
                                        <div>
                                            <a href="{{ asset('assets/dashboard/forms-pdf/newsletter/Newsletter-Edition-13-(2025 - 10).pdf') }}" target="_blank"
                                                class="custom_links_design" download >Edition 13 (06-10-2025)</a>
                                            <p class="mb-0">Developers & Website - update.</p>
                                        </div>
                                    </div>
                                </td>
                                <td>13</td>
                                <td>6th October 2025</td>

                            </tr>
                            {{-- end --}}

                             {{-- start --}}
                            <tr class="">
                                <td>
                                    <div class="guide-document">
                                        <i class="fa fa-file"></i>
                                        <div>
                                            <a href="{{ asset('assets/dashboard/forms-pdf/newsletter/Newsletter-Edition-12-(2025 - 09).pdf') }}" target="_blank"
                                                class="custom_links_design" download >Edition 12 (01-09-2025)</a>
                                            <p class="mb-0">Social me.</p>
                                        </div>
                                    </div>
                                </td>
                                <td>12</td>
                                <td>1st September 2025</td>

                            </tr>
                            {{-- end --}}
                             {{-- start --}}
                            <tr class="">
                                <td>
                                    <div class="guide-document">
                                        <i class="fa fa-file"></i>
                                        <div>
                                            <a href="{{ asset('assets/dashboard/forms-pdf/newsletter/Newsletter-Edition-11-(2025 - 08).pdf') }}" target="_blank"
                                                class="custom_links_design" download >Edition 11 (20-08-2025)</a>
                                            <p class="mb-0">Pre-launch viewing.</p>
                                        </div>
                                    </div>
                                </td>
                                <td>11</td>
                                <td>20th August 2025
</td>

                            </tr>
                            {{-- end --}}

                             {{-- start --}}
                            <tr class="">
                                <td>
                                    <div class="guide-document">
                                        <i class="fa fa-file"></i>
                                        <div>
                                            <a href="{{ asset('assets/dashboard/forms-pdf/newsletter/Newsletter-Edition-10-(2025 - 06).pdf') }}" target="_blank"
                                                class="custom_links_design" download >Edition 10 ()</a>
                                            <p class="mb-0">Escort database.</p>
                                        </div>
                                    </div>
                                </td>
                                <td>10</td>
                                <td>30th June 2025</td>

                            </tr>
                            {{-- end --}}

                             {{-- start --}}
                            <tr class="">
                                <td>
                                    <div class="guide-document">
                                        <i class="fa fa-file"></i>
                                        <div>
                                            <a href="{{ asset('assets/dashboard/forms-pdf/newsletter/Newsletter-Edition-9-(2025 - 05).pdf') }}" target="_blank"
                                                class="custom_links_design" download >Edition 09 (01-05-2025)</a>
                                            <p class="mb-0">Developers - update.</p>
                                        </div>
                                    </div>
                                </td>
                                <td>9</td>
                                <td>1st May 2025</td>

                            </tr>
                            {{-- end --}}

                             {{-- start --}}
                            <tr class="">
                                <td>
                                    <div class="guide-document">
                                        <i class="fa fa-file"></i>
                                        <div>
                                            <a href="{{ asset('assets/dashboard/forms-pdf/newsletter/Newsletter-Edition 8-(2025 - 04).pdf') }}" target="_blank"
                                                class="custom_links_design" download >Edition 08 (11-04-2025)</a>
                                            <p class="mb-0">Message from the Board.</p>
                                        </div>
                                    </div>
                                </td>
                                <td>8</td>
                                <td>11th April 2025</td>

                            </tr>
                            {{-- end --}}

                             {{-- start --}}
                            <tr class="">
                                <td>
                                    <div class="guide-document">
                                        <i class="fa fa-file"></i>
                                        <div>
                                            <a href="{{ asset('assets/dashboard/forms-pdf/newsletter/Newsletter-Edition-7-(2025 - 03).pdf') }}" target="_blank"
                                                class="custom_links_design" download >Edition 07 (27-03-2025)</a>
                                            <p class="mb-0">Appointment of additional developers.</p>
                                        </div>
                                    </div>
                                </td>
                                <td>7</td>
                                <td>27th March 2025</td>

                            </tr>
                            {{-- end --}}

                             {{-- start --}}
                            <tr class="">
                                <td>
                                    <div class="guide-document">
                                        <i class="fa fa-file"></i>
                                        <div>
                                            <a href="{{ asset('assets/dashboard/forms-pdf/newsletter/Newsletter-Edition-6-(2025 - 03).pdf') }}" target="_blank"
                                                class="custom_links_design" download >Edition 06 (06-03-2025)</a>
                                            <p class="mb-0">Capital raising.</p>
                                        </div>
                                    </div>
                                </td>
                                <td>6</td>
                                <td>6th March 2025</td>

                            </tr>
                            {{-- end --}}

                             {{-- start --}}
                            <tr class="">
                                <td>
                                    <div class="guide-document">
                                        <i class="fa fa-file"></i>
                                        <div>
                                            <a href="{{ asset('assets/dashboard/forms-pdf/newsletter/Newsletter-Edition-5-(2025 - 02).pdf') }}" target="_blank"
                                                class="custom_links_design" download >Edition 05 (06-02-2025)</a>
                                            <p class="mb-0">NUM Website launch.</p>
                                        </div>
                                    </div>
                                </td>
                                <td>5</td>
                                <td>6th February 2025</td>

                            </tr>
                            {{-- end --}}

                             {{-- start --}}
                            <tr class="">
                                <td>
                                    <div class="guide-document">
                                        <i class="fa fa-file"></i>
                                        <div>
                                            <a href="{{ asset('assets/dashboard/forms-pdf/newsletter/Newsletter-Edition-4-(2025 - 01).pdf') }}" target="_blank"
                                                class="custom_links_design" download >Edition 04 (17-01-2025)</a>
                                            <p class="mb-0">NUM Website launch.</p>
                                        </div>
                                    </div>
                                </td>
                                <td>4</td>
                                <td>17th January 2025</td>

                            </tr>
                            {{-- end --}}

                             {{-- start --}}
                            <tr class="">
                                <td>
                                    <div class="guide-document">
                                        <i class="fa fa-file"></i>
                                        <div>
                                            <a href="{{ asset('assets/dashboard/forms-pdf/newsletter/Newsletter-Edition-3-(2024 - 12).pdf') }}" target="_blank"
                                                class="custom_links_design" download >Edition 03 (20-12-2024)</a>
                                            <p class="mb-0">NUM generates enquiries.</p>
                                        </div>
                                    </div>
                                </td>
                                <td>3</td>
                                <td>20th December 2024</td>

                            </tr>
                            {{-- end --}}

                             {{-- start --}}
                            <tr class="">
                                <td>
                                    <div class="guide-document">
                                        <i class="fa fa-file"></i>
                                        <div>
                                            <a href="{{ asset('assets/dashboard/forms-pdf/newsletter/Newsletter-Edition-2-(2024 - 11).pdf') }}" target="_blank"
                                                class="custom_links_design" download >Edition 02 (29-11-2024)</a>
                                            <p class="mb-0">Bookkeeper engaged.</p>
                                        </div>
                                    </div>
                                </td>
                                <td>2</td>
                                <td>29th November 2024</td>

                            </tr>
                            {{-- end --}}

                             {{-- start --}}
                            <tr class="">
                                <td>
                                    <div class="guide-document">
                                        <i class="fa fa-file"></i>
                                        <div>
                                            <a href="{{ asset('assets/dashboard/forms-pdf/newsletter/Newsletter-Edition-1-(2024 - 10).pdf') }}" target="_blank"
                                                class="custom_links_design" download >Edition 01 (31-10-2024)</a>
                                            <p class="mb-0">Affiliated websites launch.</p>
                                        </div>
                                    </div>
                                </td>
                                <td>1</td>
                                <td>31st October 2024</td>

                            </tr>
                            {{-- end --}}

                             
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
