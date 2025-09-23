<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if ($arResult["isFormNote"] === "Y"): ?>
  <div class="success-msg">Спасибо, ваша заявка принята!</div>
<? else: ?>
    <?=$arResult["FORM_HEADER"]?>
    <?=bitrix_sessid_post()?>
  <input type="hidden" name="WEB_FORM_ID" value="<?=$arResult["arForm"]["ID"]?>">
  <input type="hidden" name="web_form_submit" value="Y">

  <div class="eco-form">
      <? if ($arResult["isFormErrors"] === "Y"): ?>
        <div class="error-msg"><?=$arResult["FORM_ERRORS_TEXT"]?></div>
      <? endif; ?>

    <div class="form-group">
      <label>
          <?=$arResult["QUESTIONS"]['NAME']['CAPTION']?>
          <? if ($arResult["QUESTIONS"]['NAME']['REQUIRED'] === 'Y') echo '<span class="req">*</span>'; ?>
          <?=$arResult["QUESTIONS"]['NAME']['HTML_CODE']?>
      </label>
    </div>

    <div class="form-group">
      <label>
          <?=$arResult["QUESTIONS"]['PHONE']['CAPTION']?>
          <? if ($arResult["QUESTIONS"]['PHONE']['REQUIRED'] === 'Y') echo '<span class="req">*</span>'; ?>
          <?php
          echo str_replace(
              '<input',
              '<input class="form-input" data-tel-input',
              $arResult["QUESTIONS"]['PHONE']['HTML_CODE']
          );
          ?>
      </label>
    </div>

    <div class="form-group">
      <label>
          <?=$arResult["QUESTIONS"]['ADDRES']['CAPTION']?>
          <? if ($arResult["QUESTIONS"]['ADDRES']['REQUIRED'] === 'Y') echo '<span class="req">*</span>'; ?>
          <?=$arResult["QUESTIONS"]['ADDRES']['HTML_CODE']?>
      </label>
    </div>

    <div class="error-msg"></div>

    <button type="submit" class="eco-btn">
        Отправвить
    </button>
  </div>

    <?=$arResult["FORM_FOOTER"]?>
<? endif; ?>
<div id="loading" style="display:none">Загрузка...</div>

<div id="form-success-popup" class="popup-order" style="display:none">
  <div class="popup-content">
    <button class="popup-close">×</button>
    <p>Спасибо, ваша заявка принята!</p>
  </div>
</div>



<script>
    ajaxForm(document.getElementsByName("<?=$arResult['arForm']['SID']?>")[0], "<?=$templateFolder?>/ajax.php");
    document.addEventListener("DOMContentLoaded", function () {
        var phoneInputs = document.querySelectorAll("input[data-tel-input]");

        var getInputNumbersValue = function (input) {
            // Return stripped input value — just numbers
            return input.value.replace(/\D/g, "");
        };

        var onPhonePaste = function (e) {
            var input = e.target,
                inputNumbersValue = getInputNumbersValue(input);
            var pasted = e.clipboardData || window.clipboardData;
            if (pasted) {
                var pastedText = pasted.getData("Text");
                if (/\D/g.test(pastedText)) {
                    // Attempt to paste non-numeric symbol — remove all non-numeric symbols,
                    // formatting will be in onPhoneInput handler
                    input.value = inputNumbersValue;
                    return;
                }
            }
        };

        var onPhoneInput = function (e) {
            var input = e.target,
                inputNumbersValue = getInputNumbersValue(input),
                selectionStart = input.selectionStart,
                formattedInputValue = "";

            if (!inputNumbersValue) {
                return (input.value = "");
            }

            if (input.value.length != selectionStart) {
                // Editing in the middle of input, not last symbol
                if (e.data && /\D/g.test(e.data)) {
                    // Attempt to input non-numeric symbol
                    input.value = inputNumbersValue;
                }
                return;
            }

            if (["7", "8", "9"].indexOf(inputNumbersValue[0]) > -1) {
                if (inputNumbersValue[0] == "9")
                    inputNumbersValue = "7" + inputNumbersValue;
                var firstSymbols = inputNumbersValue[0] == "8" ? "8" : "+7";
                formattedInputValue = input.value = firstSymbols + " ";
                if (inputNumbersValue.length > 1) {
                    formattedInputValue += "(" + inputNumbersValue.substring(1, 4);
                }
                if (inputNumbersValue.length >= 5) {
                    formattedInputValue += ") " + inputNumbersValue.substring(4, 7);
                }
                if (inputNumbersValue.length >= 8) {
                    formattedInputValue += "-" + inputNumbersValue.substring(7, 9);
                }
                if (inputNumbersValue.length >= 10) {
                    formattedInputValue += "-" + inputNumbersValue.substring(9, 11);
                }
            } else {
                formattedInputValue = "+" + inputNumbersValue.substring(0, 16);
            }
            input.value = formattedInputValue;
        };
        var onPhoneKeyDown = function (e) {
            // Clear input after remove last symbol
            var inputValue = e.target.value.replace(/\D/g, "");
            if (e.keyCode == 8 && inputValue.length == 1) {
                e.target.value = "";
            }
        };
        for (var phoneInput of phoneInputs) {
            phoneInput.addEventListener("keydown", onPhoneKeyDown);
            phoneInput.addEventListener("input", onPhoneInput, false);
            phoneInput.addEventListener("paste", onPhonePaste, false);
        }
    });

</script>
