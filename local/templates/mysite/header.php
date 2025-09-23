<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <?$APPLICATION->ShowHead();?>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?$APPLICATION->ShowTitle()?></title>
  <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/swiper-bundle.min.css" />
  <script src="<?=SITE_TEMPLATE_PATH?>/js/swiper-bundle.min.js" defer></script> <!-- убираю defer -->
  <script src="<?=SITE_TEMPLATE_PATH?>/js/slider.js" defer></script> <!-- добавляю defer -->
  <script src="<?=SITE_TEMPLATE_PATH?>/js/tabs.js" defer></script> <!-- добавляю defer -->
  <script src="<?=SITE_TEMPLATE_PATH?>/js/formValidate.js" defer></script>
  <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/style.css">
</head>
<body>
    <?$APPLICATION->ShowPanel();?> <!-- админ-панель -->
    <header class="header container"
        <?php if (strpos($_SERVER['REQUEST_URI'], '/tarif.php') !== false) echo 'style="background: #1b8607; width: 100%"'; ?>>
        <div class="header-content">
            <a class="logo-header" href="#"></a>

            <div class="phone text-dark">
                <a style="text-decoration: none" class="phoneid" href="tel:+74998017799">+7 499 801-77-99</a>
            </div>
        </div>
    </header>

    <main >
