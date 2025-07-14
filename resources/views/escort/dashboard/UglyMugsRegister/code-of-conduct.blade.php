@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<style type="text/css">
   .parsley-errors-list {
   list-style: none;
   color: rgb(248, 0, 0)
   }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content start here-->
  
  <div class="row">
   <div class="d-flex align-items-center justify-content-start mt-5 flex-wrap col-lg-12">
       <h1 class="h1">>Code of Conduct</h1>
   </div>
   <div class="col-md-12 my-4">
      <div class="back-to-dashboard">
         <a href="{{ url()->previous() ?? route('user.add-report') }}">
             <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
         </a>
     </div>
   </div>
</div>
   <div class="row my-5">
      <div class="col-md-10 ">
         <h2 class="h2">Ethical reporting</h2>
         <p>Viewers are required to maintain a high standard of ethics when reporting their experience
            whilst applying the following standards (Standards):</p>
            <p class="mt-4"><b>In these Standards the word “Escort” means a Private Escort or Masseur.</b></p>
            <ol>
               <li>Report your experience honestly, striving for accuracy, fairness and disclosure of all the
                  essential facts in a clear manner so as to not cause any confusion about the Escort and
                  your experience with them. Do not suppress relevant available facts, or give a distorting
                  emphasis.</li>
               <li>Do not place any unnecessary emphasis on irrelevant personal characteristics, act with
                  care in your reporting.</li>
               <li>Do not allow your personal interest, or any belief, perception, understanding or benefit,
                  to undermine your accuracy or fairness about your experience.</li>
               <li>Use fair, responsible and honest selections in your descriptive when completing your
                  Report.</li>
               <li>Do not provide false or misleading information about the Escort you are making the
                  Report about.</li>
               <li>By making a Report about an Escort, you may have an influence on the Escort’s ability
                  to earn an income.? Consider carefully, if it is appropriate to make the Report.? Do not
                  let bias affect your reporting.</li>
            </ol>
      </div>
   </div>
   <!--middle content end here-->
</div>
@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
@endpush