<?php
class Vendor extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->Model('Mvendor', 'MV');
    $this->load->helper('url');
  }

  public function index()
  {
    $this->db->query("select team_name, group_concat(team_member) from teams group by team_name");
  }

  public function change_vendor_status($id)
  {
    $status = $this->db->query("select status from vendor where id =$id")->row()->status;
    if ($status == 1) {
      $vendorstatus = 0;
      $this->session->set_flashdata('success', ' <div class="alert alert-warning alert-dismissible fade show">Approval Rejected <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
    } else {
      $vendorstatus = 1;
      $this->session->set_flashdata('success', ' <div class="alert alert-success alert-dismissible fade show"> Approved Successfully<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
    }
    $data = array('status' => $vendorstatus);
    $this->db->where('id', $id);
    $this->db->update('vendor', $data);
    redirect(base_url() . "Admin/manage_vendor");
  }



  public function change_vendor_blockstatus($id)
  {
    $blockstatus = $this->db->query("select is_block from vendor where id =$id")->row()->is_block;
    if ($blockstatus == 1) {
      $vendorstatus = 0;
      $this->session->set_flashdata('success', ' <div class="alert alert-warning alert-dismissible fade show">Unblock Successfully !!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
    } else {
      $vendorstatus = 1;
      $this->session->set_flashdata('error', ' <div class="alert alert-warning alert-dismissible fade show"> Block Successfully<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
    }
    $data = array('is_block' => $vendorstatus);
    $this->db->where('id', $id);
    $this->db->update('vendor', $data);
    redirect(base_url() . "Admin/manage_vendor");
  }

  public function change_fvendor_blockstatus($id)
  {
    $blockstatus = $this->db->query("select is_block from vendor where id =$id")->row()->is_block;
    if ($blockstatus == 1) {
      $vendorstatus = 0;
      $this->session->set_flashdata('success', ' <div class="alert alert-warning alert-dismissible fade show">Unblock Successfully !!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
    } else {
      $vendorstatus = 1;
      $this->session->set_flashdata('error', ' <div class="alert alert-warning alert-dismissible fade show"> Block Successfully<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
    }
    $data = array('is_block' => $vendorstatus);
    $this->db->where('id', $id);
    $this->db->update('vendor', $data);
    redirect(base_url() . "Admin/manage_farmer");
  }



  public function change_vendor_farmer_status($id)
  {
    $status = $this->db->query("select status from vendor where id =$id")->row()->status;
    if ($status == 1) {
      $vendorstatus = 0;

      $this->session->set_flashdata('error', '<div class="alert alert-danger text-center" id="successMessage">Status updated successfully</div>');
    } else {
      $vendorstatus = 1;

      $this->session->set_flashdata('error', '<div class="alert alert-success text-center" id="successMessage">Status updated  successfully</div>');
    }
    $data = array('status' => $vendorstatus);
    $this->db->where('id', $id);
    $this->db->update('vendor', $data);
    redirect(base_url() . "Admin/manage_farmer");
  }


  public function update_vendor()
  {
    $data = $this->input->post();
    if (isset($_POST['update'])) {
      $id = $this->input->post('id');
      $config['encrypt_name'] = true;
      $file = $_FILES["profile_image"];
      $MyFileName = "";
      if (strlen($file['name']) > 0) {

        $image = $file["name"];
        $config['allowed_types'] = 'pdf|gif|jpeg|png|jpg';
        $config['upload_path'] = './upload/profile_image/';
        $config['encrypt_name'] = true;
        $config['file_name'] = $image;
        $this->load->library("upload", $config);
        if ($this->upload->do_upload('profile_image')) {
          $x = $this->upload->data();
          $image_path = ("upload/profile_image/" . $x['file_name']);
        }

        $array = array(
          'name' => $data['name'],
          'district_id' => $data['district_id'],
          // 'field_type' => $data['field_type'],
          'father_name' => $data['father_name'],
          'gender' => $data['gender'],
          // 'mobile' => $data['mobile'],
          'block_id' => $data['block_id'],
          'tehsil' => $data['tehsil'],
          'village' => $data['village'],
          'pincode' => $data['pincode'],
          // 'aadhar_no' => $data['aadhar_no'],
          // 'whatsapp_no' => $data['whatsapp_no'],
          // 'user_id' => $data['user_id'],
          'added_by' => 'admin',
          'profile_image' => $image_path,
        );


      } else {

        $array = array(
          'name' => $data['name'],
          'district_id' => $data['district_id'],
          // 'field_type' => $data['field_type'],
          'father_name' => $data['father_name'],
          'gender' => $data['gender'],
          // 'mobile' => $data['mobile'],
          'block_id' => $data['block_id'],
          'tehsil' => $data['tehsil'],
          'village' => $data['village'],
          'pincode' => $data['pincode'],
          // 'aadhar_no' => $data['aadhar_no'],
          'added_by' => 'admin',
          // 'whatsapp_no' => $data['whatsapp_no'],
          // 'user_id' => $data['user_id'],
        );

      }

      $res = $this->MV->update_vender_details($id, $array);
      $this->session->set_flashdata('success', '<div class="alert alert-success text-center" id="successMessage">Data updated successfully</div>');

      if ($res == true) {
        redirect('admin/manage_farmer');
      }



    }
    else{
      echo "hek";
    }
  }





  public function DeleteVendor($id)
  {
    $res = $this->MV->DeleteVendorDetails($id);
    //print_r($res);exit;
    if ($res) {
      $this->session->set_flashdata('success', ' 
<div class="alert alert-success alert-dismissible fade show">
 User Deleted Successfully
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
');
    } else {
      $this->session->set_flashdata('error', ' 
<div class="alert alert-danger alert-dismissible fade show">
  Unable to  Delete User
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
');
    }
    redirect(base_url() . "Admin/manage_farmer");
  }



  public function delete_vendors($id)
  {
    $res = $this->MV->DeleteVendorDetails($id);
    if ($res) {
      $this->session->set_flashdata('success', ' 
                      <div class="alert alert-success alert-dismissible fade show">
                        Vendor Deleted Successfully
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      </div>
                      ');
    } else {
      $this->session->set_flashdata('error', ' 
                      <div class="alert alert-danger alert-dismissible fade show">
                       Unable to  Delete Vendor
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      </div>
                      ');
    }
    redirect(base_url() . "Admin/manage_vendor");

  }


  public function update_vendor_fpo_shg($vendor_id)
  {
    $data = $this->input->post();
    $bodmobile = $data['bodmobile'];
    $bodname = $data['bodname'];
    $array = array();
    $bod_id = $data['bod_hidden_id'];
    foreach ($data['bodmobile'] as $key => $bod_mobile) {
      $bod_rows=$this->db->get_where('bod',['bod_mobile'=>$bod_mobile,'id!='=>$bod_id[$key]]);
      $bod_phone_rows=$this->db->get_where('bod',['bod_mobile'=>$bod_mobile,'status!='=>2]); 
    if(!empty($bod_rows->num_rows()>=1)  ||  !empty($bod_phone_rows->num_rows()>1)){    
        $this->session->set_flashdata('error', '<div class="alert alert-danger text-center" id="successMessage"> BOD Mobile number already exists</div>');
        redirect($_SERVER['HTTP_REFERER']);
      } 
    
    }
   
    foreach ($data['bod_hidden_id'] as $key => $bodid) {
      if ((($bodid) != '')) {
        $bod_data = array();
        if ($this->uploadImage($key) == false) {
          $bod_data['bod_name'] = $bodname[$key];
          $bod_data['bod_mobile'] = $bodmobile[$key];
          $bod_data['vendor_id'] = $vendor_id;
        }  else{
          $bod_data['bod_name'] = $bodname[$key];
          $bod_data['bod_mobile'] = $bodmobile[$key];
          $bod_data['vendor_id'] = $vendor_id;
          $bod_data['bod_image'] = $this->uploadImage($key);
        } 
        $this->db->where('id', $bodid)->update('bod', $bod_data); 
      }
    if ($bodid == '') {
      $bod_data = array();
        if ($this->uploadImage($key) == false) {
          $bod_data['bod_name'] = $bodname[$key];
          $bod_data['bod_mobile'] = $bodmobile[$key];
          $bod_data['vendor_id'] = $vendor_id;
        } else {
          $bod_data['bod_name'] = $bodname[$key];
          $bod_data['bod_mobile'] = $bodmobile[$key];
          $bod_data['vendor_id'] = $vendor_id;
          $bod_data['bod_image'] = $this->uploadImage($key);
        }

        $this->db->insert('bod', $bod_data);
      } 
}


    $config['encrypt_name'] = true;
    $file = $_FILES["profile_image"];
    $MyFileName = "";
    if (strlen($file['name']) > 0) {
      $image = $file["name"];
      $config['allowed_types'] = 'pdf|gif|jpeg|png|jpg';
      $config['upload_path'] = './upload/profile_image/';
      $config['encrypt_name'] = true;
      $config['file_name'] = $image;
      $this->load->library("upload", $config);
      if ($this->upload->do_upload('profile_image')) {
        $x = $this->upload->data();
        $image_path = ("upload/profile_image/" . $x['file_name']);
      }
      $array = array(
        'field_type' => strtolower($data['field_type']),
        'name' => $data['name'],
        'representative' => $data['representative'],
        'promoting_agency' => $data['promoting_agency'],
        'office_address' => $data['office_address'],
        'district_id' => $data['district_id'],
        'block_id' => $data['block_id'],
        'product' => $data['product'],
        'basic_info' => $data['basic_info'],
        'added_by' => 'admin',
        'profile_image' => $image_path,
      );
    
      $res = $this->db->where(['id' => $vendor_id])->update('vendor', $array);
      if ($res == true) {
        $this->session->set_flashdata('success', '<div class="alert alert-success text-center" id="successMessage">Vendor updated successfully</div>');
        redirect('admin/manage_vendor');
      } else {
        $this->session->set_flashdata('error', '<div class="alert alert-danger text-center" id="successMessage">Vendor not updated successfully</div>');
        redirect('admin/manage_vendor');
      }

    } else {
      $array = array(
        'field_type' => strtolower($data['field_type']),
        'name' => $data['name'],
        'representative' => $data['representative'],
        'promoting_agency' => $data['promoting_agency'],
        'office_address' => $data['office_address'],
        'district_id' => $data['district_id'],
        'block_id' => $data['block_id'],
        'product' => $data['product'],
        'basic_info' => $data['basic_info'],
      );

      $res = $this->db->where(['id' => $vendor_id])->update('vendor', $array);
      if ($res == true) {
        $this->session->set_flashdata('success', '<div class="alert alert-success text-center" id="successMessage">Vendor updated successfully</div>');
        redirect('admin/manage_vendor');
        // redirect($_SERVER['HTTP_REFERER']);
      } else {
        $this->session->set_flashdata('error', '<div class="alert alert-danger text-center" id="successMessage">Vendor not updated successfully</div>');
        redirect('admin/manage_vendor');
        // redirect($_SERVER['HTTP_REFERER']);
      }

    }

  }









  public function uploadImage($i = '')
  {
    $data = [];
    if(isset($_FILES['file'.$i]))
        $_FILES['file'.$i] = array();
    if ($_FILES['bodimage']['name'][$i]!="") {
      $_FILES['file'.$i]['name'] = $_FILES['bodimage']['name'][$i];
      $_FILES['file'.$i]['type'] = $_FILES['bodimage']['type'][$i];
      $_FILES['file'.$i]['tmp_name'] = $_FILES['bodimage']['tmp_name'][$i];
      $_FILES['file'.$i]['error'] = $_FILES['bodimage']['error'][$i];
      $_FILES['file'.$i]['size'] = $_FILES['bodimage']['size'][$i];
      $config['upload_path'] = './upload/';
      $config['allowed_types'] = 'jpg|jpeg|png|gif';
      /*      $config['max_size'] = '5000'; */
      $config['encrypt_name'] = true;
      $config['file_name'] = $_FILES['bodimage']['name'][$i];
      if($config['file_name']) {
          $this->load->library('upload', $config);
          $this->upload->do_upload('file'.$i);
          $uploadData = $this->upload->data();
          $image_path = ("upload/" . $uploadData['file_name']);
          $data = $image_path;
      } else
        $data = false;
      return $data;
    } else {
      return false;
    }




  }




  public function get_phone_otp_verification_vendor()
  {
    if (isset($_POST['submit'])) {
      $phone = $this->input->post('phone');
      $id = $this->input->post('id');
      $name = $this->input->post('name');
      $field_type = $this->input->post('field_type');
      $sql = $this->MV->check_number($phone, $id);
      if ($sql->num_rows() > 0) {
        echo json_encode(array("success" => false, "message" => "Mobile number already exists"));
      } else {
        $this->session->set_userdata('vendor_name_fpo_shg', $name);
        $this->session->set_userdata('field_type', $field_type);
        $this->session->set_userdata('vendor_phone_fpo_shg', $phone);
        // redirect('admin/add_vendor');
          echo json_encode(
        array(
        "success" => true
        )
        );
      }
    }
  }


  public function check_team_phone_number_exits()
  {

    if (isset($_POST['submit'])) {
      $phone = $this->input->post('phone');
      $id = $this->input->post('id');
      $sql = $this->MV->check_team_number($phone, $id);
      if ($sql->num_rows() > 0) {
        echo json_encode(array("success" => false, "message" => "Mobile number already exists"));
      } else {
        // redirect('admin/manage_team');
        echo json_encode(array("success" => true));
      }
    }

  }




  public function check_phone_already_exits()
  {

    if (isset($_POST['submit'])) {
      $phone = $this->input->post('phone');
      $id = $this->input->post('id');
      $name = $this->input->post('name');
      $field_type = $this->input->post('field_type');
      $sql = $this->MV->check_number($phone, $id);
      /*   echo  $sql->num_rows();
      exit; */
      if ($sql->num_rows() > 0) {
        echo json_encode(array("success" => false, "message" => "Mobile number already exists"));
      } else {
        $this->session->set_userdata('vendor_name_fpo_shg', $name);
        $this->session->set_userdata('field_type', $field_type);
        echo json_encode(
          array(
            'phone' => $phone,
            "success" => true
          )
        );
        // $this->load->view('otp-sign-up',$array);
      }
    }
  }






  public function check_fpo_shg_email()
  {

    if (isset($_POST['submit'])) {
      $email = $this->input->post('eamil');
      $id = $this->input->post('id');
      $sql = $this->MV->check_email($email, $id);
      /*   echo  $sql->num_rows();
      exit; */
      if ($sql->num_rows() > 0) {
        echo json_encode(array("success" => false, "message" => "Mobile number already exists"));
      } else {
        echo json_encode(
          array(
            "success" => true
          )
        );
      }
    }
  }






  public function check_email_already_exits()
  {
    if (isset($_POST['submit'])) {
      $email = $this->input->post('email');
      $id = $this->input->post('id');
      if (!empty($id)) {
        $check_email = $this->MV->check_email($email, $id);
      } else {
        $check_email = $this->MV->check_email($email, $id = '');
      }
      if ($check_email->num_rows() > 0) {
        echo json_encode(array("success" => false, "message" => "Email ID already exists"));
      } else {
        echo json_encode(
          array(
            'email' => $email,
            "success" => true
          )
        );
      }

    }
  }




  public function check_team_email_already_exits()
  {
    if (isset($_POST['submit'])) {
      $email = $this->input->post('email');
      $id = $this->input->post('id');
      if (!empty($id)) {
        $check_email = $this->MV->check_team_email($email, $id);
      } else {
        $check_email = $this->MV->check_team_email($email, $id = '');
      }
      if ($check_email->num_rows() > 0) {
        echo json_encode(array("success" => false, "message" => "Email ID already exists"));
      } else {
        echo json_encode(
          array(
            'email' => $email,
            "success" => true
          )
        );
      }

    }
  }



  public function check_userid_already_exits()
  {
    if (isset($_POST['submit'])) {
      $userid = $this->input->post('userid');


      $id = $this->input->post('id');
      if (!empty($id)) {
        // $check_email = $this->MV->check_email($email, $id);
        $check_email = $this->MV->check_userid($userid, $id);
      } else {
        $check_email = $this->MV->check_userid($userid, $id = '');
      }

      if ($check_email->num_rows() > 0) {
        echo json_encode(array("success" => false, "message" => "User ID already exists"));
      } else {
        echo json_encode(
          array(
            'phone' => $userid,
            "success" => true
          )
        );
      }

    }
  }



  public function check_whatsaap_already_exits()
  {
    if (isset($_POST['submit'])) {
      $whatsapp = $this->input->post('whatsapp');


      $id = $this->input->post('id');
      if (!empty($id)) {
        // $check_email = $this->MV->check_email($email, $id);
        $check_whatsapp = $this->MV->check_whatsapp($whatsapp, $id);
      } else {
        $check_whatsapp = $this->MV->check_whatsapp($whatsapp, $id = '');
      }

      if ($check_whatsapp->num_rows() > 0) {
        echo json_encode(array("success" => false, "message" => "Whatsapp number already exists"));
      } else {
        echo json_encode(
          array(
            'phone' => $check_whatsapp,
            "success" => true
          )
        );
      }

    }
  }


  public function check_aadharnum_already_exits()
  {
    if (isset($_POST['submit'])) {
      $aadharnum = $this->input->post('aadharnum');
      $id = $this->input->post('id');
      if (!empty($id)) {
        // $check_email = $this->MV->check_email($email, $id);
        $check_aadharnum = $this->MV->check_aadharnum($aadharnum, $id);
      } else {
        $check_aadharnum = $this->MV->check_aadharnum($aadharnum, $id = '');
      }
      if ($check_aadharnum->num_rows() > 0) {
        echo json_encode(array("success" => false, "message" => "Aadhar number already exists"));
      } else {
        echo json_encode(
          array(
            'phone' => $check_aadharnum,
            "success" => true
          )
        );
      }

    }
  }




  public function check_regno_already_exits()
  {
    if (isset($_POST['submit'])) {
      $regno = $this->input->post('regno');
      $id = $this->input->post('id');
      if (!empty($id)) {
        $check_regno = $this->MV->check_regno($regno, $id);
      } else {
        $check_regno = $this->MV->check_regno($regno, $id = '');
      }

      if ($check_regno->num_rows() > 0) {
        echo json_encode(array("success" => false, "message" => "Registration Number already exists"));
      } else {
        echo json_encode(
          array(
            // 'phone' => $regno,
            "success" => true
          )
        );
      }

    }
  }




  public function get_phone_otp_verification_farmer()
  {
    if (isset($_POST['submit'])) {
      $phone = $this->input->post('phone');
      $id = $this->input->post('id');
      $name = $this->input->post('name');
      $field_type = $this->input->post('field_type');
      $sql = $this->MV->check_number($phone, $id);
      if ($sql->num_rows() > 0) {
        echo json_encode(array("success" => false, "message" => "Mobile number already exists"));
      } else {
        $this->session->set_userdata('vendor_name_farmer', $name);
        $this->session->set_userdata('vendor_phone_farmer', $phone);
        $this->session->set_userdata('field_type', $field_type);
         echo json_encode(
        array("success" => true )
        );
      }
    }
  }






  /*   public function vendor_signup_otp_verification()
  {
  if (isset($_POST['otphtml'])) {
  $ozotp = $_POST['otphtml'];
  $phone = $_POST['phone_p'];
  $_SESSION['vendor_phone'] = $phone;
  if ($_SESSION['otp'] != $ozotp) {
  $this->session->set_flashdata('error', '<div class="alert alert-danger text-center" id="successMessage">Wrong OTP</div>');
  redirect('admin/manage_vendor');
  }
  $last_id = $_SESSION['last_id'];
  $this->db->query("update tblotp set status=1 where id='$last_id'");
  redirect('admin/add_vendor');
  }
  } */





  /*  public function farmer_vendor_signup_otp_verification()
  {
  if (isset($_POST['otphtml'])) {
  $ozotp = $_POST['otphtml'];
  $phone = $_POST['phone_p'];
  $_SESSION['vendor_phone'] = $phone;
  if ($_SESSION['otp'] != $ozotp) {
  $this->session->set_flashdata('error', '<div class="alert alert-danger text-center" id="successMessage">Wrong OTP</div>');
  redirect('admin/manage_farmer');
  }
  $last_id = $_SESSION['last_id'];
  $this->db->query("update tblotp set status=1 where id='$last_id'");
  redirect('admin/add_farmer');
  }
  } */

  public function add_vendor_fpo_shg()
  {
    // exit;
    $data = $this->input->post();
    if (isset($_POST['add_vendor'])) {
      $data = $this->input->post();
      $bodmobile = $data['bodmobile'];
      $bodname = $data['bodname'];
      $array = array();
      $bod_id = $data['bod_hidden_id'];
      foreach ($data['bodmobile'] as $key => $bod_mobile) {
        $bod_rows=$this->db->get_where('bod',['bod_mobile'=>$bod_mobile,'id!='=>$bod_id[$key]]);
        $bod_phone_rows=$this->db->get_where('bod',['bod_mobile'=>$bod_mobile,'status!='=>2]); 
      if(!empty($bod_rows->num_rows()>=1)  ||  !empty($bod_phone_rows->num_rows()>1)){    
          $this->session->set_flashdata('error', '<div class="alert alert-danger text-center" id="successMessage">BOD Mobile number already exists</div>');
          redirect($_SERVER['HTTP_REFERER']);
        } 
      
      }


      $num_bod = count($data['bodname']);
      $config['encrypt_name'] = true;
      $file = $_FILES["profile_image"];
      $MyFileName = "";
      if (strlen($file['name']) > 0) {
        $image = $file["name"];
        $config['allowed_types'] = 'pdf|gif|jpeg|png|jpg';
        $config['upload_path'] = './upload/';
        $config['encrypt_name'] = true;
        $config['file_name'] = $image;
        $this->load->library("upload", $config);
        if ($this->upload->do_upload('profile_image')) {
          $x = $this->upload->data();
          $image_path = ("upload/" . $x['file_name']);
        }
        $array = array(
          'field_type' => strtolower($data['field_type']),
          'name' => $data['name'],
          'representative' => $data['representative'],
          'mobile' => $data['mobile'],
          'email' => $data['email_id'] ? $data['email_id'] : '',
          'reg_no' => $data['reg_no'],
          'promoting_agency' => $data['promoting_agency'],
          'office_address' => $data['office_address'],
          'district_id' => $data['district'],
          'block_id' => $data['block'],
          'product' => $data['product'],
          'basic_info' => $data['basic_info'],
          'user_id' => $data['user_id'],
          'added_by' => 'admin',
          'bod' => $num_bod,
          'password' => md5($data['password']),
          'decry_password' => $data['password'],
          'profile_image' => $image_path,
          'status' => 0,
        );

      } else {
        $array = array(
          'field_type' => strtolower($data['field_type']),
          'name' => $data['name'],
          'representative' => $data['representative'],
          'mobile' => $data['mobile'],
          'email' => $data['email_id'] ? $data['email_id'] : '',
          'reg_no' => $data['reg_no'],
          'promoting_agency' => $data['promoting_agency'],
          'office_address' => $data['office_address'],
          'district_id' => $data['district'],
          'block_id' => $data['block'],
          'product' => $data['product'],
          'basic_info' => $data['basic_info'],
          'user_id' => $data['user_id'],
          'added_by' => 'admin',
          'bod' => $num_bod,
          'password' => md5($data['password']),
          'decry_password' => $data['password'],
          'status' => 0,
        );
      }

      /*   echo "<pre>";
      print_r($array);
      exit; */
      $bodname = $data['bodname'];
      // $bodmobile = $data['bodmobile'];
      if (count($data['bodname']) <= 20) {
        $last_id = $this->MV->AddVendorDetails($array);
        foreach ($data['bodname'] as $key => $bodid) {
          $bod_data['bod_name'] = $bodname;
          $bod_data['bod_mobile'] = $bodmobile;
          $bod_data['bod_image'][] = $this->add_uploadImage($key);
          $bod_data['vendor_id'] = $last_id;
          $response = $this->db->insert('bod', ['bod_name' => $bod_data['bod_name'][$key], 'bod_mobile' => $bod_data['bod_mobile'][$key], 'bod_image' => $bod_data['bod_image'][$key], 'vendor_id' => $last_id]);
        }
      } 
      
      else {
        $this->session->set_flashdata('error', '<div class="alert alert-success text-center" id="successMessage">You can not add BOD more than 20</div>');
        redirect('admin/manage_vendor');
      }
      $this->session->unset_userdata('vendor_phone_fpo_shg');
      $this->session->unset_userdata('vendor_name_fpo_shg_farmer');
      $this->session->unset_userdata('field_type');
      if ($response == true) {
        $this->session->set_flashdata('success', '<div class="alert alert-success text-center" id="successMessage">Vendor added successfully</div>');
        redirect('admin/manage_vendor');
      } else {
        $this->session->set_flashdata('error', '<div class="alert alert-danger text-center" id="successMessage">Vendor not added successfully</div>');
        redirect('admin/manage_vendor');
      }
    } else {
      $this->session->set_flashdata('error', '<div class="alert alert-danger text-center" id="successMessage">Someting went wrong</div>');
      redirect('admin/manage_vendor');
    }



  }

  public function getch_district_block()
  {

    $district_id = isset($_GET['district']) ? $_GET['district'] : 0;
    $block_data = $this->db->get_where('block', ['district_id'=>$district_id,'status'=>1])->result_array();
    if (isset($district_id)) {
      $collectBlock = [];
      if (!empty($block_data)) {
        $collectBlock[] = '<option value="">Select Block </option>';
        foreach ($block_data as $row) {
          $collectBlock[] = '<option  value="' . $row['id'] . '">' . $row['name'] . '</option>';
        }
      } else {
        $collectBlock[] = '<option  value=""">No Block Available</option>';
      }
      echo json_encode(['subcategory_list' => $collectBlock, 'demo' => '1']);
    } else {
      $collectBlock[] = '<option>Select District First</option>';
      echo json_encode(['city_list' => $collectBlock, 'demo' => 'else']);
    }


  }

  public function add_uploadImage($i = '')
  {

    if (!empty($_FILES['bodimage']['name'][$i])) {
      $_FILES['file']['name'] = $_FILES['bodimage']['name'][$i];
      $_FILES['file']['type'] = $_FILES['bodimage']['type'][$i];
      $_FILES['file']['tmp_name'] = $_FILES['bodimage']['tmp_name'][$i];
      $_FILES['file']['error'] = $_FILES['bodimage']['error'][$i];
      $_FILES['file']['size'] = $_FILES['bodimage']['size'][$i];
      $config['upload_path'] = './upload/';
      $config['allowed_types'] = 'jpg|jpeg|png|gif';
      /*      $config['max_size'] = '5000'; */
      $config['encrypt_name'] = true;
      $config['file_name'] = $_FILES['bodimage']['name'][$i];
      $this->load->library('upload', $config);
      $this->upload->do_upload('file');
      $uploadData = $this->upload->data();
      $image_path = ("upload/" . $uploadData['file_name']);
      return $data = $image_path;
    }
    return 0;
  }



  public function add_farmer_vendor()
  {
    
    $data = $this->input->post();

    if (isset($_POST['submit_btn'])) {
      $config['encrypt_name'] = true;
      $file = $_FILES["profile_image"];
      $MyFileName = "";
      if (strlen($file['name']) > 0) {
        $image = $file["name"];
        $config['allowed_types'] = 'pdf|gif|jpeg|png|jpg';
        $config['upload_path'] = './upload/profile_image/';
        $config['encrypt_name'] = true;
        $config['file_name'] = $image;
        $this->load->library("upload", $config);
        if ($this->upload->do_upload('profile_image')) {
          $x = $this->upload->data();
          $image_path = ("upload/profile_image/" . $x['file_name']);
        }
        $array = array(
          'field_type' => strtolower($data['field_type']),
          'name' => $data['name'],
          'whatsapp_no' => $data['whatsapp_no'],
          'mobile' => $data['mobile'],
          'pincode' => $data['pincode'],
          'father_name' => $data['father_name'],
          'village' => $data['village'],
          'gender' => $data['gender'],
          'district_id' => $data['district'],
          'block_id' => $data['block'],
          'tehsil' => $data['tehsil'],
          'aadhar_no' => $data['aadhar_no'],
          'user_id' => $data['user_id'],
          'added_by' => 'admin',
          'password' => md5($data['password']),
          'decry_password' => $data['password'],
          'profile_image' => $image_path,
          'status' => 0,
        );
        $last_id = $this->MV->AddVendorDetails($array);
      } else {
        $array = array(
          'field_type' => strtolower($data['field_type']),
          'name' => $data['name'],
          'whatsapp_no' => $data['whatsapp_no'],
          'mobile' => $data['mobile'],
          'pincode' => $data['pincode'],
          'father_name' => $data['father_name'],
          'village' => $data['village'],
          'gender' => $data['gender'],
          'district_id' => $data['district'],
          'tehsil' => $data['tehsil'],
          'block_id' => $data['block'],
          'aadhar_no' => $data['aadhar_no'],
          'user_id' => $data['user_id'],
          'added_by' => 'admin',
          'password' => md5($data['password']),
          'decry_password' => $data['password'],
          'status' => 0,
        );
        $last_id = $this->MV->AddVendorDetails($array);
      }
      $this->session->unset_userdata('vendor_phone_farmer');
      $this->session->unset_userdata('vendor_name');
      $this->session->unset_userdata('field_type');
      if (!empty($last_id)) {
        $this->session->set_flashdata('success', '<div class="alert alert-success text-center" id="successMessage">Vendor added successfully</div>');
        redirect('admin/manage_farmer');
      } else {
        $this->session->set_flashdata('error', '<div class="alert alert-danger text-center" id="successMessage">Vendor not added successfully</div>');
        redirect('admin/manage_farmer');
      }

    } else {
      $this->session->set_flashdata('error', '<div class="alert alert-danger text-center" id="successMessage">Someting went wrong</div>');
      redirect('admin/manage_farmer');
    }



  }


  public function check_bod_phone_number_exits()
  {
    if (isset($_POST['submit'])) {
      $phone = $this->input->post('phone');
      $id = $this->input->post('id');
      $bod_phone_rows=$this->db->get_where('bod',['bod_mobile'=>$phone,'status!='=>2]);
      $bod_id=   $this->input->post('bod_id');
      if (!empty($bod_id)) {
        $bod_rows=$this->db->get_where('bod',['bod_mobile'=>$phone,'id='=>$bod_id]);
        
        if(!empty($bod_phone_rows->num_rows()>1)){
          echo json_encode(array("success" => false, "message" => "Mobile number already exists"));
        }else if(!empty($bod_rows->num_rows()==1)){
          echo json_encode(array("success" => true, "message" => ""));
        }else{
          echo json_encode(
            array(
              'phone' => $phone,
              "success" => true,
            )
          );
        } 
      }
      else{
        if(!empty($bod_phone_rows->num_rows()>1)){
          echo json_encode(array("success" => false, "message" => "Mobile number already exists"));
        }else{
          echo json_encode(
            array(
              'phone' => $phone,
              "success" => true,
            )
          );

        }
      } 
    }


  }


  public function delete_general_enquiry($id = '')
  {
    $res = $this->MV->delete_general_enquiry($id);
    if ($res == 1) {
      $this->session->set_flashdata('success', ' <div class="alert alert-success alert-dismissible fade show">Enquiry Deleted Successfully<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
    } else {
      $this->session->set_flashdata('error', ' <div class="alert alert-danger alert-dismissible fade show">Someting went wrong  <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
    }
    redirect('admin/vendor_enquiry');

  }


  public function delete_admin_enquiry($id = '')
  {
    $res = $this->MV->delete_admin_enquiry($id);
    if ($res == 1) {
      $this->session->set_flashdata('success', ' <div class="alert alert-success alert-dismissible fade show">Admin Enquiry Deleted Successfully<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
    } else {
      $this->session->set_flashdata('error', ' <div class="alert alert-danger alert-dismissible fade show">Someting went wrong  <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
    }
    redirect('admin/user_enquiry');

  }



  public function admin_reply_to_user($id = '')
  {
    if (isset($_POST['submit'])) {
      unset($_POST['submit']);
      $data = $this->input->post();
      $res = $this->MV->send_admin_reply_to_user($id, $data);

      if ($res == 1) {
        $this->session->set_flashdata('success', ' <div class="alert alert-success alert-dismissible fade show">Enquiry response send successfully<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
      } else {
        $this->session->set_flashdata('error', ' <div class="alert alert-danger alert-dismissible fade show">Someting went wrong  <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
      }
      redirect('admin/user_enquiry');

    } else {
      redirect('admin/user_enquiry');
    }

  }
  public function delete_product_enquiry($id = '')
  {
    $res = $this->MV->delete_product_enquiry($id);
    if ($res == 1) {
      $this->session->set_flashdata('success', ' <div class="alert alert-success alert-dismissible fade show">Enquiry Deleted Successfully<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
    } else {
      $this->session->set_flashdata('error', ' <div class="alert alert-danger alert-dismissible fade show">Someting went wrong<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
    }
    redirect('admin/enquiry');

  }

  /* public function add_state_district_block(){
  $data = $this->input->post();
  $state_name = $this->input->post('state');
  $this->db->insert('state',['name'=>$state_name]);
  $this->db->insert_id();
  $array1 = [];
  $array1['state_id'] = $data['state'];
  $array1['name'] = $data['district'];
  $array2 = [];
  $array2['state_id'] = $data['state'];
  
  } */


  public function disabled_district()
  {

    $data = $this->input->post();
    $state_id = $this->input->post('state');
    $district_id = $this->input->post('district');
    $res = $this->db->where(['state_id' => $state_id, 'id' => $district_id])->update('district', ['status' => '1']);
    // $res = $this->db->where(['id'=>$state_id])->update('state',['status'=>'1']);
    if ($res == 1) {
      $this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissible fade show">District added successfully<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
    } else {
      $this->session->set_flashdata('error', '<div class="alert alert-warning alert-dismissible fade show">Something went wrong<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');

    }

    redirect('admin/manage_state');


  }




  public function enabled_district()
  {
    $data = $this->input->post();
    $state_id = $this->input->post('state');
    $district_id = $this->input->post('district');
    $res = $this->db->where(['state_id' => $state_id, 'id' => $district_id])->update('district', ['status' => 1]);
    if ($res == 1) {
      $this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissible fade show">District Enabled successfully<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
    } else {
      $this->session->set_flashdata('error', '<div class="alert alert-warning alert-dismissible fade show">Something went wrong<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
    }
    redirect('admin/manage_state');
  }



  public function add_block()
  {
    $data = $this->input->post();
    $district_id = $data['district'];
    $block = $data['block'];
    $num_rows = $this->db->get_where('block', ['name' => $block])->num_rows();
    if ($num_rows > 1) {
      $this->session->set_flashdata('error', '<div class="alert alert-warning alert-dismissible fade show">Block already exists<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
      redirect('admin/manage_state');
    } else {
      $array = array(
        'name' => $block,
        'district_id' => $district_id,
        'status' => 1,
      );
      $res = $this->db->insert('block', $array);
      if ($res == 1) {
        $this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissible fade show">Block added successfully<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
      } else {
        $this->session->set_flashdata('error', '<div class="alert alert-warning alert-dismissible fade show">Something went wrong<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
      }

    }
    redirect('admin/manage_block');
  }



  public function get_block_edit_vendor()
  {	
		$district_id = isset($_GET['district_id'])?$_GET['district_id']:0;
		$subCategory = $this->db->get_where('block', ['district_id' => $district_id,'status'=>1])->result_array();
		// $product_data_vendor_filter = $this->PM->product_data_vendor_filter();
	if (!empty($district_id)) {
		// $product_data_category_wise = $this->PM->product_data_category_wise($district_id);
			$collectBlock = [];
			if (!empty($subCategory)) {
				$collectBlock[] = '<option value="">--Select Block--</option>';
				foreach ($subCategory as $row) {
				$collectBlock[] = '<option  value="'.$row['id'].'">'.$row['name'].'</option>';
				}
			} else {
				$collectBlock[] = '<option value=""> No Block Available </option>';
			}
			echo json_encode(['block_list' => $collectBlock,  'demo' => '1']);
		}
        else{
            $collectBlock[] = '<option value="">Select District First</option>';
            echo json_encode(['block_list' =>$collectBlock,'demo'=>'else']);      
        }
    }




}

?>