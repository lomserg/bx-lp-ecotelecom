<div class="tarif-detail">
  <h2><?= $arResult['TARIFF']['NAME'] ?></h2>
  <p>Скорость: <?= $arResult['TARIFF']['SPEED'] ?> Мбит/с</p>
  <p>Цена: <?= $arResult['TARIFF']['PRICE'] ?> ₽</p>
  <p>Тип: <?= $arResult['TARIFF']['TYPE'] ?></p>
  <p>Каналы: <?= $arResult['TARIFF']['CHANNELS'] ?></p>
  <p>Кинотеатры: <?= implode(", ", $arResult['TARIFF']['CINEMAS']) ?></p>
</div>