<?php

class Model_Liveinfo extends Model {

    protected static $_table_name = 'liveinfo';
    
    protected static $_properties = array(
        'id',
        'liveid',
        'artistid',
    );
    
    protected static $_has_one = array(
        'liveinfo' => array(
            'key_from' => 'id',
            'model_to' => 'Model_User',
            'key_to' => 'artist_id',
            'cascade_save' => true,
            'cascade_delete' => false,
        )
    );
    public static function insert($liveid, $artistid) {

        $columns = array('liveid', 'artistid');
        $values = array(
            'liveid' => $liveid,
            'artistid' => $artistid,
        );

        DB::insert('liveinfo')->columns($columns)->values($values)->execute();
    }

    public static function update($artistid, $info) {
        \DB::update('liveinfo')
                ->value('artistinfo', $info)
                ->where('artistid', $artistid)
                ->execute();
    }

    public static function getinfo($artistid) {
        $query = DB::select('liveid', 'artistid')->from('liveinfo')
                ->where('artistid', $artistid)
                ->execute();
        return $query;
    }

    public static function searchartist($artistid) {
        $query = DB::select('*')->from('liveinfo')
                ->where('artistid', $artistid)
                ->execute();

        if ($query[0] === null) {
            return FALSE;
        }
        return TRUE;
    }

    //投稿したliveを削除
    public static function delete($id, $artistid) {
        DB::delete('liveinfo')
                ->where_open()
                ->where('liveid', $id)
                ->and_where('artistid', $artistid)
                ->where_close()
                ->execute();
    }

}

?>
