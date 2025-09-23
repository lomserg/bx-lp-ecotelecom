<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<div class="tariffs">
  <!-- Кнопки фильтра по разделам -->
  <div class="tariffs__filter">
      <?foreach ($arResult['SECTIONS'] as $section):?>
        <button class="tariffs__filter-btn" data-section="<?=$section['ID']?>">
            <?=$section['NAME']?>
        </button>
      <?endforeach;?>
  </div>

  <!-- Списки тарифов -->
    <?foreach ($arResult['SECTIONS'] as $section):?>
      <div class="tariffs__list" data-section="<?=$section['ID']?>" style="display:none;">
          <?if (!empty($arResult['TARIFFS'][$section['ID']])):?>
              <?foreach ($arResult['TARIFFS'][$section['ID']] as $tarif):?>
              <div class="tarif-card">
                  <?if ($tarif['PROPERTY_PROMO_TEXT_VALUE']):?>
                    <div class="tarif-promo"><?=$tarif['PROPERTY_PROMO_TEXT_VALUE']?></div>
                  <?endif;?>

                <div class="tarif-header">
                    <?if ($tarif['PREVIEW_PICTURE']):?>
                      <div class="tarif-img">
                        <img src="<?=$tarif['PREVIEW_PICTURE']?>" alt="<?=$tarif['NAME']?>">
                      </div>
                    <?endif;?>
                  <h3 class="tarif-title"><?=$tarif['NAME']?></h3>
                </div>

                <div class="tarif-body">
                    <?if ($tarif['PROPERTY_SPEED_VALUE']):?>
                      <div class="tarif-speed">Скорость: <?=$tarif['PROPERTY_SPEED_VALUE']?> Мбит/с</div>
                    <?endif;?>

                    <?if ($tarif['PROPERTY_TV_COUNT_VALUE']):?>
                      <div class="tarif-tv">ТВ каналов: <?=$tarif['PROPERTY_TV_COUNT_VALUE']?></div>
                    <?endif;?>

                    <?if ($tarif['PROPERTY_ONLINE_CINEMA_BOLD_VALUE'] || $tarif['PROPERTY_ONLINE_CINEMA_SIMPLE_VALUE']):?>
                      <div class="tarif-cinema">
                          <?if($tarif['PROPERTY_ONLINE_CINEMA_BOLD_VALUE']):?>
                            <span><?=$tarif['PROPERTY_ONLINE_CINEMA_BOLD_VALUE']?></span>
                            <span><?=$tarif['PROPERTY_ONLINE_CINEMA_SIMPLE_VALUE']?></span>
                          <?else:?>
                            <span><?=$tarif['PROPERTY_ONLINE_CINEMA_SIMPLE_VALUE']?></span>
                          <?endif?>
                      </div>
                    <?endif;?>

                    <?if ($tarif['PROPERTY_PRICE_DISCOUNT_VALUE']):?>
                      <div class="tarif-price">
                          <?=$tarif['PROPERTY_PRICE_DISCOUNT_VALUE']?> ₽/мес
                        <span class="tarif-price-before"><?=$tarif['PROPERTY_PRICE_VALUE']?> ₽/мес</span>
                      </div>
                    <?elseif ($tarif['PROPERTY_PRICE_VALUE']):?>
                      <div class="tarif-price"><?=$tarif['PROPERTY_PRICE_VALUE']?> ₽/мес</div>
                    <?endif;?>
                </div>

                <div class="tarif-footer">
                  <a href="<?=$tarif['DETAIL_PAGE_URL']?>" class="tarif-btn">Подключить</a>
                </div>
              </div>
              <?endforeach;?>
          <?else:?>
            <p>Нет тарифов в этом разделе</p>
          <?endif;?>
      </div>
    <?endforeach;?>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const buttons = document.querySelectorAll(".tariffs__filter-btn");
        const lists = document.querySelectorAll(".tariffs__list");

        buttons.forEach(btn => {
            btn.addEventListener("click", () => {
                buttons.forEach(b => b.classList.remove("active"));
                btn.classList.add("active");
                const id = btn.dataset.section;
                lists.forEach(list => {
                    list.style.display = (list.dataset.section === id) ? "grid" : "none";
                });
            });
        });

        // включаем первый раздел по умолчанию
        if (buttons[0]) buttons[0].click();
    });
</script>
