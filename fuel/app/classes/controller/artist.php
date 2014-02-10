<?php
/**
 * The Welcome artist controller.
 *
 * @package  app
 * @author   MT2 Team
 * @extends  Controller_Rest
 * 
 * 説明：アーティスト関連用
 */
class Controller_Artist extends Controller_Template {
    public function before() {
        parent::before();
        // 初期処理
        $method = Uri::segment(2);
        // ログインチェック
        $auth_methods = array(
            'index',
            'musicdelete',
            'artistinfo',
            'cdinfo',
            'liveinfo',
            'liveperform',
            'liveperformdelete',
            'cdinfodelete',
            'accessgraph',
            'cdinfodelete',
            'music',
            'musicupload',
            'thumbnail',
            'thumbnailupload',
            'priceset',
            'purchase',
            'charge',
            'download',
        );
        
        $auth_group = Auth::get_groups();
        if (in_array($method, $auth_methods) && $auth_group !== "2"){
           Response::redirect('/');
        }
        
    }

    public function action_index() {

        $this->template->title = 'アーテイストページ';
        $this->template->breadcrumb = $this->get_bs("index");
        $this->template->content = View::forge('artist/index');

        //ユーザーID取得 $id[1]に入っている
        $id = Auth::get_user_id();

        Controller_Artist::handover($id[1], $this->template->content);
    }

    public function action_musicdelete() {
        //postで送られてきたidの音楽を削除
        Model_Music::musicdelete(Input::post('deleteid'));
        //削除後アーティストページに移動
        Response::redirect('artist/index');
    }

    public function action_artistinfo() {
        $this->template->title = 'アーテイストページ';
        $this->template->breadcrumb = $this->get_bs("artistinfo");
        $this->template->content = View::forge('artist/artistinfo');

        //ユーザーIDを取得
        $id = Auth::get_user_id();

        //artistinfoに同じIDがあるか判定
        $flag = Model_Artistinfo::searchartist($id[1]);
        if ($flag === FALSE) {
            Model_Artistinfo::validate($id[1]);
        }

        if (Input::method() == 'POST') {
            //idがある場合
            //Artistinfo::updateにidと内容を渡す
            Model_Artistinfo::update($id[1], Input::post('artistinfo'));
            //アーティストページに移動
            Response::redirect('artist/');
        } else {

            //artistinfoに同じIDがあるか判定
            $flag = Model_Artistinfo::searchartist($id[1]);
            if ($flag === TRUE) {
                //idがある場合
                $artistinfo = Model_Artistinfo::getinfo($id[1]);

                //artistinfoを渡す
                $this->template->content->set_safe('artistinfo', $artistinfo);
            }
        }
        $thumbnail = Model_Artistinfo::getartisthumbnail($id[1]);
        if (count($thumbnail) == 1) {
            $this->template->content->set_safe('thumbnail', $thumbnail);
        }
    }

    public function action_cdinfo() {
        $this->template->title = 'アーテイストページ';
        $this->template->breadcrumb = $this->get_bs("cdinfo");
        $this->template->content = View::forge('artist/cdinfo');

        //POSTが送られてきたか判定
        if (Input::method() == 'POST') {
            //ユーザーIDを取得
            $id = Auth::get_user_id();
            //POSTを受け取る
            $cdname = Input::post('cdname');
            $price = Input::post('price');
            $musicname = Input::post('musicname');
            $musicname = str_replace(array("\r\n", "\r", "\n"), '', $musicname);
            $musicname = str_replace(array("、", ".", "，"), ',', $musicname);
            $info = Input::post('cdinfo');
            //cd作成
            Model_Cdinfo::validate($cdname, $price, $musicname, $info, $id[1]);

            Response::redirect('artist/index');
        }
    }

    public function action_liveinfo() {
        $this->template->title = 'アーテイストページ';
        $this->template->breadcrumb = $this->get_bs("liveinfo");
        $this->template->content = View::forge('artist/liveinfo');
        //ユーザーIDを取得
        $id = Auth::get_user_id();
        //POSTが送られてきたか判定
        if (Input::method() == 'POST') {
            //県名を受け取る
            $prefecture = Input::post('prefecture');
            //live情報取得
            $liveinfo = Model_Live::searchprefecture($id[1],$prefecture);
        }
        else
        {
            //live情報取得
            $liveinfo = Model_Live::searchprefecture($id[1]);
        }
        //live情報を渡す
        $this->template->content->set_safe('liveinfo', $liveinfo->as_array());
    }

    public function action_view() {
        $this->template->title = 'アーテイストページ';
        $this->template->breadcrumb = $this->get_bs("view");
        $this->template->content = View::forge('artist/view');
        $this->template->content->set_safe('u_id', Auth::get_user_id());
        
        
        //artistidを受け取る
        if ((isset($_POST["artistid"]))) {
            // postの場合
            $artistid = Input::post('artistid');
        } else if (isset($_GET["id"])) {
            // getの場合
            $artistid = Input::get('id');
        } else {
            // idが送られてきてない場合
            return Response::redirect('/');
        }
        //// 石田　2013/12/13　新着情報の既読部分を消すために追加　ここから
        //newsidを受け取る
        if ((isset($_POST["newsid"]))) {
            $newsid = Input::post('newsid');
            // 既読のニュースを削除する
            Model_Mynews::deletes($newsid);
        }
        //// 石田　2013/12/13　新着情報の既読部分を消すために追加　ここまで
        
        $this->template->content->set_safe('a_id', $artistid);

        //artistpageの各種情報を渡す
        Controller_Artist::handover($artistid, $this->template->content);
        //アクセスカウンタに記録
        Model_Accesscounter::setcount($artistid);
    }

    public static function action_liveperform() {
        
        //ユーザーIDを取得
        $artistid = Auth::get_user_id()[1];
        //POSTが送られてきたか判定
        if (Input::method() == 'POST') {
            //liveidを取得
            $liveid = Input::post('liveid');
            //どのliveに出演するかの情報をdbに保存
            Model_liveinfo::insert($liveid, $artistid);

            $userid = Model_Mylist::getuserid($artistid);
            
            foreach ($userid AS $val){
                Model_Mynews::insert($userid,$artistid, $liveid);
            }

            $newsid = Model_Live::getliveid($artistid)->as_array(); //　ライブ情報を挿入し、そのライブidを取得 引数はアーティストID
            $userid = (Model_Mylist::getuserid($artistid)->as_array());  // お気に入り登録しているユーザ番号を取得　引数はアーティストID
         

            foreach ($userid as $val) {
                Model_Mynews::insert($val["userid"], $newsid[0]["id"]);      // 最新ライブ情報IDとそのアーティストをお気に入り登録しているuseridをmynewsTableに格納
            }
           

            ////////////////// ↑↑   ここまで追加しました　石田    2013/11/15　   ↑↑ 　////////////////////////////               
            //////////////////                                     2013/11/26 更新     ////////////////////////////
            //////////////////                                      2013/12/6 更新     ////////////////////////////
        }
        //liveinfoに移動
        Response::redirect('artist/liveinfo');
    }

    public static function action_liveperformdelete() {

        //ユーザーIDを取得
        $artistid = Auth::get_user_id()[1];
        if (Input::method() == 'POST') {
            //削除するliveidを取得
            $liveid = Input::post('deleteliveid');
            //出演するlive情報削除
            Model_liveinfo::delete($liveid, $artistid);
            Model_Mynews::delete($artistid, $liveid);
        }
        //アーティストページに移動
        Response::redirect('/artist/');
    }

    public static function action_cdinfodelete() {
        //ユーザーIDを取得
        $artistid = Auth::get_user_id();
        if (Input::method() == 'POST') {
            //削除するliveidを取得
            $cdid = Input::post('deletecdid');
            //出演するlive情報削除
            Model_cdinfo::delete($cdid, $artistid[1]);
        }
        //アーティストページに移動
        Response::redirect('artist/');
    }

    public function action_musicgraph() {
        $this->template->title = 'アーテイストページ';
        $this->template->breadcrumb = $this->get_bs("musicgraph");
        $this->template->content = View::forge('artist/musicgraph');

        $yaer = Model_Musiccount::getyaer(Input::post('id'));
        $month = Model_Musiccount::getmonth(Input::post('id'));

        //年グラフを渡す
        $this->template->content->set_safe('yaergraph', $yaer->as_array());

        //月グラフを渡す
        $this->template->content->set_safe('mongraph', $month->as_array());
    }

    public function action_accessgraph() {
        $artistid = Auth::get_user_id();

        $this->template->title = 'アーテイストページ';
        $this->template->breadcrumb = $this->get_bs("accessgraph");
        $this->template->content = View::forge('artist/accessgraph');

        $yaer = Model_Accesscounter::getyaer($artistid[1]);
        $month = Model_Accesscounter::getmonth($artistid[1]);
        $day = Model_Accesscounter::getday($artistid[1]);
        //年グラフを渡す
        $this->template->content->set_safe('yaergraph', $yaer->as_array());

        //月グラフを渡す
        $this->template->content->set_safe('mongraph', $month->as_array());

        //日グラフを渡す
        $this->template->content->set_safe('daygraph', $day->as_array());
    }

    public function action_lyrics() {
        $this->template->title = 'アーテイストページ';
        $this->template->breadcrumb = $this->get_bs("lyrics");
        $this->template->content = View::forge('artist/lyrics');
        
        if (Input::post('lyrics') !== null) {
            Model_Music::setlyrics(Input::post('id'), Input::post('lyrics'));
        }

        $music = Model_Music::getmusic(Input::post('id'));

        $this->template->content->set_safe('music', $music);
    }

    public function action_lyricsview() {
        $this->template->title = 'アーテイストページ';
        $this->template->breadcrumb = $this->get_bs("lyricsview");
        $this->template->content = View::forge('artist/lyricsview');

        if (Input::method() == 'GET') {
            $music = Model_Music::getmusic(Input::get('id'));

            $this->template->content->set_safe('music', $music);
        }
    }

    public function action_member(){
        $this->template->title = 'メンバー追加';
        $this->template->breadcrumb = $this->get_bs("member");
        $this->template->content = View::forge('artist/member');
    }
    
    public function action_memberadd() {
        // 初期設定
        $config = array(
            'path' => DOCROOT . 'memberimg',
            'randomize' => true,
            'ext_whitelist' => array('jpg', 'jpeg', 'gif', 'jpe', 'bmp', 'png'),
        );

        // cofigを適用
        Upload::process($config);
        $id = Auth::get_user_id()[1];
        // 指定された型かチェック
        if (Upload::is_valid()) {
            
            $file = Upload::get_files();
            $filesize = getimagesize($file[0]["file"]);

            if ($filesize[0] == 500 && $filesize[1] == 500) {
                
                // アップロード確定
                Upload::save();
                foreach (Upload::get_files() as $file) {
                    //ファイル情報を使用した処理;
                    if (Input::method() == 'POST') {
                        // 保存ファイルの名前を使用しメンバー情報を確定
                        Model_Member::insert($id,Input::post("name"),Input::post("charge"),$file['saved_as']);
                        Response::redirect('artist/index');
                    }
                }
            } else {
                // sizeerror処理
                $html_error = '画像のサイズを250×250にあわせてください<br />';
                $this->template->title = array('メンバー追加');
                $this->template->breadcrumb = $this->get_bs("member");
                $this->template->content = View::forge('artist/member');
                $this->template->content->set_safe('html_error', $html_error);
            }
        } else {
            // error処理
            $this->template->title = array('メンバー追加');
            $this->template->breadcrumb = $this->get_bs("member");
            $this->template->content = View::forge('artist/member');

            $html_error = '';
            foreach (Upload::get_errors() as $error)
                $html_error .= $error['errors'][0]['message'] . '<br />';
            $this->template->content->set_safe('html_error', $html_error);
        }
    }
    
    public function action_music() {
        $this->template->title = 'アップロード';
        $this->template->breadcrumb = $this->get_bs("music");
        $this->template->content = View::forge('artist/music');
    }

    public function action_musicupload() {
        // 初期設定
        $config = array(
            'path' => DOCROOT . 'uploadmusic',
            'randomize' => true,
            'ext_whitelist' => array('mp3'),
        );

        // cofigを適用
        Upload::process($config);
        // 指定された型かチェック
        if (Upload::is_valid()) {
            // アップロード確定
            Upload::save();

            foreach (Upload::get_files() as $file) {
                //ファイル情報を使用した処理

                if (Input::method() == 'POST') {
                    //投稿するユーザーのID取得
                    $id = Auth::get_user_id();
                    //モデルに保存したファイル名とファイルパスを渡す
                    Model_Music::insert(Input::post('title'), $file['saved_as'], Input::post('genre'), $id[1]);

                    return Response::redirect("/artist/index");
                } else {
                    $this->template->title = 'ミュージックアップロード';
                    $this->template->breadcrumb = $this->get_bs("music");
                    $this->template->content = View::forge('artist/music');
                }
            }
        } else {
            $this->template->title = 'ミュージックアップロード';
            $this->template->breadcrumb = $this->get_bs("music");
            $this->template->content = View::forge('artist/music');
            // error処理
            $html_error = '';
            foreach (Upload::get_errors() as $error)
                $html_error .= $error['errors'][0]['message'] . '<br />';
            $this->template->content->set_safe('html_error', $html_error);
        }
    }

    public function action_thumbnail() {
        $this->template->title = 'サムネイルアップロード';
        $this->template->breadcrumb = $this->get_bs("thumbnail");
        $this->template->content = View::forge('artist/thumbnail');
    }

    public function action_thumbnailupload() {
        // 初期設定
        $config = array(
            'path' => DOCROOT . 'uploadthumbnail',
            'randomize' => true,
            'ext_whitelist' => array('jpg', 'jpeg', 'gif', 'jpe', 'bmp', 'png'),
        );

        // cofigを適用
        Upload::process($config);
        $id = Auth::get_user_id()[1];
        // 指定された型かチェック
        if (Upload::is_valid()) {

            $file = Upload::get_files();
            $filesize = getimagesize($file[0]["file"]);

            if ($filesize[0] == 500 && $filesize[1] == 500) {
                // アップロード確定
                $query = Model_Artistinfo::getartisthumbnail($id);

                if (!empty($query[0]['thumbnailname'])) {
                    if($query[0]['thumbnailname'] != "no_image.jpg"){
                        File::delete(DOCROOT . 'uploadthumbnail/' . $query[0]['thumbnailname']);
                    }
                }
                Upload::save();

                foreach (Upload::get_files() as $file) {
                    //ファイル情報を使用した処理;
                    if (Input::method() == 'POST') {
                        //投稿するユーザーのID取得
                        //モデルに保存したファイル名とファイルパスを渡す
                        Model_Artistinfo::thumbnailupload($file['saved_as'], $file['saved_to'], $id);

                        Response::redirect('artist/artistinfo');
                    }
                }
            } else {
                // sizeerror処理
                $html_error = '画像のサイズを500×500にあわせてください<br />';

                $this->template->title = array('アップロード');
                $this->template->breadcrumb = $this->get_bs("thumbnail");
                $this->template->content = View::forge('artist/thumbnail');
                $this->template->content->set_safe('html_error', $html_error);
            }
        } else {
            // error処理
            $this->template->title = array('アップロード');
            $this->template->breadcrumb = $this->get_bs("thumbnail");
            $this->template->content = View::forge('artist/thumbnail');

            $html_error = '';
            foreach (Upload::get_errors() as $error)
                $html_error .= $error['errors'][0]['message'] . '<br />';
            $this->template->content->set_safe('html_error', $html_error);
        }
    }

    public static function handover($artistid, $content) {
        $group = Model_User::getGroup($artistid);
        if ($group[0]['group'] == 1) {
            Fuel\Core\Response::redirect("/");
        }
        
        // メンバー情報を取得
        $member = Model_Member::getmember($artistid);
        $content->set_safe('member', $member->as_array());
        
        //投稿musicを取得
        $music = Model_Music::getartistallmusic($artistid);
        //misic情報を渡す
        $content->set_safe('musicinfo', $music->as_array());
        
        //artistinfoに同じIDがあるか判定
        $artistflag = Model_Artistinfo::searchartist($artistid);
        if ($artistflag === TRUE) {
            //idがある場合
            //Artistinfo::validateにidと内容を渡す
            $artistinfo = Model_Artistinfo::getinfo($artistid);
            //投稿したアーティスト情報を渡す
            $content->set_safe('artistinfo', $artistinfo->as_array());
        }

        $artistname = Model_User::getname($artistid);
        $content->set_safe('artistname', $artistname->as_array());

        //liveinfoに同じIDがあるか判定
        $liveflag = Model_Liveinfo::searchartist($artistid);
        if ($liveflag === TRUE) {
            //idがある場合
            //liveid取得
            $liveid = Model_Liveinfo::getinfo($artistid);

            foreach ($liveid as $value) {
                //出演するlive情報取得し配列に挿入
                $liveinfotemp[] = Model_Live::getlive($value['liveid']);
            }
            //live情報を整える
            $liveinfo = array();
            foreach ($liveinfotemp as $value) {
                $temp = array(
                    "id" => $value[0]["id"],
                    "livename" => $value[0]["livename"],
                    "prefecture" => $value[0]["prefecture"],
                    "date" => $value[0]["date"],
                    "venue" => $value[0]["venue"],
                    "address" => $value[0]["address"],
                    "url" => $value[0]["url"]
                );
                array_push($liveinfo, $temp);
            }
            //投稿したライブ情報を渡す
            $content->set_safe('liveinfo', $liveinfo);
        }
        //cdinfoに同じIDがあるか判定
        $cdflag = Model_Cdinfo::searchartist($artistid);
        if ($cdflag === TRUE) {
            //cd情報取得
            $cdinfo = Model_Cdinfo::getinfoartistid($artistid);
            //登録したCD情報を渡す
            $content->set_safe('cdinfo', $cdinfo->as_array());
        }

        $flg = (Model_Mylist::check(Auth::get_user_id()[1], 2)->as_array());
        if (!$flg) {
            $addmylist =
                    '<form action="/mylist/insert" method="post">
            <input type="hidden" value="<?php echo $u_id[1]; ?>" name="u_id">
            <input type="hidden" value="<?php echo $a_id; ?>" name="a_id">
            <input type="submit" value="コミュニティ参加">
            </form>';
        } else {
            $addmylist = false;
        }

        $content->set_safe('addmylist', $addmylist); // こみゅ参加のボタン設置

        $thumbnail = Model_Artistinfo::getartisthumbnail($artistid);
        if (count($thumbnail) == 1) {
            $content->set_safe('thumbnail', $thumbnail);
        }
    }

    public static function get_bs($path) {
        $bs = array(array("url" => "index", "name" => "ARTIST"));
        switch ($path) {
            case "artistinfo":
                array_push($bs, array("url" => "artistinfo", "name" => "ARTIST INFO"));
                break;
            case "cdinfo":
                array_push($bs, array("url" => "cdinfo", "name" => "CD INFO"));
                break;
            case "liveinfo":
                array_push($bs, array("url" => "liveinfo", "name" => "LIVE INFO"));
                break;
            case "view":
                array_push($bs, array("url" => "view", "name" => "VIEW"));
                break;
            case "musicgraph":
                array_push($bs, array("url" => "musicgraph", "name" => "MUSIC GRAPH"));
                break;
            case "accessgraph":
                array_push($bs, array("url" => "accessgraph", "name" => "ACCESS GRAPH"));
                break;
            case "lyrics":
                array_push($bs, array("url" => "lyrics", "name" => "LYLICS"));
                break;
            case "lyricsview":
                array_push($bs, array("url" => "lyricsview", "name" => "LYRICS VIEW"));
                break;
            case "member":
                array_push($bs, array("url" => "member", "name" => "MEMBER ADD"));
                break;
            case "music":
                array_push($bs, array("url" => "music", "name" => "MUSIC UPLOAD"));
                break;
            case "thumbnail":
                array_push($bs, array("url" => "thumbnail", "name" => "THUMBNAIL UPLOAD"));
                break;
        }
        return $bs;
    }

    public function action_purchase() {

        $this->template->title = 'アーテイストページ';
        $this->template->breadcrumb = $this->get_bs("music");
        $this->template->content = View::forge('artist/purchase');
        
        $music_id = Input::get('id');
        $userid = Auth::get_user_id()[1];
        
        $purchase_check=Model_purchase::searchpurchase($userid, $music_id);
        
        $music_info = Model_Music::getmusic($music_id);
        
        $this->template->content->set_safe('$music_id',$music_id);
        $this->template->content->set_safe('music_info',$music_info->as_array());
        $this->template->content->set_safe('purchase_check',$purchase_check);
        
        
    }
    public function action_charge() {

        $this->template->title = 'アーテイストページ';
        $this->template->breadcrumb = $this->get_bs("music");
        $this->template->content = View::forge('artist/charge');
        
        Stripe::setApiKey(SECRET_KEY);
        Stripe::$apiBase = "https://api.webpay.jp";
        // 支払金額。実際には商品番号などを送信し、それに対応する金額をデータベースから引きます
        $amount = Model_Music::getprice(Input::post('id'));
        // トークン
        $token = Input::post('webpay-token');
        

        try {
            // 決済を実行
            $result=Stripe_Charge::create(array(
           "amount"=>intval($amount, 10),
           "currency"=>"jpy",
           "card"=>$token,
           "description"=>"アイテムの購入"
        ));
            // 以下エラーハンドリング
        } catch (\WebPay\Exception\CardException $e) {
            // カードが拒否された場合
            print("CardException\n");
            print('Status is:' . $e->getStatus() . "\n");
            print('Type is:' . $e->getType() . "\n");
            print('Code is:' . $e->getCardErrorCode() . "\n");
            print('Param is:' . $e->getParam() . "\n");
            print('Message is:' . $e->getMessage() . "\n");
            exit('Error');
        } catch (\WebPay\Exception\InvalidRequestException $e) {
            // リクエストで指定したパラメータが不正な場合
            print("InvalidRequestException\n");
            print('Param is:' . $e->getParam() . "\n");
            print('Message is:' . $e->getMessage() . "\n");
            exit('Error');
        } catch (\WebPay\Exception\AuthenticationException $e) {
            // 認証に失敗した場合
            print("AuthenticationException\n");
            print('Param is:' . $e->getParam() . "\n");
            print('Message is:' . $e->getMessage() . "\n");
            exit('Error');
        } catch (\WebPay\Exception\APIConnectionException $e) {
            // APIへの接続エラーが起きた場合
            print("APIConnectionException\n");
            print('Param is:' . $e->getParam() . "\n");
            print('Message is:' . $e->getMessage() . "\n");
            exit('Error');
        } catch (\WebPay\Exception\APIException $e) {
            // WebPayのサーバでエラーが起きた場合
            print("APIException\n");
            print('Message is:' . $e->getMessage() . "\n");
            exit('Error');
        } catch (Exception $e) {
            // WebPayとは関係ない例外の場合
            echo '<meta charset="utf-8">';
            print("Unexpected exception\n");
            print('Message is:' . $e->getMessage() . "\n");
            exit('Error');
        }
        Model_purchase::insert(Auth::get_user_id()[1], Input::post('id'));
        $this->template->content->set_safe('result',$result);
        $this->template->content->set_safe('musicid',Input::post('id'));
       
        // 処理終了後、 https://webpay.jp/test/charges で課金が発生したか確認できる。
    }
    public function action_priceset() {

        $this->template->title = 'アーテイストページ';
        $this->template->breadcrumb = $this->get_bs("music");
        $this->template->content = View::forge('artist/priceset');
        
        if (Input::method() == 'GET') {
            $musicid=Input::get('id');
            
            $music_info = Model_Music::getmusic($musicid);
            $this->template->content->set_safe('music_info',$music_info->as_array());
        }
        if (Input::method() == 'POST') {
            $sell = Input::post('sell');
            $musicid=Input::post('musicid');
            $price=Input::post('price');
            Model_Music::setprice($musicid, $price,$sell);
            Response::redirect('artist/');
        }
    }
    public function action_download() 
    {
        $music_id=Input::post('musicid');
        $file=Model_Music::getmusic($music_id);
        File::download('./uploadmusic/' . $file[0]['savename'], $file[0]['title'].'.mp3');
    }
    
    
}
?>

