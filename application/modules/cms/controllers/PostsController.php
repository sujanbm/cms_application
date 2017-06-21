<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Doctrine\ORM\EntityRepository;
use cms\models\Categories;
use cms\models\Posts;
class PostsController extends CI_Controller {

	public function index()
	{
		$posts['categories'] = $this->doctrine->em->getRepository('cms\models\Categories')->findBy(array ('subCategory' => null));
		$posts['list'] = $this->doctrine->em->getRepository('cms\models\Posts')->getAllPosts();
		$this->load->view('posts/viewPost', $posts);
	}

	public function createPost(){
		$category['categories'] = $this->doctrine->em->getRepository('cms\models\Categories')->findBy(array ('subCategory' => null));
		$this->load->view('posts/addPost', $category);

	}

	public function addPost(){
		// var_dump($_FILES);
		// $fileName = $this->fileUpload('file');
		// echo $fileName;
		// die();
		$post = new Posts();
		$post->setPostTitle($this->input->post('postTitle'));
		$post->setPostBody($this->input->post('postBody'));
		$post->setCreatedAt();
		$post->setCategories($this->doctrine->em->getRepository('cms\models\Categories')->find($this->input->post('categories')));
		if ($_FILES['file']['name'] != null) {
			$post->setPhotoPath($this->fileUpload('file'));
		}
		$this->doctrine->em->persist($post);
		$this->doctrine->em->flush();
		$this->session->set_flashdata('message', 'Post succesfully added!');
		redirect(site_url('cms/posts'));


	}

	public function editPost($id){

		$post['post'] = $this->doctrine->em->getRepository('cms\models\Posts')->find($id);
		$post['categories'] = $this->doctrine->em->getRepository('cms\models\Categories')->findBy(array ('subCategory' => null));
		$this->load->view('posts/editPost', $post);

	}

	public function updatePost(){
		if ($_FILES['file']['name'] != null) {
			$path = $this->fileUpload('file');
		}
		if($this->doctrine->em->getRepository('cms\models\Posts')->updatePost($this->input->post(), $path)){
			$this->session->set_flashdata('message', 'The Post has been updated!');
			redirect(site_url('cms/posts'));
		}else{
			$this->session->set_flashdata('errorMessage', 'Error Occured!');
			redirect(site_url('cms/posts/editPost'). $this->input->post('id'));
		}


	}

	public function deletePost($id){

		$post = $this->doctrine->em->getRepository('cms\models\Posts')->find($id);
		if ($post != null){
			$this->session->set_flashdata('deleteMessage', 'The Post ' .$post->getPostTitle(). ' has been deleted!');
			$this->doctrine->em->remove($post);
			$this->doctrine->em->flush();
			redirect(site_url('cms/posts'));
		}else{
			$this->session->set_flashdata('errorMessage', 'The post does not exist!');
			redirect(site_url('cms/posts'));
		}

	}

	public function fileUpload($file){

		//Config for the image
		$config = array(
			'upload_path' => FCPATH.'/uploads',
			'allowed_types' => 'png|jpg|gif',
			'overwrite' => false
		);

		$this->load->library('upload');
		$this->upload->initialize($config);

		if(!$this->upload->do_upload("file")){
			$error = $this->upload->display_errors();
			$this->session->set_flashdata('errorMessage', $error);
			redirect(site_url('cms/posts/createPost'));
		}else{

			$data = $this->upload->data();
			$file_name = $this->upload->file_name;
			//for image manipulation
			$this->load->library('image_lib');

			$con = array(
				'image_library' => 'gd2',
				'source_image'	=> $data['full_path'],
				'maintain_ratio' => true,
				'width'	=> 1000,
				'height' => 1000
			);
			$this->image_lib->clear();
			$this->image_lib->initialize($con);
			$this->image_lib->resize();

			return $file_name;
		}

	}
}
