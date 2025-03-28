
    
<form id="myTour" method="post" action="{{route('agent.tour.edit.paymentUrl',$find_tour->id)}}">
{{-- <form id="myTour" method="post" action="{{route('agent.edit.tour',$find_tour->id)}}"> --}}
    @csrf
    <input type="hidden" id="tid" value="{{$find_tour->id}}">
    <input type="hidden" name="user_id" id="user_id" >
    <div class="modal-body">
        <div class="row pl-3">
            <div class="form-group mb-2 pt-2">
                <label for="staticEmail2">Tour Name<span style='color:red'>*</span></label>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" name="name" required data-parsley-required-message=" Please enter Tour Name" class="form-control" id=" " placeholder=" " value="{{$find_tour->name}}" data-parsley-errors-container="#Tname"> 
            </div>
            
        </div><span id="Tname"></span>
        <div id="accordion" class="myacording-design mb-0 pt-3">
            <div id='EditdivcountId'>
                {{-- {{ dd($tourLocation)}} --}}
                @foreach($find_tour->tour_location as $key => $tour_location)
                @if( \Carbon\Carbon::parse($tour_location->end_date)->format('Y-m-d') <= date('Y-m-d') ) 

                    @php $class_disabled = "disabled";@endphp
                @else
                    @php $class_disabled = "";@endphp
                @endif
                <div class="editDivCount" id="deleteDiv_{{$key+1}}">
                    @include('agent.dashboard.Advertisers.tour.partials.tourModelEdit2')
                
                </div>
                @endforeach
            </div> 
        </div> 
        <div class="col-md-12 p-0">
            <button type="button" class="btn btn-primary create-tour-sec w-100 editForm_addLocation" data-count="{{count($find_tour->tour_location)}}">Add Location <i class="fa fa-fw fa-plus" style="color: #fff;"></i> </button>
        </div>
        
    </div>
    <div class="modal-footer border-0 pt-5" style="justify-content: flex-start;">
        <button type="submit" class="btn btn-secondary create-tour-sec">Save</button>
        <button type="button" class="btn btn-primary create-tour-sec resetTour" data-class="akhReset">Reset</button>
    </div>
</form>
        
