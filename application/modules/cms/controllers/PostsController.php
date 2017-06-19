<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Doctrine\ORM\EntityRepository;
use cms\models\Categories;
use cms\models\Posts;
class PostsController extends CI_Controller {

	public function index()
	{
		$posts['categories'] = $this->doctrine->em->getRepository('cms\models\Categories')->getAllCategories();
		$posts['list'] = $this->doctrine->em->getRepository('cms\models\Posts')->getAllPosts();
		$this->load->view('posts/viewPost', $posts);
	}

	public function createPost(){
		$category['categories'] = $this->doctrine->em->getRepository('cms\models\Categories')->getAllCategories();
		$this->load->view('posts/addPost', $category);

	}

	public function addPost(){
		$post = new Posts();
		$post->setPostTitle($this->input->post('postTitle'));
		$post->setPostBody($this->input->post('postBody'));
		$post->setCreatedAt();
		$post->setCategories($this->doctrine->em->getRepository('cms\models\Categories')->find($this->input->post('categories')));

		$this->doctrine->em->persist($post);
		$this->doctrine->em->flush();

		redirect(site_url('cms/posts'));


	}

	public function editPost($id){

		$post = $this->doctrine->em->getRepository('cms\models\Posts')->getPostById($id);
		$post['categories'] = $this->doctrine->em->getRepository('cms\models\Categories')->getAllCategories();
		$this->load->view('posts/editPost', $post);

	}

	public function updatePost(){

		if($this->doctrine->em->getRepository('cms\models\Posts')->updatePost($this->input->post())){
			redirect(site_url('cms/posts'));
		}else{
			redirect(site_url('cms/posts/editPost'). $this->input->post('id'));
		}


	}

	public function deletePost($id){

		$post = $this->doctrine->em->getRepository('cms\models\Posts')->find($id);
		$this->doctrine->em->remove($post);
		$this->doctrine->em->flush();

		redirect(site_url('cms/posts'));


	}
}
