<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// Статические данные преимуществ
$arResult["ITEMS"] = [
    ["ICON" => "🚀", "TITLE" => "Высокая скорость", "TEXT" => "Интернет до 1 Гбит/с"],
    ["ICON" => "📺", "TITLE" => "Бесплатное ТВ", "TEXT" => "100+ каналов в подарок"],
    ["ICON" => "💳", "TITLE" => "Удобная оплата", "TEXT" => "Через личный кабинет или терминалы"],
];

// Подключаем шаблон
$this->IncludeComponentTemplate();