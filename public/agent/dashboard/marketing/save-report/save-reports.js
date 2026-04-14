const mmRoot = $('#manage-route');
const endpoint = {
    csrf_token: mmRoot.data('csrf-token'),
    success_image: mmRoot.data('success-image'),
    error_image: mmRoot.data('error-image'),
    save_report_list: mmRoot.data('save-report-list'),
  

};

$(document).ready(function () {
    // Init DataTable
    console.log(endpoint.save_report_list);
    var table = $("#save_report_table").DataTable({
        ajax: {
            url: endpoint.save_report_list,
            type: 'GET'
        },
        language: {
            search: "Search: _INPUT_",
            searchPlaceholder: "Search by Post Code"
        },
        processing: false,
        serverSide: false,
        paging: true,
        lengthChange: false,
        searching: true, // disable default search
        bStateSave: true,
        ordering: false,
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],
        pageLength: 10,
        columns: [{
            data: 'id',
            name: 'id',
            searchable: true,
            orderable: true,
            defaultContent: 'NA'
        },
        {
            data: 'date',
            name: 'date',
            searchable: false,
            defaultContent: 'NA'
        },
        {
            data: 'post_code_label',
            name: 'post_code_label',
            searchable: true,
            defaultContent: 'NA'
        },
        {
            data: 'listings_count',
            name: 'listings_count',
            defaultContent: 'NA'
        },
        {
            data: 'merged',
            name: 'merged',
            defaultContent: 'NA'
        },
        {
            data: 'action',
            name: 'action',
            searchable: false,
            orderable: false,
            defaultContent: 'NA',
            class: 'text-center'
        },
        ],
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


    function printReport() {
        window.print();
    }

    function saveReport(reportName) {
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


    $("#filterBtn").on("click", function() {
        $("#filterType").toggle(); // dropdown
        $("#searchBtn").toggle(); // search button
    });



});