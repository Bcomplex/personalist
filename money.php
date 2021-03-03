<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
//include "include/Db.php";
include 'core.php';
include 'Payroll.php';
$consTaxis=0.15;
$person = Person::find($_GET['id']);
$accountants = new Payroll(Person::find($_GET['id']));
echo $person->getFullName();
br();
echo $accountants->wage();

$accountants->createPersonWalletFile();



function br()
{
    echo('<br>');
}

//$wallet= $money->positionRating();
//$superMoney = $wallet*1.338;
//$healt = $wallet*0.045;
//$soc = $wallet*0.065;
//$socHealt=$healt+$soc;
//$roundSuperMoney=(round($superMoney,0,PHP_ROUND_HALF_UP));
//$taxis = $roundSuperMoney*0.015;
//$jobPay = $wallet-$socHealt-$taxis;
//echo $jobPay;