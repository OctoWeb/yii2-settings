<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Settings */

$this->title = Yii::t('app', 'Update') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Группы переменных', 'url' => ['groups']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="settings-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('groups_form', ['model' => $model]) ?>
</div>
