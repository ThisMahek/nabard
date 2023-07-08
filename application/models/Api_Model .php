<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Api_Model extends CI_Model
{
public function login_get()
{
    $userdata = array();
//$query = $this->db->
    
   $query= $this->db->where('status in(0,1)')->where('mobile',$this->input->post('mobile'))->or_where('email',$this->input->post('mobile'))->get('users');
//echo $this->db->last_query();die();
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
public function add_cart_in_db($user_id,$product_id)
{
    $return_cart_status=array();
  $vendor_id =get_vendor_id($product_id);
   $array=array('user_id'=>$user_id,'product_id'=>$product_id,'vendor_id'=>$vendor_id);
 $cart_data=$this->db->where($array)->get('cart')->row();
   if($cart_data==0)
   {
       $insert_array=array(
           'user_id'=>$user_id,
           'product_id'=>$product_id,
           'vendor_id'=>$vendor_id,
           );
           $this->db->insert('cart',$insert_array);
          $x=$this->db->insert_id();
                   if($this->db->affected_rows() == true) 
                   {
                     $return_cart_status['status']=1;  
                    $return_cart_status['status']=$x;  
                   }
                   else
                   {
                        $return_cart_status['status']=0;  
                   }
   }
   else
   {
      $return_cart_status['status']=2;   
   }
     $return_cart_status;
    print_r($return_cart_status);exit;
}

}
?>