<?php

class Model_Musiccount extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'musicid',
                'count',
                'date',
	);
        

	protected static $_table_name = 'musiccounts';

        public static function setcount($musicid)
        {
            //今月分のデータがあるか検索
            $query = DB::query("SELECT date,count FROM musiccounts
                            WHERE musicid=".$musicid." && date LIKE '".date("Y-m")."%'")
                ->execute();
            
            //データがあるか判定
            if(count($query)>=1)
            {
                //ある場合
                //countをプラスする
                $temp = DB::query("UPDATE musiccounts SET
                                    count = " .($query[0]['count']+1)."
                                    WHERE musicid = '" .$musicid."'
                                    AND date = '" .date("Y-m")."'")
                ->execute();
            }
            else 
            {
                //ない場合
                //行を新規作成
                $temp = DB::insert("musiccounts")
                ->set(array(
                    'musicid' => $musicid,
                    'count'   => 1,
                    'date'    => date("Y-m"),
                ))->execute();
                
            }
        }
        
        public static function getcount($musicid)
        {
            
            $query = DB::select('count')->from('musiccounts')
                    ->where('misicid', $musicid)
                    ->execute();
            return $query;
        }
        
        public static function getyaer($musicid)
        {
            
            $query = DB::query("SELECT SUBSTR(date,1,4) as date,Sum(count) as cnt FROM musiccounts
                                WHERE musicid=".$musicid." group by SUBSTR(date,1,4)")
                ->execute();
            return $query;
        }
        
        public static function getmonth($musicid)
        {

            $query = DB::query("SELECT date,count as cnt FROM musiccounts
                            WHERE musicid=".$musicid." group by date order by date asc")
                ->execute();
            
            return $query;
        }
}
