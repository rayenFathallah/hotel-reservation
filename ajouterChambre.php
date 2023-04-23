<?php 
session_start();
$connection = mysqli_connect("hoteldb.c9cdrqgzzngt.us-east-1.rds.amazonaws.com",'admin','Rayene123123123');
mysqli_select_db($connection,'ingbdd');
$numChambre=$_POST["num_chambre"];
$etage=$_POST["etage"];
if($etage!==""){
    $addQuery = "insert into chambre(num_chambre,etage) values('$numChambre','$etage')";
    if ($connection->query($addQuery) === TRUE) {
        $_SESSION["message"]="Chambre ajoutée avec success!!!";
    }
    else {
        $_SESSION["message"]="Probleme d'ajout";
    }
    $connection->close();
    header('Location:admin.php');
}
else {
    $addQuery = "insert into chambre(num_chambre) values('$numChambre')";
    if ($connection->query($addQuery) === TRUE) {
        $_SESSION["message"]="<span class='message'>Chambre ajoutée avec success!!!</span";
    }
    else {
        $_SESSION["message"]="<span class='message'>Probleme d'ajout</span>";
    }
    $connection->close();
    header('Location:admin.php');

}

?>