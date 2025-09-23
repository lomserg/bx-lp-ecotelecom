
<?php
$APPLICATION->SetAdditionalCSS($templateFolder . "/style.css");
$APPLICATION->AddHeadScript($templateFolder . "/script.js");
?>
<?php if (!empty($arResult['FAQ'])): ?>
<?php
echo "<pre>";
var_dump($arResult['FAQ']);
echo "</pre>";

?>

  <section class="faq container">
    <h2 class="section-title fs-600">Дополнительная информация:</h2>

    <div class="accordion accordion-grid">
        <?php foreach ($arResult['FAQ'] as $faq): ?>
      <div class="accordion-item">
        <div class="accordion-item-header fs-400">
            <?= htmlspecialchars($faq['question']) ?>
        </div>
        <div class="accordion-item-body">
          <div class="accordion-item-body-content">
            <p>
                <?= $faq['answer'] ?>
            </p>
          </div>
        </div>
      </div>

        <?php endforeach; ?>

    </div>
  </section>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.faq-question').forEach(question => {
                question.addEventListener('click', () => {
                    question.classList.toggle('active');
                    const answer = question.nextElementSibling;
                    if (answer.style.display === 'block') {
                        answer.style.display = 'none';
                    } else {
                        answer.style.display = 'block';
                    }
                });
            });
        });
    </script>
<?php else: ?>
    <p>Список вопросов пуст.</p>
<?php endif; ?>