<?php

class User_Model extends CI_Model

{
    public function index(){

    }


public function user_data_state_wise($state_id){

    // return $query = $this->db->select('*')->where('status!=',2)->from('users')->order_by('id','desc')->get()->result_array();

       return  $this->db->select('users.name, users.id as uid,users.mobile,users.email,users.state as state_id,users.status, users.district as district_id,users.tahsil,users.pincode,users.image,tbl_state.id as s_id,tbl_state.name as state_name,district.id as d_id,district.name as district_name')->from('users')
        ->join('tbl_state','tbl_state.id = users.state')
        ->join('district','district.id = users.district')
        ->where(['tbl_state.id'=>$state_id,'users.status!='=>2])
        ->get()
        ->result_array();


}


public function get_users_data()
        {
            return  $this->db->select('users.name, users.id as uid,users.mobile,users.email,users.state as state_id,users.status, users.district as district_id,users.tahsil,users.pincode,users.image,tbl_state.id as s_id,tbl_state.name as state_name,district.id as d_id,district.name as district_name')->from('users')
            ->join('tbl_state','tbl_state.id = users.state')
            ->join('district','district.id = users.district')
            ->where(['users.status!='=>2])
            ->get()
            ->result_array();
        }

       public function  update_uses_profile($array,$user_id)
          {
            return $this->db->where(['id'=>$user_id])->update('users',$array);
          }


        public function user_data_state_district_wise($state_id,$district_id)
          {
              return  $this->db->select('users.name, users.id as uid,users.mobile,users.email,users.state as state_id,users.status, users.district as district_id,users.tahsil,users.pincode,users.image,tbl_state.id as s_id,tbl_state.name as state_name,district.id as d_id,district.name as district_name')->from('users')
              ->join('tbl_state','tbl_state.id = users.state')
              ->join('district','district.id = users.district')
              ->where(['tbl_state.id'=>$state_id,'district.id'=>$district_id,'users.status!='=>2])
              ->get()
              ->result_array();

          }

  public function  user_data_state_district_status_wise($state_id,$district_id,$status_id){


    return  $this->db->select('users.name, users.id as uid,users.mobile,users.email,users.state as state_id,users.status, users.district as district_id,users.tahsil,users.pincode,users.image,tbl_state.id as s_id,tbl_state.name as state_name,district.id as d_id,district.name as district_name')->from('users')
    ->join('tbl_state','tbl_state.id = users.state')
    ->join('district','district.id = users.district')
    ->where(['tbl_state.id'=>$state_id,'district.id'=>$district_id,'users.status'=>$status_id])
    ->get()
    ->result_array();

  }

  public function user_data_status_wise($status_id){


    
    return  $this->db->select('users.name, users.id as uid,users.mobile,users.email,users.state as state_id,users.status, users.district as district_id,users.tahsil,users.pincode,users.image,tbl_state.id as s_id,tbl_state.name as state_name,district.id as d_id,district.name as district_name')->from('users')
    ->join('tbl_state','tbl_state.id = users.state')
    ->join('district','district.id = users.district')
    ->where(['users.status'=>$status_id])
    ->get()
    ->result_array();


  }



public function user_data_status_state_wise($status_id,$state_id){


    return  $this->db->select('users.name, users.id as uid,users.mobile,users.email,users.state as state_id,users.status, users.district as district_id,users.tahsil,users.pincode,users.image,tbl_state.id as s_id,tbl_state.name as state_name,district.id as d_id,district.name as district_name')->from('users')
    ->join('tbl_state','tbl_state.id = users.state')
    ->join('district','district.id = users.district')
    ->where(['tbl_state.id'=>$state_id,'users.status'=>$status_id])
    ->get()
    ->result_array();

}
}


?>