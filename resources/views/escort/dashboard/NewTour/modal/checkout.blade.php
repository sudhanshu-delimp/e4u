<div class="modal fade upload-modal" id="escort_tour_checkout" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static"
    aria-modal="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id=""><img src="{{ asset('assets/dashboard/img/pinup-location.png')}}" class="custompopicon" alt="cross"> Checkout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img id="modal_close"
                                src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="container p-0">
                                <form action="#" method="GET">
                                    <div class="form-group row">
                                        <label class="col-sm-3" for=""> Tour:</label>
                                        <div class="col-sm-9">
                                            <select
                                                class="form-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp"
                                                id="escort_tour_id" name="escort_tour_id"
                                                data-parsley-errors-container="#escort_tour_id-errors" required
                                                data-parsley-required-message="Select Tour">

                                            </select>
                                            <span id="profile-errors"></span>
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                    <hr style="background-color: #0C223D" class="mt-4">
                                    <!-- <div class="form-group row">
                                        <div class="col-lg-12">
                                            <p class="mb-1"><b>Notes:</b></p>
                                            <ol class="pl-4 text-justify">
                                                <li> You must have a Current Platinum Listing to register as a Pin Up.</li>
                                                <li> If the date period you have selected is not available, and your
                                                    Current Listing period
                                                    exceeds the requested period, you will be added to the pool.</li>
                                                <li> If a position becomes available from the pool, you will be
                                                    automatically listed. If
                                                    your Listed Profile has been Suspended or Cancelled, the Pin Up
                                                    listing will also
                                                    cancel.</li>
                                            </ol>
                                        </div>
                                    </div> -->
                                    <div class="form-group row custom-pin-button">
                                        <div class="col-sm-12 text-right">
                                            <button type="submit" class="btn-success-modal"
                                                id="savePinupButton">Proceed to Payment</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@prepend('script')
<script>
    let escort_tour_id = $("#escort_tour_id");
    let checoutForm = escort_tour_id.parents('form');
    let button = checoutForm.find('button');
    button.prop('disabled', true);
    escort_tour_id.on('change', function() {
        let id = $(this).val();
        (!id) ? button.prop('disabled', true): button.prop('disabled', false);
        let url = `{{ route('account.checkout_tour', ['type' => 'tour', 'id' => '_ID']) }}`;
        url = url.replace('_ID', id);
        checoutForm.attr('action', url);
    });
</script>
@endprepend