<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Doctrine\ORM\EntityRepository;
use cms\models\Categories;
use cms\models\Posts;
class CmsController extends Front_Controller {

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
		$posts['categories'] = $this->doctrine->em->getRepository('cms\models\Categories')->findBy(array ('subCategory' => null));
		$posts['list'] = $this->doctrine->em->getRepository('cms\models\Posts')->getAllPosts();
		$this->load->view('posts/viewPost', $posts);
	}

	public function category($id){
		$posts['categories'] = $this->doctrine->em->getRepository('cms\models\Categories')->findBy(array('subCategory' => null ));
		$posts['list'] = $this->doctrine->em->getRepository('cms\models\Categories')->getPosts($id);
		$this->load->view('posts/viewPost', $posts);

	}
}
