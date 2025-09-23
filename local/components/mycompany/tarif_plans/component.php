<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}


use Bitrix\Main\Loader;

if (!Loader::includeModule('iblock')) {
    ShowError("Не подключен модуль iblock");
    return;
}

$tarifs_json = [
    [
        "id" => 1,
        "name" => "СТАРТ",
        "promo" => false,
        "speed" => 100,
        "price" => 400,
        "price2" => 0,
        "description" => "Комфортная скорость интернета и телеканалы на любой вкус",
        "description2" => "НТВ-ПЛЮС ТВ в подарок 🎁",
        "tv" => false,
        "dataPackage" => 'ntv_light',
        "channels" => 70,
        "category" => 'internet',
        "movie" => null
    ],
    [
        "id" => 2,
        "name" => "ХИТ",
        "promo" => false,
        "speed" => 300,
        "price" => 500,
        "price2" => 0,
        "description" => "Оптимальный интернет для работы и отдыха",
        "description2" => "НТВ-ПЛЮС ТВ в подарок 🎁",
        "tv" => false,
        "dataPackage" => 'ntv_light',
        "channels" => 70,
        "category" => 'internet',
        "movie" => null
    ],
    [
        "id" => 3,
        "name" => "МЕГА",
        "promo" => false,
        "speed" => 500,
        "price" => 770,
        "price2" => 0,
        "description" => "Максимум скорости. Всё летает!",
        "description2" => "НТВ-ПЛЮС ТВ в подарок 🎁",
        "tv" => false,
        "dataPackage" => 'ntv_light',
        "channels" => 70,
        "category" => 'internet',
        "movie" => null
    ],
    [
        "id" => 4,
        "name" => "старт+тв",
        "promo" => false,
        "speed" => 100,
        "price" => 550,
        "price2" => null,
        "description" => "Интернет и стартовый пакет телеканалов",
        "tv" => true,
        "dataPackage" => "5e7b710ccf1d9d5a91882f6d",
        "channels" => 95,
        "category" => 'internet-tv',
        "movie" => null
    ],
    [
        "id" => 5,
        "name" => "ХИТ+ТВ",
        "promo" => false,
        "speed" => 300,
        "price" => 650,
        "price2" => 0,
        "description" => "Быстрый интернет, кино и телевидение для всей семьи",
        "tv" => true,
        "dataPackage" => "630f5b1c944a765510046e89",
        "channels" => 275,
        "category" => 'internet-tv',
        "movie" => "PREMIER"
    ],
    [
        "id" => 6,
        "name" => "УЛЬТРА+КИНО",
        "promo" => false,
        "speed" => 350,
        "price" => 990,
        "price2" => 0,
        "description" => "Скоростной интернет, ультра ТВ и кинотеатр на выбор",
        "tv" => true,
        "dataPackage" => "5e7b7e70acb10bd8ce882ef1",
        "channels" => 320,
        "category" => 'internet-tv',
        "movie" => "2 из 3 видеосервисов"
    ]
];
//
//$tarifs_json = [
//    [
//        "id" => 1,
//        "name" => "СТАРТ",
//        "promo" => false,
//        "speed" => 100,
//        "price" => 610,
//        "price2" => null,
//        "description" => "Комфортная скорость для повседневных задач",
//        "tv" => false,
//        "dataPackage" => 'ntv_light',
//        "channels" => 70,
//        "category" => 'internet',
//        "movie" => null
//    ],
//    [
//        "id" => 2,
//        "name" => "ХИТ",
//        "promo" => false,
//        "speed" => 300,
//        "price" => 710,
//        "price2" => null,
//        "description" => "Оптимальный интернет для работы и отдыха",
//        "tv" => false,
//        "dataPackage" => 'ntv_light',
//        "channels" => 70,
//        "category" => 'internet',
//        "movie" => null
//    ],
//    [
//        "id" => 3,
//        "name" => "МЕГА",
//        "promo" => true,
//        "speed" => 500,
//        "price" => 770,
//        "price2" => 600,
//        "description" => "Максимум скорости. Всё летает!",
//        "tv" => false,
//        "dataPackage" => 'ntv_light',
//        "channels" => 70,
//        "category" => 'internet',
//        "movie" => null
//    ],
//    [
//        "id" => 4,
//        "name" => "старт+тв",
//        "promo" => false,
//        "speed" => 100,
//        "price" => 710,
//        "price2" => null,
//        "description" => "Интернет и стартовый пакет телеканалов",
//        "tv" => true,
//        "dataPackage" => "5e7b710ccf1d9d5a91882f6d",
//        "channels" => 175,
//        "category" => 'internet-tv',
//        "movie" => null
//    ],
//    [
//        "id" => 6,
//        "name" => "ХИТ+ТВ",
//        "promo" => true,
//        "speed" => 300,
//        "price" => 860,
//        "price2" => 700,
//        "description" => "Быстрый интернет, кино и телевидение для всей семьи",
//        "tv" => true,
//        "dataPackage" => "630f5b1c944a765510046e89",
//        "channels" => 260,
//        "category" => 'internet-tv',
//        "movie" => "PREMIER"
//    ],
//    [
//        "id" => 7,
//        "name" => "УЛЬТРА+КИНО",
//        "promo" => true,
//        "speed" => 350,
//        "price" => 990,
//        "price2" => 800,
//        "description" => "Скоростной интернет, ультра ТВ и кинотеатр на выбор",
//        "tv" => true,
//        "dataPackage" => "5e7b7e70acb10bd8ce882ef1",
//        "channels" => 320,
//        "category" => 'internet-tv',
//        "movie" => "2 из 3 видеосервисов"
//    ],
//];


//$arResult["TARIFS"] = [];
//foreach($tarifs_json as $tarif) {
//    if ($tv_only === null || $tarif['tv'] === $tv_only) {
//        $arResult["TARIFS"][] = $tarif;
//    }
//}

$arResult["TARIFS"] = [];
foreach ($tarifs_json as $tarif) {
    $arResult["TARIFS"][] = $tarif;
}

// Подключаем шаблон
$this->IncludeComponentTemplate();