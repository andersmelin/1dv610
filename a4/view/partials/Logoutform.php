<?php

class Logoutform {

  private $logoutform;

  public function __construct($message){
    $this->logoutform = "
    <form  method='post'>
		<p id='LoginView::Message'>{$message}</p>
		<input type='submit' name='LoginView::Logout' value='logout'/>
		</form>";
  }

  public function show(){
    return $this->logoutform;
  }
}
