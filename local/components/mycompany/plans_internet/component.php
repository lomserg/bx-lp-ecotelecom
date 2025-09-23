<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!CModule::IncludeModule("iblock")) {
    ShowError("Модуль инфоблоков не установлен");
    return;
}

$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);
$arParams["ELEMENT_COUNT"] = intval($arParams["ELEMENT_COUNT"]) ?: 10;

$arFilter = array(
    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    "ACTIVE" => "Y"
);

$res = CIBlockElement::GetList(
    array("SORT" => "ASC"),
    $arFilter,
    false,
    array("nTopCount" => $arParams["ELEMENT_COUNT"])
);

$arResult["ITEMS"] = array();

while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();

    // Обрабатываем картинку
    if ($arFields["PREVIEW_PICTURE"]) {
        $arFields["PREVIEW_PICTURE"] = CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);
    }

    $arResult["ITEMS"][] = array(
        "FIELDS" => $arFields,
        "PROPERTIES" => $arProps
    );
}

$this->IncludeComponentTemplate();
?>