<?php


   



    include("menuagent.php");
    include("connex.php");
//}
?>

<!-- <!DOCTYPE html> -->
<!DOCTYPE html>
<html>
<head>
<title>LISTE AGENT</title>
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
        color: blue;
        text-align: center;
        padding-top: 25px;
        
    }
    body table tbody tr td{
        color: black;
        text-align: center;
        padding-top: 15px;
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

    .message{
        background-color: red;
        color: white;
        width: 300;
        text-align: center;
    }
    span{
        color: red;
    }
    h3{
        background-color: #91df83;
        color: white;
        text-align: center;
        margin-top: 0px;
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
    #cel{
        text-align: center;
        padding: auto;
        
    }

</style>

<body>
    
    <!--<h2>

    <?php
    require_once("menuagent.php");
	//if($_SESSION['autoriser']=="admin"){
        
       
        //echo "BIENVENU ADMINISTRATEUR";
    //}else{
            //echo "BIENVENU  ".$_SESSION['pseudo'];
        //}
       ?></h2>-->
    <!--<div class="container" >
        <form method="GET">
        <input type="search" id="search" name="cherche" placeholder="entrer le nom d'un commercant"/>
        <input type="submit" id= "cherche" name="valider" value="RECHERCHER"/>
        <input type="submit" id= "voirtout" name="voirtout" value="LISTE DES COMMERCANTS"/>
       
        </form>
        
    </div>-->
    
    
    <?php

// connexion a la base de données
//include("connex.php");
;//aristide's connexion
$db = mysqli_connect('localhost', 'root', '', 'collecte00');

//if(isset($_GET['listecom'])){
    $sql1 = "SELECT codeag, nomag, numag, sexeag, zoneag, photoag
     FROM agent";
    $query = mysqli_query($db, $sql1);?>
        <div class="container-fluid" id="cont">
        <table class="table table-hover table-stripped">
        <thead>
            <tr>
                <th scope="col">CODE</th>
                
                <th scope="col">NOM ET PRENOM</th>
                <th scope="col">CONTACT</th>
                
                <th scope="col">SEXE</th>
                
                <th scope="col">ZONE</th>
                <th scope="col">PHOTO</th>
                
                
                <th scope="col">ACTION</th>

            </tr>
        </thead> <?php
        while($row = mysqli_fetch_assoc($query)) { ?>
        <tbody>
            <tr>
            
                <td id="cel"><br><?php echo $row['codeag']; ?></td>
                
                <td id="cel"><br><?php echo $row['nomag']; ?></td>
                <td id="cel"><br><?php echo $row['numag']; ?></td>
                <td id="cel"><br><?php echo $row['sexeag']; ?></td>
                
                <td id="cel"><br><?php echo $row['zoneag']; ?></td>
                <td><img src="<?php echo $row['photoag'];?>" width="50px" alt="rien"></td>
                                <td><br><button type="submit" name="mod" id="mod"><a href="modifagent.php?codeag=<?=$row['codeag']; ?>">MOD</a></button>
                    <button type="submit" name="sup" id="sup"><a href="supagent.php?codeag=<?=$row['codeag']; ?>" onclick="return confirm('ETES VOUS SUR DE VOULOIR SUPPRIMMER CE COMMERCANT?');">SUP</a></button></td>


            </tr>
        </tbody>
        <?php
        }?>
    </table>
    </div> <?php

//}
?>



   

<script src="js/bootstrap.js"></script>
</body>
</html>