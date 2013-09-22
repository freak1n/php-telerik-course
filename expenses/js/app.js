$(document).ready(function() {
	$('#filter-by-dd').on('change', function (e) {
		var group_id = e.currentTarget.value;
		$.ajax({
			url: 'processes/get_expenses.php?group_id='+group_id,
			type: 'GET',
			dataType: 'json', 
			complete: function (response) {
				var response_json = response.responseJSON;
				if (response_json.status == 'ok') {
					var html = '';
					$(response_json.data).each(function(i, el) {
						html += 				
							'<tr>' +
								'<td>'+ el.product +'</td>' +
								'<td>'+ el.price + ' $</td>' +
								'<td>'+ el.group +'</td>' +	
								'<td>'+ el.date +'</td>' +
							'</tr>';				
					});

					$('#expenses-table tbody').html(html);
					$('#total-price-cell').text(response_json.total_price + ' $')
				}
			}
		});
	});
});