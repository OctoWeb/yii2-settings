<?php
use yii\helpers\Html;

use octoweb\gridsort\SortableGridView as GridView;

$this->title = 'Группы переменных';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proizvoditel-index">
    <? echo Html::a('Создать', ['groups-create'], ['class' => 'btn btn-success','style'=>'float:right']);
    echo Html::a('<i class="glyphicon glyphicon-th-list"></i> Переменные', ['peremen'], ['class' => 'btn btn-info','style'=>'float:right','title'=>'Сортировка переменных']);?>
    
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'sortableAction'=>['sort-group'],
        'export'=>false,
        'columns' => [
            [
                'format'=>'html',
                'value'=>function($data){return '<i class="icon-move" style="font-size: 20px"></i>';},
                'options'=>['style'=>'width: 30px;']
            ],
            'title',
            'name',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update}{delete}',
                'buttons'=>[
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',['groups-update','name'=>$model->name]);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-trash"></span>',
                            ['groups-delete','name'=>$model->name],
                            ['data-confirm'=>'Вы уверены, что хотите удалить этот элемент?','data-method'=>'post','data-pjax'=>0]                       
                        );
                    }
                ]
            ],
        ],
    ]); ?>
</div>