<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends My_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Product_model', 'PM');
		$this->load->model('Common_model', 'CM');
	}

	public function manage_product()
	{
		$data['title'] = "Nabard - Manage Product";
		$data['page_name'] = "Manage Product";
		$data['products'] = $this->PM->get_all_vendor_product();
		$data['category'] = $this->PM->get_product_category();
		$data['subcategory'] = $this->PM->get_product_subcategory();
		$this->load->view('manage_product', $data);
	}

	public function fetch_subCategory_filter()
	{
		$vendor_id = isset($_GET['vendor_id']) ? $_GET['vendor_id'] : '';
		$category_id = isset($_GET['category']) ? $_GET['category'] : 0;
		$subcategory_id = isset($_GET['sub_category']) ? $_GET['sub_category'] : 0;
		$subCategory = $this->db->get_where('subcategory', ['parent_id' => $category_id,'status'=>1])->result_array();
// 		echo "<pre>";print_r($vendor_id);
// 		echo "<br>"; print_r($subcategory_id);
// 		echo "<br>"; print_r($category_id);
// 		exit;
		$product_data_vendor_filter = $this->PM->product_data_vendor_filter();
		$product_data_vendor_wise = $this->PM->product_data_vendor_wise($vendor_id);
		if ((!empty($category_id)) && (empty($subcategory_id)) && (empty($vendor_id))) {
			$product_data_category_wise = $this->PM->product_data_category_wise($category_id);
			$collectSubCategory = [];
			if (!empty($subCategory)) {
				$collectSubCategory[] = '<option value="">Select sub category</option>';
				foreach ($subCategory as $row) {
			$collectSubCategory[] = '<option  value="' . $row['id'] . '">' . $row['name'] . '</option>';	}
			} else {
				$collectSubCategory[] = '<option>No sub category available </option>';
			}
			echo json_encode(['subcategory_list' => $collectSubCategory, 'vendor_data_filter' => $product_data_category_wise, 'demo' => '1']);
		} 
		else if ((!empty($vendor_id)) && (empty($category_id)) && (empty($subcategory_id))) {
			$product_data_vendor_wise = $this->PM->product_data_vendor_wise($vendor_id);
			$collectSubCategory[] = '<option  value="">Select category first</option>';
			echo json_encode(['subcategory_list' => $collectSubCategory, 'vendor_data_filter' => $product_data_vendor_wise, 'demo' => '2']);
		} 	
		
// 		else if ((!empty($vendor_id)) && ($category_id == 0) && (!empty($subcategory_id))) {
// 		$product_data_vendor_wise = $this->PM->product_data_vendor_wise($vendor_id);
// 		$collectSubCategory[] = '<option  value="">Select category first</option>';
// 		echo json_encode(['subcategory_list' => $collectSubCategory, 'vendor_data_filter' => $product_data_vendor_wise, 'demo' => '2']);
// 	} 
	
	
	else if ((!empty($vendor_id)) && (!empty($category_id)) &&  (empty($subcategory_id))) {
		$product_data_vendor_category_wise = $this->PM->product_data_vendor_category_wise($vendor_id, $category_id);
			$collectSubCategory = [];
			if (!empty($subCategory)) {
				$collectSubCategory[] = '<option value="">Select sub category</option>';
				foreach ($subCategory as $row) {
					$collectSubCategory[] = '<option  value="' . $row['id'] . '">' . $row['name'] . '</option>';
				}
			} else {
				$collectCity[] = '<option>No sub category available</option>';
			}
			echo json_encode(['subcategory_list' => $collectSubCategory, 'vendor_data_filter' => $product_data_vendor_category_wise, 'demo' => '3']);
		} 	
		else if ((!empty($vendor_id)) && (!empty($category_id)) && (!empty($subcategory_id))) {

			$product_data_vendor_category_subcategory_wise = $this->PM->product_data_vendor_category_subcategory_wise($vendor_id, $category_id, $subcategory_id);
			$collectSubCategory = [];
			if (!empty($subCategory)) {
				$collectSubCategory[] = '<option value="">Select sub category</option>';
				foreach ($subCategory as $row) {
					$collectSubCategory[] = '<option  value="' . $row['id'] . '">' . $row['name'] . '</option>';
				}
			} else {
				$collectCity[] = '<option  value="">No sub category available</option>';
			}
			echo json_encode(['subcategory_list' => $collectSubCategory, 'vendor_data_filter' => $product_data_vendor_category_subcategory_wise, 'demo' => '4']);
		} else if ((!empty($category_id)) && (!empty($subcategory_id))) {
			$product_data_category_subcategory_wise = $this->PM->product_data_category_subcategory_wise($category_id, $subcategory_id);
			$collectSubCategory = [];
			if (!empty($subCategory)) {
				$collectSubCategory[] = '<option value="">Select sub category</option>';
				foreach ($subCategory as $row) {
					$collectSubCategory[] = '<option  value="' . $row['id'] . '">' . $row['name'] . '</option>';
				}
			} else {
				$collectCity[] = '<option  value="">No sub category available</option>';
			}
			echo json_encode(['subcategory_list' => $collectSubCategory, 'vendor_data_filter' => $product_data_category_subcategory_wise, 'demo' => '5']);
		} else {
			$collectSubCategory[] = '<option  value="">Select category first</option>';
			echo json_encode(['subcategory_list' => $collectSubCategory, 'vendor_data_filter' => $product_data_vendor_filter, 'demo' => 'else']);
		}
	}














	public function add_vendor_product()
	{
		$data = $this->input->post();
		if (isset($_POST['submit'])) {
			$array = array(
				'category_id' => $data['category'],
				'subcategory_id' => $data['subcategory'],
				'product_name_hindi' => $data['product_name_hindi'],
				'product_name_english' => $data['product_name_english'],
				'status' => 1,
			);
			$res = $this->PM->add_vendor_product($array);
			if ($res == true) {
				$this->session->set_flashdata('success', ' 
				<div class="alert alert-success alert-dismissible fade show">
				  Product Added Successfully
				  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
				</div>
				');
			} else {
				$this->session->set_flashdata('error', ' 
				<div class="alert alert-danger alert-dismissible fade show">
				  Product  Not Added Successfully
				  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
				</div>
				');
			}
		} else {
			$this->session->set_flashdata('error', ' 
			<div class="alert alert-danger alert-dismissible fade show">
			  Someting went wrong!
			  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
			</div>
			');
		}
		redirect('product/manage_product');
	}


	public function change_product_status($id)
	{
		$status = $this->db->query("select status from add_product where id =$id")->row()->status;
		if ($status == 1) {
			$productstatus = 0;
			$this->session->set_flashdata('success', ' <div class="alert alert-success alert-dismissible fade show">Status Changed Successfully<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
		} else {
			$productstatus = 1;
			$this->session->set_flashdata('success', ' <div class="alert alert-success alert-dismissible fade show">Status Changed Successfully <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
		}
		$data = array('status' => $productstatus);
		$this->db->where('id', $id);
		$this->db->update('add_product', $data);
		redirect(base_url() . "product/manage_product");
	}

	public function delete_vendor_product($id)
	{
		$res = $this->PM->delete_vendor_product($id);
		if ($res == 1) {
			$this->session->set_flashdata('success', ' <div class="alert alert-success alert-dismissible fade show">Product Deleted Successfully<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
		} else {
			$this->session->set_flashdata('error', ' <div class="alert alert-danger alert-dismissible fade show">Someting went wrong  <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
		}
		redirect('product/manage_product');
	}



	public function update_vendor_product($id)
	{
		$data = $this->input->post();
		if (isset($_POST['update'])) {
			$array = array(
				'product_name_english' => $data['product_name_english'],
				'product_name_hindi' => $data['product_name_hindi'],
				'category_id' => $data['category'],
				'subcategory_id' => $data['subcategory'],
				'status' => 1,
			);
			$res = $this->PM->update_vendor_product($id, $array);
			if ($res == 1) {
				$this->session->set_flashdata('success', ' <div class="alert alert-success alert-dismissible fade show">Product Updated Successfully<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
			} else {
				$this->session->set_flashdata('error', ' <div class="alert alert-danger alert-dismissible fade show">Someting went wrong <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
			}
			redirect('product/manage_product');
		}
	}




	public function change_productRequest_status()
	{
		$product_req_id = $this->input->post('req_id');
		$status = $this->input->post('status');
		$vendor_id = $this->input->post('vendor_id');


		if ($product_req_id != "" && $status != "") {
			$res = $this->PM->change_productRequest_status($product_req_id, $status);
			if ($res) {
				echo json_encode(["success" => true, "message" => "Product Request Status Updated Successfully."]);
			} else {
				echo json_encode(["success" => false, "message" => "Something Went Wrong"]);
			}
		}
	}





	public function update_productRequest_status()
	{
		$req_id = $_GET['id'];
		// $status = $this->input->post('status');
		/*      if($req_id!="" && $status!="")
		{
		$res = $this->PM->change_productRequest_status($req_id,$status);
		if($res)
		{
		echo json_encode(["success" =>true, "message" => "Product Request Status Updated Successfully."]);    
		}else{
		echo json_encode(["success" =>false, "message" => "Something Went Wrong"]);  
		}
		} */

		$status = $this->db->query("select status from product where id =$req_id")->row()->status;
		if ($status == 1) {
			$productstatus = 0;
			$this->session->set_flashdata('success', ' <div class="alert alert-success alert-dismissible fade show"> Status Changed Successfully<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
		} else {
			$productstatus = 1;
			$this->session->set_flashdata('success', ' <div class="alert alert-success alert-dismissible fade show">Status Changed Successfully <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
		}
		$data = array('status' => $productstatus);
		$this->db->where('id', $req_id);
		$res = $this->db->update('product', $data);

		redirect('admin/product_request');
	}


	public function fetch_subCategory()
	{

		$category_id = isset($_GET['category']) ? $_GET['category'] : 0;

		$subCategory = $this->db->get_where('subcategory', ['parent_id' => $category_id, 'status' => 1])->result_array();
		$product_data_vendor_filter = $this->PM->product_data_vendor_filter();

		if (!empty($category_id)) {

			$product_data_category_wise = $this->PM->product_data_category_wise($category_id);

			$collectSubCategory = [];
			if (!empty($subCategory)) {
				$collectSubCategory[] = '<option value="">Select sub category</option>';
				foreach ($subCategory as $row) {
					$collectSubCategory[] = '<option  value="' . $row['id'] . '">' . $row['name'] . '</option>';
				}
			} else {
				$collectSubCategory[] = '<option value=""> No sub category available </option>';
			}
			echo json_encode(['subcategory_list' => $collectSubCategory, 'demo' => '1']);
		} else {
			$colletSubCategory[] = '<option value="">Select category first</option>';
			echo json_encode(['subcategory_list' => $colletSubCategory, 'demo' => 'else']);
		}
	}





	public function fetch_subCategory_edit()
	{
		$category_id = $this->input->post('category');
		$subCategory = $this->db->get_where('subcategory', ['parent_id' => $category_id, 'status' => 1])->result_array();
		if (!empty($category_id)) {

			$collectSubCategory = [];
			if (!empty($subCategory)) {
				$collectSubCategory[] = '<option value="">Select sub category</option>';
				foreach ($subCategory as $row) {
					$collectSubCategory[] = '<option  value="' . $row['id'] . '">' . $row['name'] . '</option>';
				}
			} else {
				$collectSubCategory[] = '<option>No sub category available </option>';
			}
			echo json_encode(['subcategory_list' => $collectSubCategory, 'demo' => '1']);
		} else {
			$colletSubCategory[] = '<option>select category first</option>';
			echo json_encode(['subcategory_list' => $colletSubCategory, 'demo' => 'else']);
		}
	}




	public function change_user_status($id)
	{
		$status = $this->db->query("select status from users where id = $id")->row()->status;
		if ($status == 1) {
			$productstatus = 0;
			$this->session->set_flashdata('success', ' <div class="alert alert-success alert-dismissible fade show">Status Changed Successfully<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
		} else {
			$productstatus = 1;
			$this->session->set_flashdata('success', ' <div class="alert alert-success alert-dismissible fade show">Status Changed Successfully <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
		}
		$data = array('status' => $productstatus);
		$this->db->where('id', $id);
		$this->db->update('users', $data);
		redirect(base_url() . "admin/manage_user");
	}



	public function delete_user($id)
	{
		$res = $this->PM->delete_user($id);
		if ($res == 1) {
			$this->session->set_flashdata('success', ' <div class="alert alert-success alert-dismissible fade show">User Deleted Successfully<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
		} else {
			$this->session->set_flashdata('error', ' <div class="alert alert-danger alert-dismissible fade show">Someting went wrong  <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
		}
		redirect('admin/manage_user');
	}


	public function update_shopdetails(){
	    $data =	$this->input->post();
	    $vendor_id=$data['vendor_id'];
		$array = array('name'=>$data['name'],
		'mobile'=>$data['mobile'],
		'email'=>$data['email'],
		'district'=>$data['district'],
		'tehsil'=>$data['tehsil'],
		'village'=>$data['village'],
		'block'=>$data['block'],
		'pincode'=>$data['pincode']
	);
		$res =$this->PM->update_shopdetails($array,$vendor_id);
		if ($res == 1) {
			$this->session->set_flashdata('success', ' <div class="alert alert-success alert-dismissible fade show">Shop details updated Successfully<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
		} else {
			$this->session->set_flashdata('error', ' <div class="alert alert-danger alert-dismissible fade show">Someting went wrong  <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
		}
		redirect($_SERVER['HTTP_REFERER']);

	}


}