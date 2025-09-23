<!--<div class="tariff-list">
    <?php /*foreach ($arResult['TARIFFS'] as $tariff): */?>
      <div class="tariff-item">
        <h3><?php /*= $tariff['NAME'] */?></h3>
        <p>Цена: <?php /*= $tariff['PROPERTY_PRICE_VALUE'] */?> ₽</p>
        <a href="/lp/sp/tarif-detail.php?ELEMENT_CODE=<?php /*= $tariff['CODE'] */?>">Подробнее</a>
      </div>
    <?php /*endforeach; */?>
</div>-->

<?php
use Bitrix\Main\Page\Asset;
// Подключаем CSS Swiper
Asset::getInstance()->addCss('https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css');
// Подключаем JS Swiper
Asset::getInstance()->addJs('https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js');
Asset::getInstance()->addCss($templateFolder . "/style.css");
?>
<section class="tarifs-section">
  <h2 class="section-title">Тарифы</h2>
  <div class="swiper tarifs-swiper">
    <div class="swiper-wrapper">
        <?php foreach ($arResult['TARIFFS'] as $tariff): ?>
          <div class="swiper-slide">
            <div class="tarif-card">
              <div class="tarif_wrapper">
                <h3 class="tarif-name"><?= $tariff['NAME'] ?></h3>
                <p class="tarif-description"><?= $tariff['DESCRIPTION'] ?></p>
                <p class="tarif-price"><?= $tariff['PRICE'] ?> <span>₽/мес</span></p>
                <button class="tarif-button">ПОДКЛЮЧИТЬ</button>
              </div>
              <ul class="tarif-params-wrapper">
                <li class="tarif-params"><?= $tariff['SPEED'] ?> <span>Мбит/сек</span></li>
                  <?php if ($tariff['TYPE'] === 'internet_tv'): ?>
                    <li class="tarif-params"><?= $tariff['CHANNELS'] ?> <span>каналов</span></li>

                    <li class="tarif-params">
                        <?php foreach ($tariff["CINEMAS"] as $CINEMA) : ?>
                       <span><?=$CINEMA?></span>
                      <?php endforeach;?>
                    </li>
                  <?php endif; ?>
              </ul>
            </div>
          </div>
        <?php endforeach; ?>
    </div>

    <!-- Навигация -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-pagination"></div>
  </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.tarifs-swiper', {
            loop: false,
            grabCursor: true,
            // cssMode: true,
            //allowTouchMove: true,
            //  freeMode: true,
            noSwiping: false,
            spaceBetween: 20,
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            breakpoints: {
                0: {
                    slidesPerView: 1.15,
                },
                550: {
                    slidesPerView: 1.9,
                },
                768: {
                    slidesPerView: 3,
                },
                991: {
                    slidesPerView: 3,
                },
            }
        });
    });
</script>