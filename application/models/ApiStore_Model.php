<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ApiStore_Model extends CI_Model
{
    public function get_distict()
    {
        return $this->db->where('status', 1)->get('district')->result();
    }
    public function get_block($district_id)
    {
        return $this->db->where(['status' => 1, 'district_id' => $district_id])->get('block')->result();
    }

    public function set_upload_files($upload_path, $files, $type = "")
    {
        $image_base64 = base64_decode($files);

        if ($type != "" && $type != null) {
            $file = $upload_path . uniqid() . '.' . $type;
        } else {
            $file = $upload_path . uniqid() . '.png';
        }
        file_put_contents($file, $image_base64);
        $image = $file;
        return $image;
    }


    public function farmar_register()
    {
        $otp_verification = array();
        $name = $this->input->post('name');
        $father_name = $this->input->post('father_name');
        $gender = $this->input->post('gender');
        $mobile = $this->input->post('mobile');
        $district_id = $this->input->post('district_id');
        $block_id = $this->input->post('block_id');
        $tehsil = $this->input->post('tehsil');
        $pincode = $this->input->post('pincode');
        $user_id = $this->input->post('user_id');
        $village = $this->input->post('village');
        $password = $this->input->post('password');
        $farmer = $this->input->post('type');
        $otp = $this->input->post('otp');


        $array = array(
            'name' => $name,
            'father_name' => $father_name,
            'email' => (isset($_POST['email']) ? $_POST['email'] : " "),
            'whatsapp_no' => (isset($_POST['whatsapp_no']) ? $_POST['whatsapp_no'] : " "),
            'aadhar_no' => (isset($_POST['aadhar_no']) ? $_POST['aadhar_no'] : " "),
            'gender' => $gender,
            'mobile' => $mobile,
            'district_id' => $district_id,
            'block_id' => $block_id,
            'tehsil' => $tehsil,
            'pincode' => $pincode,
            'village' => $village,
            'user_id' => $user_id,
            'password' => md5($password),
            'decry_password' =>$password,
            'field_type' => $farmer,
            'added_by' => 'himself'
        );

        $user_data = $this->db->where(['mobile' => $mobile, 'type' => 'r'])->get('tblotp');
        $otp_data = $user_data->row();
        $otp_timedata = $this->db->get('app_setting')->row();
        $date = date("Y-m-d H:i:s", strtotime($otp_data->updated_at . ' +' . $otp_timedata->otp_time . ' seconds'));
        $current_date = date("Y-m-d H:i:s");
        if ($user_data->num_rows() > 0) {
            $user_data_row = $user_data->row();
            if ($date > $current_date) {

                if ($user_data_row->otp == $otp) {

                     $this->db->insert('vendor', $array);
                    $x=$this->db->insert_id();
                    $shop['vendor_id']=$x;
                    $this->db->insert('tbl_shopdetails', $shop);
                    if ($x)
                        $otp_verification['status'] = 1;

                } else {
                    $otp_verification['status'] = 2;
                }
            } else {
                $otp_verification['status'] = 4;
            }
        } else {
            $otp_verification['status'] = 3;
        }
        return $otp_verification;
    }
    public function fpo_sho_register()
    {
        $otp_verification = array();
        $name = $this->input->post('name');
        $representative = $this->input->post('representative');
        $bod = $this->input->post('bod');
        $reg_no = $this->input->post('reg_no');
        $mobile = $this->input->post('mobile');
        $district_id = $this->input->post('district_id');
        $block_id = $this->input->post('block_id');
        $office_address = $this->input->post('office_address');
        $product = $this->input->post('product');
        $basic_info = $this->input->post('basic_info');
        $user_id = $this->input->post('user_id');
        $password = $this->input->post('password');
        $type = $this->input->post('type');
        $otp = $this->input->post('otp');



        $array['name'] = $name;
        $array['representative'] = $representative;
        $array['bod'] = $bod;
        $array['reg_no'] = $reg_no;
        $array['mobile'] = $mobile;
        $array['district_id'] = $district_id;
        $array['block_id'] = $block_id;
        $array['office_address'] = $office_address;
        $array['basic_info'] = $basic_info;
        $array['product'] = $product;
        $array['user_id'] = $user_id;
        $array['password'] = md5($password);
        $array['decry_password'] = $password;
        $array['email'] = isset($_POST['email']) ? $_POST['email'] : null;
        $array['promoting_agency'] = isset($_POST['promoting_agency']) ? $_POST['promoting_agency'] : null;
        $array['field_type'] = $type;
        $array['added_by'] = 'himself';



        // $array=array(
        //     'name'=>$name,
        //     'father_name'=>$father_name,
        //     'email'=>isset($_POST['email'])?$_POST['email']:null,
        //     'whatsapp_no'=>isset($_POST['whatsapp_no'])?$_POST['whatsapp_no']:null,
        //      'aadhar_no'=>isset($_POST['aadhar_no'])?$_POST['aadhar_no']:null,
        //     'gender'=>$gender,
        //     'mobile'=>$mobile,
        //     'district_id'=>$district_id,
        //     'block_id'=>$block_id,
        //     'tehsil'=>$tehsil,
        //     'pincode'=>$pincode,
        //     'user_id'=>$user_id,
        //     'password'=>md5($password),
        //     'field_ type'=>$farmer
        //         );

        $user_data = $this->db->where(['mobile' => $mobile, 'type' => 'r'])->get('tblotp');
        $otp_data = $user_data->row();
        $otp_timedata = $this->db->get('app_setting')->row();
        $date = date("Y-m-d H:i:s", strtotime($otp_data->updated_at . ' +' . $otp_timedata->otp_time . ' seconds'));
        $current_date = date("Y-m-d H:i:s");

        if ($user_data->num_rows() > 0) {
            $user_data_row = $user_data->row();
            if ($date > $current_date) {
                if ($user_data_row->otp == $otp) {
                    $this->db->insert('vendor', $array);
                    $last_id = $this->db->insert_id();
                    $shop['vendor_id']=$last_id;
                    $this->db->insert('tbl_shopdetails', $shop);
                    $post = (isset($_POST['data'])) ? json_decode($_POST['data']) : array();

                    //   $a=  '[{"image":"dlfjldksfjlkdjfkldsfndsfldsfj","mobile":"788888889","name":"director hbhjjh"},{"image":"dlfjldksfjlkdjfkldsfndsfldsfj","mobile":"977989999","name":"director nkk"},{"image":"dlfjldksfjlkdjfkldsfndsfldsfj","mobile":"9876543288","name":"director maje"}]';
                    //      $post = json_decode($a);
                    if (!empty($post)) {
                        // print_r($post);exit;
                        foreach ($post as $post_data) {
                            $insert_array['bod_name'] = $post_data->name;
                            $insert_array['bod_mobile'] = $post_data->mobile;
                            $insert_array['vendor_id'] = $last_id;
                            $files = $post_data->image;

                            $upload_path = 'upload/';
                            $insert_array['bod_image'] = $this->set_upload_files($upload_path, $files, 'png');
                            $insert_array['status'] = 1;
                            $this->db->insert('bod', $insert_array);
                        }

                    }

                    if ($last_id)
                        $otp_verification['status'] = 1;

                } else {
                    $otp_verification['status'] = 2;
                }
            } else {
                $otp_verification['status'] = 4;
            }
        } else {
            $otp_verification['status'] = 3;
        }
        return $otp_verification;
    }



    public function login_get()
    {
        $userdata = array();
        $user_id = $this->input->post('user_id');
        $password=  md5($this->input->post('password'));
        $vendor_rows = $this->db->where(['user_id'=> $user_id,'password' =>$password])->get('vendor')->num_rows();
        if($vendor_rows >0){
        $vendor_data = $this->db->where('user_id', $user_id)->get('vendor')->row();
        if ($vendor_data->field_type == 'farmer') {
            $this->db->select('vendor.id,vendor.is_block,vendor.name,vendor.father_name,  vendor.gender,vendor.mobile,vendor.whatsapp_no,district.name as district,vendor.district_id,block.name as block,vendor.block_id,vendor.tehsil,vendor.village,vendor.pincode,vendor.aadhar_no,vendor.user_id,vendor.status,vendor.password,vendor.field_type,ifnull(vendor.profile_image," ") as profile_image  ');
            $this->db->join('block', ' block.id=vendor.block_id','left');
            $this->db->join('district', ' district.id=vendor.district_id', 'left');
            $query = $this->db->where(['vendor.user_id' => $user_id])->get('vendor');
        } else {
            $query = $this->db->select('vendor.id,vendor.is_block,vendor.name,vendor.representative,vendor.bod,vendor.reg_no,vendor.mobile,vendor.email,vendor.promoting_agency,vendor.office_address,district.name as district,vendor.district_id,block.name as block,vendor.block_id,vendor.product,vendor.basic_info,vendor.user_id,vendor.status,vendor.password,ifnull(vendor.profile_image," ") as profile_image,vendor.field_type');
            $this->db->join('block', ' block.id=vendor.block_id', 'left');
            $this->db->join('district', ' district.id=vendor.district_id', 'left');
            $query = $this->db->where(['vendor.user_id' => $user_id,'vendor.status!='=>2])->get('vendor');
        }
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            if ($row['password'] == md5($this->input->post('password'))) {
                if ($row['status'] == 1  &&  $row['is_block'] == 0) {
                    $userdata = $row;
                    $userdata['login_status'] = 1;
                } else if (($row['status'] == 1) &&  ($row['is_block'] == 1)) {
                     $userdata['login_status'] = 4;
                    }else if($row['status']==0) {
                        
                    $userdata['login_status'] = 3;
                }
            } else {
                $userdata['login_status'] = 2;
            }
        } else {
            $userdata['login_status'] = 0;
        }
        
    }else{
        $userdata['login_status']=0;
    }
        return $userdata;
    }



    public function insert_reset_otp($mobile, $otp)
    {
        return $this->db->insert('tblotp', ['mobile' => $mobile, 'otp' => $otp, 'type' => 'f']);
        // return $this->db->insert_id();  
    }


    public function check_vender_exists($mobile)
    {
        $userdata = array();
        $vendor_data = $this->db->get_where('vendor', ['mobile' => $mobile])->row();
        if ($vendor_data->mobile == $mobile) {
            if ($vendor_data->status == 1) {
                $userdata['status'] = 1;
            } elseif ($vendor_data->status == 0) {
                $userdata['status'] = 2;
            } else {
                $userdata['status'] = 3;
            }
        } else {
            $userdata['status'] = 4;
        }
        return $userdata;
        // return $this->db->get_where('vendor',['mobile'=>$mobile, 'status'=>0])->num_rows();

    }
    public function insert_product_details($data)
    {
        $this->db->insert('product', $data);
        return $this->db->insert_id();
    }

    public function update_product_details($data, $id)
    {
        return $this->db->where('id', $id)->update('product', $data);
    }
    public function insert_varient_product_id($data)
    {

        $this->db->insert('varient', $data);
        return $this->db->insert_id();

    }

    public function update_varient_product_id($data, $id)
    {
        return $this->db->where('id', $id)->update('varient', $data);
    }



    public function set_upload_multi_files($upload_path, $files, $type = "")
    {
        $files = json_decode($files);
        $upload_path = 'upload/product';

        $collectArr = [];
        foreach ($files as $each_image) {

            $image_base64 = base64_decode($each_image);

            if ($type != "" && $type != null) {
                $name = uniqid() . '.' . $type;
                $file = $upload_path . $name;
            } else {
                $name = uniqid() . '.png';
                $file = $upload_path . $name;
            }
            file_put_contents($file, $image_base64);
            $collectArr[] = $image = $name;
        }


        return json_encode($collectArr);
    }


    public function update_product_price($product_id, $mrp, $selling_price)
    {
        return $this->db->where(['id' => $product_id])->update('product', ['mrp' => $mrp, 'price' => $selling_price]);
    }

    public function update_varient_price($varient_id, $product_id, $mrp, $selling_price)
    {
        return $this->db->where(['adding_to_id' => $product_id, 'id' => $varient_id])->update('varient', ['mrp' => $mrp, 'price' => $selling_price]);
    }
    public function update_product_stock($array,$product_id)
    {
        return $this->db->where(['id' => $product_id])->update('product', $array);
    }

    public function update_varient_stock($array, $product_id, $varient_id)
    {
        return $this->db->where(['adding_to_id' => $product_id, 'id' => $varient_id])->update('varient', $array);
    }

    public function get_my_product($user_id)
    {
        return $this->db->select('product.id as product_id,product.category_id,product.subcat_id as subcategory_id,product.mrp,product.price as selling_price,  product.stock_status,product.top_product as is_top_product,product.status as approval_status, c1.name as category_name, c2.name as sub_cat_name,ap1.product_name_hindi,ap1.product_name_english,product.show_user ')

            ->join('add_product ap1', 'ap1.id = product.product_name_hindi_id', 'left')
            ->join('add_product ap2', 'ap2.id = product.product_name_english_id', 'left')
                // ->join('product_image ','product_image.product_id = product.id','left')
            ->join('category c1', 'c1.id= product.category_id', 'left')
            ->join('subcategory c2', 'c2.id=product.subcat_id', 'left')
            ->where(['product.status !=' => 2, 'product.vendor_id' => $user_id])
            ->get('product')
            ->result_array();

    }

    public function get_product_by_id($product_id)
    {
        return $this->db->select('product.id as product_id,product.category_id,product.subcat_id as subcategory_id,product.mrp,product.price as selling_price,  product.stock_status,product.top_product as is_top_product,product.status as approval_status,product.quantity,product.description,product.verification_doc,c1.name as category_name, c2.name as sub_cat_name,ap1.product_name_hindi,ap1.product_name_english,product.product_name_hindi_id as select_product_id,product.availabe_stock')

            ->join('add_product ap1', 'ap1.id = product.product_name_hindi_id', 'left')
            ->join('add_product ap2', 'ap2.id = product.product_name_english_id', 'left')
                // ->join('product_image ','product_image.product_id = product.id','left')
            ->join('category c1', 'c1.id= product.category_id', 'left')
            ->join('subcategory c2', 'c2.id=product.subcat_id', 'left')
            ->where(['product.status !=' => 2, 'product.id' => $product_id])
            ->get('product')
            ->row_array();

    }
    public function product_image($id)
    {
        return $this->db->select('id,image')->where(['status' => 1, 'product_id' => $id])->get('product_image')->result_array();
    }
    
    public function product_image_for_vendor($id)
    {
        return $this->db->select('id,image')->where(['status' => 1, 'product_id' => $id])->get('product_image')->row_array();
    }
    public function insert_news_letters($user_id, $email)
    {
        $news_latter_data=array();
       $news_letter= $this->db->where(['user_id' => $user_id, 'email' => $email, 'status!=' => 2])->get('news_letter')->num_rows();
       if($news_letter==0)
       {
         $this->db->insert('news_letter', ['user_id' => $user_id, 'email' => $email, 'status' => 1]);
         $news_latter_data['status']=1;
         
       }
       else
       {
           $news_latter_data['status']=2; 
       }
       return $news_latter_data; 
    }

    public function upload_vendor_image($array, $user_id)
    {
        return $this->db->where('id', $user_id)->update('vendor', $array);
    }


    public function get_vendor_farmer_details($user_id)
    {
        return $this->db->select('vendor.name,vendor.father_name,vendor.gender,vendor.mobile,ifnull(vendor.whatsapp_no,"") as whatsapp_no ,vendor.district_id,district.name as district,vendor.block_id,block.name as block,vendor.tehsil,vendor.village,vendor.pincode,ifnull(vendor.aadhar_no,"") as aadhar_no,vendor.user_id,vendor.field_type as type,ifnull(vendor.profile_image,"") as profile_image')
            ->from('vendor')
            ->join('district', 'district.id = vendor.district_id')
            ->join('block', 'block.id=vendor.block_id')
            ->where(['vendor.id' => $user_id])
            ->get()
            ->row();
    }



    public function delete_product($id)
    {
        $data['status'] = 2;
        return $this->db->where('id', $id)->update('product', $data);
    }
    public function remove_varients($product_id, $variant_id)
    {
        $data['status'] = 2;
        return $this->db->where(['id'=> $variant_id, 'adding_to_id' => $product_id])->update('varient', $data);
    }
    public function remove_product_image($id)
    {
        $data['status'] = 2;
        return $this->db->where('id', $id)->update('product_image', $data);
    }

    public function get_product_variants($product_id)
    {
        return $this->db->select('varient.adding_to_id as product_id,varient.id as varient_id ,varient.category_id,varient.subcat_id as subcategory_id,varient.mrp,varient.price as selling_price,varient.stock_status,varient.top_product as is_top_product,varient.status as approval_status, c1.name as category_name, c2.name as sub_cat_name,ap1.product_name_hindi,ap1.product_name_english')

            ->join('add_product ap1', 'ap1.id = varient.product_name_hindi_id', 'left')
            ->join('add_product ap2', 'ap2.id = varient.product_name_english_id', 'left')
                // ->join('product_image ','product_image.product_id = product.id','left')
            ->join('category c1', 'c1.id= varient.category_id', 'left')
            ->join('subcategory c2', 'c2.id=varient.subcat_id', 'left')
            ->where(['varient.status !=' => 2, 'varient.adding_to_id' => $product_id])
            ->get('varient')
            ->result_array();

    }
    public function varient_image($id)
    {
        return $this->db->select('id,image')->where(['status' => 1, 'varient_id' => $id])->get('product_image')->row_array();
    }
    public function varient_image_all($id)
    {
        return $this->db->select('id,image')->where(['status' => 1, 'varient_id' => $id])->get('product_image')->result_array();
    }
    public function get_filter_product()
    {
        $category_id=$this->input->post('category_id');
        $subcat_id=$this->input->post('subcat_id');
        $status=$this->input->post('status');
       $availabilty=$this->input->post('availabilty');
        $vendor_id=$this->input->post('vendor_id');
        $active_status=$this->input->post('active_status');
            
        if (!empty($category_id)) {
            $this->db->where('product.category_id', $category_id);

        }
        if (!empty($subcat_id)) {
            $this->db->where('product.subcat_id', $subcat_id);

        }
        if ($status!='') {
            //$this->db->where('product.status', $status);
             if($status==4)
              {
            $this->db->where('product.show_user', 1);
              }
               if($status==5)
              {
                  $this->db->where('product.show_user', 0);
              }
               if($status==1)
              {
            $this->db->where('product.status', 1);
              }
               if($status==0)
              {
                  $this->db->where('product.status', 0);
              }
              if($status==3)
              {
                  $this->db->where('product.status', 3);
              }
        }
        
        
        
        
        if ($availabilty!='') {
            $this->db->where('product.stock_status', $availabilty);
        }
         
             
        

        return $this->db->select('product.id as product_id,product.category_id,product.subcat_id as subcategory_id,product.mrp,product.price as selling_price,  product.stock_status,product.top_product as is_top_product,product.status as approval_status, c1.name as category_name, c2.name as sub_cat_name,ap1.product_name_hindi,ap1.product_name_english,product.show_user')
            ->join('add_product ap1', 'ap1.id = product.product_name_hindi_id', 'left')
            ->join('add_product ap2', 'ap2.id = product.product_name_english_id', 'left')
            ->join('category c1', 'c1.id= product.category_id', 'left')
            ->join('subcategory c2', 'c2.id=product.subcat_id', 'left')
            ->where(['product.status !=' => 2,'product.vendor_id'=>$vendor_id])
            ->get('product')
            ->result_array();

    }




    public function get_vendor_details_fao_sho($user_id)
    {
        return $this->db->select('vendor.profile_image,vendor.field_type,vendor.name,vendor.father_name,vendor.email,vendor.reg_no,vendor.promoting_agency,vendor.office_address, vendor.product,vendor.basic_info,vendor.tehsil,vendor.village,vendor.pincode,vendor.aadhar_no,vendor.mobile,vendor.whatsapp_no,vendor.gender,district.name as district, district.id as district_id,block.id as block_id , block.name as block,vendor.user_id,vendor.representative,vendor.bod,vendor.mobile')
            ->from('vendor')
            ->join('district', 'district.id = vendor.district_id')
            ->join('block', 'block.id=vendor.block_id')
            ->where(['vendor.id' => $user_id])
            ->get()
            ->row_array();

    }



    public function get_vendor_bod($user_id)
    {
        // $this->db->get_where('bod',['vendor_id'=>$user_id])->result_array();
        return $this->db->select('bod_image as image ,bod_name as name,bod_mobile as mobile')->from('bod')->where(['vendor_id' => $user_id])->get()->result_array();

    }

    public function update_shop_details($array, $user_id)
    {

        $get_rows = $this->db->get_where('tbl_shopdetails', ['vendor_id' => $user_id])->num_rows();
        if ($get_rows > 0) {
            return $this->db->where(['vendor_id' => $user_id])->update('tbl_shopdetails', $array);
        } else {
            return false;
        }

    }


    public function get_shop_details($user_id)
    {

        $data_row = $this->db->get_where('tbl_shopdetails', ['vendor_id' => $user_id])->result_array();
        if (!empty($data_row)) {
            return $data_row;
        } else {
            return false;
        }
    }


    public function check_old_password($old_password,$user_id)
    {
   return  $this->db->get_where('vendor',['password'=>"$old_password",'id'=>"$user_id"])->row_array();
    }


   public function change_vendor_password($new_password,$user_id,$decry_password){
    return  $this->db->where(['id'=>$user_id])->update('vendor',['password'=>$new_password,'decry_password'=>$decry_password]);
   }
   
   
//   


  public function get_block_status()
    {
        
          
            
        $userdata = array();
        $user_id = $this->input->post('user_id');
        $vendor_data = $this->db->select('user_id,is_block,status')->from('vendor')->where('user_id', $user_id)->get()->row();
        
        return $vendor_data;
        
    }
//   public function get_enquiry($user_id)
//   {
// return $this->db->select('enquiry.id as enquiry_id,enquiry.order_id,enquiry.user_id,users.name,users.mobile,users.email,users.image,enquiry.status')->join('users','users.id=enquiry.user_id','left')->
// where(['enquiry.vendor_id'=>$user_id,'enquiry.status!='=>2])->get('enquiry')->result();
//   }
 public function get_enquiry_with_order_id($user_id)
   {
$x= $this->db->select('enquiry_details.id as enquiry_id, ifnull(enquiry_details.order_id,"") as order_id, enquiry_details.user_id,users.name,users.mobile,users.email,ifnull(users.image,"") as image,enquiry_details.status,enquiry_details.enquiry_type ')->join('users','users.id= enquiry_details.user_id','left')->
where(['enquiry_details.vendor_id'=>$user_id,'enquiry_details.status!='=>2,'enquiry_details.enquiry_type'=>'product'])->order_by('enquiry_details.id')->group_by('enquiry_details.order_id')->
get('enquiry_details')->result();
// echo $this->db->last_query();
 return $x;
   }
   public function get_enquiry_without_order_id($user_id)
   {
$x= $this->db->select('enquiry_details.id as enquiry_id, ifnull(enquiry_details.order_id,"") as order_id, enquiry_details.user_id,users.name,users.mobile,users.email,ifnull(users.image,"") as image,enquiry_details.status,enquiry_details.enquiry_type ')->join('users','users.id= enquiry_details.user_id','left')->
where(['enquiry_details.vendor_id'=>$user_id,'enquiry_details.status!='=>2,'enquiry_details.enquiry_type'=>'general'])->order_by('enquiry_details.id')->
get('enquiry_details')->result();
// echo $this->db->last_query();
 return $x;
   }
  
   
   public function get_varient_by_id($product_id)
    {
        return $this->db->select('varient.id as varient_id,varient.category_id,varient.subcat_id as subcategory_id,varient.mrp,varient.price as selling_price,  varient.stock_status,varient.top_product as is_top_product,varient.status as approval_status,varient.quantity,varient.description,varient.verification_doc,c1.name as category_name, c2.name as sub_cat_name,ap1.product_name_hindi,ap1.product_name_english,varient.product_name_hindi_id as select_product_id,varient.availabe_stock')

            ->join('add_product ap1', 'ap1.id = varient.product_name_hindi_id', 'left')
            ->join('add_product ap2', 'ap2.id = varient.product_name_english_id', 'left')
                // ->join('product_image ','product_image.product_id = product.id','left')
            ->join('category c1', 'c1.id= varient.category_id', 'left')
            ->join('subcategory c2', 'c2.id=varient.subcat_id', 'left')
            ->where(['varient.status !=' => 2, 'varient.id' => $product_id])
            ->get('varient')
            ->row_array();

    }
    
     public function sent_enquiry_for_product_with_order_and_without_order()
    {
        $return_status=array();
        $type=$this->input->post('type');
        $to_id=$this->input->post('to_id');
        $from_id=$this->input->post('from_id');
        $msg=$this->input->post('msg');
  
        if($type=='product')
        {
        $order_id=$this->input->post('order_id');
         $status=$this->input->post('status');
        $reply_data['vendor_msg']= $msg;
          $reply_data['comment_status']= $status;
            $reply_data['is_reply']= 1;
        $array=array('user_id'=> $to_id,'vendor_id'=>  $from_id,'status!='=>2,'enquiry_type'=>'product','order_id'=>$order_id);
             //$this->db->where($array)->update('enquiry',array('status'=>$status));
           $this->db->where($array)->update('enquiry_details',$reply_data);
        if($this->db->affected_rows() == true)
        $return_status['status']=1;
        else
        $return_status['status']=0;
        }
        if($type=='general')
        {
        $enquiry_id=$this->input->post('enquiry_id');
         $status=$this->input->post('status');
        $reply_data['vendor_msg']= $msg;
        $reply_data['comment_status']= $status;
         $reply_data['is_reply']= 1;
        $array=array('user_id'=> $to_id,'vendor_id'=>  $from_id,'status!='=>2,'enquiry_type'=>'general','id'=>$enquiry_id);
        $enquiry_data=$this->db->where($array)->update('enquiry_details',$reply_data);
                if($this->db->affected_rows() == true)
                $return_status['status']=1;
                else
                $return_status['status']=0;

        }
        

    return $return_status;
    
    
    }
    
     public function get_reply_for_enquiry($id)
   {
return $this->db->select('id as msg_id,user_message as msg,vendor_msg as reply_msg,DATE_FORMAT(created_at,"%H:%i %p | %d-%m-%y ") as msg_time,DATE_FORMAT(updated_at,"%H:%i %p | %d-%m-%y ") as reply_time')->
where(['id'=>$id,'status!='=>2])->or_where('parent_id',$id)->get('enquiry')->result();
   }
   
   //26 nov 2022 created by mahek
   
    public function filter_enquiry()
   {
         $type = $this->input->post('type');
        $status = $this->input->post('status');
         $user_id = $this->input->post('user_id');
       if(!empty($type))
       {
           $this->db->where('enquiry_details.enquiry_type',$type);
       }
       if($status!='')
       {
           $this->db->where(['enquiry_details.status'=>$status,'enquiry_details.enquiry_type'=>'product']);
       }
        $this->db->select('enquiry_details.id as enquiry_id, ifnull(enquiry_details.order_id,"") as order_id, enquiry_details.user_id,users.name,users.mobile,users.email,users.image,enquiry_details.status,enquiry_details.enquiry_type')->join('users','users.id= enquiry_details.user_id','left')->
        where([' enquiry_details.vendor_id'=>$user_id,'enquiry_details.status!='=>2,'enquiry_details.enquiry_type!='=>'admin']);
        if($type=='product' || $status!=''){
            $this->db->group_by('enquiry_details.order_id');
        }
        return $this->db->get('enquiry_details')->result();
   }
   
    public function ativate_deactivate_product()
    {
        $userdata=array();
        $product_id=$this->input->post('product_id');
        $vendor_id=$this->input->post('vendor_id');
        $status=$this->input->post('status');
        $array=array('id'=>$product_id,'vendor_id'=>$vendor_id,'status'=>1);
       $product_data= $this->db->where($array)->get('product')->row();
       if(!empty($product_data))
            {
            $update['show_user']= $status;
            $userdata['status']=1;
            }        
        else
        {
             $userdata['status']=2;
        }
        $this->db->where(['id'=>$product_id,'vendor_id'=> $vendor_id])->update('product',$update);
        return $userdata;
    }
public function change_enquiry_status()
    {
         $status=$this->input->post('status');
        $type=$this->input->post('type');
        $vendor_id=$this->input->post('vendor_id');
        if($type=='product')
        {
        $order_id=$this->input->post('order_id');
         $update_data['status']= $status;
        $array=array('vendor_id'=>  $vendor_id,'status!='=>2,'enquiry_type'=>'product','order_id'=>$order_id);
        $this->db->where('id',$order_id)->update('enquiry',$update_data);
        $enquiry_data=$this->db->where($array)->update('enquiry_details',$update_data);
         
        if($this->db->affected_rows() == true)
        {
        $return_status['status']=1;
        }
        else
        {
               $return_status['status']=0;
        }
        }
        if($type=='general')
        {
        $enquiry_id=$this->input->post('enquiry_id');
         $update_data['status']= $status;
        $array=array('vendor_id'=>  $vendor_id,'status!='=>2,'enquiry_type'=>'general','id'=>$enquiry_id);
        $enquiry_data=$this->db->where($array)->update('enquiry_details',$update_data);
        if($this->db->affected_rows() == true)
        {
        $return_status['status']=1;
        }
        else
        {
             $return_status['status']=0;
        }
        }
       
      return  $return_status;
    }
     public function change_seen_status_for_enquiry()
    {
        $return_status=array();
        $vendor_id=$this->input->post('vendor_id');
        $seen_status=$this->input->post('seen_status');
        $type=$this->input->post('type');
          if($type=='product')
        {
        $order_id=$this->input->post('order_id');
         $seen_data['seen_status']= $seen_status;
        $array=array('vendor_id'=>  $vendor_id,'status!='=>2,'enquiry_type'=>'product','order_id'=>$order_id);
        $enquiry_data=$this->db->where($array)->update('enquiry_details',$seen_data);
         
        if($this->db->affected_rows() == true)
        {
        $return_status['status']=1;
        }
        else
        {
               $return_status['status']=0;
        }
        }
        if($type=='general')
        {
        $enquiry_id=$this->input->post('enquiry_id');
        $seen_data['seen_status']= $seen_status;
        $array=array('vendor_id'=>  $vendor_id,'status!='=>2,'enquiry_type'=>'general','id'=>$enquiry_id);
        $enquiry_data=$this->db->where($array)->update('enquiry_details',$seen_data);
        if($this->db->affected_rows() == true)
        {
        $return_status['status']=1;
        }
        else
        {
             $return_status['status']=0;
        }
        }
        
        return $return_status;
        
        
        
       
    }
    
    public function get_enquiry_for_home_with_order_id($user_id)
    {
        return $this->db->select('enquiry_details.id as enquiry_id, enquiry_details.order_id, enquiry_details.user_id,users.name,users.mobile,users.email,users.image,enquiry_details.status,enquiry_details.enquiry_type ')->join('users','users.id= enquiry_details.user_id','left')->
        where(['enquiry_details.vendor_id'=>$user_id,'enquiry_details.status!='=>2,'enquiry_details.seen_status'=>0,'enquiry_details.enquiry_type'=>'product'])->order_by('enquiry_details.id','DESC')->group_by('enquiry_details.order_id')->get('enquiry_details')->result();
    }
     public function get_enquiry_for_home_without_order_id($user_id)
    {
        return $this->db->select('enquiry_details.id as enquiry_id, enquiry_details.order_id, enquiry_details.user_id,users.name,users.mobile,users.email,users.image,enquiry_details.status,enquiry_details.enquiry_type ')->join('users','users.id= enquiry_details.user_id','left')->
        where(['enquiry_details.vendor_id'=>$user_id,'enquiry_details.status!='=>2,'enquiry_details.seen_status'=>0,'enquiry_details.enquiry_type'=>'general'])->order_by('enquiry_details.id','DESC')->get('enquiry_details')->result();
    }
    public function get_enquiry_for_complete_order($user_id)
    {
        return $this->db->where(['enquiry.vendor_id'=>$user_id,'enquiry_details.status'=>4])->
        join('enquiry_details','enquiry_details.order_id=enquiry.id')->
        group_by('enquiry_details.order_id')->get('enquiry')->num_rows();
    }
    public function get_enquiry_for_pending_order($user_id)
    {
        return $this->db->where(['enquiry.vendor_id'=>$user_id,'enquiry_details.status'=>0])->
        join('enquiry_details','enquiry_details.order_id=enquiry.id')->
        group_by('enquiry_details.order_id')->get('enquiry')->num_rows();
    }
    
    public function get_enquiry_for_cancel_order($user_id)
    {
        return $this->db->where(['enquiry.vendor_id'=>$user_id,'enquiry_details.status'=>3])->
        join('enquiry_details','enquiry_details.order_id=enquiry.id')->
        group_by('enquiry_details.order_id')->get('enquiry')->num_rows();
    }
    
    public function change_notification_status($user_id)
    {
        $notification_array=array();
        $data['read_notification']=null;
       return $this->db->where(['id'=>$user_id])->update('vendor',$data); 
                // if($x==0)
                // {
                // $this->db->where(['id'=>$user_id])->update('vendor',$data);
                // $notification_array['status']=1;
                // }
                // else
                // {
                // $notification_data= $this->db->where(['status!='=>2,'id'=>$user_id])->get('vendor')->row();
                // $read_notification_json_array= json_decode($notification_data->read_notification);
                // $read_notification_json_array[]=$id;
                // $new_read_notification_json_array=json_encode($read_notification_json_array);
                // $data['read_notification']=$new_read_notification_json_array;
                // $this->db->where(['id'=>$user_id])->update('vendor',$data); 
                // $notification_array['status']=2;
                // }
        
        //return $notification_array;
    }
    
     public function get_enquiry_by_id_with_order($order_id)
   {
        return $this->db->select('enquiry_details.comment_status,enquiry_details.is_reply,enquiry_details.user_id,users.name,users.mobile,users.email,users.image,enquiry_details.status,enquiry_details.product_id,enquiry_details.order_id,rating_feedback.feedback,rating_feedback.rating_value,ifnull(enquiry_details.user_msg,"") as user_msg,ifnull(enquiry_details.vendor_msg,"") as reply_msg,DATE_FORMAT(enquiry_details.created_at,"%H:%i %p | %d-%m-%y ") as msg_time,DATE_FORMAT(enquiry_details.updated_at,"%H:%i %p | %d-%m-%y ") as reply_time')->
        join('users','users.id=enquiry_details.user_id','left')->join('rating_feedback',' rating_feedback.enquiry_id=enquiry_details.order_id','left')->
        where(['enquiry_details.order_id'=>$order_id,'enquiry_details.status!='=>2])->get('enquiry_details')->row();
   }
   public function get_product_for_enquiry_with_order($order_id)
   {
        return $this->db->select('product.id,product.mrp,product.price as selling_price,ap1.product_name_hindi,ap1.product_name_english,ifnull(product_image.image,"") as image')->join('product','product.id=enquiry_details.product_id','left')->
        join('add_product ap1', 'ap1.id = product.product_name_hindi_id', 'left')->join('add_product ap2', 'ap2.id = product.product_name_english_id', 'left')->join('product_image','product_image.product_id=product.id','left')->
        where(['enquiry_details.order_id'=>$order_id,'enquiry_details.status!='=>2,'enquiry_details.product_id!='=>null])->order_by('enquiry_details.id')->group_by('product.id')->get('enquiry_details')->result();
   }
   public function get_varient_for_enquiry_with_order($order_id)
   {
        return $this->db->select('varient.id,varient.mrp,varient.price as selling_price,ap1.product_name_hindi,ap1.product_name_english,ifnull(product_image.image,"") as image')->join('varient','varient.id=enquiry_details.varient_id','left')->
        join('add_product ap1', 'ap1.id = varient.product_name_hindi_id', 'left')->join('add_product ap2', 'ap2.id = varient.product_name_english_id', 'left')->join('product_image','product_image.varient_id=varient.id','left')->
        where(['enquiry_details.order_id'=>$order_id,'enquiry_details.status!='=>2,'enquiry_details.varient_id!='=>null])->order_by('enquiry_details.id')->group_by('varient.id')->get('enquiry_details')->result();
   }
    public function get_enquiry_by_id_with_enquiry($id)
   {
        return $this->db->select('enquiry_details.is_reply,enquiry_details.comment_status,enquiry_details.user_id,users.name,users.mobile,users.email,users.image,enquiry_details.status,enquiry_details.product_id,enquiry_details.order_id,rating_feedback.feedback,rating_feedback.rating_value,ifnull(enquiry_details.user_msg,"") as user_msg,ifnull(enquiry_details.vendor_msg,"") as reply_msg,DATE_FORMAT(enquiry_details.created_at,"%H:%i %p | %d-%m-%y ") as msg_time,DATE_FORMAT(enquiry_details.updated_at,"%H:%i %p | %d-%m-%y") as reply_time')->
        join('users','users.id=enquiry_details.user_id','left')->join('rating_feedback',' rating_feedback.enquiry_id=enquiry_details.id','left')->where(['enquiry_details.id'=>$id,'enquiry_details.status!='=>2])->get('enquiry_details')->row();
   }
   
    public function get_product_for_enquiry_with_enquiry($id)
    {
        return $this->db->select('product.id,product.mrp,product.price as selling_price,ap1.product_name_hindi,ap1.product_name_english,ifnull(product_image.image,"") as image')->join('product','product.id=enquiry_details.product_id','left')->
        join('add_product ap1', 'ap1.id = product.product_name_hindi_id', 'left')->join('add_product ap2', 'ap2.id = product.product_name_english_id', 'left')->join('product_image','product_image.product_id=product.id','left')->
        where(['enquiry_details.id'=>$id,'enquiry_details.status!='=>2])->order_by('enquiry_details.id')->group_by('product.id')->get('enquiry_details')->result();
    }
    public function get_enquiry_for_order_with_id($type)
    {
        $order_id= $this->input->post('order_id');
        $response = $this->get_enquiry_by_id_with_order($order_id);
        $x = $this->get_product_for_enquiry_with_order($order_id);
        $y = $this->get_varient_for_enquiry_with_order($order_id);
        $product_data=array_merge($x,$y);
        $res[]=array(
            'name'=> $response->name,
            'mobile'=>$response->mobile,
            'email'=> $response->email,
            'image'=>$response->image,
             'order_id'=>$response->order_id,
            'product'=>$product_data,
            'delivered_status'=>$response->status,
              'comment_status'=>$response->comment_status,
             'user_msg'=>$response->user_msg,
             'reply_msg'=>$response->reply_msg,
             'msg_time'=>$response->msg_time,
             'reply_time'=>$response->reply_time,
            'rating_value'=>$response->rating_value?$response->rating_value:0,
            'feedback_msg'=>$response->feedback?$response->feedback:"",
             'is_reply'=>$response->is_reply,
          );
          return $res;
    }
   
   
      public function get_enquiry_for_enquiry_with_id($type)
     {
        $product_array=array();
        $enquiry_id= $this->input->post('enquiry_id');
        $response = $this->get_enquiry_by_id_with_enquiry($enquiry_id);
        $product_data = $this->get_product_for_enquiry_with_enquiry($enquiry_id);
       // echo $this->db->last_query();die();
            $res[]=array(
                'name'=> $response->name,
                'mobile'=>$response->mobile,
                'email'=> $response->email,
                'image'=>$response->image,
                 'order_id'=>isset($response->order_id)?$response->order_id:"",
                'product'=>(!empty($product_data) && $product_data!=null)?$product_data:array()  ,
                'delivered_status'=>$response->status,
                 'comment_status'=>$response->comment_status,
                 'user_msg'=>$response->user_msg,
                 'reply_msg'=>$response->reply_msg,
                 'msg_time'=>$response->msg_time,
                 'reply_time'=>$response->reply_time,
                'rating_value'=>$response->rating_value?$response->rating_value:0,
                'feedback_msg'=>$response->feedback?$response->feedback:"",
                'is_reply'=>$response->is_reply,
              );
              return $res;
    }
}



?>