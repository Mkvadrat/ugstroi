//Комментарии
jQuery(function($){
	$('#commentform').submit(function(){
			$.ajax({
				type : 'POST',
				url : 'http://' + location.host + '/wp-admin/admin-ajax.php',
				data: $(this).serialize() + '&action=ajaxcomments',
				beforeSend: function(xhr){
					// действие при отправке формы, сразу после нажатия на кнопку #submit
					//$('#submit').addClass('loadingform').val('Загрузка');
					$('#submit').text('Загрузка');
				},
				error: function (request, status, error) {
					if(status==500){
						alert('Ошибка при добавлении комментария');
					} else if(status=='timeout'){
						alert('Ошибка: Сервер не отвечает, попробуй ещё.');
					} else {

					}
				},
				success: function (error_comments) {
					$('#respond').text(error_comments);

					if(!error_comments){
						$('#respond').text("Вы успешно оставили комментарий");
					}
				},
				complete: function(){

					// действие, после того, как комментарий был добавлен

					/*$('#author').val('');

					$('#email').val('');

					$('#theme_value').val('');*/

					$('#comment').val('');

					//$('#submit').removeClass('loadingform').val('Отправить');

					$('#submit').text('Отправить');
				}

			});
		return false;
	});
});
