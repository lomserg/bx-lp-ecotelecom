<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Page\Asset;


Asset::getInstance()->addString('<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;amp;subset=cyrillic">');
Asset::getInstance()->addString('<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&amp;display=swap">');
Asset::getInstance()->addCss( $templateFolder . '/css/main.css' );
Asset::getInstance()->addCss( $templateFolder . '/css/main.css.map' );

Asset::getInstance()->addJs( $templateFolder . "/scripts/vendor.js");
Asset::getInstance()->addJs( $templateFolder . "/scripts/main.js");