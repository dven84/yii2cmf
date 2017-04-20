<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%album}}`.
 */
class m160912_051818_create_album_table extends Migration
{
    public $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%album}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(128)->notNull()->comment('name'),
            'description' => $this->string()->comment('description'),
            'owner_id' => $this->integer(11)->notNull()->comment('owner id'),
            'user_id' => $this->integer(11)->notNull()->comment('user id'),
            'created_at' => $this->integer(10)->notNull(),
            'updated_at' => $this->integer(10)->notNull()
        ], $this->tableOptions);
        $this->createTable('{{%album_attachment}}', [
            'album_id' => $this->integer(11)->notNull()->comment('album ID'),
            'attachment_id' => $this->integer(11)->notNull()->comment('attachment ID'),
        ], $this->tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%album}}');
        $this->dropTable('{{%album_attachment}}');
    }
}
