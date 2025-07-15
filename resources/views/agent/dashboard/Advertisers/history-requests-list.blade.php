@if($lists->isNotEmpty())
<div class="row mt-4">
    @forelse ($lists as $index => $list)
    @php
    $status = 'Forfeited';
    $listBG = '#fff9eb;';
    if($list->status=='1')
    {
         $listBG = '#dcf7ea;';
         $status = 'Accepted';
    }
   
    if($list->status=='2')
    {
        $listBG = '#f8d2d2;';
        $status = 'Rejected';
    }
    
    @endphp
    <div class="col-lg-4">
        {{-- new --}}
        <div class="card mb-4 shadow-sm border-0" >
            <div class="card-body p-4" style="background:<?php echo $listBG;?>">
                <div class="d-flex align-items-end justify-content-between">

                    <div>
                        <h6 class="mb-1"><b>Member ID :</b> <span style="color: #333;">{{$list->user->member_id}}</span></h6>
                        <h6 class="mb-1"><b>Name :</b> <span style="color: #333;"> {{$list->first_name.' '.$list->last_name  }}</span></h6>
                        <br>
                        <h6 class="text-warning font-weight-bold">Date  {{$status}} : <span>{{date('d/m/Y',strtotime($list->created_at))}}</span></h6>
                    </div>

                    <div>
                        <button type="button" class="btn btn-history p-0 bg-warning" data-toggle="modal" data-target="#Agent_Name" style="font-size: 20px;">
                            <i class="fas fa-arrow-right text-white rotate-27 "></i>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>


<div class="d-flex justify-content-end pt-4">
    {{ $lists->appends(request()->query())->links('pagination::bootstrap-4') }}
</div>
@else

<div class="row mt-4">
<div class="col-12">
    <div class="alert alert-warning text-center">No history found.</div>
</div>
</div>
@endif