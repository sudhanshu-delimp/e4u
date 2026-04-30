    <div class="modal fade upload-modal" id="searchCenterModal" tabindex="-1" role="dialog" aria-labelledby="searchlabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/search.png') }}" class="custompopicon">
                        <span class="text-white">Search </span>
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0 agent-tour text-center">
                    <h4 class="custom_modal_text">Search the Information Package document you are looking
                        for by the ID contained in the List.</h4>
                    <form>
                        <div class="row mt-3">
                            <div class="col-md-6 mx-auto">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="id_number"
                                        placeholder="Insert ID Number">
                                </div>
                            </div>
                        </div>

                        <!-- Save Button -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group text-center">
                                    <button type="button" class="btn-success-modal" id="search_button"
                                        data-target="#view_list" data-toggle="modal">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>