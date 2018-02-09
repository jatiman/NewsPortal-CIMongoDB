<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
			$this->load->model('M_blog');
			$this->load->helper('text');
			$this->load->library('form_validation');
	}

	public function index(){
		$data['berita'] = $this->M_blog->get('artikel');
		$data['side'] = $this->M_blog->get_where('artikel');
		/*$aa=json_decode(json_encode($data['side']),true);
		for($i=0;$i<count($aa);$i++){
			$aa[$i]['total_comment'] = $this->mongo_db->where('artikel_id', $aa[0]['_id']['$id'])->count('comment');
		}
		$data['side']=json_decode(json_encode($aa),FALSE);*/
		$data['title'] = 'DOTcom';
		$data['isiberita'] = 'content';
		$this->load->view('template',$data);
	}

	public function detail($id){
		$data['komentar'] = $this->mongo_db->where('artikel_id',$id)->get('comment');
		//var_dump($data['komentar']);die();
		$data['title'] = 'DOTcom';
		$data['side'] = $this->M_blog->get('artikel');
		$data['detail'] = $this->M_blog->get_detail($id);
		$data['isiberita'] = 'detail';
		$this->form_validation->set_rules('email','email','required|valid_email');
		$this->form_validation->set_rules('komentar','komentar','required');

		if($this->form_validation->run()==FALSE){


		}elseif(isset($_POST['kirim'])){
			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$komentar = $this->input->post('komentar');
			$berita_id = $id;
			$dt = array(
				'artikel_id' => $berita_id,
				'nickname' => $nama,
				'email' => $email,
				'date' => date('Y-m-d H:i:s'),
				'comment' => $komentar
			);

			$this->M_blog->insert('comment',$dt);
			redirect('/blog/detail/'.$id, 'refresh'); 
		}
		$this->load->view('template', $data);
	}

	public function search(){
		/*$src = $this->input->post('search'); */

		$data['side'] = $this->M_blog->get_where();
		/* $data['search'] = $this->db->query("SELECT * FROM berita WHERE judul_berita LIKE '%$src%' ")->result(); */
		/*$data['count'] = $this->db->query("SELECT * FROM berita WHERE judul_berita LIKE '%$src%' ")->num_rows();*/
		$src = $this->input->post('cari');
		$data['search'] = $this->M_blog->cariBerita($src);
		//var_dump($data['search']);die();
		$data['title'] = 'DOTcom';
		$data['isiberita'] = 'pencarian';
		$this->load->view('template',$data);

	}

	public function sport(){
		//$data['berita'] = $this->M_blog->get('berita');
		$data['berita'] = $this->M_blog->get_sport();
		$data['side'] = $this->M_blog->get_where();
		$data['title'] = 'DOTcom';
		$data['isiberita'] = 'content';
		$this->load->view('template',$data);
	}

	public function tekno(){
		//$data['berita'] = $this->M_blog->get('berita');
		$data['berita'] = $this->M_blog->get_tekno();
		$data['side'] = $this->M_blog->get_where();
		$data['title'] = 'DOTcom';
		$data['isiberita'] = 'content';
		$this->load->view('template',$data);
	}

	public function oto(){
		//$data['berita'] = $this->M_blog->get('berita');
		$data['berita'] = $this->M_blog->get_oto();
		$data['side'] = $this->M_blog->get_where();
		$data['title'] = 'DOTcom';
		$data['isiberita'] = 'content';
		$this->load->view('template',$data);	
	}

	function show_image() {
		$image_preview = '';
		if (isset($_GET['filename']) && !empty($_GET['filename'])) {
			$where['filename'] = $_GET['filename'];
			$image = $this->M_blog->get_image_from_filestream($where);
			unset($where);
			$image = $image->getResource();
			while (!feof($image)) {
                $image_preview .= fread($image, 8192);
			}
		};
		header('Content-type: image/jpeg');
		echo $image_preview;
	}  
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */
