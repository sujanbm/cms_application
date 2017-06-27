<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Doctrine\ORM\EntityRepository;
use cms\models\Categories;
use cms\models\Posts;
class CmsController extends Front_Controller {


	public function __construct(){
		$this->load->library('pagination');
	}
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
	public function index()
	{
		$config['base_url'] = site_url('cms/index');
		$config['per_page'] = 5;
		$config['total_rows'] = count($this->doctrine->em->getRepository('cms\models\Posts')->getAllPosts());
		$config['uri-segment'] = 3;
		$config['display_pages'] = false;

		$config['full_tag_open'] = '<div><ul  class="pagination">';


		$this->pagination->initialize($config);

		$posts['links'] = $this->pagination->create_links();
		$page = $this->input->get('per_page')?:0;
		$posts['list'] = $this->doctrine->em->getRepository('cms\models\Posts')->fetch_users($config['per_page'], $page);

		$posts['categories'] = $this->doctrine->em->getRepository('cms\models\Categories')->findBy(array ('subCategory' => null));

		$this->load->view('front/viewPost', $posts);
	}

	public function category($id){
		$posts['categories'] = $this->doctrine->em->getRepository('cms\models\Categories')->findBy(array('subCategory' => null ));

		$config['base_url'] = site_url('cms/category/').$id;
		$config['per_page'] = 4;
		$config['total_rows'] = count($this->doctrine->em->getRepository('cms\models\Categories')->getPosts($id));
		$config['uri-segment'] = 5;

		$this->pagination->initialize($config);

		$posts['links'] = $this->pagination->create_links();
		$page = $this->input->get('per_page')?:0;
		$posts['list'] = $this->doctrine->em->getRepository('cms\models\Categories')->getPostsFromCategory($id, $config['per_page'], $page);
		$this->load->view('front/viewPost', $posts);

	}
}
