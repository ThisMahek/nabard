<?php
class Common_Model extends CI_Model{
    public function addtables($table,$array)
        {
           $this->db->insert($table,$array);
           return   $this->db->insert_id();
        }
    public function updatestatus($table,$data,$id)
        {
            $this->db->where('id',$id);
            return $this->db->update($table,$data);
        }
    public function  deleteTable($id,$table)
        {
            $status['status']=2;
            return $this->db->where('id',$id)->update($table,$status);
        }
    public function  UpdateTable($id,$table,$array)
        {
            return $this->db->where('id',$id)->update($table,$array);
        }
    }?>