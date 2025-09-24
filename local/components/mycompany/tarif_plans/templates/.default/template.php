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
    <button
            class="tarif-button tarif__btn-green"
            data-tarif-name="<?= $tarif["name"] ?>"
            data-tarif-price="<?= $tarif["price"] ?>"
            data-tarif-speed="<?= $tarif["speed"] ?>"
            data-tarif-channels="<?= $tarif["channels"] ?>"
    >
      ПОДКЛЮЧИТЬ
    </button>
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
<div class="popup popup_tarif" id="tarifPopup">
  <div class="popup__overlay"></div>
  <div class="popup__container ">
    <div class="popup__content">
      <a href="" class="popup__close">×</a>
      <h2 style="margin: 2rem; text-align: center;">Заявка на подключение</h2>
        <?php
        $APPLICATION->IncludeComponent(
            "bitrix:form.result.new",
            "request_form", // твой шаблон формы
            array(
                "WEB_FORM_ID" => "1",
                "AJAX_MODE" => "Y",
                "AJAX_OPTION_SHADOW" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
            ),
            false
        );
        ?>
    </div>
  </div>
</div>
<script>

        (function () {
        // helper: ждать появления элемента в DOM
        function waitForElement(selector, timeout = 5000) {
            return new Promise((resolve, reject) => {
                const el = document.querySelector(selector);
                if (el) return resolve(el);

                const start = Date.now();
                const interval = setInterval(() => {
                    const found = document.querySelector(selector);
                    if (found) {
                        clearInterval(interval);
                        return resolve(found);
                    }
                    if (Date.now() - start > timeout) {
                        clearInterval(interval);
                        return reject(new Error('timeout'));
                    }
                }, 50);
            });
        }

        // безопасно получить инпут по ряду селекторов (class, name и т.д.)
        function findInput(popupEl, selectors) {
        for (const sel of selectors) {
        const found = popupEl.querySelector(sel) || document.querySelector(sel);
        if (found) return found;
    }
        return null;
    }

        document.addEventListener('DOMContentLoaded', () => {
        waitForElement('#tarifPopup', 4000).then(popup => {
        // нашли popup
        const overlay = popup.querySelector('.popup__overlay');
        const closeBtn = popup.querySelector('.popup__close');

        // селекторы для скрытых полей: сначала по классам, потом по имени (form_hidden_N)
        const hiddenNameSelectors  = ['.selected_hidden_ultra_power', 'input[name="form_hidden_7"]', 'input[name="form_hidden_7[]"]'];
        const hiddenPriceSelectors = ['.monthly_pay', 'input[name="form_hidden_8"]'];
        const hiddenSpeedSelectors = ['.equipment_pay', 'input[name="form_hidden_9"]'];
        const hiddenChanSelectors  = ['.final_pay', 'input[name="form_hidden_10"]'];

        // делегируем клик на документ — устойчиво к порядку загрузки элементов
        document.addEventListener('click', function (e) {
        const btn = e.target.closest('.tarif-button');
        if (!btn) return;

        e.preventDefault();

        const nameInput  = findInput(popup, hiddenNameSelectors);
        const priceInput = findInput(popup, hiddenPriceSelectors);
        const speedInput = findInput(popup, hiddenSpeedSelectors);
        const chanInput  = findInput(popup, hiddenChanSelectors);

        if (nameInput)  nameInput.value  = btn.dataset.tarifName  || '';
        else console.warn('Не найден инпут для имени тарифа (form_hidden_7 / .selected_hidden_ultra_power).');

        if (priceInput) priceInput.value = btn.dataset.tarifPrice || '';
        else console.warn('Не найден инпут для цены (form_hidden_8 / .monthly_pay).');

        if (speedInput) speedInput.value = btn.dataset.tarifSpeed || '';
        else console.warn('Не найден инпут для скорости (form_hidden_9 / .equipment_pay).');

        if (chanInput)  chanInput.value  = btn.dataset.tarifChannels || '';
        else console.warn('Не найден инпут для каналов (form_hidden_10 / .final_pay).');

        // открыть попап
        popup.classList.add('popup_is-active');
        document.body.classList.add('modal-open');

        // опционально — фокус в первое текстовое поле формы если нужно:
        const firstInput = popup.querySelector('input[type="text"], input[type="tel"], textarea');
        if (firstInput) firstInput.focus();
    });

        // закрытие (overlay и крестик)
        [overlay, closeBtn].forEach(node => {
        if (!node) return;
        node.addEventListener('click', (ev) => {
        ev.preventDefault();
        popup.classList.remove('popup_is-active');
        document.body.classList.remove('modal-open');
    });
    });

        // Esc закрытие
        document.addEventListener('keydown', (ev) => {
        if (ev.key === 'Escape' && popup.classList.contains('popup_is-active')) {
        popup.classList.remove('popup_is-active');
        document.body.classList.remove('modal-open');
    }
    });

    }).catch(() => {
        console.warn('Попап #tarifPopup не найден в DOM — убедитесь, что блок вставлен на страницу.');
    });
    });
    })();
</script>

