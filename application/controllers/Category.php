<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
    
     public function __construct()
    {
        parent::__construct();
          
        $this->load->model("Cat_model","CM");   
    }
     
 	public function Index()
	{
    	return redirect('Category/manage_category');
	}
	
	public function manage_category()
	{
	    $data['title']="Nabard - Manage Category";
	    $data['page_name']="Manage Category";
	    $data['par_cat']= $this->CM->get_category_parent();
	    $data['category']= $this->CM->get_category();
		$this->load->view('manage_category',$data);
	}


    public function manage_subcategory()
	{
	    $data['title']="Nabard - Manage Sub Category";
	    $data['page_name']="Manage Sub Category";
	    $data['par_cat']= $this->CM->get_category_parent();
	    $data['category']= $this->CM->get_subcategory();

       /*  echo "<pre>";
        print_r($data['category']);
        exit; */

    
		$this->load->view('manage_subcategory',$data);
	}
	
    public function Add_category_db()
    {
     $name=$this->input->post('name');
    $check=$this->CM->check_category($name);
    if($check)
    {
      
          $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade show">Category Already Added, Try Another Category<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
        return redirect('Category/manage_category');   
    }
    else
    {
           $data = $_FILES['image']['name'];
            $config['image_library'] = 'gd2';
            $config['source_image'] = $_FILES['image']['tmp_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 400;
            $config['height'] = 400;
            $config['quality'] ='80%';
            $config['new_image'] = './upload/' . $data;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $img=$data;
        if($img != '')
        {
    	$img = array(
    	    'image'=>'upload/'.$data
    	    );
        }
        else
        {
            $img = array();
          }
          $post=$this->input->post();
         $postd=array_merge($post,$img);


          /*   echo "<pre>";
            print_r($postd);
            exit; */
          $this->CM->insert_category($postd);	
          	// $this->session->set_flashdata('error','Category Inserted Successfully !!');

            
          $this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissible fade show">Category Inserted Successfully !!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
        return redirect('Category/manage_category');
    }
    }



    public function Add_subcategory_db()
    {
     $name=$this->input->post('name');
    $check=$this->CM->check_subcategory($name);
    if($check)
    {
      	// $this->session->set_flashdata('error','Sub Category Already Added, Try Another Category');

        
          $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade show">Sub Category Already Added, Try Another Sub Category<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
        return redirect('Category/manage_subcategory');   
    }
    else
    {
           $data = $_FILES['image']['name'];
            $config['image_library'] = 'gd2';
            $config['source_image'] = $_FILES['image']['tmp_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 400;
            $config['height'] = 400;
            $config['quality'] ='80%';
            $config['new_image'] = './upload/' . $data;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $img=$data;
        if($img != '')
        {
    	$img = array(
    	    'image'=>'upload/'.$data
    	    );
        }
        else
        {
            $img = array();
          }
          $post=$this->input->post();
         $postd=array_merge($post,$img);
          $this->CM->insert_subcategory($postd);	
          	// $this->session->set_flashdata('error','Sub Category Inserted Successfully !!');
            
          $this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissible fade show">Sub Category Inserted Successfully !!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
        return redirect('Category/manage_subcategory');
    }
    }
        
        
      public function Edit_category_db($id)
    {
           $data = $_FILES['image']['name'];
            $config['image_library'] = 'gd2';
            $config['source_image'] = $_FILES['image']['tmp_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 400;
            $config['height'] = 400;
            $config['quality'] ='80%';
            $config['new_image'] = './upload/' . $data;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $img=$data;
        if($img != '')
        {
    	$img = array(
    	    'image'=>'upload/'.$data
    	    );
        }
        else
        {
            $img = array();
          }
          $post=$this->input->post();
         $postd=array_merge($post,$img); 
          $this->CM->update_category($postd,$id);	
          	// $this->session->set_flashdata('error','Category Updated Successfully !!');
              $this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissible fade show"> Category Updated Successfully !!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
            return redirect('Category/manage_category');
          
    }
    






    public function Edit_subcategory_db($subcat_id)
    {

           $data = $_FILES['image']['name'];
            $config['image_library'] = 'gd2';
            $config['source_image'] = $_FILES['image']['tmp_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 400;
            $config['height'] = 400;
            $config['quality'] ='80%';
            $config['new_image'] = './upload/' . $data;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $img=$data;
        if($img != '')
        {
    	$img = array(
    	    'image'=>'upload/'.$data
    	    );
        }
        else
        {
            $img = array();
          }


          $post=$this->input->post();

        $category_id = $post['parent_id'];

       /*  echo "<pre>";
        print_r($post);
        exit; */
         $postd=array_merge($post,$img);
         
         
         $res1 = $this->CM->update_subcategory($postd,$subcat_id);

         $res2 = $this->CM->update_add_product_category($category_id,$subcat_id);

          	// $this->session->set_flashdata('error','Category Updated Successfully !!');

            if($res1 && $res2){
                $this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissible fade show">Sub Category Updated Successfully !!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
            }else{
                $this->session->set_flashdata('success', '<div class="alert alert-danger alert-dismissible fade show">Something went wrong !!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');   
            }
            return redirect('Category/manage_subcategory');
          
    }
    
    /*        
        public function Delete_cat($id)
        {
          $this->CM->delete_category($id);
          $this->session->set_flashdata('error','<div class="alert alert-danger text-center" id="successMessage">
			 Category Deleted Successfully!</div>');
		return redirect('Category/manage_category');
        }
        
*/


    
}
