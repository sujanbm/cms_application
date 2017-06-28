<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Doctrine\ORM\EntityRepository;
use cms\models\Categories;
use cms\models\Posts;
class FrontController extends Front_Controller {

    protected $post;

	public function __construct(){
		$this->load->library('pagination');
        $this->post['posts'] = $this->doctrine->em->getRepository('cms\models\Posts')->fetch_users(5);
        $this->post['categories'] = $this->doctrine->em->getRepository('cms\models\Categories')->findBy(array('subCategory' => null ));
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
        $this->posts();
	}

    public function posts(){

        $config['base_url'] = site_url('cms/front/posts');
        $config['per_page'] = 3;
        $config['total_rows'] = count($this->doctrine->em->getRepository('cms\models\Posts')->findAll());
        $config['uri-segment'] = 2;
        $config['display_pages'] = false;

        $config['full_tag_open'] = '<div><ul  class="pagination">';


        $this->pagination->initialize($config);

        $this->post['links'] = $this->pagination->create_links();
        $page = $this->input->get('per_page')?:0;
        $this->post['list'] = $this->doctrine->em->getRepository('cms\models\Posts')->fetch_users($config['per_page'], $page);
        $this->post['catName'] = "";

        $this->load->view('front/content', $this->post);

    }

    public function category($id){

        $config['base_url'] = site_url('cms/front/category/').$id;
        $config['per_page'] = 3;
        $config['total_rows'] = count($this->doctrine->em->getRepository('cms\models\Categories')->getPosts($id));
        $config['uri-segment'] = 4;

        $this->pagination->initialize($config);

        $this->post['links'] = $this->pagination->create_links();
        $page = $this->input->get('per_page')?:0;
        $this->post['list'] = $this->doctrine->em->getRepository('cms\models\Categories')->getPostsFromCategory($id, $config['per_page'], $page);
        $this->post['catName'] = $this->doctrine->em->getRepository('cms\models\Categories')->find($id)->getCategoryName();
        $this->load->view('front/content', $this->post);

    }

    public function singlePost($id){

        $this->post['post'] = $this->doctrine->em->getRepository('cms\models\Posts')->find($id);

        if ($this->post['post'] != null){
            $this->load->view('front/singlePost', $this->post);
        }else{
            $this->session->set_message('errorMessage', 'The post does not exist');
            redirect('cms/front/posts');
        }
    }

}
