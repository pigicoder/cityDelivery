<?php

include "../common/functions.php";

session_start();
$email = $_SESSION["user"];

if (empty($email))
    header("Location: login.php");

?>

<!DOCTYPE html>
    <html>
        <head>
                <title>Inserire prodotto</title>
                <link href="../css/styles.css" rel="stylesheet" />
                <!--<link href="../css/form_style.css" rel="stylesheet" />-->

                <!------ Include the below in your HEAD tag ---------->

                <!------ Include the above in your HEAD tag ---------->

        </head>
            
            <body>
                <!------ FORM_STYLE SCRIPTS+FONTS ---------->

                <!------ END FORM_STYLE SCRIPTS+FONTS ---------->
                
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                        <div class="container">
                                <a class="navbar-brand" href="../index.html">Home</a>
                        </div>
                </nav>
                <br>
                <div class="background">
                <br>
		    <br>
	    	<h1 class="titolo" align="center">Inserire nuovo prodotto</h1>
            <br><br>

                <div class="container" style="display:flex;width:120%;">
                <form method="POST" action="../backend/checkDatiProdotto.php">
              <div style="width:100%;" align="left">
              
</div>
                <form method="GET" action="../backend/checkDatiProdotto.php">
                
                    <div style="width:100%;" align="left">
                                <td>Name: </td>
                                <td><input type="text" name= "nome" 
                                placeholder="Insert product name"
                                ></input></td>
                                <?php visualizzaErrore("nome"); ?>
                 </div>
              
                 <div style="width:100%;margin-left:0%;" align="left">
                                    <td>Tipo: </td>
                                    <td><input type = "text" name = "tipo" 
                                    list="listTipos" 
                                    placeholder="Insert type of prodotto" >
                                    
                                    <?php visualizzaErrore("tipo"); ?>
                                    <datalist id="listTipos">
                                        <option value="Piatti">
                                        <option value="Menù">  
                                        </datalyst>
                        </input></td>          
                        </div>
                       
                        <div style="width:100%;" align="left">
                                <td>Description: </td>
                                <td><input type = "text" name = "descrizione"
                                 placeholder="Insert description" 
                                ></input></td>
                                <?php visualizzaErrore("descrizione"); ?>
                        </div >
                        <div style="width:100%;margin-left:0%;" align="left">
                                    <td>Price: </td>
                                    <td><input type = "float" name = "prezzo" 
                                    placeholder="Insert price of prodotto" 
                                   ></input></td>
                                    <?php visualizzaErrore("prezzo"); ?>
                        </div>
                        <div style="width:100%;margin-left:0%;" align="left">
                        <!--<form name="MiForm" id="MiForm" method="post" action="cargar.php" enctype="multipart/form-data">
                       <div class="form-group"><div class="col-sm-8"> -->
                        <td>Immagine: </td>
                       <td><input type="file" class="form" id="immagine" name="immagine"></td>
                    </input></td>
                                    <?php visualizzaErrore("immagine"); ?>
                        </div>
                               

             <div class="container" style="display:flex;width:50%;"><input type= "submit" value= "OK"/></div>
             <div class="container" style="display:flex;width:50%;"><input type = "reset" value = "Cancella"/></div>       		
                        </div>
                    </form>
                </div>
            </body>
    </html>