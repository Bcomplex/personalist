


<?php
include 'include/core.php';
include 'include/head.php';
?>
<body>
<!--form for create person-->
<h2>Registration new person </h2>
<form action="createPerson.php" method="post">
    <input type="text" name="firstName" placeholder="Frirst Name"><br>
    <input type="text" name="lastName" placeholder="Last Name"><br>
    <input type="text" name="telNumber" placeholder="telephone number"><br>
    <input type="text" name="privateEmail" placeholder="private email"><br>
    <select name="position" id="position"><br>
        <option value="worker">Worker</option>
        <option value="ceo">Ceo</option>
        <option value="manager">Manager</option>
        <option value="programer">Programer</option>
        <option value="analitik">Analatik</option>
        <option value="driver">Driver</option>
    </select><br>
    <input type="text" name="cardNumber" placeholder="card number"><br>
    <input type="text" name="children" placeholder="children"><br>
    <input type="date" name="date"><br><br>
    <input type="submit" value="Register" class="btn btn-info">

</form> <br>
<h2>Calclate Person wage and create payslip </h2><br>
<form action="money.php" method="get">
    <input type="number" name="id">
    <input type="submit" name="submit" value="Calculate" class="btn btn-primary">
 

</form><br>
<h2>Find Person as per person ID  </h2><br>
<form action="lookPerson.php" method="get">
    <input type="number" name="id">
    <input type="submit" name="person" value="Find" class="btn btn-success">
</form>




<?php
include 'include/footer.php';
?>
