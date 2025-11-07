@extends('layouts.operator')
@section('content')
@section('style')
@endsection


<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5 opr-console">
    {{-- Page Heading --}}
    <div class="row">
        <div class="col-md-12 operator-heading-wrapper">
            <h1 class="h1">Monthly Report</h1>
            <span class="oprhelpNote" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <p class="notes"><b>Notes:</b> </p>
                    <p></p>
                    <ol>
                            
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}
</div>

@endsection
@section('script')
<script>
    
</script>
@endsection
