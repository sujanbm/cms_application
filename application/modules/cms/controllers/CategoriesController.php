<?php
use Doctrine\ORM\EntityRepository;
use cms\models\Categories;
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoriesController extends Admin_Controller {

	protected $admin;

	public function __construct(){

		parent::__construct();

		$this->admin['categories'] = $this->doctrine->em->getRepository('cms\models\Categories')->findBy(array('subCategory' => null));
		$this->admin['posts'] = $this->doctrine->em->getRepository('cms\models\Posts')->findAll();
		$this->load->library(array('pagination', 'form_validation'));
		$this->form_validation->CI =& $this;

	}
	public function index(){

		$this->admin['list'] = $this->doctrine->em->getRepository('cms\models\Categories')->findBy(array('subCategory' => null ));
		$this->load->view('admins/categories/viewCategories', $this->admin);

	}

	public function createCategory(){

		$this->load->view('admins/categories/addCategories', $this->admin);

	}

	public function addCategory(){

		if($this->form_validation->run('category/create') == FALSE){

			$this->createCategory();

		}else{

			$category = new Categories();
			$category->setCategoryName($this->input->post('categoryName'));
			$category->setSubCategory($this->doctrine->em->getRepository('cms\models\Categories')->find($this->input->post('subCategoryId')));
			$this->doctrine->em->persist($category);
			$this->doctrine->em->flush();
			$this->session->set_flashdata('message', 'Category Added!');
			redirect(site_url('cms/categories'));

		}

	}

	public function editCategory($id){

		$this->admin['cat'] = $this->doctrine->em->getRepository('cms\models\Categories')->find($id);
		$this->load->view('admins/categories/editCategory', $this->admin);

	}

	public function updateCategory(){

		if ($this->form_validation->run('category/update') == FALSE){

			$this->editCategory($this->input->post('id'));

		}else{

			$category = $this->getEntityManager()->getRepository('cms\models\Categories')->find($post['id']);

            if ($category != null){

                $category->setCategoryName($post['categoryName']);
                $category->setSubCategory($this->getEntityManager()->getRepository('cms\models\Categories')->find($post['subCategoryId']));
                $this->getEntityManager()->flush();

				$this->session->set_flashdata('message', 'Category '.$category->getCategoryName().' succesfully updated!');

				redirect(site_url('cms/categories'));

			}else{
				$this->session->set_flashdata('errorMessage', 'Error Occured!');
				redirect(site_url('cms/categories/editCategory/').$this->input->post('id'));
			}

		}

	}

	public function posts($id){

		$config['base_url']		=	site_url('cms/categories/posts/').$id;
		$config['per_page']		=	3;
		$config['uri-segment']	=	5;
		$config['total_rows']	=	count($this->doctrine->em->getRepository('cms\models\Categories')->getPostsFromCategory($id));

		$this->pagination->initialize($config);

		$this->admin['links'] = $this->pagination->create_links();

		// $page = ($this->uri->segment()) ? ($this->uri->segment(5)) : 0;
		$page = $this->input->get('per_page')?:0;

		$this->admin['list'] = $this->doctrine->em->getRepository('cms\models\Categories')->getPostsFromCategory($id, $config['per_page'], $page);

		$this->load->view('admins/categories/viewPosts', $this->admin);

	}

	public function deleteCategory($id){

			$category = $this->doctrine->em->getRepository('cms\models\Categories')->find($id);

			if ($category != null){
				if ($category->getPosts()->count() > 0){
					$this->session->set_flashdata('errorMessage', 'The Category ' . $category->getCategoryName() . ' contains Posts and cannot be deleted!');
					redirect(site_url('cms/categories/'));
				}else{
					$this->session->set_flashdata('deleteMessage', 'The Category '. $category->getCategoryName() .' has been deleted!');
					$this->doctrine->em->remove($category);
					$this->doctrine->em->flush();
					redirect(site_url('cms/categories/'));
					}
			}else{
				$this->session->set_flashdata('errorMessage', 'The Category does not exist!');
				redirect(site_url('cms/categories/'));
			}

	}

	public function subCategories($id){

		$cat = $this->doctrine->em->getRepository('cms\models\Categories')->findBy(array('subCategory' => $id ));

		if ($cat != null){
			$this->admin['list'] = $cat;
			$this->load->view('admins/categories/viewCategories', $this->admin);

		}else{
			$this->session->set_flashdata('errorMessage', 'No Sub Categories exist!');
			redirect(site_url('cms/categories'));
		}
	}

	// public function checkChild($category, $tab){
	//
	//
	// 	//from createCategory()
	// 			// foreach($category['categories'] as $c){
	// 			// 	$tab = "";
	// 			// 	$ca['categoryName'] = $c->getCategoryName();
	// 			// 	$ca['id'] = $c->getId();
	// 			// 	$ca['sub'] = $this->checkChild($c, $tab);
	// 			// 	$cate[] = $ca;
	// 			// }
	// 			// $category['list'] = $cate;
	// 			// //
	// 			// // var_dump($cat);
	// 			// // die();
	//
	// 		if($category->getCategory()->count() > 0){
	// 			$tab = $tab . " - - ";
	// 			foreach ($category->getCategory() as $cat) {
	//
	// 				$sub['categoryName'] = $tab . $cat->getCategoryName();
	// 				$sub['id'] =  $cat->getId();
	// 				$sub['sub'] = $this->checkChild($cat, $tab);
	// 				$catego[] = $sub;
	// 			}
	// 				return $catego;
	// 		}
	// }

}
