<?php
use Orm\Model;

class Model_Genre extends Model
{
	protected static $_properties = array(
		'id',
		'genreid',
		'genrename',
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

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('genreid', 'Genreid', 'required|valid_string[numeric]');
		$val->add_field('genrename', 'Genrename', 'required|max_length[10]');

		return $val;
	}
        
        public static function start()
        {
            $query = DB::select('*')->from('genre')
                    ->where('genreid', 1000)
                    ->execute();
             
            if(count($query)===1)
            {
                
            }
            else
            {
                $seeds = array(  
                array(
                    'genreid' => 1000,
                    'genrename' => 'ポップ',
                ), 
                array(
                    'genreid' => 2000,
                    'genrename' => 'バラード',
                ), 
                array(
                    'genreid' => 3000,
                    'genrename' => 'テクノ',
                ),
                array(
                    'genreid' => 4000,
                    'genrename' => 'ロック',
                ),
                array(
                    'genreid' => 5000,
                    'genrename' => 'レゲエ',
                ));
                foreach ($seeds as $seed) {
                            DB::insert('genre')->columns(array('genreid','genrename'))->values($seed)->execute();
                }
            }  
        }
        
}
