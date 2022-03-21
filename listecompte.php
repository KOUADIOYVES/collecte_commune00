<?php


    include("menuvers.php");
    include("connex.php");
    

//}
?>

<!-- <!DOCTYPE html> -->
<!DOCTYPE html>
<html>
<head>
<title>RECHERCHE VERSEMENT</title>
<meta charset='utf-8'>
<meta name="viewport" content="width=device-width initial-scale=1.0">
<link rel="stylesheet" href="css/bootstrap.css"/>
</head>
<style>
    
    body table{
        border-top: 1px solid midnightblue;
        border-bottom: 3px solid midnightblue;
        margin: 50px auto;
        margin-top: 20px;
        border-collapse: collapse;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }
    body table thead tr{
        background-color: midnightblue;
        color: #fff;
        text-align: center;
        font-weight: bold;
    }
    
       
    body table thead th, td{
        padding: 5px 10px;
        border: 0px;
        height: 20px;
    }
    body table thead tr:nth-child(even){
        background-color: aqua;
    }
    body table tbody tr{
        background-color: white;
        color: black;
        text-align: center;
        
    }
    .container{
        background-color: white;
        margin-top: 60px;
    }
    
    #supprimer{
        background-color: red;
    }
    #modifier{
        background-color: green;
    }

    div .message{
        background-color: red;
        color: white;
        width: 300;
        text-align: center;
    }
    div .message span{
        color: black;
    }
    h4{ 
        color: green;
        width: 300;
        text-align: center;

    }
    #sup{
        background-color: red;
        color: white;
        height: 30px;
        box-shadow: 0 10px 10px rgba(0,0,255,0.15);
        border-radius: 15px;
        font-weight: bold;
        border: 1px solid white;
        cursor: pointer;
    }
    #mod{
        background-color: green;
        color: white;
        height: 30px;
        box-shadow: 0 10px 10px rgba(0,0,255,0.15);
        border-radius: 15px;
        font-weight: bold;
        border: 1px solid white;
        cursor: pointer;
    }
    #mod a, #sup a{
        text-decoration: none;
        color: white;
    }
    #rest{
        background-color: red;
        color: white;
        text-align: center;
        font-weight: bolder;
        border-bottom: 1px solid white;
    }
    .form-control{
        
        margin: auto 0;
        border: 1px solid ;
    }
    #rec{
        margin-left: 0;
        color: white;
        font-weight: bold;
        border-radius: 20px;
    }
    #tout{
        background-color: #91df83;
        color: white;
        font-weight: bold;
        border-radius: 20px;
    }
    #cont{
        background-color: white;
    }
    h3{
        background-color: red;
        color: white;
        text-align: center;
        margin-top: 0px;
    }
</style>

<body>


    
<!--<h2>
    <?php
	//if($_SESSION['autoriser']=="admin"){
        
        
        //echo "BIENVENU ADMINISTRATEUR";
    //}else{
            //echo "BIENVENU  ".$_SESSION['pseudo'];
        //}
       ?></h2>
    <div class="inputs">
        <form method="GET">
        <input type="search" id="search" name="cherche" placeholder="entrer le numero d'un compte"/>
        <input type="submit" id= "cherche" name="valider" value="RECHERCHER"/>
        <input type="submit" id= "voirtout" name="voirtout" value="LISTE DES COMPTES"/>
       
        </form>

    </div>
    <div class="container">-->
    <?php
        //require_once("menuvers.php");
    ?>
   
    

    <?php

// connexion a la base de données
//include("connex.php");
;//aristide's connexion
//$db = mysqli_connect('localhost', 'root', '', 'collecte00');

     




    

$req=$conn->query("SELECT  numcompte, codecom, nomcom, zonecom, codeag, secactcom, restapay
FROM commercant") ;
//$query = mysqli_query($db, $sql);
$resultat=$req->fetchAll();
$i=0;
foreach($resultat as $lig){
    $i+=1;
}?>
<h3><?php echo $i." "?> COMPTES IMPOTS</h3>
<div class="container-fluid">

    <table class="table table-hover table-striped">
        <thead>
            <tr>
            <th scope="col">NUM COMPTE</th>
            <th scope="col">CODE</th>
            <th scope="col">NOM ET PRENOM</th>
            <th scope="col">ZONE</th>
            <th scope="col">SECTEUR ACT</th>
            <th scope="col">RESTE A PAYER</th>
            <th scope="col">ACTION</th>
            </tr>
        </thead>
        <tbody> 
        <?php
        foreach($resultat as $lig){?>
            
                    <tr>
                    
                    <td><?php echo $lig['numcompte']; ?></td>
                    <td><?php echo $lig['codecom']; $codecomrech=$lig['codecom'];?></td>
                    <td><?php echo $lig['nomcom']; ?></td>
                    <td><?php echo $lig['zonecom']; ?></td>
                    
                    <td><?php echo $lig['secactcom']; ?></td>
                    <td id="rest"><?php echo $lig['restapay']; ?></td>
                    <td><button type="submit" name="versement" id="mod"><a href="listevers.php?codecom=<?=$lig['codecom']; ?>">VERSEMENT</a></button></td>
                    
                    </tr>
                    <?php
        }?>
           
    </table>


</div>

<script src="js/bootstrap.js"></script>
</body>
</html>