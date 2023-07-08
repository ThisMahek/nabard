<?php
class Mvendor extends CI_Model
{
    /*   public function __construct(){
    parent:: __construct();
    } */
    public function index()
    {

    }

    public function get_vendor_bod_details()
    {
        $array = array();
        $query = $this->db->select('vendor.id,vendor.field_type,vendor.name,vendor.father_name,vendor.email,vendor.reg_no,vendor.promoting_agency,vendor.office_address, vendor.product,vendor.basic_info,vendor.tehsil,vendor.village,vendor.pincode,vendor.aadhar_no,vendor.mobile,vendor.whatsapp_no,vendor.gender,district.name as district, district.id as district_id,block.id as block_id , block.name as block,vendor.user_id,vendor.representative,vendor.bod,vendor.mobile,bod.bod_name, bod.bod_mobile,bod.bod_image')
            ->from('vendor')
            ->join('district', 'district.id = vendor.district_id', 'left')
            ->join('block', 'block.id=vendor.block_id', 'left ')
            ->join('bod', 'bod.vendor_id = vendor.id', 'left')
            ->get();

        foreach ($query->result_array() as $key => $row) {
            $array = $this->db->select('*')->from('bod')->where(['vendor_id' => $row['id']])->get()->result_array();
            return $array;
        }

    }

    public function get_vendor_details()
    {
        $array = array();
        $query = $this->db->select('vendor.id,vendor.added_by,vendor.bod,vendor.field_type,vendor.name as v_name,vendor.father_name,vendor.email,vendor.reg_no,vendor.promoting_agency,vendor.office_address,vendor.decry_password, vendor.product,vendor.basic_info,vendor.tehsil,vendor.village,vendor.pincode,vendor.aadhar_no, vendor.status as v_status,vendor.profile_image,vendor.mobile,vendor.whatsapp_no,vendor.gender,vendor.is_block,district.name as district, district.id as district_id,block.id as block_id , block.name as block,vendor.user_id,vendor.representative,vendor.promoting_agency,vendor.office_address,vendor.bod,vendor.mobile,bod.bod_name, bod.bod_mobile,bod.bod_image')
            ->from('vendor')
            ->group_by('vendor.id')
            ->join('district','district.id = vendor.district_id','left')
            ->join('block','block.id=vendor.block_id','left')
            ->join('bod','bod.vendor_id = vendor.id','left')
            ->join('rating_feedback','rating_feedback.vendor_id = vendor.id','left')
            ->where(['vendor.field_type' => 'fpo'])
            ->or_where(['vendor.field_type' => 'shg'])
            ->order_by('vendor.id','desc')
            ->get()
            ->result_array();
        $array = [];
        foreach ($query as $row) {
            $tempArr = $row['v_status'] != '2' ? $row : '';
            if (!empty($tempArr)) {
                $array[] = $tempArr;
            }
        }
        return $array;


    }

    public function get_vendor_farmer_details()
    {
        return $query = $this->db->select('vendor.id,vendor.is_block,vendor.added_by,vendor.field_type,vendor.name,vendor.father_name,vendor.email,vendor.reg_no,vendor.promoting_agency,vendor.office_address, vendor.product,vendor.basic_info,vendor.decry_password,vendor.tehsil,vendor.village,vendor.pincode,vendor.aadhar_no,vendor.status,vendor.profile_image,vendor.mobile,vendor.whatsapp_no,vendor.gender,district.name as district, district.id as district_id,block.id as block_id , block.name as block,vendor.user_id,vendor.representative,vendor.promoting_agency,vendor.office_address')
            ->from('vendor')
            ->group_by('vendor.id')
            ->join('district', 'district.id = vendor.district_id','left')
            ->join('block', 'block.id=vendor.block_id','left')
            ->where('vendor.field_type', 'farmer')
            ->where('vendor.status !=', 2)
            ->order_by('vendor.id','desc')
            ->get()
            ->result_array();
    }



    public function get_farmer_details_fpo_shg($id)
    {
            return $query = $this->db->select('vendor.id ,vendor.added_by,vendor.field_type,vendor.name,vendor.father_name,vendor.email,vendor.reg_no,vendor.promoting_agency,vendor.office_address, vendor.product,vendor.basic_info,vendor.tehsil,vendor.village,vendor.pincode,vendor.aadhar_no,vendor.status,vendor.profile_image,vendor.mobile,vendor.whatsapp_no,vendor.gender,district.name as district, district.id as district_id,block.id as block_id , block.name as block,vendor.user_id,vendor.representative,vendor.promoting_agency,vendor.office_address,vendor.bod,vendor.mobile')
            ->from('vendor')
            ->group_by('vendor.id')
            ->join('district', 'district.id = vendor.district_id','left')
            ->join('block', 'block.id=vendor.block_id','left')
                // ->join('bod','bod.vendor_id = vendor.id')
            ->where('vendor.id', $id)
            ->get()
            ->row_array();

    }


    public function get_vendors_bod($id)
    {
        return $this->db->get_where('bod', ['vendor_id' => $id])->result_array();
    }



  /*   public function check_email($email)
    {
        return $this->db->get_where('vendor',['email'=>$email,'status'=>1]);
    }
 */

 /*    public function check_userid($userid)
    {
        return $this->db->get_where('vendor',['user_id'=>$userid,'status'=>1]);
    } */


    public function check_userid($userid,$id)
    {
        if(!empty($id)){
            return $this->db->select('*')->where(['user_id'=>$userid,'id!='=>$id,'status!='=>2])->get('vendor');
        }else{
            return $this->db->select('*')->where(['user_id'=>$userid,'status!='=>2])->get('vendor'); 
        }
       }


     public function  check_whatsapp($whatsapp,$id){

        if(!empty($id)){
            return $this->db->select('*')->where(['whatsapp_no'=>$whatsapp,'id!='=>$id,'status!='=>2])->get('vendor');
        }else{
            return $this->db->select('*')->where(['whatsapp_no'=>$whatsapp,'status!='=>2])->get('vendor'); 
        }

     }


     public function check_aadharnum($aadharnum,$id){
        if(!empty($id)){
            return $this->db->select('*')->where(['aadhar_no'=>$aadharnum,'id!='=>$id,'status!='=>2])->get('vendor');
        }else{
            return $this->db->select('*')->where(['aadhar_no'=>$aadharnum,'status!='=>2])->get('vendor'); 
        }
     }

    public function check_regno($regno,$id) {
        if(!empty($id)){
            return $this->db->select('*')->where(['reg_no'=>$regno,'id!='=>$id,'status!='=>2])->get('vendor');
        }else{
            return $this->db->select('*')->where(['reg_no'=>$regno,'status!='=>2])->get('vendor'); 
        }
       }


    public function get_vendors_product_rating($id)
    {
        // return $this->db->get_where('rating_feedback', ['vendor_id' => $id]);
       return $this->db->query("SELECT round(avg(`rating_value`),1) AS `rating`, count(`rating_value`) AS `num_of_rating`
       FROM rating_feedback 
       WHERE vendor_id = '$id' ")->row_array(); 

       

        // return $this->db->query("select AVG(rating_value) as rating FROM rating_feedback where vendor_id ='$id'")->row_array();
       
    }


    public function get_farmer_details($id)
    {
        return $query = $this->db->select('vendor.id,vendor.added_by,vendor.field_type,vendor.name,vendor.father_name,vendor.email,vendor.reg_no,vendor.promoting_agency,vendor.office_address, vendor.product,vendor.basic_info,vendor.tehsil,vendor.village,vendor.pincode,vendor.aadhar_no,vendor.status,vendor.profile_image,vendor.mobile,vendor.whatsapp_no,vendor.gender,district.name as district, district.id as district_id,block.id as block_id , block.name as block,vendor.user_id,vendor.representative,vendor.promoting_agency,vendor.office_address')
            ->from('vendor')
            ->group_by('vendor.id')
            ->join('district', 'district.id = vendor.district_id')
            ->join('block', 'block.id=vendor.block_id')
            ->where('vendor.id', $id)
            ->get()
            ->row_array();
    }



    /* $array= array();
    $this->db->select('vendor.field_type,vendor.name,vendor.father_name,vendor.email,vendor.reg_no,vendor.promoting_agency,vendor.office_address, vendor.product,vendor.basic_info,vendor.tehsil,vendor.village,vendor.pincode,vendor.aadhar_no,vendor.mobile,vendor.whatsapp_no,vendor.gender,district.name as district, district.id as district_id,block.id as block_id , block.name as block,vendor.user_id,vendor.representative,vendor.bod,vendor.mobile,bod.bod_name,bod.bod_mobile,bod.bod_image,GROUP_CONCAT(bod.bod_name SEPARATOR ",")'); 
    $this->db->from('vendor');
    $this->db->join('district', 'district.id = vendor.district_id');
    $this->db->join('block', 'block.id=vendor.block_id');
    $this->db->join('bod', 'bod.vendor_id = vendor.id', 'right join');
    $query = $this->db->get()->result_array();
    */
    // return $query;

    public function update_vender_details($id, $array)
    {
        return $this->db->where(['id' => $id])->update('vendor', $array);
    }


    public function DeleteVendorDetails($id)
    {
        return $this->db->where('id', $id)->update('vendor', ['status' => 2]);
    }

    public function get_district()
    {
        return $this->db->get_where('district', ['status' => 1])->result_array();
    }

    public function get_block($district_id)
    {
        return $this->db->get_where('block',['district_id'=>$district_id])->result_array();
    }

    public function check_number($phone,$id)
    {
        return $this->db->select('*')->where(['mobile'=>$phone,'id!='=>$id,'status!='=>2])->get('vendor');
    }
   public function check_email($email,$id){
    if(!empty($id)){
        return $this->db->select('*')->where(['email'=>$email,'id!='=>$id,'status!='=>2])->get('vendor');
    }else{
        return $this->db->select('*')->where(['email'=>$email,'status!='=>2])->get('vendor'); 
    }
   }


   public function check_team_email($email,$id){
    if(!empty($id)){
        return $this->db->select('*')->where(['email'=>$email,'id!='=>$id,'status!='=>2])->get('tbl_team');
    }else{
        return $this->db->select('*')->where(['email'=>$email,'status!='=>2])->get('tbl_team'); 
    }
   }

 


    public function check_number_resend($phone, $otp)
    {
        return $this->db->where(['mobile' => $phone, 'status' => '0'])->update('tblotp', ['otp' => $otp]);
    }
    public function insert_number_user($phone, $otp)
    {
        $this->db->insert('tblotp', ['mobile' => $phone, 'otp' => $otp, 'status' => '0']);
        $last_id = $this->db->insert_id();
        return $this->session->set_userdata('last_id', $last_id);
    }


     public function add_vendor_bod_data($bod_data)
            {
                return $this->db->insert('bod',$bod_data);
            }

    public function  AddVendorDetails($array)
            {
                $this->db->insert('vendor',$array);
                return $this->db->insert_id();
            }

          public function  check_number_bod_number($phone,$id,$bod_id){

            if(!empty($bod_id))
            { 
              $bod_rows=$this->db->get_where('bod',['bod_mobile'=>$phone,'status!='=>2,'id='=>$bod_id]);
              $bod_phone_rows=$this->db->get_where('bod',['bod_mobile'=>$phone,'status!='=>2]);
              if($bod_rows->num_rows()==1){
                return $bod_rows->num_rows();
              }elseif($bod_phone_rows->num_rows() >1){
                return $bod_phone_rows->num_rows();
              }
          }

}
        public function  check_team_number($phone, $id){
            if($id !=''){
                $team_rows=$this->db->get_where('tbl_team',['mobile'=>$phone,'status!='=>2,'id!='=>$id]);

            return $team_rows;
            /*     if($bod_rows->num_rows()>1){
                return false;
                }else{
                return true;
                } */
            }else{
                $team_rows=$this->db->get_where('tbl_team',['mobile'=>$phone,'status!='=>2]);

            return $team_rows;
            /* if ($bod_rows->num_rows() > 1) {
                return false;
            }else{
                return true;
            } */
            }
          }



          public function get_user_details(){
            return $query = $this->db->select('*')->where('status!=',2)->from('users')->order_by('id','desc')->get()->result_array();

          }



          public function get_user_detail($id){
            return  $this->db->select('users.name, users.id as uid,users.mobile,users.email,users.state as state_id,users.status, users.district as district_id,users.tahsil,users.pincode,users.image,tbl_state.id as s_id,tbl_state.name as state_name,district.id as d_id,district.name as district_name')->from('users')
            ->join('tbl_state','tbl_state.id = users.state')
            ->join('district','district.id = users.district')
            ->where(['users.id'=>$id])
            ->get()
            ->row_array();

          }

        public function get_users_general_enquiry()
        {
            return $query = $this->db->select('enquiry_details.id as enq_id,vendor.id as vendor_id,vendor.name  as vendor_name,users.id as user_id,users.name as user_name,users.mobile as user_mobile, users.email as user_email, users.state as u_state, users.district as u_district,users.tahsil as u_tahsil,users.pincode as u_pincode,enquiry_details.user_msg,enquiry_details.vendor_msg,enquiry_details.issue_type,enquiry_details.enquiry_type,enquiry_details.is_reply,enquiry_details.status')
            ->from('enquiry_details')
            ->group_by('enquiry_details.id')
            ->join('users','users.id = enquiry_details.user_id')
            ->join('vendor','vendor.id = enquiry_details.vendor_id')
            ->where(['enquiry_details.enquiry_type'=>'general','enquiry_details.status!='=>2])
            ->get()
            ->result_array();
        }


       public function delete_general_enquiry($id){
        return $this->db->where('id', $id)->update('enquiry_details', ['status' => 2]);

       }



       public function get_users_enquiry(){


        return $query = $this->db->select('enquiry_details.id as enq_id,vendor.id as vendor_id,vendor.name  as vendor_name,users.id as user_id,users.name as user_name,users.mobile as user_mobile, users.email as user_email, users.state as u_state, users.district as u_district,users.tahsil as u_tahsil,users.pincode as u_pincode,enquiry_details.user_msg,enquiry_details.vendor_msg,enquiry_details.issue_type,enquiry_details.enquiry_type,enquiry_details.is_reply,  enquiry_details.admin_msg,enquiry_details.status')
        ->from('enquiry_details')
        ->group_by('enquiry_details.id')
        ->join('users','users.id = enquiry_details.user_id')
        ->join('vendor','vendor.id = enquiry_details.vendor_id')
        ->where(['enquiry_details.enquiry_type'=>'admin','enquiry_details.status!='=>2])
        ->get()
        ->result_array();

       }


      public function  delete_admin_enquiry($id){
        return $this->db->where('id', $id)->update('enquiry_details', ['status' => 2]);
       }


       public function send_admin_reply_to_user($id,$data){
        return $this->db->where('id', $id)->update('enquiry_details',$data);
       }
        public function get_product_enquiry()
        {
            if(isset($_POST['search_filter']))
            {
              if(!empty($_POST['vendor_id']) && isset($_POST['vendor_id']) )
              {
              $this->db->where('enquiry_details.vendor_id',$this->input->post('vendor_id'));
              }
               if(!empty($_POST['status']) && isset($_POST['status']))
               {
                $this->db->where('enquiry.status',$this->input->post('status'));
                $this->db->where('enquiry_details.status',$this->input->post('status'));
               }
                if($this->input->post("from_date")!="" && $this->input->post("to_date")!=""){
                 $fromdate = $this->input->post("from_date");
                 $todate =  $this->input->post("to_date");
                 
                 $this->db->where('DATE_FORMAT(enquiry_details.created_at,"%Y-%m-%d")>=',$fromdate);
                 $this->db->where('DATE_FORMAT(enquiry_details.created_at,"%Y-%m-%d")<=',$todate);
                }
            }
           $order_ids= $this->db->select('enquiry_details.status,enquiry_details.order_id,enquiry_details.vendor_id,enquiry_details.user_msg,vendor.id as vendor_id,vendor.name as vendor_name,users.id as user_id,users.name as user_name,enquiry_details.vendor_msg,rating_feedback.feedback,rating_feedback.rating_value, enquiry_details.created_at')
           ->join('enquiry','enquiry.id=enquiry_details.order_id','left')
           ->join('vendor','vendor.id=enquiry_details.vendor_id','left')
           ->join('users','users.id=enquiry_details.user_id','left')
           ->join('rating_feedback','rating_feedback.enquiry_id=enquiry_details.order_id','left')
             ->where(['enquiry_details.enquiry_type'=>'product','enquiry_details.status!='=>2,'enquiry.status!='=>2])
             ->group_by('enquiry_details.order_id')
             ->order_by("enquiry.id", "desc")
             ->get('enquiry_details')
             ->result();
            return $order_ids;
       }
        public function get_product_data_from_enquiry($order_id)
        {
      $result= $this->db->select('product.id as product_id,add_product.product_name_english as product_name,product.mrp,product.price')
      ->join('product','product.id=enquiry_details.product_id','left')
      ->join('add_product','add_product.id=product.product_name_english_id','left')
      ->where(['enquiry_details.enquiry_type'=>'product','enquiry_details.status!='=>2,'enquiry_details.order_id'=>$order_id,'enquiry_details.product_id !='=>null])->get('enquiry_details')->result();
      return $result;
    
       }
       
  
          public function get_variant_data_from_enquiry($order_id){
           
                $result= $this->db->select('varient.id as varient_id,add_product.product_name_english as product_name,varient.mrp,varient.price')
                ->join('varient','varient.id=enquiry_details.varient_id','left')
                ->join('add_product','add_product.id=varient.product_name_english_id','left')
                ->where(['enquiry_details.enquiry_type'=>'product','enquiry_details.status!='=>2,'enquiry_details.order_id'=>$order_id,'enquiry_details.varient_id !='=>null])//'enquiry_details.varient_id!='=>null]
                ->get('enquiry_details')
                ->result();
                return $result;
          }
         public function  delete_product_enquiry($id){
             
             $data['status']=2;
         $this->db->where('order_id', $id)->update('enquiry_details',$data);
        return  $this->db->where('id', $id)->update('enquiry',$data);
       }

 public function  get_vendor_data()
 {
   return  $this->db->where('status!=',2)->order_by('name','ASC')->get('vendor')->result();
 }
 public function  get_status()
 {
   return  $this->db->get('status')->result();
 }
}

?>