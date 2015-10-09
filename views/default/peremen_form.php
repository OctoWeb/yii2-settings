<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use common\models\SettingGroup;

/* @var $this yii\web\View */
/* @var $model common\models\Settings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6"><?= $form->field($model, 'label')->textInput(['maxlength' => 255]) ?></div>
        <div class="col-sm-6"><?= $form->field($model, 'param')->textInput(['maxlength' => 128]) ?></div>
    </div>
    <div class="row">
        <div class="col-sm-6"><?= $form->field($model, 'group')->dropDownList(ArrayHelper::map(SettingGroup::find()->orderBy('position')->All(),'name','title')) ?></div>
        <div class="col-sm-6"><?= $form->field($model, 'type')->dropDownList($model->types) ?></div>
    </div>
    
    <?= $form->field($model, 'default')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'desc')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
