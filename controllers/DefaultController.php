<?php

namespace octoweb\settings\controllers;

use Yii;
use octoweb\settings\models\Settings;
use octoweb\settings\models\SettingGroup;
use yii\data\ActiveDataProvider;
use backend\components\MyController as Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use octoweb\gridsort\SortableGridAction;

class DefaultController extends Controller{
    
    public function actions(){
        return [
            'sort' => [
                'class' => SortableGridAction::className(),
                'modelName' => Settings::className(),
            ],
            'sort-group' => [
                'class' => SortableGridAction::className(),
                'modelName' => SettingGroup::className(),
            ],
        ];
    }

    public function actionIndex(){
        
        if(isset($_POST['Settings'])){
            $models = Settings::find()->All();
            foreach($models as $model){
                if($model->type!=4){
                    if(isset($_POST['Settings'][$model->id]) && $_POST['Settings'][$model->id]!=''){
                        if($model->type==3) $model->value='1';
                        else                $model->value=$_POST['Settings'][$model->id];
                    }else{
                        $model->value=null;
                    }
                    $model->save();
                }
            }
        }
        if(isset($_FILES['Settings'])){
            foreach($_FILES['Settings']['name'] as $key=>$id){
                if($image=UploadedFile::getInstanceByName('Settings['.$key.']')){
                    $dir = Yii::getAlias('@frontend/web/files/settings/');
                    $fileName1=pathinfo($image->name);
                    $fileName=md5(microtime()).'.'.$fileName1['extension'];
                    if($image->saveAs($dir.$fileName)){
                        $model=Settings::findOne($key);
                        $model->deleteDocument();
                        $model->value=$fileName;
                        $model->save();
                    }
                }
            }
        }
        
        $groups=SettingGroup::find()->orderBy('position')->All();
        return $this->render('index', ['groups'=>$groups]);
    }
    /** Переменные **/
    public function actionPeremen(){
        $dataProvider = new ActiveDataProvider([
            'query' => Settings::find()->joinWith('grouping')->orderBy('setting_group.position,position'),
            'pagination' => [
                'pageSize' => 10000,
            ],
        ]);
        return $this->render('peremen', ['dataProvider' => $dataProvider]);
    }

    public function actionPeremenCreate(){
        $model = new Settings();

        if ($model->load(Yii::$app->request->post()) && $model->save())
            return $this->redirect(['peremen']);
        
        return $this->render('peremen-create', ['model' => $model]);
    }

    public function actionPeremenUpdate($id){
        $model = Settings::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save())
            return $this->redirect(['peremen']);
        return $this->render('peremen-update', ['model' => $model]);
    }

    public function actionPeremenDelete($id){
        Settings::findOne($id)->delete();
        return $this->redirect(['peremen']);
    }
    
    /** Группы переменных **/
    
    public function actionGroups(){
        $dataProvider = new ActiveDataProvider([
            'query' => SettingGroup::find()->orderBy('position'),
            'pagination' => [
                'pageSize' => 10000,
            ],
        ]);
        return $this->render('groups', ['dataProvider' => $dataProvider]);
    }

    public function actionGroupsCreate(){
        $model = new SettingGroup();

        if ($model->load(Yii::$app->request->post()) && $model->save())
            return $this->redirect(['groups']);
        
        return $this->render('groups-create', ['model' => $model]);
    }

    public function actionGroupsUpdate($name){
        $model = SettingGroup::findOne($name);

        if ($model->load(Yii::$app->request->post()) && $model->save())
            return $this->redirect(['groups']);
        return $this->render('groups-update', ['model' => $model]);
    }

    public function actionGroupsDelete($name){
        SettingGroup::findOne($name)->delete();
        return $this->redirect(['groups']);
    }

    
}
