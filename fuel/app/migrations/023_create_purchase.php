<?php

namespace Fuel\Migrations;

class Create_purchase
{
	public function up()
	{
		\DBUtil::create_table('purchase', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'userid' => array('constraint' => 11, 'type' => 'int'),
			'musicid' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('purchase');
	}
}