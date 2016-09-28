<?php

class Registrationform {

	public $show;

	public function __construct($message = "", $username = "", $password = ""){
		$this->show =  "
		<h2>Register new user</h2>
    <form action='?register' method='post' enctype='multipart/form-data'>
				<fieldset>
				<legend>Register a new user - Write username and password</legend>
					<p id='LoginView::Message'>{$message}</p>

					<label>Username:
					     <input type='text' size='20' name='RegisterView::UserName' id='RegisterView::UserName' <value='{$username}'>
					</label>

					<label>Password:
					     <input type='password' size='20' name='RegisterView::Password' id='RegisterView::Password' value='{$password}'>
					</label>

					<label>Repeat password:
					     <input type='password' size='20' name='RegisterView::PasswordRepeat' id='RegisterView::PasswordRepeat'>
					</label>

					<input id='submit' type='submit' name='DoRegistration' value='register' />

				</fieldset>
			</form>
    ";
	}
}
