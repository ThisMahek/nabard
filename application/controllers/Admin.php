<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends My_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('admin_nid'))
		return redirect('Login/Index');
		$this->load->Model('Mvendor', 'MV');
		$this->load->model('Product_model','PM');	
		$this->load->model('Common_Model','CM');	
		$this->load->model('Master_model','MM');	
	}


 public function index()
	{

		$data['total_user']=$this->db->select('count(id) count')->where('status!=','3')->get('users')->row()->count;
		$data['total_vendor']=$this->db->select('count(id) count')->where('status!=','3')->get('vendor')->row()->count;
		$data['total_category']=$this->db->select('count(id) count')->where(['status!='=>'3'])->get('category')->row()->count;
		$data['total_product']=$this->db->select('count(id) count')->where(['status!='=>'3'])->get('product')->row()->count;
		$data['total_enquiry']=$this->db->select('count(id) count')->where(['status!='=>'3'])->get(' enquiry_details')->row()->count;
  
	$data['payment']= $this->db->query("SELECT  ROUND(SUM(product.price),2 )AS 'payment' FROM `product` JOIN `enquiry_details` ON `enquiry_details`.`product_id`=`product`.`id` WHERE `enquiry_details`.`status` = 4")->row()->payment; 
	
		$data['title'] = "Nabard - Admin Dashboard";
		$data['page_name'] = "Dashboard";
		$this->load->view('index', $data);	
	}





	



	public function manage_user()
	{

		$data['title'] = "Nabard - Manage User";
		$data['page_name'] = "Manage User";
		$data['states'] = $this->db->select('tbl_state.name as sname,district.name as dname,tbl_state.status as s_status,district.status as d_status,district.state_id,district.id as d_id,tbl_state.id as s_id')->from('district')->join('tbl_state','tbl_state.id = district.state_id')->group_by('tbl_state.id')->where(['district.status'=>1])->get()->result_array();

		$data['users']=$this->MV->get_user_details();


		
		/* echo "<pre>";
		print_r($data['users']);
		exit; */
		$this->load->view('manage_user', $data);
	}

	
	public function get_active_district_state()
	{
	
	$result=$this->db->select('tbl_state.name as sname , tbl_state.id as sid,district.name as dname,district.id as did')->from('tbl_state')
	->join('district','district.state_id = tbl_state.id')
	->where(['district.status'=>1])
	->group_by('district.state_id')
	->get()
	->result_array();
	}
	


	public function product_request()
	{
		$data['title'] = "Nabard - Manage Product Request";
		$data['page_name'] = "Product Request";
		$data['category']=$this->PM->get_product_category();
		$data['products']= $this->PM->get_product_request();
		$data['vendors']= $this->PM->get_all_vendors();
		// echo "<pre>"; print_r($data['products']);exit;
		$data['category']= $this->PM->get_category();
		$this->load->view('product_request', $data);
	}

	public function manage_vendor()
	{
		$data['title'] = "Nabard - Manage Vendor";
		$data['page_name'] = "Manage Vendor";
		$row = $this->MV->get_vendor_details();
		// $vendors_bod= $this->MV->get_vendor_bod_details();
		// $row = $this->MV->get_vendor_details();
		$vendors_bod = $this->MV->get_vendor_bod_details();

		/* echo "<pre>";
		print_r($row);
		exit;	 */	
		    foreach ($row as $vendors) {
			$data['vendors'][] = array(
				'id' => $vendors['id'],
				'name' => $vendors['v_name'],
				'email' => $vendors['email'],
				'district' => $vendors['district'],
				'field_type' => $vendors['field_type'],
				'father_name' => $vendors['father_name'],
				'gender' => $vendors['gender'],
				'mobile' => $vendors['mobile'],
				'block' => $vendors['block'],
				'bod' => $vendors['bod'],
				'tehsil' => $vendors['tehsil'],
				'village' => $vendors['village'],
				'pincode' => $vendors['pincode'],
				'aadhar_no' => $vendors['aadhar_no'],
				'user_id' => $vendors['user_id'],
				'status'=>$vendors['v_status'],
				'is_block'=>$vendors['is_block'],
				'added_by'=>$vendors['added_by'],
				'decry_password'=>$vendors['decry_password'],
				'representative'=>$vendors['representative'],
				'promoting_agency'=>$vendors['promoting_agency'],
				'office_address'=>$vendors['office_address'],
				'product'=>$vendors['product'],
				'basic_info'=>$vendors['basic_info'],
				'reg_no'=>$vendors['reg_no'],
				'profile_image'=>$vendors['profile_image'],
				'vendors_bod' => ($this->get_bod($vendors['id'])),
				'vendor_rating'=>($this->get_rating($vendors['id'])),
			);	
		}


/* 		echo "<pre>";
		print_r($data['vendors']);
		exit; */
    $this->load->view('manage_vendor', $data);
	}


	public function get_bod($id)
	{
		$vendors_bod = $this->MV->get_vendors_bod($id);
		$array = [];
		foreach ($vendors_bod as $row) {
			$tempArr = $row['vendor_id'] == $id?$row:'';
			if(!empty($tempArr)){
				$array[]=$tempArr;
			}
		}
		return $array;	
	}


	public function get_rating($id)
	{
		$vendors_rating = $this->MV->get_vendors_product_rating($id);
		// echo '<pre>';echo $this->db->last_query();
		// $x =number_format($vendors_rating['rating'], 1, '.', '');
		return $vendors_rating;

		// echo $vendors_rating;
		/* $rating_count =$vendors_rating->num_rows();
		/* echo $rating_count;
		exit; */
	/* 	$vendor_rating = $vendors_rating->result_array();
		$tempArr = [];
		foreach ($vendor_rating as $row) {
			$tempArr += $row['rating_value'];	
		}  */
		// $total_rating= $tempArr/$rating_count;
		// return $tempArr;

			// echo "<pre>";
		// print_r($vendors_rating->num_rows());
		// exit;
	}
	public function manage_farmer()
	{
	
			$data['title'] = "Nabard - Manage Farmer Vendor";
			$data['vendors_farmer'] = $this->MV->get_vendor_farmer_details();
			$data['page_name'] = "Manage Farmer Vendor";
	/* 	echo "<pre>";
		print_r($data['vendors_farmer']);
		exit; */
			$this->load->view('manage_farmer', $data);
	
	}
	public function add_farmer()
	{
		if($this->session->userdata('vendor_phone_farmer')){
			$data['title'] = "Nabard - Add Farmer Vendor";
			$data['page_name'] = "Add Farmer Vendor";
			$data['district']= $this->MV->get_district();
			$this->load->view('add_farmer', $data);
		}else{
			redirect('admin/manage_farmer');
		}
	
	}
	public function edit_farmer($id = '')
	{
		$data['title'] = "Nabard - Update Farmer Vendor";
		$data['page_name'] = "Update Farmer Vendor";
		$data['district']=$this->MV->get_district();
		$data['data'] = $this->MV->get_farmer_details($id);
		$district_id = $data['data']['district_id'];
	    $data['block']=$this->MV->get_block($district_id);
		$this->load->view('edit_farmer', $data);
	}

	public function edit_users($id = '')
	{
		$data['title'] = "Nabard - Update Users ";
		$data['page_name'] = "Update Users";
		$data['users']=$this->MV->get_user_detail($id);

		$data['district']=$this->MV->get_district();
		$data['data'] = $this->MV->get_farmer_details($id);
		$district_id = $data['data']['district_id'];

		$data['states'] = $this->db->select('tbl_state.name as sname,district.name as dname,tbl_state.status as s_status,district.status as d_status,district.state_id,district.id as d_id,tbl_state.id as s_id')->from('district')->join('tbl_state','tbl_state.id = district.state_id')->group_by('tbl_state.id')->where(['district.status'=>1])->get()->result_array();

	    $data['block']=$this->MV->get_block($district_id);
		$this->load->view('edit_users', $data);
	}
	public function vendor_enquiry()
	{
		$data['title'] = "Nabard -Manage Vendor Enquiry";
		$data['page_name'] = "Manage Vendor Enquiry";
		$data['general_enquiry'] = $this->MV->get_users_general_enquiry();
		$this->load->view('vendor_enquiry', $data);
	}
	public function enquiry()
	{ 
		$data['title'] = "Nabard - Product Enquiry";
		$data['page_name'] = "Product Enquiry";
		$data['product_enquiry'] = $this->MV->get_product_enquiry();
		$data['status_data'] = $this->MV->get_status();
	    $data['vendor_data'] = $this->MV->get_vendor_data();


// 		echo "<pre>"; print_r($data['product_enquiry']);exit;
// 		echo "<pre>"; print_r($data['status_data']);
//	echo "<pre>"; print_r($data['vendor_data']);exit;

		$this->load->view('enquiry', $data);
	}
	public function edit_vendor($id = '')
	{
	
		$data = $this->MV->get_farmer_details_fpo_shg($id);
		$district_id =$data['district_id'];
		$data['district']=$this->MV->get_district();
		$data['block']=$this->MV->get_block($district_id);
		$data['data']= array(
			'vendor_details'=>$data,
			'vendor_bod'=>$this->MV->get_vendors_bod($id),		
		);
		$data['title'] = "Nabard - Update Vendor";
		$data['page_name'] = "Update Vendor";
		$this->load->view('edit_vendor', $data);
	}

	public function add_vendor()
	{
		if ($this->session->userdata('vendor_phone_fpo_shg')) {
			$data['title'] = "Nabard - Add Vendor";
			$data['page_name'] = "Add Vendor";
			$data['district'] = $this->MV->get_district();
			$this->load->view('add_vendor', $data);
		}else{
			redirect('admin/manage_vendor');
		}
	}
	public function add_user()
	{
		$data['title'] = "Nabard - Add User";
		$data['page_name'] = "Add User";
		$this->load->view('add_user', $data);
	}
	public function edit_user()
	{
		$data['title'] = "Nabard - Edit User";
		$data['page_name'] = "Edit User";
		$this->load->view('edit_user', $data);
	}
	public function add_product()
	{
		$data['title'] = "Nabard - Add Product";
		$data['page_name'] = "Add Product";
		$this->load->view('add_product', $data);
	}
	public function edit_product()
	{
		$data['title'] = "Nabard - Update Product";
		$data['page_name'] = "Update Product";
		$this->load->view('edit_product', $data);
	}
	public function login()
	{
		$data['title'] = "Nabard - Admin Login";
		$data['page_name'] = "Admin Login";
		$this->load->view('login', $data);
	}
	public function manage_order()
	{
		$data['title'] = "Nabard - Manage Orders";
		$data['page_name'] = "Manage Orders";
		$this->load->view('manage_order', $data);
	}
	public function manage_gallery()
	{
		$data['title'] = "Nabard - Manage Gallery";
		$data['page_name'] = "Manage Gallery";
		$this->load->view('manage_gallery', $data);
	}

	public function manage_news()
	{
		$data['title'] = "Nabard - Manage News";
		$data['page_name'] = "Manage News";
		$this->load->view('manage_news', $data);
	}

	public function manage_events()
	{
		$data['title'] = "Nabard - Manage Events";
		$data['page_name'] = "Manage Events";
		$this->load->view('manage_events', $data);
	}
	public function user_enquiry()
	{
		$data['title'] = "Nabard - User Enquiry";
		$data['page_name'] = "User Enquiry";
		$data['users_enquiry'] = $this->MV->get_users_enquiry();

		$this->load->view('user_enquiry', $data);
	}
	public function terms_condition()
	{

	
		if(isset($_POST['submit'])){

			unset($_POST['submit']);
			$term_condition = $this->input->post('term_condition');
			$res=$this->PM->update_term_condition($term_condition);
				if ($res == 1) {
					$this->session->set_flashdata('success', ' <div class="alert alert-success alert-dismissible fade show">Term & Conditon updated successfully<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
				  } else {
					$this->session->set_flashdata('error', ' <div class="alert alert-danger alert-dismissible fade show">Someting went wrong  <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
				  }
				  redirect('admin/terms_condition');
		}
		$data['row'] = $this->PM->get_term_condition();
		$data['title'] = "Nabard - Terms & Conditions";
		$data['page_name'] = "Terms & Conditions";


		$this->load->view('terms_condition', $data);
	}
	public function privacy_policies()
	{
		if(isset($_POST['submit'])){
			unset($_POST['submit']);
			$privacy_policy = $this->input->post('privacy_policy');
			$res=$this->PM->update_privacy_policy($privacy_policy);
				if ($res == 1) {
					$this->session->set_flashdata('success', ' <div class="alert alert-success alert-dismissible fade show">Privacy & Policy updated successfully<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
				  } else {
					$this->session->set_flashdata('error', ' <div class="alert alert-danger alert-dismissible fade show">Someting went wrong  <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
				  }
				  redirect('admin/privacy_policies');
		}
		$data['title'] = "Nabard - Privacy Policy";
		$data['page_name'] = "Privacy Policy";
		$data['row'] = $this->PM->get_term_condition();
		$this->load->view('privacy_policies', $data);
	}
	public function invoice()
	{
		$data['title'] = "Nabard - Invoice";
		$data['page_name'] = "Invoice";
		$this->load->view('invoice', $data);
	}
	public function customer_feedback()
	{
		$data['title'] = "Nabard - Customer Feedback";
		$data['page_name'] = "Customer Feedback";
		$this->load->view('customer_feedback', $data);
	}
	public function manage_team()
	{
		$table = "tbl_team";
        $status = 2;
		$data['teams']= $this->db->get_where('tbl_team',['status !='=>2])->result_array();
		$data['title'] = "Nabard - Manage Team";
		$data['page_name'] = "Manage Team";
		$this->load->view('manage_team', $data);
	}
	public function subscriber_list()
	{
		$data['title'] = "Nabard - Subscriber List";
		$data['page_name'] = "Subscriber List";
		$this->load->view('subscriber_list', $data);
	}
	public function manage_state()
	{
		$data['title'] = "Nabard - Manage State & District";
		$data['page_name'] = "Manage State & District";
		$data['states']= $this->db->get_where('tbl_state',['status'=>0])->result_array();
		$data['state_table'] =  $this->MM->get_district_table();
		$this->load->view('manage_state', $data);
	}


	public function manage_block()
	{
		$data['title'] = "Nabard - Manage Block";
		$data['page_name'] = "Add Block";
		$data['state']= $this->db->get_where('tbl_state',['status'=>0])->result_array();
		$data['state_table'] =  $this->MM->get_district_table();
		$data['states'] = $this->db->select('tbl_state.name as sname,district.name as dname,tbl_state.status as s_status,district.status as d_status,district.state_id,district.id as d_id,tbl_state.id as s_id')->from('district')->join('tbl_state','tbl_state.id = district.state_id')->group_by('tbl_state.id')->where(['district.status'=>1])->get()->result_array();
		$data['block_table'] = $this->db->select('tbl_state.name as sname,district.name as dname,tbl_state.status as s_status,district.status as d_status,district.state_id,district.id as d_id,tbl_state.id as s_id,block.district_id,block.name as bname,block.id as b_id,block.status as b_status')
		->from('district')
		->join('tbl_state','tbl_state.id = district.state_id')
		->join('block','block.district_id = district.id')
		// ->group_by('tbl_state.id')
		->where(['district.status'=>1])
		->get()->result_array();
		/* echo "<pre>";
		print_r($sid);
		exit; */
		$this->load->view('add_block', $data);
	}
	public function product_details($product_id,$vendor_id)
	{
		
		$data['title'] = "Nabard - Product Details";
		$data['page_name'] = "Product Details";
		$result = $this->PM->get_product_request_by_vendors($product_id,$vendor_id);
		$result['vendor_id'] = $vendor_id;
		$data['vendor_product'] = $result;
		$data['images'] =	explode(",",$result['product_images']);
		$data['product_varient'] = $this->PM->get_product_varient($product_id,$vendor_id);
		$product_id = $result['product_id'];
		$data['vendor_shop'] = $this->PM->get_vendor_shop($vendor_id);


// 		echo "<pre>";
// 		echo $vendor_id;
// 		print_r($data['vendor_shop']);
// 		exit; 
	/* 	echo "<pre>";
		echo "<br>";
		foreach($data['product_varient'] as $row){
			echo "<br>";
			$var = explode(",",$row['varient_images']) ;

			print_r($var);
		}
	
		exit; */
	    $this->load->view('product_details', $data);
	}

}