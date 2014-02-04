<?php
/**
 * The Welcome bbs controller.
 *
 * @package  app
 * @author   MT2 Team
 * @extends  Controller_Rest
 * 
 * 説明：掲示板関連用
 */
class Controller_Bbs extends Controller_Template{
    public function action_index(){
        
        // viewの適用
        $this->template->title = array("掲示板");
        $this->template->breadcrumb = $this->get_bs("index");
        $this->template->content = View::forge('bbs/index');
        
        $result = Model_Bbs::select();
        $this->template->content->set_safe('less', $result);
        
    }
    
    public function action_newthread(){
        
        // postの取得
        $title = Input::post("title");
        $content = Input::post("content");
        
        // 見出し用テキスト生成
        $head = explode( "\n", $content );
        
        // スレッドの追加
        Model_Bbs::insert($title, $head[0], $content);
        
        return Response::redirect("/bbs/index");
    }
    
    public function action_less(){
        $this->template->title = array("掲示板");
        $this->template->breadcrumb = $this->get_bs("less");
        $this->template->content = View::forge("bbs/less");
        
        $result=Model_Bbs::getsled(INPUT::get("id"));
        $lessresult = Model_Less::select(INPUT::get("id"));
        $this->template->content->set_safe('title',$result->as_array()[0]["title"]);
        $this->template->content->set_safe('content',$result->as_array()[0]["content"]);
        $this->template->content->set_safe('lessarray', $lessresult->as_array());
        
    }
    
    public function action_newcomment()
    {      
        $id=Input::post('id');
        $title=Input::post('title');
        $content=Input::post('content');
        
        Model_Less::insert($id, $title, $content);
        
        return Response::redirect("/bbs/less?id=". Input::post('id'));
        
    }
       public function action_last(){
        
        // postの取得
        $title = Input::post("title");
        $content = Input::post("content");
        
        // 見出し用テキスト生成
        $head = explode( "\n", $content );
        
        return Response::redirect("/bbs/less");
    }
    
    public static function get_bs($path){
        $bs = array(array("url" => "", "name" => "BBS"));
        switch ($path){
            case "index":
                array(array("url" => "/bbs/index", "name" => "THREAD"));break;
            case "less":
                array(array("url" => "/bbs/less", "name" => "LESS"));break;
        }
        return $bs;
    }
    
}
?>
