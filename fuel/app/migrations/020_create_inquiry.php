<?php

namespace Fuel\Migrations;

class Create_inquiry
{
	public function up()
	{
		\DBUtil::create_table('inquiry', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'address' => array('type' => 'text'),
			'title' => array('type' => 'text'),
			'content' => array('type' => 'text'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('inquiry');
	}
}