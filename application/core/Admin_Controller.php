<?php

class  Admin_Controller extends MY_Controller{
    public function __construct(){
        parent::__construct();

		if (empty($this->session->userdata('logged_in'))){

			redirect(site_url('admin/login'));
		}
    }
}
