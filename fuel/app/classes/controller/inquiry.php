<?php
/**
 * The Welcome inquiry controller.
 *
 * @package  app
 * @author   MT2 Team
 * @extends  Controller_Rest
 * 
 * 説明：問い合わせ処理関連用
 */
class Controller_Inquiry extends Controller_Template{
    public function action_index(){
        
        // viewの適用
        $this->template->title = array("問い合わせ");
        $this->template->breadcrumb = $this->get_bs("index");
        $this->template->content = View::forge('inquiry/index');
        
        
    }
    
    public function action_create(){
        $this->template->title = array("問い合わせ");
        $this->template->breadcrumb = $this->get_bs("create");
        $this->template->content = View::forge('inquiry/index');
        // postの取得
        if (Input::method() == 'POST') 
        {
            $error="";
            $cont=array(
                'address' => Input::post('address'),
                'title' => Input::post("title"),
                'content' => Input::post("content"),
                );
            
            //アドレスが入力していない場合
            if(preg_match("/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/",$cont['address'])===0)
            {
                $error='メールアドレスを入力してください<br>';
            }
            //内容が入力していない場合
            if(empty($cont['content']))
            {
                $error=$error.'内容を入力してください<br>';
            }
            //errorがある場合
            if(!empty($error))
            {
                $this->template->content->set_safe('error',$error);
            }
            else {
                Model_Inquiry::validate($cont);
            }
        }
    }
    
    public function action_admin(){
        $this->template->title = array("問い合わせ");
        $this->template->breadcrumb = $this->get_bs("admin");
        $this->template->content = View::forge('inquiry/admin');
        
        $group=Model_User::getGroup(Auth::get_user_id()[1]);
        if($group[0]['group']!=5)
        {
            Fuel\Core\Response::redirect("/");
        }
        $que=Model_Inquiry::getallinquiry();
        
        $this->template->content->set_safe('inquiry',$que);
    }
    public function action_content(){
        $this->template->title = array("問い合わせ");
        $this->template->breadcrumb = $this->get_bs("content");
        $this->template->content = View::forge('inquiry/content');
        
        $group=Model_User::getGroup(Auth::get_user_id()[1]);
        if($group[0]['group']!=5)
        {
            Fuel\Core\Response::redirect("/");
        }
        $que=Model_Inquiry::getinquiry(Input::post('id'));
        $this->template->content->set_safe('inquiry',$que);
    }
    
    public function action_delete()
    {
        Model_Inquiry::delete(Input::post('id'));
        Response::redirect('inquiry/admin');
    }
    
    public static function get_bs($path){
        $bs = array(array("url" => "/inquiry/index", "name" => "INQUIRY"));
        switch ($path){
            case "create":
                array(array("url" => "/inquiry/create", "name" => "CREATE"));break;
            case "admin":
                array(array("url" => "/inquiry/admin", "name" => "ADMIN"));break;
            case "content":
                array(array("url" => "/inquiry/content", "name" => "CONTENT"));break;
        }
        return $bs;
    }
}
?>
