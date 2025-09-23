<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>

<?php if($arResult["TARIF"]): ?>
    <div class="tarif-detail">
        <h1><?= $arResult["TARIF"]["name"] ?></h1>
        <?php if($arResult["TARIF"]["promo"]): ?>
            <div class="tarif-promo">Акция</div>
        <?php endif; ?>

        <p><?= $arResult["TARIF"]["description"] ?></p>

        <ul>
            <li>Скорость: <?= $arResult["TARIF"]["speed"] ?> Мбит/с</li>
            <li>Цена: 
                <?php if($arResult["TARIF"]["promo"] && $arResult["TARIF"]["price2"]): ?>
                    <?= $arResult["TARIF"]["price2"] ?> ₽/мес
                    <span class="tarif-price-old"><?= $arResult["TARIF"]["price"] ?> ₽/мес</span>
                <?php else: ?>
                    <?= $arResult["TARIF"]["price"] ?> ₽/мес
                <?php endif; ?>
            </li>
            <?php if($arResult["TARIF"]["tv"]): ?>
                <li>Каналы: <?= $arResult["TARIF"]["channels"] ?></li>
                <?php if($arResult["TARIF"]["movie"]): ?>
                    <li>Онлайн-кинотеатр: <?= $arResult["TARIF"]["movie"] ?></li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>

        <a href="javascript:void(0)" class="choose-btn">Подключить</a>
    </div>
<?php else: ?>
    <p>Тариф не найден</p>
<?php endif; ?>