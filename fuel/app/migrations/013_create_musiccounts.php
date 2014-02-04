<?php

namespace Fuel\Migrations;

class Create_musiccounts
{
	public function up()
	{
		\DBUtil::create_table('musiccounts', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'musicid' => array('constraint' => 11, 'type' => 'int'),
			'count' => array('constraint' => 11, 'type' => 'int'),
			'date' => array('constraint' => 10, 'type' => 'varchar'),

		), array('id'));
	}
	public function down()
	{
		\DBUtil::drop_table('musiccounts');
	}
}