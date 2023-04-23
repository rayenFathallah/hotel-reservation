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
        include_once('./navbar.php');
    ?>
    <body> 
        <div class="Admin_container">
            <h1>Admin dashboard</h1>
            <h5>Welcome <?php echo $_SESSION['username'];?>, Love to see you back!</h5>
            <hr></hr>
            <div class="boxes">
                <div class="box">
                    <img src="./images/room.png" alt="chambres">
                    <span><?php echo count($_SESSION["chambres"]);?> Chambres</span>
                </div>
                <div class="box">
                    <img src="./images/group.png" alt="group">
                    <span><?php echo count($_SESSION["clients"]);?> Clients</span>
                </div>
            </div>
            <div class="add">
                <button id="addCh">Ajouter une chambre</button>
                <a id="gestClient" href="gestionClients.php">Editer les clients</a>
            </div>
            <form id="ajouterChambre" action="ajouterChambre.php" method="post">
                    <div class="addElement">
                        <label for="num_chambre">Numero du chambre: </label>
                        <input type="number" name="num_chambre" placeholder="numero du chambre" required class="input">
                    </div>
                    <div class="addElement">
                        <label for="Etage">Etage: </label>
                        <input type="number" name="etage" placeholder="Etage" class="input">
                    </div>
                    <button onclick="document.Document.getElementsByClassName('input').value = ''" type="submit">Ajouter chambre</button>
            </form>
            <?php if(isset($_SESSION["message"])){
                echo $_SESSION["message"];
                unset($_SESSION["message"]);
                }
            ?>
                <div class="title">Les chambres les plus demandées : </div>
                <div class="mostWanted">
                    <?php foreach($_SESSION['latestchambres'] as $key=>$value): ?>
                        <div class="box1">
                            <div class="margin">
                                <div class="chNum">Chambre numero <?=$value["num_chambre"]?></div>
                                <div>Etage: <?=$value["etage"]?></div>
                                <div>Nombre de fois de reservation : <?=$value["nb_reservee"]?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="viewMore">
                        <a href="gestionChambres.php">Voir tous les chambres</a>
                    </div>
                </div> 
            <div class="title">Les clients reguliers : </div>
            <div class="reguliers">
                <?php foreach($_SESSION['clientsReguliers'] as $key=>$value): ?>
                    <div class="box1">
                        <div class="margin">
                            <div class="chNum">Nom du client <?=$value["name_client"]?></div>
                            <div>Numero client : <?=$value["id_client"]?></div>
                            <div>Nombre de fois de reservation : <?=$value["nb_reservations"]?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="viewMore">
                    <a href="gestionClients.php">Voir tous les Clients</a>
                </div>
            </div> 
        </div>    
    </body>
</html>
<script>
    const targetDiv = document.getElementById("ajouterChambre");
    const btn = document.getElementById("addCh");
    btn.onclick = function () {
      if (targetDiv.style.display !== "none") {
        targetDiv.style.display = "none";
      } else {
        targetDiv.style.display = "table";
      }
    };
  </script>
