<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PostsController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		echo "<h1>This is Posts</h1>";
	}

	public function createPost(){

		$this->load->view('posts/addPost');

	}

	public function addPost(){



	}

	public function editPost($id){

		$this->load->view('posts/editPost');

	}

	public function updatePost(){



	}

	public function deletePost($id){



	}
}
