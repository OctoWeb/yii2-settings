<?php
namespace octoweb\settings\components;

use Yii;
use yii\web\NotFoundHttpException;
//use yii\helpers\ArrayHelper;

use octoweb\settings\models\Settings;

class SettingSite{

    protected $data = [];
 
    public function __construct(){
        $cache=Yii::$app->cache;
        $this->data = $cache->get('settings');
        if ($this->data === false) {
            $items = Settings::find()->all();
            foreach ($items as $item){
                if ($item->param)
                    $this->data[$item->group][$item->param] = ($item->value==null)?$item->default:$item->value;
            }
            $cache->set('settings',$this->data,(defined("YII_DEBUG") && YII_DEBUG)?1:3600);
        }
    }
    
    public function get($group,$key){
        if (array_key_exists($group, $this->data)){
            if(array_key_exists($key, $this->data[$group]))
                return $this->data[$group][$key];
        }
        return false;
    }
    
    public static function has($group,$key){
        $model= new SettingSite;
        return $model->get($group,$key);
    }
 
    /*public function set($group,$key, $value){
        $model = Settings::find()->where(['group'=>$group,'param'=>$key]);
        if (!$model)
            throw new NotFoundHttpException('Неопределенный параметр ' . $key);
 
        $model->value = $value;
 
        if ($model->save())
            $this->data[$group][$key] = $value;
 
    }*/
    
}