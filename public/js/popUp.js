document.addEventListener("DOMContentLoaded", function () {
    const popup = document.getElementById("popupOverlay");

    if (popup) {
        window.addEventListener("click", function (e) {
            if (e.target === popup) {
                popup.classList.remove("show");
            }
        });
    }
});
