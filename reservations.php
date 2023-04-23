<?php 
session_start();
$connection = mysqli_connect("hoteldb.c9cdrqgzzngt.us-east-1.rds.amazonaws.com",'admin','Rayene123123123');
mysqli_select_db($connection,'ingbdd');
// 
$user=$_SESSION["username"];
$userQuery = " select id_user from utilisateur where username='$user'"; 
$userResult = mysqli_query($connection,$userQuery);
$numRow = mysqli_num_rows($userResult);
if($numRow>0){
    while($rowUs=$userResult->fetch_assoc()){
        $user_id=$rowUs["id_user"];
    }
}
else {
    echo " no user found";
}
$clientQuery = "select * from client where id_user='$user_id'"; 
$client = mysqli_query($connection,$clientQuery);
$num = mysqli_num_rows($client);
if($num>0){
    while($rowc=$client->fetch_assoc()){
        $_SESSION["id_client"]=$rowc['id_client'];
        $id_client=$rowc['id_client'];
        $_SESSION["nb_reservations"]=$rowc["nb_reservations"];
    }
}
//
$selectQuery = " select * from reservation where id_client='$id_client'";
$myReservations = mysqli_query($connection,$selectQuery);
$numRow = mysqli_num_rows($myReservations);
$reservations=[];
if($numRow>0){
    while($rowCls=$myReservations->fetch_assoc()){
        array_push($reservations,$rowCls);
    }
}
?>
<html>
    <head>
        <title>
            Mes reservations
        </title>
        <link rel="stylesheet" href="client.css">
    </head>
    <?php 
        include_once('./nabar2.php');
    ?>
    <body>
    <?php foreach($reservations as $key=>$value): ?>
        <form class="box1" action="gestionReservations.php" method='post'>
            <div class="margin">
                <div class="chNum">Chambre numero <?=$value["num_chambre"]?></div>
                <div>Date debut: <?=$value["date_reservation"]?></div>
                <div>Durée de reservation : <?=$value["duree"]?></div>
                <input name="id_reservation" type="number" value=<?php echo $value['id_reservation']?> class="hidden">
            </div>
            <button class="supprimer" type="submit">Supprimer Reservation</button>
        </form>
    <?php endforeach; ?>
    </body>


</html>

