<?php
class Login_model extends CI_Model
{
    
public function isvalidate($email,$password)
	{
		$q=$this->db->where("mobile",$email)->get('admin');
		 if($q->num_rows() > 0)
			 {
				$e = $q->row();
				$pass =$e->password;
				$a1=$e->id;
				if($pass != $password)
				{
					$this->session->set_flashdata('error','Password Mismatched !!</div>');
					return redirect('Login/index');
				}
				elseif($e->status == '1')
			{
				date_default_timezone_set('Asia/Calcutta'); 
				$dt= date("Y-m-d H:i:s"); // time in India
				$sdata=array(
				'updated_at'=>$dt
				);
				$dep=$this->db->where('id',$a1)->update('admin',$sdata);
				return $a1;
			  
			}
			elseif($e->status != '1')
			{
				$this->session->set_flashdata('error','Your account has been banned !!');	  
				return redirect('Login/index');
			}
			else
			{
				return false;
			}			
			}
			else
			{
			  
			  $q=$this->db->where("email",$email)->get('admin');
			  if($q->num_rows() > 0)
			 {
				$e = $q->row();
				$pass =$e->password;
				$a1=$e->id;
				if($pass != $password)
				{
					$this->session->set_flashdata('error','Password Mismatched !!</div>');
					return redirect('Login/index');
				}
				elseif($e->status == '1')
			{
				date_default_timezone_set('Asia/Calcutta'); 
				$dt= date("Y-m-d H:i:s"); // time in India
				$sdata=array(
				'updated_at'=>$dt
				);
				$dep=$this->db->where('id',$a1)->update('admin',$sdata);
				return $a1;
			  
			}
			elseif($e->status != '1')
			{
				$this->session->set_flashdata('Item','Your account has been banned !!');	  
				return redirect('Login/index');
			}
			else
			{
				return false;
			}			
			}  
			
			else
			{
			  return false;
			}
			}
	}
	
}

?>