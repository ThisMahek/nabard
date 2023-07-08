<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    	$this->load->model('Master_model','MM');	
    }
    
    public function manage_slider()
	{
	    $data['title']="Nabard - Manage Slider";
	    $data['page_name']="Manage Slider";
	    $data['slider']=$this->MM->get_slider();
		$this->load->view('manage_slider',$data);
	}
	
	public function manage_banner()
	{
	    $data['title']="Nabard - Manage Banner";
	    $data['page_name']="Manage Banner";
	    $data['banner']=$this->MM->get_banner();
		$this->load->view('manage_banner',$data);
	}
	
    public function Add_banner_db()
    {
        $sdt = array();
        $config['allowed_types'] = 'gif|jpeg|png|jpg';
        $config['upload_path'] = './upload/';
        $config['encrypt_name'] = true;
        $this->load->library('upload',$config);
        if($this->upload->do_upload('image'))
            {	
                $data= $this->upload->data();
                $image_path = ("upload/".$data['file_name']);  
            }
       $post=$this->input->post();
       $type = $this->input->post('section_name');
       $array = array(
       'title'=>$post['title'],
       'url'=>$post['url'],
       'type'=>$post['type'],
       'status'=>$post['status'],
       'share_status'=>$post['share_status'],
       'image'=>$image_path,
       
    
    );
       $banner_rows = $this->db->get_where('slider_and_banner',['type'=>'2'])->num_rows();
       $allowed_total_banner=$this->db->select('banner_num')->get('setting')->row()->banner_num;
      
        if(($banner_rows < $allowed_total_banner))
        {
            $this->MM->insert_slider($array);
            $this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissible fade show">Banner Added successfully! !!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }else{
         $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade show">You  can not add banner more than 7 !!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
         redirect($_SERVER['HTTP_REFERER']);
        }   
    }
    
    public function Delete_slider($id)
    {
        $this->db->where('id',$id)->delete('slider_and_banner');
        // $this->session->set_flashdata('error','Deleted slider successfully!');
        $this->session->set_flashdata('success','<div class="alert alert-success text-center" id="successMessage">Slider deleted successfully</div>');
        // $this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissible fade show"><strong>!SUCCESS</strong>Slider deleted successfully !!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
		 redirect($_SERVER['HTTP_REFERER']);

    }


    public function Delete_banner($id)
    {
        $this->db->where('id',$id)->delete('slider_and_banner');
        // $this->session->set_flashdata('error','Deleted banner successfully!');
        $this->session->set_flashdata('success','<div class="alert alert-success text-center" id="successMessage">Banner deleted successfully !!</div>');
        // $this->session->set_flashdata('error', '<div class="alert alert-success alert-dismissible fade show"><strong>SUCCESS!</strong> Banner deleted successfully !!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
		redirect($_SERVER['HTTP_REFERER']);
    }
    
      
    public function Edit_slider_db($id)
    {
       $data = $_FILES['image']['name'];
            $config['image_library'] = 'gd2';
            $config['source_image'] = $_FILES['image']['tmp_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            // $config['width'] = 'auto';
            // $config['height'] = 'auto';
            $config['quality'] ='80%';
            $config['new_image'] = './upload/slider/' . $data;
            // $this->load->library('image_lib', $config);
            // $this->image_lib->resize();
            $imgs=$data;
          
        if($imgs != '')
        {
    	$sdt = array(
    	    'image'=>'upload/slider/'.$data
    	    );
        }
        else
        {
            $sdt = array();
         } 
          $post=$this->input->post();
       $postd=array_merge($post,$sdt);
        $this->MM->update_slider($postd,$id);	
        // $this->session->set_flashdata('error','Slider Updated Successfully !!');
        $this->session->set_flashdata('success','<div class="alert alert-success text-center" id="successMessage"> Banner Updated successfully</div>');

		redirect($_SERVER['HTTP_REFERER']);
        
    }
    
    /* -----------------Notification-------------------------*/
    	
	public function manage_notification()
	{
        $data['title']="Nabard - Manage Notification";
	    $data['page_name']="Manage Notification";
	    $data['notic']=$this->MM->get_notification();
		$this->load->view('manage_notification',$data);
	}
    
    
    public function Add_notification_db()
    {
       $post=$this->input->post();
      // print_r($post['share_status']);exit;
       $this->MM->insert_notification($post);	

  /*      echo $this->db->last_query();
       exit; */
        //  $this->session->set_flashdata('error','Notification Inserted Successfully !!');

        $this->session->set_flashdata('error', '<div class="alert alert-success alert-dismissible fade show">Notification Inserted Successfully !!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');

		redirect($_SERVER['HTTP_REFERER']);
    }
    
       public function Delete_notification($id)
    {
        $this->db->where('id',$id)->delete('notification');
          $this->session->set_flashdata('error','Notification Deleted Successfully !!');
		redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function Edit_notification_db($id)
    {
       $post=$this->input->post();
       $this->MM->update_notification($post,$id);	
         $this->session->set_flashdata('error','Notification Updated Successfully !!');
		redirect($_SERVER['HTTP_REFERER']);
    }
    
    /* ----------   Manage FAQ   ------------*/
    
    	public function manage_faq()
	{
		$data['title']="Nabard - Manage FAQ";
	    $data['page_name']="Manage FAQ";
	    $data['faq']=$this->MM->get_faq();
		$this->load->view('manage_faq',$data);
	}
	
	public function Add_faq_db()
    {
       $post=$this->input->post();
       $this->MM->insert_faq($post);	
        //  $this->session->set_flashdata('error','FAQ Inserted Successfully !!');
        $this->session->set_flashdata('error', '<div class="alert alert-success alert-dismissible fade show">FAQ Inserted Successfully !!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
		redirect($_SERVER['HTTP_REFERER']);

    }
	
	
	  public function Delete_faq($id)
    {
        $this->db->where('id',$id)->delete('faq');
        //   $this->session->set_flashdata('error','FAQ Delete Successfully !!');


        $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade show">FAQ Delete Successfully !!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
		redirect($_SERVER['HTTP_REFERER']);
    }
	
	
	public function Edit_faq_db($id)
    {
       $post=$this->input->post();
       $this->MM->update_faq($post,$id);	
        //  $this->session->set_flashdata('error','FAQ Updated Successfully !!');

         $this->session->set_flashdata('error', '<div class="alert alert-success alert-dismissible fade show">FAQ Updated Successfully!!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');

		redirect($_SERVER['HTTP_REFERER']);
    }
	
	
	
	    /* ----------   Manage Testimonials   ------------*/

	public function manage_testimonials()
	{
		$data['title']="Nabard - Manage Testimonials";
	    $data['page_name']="Manage Testimonials";
	    $data['testimonial']=$this->MM->get_testimonial();
        $this->load->view('manage_testimonials',$data);
	}
	
		public function Add_testimonial_db()
    {
           $data = $_FILES['image']['name'];
            $config['image_library'] = 'gd2';
            $config['source_image'] = $_FILES['image']['tmp_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 150;
            $config['height'] = 150;
            $config['quality'] ='80%';
            $config['new_image'] = './upload/testimonial/' . $data;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $imgs=$data;     
        if($imgs != '')
        {
    	$sdt = array(
    	    'image'=>'upload/testimonial/'.$data
    	    );
        }
        else
        {
            $sdt = array();
        }
         $post=$this->input->post();
         $postd=array_merge($post,$sdt);
         $testimonial_rows = $this->db->get_where('testimonial',['status'=>1])->num_rows();

       /*  echo $testimonial_rows;
        // exit;
        echo "<br>"; */
         $allowed_total_testimonial=$this->db->select('testimonial_num')->get('setting')->row()->testimonial_num;
       /*  echo $allowed_total_testimonial;
        exit; */
          if(($testimonial_rows < $allowed_total_testimonial))
          {
            $this->MM->insert_testimonial($postd);
              $this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissible fade show">Testimonial Added successfully! !!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
              redirect($_SERVER['HTTP_REFERER']);
          }else{
           $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade show">You  can not add testimonial more than 7 !!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
           redirect($_SERVER['HTTP_REFERER']);
          } 

       /*  $this->MM->insert_testimonial($postd);	
         $this->session->set_flashdata('error','Testimonial Inserted Successfully !!'); */
		// redirect($_SERVER['HTTP_REFERER']);
    }
	
	 public function Delete_testimonial($id)
    {
        $this->db->where('id',$id)->update('testimonial',['status'=>2]);
        //   $this->session->set_flashdata('error','Testimonial Deleted Successfully !!');
        $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade show">Testimonial Deleted Successfully  !!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');

		redirect($_SERVER['HTTP_REFERER']);
    }
	
	  public function Edit_testimonial_db($id)
    {
       $data = $_FILES['image']['name'];
            $config['image_library'] = 'gd2';
            $config['source_image'] = $_FILES['image']['tmp_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
       /*      $config['width'] = auto;
            $config['height'] = auto; */
            $config['quality'] ='80%';
            $config['new_image'] = './upload/testimonial/' . $data;
            $this->load->library('image_lib', $config);
            // $this->image_lib->resize();
            $imgs=$data;
          
        if($imgs != '')
        {
    	$sdt = array(
    	    'image'=>'upload/testimonial/'.$data
    	    );
        }
        else
        {
            $sdt = array();
         } 
          $post=$this->input->post();
       $postd=array_merge($post,$sdt);
        $this->MM->update_testimonial($postd,$id);	
        // $this->session->set_flashdata('error','Testimonial Updated Successfully !!');
        
 $this->session->set_flashdata('error', '<div class="alert alert-success alert-dismissible fade show">Testimonial Updated Successfully  !!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');

		redirect($_SERVER['HTTP_REFERER']);
        
    }
    
    
    /*   ------------ Subscriber List --------------*/
  
    	public function subscriber_list()
	{
		$data['title']="Nabard - Subscriber List";
	    $data['page_name']="Subscriber List";
	    $data['subs']=$this->MM->get_subscriber();
		$this->load->view('subscriber_list',$data);
	}
	
  
    	public function manage_news()
	{
		$data['title']="Nabard - Manage News";
	    $data['page_name']="Manage News";
	    $data['subs']=$this->MM->get_news();
		$this->load->view('manage_news',$data);
	}
	
		public function Add_news_db()
    {
         $data = $_FILES['image']['name'];
            $config['image_library'] = 'gd2';
            $config['source_image'] = $_FILES['image']['tmp_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 450;
            $config['height'] = 150;
            $config['quality'] ='80%';
            $config['new_image'] = './upload/news_event/' . $data;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $imgs=$data;
          
        if($imgs != '')
        {
    	$sdt = array(
    	    'image'=>'upload/news_event/'.$data
    	    );
        }
        else
        {
            $sdt = array();
        }
 
         $post=$this->input->post();
       $postd=array_merge($post,$sdt);
         $this->MM->insert_news($postd);	
        
         $this->session->set_flashdata('error','News  Inserted Successfully !!');
		redirect($_SERVER['HTTP_REFERER']);
    }
	
	 public function Delete_news($id)
    {
        $this->db->where('id',$id)->delete('news_event');
          $this->session->set_flashdata('error','News Deleted Successfully !!');
		redirect($_SERVER['HTTP_REFERER']);
    }
	
	  public function Edit_news_db($id)
    {
       $data = $_FILES['image']['name'];
            $config['image_library'] = 'gd2';
            $config['source_image'] = $_FILES['image']['tmp_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 450;
            $config['height'] = 150;
            $config['quality'] ='80%';
            $config['new_image'] = './upload/news_event/' . $data;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $img=$data;
          
        if($img != '')
        {
    	$sdt = array(
    	    'image'=>'upload/news_event/'.$data
    	    );
        }
        else
        {
            $sdt = array();
         } 
        
          $post=$this->input->post();
       $postd=array_merge($post,$sdt);
        $this->MM->update_news($postd,$id);	
        $this->session->set_flashdata('error','News Updated Successfully !!');
		redirect($_SERVER['HTTP_REFERER']);
        
    }
  
	
		public function manage_events()
	{
		$data['title']="Nabard - Manage Events";
	    $data['page_name']="Manage Events";
	    $data['subs']=$this->MM->get_event();
		$this->load->view('manage_events',$data);
	}
	
  
	
	
}
