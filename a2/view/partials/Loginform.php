<?php


class Loginform {

	public $show;

	public function __construct($message, $username, $password) {
		$this->show = "
		<form method='post'>
			<fieldset>
				<legend>Login - enter Username and password</legend>

				<p id='LoginView::Message'>{$message}</p>

				<label for='LoginView::UserName'>Username :</label>
					<input type='text' id='LoginView::UserName' name='LoginView::UserName' value='{$username}'/>

				<label for='LoginView::Password'>Password :</label>
					<input type='password' id='LoginView::Password' name='LoginView::Password'/>

				<label for='LoginView::KeepMeLoggedIn'>Keep me logged in  :</label>
					<input type='checkbox' id='LoginView::KeepMeLoggedIn' name='LoginView::KeepMeLoggedIn'/>

				<input type='submit' name='LoginView::Login' value='login'/>
			</fieldset>
		</form>
		";
	}
}
