$(document).ready(function(){
	 $("#js-select-client").change(function(){
		$.post('http://localhost/nishant/index.php/transaction/getProductList',{client:$(this).val()},function(response){
			var options = $.parseJSON(response); // Decode JSON Response
			$("#js-product-list option").remove();
			$.each(options, function (i, result) {
				$('#js-product-list').append($('<option>', { 
					value: result.key,
					text : result.value 
				}));
			});
		});
	});

	$("#js-submit").click(function(){
		var params = $( "#transaction_form" ).serialize();
		var url = $('#transaction_form').attr('action');
		
		// Ajax call to post the form
		$.post(url,params,function(response){
			//Display results in result div.
			$("#search_result").html(response);

		});
	});
});