<?php

class Model_Cdinfo extends Model
{

	public static function validate($cdname,$price,$musicname,$info,$artistid)
	{
            
            $columns=array('cdname','price','musicname','cdinfo','artistid');
            $values=array('cdname' => $cdname,
                          'price' => $price,
                          'musicname' => $musicname,
                          'cdinfo' => $info,
                          'artistid' => $artistid,
                );
            
            DB::insert('cdinfo')->columns($columns)->values($values)->execute();
            
	}

        public static function update($artistid,$cdname,$price,$musicname,$info)
	{
            $columns=array('cdname','price','musicname','info');
            $values=array('cdname' => $cdname,
                          'price' => $price,
                          'musicname' => $musicname,
                          'cdinfo' => $info,
                );
            
            DB::insert('cdinfo')->columns($columns)->values($values)->where('id',$artistid)->execute();
	}
        public static function getinfocdid($cdid)
	{
            $query = DB::select('*')->from('cdinfo')
                    ->where('id', $cdid)
                    ->execute();
            return $query;
	}
        
        public static function getinfoartistid($artistid)
	{
            $query = DB::select('*')->from('cdinfo')
                    ->where('artistid', $artistid)
                    ->execute();
            return $query;
	}
        
        public static function searchartist($artistid)
        {
            $query = DB::select('*')->from('cdinfo')
                    ->where('artistid', $artistid)
                    ->execute();
             
            if($query[0]===null)
            {
                return FALSE;
            }
            return TRUE;
        
        }

        //投稿したcdinfoを削除
        public  static function delete($id,$artistid) {
            DB::delete('cdinfo')
            ->where_open()
            ->where('id',$id)
            ->and_where('artistid', $artistid)
            ->where_close()
            ->execute();
        }
        
}
?>
