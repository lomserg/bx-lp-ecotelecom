<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
    "NAME" => GetMessage("SLIDER_HL_NAME"),
    "DESCRIPTION" => GetMessage("SLIDER_HL_DESCRIPTION"),
    "ICON" => "/images/news_line.gif",
    "SORT" => 10,
    "CACHE_PATH" => "Y",
    "PATH" => array(
        "ID" => "my_custom_section", // 👉 уникальный ID раздела
        "NAME" => GetMessage("Мои компоненты"), // 👉 название раздела
        "SORT" => 100,
        "CHILD" => array(
            "ID" => "slider",
            "NAME" => GetMessage("MY_CUSTOM_CHILD_NAME"),
            "SORT" => 10,
        )
    ),
);

?>