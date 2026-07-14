const lightbox = GLightbox({
    touchNavigation: true,
    loop: true,
    width: "90vw",
    height: "90vh"
});
document.querySelectorAll('.hover-overlay').forEach(function(overlay) {
    overlay.addEventListener('click', function() {
        this.parentElement.querySelector('.glightbox').click();
    });
});