<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Doctrine\ORM\EntityRepository;
use admin\models\Admin;


class LoginController extends Front_Controller {

    public function __construct(){

        parent::__construct();

        if (!empty($this->session->userdata('logged_in'))){

            redirect(site_url('admin'));

        }

        $this->load->library('form_validation');
    }

    public function index(){

        $this->load->view('login/login');

    }

    public function verify(){

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $admin = $this->doctrine->em->getRepository('admin\models\Admin')->findOneBy(array ('adminEmail' => $email));

        if (!empty($admin)){

            if (password_verify($password, $admin->getAdminPassword())){

                $logged_in = array(
                    'id'        =>  $admin->getId(),
                    'email'     =>  $admin->getAdminEmail(),
                    'name'      =>  $admin->getAdminName(),
                    'photo'     =>  $admin->getAdminPhoto(),
                    'roleId'    =>  $admin->getRole()->getId(),
                    'roleName'  =>  $admin->getRole()->getRoleName(),
                    'date'      =>  $admin->getCreatedAt(),
                 );

                 $this->session->set_userdata('logged_in', $logged_in);
                 $this->session->set_flashdata('message', 'Welcome '.$admin->getAdminName());
                 redirect('admin');
            }else{
                $this->session->set_flashdata('errorMessage', 'Wrong Password');
                redirect('admin/login');
            }

        }else{

            $this->session->set_flashdata('errorMessage', 'Invalid Email');
            redirect('admin/login');
        }

    }
}

?>
