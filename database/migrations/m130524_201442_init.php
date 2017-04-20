<?php

use yii\db\Migration;
use yii\db\Schema;

class m130524_201442_init extends Migration
{
    public $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

    public function safeUp()
    {
        $this->execute('SET foreign_key_checks = 0');
        // admin_log
        $this->createTable('{{%admin_log}}', [
            'id' => Schema::TYPE_PK,
            'route' => Schema::TYPE_STRING . "(255) NOT NULL DEFAULT ''",
            'description' => Schema::TYPE_TEXT . " NULL",
            'created_at' => Schema::TYPE_INTEGER . "(10) NOT NULL",
            'user_id' => Schema::TYPE_INTEGER . "(10) NOT NULL DEFAULT '0'",
            'ip' => Schema::TYPE_INTEGER . "(10) NOT NULL DEFAULT '0'",
        ], $this->tableOptions);

// article
        $this->createTable('{{%article}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . "(50) NOT NULL COMMENT 'title'",
            'category' => Schema::TYPE_STRING . "(50) NOT NULL COMMENT 'category'",
            'category_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
            'status' => Schema::TYPE_BOOLEAN . " NOT NULL COMMENT 'status'",
            'view' => Schema::TYPE_INTEGER . "(11) NOT NULL DEFAULT '0'",
            'is_top' => $this->smallInteger(1)->notNull()->defaultValue(0)->comment('Is top'),
            'is_hot' => $this->smallInteger(1)->notNull()->defaultValue(0)->comment('Is hot'),
            'is_best' => $this->smallInteger(1)->notNull()->defaultValue(0)->comment('Is best'),
            'description' => $this->string(255)->notNull()->defaultValue('')->comment('description'),
            'user_id' => Schema::TYPE_INTEGER . "(11) NOT NULL DEFAULT '0'",
            'source' => $this->string(255)->notNull()->defaultValue('')->comment('source'),
            'deleted_at' => Schema::TYPE_INTEGER . "(10)",
            'favourite' => Schema::TYPE_INTEGER . "(11) NOT NULL DEFAULT '0'",
            'published_at' => Schema::TYPE_INTEGER . "(10) NOT NULL DEFAULT '0'",
            'created_at' => Schema::TYPE_INTEGER . "(10) NOT NULL",
            'updated_at' => Schema::TYPE_INTEGER . "(10) NOT NULL",
        ], $this->tableOptions);
        $this->createIndex('index_published_at', '{{%article}}', 'published_at');
// article_data
        $this->createTable('{{%article_data}}', [
            'id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
            'content' => Schema::TYPE_TEXT . " NOT NULL",
            'markdown' => $this->smallInteger(1)->notNull()->defaultValue(0)->comment('markdown'),
            'PRIMARY KEY (id)',
        ], $this->tableOptions);

// article_tag
        $this->createTable('{{%article_tag}}', [
            'article_id' => Schema::TYPE_INTEGER . "(10) NOT NULL",
            'tag_id' => Schema::TYPE_INTEGER . "(10) NOT NULL",
        ], $this->tableOptions);
// meta
        $this->createTable('{{%meta}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128),
            'keywords' => $this->string(128),
            'description' => $this->string(128),
            'entity' => $this->string(80),
            'entity_id' => $this->integer()
        ], $this->tableOptions);
// auth
        $this->createTable('{{%auth}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
            'source' => Schema::TYPE_STRING . "(255) NOT NULL",
            'source_id' => Schema::TYPE_STRING . "(255) NOT NULL",
        ], $this->tableOptions);

// category
        $this->createTable('{{%category}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . "(50) NOT NULL COMMENT 'title'",
            'pid' => Schema::TYPE_INTEGER . "(11) NOT NULL DEFAULT '0' COMMENT 'pid'",
            'created_at' => Schema::TYPE_INTEGER . "(10) NOT NULL",
            'updated_at' => Schema::TYPE_INTEGER . "(10) NOT NULL",
            'slug' => Schema::TYPE_STRING . "(20) NOT NULL",
            'description' => Schema::TYPE_STRING . "(1000) NOT NULL DEFAULT ''",
            'article' => Schema::TYPE_INTEGER . "(10) NOT NULL DEFAULT '0'",
            'sort' => Schema::TYPE_BOOLEAN . " NOT NULL DEFAULT '0'",
            'allow_publish' => $this->smallInteger(1)->defaultValue('1')->comment('Allow published')
        ], $this->tableOptions);

// comment
        $this->createTable('{{%comment}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
            'user_ip' => $this->string(20)->comment('User ip')->defaultValue(''),
            'entity' => Schema::TYPE_STRING . "(80) NOT NULL",
            'entity_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
            'content' => Schema::TYPE_TEXT . " NOT NULL COMMENT 'content'",
            'parent_id' => Schema::TYPE_INTEGER . "(11) NOT NULL DEFAULT '0'",
            'reply_uid' => $this->integer(11)->defaultValue('0'),
            'is_top' => Schema::TYPE_SMALLINT . "(1) NOT NULL DEFAULT '0'",
            'status' => Schema::TYPE_SMALLINT . "(1) NOT NULL DEFAULT '1'",
            'created_at' => Schema::TYPE_INTEGER . "(10) NOT NULL",
            'updated_at' => Schema::TYPE_INTEGER . "(10) NOT NULL",
        ], $this->tableOptions);
        $this->createIndex('entity', '{{%comment}}', ['entity', 'entity_id']);
// comment_info
        $this->createTable('{{%comment_info}}', [
            'id' => Schema::TYPE_PK,
            'entity' => $this->string(80)->notNull(),
            'entity_id' => $this->integer(11)->notNull(),
            'status' => $this->boolean()->notNull()->defaultValue(1),
            'total' => $this->integer(11)->notNull()
        ], $this->tableOptions);
        $this->createIndex('entity', '{{%comment_info}}', ['entity', 'entity_id']);
// favourite
        $this->createTable('{{%favourite}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
            'article_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
            'created_at' => Schema::TYPE_INTEGER . "(10) NOT NULL",
        ], $this->tableOptions);

// gather
        $this->createTable('{{%gather}}', [
            'id' => Schema::TYPE_PK,
            'url_org' => Schema::TYPE_STRING . "(255) NOT NULL",
            'created_at' => Schema::TYPE_INTEGER . "(10) NOT NULL",
            'updated_at' => Schema::TYPE_INTEGER . "(10) NOT NULL",
        ], $this->tableOptions);

// page
        $this->createTable('{{%page}}', [
            'id' => Schema::TYPE_PK,
            'use_layout' => Schema::TYPE_BOOLEAN . " NOT NULL DEFAULT '1' COMMENT '0: Not use 1: Use'",
            'content' => Schema::TYPE_TEXT . " NOT NULL COMMENT 'content'",
            'title' => Schema::TYPE_STRING . "(50) NOT NULL COMMENT 'title'",
            'slug' => Schema::TYPE_STRING . "(50) NOT NULL DEFAULT ''",
            'markdown' => $this->smallInteger(1)->defaultValue(0)->comment('markdown'),
            'created_at' => Schema::TYPE_INTEGER . "(10) NULL",
            'updated_at' => Schema::TYPE_INTEGER . "(10) NULL",
        ], $this->tableOptions);

// reward
        $this->createTable('{{%reward}}', [
            'id' => Schema::TYPE_PK,
            'article_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
            'user_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
            'money' => Schema::TYPE_INTEGER . "(11) NOT NULL",
            'comment' => $this->string(50)->defaultValue('')->comment('comment'),
            'created_at' => Schema::TYPE_INTEGER . "(10) NOT NULL",
            'updated_at' => Schema::TYPE_INTEGER . "(10) NOT NULL",
        ], $this->tableOptions);

// sign 签到表
        $this->createTable('{{%sign}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
            'last_sign_at' => Schema::TYPE_INTEGER . "(10) NOT NULL COMMENT 'Last sign up'",
            'times' => Schema::TYPE_INTEGER . "(11) NOT NULL COMMENT 'times'",
            'continue_times' => Schema::TYPE_INTEGER . "(11) NOT NULL COMMENT 'continue times'",
        ], $this->tableOptions);

// spider
        $this->createTable('{{%spider}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . "(20) NOT NULL COMMENT 'Name'",
            'title' => Schema::TYPE_STRING . "(100) NOT NULL COMMENT 'title'",
            'domain' => Schema::TYPE_STRING . "(255) NOT NULL COMMENT 'domain'",
            'page_dom' => Schema::TYPE_STRING . "(255) NOT NULL COMMENT 'page dom'",
            'list_dom' => Schema::TYPE_STRING . "(255) NOT NULL COMMENT 'list dom'",
            'time_dom' => Schema::TYPE_STRING . "(255) NULL COMMENT 'time dom'",
            'content_dom' => Schema::TYPE_STRING . "(255) NOT NULL COMMENT 'content dom'",
            'title_dom' => Schema::TYPE_STRING . "(255) NOT NULL COMMENT 'title dom'",
            'target_category' => Schema::TYPE_STRING . "(255) NOT NULL COMMENT 'target category'",
            'target_category_url' => Schema::TYPE_STRING . "(255) NOT NULL COMMENT 'target category url'",
        ], $this->tableOptions);

// system_log
        $this->createTable('{{%system_log}}', [
            'id' => Schema::TYPE_BIGPK,
            'level' => Schema::TYPE_INTEGER . "(11) NULL",
            'category' => Schema::TYPE_STRING . "(255) NULL",
            'log_time' => Schema::TYPE_DOUBLE . " NULL",
            'prefix' => Schema::TYPE_TEXT . " NULL",
            'message' => Schema::TYPE_TEXT . " NULL",
        ], $this->tableOptions);

// tag
        $this->createTable('{{%tag}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . "(100) NOT NULL",
            'article' => Schema::TYPE_INTEGER . "(11) NOT NULL DEFAULT '0' COMMENT 'article'",
        ], $this->tableOptions);

// vote
        $this->createTable('{{%vote}}', [
            'id' => Schema::TYPE_PK,
            'entity' => Schema::TYPE_STRING . "(80) NOT NULL",
            'entity_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
            'user_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
            'created_at' => Schema::TYPE_INTEGER . "(10) NOT NULL",
            'updated_at' => Schema::TYPE_INTEGER . "(10) NOT NULL",
            'action' => Schema::TYPE_STRING . "(20) NOT NULL DEFAULT 'up' COMMENT 'up or down'",
        ], $this->tableOptions);
//vote_info
        $this->createTable('{{%vote_info}}', [
            'id' => Schema::TYPE_PK,
            'entity' => $this->string(80)->notNull(),
            'entity_id' => $this->integer(11)->notNull(),
            'up' => $this->integer(11)->notNull()->defaultValue('0')->comment('up'),
            'down' => $this->integer(11)->notNull()->defaultValue('0')->comment('down'),
        ], $this->tableOptions);
        $this->createIndex('entity', '{{%vote_info}}', ['entity', 'entity_id']);
        $this->insert('{{%page}}', [
            'use_layout' => 1,
            'content' => 'content',
            'title' => 'title',
            'slug' => 'aboutus',
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->insert('{{%category}}', [
            'slug' => 'default',
            'title' => 'default',
            'allow_publish' => '2',
            'created_at' => time(),
            'updated_at' => time()
        ]);
        $this->execute('SET foreign_key_checks = 1');
    }

    public function safeDown()
    {
        $this->execute('SET foreign_key_checks = 0');
        $this->dropTable('{{%admin_log}}');
        $this->dropTable('{{%article}}');
        $this->dropTable('{{%article_data}}');
        $this->dropTable('{{%article_tag}}');
        $this->dropTable('{{%meta}}');
        $this->dropTable('{{%auth}}');
        $this->dropTable('{{%category}}');
        $this->dropTable('{{%comment}}');
        $this->dropTable('{{%comment_info}}');
        $this->dropTable('{{%favourite}}');
        $this->dropTable('{{%gather}}');
        $this->dropTable('{{%page}}');
        $this->dropTable('{{%reward}}');
        $this->dropTable('{{%sign}}');
        $this->dropTable('{{%spider}}');
        $this->dropTable('{{%system_log}}');
        $this->dropTable('{{%tag}}');
        $this->dropTable('{{%vote}}');
        $this->dropTable('{{%vote_info}}');
        $this->execute('SET foreign_key_checks = 1');
    }
}
