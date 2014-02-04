<?php

namespace Fuel\Migrations;

class Create_genre
{
	public function up()
	{
		\DBUtil::create_table('genre', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'genreid' => array('constraint' => 4, 'type' => 'int', 'unique' => true),
			'genrename' => array('constraint' => 10, 'type' => 'varchar'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('genre');
	}
}