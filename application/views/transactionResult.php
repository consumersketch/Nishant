

<div id="container">
	<table>
		<tr>
			<th>Invoice Num</th>
			<th>Invoice Date</th>
			<th>Product</th>
			<th>Qty</th>
			<th>Price</th>
			<th>Total</th>
		</tr>
		<?php 
			if(count($search_result)>0)
			{
				foreach($search_result as $result)
				{
					echo '<tr>';
					echo '<td>'.$result["invoice_num"].'</td>';
					echo '<td>'.$result["invoice_date"].'</td>';
					echo '<td>'.$result["product_description"].'</td>';
					echo '<td>'.$result["qty"].'</td>';
					echo '<td align="right">'.$result["price"].'</td>';
					//$qty =;
					//$price = 
					$total = $result["qty"]* $result["price"];
					echo '<td class="tbl-sub-item" align="right">'.$total.'</td>';
					echo '</tr>';
				}
				
			}
			else{
				echo '<tr><td colspan="6">No record Found</td></tr>';
			}

		?>
	</table>
		
</div>
