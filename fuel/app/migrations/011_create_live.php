<?php

namespace Fuel\Migrations;

class Create_live
{
	public function up()
	{
		\DBUtil::create_table('live', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'livename' => array('type' => 'text'),
			'prefecture' => array('constraint' => 10, 'type' => 'varchar'),
			'date' => array('type' => 'date'),
			'venue' => array('type' => 'text'),
			'address' => array('type' => 'text'),
                        'url' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('live');
	}
}