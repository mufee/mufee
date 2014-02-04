<?php

class Model_Accesscounter extends Model
{
        
	public static function validate($artistid)
	{
            $columns=array('artistid');
            $values=array('artistid' => $artistid,);
            DB::insert('accesscounter')->columns($columns)->values($values)->execute();
	}
        
        public static function setcount($artistid)
        {
            //今日分のデータがあるか検索
            $query = DB::query("SELECT accessdate,count FROM accesscounter
                            WHERE artistid=".$artistid." && accessdate LIKE '".date("Y-m-d")."%'")
                ->execute();
            
            //データがあるか判定
            if(count($query)>=1)
            {
                //ある場合
                //countをプラスする
                $temp = DB::query("UPDATE accesscounter SET
                                    count = " .($query[0]['count']+1)."
                                    WHERE artistid = '" .$artistid."'
                                    AND accessdate = '" .date("Y-m-d")."'")
                ->execute();
            }
            else 
            {
                //ない場合
                //行を新規作成
                $temp = DB::insert("accesscounter")
                ->set(array(
                    'artistid' => $artistid,
                    'count'   => 1,
                    'accessdate'    => date("Y-m-d"),
                ))->execute();
                
            }
        }
        
        public static function getyaer($artistid)
        {
            
            $query = DB::query("SELECT SUBSTR(accessdate,1,4) as date,Sum(count) as cnt FROM accesscounter
                            WHERE artistid=".$artistid."
                                group by DATE_FORMAT(accessdate, '%Y')")
                ->execute();
            return $query;
        }
        
        public static function getmonth($artistid)
        {

            $query = DB::query("SELECT DATE_FORMAT(accessdate, '%Y-%m') as date, sum(count) as cnt
                                FROM accesscounter
                                WHERE artistid = ".$artistid."
                                and accessdate
                                between date_add('".date("Y-m-d")."',interval -5 MONTH)
                                    and date_add('".date("Y-m-d")."',interval 1 MONTH)
                                GROUP BY
                                DATE_FORMAT(accessdate, '%Y%m')
                                order by date")
                ->execute();
            return $query;
        }
        
        public static function getday($artistid)
        {
            $query = DB::query("SELECT SUBSTR(accessdate,3) as date, count as cnt
                                FROM accesscounter
                                WHERE artistid = ".$artistid."
                                AND accessdate
                                BETWEEN DATE_ADD('".date("Y-m-d")."', INTERVAL -6
                                DAY ) 
                                AND DATE_ADD('".date("Y-m-d")."', INTERVAL 0 
                                DAY )
                                GROUP BY DATE_FORMAT(accessdate, '%Y%m%d')")
                ->execute();
            return $query;
        }
}
?>