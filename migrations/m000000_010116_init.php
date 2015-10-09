<?php

use yii\db\Schema;
use yii\db\Migration;

class m000000_010116_init extends Migration {
    
    public $tb_group='setting_group_test';
    public $tb_sett='settings_test';
    

    public function up() {
        $this->createTable($this->tb_group, [
                'name' => 'VARCHAR(50) NOT NULL',
                'title' => 'VARCHAR(50) NULL DEFAULT NULL',
                'position'=>'INT(11) NOT NULL'
            ], "COMMENT'Module Settings Groups'"
        );
        $this->addPrimaryKey('name',$this->tb_group,'name');
        $this->createIndex('name',$this->tb_group,'name',true);
        $this->insert($this->tb_group, ['name'=>'site','title'=>'Сайт','position'=>1]);
		$this->insert($this->tb_group, ['name'=>'sys','title'=>'Системы','position'=>2]);
        $this->insert($this->tb_group, ['name'=>'modules','title'=>'Модули','position'=>3]);
        
        $this->createTable($this->tb_sett, [
                'id'=>Schema::TYPE_PK,
                'group'=>'VARCHAR(50) NOT NULL',
                'param'=>'VARCHAR(128) NOT NULL',
                'type'=>'INT(11) NOT NULL',
                'label'=>'VARCHAR(255) NOT NULL',
            	'desc'=>'VARCHAR(255) NULL DEFAULT NULL',
            	'default'=>'TEXT NULL',
            	'value'=>'TEXT NULL',
            	'position'=>'INT(11) NOT NULL',
            ], "COMMENT'Module Settings'"
        );
        $this->createIndex('group_param',$this->tb_sett,['group','param'],true);
        $this->addForeignKey('FK_'.$this->tb_sett.'_'.$this->tb_group,$this->tb_sett,'group',$this->tb_group,'name');
        
        $this->insert($this->tb_sett, ['id'=>1,'group'=>'site','param'=>'name','type'=>0,'label'=>'Название сайта','desc'=>null,'default'=>'Octo Web','value'=>null,'position'=>0]);
        $this->insert($this->tb_sett, ['id'=>2,'group'=>'site','param'=>'site_mail','type'=>0,'label'=>'E-mail сайта','desc'=>null,'default'=>'mail@domen.ru','value'=>null,'position'=>0]);
        $this->insert($this->tb_sett, ['id'=>3,'group'=>'site','param'=>'phones','type'=>0,'label'=>'Телефоны','desc'=>'Если телефонов несколько основной ставьте первым, ввод телефонов строго через <strong>;</strong>','default'=>'8 (xxx) xxx-xx-xx','value'=>null,'position'=>0]);
        $this->insert($this->tb_sett, ['id'=>4,'group'=>'site','param'=>'adress','type'=>0,'label'=>'Адресс','desc'=>null,'default'=>null,'value'=>null,'position'=>0]);
        $this->insert($this->tb_sett, ['id'=>5,'group'=>'site','param'=>'favicon','type'=>4,'label'=>'Иконка сайта','desc'=>null,'default'=>null,'value'=>null,'position'=>0]);
        $this->insert($this->tb_sett, ['id'=>6,'group'=>'site','param'=>'logo','type'=>4,'label'=>'Логотип сайта','desc'=>null,'default'=>null,'value'=>null,'position'=>0]);
        $this->insert($this->tb_sett, ['id'=>7,'group'=>'site','param'=>'meta_desc','type'=>0,'label'=>'Meta описание','desc'=>'meta description используется для SEO главной страницы','default'=>null,'value'=>null,'position'=>0]);
        $this->insert($this->tb_sett, ['id'=>8,'group'=>'site','param'=>'meta_key','type'=>0,'label'=>'Meta ключи','desc'=>'meta keywords используется для SEO главной страницы','default'=>null,'value'=>null,'position'=>0]);
        $this->insert($this->tb_sett, ['id'=>9,'group'=>'site','param'=>'dop_kods','type'=>1,'label'=>'Коды метрик, счетчиков, онлайн кольсунтантов','desc'=>null,'default'=>null,'value'=>null,'position'=>0]);
        $this->insert($this->tb_sett, ['id'=>10,'group'=>'site','param'=>'map','type'=>1,'label'=>'Карта','desc'=>null,'default'=>null,'value'=>null,'position'=>0]);
        
        $this->insert($this->tb_sett, ['id'=>11,'group'=>'sys','param'=>'smtp','type'=>3,'label'=>'Чере SMTP','desc'=>null,'default'=>null,'value'=>null,'position'=>0]);
        $this->insert($this->tb_sett, ['id'=>12,'group'=>'sys','param'=>'email','type'=>0,'label'=>'Email для отправки почты','desc'=>null,'default'=>'mail@domen.ru','value'=>null,'position'=>0]);
        $this->insert($this->tb_sett, ['id'=>13,'group'=>'sys','param'=>'smtp_host','type'=>0,'label'=>'Smtp host','desc'=>null,'default'=>null,'value'=>null,'position'=>0]);
        $this->insert($this->tb_sett, ['id'=>14,'group'=>'sys','param'=>'smtp_username','type'=>0,'label'=>'Smtp логин','desc'=>null,'default'=>null,'value'=>null,'position'=>0]);
        $this->insert($this->tb_sett, ['id'=>15,'group'=>'sys','param'=>'smtp_password','type'=>0,'label'=>'Smtp пароль','desc'=>null,'default'=>null,'value'=>null,'position'=>0]);
        $this->insert($this->tb_sett, ['id'=>16,'group'=>'sys','param'=>'smtp_port','type'=>0,'label'=>'Smtp порт','desc'=>null,'default'=>null,'value'=>null,'position'=>0]);
        $this->insert($this->tb_sett, ['id'=>17,'group'=>'sys','param'=>'smtp_encryption','type'=>0,'label'=>'Smtp Шифрование','desc'=>null,'default'=>'tls','value'=>null,'position'=>0]);
        $this->insert($this->tb_sett, ['id'=>18,'group'=>'sys','param'=>'watermark','type'=>3,'label'=>'Водяной знак','desc'=>null,'default'=>'tls','value'=>null,'position'=>0]);
        $this->insert($this->tb_sett, ['id'=>19,'group'=>'sys','param'=>'watermark_pos','type'=>3,'label'=>'Позиция знака','desc'=>'top_left,top_right,bottom_left,bottom_right','default'=>'top_left','value'=>null,'position'=>0]);
        $this->insert($this->tb_sett, ['id'=>20,'group'=>'sys','param'=>'watermark_image','type'=>4,'label'=>'Картинка знака','desc'=>null,'default'=>null,'value'=>null,'position'=>0]);
        $this->insert($this->tb_sett, ['id'=>21,'group'=>'sys','param'=>'update','type'=>0,'label'=>'Частота обновлений админки','desc'=>'укажите количество минут','default'=>'5','value'=>null,'position'=>0]);
        
        $this->insert($this->tb_sett, ['id'=>22,'group'=>'modules','param'=>'vip-service-desc','type'=>2,'label'=>'Описание Vip сервиса','desc'=>null,'default'=>null,'value'=>null,'position'=>0]);
    }

    public function down() {
        $this->dropTable('tbl_ym_settings');
    }

}
