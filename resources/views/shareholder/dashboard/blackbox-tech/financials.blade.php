@extends('layouts.shareholder')
@section('content')
@section('style')
<style>
    #FormsTable td{
        vertical-align: middle !important;
    }
    .custom-wrapper {
      background: #fff;
      box-shadow: 0 6px 20px rgba(0,0,0,0.08);
      overflow: hidden;
    }

    .pdf-viewer {
      height: 700px;
      width: 100%;
      border: none;
      background: #0C223D;
    }

    .pdf-area {
      background: #fff;
      min-height: 700px;
    }

    .tab-sidebar {
      background: #fff
      border-left: 1px solid #dee2e6;
      height: 100%;
    }

    .nav-pills .nav-link {
      border-radius: 0;
      padding: 18px 20px;
      font-weight: 600;
      color: #0C223D;
      border-bottom: 1px solid #e9ecef;
      text-align: left;
      transition: all 0.3s ease;
    }

    .nav-pills .nav-link:hover {
      background: #eef4ff;
      color: #0C223D;
    }

    .nav-pills .nav-link.active {
      background: #0C223D;
      color: #fff;
    }

    .pdf-title {
    font-size: 16px;
    font-weight: bold;
    color: #ffffff;
    background: #0c223d;
    padding: 18px 20px;
    }

    @media (max-width: 767px) {
      .pdf-viewer {
        height: 500px;
      }

      .pdf-area {
        min-height: auto;
      }

      .tab-sidebar {
        border-left: none;
        border-top: 1px solid #dee2e6;
      }
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
                        <li>Click the financial report you are looking for and it will download as a .pdf file for you to view.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="custom-wrapper">
    <div class="row no-gutters">

      <!-- Left Side PDF Viewer -->
      <div class="col-md-9">
        <div class="pdf-area">
          <div class="pdf-title" id="pdfTitle"> Balance Sheet (30-06-2025)</div>
          <iframe id="pdfViewer" class="pdf-viewer" src="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Balance-Sheet-as-at-30-06-2025.pdf') }}"></iframe>
        </div>
      </div>

      <!-- Right Side Tabs -->
      <div class="col-md-3">
        <div class="nav flex-column nav-pills tab-sidebar h-100 p-0" id="pdfTabs">

          <a href="javascript:void(0)" class="nav-link active" 
             data-pdf="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Balance-Sheet-as-at-30-06-2025.pdf') }}" 
             data-title=" Balance Sheet (30-06-2025)">
            Balance Sheet (30-06-2025)
          </a>

          <a href="javascript:void(0)" class="nav-link" 
             data-pdf="{{ asset('assets/dashboard/forms-pdf/financials/BBT-Pty-Ltd-Profit-and-Loss-01-07-2024-to-30-06-2025.pdf') }}" 
             data-title="Profit and Loss (30-06-2025)">
             Profit and Loss (30-06-2025)
          </a>

          <a href="javascript:void(0)" class="nav-link" 
             data-pdf="sample3.pdf" 
             data-title="Document 3">
             Document 3
          </a>

          <a href="javascript:void(0)" class="nav-link" 
             data-pdf="sample4.pdf" 
             data-title="Document 4">
             Document 4
          </a>

        </div>
      </div>

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

  $(document).ready(function () {
    $('#pdfTabs .nav-link').click(function () {
      var pdfFile = $(this).data('pdf');
      var pdfTitle = $(this).data('title');

      // Active tab change
      $('#pdfTabs .nav-link').removeClass('active');
      $(this).addClass('active');

      // Change PDF and title
      $('#pdfViewer').attr('src', pdfFile);
      $('#pdfTitle').text(pdfTitle);
    });
  });
</script>
@endsection
