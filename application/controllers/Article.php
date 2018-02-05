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
		$config['title'] = 'DOTcom';
		$config['page_title'] = 'Berita';
		$config['page_subtitle'] = 'Tambah Berita';
       
		$this->load->view('articles/v_add', $config);
	}
	
	function insert_article(){
		$title  = $this->input->post('articleTitle');
		$text  = $this->input->post('articleText');
		//$images = $_FILES['articlePic'];
		$category = $this->input->post('articleCategory');
		//$videos = $this->input->post('articleVid');
		//$point = $this->input->post('articlePoint');
		//$time = $this->input->post('articleTime');
		//$startPub = date('Y-m-d',strtotime($this->input->post('startPub')));
		//$endPub = date('Y-m-d',strtotime($this->input->post('endPub')));		
		/*$imgUpload =0;
		if(count($images['name']) == 1 && $_FILES['articlePic']['error']['0'] == '4'){
			$imgUpload = 0;
		}else{
			$imgUpload = count($images['name']);
		}
		if(count($videos) == 1 && $videos['0'] == ''){
			$vidUpload = 0;
		}else{
			$vidUpload = count($videos);
		}
		$upPic=0;
		$upVid=0;*/
		//echo $vidUpload;die();
		//insert text article
		$data = array(
			//"pbArticleCategoryId" => $category,
			"title" => $title,
			"content" => $text,
			"date_published" => date('Y-m-d'),
			"category"	=> $category,
			"createdBy" 	=> new MongoDB\BSON\ObjectId($this->session->userdata('user_id')),
			//"" => $this->session->userdata('user_id'),
		);	
		$last_id = $this->m_article->insert_article_text('artikel',$data);
		
		//upload files and link if last_id is not empty
		/*if(!empty($last_id)){
			if(!empty($imgUpload)){
				//initialize
				$upload_conf = array(
					'upload_path'   => realpath('uploads/article_pic/'),
					'allowed_types' => 'gif|jpg|png',
					'max_size'      => '3000',
				);

				$this->upload->initialize($upload_conf);
				for($i=0;$i<count($images['name']);$i++){
					$namewithoutspace = preg_replace('/\s+/','_',$images['name'][$i]);
					$filename = date('His').mt_rand( 10, 100)."_".$namewithoutspace;
					
					$_FILES['articlePic']['name'] = $filename;
					$_FILES['articlePic']['type'] = $images['type'][$i];
					$_FILES['articlePic']['tmp_name'] = $images['tmp_name'][$i];
					$_FILES['articlePic']['error'] = $images['error'][$i];
					$_FILES['articlePic']['size'] = $images['size'][$i];

					if ( ! $this->upload->do_upload('articlePic'))
					{
						$error['upload'][] = $this->upload->display_errors();
						$upPic = $upPic;
					}
					else
					{
						$upload_data = $this->upload->data();
						
						$dataFile = array(
							'pbArticleImageArticleId' 			=> $last_id,
							'pbArticleImagePicture'    	=> $filename,
						);
						
						$insert_data = $this->m_article->insert_article_image($dataFile);
						$upPic = $upPic+1;
					}
				}
			}
			for($j=0;$j<$vidUpload;$j++){
				$dataVideo = array(
						'pbArticleVideoArticleId' 	=> $last_id,
						'pbArticleVideoContent'    	=> $videos[$j],
					);

				$res = $this->m_article->insert_article_video($dataVideo);
				if(!empty($res)){
					$upVid = $upVid+1;
				}
			}
		}*/
		
		/*if(!empty($last_id) && $upPic == $imgUpload && $upVid == $vidUpload) {
			$this->session->set_flashdata('message', 'Article has been added successfully');
		}elseif(!empty($last_id) && $upPic != $imgUpload && $upVid == $vidUpload){
			$this->session->set_flashdata('message', "Failed to upload some article's pictures");
		}elseif(!empty($last_id) && $upPic == $imgUpload && $upVid != $vidUpload){
			$this->session->set_flashdata('message', "Failed to add some article's videos URL");
		}elseif(!empty($last_id) && $upPic != $imgUpload && $upVid != $vidUpload) {
			$this->session->set_flashdata('message', "Failed to upload some article's pictures and videos URL");
		}else{
			$this->session->set_flashdata('message', 'Failed to add article');
		}*/
		redirect(base_url() . 'article', 'refresh');	
	}

	function edit_article($id)
	{
		$config['title'] = 'DOTcom';
		$config['page_title'] = 'Berita';
		$config['page_subtitle'] = 'Ubah Berita';
		$config['article_list'] =	$this->m_article->get_article_by_id($id);
		//$config['video_list']	= $this->m_article->get_article_video_by_id($id);
		//$config['image_list']	= $this->m_article->get_article_image_by_id($id);
       
		$this->load->view('articles/v_edit', $config);
	}

	function update_article(){
		$articleId = $this->input->post('articleId');
		$title  = $this->input->post('articleTitle');
		$text  = $this->input->post('articleText');
		$category = $this->input->post('articleCategory');

		$images = $_FILES['articlePic'];
		$category = $this->input->post('articleCategory');
		$videos = $this->input->post('articleVid');
		$videoIds = $this->input->post('articleVidId');
		$point = $this->input->post('articlePoint');
		$time = $this->input->post('articleTime');
		$startPub = date('Y-m-d',strtotime($this->input->post('startPub')));
		$endPub = date('Y-m-d',strtotime($this->input->post('endPub')));
		$statusPub = $this->input->post('articleStatus');
		$videosNew = $this->input->post('articleVidNew');		
		$imgUpload =0;
		/*if(count($images['name']) == 1 && $_FILES['articlePic']['error']['0'] == '4'){
			$imgUpload = 0;
		}else{
			$imgUpload = count($images['name']);
		}
		if(count($videosNew) == 1 && $videosNew['0'] == ''){
			$vidUploadNew = 0;
		}else{
			$vidUploadNew = count($videosNew);
		}
		$upPic=0;
		$upVid=0;*/	
		//insert text article
		$data = array(
			"title" => $title,
			"content" => $text,
			"category" => $category,
		);	
		$updateText = $this->m_article->update_article_text($data, $articleId);
		//upload files and link if last_id is not empty
		/*if(!empty($updateText)){
			//initialize
			if( !empty($imgUpload)){
				$upload_conf = array(
					'upload_path'   => realpath('uploads/article_pic/'),
					'allowed_types' => 'gif|jpg|png',
					'max_size'      => '3000',
				);

				$this->upload->initialize($upload_conf);
				$upPic = 0;
				for($i=0;$i<count($images['name']);$i++){
					$namewithoutspace = preg_replace('/\s+/','_',$images['name'][$i]);
					$filename = date('His').mt_rand( 10, 100)."_".$namewithoutspace;
					
					$_FILES['articlePic']['name'] = $filename;
					$_FILES['articlePic']['type'] = $images['type'][$i];
					$_FILES['articlePic']['tmp_name'] = $images['tmp_name'][$i];
					$_FILES['articlePic']['error'] = $images['error'][$i];
					$_FILES['articlePic']['size'] = $images['size'][$i];

					if ( ! $this->upload->do_upload('articlePic'))
					{
						$error['upload'][] = $this->upload->display_errors();
						$upPic = $upPic;
					}
					else
					{
						$upload_data = $this->upload->data();
						
						$dataFile = array(
							'pbArticleImageArticleId' 	=> $articleId,
							'pbArticleImagePicture'    	=> $filename,
						);
						
						$insert_data = $this->m_article->insert_article_image($dataFile);
						$upPic = $upPic+1;
					}
				}
			}
			
			$upVid = 0;
			for($j=0;$j<count($videos);$j++){
				if(empty($videos[$j])){
					$res = $this->m_article->delete_video($videoIds[$j]);
				}else{
					$dataVideo = array(
							'pbArticleVideoContent'    	=> $videos[$j],
						);

					$res = $this->m_article->update_article_video($dataVideo, $videoIds[$j]);
				}
				if(!empty($res)){
					$upVid = $upVid+1;
				}
			}

			for($k=0;$k<$vidUploadNew;$k++){
				$dataVideo = array(
						'pbArticleVideoArticleId' 	=> $articleId,
						'pbArticleVideoContent'    	=> $videosNew[$k],
					);

				$res = $this->m_article->insert_article_video($dataVideo);
				if(!empty($res)){
					$upVid = $upVid+1;
				}
			}
		}
		if(!empty($updateText) && $upPic == $imgUpload && $upVid == (count($videos)+$vidUploadNew)) {
			$this->session->set_flashdata('message', 'Article has been updated successfully');
		}elseif(!empty($updateText) && $upPic != $imgUpload && $upVid == (count($videos)+$vidUploadNew)){
			$this->session->set_flashdata('message', "Failed to upload some article's pictures");
		}elseif(!empty($updateText) && $upPic == $imgUpload && $upVid != (count($videos)+$vidUploadNew)){
			$this->session->set_flashdata('message', "Failed to add/update some article's videos URL");
		}elseif(!empty($updateText) && $upPic != $imgUpload && $upVid != (count($videos)+$vidUploadNew)) {
			$this->session->set_flashdata('message', "Failed to upload some article's pictures and videos URL");
		}else{
			$this->session->set_flashdata('message', 'Failed to update article');
		}*/
		
		redirect(base_url() . 'article', 'refresh');	
	}
	
	function delete($id){
		//$path = realpath('uploads/article_pic/');
		//$filename = $this->m_article->get_file_name($id);
		//foreach ($filename as $row) {
		//	unlink($path.'/'.$row->pbArticleImagePicture);		
		//}
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
		//$category = $this->input->post('category');
		$this->m_article->check_article_title($title);//, $category);
	}

	function detail_article($id)
	{
		$config['title'] 	 = 'gtPlayBook | Manage Articles';
		$config['page_title'] = 'Articles';
		$config['page_subtitle'] = 'Detail Article';
		$config['article_list'] =	$this->m_article->get_article_by_id($id);	
		$config['video_list']	= $this->m_article->get_article_video_by_id($id);
		$config['image_list']	= $this->m_article->get_article_image_by_id($id);
       
		$this->load->view('v_detail', $config);
	}
	function article($id)
	{
		$query = $this->db->get_where('pb_article',array('pbArticleId'=>$id))->row();     
		$this->load->view('v_article', $query);
	}
}