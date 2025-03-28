@extends('layouts.web')
@section('style')

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
    
    <style>
        .swal-button {
            background-color: #242a2c;
        }
        </style>

@stop
@section('content')
    <section class="padding_fifty_top_and_btm">
        <div class="container">
               
                {!! $page ? $page->content : '' !!} 

                Last Updated - <span class="d-inline-block" tabindex="0" data-toggle="tooltip" >{{ \Carbon\Carbon::parse($page ? $page->updated_at : '')->diffForHumans() }}</span>
                
        </div>
    </section>

@endsection




@push('script')
<!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/app/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/app/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/app/vendor/jquery-easing/jquery.easing.min.js') }}"></script>




    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/app/js/sb-admin-2.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('assets/app/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/app/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/app/js/demo/chart-pie-demo.js') }}"></script>
     <script src="{{ asset('assets/app/js/popper.min.js') }}"></script>
<script>
var textarea = document.getElementById('editor1');
let editor = CKEDITOR.replace(textarea);
</script>
@endpush
