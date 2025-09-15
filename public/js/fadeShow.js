document.addEventListener("DOMContentLoaded", function () {
    const jumbotrons = document.querySelectorAll(".jumbo-div");

    const observer = new IntersectionObserver(
        (entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("jumbo-visible");
                    observer.unobserve(entry.target); // Prestaje posmatranje nakon prvog prikazivanja
                }
            });
        },
        { threshold: 0.2 } // Element je vidljiv kada je 20% u viewport-u
    );

    jumbotrons.forEach((jumbo) => observer.observe(jumbo));
});

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("mojElement").scrollIntoView({
        behavior: "smooth",
        block: "start",
    });
});


