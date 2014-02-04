<?php
/**
 * The Welcome mylist controller.
 *
 * @package  app
 * @author   MT2 Team
 * @extends  Controller_Rest
 * 
 * 説明：マイリスト処理関連用
 */
class Controller_Mylist extends Controller_Template {

    public function action_index() {
        $this->template->title = "Mylists";                     //　タイトルをMylistsに設定
        $this->template->breadcrumb = array(array("url" => "/mylist/index", "name" => "MYLIST"));
        $this->template->content = View::forge('mylist/index'); //　mylist/indexに画面遷移
        $this->template->content->set_safe('u_id', Auth::get_user_id());
        $this->template->content->set_safe('a_id', INPUT::post("a_id"));
    }
}