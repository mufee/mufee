<?php

class Model_purchase extends \Orm\Model
{
	protected static $_properties = array(
		'userid',
		'musicid',
	);

	protected static $_table_name = 'purchase';

        public static function insert($userid,$musicid)
        {
            $columns=array('userid','musicid');
            $values=array('userid' => $userid,
                    'musicid' => $musicid,
                );
            DB::insert('purchase')->columns($columns)->values($values)->execute();
        }
        //そのユーザーがその音楽を買っているか
        public static function searchpurchase($userid,$musicid)
        {
            $query = DB::select('userid','musicid')->from('purchase')
                    ->where('userid', $userid)
                    ->and_where('musicid', $musicid)
                    ->execute();
            
            if(count($query)==1)
            {
                return TRUE;
            }
            else if(count($query)==0)
            {
                return FALSE;
            }
        }
        //そのユーザーの買っている音楽一覧
        public static function getuser($id)
        {
            $query = DB::select(distinct('userid'),'musicid')->from('purchase')
                    ->where('userid', $id)
                    ->execute();
            return $query;
        }
        //その音楽を買っているユーザー一覧
        public static function getmusic($id)
        {
            $query = DB::select(distinct('musicid'),'userid')->from('purchase')
                    ->where('musicid', $id)
                    ->execute();
            return $query;
        }
        
       
}