<?php
/**
 * The Welcome top controller.
 *
 * @package  app
 * @author   MT2 Team
 * @extends  Controller_Rest
 * 
 * 説明：トップページ関連用
 */
class Controller_Top extends Controller_Template {

    /**
     * The basic welcome message
     *
     * @access  public
     * @return  Response
     */
    public function action_index() {
        // viewの適用
        $this->template->title = 'トップ';
        $this->template->content = View::forge('top/index');

//        Model_Music::getmusic();
        //注目アーティスト(再生数の多い順)の表示
        $popartist = DB::select('users.id', 'users.username', 'artistinfo.thumbnailname', 'artistinfo.artistinfo')
                ->distinct(true)
                ->from('users')
                ->join('music')
                ->join('musiccounts')
                ->join('artistinfo')
                ->on('users.id', '=', 'music.artistid')
                ->on('musiccounts.musicid', '=', 'music.id')
                ->on('users.id', '=', 'artistinfo.artistid')
                ->order_by('musiccounts.count', "DESC")
                ->order_by('musiccounts.date', "DESC")
                ->limit(5)
                ->execute();
        $popartistinfo = DB::select('artistinfo.artistid', 'artistinfo.artistinfo')
                ->distinct(true)
                ->from('users')
                ->join('music')
                ->join('musiccounts')
                ->join('artistinfo')
                ->on('users.id', '=', 'music.artistid')
                ->on('musiccounts.musicid', '=', 'music.id')
                ->on('users.id', '=', 'artistinfo.artistid')
                ->order_by('musiccounts.count', "DESC")
                ->order_by('musiccounts.date', "DESC")
                ->limit(5)
                ->execute()
                ->as_array();

        /**
         * 　お気に入りの情報を取得
         */
        if (Auth::check()) {      //ログインしている場合
            $id = Auth::get_user_id()[1];
            $news = Model_Mynews::getnews($id)->as_array();
            if (isset($news)) {
                $this->template->content->set_safe('news', $news);
            }
        }
        
        
/////////////////////////    石田  2013/11/19　 新着情報表示用　　ここから
//        //      //               2013/12/3 更新        ////////////////////////////
//        //ユーザーID取得 $id[1]に入っている
//
//        $id = Auth::get_user_id();
//        if (Auth::check()) {      //ログインしている場合
//            $newsid = Model_Mynews::newsCheck($id[1])->as_array(); // 新着情報の有無を確認  引数はユーザID
//            if (!empty($newsid)) {
//                $this->template->content->set_safe('newsid', $newsid); // 新着情報ありの表示用
//            }
//        }//ログインしている場合if文　終わり
//        ///////////////////////    石田　2013/11/19　 　　　新着情報表示用ここまで
//        //                       2013/12/3 更新        ////////////////////////////


        //新着のアーティストidとユーザーネームの取得  
        $newartist = DB::select('users.id', 'users.username', 'artistinfo.thumbnailname', 'artistinfo.artistinfo')
                ->from('users')
                ->join('artistinfo')
                ->on('users.id', '=', 'artistinfo.artistid')
                ->where('users.group', '=', '2')
                ->order_by('users.id', 'desc')
                ->limit(5)
                ->execute();
        //新着のアーティストidとユーザーネームの取得  
        $newartistinfo = DB::select('artistinfo.artistid','artistinfo.artistinfo')
                ->from('users')
                ->join('artistinfo')
                ->on('users.id', '=', 'artistinfo.artistid')
                ->where('users.group', '=', '2')
                ->order_by('users.id', 'desc')
                ->limit(5)
                ->execute()
                ->as_array();


        // ライブの新着情報を取得
        $live = DB::select(DB::expr('live.livename,live.venue,live.prefecture,live.date,users.username,users.id'))
                ->distinct('liveinfo.liveid')
                ->from('live')
                ->join('liveinfo')
                ->join('users')
                ->on('users.id', '=', 'liveinfo.artistid')
                ->on('liveinfo.liveid', '=', 'live.id')
                ->order_by('liveinfo.id', "DESC")
                ->limit(5)
                ->execute();

        // 新曲の情報を取得
        $music = DB::select(DB::expr('music.title,users.username,users.id,genre.genrename'))
                ->from('music')
                ->join('genre')
                ->join('users')
                ->on('music.genreid', '=', 'genre.genreid')
                ->on('users.id', '=', 'music.artistid')
                ->order_by('music.id', "DESC")
                ->limit(5)
                ->execute();




        $this->template->content->set_safe('newartist', $newartist->as_array()); //新着アーティスト
        $this->template->content->set_safe('newartistinfo', json_encode($newartistinfo));
        $this->template->content->set_safe('popartistinfo', json_encode($popartistinfo));
        $this->template->content->set_safe('popartist', $popartist->as_array()); //人気アーティスト
        $this->template->content->set_safe('live', $live->as_array()); //ライブ情報
        $this->template->content->set_safe('music', $music->as_array()); //新曲情報
    }

    public function action_search() {
        $this->template->title = 'アーテイスト検索';
        $this->template->breadcrumb = array(array("url" => "", "name" => "SEARCH"));
        $this->template->content = View::forge('top/search');
        $this->template->content->set_safe('u_id', Auth::get_user_id());
        //アーティスト情報取得
        $artist = DB::query("select users.id as id,users.username as username,artistinfo.thumbnailname as thumbnailname
            from users join artistinfo on users.id=artistinfo.artistid
            where users.group=2")
                ->execute();
        $point = 0;
        $per = 0;
        $answer = array();   //１番似ている名前
        $namelist = array();

        foreach ($artist as $val) {
            $new_point = Controller_Top::mb_similar_text(Input::post("searchname"), $val['username'], $per, 'UTF-8');
            if ($per >= 40) {
                array_push($namelist, array($val['id'], $val['username'],$val["thumbnailname"]));
            }
            if ($point < $new_point) {
                $point = $new_point;
                array_push($answer, array($val['id'], $val['username'],$val["thumbnailname"]));
            }
        }
        $this->template->content->set_safe('namelist', $namelist);
        $this->template->content->set_safe('answer', end($answer));
        $this->template->content->set_safe('searchstr', Input::post("searchname"));
    }

        /**
     * mb_similar_text
     *
     * @version 1.0.0
     * @charset UTF-8
     * @create 2011/09/25
     * @update -
     * @author mamiya_shou
     * @copyright mamiya_shou
     * @license MIT License
     * @cation PHP 4.0.6 以上必須
     */

    /**
     * 二つの文字列の間の類似性を計算する(マルチバイト文字列可)
     *
     * @param string $first 最初の文字列
     * @param string $second 次の文字列
     * @param string &$persent 類似性(パーセント) (def:NULL)
     * @param string $encoding エンコーディング (def:NULL)
     * @param string $funcName 実行する関数名 (def:NULL)
     * @return integer 両方の文字列でマッチした文字の数
     * @memo 実行する関数は、第1引数が処理する文字列、
     *		 第2引数が文字コード、戻り値は処理後の文字列。
     *		 使用する場合、ユーザが定義する。
     * @reference
     *	- http://www.programming-magic.com/20071210005711/
     */
    function mb_similar_text($first, $second, &$percent = NULL,
                                                     $encoding = NULL, $funcName = NULL)
    {
            // エンコーディング省略
            if ($encoding === NULL) {
                    // 内部エンコーディングを使用
                    $encoding = mb_internal_encoding();
            }

            // firstが文字列長が大きい場合
            if (mb_strlen($first) > mb_strlen($second)) {
                    // swap
                    // firstの文字列長が短いと処理が早く終る、はず
                    list($first, $second) = array($second, $first);
            }

            // 関数が指定、かつ定義されている場合
            if ($funcName !== NULL && function_exists($funcName)) {
                    $first = $funcName($first, $encoding);
                    $second = $funcName($second, $encoding);
            }

            // マルチバイト文字列を配列化
            $aryFirst = Controller_Top::mbStrToAry($first, $encoding);
            $arySecond = Controller_Top::mbStrToAry($second, $encoding);

            $cnt = 0;
            // 1文字ずつ一致するか調べる
            foreach ((array)$aryFirst as $chr) {
                    // 一致
                    if (($key = array_search($chr, $arySecond)) !== FALSE) {
                            // 次回以降一致しないように削除
                            unset($arySecond[$key]);
                            $cnt++;
                    }
            }
            $totalLen = mb_strlen($first, $encoding) + mb_strlen($second, $encoding);
            if ($totalLen !== 0) {
                    // パーセンテージは、(一致回数 x 2) / 2つの文字列の合計の長さ x 100
                    $percent = ($cnt * 2) / $totalLen * 100;
            }
            // 0除算対策
            else {
                    $percent = 0.0;
            }
            // 一致回数
            return $cnt;
    }

    /**
     * マルチバイト文字列を1文字ずつ配列に格納する
     *
     * @param string $mbStr マルチバイト文字
     * @param string $encoding エンコーディング
     * @return array マルチバイト文字配列
     * @reference
     *	- http://detail.chiebukuro.yahoo.co.jp/qa/question_detail/q1417635014
     */
    function mbStrToAry($mbStr, $encoding = NULL)
    {
            // エンコーディング省略
            if ($encoding === NULL) {
                    // 内部エンコーディングを使用
                    $encoding = mb_internal_encoding();
            }

            $aryRet = array();
            // 文字列長が0になるまでループ
            while ($iLen = mb_strlen($mbStr, $encoding)) {
                    // 1文字目を配列に代入
                    $aryRet[] = mb_substr($mbStr, 0, 1, $encoding);
                    // 2文字目から末尾までを新しい文字列とする
                    $mbStr = mb_substr($mbStr, 1, $iLen, $encoding);
            }
            return $aryRet;
    }
    public function AlreadyRread() {
        
    }

    /**
     * The 404 action for the application.
     *
     * @access  public
     * @return  Response
     */
    public function action_404() {
        return Response::forge(ViewModel::forge('top/404'), 404);
    }

}
