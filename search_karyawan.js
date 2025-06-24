$(document).ready(function () {
    $('#search_input').keypress(function (e) {
        if (e.which === 13) {
            e.preventDefault(); 
            let keyword = $(this).val().trim();
            if (keyword !== "") {

                window.location.href = "?search=" + encodeURIComponent(keyword);
            }
        }
    });
});