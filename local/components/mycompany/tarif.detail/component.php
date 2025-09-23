<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// Получаем ID тарифа из GET
$tarif_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Массив тарифов (тот же, что в списке)
$tarifs_json = [
    ["id"=>1,"name"=>"СТАРТ","promo"=>false,"speed"=>100,"price"=>610,"price2"=>null,"description"=>"Комфортная скорость для повседневных задач","tv"=>false,"dataPackage"=>null,"channels"=>70,"movie"=>null],
    ["id"=>2,"name"=>"ХИТ","promo"=>false,"speed"=>300,"price"=>710,"price2"=>null,"description"=>"Оптимальный интернет для работы и отдыха","tv"=>false,"dataPackage"=>null,"channels"=>70,"movie"=>null],
    ["id"=>3,"name"=>"МЕГА","promo"=>true,"speed"=>500,"price"=>770,"price2"=>600,"description"=>"Максимум скорости. Всё летает!","tv"=>false,"dataPackage"=>null,"channels"=>70,"movie"=>null],
    ["id"=>4,"name"=>"старт+тв","promo"=>false,"speed"=>100,"price"=>710,"price2"=>null,"description"=>"Интернет и стартовый пакет телеканалов","tv"=>true,"dataPackage"=>"5e7b710ccf1d9d5a91882f6d","channels"=>175,"movie"=>null],
    ["id"=>6,"name"=>"ХИТ+ТВ","promo"=>true,"speed"=>300,"price"=>860,"price2"=>700,"description"=>"Быстрый интернет, кино и телевидение для всей семьи","tv"=>true,"dataPackage"=>"630f5b1c944a765510046e89","channels"=>260,"movie"=>"PREMIER"],
    ["id"=>7,"name"=>"УЛЬТРА+КИНО","promo"=>true,"speed"=>350,"price"=>990,"price2"=>800,"description"=>"Скоростной интернет, ультра ТВ и кинотеатр на выбор","tv"=>true,"dataPackage"=>"5e7b7e70acb10bd8ce882ef1","channels"=>320,"movie"=>"2 из 3 видеосервисов"]
];

// Ищем тариф по ID
$arResult["TARIF"] = null;
foreach($tarifs_json as $tarif) {
    if ($tarif["id"] == $tarif_id) {
        $arResult["TARIF"] = $tarif;
        break;
    }
}

$this->IncludeComponentTemplate();