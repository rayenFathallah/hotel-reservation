<?php 
session_start(); 
$connection = mysqli_connect("hoteldb.c9cdrqgzzngt.us-east-1.rds.amazonaws.com",'admin','Rayene123123123');
mysqli_select_db($connection,'ingbdd');
$id_reservation=$_POST["id_reservation"];
$deleteQuery = "DELETE from reservation where id_reservation='$id_reservation'";
if ($connection->query($deleteQuery) === TRUE){
    $_SESSION["validation"]="La suppression de la reservation a eté faite avec success"; 
    header('Location:client.php');
}
else {
    $_SESSION["validation"]="Problem faced!!!";
    header('Location:client.php');
}
mysqli_close($connection);

