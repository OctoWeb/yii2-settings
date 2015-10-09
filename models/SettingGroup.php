<?php
namespace octoweb\settings\models;

use Yii;
use octoweb\gridsort\SortableGridBehavior;

class SettingGroup extends \yii\db\ActiveRecord{

    public static function tableName(){
        return 'setting_group';
    }

    public function behaviors(){
        return [
            'sort' => [
                'class' => SortableGridBehavior::className(),
                'sortableAttribute' => 'position'
            ],
        ];
    }
    
    public function rules(){
        return [
            [['name', 'title'], 'required'],
            [['position'], 'integer'],
            [['name', 'title'], 'string', 'max' => 50],
            [['name'], 'unique']
        ];
    }

    public function attributeLabels(){
        return [
            'name' => Yii::t('app', 'Name'),
            'title' => Yii::t('app', 'Title'),
            'position' => Yii::t('app', 'Position'),
        ];
    }

    public function getSettings(){
        return $this->hasMany(Settings::className(), ['group' => 'name']);
    }
    
    public function beforeDelete(){
        if(!parent::beforeDelete())
            return false;
        foreach($this->getSettings()->All() as $uslug){
            $uslug->delete();
        }
        return true;
    }
    
}
