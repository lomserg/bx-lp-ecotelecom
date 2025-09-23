<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader;

if (!Loader::includeModule("iblock")) {
    ShowError("Модуль Инфоблоков не установлен");
    return;
}

$arResult = [];

// --- Получаем только нужные подразделы (2 и 3) ---
$arResult['SECTIONS'] = [];
$rsSections = CIBlockSection::GetList(
    ['SORT' => 'ASC'],
    ['IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y', 'DEPTH_LEVEL' => 2], // только дочерние
    false,
    ['ID', 'NAME', 'CODE']
);
while ($section = $rsSections->GetNext()) {
    $arResult['SECTIONS'][$section['ID']] = $section;
}

// --- Элементы инфоблока ---
$arFilter = [
    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
    'ACTIVE' => 'Y'
];

$arSelect = [
    'ID', 'NAME', 'IBLOCK_SECTION_ID', 'DETAIL_PAGE_URL', 'PREVIEW_PICTURE',
    'PROPERTY_PRICE', 'PROPERTY_PRICE_DISCOUNT', 'PROPERTY_SPEED',
    'PROPERTY_TV_COUNT', 'PROPERTY_DESCRIPTION', 'PROPERTY_PROMO_TEXT',
    'PROPERTY_MERGE_CHANNELS', 'PROPERTY_SUBSCRIPTION'
];

$arResult['TARIFFS'] = [];
$rsItems = CIBlockElement::GetList(['SORT' => 'ASC'], $arFilter, false, false, $arSelect);
while ($arItem = $rsItems->GetNext()) {
    // Картинка
    $arItem['PREVIEW_PICTURE'] = $arItem['PREVIEW_PICTURE'] ? CFile::GetPath($arItem['PREVIEW_PICTURE']) : false;

    // Группируем по разделам
    $arResult['TARIFFS'][$arItem['IBLOCK_SECTION_ID']][] = $arItem;
}

$this->IncludeComponentTemplate();
