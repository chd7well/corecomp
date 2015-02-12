<?php

use yii\db\Schema;
use yii\db\Migration;
use chd7well\corecomp\migrations;


class m150211_084745_init extends Migration
{
    public function up()
    {
    	$this->createTable('{{%mkt_corecomp_profile}}', [
    			'ID'                    => Schema::TYPE_PK,
    			'user_ID'             		=> Schema::TYPE_INTEGER . ' NOT NULL',
    			'profilename'           => Schema::TYPE_STRING . '(255) NOT NULL',
    			'comment'		   		=> Schema::TYPE_STRING . '(255) ',
    			'created_at'			   => Schema::TYPE_DATETIME,
    	]);
    	$this->createTable('{{%mkt_corecomp_practice}}', [
    			'ID'                    => Schema::TYPE_PK,
    			'profile_ID'             		=> Schema::TYPE_INTEGER . ' NOT NULL',
    			'practicename'           => Schema::TYPE_STRING . '(255) NOT NULL',
    			'expertise'		   		=> Schema::TYPE_INTEGER . ' NOT NULL ',
    			'specifics'		   		=> Schema::TYPE_INTEGER . ' NOT NULL ',
    			'funfactor'		   		=> Schema::TYPE_INTEGER . ' NOT NULL '
    	]);
    	
    	$this->addForeignKey('fk_mkt_corecomp_practice_mkt_corecomp_profile', '{{%mkt_corecomp_practice}}', 'profile_ID', '{{%mkt_corecomp_profile}}', 'ID', 'CASCADE');
    	$this->addForeignKey('fk_mkt_corecomp_profile_sys_user', '{{%mkt_corecomp_profile}}', 'user_ID', '{{%sys_user}}', 'id', 'CASCADE');
    }

    public function down()
    {
                $this->dropTable('{{%mkt_corecomp_practice}}');
        $this->dropTable('{{%mkt_corecomp_profile}}');
    }
}
