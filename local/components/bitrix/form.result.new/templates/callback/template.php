<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>

<?=$arResult["FORM_HEADER"]?>

<div class="popup popup_feedback new_abonent<?php if($arResult["isFormNote"] == "Y" || $_REQUEST['AJAX_CALL']=='Y'): ?> popup_is-active<?php endif; ?>">

  <div class="popup__overlay"></div>

  <div class="popup__container container">
    <div class="popup__content">

      <a href="" class="popup__close"></a>

        <?php if($arResult["isFormNote"] == "Y" || $_REQUEST['AJAX_CALL']=='Y'): ?>
          <div class="popup__title">
              <?=$arResult["FORM_NOTE"]?>
          </div>
          <script type="text/javascript">initPopups();</script>
        <?php else: ?>

          <form id="<?=$arResult['arForm']['SID']?>" action="<?=$APPLICATION->GetCurPage()?>" method="POST" enctype="multipart/form-data" onsubmit="dis(); yaCounter27260183.reachGoal('form_submit'); return true;">

            <div class="popup__title">Форма обратной связи</div>

            <div class="popup__wrapper">

              <div class="popup__wrap">

                <div class="form__input-wrap">
                  <input class="form__input input input_theme_grey-line input_fio" type="text" name="form_text_1" placeholder="ФИО*" required>
                  <div class="form__input-error"><p>ошибка</p></div>
                </div>

                <div class="form__input-wrap">
                  <input class="form__input input input_theme_grey-line input_phone" type="text" name="form_text_2" placeholder="Телефон*" required>
                  <div class="form__input-error"><p>ошибка</p></div>
                </div>

                <div class="form__input-wrap">
                  <input class="form__input input input_theme_grey-line" type="text" name="form_text_3" placeholder="Email">
                </div>

              </div>

              <div class="popup__wrap">

                <div class="form__input-wrap">
                  <input class="form__input input input_theme_grey-line street" type="text" name="form_text_4" placeholder="Город и улица">
                </div>

                <div class="form__input-wrap">
                  <input class="form__input input input_theme_grey-line home" type="text" name="form_text_5" placeholder="Дом и квартира">
                </div>

                <div class="form__input-wrap">
                  <textarea class="popup__textarea textarea textarea_theme_grey-line" name="form_textarea_6" placeholder="Введите ваш комментарий"></textarea>
                </div>

                <!-- Скрытые поля -->
                <input type="hidden" name="form_hidden_7" class="selected_hidden_ultra_power">
                <input type="hidden" name="form_hidden_8" class="monthly_pay">
                <input type="hidden" name="form_hidden_9" class="equipment_pay">
                <input type="hidden" name="form_hidden_10" class="final_pay">
                <input type="hidden" name="form_hidden_11" class="adress_trtr">
                <input type="hidden" name="form_hidden_12" value="<?=SITE_SERVER_NAME.'/'.$APPLICATION->GetCurPage()?>">

              </div>
            </div>

            <div class="popup__footer">
              <div class="popup__checkout">
                <div class="input input_checkbox input_theme_green-checkbox">
                  <input class="input__source" required="required" type="checkbox" id="checkbox_deflt">
                  <label class="input__checkbox" for="checkbox_deflt"></label>
                  <label class="input__text" for="checkbox_deflt">
                    Я согласен с условиями подключения и даю согласие на обработку персональных данных согласно
                      <?php if(!empty($arResult['FILE_ID'])): ?>
                        <a class="input__text" target="_blank" href="<?=$arResult['FILE']?>">Федеральному закону «О персональных данных»</a>
                      <?php else: ?>
                        Федеральному закону «О персональных данных»
                      <?php endif; ?>
                  </label>
                </div>
              </div>

              <button type="submit" name="web_form_apply" value="Отправить" class="button button_size_medium button_theme_full-green form__button-send">Отправить</button>
            </div>

          </form>

        <?php endif; ?>

    </div>
  </div>

</div>

<?=$arResult["FORM_FOOTER"]?>

<script type="text/javascript">
    function dis(){
        const btn = document.querySelector('.form__button-send');
        if(btn){
            btn.disabled = true;
            btn.textContent = "Пожалуйста подождите";
        }
    }
</script>