<?php 
// transaction model for all Queries
class transactionModel extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    /*
    * Function will returl al  the Client List
    */
    function getAllClientList()
    {
		// Fetch records from client table.
        $query = $this->db->get('clients');
		$results = $query->result_array();
		
		$rec = array();
		if(empty($results)){
			$rec[0] = 'No company available';
		}else{
			$rec[0]= 'Select Client/Company';
		}
		
		//convert all records into key=>value pair.
		foreach($results as $row){
			$rec[$row['client_id']] = $row['client_name'];
		}
		
		//return records
		return $rec;
    }

     function getAllProductList($client) {
        // Fetch records from client table.
        $this->db->where('client_id', $client);
        $query = $this->db->get('products');

        $results = $query->result_array();

        $rec = array();
        if (empty($results)) {
            $rec[0] = 'No products found';
        } else {
            $rec[0] = 'Select products';
        }

        //convert all records into key=>value pair.
        foreach ($results as $row) {
            $rec[] = array("key" => $row['product_id'], "value" => $row['product_description']);
        }

        //return records
        return $rec;
    }

	/*
	*  search_records function will required two parameters
	*  client name and date type
	*
	*/
    function getAllProductSearchResult($client, $durationType,$productId)
    {

    	$where = "p.client_id ='".$client."'";
		if($durationType == "current_month")
		{
				$where .= ' and inv.invoice_date >="'.date('Y-m-1').'" and inv.invoice_date <="'.date('Y-m-31').'"';
		}	
		elseif($durationType == "last_month")
		{
			$fromDate = date('Y-m-d', strtotime(date('Y-m')." -1 month"));
			$where .= ' And inv.invoice_date >="'.$fromDate.'" and inv.invoice_date <="'.date('Y-m-d').'"';
		}	
		elseif($durationType == "current_year")
		{
			$where .= ' and inv.invoice_date >="'.date('Y-1-1').'" and inv.invoice_date <="'.date('Y-12-31').'"';
		}
		elseif($durationType == "last_year")
		{
			$year = date("Y",strtotime("-1 year"));
			$where .= ' and inv.invoice_date >="'.$year.'-1-1" and inv.invoice_date <="'.$year.'-12-31"';
		}
		if(!empty($productId))
		{
			$where .= ' and p.product_id ="'.$productId.'" ';	
		}

		$this->db->select('inv.invoice_num, inv.invoice_date, p.product_description, invil.qty, invil.price');
		$this->db->from('invoices as inv');
		
		$this->db->where($where);
		$this->db->join('invoicelineitems as invil','invil.invoice_num = inv.invoice_num');
		$this->db->join('products as p','p.product_id = invil.product_id');
		$this->db->order_by('inv.invoice_date ASC');
		$this->db->order_by('inv.invoice_num ASC');
		$query = $this->db->get();
		return  $query->result_array();
    }    
}
?>