<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

if (!Loader::includeModule("iblock")) {
    ShowError("Модуль iblock не подключен");
    return;
}
$arResult = [];


$res = CIBlockElement::GetList(
    ['ACTIVE_FROM' => 'DESC'],
    [
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'ACTIVE' => 'Y'
    ],
    false,
    ['nTopCount' => 5],
    ['ID', 'NAME', 'PREVIEW_TEXT', 'DETAIL_TEXT']
);

while ($element = $res->GetNext()) {
    $arResult['ITEMS'][] = $element;
}

$this->arResult = $arResult;
$this->IncludeComponentTemplate();
