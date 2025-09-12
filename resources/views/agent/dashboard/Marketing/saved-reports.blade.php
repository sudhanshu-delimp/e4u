@extends('layouts.agent')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<style>
.report-table {
  border: 0px;
  border-collapse: collapse;
  border-radius: 5px !important;
  padding: 25px;
}

.report-table th,
.report-table td {
  border: none !important;
}
.report-table th{
   font-weight: bold;
}
.custom-height{
   height: 40px !important;
}
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content end here-->{{-- Page Heading   --}}
   <div class="row">  
         <div class="custom-heading-wrapper col-md-12">
             <h1 class="h1">Saved Reports</h1>
             <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
         </div>
         <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
               <div class="card-body">
                  <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                  <ol>
                     
                  </ol>
               </div>
            </div>
         </div>   
   </div>
   {{-- end --}}


   <div class="row mb-3 justify-content-end">
    <div class="col-lg-12 d-flex align-items-center gap-10 justify-content-end flex-wrap">
      
      <!-- Search Bar -->
      <input type="text" id="customSearch" disabled class="form-control custom-height w-25"
        placeholder="Select your search type by Filters">
  
      <!-- Hidden Filter Options -->
      <select id="filterType" class="form-control custom-height w-auto" style="display:none;">
        <option value="">-- Select Filter --</option>
        <option value="0">Massage Centre</option>
        <option value="1">Post Code</option>
        <option value="2">Mobile Number</option>
      </select>
  
      <!-- Filter Button -->
      <button id="filterBtn" class="btn-common d-flex align-items-center gap-10 m-0">
        <i class="fa fa-filter text-white"></i> Filter
      </button>
  
      <!-- Hidden Search Button -->
      <button id="searchBtn" class="btn-common d-flex align-items-center gap-10 m-0" style="display:none !important;">
        <i class="fa fa-search text-white"></i> Search
      </button>
  
    </div>
  </div>
 
  

    
    <!-- Main DataTable (Your Reports Table) -->
    <div class="table-responsive-xl">
      <table class="table mb-3" id="save_report_table">
        <thead class="table-bg">
          <tr>
            <th>Report Date</th>
            <th>Post Code</th>
            <th>Suburb</th>
            <th>Location</th>
            <th>Download</th>
            <th>Status</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>22-07-2025</td>
            <td>6152</td>
            <td>Manning</td>
            <td>Western Australia</td>
            <td><a href="download.pdf">22072025_6152</a></td>
            <td>Pending</td>
            <td class="text-center">
               <div class="dropdown no-arrow">
                   <a class="dropdown-toggle" href="#" role="button"
                       id="dropdownMenuLink" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="true">
                       <i
                           class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                   </a>
                   <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                       aria-labelledby="dropdownMenuLink"
                       x-placement="bottom-end">
                       
                       <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                           href="#"> <i class="fa fa-check-circle"></i>
                           Completed</a>
                       <div class="dropdown-divider"></div>
                       <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                           href="#"> <i class="fa fa-bezier-curve"></i>
                           Merge</a>

                   </div>
               </div>
           </td>
          </tr>
        </tbody>
      </table>
    </div>
    

</div>

@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>   
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
   $(document).ready(function () {
  // Init DataTable
  var table = $("#save_report_table").DataTable({
    language: {
      search: "Search: _INPUT_",
      searchPlaceholder: "Search by Member ID"
    },
    processing: false,
    serverSide: false,
    paging: true,
    lengthChange: false,
    searching: false, // disable default search
    bStateSave: true,
    ordering: false,
    lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
    pageLength: 10
  });

  // Show filter options
  $("#filterBtn").on("click", function () {
    $("#filterOptions").toggle();
  });

  // Enable/disable search input
  $("#filterType").on("change", function () {
    if ($(this).val()) {
      $("#customSearch").prop("disabled", false);
      $("#searchBtn").show();
    } else {
      $("#customSearch").prop("disabled", true).val("");
      $("#searchBtn").hide();
    }
  });

  // Search button click
  $("#searchBtn").on("click", function () {
    let colIndex = $("#filterType").val(); // column index (string)
    let query = $("#customSearch").val().toLowerCase();

    if (colIndex !== "" && query) {
      let found = false;

      // Remove old report section
      $("#reportSection").remove();

      // Loop through all rows
      table.rows().every(function () {
        let row = this.data();
        if (row[colIndex].toLowerCase().includes(query)) {
          found = true;

          // Report Name format: [date_postcode]
          let reportName = row[0].replace(/-/g, "") + "_" + row[1];

          let reportHtml = `
               <div id="reportSection" class="my-account-card">
                  <table class="table table-bordered report-table">
                     <thead>
                        <tr>                        
                           <th class="pb-3"><h5 class="text-blue-primary">Report Details</h5></th>
                           <td class="text-right pb-3" colspan="3">
                              <button class="btn-cancel-modal" onclick="printReport()"><i class="fa fa-print text-white pr-2"></i>  Print Report</button>
                              <button class="btn-success-modal" onclick="saveReport('${reportName}')"> <i class="fa fa-save text-white pr-2"></i> Save Report</button> 
                           </td>
                        </tr>
                     </thead>
                     <tbody>
                        <tr><th>Report Date</th><td>${row[0]}</td> <th>Post Code</th><td>${row[1]}</td></tr>
                        <tr></tr>
                        <tr><th>Suburb</th><td>${row[2]}</td><th>Location</th><td>${row[3]}</td></tr>
                        <tr><th>Download</th><td>${row[4]}</td><th>Status</th><td>${row[5]}</td></tr>
                     </tbody>
                  </table>
               </div>
               `;

          // Append report below table
          $(".table-responsive-xl").before(reportHtml);
        }
      });

      if (!found) {
        alert("No matching report found.");
      }
    } else {
      alert("Please select filter and enter a search value.");
    }
  });
});

// Print function
function printReport() {
  window.print();
}

function saveReport(reportName) {
  // Get the current report details table
  let reportTable = document.querySelector("#reportSection .report-table tbody");
  if (!reportTable) {
    alert("No report to save!");
    return;
  }

  // Extract data from the report table
  let rows = reportTable.querySelectorAll("tr");
  let data = [];
  rows.forEach((tr) => {
    let cells = tr.querySelectorAll("td");
    if (cells.length > 0) {
      data.push(cells[0].innerText || cells[0].textContent);
    }
  });

  // Append a new row to #save_report_table tbody
  let saveTableBody = document.querySelector("#save_report_table tbody");
  let newRow = document.createElement("tr");

  // Use the original columns from the report details
  newRow.innerHTML = `
    <td>${rows[0].querySelector("td").innerText}</td>
    <td>${rows[1].querySelector("td").innerText}</td>
    <td>${rows[2].querySelector("td").innerText}</td>
    <td>${rows[3].querySelector("td").innerText}</td>
    <td>${rows[4].querySelector("td").innerText}</td>
    <td>${rows[5].querySelector("td").innerText}</td>
    <td class="text-center">
      <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button"
           data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
           <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
        </a>
        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in">
          <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" onclick="printReport()">
            <i class="fa fa-print"></i> Print Report
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" onclick="alert('Downloading ${reportName}.pdf')">
            <i class="fa fa-save"></i> Download
          </a>
        </div>
      </div>
    </td>
  `;
  saveTableBody.appendChild(newRow);

  alert(`Report "${reportName}" saved successfully!`);
}

// Filter button click → show/hide dropdown + search button
$("#filterBtn").on("click", function () {
  $("#filterType").toggle();   // dropdown
  $("#searchBtn").toggle();    // search button
});


</script>
@endpush