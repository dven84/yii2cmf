<?php

use yii\db\Migration;

class m161102_090053_menu extends Migration
{
    public function up()
    {
		$this->execute('SET foreign_key_checks = 0');
        $this->createTable('{{%menu}}', [
            'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
            'name' => 'VARCHAR(128) NOT NULL',
            'parent' => 'INT(11) NULL',
            'route' => 'VARCHAR(256) NULL',
            'order' => 'INT(11) NULL',
            'data' => 'TEXT NULL',
            'icon' => 'VARCHAR(50) NULL',
            'PRIMARY KEY (`id`)'
        ], "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB");

        $this->createIndex('parent','{{%menu}}','parent',0);
        $this->addForeignKey('pop_menu_ibfk_1', '{{%menu}}', 'parent', '{{%menu}}', 'id', 'SET NULL', 'CASCADE' );

        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');

        /* Table yii2cmf_menu */
        $this->batchInsert('{{%menu}}',['id','name','parent','route','order','data','icon'],[
            ['15','/user/admin/index','33','/user/admin/index','1','','fa-user'],
            ['16','/rbac/route/index','33','/rbac/route/index','3','','fa-link'],
            ['17','/rbac/role/index','33','/rbac/role/index','2','','fa-user-md'],
            ['22','/article/index','39','/article/index','1','',''],
            ['24','system','','','1','','fa-cog'],
            ['25','/config/default/index','71','/config/default/index','1','',''],
            ['26','/config/custom/index','71','/config/custom/index','2','',''],
            ['27','/page/index','39','/page/index','39','',''],
            ['29','/category/index','39','/category/index','4','',''],
            ['30','database','','','7','','fa-book'],
            ['31','/backup/export/index','30','/backup/export/index','1','',''],
            ['32','/backup/import/index','30','/backup/import/index','2','',''],
            ['33','user','','','2','','fa-users'],
            ['34','/rbac/menu/index','24','/rbac/menu/index','3','','fa-navicon'],
            ['37','/admin-log/index','24','/admin-log/index','5','','fa-envelope-o'],
            ['39','content','','','4','','fa-edit'],
            ['40','/article/create','39','/article/create','2','','fa-plus'],
            ['41','/article/trash','39','/article/trash','3','',''],
            ['42','/comment/index','39','/comment/index','6','',''],
            ['43','/suggest/index','39','/suggest/index','7','',''],
            ['44','plugins','','','6','','fa-plug'],
            ['45','/plugins/index','44','/plugins/index','','',''],
            ['78','/module/index','44','/module/index','','',''],
            ['46','exterior','','','3','','fa-desktop'],
            ['47','/theme/index','46','/theme/index','4','',''],
            ['48','/carousel/index','46','/carousel/index','5','',''],
            ['49','/nav/index','46','/nav/index','1','',''],
            ['50','/area/area/index','46','/area/area/index','2','',''],
            ['51','/area/block/index','46','/area/block/index','3','',''],
            ['53','/spider/index','39','/spider/index','8','',''],
            ['57','/rbac/rule/index','33','/rbac/rule/index','5','','fa-sitemap'],
            ['58','/rbac/permission/index','33','/rbac/permission/index','4','','fa-check-square'],
            ['66','/message/admin/create','24','/message/admin/create','4','','fa-comment-o'],
            ['67','/log/index','24','/log/index','5','','fa-warning'],
            ['68','/site/dashboard','24','/site/dashboard','1','','fa-dashboard'],
            ['69','GII','24','/gii/default/index','6','',''],
            ['70','/migration/default/index','24','/migration/default/index','7','','fa-external-link'],
            ['71','configuration','','','8','',''],
            ['72','/config/default/database','71','/config/default/database','3','',''],
            ['73','/config/default/mail','71','/config/default/mail','4','',''],
            ['75','/cache/index','24','/cache/index','8','','fa-flash'],
            ['76','/attachment/admin/index','39','/attachment/admin/index','9','','fa-file-picture-o'],
            ['77','/tag/index','39','/tag/index','10','','fa-tags'],
        ]);
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        $this->dropTable('{{%menu}}');
        $this->execute('SET foreign_key_checks = 1;');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
