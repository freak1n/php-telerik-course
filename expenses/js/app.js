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
							'<tr data-id="' + el.id + '">' +
								'<td>'+ el.product +'</td>' +
								'<td>'+ el.price + ' $</td>' +
								'<td>'+ el.group +'</td>' +	
								'<td>'+ el.date +'</td>' +
								'<td><a href="#" class="delete-btn">Delete</a></td>' +  
							'</tr>';				
					});

					$('#expenses-table tbody').html(html);
					$('#total-price-cell').text(response_json.total_price + ' $')
				}
			}
		});
	});

	$('body').on('click', '.delete-btn', function (e) {
		var current_id = $(this).parents('tr').data('id');
		var current_total_price = $('#total-price-cell span').text();
		$.ajax({
			url: 'processes/delete_expense.php?expence_id='+current_id+'&current_total_price='+current_total_price,
			type: 'GET',
			dataType: 'json', 
			complete: function (response) {
				var response_json = response.responseJSON;
				if (response_json.status == 'ok')
				{
					$('#total-price-cell span').text(response_json.total_price);
					$("tr[data-id='"+current_id+"']").remove();
				}
			}
		});
	});
});