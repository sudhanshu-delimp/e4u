<!-- Footer -->
<footer class="custom-app-footer">
    <div class="container-fluid">
        <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between">
            <div class="copyright-text text-center text-sm-left my-1">
                <span>Copyright &copy; {{ date('Y') }} <strong>{{ config('app.name', 'Your Website') }}</strong>. All Rights Reserved.</span>
            </div>
        </div>
    </div>
</footer>
<!-- End of Footer -->

<!-- Go to Top Circle Button (Footer ke bahar, Only Icon) -->
<a href="#page-top" id="goToTopBtn" class="go-top-circle" aria-label="Go to Top">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="18 15 12 9 6 15"></polyline>
    </svg>
</a>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const goToTopBtn = document.getElementById('goToTopBtn');
        if (!goToTopBtn) return;

        let activeScroller = window;

        // Scroll par button show/hide karna (window aur wrapper dono ke liye)
        document.addEventListener('scroll', function (e) {
            const target = e.target;
            let scrollTop = 0;

            if (target === document || target === document.documentElement || target === document.body) {
                scrollTop = window.scrollY || document.documentElement.scrollTop || document.body.scrollTop || 0;
                activeScroller = window;
            } else if (target instanceof Element && target.clientHeight >= window.innerHeight * 0.5) {
                scrollTop = target.scrollTop;
                activeScroller = target;
            } else {
                return;
            }

            if (scrollTop > 100) {
                goToTopBtn.classList.add('show');
            } else {
                goToTopBtn.classList.remove('show');
            }
        }, true);

        // Click par smooth scroll to top
        goToTopBtn.addEventListener('click', function (e) {
            e.preventDefault();
            if (activeScroller === window) {
                window.scrollTo({ top: 0, behavior: 'smooth' });
                document.documentElement.scrollTo({ top: 0, behavior: 'smooth' });
                document.body.scrollTo({ top: 0, behavior: 'smooth' });
            } else {
                activeScroller.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });
    });
</script>