<div id="user_hello" style="margin-bottom:50px"><p><span>Обратная связь</span></p></div><br/>
<div style="clear:left;"></div>
<span style="margin-left:30px" id="feedback_success_message"></span>
	<div id="feedback_block">
		<form style="margin-left:30px" id="feedback_form" action="javascript:void(null);" method="post">
				<label for="feedback_name">Ваше имя<div class="user_error" id="feedback_name_error"><img src="img/left.png" />Обязательное поле</div></label>
				<input type="text" id="feedback_name" name="feedback_name" value="<?php echo$_SESSION['autorization_name']; ?>"/></br></br></br>
				<label for="feedback_email">Ваша электронная почта<div class="user_error" id="feedback_email_error"><img src="img/left.png" />Обязательное поле</div></label>
				<input type="text" id="feedback_email" name="feedback_email" value="<?php echo$_SESSION['autorization_email']; ?>"/></br></br></br>
				<label for="feedback_subject">Тема сообщения<div class="user_error" id="feedback_subject_error"><img src="img/left.png" />Обязательное поле</div></label>
				<input type="text" id="feedback_subject" name="feedback_subject" value=""/></br></br></br>
				<label for="feedback_message">Текст сообщения<div class="user_error" id="feedback_message_error"><img src="img/left.png" />Обязательное поле</div></label>
				<textarea id="feedback_message"></textarea><br/></br></br></br></br></br>
				<input style="margin-left:30px" type="submit" id="feedback_submit" name="feedback_submit" />
		</form>
</div>