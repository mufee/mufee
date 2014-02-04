<?php

class Model_Inquiry extends Model
{
        
	public static function validate($cont)
	{
            
            $columns=array('address','title','content');
            $values=array('address' => $cont['address'],
                          'title' => $cont['title'],
                          'content' => $cont['content'],
                );
            DB::insert('inquiry')->columns($columns)->values($values)->execute();
            
	}
        public static function getinquiry($id)
        {
            $query = DB::select('*')->from('inquiry')
                    ->where('id',$id)
                    ->execute();
            return $query;
        }
        public static function getallinquiry()
        {
            $query = DB::select('*')->from('inquiry')
                    ->order_by('id', 'desc')
                    ->execute();
            return $query;
        }
        
        public static function delete($id) {
            DB::delete('inquiry')
            ->where('id',$id)
            ->execute();
        }
        
}
?>
