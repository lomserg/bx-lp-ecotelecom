<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<? if ($arResult["isFormNote"] === "Y"): ?>
  Спасибо, ваша заявка принята!
<? else: ?>
    <?=$arResult["FORM_HEADER"]?>
  <div class="error-msg"></div>
  <input type="hidden" name="web_form_submit" value="Y">

    <? if ($arResult["isFormErrors"] === "Y"): ?>
    <div class="errors">
        <?=$arResult["FORM_ERRORS_TEXT"]?>
    </div>
    <? endif; ?>

    <?=$arResult["QUESTIONS"]['NAME']['CAPTION']?>
    <?=($arResult["QUESTIONS"]['NAME']['REQUIRED'] === 'Y' ? ' *' : '')?>:
    <?=$arResult["QUESTIONS"]['NAME']['HTML_CODE']?><br>

    <?=$arResult["QUESTIONS"]['PHONE']['CAPTION']?>
    <?=($arResult["QUESTIONS"]['PHONE']['REQUIRED'] === 'Y' ? ' *' : '')?>:
    <?=$arResult["QUESTIONS"]['PHONE']['HTML_CODE']?><br>

    <?=$arResult["QUESTIONS"]['ADDRES']['CAPTION']?>
    <?=($arResult["QUESTIONS"]['ADDRES']['REQUIRED'] === 'Y' ? ' *' : '')?>:
    <?=$arResult["QUESTIONS"]['ADDRES']['HTML_CODE']?><br>

  <input type="submit" value="<?=$arResult["arForm"]["BUTTON"]?>">

    <?=$arResult["FORM_FOOTER"]?>
<? endif; ?>

<script>
    console.log(document.getElementsByName("<?=$arResult['arForm']['SID']?>")[0]);
    console.log('<?=$templateFolder?>/ajax.php');
    ajaxForm(document.getElementsByName('<?=$arResult['arForm']['SID']?>')[0], '<?=$templateFolder?>/ajax.php')
</script>
