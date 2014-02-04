<?php

class Model_Member extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'artistid',
		'name',
		'charge',
		'imgname',
	);

	protected static $_table_name = 'members';
        
        // メンバー情報取得
        public static function getmember($artistid){
            $result = DB::select("*")->from("members")
                    ->where('artistid', $artistid)
                    ->execute();
            return $result;
        }
        
        //メンバー画像投稿
	public static function insert($artistid,$name,$charge,$imgname)
	{
            $columns = array('artistid', 'name', 'charge', 'imgname');
                $values=array(
                    'artistid' => $artistid,
                    'name'=> $name,
                    'charge' => $charge,
                    'imgname' => $imgname,
                    );
                DB::insert("members")
                        ->columns($columns)
                        ->values($values)
                        ->execute();
	}
        //メンバー画像取得
        public static function getmemberimg($artistid)
        {
            $query = DB::select('imgname','thumbnailpath')->from('artistinfo')
                    ->where('artistid', $artistid)
                    ->execute();
            return $query;
        }

}