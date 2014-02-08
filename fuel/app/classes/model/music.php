<?php

use Orm\Model;

class Model_Music extends Model {

    protected static $_properties = array(
        'id',
        'title',
        'path',
        'genreid',
        'artistid',
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
    protected static $_table_name = 'music';
    protected static $_has_many = array(
        'comments' => array(
            'key_from' => 'id',
            'model_to' => 'Model_User',
            'key_to' => 'artistid',
            'cascade_save' => true,
            'cascade_delete' => false,
        )
    );

    public static function getOneMusic($savename) {
        $result = DB::select("*")
                    ->from("music")
                    ->where("savename", $savename)
                    ->execute()
                    ->as_array();
        return $result;
    }

    public static function insert($title, $savename, $genre, $artistid, $lyrics = "",$price = "") {

        $columns = array('title', 'savename', 'genreid', 'artistid', 'lyrics','price','sell');
        $values = array('title' => $title,
            'savename' => $savename,
            'genreid' => (int) $genre,
            'artistid' => $artistid,
            'lyrics' => $lyrics,
            'price' => $price,
            'sell' => "false",
        );
        DB::insert('music')->columns($columns)->values($values)->execute();
    }
//artist単位で音楽を取得
    public static function getartistallmusic($artistid) {
        $query = DB::select('*')->from('music')
                ->where('artistid', $artistid)
                ->execute();
        return $query;
    }
    //artist単位で音楽を取得
    public static function getartistmusic($artistid) {
        $query = DB::select('*')->from('music')
                ->where('artistid', $artistid)
                ->limit(5)
                ->execute();
        return $query;
    }

    //音楽単位で情報を取得
    public static function getmusic($id) {
        $query = DB::select('*')->from('music')
                ->where('id', $id)
                ->execute();
        return $query;
    }

    //投稿した音楽を削除
    public static function musicdelete($id) {
        DB::delete('music')
                ->where('id', $id)
                ->execute();
    }

    //歌詞を追加
    public static function setlyrics($id, $lyrics) {
        DB::update('music')
                ->value('lyrics', $lyrics)
                ->where('id', $id)
                ->execute();
    }

    //idを元に歌詞を取得
    public static function getlyrics($id) {
        $query = DB::select('*')->from('music')
                ->where('id', $id)
                ->execute();
        return $query;
    }

    public static function getmusicdata($genre = 0) {

        if (empty($genre)) {
            // 全ジャンル用SQLを生成
            $sql = ("SELECT ms.artistid, ms.title, ms.savename, ms.lyrics, us.username, ai.thumbnailname
                        FROM music AS ms,
                        (SELECT id FROM music ORDER BY RAND())AS rnd,
                        users AS us,
                        artistinfo AS ai
                        WHERE ms.id = rnd.id AND us.id = ms.artistid AND us.id = ai.artistid");
        } else {
            // 指定ジャンル用SQLを生成(前半)
            $sql = ("SELECT DISTINCT(ms.id), ms.artistid, ms.title, ms.savename, ms.lyrics, us.username, ai.thumbnailname
                    FROM(SELECT * FROM music WHERE genreid = " . $genre[0]);

            // ジャンル指定判定
            if (!(empty($genre))) {
                for ($i = 1; count($genre) > $i; $i++) {
                    $sql .= (" OR genreid = " . $genre[$i]);
                }
            }

            // 指定ジャンル用SQLを生成(後半)
            $sql .= (")AS ms,
                    (SELECT id FROM music ORDER BY RAND())AS rnd,
                    users AS us,
                    artistinfo AS ai
                    WHERE ms.id = rnd.id AND us.id = ms.artistid AND us.id = ai.artistid");
        }

        // クエリ実行
        $result = DB::query($sql)->execute();

        // 結果
        return $result;
    }

    public static function musicnum() {
        $query = DB::select('*')->from('music')
                ->execute();
        return count($query);
    }
    public static function setprice($id,$price,$sell) {

        
        DB::update('music')
                ->set(array('price' => $price,
                            'sell'=>$sell))
                ->where('id', $id)
                ->execute();
    }
    public static function getprice($id)
    {
        $query = DB::select('price')->from('music')
                ->where('id', $id)
                ->execute();
        return $query[0]['price'];
        
    }

}
