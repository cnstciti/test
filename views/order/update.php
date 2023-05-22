<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Order $model */
/** @var array $statuses */

$this->title = 'Редактирование заказа: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'statuses' => $statuses,
    ]) ?>

</div>
