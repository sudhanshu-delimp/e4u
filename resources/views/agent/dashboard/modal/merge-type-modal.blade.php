
    {{-- merge modal --}}
    <div class="modal fade upload-modal" id="mergeType" tabindex="-1" role="dialog" aria-labelledby="mergeTypelabel"  aria-hidden="true" data-backdrop="static" >
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/merge.png') }}" class="custompopicon">
                        <span class="text-white">Merge Type</span>
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div> 
                <div class="modal-body pb-0 agent-tour">
                    <h4 class="custom_modal_text">Select the Marketing Information document to merge with</h4>
                   <form method="POST" action="" id="submitMergeTypeForm">
                        @csrf
                        <div class="row my-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-center gap-20">
                                        
                                        <div class="form-check form-check-inline">
                                            <input type="hidden" name="report_id" id="report_id" value="">
                                            <input class="form-check-input" type="radio" name="mergeType"
                                                id="single" value="single" checked>
                                            <label class="form-check-label" for="single">Massage Centre (single)</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="mergeType"
                                                id="multiple" value="multiple">
                                            <label class="form-check-label" for="multiple">Massage Centre (Multiple)</label>
                                        </div>

                                    </div>
                                </div>

                                <div class="d-flex justify-content-center mt-4">
                                    <button type="submit" class="btn-success-modal" >Merge</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}