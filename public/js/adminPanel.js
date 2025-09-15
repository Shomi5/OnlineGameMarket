document.addEventListener("DOMContentLoaded", function () {
    const popup = document.getElementById(`popupDodajKljuceve`);
    const openBtn = document.getElementById(`viseKljuceva`);
    // const closeBtn = document.getElementById(`closePopup`);

    openBtn.addEventListener("click", () => {
        console.log("Usao je u klik")
        if (!popup.classList.contains("show")) {
            popup.classList.add("show");
        }
    });

    window.addEventListener("click", (e) => {
        if (e.target === popup) {
            popup.classList.remove("show");
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const popup = document.getElementById("porukePopUp");

    if (popup) {
        window.addEventListener("click", function (e) {
            if (e.target === popup) {
                popup.classList.remove("show");
            }
        });
    }
});


document.addEventListener("DOMContentLoaded", function () {
    const popup = document.getElementById("porukeUspehPopUp");

    if (popup) {
        window.addEventListener("click", function (e) {
            if (e.target === popup) {
                popup.classList.remove("show");
            }
        });
    }
});