<?php

namespace Fuel\Migrations;

class Create_accesscounter
{
	public function up()
	{
		\DBUtil::create_table('accesscounter', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'artistid' => array('constraint' => 11, 'type' => 'int'),
			'count' => array('constraint' => 11, 'type' => 'int'),
			'accessdate' => array('constraint' => 10, 'type' => 'varchar'),

		), array('id'));
	}
	public function down()
	{
		\DBUtil::drop_table('accesscounter');
	}
}