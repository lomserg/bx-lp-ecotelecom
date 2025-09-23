<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->addExternalCSS($this->GetFolder().'/style.css');
?>

  <div class="tv-list">
      <?php foreach ($arResult["ITEMS"] as $arItem): ?>
        <div class="tv-item">
          <h3 class="tv-title"><?= $arItem["FIELDS"]["NAME"] ?></h3>

            <?php if ($arItem["FIELDS"]["PREVIEW_PICTURE"]): ?>
              <div class="tv-image">
                <img src="<?= $arItem["FIELDS"]["PREVIEW_PICTURE"]["SRC"] ?>"
                     alt="<?= $arItem["FIELDS"]["NAME"] ?>"
                     width="200">
              </div>
            <?php endif; ?>

            <?php if ($arItem["FIELDS"]["PREVIEW_TEXT"]): ?>
              <div class="tv-description">
                  <?= $arItem["FIELDS"]["PREVIEW_TEXT"] ?>
              </div>
            <?php endif; ?>

          <div class="tv-properties">
            <div class="tv-price">
              <strong>Цена:</strong>
                <?= !empty($arItem["PROPERTIES"]["PRICE"]["VALUE"]) ? $arItem["PROPERTIES"]["PRICE"]["VALUE"] . " руб." : "не указана" ?>
            </div>

            <div class="tv-type">
              <strong>Тип TV:</strong>
                <?= !empty($arItem["PROPERTIES"]["TYPE_TV"]["VALUE"]) ? $arItem["PROPERTIES"]["TYPE_TV"]["VALUE"] : "не указан" ?>
            </div>

            <div class="tv-channels">
              <strong>Каналы:</strong>
                <?= !empty($arItem["PROPERTIES"]["CHANNELS"]["VALUE"]) ? $arItem["PROPERTIES"]["CHANNELS"]["VALUE"] : "не указаны" ?>
            </div>

            <div class="tv-cinemas">
              <strong>Кинотеатры:</strong>
                <?= !empty($arItem["PROPERTIES"]["CINEMAS"]["VALUE"]) ? $arItem["PROPERTIES"]["CINEMAS"]["VALUE"] : "не указаны" ?>
            </div>

            <div class="tv-tariff">
              <strong>Тип тарифа:</strong>
                <?= !empty($arItem["PROPERTIES"]["TYPE_TARIF"]["VALUE"]) ? $arItem["PROPERTIES"]["TYPE_TARIF"]["VALUE"] : "не указан" ?>
            </div>
          </div>

            <?php if ($arItem["FIELDS"]["DETAIL_PAGE_URL"]): ?>
              <a href="<?= $arItem["FIELDS"]["DETAIL_PAGE_URL"] ?>" class="tv-link">
                Подробнее
              </a>
            <?php endif; ?>
        </div>
      <?php endforeach; ?>
  </div>

<?php if (empty($arResult["ITEMS"])): ?>
  <div class="tv-empty">Телевизоры не найдены</div>
<?php endif; ?>