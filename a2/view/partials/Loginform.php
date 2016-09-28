<?php


class Loginform {

	public $show;

	public function __construct($message = "", $username = "", $password = "") {
		$this->show = "
		<form method='post' >
			<fieldset>
				<legend>Login - enter Username and password</legend>

				<p id='LoginView::Message'>{$message}</p>

				<label>Username :
					<input type='text' id='LoginView::UserName' name='LoginView::UserName' value='{$username}'/>
				</label>

				<label>Password :
					<input type='password' id='LoginView::Password' name='LoginView::Password'/>
				</label>

				<label>Keep me logged in  :
					<input type='checkbox' id='LoginView::KeepMeLoggedIn' name='LoginView::KeepMeLoggedIn'/>
				</label>

				<input type='submit' name='LoginView::Login' value='login'/>
			</fieldset>
		</form>
		";
	}
}
