<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Nishant Practical Test</title>
	<script src="<?php echo base_url() ?>assets/js/jquery-1.12.0.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/transaction.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/transaction.css">
	<style type="text/css">
	
	</style>
</head>
<body>
	<div id="container">
		<?php
			$attributes = array('id' => 'transaction_form');
			echo form_open('transaction/getProductSearchResult',$attributes);
		?>
		<div class="transaction-filter-div">
			<?php 
				echo form_label('Please Select Client');
				echo form_dropdown('client', $clientList, 'large', 'id="js-select-client" class="select-box"');
			?>
		</div>
		<div class="transaction-filter-div">
			<?php 
				echo form_label(' Please Select Date :');
				echo form_dropdown('duration_type', $durationType, 'large', 'id="js-select-date" class="select-box"');
			?>
		</div>


		<div class="transaction-filter-div">
			<?php 
				echo form_label('Please Select products :');
				echo form_dropdown('product', array(), 'large', 'id="js-product-list" class="select-box"');
			?>
		</div>

		<div class="transaction-filter-div">
			<?php 
				echo form_button('submit', 'Submit','class="submit" id="js-submit"');
			?>
		</div>
		<?php 
			echo form_close();
		?>

		<div id="search_result">
		</div>
	</div>
</body>
</html>