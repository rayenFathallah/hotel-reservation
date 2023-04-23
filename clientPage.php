<?php 
session_start();
if(!isset($_SESSION['username'])){
    header("Location:Login.php");
}
?>
<html> 
    <head>
        <title>admin Home Page</title>
        <link href="admin.css" rel="stylesheet">
    </head>
<?php 
        include_once('./navbar2.php');
?>
<body>
    <h1>taraa</h1>
</body>
</html>