<?php
/**
 * The Welcome music controller.
 *
 * @package  app
 * @author   MT2 Team
 * @extends  Controller_Rest
 * 
 * 説明：曲処理関連用
 */
class Controller_Music extends Controller_Template {

    public function action_index() {

        // viewの適用
        $this->template->title = array("ランダム再生");
        $this->template->breadcrumb = array(array("url" => "index", "name" => "MUSIC"));
        $this->template->content = View::forge('music/index');
        
        if(Auth::check()){
            $userid = Auth::get_user_id();
        
            // 履歴情報を取得と設定
            $histdata = Model_Musichistory::gethistory($userid[1], 5);
            if(!(empty($histdata)))$this->template->content->set_safe('histdata', $histdata);
        }
        // 曲情報を取得と設定
        if(!empty($_POST['gb'])){
            $data = Model_Music::getmusicdata(INPUT::post("gb"));
        }else if(!empty($_GET['gb'])){
            $data = Model_Music::getmusicdata(INPUT::get("gb"));
        }else{
            $data = Model_Music::getmusicdata();
        }
        $this->template->content->set_safe('mdata', json_encode($data->as_array()));
    }
    
    public function action_history(){
        
        $userid = Auth::get_user_id();
        
        // 履歴情報を取得
        $data = Model_Musichistory::gethistory($userid[1]);
        
        // viewの適用
        $this->template->title = array("再生履歴");
        $this->template->breadcrumb = array(array("url" => "index", "name" => "MUSIC"),array("url" => "history", "name" => "HISTORY"));
        $this->template->content = View::forge('music/history');
        $this->template->content->set_safe('histdata',$data); 
    }
}

