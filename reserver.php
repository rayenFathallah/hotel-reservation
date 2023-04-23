<?php 
session_start();
$connection = mysqli_connect("localhost",'root','rayen');
mysqli_select_db($connection,'ingbdd');
$id_client=$_POST['id_client'];
$num_chambre=$_POST["num_chambre"];
$nb_reservee=$_POST["nb_reservee"]+1;
$requestDuree=$_POST["duree"];
$selectClientQuery =" select * from client where id_client='$id_client'";
$clientResult = mysqli_query($connection,$selectClientQuery);
$numRow = mysqli_num_rows($clientResult);
if($numRow>0){
    while($rowCls=$clientResult->fetch_assoc()){
        $nb_reservations=$rowCls["nb_reservations"]+1;
    }
}
$requestDate = date("y-m-d", strtotime($_POST["date"]));
$endDateRequest = date("y-m-d", strtotime("$requestDate +$requestDuree days"));
$reservations = $_SESSION["reservations"];
$addReservationQuery = "UPDATE chambre SET nb_reservee='$nb_reservee' WHERE num_chambre='$num_chambre'";
$addReserveeQuery =" UPDATE client SET nb_reservations='$nb_reservations' WHERE id_client='$id_client'";
$reserveQuery = "INSERT into reservation (num_chambre,id_client,duree,date_reservation) VALUES('$num_chambre','$id_client','$requestDuree','$requestDate')";
if(count($reservations)>0){
    foreach ($reservations as $key => $value){
        $duration=$value["duree"];
        $startDate= $value["date_reservation"];
        $endDate = date("y-m-d", strtotime("$startDate +$duration days"));
        if(($requestDate>$startDate && $requestDate<$endDate) || ($startDate>$requestDate && $startDate<$endDateRequest)){
            $_SESSION["validation"]="La chambre est reservée durant cette periode!";
            header("Location:client.php");
        }
        else {
            mysqli_query($connection,$reserveQuery);
            if ($connection->query($addReserveeQuery) === TRUE && $connection->query($addReservationQuery)=== TRUE) {
                $_SESSION["validation"]="La chambre est réservée avec success";
            }
            $connection->close();
            header("location:client.php");
        }
    }
}
else {
    mysqli_query($connection,$reserveQuery);
    if ($connection->query($addReserveeQuery) === TRUE && $connection->query($addReservationQuery)=== TRUE) {
        $_SESSION["validation"]="La chambre est réservée avec success";
        $connection->close();
        header("location:client.php");
    }

}

