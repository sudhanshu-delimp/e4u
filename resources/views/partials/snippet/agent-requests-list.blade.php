<div id="mainAccordion" class="row" style="row-gap: 20px;">
    @forelse ($lists as $index => $list)

    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card shadow-sm border-0">
            <div class="card-body pb-2 statement-accordian">
                <div id="accordion1" class="myacording-design">
                    <div class="card border-0 p-0">
                        <div class="card-header">
                            <a class="card-link collapsed" data-toggle="collapse" href="#req1" aria-expanded="false">
                                <div class="d-flex align-items-center stat-detls">
                                    <div class="avatar avatar-xl pr-3 mt-1">
                                        <img src="{{asset('assets/img/agn-img.png') }}" alt="Face 1">
                                    </div>
                                    <div class="ms-3 name">
                                        <h5 class="primery_color normal_heading mb-0">
                                            <b>{{$list->first_name.' '.$list->last_name  }} </b>
                                        </h5>
                                        <h6 class="text-muted mb-0 small">
                                            Member ID : {{$list->user->member_id}}
                                            <span class="px-3">Request Date :  {{date('d/m/Y',strtotime($list->created_at))}}</span>
                                            <span>Ref : {{$list->ref_number}}</span>
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div id="req1" class="collapse" data-parent="#mainAccordion">
                            <div class="row">
                                <div class="col-md-6 list-sec pt-3">
                                    <h6><b>Mobile:</b> <span class="ml-2"> {{$list->mobile_number}}</span></h6>
                                    <h6><b>Email:</b> <span class="ml-2"> {{$list->email}}</span></h6>
                                </div>
                                <div class="col-md-6 list-sec pt-3">
                                    <h6><b>Home State:</b> <span class="ml-2">SA</span></h6>
                                    <h6><b>Contact Method:</b> 

                                    @php
                                        if ($list->contact_by_mobile && !$list->contact_by_email) {
                                            echo '<span class="ml-2">By Mobile</span>';
                                        } elseif ($list->contact_by_email && !$list->contact_by_mobile) {
                                            echo '<span class="ml-2">By Email</span>';
                                        } elseif ($list->contact_by_email && $list->contact_by_mobile) {
                                            echo '<span class="ml-2">By Mobile or By Email</span>';
                                        }
                                    @endphp
                                     

                                </h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 list-sec pt-1">
                                    <h6><b>Comments:</b> </h6>
                                    <h6 class="text-justify">
                                       {{$list->comments}}
                                    </h6>
                                </div>
                            </div>
                            <div class="row mt-2">

                                <div class="col-auto">
                                    <input type="submit" value="Accept" class="btn-success-modal float-right" name="submit" data-target="#requestAccepted" data-toggle="modal">
                                </div>
                                <div class="col-auto pr-0">
                                    <input type="submit" value="Reject" class=" btn-cancel-modal shadow-none float-right" name="submit" data-target="#requestRejected" data-toggle="modal">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @empty
    <div class="col-12">
        <div class="alert alert-warning text-center">No records found.</div>
    </div>
    @endforelse
</div>

<div class="d-flex justify-content-end pt-4">
    {{ $lists->appends(request()->query())->links('pagination::bootstrap-4') }}
</div>