<?php

namespace Fuel\Migrations;

class Create_members
{
	public function up()
	{
		\DBUtil::create_table('members', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'artistid' => array('constraint' => 11, 'type' => 'int'),
			'name' => array('constraint' => 50, 'type' => 'varchar'),
			'charge' => array('type' => 'text'),
			'imgname' => array('constraint' => 50, 'type' => 'varchar', 'default' => 'no_image.jpg'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('members');
	}
}