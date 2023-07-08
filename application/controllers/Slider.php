<?php
class Slider extends MY_Controller
    {
        public function __construct()
           {
              parent::__construct();
           }
        public function add_slider()
             {
                if(isset($_POST['submit']))
                {
                    $table="slider_and_banner";
                    $array['title']=$this->input->post('title'); 
                    $array['type'] = $this->input->post('type');
                    $array["share_status"]=$this->input->post("share_status");
                    $array['status']= $this->input->post('status');
                    $array['url']=$this->input->post('url');  
                    $config['allowed_types'] = 'gif|jpeg|png|jpg';
			        $config['upload_path'] = './upload/';
                    $config['encrypt_name'] = true;
                    $this->load->library('upload',$config);
	                if($this->upload->do_upload('image'))
                        {	
                            $data= $this->upload->data();
                            $image_path = ("upload/".$data['file_name']);
                            $array['image'] = $image_path;    
                        }
                                $slider_rows = $this->db->get_where('slider_and_banner',['type'=>'1'])->num_rows();
                                $allowed_total_slider=$this->db->select('slider_num')->get('setting')->row()->slider_num;
                                if(($slider_rows < $allowed_total_slider))
                                 {
                                 $this->addtables($table,$array);
                                 $this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissible fade show">Slider Added successfully! !!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
                                 redirect($_SERVER['HTTP_REFERER']);
                                 }else{
                                  $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade show">You  can not add slider more than 7 !!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
                                  redirect($_SERVER['HTTP_REFERER']);
                                 } 
                                 
                              /*    
                                if($x)
                                {
                                $this->session->set_flashdata('success','<div class="alert alert-success text-center" id="successMessage">Slider added successfully</div>');
                                // redirect(base_url()."admin/manage_slider");
                                }
                                else
                                {
                                $this->session->set_flashdata('error','<div class="alert alert-danger text-center" id="successMessage">Unable to add slider </div>');
                                // redirect(base_url()."admin/manage_slider");
                                } */
                                // redirect("admin/manage_slider"); 
                }
             
             }

     public function  update_slider_status()
   { 
      $tab =  'slider_and_banner';
      $id = $_GET['id'];
	  $sval = $_GET['status'];

	if($sval == 1)
        {
            $status = 0;
        }
	else
        {
            $status = 1;
        }

	$data = array(
                  'status'=> $status
	             );
               $x=$this->updatestatus($tab,$data,$id); 
			  if ($x)
                    {
                        $this->session->set_flashdata('success','<div class="alert alert-success text-center" id="successMessage">Status updated successfully</div>');
                    }
            else
                    {
                        $this->session->set_flashdata('error','<div class="alert alert-danger text-center" id="successMessage">Unable to update staus</div>');
                    }
              redirect(base_url()."admin/manage_slider");
}


public function delete_slider($id)

{
$tab = 'slider_and_banner';
$res=$this->deleteTable($id,$tab); 
if($res==1)
     {
         $this->session->set_flashdata('success','<div class="alert alert-success text-center">Slider deleted successfully</div>');
     }
else 
     {
         $this->session->set_flashdata('error','<div class="alert alert-danger text-center">Unable to delete slider</div>');
     }
     redirect(base_url()."admin/manage_slider");
 } 







 public function update_slider($id)
{

if(isset($_POST['update']))
{
    $table = "slider_and_banner";           
    $array['url'] = $this->input->post("url");
    $array["title"]=$this->input->post("title");
    $array["share_status"]=$this->input->post("share_status");
    $status = $this->input->post('status');
    // $array['status']=  $status=='on'?'1':'0';
    $array['status']= $this->input->post('status');
    $file = $_FILES["image"]; 
    $MyFileName="";
            if(strlen($file['name'])>0)
                {
                    $image=$file["name"];
                    $config['allowed_types'] = 'pdf|gif|jpeg|png|jpg';
                    $config['upload_path'] = './upload/';
                    $config['encrypt_name'] = true;
                    $config['file_name']=$image;
                    $this->load->library("upload",$config);
                        if($this->upload->do_upload('image'))
                            {	
                                    $data= $this->upload->data();
                                    $post= $this->input->post();
                                    $image_path = ("upload/".$data['file_name']);
                                    $array['image']= $image_path;        
                                }
                                      else
                                            {
                                            $error = array('error' => $this->upload->display_errors());
                                            $result=$error;
                                            } 
                               } 
                                $x =$this->UpdateTable($id,$table,$array); 
                               if($x)
                                   {
                                   $this->session->set_flashdata('success','<div class="alert alert-success text-center" id="successMessage"> Slider Updated successfully</div>');
                                   redirect(base_url()."Master/manage_slider");
                                   }
                               else
                                   {
                                   $this->session->set_flashdata('error','<div class="alert alert-danger text-center" id="successMessage">Something went wrong </div>');
                                   redirect(base_url()."Master/manage_slider");
                                   } 

}
        

}
    }


?>