<?php

include '../classes/User.php';

//create an object
$user = new User;

//call the method
$user->store($_POST);
//$_POST is used to retrieve the form data [form action="../actions/register.php] from register.php 


?>