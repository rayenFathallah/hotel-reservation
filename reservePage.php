<?php 
session_start();
$connection = mysqli_connect("localhost",'root','');
mysqli_select_db($connection,'ingbdd');
$user=$_SESSION["username"];
$num_chambre = $_POST['num_chambre'];
$nb_reservee=$_POST["nb_reservee"];
$userQuery = " select id_user from utilisateur where username='$user'"; 
$reservQuery = " select * from reservation where num_chambre='$num_chambre'";
$userResult = mysqli_query($connection,$userQuery);
$numRow = mysqli_num_rows($userResult);
if($numRow>0){
    while($rowUs=$userResult->fetch_assoc()){
        $user_id=$rowUs["id_user"];
    }
}
$reservResult = mysqli_query($connection,$reservQuery);
$reservRows = mysqli_num_rows($reservResult);
$reservations=[];
if($reservRows>0){
    while($rowRes=$reservResult->fetch_assoc()){
        array_push($reservations,$rowRes);
    }
}


$clientQuery = "select * from client where id_user='$user_id'"; 
$client = mysqli_query($connection,$clientQuery);
$num = mysqli_num_rows($client);
if($num>0){
    while($rowc=$client->fetch_assoc()){
        $_SESSION["id_client"]=$rowc['id_client'];
        $_SESSION["reservations"]=$reservations;
        $_SESSION["nb_reservations"]=$rowc["nb_reservations"];
    }
}
if(!isset($_SESSION['username'])){
    header("Location:Login.php");
}
?>
<html> 
    <head>
        <title>
            Reservation d'une chambre
        </title>
        <link rel="stylesheet" href="client.css">
    </head>
    <?php 
        include_once('./nabar2.php');
    ?>
    <div class="title">Reserver une chambre</div>
    <form class="reservation_panel" action="reserver.php" method="post">
        <div class="panel">
            <div>Numero du chambre : <?php echo $_POST["num_chambre"];?></div>
            <div>Etat actuelle : <?php echo $_POST["etat"];?> </div>
            <label for="date" class="label">Date de reservation :
                <input type="date" name="date" class="input">
            </label>
            <br>
            <label for="duree" class="label">Duree du reservation
                <input type="number" name="duree" class="input">
            </label>
            <input name="id_client" value=<?php echo $_SESSION["id_client"]?> class="hidden">
            <input name="num_chambre" value=<?php echo $_POST["num_chambre"]?> class="hidden">
            <input name="nb_reservee" value=<?php echo $_POST["nb_reservee"]?> class="hidden">
            <button type="submit">Reserver la chambre</button>    
        </div>
    </form>
    <div class="Reserved">
        Les reservations affectés à cette chambre :
    </div>    
    <span class="small">vous ne pouvez pas reserver la chambre pendant ces periodes</span>
    <div class="reservations">
    <?php foreach($reservations as $key=>$value): ?>
        <div class="box1">
            <div class="margin">
                <div class="date">Reservé du <?=$value["date_reservation"]?></div>
                <div>Pour <?=$value["duree"]?> Jours</div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>       

    
</html>
