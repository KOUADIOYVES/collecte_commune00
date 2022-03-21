<?php
//session_start();
//if($_SESSION['pseudo']=="TEKI"){
    
//}else{
    include("menuvers.php");
    include("connex.php");

    function afficher($reqresult){?>
        <div class="container-fluid" id="cont">
            <table class="table table-stripped table-hover">
                <thead>
                    <tr>
                        <th scope="col">CODE</th>
                        <th scope="col">NUM COMPTE</th>
                        <th scope="col">NOM ET PRENOM</th>
                        <th scope="col">CONTACT</th>
                        
                        <th scope="col">SEXE</th>
                        <th scope="col">PHOTO</th>
                        <th scope="col">ZONE</th>
                        <th scope="col">SECTEUR ACT</th>
                        <th scope="col">RESTE A PAYER</th>
                        
                        </tr>
                </thead> <?php
        foreach($reqresult as $lig){?>
            <tbody>
                <tr>
                
                    <td><br><?php echo $lig['codecom']; ?></td>
                    <td><br><?php echo $lig['numcompte']; ?></td>
                    <td><br><?php echo $lig['nomcom']; ?></td>
                    <td><br><?php echo $lig['numcom']; ?></td>
                    <td><br><?php echo $lig['sexecom']; ?></td>
                    <td><img src="<?php echo $lig['photocom'];?>" width="50px" alt="rien"></td>
                    <td><br><?php echo $lig['zonecom']; ?></td>
                    <td><br><?php echo $lig['secactcom']; ?></td>
                    <td id="rest"><br><?php echo $lig['restapay']; ?></td>
                    
    
                </tr>
            </tbody><?php
                    
                        
                        
        }
    }
    
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
   
    <div class="container">
        <form method="GET">   
            <div class="row">
                <div class="col">
                    <input type="search" name="cherche" class="form-control" placeholder="Entrer le nom d'un commercant" >  
                </div>
                <div class="col">
                    <button class="btn btn-outline-secondary btn-primary " id="rec" name="valider" type="submit">Rechercher</button>
                </div>
                <div class="col"></div>
                <div class="col"><button class="btn btn-outline-secondary" id="tout" name="listevers" type="submit">Liste des versements</button></div>
            </div>
        </form>   
    </div>

    <?php

// connexion a la base de données
//include("connex.php");
;//aristide's connexion
$db = mysqli_connect('localhost', 'root', '', 'collecte00');

if(isset($_GET['listevers'])){
    $sql1 = "SELECT codevers, versement.codecom, versement.numcompte, commercant.zonecom, commercant.codeag, datevers, taxe, montvers, versement.restapay FROM `versement` INNER JOIN `commercant` on versement.codecom=commercant.codecom";
    $query = mysqli_query($db, $sql1);?>
    <div class="container-fluid">
        <table class="table table-striped" id="cont">
        <thead>
            <tr>
            
                <th scope="col">CODE VERS</th>
                <th scope="col">CODE COM</th>
                <th scope="col">NUM COMPTE</th>
                <th scope="col">ZONE</th>
                <th scope="col">AGENT</th>
                <th scope="col">DATE VERS</th>
                <th scope="col">TAXE</th>
                <th scope="col">VERSEMENT</th>
                <th scope="col">RESTE A PAYER</th>
                <th scope="col">ACTION</th>

            </tr>
        </thead> <?php
        while($row = mysqli_fetch_assoc($query)) { ?>
            <tr>
            
                <td><?php echo $row['codevers']; ?></td>
                <td><?php echo $row['codecom']; ?></td>
                <td><?php echo $row['numcompte']; ?></td>
                <td><?php echo $row['zonecom']; ?></td>
                <td><?php echo $row['codeag']; ?></td>
                <td><?php echo $row['datevers']; ?></td>
                <td><?php echo $row['taxe']; ?></td>
                <td><?php echo $row['montvers']; ?></td>
                <td><?php echo $row['restapay']; ?></td>
                <td><button type="submit" name="mod" id="mod"><a href="modifvers.php?codevers=<?=$row['codevers']; ?>">MOD</a></button>
                    <button type="submit" name="sup" id="sup"><a href="supvers.php?codevers=<?=$row['codevers']; ?>">SUP</a></button></td>

                    
            </tr>
        <?php
        }?>
        </table> 
    </div>   
        <?php

}


    @$recherche=$_GET['cherche'];
// initialisation des variables
if(isset($_GET['valider'])){
    $recherche=strtoupper($recherche);
        
    if(!empty($_GET['cherche'])){
        $sql = "SELECT  numcompte, codecom, nomcom, zonecom, codeag, secactcom, restapay
             FROM commercant where numcompte like '%$recherche%'";
        $query = mysqli_query($db, $sql);

        if (mysqli_num_rows($query) > 0) { ?>
            <table class="table table-striped">
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
                </thead> <?php

                while($row = mysqli_fetch_assoc($query)) { ?>


                    <tr>
                    
                    <td><?php echo $row['numcompte']; ?></td>
                    <td><?php echo $row['codecom']; $codecomrech=$row['codecom'];?></td>
                    <td><?php echo $row['nomcom']; ?></td>
                    <td><?php echo $row['zonecom']; ?></td>
                    
                    <td><?php echo $row['secactcom']; ?></td>
                    <td id="rest"><?php echo $row['restapay']; ?></td>
                    <td><button type="submit" name="versement" id="mod"><a href="listevers.php?codecom=<?=$row['codecom']; ?>">VERSEMENT</a></button>
                        </td>
                        

                    </tr>
                    
                    
                    <?php
                }
            if(isset($_GET['versement'])){

                $req=$conn->query("SELECT * from versement where nomcom='$codecomrech'");
                $resultat=$req->fetchAll();?>
                    <table class="table table-striped">
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
                        </thead><?php
                        foreach($resultat as $ligne){?>
                            <tr>
                                <td><?php echo $ligne['numcompte'];?></td>
                                
                                <td><?php echo $ligne['codevers'];?></td>
                                <td><?php echo $ligne['datevers'];?></td>
                                <td><?php echo $ligne['taxe'];?></td>
                                <td><?php echo $ligne['montvers'];?></td>
                                <td><?php echo $ligne['restapay'];?></td>
                                <td><button type="submit" name="mod" id="mod"><a href="modifvers.php?codevers=<?=$ligne['codevers']; ?>">MOD</a></button>
                                    <button type="submit" name="sup" id="sup"><a href="supvers.php?codevers=<?=$ligne['codevers']; ?>">SUP</a></button></td>

                            </tr><?php        
                        }?>
                    </table><?php
            }
                
                
        } else {?>
                    <div class="message"><h3>AUCUN COMPTE CORRESPONDANT A <span><?php echo" ".$recherche;?></span></h3></div>
                <?php
        }
    }else{?>
        <div class="message"><h3>SAISISSEZ LE NUMERO D'UN COMPTE</h3></div>
        <?php
    }
          
        
}
?>

</div>

<script src="js/bootstrap.js"></script>
</body>
</html>