<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%article_module}}`.
 */
class m160718_040058_create_article_module_table extends Migration
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
        $this->createTable('{{%article_module}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50),
            'title' => $this->string(50),
        ], $tableOptions);
        $this->createTable('{{%article_exhibition}}', [
            'id' => $this->integer(11)->unique(),
            'start_at' => $this->dateTime()->comment('start at'),
            'end_at' => $this->dateTime()->comment('end at'),
            'city' => $this->string(50)->comment('city'),
            'address' => $this->string(255)->comment('address')
        ], $tableOptions);
        $moduleColumn = new \yii\db\ColumnSchemaBuilder('string');
        $moduleColumn->comment('document type');
        $moduleColumn->defaultValue('base');// 默认普通文章
        $this->addColumn('{{%article}}', 'module', $moduleColumn);
        $this->addColumn('{{%category}}', 'module', $moduleColumn);
        $this->createTable('{{%article_download}}', [
            'id' => $this->integer(11)->unique(),
            'content' => $this->text(),
        ], $tableOptions);
        $this->createTable('{{%article_photo}}', [
            'id' => $this->integer(11)->unique(),
        ], $tableOptions);
        $this->insert('{{%article_module}}', [
            'name' => 'base',
            'title' => 'base',
        ]);
        $this->insert('{{%article_module}}', [
            'name' => 'exhibition',
            'title' => 'exhibition',
        ]);
        $this->insert('{{%article_module}}', [
            'name' => 'download',
            'title' => 'download',
        ]);
        $this->insert('{{%article_module}}', [
            'name' => 'photo',
            'title' => 'photo',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%article_module}}');
        $this->dropTable('{{%article_exhibition}}');
        $this->dropTable('{{%article_download}}');
        $this->dropTable('{{%article_photo}}');
        $this->dropColumn('{{%article}}', 'module');
        $this->dropColumn('{{%category}}', 'module');
    }
}
