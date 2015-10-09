<?php

namespace octoweb\settings\models;

use Yii;
use octoweb\gridsort\SortableGridBehavior;
/**
 * This is the model class for table "settings".
 *
 * @property integer $id
 * @property integer $group
 * @property integer $type
 * @property string $param
 * @property string $value
 * @property string $default
 * @property string $label
 * @property string $desc
 * @property integer $position
 */
class Settings extends \yii\db\ActiveRecord{
    
    public $types=[0=>'Строка',1=>'Текст',2=>'Текстовый редактор',3=>'ВКЛ/выкл',4=>'Файл',5=>'Цвет'];
    
    public function behaviors(){
        return [
            'sort' => [
                'class' => SortableGridBehavior::className(),
                'sortableAttribute' => 'position'
            ],
        ];
    }
    
    public static function tableName(){
        return 'settings';
    }

    public function rules(){
        return [
            [['group', 'type', 'param', 'label'], 'required'],
            [['type', 'position'], 'integer'],
            [['default', 'value'], 'string'],
            [['group'], 'string', 'max' => 50],
            [['param'], 'string', 'max' => 128],
            [['label', 'desc'], 'string', 'max' => 255],
            
            [['group', 'param'], 'unique', 'targetAttribute' => ['group', 'param'], 'message' => 'В этой группе уже есть параметр с таким именем.']
        ];
    }

    public function attributeLabels(){
        return [
            'id' => Yii::t('app', 'ID'),
            'group' => Yii::t('app', 'Group'),
            'type' => Yii::t('app', 'Type'),
            'param' => Yii::t('app', 'Param'),
            'value' => Yii::t('app', 'Value'),
            'default' => Yii::t('app', 'Default'),
            'label' => Yii::t('app', 'Label'),
            'desc' => Yii::t('app', 'Desc'),
            'position' => Yii::t('app', 'Position'),
        ];
    }
    
    public function getGrouping(){
        return $this->hasOne(SettingGroup::className(), ['name' => 'group']);
    }
    
    public function beforeDelete(){
        if(!parent::beforeDelete())
            return false;
        Settings::deleteDocument();
        return true;
    }
    
    public function deleteDocument(){
        $dir = Yii::getAlias('@frontend/web/files/settings/');
        $documentPath=$dir.$this->value;
        if(is_file($documentPath))
            unlink($documentPath);
    }
}
