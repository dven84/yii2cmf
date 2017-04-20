<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%config}}`.
 */
class m160728_025305_create_config_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        // config
        $this->createTable('{{%config}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->comment('name'),
            'value' => $this->text()->comment('value'),
            'extra' => $this->text()->notNull(),
            'description' => $this->string(255)->comment('description'),
            'type' => $this->string(30)->defaultValue('text')->comment('type'),
            'created_at' => $this->integer(10)->notNull(),
            'updated_at' => $this->integer(10)->notNull(),
            'group' => $this->string(30)->defaultValue('system')->comment('group')
        ], $tableOptions);
        $this->execute(<<<SQL
INSERT INTO {{%config}} VALUES (1,'CONFIG_TYPE_LIST','text=>text\r\narray=>array\r\npassword=>password\r\nimage=>image\r\ntextarea=>textarea\r\nselect=>select\r\nradio=>radio\r\ncheckbox=>checkbox\r\neditor=>editor','','CONFIG_TYPE_LIST','array',0,1461937892,'system'),
(2,'CONFIG_GROUP','site=>site\r\nsystem=>system\r\nwechat=>wechat','','CONFIG_GROUP','array',1468405444,1468421137,'system'),
(3,'SITE_NAME','yii2cmf','','SITE_NAME','text',0,1461937892,'site'),
(4,'SITE_ICP','','','SITE_ICP','text',0,1461937892,'site'),
(5,'SITE_LOGO','','','SITE_LOGO','image',0,1461937892,'site'),
(6,'SEO_SITE_DESCRIPTION','yiicmf2','','meta description','text',0,1468403120,'site'),
(7,'SEO_SITE_KEYWORDS','yiicmf','','meta keywords','text',0,1461937892,'site'),
(8,'FOOTER','','','FOOTER','textarea',0,1461937892,'site'),
(9,'THEME_NAME','basic','','THEME_NAME','text',0,1467882452,'site'),
(10,'BACKEND_SKIN','skin-purple','skin-black=>skin-black\r\nskin-black-light=>skin-black-light\r\nskin-blue=>skin-blue\r\nskin-blue-light=>skin-blue-light\r\nskin-green=>skin-green\r\nskin-green-light=>skin-green-light\r\nskin-purple=>skin-purple\r\nskin-pruple-light=>skin-purple-light\r\nskin-red=>skin-red\r\nskin-red-light=>skin-red-light\r\nskin-yellow=>skin-yellow\r\nskin-yellow-light=>skin-yellow-light','BACKEND_SKIN','select',1461931367,1461937892,'system'),
(11,'wx_token','','','wx_token','text',0,1468406411,'wechat'),
(12,'editor.type_list','markdown=>markdown\r\nredactor=>redactor','','editor.type_list','array',0,1468406411,'system'),
(13,'editor.type_article','redactor','editor.type_list','editor.type_article','select',0,1468406411,'system'),
(14,'editor.type_page','redactor','editor.type_list','editor.type_page','select',0,1468406411,'system');
SQL
);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%config}}');
    }
}
