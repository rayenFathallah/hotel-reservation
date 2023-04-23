<?php 
session_start();
?>
<html> 
    <head>
        <title>Gestion Clients</title>
        <link href="admin.css" rel="stylesheet">
    </head>
    <?php 
        include_once('./navbar.php');
    ?>
    <body>
    <?php foreach($_SESSION['clients'] as $key=>$value): ?>
        <div class="chambreBox">
            <form class="margin" method="post" action="editClient.php">
                <div class="element">Nom client :  <span class="notEdit"> <?=$value["name_client"]?></span><input placeholder="nom du client" class="Edit" value=<?=$value["name_client"]?> type="text" name="nom_client"></div>
                <div class="element">email: <span class="notEdit"> <?=$value["email"]?></span><input type="email" class="Edit" value=<?=$value["email"]?> name="email"></div>
                <div class="element">Nombre de fois de reservation : <span class="notEdit"> <?=$value["nb_reservations"]?> </span><input class="Edit" value=<?=$value["nb_reservations"]?> type="number" name="nb_reservations"></div>  
                <div class="element">Numero du telephone : <span class="notEdit"> <?=$value["telephone"]?></span> <input class="Edit" value=<?=$value["telephone"]?> type="tel" name="telephone"></div>  
                <input class="none" type="number" value=<?=$value["id_client"]?> name="id_client">
                <button type="button" class="notEdit clickable" class="change" onClick="change()">Modifier client</button> 
                <button class="edit" type="submit" name="update">Sauvgarder les changements</button> 
                <button class="edit" type="submit" name="remove">Supprimer le client</button> 
            </form>
        </div>
    <?php endforeach; ?>
    </body>
</html>   
<script>
    function change(){
        const targetDiv = document.getElementsByClassName("notEdit");
        const targetDiv2 = document.getElementsByClassName("Edit");
        for(let target of targetDiv){  
            target.style.display = "none";
        }
        for(let target2 of targetDiv2){  
            target2.style.display = "block";
        }  
    }
</script> 