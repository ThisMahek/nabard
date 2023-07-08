<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Team extends My_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Common_Model', 'CM');

	}

    public function addTeam(){
        //exit;
        $table = "tbl_team";
        $post = $this->input->post();
        $array['name'] = $post['name'];
        $array['mobile'] = $post['mobile'];
        // $array['email'] = $post['email'];
        // $array['designation'] = $post['designation'];
        $status = $this->input->post('status');
        $array['status'] = $status;
        $config['allowed_types'] = 'pdf|gif|jpeg|png|jpg';
        $config['upload_path'] = './upload/profile_image/';
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image')) {
            $data = $this->upload->data();
            $post = $this->input->post();
            $image_path = ("upload/profile_image/" . $data['file_name']);
            $array['image'] = $image_path;
        }


    //   echo "<pre>";  print_r($array);exit;



    $team_rows = $this->db->get_where('tbl_team',['status'=>'1'])->num_rows();
    $allowed_total_team=$this->db->select('team_num')->get('setting')->row()->team_num;
    if(($team_rows < $allowed_total_team))
     {
     $this->addtables($table,$array);
     $this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissible fade show">Slider Added successfully! !!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
     redirect($_SERVER['HTTP_REFERER']);
     }else{
      $this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible fade show">You  can not add team member more than 5 !!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
      redirect($_SERVER['HTTP_REFERER']);
     } 
        /* $x = $this->addtables($table, $array);
        if ($x) {
            $this->session->set_flashdata('success', '<div class="alert alert-success text-center" id="successMessage">Team Added Successfully</div>');
                }
        else {
            $this->session->set_flashdata('error', '<div class="alert alert-danger text-center" id="successMessage">Unable to Add Team </div>');
              }
        redirect("admin/manage_team"); */
    }



    public function update_team()
    {
        if (isset($_POST["update"])) {
            $tab = 'tbl_team';
            $id = $this->input->post("id");
            $post = $this->input->post();
            $array['name'] = $post['name'];
       /*      $array['email'] = $post['email'];
            $array['designation'] = $post['designation']; */
            $array['mobile'] = $post['mobile'];
            $status = $this->input->post('status');
            $array['status'] = $status;
            $config['allowed_types'] = 'pdf|gif|jpeg|png|jpg';
            $config['upload_path'] = './upload/profile_image/';
            $config['encrypt_name'] = true;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image')) {
                $data = $this->upload->data();
                $post = $this->input->post();
                $image_path = ("upload/profile_image/" . $data['file_name']);
                $array['image'] = $image_path;
            }

                $x = $this->UpdateTable($id, $tab, $array);
                if ($x) {
                    $this->session->set_flashdata('success', '<div class="alert alert-success text-center" id="successMessage">Team updated successfully</div>');
                }
                else {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger text-center" id="successMessage">Unable to update Team</div>');
                }
            }
        redirect(base_url() . "admin/manage_team");

    }



    public function delete_team_member($id)
    {
        $tab = 'tbl_team';
        $res = $this->deleteTable($id, $tab);
        if ($res == 1) {
            $this->session->set_flashdata('success', '<div class="alert alert-success text-center" id="successMessage">Data deleted successfully</div>');
        }
        else {
            $this->session->set_flashdata('error', '<div class="alert alert-danger text-center" id="successMessage">Unable to delete Data</div>');
        }
        redirect("admin/manage_team");
    }


}

?>