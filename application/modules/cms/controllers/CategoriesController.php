<?php
use Doctrine\ORM\EntityRepository;
use cms\models\Categories;
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoriesController extends CI_Controller {

	public function index(){

		$categories['categories'] = $this->doctrine->em->getRepository('cms\models\Categories')->getAllCategories();
		$this->load->view('categories/viewCategories', $categories);

	}

	public function createCategory(){
		$category['categories'] = $this->doctrine->em->getRepository('cms\models\Categories')->getAllCategories();
		$this->load->view('categories/addCategories', $category);

	}

	public function addCategory(){

		$category = new Categories();
		$category->setCategoryName($this->input->post('categoryName'));
		$this->doctrine->em->persist($category);
		$this->doctrine->em->flush();
		$this->session->set_flashdata('message', 'Category Added!');
		redirect(site_url('cms/categories'));

	}

	public function editCategory($id){

		$category = $this->doctrine->em->getRepository('cms\models\Categories')->getCategoryById($id);
		$category['categories'] = $this->doctrine->em->getRepository('cms\models\Categories')->getAllCategories();
		$this->load->view('categories/editCategory', $category);

	}

	public function updateCategory(){

		if($this->doctrine->em->getRepository('cms\models\Categories')->updateCategory($this->input->post())){
			$this->session->set_flashdata('message', 'Category Name Updated!');
			redirect(site_url('cms/categories'));
		}else{
			$this->session->set_flashdata('errorMessage', 'Error Occured!');
			redirect(site_url('cms/categories/editCategory/').$this->input->post('id'));
		}
	}

	public function posts($id){
		$posts['categories'] = $this->doctrine->em->getRepository('cms\models\Categories')->getAllCategories();
		$posts['list'] = $this->doctrine->em->getRepository('cms\models\Categories')->getPostsByCategory($id);
		$this->load->view('categories/viewPosts', $posts);

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
}
