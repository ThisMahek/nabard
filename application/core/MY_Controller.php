<?php 
class MY_Controller extends CI_Controller
{
    public function __construct()
        {
        parent::__construct();
        $this->load->model("Common_Model","CM");
        }
     
    public function addtables($table,$array)
        {
        return $this->CM->addtables($table,$array);
        }
     
    public function updatestatus($table,$data,$id)
        {
        return $this->CM->updatestatus($table,$data,$id);
        }
         
    public function deleteTable($id,$table)
        {
        return $this->CM->deleteTable($id,$table);
        }
    
    public function UpdateTable($id,$table,$array)
        {
            return $this->CM->UpdateTable($id,$table,$array); 
        }
            /*   public function imagepdf ($image= null ,$pdf=null)
                    {
                        
                    } */
    public function selectdata($table,$status)
            {
              return $this->CM->selectdata($table,$status);
            }

}


?>