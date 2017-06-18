<?php
use Doctrine\ORM\EntityRepository;
use cms\models\Categories;
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoriesController extends CI_Controller {

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
	public function index(){

		$categories['list'] = $this->doctrine->em->getRepository('cms\models\Categories')->getAllCategories();
		$this->load->view('categories/viewCategories', $categories);

	}

	public function createCategory(){

		$this->load->view('categories/addCategories');

	}

	public function addCategory(){

		$category = new Categories();
		$category->setCategoryName($this->input->post('categoryName'));
		$this->doctrine->em->persist($category);
		$this->doctrine->em->flush();

		redirect(site_url('cms/categories'));

	}

	public function editCategory($id){



	}
}
