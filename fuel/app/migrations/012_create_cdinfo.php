<?php

namespace Fuel\Migrations;

class Create_cdinfo
{
	public function up()
	{
		\DBUtil::create_table('cdinfo', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'cdname' => array('type' => 'text'),
			'price' => array('constraint' => 6, 'type' => 'int'),
                        'musicname' => array('type' => 'text'),
			'cdinfo' => array('type' => 'text'),
			'artistid' => array('constraint' => 11, 'type' => 'int', 'not_null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('cdinfo');
	}
}