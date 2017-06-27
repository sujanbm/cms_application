<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Doctrine\ORM\EntityRepository;
use admin\models\Admin;
use crm\models\Categories;
use crm\models\Posts;

class AdminController extends Admin_Controller {

	protected $admin;

	public function __construct(){

		parent::__construct();
		$this->admin['admins'] = $this->doctrine->em->getRepository('admin\models\Admin')->findAll();
		$this->admin['posts'] = $this->doctrine->em->getRepository('cms\models\Posts')->findAll();
		$this->admin['categories'] = $this->doctrine->em->getRepository('cms\models\Categories')->findBy(array('subCategory' => null ));
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;

	}

	public function index(){

		$this->load->view('admins/viewAdmin', $this->admin);

	}

	public function createAdmin(){
		if ($this->session->userdata('logged_in')['roleId'] == 1){

			$this->admin['roles'] = $this->doctrine->em->getRepository('admin\models\AdminRoles')->findAll();
			$this->load->view('admins/createAdmin', $this->admin);

		}else{
			redirect(site_url('admin'));
		}

	}

	public function editAdmin($id){
			if ($this->session->userdata('logged_in')['roleId'] == 1){
				$this->admin['admin'] = $this->doctrine->em->getRepository('admin\models\Admin')->find($id);
				$this->admin['roles'] = $this->doctrine->em->getRepository('admin\models\AdminRoles')->findAll();

				if (!empty($this->admin['admin'])){
					$this->load->view('admins/editAdmin', $this->admin);
				}else{
					$this->session->set_flashdata('errorMessage', 'Admin with that id does not exist');
					redirect(site_url('admin'));
				}
			}else{
				redirect(site_url('admin'));
			}

	}

	public function addAdmin(){

		// $this->form_validation->set_rules('adminEmail', 'EMail', 'callback_email_check');
		if($this->form_validation->run('admin/create') == FALSE){

			$this->createAdmin();

		}else{

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
			$admin->setRole($this->doctrine->em->getRepository('admin\models\AdminRoles')->find($this->input->post('role')));

			$this->doctrine->em->persist($admin);
			$this->doctrine->em->flush();
			$this->session->set_flashdata('message', 'Admin '.$this->input->post('adminName'). ' has been added');
			redirect(site_url('admin/'));

		}

	}

	public function updateAdmin(){

		if($this->form_validation->run('admin/update') == FALSE){

			$this->editAdmin($this->input->post('id'));

		}else{

			$admin = $this->doctrine->em->getRepository('admin\models\Admin')->find($this->input->post('id'));
			if (!empty($admin)){

				$admin->setAdminName($this->input->post('adminName'));
				$admin->setAdminEmail($this->input->post('adminEmail'));
				$admin->setAdminPhone($this->input->post('adminPhone'));
				$admin->setAdminStatus($this->input->post('adminStatus'));
				if ($_FILES['file']['name'] != null) {
					$admin->setAdminPhoto($this->fileUpload('file'));
				}
				$admin->setUpdatedAt();
				$admin->setRole($this->doctrine->em->getRepository('admin\models\AdminRoles')->find($this->input->post('role')));

				$this->session->set_flashdata('message', 'Updated '. $this->input->post('adminName'). " Admin");

				$this->doctrine->em->flush();

				redirect(site_url('admin'));
			}else{
				$this->session->set_flashdata('errorMessage', 'Some error occured, could not update');
				redirect(site_url('admin'));
			}
		}
	}

	// public function deleteAdmin(){
	//
	//
	//
	// }

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

	public function email_check($email){

		if ($this->doctrine->em->getRepository('admin\models\Admin')->findOneBy(array('adminEmail'=>$email)) != null){

		 	$this->form_validation->set_message('email_check', 'The email is already in use, please use another email');
			return FALSE;

		}else{

			return TRUE;

		}

	}


}
