<?php

/**
 * The Welcome artist controller.
 *
 * @package  app
 * @author   MT2 Team
 * @extends  Controller_Rest
 * 
 * 説明：会員処理関連用
 */
class Controller_Auth extends Controller_Template {

    public function before() {
        parent::before();
        // 初期処理
        // POSTチェック
        $post_methods = array(
            'created',
            'updated',
            'removed',
        );
        $method = Uri::segment(2);
        if (Input::method() !== 'POST' && in_array($method, $post_methods)) {
            Response::redirect('auth/timeout');
        }
        // ログインチェック
        $auth_methods = array(
            'logined',
            'logout',
            'update',
            'remove',
        );
        if (in_array($method, $auth_methods) && !Auth::check()) {
            Response::redirect('auth/login');
        }
        // ログイン済みチェック
        $nologin_methods = array(
            'login',
        );
        if (in_array($method, $nologin_methods) && Auth::check()) {
            Response::redirect('auth/logined');
        }
        // CSRFチェック
        if (Input::method() === 'POST') {
            if (!Security::check_token()) {
                Response::redirect('auth/timeout');
            }
        }
    }

    public function action_404() {
        // ページが見つからない
        $this->template->title = 'ページが見つかりません。';
        $this->template->breadcrumb = $this->get_bs("404");
        $this->template->content = View::forge('auth/404');
    }

    public function action_timeout() {
        // 不正アクセス
        return Response::redirect('/');
    }

    public function action_logined() {
        // ログイン後ページ
        return Response::redirect('/');
    }

    private function validate_login() {
        // 入力チェック
        $validation = Validation::forge();
        $validation->add('username', 'ユーザー名')
                ->add_rule('required')
                ->add_rule('min_length', 4)
                ->add_rule('max_length', 15);
        $validation->add('password', 'パスワード')
                ->add_rule('required')
                ->add_rule('min_length', 6)
                ->add_rule('max_length', 20);
        $validation->run();
        return $validation;
    }

    public function action_login() {
        // ログイン処理
        $username = Input::post('username', null);
        $password = Input::post('password', null);
        $result_validate = '';
        if ($username !== null && $password !== null) {
            $validation = $this->validate_login();
            $errors = $validation->error();
            if (empty($errors)) {
                // ログイン認証を行う
                $auth = Auth::instance();
                if ($auth->login($username, $password)) {
                    // ログイン成功
                    Response::redirect('/');
                }
                $result_validate = "ログインに失敗しました。";
            } else {
                $result_validate = $validation->show_errors();
            }
        }
        $this->template->title = 'ログイン';
        $this->template->breadcrumb = $this->get_bs("login");
        $this->template->content = View::forge('auth/login');
        $this->template->content->set_safe('errmsg', $result_validate);
    }

    public function action_logout() {
        // ログアウト処理
        Auth::logout();
        Response::redirect('/');
    }

    public function action_usercreate() {
        // ユーザー作成
        $this->template->title = '会員登録';
        $this->template->breadcrumb = $this->get_bs("usercreate");
        $this->template->content = View::forge('auth/usercreate');
        $this->template->content->set_safe('errmsg', "");
    }

    private function validate_create() {
        // 入力チェック
        $validation = Validation::forge();
        $validation->add('username', 'ユーザー名')
                ->add_rule('required')
                ->add_rule('min_length', 4)
                ->add_rule('max_length', 15);
        $validation->add('password', 'パスワード')
                ->add_rule('required')
                ->add_rule('min_length', 6)
                ->add_rule('max_length', 20);
        $validation->add('email', 'Eメール')
                ->add_rule('required')
                ->add_rule('valid_email');
        $validation->run();
        return $validation;
    }

    public function action_usercreated() {
        // ユーザー登録
        $validation = $this->validate_create();
        $errors = $validation->error();
        try {
            if (empty($errors)) {
                $auth = Auth::instance();
                $input = $validation->input();
                if ($auth->create_user($input['username'], $input['password'], $input['email'])) {
                    $this->template->title = '登録完了';
                    $this->template->breadcrumb = $this->get_bs("created");
                    $this->template->content = View::forge('auth/created');
                    return;
                }
                $result_validate = 'ユーザー作成に失敗しました。';
            } else {
                $result_validate = $validation->show_errors();
            }
        } catch (SimpleUserUpdateException $e) {
            $result_validate = $e->getMessage();
        }
        $this->template->title = '会員登録';
        $this->template->breadcrumb = $this->get_bs("usercreate");
        $this->template->content = View::forge('auth/usercreate');
        $this->template->content->set_safe('errmsg', $result_validate);
    }

    public function action_artistcreate() {
        // ユーザー作成
        $this->template->title = '会員登録';
        $this->template->breadcrumb = $this->get_bs("artistcreate");
        $this->template->content = View::forge('auth/artistcreate');
        $this->template->content->set_safe('errmsg', "");
    }

    private function validate_artistcreate() {
        // 入力チェック
        $validation = Validation::forge();
        $validation->add('username', 'アーティスト名')
                ->add_rule('required')
                ->add_rule('min_length', 4)
                ->add_rule('max_length', 15);
        $validation->add('password', 'パスワード')
                ->add_rule('required')
                ->add_rule('min_length', 6)
                ->add_rule('max_length', 20);
        $validation->add('email', 'Eメール')
                ->add_rule('required')
                ->add_rule('valid_email');
        $validation->run();
        return $validation;
    }

    public function action_artistcreated() {
        // アーティスト登録
        $validation = $this->validate_create();
        $errors = $validation->error();
        try {
            if (empty($errors)) {
                $auth = Auth::instance();
                $input = $validation->input();
                if ($auth->create_user($input['username'], $input['password'], $input['email'], 2)) {
                    $artistid = Model_User::getid($input['username']);
                    Model_Artistinfo::validate($artistid[0]['id']);
                    $this->template->title = '登録完了';
                    $this->template->breadcrumb = $this->get_bs("created");
                    $this->template->content = View::forge('auth/created');
                    return;
                }
                $result_validate = 'アーティスト作成に失敗しました。';
            } else {
                $result_validate = $validation->show_errors();
            }
        } catch (SimpleUserUpdateException $e) {
            $result_validate = $e->getMessage();
        }
        $this->template->title = '会員登録';
        $this->template->breadcrumb = $this->get_bs("artistcreate");
        $this->template->content = View::forge('auth/artistcreate');
        $this->template->content->set_safe('errmsg', $result_validate);
    }

    public function action_update() {
        // ユーザー更新
        $auth = Auth::instance();
        $username = $auth->get_screen_name();
        $email = $auth->get_email();
        $this->template->title = '会員情報編集';
        $this->template->breadcrumb = $this->get_bs("update");
        $this->template->content = View::forge('auth/update');
        $this->template->content->set_safe('errmsg', "");
        $this->template->content->set('username', $username);
        $this->template->content->set('email', $email);
    }

    private function validate_update() {
        // 入力チェック
        $validation = Validation::forge();
        $validation->add('password', '新パスワード')
                ->add_rule('min_length', 6)
                ->add_rule('max_length', 20);
        $validation->add('old_password', '旧パスワード')
                ->add_rule('min_length', 6)
                ->add_rule('max_length', 20);
        $validation->add('email', 'Eメール')
                ->add_rule('valid_email');
        $validation->run();
        return $validation;
    }

    public function action_updated() {
        // ユーザー更新
        $validation = $this->validate_update();
        $errors = $validation->error();
        $auth = Auth::instance();
        $result_validate = '';
        try {
            if (empty($errors)) {
                $input = $validation->input();
                $values = array();
                foreach ($input as $key => $value) {
                    if ($value === '')
                        continue;
                    $values[$key] = $value;
                }
                $username = Input::post('username', null);
                if (!empty($values) && $auth->update_user($values, $username)) {
                    $this->template->title = 'ユーザー更新完了';
                    $this->template->breadcrumb = $this->get_bs("updated");
                    $this->template->content = View::forge('auth/updated');
                    return;
                }
                if (!empty($values))
                    $result_validate = '更新に失敗しました。';
            } else {
                $result_validate = $validation->show_errors();
            }
        } catch (Exception $e) {
            $result_validate = $e->getMessage();
        }
        $this->template->title = 'ユーザー更新';
        $this->template->breadcrumb = $this->get_bs("update");
        $this->template->content = View::forge('auth/update');
        $this->template->content->set_safe('errmsg', $result_validate);
        $username = $auth->get_screen_name();
        $email = $auth->get_email();
        $this->template->content->set('username', $username);
        $this->template->content->set('email', $email);
    }

    public function action_remove() {
        // ユーザー削除
        $auth = Auth::instance();
        $username = $auth->get_screen_name();
        $this->template->title = 'ユーザー削除';
        $this->template->content = View::forge('auth/remove');
        $this->template->content->set('errmsg', '');
        $this->template->content->set('username', $username);
    }

    public function action_removed() {
        $auth = Auth::instance();
        try {
            $auth->delete_user(Input::post('username', null));
            Auth::logout();
        } catch (Exception $e) {
            $errmsg = $e->getMessage();
            $this->template->title = 'ユーザー削除';
            $this->template->content = View::forge('auth/remove');
            $this->template->content->set('errmsg', $errmsg);
            return;
        }
        $this->template->title = 'ユーザー削除完了';
        $this->template->content = View::forge('auth/removed');
    }

    public function get_bs($path) {
        $bs = array(array("url" => "", "name" => "AUTH"));
        switch ($path) {
            case "login":
                array_push($bs, array("url" => "login", "name" => "LOGIN"));
                break;
            case "usercreate":
                array_push($bs, array("url" => "usercreate", "name" => "USER CREATE"));
                break;
            case "artistcreate":
                array_push($bs, array("url" => "artistcreate", "name" => "ARTIST CREATE"));
                break;
            case "update":
                array_push($bs, array("url" => "update", "name" => "UPDATE"));
                break;
            case "created":
                array_push($bs, array("url" => "created", "name" => "CREATED"));
                break;
        }
        return $bs;
    }

}
