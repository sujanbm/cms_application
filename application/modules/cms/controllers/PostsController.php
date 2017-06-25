<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Doctrine\ORM\EntityRepository;
use cms\models\Categories;
use cms\models\Posts;
class PostsController extends Admin_Controller {

	protected $admin;

	public function __construct(){

		$this->admin['categories'] = $this->doctrine->em->getRepository('cms\models\Categories')->findBy(array ('subCategory' => null, ));
		$this->admin['posts'] = $this->doctrine->em->getRepository('cms\models\Posts')->findBy( array(), array('createdAt' => 'DESC' ));
		$this->load->library('pagination');

	}

	public function index()
	{
		// $this->admin['list'] = $this->doctrine->em->getRepository('cms\models\Posts')->getAllPosts();
		$config = array(
			'base_url'			=>	site_url('cms/posts/index'),
			'total_rows'		=>	count($this->doctrine->em->getRepository('cms\models\Posts')->findAll()),
			'per_page'			=>	3,
			'uri-segment'		=>	4,

			// 'use_page_numbers'	=>	TRUE,
			// 'display_pages'		=>	FALSE,

			'first_link'		=>	'First',
			'last_link'			=>	'Last',
			// 'next_link'			=>	'Next Page &rarr;',
			// 'prev_link'			=>	'&larr; Previous Page',

			'full_tag_open'		=>	'<div><ul class="pagination pull-right">',
			'full_tag_close'	=>	'</ul></div>',

			'first_tag_open'	=>	'<li class="prev page">',
			'last_tag_open'		=>	'<li class="next page">',
			'next_tag_open'		=>	'<li class="next page">',
			'prev_tag_open'		=>	'<li class="prev page">',
			'num_tag_open'		=>	'<li class="page">',

			'first_tag_close'	=>	'</li>',
			'last_tag_close'	=>	'</li>',
			'next_tag_close'	=>	'</li>',
			'prev_tag_close'	=>	'</li>',
			'num_tag_close'		=>	'</li>',

			'cur_tag_open'		=>	'<li class="active"><a href="">',
			'cur_tag_close'		=>	'</a></li>',
		);

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;
		$this->admin['list'] = $this->doctrine->em->getRepository('cms\models\Posts')->fetch_users($config['per_page'], $page);
		$this->admin['links'] = $this->pagination->create_links();

		$this->load->view('admins/posts/viewPost', $this->admin);
	}

	public function createPost(){

		$this->load->view('admins/posts/addPost', $this->admin);

	}

	public function addPost(){

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

		$this->admin['post'] = $this->doctrine->em->getRepository('cms\models\Posts')->findOneBy(array( 'id'=> $id));
		$this->load->view('admins/posts/editPost', $this->admin);

	}

	public function updatePost(){

		$post = $this->doctrine->em->getRepository('cms\models\Posts')->find($this->input->post('id'));

		if($post != null){
			$post->setPostTitle($this->input->post('postTitle'));
			$post->setPostBody($this->input->post('postBody'));
			if ($_FILES['file']['name'] != null) {
				$path = $this->fileUpload('file');
				$post->setPhotoPath($path);
			}
			$post->setUpdatedAt();
			$post->setCategories($this->doctrine->em->getRepository('cms\models\Categories')->find($this->input->post('categories')));
			$this->doctrine->em->flush();
			$this->session->set_flashdata('message', 'The Post ' .$post->getPostTitle(). ' has been updated!');
			redirect(site_url('cms/posts'));
		}else{
			$this->session->set_flashdata('errorMessage', 'Error Occured! Could not update!!');
			redirect(site_url('cms/posts/'));
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

	public function viewPost($id){

		$this->admin['post'] = $this->doctrine->em->getRepository('cms\models\Posts')->find($id);
		if ($this->admin['post'] != null){

			$this->load->view('admins/posts/view', $this->admin);

		}else{

			$this->session->set_flashdata('errorMessage', 'Could not view the post! The Post does not exist');
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
