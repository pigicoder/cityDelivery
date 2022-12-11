<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" href="../css/styles.css">
	</head>
	<body>
	    	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        		<div class="container">
                		<a class="navbar-brand" href="../index.html">Home</a>
            		</div>
        	</nav>
	    	<div class="background">
		    <br>
		    <br>
	    	<h1 class="titolo" align="center">Servizi riservati</h1>
            <br>
		    <h4 class="titolo" align="center">Per accedere digitare username e password, quindi premere OK. </h4>
            <br><br>
		    <div class="container" style="display:flex;width:100%;">
		        <form  method="POST" action="../backend/checkLogin.php">
		  		    <!--<table align="center">-->
                    <div style="width:100%;" align="left">
			        <td>Email: </td><td><input name = "email" placeholder="Insert email address" autofocus required></input></td>
    		        </div>
                    <div style="width:100%;" align="left">
                        <td>Password: </td><td><input type = "password" name = "pwd" placeholder="Insert password" autofocus required></input></td>
    		        </div>	
					<div class="container" style="display:flex;width:50%;"><input type= "submit" value= "OK"/></div>
					<div class="container" style="display:flex;width:50%;"><input type = "reset" value = "Cancella"/></div>	
				    <!--</table>-->
                	<err class="errore"><?php checkErrorLogin();?></err>
			    </form>
            </div> 
	    </div>
	</body>
</html>

<?php

session_start();
//$_SESSION["user"];

$parameter = "";

if (isset($_SESSION["user"]))
{
	//$parameter = "Location: ../backend/checkLogin.php?email=$email";
	echo "<br><a>Session is already open.<br>Welcome back, ",$_SESSION["user"],"</a>";
	//header($parameter);
}

function checkErrorLogin()
{
	if (isset($_GET["errore"]))
     	{
        	if ($_GET["errore"] == "email")    echo "Email is wrong";
        	if ($_GET["errore"] == "password") echo "Password is wrong";
    	}
    	else echo "";
}

?>