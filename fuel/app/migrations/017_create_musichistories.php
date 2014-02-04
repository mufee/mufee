<?php

namespace Fuel\Migrations;

class Create_musichistories
{
	public function up()
	{
		\DBUtil::create_table('musichistories', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
                        'userid' => array('constraint' => 11, 'type'=> 'int'),
			'musicid' => array('constraint' => 11, 'type' => 'int'),
			'artistid' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('musichistories');
	}
}