<?php
/**
 * The Welcome genre controller.
 *
 * @package  app
 * @author   MT2 Team
 * @extends  Controller_Rest
 * 
 * 説明：曲ジャンル処理関連用
 */
class Controller_Genre extends Controller_Template{

	public function action_index()
	{
		$data['genre'] = Model_Genre::find('all');
		$this->template->title = "genre";
		$this->template->content = View::forge('genre/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('genre');

		if ( ! $data['genre'] = Model_Genre::find($id))
		{
			Session::set_flash('error', 'Could not find genre #'.$id);
			Response::redirect('genre');
		}

		$this->template->title = "genre";
		$this->template->content = View::forge('genre/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Genre::validate('create');
			
			if ($val->run())
			{
				$genre = Model_Genre::forge(array(
					'genreid' => Input::post('genreid'),
					'genrename' => Input::post('genrename'),
				));

				if ($genre and $genre->save())
				{
					Session::set_flash('success', 'Added genre #'.$genre->id.'.');

					Response::redirect('genre');
				}

				else
				{
					Session::set_flash('error', 'Could not save genre.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "genre";
		$this->template->content = View::forge('genre/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('genre');

		if ( ! $genre = Model_Genre::find($id))
		{
			Session::set_flash('error', 'Could not find genre #'.$id);
			Response::redirect('genre');
		}

		$val = Model_Genre::validate('edit');

		if ($val->run())
		{
			$genre->genreid = Input::post('genreid');
			$genre->genrename = Input::post('genrename');

			if ($genre->save())
			{
				Session::set_flash('success', 'Updated genre #' . $id);

				Response::redirect('genre');
			}

			else
			{
				Session::set_flash('error', 'Could not update genre #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$genre->genreid = $val->validated('genreid');
				$genre->genrename = $val->validated('genrename');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('genre', $genre, false);
		}

		$this->template->title = "genre";
		$this->template->content = View::forge('genre/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('genre');

		if ($genre = Model_Genre::find($id))
		{
			$genre->delete();

			Session::set_flash('success', 'Deleted genre #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete genre #'.$id);
		}

		Response::redirect('genre');

	}


}
