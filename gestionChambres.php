<?php 
session_start();
?>
<html> 
    <head>
        <title>gestion chambres</title>
        <link href="admin.css" rel="stylesheet">
    </head>
    <?php 
        include_once('./navbar.php');
    ?>
    <body>
     <div class="chambres">   
        <?php foreach($_SESSION['chambres'] as $key=>$value): ?>
            <div class="chambreBox">
                <form class="margin" method="post" action="editChambre.php">
                    <div class="element">Chambre numero <span class="notEdit"><?=$value["num_chambre"]?></span><input placeholder="numero du chambre" class="Edit" value=<?=$value["num_chambre"]?> type="number" name="num_chambre"></div>
                    <div class="element">Etage: <span class="notEdit"><?=$value["etage"]?></span><input type="number" class="Edit" value=<?=$value["etage"]?> name="etage"></div>
                    <div class="element">Nombre de fois de reservation : <span class="notEdit"><?=$value["nb_reservee"]?></span><input class="Edit" value=<?=$value["nb_reservee"]?> type="number" name="nb_reservee"></div>
                    <?php if($value["etat"]==1) : ?>
                        <div class="element"> Etat: <span class="etat notEdit">libre</span><input class="Edit" value="libre" type="text" name="etat"></div>
                    <?php elseif($value["etat"]==2) : ?>
                        <div class="element">Etat: <span class="notEdit">Allouée</span><input class="Edit" type="text" value="Allouee" name="etat"></div>  
                    <?php else : ?>
                        <div class="element">Etat: <span class="notEdit">En rénovation</span><input class="Edit" type="text" value="En renovation" name="etat"></div>  
                    <?php endif; ?>    
                    <input class="none" type="number" value=<?=$value["num_chambre"]?> name="old_num">
                    <button type="button" class="notEdit clickable" class="change" onClick="change()">Modifier chambre</button> 
                    <button class="edit" type="submit">Sauvgarder les changements</button> 
                </form>
            </div>
        <?php endforeach; ?>
     </div>
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