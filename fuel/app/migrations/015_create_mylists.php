<?php

namespace Fuel\Migrations;

class Create_mylists
{
	public function up()
	{
		\DBUtil::create_table('mylists', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'userid' => array('constraint' => 11, 'type' => 'int'),
			'artistid' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('mylists');
	}
}