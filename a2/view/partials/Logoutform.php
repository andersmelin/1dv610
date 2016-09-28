<?php

class Logoutform {

  public $show;

  public function __construct($message = "", $username = "", $password = ""){
    $this->show = "
    <form  method='post'>
		<p id='LoginView::Message'>{$message}</p>
		<input type='submit' name='LoginView::Logout' value='logout'/>
		</form>";
  }
}
