<?php

function ozekiOTP($len, $type="", $mobile="", $chars = '1234567890', $default="")
{
    $type_allowed = array("signup","reset_pass");
	$chars_length = (strlen($chars) - 1);
	$string = $chars[rand(0, $chars_length)];
	for ($i = 1; $i < $len; $i = strlen($string))
	{
		$r = $chars[rand(0, $chars_length)];
		if ($r != $string[$i - 1]) $string .=  $r;
	}
	/* if(in_array($type, $type_allowed)) {
        if($default!="")
           $string = $default; 
        $msg = "Your ExtraaMoney One Time Password (OTP) is {$string}. Don't share it with anyone. We don't call/email you to verify OTP. OTP is valid for 15 mins.";
        send_sms($mobile, $msg, $type);
    } */
	return $string;
}

        function get_vendor_id_product_wise($product_id){
            $ci=&get_instance();
           $vendor_data=  $ci->db->where(["id"=>$product_id,'status'=>1,'show_user'=>1])->get("product")->row();
             return $vendor_data->vendor_id;
        }
          function get_vendor_id_varient_wise($varient_id){
            $ci=&get_instance();
           $vendor_data=  $ci->db->select('varient.vendor_id')->join('product','product.id=varient.adding_to_id','left')->where(["varient.id"=>$varient_id,'product.status'=>1,'product.show_user'=>1])->get("varient")->row();
             return $vendor_data->vendor_id;
        }
         function get_vendor_id_user_wise_for_enquiry($user_id){
            $ci=&get_instance();
           $vendor_data=  $ci->db->where(["user_id"=>$user_id])->group_by('vendor_id')->get("cart")->result();
           foreach($vendor_data as $v)
           {
               $vendor_ids[]=$v->vendor_id;
                   
           }
             return $vendor_ids;
        }
        function get_all_notifiction_count(){
            $ci= &get_instance();
           $notification_data=  $ci->db->where(["status!="=>2,'share_status!='=>2])->get("notification")->num_rows();
             return $notification_data;
        }
        function get_users_notifiction_count($user_id){
            $ci=&get_instance();
            $data = $ci->db->select('read_notification')->where(["status!="=>2,'id'=>$user_id])->get("vendor")->row_array();
            $notifi_count = $data['read_notification'];
           if(!empty($notifi_count)){
              $x =json_decode($notifi_count,true);  
                $y=count($x);
                  return $y; 
           }else{
               return 0;
           }
        }
    
     function get_home_user_notifiction_count($user_id){
            $ci=&get_instance();
            $data = $ci->db->select('ifnull(read_notification,"") as read_notification')->where(["status!="=>2,'id'=>$user_id])->get("users")->row_array();
            $notifi_count = $data['read_notification'];
           if(!empty($notifi_count)){
              $x =json_decode($notifi_count,true);  
                $y=count($x);
                  return $y; 
           }else{
               return 0;
           }
        }
         function update_enquiry_status($enquiry_id){
         $ci= &get_instance();
         if(!empty($enquiry_id)){
         $enquiry_data= $ci->db->query("SELECT status,order_id FROM `enquiry_details` WHERE status=0 and order_id= $enquiry_id and updated_at < DATE_SUB(NOW(),INTERVAL 15 DAY)")->row();
         if(!empty($enquiry_data->order_id)){
         $x=$ci->db->where('order_id',$enquiry_data->order_id)->update('enquiry_details',array('status'=>5));
         $x=$ci->db->where('id',$enquiry_data->order_id)->update('enquiry',array('status'=>5));
         return $x;
          }
         }
        }
        
    

?>