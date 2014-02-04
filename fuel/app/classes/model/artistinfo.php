<?php

class Model_Artistinfo extends Model
{
        protected static $_table_name = 'artistinfo';
        
        protected static $_properties = array(
		'id',
		'artistid',
		'artistinfo',
                'thumnailname',
                'thumnailpath',
	);
        
        protected static $_has_one = array(
            'artistinfo' => array(
                'key_from' => 'id',
                'model_to' => 'Model_User',
                'key_to' => 'artist_id',
                'cascade_save' => true,
                'cascade_delete' => false,
            )
        );
        
	public static function validate($artistid)
	{
            
            $columns=array('artistid','artistinfo','thumbnailpath');
            $values=array('artistid' => $artistid,
                    'artistinfo' => "",
                    'thumbnailpath' => "",
                );
            DB::insert('artistinfo')->columns($columns)->values($values)->execute();
	}

        public static function update($artistid,$info)
	{
            \DB::update('artistinfo')
            ->value('artistinfo', $info)
            ->where('artistid',$artistid)
            ->execute();
            
            
	}
        public static function getinfo($artistid)
	{
            $query = DB::select('artistinfo','users.username')
                    ->from('artistinfo')
                    ->join('users')
                    ->on('artistinfo.artistid', "=", "users.id")
                    ->where('artistid', $artistid)
                    ->execute();
            return $query;
	}	
        
        public static function searchartist($artistid)
        {
            $query = DB::select('*')->from('artistinfo')
                    ->where('artistid', $artistid)
                    ->execute();
             
            if($query[0]===null)
            {
                return FALSE;
            }
            return TRUE;
        }
        
        //サムネイル投稿
	public static function thumbnailupload($savename,$filepath,$artistid)
	{
                $values=array(
                    'thumbnailname'=>$savename,
                    'thumbnailpath'=>$filepath,
                    );
                DB::update('artistinfo')->set($values)->where('artistid','=',$artistid)->execute();
            
	}
        
        //artistのサムネイル取得
        public static function getartisthumbnail($artistid)
        {
            $query = DB::select('thumbnailname','thumbnailpath')->from('artistinfo')
                    ->where('artistid', $artistid)
                    ->execute();
            return $query;
        }

}
?>
