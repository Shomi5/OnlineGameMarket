document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".klik");

    buttons.forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();

            const id = this.getAttribute("id");

            const popup = document.getElementById(`element-${id}`);
            if (!popup.classList.contains("show")) {
                popup.classList.add("show");
            }

            window.addEventListener("click", (e) => {
                if (e.target === popup) {
                    popup.classList.remove("show");
                }
            });
        });
    });
});
