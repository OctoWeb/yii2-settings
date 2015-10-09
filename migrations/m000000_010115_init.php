<?php

use yii\db\Schema;
use yii\db\Migration;

class m000000_010115_init extends Migration {

    public function safeUp() {
        $this->createTable('setting_group', [
                'name' => Schema::TYPE_PK,
                'title' => Schema::TYPE_STRING,
                'position'=>Schema::TYPE_INTEGER
            ], "COMMENT'Module Settings Groups'"
        );
        $this->insert('settings', ['name'=>'site','title'=>'Сайт','position'=>1]);
		$this->insert('settings', ['name'=>'sys','title'=>'Системы','position'=>2]);
        $this->insert('settings', ['name'=>'modules','title'=>'Модули','position'=>3]);
        
        /*$this->createTable('settings', [
                'id'=>'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
                'group'=>'VARCHAR(50) NOT NULL',
                'param'=>'VARCHAR(128) NOT NULL'
            ], "COMMENT'Module Settings'"
        );
        $this->insert('settings', ['name'=>'site','title'=>'Сайт','position'=>1]);
		$this->insert('settings', ['name'=>'sys','title'=>'Системы','position'=>2]);
        $this->insert('settings', ['name'=>'modules','title'=>'Модули','position'=>3]);*/
    }

    public function down() {
        $this->dropTable('tbl_ym_settings');
    }

}
