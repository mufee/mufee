<?php

/**
 * The Welcome ajax rest controller.
 *
 * @package  app
 * @author   MT2 Team
 * @extends  Controller_Rest
 * 
 * 説明：ajaxリクエスト用
 */
class Controller_Ajax extends Controller_Rest {

    /**
     * @brief   [曲の再生後処理]
     * @param   [musicname] [曲名]
     * @param   [musicinfo] [曲情報]
     * @access  public
     * @return  Response
     */
    public function post_musicoperate() {
        $musicname = $_POST['name'];

        // 曲情報を取得
        $musicinfo = Model_Music::getOneMusic($musicname);

        // musiccountsに曲idをinsert
        Model_Musiccount::setcount($musicinfo[0]["id"]);
        
        // 再生履歴追加処理
        if (Auth::check()) {
            $userid = Auth::get_user_id()[1];

            // 履歴情報を追加
            Model_Musichistory::sethistory($userid, $musicinfo[0]["id"], $musicinfo[0]["artistid"]);
        }
    }

    public function post_nextpaging() {
        $userid = Auth::get_user_id()[1];
        switch ($_POST['name']) {
            case "favorite":
                $result = Model_Mynews::getNextNews($userid, $_POST['page']);
                break;
        }
        $this->response(json_encode($result), 200);
    }

    // 2013/12/20 石田追加
    public function post_addmylist() {         // マイリスト情報を挿入
        $data = array(
            'userid' => $ID[] = $_POST['u_id'], // ユーザID取得
            'artistid' => $ID[] = $_POST['a_id'], //　選択アーティストID取得
        );
        //SQLの発行
        $query = DB::insert('mylists')->set($data)->execute();
    }

    public function post_deletemylist() {
        $data = array(
            'userid' => $ID[] = $_POST['u_id'], // ユーザID取得
            'artistid' => $ID[] = $_POST['a_id'], //　選択アーティストID取得
        );
        //SQLの発行

        $query = DB::delete('mylists')
                ->where('userid', $data['userid'])
                ->and_where('artistid', $data['artistid'])
                ->execute();
    }

}

?>
