@extends('layouts.agent')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<style>
  .report-table { border: 0; border-collapse: collapse; border-radius: 5px !important; padding: 25px; }
  .report-table th, .report-table td { border: none !important; }
  .report-table th { font-weight: bold; }
  .custom-height { height: 40px !important; }
</style>
@endsection

@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">

  {{-- Page Heading --}}
  <div class="row">
    <div class="custom-heading-wrapper col-md-12">
      <h1 class="h1">Prospects & Reports</h1>
      <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b></span>
    </div>
    <div class="col-md-12 mb-4">
      <div class="card collapse" id="notes">
        <div class="card-body">
          <p><b>Notes:</b> Use filters to generate a prospect list. Proceed will add to Generated Reports. Trial Run lets you preview recipients.</p>
        </div>
      </div>
    </div>
  </div>

  {{-- Filter Section --}}
  <div class="card mb-3">
    <div class="card-header">Generate List</div>
    <div class="card-body">
      <div class="form-row align-items-end">
        <div class="col-md-4">
          <label>Filter Types</label>
          <div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="filterType" value="single" checked>
              <label class="form-check-label">Post Code Single</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="filterType" value="multiple">
              <label class="form-check-label">Post Code Multiple</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="filterType" value="all">
              <label class="form-check-label">All</label>
            </div>
          </div>
        </div>
        <div class="col-md-3" id="singleWrap">
          <label>Post Code</label>
          <input type="text" id="postCodeSingle" class="form-control" placeholder="e.g. 6000">
        </div>
        <div class="col-md-4 d-none" id="multipleWrap">
          <label>Post Code Range</label>
          <div class="input-group">
            <input type="text" id="postFrom" class="form-control" placeholder="From">
            <input type="text" id="postTo" class="form-control" placeholder="To">
          </div>
        </div>
        <div class="col-md-2 text-right">
          <button id="proceedBtn" class="btn-common">Proceed</button>
        </div>
      </div>
      <hr>
      <div class="form-row align-items-center">
        <div class="col-md-3">
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="trialRun">
            <label class="custom-control-label" for="trialRun">Trial Run Only</label>
          </div>
        </div>
        <div class="col-md-3">
          <button id="showRecipients" class="btn-common" disabled>Show Recipients</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Generated Reports --}}
  <div class="card">
    <div class="card-header">Generated Reports</div>
    <div class="card-body">
      <table class="table" id="reportsTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Date Generated</th>
            <th>Post Code</th>
            <th>Listings</th>
            <th>Merged</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>

</div>

{{-- View Report Modal --}}
<div class="modal fade" id="viewReportModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Report View</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="reportDetails"></div>
      <div class="modal-footer">
        <button class="btn-cancel-modal" data-dismiss="modal">Close</button>
        <button class="btn-success-modal" id="printReport">Print</button>
      </div>
    </div>
  </div>
</div>

{{-- Merge Modal --}}
<div class="modal fade" id="mergeModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Merge Type</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <select id="mergeSelect" class="form-control">
          <option value="single">Massage Centre (single)</option>
          <option value="multiple">Massage Centre (multiple)</option>
        </select>
      </div>
      <div class="modal-footer">
        <button class="btn-cancel-modal" data-dismiss="modal">Cancel</button>
        <button class="btn-success-modal" id="doMerge">Merge</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('script')
<script>
$(function(){
  let reports = [];
  let nextId = 101;

  $('input[name="filterType"]').change(function(){
    let val = $(this).val();
    if(val === 'single'){ $('#singleWrap').removeClass('d-none'); $('#multipleWrap').addClass('d-none'); }
    else if(val === 'multiple'){ $('#singleWrap').addClass('d-none'); $('#multipleWrap').removeClass('d-none'); }
    else { $('#singleWrap, #multipleWrap').addClass('d-none'); }
  });

  $('#trialRun').change(function(){
    $('#showRecipients').prop('disabled', !this.checked);
  });

  $('#proceedBtn').click(function(){
    let filter = $('input[name="filterType"]:checked').val();
    let pc = 'All';
    if(filter==='single') pc = $('#postCodeSingle').val();
    if(filter==='multiple') pc = $('#postFrom').val() + '-' + $('#postTo').val();

    let rpt = {id: nextId++, date: new Date().toLocaleDateString(), pc, listings: 3, merged:false};
    reports.unshift(rpt);
    renderReports();
  });

  function renderReports(){
    let tbody = $('#reportsTable tbody').empty();
    reports.forEach(r=>{
      tbody.append(`<tr>
        <td>${r.id}</td>
        <td>${r.date}</td>
        <td>${r.pc}</td>
        <td>${r.listings}</td>
        <td>${r.merged?'Yes':'No'}</td>
        <td class="text-center">
          <button class="btn btn-sm btn-info viewReport" data-id="${r.id}">View</button>
          <button class="btn btn-sm btn-secondary mergeReport" data-id="${r.id}">Merge</button>
          <button class="btn btn-sm btn-light printReportBtn" data-id="${r.id}">Print</button>
        </td>
      </tr>`);
    });
  }

  $(document).on('click','.viewReport',function(){
    let rpt = reports.find(x=>x.id==$(this).data('id'));
    $('#reportDetails').html(`<p><b>ID:</b> ${rpt.id}</p><p><b>Post Code:</b> ${rpt.pc}</p><p><b>Listings:</b> ${rpt.listings}</p>`);
    $('#viewReportModal').modal('show');
  });

  $(document).on('click','.mergeReport',function(){
    $('#mergeModal').data('id',$(this).data('id')).modal('show');
  });

  $('#doMerge').click(function(){
    let id = $('#mergeModal').data('id');
    let rpt = reports.find(x=>x.id==id);
    rpt.merged = true;
    renderReports();
    $('#mergeModal').modal('hide');
  });

  $(document).on('click','.printReportBtn',function(){ alert('Print '+$(this).data('id')); });
  $('#printReport').click(function(){ window.print(); });

  $('#showRecipients').click(function(){
    $('#reportDetails').html('<pre>Sample recipients list…</pre>');
    $('#viewReportModal').modal('show');
  });
});
</script>
@endpush
