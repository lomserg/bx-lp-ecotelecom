<?php //if ($arResult['ITEM']): ?>
<!--    <div class="tariff-detail">-->
<!--        <h1>--><?php //= htmlspecialchars($arResult['ITEM']['NAME']) ?><!--</h1>-->
<!--        <p>💰 Цена: --><?php //= $arResult['ITEM']['PROPERTY_PRICE_VALUE'] ?><!-- ₽</p>-->
<!--        <p>⚡ Скорость: --><?php //= $arResult['ITEM']['PROPERTY_SPEED_VALUE'] ?><!--</p>-->
<!---->
<!--        --><?php //if ($arResult['ITEM']['PROPERTY_TYPE_VALUE'] == 'С ТВ'): ?>
<!--            <p>📺 Каналов: --><?php //= $arResult['ITEM']['PROPERTY_CHANNELS_VALUE'] ?><!--</p>-->
<!--            <p>🎬 Кинотеатры:-->
<!--                --><?php //= is_array($arResult['ITEM']['PROPERTY_CINEMAS_VALUE'])
//                    ? implode(', ', $arResult['ITEM']['PROPERTY_CINEMAS_VALUE'])
//                    : $arResult['ITEM']['PROPERTY_CINEMAS_VALUE']
//                ?>
<!--            </p>-->
<!--        --><?php //endif; ?>
<!---->
<!--        <div class="description">-->
<!--            --><?php //= $arResult['ITEM']['DETAIL_TEXT'] ?>
<!--        </div>-->
<!---->
<!--        <a href="--><?php //= $arResult["FOLDER"] ?><!--" class="back-link">← Назад к тарифам</a>-->
<!--    </div>-->
<?php //else: ?>
<!--    <p>Тариф не найден.</p>-->
<?php //endif;?>

<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

CModule::IncludeModule('iblock');

$elementCode = $arResult['VARIABLES']['ELEMENT_CODE'];

$res = CIBlockElement::GetList([], [
    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
    'CODE' => $elementCode,
    'ACTIVE' => 'Y',
], false, false, [
    'ID', 'NAME', 'PROPERTY_PRICE', 'PROPERTY_SPEED', 'PROPERTY_TYPE', 'PROPERTY_CHANNELS', 'PROPERTY_CINEMAS'
]);

if ($item = $res->Fetch()):
    echo "<h2>" . htmlspecialchars($item['NAME']) . "</h2>";
    echo "<p>Цена: " . htmlspecialchars($item['PROPERTY_PRICE_VALUE']) . " руб.</p>";
    echo "<p>Скорость: " . htmlspecialchars($item['PROPERTY_SPEED_VALUE']) . "</p>";
    echo "<p>Тип: " . htmlspecialchars($item['PROPERTY_TYPE_VALUE']) . "</p>";

    if ($item['PROPERTY_TYPE_VALUE'] === 'С ТВ') {
        echo "<p>Каналов: " . htmlspecialchars($item['PROPERTY_CHANNELS_VALUE']) . "</p>";
        echo "<p>Кинотеатры: " . (is_array($item['PROPERTY_CINEMAS_VALUE'])
                ? htmlspecialchars(implode(', ', $item['PROPERTY_CINEMAS_VALUE']))
                : htmlspecialchars($item['PROPERTY_CINEMAS_VALUE'])) . "</p>";
    }

endif;