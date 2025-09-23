<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); // подключаем шапку шаблона
$APPLICATION->SetTitle("Главная страница"); // заголовок страницы
?>


  <section class="hero__bg">

    <div class="hero__bg-container container">
      <div class="hero-txt-cta">
        <h1 class="hero__title">ЗАПАС ИНТЕРНЕТА</h1>
        <h3 class="hero__title-second">
          месяц в подарок по промокоду САМОКАТ
        </h3>
        <a href="#tarif_block" class="button-63">Подробнее</a>
        <div class="info-blocks">
          <div class="info-block">
            <div class="info-block-feature fs-300 uppercase fw-bold">300</div>
            <div class="info-block-text">Мбит/с</div>
          </div>
          <div class="info-block">
            <div class="info-block-feature fs-300 uppercase fw-bold">70</div>
            <div class="info-block-text">каналов</div>
          </div>
          <!-- <div class="info-block img">
            <img src="./img/logo_Premier_w.png" alt="" />
             <img src="./img/logo_start.svg" alt="" />
                  <img src="./img/Amediateka_full_white.png" alt="" />
          </div>-->
          <div class="info-block">
            <div class="info-block-feature fs-300 uppercase fw-bold">500</div>
            <div class="info-block-text">₽/мес</div>
          </div>
        </div>
      </div>
      <div class="hero-img">
        <div class="anim-1"></div>
        <div class="anim-2"></div>

        <img src="<?= SITE_TEMPLATE_PATH ?>/img/zapas4.png" alt=""/>
      </div>
    </div>

    <!--
    <div class="hero__img">
      <img src="<?= SITE_TEMPLATE_PATH ?>/img/9PIrNJFKZR.png" alt="Hero" />
    </div>
    -->


  </section>


  <section class="tarifs__section " id="tarifs__section">

      <?
      $APPLICATION->IncludeComponent(
          "mycompany:tarif_plans",
          "",
          array(
              "TV_ONLY" => false
          )
      ); ?>
    <!-- В компоненте каждая карточка <div class="swiper-slide"> -->


  </section>
  <section class="container">
    <h2 class="section-title">Интерактивное ТВ</h2>
    <div class="advantages-tv-container container">
      <div class="advantages-tv-card">
        <h3>Управление эфиром</h3>
        <p>
          Пропустили игру? Смотрите, как это было: голы, повторы, ключевые эпизоды матчей
        </p>
        <img src="<?= SITE_TEMPLATE_PATH ?>/img/do_5_ustroystv_.png" alt=""/>
      </div>

      <div class="advantages-tv-card">
        <div><h3 style="width: 89%;
    margin-bottom: 1rem;">Онлайн-кинотеатры в одном месте</h3>
          <p>Подписки на Amediateka, START, Premier, viju</p></div>
        <img src="<?= SITE_TEMPLATE_PATH ?>/img/ntv 1.png" alt=""/>
      </div>

      <div class="advantages-tv-card">
        <h3>Более 200 телеканалов</h3>
        <p>
          Спортивные, новостные, детские, познавательные, развлекательные, киноканалы и другие
        </p>
        <img src="<?= SITE_TEMPLATE_PATH ?>/img/chanels.png" alt=""/>
      </div>

      <div class="advantages-tv-card">
        <h3>Смотри на разных устройствах</h3>
        <p>
          Дома, на даче, в дороге: Smart TV, смартфон, ноутбук, планшет, ПК.

        </p>
        <img src="<?= SITE_TEMPLATE_PATH ?>/img/optimal_entertainment.png" alt=""/>
      </div>
    </div>
  </section>

  <section class="advantage container">
    <h2 class="section-title">Преимущества</h2>
    <div class="advantage-container">
      <div class="advantage-card">
        <div class="advantage-card-wrapper">
          <h3>Тариф «всё в одном»</h3>

          <p>Три услуги по цене одной: интернет. интерактивное ТВ, онлайн-кинотеатр</p>

        </div>
        <img src="<?= SITE_TEMPLATE_PATH ?>/img/star-icon.png" alt=""/>
      </div>
      <div class="advantage-card" style="background-color: #6629DE">
        <div class="advantage-card-wrapper">
          <h3>Стабильный интернет</h3>
          <p>
            Всё летает на скорости до 500 Мбит/с: игры, видеосвязь , фильмы

          </p>
        </div>
        <img src="<?= SITE_TEMPLATE_PATH ?>/img/rocket-icon.png" alt=""/>
      </div>
      <div class="advantage-card"  style="background-color: #F0926C">
        <div class="advantage-card-wrapper">
          <h3>Отличная экономия</h3>
          <p>
            - 20% скидка при оплате на год


          </p> <p>

            - 15% скидка при оплате на полгода

          </p>
        </div>
        <img src="<?= SITE_TEMPLATE_PATH ?>/img/piggy-bank-icon.png" alt=""/>
      </div>
    </div>
  </section>
  <!----> <!--<p>Здесь будет ваш основной контент — преимущества, тарифы, интерактивное ТВ и т.д.</p>--> <?
//$APPLICATION->IncludeComponent(
//    "mycompany:advantages",
//    "",
//    []
//);?>
  <section class="container">

      <?
      $APPLICATION->IncludeComponent(
          "mycompany:faq.simple",
          "new_template",

      ); ?>
  </section>

  <section class="container" style="margin-bottom: 2rem">
    <h2 class="section-title">Заявка на подключение</h2>
      <?
      $APPLICATION->IncludeComponent(
          "bitrix:form.result.new",
          "request_form",
          array(
              "CACHE_TIME" => "3600",  // Время кеширования (сек.)
              "CACHE_TYPE" => "A", // Тип кеширования
              "CHAIN_ITEM_LINK" => "", // Ссылка на дополнительном пункте в навигационной цепочке
              "CHAIN_ITEM_TEXT" => "", // Название дополнительного пункта в навигационной цепочке
              "COMPOSITE_FRAME_MODE" => "A",   // Голосование шаблона компонента по умолчанию
              "COMPOSITE_FRAME_TYPE" => "AUTO",    // Содержимое компонента
              "EDIT_URL" => "",    // Страница редактирования результата
              "IGNORE_CUSTOM_TEMPLATE" => "N", // Игнорировать свой шаблон
              "LIST_URL" => "",    // Страница со списком результатов
              "SEF_MODE" => "N",   // Включить поддержку ЧПУ
              "SUCCESS_URL" => "", // Страница с сообщением об успешной отправке
              "USE_EXTENDED_ERRORS" => "Y",    // Использовать расширенный вывод сообщений об ошибках
              "VARIABLE_ALIASES" => array(
                  "RESULT_ID" => "RESULT_ID",
                  "WEB_FORM_ID" => "WEB_FORM_ID",
              ),
              "WEB_FORM_ID" => "1",    // ID веб-формы
              "AJAX_MODE" => "N",
              "AJAX_OPTION_SHADOW" => "N",
              "AJAX_OPTION_JUMP" => "N",
              "AJAX_OPTION_STYLE" => "Y",
              "AJAX_OPTION_HISTORY" => "N",
          ),
          false
      ); ?>

  </section>
<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); // подключаем подвал шаблона
?>