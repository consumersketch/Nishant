<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaction extends CI_Controller {

	public function init()
	{
		// Load transaction model
		return $this->load->model('transactionModel','transactionModel');
	}


	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$this->init();
		
		$data = array();
		$data['clientList'] = $this->transactionModel->getAllClientList(); // Fetch All the Clients
		
		// Make All Date Filters
		$data['durationType'] = array(
			'0'=>"Select Date",
			'current_month'=>"Current Month",
			'last_month'=>"Last Month",
			'current_year'=>"Current Year",
			'last_year'=>"Last Year",
		);
						
		//Transaction Form View
		$this->load->view('transactionDefault', $data);
	}

	

	/**
	 * Get All The Search result when Click on Submit Button
	 *
	 */
	public function getProductSearchResult(){
		$post = $this->input->post();
		$this->init();
		$data = array();
		//Fetch matching records 
		$data['search_result'] = $this->transactionModel->getAllProductSearchResult($post['client'],$post['duration_type'], $post['product']);	
		//generate all product search lists
		$this->load->view('transactionResult',$data);
		
	}
	

	/**
	 * Get All Product List When Change The Client Dropdown
	 *
	 */
	public function getProductList(){
		//Fetch post data
		$post = $this->input->post();
		$this->init();
		//Fetch records 
		$data = array();
		$result = $this->transactionModel->getAllProductList($post['client']);
		//Print jason encoded response
		echo json_encode($result);exit;
		
	}
	
}
