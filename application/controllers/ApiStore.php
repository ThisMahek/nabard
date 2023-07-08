<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ApiStore extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ApiStore_Model", "AS");
    }
    public function get_distict()
    {
        $data = array();
        $result = $this->AS->get_distict();
        if (!empty($result)) {
            $data['status'] = true;
            $data['data'] = $result;
        } else {
            $data['status'] = false;
            $data['data'] = array();
        }

        echo json_encode($data);
    }

    public function get_block()
    {
        $data = array();
        $district_id = $this->input->post('district_id');
        $result = $this->AS->get_block($district_id);


        if (!empty($result)) {
            $data['status'] = true;
            $data['data'] = $result;
        } else {
            $data['status'] = false;
            $data['data'] = array();
        }

        echo json_encode($data);
    }


    public function get_otp()
    {
        $data = array();
        $response = array();

        $otp = ($this->input->post('otp')) ? $this->input->post('otp') : rand(100000, 999999);
        $phone = $this->input->post('mobile');
        $check_otp = $this->db->where('mobile', $phone)->select('*')->get('tblotp')->num_rows();

        if ($check_otp > 0) {
            $data2['otp'] = $otp;
            $data2['mobile'] = $phone;
            $data2['user_id'] = '';
            $data2['type'] = 'r';
            $this->db->where('mobile', $phone);
            $q2 = $this->db->update('tblotp', $data2);

        } else {
            $id = "";
            $array = array(
                'otp' => $otp,
                'user_id' => '',
                'type' => 'r',
                'mobile' => $phone
            );
            $q2 = $this->db->insert('tblotp', $array);
            // echo $this->db->last_query();die();
        }

        if ($q2) {
            $data['status'] = true;
            $data['otp'] = $otp;
            $data["message"] = 'Otp send successfully';

        } else {
            $data['status'] = false;
            $data["message"] = 'Something went wrong';
        }
        echo json_encode($data);


    }
    public function varify_phone()
    {

        $user_phone = $this->input->post('mobile');
        $id = $this->input->post('user_id');
        if ($id) {
            $this->db->where('id!=', $id);
        }
        $rs = $this->db->where(['mobile' => $user_phone, 'status!=' => 2])->get('vendor')->num_rows();
        // echo $this->db->last_query();die();
        if ($rs == 0) {
            //return $data['code'] = 'HTTP_OK';
            return TRUE;
        } else {

            $this->form_validation->set_message("varify_phone", "Phone number is already exists");
            // return $data['code'] = 'HTTP_NOT_FOUND';
            return FALSE;

        }

    }
    public function varify_email()
    {

        $email = $this->input->post('email');
        $id = $this->input->post('user_id');
        if ($id) {
            $this->db->where('id!=', $id);
        }
        $rs2 = $this->db->where(['email' => $email, 'status!=' => 2])->where('email!=', '')->get('vendor')->num_rows();
        //echo $this->db->last_query();die();
        if ($rs2 == 0) {

            return TRUE;
        } else {

            $this->form_validation->set_message("varify_email", "Email already exists");
            //  return $data['code'] = 'HTTP_NOT_FOUND';
            return FALSE;

        }

    }

    public function varify_aadharno()
    {

        $aadhar_no = $this->input->post('aadhar_no');
        $id = $this->input->post('id');
        if ($id) {
            $this->db->where('id!=', $id);
        }
        $rs2 = $this->db->where(['aadhar_no' => $aadhar_no, 'status!=' => 2])->where('aadhar_no!=', '')->get('vendor')->num_rows();
        //echo $this->db->last_query();die();
        if ($rs2 == 0) {

            return TRUE;
        } else {

            $this->form_validation->set_message("varify_aadharno", "Aadhar no already exist");
            //  return $data['code'] = 'HTTP_NOT_FOUND';
            return FALSE;

        }

    }
    public function varify_whatsappno()
    {

        $whatsapp_no = $this->input->post('whatsapp_no');
        $id = $this->input->post('id');
        if ($id) {
            $this->db->where('id!=', $id);
        }
        $rs2 = $this->db->where(['whatsapp_no' => $whatsapp_no, 'status!=' => 2])->where('whatsapp_no!=', '')->get('vendor')->num_rows();
        //echo $this->db->last_query();die();
        if ($rs2 == 0) {

            return TRUE;
        } else {

            $this->form_validation->set_message("varify_whatsappno", "Whatsapp_no already exist");
            //  return $data['code'] = 'HTTP_NOT_FOUND';
            return FALSE;

        }

    }
    public function varify_userid()
    {

        $user_id = $this->input->post('user_id');
        $id = $this->input->post('id');
        if ($id) {
            $this->db->where('id!=', $id);
        }
        $rs2 = $this->db->where(['user_id' => $user_id, 'status!=' => 2])->get('vendor')->num_rows();
        // echo $this->db->last_query();die();
        if ($rs2 == 0) {

            return TRUE;
        } else {

            $this->form_validation->set_message("varify_userid", "UserId already register");
            //  return $data['code'] = 'HTTP_NOT_FOUND';
            return FALSE;

        }

    }

    public function varify_regno()
    {

        $reg_no = $this->input->post('reg_no');
        $id = $this->input->post('id');
        if ($id) {
            $this->db->where('id!=', $id);
        }
        $rs2 = $this->db->where(['reg_no' => $reg_no, 'status!=' => 2])->get('vendor')->num_rows();

        if ($rs2 == 0) {

            return TRUE;
        } else {

            $this->form_validation->set_message("varify_regno", "Registration No already register");
            //  return $data['code'] = 'HTTP_NOT_FOUND';
            return FALSE;

        }

    }



    public function farmer_register()
    {
        $data = array();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('father_name', 'Father_Name', 'required|trim');
        $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
        $this->form_validation->set_rules('mobile', 'Mobile', 'callback_varify_phone|required');
        $this->form_validation->set_rules('email', 'Email', 'callback_varify_email');
        $this->form_validation->set_rules('whatsapp_no', 'Whatsapp_No', 'callback_varify_whatsappno');
        $this->form_validation->set_rules('aadhar_no', 'Aadhar_No', 'callback_varify_aadharno');
        $this->form_validation->set_rules('district_id', 'District_Id', 'required|trim');
        $this->form_validation->set_rules('block_id', 'Block_Id', 'required|trim');
        $this->form_validation->set_rules('tehsil', 'Tehsil', 'required|trim');
        $this->form_validation->set_rules('village', 'Village', 'required|trim');
        $this->form_validation->set_rules('pincode', 'Pincode', 'required|trim');
        $this->form_validation->set_rules('user_id', 'User_id', 'callback_varify_userid|required');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('otp', 'OTP', 'required|trim');


        if ($this->form_validation->run() == FALSE) {
            $data["status"] = false;
            $data["message"] = strip_tags($this->form_validation->error_string());
        } else {

            $userdata = $this->AS->farmar_register();
            //print_r($userdata);exit;
//   echo $this->db->last_query();die();
            if ($userdata['status'] == 1) {

                $data['status'] = true;
                $data['message'] = 'Register successfully';
                //  $data['data']=$userdata;
            } else if ($userdata['status'] == 2) {
                $data['status'] = false;
                $data['message'] = 'Invalid otp';
                $data['data'] = array();
            } else if ($userdata['status'] == 3) {
                $data['status'] = false;
                $data['message'] = 'Phone number does not exist';
                $data['data'] = array();
            } else if ($userdata['status'] == 4) {
                $data['status'] = false;
                $data['message'] = 'Otp expired !Please try again';

                $data['data'] = array();
            } else {
                $data['status'] = false;
                $data['message'] = 'Unable to resgister';
                $data['data'] = array();
            }

        }

        echo json_encode($data);

    }

    public function fpo_sho_register()
    {
        $data = array();
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('representative', 'Representative', 'required|trim');
        $this->form_validation->set_rules('bod', 'Bod', 'required|trim');
        $this->form_validation->set_rules('mobile', 'Mobile', 'callback_varify_phone|required');
        $this->form_validation->set_rules('email', 'Email', 'callback_varify_email');
        $this->form_validation->set_rules('reg_no', 'Reg_No', 'callback_varify_regno|required');
        $this->form_validation->set_rules('district_id', 'District_Id', 'required|trim');
        $this->form_validation->set_rules('block_id', 'Block_Id', 'required|trim');
        $this->form_validation->set_rules('office_address', 'Office_Address', 'required|trim');
        $this->form_validation->set_rules('product', 'Product', 'required|trim');
        $this->form_validation->set_rules('basic_info', 'Basic_Info', 'required|trim');
        $this->form_validation->set_rules('user_id', 'User_id', 'callback_varify_userid|required');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('otp', 'OTP', 'required|trim');


        if ($this->form_validation->run() == FALSE) {
            $data["status"] = false;
            $data["message"] = strip_tags($this->form_validation->error_string());
        } else {

            $userdata = $this->AS->fpo_sho_register();
            //print_r($userdata);exit;
//   echo $this->db->last_query();die();
            if ($userdata['status'] == 1) {

                $data['status'] = true;
                $data['message'] = 'Register successfully';
                //  $data['data']=$userdata;
            } else if ($userdata['status'] == 2) {
                $data['status'] = false;
                $data['message'] = 'Invalid otp';
                $data['data'] = array();
            } else if ($userdata['status'] == 3) {
                $data['status'] = false;
                $data['message'] = 'Phone number does not exist';
                $data['data'] = array();
            } else if ($userdata['status'] == 4) {
                $data['status'] = false;
                $data['message'] = 'Otp expired !Please try again';
                $data['data'] = array();
            } else {
                $data['status'] = false;
                $data['message'] = 'Unable to resgister';
                $data['data'] = array();
            }

        }

        echo json_encode($data);

    }
    // Login Api
    public function login()
    {
        $data = array();
        $this->form_validation->set_rules('user_id', 'User_Id', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        // $this->form_validation->set_rules('type', 'Type', 'required|trim');

        if ($this->form_validation->run() == TRUE) {
            $userdata = $this->AS->login_get();


            // echo "<pre>";
            // print_r($userdata);exit;
            if ($userdata['login_status'] == 1) {

                $data['status'] = true;
                $data['message'] = 'Login successfully';
                $data['data'] = $userdata;
            } else if (($userdata['login_status'] == 4)) {
                $data['status'] = false;
                $data['message'] = 'You have blocked by Admin';
            } else if ($userdata['login_status'] == 0) {
                $data['status'] = false;
                $data['message'] = 'User does not exits ';

            } else if ($userdata['login_status'] == 3) {
                $data['status'] = false;
                $data['message'] = 'Your account is inactive';

            } else if ($userdata['login_status'] == 2) {
                $data['status'] = false;
                $data['message'] = 'Invalid password';
            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }

        echo json_encode($data);

    }
    public function get_policy()
    {
        $data = array();
        $type = $this->input->post('type');

        $result_data = $this->db->select('privacy_policy,term_condition,return_policies')->where('status', 1)->get('privacy_policy')->row();
        if ($type == '1') {
            $result = array('privacy_policy' => $result_data->privacy_policy);
        } elseif ($type == '2') {
            $result = array('term_condition' => $result_data->term_condition);

        } else {
            $result = $result_data;
        }
        if (!empty($result)) {
            $data['data'] = $result;
            $data['status'] = true;
        } else {
            $data['status'] = false;
            $data['data'] = array();
        }

        echo json_encode($data);
    }


    public function get_vendor_block_status()
    {
        $data = array();
        $this->form_validation->set_rules('user_id', 'User_Id', 'required|trim');
        if ($this->form_validation->run() == TRUE) {
            $userdata = $this->AS->get_block_status();
            $data['status'] = true;
            $data['data'] = $userdata;
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }

        echo json_encode($data);

    }

    public function get_otp_for_reset_password()
    {
        $this->form_validation->set_rules('mobile', 'mobile', 'trim|required');
        if ($this->form_validation->run() == true) {
            $mobile = $this->input->post('mobile');
            $check_res = $this->AS->check_vender_exists($mobile);

            //print_r($check_res);exit;
            /* // echo $check_res;exit; */
            if ($check_res['status'] == 1) {
                $otp = ozekiOTP(6, "signup", $mobile);
                $response = $this->AS->insert_reset_otp($mobile, $otp);
                if ($response) {
                    $data['status'] = true;
                    $data['otp'] = $otp;
                    $data["message"] = 'Otp send successfully';
                } else {
                    $data['status'] = false;
                    $data["message"] = 'Something went wrong';
                }

                // echo json_encode($data);
            } elseif ($check_res['status'] == 2) {

                $data['status'] = false;
                $data["message"] = 'Your account in inactive';
            } else {

                $data['status'] = false;
                $data["message"] = 'Vendor not Exist';
            }
            // echo json_encode($data);
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
            // echo validation_errors();
        }
        echo json_encode($data);


    }


    public function verify_otp()
    {
        $this->form_validation->set_rules('mobile', 'mobile', 'trim|required');
        $this->form_validation->set_rules('otp', 'otp', 'trim|required');
        if ($this->form_validation->run() == true) {
            $array = array(
                'otp' => $this->input->post('otp'),
                'mobile' => $this->input->post('mobile'),
                'type' => 'f',
            );
            $x = $this->db->where($array)->get('tblotp');
            $otp_timedata = $this->db->get('app_setting')->row();
            $otp_data = $x->row();
            $date = date("Y-m-d H:i:s", strtotime($otp_data->updated_at . ' +' . $otp_timedata->otp_time . ' seconds'));
            $current_date = date("Y-m-d H:i:s");

            if ($date > $current_date) {
                if ($x->num_rows() > 0) {
                    $data["message"] = "Otp verified successfully";
                    $data['status'] = true;
                } else {
                    $data["message"] = "Invalid otp";
                    $data['status'] = false;
                }
            } else {
                $data['message'] = 'Otp expired !Please try again';
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());

        }
        echo json_encode($data);
    }

    public function reset_password()
    {

        // if (isset($_POST['new_password']) && isset($_POST['confirm_password']) && isset($_POST['mobile'])) {
        $data = array();
        $this->form_validation->set_rules('new_password', 'New_Password', 'required|trim');
        //$this->form_validation->set_rules('confirm_password', 'Confirm_Password', 'required|trim');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|trim');

        if ($this->form_validation->run() == TRUE) {
            // if ($_POST['new_password'] == $_POST['confirm_password']) 
            // {
            $updater['password'] = md5($_POST['new_password']);
            $updater['decry_password'] = $_POST['new_password'];
            $this->db->where('mobile', $this->input->post('mobile'))->or_where('email', $this->input->post('mobile'));
            $this->db->update('vendor', $updater);
            //  echo $this->db->last_query();
            if ($this->db->affected_rows() == true) {
                $data['status'] = true;
                $data['message'] = 'Password reset successfully';
            } else {
                $data['status'] = false;
                // $data['message'] = 'Try with different password';
                $data['message'] = 'Please enter new password';
            }
            // } 

            // else {
            //     $data['status'] = false;
            //     $data['message'] = 'Password and confirm password does not match';
            // }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());

        }

        echo json_encode($data);

    }

    public function change_password()
    {

        $user_id = $this->input->post('user_id');
        $old_password = $this->input->post('old_password');
        $new_password = $this->input->post('new_password');
        $data = array();
        $this->form_validation->set_rules('new_password', 'New_Password', 'required|trim');
        $this->form_validation->set_rules('old_password', 'Old Password', 'required|trim');
        $this->form_validation->set_rules('user_id', 'user_Id', 'required|trim');

        if ($this->form_validation->run() == TRUE) {

            $old_password = md5($old_password);
            $new_password = md5($new_password);
            $decry_password = $new_password;
            $check_user = $this->db->where(['id' => $user_id, 'status' => 1])->get('vendor')->row();

            if (!empty($check_user)) {
                $check_password = $this->AS->check_old_password($old_password, $user_id);
                if (!empty($check_password)) {
                    $update = $this->AS->change_vendor_password($new_password, $user_id, $decry_password);
                    if ($this->db->affected_rows() == true) {
                        $data['status'] = true;
                        $data['message'] = 'Password changed successfully';
                    } else {
                        $data['status'] = false;
                        //  $data['message'] = 'Try with different password';
                        $data['message'] = 'Please enter new password';
                    }
                } else {
                    $data['status'] = false;
                    $data['message'] = 'Old Password does not matched';
                }
            } else {
                $data['status'] = false;
                $data['message'] = 'Vendor does not exist';
            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }
        echo json_encode($data);
    }
    //date 19-nov-2022
    public function get_category()
    {
        $data = array();
        $category = $this->db->select('id,name,name_hindi')->get_where('category', ['status' => 1])->result_array();
        if (!empty($category)) {
            $data['status'] = true;
            $data['data'] = $category;
        } else {
            $data['status'] = false;
            $data['message'] = "Category doesn't exist";
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    public function get_sub_category()
    {
        $this->form_validation->set_rules('category_id', 'category_id', 'trim|required');
        if ($this->form_validation->run() == true) {
            $cat_id = $this->input->post('category_id');
            $cat_id = $cat_id ? $cat_id : 1;
            $sub_category = $this->db->select('id,name,name_hindi')->get_where('subcategory', ['status' => 1, 'parent_id' => $cat_id])->result_array();
            $data = array();
            if (!empty($sub_category)) {
                $data['status'] = true;
                $data['data'] = $sub_category;
            } else {
                $data['status'] = false;
                $data['message'] = "Sub category doesn't exist";
            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function get_product()
    {
        $data = array();
        $this->form_validation->set_rules('category_id', 'category_id', 'trim|required');
        $this->form_validation->set_rules('subcat_id', 'subcat_id', 'trim|required');
        if ($this->form_validation->run() == true) {
            $category_id = $this->input->post('category_id');
            $sub_category_id = $this->input->post('subcat_id');
            $product_data = $this->db->select('id,product_name_hindi,product_name_english')->where(['subcategory_id' => $sub_category_id, 'category_id' => $category_id, 'status' => 1])->get('add_product')->result();
            if (!empty($product_data)) {
                $data['status'] = true;
                $data['data'] = $product_data;
            } else {
                $data['status'] = false;
                $data['message'] = "Product doesn't exist";
                $data['data'] = array();
            }

        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);

    }


    public function add_product()
    {

        $vendor_id = $this->input->post('vendor_id');
        $category_id = $this->input->post('category_id');
        $sub_category_id = $this->input->post('subcat_id');
        $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;
        $quntity = $this->input->post('quantity');
        $description = $this->input->post('description');
        $type = $this->input->post('type');
        //$type = $this->input->post('type') ? 'varient' : 'new_product';
        $this->form_validation->set_rules('category_id', 'category_id', 'trim|required');
        $this->form_validation->set_rules('subcat_id', 'subcat_id', 'trim|required');
        $this->form_validation->set_rules('product_id', 'Product_Id', 'trim|required');
        $this->form_validation->set_rules('vendor_id', 'Vendor_Id', 'trim|required');
        $this->form_validation->set_rules('type', 'type', 'trim|required');
        if ($type == 'varient') {
            $this->form_validation->set_rules('adding_to_id', 'Adding_to_id', 'trim|required');
        }
        $this->form_validation->set_rules('quantity', 'quantity', 'trim|required');
        $this->form_validation->set_rules('description', 'description', 'trim|required');
        if ($this->form_validation->run() == true) {
            $vendor_data = $this->db->where(['vendor_id' => $vendor_id, 'status' => 1])->get('tbl_shopdetails')->row();
            $array['category_id'] = $category_id;
            $array['subcat_id'] = $sub_category_id;
            $array['product_name_hindi_id'] = $product_id;
            $array['product_name_english_id'] = $product_id;
            $array['quantity'] = $quntity;
            $array['description'] = $description;
            $array['vendor_id'] = $vendor_id;
            $array['status'] = 0;
            if ($type == 'varient') {
                if ($vendor_data->name != null && $vendor_data->email != null && $vendor_data->mobile != null && $vendor_data->district != null && $vendor_data->tehsil != null && $vendor_data->village != null && $vendor_data->block != null && $vendor_data->pincode != null) {
                    $array['adding_to_id'] = $this->input->post('adding_to_id');
                    $response_varient = $this->AS->insert_varient_product_id($array);
                    $post = (isset($_POST['data'])) ? json_decode($_POST['data']) : array();
                    if (!empty($post)) {
                        foreach ($post as $post_data) {
                            $check_id = isset($post_data->id) ? $post_data->id : '';
                            if ($check_id == null || $check_id == " ") {
                                $files = $post_data->image;
                                $upload_path = 'upload/product/';
                                $image['image'] = $this->AS->set_upload_files($upload_path, $files, 'png');
                                $image['varient_id'] = $response_varient;
                                $image['status'] = 1;
                                $this->db->insert('product_image', $image);
                            }
                        }
                    }
                    if ($response_varient) {
                        $data['status'] = true;
                        $data['message'] = "Varient added successfully";
                        $data['id'] = $response_varient;
                    } else {
                        $data['status'] = false;
                        $data['message'] = "Unable to added varient";
                    }
                } else {
                    $data['status'] = false;
                    $data['message'] = "Firstly add shop details!";
                }
            } else {
                if ($vendor_data->name != null && $vendor_data->email != null && $vendor_data->mobile != null && $vendor_data->district != null && $vendor_data->tehsil != null && $vendor_data->village != null && $vendor_data->block != null && $vendor_data->pincode != null) {
                    $response_product = $this->AS->insert_product_details($array);
                    $post = (isset($_POST['data'])) ? json_decode($_POST['data']) : array();
                    if (!empty($post)) {

                        foreach ($post as $post_data) {
                            $check_id = isset($post_data->id) ? $post_data->id : '';
                            if ($check_id == null || $check_id == " ") {

                                $files = $post_data->image;
                                $upload_path = 'upload/product/';
                                $image['image'] = $this->AS->set_upload_files($upload_path, $files, 'png');
                                $image['product_id'] = $response_product;
                                $image['status'] = 1;
                                $this->db->insert('product_image', $image);
                            }
                        }
                    }
                    if ($response_product) {
                        $data['status'] = true;
                        $data['message'] = "Product added successfully";
                        $data['id'] = $response_product;
                    } else {
                        $data['status'] = false;
                        $data['message'] = "Unable to added product";
                    }
                } else {
                    $data['status'] = false;
                    $data['message'] = "Firstly add shop details!";
                }
            }

        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());

        }
        echo json_encode($data);
    }

    public function update_product()
    {

        $id = $this->input->post('id');
        $category_id = $this->input->post('category_id');
        $sub_category_id = $this->input->post('subcat_id');
        $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;
        $quntity = $this->input->post('quantity');
        $description = $this->input->post('description');
        $type = $this->input->post('type');
        //$type = $this->input->post('type') ? 'varient' : 'new_product';
        $this->form_validation->set_rules('category_id', 'category_id', 'trim|required');
        $this->form_validation->set_rules('subcat_id', 'subcat_id', 'trim|required');
        $this->form_validation->set_rules('product_id', 'Product_Id', 'trim|required');
        $this->form_validation->set_rules('id', 'Id', 'trim|required');
        $this->form_validation->set_rules('type', 'type', 'trim|required');
        if ($type == 'varient') {
            $this->form_validation->set_rules('adding_to_id', 'Adding_to_id', 'trim|required');
        }
        $this->form_validation->set_rules('quantity', 'quantity', 'trim|required');
        $this->form_validation->set_rules('description', 'description', 'trim|required');
        if ($this->form_validation->run() == true) {
            $array['category_id'] = $category_id;
            $array['subcat_id'] = $sub_category_id;
            $array['product_name_hindi_id'] = $product_id;
            $array['product_name_english_id'] = $product_id;
            $array['quantity'] = $quntity;
            $array['description'] = $description;
            if ($type == 'varient') {
                $varient_data = $this->db->where('id', $id)->get('varient')->row();
                $vendor_data = $this->db->where(['vendor_id' => $varient_data->vendor_id, 'status' => 1])->get('tbl_shopdetails')->row();
                if ($vendor_data->name != null && $vendor_data->email != null && $vendor_data->mobile != null && $vendor_data->district != null && $vendor_data->tehsil != null && $vendor_data->village != null && $vendor_data->block != null && $vendor_data->pincode != null) {
                    $array['adding_to_id'] = $this->input->post('adding_to_id');
                    $response_varient = $this->AS->update_varient_product_id($array, $id);
                    $post = (isset($_POST['data'])) ? json_decode($_POST['data']) : array();
                    if (!empty($post)) {
                        foreach ($post as $post_data) {
                            $check_id = isset($post_data->id) ? $post_data->id : '';
                            if ($check_id == null || $check_id == " ") {
                                $files = $post_data->image;
                                $upload_path = 'upload/product/';
                                $image['image'] = $this->AS->set_upload_files($upload_path, $files, 'png');
                                $image['varient_id'] = $id;
                                $image['status'] = 1;
                                $this->db->insert('product_image', $image);
                            }
                        }
                    }
                    if ($response_varient) {
                        $data['status'] = true;
                        $data['message'] = "Varient updated successfully";
                    } else {
                        $data['status'] = false;
                        $data['message'] = "Unable to update varient";
                    }
                } else {
                    $data['status'] = false;
                    $data['message'] = "Firstly add shop details!";
                }

            } else {
                $product_data = $this->db->where('id', $id)->get('product')->row();
                $vendor_data = $this->db->where(['vendor_id' => $product_data->vendor_id, 'status' => 1])->get('tbl_shopdetails')->row();
                if ($vendor_data->name != null && $vendor_data->email != null && $vendor_data->mobile != null && $vendor_data->district != null && $vendor_data->tehsil != null && $vendor_data->village != null && $vendor_data->block != null && $vendor_data->pincode != null) {
                    $response_product = $this->AS->update_product_details($array, $id);
                    $post = (isset($_POST['data'])) ? json_decode($_POST['data']) : array();
                    if (!empty($post)) {
                        foreach ($post as $post_data) {
                            $check_id = isset($post_data->id) ? $post_data->id : '';
                            if ($check_id == null || $check_id == " ") {
                                $files = $post_data->image;
                                $upload_path = 'upload/product/';
                                $image['image'] = $this->AS->set_upload_files($upload_path, $files, 'png');
                                $image['product_id'] = $id;
                                $image['status'] = 1;
                                $this->db->insert('product_image', $image);
                            }
                        }
                    }
                    if ($response_product) {

                        $data['status'] = true;
                        $data['message'] = "Product updated successfully";
                    } else {
                        $data['status'] = false;
                        $data['message'] = "Unable to update product";
                    }
                } else {
                    $data['status'] = false;
                    $data['message'] = "Firstly add shop details!";
                }
            }



        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());

        }
        echo json_encode($data);
    }


    public function add_product_price()
    {
        $product_id = $this->input->post('product_id');
        $mrp = $this->input->post('mrp');
        $selling_price = $this->input->post('selling_price');
        $type = $this->input->post('type');
        $key = $this->input->post('key');
        $this->form_validation->set_rules('product_id', 'product_id', 'trim|required');
        $this->form_validation->set_rules('mrp', 'mrp', 'trim|required');
        $this->form_validation->set_rules('selling_price', 'selling_price', 'trim|required');
        $this->form_validation->set_rules('type', 'type', 'trim|required');
        $this->form_validation->set_rules('key', 'Key', 'trim|required');
        if ($type == 'varient') {
            $this->form_validation->set_rules('adding_to_id', 'Adding_to_id', 'trim|required');
        }
        if ($this->form_validation->run() == true) {

            if ($type == 'varient') {
                $varient_id = $this->input->post('adding_to_id');
                $response_varient = $this->AS->update_varient_price($varient_id, $product_id, $mrp, $selling_price);
                if ($key == 'add') {
                    if ($response_varient) {
                        $data['status'] = true;
                        $data['message'] = "Varient price added successfully";
                    } else {
                        $data['status'] = false;
                        $data['message'] = "Unable to add varient price";
                    }
                } else {
                    if ($response_varient) {
                        $data['status'] = true;
                        $data['message'] = "Varient price updated successfully";
                    } else {
                        $data['status'] = false;
                        $data['message'] = "Unable to update varient price";
                    }
                }
            } else {
                $response_product = $this->AS->update_product_price($product_id, $mrp, $selling_price);
                if ($key == 'add') {
                    if ($response_product) {
                        $data['status'] = true;
                        $data['message'] = "Product  price added successfully";
                    } else {
                        $data['status'] = false;
                        $data['message'] = "Unable to added product price";
                    }
                } else {
                    if ($response_product) {
                        $data['status'] = true;
                        $data['message'] = "Product  price updated successfully";
                    } else {
                        $data['status'] = false;
                        $data['message'] = "Unable to update product price";
                    }
                }

            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }

        echo json_encode($data);


    }
    public function add_stock()
    {
        $product_id = $this->input->post('product_id');
        $stock_management = $this->input->post('stock_management');
        $available_stock = $this->input->post('available_stock');
        $top_product = $this->input->post('top_product');
        $type = $this->input->post('type');
        $key = $this->input->post('key');
        $this->form_validation->set_rules('product_id', 'product_id', 'trim|required');
        $this->form_validation->set_rules('available_stock', 'available_stock', 'trim|required');
        $this->form_validation->set_rules('stock_management', 'stock_management', 'trim|required');
        $this->form_validation->set_rules('top_product', 'top_product', 'trim|required');
        $this->form_validation->set_rules('type', 'type', 'trim|required');
        $this->form_validation->set_rules('key', 'Key', 'trim|required');
        if ($type == 'varient') {
            $this->form_validation->set_rules('adding_to_id', 'Adding_to_id', 'trim|required');
        }
        if ($this->form_validation->run() == true) {
            // $files = $_POST['verification_doc'] ? $_POST['verification_doc'] : '';
            $array = [];
            if (isset($_POST['verification_doc']) && $this->input->post('doc_type') == 'image') {
                $files = $this->input->post('verification_doc');
                $upload_path = 'upload/verification_doc';
                $array['verification_doc'] = $this->AS->set_upload_files($upload_path, $files, 'jpg');
            } elseif (!empty($_POST['verification_doc']) && $this->input->post('doc_type') == 'pdf') {
                $files = $this->input->post('verification_doc');
                $upload_path = 'upload/verification_doc';
                $array['verification_doc'] = $this->AS->set_upload_files($upload_path, $files, 'pdf');
                //$array['verification_doc'] = '';
            } elseif (empty($_POST['verification_doc'])) {
                //  $files = $this->input->post('verification_doc');
                // $upload_path = 'upload/verification_doc';
                $array['verification_doc'] = '';
                //$array['verification_doc'] = '';
            }

            $array['stock_status'] = $stock_management;
            $array['availabe_stock'] = $available_stock;
            $array['top_product'] = $top_product;

            // echo "<pre>";
            // print_r($array);exit;


            if ($type == 'varient') {
                $varient_id = $this->input->post('adding_to_id');
                $response_varient = $this->AS->update_varient_stock($array, $product_id, $varient_id);
                if ($key == 'add') {
                    if ($response_varient) {
                        $data['status'] = true;
                        $data['message'] = "Varient stock added successfully";
                    } else {
                        $data['status'] = false;
                        $data['message'] = "Unable to add varient stock";
                    }
                } else {
                    if ($response_varient) {
                        $data['status'] = true;
                        $data['message'] = "Varient stock updated successfully";
                    } else {
                        $data['status'] = false;
                        $data['message'] = "Unable to update varient stock";
                    }
                }


            } else {
                $response_product = $this->AS->update_product_stock($array, $product_id);
                if ($key == 'add') {
                    if ($response_product == 1) {
                        $data['status'] = true;
                        $data['message'] = "Product stock added successfully";
                    } else {
                        $data['status'] = false;
                        $data['message'] = "Unable to add product stock";
                    }
                } else {
                    if ($response_product == 1) {
                        $data['status'] = true;
                        $data['message'] = "Product stock updated successfully";
                    } else {
                        $data['status'] = false;
                        $data['message'] = "Unable to update product stock";
                    }
                }

            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());

        }
        echo json_encode($data);
    }

    public function get_my_products()
    {
        $user_id = $this->input->post('user_id');
        $res = array();
        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
        if ($this->form_validation->run() == true) {
            $response = $this->AS->get_my_product($user_id);
            // print_r($response);exit;
            if (!empty($response)) {
                foreach ($response as $d) {
                    $product_image = $this->AS->product_image_for_vendor($d['product_id']);
                    $res[] = array(
                        'product_id' => $d['product_id'],
                        'product_name_hindi' => $d['product_name_hindi'],
                        'product_name_english' => $d['product_name_english'],
                        'image' => (!empty($product_image['image']) ? $product_image['image'] : ""),
                        'category_id' => $d['category_id'],
                        'category_name' => $d['category_name'],
                        'subcategory_id' => $d['subcategory_id'],
                        'sub_cat_name' => $d['sub_cat_name'],
                        'mrp' => $d['mrp'] ? $d['mrp'] : "",
                        'selling_price' => $d['selling_price'] ? $d['selling_price'] : "",
                        'stock_status' => $d['stock_status'],
                        'is_top_product' => $d['is_top_product'],
                        'approval_status' => $d['approval_status'],
                        'active_status' => $d['show_user'],

                    );
                }

                $data['status'] = true;
                $data['data'] = $res;


            } else {
                $data['status'] = false;
                $data['data'] = array();
            }

        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());

        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);

    }

    public function get_product_by_id()
    {
        $product_id = $this->input->post('product_id');
        $res = array();
        $this->form_validation->set_rules('product_id', 'product_id', 'trim|required');
        if ($this->form_validation->run() == true) {

            $d = $this->AS->get_product_by_id($product_id);

            if (!empty($d)) {

                $product_image = $this->AS->product_image($d['product_id']);

                $res[] = array(
                    'product_id' => $d['product_id'],
                    'product_name_hindi' => $d['product_name_hindi'],
                    'product_name_english' => $d['product_name_english'],
                    'select_product_id' => $d['select_product_id'],
                    'availabe_stock' => $d['availabe_stock'],
                    'image' => $product_image,
                    'category_id' => $d['category_id'],
                    'category_name' => $d['category_name'],
                    'subcategory_id' => $d['subcategory_id'],
                    'sub_cat_name' => $d['sub_cat_name'],
                    'mrp' => $d['mrp'] ? $d['mrp'] : "",
                    'selling_price' => $d['selling_price'] ? $d['selling_price'] : "",
                    'quantity' => $d['quantity'],
                    'description' => $d['description'],
                    'stock_status' => $d['stock_status'],
                    'is_top_product' => $d['is_top_product'],
                    'approval_status' => $d['approval_status'],
                    'product_doc' => $d['verification_doc'],

                );


                $data['status'] = true;
                $data['data'] = $res;


            } else {
                $data['status'] = false;
                $data['data'] = array();
            }

        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());

        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);

    }

    public function subscribe_news_letter()
    {
        $this->form_validation->set_rules('user_id', 'User id', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        if ($this->form_validation->run() == true) {
            $user_id = $this->input->post('user_id');
            $email = $this->input->post('email');
            $response = $this->AS->insert_news_letters($user_id, $email);
            // print_r($response);exit;
            if ($response['status'] == 1) {
                $data['status'] = true;
                $data['message'] = "News letter added successfully";

            } elseif ($response['status'] == 2) {
                $data['status'] = false;
                $data['message'] = "News letter already exists";

            } else {
                $data['status'] = false;
                $data['message'] = "News letter not added successfully";
            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());

        }
        echo json_encode($data);

    }
    public function upload_profile_image()
    {
        $user_id = $this->input->post('user_id');
        $this->form_validation->set_rules('user_id', 'User id', 'trim|required');
        if ($this->form_validation->run() == true) {
            if (isset($_POST['image'])) {
                $files = $_POST['image'];
                $upload_path = 'upload/profile_image/';
                $array['profile_image'] = $this->AS->set_upload_files($upload_path, $files, 'png');
                $response = $this->AS->upload_vendor_image($array, $user_id);
            }
            if ($response == 1) {
                $data['status'] = true;
                $data['message'] = "Profile image updated successfully";
                $data['img_link'] = $array['profile_image'];
            } else {
                $data['status'] = false;
                $data['message'] = "Profile image not updated successfully";
            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }
        echo json_encode($data);

    }


    public function get_personal_details()
    {

        $user_id = $this->input->post('user_id');
        $array = array();
        $array1 = array();
        $this->form_validation->set_rules('user_id', 'User id', 'trim|required');
        $vendor_row = $this->db->get_where('vendor', ['id' => $user_id])->row_array();

        if ($this->form_validation->run() == true) {
            if ($vendor_row['field_type'] == 'farmer') {
                $array2 = $this->AS->get_vendor_farmer_details($user_id);
                if (!empty($array2)) {

                    $data['status'] = true;
                    $data['data'] = $array2;
                } else {
                    $data['status'] = false;
                    $data['message'] = "Details doesn't exist";
                }
            } else {
                $array = $this->AS->get_vendor_details_fao_sho($user_id);
                $bod_array = $this->AS->get_vendor_bod($user_id);

                if (!empty($array)) {
                    $array1['name'] = $array['name'] ? $array['name'] : '';
                    $array1['bod_list'] = $bod_array;
                    $array1['email'] = $array['email'] ? $array['email'] : '';
                    $array1['reg_no'] = $array['reg_no'] ? $array['reg_no'] : '';
                    $array1['promoting_agency'] = $array['promoting_agency'] ? $array['promoting_agency'] : '';
                    $array1['office_address'] = $array['office_address'] ? $array['office_address'] : '';
                    $array1['district'] = $array['district'] ? $array['district'] : '';
                    $array1['district_id'] = $array['district_id'] ? $array['district_id'] : '';
                    $array1['block'] = $array['block'] ? $array['block'] : '';
                    $array1['block_id'] = $array['block_id'] ? $array['block_id'] : '';
                    $array1['product'] = $array['product'] ? $array['product'] : '';
                    $array1['basic_info'] = $array['basic_info'] ? $array['basic_info'] : '';
                    $array1['user_id'] = $array['user_id'] ? $array['user_id'] : '';
                    $array1['type'] = $array['field_type'] ? $array['field_type'] : '';
                    $array1['profile_image'] = isset($array['profile_image']) ? $array['profile_image'] : '';
                    $array1['representative'] = $array['representative'] ? $array['representative'] : '';
                    $array1['mobile'] = $array['mobile'] ? $array['mobile'] : '';
                    $data['status'] = true;
                    $data['data'] = $array1;
                } else {
                    $data['status'] = false;
                    $data['message'] = "Details doesn't exist";
                }

            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }
        echo json_encode($data);
    }



    public function delete_product()
    {
        $id = $this->input->post('product_id');
        $data = array();
        $this->form_validation->set_rules('product_id', 'product_id', 'required|trim');

        if ($this->form_validation->run() == TRUE) {
            $userdata = $this->AS->delete_product($id);

            if ($this->db->affected_rows() == true) {

                $data['status'] = true;
                $data['message'] = 'Product deleted successfully';

            } else {
                $data['status'] = false;
                $data['message'] = 'Unable to delete product';
            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }

        echo json_encode($data);

    }


    public function remove_varients()
    {
        $product_id = $this->input->post('product_id');
        $variant_id = $this->input->post('variant_id');
        $data = array();
        $this->form_validation->set_rules('product_id', 'product_id', 'required|trim');
        $this->form_validation->set_rules('variant_id', 'variant_id', 'required|trim');


        if ($this->form_validation->run() == TRUE) {
            $this->AS->remove_varients($product_id, $variant_id);
            // echo $this->db->last_query();die();
            if ($this->db->affected_rows() == true) {

                $data['status'] = true;
                $data['message'] = 'Varient deleted successfully';

            } else {
                $data['status'] = false;
                $data['message'] = 'Unable to delete varient';
            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }

        echo json_encode($data);

    }

    public function remove_image()
    {

        $image_id = $this->input->post('image_id');
        $data = array();

        $this->form_validation->set_rules('image_id', 'image_id', 'required|trim');


        if ($this->form_validation->run() == TRUE) {
            $userdata = $this->AS->remove_product_image($image_id);

            if ($this->db->affected_rows() == true) {

                $data['status'] = true;
                $data['message'] = 'Image deleted successfully';

            } else {
                $data['status'] = false;
                $data['message'] = 'Unable to delete image';
            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }

        echo json_encode($data);

    }

    public function get_product_variants()
    {
        $product_id = $this->input->post('product_id');
        $res = array();
        $this->form_validation->set_rules('product_id', 'product_id', 'trim|required');
        if ($this->form_validation->run() == true) {

            $response = $this->AS->get_product_variants($product_id);
            // echo $this->db->last_query();die();
            if (!empty($response)) {
                foreach ($response as $d) {
                    $varient_image = $this->AS->varient_image($d['varient_id']);
                    //print_r($varient_image['image']);

                    // echo $this->db->last_query();die();
                    $res[] = array(
                        'product_id' => $d['product_id'],
                        'varient_id' => $d['varient_id'],
                        'product_name_hindi' => $d['product_name_hindi'],
                        'product_name_english' => $d['product_name_english'],
                        'image' => (isset($varient_image['image']) ? $varient_image['image'] : ""),
                        //    'category_id'=>$d['category_id'],
                        //    'category_name'=>$d['category_name'],
                        //    'subcategory_id'=>$d['subcategory_id'],
                        //    'sub_cat_name'=>$d['sub_cat_name'],
                        'mrp' => $d['mrp'] ? $d['mrp'] : "",
                        'selling_price' => $d['selling_price'] ? $d['selling_price'] : "",
                        'stock_status' => $d['stock_status'],
                        //    'is_top_product'=>$d['is_top_product'],
                        //    'approval_status'=>$d['approval_status'],

                    );
                }

                $data['status'] = true;
                $data['data'] = $res;
            } else {
                $data['status'] = false;
                $data['data'] = array();
            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);

    }


    public function filter_product()
    {

        $data = array();
        $response = $this->AS->get_filter_product();
        //  echo $this->db->last_query();die();
        if (!empty($response)) {
            foreach ($response as $d) {
                $product_image = $this->AS->product_image_for_vendor($d['product_id']);
                $res[] = array(
                    'product_id' => $d['product_id'],
                    'product_name_hindi' => $d['product_name_hindi'],
                    'product_name_english' => $d['product_name_english'],
                    'image' => (!empty($product_image['image']) ? $product_image['image'] : ""),
                    'category_id' => $d['category_id'],
                    'category_name' => $d['category_name'],
                    'subcategory_id' => $d['subcategory_id'],
                    'sub_cat_name' => $d['sub_cat_name'],
                    'mrp' => $d['mrp'],
                    'selling_price' => $d['selling_price'],
                    'stock_status' => $d['stock_status'],
                    'is_top_product' => $d['is_top_product'],
                    'approval_status' => $d['approval_status'],
                    'active_status' => $d['show_user'],

                );
            }

            $data['status'] = true;
            $data['data'] = $res;


        } else {
            $data['status'] = false;
            $data['data'] = array();
        }


        echo json_encode($data, JSON_UNESCAPED_UNICODE);

    }

    public function update_shop_details()
    {

        $user_id = $this->input->post('user_id');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $district = $this->input->post('district');
        $tehsil = $this->input->post('tehsil');
        $village = $this->input->post('village');
        $block = $this->input->post('block');
        $pincode = $this->input->post('pincode');
        $mobile = $this->input->post('mobile');
        $array = array();
        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('district', 'district', 'trim|required');
        $this->form_validation->set_rules('tehsil', 'tehsil', 'trim|required');
        $this->form_validation->set_rules('village', 'village', 'trim|required');
        $this->form_validation->set_rules('block', 'block', 'trim|required');
        $this->form_validation->set_rules('pincode', 'pincode', 'trim|required');
        $this->form_validation->set_rules('mobile', 'mobile', 'trim|required');
        if ($this->form_validation->run() == true) {
            $array = array(
                'name' => $name,
                'email' => $email,
                'mobile' => $mobile,
                'district' => $district,
                'tehsil' => $tehsil,
                'village' => $village,
                'block' => $block,
                'pincode' => $pincode,
                'status' => 1,
            );
            $response = $this->AS->update_shop_details($array, $user_id);
            if ($response == true) {
                $data['status'] = true;
                $data['message'] = "Shop details updated successfully";
            } else {
                $data['status'] = false;
                $data['message'] = "Vendor doesn't exist";
            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }
        echo json_encode($data);
    }

    public function get_shop_details()
    {

        $user_id = $this->input->post('user_id');
        $array = array();

        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
        if ($this->form_validation->run() == true) {
            $data = array();
            $response = $this->AS->get_shop_details($user_id);
            if (!empty($response)) {

                foreach ($response as $row) {

                    $array = array(
                        'name' => $row['name'] ? $row['name'] : '',
                        'email' => $row['email'] ? $row['email'] : '',
                        'mobile' => $row['mobile'] ? $row['mobile'] : '',
                        'district' => $row['district'] ? $row['district'] : '',
                        'tehsil' => $row['tehsil'] ? $row['tehsil'] : '',
                        'village' => $row['village'] ? $row['village'] : '',
                        'block' => $row['block'] ? $row['block'] : '',
                        'pincode' => $row['pincode'] ? $row['pincode'] : '',
                    );
                }
                $data['status'] = true;
                $data['data'] = $array;
            } else {
                $data['status'] = false;
                $data['data'] = "Shop doesn't exist";
            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }
        echo json_encode($data);
    }



    //23 nov 2022 create by mahek
    public function get_faq()
    {
        $data = array();



        $result_data = $this->db->select('question,answer')->where('status', 1)->get('faq')->result();

        if (!empty($result_data)) {
            $data['status'] = true;
            $data['data'] = $result_data;
        } else {
            $data['status'] = false;
            $data['data'] = array();
        }

        echo json_encode($data);
    }
    public function get_sliders()
    {
        $data = array();


        $result_data = $this->db->select('id,url,image as link')->where(['status' => 1, 'type' => 1, 'share_status!=' => 2])->get('slider_and_banner')->result();

        if (!empty($result_data)) {
            $data['status'] = true;
            $data['data'] = $result_data;
        } else {
            $data['status'] = false;
            $data['data'] = array();
        }

        echo json_encode($data);
    }
    public function get_news_events()
    {
        $data = array();
        $type = $this->input->post('type');
        $this->form_validation->set_rules('type', 'type', 'trim|required');
        if ($this->form_validation->run() == true) {

            if ($type == 'news') {
                $result_data = $this->db->select('id,title,description,ifnull(url,"") as url ,image')->where(['status' => 1, 'type' => 1])->get('news_event')->result();
            } else {
                $result_data = $this->db->select('id,title,description,ifnull(url,"") as url ,image')->where(['status' => 1, 'type' => 2])->get('news_event')->result();
            }

            if (!empty($result_data)) {
                $data['status'] = true;
                $data['data'] = $result_data;

            } else {
                $data['status'] = false;
                $data['data'] = array();
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
        $result_data = $this->db->select('id,name,image,mobile')->where('status', 1)->limit('4')->get('tbl_team')->result();
        $admin = $this->db->where(['status' => 1])->get('admin')->row();
        if (!empty($result_data)) {
            $array[] = array(
                'contact' => $result_data,
                'support' => $admin->email,
                'address' => $admin->address,
            );
            $data['status'] = true;
            $data['data'] = $array;

        } else {
            $data['status'] = false;
            $data['data'] = array();
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);

    }

    //24 nov 2022 created by mahek
    public function get_home_data()
    {
        $user_id = $this->input->post('user_id');
        $data = array();
        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
        if ($this->form_validation->run() == true) {
            $data = array();
            $slider_data = $this->db->select('id,url,image as link')->where(['status' => 1, 'type' => 1, 'share_status!=' => 2])->get('slider_and_banner')->result();
            $banner_data = $this->db->select('id,url,image as link')->where(['status' => 1, 'type' => 2, 'share_status!=' => 2])->get('slider_and_banner')->result();
            $testimonial_data = $this->db->select('id,name,image,description')->where(['status' => 1])->get('testimonial')->result();
            $total_data = $this->db->where(['status!=' => 2, 'vendor_id' => $user_id])->get('product')->num_rows();
            $x = $this->AS->get_enquiry_for_home_with_order_id($user_id);
            $y = $this->AS->get_enquiry_for_home_without_order_id($user_id);
            // print_r($y);exit;
            $enquiry_data = array_merge($x, $y);


            $complete_order = $this->AS->get_enquiry_for_complete_order($user_id);
            $pending_order = $this->AS->get_enquiry_for_pending_order($user_id);
            $cancel_order = $this->AS->get_enquiry_for_cancel_order($user_id);
            $admin_data = $this->db->where('status', 1)->get('admin')->row();
            //start notification
            $notification_data = $this->db->select("id,msg,DATE_FORMAT(created_at,'%d-%m-%y | %H:%i %p') as date_time ")->where(['status' => 1, 'share_status!=' => 2])->order_by('id', 'DESC')->limit(5)->get('notification')->result();
            $user_notification_count = get_users_notifiction_count($user_id);
            $notification_count = $user_notification_count;
            $notification = array('notification_count' => $user_notification_count, 'notification' => $notification_data);
            //end notification
            $social_media = array('facebook' => $admin_data->facebook, 'twitter' => $admin_data->twitter, 'linked' => $admin_data->linked, 'university_link' => $admin_data->instagram);
            //   print_r($user_notification_count);
            //   exit;
            if (!empty($slider_data) || !empty($banner_data) || !empty($notification_data) || $enquiry_data) {
                $res[] = array(
                    'banner' => $banner_data,
                    'slider' => $slider_data,
                    'total_product' => $total_data,
                    'complete_order' => $complete_order,
                    'pending_order' => $pending_order,
                    'cancel_order' => $cancel_order,
                    'testimonial_data' => $testimonial_data,
                    'new_enquiry' => $enquiry_data,
                    //   'notification'=>array('notification_count'=>$notification_count,$notification_data),
                    //'notification_data'=> $notification_data,
                    'notification' => $notification,
                    'social_media' => $social_media


                );
                $data['status'] = true;
                $data['data'] = $res;


            } else {
                $data['status'] = false;
                $data['data'] = array();
            }

        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());

        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);

    }

    public function get_enquiry()
    {
        $user_id = $this->input->post('user_id');
        $array = array();
        $enquiry_data = array();
        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');

        if ($this->form_validation->run() == true) {
            $data = array();
            $x = $this->AS->get_enquiry_with_order_id($user_id);
            $y = $this->AS->get_enquiry_without_order_id($user_id);
            $response = array_merge($x, $y);
            if (!empty($response)) {
                foreach ($response as $row) {

                    update_enquiry_status($row->order_id);
                    //echo $this->db->last_query();die();
                    $enquiry_data[] = array(
                        'enquiry_id' => $row->enquiry_id,
                        'order_id' => $row->order_id,
                        'user_id' => $row->user_id,
                        'name' => $row->name,
                        'mobile' => $row->mobile,
                        'email' => $row->email,
                        'image' => $row->image,
                        'status' => $row->status,
                        'enquiry_type' => $row->enquiry_type,
                    );
                }

                $data['status'] = true;
                $data['data'] = $enquiry_data;

            } else {
                $data['status'] = false;
                $data['data'] = array();
            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }
        echo json_encode($data);
    }
    public function filter_enquiry()
    {
        $array = array();
        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
        if ($this->form_validation->run() == true) {
            $data = array();
            $response = $this->AS->filter_enquiry();
            // echo $this->db->last_query();die();
            if (!empty($response)) {

                $data['status'] = true;
                $data['data'] = $response;
            } else {
                $data['status'] = false;
                $data['data'] = array();
            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }
        echo json_encode($data);
    }
    public function get_enquiry_by_id()
    {
        $type = $this->input->post('type');
        $array = array();
        $this->form_validation->set_rules('type', 'type', 'trim|required');
        if ($this->input->post('type') == 'product') {
            $this->form_validation->set_rules('order_id', 'order_id', 'trim|required');
        }
        if (($this->input->post('type') == 'general') || ($this->input->post('type') == 'admin')) {
            $this->form_validation->set_rules('enquiry_id', 'enquiry_id', 'trim|required');
        }

        if ($this->form_validation->run() == true) {
            $data = array();
            if ($type == 'product') {
                $response = $this->AS->get_enquiry_for_order_with_id($type);
            } else {
                $response = $this->AS->get_enquiry_for_enquiry_with_id($type);
            }

            if (!empty($response)) {

                $data['status'] = true;
                $data['data'] = $response;
            } else {
                $data['status'] = false;
                $data['data'] = array();

            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }


    //25 nov created by mahek
    public function get_varient_by_id()
    {
        $varient_id = $this->input->post('varient_id');
        $res = array();
        $this->form_validation->set_rules('varient_id', 'varient_id', 'trim|required');
        if ($this->form_validation->run() == true) {

            $d = $this->AS->get_varient_by_id($varient_id);

            if (!empty($d)) {

                $varient_image = $this->AS->varient_image_all($d['varient_id']);

                $res[] = array(
                    'varient_id' => $d['varient_id'],
                    'product_name_hindi' => $d['product_name_hindi'],
                    'product_name_english' => $d['product_name_english'],
                    'select_product_id' => $d['select_product_id'],
                    'availabe_stock' => $d['availabe_stock'],
                    'image' => $varient_image,
                    'category_id' => $d['category_id'],
                    'category_name' => $d['category_name'],
                    'subcategory_id' => $d['subcategory_id'],
                    'sub_cat_name' => $d['sub_cat_name'],
                    'mrp' => $d['mrp'] ? $d['mrp'] : "",
                    'selling_price' => $d['selling_price'] ? $d['selling_price'] : "",
                    'quantity' => $d['quantity'],
                    'description' => $d['description'],
                    'stock_status' => $d['stock_status'],
                    'is_top_product' => $d['is_top_product'],
                    'approval_status' => $d['approval_status'],
                    'product_doc' => $d['verification_doc'],

                );


                $data['status'] = true;
                $data['data'] = $res;


            } else {
                $data['status'] = false;
                $data['data'] = array();
            }

        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());

        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);

    }




    public function send_commnet()
    {
        $array = array();

        $this->form_validation->set_rules('to_id', 'to_id', 'trim|required');
        $this->form_validation->set_rules('from_id', 'from_id', 'trim|required');
        $this->form_validation->set_rules('msg', 'msg', 'trim|required');
        $this->form_validation->set_rules('type', 'type', 'trim|required');
        if ($this->input->post('type') == 'product') {
            $this->form_validation->set_rules('order_id', 'order_id', 'trim|required');
            $this->form_validation->set_rules('status', 'status', 'trim|required');
        }
        if ($this->input->post('type') == 'general') {
            $this->form_validation->set_rules('enquiry_id', 'enquiry_id', 'trim|required');
        }
        if ($this->form_validation->run() == true) {
            $data = array();
            $response = $this->AS->sent_enquiry_for_product_with_order_and_without_order();

            //  print_r($response);exit;
// echo $this->db->last_query();die();
            if ($response['status'] == 1) {

                $data['status'] = true;
                $data['message'] = 'Reply send successfully';
            } else {
                $data['status'] = false;
                $data['message'] = 'Unable to send reply';

            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }
        echo json_encode($data);
    }
    public function activate_deactivate_product()
    {
        $array = array();
        $this->form_validation->set_rules('product_id', 'product_id', 'trim|required');
        $this->form_validation->set_rules('vendor_id', 'vendor_id', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');

        if ($this->form_validation->run() == true) {
            $data = array();
            $response = $this->AS->ativate_deactivate_product();
            //  echo $this->db->last_query();die();
            if ($response['status'] == 1) {

                $data['status'] = true;
                $data['message'] = 'Status changed successfully';
            } elseif ($response['status'] == 2) {

                $data['status'] = false;
                $data['message'] = "You can't change the status until your product is approved";
            } else {
                $data['status'] = false;
                $data['message'] = 'Unable to change status';

            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }
        echo json_encode($data);
    }

    public function change_enquiry_status()
    {

        $array = array();

        $this->form_validation->set_rules('type', 'type', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');
        $this->form_validation->set_rules('vendor_id', 'vendor_id', 'trim|required');
        if ($this->input->post('type') == 'product') {
            $this->form_validation->set_rules('order_id', 'order_id', 'trim|required');
        }
        if ($this->input->post('type') == 'general') {
            $this->form_validation->set_rules('enquiry_id', 'enquiry_id', 'trim|required');
        }
        if ($this->form_validation->run() == true) {
            $data = array();
            $response = $this->AS->change_enquiry_status();

            if ($this->db->affected_rows() == true) {

                $data['status'] = true;
                $data['message'] = 'Status changed successfully';
            } else {
                $data['status'] = false;
                $data['message'] = 'Unable to change status';

            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }
        echo json_encode($data);
    }

    public function change_seen_status_for_enquiry()
    {
        $array = array();

        $this->form_validation->set_rules('vendor_id', 'vendor_id', 'trim|required');
        $this->form_validation->set_rules('seen_status', 'seen_status', 'trim|required');
        $this->form_validation->set_rules('type', 'type', 'trim|required');
        if ($this->input->post('type') == 'product') {
            $this->form_validation->set_rules('order_id', 'order_id', 'trim|required');
        }
        if ($this->input->post('type') == 'general') {
            $this->form_validation->set_rules('enquiry_id', 'enquiry_id', 'trim|required');
        }

        if ($this->form_validation->run() == true) {
            $data = array();
            $response = $this->AS->change_seen_status_for_enquiry();
            //echo $this->db->last_query();die();
            if ($response['status'] == 1) {

                $data['status'] = true;
                $data['message'] = 'Status changed successfully';
            } else {
                $data['status'] = false;
                $data['message'] = 'Unable to change status';

            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }
        echo json_encode($data);
    }

    public function change_notification_status()
    {

        $array = array();

        $user_id = $this->input->post('user_id');
        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
        if ($this->form_validation->run() == true) {
            $data = array();
            $response = $this->AS->change_notification_status($user_id);
            //echo $this->db->last_query();die();
            if ($response) {
                $data['status'] = true;
                $data['message'] = 'Status changed successfully';
            } else {
                $data['status'] = false;
                $data['message'] = 'Unable to change status';
            }
        } else {
            $data['status'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }
        echo json_encode($data);
    }


    public function get_notification()
    {
        $data = array();
        $notification_data = $this->db->select("id,msg,DATE_FORMAT(created_at,'%d-%m-%y | %H:%i %p  ') as date_time ")->where(['status' => 1, 'share_status!=' => 2])->order_by('id', 'DESC')->get('notification')->result();

        if (!empty($notification_data)) {
            $data['status'] = true;
            $data['data'] = $notification_data;
        } else {
            $data['status'] = false;
            $data['data'] = array();
        }

        echo json_encode($data);
    }

}


// }
?>