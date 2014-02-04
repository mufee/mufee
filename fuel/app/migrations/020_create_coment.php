<?php

namespace Fuel\Migrations;

class Create_coment
{
	public function up()
	{
		\DBUtil::create_table('coment', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
                        'bbsid' => array('constraint' => 11, 'type' => 'int'),
                        'title' => array('constraint' => 50, 'type' => 'varchar'),
                        'head' => array('constraint' => 150, 'type' => 'varchar'),'content' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('coment');
	}
}

?>
