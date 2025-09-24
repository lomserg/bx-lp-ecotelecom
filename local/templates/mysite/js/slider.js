document.addEventListener("DOMContentLoaded", () => {
  const tabs = document.querySelectorAll(".tab_btn");
  const allSwipers = [];

  function initSwiperIfReady(container) {
    // ждем, пока слайды появятся и контейнер видим
    if (container.offsetParent === null || container.querySelectorAll('.swiper-slide').length === 0) {
      setTimeout(() => initSwiperIfReady(container), 50);
      return;
    }

    const swiper = new Swiper(container, {
      loop: false,
      grabCursor: true,
      spaceBetween: 20,
      pagination: {
        el: container.querySelector('.swiper-pagination'),
        clickable: true
      },
      navigation: {
        nextEl: '.tarif-custom-next',
        prevEl: '.tarif-custom-prev',
      },
      breakpoints: {
        0: { slidesPerView: 1 },
        550: { slidesPerView: 1.3 },
        768: { slidesPerView: 2.6 },
        991: { slidesPerView: 3 }
      }
    });

    allSwipers.push(swiper);
    return swiper;
  }

  // Инициализация всех слайдеров
  const sliders = document.querySelectorAll('.tarifs__section .swiper');
  sliders.forEach(container => initSwiperIfReady(container));

  // Функция показа карточек по категории
  function showCategory(category) {
    const cards = document.querySelectorAll('.tarif-item');
    cards.forEach(card => {
      card.style.display = (card.getAttribute("data-category") === category) ? "block" : "none";
    });

    // Обновляем только видимые слайдеры
    setTimeout(() => {
      allSwipers.forEach(sw => {
        if (sw.el.offsetParent !== null) sw.update();
      });
    }, 50);
  }

  // Переключение табов
  tabs.forEach(tab => {
    tab.addEventListener("click", () => {
      tabs.forEach(t => t.classList.remove("active"));
      tab.classList.add("active");

      const category = tab.getAttribute("data-category");
      showCategory(category);
    });
  });

  // Показываем по умолчанию первую категорию
  showCategory("internet-tv");
});