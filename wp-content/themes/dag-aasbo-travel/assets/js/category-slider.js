document.addEventListener('DOMContentLoaded', function () {
  new Swiper('.category-swiper', {
    slidesPerView: 4,
    slidesPerGroup: 1,
    spaceBetween: 20,
    loop: false,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    breakpoints: {
      0: { slidesPerView: 1.2 },
      576: { slidesPerView: 2 },
      768: { slidesPerView: 3 },
      992: { slidesPerView: 4 }
    }
  });
});
