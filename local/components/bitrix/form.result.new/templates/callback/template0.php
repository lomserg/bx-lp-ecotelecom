<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?=$arResult["FORM_HEADER"]?>

<div class="form-body">
    <? foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion): ?>
        <? if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden'): ?>
            <?=$arQuestion["HTML_CODE"]?>
        <? else: ?>
        <div class="form-row">
          <label>
              <?php
              // Красивые названия полей
              if ($FIELD_SID == "form_text_1") echo "Имя";
              elseif ($FIELD_SID == "form_text_2") echo "Телефон";
              elseif ($FIELD_SID == "form_text_3") echo "Адрес";
              else echo $arQuestion["CAPTION"];
              ?>
              <? if ($arQuestion["REQUIRED"] == "Y") echo $arResult["REQUIRED_SIGN"]; ?>
          </label>
            <?=$arQuestion["HTML_CODE"]?>
        </div>
        <? endif; ?>
    <? endforeach; ?>

    <? if ($arResult["isUseCaptcha"] == "Y"): ?>
      <div class="form-captcha">
        <label><b><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></b></label><br/>
        <input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" />
        <img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" alt="CAPTCHA"/>
        <input type="text" name="captcha_word" size="30" maxlength="50" class="inputtext" required />
      </div>
    <? endif; ?>
</div>

<div class="form-actions">
  <input type="submit" name="web_form_submit" class="button-63" value="<?=htmlspecialcharsbx($arResult["arForm"]["BUTTON"] ?: GetMessage("FORM_ADD"));?>" />
  <input type="reset" value="<?=GetMessage("FORM_RESET");?>" />
  <div id="form-status"></div>
</div>

<?=$arResult["FORM_FOOTER"]?>

<script>
    BX.ready(function(){
        var form = document.querySelector("form[name='<?=$arResult["arForm"]["SID"]?>']");
        var status = form.querySelector("#form-status");

        // Статус при отправке
        BX.bind(form, 'submit', function(){
            var btn = form.querySelector('input[type="submit"]');
            btn.disabled = true;
            btn.value = 'Отправка...';
            if(status) status.textContent = 'Сообщение отправляется, пожалуйста подождите...';
        });

        // После успешной отправки AJAX
        BX.addCustomEvent('onAjaxSuccess', function(formId, data){
            if(formId === '<?=$arResult["COMPONENT_ID"]?>' && data && data.TYPE === 'success'){
                form.style.display = 'none';
                var div = document.createElement('div');
                div.className = 'form-success';
                div.textContent = '✅ Спасибо! Ваше сообщение успешно отправлено.';
                form.parentNode.appendChild(div);
            }
        });
    });
</script>

<style>
    .form-row { margin-bottom: 1rem; }
    .form-row label { display: block; margin-bottom: .3rem; font-weight: bold; }
    .inputtext { width: 100%; padding: .5rem; border: 1px solid #ccc; border-radius: 5px; }
    .button-63 { padding: .5rem 1rem; background: #7b3fe4; color: #fff; border: none; border-radius: 8px; cursor: pointer; }
    .button-63:disabled { opacity: .6; cursor: not-allowed; }
    .form-success { margin-top: 1rem; font-size: 1.1rem; color: green; }
    .form-captcha { margin-top: 1rem; }
</style>