const swiper = new Swiper(".swiper", {
    slidesPerView: 1, // možeš staviti 2 ili 3 ako želiš više kartica odjednom
    spaceBetween: 20,
    grabCursor:true,

    //   loop: true,
    watchOverflow: true,

    // Navigacija
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },

    // Paginacija
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets:true
    },
});
