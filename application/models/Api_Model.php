<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Api_Model extends CI_Model
{
public function login_get()
{
    $userdata = array();
   $query=   $this->db->select('users.id,users.name,users.mobile,users.email,ifnull(users.image,"") as image,users.district as district_id,district.name as district_name,users.state as state_id,tbl_state.name as state_name,users.pincode,users.tahsil,users.pincode,users.password,ifnull(users.read_notification,"") as read_notification,users.status')->
   join('district','district.id=users.district','left')->join('tbl_state','tbl_state.id=users.state','left')->
    where('users.status in(0,1)')->where('users.mobile',$this->input->post('mobile'))->or_where('users.email',$this->input->post('mobile'))->get('users');
    if ($query->num_rows() > 0) 
    {
        $row = $query->row_array();
        if($row['status'] == 1 )
        {
            if($row['password'] == md5($this->input->post('password')))
            {
                    $userdata = $row;
                    $userdata['login_status'] = 1;
            } 
           
            else
            {
                $userdata['login_status'] = 3;
            }
        } 
   

        else
        {
           $userdata['login_status'] = 2; 
        }
              
}
    else 
    {
        
        $userdata['login_status'] = 0;
    }
    
    
    
    return $userdata;
}

public function verify_otp()
{
        $otp_verification = array();
        $mobile=$this->input->post('mobile');
       $otp=$this->input->post('otp');
       $user_data=$this->db->where(['mobile'=>$mobile,'type'=>'f'])->get('tblotp');
       
         $otp_timedata=$this->db->get('app_setting')->row();
       if($user_data->num_rows()>0)
        {
             
        $user_data_row = $user_data->row();
        $date= date("Y-m-d H:i:s",strtotime($user_data_row->updated_at	.' +'.$otp_timedata->otp_time.' seconds'));
        $current_date=date("Y-m-d H:i:s");
        if($date > $current_date)
        {
            // print_r($date);
            // print_r($current_date);
           if($user_data_row->otp==$otp)
            {
            $data=$this->db->where(['mobile'=>$mobile])->get('users')->row_array();
            $otp_verification = $data;
            $otp_verification['status']=1;
            }
            else
            {
            $otp_verification['status']=0;
            }
        }
        else
        {
            $otp_verification['status']=3; 
        }
        }
        else
        {
        $otp_verification['status']=2; 
        }
        return $otp_verification;
}
public function set_upload_files($upload_path ,$files,$type="")
{
    $image_base64 = base64_decode($files);
    
    if($type!="" && $type!=null){
        $file = $upload_path . uniqid() . '.'.$type;
    }else{
        $file = $upload_path . uniqid() . '.png';
    }
    file_put_contents($file, $image_base64); 
    $image = $file;
    return $image;
}
        
// public function place_enquiry($user_id,$user_msg,$vendor_id)
// {
//     $enquiry_array=array();
//     $return_status=array();
// // $vendor_id=   get_vendor_id_user_wise_for_enquiry($user_id);
//     // print_r($vendor_id);exit;
    
//     $array=array('user_id'=>$user_id);
//     $cart_data=$this->db->where($array)->get('cart')->result();    
//     if(!empty($cart_data))
//     {
//         // $enquiry_array['user_id']=$user_id;
//         // $enquiry_array['status']=1;
//         foreach($cart_data as $r)
//       {
//         $enquiry_array[$r->vendor_id][]=$r;
//       }
//     //  print_r($enquiry_array);exit;
// //     $this->db->insert('enquiry',$enquiry_array);
// //   $order_id= $this->db->insert_id();
//     foreach($enquiry_array as $row)
//     {
//         $this->db->insert('enquiry',['vendor_id'=>$row[0]->vendor_id,'user_id'=>$row[0]->user_id,'status'=>1]);
    
//         $order_id= $this->db->insert_id();
//         foreach($row as $ro)
//         {
//              $enquiry_details=array(
//             'user_id'=>$user_id,
//             'vendor_id'=>$ro->vendor_id,
//             'product_id'=>$ro->product_id,
//             'user_msg'=>$user_msg,
//             'order_id'=>$order_id,
//             'status'=>0,
//               'enquiry_type'=>'product',
//             );
//              $this->db->insert('enquiry_details',$enquiry_details);
//         }
       
//     }
    
//      $this->db->where(['user_id'=>$user_id,'vendor_id'=>$vendor_id])->delete('cart');
//     $enquiry_details['status']=1;
//     }
 
//  else
//  {
//       $enquiry_details['status']=2;
//  }
//  return $enquiry_details;
// }
        public function place_enquiry($user_id,$user_msg,$vendor_id)
        {
        $enquiry_array=array();
        $return_status=array();
        $array=array('user_id'=>$user_id,'vendor_id'=>$vendor_id);
        $cart_data=$this->db->where($array)->get('cart')->result();  
        if(!empty($cart_data))
        {
        foreach($cart_data as $r)
        {
        $enquiry_array[$r->vendor_id][]=$r;
        }
        foreach($enquiry_array as $row)
        {
        $this->db->insert('enquiry',['vendor_id'=>$vendor_id,'user_id'=>$user_id,'status'=>1]);
        $order_id= $this->db->insert_id();
        foreach($row as $ro)
        {
        $enquiry_details['user_id']=$user_id;
        $enquiry_details['vendor_id']=$vendor_id;
        $enquiry_details['user_msg']=$user_msg;
        $enquiry_details['order_id']=$order_id;
        $enquiry_details['status']=0;
        $enquiry_details['enquiry_type']='product';
         $enquiry_details['type']=$ro->type;
        if($ro->type=='product'){
             $enquiry_details['product_id']=$ro->product_id;
             $enquiry_details['varient_id']=null;
        }if($ro->type=='varient'){
             $enquiry_details['varient_id']=$ro->varient_id;
             $enquiry_details['product_id']=null;
        }
        $this->db->insert('enquiry_details',$enquiry_details);
       // echo $this->db->last_query();die();
        $this->db->where(['user_id'=>$user_id,'vendor_id'=>$vendor_id,'type'=>$ro->type])->delete('cart');
        }
        
        }
        
        $enquiry_details['status']=1;
        }
        else
        {
        $enquiry_details['status']=2;
        }
        return $enquiry_details;
        }
public function send_enquiry()
{
            $user_id= $this->input->post('user_id');
            $user_msg=$this->input->post('user_msg');
            $vendor_id=$this->input->post('vendor_id');
            $issue_type=$this->input->post('issue_type');
            $type=$this->input->post('type');
            $insert_array['user_id']= $user_id;
            $insert_array['vendor_id']= $vendor_id;
            $insert_array['user_msg']= $user_msg;
            $insert_array['issue_type']= $issue_type;
            $insert_array['enquiry_type']= $type;
            $insert_array['type']= 'product';
             if($type=='general'){
                $insert_array['product_id']= $this->input->post('product_id');
                 $x=$this->db->insert('enquiry_details',$insert_array);
             }else{
                  $x=$this->db->insert('enquiry_details',$insert_array);
             }
     
   return  $x;
}
        public function remove_product_from_cart($user_id,$cart_id,$type)
        {
        $check_array['id']=$cart_id;
        $check_array['user_id']=$user_id;
        if($type=='product'){
            $product_id=$this->input->post('product_id');
            $check_array['product_id']=$product_id;
        }else{
           $varient_id=$this->input->post('varient_id');
           $check_array['varient_id']=$varient_id; 
        }
        $this->db->where($check_array)->delete('cart');
        return  $this->db->affected_rows(); 
        }
 public function get_enquiry_with_order_id($user_id)
   {
       //if(condition,true,false) as value
return $this->db->select('enquiry_details.id as enquiry_id, ifnull(enquiry_details.order_id,"") as order_id, enquiry_details.vendor_id,vendor.name,ifnull(vendor.mobile,"") as mobile,ifnull(vendor.email,"") as email,ifnull(vendor.profile_image,"") as image,enquiry_details.status,enquiry_details.enquiry_type,enquiry_details.user_msg,enquiry_details.issue_type,users.image as user_image,enquiry_details.admin_msg,enquiry_details.vendor_msg,enquiry_details.type ')->join('vendor','vendor.id=enquiry_details.vendor_id','left')->join('users','users.id=enquiry_details.user_id','left')->
 join('enquiry','enquiry.id=enquiry_details.order_id','left')->
//'enquiry_details.enquiry_type!='=>'admin'
where(['enquiry_details.user_id'=>$user_id,'enquiry_details.status!='=>2,'vendor.status'=>1,'enquiry_details.order_id!='=>null])->group_by('enquiry_details.order_id')->
order_by('enquiry_details.id')->
get('enquiry_details')->result();
   }
    public function get_enquiry_without_order_id($user_id)
   {
       //if(condition,true,false) as value
return $this->db->select('enquiry_details.id as enquiry_id, ifnull(enquiry_details.order_id,"") as order_id, enquiry_details.vendor_id,vendor.name,ifnull(vendor.mobile,"") as mobile,ifnull(vendor.email,"") as email,ifnull(vendor.profile_image,"") as image,enquiry_details.status,enquiry_details.enquiry_type,enquiry_details.user_msg,enquiry_details.issue_type,users.image as user_image,enquiry_details.admin_msg,enquiry_details.vendor_msg,enquiry_details.type ')->join('vendor','vendor.id=enquiry_details.vendor_id','left')->join('users','users.id=enquiry_details.user_id','left')->
 join('enquiry','enquiry.id=enquiry_details.order_id','left')->
//'enquiry_details.enquiry_type!='=>'admin'
where(['enquiry_details.user_id'=>$user_id,'enquiry_details.status!='=>2,'vendor.status'=>1,'enquiry_details.order_id'=>null])->
order_by('enquiry_details.id')->
get('enquiry_details')->result();
   }
   public function get_vendor_from_cart_for_varient($user_id)
   {
       return $this->db->select('vendor.id as vendor_id,vendor.name,ifnull(vendor.email,"") as email,ifnull(vendor.mobile,"") as mobile,ifnull(vendor.profile_image,"") as image,cart.type')
       ->join('vendor','vendor.id=cart.vendor_id','left')
       ->join('product as p1','p1.id=cart.product_id','left')
       ->join('product','product.vendor_id=vendor.id','left')
       ->where(['cart.user_id'=>$user_id,'vendor.status'=>1,'vendor.is_block'=>0,'product.status'=>1,'p1.status'=>1,'p1.show_user'=>1])
       ->group_by('cart.vendor_id')
       ->get('cart')
       ->result();
   }
//      public function get_vendor_from_cart_for_product($user_id)
//   {
//       return $this->db->select('vendor.id as vendor_id,vendor.name,ifnull(vendor.email,"") as email,ifnull(vendor.mobile,"") as mobile,ifnull(vendor.profile_image,"") as image,cart.type')->join('vendor','vendor.id=cart.vendor_id')->where(['cart.user_id'=>$user_id,'cart.type'=>'product'])->group_by('cart.vendor_id')->get('cart')->result();
//   }
   public function get_product_from_cart($vendor_id,$user_id)
   {
return $this->db->select('
                                FORMAT(if(((product.mrp IS NOT NULL) and (product.price IS NOT NULL)),
                                    (((product.mrp-product.price)/product.mrp)*100)
                                    ,0
                                ) ,2) as discount,
                          product.id as product_id,cart.id as cart_id,
                          ifnull(product.mrp,0) as mrp,
                          ifnull(product.price,0) as selling_price,
                          ap1.product_name_hindi,
                          ap1.product_name_english,ifnull(product_image.image,"") as product_image,cart.type')
                ->join('product','product.id=cart.product_id','left')
                ->join('vendor','vendor.id=cart.vendor_id','left')
                ->join('product_image','product_image.product_id=cart.product_id','left')
                ->join('add_product ap1', 'ap1.id = product.product_name_hindi_id', 'left')
                ->join('add_product ap2', 'ap2.id = product.product_name_english_id', 'left')
                ->where(['cart.vendor_id'=>$vendor_id,'cart.user_id'=>$user_id,'product.status'=>1,'product.show_user'=>1,'vendor.status'=>1,'vendor.is_block'=>0,'ap2.status'=>1,'ap1.status'=>1])->group_by('product.id')->order_by('cart.id')->get('cart')->result();
   }
    public function get_varient_from_cart($vendor_id,$user_id)
   {
return $this->db->select('
                              FORMAT(if(((varient.mrp IS NOT NULL) and (varient.price IS NOT NULL)),
                                    (((varient.mrp-varient.price)/varient.mrp)*100)
                                    ,0
                                ) ,2) as discount,
                          varient.id as product_id,cart.id as cart_id,
                          ifnull(varient.mrp,0) as mrp,
                          ifnull(varient.price,0) as selling_price,
                          ap1.product_name_hindi,
                          ap1.product_name_english,ifnull(product_image.image,"") as product_image,cart.type')
                ->join('varient','varient.id=cart.varient_id','left')
                 ->join('product', 'product.id= varient.adding_to_id', 'left')
                
                 ->join('vendor', 'vendor.id= product.vendor_id', 'left')
                
                ->join('product_image','product_image.varient_id=cart.varient_id','left')
                ->join('add_product ap1', 'ap1.id = product.product_name_hindi_id', 'left')
                ->join('add_product ap2', 'ap2.id = product.product_name_english_id', 'left')
                ->where(['cart.vendor_id'=>$vendor_id,'cart.user_id'=>$user_id,'varient.status!='=>2,'product.show_user'=>1,'vendor.status'=>1,'vendor.is_block'=>0])->group_by('varient.id')->order_by('cart.id')->get('cart')->result();
   }
   
   public function product_image($id)
    {
        return $this->db->select('id,image')->where(['status' => 1, 'product_id' => $id])->get('product_image')->row();
    }
   //new api created by mahek on  13 jan 2023
        public function get_top_product($user_id,$type)
    {
         $querywishlist =  "(select id  from wishlist where user_id = '".$user_id."' AND wishlist.product_id = product.id limit 1)";
        $is_wishlist = "IF($querywishlist > 0,1,0) as is_wishlist";
         
        $query= $this->db->select("product.id as product_id, product.vendor_id,vendor.id as vid,vendor.status as v_status,vendor.is_block,ap1.product_name_hindi,ap1.product_name_english,ifnull(product.mrp,0) as mrp,ifnull(product.price,0) as price,
        FORMAT(if(
                                    ((product.mrp IS NOT NULL) and (product.price IS NOT NULL)),
                                    (((product.mrp-product.price)/product.mrp)*100)
                                    ,0
                                ) ,2)
                                as discount,product_image.image,$is_wishlist")
            
            ->join('vendor ', 'vendor.id = product.vendor_id', 'left')
            
            ->join('add_product ap1', 'ap1.id = product.product_name_hindi_id', 'left')
            ->join('add_product ap2', 'ap2.id = product.product_name_english_id', 'left')
            ->join('product_image', 'product_image.product_id = product.id', 'left')
            ->where(['product.status' => 1, 'product.top_product' => 1,'product.show_user'=>1,'vendor.status'=>1,'vendor.is_block'=>0]);
            if($type=="")
            $this->db->limit(5);
           return $this->db->group_by('product.id')->get('product')->result_array();
//             ->get('product')
//             ->result_array();
// return $query;
    }
    public function get_new_product($user_id,$type)
    {
         $querywishlist =  "(select id  from wishlist where user_id = '".$user_id."' AND wishlist.product_id = product.id limit 1)";
        $is_wishlist = "IF($querywishlist > 0,1,0) as is_wishlist";
         
     $this->db->select("product.id as product_id,ap1.product_name_hindi, product.vendor_id, vendor.id as vid,vendor.status as v_status,vendor.is_block,  ap1.product_name_english,ifnull(product.mrp,0) as mrp,ifnull(product.price,0) as price,FORMAT(if(
                                    ((product.mrp IS NOT NULL) and (product.price IS NOT NULL)),
                                    (((product.mrp-product.price)/product.mrp)*100)
                                    ,0
                                ) ,2)
                                as discount,product_image.image,$is_wishlist")
            ->join('add_product ap1', 'ap1.id = product.product_name_hindi_id', 'left')
            
            ->join('vendor', 'vendor.id = product.vendor_id', 'left')
            
            ->join('add_product ap2', 'ap2.id = product.product_name_english_id', 'left')
            ->join('product_image', 'product_image.product_id = product.id', 'left')
              // if($type=="")
            // $this->db->limit(5);
            ->where(['product.status' => 1,'product.show_user'=>1,'vendor.status'=>1,'vendor.is_block'=>0])->group_by('product.id')->order_by('product.id','desc');
            if($type=="")
            $this->db->limit(5);
           return $this->db->group_by('product.id')->get('product')->result_array();
        
//return $query;
    }
     public function get_all_product($user_id,$type,$order_id,$enquiry_type,$enquiry_id,$product_type)
    {
         $querywishlist =  "(select id  from wishlist where user_id = '".$user_id."' AND wishlist.product_id = product.id limit 1)";
        $is_wishlist = "IF($querywishlist > 0,1,0) as is_wishlist";
         
     $this->db->select("product.id as product_id,ap1.product_name_hindi,ap1.product_name_english,ifnull(product.mrp,0) as mrp,ifnull(product.price,0) as price,FORMAT(if(
                                    ((product.mrp IS NOT NULL) and (product.price IS NOT NULL)),
                                    (((product.mrp-product.price)/product.mrp)*100)
                                    ,0
                                ) ,2)
                                as discount,product_image.image,$is_wishlist,enquiry_details.type")
            ->join('add_product ap1', 'ap1.id = product.product_name_hindi_id', 'left')
            
            
            ->join('vendor', 'vendor.id = product.vendor_id', 'left')
            
            ->join('add_product ap2', 'ap2.id = product.product_name_english_id', 'left')
            ->join('product_image', 'product_image.product_id = product.id', 'left');
            if($type=='enquiry' ){
                $this->db->join('enquiry_details', 'enquiry_details.product_id = product.id', 'left');
                if($enquiry_type=='product'){
                   $this->db->where('enquiry_details.order_id',$order_id);
                }else{
                     $this->db->where('enquiry_details.id',$enquiry_id);
                }
            }
            $this->db->where(['enquiry_details.status!='=>2,'enquiry_details.type'=>$product_type,'vendor.status'=>1,'vendor.is_block'=>0])->group_by('product.id')->order_by('product.id','desc');
            $data=$this->db->get('product');
        $query= $data->result_array();
return $query;
    }
     public function get_all_varient($user_id,$type,$order_id,$enquiry_type,$enquiry_id,$product_type)
    {
         $querywishlist =  "(select id  from wishlist where user_id = '".$user_id."' AND wishlist.varient_id =  varient.id limit 1)";
        $is_wishlist = "IF($querywishlist > 0,1,0) as is_wishlist";
         
     $this->db->select("varient.id as product_id,ap1.product_name_hindi,ap1.product_name_english,ifnull( varient.mrp,0) as mrp,ifnull(varient.price,0) as price,FORMAT(if(
                                    ((varient.mrp IS NOT NULL) and (varient.price IS NOT NULL)),
                                    (((varient.mrp- varient.price)/varient.mrp)*100)
                                    ,0
                                ) ,2)
                                as discount,product_image.image,$is_wishlist,enquiry_details.type")
                                
                                  ->join('vendor', 'vendor.id = varient.vendor_id', 'left')
                                
                                
            ->join('add_product ap1', 'ap1.id = varient.product_name_hindi_id', 'left')
            ->join('add_product ap2', 'ap2.id = varient.product_name_english_id', 'left')
            ->join('product', 'product.id = varient.adding_to_id', 'left')
            ->join('product_image', 'product_image.varient_id = varient.id', 'left');
            
            if($type=='enquiry' ){
                $this->db->join('enquiry_details', 'enquiry_details.varient_id = varient.id', 'left');
                if($enquiry_type=='product'){
                   $this->db->where('enquiry_details.order_id',$order_id);
                }else{
                     $this->db->where('enquiry_details.id',$enquiry_id);
                }
            }
            $this->db->where(['enquiry_details.status!='=>2,'enquiry_details.type'=>$product_type,'vendor.status'=>1,'vendor.is_block'=>0])->group_by('product.id')->order_by('product.id','desc');
            $data=$this->db->get('varient');
        $query= $data->result_array();
return $query;
    }
       public function get_product_by_subcategory($sub_category_id,$user_id)
    {
         $querywishlist =  "(select id  from wishlist where user_id = '".$user_id."' AND wishlist.product_id = product.id limit 1)";
        $is_wishlist = "IF($querywishlist > 0,1,0) as is_wishlist";
         
        $query= $this->db->select("product.id as product_id,ap1.product_name_hindi,ap1.product_name_english,ifnull(product.mrp,0) as mrp,ifnull(product.price,0) as price,FORMAT(if(
                                    ((product.mrp IS NOT NULL) and (product.price IS NOT NULL)),
                                    (((product.mrp-product.price)/product.mrp)*100)
                                    ,0
                                ) ,2)
                                as discount,$is_wishlist")
            ->join('add_product ap1', 'ap1.id = product.product_name_hindi_id', 'left')
            
            ->join('vendor', 'vendor.id = product.vendor_id', 'left')
            
            
            ->join('add_product ap2', 'ap2.id = product.product_name_english_id', 'left')
            ->where(['product.status' =>1,'product.subcat_id'=>$sub_category_id,'product.show_user'=>1,'vendor.status'=>1,'vendor.is_block'=>0])
            ->get('product')
            ->result_array();
return $query;
    }
      public function get_product_by_id($product_id,$user_id)
     {
        $querywishlist =  "(select id  from wishlist where user_id = '".$user_id."' AND wishlist.product_id = product.id limit 1)";
        $is_wishlist = "IF($querywishlist > 0,1,0) as is_wishlist";
        $querycart =  "(select id  from cart where user_id = '".$user_id."' AND cart.product_id = product.id AND status!=2 limit 1)";
       // echo $this->db->last_query();die();
        $cart_status = "IF($querycart > 0,1,0) as is_cart";
        $query= $this->db->select("product.id as product_id,product.category_id,product.subcat_id as subcategory_id,product.mrp,product.price as selling_price,product.stock_status,product.top_product as is_top_product,product.status as approval_status,product.quantity,product.description,ifnull(product.verification_doc,'') as verification_doc,c1.name as category_name, c2.name as sub_cat_name,ap1.product_name_hindi,ap1.product_name_english,product.product_name_hindi_id as select_product_id,product.availabe_stock,$is_wishlist, $cart_status, 
                                   FORMAT(if(((product.mrp IS NOT NULL) and (product.price IS NOT NULL)),
                                    (((product.mrp-product.price)/product.mrp)*100)
                                    ,0
                                ) ,2)
                                as discount,product.vendor_id,product.category_id,product.subcat_id")
            ->join('add_product ap1', 'ap1.id = product.product_name_hindi_id', 'left')
            ->join('add_product ap2', 'ap2.id = product.product_name_english_id', 'left')
                // ->join('product_image ','product_image.product_id = product.id','left')
            ->join('category c1', 'c1.id= product.category_id', 'left')
            ->join('subcategory c2', 'c2.id=product.subcat_id', 'left')
            ->where(['product.status' => 1, 'product.id' => $product_id,'product.show_user'=>1])
            ->get('product')
            ->row_array();
return $query;
    }
    public function all_product_image($id)
    {
        return $this->db->select('id,image')->where(['status' => 1, 'product_id' => $id])->get('product_image')->result();
    }
    public function get_product_varient($product_id)
     {
        $query= $this->db->select("varient.id as varient_id,varient.mrp,varient.price as price,ap1.product_name_hindi,ap1.product_name_english, FORMAT(if(((varient.mrp IS NOT NULL) and (varient.price IS NOT NULL)),
                                    (((varient.mrp-varient.price)/varient.mrp)*100)
                                    ,0
                                ) ,2) as discount,,")
            ->join('add_product ap1', 'ap1.id = varient.product_name_hindi_id', 'left')
            ->join('add_product ap2', 'ap2.id = varient.product_name_english_id', 'left')
            ->where(['varient.status !=' => 2, 'varient.adding_to_id' => $product_id])
            ->get('varient')
            ->result_array();
return $query;
    }
    //new api created on 29-03-2023
    public function get_faq()
    {
      return  $this->db->select('question,answer')->where('status',1)->get('faq')->result();
    }
    public function get_news_event($type)
    {
      return  $this->db->select('id,title,description,url,image')->where(['status'=>1,'type'=>$type])->get('news_event')->result();
    }
    public function get_contact_us()
    {
      return  $this->db->select('id,name,image,ifnull(mobile,"") as mobile')->where('status',1)->limit('4')->get('tbl_team')->result();
    }
     public function get_admin_details()
    {
      return  $this->db->where(['status'=>1])->get('admin')->row();
    }
    public function get_sellers()
    {
      return  $this->db->select('id,name,ifnull(profile_image,"") as image,ifnull(mobile,"") as mobile,email')->where(['status'=>1,'is_block'=>0])->get('vendor')->result();
    }
     public function get_seller_detail_by_id($seller_id)
    {
      return  $this->db->select('vendor.id,vendor.name,vendor.profile_image,tbl_shopdetails.district,district.name as district_name,vendor.tehsil,vendor.village,block.name as block_name,vendor.pincode,tbl_shopdetails.name as shop_name,vendor.email,vendor.mobile,tbl_shopdetails.tehsil as s_tehsil,tbl_shopdetails.village as s_village,tbl_shopdetails.block as s_block,tbl_shopdetails.pincode as s_pincode')->
      join('district','district.id=vendor.district_id','left')->join('block','block.id=vendor.block_id','left')->join('tbl_shopdetails',' tbl_shopdetails.vendor_id=vendor.id','left')->
      where(['vendor.status'=>1,'vendor.is_block'=>0,'vendor.id'=>$seller_id])->get('vendor')->row();
    }
    //  public function get_seller_detail_by_id($seller_id)
    // {
    //   return  $this->db->select('vendor.id,vendor.name,vendor.profile_image,tbl_shopdetails.district,tbl_shopdetails.tehsil,tbl_shopdetails.village,tbl_shopdetails.block,tbl_shopdetails.pincode,tbl_shopdetails.name as shop_name,vendor.email,vendor.mobile')->
    //   join('district','district.id=vendor.district_id','left')->join('block','block.id=vendor.block_id','left')->join('tbl_shopdetails',' tbl_shopdetails.vendor_id=vendor.id','left')->
    //   where(['vendor.status'=>1,'vendor.is_block'=>0,'vendor.id'=>$seller_id])->get('vendor')->row();
    // }
     public function get_seller_product($seller_id,$user_id)
    {
        $product_array=array();
        if($user_id!=""){
        $querywishlist =  "(select id  from wishlist where user_id = '".$user_id."' AND wishlist.product_id = product.id limit 1)";
        $is_wishlist = "IF($querywishlist > 0,1,0) as is_wishlist";
        }else{
            $is_wishlist=0;
        }
       $product_data= $this->db->select("product.id as product_id,ap1.product_name_english as name,ap1.product_name_hindi,product.mrp,product.price,
     FORMAT(if(((product.mrp IS NOT NULL) and (product.price IS NOT NULL)),
                                    (((product.mrp-product.price)/product.mrp)*100)
                                    ,0
                                ) ,2) as discount,$is_wishlist
                                ")

            ->join('add_product ap1', 'ap1.id = product.product_name_hindi_id', 'left')
            ->join('add_product ap2', 'ap2.id = product.product_name_english_id', 'left')
                // ->join('product_image ','product_image.product_id = product.id','left')
            ->join('category c1', 'c1.id= product.category_id', 'left')
            ->join('subcategory c2', 'c2.id=product.subcat_id', 'left')
            ->where(['product.status' => 1, 'product.vendor_id' => $seller_id])
            ->get('product')
            ->result_array();
            return $product_data;
           // print_r($product_data);exit;
          

    }
    public function subscribe($user_id,$email_id)
    {
        $array=array(
            'user_id'=>$user_id,
            'email'=>$email_id,
            'status'=>1
            );
           return $this->db->insert('subscriber',$array);
    }
     public function send_feedback($user_id,$rating_value,$feedback,$enquiry_id,$type)
    {
        if($type=='product'){
        $product_id=$this->input->post('product_id');    
        $array['product_id']=$product_id;
        $array['varient_id']=null;
        }else{
        $varient_id=$this->input->post('varient_id'); 
        $array['varient_id']=$varient_id;
        $array['product_id']=null; 
        }
        $array['user_id']=$user_id;
        $array['rating_value']=$rating_value;
        $array['feedback']=$feedback;
        $array['enquiry_id']=$enquiry_id;
        $array['status']=1;
       $array['type']=$type;
        return $this->db->insert('rating_feedback',$array);
    }
    public function get_product_rating_feedback($user_id)
    {
        $product_array=array();
        $product_data= $this->db->select("enquiry_details.order_id as order_id,product.id as product_id,ap1.product_name_english as name,ap1.product_name_hindi,product.mrp,product.price,
                                 FORMAT(if(((product.mrp IS NOT NULL) and (product.price IS NOT NULL)),
                                    (((product.mrp-product.price)/product.mrp)*100)
                                    ,0
                                ) ,2) as discount,enquiry_details.type
                                ")
            ->join('product', 'product.id = enquiry_details.product_id', 'left')
            // ->join('rating_feedback', 'rating_feedback.product_id=enquiry_details.product_id ', 'left')
            ->join('add_product ap1', 'ap1.id = product.product_name_hindi_id', 'left')
            ->join('add_product ap2', 'ap2.id = product.product_name_english_id', 'left')
            ->where(['enquiry_details.user_id' => $user_id,'enquiry_details.enquiry_type'=>'product','enquiry_details.type'=>'product','enquiry_details.status'=>4])->group_by('enquiry_details.id')
            ->get('enquiry_details')
            ->result_array();
          foreach($product_data as $p){
               $after_dis=(($p['mrp']*$p['discount'])/100);
              $after_discount_price=$p['mrp']-$after_dis;
              $product_image= $this->product_image($p['product_id']);
    $feedback_data=$this->db->where(['enquiry_id'=>$p['order_id'],'product_id'=>$p['product_id'],'type'=>'product'])->get('rating_feedback')->row_array();
              $product_array[]=array(
                       'enquiry_id'=>$p['order_id'],
                        'product_id'=>$p['product_id'],
                        'product_name_english'=>$p['name'],
                         'product_name_hindi'=>$p['product_name_hindi'],
                        'image'=>isset($product_image->image)?$product_image->image:"",
                        'mrp'=>$p['mrp'],
                        'discount'=>$p['discount'],
                        'price'=>$p['price'],//$after_discount_price,
                        'rating_value'=>isset($feedback_data['rating_value'])?$feedback_data['rating_value']:"",
                        'feedback'=>isset($feedback_data['feedback'])?$feedback_data['feedback']:"",
                        'type'=>$p['type'],
              );
          }
          return $product_array;

    }
      public function get_varient_rating_feedback($user_id)
    {
        $product_array=array();
        $product_data= $this->db->select("enquiry_details.order_id as order_id,varient.id as product_id,ap1.product_name_english as name,ap1.product_name_hindi,varient.mrp,FORMAT(if(((varient.mrp IS NOT NULL) and (varient.price IS NOT NULL)),
                                    (((varient.mrp-varient.price)/varient.mrp)*100)
                                    ,0
                                ) ,2) as discount,,enquiry_details.type,varient.price,
                                ")
            ->join('varient', 'varient.id = enquiry_details.varient_id', 'left')
            // ->join('rating_feedback', 'rating_feedback.product_id=enquiry_details.product_id ', 'left')
            ->join('add_product ap1', 'ap1.id = varient.product_name_hindi_id', 'left')
            ->join('add_product ap2', 'ap2.id = varient.product_name_english_id', 'left')
            ->where(['enquiry_details.user_id' => $user_id,'enquiry_details.enquiry_type'=>'product','enquiry_details.status'=>4,'enquiry_details.product_id'=>null,'enquiry_details.type'=>'varient'])->group_by('enquiry_details.id')
            ->get('enquiry_details')
            ->result_array();
          //echo $this->db->last_query();die();
          foreach($product_data as $p){
               $after_dis=(($p['mrp']*$p['discount'])/100);
              $after_discount_price=$p['mrp']-$after_dis;
              $product_image= $this->varient_image($p['product_id']);
    $feedback_data=$this->db->where(['enquiry_id'=>$p['order_id'],'varient_id'=>$p['product_id'],'type'=>'varient'])->get('rating_feedback')->row_array();
              $product_array[]=array(
                       'enquiry_id'=>$p['order_id'],
                        'product_id'=>$p['product_id'],
                        'product_name_english'=>$p['name'],
                         'product_name_hindi'=>$p['product_name_hindi'],
                        'image'=>isset($product_image->image)?$product_image->image:"",
                        'mrp'=>$p['mrp'],
                        'discount'=>$p['discount'],
                        'price'=>$p['price'],//$after_discount_price,
                        'rating_value'=>isset($feedback_data['rating_value'])?$feedback_data['rating_value']:"",
                        'feedback'=>isset($feedback_data['feedback'])?$feedback_data['feedback']:"",
                        'type'=>$p['type'],
              );
          }
          return $product_array;

    }
    public function get_state()
    {
        $result=$this->db->select('tbl_state.name as name,tbl_state.id')->from('tbl_state')
	->join('district','district.state_id = tbl_state.id')
	->where(['district.status'=>1])
	->group_by('district.state_id')->order_by('name','ASC')
	->get()
	->result();
	return $result;
     //return   $this->db->select('id,name')->where('status',1)->get('tbl_state')->result();
    }
      public function get_district($state_id)
    {
     return   $this->db->select('id,name')->where(['status'=>1,'state_id'=>$state_id])->order_by('name','ASC')->get('district')->result();
    }
    public function create_search_history($user_id,$type)
    {
        if($type=='product'){
        $product_id = $this->input->post('product_id'); 
        $insert_array['product_id']=$product_id;
        $check_array['product_id']=$product_id;
        }else{
        $varient_id = $this->input->post('varient_id');
        $insert_array['varient_id']=$varient_id;
        $check_array['varient_id']=$varient_id;
        }    
        $insert_array['user_id']=$user_id;
        $insert_array['status']=1;
        $insert_array['type']=$type;
        $check_array['status']=1;
        $check_array['user_id']=$user_id;
        $check_array['type']=$type;
        $history_data=$this->db->where($check_array)->get('search_history')->num_rows();
      //  echo $this->db->last_query();die();
        if($history_data==0){
        return $this->db->insert('search_history',$insert_array); 
        }
     
    }
     public function get_search_product($user_id,$type)
    {
         $querywishlist =  "(select id  from wishlist where user_id = '".$user_id."' AND wishlist.product_id = product.id limit 1)";
        $is_wishlist = "IF($querywishlist > 0,1,0) as is_wishlist";
        $product_array=array();
        $this->db->select("search_history.product_id,ap1.product_name_english as name,ap1.product_name_hindi,product.mrp,product.price,product.vendor_id,vendor.id as vid,vendor.status as v_status,vendor.is_block,
                                   FORMAT(if(((product.mrp IS NOT NULL) and (product.price IS NOT NULL)),
                                    (((product.mrp-product.price)/product.mrp)*100)
                                    ,0
                                ) ,2) as discount,$is_wishlist
                                ")
            ->join('product', 'product.id = search_history.product_id', 'left')
            ->join('vendor', 'vendor.id = product.vendor_id', 'left')
            ->join('add_product ap1', 'ap1.id = product.product_name_hindi_id', 'left')
            ->join('add_product ap2', 'ap2.id = product.product_name_english_id', 'left')
            ->where(['product.status' => 1,'product.show_user' => 1,'search_history.user_id' => $user_id,'vendor.status'=>1,'vendor.is_block'=>0])->group_by('product.id')->order_by('search_history.id','DESC');
            // ->get('search_history')
            // ->result_array();
             if($type=="")
            $this->db->limit(5);
           $product_data= $this->db->group_by('search_history.product_id')->get('search_history')->result_array();
           //print_r($product_data);exit;
        //echo $this->db->last_query();die();
          foreach($product_data as $p){
                $after_dis=(($p['mrp']*$p['discount'])/100);
              $after_discount_price=$p['mrp']-$after_dis;
              $product_image= $this->product_image($p['product_id']);
              $product_array[]=array(
                        'product_id'=>$p['product_id'],
                        'product_name_english'=>$p['name'],
                        'product_name_hindi'=>$p['product_name_hindi'],
                        'image'=>isset($product_image->image)?$product_image->image:"",
                        'mrp'=>$p['mrp'],
                        'discount'=>$p['discount'],
                        'price'=>$p['price'],////$after_discount_price,
                       'is_wishlist'=>$p['is_wishlist']
              );
          }
          return $product_array;

    }
     public function get_related_product($category_id,$user_id,$product_id)
    {
       
         $querywishlist =  "(select id  from wishlist where user_id = '".$user_id."' AND wishlist.product_id = product.id limit 1)";
        $is_wishlist = "IF($querywishlist > 0,1,0) as is_wishlist";
        $product_array=array();
        $product_data= $this->db->select("product.id as pid,product.vendor_id,vendor.id as vid,vendor.status as v_status,vendor.is_block,ap1.product_name_english,ap1.product_name_hindi,product.mrp,product.price,
                              FORMAT(if(((product.mrp IS NOT NULL) and (product.price IS NOT NULL)),
                                    (((product.mrp-product.price)/product.mrp)*100)
                                    ,0
                                ) ,2) as discount,$is_wishlist
                                ")
            ->join('add_product ap1', 'ap1.id = product.product_name_hindi_id', 'left')
            
            ->join('vendor', 'vendor.id = product.vendor_id', 'left')
            
            ->join('add_product ap2', 'ap2.id = product.product_name_english_id', 'left')
            ->where(['product.status' => 1, 'product.category_id' => $category_id,'product.id!='=>$product_id,'vendor.status'=>1,'vendor.is_block'=>0,'ap1.product_name_english!='=>''])->group_by('product.id')->order_by('product.id','DESC')->limit(5)
            ->get('product')
            ->result_array();
        //echo $this->db->last_query();die();
          foreach($product_data as $p){
              $after_dis=(($p['mrp']*$p['discount'])/100);
              $after_discount_price=$p['mrp']-$after_dis;
              //print_r($after_dis);exit;
              $product_image= $this->product_image($p['pid']);
              $product_array[]=array(
                        'product_id'=>$p['pid'],
                        'product_name_english'=>$p['product_name_english'],
                         'product_name_hindi'=>$p['product_name_hindi'],
                        'image'=>isset($product_image->image)?$product_image->image:"",
                        'mrp'=>$p['mrp'],
                        'discount'=>$p['discount'],
                        'price'=>$p['price'],//$after_discount_price,
                       'is_wishlist'=>$p['is_wishlist']
              );
          }
          return $product_array;

    }
     public function change_notification_status($user_id)
    {
        $notification_array=array();
        $data['read_notification']=null;
       return $this->db->where(['id'=>$user_id])->update('users',$data); 
    } 
    public function varient_image($id)
    {
        return $this->db->select('id,image')->where(['status' => 1, 'varient_id' => $id])->get('product_image')->row();
    }
     public function varient_image_all($id)
    {
        return $this->db->select('id,image')->where(['status' => 1, 'varient_id' => $id])->get('product_image')->result_array();
    }
     public function get_varient_by_id($varient_id,$user_id)
    {
        $querywishlist =  "(select id  from wishlist where user_id = '".$user_id."' AND wishlist.varient_id = varient.id limit 1)";
        $is_wishlist = "IF($querywishlist > 0,1,0) as is_wishlist";
        $querycart =  "(select id  from cart where user_id = '".$user_id."' AND cart.varient_id = varient.id AND status!=2 limit 1)";
        $cart_status = "IF($querycart > 0,1,0) as is_cart";
        return $this->db->select(" 
                                  FORMAT(if(((varient.mrp IS NOT NULL) and (varient.price IS NOT NULL)),
                                    (((varient.mrp-varient.price)/varient.mrp)*100)
                                    ,0
                                ) ,2) as discount,
        varient.id as varient_id,varient.category_id,varient.subcat_id as subcategory_id,varient.mrp,varient.price as selling_price,  varient.stock_status,varient.top_product as is_top_product,varient.status as approval_status,varient.quantity,varient.description,varient.verification_doc,c1.name as category_name, c2.name as sub_cat_name,ap1.product_name_hindi,ap1.product_name_english,varient.product_name_hindi_id as select_product_id,varient.availabe_stock,varient.vendor_id,$is_wishlist,$cart_status")
            ->join('add_product ap1', 'ap1.id = varient.product_name_hindi_id', 'left')
            ->join('add_product ap2', 'ap2.id = varient.product_name_english_id', 'left')
                // ->join('product_image ','product_image.product_id = product.id','left')
            ->join('category c1', 'c1.id= varient.category_id', 'left')
            ->join('subcategory c2', 'c2.id=varient.subcat_id', 'left')
             ->join('product', 'product.id= varient.adding_to_id', 'left')
            ->where(['product.status' => 1,'product.show_user'=>1 ,'varient.id' => $varient_id])
            ->get('varient')
            ->row_array();

    }
      public function get_related_varient($category_id,$user_id,$varient_id)
    {
       
         $querywishlist =  "(select id  from wishlist where user_id = '".$user_id."' AND wishlist.varient_id = varient.id limit 1)";
        $is_wishlist = "IF($querywishlist > 0,1,0) as is_wishlist";
        $product_array=array();
        $product_data= $this->db->select("varient.id as vid,ap1.product_name_english,ap1.product_name_hindi,varient.mrp,FORMAT(if(((varient.mrp IS NOT NULL) and (varient.price IS NOT NULL)),
                                    (((varient.mrp-varient.price)/varient.mrp)*100)
                                    ,0
                                ) ,2) as discount,,$is_wishlist,varient.price
                                ")
            ->join('add_product ap1', 'ap1.id = varient.product_name_hindi_id', 'left')
            ->join('add_product ap2', 'ap2.id = varient.product_name_english_id', 'left')
             ->join('product', 'product.id= varient.adding_to_id', 'left')
            ->where(['product.status' => 1,'product.show_user'=>1, 'varient.category_id' => $category_id,'varient.id!='=>$varient_id])->order_by('varient.id','DESC')->limit(5)
            ->get('varient')
            ->result_array();
          foreach($product_data as $p){
              $after_dis=(($p['mrp']*$p['discount'])/100);
              $after_discount_price=$p['mrp']-$after_dis;
              //print_r($after_dis);exit;
              $product_image= $this->varient_image($p['vid']);
              $product_array[]=array(
                        'varient_id'=>$p['vid'],
                        'varient_name_english'=>$p['product_name_english'],
                         'varient_name_hindi'=>$p['product_name_hindi'],
                        'image'=>isset($product_image->image)?$product_image->image:"",
                        'mrp'=>$p['mrp'],
                        'discount'=>$p['discount'],
                        'price'=>$p['price'],//$after_discount_price,
                       'is_wishlist'=>$p['is_wishlist']
              );
          }
          return $product_array;
    }
     public function get_search_varient($user_id,$type)
    {
        $querywishlist =  "(select id  from wishlist where user_id = '".$user_id."' AND wishlist.varient_id =varient.id limit 1)";
        $is_wishlist = "IF($querywishlist > 0,1,0) as is_wishlist";
        $product_array=array();
        $this->db->select("search_history.varient_id,ap1.product_name_english as name,ap1.product_name_hindi,varient.mrp,
        FORMAT(if(((varient.mrp IS NOT NULL) and (varient.price IS NOT NULL)),
                                    (((varient.mrp-varient.price)/varient.mrp)*100)
                                    ,0
                                ) ,2) as discount,$is_wishlist,search_history.type
                                ")
            ->join('varient', 'varient.id = search_history.varient_id', 'left')
            ->join('add_product ap1', 'ap1.id = varient.product_name_hindi_id', 'left')
            ->join('add_product ap2', 'ap2.id = varient.product_name_english_id', 'left')
            ->join('product', 'product.id = varient.adding_to_id', 'left')
            ->where(['product.status' => 1, 'product.show_user' => 1,'search_history.user_id' => $user_id,'search_history.type'=>'varient'])->order_by('search_history.id','DESC');
             if($type=="")
            $this->db->limit(5);
           $product_data= $this->db->group_by('search_history.varient_id')->get('search_history')->result_array();
              //echo $this->db->last_query();die();
          foreach($product_data as $p){
                $after_dis=(($p['mrp']*$p['discount'])/100);
              $after_discount_price=$p['mrp']-$after_dis;
              $product_image= $this->varient_image_all($p['varient_id']);
              $product_array[]=array(
                        'varient_id'=>$p['varient_id'],
                        'varient_name_english'=>$p['name'],
                        'varient_name_hindi'=>$p['product_name_hindi'],
                        'image'=>isset($product_image->image)?$product_image->image:"",
                        'mrp'=>$p['mrp'],
                        'discount'=>$p['discount'],
                        'price'=>$p['price'],//$after_discount_price,
                       'is_wishlist'=>$p['is_wishlist'],
                       'type'=>$p['type'],
              );
          }
          return $product_array;
    }
     public function add_cart_in_db($user_id,$type)
        {
        if($type=='product')
        {
            $product_id=$this->input->post('product_id');
            $return_cart_status=array();
            $vendor_id =get_vendor_id_product_wise($product_id);
            $array=array('user_id'=>$user_id,'product_id'=>$product_id,'vendor_id'=>$vendor_id,'type'=>$type);
            $cart_data=$this->db->where($array)->get('cart')->row();
                if($cart_data==0)
                {
                $insert_array=array(
                'user_id'=>$user_id,
                'product_id'=>$product_id,
                'vendor_id'=>$vendor_id,
                'type'=>$type,
                );
            $this->db->insert('cart',$insert_array);
            $x=$this->db->insert_id();
                if($this->db->affected_rows() == true) 
                {
                $return_cart_status['status']=1;  
                $return_cart_status['data']=$x;  
                }
                }
                else
                {
                $return_cart_status['status']=2;   
                }
            return  $return_cart_status;
        }
         else
        {
            $varient_id=$this->input->post('varient_id');
            $return_cart_status=array();
            $vendor_id = get_vendor_id_varient_wise($varient_id);
            $array=array('user_id'=>$user_id,'varient_id'=>$varient_id,'vendor_id'=>$vendor_id,'type'=>$type);
            $cart_data=$this->db->where($array)->get('cart')->row();
                if($cart_data==0)
                {
                $insert_array=array(
                'user_id'=>$user_id,
                'varient_id'=>$varient_id,
                'vendor_id'=>$vendor_id,
                 'type'=>$type,
                );
                $this->db->insert('cart',$insert_array);
                $x=$this->db->insert_id();
                if($this->db->affected_rows() == true) 
                {
                $return_cart_status['status']=1;  
                $return_cart_status['data']=$x;  
                }
                }
                else
                {
                $return_cart_status['status']=2;   
                }
            return  $return_cart_status;
        }
        }
        public function add_wishlist($user_id,$type){
            $userdata=array();
            if($type=='product'){
            $product_id = $this->input->post("product_id");
            $insertdata['product_id']=$product_id;
            }
            else{
            $varient_id = $this->input->post("varient_id");
            $insertdata['varient_id']=$varient_id;
            }
            $insertdata['user_id']=$user_id;
            $insertdata['type']=$type;
            $check = $this->db->where($insertdata)->get("wishlist")->num_rows();
            if($check<1)
            {
                $this->db->insert("wishlist",$insertdata);
                $userdata['status']=1;
              
            }
            else{
                $userdata['status']=2;
            }
            return $userdata;
        }
        public function remove_wishlist($user_id,$type)
        {
           if($type=='product'){
            $product_id = $this->input->post("product_id");
            $remove_wishlist['product_id']=$product_id;
            }
            else{
            $varient_id = $this->input->post("varient_id");
            $remove_wishlist['varient_id']=$varient_id;
            }
            $remove_wishlist['user_id']=$user_id;
            $remove_wishlist['type']=$type; 
            $this->db->where($remove_wishlist);
           $this->db->delete('wishlist');
             return  $this->db->affected_rows(); 
        }
         public function get_product_from_wishlist($user_id)
        {
              $product_data=array();
        $querycart =  "(select id  from cart where user_id = '".$user_id."' AND cart.product_id = product.id AND status!=2 limit 1)";
        $cart_status = "IF($querycart > 0,1,0) as is_cart";
        $response= $this->db->select("
        FORMAT(if(((product.mrp IS NOT NULL) and (product.price IS NOT NULL)),
                                    (((product.mrp-product.price)/product.mrp)*100)
                                    ,0
                                ) ,2) as discount,$cart_status,wishlist.type,
        product.id,
        ifnull(product.mrp,0) as mrp,
        ifnull(product.price,0) as selling_price,
        ap1.product_name_hindi,
        ap1.product_name_english")
        ->join('product','product.id=wishlist.product_id','left')
        ->join('vendor','vendor.id=product.vendor_id','left')
        ->join('add_product ap1', 'ap1.id = product.product_name_hindi_id', 'left')
        ->join('add_product ap2', 'ap2.id = product.product_name_english_id', 'left')
        ->where(['wishlist.user_id'=>$user_id,'product.status'=>1,'product.show_user'=>1,'wishlist.type'=>'product','vendor.status'=>1,'vendor.is_block'=>0])->order_by('wishlist.id')->get('wishlist')->result();
            foreach($response as $row)
            {
            $image_data = $this->AM->product_image($row->id);
            $product_data[]=array(
            'id'=>$row->id,
            'product_name_hindi'=>$row->product_name_hindi,
            'product_name_english'=>$row->product_name_english,
            'mrp'=>$row->mrp,
            'price'=>$row->selling_price,
            'image'=>$image_data->image,
            'cart_status'=>$row->is_cart,
             'type'=>$row->type,
            );
            }
            return $product_data;
        }
        public function get_varient_from_wishlist($user_id)
        {
            $product_data=array();
        $querycart =  "(select id  from cart where user_id = '".$user_id."' AND cart.varient_id = varient.id AND status!=2 limit 1)";
        $cart_status = "IF($querycart > 0,1,0) as is_cart";
        $response= $this->db->select("
        FORMAT(if(((varient.mrp IS NOT NULL) and (varient.price IS NOT NULL)),
                                    (((varient.mrp-varient.price)/varient.mrp)*100)
                                    ,0
                                ) ,2) as discount,$cart_status,wishlist.type,
        varient.id,
        ifnull(varient.mrp,0) as mrp,
        ifnull(varient.price,0) as selling_price,
        ap1.product_name_hindi,
        ap1.product_name_english")
        ->join('varient','varient.id=wishlist.varient_id','left')
        ->join('add_product ap1', 'ap1.id = varient.product_name_hindi_id', 'left')
        ->join('add_product ap2', 'ap2.id = varient.product_name_english_id', 'left')
         ->join('product', 'product.id = varient.adding_to_id', 'left')
          ->join('vendor', 'vendor.id = product.vendor_id', 'left')
        ->where(['wishlist.user_id'=>$user_id,'varient.status!='=>2,'product.show_user'=>1,'wishlist.type'=>'varient','vendor.status'=>1,'vendor.is_block'=>0])->order_by('wishlist.id')->get('wishlist')->result();
         foreach($response as $row)
            {
            $image_data = $this->AM->varient_image($row->id);
            $product_data[]=array(
            'id'=>$row->id,
            'product_name_hindi'=>$row->product_name_hindi,
            'product_name_english'=>$row->product_name_english,
            'mrp'=>$row->mrp,
            'price'=>$row->selling_price,
            'image'=>$image_data->image,
            'cart_status'=>$row->is_cart,
              'type'=>$row->type,
            );
            }
            return $product_data;
        }
}
?>