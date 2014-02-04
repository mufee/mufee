<?php

namespace Fuel\Migrations;

class Create_liveinfo
{
	public function up()
	{
		\DBUtil::create_table('liveinfo', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'liveid' => array('constraint' => 11, 'type' => 'int', 'not_null' => true),
			'artistid' => array('constraint' => 11, 'type' => 'int', 'not_null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('liveinfo');
	}
}