<?php 
session_start();
$connection = mysqli_connect("localhost",'root','rayen');
mysqli_select_db($connection,'ingbdd');
$selectQuery = "select * from reservation where id_client='$id_client'";
$updateQuery = "DELETE from reservation where id_reservation='$id_reservation'";
$updateChambreQuery=" UPDATE chambre SET nb_reservee='$nb_reservee' where num_chambre='$num_chambre'";
$updateClientQuery=" UPDATE client SET nb_reservations='$nb_reservations' where id_client='$id_client'"; 
if ($connection->query($updateChambreQuery) === TRUE && $connection->query($updateClientQuery) === TRUE && $connection->query($updateQuery) === TRUE)  {
    $_SESSION["message"]="La misa à jour du reservation a ete effectué avec success!";
    header('Location:client.php');
} else {
  $_SESSION["message"]="La misa à jour du reservation n'a pas été faite!!!";
  header('Location:client.php');
}
