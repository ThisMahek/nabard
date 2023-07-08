<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    
	public function __construct()
    {
        parent::__construct();
    //	$this->load->model('profile_model','PM');	
	
    }
    
    public function update_profile()
	{
 	    $es = $this->session->userdata('admin_nid');
 	    
            $data = $_FILES['profile']['name'];
            $config['image_library'] = 'gd2';
            $config['source_image'] = $_FILES['profile']['tmp_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 150;
            $config['height'] = 150;
            $config['quality'] ='80%';
            $config['new_image'] = './upload/admin/' . $data;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $img=$data;
          
		if($img != '')
		{	
		$sdata=array(
		'profile'=>'upload/admin/'.$data
		);	
		
		}
		else
		{
		$sdata=array(
  		);	
		}
	
  	     $post=$this->input->post();
         $postd=array_merge($post,$sdata);
        $this->db->where('id',$es)->update('admin',$postd);
          //  $this->session->set_flashdata('error','> Update Successfully !!');
          $this->session->set_flashdata('error', ' 
          <div class="alert alert-success alert-dismissible fade show">
          Profile Update Successfully !!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
          ');
          return  redirect('Admin/index');
	}
	
	  public  function change_pass(){
       
                $adid=$this->session->userdata('admin_nid');         
                $opass = md5($this->input->post('oldpass'));
                 $pass = md5($this->input->post('pass'));
          
            $check = $this->db->query("SELECT * FROM `admin` WHERE ((`id` = '$adid') AND (`password` = '$opass'))")->row_array();
        
            if(!empty($check)){
                $insert = $this->db->query("UPDATE `admin` SET `password` = '$pass' WHERE `id` = '$adid'");
        
                if($insert){ 
                
                /*  $this->session->set_flashdata('error','> Successfully Updated Password !!');
                       return  redirect('Admin/index'); */


                       $this->session->set_flashdata('error', ' 
                       <div class="alert alert-success alert-dismissible fade show">
                         Successfully Updated Password !!
                         <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                       </div>
                       ');
                       return  redirect('Admin/index');

                 }else{ 
                 /*   $this->session->set_flashdata('error','> Something Went Wrong !!');
                                          return  redirect('Admin/index'); */
                                          $this->session->set_flashdata('error', ' 
                       <div class="alert alert-danger alert-dismissible fade show">
                        Something Went Wrong !!
                         <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                       </div>
                       ');
                       return  redirect('Admin/index');
               }
            }
            else{
       /*  $this->session->set_flashdata('error','> Old Password is Wrong !!');
                                   return  redirect('Admin/index'); */
                                   $this->session->set_flashdata('error', ' 
                                   <div class="alert alert-danger alert-dismissible fade show">
                                    Old Password is Wrong !!
                                     <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                   </div>
                                   ');
                                   return  redirect('Admin/index');

            }
    
          return  redirect('Admin/index');
    }



    

	
}