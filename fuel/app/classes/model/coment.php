<?php

class Model_Coment extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'bbsid',
		'title',
                'head',
                'content',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);
	protected static $_table_name = 'coment';
        
        public static function insert($title, $head, $content){
            DB::insert("coment")
                    ->set(array(
                        "title" => $title,
                        "head" => $head,
                        "content" => $content,
                    ))->execute();
        }
        
        public static function select(){
            $result = DB::select("*")
                    ->from("coment")
                    ->execute();
            return $result;
        }
}
