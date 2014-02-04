<?php

namespace Fuel\Migrations;

class Create_musicinfo
{
	public function up()
	{
		\DBUtil::create_table('musicinfo', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'musicid' => array('constraint' => 11, 'type' => 'int', 'not_null' => true),
			'musicinfo' => array('type' => 'text'),
			'artistid' => array('constraint' => 11, 'type' => 'int', 'not_null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('musicinfo');
	}
}