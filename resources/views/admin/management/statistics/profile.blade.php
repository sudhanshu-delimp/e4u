@extends('layouts.admin')
@section('content')

<div class="conatainer">

 <div class="table--wrapper"> 
   <table class="custom--table">
      <thead>
         <tr>
            <th>Year o Year Growth</th><th>Total Profiles</th><th>Historical Profiles</th>
         </tr>
         <tr>
            <th>Current FY </th><th rowspan="2">Total Last FY</th><th>Variation Total</th><th rowspan="2">Total Units</th><th>Variation</th><th rowspan="2">Total Units</th><th>Overall Growth</th>
         </tr>
         <tr>
            <th>Location</th><th>Member</th><th>Listed</th><th>Archived</th><th>Total</th><th>Units</th><th>%</th><th>Units</th><th>%</th><th>Units</th><th>%</th>s
         </tr>
      </thead>
   </table>
 </div>

</div>



@endsection
@section('script')
<script>
    
</script>
@endsection
