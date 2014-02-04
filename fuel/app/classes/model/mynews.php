<?php

use Orm\Model;

class Model_Mynews extends Model {

    //使用するフィールド名をセット
    protected static $_properties = array(
        'artistid',
        'liveid',
        'created_at',
    );

    public static function getNews($userid) {
        $result = DB::select('artistid', 'users.username', 'live.livename')
                ->from('mynews')
                ->join('live')
                ->on('mynews.liveid', '=', 'live.id')
                ->join('users')
                ->on('mynews.artistid', '=', 'users.id')
                ->where('mynews.userid', $userid)
                ->limit(5)
                ->execute();

        return $result;
    }
    
    public static function getNextNews($userid, $page){
        $result = DB::select('artistid', 'users.username', 'live.livename')
                ->from('mynews')
                ->join('live')
                ->on('mynews.liveid', '=', 'live.id')
                ->join('users')
                ->on('mynews.artistid', '=', 'users.id')
                ->where('mynews.userid', $userid)
                ->limit(4)
                ->offset(($page-1)*4)
                ->execute();
        return $result->as_array();
    }

    public static function newsCheck($userid) {

        $query = DB::select('liveid', 'artistid', 'users.username', 'mynews.id')->from('mynews')->
                        join('liveinfo')->on('mynews.liveid', '=', 'live.liveid')->
                        join('users', 'left')->on('users.id', '=', 'liveinfo.artistid')->
                        where('mynews.artistid', $userid)->and_where('mynews.checkflg', 0)->execute();
        return $query;
    }

    public static function insert($userid, $artistid, $liveid) {
        $columns = array('userid', 'artistid', 'liveid');
        $values = array(
            'userid' => $userid,
            'artistid' => $artistid,
            'liveid' => $liveid,
            'created_at' => \Date::forge()->get_timestamp(),
        );
        DB::insert('mynews')->columns($columns)->values($values)->execute();
    }

    public static function deleteNews($artistid, $liveid) {
        DB::delete('mynews')
            ->where('id', $id)
            ->execute();
    }

}