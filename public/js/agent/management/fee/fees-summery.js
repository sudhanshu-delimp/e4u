
$(function () {


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

});


