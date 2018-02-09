<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); error_reporting(E_ALL);

class Article extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('is_login')){
			redirect('auth?location='.urlencode($_SERVER['REQUEST_URI']));
		}
		$this->load->model(array('m_menu','m_article'));
		//$this->load->helper(array('check_auth_menu', 'article'));
		$this->load->library('upload');
		//check_authority_url();		
	}

	function index()
	{
		$config['title'] = 'DOTcom';
		$config['page_title'] = 'Berita';
		$config['page_subtitle'] = 'Daftar Berita';
	    $config['article_list'] = $this->m_article->get_all();	    
       
		$this->load->view('articles/v_list', $config);
	}

	function add_article()
	{
		if (isset($_POST['submit'])) {
			$this->insert_article();
		} else {
			$config['title'] = 'DOTcom';
			$config['page_title'] = 'Berita';
			$config['page_subtitle'] = 'Tambah Berita';
			$config['list_category'] = $this->m_article->get_list_category();
			$this->load->view('articles/v_add', $config);
		}
	}
	
	public function insert_article() {
		$data = array(
			'title' => $this->input->post('articleTitle'),
			'content' => $this->input->post('articleText'),
			'category' => $this->input->post('articleCategory'),
			'linkVideos' => $this->input->post('articleVid'),
			'date_published' => date('d-M-Y'),
		);

		if (isset($_FILES['articlePic']) && !empty($_FILES['articlePic']['name'])) {
			$options['filename'] = sha1($_FILES['articlePic']['name'].date('d-M-Y'));
			$this->m_article->insert_image_filestream('articlePic', $options);
			$data['image_metadata'] = $options;
			unset($options);
		}
		 
		$this->m_article->insert_data('artikel', $data);
		redirect(base_url('article'));
	}	

	function edit_article($id)
	{
		if (isset($_POST['submit'])) {
			$this->update_article($id);
		} else {
			$config['title'] = 'DOTcom';
			$config['page_title'] = 'Berita';
			$config['page_subtitle'] = 'Ubah Berita';
			$config['article_list'] =	$this->m_article->get_article_by_id($id);
			$config['list_category'] = $this->m_article->get_list_category();
			$this->session->set_userdata('edit_article', true);

			$this->load->view('articles/v_add', $config);
		}
	}

	function show_image() {
		$image_preview = '';
		if (isset($_GET['filename']) && !empty($_GET['filename'])) {
			$where['filename'] = $_GET['filename'];
			$image = $this->m_article->get_image_from_filestream($where);
			unset($where);
			$image = $image->getResource();
			while (!feof($image)) {
                $image_preview .= fread($image, 8192);
			}
		};
		header('Content-type: image/jpeg');
		echo $image_preview;
	}

	function update_article($id){
		$data = array(
			'title' => $this->input->post('articleTitle'),
			'content' => $this->input->post('articleText'),
			'category' => $this->input->post('articleCategory'),
			'linkVideos' => $this->input->post('articleVid'),
		);

		if (isset($_FILES['articlePic']) && !empty($_FILES['articlePic']['name'])) {
			$options['filename'] = sha1($_FILES['articlePic']['name'].date('d-M-Y'));
			$this->m_article->insert_image_filestream('articlePic', $options, true);
			$data['image_metadata'] = $options;
			unset($options);
		}
		 
		$where['_id'] = new MongoId($id);
		$this->m_article->update_data('artikel', $data, $where);
		redirect(base_url('article'));	
	}
	
	function delete($id){
		$this->m_article->delete_article($id);
	}

	function delete_image($id){
		$path = realpath('uploads/article_pic/');
		$filename = $this->m_article->get_file_name_perpic($id);
		foreach ($filename as $row) {
			if(unlink($path.'/'.$row->pbArticleImagePicture)){		
				$this->m_article->delete_image($id);
			}
		}		
	}

	function delete_video($id){		
		$res = $this->m_article->delete_video($id);
		echo $res;
	}

	function check_article_title(){
		$title = $this->input->post('title');
		$this->m_article->check_article_title($title);
	}
}