
<?php
$APPLICATION->SetAdditionalCSS($templateFolder . "/style.css");
$APPLICATION->AddHeadScript($templateFolder . "/script.js");
?>
<?php if (!empty($arResult['FAQ'])): ?>


<section class="faq container">
    <h2 class="section-title fs-600">Дополнительная информация:</h2>

    <div class="accordion">
        <?php foreach ($arResult['FAQ'] as $faq): ?>

            <div class="accordion-item">
                <div class="accordion-header">
                    <?= htmlspecialchars($faq['question']) ?>
                </div>
                <div class="accordion-body">
                    <div class="accordion-body-content">
                        <?= nl2br(htmlspecialchars($faq['answer'])) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php endif; ?>