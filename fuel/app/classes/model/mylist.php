<?php

use Orm\Model;

class Model_Mylist extends Model {

    //使用するフィールド名をセット
    protected static $_properties = array(
        'userid', // ユーザID
        'artistid', //　アーティストID
    );

    public static function validate($artistid) {

        $columns = array('artistid');
        $values = array('artistid' => $artistid
        );

        $query = DB::insert('artistinfo')->columns($columns)->values($values)->execute();
    }

    public static function getuserid($artistid) {
        $result = DB::select('userid')
                ->from('mylists')
                ->where('mylists.artistid', $artistid)
                ->execute();

        return $result;
    }

    public static function check($userid, $artistid) {
        $query = DB::select('*')
                ->from('mylists')
                ->where('mylists.userid', $userid)
                ->and_where('mylists.artistid', $artistid)
                ->execute();

        return $query;
    }

    public static function getNews($newsid) {
        $query = DB::select('users.username')
                ->from('liveinfo')
                ->join('users', 'left')
                ->on('liveinfo.artistid', '=', 'users.id')
                ->where('liveinfo.liveid', $newsid)
                ->execute();

        return $query;
    }

    public static function insertes($userid, $artistid) {
        $colums = array('userid', 'artistid');
        $values = array('userid' => $userid,
            'artistid' => $artistid,
        );
        $query = DB::insert('mylists')->columns($colums)->values($values)->execute();
    }
    public static function deletes($userid, $artistid) {
        $query = DB::delete('mylists')
                ->where('userid', $userid)
                ->and_where('artistid', $artistid)
                ->execute();
    }
            public static function getMylistview($userid){
            $query = DB::select('users.id','users.username')
                    ->from('mylists')
                    ->join('users')
                    ->on('mylists.artistid','=','users.id')
                    ->where('mylists.userid',$userid)
                    ->execute();
            return $query;
    }
	
}
