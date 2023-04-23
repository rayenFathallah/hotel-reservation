<?php 
session_start();
$connection = mysqli_connect("hoteldb.c9cdrqgzzngt.us-east-1.rds.amazonaws.com",'admin','Rayene123123123');
mysqli_select_db($connection,'ingbdd');
$id_client=$_POST["id_client"];
echo $id_client ; 
$nom_client=$_POST["nom_client"];
echo $nom_client;
$telephone=$_POST["telephone"];
echo $telephone;
$nb_reservations=$_POST["nb_reservations"];
echo $nb_reservations;
$email=$_POST["email"];
$selectUserQuery = "SELECT id_user from client WHERE id_client='$id_client'";
$userClient = mysqli_query($connection,$selectUserQuery);
$num = mysqli_num_rows($userClient);
if($num>0){
    while($rowc=$userClient->fetch_assoc()){
        $id_user=$rowc['id_user'];
    }
}
echo $email;
if(isset($_POST["update"])){
    $update = "UPDATE client SET name_client='$nom_client', email='$email', telephone='$telephone', nb_reservations='$nb_reservations' WHERE id_client='$id_client'";
    if ($connection->query($update) === TRUE) {
        $_SESSION["message"]="La mise à jour du client a été faite avec succes";
        header('Location:admin.php');
    } else {
        $_SESSION["message"]="La mise à jour du client est echouée!!";
        header('Location:admin.php');
    }
}
else {
    $delete = "delete from client WHERE id_client='$id_client'";
    $delete_user = "delete from utilisateur WHERE id_user='$id_user'";
    if ($connection->query($delete) === TRUE && $connection->query($delete_user) === TRUE ) {
        $_SESSION["message"]="La suppression du client a été faite avec succes";
        header('Location:admin.php');
    } else {
        $_SESSION["message"]="La suppression du client est echouée!!";
        header('Location:admin.php');
    }
}
?>