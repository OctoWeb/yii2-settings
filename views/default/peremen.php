<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use octoweb\gridsort\SortableGridView as GridView;

$this->title = 'Переменные';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proizvoditel-index">
    <? echo Html::a('Создать', ['peremen-create'], ['class' => 'btn btn-success','style'=>'float:right']);
    echo Html::a('<i class="glyphicon glyphicon-th-list"></i> Группы', ['groups'], ['class' => 'btn btn-info','style'=>'float:right','title'=>'Сортировка груп']);?>
    
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'export'=>false,
        'columns' => [
            [
                'format'=>'html',
                'value'=>function($data){return '<i class="icon-move" style="font-size: 20px"></i>';},
                'options'=>['style'=>'width: 30px;']
            ],
            [
                'attribute' => 'group',
                'value'=>function($data){
                    return $data->getGrouping()->one()->title.' ('.$data->group.')'; 
                },
            ],
            [
                'attribute' => 'type',
                'value'=>function($data) {
                    return $data->types[$data->type];
                },
            ],
            [
                'attribute' => 'param',
                'value'=>function($data){
                    return $data->param; 
                },
            ],
            'label',
           
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update}{delete}',
                'buttons'=>[
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',['peremen-update','id'=>$model->id]);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-trash"></span>',
                            ['peremen-delete','id'=>$model->id],
                            ['data-confirm'=>'Вы уверены, что хотите удалить этот элемент?','data-method'=>'post','data-pjax'=>0]                       
                        );
                    }
                ]
            ],
        ],
    ]); ?>

</div>
