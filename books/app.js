$(document).ready(function() {
	$('#add-comment-ta').on('keyup', function(e) {
		if (e.keyCode == 13) {
			var comment_text = $(this).val().trim();
			if (comment_text.length == 0) {
				return false;
			}
			var book_id = $(this).data('book-id');
			var user_id = $(this).data('user-name');
			console.log(user_id);
			$.ajax({
				url: 'processes/add_comment.php',
				type: 'POST',
				dataType: 'json',
				data: {
					username: user_id,
					book_id: book_id,
					comment_text: comment_text
				},
				complete: function (response) {

				}
			});
		}
	});
});