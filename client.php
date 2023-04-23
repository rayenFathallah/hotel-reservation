<?php 
session_start();
if(!isset($_SESSION['username'])){
    header("Location:Login.php");
}
$connection = mysqli_connect("localhost",'root','');
mysqli_select_db($connection,'ingbdd');
?>
<html> 
    <head>
        <title>admin Home Page</title>
        <link href="client.css" rel="stylesheet">
    </head>
    <?php 
        include_once('./nabar2.php');
    ?>
    <body>
        <h1>Tous les chambres</h1>
        <?php if(isset($_SESSION["validation"])){
            echo $_SESSION["validation"];
            unset($_SESSION["validation"]);
        }
        ?>
        <div id="container">
            <?php 
            $chambreQuery = "select * from chambre where etat=1 or etat=2";
            $chambreResQuery = "select p.id_reservation, p.id_client,p.num_chambre,p.date_reservation,p.duree,c.etage,c.nb_reservee from reservation p , chambre c where c.num_chambre=p.num_chambre";
            //$insertResQuery = "insert into reservation (num_chambre,id_client,date_reservation,duree) values('$num_chambre',$id_client','$date_reservation','$duree')";
            $chambres = mysqli_query($connection,$chambreQuery);
            if(mysqli_num_rows($chambres)>0){
                while($row = mysqli_fetch_array($chambres)){
            ?>
                <div class="chambre"> 
                    <form method="post" action="reservePage.php">
                        <div>Numero du chambre : <?php echo $row["num_chambre"];?></div>
                        <?php if($row["etat"]==1) : ?>
                            <div class="element"> Etat: <span class="etat notEdit">libre</span></div>
                        <?php elseif($row["etat"]==2) : ?>
                            <div class="element">Etat: <span class="notEdit">Allouée</span></div>  
                        <?php else : ?>
                            <div class="element">Etat: <span class="notEdit">En rénovation</span></div>  
                        <?php endif; ?><div>Etage : <?php echo $row["etage"];?></div>
                        <div>Nombre de fois de reservations : <?php echo  $row["nb_reservee"];?></div>
                        <?php echo "<button type='submit' onclick=Openres('".$row["num_chambre"]."')>";?>reserver</button>
                        <div id="<?php echo $row["num_chambre"];?>" class="hidden">
                            <input type="number" name="id_client" class="hidden" value=<?=$_SESSION["id_client"]?>>
                            <input type="number" name="etat" class="hidden" value=<?=$row["etat"]?>>
                            <input type="number" name="num_chambre" class="hidden" value=<?=$row["num_chambre"]?> >
                            <input type="number" name="nb_reservee" class="hidden" value=<?=$row["nb_reservee"]?> >

                        </div>    
                    </form>


                </div>
                <?php 
                }
                
            }
            ?>
            <?php if(isset($_SESSION["message"])) : ?>
                <div class="message"><?php echo $_SESSION["message"]?></div>
            <?php endif; ?>
        </div>
    </body>
</html>
<script>
    function Openres(numCh){
        console.log(numCh);
        numc=numCh.toString();
        target = document.getElementById(numc);
        if (target.style.display !== "none") {
            target.style.display = "none";
        } 
        else {
            target.style.display = "table";
        }
    }
</script>
