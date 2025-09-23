<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>

<div class="advantages">
  <?php foreach ($arResult["ITEMS"] as $item): ?>
    <div class="advantages__item">
        <div class="advantages__icon"><?=$item["ICON"]?></div>
        <div class="advantages__content">
            <div class="advantages__title"><?=$item["TITLE"]?></div>
            <div class="advantages__text"><?=$item["TEXT"]?></div>
        </div>
    </div>
  <?php endforeach; ?>
</div>