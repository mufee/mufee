<?php

class Model_Less extends \Orm\Model
{
	protected static $_properties = array(
		'id',
                'bbsid',
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
	protected static $_table_name = 'less';
        
        public static function insert($id,$title,$content){
            DB::insert("less")
                    ->set(array(
                        "bbsid" => $id,
                        "title" => $title,
                        "content" => $content,
                    ))->execute();
        }
        
        public static function selectall(){
            $result = DB::select("*")
                    ->from("less")
                    ->execute();
            return $result;
        }
        
        public static function select($id){
            $result = DB::select("*")
                    ->from("less")
                    ->where("bbsid", "=", $id)
                    ->execute();
            return $result;
        }

}
