<div class="modal fade" id="play-mates-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title w-100" id="playmate-modal-title">
                    <span id="playmate-modal-name"> </span>
                    <span class="float-right" id="playmate-modal-location">
                        
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="hidden_escort_id" id="hidden_escort_id">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('agent.playmates.add') }}" method="POST" id="add-playmate-form">
                            @csrf
                            <div class="form-group row">
                                <div class="col-12">
                                    <select class="form-control select2 form-control" id="search-playmate-input" name="playmate_id" data-parsley-errors-container="#playmate-errors" required data-parsley-required-message="Select a playmate">
                                        <option value="" disabled>Select a playmate</option>
                                    </select>
                                    <span id="playmate-errors"></span>
                                </div>
                            </div>
                            <span class="float-right">
                                <button style="display: none" type="submit" id="playmate_submit_button" class="save_profile_btn pull-right">Add Playmate</button>
                            </span>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="playmate-template" class="text-center">
                            <div class="spinner-border text-secondary" style="width: 6rem; height: 6rem;" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>