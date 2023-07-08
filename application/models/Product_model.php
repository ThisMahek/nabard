<?php
class Product_model extends CI_Model
{
    
  public function  get_product_request(){
    return $this->db->select('product.id as product_id,product.category_id,product.subcat_id as subcategory_id,product.mrp,product.price as selling_price,product.stock_status,product.top_product as is_top_product,product.status as approval_status, c1.name as category_name,  c1.image as category_image,c2.name as sub_cat_name, c2.image as subcategory_image,ap1.product_name_hindi,ap1.product_name_english,vendor.name as v_name,vendor.email as v_email,vendor.office_address,vendor.profile_image,vendor.id  as vendor_id,vendor.status as v_status')
    ->join('add_product ap1', 'ap1.id = product.product_name_hindi_id', 'left')
    ->join('add_product ap2', 'ap2.id = product.product_name_english_id', 'left')
        // ->join('product_image ','product_image.product_id = product.id','left')
    ->join('category c1', 'c1.id= product.category_id', 'left')
    ->join('subcategory c2', 'c2.id=product.subcat_id', 'left')
    ->join('vendor ','vendor.id=product.vendor_id', 'left')
    ->where(['product.status !=' =>'2','vendor.status'=>1])
    ->where(['vendor.id !=' => ''])
    // ->order_by(['vendor.id' => 'desc'])
    ->get('product')
    ->result_array();

  }

  public function get_product_request_by_vendors($product_id,$vendor_id)
  {
    return $this->db->select('GROUP_CONCAT(product_image.image) as product_images,product.id as p_id,product_image.product_id,product.description,product.category_id,product.subcat_id as subcategory_id,product.mrp,product.price as selling_price,  product.stock_status, product.availabe_stock,product.quantity,product.top_product as is_top_product,product.status as approval_status,  product.verification_doc as product_ver_doc, c1.name as category_name, c1.name_hindi as cat_name_hindi, c1.image as category_image,c2.name as sub_cat_name, c2.image as subcategory_image,ap1.product_name_hindi,ap1.product_name_english,vendor.name as v_name,vendor.email as v_email,vendor.office_address,vendor.profile_image')
    ->join('add_product ap1', 'ap1.id = product.product_name_hindi_id', 'left')
    ->join('add_product ap2', 'ap2.id = product.product_name_english_id', 'left')
    ->join('category c1', 'c1.id= product.category_id', 'left')
    ->join('subcategory c2', 'c2.id=product.subcat_id', 'left')
    ->join('vendor ','vendor.id=product.vendor_id', 'left')
    ->join('product_image','product_image.product_id = product.id', 'left')
    ->where(['product.vendor_id' => $vendor_id,'product.id'=>$product_id,'vendor.status'=>1])
    ->get('product')
    ->row_array();


  }


  public function get_product_category()
  {
      return $this->db->get_where('category',['status'=>1])->result_array();
  }

   public  function  add_vendor_product($array)
   {
    return $this->db->insert('add_product',$array);
   }
      public function get_all_vendor_product()
      {
        return $this->db->select('add_product.id,add_product.category_id,add_product.subcategory_id,add_product.product_name_hindi,add_product.product_name_english,add_product.status,c1.name as category_name,c2.name as subcategory_name')
        ->from('add_product')
        ->where(['add_product.status!='=>2])
        ->join('category c1','c1.id=add_product.category_id')
        ->join('subcategory c2','c2.id=add_product.subcategory_id')
        ->order_by('add_product.id','desc')
        ->get()
        ->result_array();
      }
     public function  delete_vendor_product($id)
     {
      return $this->db->where(['id'=>$id])->update('add_product',['status'=>2]);
     }
    public function  get_product_subcategory()
    {
    return   $this->db->get_where('subcategory',['status'=>1])->result_array();
    }
    public function update_vendor_product($id, $array)
    {
        return   $this->db->where(['id'=>$id])->update('add_product',$array);
    }
    public function change_productRequest_status($req_id,$status)
    {
      return $this->db->where('id',$req_id)->update('product',['status'=>$status]);
    }

    public function get_all_vendors()
    {
     return $this->db->select('*')->where(['status='=>1])->order_by('id','desc')->group_by('name')->get('vendor')->result_array();
    }

    public function  get_category()
      {
        return $this->db->get_where('category',['status'=>1])->result_array();
      }


   

    public function delete_user($id)
      {
      return $this->db->where('id', $id)->update('users',['status'=>2]);
      }
      public  function update_term_condition($term_condition)
      {
        return $this->db->where('id',1)->update('privacy_policy',['term_condition'=>$term_condition]);
      }
     public function get_term_condition()
      {
      return $this->db->get_where('privacy_policy',['id'=>1])->row_array();
      }

    public function update_privacy_policy($privacy_policy)
      {
        return $this->db->where('id',1)->update('privacy_policy',['privacy_policy'=>$privacy_policy]);
      }
    public function  product_data_vendor_wise($vendor_id)
    {
    return $this->db->select('product.id as product_id,  product.description,product.category_id,product.subcat_id as subcategory_id,product.mrp,product.price as selling_price,product.stock_status, product.availabe_stock,product.quantity,product.top_product as is_top_product,product.status as product_status,c1.name as category_name,c1.image as category_image,c2.name as sub_cat_name, c2.image as subcategory_image,ap1.product_name_hindi,ap1.product_name_english,vendor.name as v_name,vendor.email as v_email,vendor.id as v_id,vendor.office_address,vendor.profile_image')
    ->join('product ','product.vendor_id=vendor.id','left')
    ->join('add_product ap1', 'ap1.id = product.product_name_hindi_id','left')
    ->join('add_product ap2', 'ap2.id = product.product_name_english_id','left')
    ->join('category c1', 'c1.id= product.category_id','left')
    ->join('subcategory c2', 'c2.id=product.subcat_id','left')
    ->join('product_image','product_image.product_id=product.id','left')
    ->group_by('product.id')
    ->where(['vendor.id'=>$vendor_id,'vendor.status'=>1,'product.id !='=>'','product.status!='=>2])
    ->get('vendor')
    ->result_array(); 

 /*    return $this->db->select('vendor.name as v_name, vendor.id as v_id,vendor.status as v_status,product.status as p_status,vendor.email as v_email,vendor.office_address,vendor.profile_image,product.id as product_id, product.description,product.category_id,product.subcat_id as subcategory_id,product.product_name_hindi_id,product.product_name_english_id,c1.id as c_id,c2.id as sb_cat')
    ->from('vendor')
    ->join('product ','product.vendor_id=vendor.id','left')
    ->join('category c1', 'c1.id= product.category_id','left')
    ->join('category c2', 'c2.id=product.subcat_id','left')
    ->group_by('vendor.id')
    ->get()->result_array(); */

    }



/* 
    <td>1</td>
    <td><img src="<?php echo base_url()?>assets/images/users/avatar-2.jpg" class="imge_categoy">Rohini Sign</td>
    <td><img src="<?php echo base_url()?>assets/images/users/avatar-1.jpg" class="imge_categoy">Seeds(बीज)</td>
    <td>seeds</td>
    <td>sub category</td>
    <td>Rs 200</td>
    <td>Rs 100</td>
    <td><button type="button" class="btn btn-success">Active</button></td>
     <td><a href="<?php echo base_url()?>Admin/product_details" type="button" class="btn btn-success"><i class="fa fa-eye"></i></a></td>
               */






               public function  product_data_vendor_filter()
               {
               return $this->db->select('product.id as product_id, product.description,product.category_id,product.subcat_id as subcategory_id,product.mrp,product.price as selling_price,product.stock_status, product.availabe_stock,product.quantity,product.top_product as is_top_product,product.status as product_status,c1.name as category_name,c1.image as category_image,c2.name as sub_cat_name, c2.image as subcategory_image,ap1.product_name_hindi,ap1.product_name_english,vendor.name as v_name,vendor.email as v_email,vendor.id as v_id,vendor.office_address,vendor.profile_image,vendor.status as v_status')
               ->join('product ','product.vendor_id=vendor.id','left')
               ->join('add_product ap1', 'ap1.id = product.product_name_hindi_id','left')
               ->join('add_product ap2', 'ap2.id = product.product_name_english_id','left')
               ->join('category c1', 'c1.id = product.category_id','left')
               ->join('subcategory c2', 'c2.id= product.subcat_id','left')
               ->join('product_image','product_image.product_id=product.id','left')
              //  ->where(['vendor.status'=>1,'product.id !='=>'','product.status!='=>2]) 
              ->order_by('product.id','desc')
                ->where(['vendor.status'=>1,'product.id !='=>'','product.status!='=>2,'c1.status'=>1,'c2.status'=>1]) 
               ->group_by('product.id')
               ->get('vendor')
               ->result_array(); 
     
               }


        public function   product_data_vendor_category_wise($vendor_id,$category_id)
        {
          return $this->db->select('product.id as product_id,product.description,product.category_id,product.subcat_id as subcategory_id,product.mrp,product.price as selling_price,product.stock_status, product.availabe_stock,product.quantity,product.top_product as is_top_product,product.status as product_status,c1.name as category_name,c1.image as category_image,c2.name as sub_cat_name, c2.image as subcategory_image,ap1.product_name_hindi,ap1.product_name_english,vendor.name as v_name,vendor.email as v_email,vendor.id as v_id,vendor.office_address,vendor.profile_image')
          ->join('product ','product.vendor_id=vendor.id','left')
          ->join('add_product ap1', 'ap1.id = product.product_name_hindi_id','left')
          ->join('add_product ap2', 'ap2.id = product.product_name_english_id','left')
          ->join('category c1','c1.id= product.category_id','left')
          ->join('subcategory c2','c2.id=product.subcat_id','left')
          ->join('product_image','product_image.product_id=product.id','left')
          ->group_by('product.id')
          ->where(['vendor.id'=>$vendor_id,'product.category_id'=>$category_id,'vendor.status'=>1,'product.id !='=>'','product.status!='=>2])
          ->get('vendor')
          ->result_array(); 
        }


      public function  product_data_vendor_category_subcategory_wise($vendor_id,$category_id,$subcategory_id){
        return $this->db->select('product.id as product_id,product.description,product.category_id,product.subcat_id as subcategory_id,product.mrp,product.price as selling_price,product.stock_status, product.availabe_stock,product.quantity,product.top_product as is_top_product,product.status as product_status,c1.name as category_name,c1.image as category_image,c2.name as sub_cat_name, c2.image as subcategory_image,ap1.product_name_hindi,ap1.product_name_english,vendor.name as v_name,vendor.email as v_email,vendor.id as v_id,vendor.office_address,vendor.profile_image')
        ->join('product ','product.vendor_id=vendor.id','left')
        ->join('add_product ap1', 'ap1.id = product.product_name_hindi_id','left')
        ->join('add_product ap2', 'ap2.id = product.product_name_english_id','left')
        ->join('category c1','c1.id= product.category_id','left')
        ->join('subcategory c2','c2.id=product.subcat_id','left')
        ->join('product_image','product_image.product_id=product.id','left')
        ->group_by('product.id')
        ->where(['vendor.id'=>$vendor_id,'product.category_id'=>$category_id,'product.subcat_id'=>$subcategory_id,'vendor.status'=>1,'product.id !='=>'','product.status!='=>2])
        ->get('vendor')
        ->result_array(); 
      }




      public function  product_data_category_subcategory_wise($category_id,$subcategory_id){
        return $this->db->select('product.id as product_id,product.description,product.category_id,product.subcat_id as subcategory_id,product.mrp,product.price as selling_price,product.stock_status, product.availabe_stock,product.quantity,product.top_product as is_top_product,product.status as product_status,c1.name as category_name,c1.image as category_image,c2.name as sub_cat_name, c2.image as subcategory_image,ap1.product_name_hindi,ap1.product_name_english,vendor.name as v_name,vendor.email as v_email,vendor.id as v_id,vendor.office_address,vendor.profile_image')
        ->join('product ','product.vendor_id=vendor.id','left')
        ->join('add_product ap1', 'ap1.id = product.product_name_hindi_id','left')
        ->join('add_product ap2', 'ap2.id = product.product_name_english_id','left')
        ->join('category c1','c1.id= product.category_id','left')
        ->join('subcategory c2','c2.id=product.subcat_id','left')
        ->join('product_image','product_image.product_id=product.id','left')
        ->group_by('product.id')
        ->where(['product.category_id'=>$category_id,'product.subcat_id'=>$subcategory_id,'vendor.status'=>1,'product.id !='=>'','product.status!='=>2])
        ->get('vendor')
        ->result_array(); 
      }


   public function   product_data_category_wise($category_id)
   {
    return $this->db->select('product.id as product_id,product.description,product.category_id,product.subcat_id as subcategory_id,product.mrp,product.price as selling_price,product.stock_status, product.availabe_stock,product.quantity,product.top_product as is_top_product,product.status as product_status,c1.name as category_name,c1.image as category_image,c2.name as sub_cat_name, c2.image as subcategory_image,ap1.product_name_hindi,ap1.product_name_english,vendor.name as v_name,vendor.email as v_email,vendor.id as v_id,vendor.office_address,vendor.profile_image')
    ->join('product ','product.vendor_id=vendor.id','left')
    ->join('add_product ap1', 'ap1.id = product.product_name_hindi_id','left')
    ->join('add_product ap2', 'ap2.id = product.product_name_english_id','left')
    ->join('category c1','c1.id= product.category_id','left')
    ->join('subcategory c2','c2.id=product.subcat_id','left')
    ->join('product_image','product_image.product_id=product.id','left')
    ->group_by('product.id')
    ->where(['product.category_id'=>$category_id,'vendor.status'=>1,'product.id !='=>'','product.status!='=>2])
    ->get('vendor')
    ->result_array(); 
  }

 /*  public function get_product_varient($product_id,$vendor_id){
    return $this->db->select('GROUP_CONCAT(product_image.image) as varient_images,product.id as product_id,varient.id ,varient.adding_to_id,varient.quantity,varient.category_id, varient.description,varient.subcat_id as subcategory_id,varient.mrp,varient.price,varient.product_name_hindi_id,varient.product_name_english_id,varient.stock_status,ap1.product_name_hindi,ap1.product_name_english, varient.availabe_stock,varient.verification_doc as varient_ver_doc')
    ->join('product ','product.vendor_id=vendor.id','left')
    ->join('varient ','varient.adding_to_id=product.id','left')
    ->join('add_product ap1', 'ap1.id = varient.product_name_hindi_id','left')
    ->join('add_product ap2', 'ap2.id = varient.product_name_english_id','left')
   ->join('category c1', 'c1.id = product.category_id','left')
    ->join('subcategory c2', 'c2.id= product.subcat_id','left')
    ->join('product_image','product_image.varient_id=varient.id','left')
    ->where(['varient.adding_to_id'=>$product_id,'varient.vendor_id'=>$vendor_id]) 
    ->group_by('product.id')
    ->get('vendor')
    ->result_array(); 
  } */

  public function get_product_varient($product_id,$vendor_id)
  {
   return  $this->db->select('vendor.status as v_status,varient.id as varient_id, varient.adding_to_id,varient.quantity,varient.category_id, varient.description,varient.subcat_id as subcategory_id,varient.mrp,varient.price,varient.product_name_hindi_id,varient.product_name_english_id,varient.stock_status,
   varient.availabe_stock,varient.verification_doc as varient_ver_doc, 
   product_image.varient_id,GROUP_CONCAT(product_image.image) as varient_images,c1.id as c_id,c2.id as sub_id,c1.name as cname,c2.name as subname,ap1.product_name_hindi,ap1.product_name_english')
    ->from('varient')
    ->where(['varient.adding_to_id'=>$product_id,'varient.vendor_id'=>$vendor_id,'varient.status!='=>2])
    ->join('product_image','product_image.varient_id= varient.id')
    ->join('category c1', 'c1.id = varient.category_id')
    ->join('subcategory c2', 'c2.id= varient.subcat_id') 
    ->join('add_product ap1', 'ap1.id = varient.product_name_hindi_id')
    ->join('add_product ap2', 'ap2.id = varient.product_name_english_id')
    ->join('vendor', 'vendor.id = varient.vendor_id')
    ->group_by('varient.id')
    ->order_by('varient.id','desc')
    ->get()
    ->result_array();
  }

  public function get_vendor_shop($vendor_id){
   return  $this->db->get_where('tbl_shopdetails',['vendor_id'=>$vendor_id])->row_array();
  }

 public function update_shopdetails($array,$vendor_id){
    return $this->db->where(['vendor_id'=>$vendor_id])->update('tbl_shopdetails',$array);
 }



}


?>