<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Api_Model","AM");   
    }
public function register() 
{
    $data=array();
    $this->form_validation->set_rules('name', 'Name', 'required|trim');
    $this->form_validation->set_rules('mobile', 'Mobile',  'callback_varify_phone|required');
    $this->form_validation->set_rules('email', 'Email',  'callback_varify_email|required');
    $this->form_validation->set_rules('state', 'State_Id', 'required|trim');
    $this->form_validation->set_rules('district', 'District_Id', 'required|trim');
    $this->form_validation->set_rules('tahsil', 'Tahsil', 'required|trim');
    $this->form_validation->set_rules('password', 'Password', 'required|trim');
    $this->form_validation->set_rules('pincode', 'Pincode', 'required|trim');
       if($this->form_validation->run() == FALSE) 
            {
              $data["status"] = false;
              $data["message"] = strip_tags($this->form_validation->error_string());
            }
            else 
            {
    
        $data=array();
        $array=array(
            'name'=>$this->input->post('name'),
            'mobile'=>$this->input->post('mobile'),
            'email'=>isset($_POST['email'])?$_POST['email']:"",
            'state'=>$this->input->post('state'),
            'district'=>$this->input->post('district'),
            'tahsil'=>$this->input->post('tahsil'),
            'pincode'=>$this->input->post('pincode'),
            'password'=>md5($this->input->post('password')),

            'status'=>1
                );
                $user_id="";

         $data = $this->gen_otp($user_id,$this->input->post("mobile"),'r');
        // $array['otp']=$data;
          $data['data'] = $array;
          
      
   
}
 
     echo json_encode($data);
  
}
 public function gen_otp($id,$phone,$type)
{
        $data = array();
        $response = array();
       
            $otp = ($this->input->post('otp'))?$this->input->post('otp'):rand(100000, 999999);
            $phone = $this->input->post('mobile');
            $check_otp = $this->db->where('mobile',$phone)->select('*')->get('tblotp')->num_rows();

                if($check_otp > 0)
                {
                    $data2['otp']=$otp;
                    $data2['mobile']=$phone;
                    $data2['user_id']='';
                    $data2['type']=$type;
                    $this->db->where('mobile', $phone);
                    $q2= $this->db->update('tblotp', $data2);
               
                }
                else
                {  
                    $id="";
                    $array=array('otp'=>$otp,
                    'user_id'=>$id,
                    'type'=>$type,
                    'mobile'=>$phone
                    );
                    $q2 = $this->db->insert('tblotp',$array);
                    // echo $this->db->last_query();die();
                }
                
              if($q2)
                {
                    $data['status'] = true;
                    $data['otp'] = $otp;
                    $data["message"] = 'Otp send successfully';
                    
                }
                else
                {
                    
                     $data['status'] = false;
                    $data["message"] = 'Something went wrong';
                }
                            
                        
                    return  $data  ; 
           //  return $this->response($data, REST_Controller::HTTP_OK);
  
}
  public function varify_phone()
{
    
     $user_phone = $this->input->post('mobile');
     $id = $this->input->post('user_id');
          if($id)
          {
              $this->db->where('id!=',$id);
          }
    $rs = $this->db->where(['mobile'=>$user_phone,'status!='=>2])->get('users')->num_rows();
    
    if($rs==0)
    {
        //return $data['code'] = 'HTTP_OK';
    return TRUE;
    }
    else
    {
        
        $this->form_validation->set_message("varify_phone","Phone Number Is Already Exists");
        // return $data['code'] = 'HTTP_NOT_FOUND';
            return FALSE;
        
    }
    
}
public function varify_email()
{
    
     $email = $this->input->post('email');
       $id = $this->input->post('user_id');
          if($id)
          {
              $this->db->where('id!=',$id);
          }
    $rs2 = $this->db->where(['email'=>$email,'status!='=>2])->get('users')->num_rows();
  
    if($rs2==0)
    {
       
            return TRUE;
    }
    else
    {
    
       $this->form_validation->set_message("varify_email", "Email Already Registered");
      //  return $data['code'] = 'HTTP_NOT_FOUND';
        return FALSE;
        
    }
    
}

public function otp_verification_signup()
{
            $data=array();
            $this->load->library('form_validation');
            $this->form_validation->set_rules('mobile', 'Mobile',  'trim|required');
            $this->form_validation->set_rules('otp', 'OTP',  'trim|required');
            $this->form_validation->set_rules('data', 'Form Data',  'required');
                if ($this->form_validation->run() == FALSE) 
                {
                      $data['status'] = false;
                    $data["error"] =  strip_tags($this->form_validation->error_string());
                 }
                 else
                 {
                    $insrtarray = json_decode($this->input->post('data'));
                    $array=array('otp'=>$this->input->post('otp'),'mobile'=>$this->input->post('mobile'));
                    $x = $this->db->where($array)->get('tblotp');
                     $otp_timedata=$this->db->get('app_setting')->row();
                     $otp_data=$x->row();
                 $date= date("Y-m-d H:i:s",strtotime($otp_data->updated_at	.' +'.$otp_timedata->otp_time.' seconds'));
                $current_date=date("Y-m-d H:i:s");
               
                    
                         if($x->num_rows() > 0 && $date > $current_date)
                         {
                            /*Register Users*/
                            
                          $x=  $this->db->insert("users",$insrtarray);
                             //echo $this->db->last_query();die();
                           $user_id = $this->db->insert_id();
                           
                        $data["message"] = "User registered successfully";
                         $data['status'] = true;
                         }
                         else
                         {
                            $data["message"] = "Invalid otp";
                           $data['status'] = false;
                            $data['data'] = $insrtarray;
                         }
                  
                 }
     echo json_encode($data);
  
}

public function login() 
{
    $data=array();
      $this->form_validation->set_rules('mobile', 'Mobile', 'required|trim');
      $this->form_validation->set_rules('password', 'Password', 'required|trim');
     
    if($this->form_validation->run() == TRUE){
       $userdata = $this->AM->login_get();
  //echo $this->db->last_query();die();
            if ($userdata['login_status'] == 1 ){

             $data['status'] = true;
            $data['message']='Login successfully';
            $data['data']=$userdata;
            }
            else if($userdata['login_status'] == 0)
            {

           $data['status'] = false;
            $data['message']= 'User does not exists'; 

            }
            else if($userdata['login_status'] == 2){

               $data['status'] = false;
                $data['message']= 'Your account is inactive'; 
    
                }
            else if($userdata['login_status'] == 3)
            {

            $data['status'] = false;
            $data['message']='Invalid password';

            }  
        }
    else
    {
     
        $data['status'] = false;
          $data['message'] = strip_tags($this->form_validation->error_string());
          
    }
  
       echo json_encode($data);
  
}
	public function get_policy()
    {   
        $data = array();
        $type=$this->input->post('type');
        
        $result_data = $this->db->select('privacy_policy,term_condition')->where('status',1)->get('privacy_policy')->row();
       if($type=='1')
       {
           $result=array('privacy_policy'=>$result_data->privacy_policy);
       }
       elseif($type=='2')
       {
         $result=  array('term_condition'=>$result_data->term_condition);
        
       }
       else
       {
           $result=$result_data;
       }
     //  print_r($result);exit;
        if(!empty($result))
        {
            $data['data'] = $result;
              $data['status'] = true;
        }
        else
        {
              $data['status'] = false;
            $data['data'] = array();
        }
         
        echo json_encode($data);
    }
    
public function forgot_password_otp()
{
    $data=array();
     $data = array();
            $this->load->library('form_validation');
            $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
            if ($this->form_validation->run() == FALSE) 
            {
              $data["status"] = false;
              $data["error"] = strip_tags($this->form_validation->error_string());
            }
            else
            {
                
            //$data["response"] = true;
            $mobile=$this->input->post("mobile");
            $type='f';
            $user_data=$this->db->where('mobile',$mobile)->get('users')->row();
             $user_data_count=$this->db->where('mobile',$mobile)->get('users')->num_rows();
            if($user_data_count>0)
            {
              $result = $this->gen_otp($user_data->user_id,$mobile,$type) ;
              
             //print_r($result=array('otp'=>$result['otp']));exit;
               $data['data'] = $result;
              $data['status'] = true; 
            }
            else
            {
                 
                $data['message'] = 'Phone number does not exists.';
                $data['status'] = false; 
            }
           
             
            }
            echo json_encode($data);
}
	
	
 public function forgot_password_verifyotp() 
  {

        $this->form_validation->set_rules('mobile', 'Mobile', 'required|trim');
        $this->form_validation->set_rules('otp', 'Otp', 'required|trim');
                if($this->form_validation->run() == TRUE){
                $userdata = $this->AM->verify_otp();
                
                if ($userdata['status']==1){
                
                $data['status'] = true;
                $data['message']='Otp verify successfully';
                $data['data']=$userdata;
                }
                else if($userdata['status']==0)
                {
                $data['status'] = false;
                $data['message']='Invalid otp';
                $data['data']=array();  
                }
                else if($userdata['status']==2)
                {
                $data['status'] = false;
                $data['message']='Phone number does not exists';
                $data['data']=array();  
                }
                else if($userdata['status']==3)
                {
               $data['status'] = false;
                $data['message']='Otp expired!';
                $data['data']=array();  
                }
    
      }
      else
      {
       
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
            
      }
    
         echo json_encode($data);
    
  }


  public function reset_password() {
    if(isset($_POST['new_password']) && isset($_POST['confirm_password']) && isset($_POST['mobile'])){
       if($_POST['new_password']== $_POST['confirm_password']){ 
          $updater['password'] = md5($_POST['new_password']);
          $this->db->where('mobile',$this->input->post('mobile'))->or_where('email',$this->input->post('mobile'));
          $update=$this->db->update('users', $updater);
          if($this->db->affected_rows() == true)
          {
            $data['status'] = true;
              $data['message']='Password reset successfully';
          }
           else
           {
         $data['status'] = false;
            $data['message']='Try with different password';
          }
       }
       else{
         $data['status'] = false;
          $data['message']='Password and confirm password does not match';
    }
    } else{
        $data['status'] = false;
          $data['message'] = 'Parameters missing';
    }
  
       echo json_encode($data);
  
}


public function change_password() 
  {

        $this->form_validation->set_rules('user_id', 'User_Id', 'required|trim');
        $this->form_validation->set_rules('new_password', 'New_Password', 'required|trim');
        $this->form_validation->set_rules('old_password', 'Old_Password', 'required|trim');
                if($this->form_validation->run() == TRUE){
                   
                  $user_id=$this->input->post('user_id');
                  $old_password = $this->input->post('old_password');
                  $new_password =   $this->input->post('new_password');
                   $userdetails=$this->db->where(['id'=>$user_id,'status'=>1])->get('users')->row();
                   $userdetails_count=$this->db->where(['id'=>$user_id,'status'=>1])->get('users')->num_rows();
                    $oldpassword=$userdetails->password;
                    $currentpassword=md5($old_password);
                    if($userdetails_count>0)
                    {
                    if($oldpassword == $currentpassword)
                    {
                    $array6['password']= md5($new_password);
                    $userdata1=$this->db->update("users",$array6,array("id"=>$user_id));
                    if($this->db->affected_rows() == true)
                    {
                    $data['status'] = true;
                    $data['message']='Password changed successfully.'; 
                    }
                    else
                    {
                    $data['status'] = false;
                      $data['message']='Try with different password';
                    }
                    
                    }
                    else
                    {
                     $data['status'] = false;
                    $data['message']='Old password does not match';
                   
                    
                    }
                    }
                    else
                    {
                     $data['status'] = false;
                    $data['message']='User does not exists'; 
                    }
 
      }
      else
      {
       
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
            
      }
    
         echo json_encode($data);
    
  }
  
 

public function update_profile_image() 
{
    $data=array();
    
    $this->form_validation->set_rules('user_id', 'User_Id', 'required|trim');
       if($this->form_validation->run() == FALSE) 
            {
              $data["status"] = false;
              $data["message"] = strip_tags($this->form_validation->error_string());
            }
            else 
            {
                $user_id=$this->input->post('user_id');
                $files =$_POST['profile_image'];
                                //assets/images/profile_image
                $upload_path = 'assets/images/profile_image/';
                $array['image'] =  $this->AM->set_upload_files($upload_path ,$files,'png');
                $userdata=   $this->db->where('id',$user_id)->update("users",$array);
                if($userdata)
                {
                     $user_image=$this->db->where('id',$user_id)->get('users')->row();
                $data['status'] = true;
                $data['message']='Profile image updated successfully.';   
                $data['image_link']=isset($user_image->image)?$user_image->image:"";
                }
                else
                {
                $data['status'] = false;
                $data['message']='Unable to update profile image';
                }

          
      
   
}
 
     echo json_encode($data);
  
}
        public function update_personal_details() 
        {
        $data=array();
        $this->form_validation->set_rules('user_id', 'User_Id', 'required|trim');
        if($this->form_validation->run() == FALSE) 
        {
        $data["status"] = false;
        $data["message"] = strip_tags($this->form_validation->error_string());
        }
        else 
        {
        $user_id=$this->input->post('user_id');
        $userdata=$this->db->where('id',$user_id)->get('users')->row();
        $data=array();
        $array=array(
        'name'=>isset($_POST['name'])?$_POST['name']:$userdata->name,
        // 'mobile'=>isset($_POST['mobile'])?$_POST['mobile']:$userdata->mobile,
        'email'=>isset($_POST['email'])?$_POST['email']:$userdata->email,
        'state'=>isset($_POST['state'])?$_POST['state']:$userdata->state,
        'district'=>isset($_POST['district'])?$_POST['district']:$userdata->district,
        'tahsil'=>isset($_POST['tahsil'])?$_POST['tahsil']:$userdata->tahsil,
        'pincode'=>isset($_POST['pincode'])?$_POST['pincode']:$userdata->pincode,
        );
        $user= $this->db->where('id',$user_id)->update('users',$array);
        if($user)
        {
        $data['status'] = true;
        $data['message']='Profile  updated successfully.';   
        }
        else
        {
        $data['status'] = false;
        $data['message']="You have not changed anything.";
        }
        }
        echo json_encode($data);
        }
	
	
	
        public function add_cart() 
        {
        $data=array();
        $user_id= $this->input->post('user_id');
        $type= $this->input->post('type');
        $this->form_validation->set_rules('user_id', 'User_Id', 'required|trim');
        $this->form_validation->set_rules('type', 'Type', 'required|trim');
        if($type=='product'){
        $this->form_validation->set_rules('product_id', 'Product_Id', 'required|trim');
        }else{
        $this->form_validation->set_rules('varient_id', 'Varient_Id', 'required|trim');
        }
        if($this->form_validation->run() == FALSE) 
        {
        $data["status"] = false;
        $data["message"] = strip_tags($this->form_validation->error_string());
        }
        else 
        {
        $return_cart_status=   $this->AM->add_cart_in_db($user_id,$type);
       // echo $this->db->last_query();die();
        if($return_cart_status['status']==1)
        {
        $data['status'] = true;
        $data['cart_id'] = $return_cart_status['data'];
        $data['message']=($type=='product')?"Product added in cart":"Varient added in cart";   
        }
        elseif($return_cart_status['status']==2)
        {
        $data['status'] = false;
        $data['message']=($type=='product')?"Product already added in cart":"Varient already added in cart";   
        }
        
        else
        {
        $data['status'] = false;
        $data['message']='Unable to add product';
        }
        }
        echo json_encode($data);
        }


	
 public function send_enquiry_by_cart_item() 
            {
            $data=array();
            $user_id= $this->input->post('user_id');
            $user_msg=$this->input->post('user_msg');
            $vendor_id=$this->input->post('vendor_id');
          //  $type=$this->input->post('type');
            $this->form_validation->set_rules('user_id', 'User_Id', 'required|trim');
            $this->form_validation->set_rules('user_msg', 'User_Msg', 'required|trim');
            $this->form_validation->set_rules('vendor_id', 'Vendor_Id', 'required|trim');
           // $this->form_validation->set_rules('type', 'Type', 'required|trim');
            if($this->form_validation->run() == FALSE) 
            {
            $data["status"] = false;
            $data["message"] = strip_tags($this->form_validation->error_string());
            }
            else 
            {
            $data_status= $this->AM->place_enquiry($user_id,$user_msg,$vendor_id);
            if($data_status['status']==1)
            {
            $data['status'] = true;
            $data['message']='Enquiry added successfully';   
            }
            elseif($data_status['status']==2)
            {
            $data['status'] = false;
            $data['message']='Your cart is empty!';   
            }
            else
            {
            $data['status'] = false;
            $data['message']='Unable to add enquiry';
            }
            }
            echo json_encode($data);
            }



	public function send_general_or_admin_enquiry() 
{
    $data=array();
     
        $this->form_validation->set_rules('user_id', 'User_Id', 'required|trim');
        $this->form_validation->set_rules('user_msg', 'User_Msg', 'required|trim');
        $this->form_validation->set_rules('vendor_id', 'Vendor_Id', 'required|trim');
        $this->form_validation->set_rules('issue_type', 'issue_type', 'required|trim');
          if($this->input->post('type')=='general')
         {
              $this->form_validation->set_rules('product_id', 'Product_Id', 'required|trim');
         }
        
       if($this->form_validation->run() == FALSE) 
            {
              $data["status"] = false;
              $data["message"] = strip_tags($this->form_validation->error_string());
            }
            else 
            {
                $data_status=   $this->AM->send_enquiry();
                //echo $this->db->last_query();die();
                if($data_status==1)
                {
                $data['status'] = true;
                $data['message']='Enquiry send successfully';   
                }
                else
                {
                $data['status'] = false;
                $data['message']='Unable to send enquiry';
                }

}
 
     echo json_encode($data);
  
}


            public function remove_product_from_cart() 
            {
            $data=array();
            $user_id=$this->input->post('user_id');
            $cart_id=$this->input->post('cart_id');
            $type=$this->input->post('type');
            $this->form_validation->set_rules('user_id', 'User_Id', 'required|trim');
            $this->form_validation->set_rules('cart_id', 'Cart_Id', 'required|trim');
            if($type=='product'){
            $this->form_validation->set_rules('product_id', 'Product_Id', 'required|trim');
            }else{
            $this->form_validation->set_rules('varient_id', 'Varient_Id', 'required|trim');
            }
            if($this->form_validation->run() == FALSE) 
            {
            $data["status"] = false;
            $data["message"] = strip_tags($this->form_validation->error_string());
            }
            else 
            {
            $data_status=   $this->AM->remove_product_from_cart($user_id,$cart_id,$type);
            if($data_status==1)
            {
            $data['status'] = true;
            $data['message']='Item remove successfully';   
            }
            else
            {
            $data['status'] = false;
            $data['message']='Unable to remove item';
            }
            }
            echo json_encode($data);
            }

   public function get_home_data(){
        $user_id=$this->input->post('user_id');
        $data=array();   
        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
        if ($this->form_validation->run() == true) {
            $data = array();
        $slider_data = $this->db->select('id,url,image as link')->where(['status'=>1,'type'=>1,'share_status!='=>3])->limit(7)->get('slider_and_banner')->result();
        $banner_data = $this->db->select('id,url,image as link')->where(['status'=>1,'type'=>2,'share_status!='=>3])->limit(7)->get('slider_and_banner')->result();
        $testimonial_data = $this->db->select('id,name,image,description')->where(['status'=>1])->get('testimonial')->result();
          $category = $this->db->select('id,name,name_hindi,ifnull(image,"") as image')->get_where('category', ['status' => 1])->result_array();
        //start notification code
        $notification_data=$this->db->select("id,msg,DATE_FORMAT(created_at,'%d-%m-%y | %H:%i %p') as date_time ")->where(['status'=>1,'share_status!='=>3])->order_by('id','DESC')->limit(5)->get('notification')->result();
        $user_notification_count = get_home_user_notifiction_count($user_id);
        $notification_count = $user_notification_count;
        $notification=array('notification_count'=>$user_notification_count,'notification'=>$notification_data);
         //end notification code
       $top_product=   $this->AM->get_top_product($user_id,"");
        $new_product=   $this->AM->get_new_product($user_id,"");
        
           foreach($new_product as $p){
          
               
                $after_dis=(($p['mrp']*$p['discount'])/100);
              $after_discount_price=$p['mrp']-$after_dis;
              $new_product_array[]=array(
                        'product_id'=>$p['product_id'],
                        'vendor_id'=>$p['vendor_id'],
                        
                        
                          'v_status'=>$p['v_status'],
                        'is_block'=>$p['is_block'],
                        
                        
                        
                        'product_name_english'=>$p['product_name_english'],
                         'product_name_hindi'=>$p['product_name_hindi'],
                        'image'=>isset($p['image'])?$p['image']:"",
                        'mrp'=>$p['mrp'],
                        'discount'=>$p['discount'],
                        'price'=>$p['price'],//$after_discount_price,
                       'is_wishlist'=>$p['is_wishlist']
              );
          }
          
           foreach($top_product as $p){
                $after_dis=(($p['mrp']*$p['discount'])/100);
              $after_discount_price=$p['mrp']-$after_dis;
              $top_product_array[]=array(
                        'product_id'=>$p['product_id'],
                        
                        
                        
                         'v_status'=>$p['v_status'],
                          'is_block'=>$p['is_block'],
                        
                        'product_name_english'=>$p['product_name_english'],
                         'product_name_hindi'=>$p['product_name_hindi'],
                        'image'=>isset($p['image'])?$p['image']:"",
                        'mrp'=>$p['mrp'],
                        'discount'=>$p['discount'],
                        'price'=>$p['price'],//$after_discount_price,
                       'is_wishlist'=>$p['is_wishlist']
              );
          }
        //print_r($new_product);exit;
 //echo $this->db->last_query();die();
        //$social_media=array('facebook'=>$admin_data->facebook,'twitter'=>$admin_data->twitter,'linked'=>$admin_data->linked,'university_link'=>$admin_data->instagram);
         if(!empty($slider_data) || !empty($banner_data) || !empty($category) || !empty($testimonial_data) || !empty($notification) || !empty($top_product) || !empty($new_product))
         {
        $res[]=array(
        'banner'=>$banner_data,
        'slider'=> $slider_data,
        'category'=>$category,
        'testimonial_data'=>$testimonial_data,
         'notification'=>$notification,
         'top_product'=> ($top_product_array !=null)?$top_product_array:array(),
         'new_product'=>($new_product_array != null)?$new_product_array:array(),
        );
        // print_r($res);exit;
         $data['status']=true;
         $data['data']=  $res;
       }else{
         $data['status']=false;
         $data['data']=array();
       }
        }else{
        $data['status'] = false;
        $data['message'] = strip_tags($this->form_validation->error_string());
       
    }
     echo json_encode($data,JSON_UNESCAPED_UNICODE);
    
    }

            public function get_enquiry(){
            $user_id = $this->input->post('user_id');
            $array=array();
            $enquiry_data=array();
            $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
            if($this->form_validation->run() == true) {
            $data = array();
            $x = $this->AM->get_enquiry_with_order_id($user_id);
            $y = $this->AM->get_enquiry_without_order_id($user_id);
            $response=array_merge($x,$y);
            if(!empty($response)){
            foreach($response as $row)
            {
            $type='enquiry';
            $get_varient_data = $this->AM->get_all_varient($user_id,$type,$row->order_id,$row->enquiry_type,$row->enquiry_id,'varient');
            $get_product_data = $this->AM->get_all_product($user_id,$type,$row->order_id,$row->enquiry_type,$row->enquiry_id,'product');
            if($row->type==''){
               $product_data=$get_product_data;
            }else{
              $product_data=array_merge($get_product_data,$get_varient_data);  
            }
            if($row->enquiry_type=='admin'){
            $seller_comment=isset($row->admin_msg)?$row->admin_msg:"";
            }else{
            $seller_comment=isset($row->vendor_msg)?$row->vendor_msg:"";
            }
            $enquiry_data[]=array(
            'enquiry_id'=>$row->enquiry_id,
            'order_id'=>$row->order_id,
            'vendor_id'=>$row->vendor_id,
            'name'=>$row->name,
            'mobile'=>$row->mobile,
            'email'=>$row->email,
            'image'=>$row->image,
            'status'=>$row->status,
            'enquiry_type'=>$row->enquiry_type,
            'commenttype'=>isset($row->issue_type)?$row->issue_type:"",
            'my_comment'=>isset($row->user_msg)?$row->user_msg:"",
            'user_image'=>isset($row->user_image)?$row->user_image:"",
            'seller_comment'=>$seller_comment,
            'product'=>!empty($product_data)?$product_data:array(),
            );
            }
            $data['status'] = true;
            $data['data']=$enquiry_data;
            }else{
            $data['status'] = false;
            $data['data']=array();
            $data['message']='Data not found';
            }
            }else{
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string()); 
            }
            echo json_encode($data,JSON_UNESCAPED_UNICODE); 
            }

            public function get_cart_list(){
            $user_id = $this->input->post('user_id');
            $array=array();
            $enquiry_data=array();
            $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
            if($this->form_validation->run() == true) {
            $data = array();
            $response = $this->AM->get_vendor_from_cart_for_varient($user_id);
            if(!empty($response)  ){
                foreach($response as $row)
                {
                $product_data = $this->AM->get_product_from_cart($row->vendor_id,$user_id);
               //  echo $this->db->last_query();exit;
                $varient_data = $this->AM->get_varient_from_cart($row->vendor_id,$user_id);
                $product_and_varient_data=array_merge($product_data,$varient_data);
                
                $enquiry_data[]=array(
                'vendor_id'=>$row->vendor_id,
                'seller_name'=>$row->name,
                'seller_mobile'=>$row->mobile,
                'seller_email'=>$row->email,
                'seller_image'=>$row->image,
                'product_data'=>$product_and_varient_data,
                );
            }
            $data['status'] = true;
            $data['data']=$enquiry_data;
            }else{
            $data['status'] = false;
            $data['data']=array();
            }
            }else{
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string()); 
            }
            echo json_encode($data,JSON_UNESCAPED_UNICODE); 
            }
    
    //1 -dec-2022 created_by mahek
        public function add_wishlist()
        {
        
        $data = array();
        $insertdata = array();
        $type=$this->input->post('type');
        $user_id=$this->input->post('user_id');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('type', 'Type',  'trim|required');
        if($type=='product'){
        $this->form_validation->set_rules('product_id', 'Product Id',  'trim|required');
        }else{
        $this->form_validation->set_rules('varient_id', 'Varient_Id',  'trim|required');
        }
        $this->form_validation->set_rules('user_id', 'User Id',  'trim|required');
        if ($this->form_validation->run() == FALSE) 
        {
        $data["status"] = false;
        $data["error"] =  strip_tags($this->form_validation->error_string());
        } 
        else
        {
        $return_cart_status=   $this->AM->add_wishlist($user_id,$type);
            if($return_cart_status['status']==1){
            $data["status"] = true;
            $data["message"] = "This item is successfully added to your wishlist.";
            }
            elseif($return_cart_status['status']==2)
            {
            $data["status"] = false;
            $data["error"] =  "Already in wishlist";
            } 
            else{
            $data["status"] = false;
            $data["error"] =  "Unable to add product in wishlist";
            }  
        }
        echo json_encode($data);         
        }        
                   
      public function remove_wishlist()
          {
        $data = array();
        $remove_wishlist = array();
        $type=$this->input->post('type');
        $user_id=$this->input->post('user_id');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('type', 'Type',  'trim|required');
        if($type=='product'){
        $this->form_validation->set_rules('product_id', 'Product Id',  'trim|required');
        }else{
        $this->form_validation->set_rules('varient_id', 'Varient_Id',  'trim|required');
        }
        if ($this->form_validation->run() == FALSE) 
        {
            $data["status"] = false;
            $data["error"] =  strip_tags($this->form_validation->error_string());
        } 
        else
        {
            $wishlist_status=   $this->AM->remove_wishlist($user_id,$type);
            if($wishlist_status)
            {
                $data["status"] = true;
                $data["message"] = "Item removed from wishlist successfully.";
            }
            else
            {
                $data["status"] = false;
                $data["error"] =  "Unable to remove item from wishlist";
            }  
        }
        echo json_encode($data);         
    } 
        public function get_wish_list(){
        $user_id = $this->input->post('user_id');
        $array=array();
        $enquiry_data=array();
        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
        if ($this->form_validation->run() == true) {
        $data = array();
        $x = $this->AM->get_product_from_wishlist($user_id);
        $y = $this->AM->get_varient_from_wishlist($user_id);
        $response=array_merge($x,$y);
     //   print_r($response);exit;
        if(!empty($response)){
        $data['status'] = true;
        $data['data']=$response;
        }else{
        $data['status'] = false;
        $data['data']=array();
        }
        }else{
        $data['status'] = false;
        $data['message'] = strip_tags($this->form_validation->error_string()); 
        }
        echo json_encode($data,JSON_UNESCAPED_UNICODE); 
        }
    //new api created by mahek on 13 jan 2023
    public function get_sub_category()
    {
        $this->form_validation->set_rules('category_id', 'category_id', 'trim|required');
        if ($this->form_validation->run() == true) {
            $cat_id = $this->input->post('category_id');
            // $cat_id = $cat_id ? $cat_id : 1;
            $sub_category = $this->db->select('id,name,name_hindi,image')->get_where('subcategory', ['status' => 1, 'parent_id' => $cat_id])->result_array();
            $data = array();
            if (!empty($sub_category)) {
                $data['status'] = true;
                $data['data'] = $sub_category;
            } else {
                $data['status'] = false;
                $data['message'] = "Sub category doesn't exists";
            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
     public function get_product_by_sub_category()
    {
        $this->form_validation->set_rules('sub_category_id', 'sub_category_id', 'trim|required');
       $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
        if ($this->form_validation->run() == true) {
            $sub_category_id = $this->input->post('sub_category_id');
            $res=array();
            $res_data=array();
            $user_id = $this->input->post('user_id');
            $sub_category_data = $this->AM->get_product_by_subcategory($sub_category_id,$user_id);
            $data = array();
            if (!empty($sub_category_data)) {
            foreach($sub_category_data as $d){
            $product_image=$this->AM->product_image($d['product_id']);
            $res_data[]=array(
            'product_id'=>$d['product_id'],
            'product_name_hindi'=>$d['product_name_hindi'],
            'product_name_english'=>$d['product_name_english'],
            'mrp'=>$d['mrp']?$d['mrp']:0,
            'price'=>$d['price'],//$after_discount_price?$after_discount_price:0,
            'discount'=>$d['discount'],
            'is_wishlist'=>$d['is_wishlist'],
            'image'=>$product_image->image,
     );
            }
                $data['status'] = true;
                $data['data'] = $res_data;
            } else {
                $data['status'] = false;
                $data['message'] = "Data not found";
            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
   
//new api created on 29-03-2023
 public function get_faq()
    {
            $get_data = $this->AM->get_faq();
            $data = array();
            if (!empty($get_data)) {
                $data['status'] = true;
                $data['data'] = $get_data;
            } else {
                $data['status'] = false;
                $data['message'] = "Data not found";
            }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
     public function get_news_event()
    {
            $type = $this->input->post('type');
        $this->form_validation->set_rules('type', 'Type', 'trim|required');
        if ($this->form_validation->run() == true) {
            $news_event_data = $this->AM->get_news_event($type);
            $data = array();
            if (!empty($news_event_data)) {
                $data['status'] = true;
                $data['data'] = $news_event_data;
            } else {
                $data['status'] = false;
                $data['message'] = "Data not found";
            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
     public function getContactus()
    {
        $data = array();
                $result_data = $this->AM->get_contact_us();
                $admin = $this->AM->get_admin_details();
        if (!empty($result_data) || !empty($admin)) {
            $array[]=array( 
                'contact'=> $result_data,
                'support'=>$admin->email,
                'address'=>$admin->address,
            );
            $data['status'] = true;
            $data['data'] = $array;
           
        } else {
            $data['status'] = false;
            $data['data'] = array();
        }
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }
     public function get_sellers()
    {
        $data = array();
        $result_data = $this->AM->get_sellers();
        if (!empty($result_data )){
            $data['status'] = true;
            $data['data'] = $result_data;
           
        } else {
            $data['status'] = false;
            $data['data'] = array();
        }
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }
    public function get_seller_detail()
    {
        $seller_id=$this->input->post('seller_id');
        $user_id=$this->input->post('user_id');
        $data = array();
        $product_array=array();
        $this->form_validation->set_rules('seller_id', 'Seller_Id', 'trim|required');
         $this->form_validation->set_rules('user_id', 'User_Id', 'trim|required');
        if ($this->form_validation->run() == true) {
        $result_data = $this->AM->get_seller_detail_by_id($seller_id);
        //echo $this->db->last_query();die();
        $product_data=$this->AM->get_seller_product($seller_id,$user_id);
        //print_r($seller_product);exit
         foreach($product_data as $p){
             
               $after_dis=(($p['mrp']*$p['discount'])/100);
              $after_discount_price=$p['mrp']-$after_dis;
              $product_image= $this->AM->product_image($p['product_id']);
               $product_array[]=array(
                        'product_id'=>$p['product_id'],
                        'name'=>$p['name'],
                        'image'=>isset($product_image->image)?$product_image->image:"",
                        'product_name_hindi'=>$p['product_name_hindi'],
                        'mrp'=>$p['mrp'],
                        'discount'=>$p['discount'],
                        'price'=>$p['price'],//$after_discount_price,
                        'is_wishlist'=>$p['is_wishlist'],
                        //'is_wishlist'=>$is_wishlist
               );
           }
        //    $product_array;
        if (!empty($result_data)) {
            $details=array(
                'Shop Name'=>isset($result_data->shop_name)?$result_data->shop_name:"",
                'District'=>isset($result_data->district)?$result_data->district:"",
                'Tehsil'=>isset($result_data->s_tehsil)?$result_data->s_tehsil:"",
                'Village'=>isset($result_data->s_village)?$result_data->s_village:"",
                'Block'=>isset($result_data->s_block)?$result_data->s_block:"",
                'Pincode'=>isset($result_data->s_pincode)?$result_data->s_pincode:"",
                );
                $contact_details=array(
                'MobileNumber'=>$result_data->mobile,
                'EmailID '=>$result_data->email,
                );
            $array[]=array( 
                'id'=> $result_data->id,
                'name'=>$result_data->name,
                'porfile_image'=>isset($result_data->porfile_image)?$result_data->porfile_image:"",
                'details'=>$details,
                'contact_details'=>$contact_details,
                'seller_product'=>$product_array,
            );
            $data['status'] = true;
            $data['data'] = $array;
           
        } else {
            $data['status'] = false;
            $data['data'] = array();
         }
        }
    else{
     $data['status'] = false;
     $data['message'] = strip_tags($this->form_validation->error_string());
    
 }
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }
    public function subscribe()
    {
        $user_id = $this->input->post('user_id');
        $email_id = $this->input->post('email_id');
        $this->form_validation->set_rules('user_id', 'User_Id', 'trim|required');
        $this->form_validation->set_rules('email_id', 'Email_Id', 'trim|required');
        if ($this->form_validation->run() == true) {
            $x = $this->AM->subscribe($user_id,$email_id);
            if ($x==1) {
                $data['status'] = true;
                $data['data'] = 'Subscribed Successfully!';
            } else {
                $data['status'] = false;
                $data['message'] = "Unable to subscribe data";
            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
     public function send_feedback()
    {
        $user_id = $this->input->post('user_id');
       // $product_id = $this->input->post('product_id');
        $rating_value = $this->input->post('rating_value');
        $feedback = $this->input->post('feedback');
        $enquiry_id = $this->input->post('enquiry_id');
        $type = $this->input->post('type');
        $this->form_validation->set_rules('user_id', 'User_Id', 'trim|required');
         $this->form_validation->set_rules('type', 'Type', 'trim|required');
         if($type=='product'){
        $this->form_validation->set_rules('product_id', 'Product_Id', 'trim|required');
         }else{
            $this->form_validation->set_rules('varient_id', 'Varient_Id', 'trim|required'); 
         }
        $this->form_validation->set_rules('rating_value', 'Rating_Value', 'trim|required');
        $this->form_validation->set_rules('feedback', 'Feedback', 'trim|required');
        $this->form_validation->set_rules('enquiry_id', 'Enquiry_Id', 'trim|required');
        if ($this->form_validation->run() == true) {
            $x = $this->AM->send_feedback($user_id,$rating_value,$feedback,$enquiry_id,$type);
          // echo $this->db->last_query();die();
            if ($x==1) {
                $data['status'] = true;
                $data['data'] = 'Feedback send successfully!';
            } else {
                $data['status'] = false;
                $data['message'] = "Unable to send feedback";
            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    public function get_rating_feedback()
    {
     $data = array();
      $user_id = $this->input->post('user_id');
        $this->form_validation->set_rules('user_id', 'User_Id', 'trim|required');
        if ($this->form_validation->run() == true) {
            $x=$this->AM->get_product_rating_feedback($user_id);
            $y=$this->AM->get_varient_rating_feedback($user_id);
            // echo $this->db->last_query();die();
            // print_r($y);exit;
            $rating_feedback=array_merge($x,$y);
    
            //echo $this->db->last_query();die();
            if (!empty($rating_feedback)) {
                $data['status'] = true;
                $data['data'] = $rating_feedback;
            } else {
                $data['status'] = false;
                $data['message'] = "Data not found";
            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
       public function get_product_by_seller()
      {
        $seller_id=$this->input->post('seller_id');
        $data = array();
        $product_array=array();
        $this->form_validation->set_rules('seller_id', 'Seller_Id', 'trim|required');
     if ($this->form_validation->run() == true) {
        $product_data=$this->AM->get_seller_product($seller_id,"");
        if (!empty($product_data)) {
         foreach($product_data as $p){
             $after_dis=(($p['mrp']*$p['discount'])/100);
              $after_discount_price=$p['mrp']-$after_dis;
              $product_image= $this->AM->product_image($p['product_id']);
               $product_array[]=array(
                        'product_id'=>$p['product_id'],
                        'name'=>$p['name'],
                        'image'=>isset($product_image->image)?$product_image->image:"",
                        'product_name_hindi'=>$p['product_name_hindi'],
                        'mrp'=>$p['mrp'],
                        'discount'=>$p['discount'],
                        'price'=>$p['price'],//$after_discount_price,
                        //'is_wishlist'=>$p['is_wishlist'],
                        //'is_wishlist'=>$is_wishlist
               );
           }
            $data['status'] = true;
            $data['data'] = $product_array;
           
        } else {
            $data['status'] = false;
            $data['data'] = array();
        }
    }else{
     $data['status'] = false;
     $data['message'] = strip_tags($this->form_validation->error_string());
       }
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }
    public function get_state()
    {
    $data = array();
    $array_data=array();
    $get_state = $this->AM->get_state();
   
    if (!empty($get_state)) {
        foreach($get_state as $row){
            // print_r($get_state);exit;
        $array_data[]=array(
            'id'=>$row->id,
           'name'=>ucfirst(strtolower($row->name)),
            );
        }
    $data['status'] = true;
    $data['data'] = $array_data;
    } else {
    $data['status'] = false;
    $data['message'] = "Data not found";
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
     public function get_district()
    {
     $data = array();
      $state_id = $this->input->post('state_id');
        $this->form_validation->set_rules('state_id', 'State_Id', 'trim|required');
        if ($this->form_validation->run() == true) {
            $get_district = $this->AM->get_district($state_id);
            if (!empty($get_district)) {
                $data['status'] = true;
                $data['data'] = $get_district;
            } else {
                $data['status'] = false;
                $data['message'] = "Data not found";
            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    public function create_product_search_history()
    {
        $data = array();
        $user_id = $this->input->post('user_id');
        $type = $this->input->post('type'); 
        $this->form_validation->set_rules('type', 'Type', 'trim|required');
        if($type=='product'){
             $this->form_validation->set_rules('product_id', 'Product_Id', 'trim|required');
        }else{
             $this->form_validation->set_rules('varient_id', 'Varient_Id', 'trim|required');
        }
        $this->form_validation->set_rules('user_id', 'User_Id', 'trim|required');
        if ($this->form_validation->run() == true) {
            $x = $this->AM->create_search_history($user_id,$type);
            if ($x){
                $data['status'] = true;
                $data['message'] = 'History created successfully!';
            } else {
                $data['status'] = false;
                $data['message'] = "Already created";
            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
     public function get_product_details(){
    $product_id= $this->input->post('product_id');
    $user_id= $this->input->post('user_id');
    $res=array();
    $seller_array=array();
    $varient_array=array();
    $this->form_validation->set_rules('product_id', 'product_id', 'trim|required');
     $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
     if($this->form_validation->run() == true){
     $d =$this->AM->get_product_by_id($product_id,$user_id);
     $varient_data =$this->AM->get_product_varient($product_id);
     $seller_data =$this->AM->get_seller_detail_by_id($d['vendor_id']);
     $recent_search_product =$this->AM->get_search_product($user_id,"");
     $get_realted_product =$this->AM->get_related_product($d['category_id'],$user_id,$product_id);
    // print_r($seller_data);exit;
     foreach($varient_data as $v){
         $varient_data=$this->AM->varient_image($v['varient_id']);
           $after_dis=(($v['mrp']*$v['discount'])/100);
          
            $after_discount_price=$v['mrp']-$after_dis;
            $varient_array[]=array(
            'varient_id'=>$v['varient_id'],
            'mrp'=>$v['mrp'],
            'product_name_hindi'=>$v['product_name_hindi'],
            'product_name_english'=>$v['product_name_english'],
            'discount'=>$v['discount'],
            'price'=>$v['price'],//$after_discount_price,
            'image'=>$varient_data->image,

			 
     );
     }
     $seller_array=array(
                'id'=>isset($seller_data->id)?$seller_data->id:'',
                'name'=>isset($seller_data->name)?$seller_data->name:'',
                'mobile'=>isset($seller_data->mobile)?$seller_data->mobile:'',
                'email'=>isset($seller_data->email)?$seller_data->email:'',
                'image'=>isset($seller_data->profile_image)?$seller_data->profile_image:"",
                'district'=>isset($seller_data->district_name)?$seller_data->district_name:"",
         );
     if(!empty($d))
     {
         
        $rating_value=$this->db->select("IFNULL(AVG(rating_value),0) AS rating_value")->where('product_id',$d['product_id'])->get('rating_feedback')->row();
        // print_r($rating_value);exit;
       $product_image= $this->AM->all_product_image($d['product_id']);
        $after_dis=(($d['mrp']*$d['discount'])/100);
        $after_discount_price=$d['mrp']-$after_dis;
        
        //print_r($d['discount']);exit;
     $res[]=array(
            'product_id'=>$d['product_id'],
            'is_wishlist'=>$d['is_wishlist'],
             'cart_status'=>$d['is_cart'],
            'image'=>$product_image,
            'product_name_hindi'=>$d['product_name_hindi'],
            'product_name_english'=>$d['product_name_english'],
            'mrp'=>$d['mrp']?$d['mrp']:0,
            'price'=>$d['selling_price'],//$after_discount_price,//$d['selling_price']?$d['selling_price']:0,
            'discount'=>$d['discount'],
            'description'=>$d['description'],
            'quantity'=>$d['quantity'],
            'stock'=>$d['availabe_stock'],
            'category_id'=>$d['category_id'],
            'subcat_id'=>$d['subcat_id'],
            'rating_value'=>number_format($rating_value->rating_value,1),
            'varient_data'=>$varient_array,
            'seller_info'=>$seller_array,
            'recent_search_product'=>$recent_search_product,
            'realted_product'=>$get_realted_product,
     );
    

     $data['status']=true;
     $data['data']=  $res;
  

   }else{
     $data['status']=false;
     $data['data']=array();
   }

     }else{
     $data['status'] = false;
     $data['message'] = strip_tags($this->form_validation->error_string());
    
 }
 echo json_encode($data,JSON_UNESCAPED_UNICODE);

}
public function get_category()
    {
        $data = array();
        $category = $this->db->select('id,name,name_hindi,image')->get_where('category', ['status' => 1])->result_array();
        if (!empty($category)) {
            $data['status'] = true;
            $data['data'] = $category;
        } else {
            $data['status'] = false;
            $data['message'] = "Category doesn't exists";
        }
       
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
  public function change_notification_status(){
        
        $array=array();
    
      $user_id= $this->input->post('user_id');
          $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
        if ($this->form_validation->run() == true) {
            $data = array();
           $response = $this->AM->change_notification_status($user_id);
      //echo $this->db->last_query();die();
        if ($response) {
                $data['status'] = true;
              $data['message']='Status changed successfully';
           }else{
            $data['status'] = false;
              $data['message']='Unable to change status';
           }
        }else{
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string()); 
        }
    echo json_encode($data); 
    }
    public function get_account_status()
    {
        $data = array();
        $user_id=$this->input->post('user_id');
         $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
        if($this->form_validation->run() == true){
        $result_data = $this->db->select('status')->where('id', $user_id)->get('users')->row();
        if (!empty($result_data)) {
            $data['status'] = true;
            $data['login_status'] = $result_data->status;
        } else {
            $data['status'] = false;
            $data['data'] = array();
        }
     }else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }
        echo json_encode($data);
    }
    
      public function get_notification()
     {
        $data = array();
       $notification_data=$this->db->select("id,msg,DATE_FORMAT(created_at,'%d-%m-%y | %H:%i %p  ') as date_time ")->where(['status'=>1,'share_status!='=>3])->order_by('id','DESC')->get('notification')->result();
       
        if (!empty($notification_data)) {
            $data['status'] = true;
            $data['data'] = $notification_data;
        } else {
            $data['status'] = false;
            $data['data'] = array();
        }

        echo json_encode($data);
    }
public function get_all_product(){
        $user_id=$this->input->post('user_id');
        $type=$this->input->post('type');
        $category_id=$this->input->post('category_id');
        $product_id=$this->input->post('product_id');
        $data=array();   
        $this->form_validation->set_rules('user_id', 'User_Id', 'trim|required');
        $this->form_validation->set_rules('type', 'Type', 'trim|required');
        if($type=='related'){
        $this->form_validation->set_rules('category_id', 'Category_Id', 'trim|required');
        $this->form_validation->set_rules('product_id', 'Product_Id', 'trim|required');
        }
        if ($this->form_validation->run() == true) {
        $data = array();
        if($type=='top')
        {
        $top_product=   $this->AM->get_top_product($user_id,$type);
        $product_data=$top_product;
        }elseif($type=='new'){
        $new_product=   $this->AM->get_new_product($user_id,$type);
         $product_data=$new_product;
        }elseif($type=='search'){
        $search_product=   $this->AM->get_search_product($user_id,$type);
         $product_data=$search_product;
        }elseif($type=='related'){
            $get_realted_product =$this->AM->get_related_product($category_id,$user_id,$product_id);
          //  echo $this->db->last_query();die();
            $product_data=$get_realted_product;
        }
        
        else{
            $all_product=   $this->AM->get_all_product($user_id,"","","","","");
             $product_data=$all_product;
        }
         if(!empty($top_product) || !empty($new_product) || !empty($all_product) || !empty($search_product) || !empty($get_realted_product))
         {
         $data['status']=true;
         $data['data']=  $product_data;
       }else{
         $data['status']=false;
         $data['data']=array();
         $data['message']='Data not found';
       }
       
        }else{
        $data['status'] = false;
        $data['message'] = strip_tags($this->form_validation->error_string());
       
    }
     echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }
public function get_varient_details(){
    $varient_id= $this->input->post('varient_id');
    $user_id= $this->input->post('user_id');
    $res=array();
    $seller_array=array();
    $varient_array=array();
    $this->form_validation->set_rules('varient_id', 'varient_id', 'trim|required');
     $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
     if($this->form_validation->run() == true){
     $d =$this->AM->get_varient_by_id($varient_id,$user_id);
     $seller_data =$this->AM->get_seller_detail_by_id($d['vendor_id']);
     $recent_search_varient =$this->AM->get_search_varient($user_id,"");
    // echo $this->db->last_query();die();
     $get_realted_product =$this->AM->get_related_varient($d['category_id'],$user_id,$varient_id);
     $seller_array=array(
                'id'=>$seller_data->id,
                'name'=>$seller_data->name,
                'mobile'=>$seller_data->mobile,
                'email'=>$seller_data->email,
                'image'=>isset($seller_data->profile_image)?$seller_data->profile_image:"",
                'district'=>$seller_data->district_name,
         );
     if(!empty($d))
     {
      $rating_value=$this->db->select("IFNULL(AVG(rating_value),0) AS rating_value")->where('varient_id',$d['varient_id'])->get('rating_feedback')->row();
       $product_image= $this->AM->varient_image_all($d['varient_id']);
     $res[]=array(
            'varient_id'=>$d['varient_id'],
            'is_wishlist'=>$d['is_wishlist'],
             'cart_status'=>$d['is_cart'],
            'image'=>$product_image,
            'varient_name_hindi'=>$d['product_name_hindi'],
            'varient_name_english'=>$d['product_name_english'],
            'mrp'=>$d['mrp']?$d['mrp']:0,
            'price'=>$d['selling_price']?$d['selling_price']:0,
            'discount'=>$d['discount'],
            'description'=>$d['description'],
            'quantity'=>$d['quantity'],
            'stock'=>$d['availabe_stock'],
            'category_id'=>$d['category_id'],
            'subcat_id'=>$d['subcategory_id'],
            'rating_value'=>number_format($rating_value->rating_value,1),
            'seller_info'=>$seller_array,
            'recent_search_product'=>$recent_search_varient,
            'realted_product'=>$get_realted_product,
     );
    

     $data['status']=true;
     $data['data']=  $res;
  

   }else{
     $data['status']=false;
     $data['data']=array();
   }

     }else{
     $data['status'] = false;
     $data['message'] = strip_tags($this->form_validation->error_string());
    
 }
 echo json_encode($data,JSON_UNESCAPED_UNICODE);

}

}
