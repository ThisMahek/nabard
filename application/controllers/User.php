<?php 
class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_Model', 'UM');
    }

    public function user_data_filter()
    { 

            $status_id = isset($_GET['inputStatus']) ? $_GET['inputStatus'] : '';
            $state_id = !empty($_GET['inputState']) ? $_GET['inputState'] : 0;
            $district_id = !empty($_GET['inputDistrict']) ? $_GET['inputDistrict'] : 0;
            $get_users_data = $this->UM->get_users_data();
            
                        // echo $status_id; echo "<br>"; echo $state_id; echo "<br>"; echo $district_id;exit;
            $district = $this->db->get_where('district', ['state_id' => $state_id, 'status' => 1])->result_array();


            if (($state_id != 0) &&($district_id == 0)   &&($status_id == '')) {
                $user_data_state_wise = $this->UM->user_data_state_wise($state_id);
                $collectDistrict = [];
                if (!empty($district) && ($district_id == 0)) {
                    $collectDistrict[] = '<option value="">--Select District--</option>';
                    foreach ($district as $row) {
                        $collectDistrict[] = '<option  value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                } else {
                    $collectDistrict[] = '<option>No District available </option>';
                }
                echo json_encode(['subcategory_list' => $collectDistrict, 'user_data_filter' => $user_data_state_wise, 'demo' => '1']);
            }

          else if (($state_id != 0) && ($district_id != 0) &&  ($status_id == '') ) {
                $user_data_state_district_wise = $this->UM->user_data_state_district_wise($state_id,$district_id);
                $collectDistrict = [];
                if (!empty($district)) {
                    $collectDistrict[] = '<option value="">--Select District--</option>';
                    foreach ($district as $row) {
                        $collectDistrict[] = '<option  value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                } else {
                    $collectDistrict[] = '<option value="">No District available </option>';
                }
                echo json_encode(['subcategory_list' => $collectDistrict, 'user_data_filter' => $user_data_state_district_wise, 'demo' => '2']);
            }



            else if (($state_id != 0) && ($district_id != 0)  && ($status_id !='')) {

           /*  echo "helo";
            exit; */
                $user_data_state_district_status_wise = $this->UM->user_data_state_district_status_wise($state_id,$district_id,$status_id);
                $collectDistrict = [];
                if (!empty($district)) {
                    $collectDistrict[] = '<option value="">--Select District--</option>';
                    foreach ($district as $row) {
                        $collectDistrict[] = '<option  value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                } else {
                    $collectDistrict[] = '<option>No District available </option>';
                }
                echo json_encode(['subcategory_list' => $collectDistrict, 'user_data_filter' => $user_data_state_district_status_wise, 'demo' => '3']);
            }




            else if ( ($status_id !='')&&($state_id == 0) && ($district_id == 0)  ) {

                /*  echo "helo";
                 exit; */
                     $user_data_status_wise = $this->UM->user_data_status_wise($status_id);
                     $collectDistrict = [];
                  /*   
                     if (!empty($district)) {
                         $collectDistrict[] = '<option value="">select district</option>';
                         foreach ($district as $row) {
                             $collectDistrict[] = '<option  value="' . $row['id'] . '">' . $row['name'] . '</option>';
                         }
                     } else {
                         $collectDistrict[] = '<option>No District available </option>';
                     } */

                     $collectDistrict[] = '<option  value="">Please select state </option>';
                     echo json_encode(['subcategory_list' => $collectDistrict, 'user_data_filter' => $user_data_status_wise, 'demo' => '4']);
                 }     
                  else if ( ($status_id !='')&&($state_id != 0) && ($district_id == 0)  ) {

                    /*  echo "helo";
                     exit; */
                         $user_data_status_state_wise = $this->UM->user_data_status_state_wise($status_id,$state_id);  
                         $collectDistrict = [];
                      
                         if (!empty($district)) {
                             $collectDistrict[] = '<option value="">--Select District--</option>';
                             foreach ($district as $row) {
                                 $collectDistrict[] = '<option  value="' . $row['id'] . '">' . $row['name'] . '</option>';
                             }
                         } else {
                             $collectDistrict[] = '<option>No District available </option>';
                         } 
    
                        //  $collectDistrict[] = '<option  value="">Please select state </option>';
                         echo json_encode(['subcategory_list' => $collectDistrict, 'user_data_filter' => $user_data_status_state_wise, 'demo' => '5']);
                     } 
                 
                 else {
                     $collectSubCategory[] = '<option  value="">--Select District--</option>';
                     echo json_encode(['subcategory_list' => $collectSubCategory, 'user_data_filter' => $get_users_data, 'demo' => 'else']);
                 }
 
    }



  public function  update_users(){

    if(isset($_POST['update'])){
        $data = $this->input->post();
         $user_id =$data['user_id'];
         $array = array(
                      'name'=> $data['name'],
                       'state'=> $data['state'],
                        'district' =>$data['district'],
                        'tahsil'=> $data['tehsil'],
                        'pincode' =>$data['pincode'],
         );
       $res  =  $this->UM->update_uses_profile($array,$user_id);
       if ($res == 1) {
        $this->session->set_flashdata('success', ' <div class="alert alert-success alert-dismissible fade show">Profile updated successfully<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
      } else {
        $this->session->set_flashdata('error', ' <div class="alert alert-danger alert-dismissible fade show">Someting went wrong  <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
      }

    }
        redirect('admin/manage_user');


        
  }

}

    
                    
   

?>