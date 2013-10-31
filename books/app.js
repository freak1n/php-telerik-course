$(document).ready(function() {
	$('#add-comment-ta').on('keyup', function(e) {
		if (e.keyCode == 13) {
			var comment_text = $(this).val().trim();
			if (comment_text.length == 0) {
				return false;
			}
			var book_id = $(this).data('book-id');
			var username_provided = $(this).data('username');
			$.ajax({
				url: 'processes/add_comment.php',
				type: 'POST',
				dataType: 'json',
				data: {
					username: username_provided,
					book_id: book_id,
					comment_text: comment_text
				},
				complete: function (response) {
						var html =
						'<div class="comment-container">' +
							'<strong>' + username_provided + ' написа:</strong>' +
							'<div>'+ comment_text +'</div>' +
						'</div>';
						$('#comments-conatainer').append(html);
						$('#add-comment-ta').val('');
						$('#nobody-comment').remove();
					}

			});
		}
	});
});