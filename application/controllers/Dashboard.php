<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('is_login')){
			redirect('auth?location='.urlencode($_SERVER['REQUEST_URI']));
		}
		$this->load->model(array('m_menu','m_dashboard'));
		//$this->load->helper('check_auth_menu');
		//check_authority_url();		
	}


	function index()
	{
		$config['title'] = 'gtPlayBook';
		$config['page_title'] = 'Dashboard';
		$config['berita'] = $this->m_dashboard->articles('artikel');
		$config['total_articles'] = $this->m_dashboard->total_articles('artikel');
		$config['total_comments'] = $this->m_dashboard->total_comments('comment');
		$this->load->view('dashboard/dashboard',$config);
	}

	function article_rank(){
		$config['title'] = 'gtPlayBook';
		$config['page_title'] = 'Ranking Artikel';
		$config['page_subtitle'] = '';
		$config['rank_title'] = 'Ranking Berita Berdasarkan Jumlah Komentar';
		$config['rank_data'] = $this->m_dashboard->article_rank();
		$this->load->view('dashboard/dashboard_detail_topten',$config);
	}

}
