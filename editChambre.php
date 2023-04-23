<?php 
session_start();
$connection = mysqli_connect("hoteldb.c9cdrqgzzngt.us-east-1.rds.amazonaws.com",'admin','Rayene123123123');
mysqli_select_db($connection,'ingbdd');
$numChambre=$_POST["num_chambre"];
echo $numChambre;
$etage=$_POST["etage"];
echo $etage;
$nb_reservee=$_POST["nb_reservee"];
echo $nb_reservee;
$old_num=$_POST["old_num"];
echo $old_num;
if($_POST["etat"]=="libre"){
    $etat=1;
    echo $etat;
}
else if($_POST["etat"]=="Allouee"){
    $etat=2;
    echo $etat;
}
else {
    $etat=3;
    echo $etat;
}
$update = "UPDATE chambre SET num_chambre='$numChambre', etage='$etage', nb_reservee='$nb_reservee' WHERE num_chambre='$old_num'";

if ($connection->query($update) === TRUE) {
    echo "connected";
    $_SESSION["message"]="La mise à jour du chambre a été effectué avec success"; 
    header('Location:admin.php');
} else {
    $_SESSION["message"]="La mise à jour du chambre est erroné!!"; 
  header('gestionChambres.php');
}
?>