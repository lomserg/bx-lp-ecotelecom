<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = array(
    "PARAMETERS" => array(
        "IBLOCK_ID" => array(
            "NAME" => "ID инфоблока",
            "TYPE" => "STRING",
            "DEFAULT" => "",
            "REQUIRED" => "Y"
        ),
        "SECTION_ID" => array(
            "NAME" => "ID раздела",
            "TYPE" => "STRING",
            "DEFAULT" => ""
        ),
        "ELEMENT_COUNT" => array(
            "NAME" => "Количество элементов",
            "TYPE" => "STRING",
            "DEFAULT" => "10"
        ),
        "CACHE_TIME" => array("DEFAULT" => "3600"),
    )
);
?>