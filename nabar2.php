
<html>
    <head> 
        <link rel="stylesheet" href="navbar.css">
    </head>
    <nav>
        <div class="container">
            <ul>
                <a href="client.php" onclick="setSession();"><li>Home</li></a>
                <a href="reservations.php"><li>Mes reservations</li></a>
                <a href="logeout.php"><li>Deconnecter</li></a>

            </ul>
        </div>
    </nav>

</html>
<script type="text/javascript">
    function SetSession()
    {
        
        '<%Session["validation"] = ""; %>';
        alert('<%=Session["validatiion"] %>');
    }
</script>