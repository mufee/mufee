<?php

namespace Fuel\Migrations;

class Create_thumbnailtable
{
	public function up()
	{
		\DBUtil::create_table('thumbnailtable', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'thumbnailname' => array('constraint' => 50, 'type' => 'varchar'),
			'path' => array('constraint' => 50, 'type' => 'varchar'),
			'artistid' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('thumbnailtable');
	}
}