<?php

namespace Fuel\Migrations;

class Create_artistinfo
{
	public function up()
	{
		\DBUtil::create_table('artistinfo', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'artistid' => array('constraint' => 11, 'type' => 'int', 'not_null' => true),
			'artistinfo' => array('type' => 'text'),
                        'thumbnailname' => array('constraint' => 100, 'type' => 'varchar', 'default' => 'no_image.jpg'),
                        'thumbnailpath' => array('constraint'=> 255, 'type' => 'varchar'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('artistinfo');
	}
}