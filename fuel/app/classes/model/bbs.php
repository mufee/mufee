<?php

class Model_Bbs extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'title',
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
	protected static $_table_name = 'bbs';
        
        public static function insert($title, $head, $content){
            DB::insert("bbs")
                    ->set(array(
                        "title" => $title,
                        "head" => $head,
                        "content" => $content,
                    ))->execute();
        }
        
        public static function select(){
            $result = DB::select("*")
                    ->from("bbs")
                    ->execute();
            return $result;
        }
        
        public static function getsled($id)
        {
            $result = DB::select("*")
                    ->from("bbs")
                    ->where('id','=',$id)
                    ->execute();
            return $result;
        }

}
