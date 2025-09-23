<?php
//if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
//CModule::IncludeModule('iblock');
//
//$arFilter = [
//    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
//    'ACTIVE' => 'Y',
//];
//
//if (!empty($arParams['FILTER_SECTION_CODE'])) {
//    $arFilter['SECTION_CODE'] = $arParams['FILTER_SECTION_CODE'];
//}
//
//$res = CIBlockElement::GetList([], $arFilter, false, false, [
//    'ID',
//    'NAME',
//    'PROPERTY_TYPE',
//    'PROPERTY_PRICE',
//    'PROPERTY_SPEED',
//    'PROPERTY_CHANNELS',
//    'PROPERTY_CINEMAS',
//]);
//
//$arItems = [];
//
//while ($item = $res->Fetch()) {
//    $arItems[] = $item;
//}
//
//echo '<pre>';
//print_r($arItems);
//echo '</pre>';
//
//$arResult['ITEMS'] = $arItems;
//
//$this->IncludeComponentTemplate();





// Защита от прямого доступа к файлу
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

$arDefaultUrlTemplates404 = [
    "list" => "",
    "detail" => "#ELEMENT_CODE#/",
];

$arComponentVariables = ["ELEMENT_CODE"];

$arVariables = [];
$componentPage = "";

if ($arParams["SEF_MODE"] === "Y") {
    $arUrlTemplates = CComponentEngine::MakeComponentUrlTemplates($arDefaultUrlTemplates404, $arParams["SEF_URL_TEMPLATES"]);
    $arVariableAliases = CComponentEngine::MakeComponentVariableAliases([], $arParams["VARIABLE_ALIASES"]);

    $componentPage = CComponentEngine::ParseComponentPath(
        $arParams["SEF_FOLDER"],
        $arUrlTemplates,
        $arVariables
    );

    if (!$componentPage) {
        $componentPage = "list";
    }

    CComponentEngine::InitComponentVariables(
        $componentPage,
        $arComponentVariables,
        $arVariableAliases,
        $arVariables
    );
} else {
    $componentPage = "list";
}

$arResult = [
    "FOLDER" => $arParams["SEF_FOLDER"],
    "URL_TEMPLATES" => $arUrlTemplates,
    "VARIABLES" => $arVariables,
    "ALIASES" => $arVariableAliases,
];

if (!Loader::includeModule('iblock')) {
    ShowError('Модуль iblock не подключен');
    return;
}

$iblockId = intval($arParams['IBLOCK_ID']);
$filterSectionCode = $arParams['FILTER_SECTION_CODE'] ?? null;
$filterType = $arParams['FILTER_TYPE'] ?? null;

if ($componentPage === 'list') {
    $arResult['TARIFFS'] = [];

    $arSelect = [
        'ID', 'IBLOCK_ID', 'NAME', 'CODE', 'IBLOCK_SECTION_ID',
        'PROPERTY_PRICE', 'PROPERTY_SPEED', 'PROPERTY_TYPE',
        'PROPERTY_CHANNELS', 'PROPERTY_CINEMAS',
    ];

    $arFilter = [
        'IBLOCK_ID' => $iblockId,
        'ACTIVE' => 'Y',
    ];

    // --- Получаем ID раздела по символьному коду ---
    $filterSectionId = null;
    if ($filterSectionCode) {
        $sectionRes = CIBlockSection::GetList([], [
            'IBLOCK_ID' => $iblockId,
            'CODE' => $filterSectionCode,
            'ACTIVE' => 'Y',
        ], false, ['ID']);
        if ($section = $sectionRes->Fetch()) {
            $filterSectionId = $section['ID'];
        } else {
            $filterSectionId = -1; // невалидный код — не найдёт ничего
        }
    }

    $rsElements = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
    while ($arItem = $rsElements->GetNext()) {
        $sectionId = $arItem['IBLOCK_SECTION_ID'];
        $type = $arItem['PROPERTY_TYPE_VALUE'] ?: 'Без типа';
        $key = $arItem['ID'];

        // --- Фильтрация ---
        if (!empty($filterSectionId) && $sectionId != $filterSectionId) {
            continue;
        }
        if (!empty($filterType) && $type != $filterType) {
            continue;
        }

        // --- Сохраняем тариф ---
        if (!isset($arResult['TARIFFS'][$sectionId][$type][$key])) {
            $arResult['TARIFFS'][$sectionId][$type][$key] = [
                'ID' => $arItem['ID'],
                'NAME' => $arItem['NAME'],
                'CODE' => $arItem['CODE'],
                'PRICE' => $arItem['PROPERTY_PRICE_VALUE'],
                'SPEED' => $arItem['PROPERTY_SPEED_VALUE'],
                'TYPE' => $type,
                'CHANNELS' => $arItem['PROPERTY_CHANNELS_VALUE'],
                'CINEMAS' => [],
            ];
        }

        $cinema = $arItem['PROPERTY_CINEMAS_VALUE'];
        if ($cinema && !in_array($cinema, $arResult['TARIFFS'][$sectionId][$type][$key]['CINEMAS'])) {
            $arResult['TARIFFS'][$sectionId][$type][$key]['CINEMAS'][] = $cinema;
        }
    }

    // Получаем список разделов
    $arResult['SECTIONS'] = [];
    $rsSections = CIBlockSection::GetList([], ['IBLOCK_ID' => $iblockId, 'ACTIVE' => 'Y']);
    while ($arSection = $rsSections->GetNext()) {
        $arResult['SECTIONS'][$arSection['ID']] = $arSection['NAME'];
    }

} elseif ($componentPage === 'detail' && !empty($arVariables['ELEMENT_CODE'])) {
    $code = $arVariables['ELEMENT_CODE'];

    $arSelect = [
        'ID', 'NAME', 'CODE', 'PROPERTY_PRICE', 'PROPERTY_SPEED',
        'PROPERTY_TYPE', 'PROPERTY_CHANNELS', 'PROPERTY_CINEMAS',
    ];
    $arFilter = [
        'IBLOCK_ID' => $iblockId,
        'ACTIVE' => 'Y',
        'CODE' => $code,
    ];

    $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
    if ($ob = $res->GetNext()) {
        $arResult['TARIFF'] = [
            'ID' => $ob['ID'],
            'NAME' => $ob['NAME'],
            'CODE' => $ob['CODE'],
            'PRICE' => $ob['PROPERTY_PRICE_VALUE'],
            'SPEED' => $ob['PROPERTY_SPEED_VALUE'],
            'TYPE' => $ob['PROPERTY_TYPE_VALUE'],
            'CHANNELS' => $ob['PROPERTY_CHANNELS_VALUE'],
            'CINEMAS' => is_array($ob['PROPERTY_CINEMAS_VALUE']) ? $ob['PROPERTY_CINEMAS_VALUE'] : [$ob['PROPERTY_CINEMAS_VALUE']],
        ];
    } else {
        ShowError("Тариф не найден");
    }
}

// Подключаем шаблон
$this->IncludeComponentTemplate($componentPage);


echo '<pre>';
print_r($componentPage);
print_r($arVariables);
echo '</pre>';
echo '<pre>';   print_r($arResult['TARIFFS']);  echo '</pre>';
