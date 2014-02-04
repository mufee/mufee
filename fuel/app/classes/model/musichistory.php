<?php

class Model_Musichistory extends \Orm\Model {

    protected static $_properties = array(
        'id',
        'userid',
        'musicid',
        'artistid',
        'created_at',
    );
    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array(
            'events' => array('before_insert'),
            'mysql_timestamp' => true,
        ),
    );
    protected static $_table_name = 'musichistories';

    public static function sethistory($userid, $musicid, $artistid) {
        DB::insert('musichistories')
                ->set(array(
                    'userid' => $userid,
                    'musicid' => $musicid,
                    'artistid' => $artistid,
                    'created_at' => time(),
                ))->execute();
    }

    public static function gethistory($userid, $limit = 10) {
        
        $sql = "SELECT mh.artistid, us.username, ms.title, ai.thumbnailname
                FROM (musichistories AS mh JOIN users AS us ON mh.artistid = us.id)
                JOIN music AS ms 
                ON mh.musicid = ms.id
                JOIN artistinfo AS ai
                ON us.id = ai.artistid
                WHERE mh.userid = ". $userid.
                " ORDER BY mh.created_at DESC
                LIMIT ". $limit;
        
        $result = DB::query($sql)->execute();
        
        return $result->as_array();
    }

}
