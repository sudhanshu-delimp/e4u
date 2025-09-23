@extends('layouts.agent')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/datatables.min.css') }}">
<style>
  .small-muted { font-size: 12px; color: #6c757d; }
  .card { box-shadow: 0 2px 6px rgba(0,0,0,.06); }
</style>
@endsection

@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">

  {{-- Page Heading --}}
  <div class="row">
    <div class="d-flex align-items-center justify-content-between col-md-12">
      <div class="custom-heading-wrapper">
        <h1 class="h1">Create Prospect</h1>
        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
      </div>
      {{-- <div class="back-to-dashboard">
        <a href="{{ url()->previous() ?? route('dashboard.home') }}">
          <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
        </a>
      </div> --}}
    </div>
    <div class="col-md-12 mb-4">
      <div class="card collapse" id="notes">
        <div class="card-body">
          <p class="mb-0" style="font-size: 20px;"><b>Notes:</b></p>
          <ol>
            <li>The E4U data list (Data) includes all known Massage Centres located in your Territory. From time to time the Data will be updated. You will be notified when the Data is updated.</li>
            <li>Use the search feature to create your prospect list (List). Once you have created the List, you can then apply the List in the following manner:
               <ul style="list-style: lower-alpha;padding-left: 20px;margin-top: 8px;">
                  <li>merging the List into any of the marketing material provided.</li>
                  <li>printing the List as a working sheet.</li>
                  <li>working from the List via your computer screen.</li>
               </ul>
            </li>
            <li>A Massage Centre who becomes a Member will remain in the List.</li>
            <li>You can access your Lists anytime from the Report List.</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  {{-- Generate Prospect List --}}
  <div class="card mb-4">
   <div class="card-header" style="background: #0c223d;color: #fff;">Generate Prospect List</div>
    <div class="card-body">
      <p class="small-muted">Use filters to create a list for your territory.</p>

      <form id="generateForm">
        <div class="form-row align-items-end">
          <div class="col-md-4">
            <label>Filter Type</label>
            <select class="form-control" id="filterType">
              <option value="single">Post Code - Single</option>
              <option value="multiple">Post Code - Multiple</option>
              <option value="all">All</option>
            </select>
          </div>

          <div class="col-md-2" id="singleField">
            <label>Post Code</label>
            <input type="text" id="singlePostcode" class="form-control" placeholder="e.g. 6000">
          </div>

          <div class="col-md-3 d-none" id="rangeField">
            <label>Post Code Range</label>
            <div class="input-group">
              <input type="text" id="fromPostcode" class="form-control" placeholder="From">
              <input type="text" id="toPostcode" class="form-control" placeholder="To">
            </div>
          </div>

          <div class="col-md-2">
            <label style="margin-bottom: 22px;">Options</label>
            <div class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input" id="trialRunSwitch">
              <label class="custom-control-label" for="trialRunSwitch">Trial Run Only</label>
            </div>
          </div>

          <div class="col-md-1 text-right">
            <button type="button" id="showRecipients" class="btn-common" disabled>Show</button>
          </div>
          <div class="col-md-1 text-right">
            <button type="button" id="proceedBtn" class="btn-common">Proceed</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  {{-- Trial Run Preview --}}
  <div id="previewCard" class="card mb-4 d-none">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Preview Results</h5>
        <button class="btn-common" id="closePreview">Close</button>
      </div>
      <hr>
      <div class="table-responsive">
        <table class="table table-sm table-bordered" id="previewTable">
          <thead class="bg-first">
            <tr>
              <th>ID</th><th>Business Name</th><th>Address</th><th>Post Code</th><th>Mobile</th><th>Business No.</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>

  {{-- Generated Reports --}}
  <div class="card">
    <div class="card-body">
      <h5 class="card-title pt-0 mb-0">Generated Report List</h5>
      <div class=" ">
         <div class="table-responsive-xl">
            <table class="table table-bordered">
               <thead class="bg-first">
                  <tr>
                     <th>ID</th>
                     <th>Date</th>
                     <th>Post Code</th>
                     <th>Listings</th>
                     <th>Merged</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody class="table-content">
                  <tr class="row-color mt-0">
                     <td class="font-weight-normal text-muted bg-white">411</td>
                     <td class="font-weight-normal text-muted bg-white pt-0">9/18/2025</td>
                     <td class="font-weight-normal text-muted bg-white pt-0">44444</td>
                     <td class="font-weight-normal text-muted bg-white pt-0">0</td>
                     <td class="font-weight-normal text-muted bg-white pt-0">No</td>
                     <td class="font-weight-normal text-muted bg-white pt-0">
                        <div class="dropdown no-arrow">
                           <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                           </a>
                           <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                              <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#viewModal"> <i class="fa fa-eye"></i> View </a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 viewReportBtn" href="#" data-toggle="modal" data-target="#mergeModal"> <i class="fas fa-atom"></i> Merge</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#printModal"> <i class="fa fa-print"></i> Print</a>
                           </div>
                        </div>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
    </div>
  </div>

</div>

{{-- Merge Modal --}}
<div class="modal fade upload-modal" id="mergeModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered"><div class="modal-content basic-modal">
    <div class="modal-header"><h5 class="modal-title">Merge Report</h5>
      <button class="close" data-dismiss="modal">&times;</button></div>
    <div class="modal-body">
      <label>Select Marketing Document</label>
      <select class="form-control"><option>Welcome Pack</option><option>Brochure</option></select>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button class="btn btn-primary">Merge</button>
    </div>
  </div></div>
</div>

{{-- View Modal --}}
<div class="modal fade upload-modal" id="viewModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered"><div class="modal-content basic-modal">
    <div class="modal-header"><h5 class="modal-title">View Report</h5>
      <button class="close" data-dismiss="modal">&times;</button></div>
    <div class="modal-body" id="viewReportBody"></div>
  </div></div>
</div>

<div class="modal fade upload-modal" id="printModal" tabindex="-1" aria-modal="true" role="dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title">Print Report</h5>
            <button type="button" class="close" data-dismiss="modal">×</button>
         </div>
         <div class="modal-body" id="printModalBody">
            <h6>Report For: Agent Name</h6>
            <p><strong>Date Generated:</strong> 9/18/2025 <strong>Post Code:</strong> 44444 <strong>Listings:</strong> 0</p>
            <div class="table-responsive">
               <table class="table table-sm table-bordered">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Business Name</th>
                        <th>Address</th>
                        <th>Post Code</th>
                        <th>Mobile</th>
                        <th>Business No.</th>
                     </tr>
                  </thead>
                  <tbody></tbody>
               </table>
            </div>
            <p><label><input type="checkbox" id="signedCheck"> Signed (tick when converted to member)</label></p>
         </div>
         <div class="modal-footer">
            <button class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button class="btn btn-success" id="doPrint">Print</button>
         </div>
      </div>
   </div>
</div>

@endsection

@push('script')
<script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
<script>
$(function(){
  // Example dataset
  const SAMPLE = [
    {id:369,name:'Body Heat Massage',address:'62 Gordon Rd, Perth',postcode:'6000',mobile:'0456 665 012',business:'9236 2587'},
    {id:256,name:'Healthland',address:'510 Murray St, Perth',postcode:'6000',mobile:'0426 610 881',business:''},
    {id:147,name:'Esquire Spa',address:'11 Aberdeen St, Perth',postcode:'6000',mobile:'',business:'9325 2011'},
  ];
  let reports=[];

  function renderReports(){
    let tb=$('#reportsTable tbody');tb.empty();
    reports.forEach(r=>{
      tb.append(`<tr>
        <td>${r.id}</td><td>${r.date}</td><td>${r.postcode}</td><td>${r.listings.length}</td>
        <td>${r.merged?'Yes':'No'}</td>
        <td>
          <button class="btn btn-sm btn-info viewBtn" data-id="${r.id}">View</button>
          <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#mergeModal">Merge</button>
          <button class="btn btn-sm btn-success">Print</button>
        </td></tr>`);
    });
  }

  function filterData(type,single,from,to){
    if(type==='all') return SAMPLE;
    if(type==='single') return SAMPLE.filter(s=>s.postcode===single);
    let f=parseInt(from),t=parseInt(to);
    return SAMPLE.filter(s=>+s.postcode>=f && +s.postcode<=t);
  }

  $('#filterType').on('change',function(){
    let v=$(this).val();
    $('#singleField').toggleClass('d-none',v!=='single');
    $('#rangeField').toggleClass('d-none',v!=='multiple');
  }).trigger('change');

  $('#trialRunSwitch').on('change',function(){
    $('#showRecipients').prop('disabled',!this.checked);
  });

  $('#showRecipients').click(function(){
    let data=filterData($('#filterType').val(),$('#singlePostcode').val(),$('#fromPostcode').val(),$('#toPostcode').val());
    let tb=$('#previewTable tbody');tb.empty();
    data.forEach(d=>tb.append(`<tr><td>${d.id}</td><td>${d.name}</td><td>${d.address}</td><td>${d.postcode}</td><td>${d.mobile}</td><td>${d.business}</td></tr>`));
    $('#previewCard').removeClass('d-none');
  });

  $('#closePreview').click(()=>$('#previewCard').addClass('d-none'));

  $('#proceedBtn').click(function(){
    let type=$('#filterType').val();
    let data=filterData(type,$('#singlePostcode').val(),$('#fromPostcode').val(),$('#toPostcode').val());
    let rep={id:Math.floor(Math.random()*1000),date:new Date().toLocaleDateString(),postcode:type, listings:data,merged:false};
    reports.unshift(rep);renderReports();
    alert('Report generated!');
  });

  $('#reportsTable').on('click','.viewBtn',function(){
    let id=$(this).data('id');
    let r=reports.find(x=>x.id==id);
    $('#viewReportBody').html(`<p><b>ID:</b> ${r.id} <b>Date:</b> ${r.date}</p>`);
    $('#viewModal').modal('show');
  });
});
</script>
@endpush
