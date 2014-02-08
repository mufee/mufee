<?php

namespace Fuel\Migrations;

class Create_music
{
	public function up()
	{
		\DBUtil::create_table('music', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'title' => array('constraint' => 50, 'type' => 'varchar'),
			'savename' => array('constraint' => 50, 'type' => 'varchar'),
			'genreid' => array('constraint' => 4, 'type' => 'int'),
			'artistid' => array('constraint' => 11, 'type' => 'int'),
			'lyrics' => array('type' => 'text'),
                        'price' => array('constraint' => 4, 'type' => 'int' ,'default' => '0'),
                        'sell' => array('constraint' => "'false','true'", 'type' => 'enum', 'default' => 'false'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('music');
	}
}