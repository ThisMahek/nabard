<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cat_model extends CI_Model
{
    
    public function get_category_parent()
    {
        return $this->db->where('status','1')->get('category')->result_array();
    }
    
    
    public function get_category()
    {
        return $this->db->where('status!=','3')->order_by('id','desc')->get('category')->result_array();
    }

   public function get_subcategory(){
    // return $this->db->where('status!=','3')->get('subcategory')->result_array();
        return $this->db->select('*,subcategory.id as sub_id,subcategory.name as sub_name,subcategory.name_hindi as sub_hindi,subcategory.image as sub_image,subcategory.parent_id as p_id,subcategory.status as sub_status,category.name as c_name, category.id as c_id, category.name_hindi as ch_name')->from('subcategory')->where(['subcategory.status!='=>2])
        ->order_by('subcategory.id','desc')->join('category','category.id = subcategory.parent_id')->get()->result_array();
   }
    
    public function check_category($name)
    {
        $q= $this->db->where('name',$name)->get('category')->num_rows();
        if($q > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function check_subcategory($name)
    {
        $q= $this->db->where('name',$name)->get('subcategory')->num_rows();
        if($q > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function insert_category($postd)
    {
        return $this->db->insert('category',$postd);
    }
   public function  insert_subcategory($postd)
   {
    return $this->db->insert('subcategory',$postd);
   }
    
    public function delete_category($id)
    {
        $pst=array(
            'status'=>'3'
            );
        return $this->db->where('id',$id)->update('category',$pst);    
    } 
    public function update_category($pst,$id)
    {
      return $this->db->where('id',$id)->update('category',$pst);    
    }


    public function update_subcategory($postd,$id)
    {
      return $this->db->where('id',$id)->update('subcategory',$postd);   
      
    }

   public function update_add_product_category($category_id,$subcat_id){

       return $this->db->where(['subcategory_id'=>$subcat_id])->update('add_product',['category_id'=>$category_id]);

   }

    
    
}
?>