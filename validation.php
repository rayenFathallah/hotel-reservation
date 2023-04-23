<?php
session_start(); 
$username = $_POST['username']; 
$pass = $_POST['password'];
$connection = mysqli_connect("hoteldb.c9cdrqgzzngt.us-east-1.rds.amazonaws.com",'admin','Rayene123123123');
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
else {
    echo('hay t3addet c bon');
    $userTable= " select * from utilisateur where username='$username' && password = '$pass'";
    $chambresquery = " select * from chambre";
    $latestchquery = "select * from chambre order by nb_reservee limit 6";
    $reguliersquery = "select * from client order by nb_reservations limit 2";
    $usersquery=" select name_client , id_client , email , nb_reservations , telephone from client";
    $result = mysqli_query($connection,$userTable);
    $num = mysqli_num_rows($result);
    if($num==1){
        while($row = $result->fetch_assoc()){
            if($row["type"]==1){
                $id_user=$row["id_user"];
                $_SESSION["id_user"]=$id_user;
                $_SESSION['username']=$username;
                $_SESSION["type"]=1;
                $clientQuery = "select * from client where id_user='$id_user'"; 
                $client = mysqli_query($connection,$clientQuery);
                while($rowc = $client->fetch_assoc()){
                    $SESSION["id_client"]=$rowc['id_client'];
                    header('Location:client.php');
                }
            }
            else {
                $clients=[];
                $_SESSION["type"]=2;
                $clientsRes=mysqli_query($connection,$usersquery);
                while($rowch=$clientsRes->fetch_assoc()){
                    if($rowch["email"]==null){
                        $rowch["email"]="";
                    }
                    if($rowch["telephone"]==null){
                        $rowch["telephone"]=0;
                    }
                    array_push($clients,$rowch);
                }
                $chambres=[];
                $_SESSION['username']=$username;
                $chambresRes=mysqli_query($connection,$chambresquery);
                while($row=$chambresRes->fetch_assoc()){
                    array_push($chambres,$row);
                }
                $latestchambres=[];
                $latestchambresRes=mysqli_query($connection,$latestchquery);
                while($rowlts=$latestchambresRes->fetch_assoc()){
                    array_push($latestchambres,$rowlts);
                }
                $clientsReguliers=[];
                $clientsReguliersRes=mysqli_query($connection,$reguliersquery);
                while($rowres=$clientsReguliersRes->fetch_assoc()){
                    array_push($clientsReguliers,$rowres);
                }
                $_SESSION['chambres']=$chambres;
                $_SESSION['clients']=$clients;
                $_SESSION['latestchambres']=$latestchambres;
                $_SESSION['clientsReguliers']=$clientsReguliers;
                $connection->close();
                header('Location:admin.php');
            }
        }
    }    
    else {
        echo "more than one row exists";
    }
}
?>


