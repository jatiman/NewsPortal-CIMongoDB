<?php
defined('BASEPATH') OR exit('No direct script access allowed');error_reporting(E_ALL);

class Auth extends CI_Controller {
    function __construct(){
        parent::__construct();
    }

	function index()
	{
        if($this->session->userdata('is_login')){
            redirect('dashboard', 'refresh');
        }else{
            // $this->session->set_userdata('is_login', true);
            // redirect('dashboard', 'refresh');
            if(isset($_GET['location'])){
                $config['location']=urldecode($_GET['location']);
            }
            $config['title'] = "DOTcom";
    		$this->load->view('login',$config);
        }
	}

	function login()
	{
        if($this->session->userdata('is_login')){
            redirect('dashboard', 'refresh');
        }else{
            $location = $this->input->post('location');
            $user = $this->input->post('user');
            $pass = md5($this->input->post('password'));              
            if(isset($user)){
                //query process
                $result = $this->mongo_db->where(['username'=>$user,'password'=>$pass])->get('user');
                var_dump($result);
                if ( count($result) > 0 ){                                                                                                                                
                    foreach ($result as $res){ 
                        $this->mongo_db->set('last_login',date('Y-m-d H:i:s'))->where(array('username' => $user))->update('user');

                        $sess['is_login'] = TRUE;
                        $sess['email'] = $res['email'];
                        $sess['uname'] = $res['username'];
                        $sess['last_login'] = $res['last_login'];

                        $this->session->set_userdata($sess);                                                                          
                    }
                    if(isset($location)){
                        redirect("http://".$_SERVER['HTTP_HOST'].$location);
                    }else{
                        redirect('dashboard');    
                    }
                }else{
                    $this->session->set_flashdata('message','Your Username/Email or Password is Invalid');
                    redirect('auth','refresh');
                }
            }else{
                $this->session->set_flashdata('message','Please use login form!');
                redirect('auth','refresh');
            }
        }
	}
        
    function logout()
	{
        $this->session->sess_destroy();
        redirect(base_url().'auth','refresh');
	}
}
