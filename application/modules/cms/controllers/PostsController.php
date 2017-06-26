<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Doctrine\ORM\EntityRepository;
use cms\models\Categories;
use cms\models\Posts;
class PostsController extends Admin_Controller {

	protected $admin;

	public function __construct(){

		parent::__construct();
		$this->admin['categories'] = $this->doctrine->em->getRepository('cms\models\Categories')->findBy(array ('subCategory' => null, ));
		$this->admin['posts'] = $this->doctrine->em->getRepository('cms\models\Posts')->findBy( array(), array('createdAt' => 'DESC' ));

		$this->load->library(array('pagination', 'form_validation'));

	}

	public function index()
	{
		$config['base_url']		=	site_url('cms/posts/index');
		$config['per_page']		=	3;
		$config['uri-segment']	=	4;
		$config['total_rows']	=	count($this->doctrine->em->getRepository('cms\models\Posts')->findAll());

		$this->pagination->initialize($config);

		$this->admin['links'] = $this->pagination->create_links();

		$page = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;

		$this->admin['list'] = $this->doctrine->em->getRepository('cms\models\Posts')->fetch_users($config['per_page'], $page);

		$this->load->view('admins/posts/viewPost', $this->admin);
	}

	public function createPost(){

		$this->load->view('admins/posts/addPost', $this->admin);

	}

	public function addPost(){

		if($this->form_validation->run('post/create') == FALSE){

			$this->createPost();

		}else{

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

	}

	public function editPost($id){

		$this->admin['post'] = $this->doctrine->em->getRepository('cms\models\Posts')->findOneBy(array( 'id'=> $id));
		$this->load->view('admins/posts/editPost', $this->admin);

	}

	public function updatePost(){

		if($this->form_validation->run('post/update') == FALSE){

			$this->editPost($this->input->post('id'));

		}else{

			$post = $this->doctrine->em->getRepository('cms\models\Posts')->find($this->input->post('id'));

			if($post != null){
				$post->setPostTitle($this->input->post('postTitle'));
				$post->setPostBody($this->input->post('postBody'));
				if ($_FILES['file']['name'] != null) {

					//Removes the old photo
					$path = FCPATH.'/uploads/posts/'.$post->getPhotoPath();
					if(file_exists($path)) {
						unlink($path);
					}

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

	}

	public function deletePost($id){

		$post = $this->doctrine->em->getRepository('cms\models\Posts')->find($id);
		if ($post != null){
			$this->session->set_flashdata('deleteMessage', 'The Post ' .$post->getPostTitle(). ' has been deleted!');
			//Removes the photo
			$path = FCPATH.'/uploads/posts/'.$post->getPhotoPath();
			if(file_exists($path)) {
				unlink($path);
			}
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
			'upload_path' => FCPATH.'/uploads/posts/',
			'allowed_types' => 'png|jpg|gif',
			'overwrite' => false,
			'encrypt_name' => TRUE,
			'max_filename' => 15
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
