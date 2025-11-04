@extends('layouts.center')
@section('style')
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between">
            <div class="custom-heading-wrapper">
                <h1 class="h1">Customise Dashboard</h1>
                <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></h6>
            </div>
            <div class="back-to-dashboard">
                <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                    <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <p></p>
                        <ol>

                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Heading -->

        <div class="row">
           
         <?php
         $viewers = config('constants.dashboard_viewer.center');
         if(!empty($viewers))
         {
             foreach($viewers as $view) :
             $checked = (($viewer_array->my_view[$view['key']] ?? 0) == 1) ? true : false; 
         ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <label class="card-label shadow-sm">
                    <input type="checkbox" name="{{$view['key']}}" data-key="{{$view['key'] }}" value="1" class="toggle-view" 
                     @if($checked) checked @endif >
                    <div class="selectable-card">
                    <div class="card-title-row">
                        <div class="card-title">{{$view['name']}}</div>
                        <div class="card-image">
                            <img src="{{ asset('assets/dashboard/img/'.$view['icon'].'')}}" alt="{{$view['name']}}">
                        </div>
                    </div>
                    <div class="card-desc">{{$view['text']}}</div>
                    </div>
                </label>
            </div>
            <?php
             endforeach;
            } 
            ?>
           
        </div>
    @endsection
    @section('script')
       
     <script>
    $(document).on("change", ".toggle-view", function () {
                    let key = $(this).data("key");
                    let value = $(this).is(":checked") ? 1 : 0;

                    $.ajax({
                        url: "{{ route('center.dashboard.customise-dashboard') }}",
                        method: "POST",
                        data: {
                            key: key,
                            value: value
                        },
                        success: function (res) {
                            console.log("Saved:", res);
                        },
                        error: function (xhr) {
                            console.error("Error:", xhr.responseText);
                        }
                    });
        });


    </script>

    @endsection
