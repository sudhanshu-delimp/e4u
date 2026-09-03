

$(function () {
    const mmRoot = $('#manage-route');
    const endpoint = {
        csrf_token: mmRoot.data('csrf-token'),
        success_image: mmRoot.data('success-image'),
        error_image: mmRoot.data('error-image'),
        advertiser_fees_summery: mmRoot.data('advertiser-fees-summery'),
        agent_fees_summary : mmRoot.data('agent-fees-summary'),
        single_advertiser_summary : mmRoot.data('single-advertiser-summary'),
    };



    let isHidden = false;
    $('#hideAlltr').on('click', function () {
        const $chevron = $(this).find('i');
        if (!isHidden) {
            // Hide only visible rows, and mark them
            $('#hideAlltr').nextAll('tr:visible').addClass('user-hidden').hide();
            $chevron.removeClass('fa-chevron-down').addClass('fa-chevron-up');
            isHidden = true;
        } else {
            // Show only those rows that were hidden by this action
            $('tr.user-hidden').removeClass('user-hidden').show();
            $chevron.removeClass('fa-chevron-up').addClass('fa-chevron-down');
            isHidden = false;
        }
    });


    $('.collapse-row').hide(); // 🔒 Hide all groups initially
    function toggleHideAndShow(){
            $('[data-toggle="toggle-row"]').on('click', function () {
                const targetClass = $(this).data('target');
                const $icon = $(this).find('i.fa');
                const isVisible = $(targetClass).is(':visible');
                $('.collapse-row').not(targetClass).hide();
                $('[data-toggle="toggle-row"] i.fa').removeClass('fa-chevron-up').addClass(
                    'fa-chevron-down');
                if (!isVisible) {
                    $(targetClass).show();
                    $icon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
                } else {
                    $(targetClass).hide();
                }
            });
    }
    toggleHideAndShow();


    // Alert Helper function
    function showAlert(type, message) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: type,
                //title: type === 'success' ? 'Success!' : type === 'error' ? 'Error!' : 'Warning!',
                text: message,
                timer: 2500,
                showConfirmButton: false
            });
        } else {
            alert(message);
        }
    }


$(document).on('click', '.view-advertiser-report', function (event) {

    event.preventDefault();

    const $button = $(this);
    const advertiserType = String($button.data('advertiser-type') || '').toUpperCase();
    const modalId = advertiserType === 'E' ? '#commission-report' : '#message-report';
    const target = advertiserType === 'E' ? '#appendSingleEscort' : '#appendSingleMassage';

    $.ajax({
        url: endpoint.single_advertiser_summary,
        type: 'GET',
        data: {
            advertiser_id: $button.data('advertiser-id'),
            type: advertiserType
        },
        headers: {
            'X-CSRF-TOKEN': endpoint.csrf_token
        },
        beforeSend: function () {
            $(target).html('<div class="modal-body text-center">Loading...</div>');
        },
        success: function (response) {
            $(target).html(response.data.html);
            $(modalId).modal('show');

            $('.collapse-row').hide();
            toggleHideAndShow(); // js init
 
        },
        error: function (xhr) {
            $(target).html('');
            $(modalId).modal('hide');
            showAlert('error', xhr.responseJSON?.message || 'Unable to load advertiser report.');
        }
    });
});


$(document).on('change', '#display_type, #select-fy', function(){
    let fy = $('#select-fy').val();
    let displayType = $('#display_type').val();
    window.location.href =  `${endpoint.agent_fees_summary}?fee_summery_advertiser_fy=${encodeURIComponent(fy)}&display_type=${encodeURIComponent(displayType)}`;
});


});


