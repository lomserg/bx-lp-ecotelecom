<?php
//echo "<h2>Тестовый шаблон найден</h2>";
//
//if (empty($arResult['ITEMS'])): ?>
<!--    <p>Тарифы не найдены.</p>-->
<?php //else: ?>
<!--    --><?php //foreach ($arResult['ITEMS'] as $item): ?>
<!--        <h3>--><?php //= htmlspecialchars($item['NAME']) ?><!--</h3>-->
<!--        <p>Тип: --><?php //= htmlspecialchars($item['PROPERTY_TYPE_VALUE'] ?? '') ?><!--</p>-->
<!--        <p>Цена: --><?php //= htmlspecialchars($item['PROPERTY_PRICE_VALUE'] ?? '') ?><!-- руб.</p>-->
<!--        <p>Скорость: --><?php //= htmlspecialchars($item['PROPERTY_SPEED_VALUE'] ?? '') ?><!--</p>-->
<!---->
<!--        --><?php //if (($item['PROPERTY_TYPE_VALUE'] ?? '') === 'С ТВ'): ?>
<!--            <p>Каналов: --><?php //= htmlspecialchars($item['PROPERTY_CHANNELS_VALUE'] ?? '') ?><!--</p>-->
<!--            <p>Кинотеатры:-->
<!--                --><?php
//                $cinemas = $item['PROPERTY_CINEMAS_VALUE'] ?? '';
//                if (is_array($cinemas)) {
//                    echo htmlspecialchars(implode(', ', $cinemas));
//                } else {
//                    echo htmlspecialchars($cinemas);
//                }
//                ?>
<!--            </p>-->
<!--        --><?php //endif; ?>
<!--    --><?php //endforeach; ?>
<?php //endif; ?>

<?php
// list.php - шаблон для вывода списка тарифов
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

?>
<h2>Список тарифов</h2>
<?php foreach ($arResult['TARIFFS'] as $sectionId => $types): ?>
  <h3><?= htmlspecialcharsbx($arResult['SECTIONS'][$sectionId]) ?></h3>
    <?php foreach ($types as $typeName => $tariffs): ?>
    <h4><?= htmlspecialcharsbx($typeName) ?></h4>
    <ul>
        <?php foreach ($tariffs as $tariff): ?>
          <li>
            <a href="<?= $arResult['FOLDER'] . str_replace('#ELEMENT_CODE#', $tariff['CODE'], $arResult['URL_TEMPLATES']['detail']) ?>">
              <strong><?= htmlspecialcharsbx($tariff['NAME']) ?></strong>
            </a>
            Цена: <?= intval($tariff['PRICE']) ?> руб.<br>
            Скорость: <?= intval($tariff['SPEED']) ?> Мбит/с<br>
            Тип: <?= htmlspecialcharsbx($tariff['TYPE']) ?><br>
            Кинотеатры:
              <?php if (!empty($tariff['CINEMAS'])): ?>
                  <?= implode(', ', array_map('htmlspecialcharsbx', $tariff['CINEMAS'])) ?>
              <?php else: ?>
                нет данных
              <?php endif; ?>
          </li>
        <?php endforeach; ?>
    </ul>
    <?php endforeach; ?>
<?php endforeach; ?>
