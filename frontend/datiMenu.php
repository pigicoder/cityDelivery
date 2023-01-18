<!DOCTYPE html>
<?php

require "../common/functions.php";

$result = dbConnection();

session_start();
$email=$_SESSION["user"] ;
$cid = $result["value"];
$result = $cid->query("SELECT * FROM Ristorante WHERE email = '".$email."'");
$rows = $result->fetch_row();
$ristorante=$rows[0];
$result = $cid->query("SELECT nome, tipo, descrizione, prezzo, immagine FROM Prodotto WHERE Prodotto.ristorante = '".$email."'");


?>
<html>

<head>
    <title>Products</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" type="image/x-icon" href="../assets/waiter.ico" />
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="../js/scripts.js" async></script>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="../index.html">Home</a>

        </div>
    </nav>
   
    <div class="background">
    <h4>Products in restaurant	<?= $ristorante; ?>:</h4> 
        <section class="row">
            <?php         
          
              
while($row = $result->fetch_row())
		    {
                $productos[]=$row[0];
		    ?>
           <?php
		    }
	        ?>
           	<form method="POST" action="../backend/insertProdottoInMenu.php">
             <table>
                <tr>
                    <td>
                <select multiple id="source1" size="10"  style="width:200px" name="prod">
                      <?php  $number=count(array_unique($productos));
                          for($i=0;$i<$number;$i++){?>
                            <option><?php echo  $productos[$i]?></option>
                            <?php }?>   
                </select>
            </td>
            <td>
                <div style="display:inline;vertical-align:top;">
                    <button id="shift1" onclick="move(source1,target1);">>></button> <br /><br />
                    <button id="rshift1" onclick="move(target1,source1);"><<</button>
                 
                </div>
            </td>
            <td><select multiple id="target1" size="10"  style="width:200px;"></select></td>
        </tr>
        <div style="width:100%;" align="left">
                        <td>Nome menu: </td><td><input type = "text" name = "nome" placeholder="Insert delivery instructions (optional)"></input></td>
                    </div>
                          </form>
    </table>
                           
        <button onclick="submit(target1);">Submit</button>

    <div id="submitted"></div>                     
         
        
                                    </div>
                        </div>
                                                
                    </div>
                    <script>
          function move (source, target)
          {
            var selectedItems = getSelectOptions(source);
            if (selectedItems) {
                    for (var i = 0; i < selectedItems.length; i++) {
                        var option = new Option(selectedItems[i].text, selectedItems[i].text);
                        target.appendChild(option);
                        selectedItems[i].remove();
                    }
                }
          }

          function getSelectOptions(select) {
                var result = [];
                var options = select.options;
                var opt;

                for (var i = 0, iLen = options.length; i < iLen; i++) {
                    opt = options[i];

                    if (opt.selected) {
                        result.push(opt);
                    }
                }
                return result;
            }

        function submit(target) {
            var options = target.options;
            var out = document.getElementById("submitted");
                out.innerHTML="Il menù è formato per ";
      for (var i = 0; i < options.length; i++) {
                    opt = options[i].value + " ";
                    out.innerHTML += opt;
                
                }
             
            return false;
        }
    </script>
   
    
    <div class="container" style="display:flex;width:50%;"><input type = "submit" value = "OK"/></div>
				  
        </section>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>