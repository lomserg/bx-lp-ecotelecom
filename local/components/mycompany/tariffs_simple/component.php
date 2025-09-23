<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

if (!Loader::includeModule('iblock')) {
    ShowError('Модуль iblock не подключен');
    return;
}

$arResult = [];
$iblockId = intval($arParams['IBLOCK_ID']);
$elementCode = $_GET['ELEMENT_CODE'] ?? null;

if ($elementCode) {
    // Детальная страница (оставляем как было)
    $filterSectionId = isset($arParams['FILTER_SECTION_ID']) ? intval($arParams['FILTER_SECTION_ID']) : 0;

// Список тарифов
    $arSelect = [
        'ID', 'IBLOCK_ID', 'NAME', 'CODE', 'IBLOCK_SECTION_ID',
        'PROPERTY_PRICE', 'PROPERTY_SPEED', 'PROPERTY_TYPE',
        'PROPERTY_CHANNELS', 'PROPERTY_CINEMAS','PROPERTY_DESCRIPTION'
    ];
    $arFilter = [
        'IBLOCK_ID' => $iblockId,
        'ACTIVE' => 'Y',
    ];

// Если передан фильтр раздела, добавляем
    if ($filterSectionId > 0) {
        $arFilter['SECTION_ID'] = $filterSectionId;
    }
    $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
    if ($item = $res->GetNext()) {
        $arResult['TARIFF'] = [
            'ID' => $item['ID'],
            'NAME' => $item['NAME'],
            'CODE' => $item['CODE'],
            'PRICE' => $item['PROPERTY_PRICE_VALUE'],
            'SPEED' => $item['PROPERTY_SPEED_VALUE'],
            'TYPE' => $item['PROPERTY_TYPE_VALUE'],
            'CHANNELS' => $item['PROPERTY_CHANNELS_VALUE'],
            'DESCRIPTION'=> $item['PROPERTY_DESCRIPTION_VALUE'],
            'CINEMAS' => is_array($item['PROPERTY_CINEMAS_VALUE'])
                ? $item['PROPERTY_CINEMAS_VALUE']
                : [$item['PROPERTY_CINEMAS_VALUE']],
        ];
        $componentPage = "detail";
    } else {
        ShowError("Тариф не найден");
        return;
    }
}  else {
    $filterSectionId = isset($arParams['FILTER_SECTION_ID']) ? intval($arParams['FILTER_SECTION_ID']) : 0;

    $arSelect = [
        'ID', 'IBLOCK_ID', 'NAME', 'CODE', 'IBLOCK_SECTION_ID',
        'PROPERTY_PRICE', 'PROPERTY_SPEED', 'PROPERTY_TYPE',
        'PROPERTY_CHANNELS', 'PROPERTY_CINEMAS','PROPERTY_DESCRIPTION'
    ];

    $arFilter = [
        'IBLOCK_ID' => $iblockId,
        'ACTIVE' => 'Y',
    ];

    if ($filterSectionId > 0) {
        $arFilter['SECTION_ID'] = $filterSectionId;
    }

    $res = CIBlockElement::GetList(['SORT' => 'ASC'], $arFilter, false, false, $arSelect);

    $tariffsTemp = [];
    while ($item = $res->GetNext()) {
        $id = $item['ID'];

        if (!isset($tariffsTemp[$id])) {
            $tariffsTemp[$id] = [
                'ID' => $item['ID'],
                'NAME' => $item['NAME'],
                'CODE' => $item['CODE'],
                'PRICE' => $item['PROPERTY_PRICE_VALUE'],
                'SPEED' => $item['PROPERTY_SPEED_VALUE'],
                'TYPE' => $item['PROPERTY_TYPE_VALUE'],
                'CHANNELS' => $item['PROPERTY_CHANNELS_VALUE'],
                'DESCRIPTION'=> $item['PROPERTY_DESCRIPTION_VALUE'],
                'CINEMAS' => [],
                'SECTION_ID' => $item['IBLOCK_SECTION_ID']
            ];
        }

        if ($item['PROPERTY_CINEMAS_VALUE']) {
            $cinema = is_array($item['PROPERTY_CINEMAS_VALUE'])
                ? $item['PROPERTY_CINEMAS_VALUE'][0]
                : $item['PROPERTY_CINEMAS_VALUE'];

            if ($cinema && !in_array($cinema, $tariffsTemp[$id]['CINEMAS'])) {
                $tariffsTemp[$id]['CINEMAS'][] = $cinema;
            }
        }
    }

    $arResult['TARIFFS'] = array_values($tariffsTemp);

    $arResult['SECTIONS'] = [];
    foreach ($arResult['TARIFFS'] as $tariff) {
        $sectionId = $tariff['SECTION_ID'];
        if (!isset($arResult['SECTIONS'][$sectionId])) {
            $arResult['SECTIONS'][$sectionId] = [];
        }
        $arResult['SECTIONS'][$sectionId][] = $tariff;
    }

    $componentPage = "list";
}

$this->IncludeComponentTemplate($componentPage);
?>