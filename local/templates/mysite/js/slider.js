const allSwipers = []; // массив для хранения всех инстансов

function initSwiperIfReady(container) {
  if (container.querySelectorAll('.swiper-slide').length === 0) {
    setTimeout(() => initSwiperIfReady(container), 50);
    return;
  }

  try {
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
        0: { slidesPerView: 1.15 },
        550: { slidesPerView: 1.3 },
        768: { slidesPerView: 2.6 },
        991: { slidesPerView: 3 }
      }
    });

    allSwipers.push(swiper); // сохраняем в массив
    console.log(`Swiper инициализирован для: ${container.className}`);
    return swiper;
  } catch (error) {
    console.error('Ошибка инициализации Swiper:', error);
  }
}

document.addEventListener("DOMContentLoaded", () => {
  console.log('DOM загружен, инициализирую слайдеры...');

  const sliders = document.querySelectorAll('.tarifs__section .swiper');
  console.log(`Найдено слайдеров: ${sliders.length}`);

  sliders.forEach((container, index) => {
    console.log(`Инициализирую слайдер ${index + 1}:`, container.className);
    initSwiperIfReady(container);
  });

  // 👉 слушаем переключение табов
  document.querySelectorAll(".tab_btn").forEach(tab => {
    tab.addEventListener("click", () => {
      // задержка нужна, чтобы DOM успел перерисоваться
      setTimeout(() => {
        allSwipers.forEach(sw => sw.update());
      }, 100);
    });
  });
});