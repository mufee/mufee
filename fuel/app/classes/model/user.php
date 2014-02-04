<?php

class Model_User extends \Orm\Model
{
	protected static $_properties = array(
		'username',
		'email',
		'password',
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
	protected static $_table_name = 'users';

        public static function getname($id)
        {
            $query = DB::select('username')->from('users')
                    ->where('id', $id)
                    ->execute();
            return $query;
        }
        public static function getid($name)
        {
            $query = DB::select('id')->from('users')
                    ->where('username', $name)
                    ->execute();
            return $query;
        }
        
        // 石田　2013/12/3　追加
        public static function getGroup($id){
        
            $query = DB::select('group')->from('users')
                    ->where('id', $id)
                    ->execute();
            return $query;
        }
        public static function artistcount(){
        
            $query = DB::select('id')->from('users')
                    ->where('group', 2)
                    ->execute();
            return count($query);
        }
        public static function allusercount(){
        
            $query = DB::select('id')->from('users')
                    ->where('group','!=', 5)
                    ->execute();
            return count($query);
        }
}