$(() => {
    $('#cItem_0').addClass('active');
        $('#pageItem_0').addClass('active');
        $("body").on('click','.page-link', function(e){
            e.preventDefault();
            var id = $(this).attr('data-slide-to');
            $('.page-item').removeClass('active');
            $('#pageItem_'+id).addClass('active');
            if(id == 0) {
                $(".preview").addClass('leftLst over');
            } else {
                $(".preview").removeClass('leftLst over');
            }
            if(id == 2) {
                $(".nextOne").addClass('leftLst over');
            } else {
                $(".nextOne").removeClass('leftLst over');
            }
        });

        $("body").on('click','.preview', function(e){
            e.preventDefault();
            var carouselEl = $(".carousel-inner").carousel('prev');
            var carouselItems = carouselEl.find('.carousel-item');
            var id = carouselItems.siblings('.active').index();
            if(id == 0) {
                $(".preview").addClass('leftLst over');
            } else {
                $(".preview").removeClass('leftLst over');
            }
            $('#pageItem_'+id).addClass(' active');
        });

        $("body").on('click','.nextOne', function(e){
            e.preventDefault();
            var carouselEl = $(".carousel-inner").carousel('next');
            var carouselItems = carouselEl.find('.carousel-item');
            var id = carouselItems.siblings('.active').index();
            if(id == 2) {
            $(".nextOne").addClass('leftLst over');
            } else {
            $(".nextOne").removeClass('leftLst over');
            }
            var clm = $(".carousel-inner").carousel('pause');
            $('#pageItem_'+id).addClass(' active');
        });

        $('body').on('click','.deleteimg', function () {
        var id = $(this).data('id');
        $('#deleteId').val(id);
        var msg = "Delete";
        $('.img_comman_msg').text(msg);
        $("#delete_img").modal('show');
        $('#dImg').click(function () {
                $.ajax({
                type: "POST",
                url:`/escort-dashboard/delete-photos/${id}`,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if(data.error == true) {
                        $("#delete_img").modal('hide');
                        $("#dm_"+id).remove();
                    } else {
                        var msg = "Sumthing wrong...";
                        $('.img_comman_msg').text(msg);

                    }
                },
                error: function (data) {
                    var errors = $.parseJSON(data.responseText);
                    swal.fire('', "<p>"+errors.message+"</p>", 'error');
                    $('#comman_modal').on('hidden.bs.modal', function () {
                        location.reload();
                    });
                }
            });
        });
   });
});