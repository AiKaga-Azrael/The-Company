<?php

include '../classes/User.php';

$user = new User;

$user->update($_POST, $_FILES);//update information on the user. POST is user inforamation from form FILE for images

?>