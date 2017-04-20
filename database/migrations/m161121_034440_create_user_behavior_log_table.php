<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%user_behavior_log}}`.
 */
class m161121_034440_create_user_behavior_log_table extends Migration
{
    public $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%user_behavior_log}}', [
            'id' => $this->primaryKey(),
            'behavior_name' => $this->string(30)->comment('behavior name'),
            'user_id' => $this->integer(11),
            'content' => $this->text()->comment('content'),
            'created_at' => $this->integer(10)->notNull(),
        ], $this->tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%user_behavior_log}}');
    }
}
