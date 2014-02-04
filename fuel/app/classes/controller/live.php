<?php
/**
 * The Welcome live controller.
 *
 * @package  app
 * @author   MT2 Team
 * @extends  Controller_Rest
 * 
 * 説明：ライブ処理関連用
 */
class Controller_Live extends Controller_Template {

    public function action_index() {
        $this->template->title = "live";
        $this->template->breadcrumb = array(array("url" => "/live/index", "name" => "LIVE CREATE"));
        $this->template->content = View::forge('live/index');
        
        
    }

    public function action_view($id = null) {
        is_null($id) and Response::redirect('live');

        if (!$data['live'] = Model_Live::find($id)) {
            Session::set_flash('error', 'Could not find live #' . $id);
            Response::redirect('live');
        }

        $this->template->title = "live";
        $this->template->breadcrumb = array(array("url" => "/live/view", "name" => "LIVE VIEW"));
        $this->template->content = View::forge('live/view', $data);
    }

    public function action_create() {
        if (Input::method() == 'POST') {
            $live = Model_Live::forge(array(
                        'livename' => Input::post('livename'),
                        'prefecture' => Input::post('prefecture'),
                        'year' => Input::post('year'),
                        'month' => Input::post('month'),
                        'day' => Input::post('day'),
                        'venue' => Input::post('venue'),
                        'address' => Input::post('address'),
                        'url' => Input::post('url'),
            ));
            Model_Live::validate($live);

            //アーティストページに移動
            Response::redirect('artist/liveinfo');
        }
    }

    public function action_delete($id = null) {
        is_null($id) and Response::redirect('live');

        if ($live = Model_Live::find($id)) {
            $live->delete();

            Session::set_flash('success', 'Deleted live #' . $id);
        } else {
            Session::set_flash('error', 'Could not delete live #' . $id);
        }

        Response::redirect('live');
    }

    public function action_edit() {
        $this->template->title = "live";
        $this->template->content = View::forge('live/edit');
        $this->template->breadcrumb = array(array("url" => "/live/edit", "name" => "LIVE EDIT"));

        if (Input::method() == 'POST') {
            //live情報取得
            $liveinfo = Model_Live::getlive(Input::post('liveid'));
            $this->template->content->set_safe('liveinfo', $liveinfo->as_array());
        }
    }

    public static function action_liveupdate() {
        if (Input::method() == 'POST') {
            $live = Model_Live::forge(array(
                        'livename' => Input::post('livename'),
                        'prefecture' => Input::post('prefecture'),
                        'year' => Input::post('year'),
                        'month' => Input::post('month'),
                        'day' => Input::post('day'),
                        'venue' => Input::post('venue'),
                        'address' => Input::post('address'),
                        'url' => Input::post('url'),
            ));
            Model_Live::liveupdate(Input::post('liveid'), $live);

            //アーティストページに移動
            Response::redirect('artist/liveinfo');
        }
    }

}
