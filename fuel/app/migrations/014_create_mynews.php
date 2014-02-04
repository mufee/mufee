<?php

namespace Fuel\Migrations;

class Create_mynews
{
	public function up()
	{
		\DBUtil::create_table('mynews', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
                        'userid' => array('constraint' => 11, 'type' => 'int'),
			'artistid' => array('constraint' => 11, 'type' => 'int'),
			'liveid' => array('constraint' => 11, 'type' => 'int'),
                        'created_at' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true, 'not null' => true),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('mynews');
	}
}