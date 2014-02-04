<?php
use Orm\Model;

class Model_Live extends Model
{
	protected static $_properties = array(
		'id',
		'livename',
		'prefecture',
		'date',
		'venue',
		'address',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($live_val)
	{
            $columns=array('livename','prefecture','date','venue','address','url');
            $values=array('livename' => $live_val['livename'],
                          'prefecture' => $live_val['prefecture'],
                          'date' => $live_val['year'].'-'.$live_val['month'].'-'.$live_val['day'],
                          'venue' => $live_val['venue'],
                          'address' => $live_val['address'],
                          'url'=>$live_val['url'],
                );
            
            DB::insert('live')->columns($columns)->values($values)->execute();
	}
        
        // 引数のartistidのアーティストの最新ライブ情報idを返す
        public static function getliveid($artistid){    
            $query = DB::select('id')
                    ->from('live')
                    ->where('id',(DB::select('MAX("liveid") as new')
                                    ->from('liveinfo')
                                    ->where('artistid',$artistid)))
                    ->execute();    
            return $query;
        }
        public static function getalllive()
        {
            $query = DB::select('*')->from('live')
                    ->order_by('id','asc')
                    ->execute();
            
            return $query;
        }
        public static function getartlive($artid)
        {
            $query = DB::select('*')->from('live')
                    ->where('id!=(select liveid from liveinfo where artistid='.$artid.')')
                    ->order_by('id','asc')
                    ->execute();
            
            return $query;
        }
        public static function getlive($id)
        {
            if($id=='')
            {
                
            }
            $query = DB::select('*')->from('live')
                    ->where('id', $id)
                    ->execute();
            
            return $query;
        }
        public static function searchprefecture($artid,$prefecture='')
        {
            if(!empty($prefecture))
            {
                $query = DB::query('select id,livename,prefecture,date,venue,address,url
                                    from live
                                    where id not in(select liveid from liveinfo where artistid='.$artid.')
                                    and prefecture="'.$prefecture.'"
                                    order by id asc')
                ->execute();
            }
            else 
            {
                $query = DB::query('select id,livename,prefecture,date,venue,address,url
                                    from live
                                    where id not in(select liveid from liveinfo where artistid='.$artid.')
                                    order by id asc')
                ->execute();
            }
            return $query;
        }
        public static function liveupdate($id,$live_val)
        {
            $values=array('livename' => $live_val['livename'],
                          'prefecture' => $live_val['prefecture'],
                          'date' => $live_val['year'].'-'.$live_val['month'].'-'.$live_val['day'],
                          'venue' => $live_val['venue'],
                          'address' => $live_val['address'],
                          'url'=>$live_val['url'],
                );
            
            DB::update('live')->set($values)->where('id',$id)->execute();
        }
   
        
}
