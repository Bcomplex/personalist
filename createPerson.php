<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include 'core.php';
include 'Person.php';



$user = Person::fromPost($_POST);
$user->insert();
print_r($user);



//$request = Person::find($_POST['id']);
//echo $request->getDate();
//echo $request->money();

