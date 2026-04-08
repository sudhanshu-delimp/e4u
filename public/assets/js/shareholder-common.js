$(document).ready(function() {
    $('#pdfTabs .nav-link').click(function() {
        var pdfFile = $(this).data('pdf');
        var pdfTitle = $(this).data('title');

        // Active tab change
        $('#pdfTabs .nav-link').removeClass('active');
        $(this).addClass('active');

        // Change PDF and title
        $('#pdfViewer').attr('src', pdfFile);
        $('#pdfTitle').text(pdfTitle);
    });

    const searchInput = document.querySelector("#searchForm input[name='search']");
    const pdfList = document.querySelectorAll("#pdfList li");
    const message = document.getElementById("message")

    searchInput.addEventListener("input", function() {
        const searchTerm = this.value.toLowerCase();
        let found = false;
        pdfList.forEach(function(li) {
            const title = li.querySelector("a").textContent.toLowerCase();
            if (title.includes(searchTerm)) {
                li.style.display = "";
                found = true;
            } else {
                li.style.display = "none";
            }
        })

        if (!found) {
            message.textContent = "No Data Found!";
            message.style.color = "red";
            message.classList = "text-center font-weight-bold"
        } else {
            message.textContent = "";
        }
    });
});