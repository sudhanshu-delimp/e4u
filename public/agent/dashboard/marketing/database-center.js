const mmRoot = $('#manage-route');
const endpoint = {
  csrf_token: mmRoot.data('csrf-token'),
  success_image: mmRoot.data('success-image'),
  error_image: mmRoot.data('error-image'),
  marketing_database_centres: mmRoot.data('marketing-database-centres'),
  marketing_view_database_center: mmRoot.data('marketing-view-database-center'),
  marketing_download_database_center: mmRoot.data('marketing-download-database-center'),
  count_active_post_code: mmRoot.data('count-active-post-code'),
  download_pdf: mmRoot.data('download-pdf')

};



$(document).ready(function () {

  var table = $("#databaseCentreTable").DataTable({
    language: {
      search: "Search: _INPUT_",
      searchPlaceholder: "Search by Territory"
    },
    processing: true,
    serverSide: true,
    lengthMenu: paginateRange,
    pageLength: paginateLength,
    ajax: {
      url: endpoint.marketing_database_centres,
      type: 'GET'
    },
    columns: [{
      data: 'date',
      name: 'date',
      searchable: false,
    },
    {
      data: 'territory_name',
      name: 'territory_name',
      searchable: true,
    },
    {
      data: 'centres',
      name: 'centres',
      searchable: false
    },
    {
      data: 'mobile_numbers',
      name: 'mobile_numbers',
      searchable: false
    },
    {
      data: 'status',
      name: 'status',
      searchable: false
    },
    {
      data: 'action',
      name: 'action',
      orderable: false,
      searchable: false,
      className: 'text-center',
      searchable: false
    },
    ],
    order: []
  });

  //for view
  $(document).on('click', '.js-summary', function (e) {
    e.preventDefault();
    const id = $(this).data('id');
    $('#view_data_center').modal('show');
    $('#modal_error').hide();
    $('#viewSummeryData').empty();
    $('#modal_loader').show();
    $('.js-pdf').attr('data-pdf-id', id);

    $.ajax({
      url: endpoint.marketing_view_database_center.replace('__ID__', id),
      type: 'GET',
      success: function (response) {
        let d = response.data;
        let html = '';
        if (response.status === true) {
          $('#modal_loader').hide();
          const rows = [
            ['Uploaded', d.Uploaded || ''],
            ['Territory', d.Territory || ''],
            ['Centres', d.Centres || ''],
            ['Mobiles', d.Mobiles || ''],
            ['Status', d.Status || ''],
          ];

          rows.forEach(function (r) {
            html += `
                                <tr>
                                    <th><b>${r[0]}</b></th>
                                    <td>${r[1]}</td>
                                </tr>
                            `;
          });

          $('#viewSummeryData').html(html);
          $('#view_data_center').modal('show');

        }
      },
      error: function () {
        $('#modal_loader').hide();
        $('#modal_error').show();
      }
    });
  });

  // for Download
  $(document).on('click', '.js-download', function (e) {
    e.preventDefault();
    const id = $(this).data('id');
    window.location.href = endpoint.marketing_download_database_center.replace('__ID__', id);
  });

  // for generate PDf

  $(document).on('click', '.js-pdf', function (e) {
    e.preventDefault();
    let id = $(this).data('pdf-id');
    let decordId = btoa(id);
    window.open(endpoint.download_pdf.replace('__ID__', decordId), '_blank');
  });

  countActivePostCode();
  function countActivePostCode() {
    $.ajax({
      url: endpoint.count_active_post_code,
      method: "GET",
      success: function (response) {
        if (response.status === true) {
          $('.totalInprogressTask').html(response.data);
        }
      }

    });
  }







});

