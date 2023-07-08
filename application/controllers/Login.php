<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    	$this->load->model('login_model','LM');	
	
    }
    
 	public function Index()
	{
    	$data['title']="Nabard - Admin Login";
	    $data['page_name']="Admin Login";
		$this->load->view('login',$data);
	}
	
	
	 	public function checklogin()
    { 
	 $uname= $this->input->post('email');
	 $pass=  md5($this->input->post('password'));
 
	$login_id=$this->LM->isvalidate($uname,$pass);
	if($login_id)
	{ 			
		$this->session->set_userdata('admin_nid',$login_id);
		  return redirect('Admin/index');
  }
	else
	{
		$this->session->set_flashdata('error','Please Enter Corrent Details !!');
        return redirect('Login/index');
	}
 
  
  }
  
  
  
	public function logout()
	{
		$this->session->sess_destroy();
		return redirect('Login/index');
	}
    
}
