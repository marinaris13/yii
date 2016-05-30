<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

?>
<h1>Изготовители</h1>
<ul>
        <?php foreach ($manufacturers as $item): ?>
        <li>
            <?= Html::encode("{$item->name} ({$item->city})") ?>
        </li>
<?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>