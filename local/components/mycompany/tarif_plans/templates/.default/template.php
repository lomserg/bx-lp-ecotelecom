<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>
<?php
use Bitrix\Main\Page\Asset;
Asset::getInstance()->addJs($templateFolder . "/channels.js");
?>

<h2 id="tarif_block" class="section-title fs-600">Выберите свой тариф</h2>
<div class="tab-box">
  <button class="tab_btn active" data-category="internet-tv">Интернет и ТВ</button>
  <button class="tab_btn" data-category="internet">Интернет</button>


</div>
<div class="tarifs-slider-container">
  <div class="swiper tarifs-slider-internet">
    <div class="swiper-wrapper">
<?php foreach($arResult["TARIFS"] as $tarif): ?>
  <div data-category="<?= $tarif["category"]; ?>" class="tarif-item swiper-slide">
    <h3 class="tarif-title"><?= $tarif["name"] ?></h3>
    <p class="tarif__description"><?= $tarif["description"] ?></p>
    <ul class="tarif__features">
      <li class="tarif__params"><p><?= $tarif["speed"] ?>&nbsp;</p><span>Мбит/сек</span></li>
      <li class="tarif__params tarif__channels"
          data-package="<?= $tarif["dataPackage"] ?>"><p>
          <?= $tarif["channels"] ?>&nbsp;</p><span>ТВ-каналов</span>

      </li>
        <?php if($tarif["dataPackage"] === 'ntv_light') : ?>
          <p><?= $tarif["description2"] ?></p>
        <?php endif; ?>
      <?php if($tarif["movie"]): ?>
      <li class="tarif__params">
       <?=  $tarif["movie"] ?>&nbsp;
      </li>
      <?php endif; ?>
    </ul>
    <p class="tarif__price"><?= $tarif["price"] ?> <span>₽/мес</span></p>
    <button class="tarif-button tarif__btn-green">ПОДКЛЮЧИТЬ</button>
  </div>
<?php endforeach; ?>

    </div>

    <!-- Пагинация внутри слайдера -->
    <div class="swiper-pagination"></div>
  </div>

  <!-- Кнопки навигации ВНЕ слайдера -->
  <div class="swiper-button-prev tarif-custom-prev">
  </div>
  <div class="swiper-button-next tarif-custom-next">
  </div>
</div>
<div id="channelsModal" class="modal-bitix" style="display:none;">
  <div class="modal-content-bitix">
    <span class="modal-close-bitix">&times;</span>
    <h3>Список каналов</h3>
    <ul id="channelsList"></ul>
  </div>
</div>

