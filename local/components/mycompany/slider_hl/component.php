<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Loader;

if (!Loader::includeModule('iblock')) {
    ShowError('Модуль инфоблоков не подключен');
    return;
}

$arResult['SLIDES'] = [];

$res = CIBlockElement::GetList(
    ['SORT' => 'ASC'],
    ['IBLOCK_ID' => 1, 'ACTIVE' => 'Y'],
    false,
    false,
    ['ID', 'NAME', 'DETAIL_TEXT', 'PREVIEW_PICTURE', 'PROPERTY_LINK']
);

while ($arItem = $res->GetNext()) {
    echo '<pre>';
    print_r($arItem);
    echo '</pre>';

    $previewPictureSrc = '';
    if ($arItem['PREVIEW_PICTURE']) {
        $previewPictureSrc = CFile::GetPath($arItem['PREVIEW_PICTURE']);
    }

    $arResult['SLIDES'][] = [
        'NAME' => $arItem['NAME'],
        'DETAIL_TEXT' => $arItem['DETAIL_TEXT'],
        'PREVIEW_PICTURE_SRC' => $previewPictureSrc,
        'LINK' => $arItem['PROPERTY_LINK_VALUE'],
    ];
}

$this->IncludeComponentTemplate();