<?php
use yii\helpers\Html;

use kartik\widgets\SwitchInput;
use kartik\widgets\FileInput;
use kartik\widgets\ColorInput;

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

$this->title = Yii::t('app', 'Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-index">
    <?$edits=Yii::$app->user->identity->hasRouter('/settings/delete');
    if($edits){
        echo Html::a('<i class="glyphicon glyphicon-th-list"></i> Переменный', ['peremen'], ['class' => 'btn btn-success','style'=>'float:right','title'=>'Сортировка переменных']);
        echo Html::a('<i class="glyphicon glyphicon-th-list"></i> Группы', ['groups'], ['class' => 'btn btn-info','style'=>'float:right','title'=>'Сортировка груп']);
    }?>
    <h1><?= Html::encode($this->title) ?></h1>
    <ul class="nav nav-tabs">
        <?foreach($groups as $group){?>
            <li><a href="#tab_<?=$group->name?>" data-toggle="tab"><?=$group->title?></a></li>
        <?}?>
    </ul>
    <div class="tab-content" style="position: relative;">
        <?= Html::beginForm('','post',['enctype' => 'multipart/form-data','class'=>'form-horizontal'])?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary','style'=>'position: absolute;right: 0;top: -40px;']) ?>
            <?foreach($groups as $group){?>
                <div id="tab_<?=$group->name?>" class="tab-panel">
                    <?$models=$group->getSettings()->orderBy('position')->All();
                    foreach($models as $model){?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?=$model->label?></label>
                            <div class="col-sm-10">
                                <?if($model->type==0){
                                    echo Html::textInput('Settings['.$model->id.']',$model->value,['class'=>'form-control','placeholder'=>$model->default]);
                                }elseif($model->type==1){
                                    echo Html::textarea('Settings['.$model->id.']',$model->value,['class'=>'form-control','rows'=>3]);
                                }elseif($model->type==2){
                                    echo CKEditor::widget([
                                        'id'=>'Settings'.$model->id,
                                        'name'=>'Settings['.$model->id.']',
                                        'value'=>$model->value,
                                        'editorOptions' => ElFinder::ckeditorOptions('elfinder',['language'=> 'ru',])
                                    ]);
                                }elseif($model->type==3){
                                    echo SwitchInput::widget([
                                        'name' => 'Settings['.$model->id.']',
                                        'value'=>(int)$model->value,
                                        'pluginOptions' => [
                                            'onColor' => 'success',
                                            'offColor' => 'danger',
                                        ]
                                    ]);
                                }elseif($model->type==4){
                                    $pluginOptions=[
                                        'showPreview' => true,
                                        'showCaption' => true,
                                        'showRemove' => true,
                                        'showUpload' => false,
                                        'overwriteInitial'=>true
                                    ];
                                    if(!empty($model->value)){
                                        $pluginOptions['initialPreview']=[Html::img("/files/settings/".$model->value, ['class'=>'file-preview-image'])];
                                    }
                                    echo FileInput::widget([
                                        'name' => 'Settings['.$model->id.']',
                                        'language' => 'ru',
                                        'pluginOptions' => $pluginOptions
                                    ]);
                                }elseif($model->type==5){
                                    echo ColorInput::widget([
                                        'name'=>'Settings['.$model->id.']',
                                        'value'=>$model->value,
                                        'options'=>['readonly'=>true]
                                    ]);
                                }else
                                    echo('<strong class="form-control">Не известный тип поля</strong>');
                                ?>
                                <span style="font-size: 12px;"><?=$model->desc?></span>
                            </div>
                        </div>
                    <?}?>
                </div>                
            <?}?>                                
        <?= Html::endForm()?>
    </div>
</div>
<script>
$(document).ready(function(){
    $(".settings-index ul a:first").parent().addClass('active');
    $("div.tab-panel:first").addClass('active');
})
</script>