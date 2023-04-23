<?php
session_start(); 
header('Location:login.php');
$connection = mysqli_connect("localhost",'root','');
mysqli_select_db($connection,'ingbdd');
$username = $_POST['username']; 
$name = $_POST["name"];
$email = $_POST['email']; 
$telS = $_POST['telephone']; 
$pass = $_POST['password'];
$tel = intval($telS);
if($connection==false){
    echo "probleme de connection";
}
else {
    $userTable= " select * from utilisateur where username='$username'";
    $result = mysqli_query($connection,$userTable);
    $num = mysqli_num_rows($result);
    if($num==1){
        echo " Username already taken!"; 
    }
    else {
        $register_user = "insert into utilisateur(username,password) values('$username','$pass')";
        if ($connection->query($register_user) === TRUE) {
            $last_id = $connection->insert_id;
            $register_client = "insert into client(ID_USER,NAME_CLIENT,EMAIL,TELEPHONE) values('$last_id','$name','$email','$tel')";
            mysqli_query($connection,$register_client);
            $connection->close();
            header("location:login.php");
        }
        else {
            echo" probleme de connection";
        }
    }
}
?>


