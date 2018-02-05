<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); //error_reporting(0);

class Management_user extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('is_login')){
			redirect('auth?location='.urlencode($_SERVER['REQUEST_URI']));
		}
		$this->load->model(array('m_menu','m_management_user'));
		//$this->load->helper('check_auth_menu');
		//$this->load->library('upload');
		//check_authority_url();		
	}

	function index()
	{
		$config['title'] = 'DOTcom';
		$config['page_title'] = 'Management User';
		$config['page_subtitle'] = 'Daftar user';
	    $config['user_list'] = $this->m_management_user->get_all();
        //$config['group_list'] = $this->m_management_user->get_all_group();
       
		$this->load->view('user/v_list', $config);
	}

	function insert_user(){
		$pbUsername  = $this->input->post('username');
		$pbPassword  = md5($this->input->post('password'));
		$pbRealName  = $this->input->post('realName');
		$pbUserEmail = $this->input->post('email');

		
		$data = array(
				"username" 		=> $pbUsername,
				"password" 		=> $pbPassword,
				"realname"    => $pbRealName,
				"email"     	=> $pbUserEmail,
				"dateCreated" => date('Y-m-d H:i:s'),
				"createdBy" 	=> new MongoDB\BSON\ObjectId($this->session->userdata('user_id'))
				);

		$action = $this->m_management_user->insert_user($data);
			
		
		
		/*if($action) {
			$this->session->set_flashdata('message', 'User has been added successfully');
		}
		else {
			$this->session->set_flashdata('message', 'Failed to add user');
		}*/

		redirect('management_user','refresh');
	}

	function checkUsername($uname){
		$this->m_management_user->check_username($uname);
	}
	
	function edit_user($id){
		$user = $this->m_management_user->get_user_by_id($id);
		echo json_encode($user);
	}
	
	function update_user(){	
		$pbUserId    = $this->input->post('userId');
		$pbUsername  = $this->input->post('username');
		$pbPassword  = md5($this->input->post('password'));
		$pbRealName  = $this->input->post('realName');
		$pbUserEmail = $this->input->post('email');
		
		if(!empty($pbPassword)){
			$data = array(
				"username" 		=> $pbUsername,
				"password" 		=> $pbPassword,
				"realname"    => $pbRealName,
				"email"     	=> $pbUserEmail
			);
		}else{
			$data = array(
				"username" 		=> $pbUsername,
				"realname"    => $pbRealName,
				"email"     	=> $pbUserEmail
			);
			
		}

		$action = $this->m_management_user->update_user($data, $pbUserId);
			
		redirect(base_url() . 'management_user', 'refresh');
	}
	
	function delete($id){
		$this->m_management_user->delete_user($id);
	}
}