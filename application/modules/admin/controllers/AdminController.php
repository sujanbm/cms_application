<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Doctrine\ORM\EntityRepository;
use admin\models\Admin;


class AdminController extends CI_Controller {

	public function __construct(){

		parent::__construct();

		if (empty($this->session->userdata('logged_in'))){

			redirect(site_url('admin/login'));
		}
	}

	public function index()
	{
		$admin['admins'] = $this->doctrine->em->getRepository('admin\models\Admin')->findAll();
		$this->load->view('admins/viewAdmin', $admin);
	}

	public function createAdmin(){

		$this->load->view('admins/createAdmin');

	}

	public function editAdmin($id){

		$admin['admin'] = $this->doctrine->em->getRepository('admin\models\Admin')->find($id);
		$this->load->view('admins/editAdmin', $admin);

	}

	public function addAdmin(){

		$admin = new Admin();
		$admin->setAdminName($this->input->post('adminName'));
		$admin->setAdminEmail($this->input->post('adminEmail'));
		$admin->setAdminPhone($this->input->post('adminPhone'));
		$admin->setCreatedAt();
		$password = password_hash($this->input->post('adminPassword'), PASSWORD_DEFAULT);
		$admin->setAdminPassword($password);
		if ($_FILES['file']['name'] != null) {
			$admin->setAdminPhoto($this->fileUpload('file'));
		}
		$admin->setAdminStatus($this->input->post('adminStatus'));

		$this->doctrine->em->persist($admin);
		$this->doctrine->em->flush();

		redirect(site_url('admin/'));


	}

	public function updateAdmin(){



	}

	public function deleteAdmin(){



	}

	public function signOut(){

		$this->session->unset_userdata('logged_in');
		$this->session->set_flashdata('errorMessage', 'Signed Out');
		redirect('admin/login');

	}

	public function fileUpload($file){

		//Config for the image
		$config = array(
			'upload_path' => FCPATH.'/uploads/admins',
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
