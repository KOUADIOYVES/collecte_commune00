<?php
//session_start();
//if($_SESSION['pseudo']=="TEKI"){
    //include('menu_admin.php');
//}else{
    //include('menu_util.php');
//}
?>

<!-- <!DOCTYPE html> -->
<!DOCTYPE html>
<html>
<head>
<title>RECHERCHE AGENT</title>
<meta charset='utf-8'>
<meta name="viewport" content="width=device-width initial-scale=1.0">
</head>
<style>
    
    body table{
        border-top: 1px solid midnightblue;
        border-bottom: 3px solid midnightblue;
        margin: 100px auto;
        margin-top: 50px;
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
        padding: 15px 20px;
        border: 0px;
    }
    body table thead tr:nth-child(even){
        background-color: aqua;
    }
    #search{
        width: 300px;
        margin-left: 40px;
        margin-top: 90px;
        height: 40px;
        box-shadow: 0 10px 10px rgba(0,0,255,0.15);
        border-radius: 15px;
    }
    #cherche{
        width: 130px;
        margin-left: 0px;
        margin-top: 90px;
        height: 40px;
        box-shadow: 0 10px 10px rgba(0,0,255,0.15);
        border-radius: 15px;
        background-color: blue;
        color: white;
        font-weight: bold;
        border: 1px solid white;
        cursor: pointer;
    }
    #voirtout{
        margin-left: 300px;
        width: 200px;
        color: white;
        margin-top: 90px;
        height: 40px;
        box-shadow: 0 10px 10px rgba(0,0,255,0.15);
        border-radius: 15px;
        background-color: blue;
        font-weight: bold;
        border: 1px solid white;
        cursor: pointer;
        
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

</style>

<body>
    
<h2>
    <?php
	//if($_SESSION['autoriser']=="admin"){
        
       
        //echo "BIENVENU ADMINISTRATEUR";
    //}else{
            //echo "BIENVENU  ".$_SESSION['pseudo'];
        //}
       ?></h2>

    <form method="GET">
       <input type="search" id="search" name="cherche" placeholder="entrer le nom d'un agent"/>
       <input type="submit" id= "cherche" name="valider" value="RECHERCHER"/>
       <input type="submit" id= "voirtout" name="voirtout" value="LISTE DES AGENTS"/>
    </form>


    <div class="container">
   
    
    <?php

// connexion a la base de données
//include("connex.php");
;//aristide's connexion
$db = mysqli_connect('localhost', 'root', '', 'collecte00');

if(isset($_GET['voirtout'])){
    $sql1 = "SELECT codeag, nomag, numag, melag, sexeag, zoneag
     FROM agent";
    $query = mysqli_query($db, $sql1);?>
    <table>
    <thead>
        <tr>
            <th scope="col">CODE AGENT</th>
            <th scope="col">NOM ET PRENOM</th>
            <th scope="col">CONTACT</th>
            <th scope="col">EMAIL</th>
            <th scope="col">SEXE</th>
            <th scope="col">ZONE</th>
            
        </tr>
    </thead> <?php
    while($row = mysqli_fetch_assoc($query)) { ?>
        <tr>
        
            <td><?php echo $row['codeag']; ?></td>
            <td><?php echo $row['nomag']; ?></td>
            <td><?php echo $row['numag']; ?></td>
            <td><?php echo $row['melag']; ?></td>
            <td><?php echo $row['sexeag']; ?></td>
            <td><?php echo $row['zoneag']; ?></td>

        </tr>
     <?php
    }?>
    </table> <?php

}else{


    @$recherche=$_GET['cherche'];
// initialisation des variables
    if(isset($_GET['valider'])){
        $recherche=strtoupper($recherche);
        

               
        if(!empty($_GET['cherche'])){
            $sql = "SELECT  codeag, nomag, numag, melag, sexeag, zoneag
             FROM agent where nomag like '%$recherche%'";
            $query = mysqli_query($db, $sql);

            if (mysqli_num_rows($query) > 0) { ?>
                <table>
                <thead>
                    <tr>
                    <th scope="col">CODE AGENT</th>
                    <th scope="col">NOM ET PRENOM</th>
                    <th scope="col">CONTACT</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">SEXE</th>
                    <th scope="col">ZONE</th>
                    
                    </tr>
                </thead> <?php

                while($row = mysqli_fetch_assoc($query)) { ?>


                    <tr>
                    
                    <td><?php echo $row['codeag']; ?></td>
                    <td><?php echo $row['nomag']; ?></td>
                    <td><?php echo $row['numag']; ?></td>
                    <td><?php echo $row['melag']; ?></td>
                    <td><?php echo $row['sexeag']; ?></td>
                    <td><?php echo $row['zoneag']; ?></td>
                    </tr>
                    <?php
                    }
            } else {?>
                    <div class="message"><h3>AUCUN COMMERCANT CORRESPONDANT A <span><?php echo" ".$recherche;?></span></h3></div>
                <?php
            }
        }else{?>
            <div class="message"><h3>SAISISSEZ LE NOM D'UN AGENT</h3></div>
        <?php
        }
    }
}
?>
  
</div>

</body>
</html>