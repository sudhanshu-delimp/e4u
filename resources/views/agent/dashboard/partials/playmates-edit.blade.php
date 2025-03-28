<div id="play-mates-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-width" role="document">
        <div class="modal-content remove-border">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('agent.playmates.add') }}" method="POST" id="add-playmate-form">
                        <input type="hidden" name="hidden_escort_id" id="hidden_escort_id" value="{{ $escort->id}}">
                        @csrf
                        <div class="row">
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
        </div>
    </div>
</div>