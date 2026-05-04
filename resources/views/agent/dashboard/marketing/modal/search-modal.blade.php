<div class="modal fade upload-modal" id="searchCenterModal" tabindex="-1" role="dialog"
    aria-labelledby="searchlabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <img src="{{ asset('assets/dashboard/img/search.png') }}" class="custompopicon">
                    <span class="text-white">Search</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>

            <div class="modal-body pb-0 agent-tour text-center">
                <h4 class="custom_modal_text">
                    Search the Information Package document you are looking for by the ID contained in the List.
                </h4>

                <div class="row mt-3">
                    <div class="col-md-6 mx-auto">
                        <div class="form-group">
                            <input class="form-control" type="text" id="search_id_number" placeholder="Insert ID Number">
                            <input type="hidden" id="search_report_id" value="">
                        </div>
                    </div>
                </div>

                {{-- Search Button --}}
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <button type="button" class="btn-success-modal" id="search_button">
                            Search
                        </button>
                    </div>
                </div>

                {{-- Merge Type --}}
                <div class="row" style="display:none;" id="search_merge_type_row">
                    <div class="col-md-12 mb-2">
                        <div class="d-flex align-items-center justify-content-center gap-20">
                            <input type="hidden" id="search_report_id" value="">

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="searchMergeType" id="search_single" value="single" checked>
                                <label class="form-check-label" for="search_single"> Massage Centre (Single) </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="searchMergeType" id="search_multiple" value="multiple">
                                <label class="form-check-label" for="search_multiple">  Massage Centre (Multiple) </label>
                            </div>
                        </div>
                    </div>
                </div>

                

                {{-- Loader --}}
                <div id="search_loader" class="text-center py-3" style="display:none;">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="mt-2">Searching...</p>
                </div>

                {{-- Result --}}
                <div id="report_items_list" >
                    <div class="report_container" id="search_result_item">
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>