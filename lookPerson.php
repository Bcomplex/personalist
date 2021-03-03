<!--editing Person or delete-->



<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
//include "include/Db.php";
include 'core.php';
include 'Person.php';
include 'include/head.php';

//isseting button update or delete
$person=Person::find($_GET['id']);

if(isset($_POST)){
    print_r($_POST);
    if(isset($_POST['delete'])){
        $person->delete();
        header('index.php');
    }
    if(isset($_POST['update'])){
    $person=Person::fromPost($_POST);
    $person->setIdPerson($_GET['id']);
    $person->update();
    }
}

 $firstName = $person->getFirstName();
 $lastname = $person->getLastName();
 $cardNumber = $person->getCardNumber();
 $telNumber = $person->getTelNumber();
 $privateEmail = $person->getPrivateEmail();
 $dateEnter = $person->getDate();
 $position = $person->getPosition();
 $workEmail = $person->getWorkEmail();
 $workTime = $person->getWorkTime();
 $child = $person->getChildren();


?>
<!-- update form-->


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalabel=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>



<form action=""  method="post" class="mb-3" >
    <label for="fname">First Name: </label>
    <input name='firstName' type="text" id="fname" value="<?php echo $firstName ?>"><br><br>


    <label for="lname">Last Name: </label>
    <input name='lastName' type="text" id="lname" value="<?php echo $lastname ?>"><br><br>


    <label for="telNumber">Telephone number: </label>
    <input name='telNumber' type="text" id="telNumber" value="<?php echo $telNumber ?>"><br><br>

    <label for="privateEmail">Private Email: </label>
    <input name='privateEmail' type="text" id="privateEmail" value="<?php echo $privateEmail ?>"><br><br>

    <label for="position">Position: </label>
    <input name='position' type="text" id="position" value="<?php echo $position ?>"><br><br>

    <label for="cardNumber">Card Number: </label>
    <input name='cardNumber' type="text" id="cardNumber" value="<?php echo $cardNumber ?>"><br><br>

    <label for="dateEnter">Date to enter: </label>
    <input name='date' type="text" id="dateEnter" value="<?php echo $dateEnter ?>"><br><br>

    <label for="workEmail">Work Email: </label>
    <input name='workEmial' type="text" id="workEmail" value="<?php echo $workEmail ?>"><br><br>

    <label for="workTime">Work Time: </label>
    <input name='workTime' type="text" id="workTime" value="<?php echo $workTime ?>"><br><br>

    <label for="workTime">Childs: </label>
    <input  name='childs' type="text" id="workTime" value="<?php echo $child ?>"><br><br>

    <input type="submit" name="update" value="Update" class="btn btn-warning">
    <input type="submit" name="delete" value="Delete" class="btn btn-danger">


</form>

</body>
</html>
