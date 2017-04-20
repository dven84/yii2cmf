<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%area}}`.
 */
class m160722_114202_create_area_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%area}}', [
            'area_id' => 'INT(11) NOT NULL AUTO_INCREMENT',
            'title' => 'VARCHAR(255) NOT NULL',
            'slug' => 'VARCHAR(255) NOT NULL',
            'description' => 'VARCHAR(255) NOT NULL',
            'blocks' => 'VARCHAR(255) NOT NULL',
            'PRIMARY KEY (`area_id`)'
        ], "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB");

        $this->createTable('{{%area_block}}', [
            'block_id' => 'INT(11) NOT NULL AUTO_INCREMENT',
            'title' => 'VARCHAR(255) NOT NULL',
            'type' => 'VARCHAR(50) NULL',
            'widget' => 'TEXT NULL',
            'slug' => 'VARCHAR(255) NOT NULL',
            'config' => 'TEXT NULL',
            'template' => 'TEXT NULL',
            'cache' => 'INT(11) NOT NULL',
            'used' => 'SMALLINT(6) NOT NULL',
            'PRIMARY KEY (`block_id`)'
        ], "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB");

        $this->insert('{{%area}}', [
            'area_id' => '1',
            'title' => 'index-header',
            'slug' => 'index-header',
            'description' => 'default',
            'blocks' => ''
        ]);
        $this->insert('{{%area}}', [
            'area_id' => '2',
            'title' => 'site-index-sidebar',
            'slug' => 'site-index-sidebar',
            'description' => 'site-index-sidebar',
            'blocks' => ''
        ]);
        $this->insert('{{%area}}', [
            'area_id' => '3',
            'title' => 'article-index-sidebar',
            'slug' => 'article-index-sidebar',
            'description' => 'article-index-sidebar',
            'blocks' => ''
        ]);
        $this->insert('{{%area_block}}', [
            'block_id' => '7',
            'title' => 'announcement',
            'type' => 'text',
            'widget' => 'frontend\\widgets\\area\\TextWidget',
            'slug' => 'gong-gao',
            'config' => '',
            'template' => serialize('<p>这里是公告</p>'),
            'cache' => '0',
            'used' => '0'
        ]);
        $this->insert('{{%area_block}}', [
            'block_id' => '9',
            'title' => 'regional testing',
            'type' => 'text',
            'widget' => 'frontend\\widgets\\area\\TextWidget',
            'slug' => 'qu-yu-ce-shi',
            'config' => '',
            'template' => serialize('<p>Block in the are of the sidebar</p>'),
            'cache' => '0',
            'used' => '0'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%area}}');
        $this->dropTable('{{%area_block}}');
    }
}
