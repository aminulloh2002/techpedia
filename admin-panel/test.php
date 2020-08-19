<?php 
session_start();
echo $_SESSION["password"];
?>
<br>
<?php
echo $_SESSION["login"];
?>
<br>
<?php
echo count($_SESSION);
?>
<br>
<?php
print_r($_SESSION);
 ?>