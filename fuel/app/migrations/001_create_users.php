<?php

namespace Fuel\Migrations;

class Create_users
{
	public function up()
	{
		\DBUtil::create_table('users', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'username' => array('constraint' => 50, 'type' => 'varchar', 'not null' => true, 'character set' => 'utf8'),
			'password' => array('constraint' => 255, 'type' => 'varchar', 'not null' => true, 'character set' => 'utf8'),
                        'group' => array('constraint' => 11, 'type' => 'int', 'not null' => true, 'default' => 1),
                        'email' => array('constraint' => 255, 'type' => 'varchar', 'not null' => true, 'character set' => 'utf8'),
                        'last_login' => array('constraint' => 25, 'type' => 'varchar', 'not null' => true, 'character set' => 'utf8'),
                        'login_hash' => array('constraint' => 255, 'type' => 'varchar', 'not null' => true, 'character set' => 'utf8'),
                        'profile_fields' => array('type' => 'text', 'not null' => true, 'character set' => 'utf8'),
                        'created_at' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true, 'not null' => true),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('users');
	}
}