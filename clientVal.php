<?php 
if(isset($_SESSION["validation"])){
    echo("yasss it is set");
    unset($_SESSION["validation"]);
    header("Location:client.php");
}
else {
    echo "naahh it is not set";
    header("Location:client.php");
}
?> 

