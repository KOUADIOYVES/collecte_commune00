<?php
 

//session_start();
//if($_SESSION['pseudo']=="TEKI"){
    
//}else{
    include("menuvers.php");
    include("connex.php");

//}

function afficher($reqresult){?>
    <div class="container-fluid" id="cont">
        <table class="table table-stripped table-hover">
            <thead>
                <tr>
                    <th scope="col">NUM COMPTE</th>
                    <th scope="col">CODE</th>
                    <th scope="col">NOM ET PRENOM</th>
                    <th scope="col">CONTACT</th>
                    
                    <th scope="col">PHOTO</th>
                    <th scope="col">ZONE</th>
                    <th scope="col">SECTEUR ACT</th>
                    <th scope="col">RESTE A PAYER</th>
                    <th scope="col">ACTION</th>
                    </tr>
            </thead> <?php
    foreach($reqresult as $lig){?>
        <tbody>
            <tr>
                <td><br><?php echo $lig['numcompte']; ?></td>
                <td><br><?php echo $lig['codecom']; ?></td>
                
                <td><br><?php echo $lig['nomcom']; ?></td>
                <td><br><?php echo $lig['numcom']; ?></td>
                
                <td><img src="<?php echo $lig['photocom'];?>" width="50px" alt="rien"></td>
                <td><br><?php echo $lig['zonecom']; ?></td>
                <td><br><?php echo $lig['secactcom']; ?></td>
                <td id="rest"><br><?php echo $lig['restapay']; ?></td>
                <td><button type="submit" name="versement" id="mod"><a href="listevers.php?codecom=<?=$lig['codecom']; ?>">VERSEMENT</a></button></td>

            </tr>
        </tbody><?php
                
                    
                    
    }
}
?>

<!-- <!DOCTYPE html> -->
<!DOCTYPE html>
<html>
<head>
<title>RECHERCHE COMMERCANT</title>
<meta charset='utf-8'>
<meta name="viewport" content="width=device-width initial-scale=1.0">
<link rel="stylesheet" href="css/bootstrap.css"/>
</head>
<style>
    img{
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }
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
    #cherc{
        margin-left: 30px;
        width: 300px;
    }
    #rec{
        margin-left: 0;
        color: white;
        font-weight: bold;
        border-radius: 20px;
        width: 200px;
    }
    #tout{
        background-color: #91df83;
        color: white;
        font-weight: bold;
        border-radius: 20px;
        width: 200px;
    }
    #cont{
        margin-top: 40px;
        background-color: white;
    }
    select#zone{
        padding: 5px;
        margin: 5px;
        text-align: center;
        width: 200px;
    }
    span{
        background-color: red;
        color: white;
    }
</style>

<body>
    
    <!--<h2>

    <?php
    require_once("menucom.php");
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
    
    <div class="container-fluid" id="cont">
        <form method="GET">   
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <input type="search" id="cherc" name="cherche" class="form-control" placeholder="Entrer le numero d'un compte" >  
                </div>
                <div class="col-sm-6 col-lg-3">
                    <button class="btn btn-outline-secondary btn-primary " id="rec" name="valider" type="submit">Rechercher</button>
                </div>
                <div class="col-sm-6 col-lg-3"><button class="btn btn-outline-secondary btn-primary " id="rec" name="filtre" type="submit">Filtrer</button></div>
                <div class="col-sm-6 col-lg-3"><button class="btn btn-outline-secondary" id="tout" name="listecompte" type="submit">Liste des comptes</button></div>
            </div>
        </form>   
    </div>
    
   
    
    <?php

// connexion a la base de données
//include("connex.php");
;//aristide's connexion
$db = mysqli_connect('localhost', 'root', '', 'collecte00');

if(isset($_GET['listecompte'])){
    $sql1 = "SELECT codecom, numcompte, nomcom, numcom, zonecom, secactcom, restapay, photocom
     FROM commercant";
    $query = mysqli_query($db, $sql1);?>
        <div class="container-fluid" id="cont">
        <table class="table table-hover table-stripped">
        <thead>
            <tr>
                
                <th scope="col">NUM COMPTE</th>
                <th scope="col">CODE</th>
                <th scope="col">NOM ET PRENOM</th>
                <th scope="col">CONTACT</th>
                <th scope="col">PHOTO</th>
                <th scope="col">ZONE</th>
                <th scope="col">SECTEUR ACT</th>
                <th scope="col">RESTE A PAYER</th>
                
                <th scope="col">ACTION</th>

            </tr>
        </thead> <?php
        while($row = mysqli_fetch_assoc($query)) { ?>
        <tbody>
            <tr>
                <td><br><?php echo $row['numcompte']; ?></td>
                <td><br><?php echo $row['codecom']; ?></td>
                
                <td><br><?php echo $row['nomcom']; ?></td>
                <td><br><?php echo $row['numcom']; ?></td>
                
                <td><img src="<?php echo $row['photocom'];?>" width="50px" alt="rien"></td>
                <td><br><?php echo $row['zonecom']; ?></td>
                <td><br><?php echo $row['secactcom']; ?></td>
                <td id="rest"><br><?php echo $row['restapay']; ?></td>
                <td><br><button type="submit" name="versement" id="mod"><a href="listevers.php?codecom=<?=$row['codecom']; ?>">VERSEMENT</a></button></td>

            </tr>
        </tbody>
        <?php
        }?>
    </table>
    </div> <?php

}



    @$recherche=$_GET['cherche'];
// initialisation des variables
    if(isset($_GET['valider'])){
        $recherche=strtoupper($recherche);
        

               
        if(!empty($_GET['cherche'])){
            $sql = "SELECT  codecom, numcompte, nomcom, numcom,  photocom, zonecom, secactcom, restapay
             FROM commercant where CONCAT(codecom, numcompte, nomcom, numcom) like '%$recherche%'";
            $query = mysqli_query($db, $sql);

            if (mysqli_num_rows($query) > 0) { ?>
            <div class="container-fluid" id="cont">
                <table class="table table-stripped table-hover">
                <thead>
                    <tr>
                    
                    <th scope="col">NUM COMPTE</th>
                    <th scope="col">CODE</th>
                    <th scope="col">NOM ET PRENOM</th>
                    <th scope="col">CONTACT</th>
                    <th scope="col">PHOTO</th>
                    
                    <th scope="col">ZONE</th>
                    <th scope="col">SECTEUR ACT</th>
                    <th scope="col">RESTE A PAYER</th>
                    <th scope="col">ACTION</th>
                    </tr>
                </thead> <?php

                while($row = mysqli_fetch_assoc($query)) { ?>

                <tbody>
                    <tr>
                    <td><br><br><?php echo $row['numcompte']; ?></td>
                    <td><br><br><?php echo $row['codecom']; $codecomrech=$row['codecom'];?></td>
                    
                    <td><br><br><?php echo $row['nomcom']; ?></td>
                    <td><br><br><?php echo $row['numcom']; ?></td>
                    <td><img src="<?php echo $row['photocom'];?>" width="75px" alt="rien"></td>
                    
                    <td><br><br><?php echo $row['zonecom']; ?></td>
                    <td><br><br><?php echo $row['secactcom']; ?></td>
                    <td id="rest"><br><br><?php echo $row['restapay']; ?></td>
                    <td><td><button type="submit" name="versement" id="mod"><a href="listevers.php?codecom=<?=$lig['codecom']; ?>">VERSEMENT</a></button></td>

                    </tr>
                </tbody>
                    
                    <?php
                }?>
                </table>
            </div><?php
                
                
                
            } else {?>
                    <h3>AUCUN COMPTE CORRESPONDANT A <span><?php echo" ".$recherche;?></span></h3>
                <?php
            }
        }else{?>
            <div class="contenair-fluid"><h3>SAISISSEZ LE NUMERO D'UN COMPTE</h3></div>
        <?php
        }
        
    }    

?>
<?php
    if(isset($_GET['filtre'])){
        $req="SELECT * from secteuract ";
        $req=$conn->query($req);
        $resu=$req->fetchAll();
        //echo $resu['nomsecact'];
        $req2="SELECT * from zonee ";
        $req2=$conn->query($req2);
        $resu2=$req2->fetchAll();?>
        
        <div class="container">
            <form method="POST">
                <select name="etatc" id="zone">
                    <option value="">Etat du compte</option>
                    
                    <option value="0">VERT</option>
                    <option value="1">ROUGE</option>
                    
                </select>
                <select name="zone" id="zone">
                    <option value="">zone</option>
                    <?php foreach($resu2 as $row){?>
                    <option value="<?= $row['nomzo']; ?>"><?= $row['nomzo']; ?></option>
                    <?php } ?>
                </select>
                <select name="secact"  id="zone">
                    <option value="">secteur d'activite</option>
                    <?php foreach($resu as $row){?>
                    <option value="<?= $row['nomsecact']; ?>"><?= $row['nomsecact']; ?></option>
                    <?php } ?>
                </select>
                
                <input type="submit" id="tout" name="valider" value="FILTRAGE">
            </form>
        </div><?php

        @$numcompte=$_POST['numcompte'];
        @$secact=$_POST['secact'];
        @$zone=$_POST['zone'];
        @$etatc=$_POST['etatc'];
        switch(isset($_POST['valider'])){
            //echo $secact=$_POST['secact'];
            //echo $codecom=$_POST['zone'];
        
        

        case(empty($secact) AND !empty($zone) AND empty($etatc)):
            $req=$conn->query("SELECT * from commercant where zonecom='$zone'");
            $resultat=$req->fetchAll();
                //$nbre=$resultat->rowcount();
            $i=0;
            foreach($resultat as $lig){
                $i+=1;?> <?php
            }
            if($i>0){?>
                   
                <h3><?php echo $i." COMPTE DANS LA ZONE "?><span><?php echo $zone;?></span></h3>
            <?php
                afficher($resultat);
            }else{ ?>
                <h3><?php echo " AUCUN COMPTE DANS LA ZONE "?><span><?php echo $zone;?></span></h3><?php    
            }
            break;    

        case(!empty($secact) AND empty($zone) AND empty($etatc)):
            $req=$conn->query("SELECT * from commercant where secactcom='$secact'");
            $resultat=$req->fetchAll();
            //$nbre=$resultat->rowcount();
            $i=0;
            foreach($resultat as $lig){
                $i+=1;?> <?php
            }
            if($i>0){?>
               
                <h3><?php echo $i." COMPTE DANS SECTEUR D'ACTIVITE "?><span><?php echo $secact;?></span></h3>
            <?php
                afficher($resultat);
            }else{ ?>
                <h3><?php echo " AUCUN COMPTE DANS SECTEUR D'ACTIVITE "?><span><?php echo $secact;?></span></h3><?php    
            }
            break;
        
        case(!empty($secact) AND !empty($zone) AND empty($etatc)):
            $req=$conn->query("SELECT * from commercant where zonecom='$zone' and secactcom='$secact'");
            $resultat=$req->fetchAll();
            $i=0;
                foreach($resultat as $lig){
                    $i+=1;?> <?php
                }
                if($i>0){?>
                   
                    <h3><?php echo $i." COMPTES DANS LA ZONE DE ";?><span><?php echo $zone;?></span></h3>
                <?php
                    afficher($resultat);
                }else{ ?>
                    <h3><?php echo " AUCUN COMPTE DANS LA ZONE DE ";?><span><?php echo $zone;?></span></h3><?php    
                }            
            break;

        case(empty($secact) AND empty($zone) AND ($etatc=="0")):
            
                $etatc=intval($etatc);
                $req=$conn->query("SELECT * from commercant where restapay= 0 ");
                $resultat=$req->fetchAll();
                $i=0;
                foreach($resultat as $lig){
                    $i+=1;?> <?php
                }
                if($i>0){?>
                    
                    <h3><?php echo $i." COMPTES VERTS ";?></h3>
                    <?php
                    afficher($resultat);
                }else{ ?>
                    <h3><?php echo " AUCUN COMPTE VERT ";?></h3><?php    
                }
            
            break;
        
        case(empty($secact) AND empty($zone) AND $etatc=="1"):
            
                $req=$conn->query("SELECT * from commercant where restapay>0");
                $resultat=$req->fetchAll();
                $i=0;
                foreach($resultat as $lig){
                    $i+=1;?> <?php
                }
                if($i>0){?>
                    
                    <h3><?php echo $i." COMPTES ROUGES ";?></h3>
                    <?php
                    afficher($resultat);
                }else{ ?>
                    <h3><?php echo " AUCUN COMPTE ROUGE ";?></h3><?php    
                }
            
                
            break;
        
        case(empty($secact) AND !empty($zone) AND ($etatc=="0")):
            
                $req=$conn->query("SELECT * from commercant where restapay=0 and zonecom='$zone'");
                $resultat=$req->fetchAll();
                $i=0;
                foreach($resultat as $lig){
                    $i+=1;?> <?php
                }
                if($i>0){?>
                    
                    <h3><?php echo $i." COMPTES VERTS DANS LA ZONE "?><span><?php echo $zone;?></span></h3>
                    <?php
                    afficher($resultat);
                }else{ ?>
                    <h3><?php echo " AUCUN COMPTE VERT DANS LA ZONE "?><span><?php echo $zone;?></span></h3><?php    
                }
            break;
        
        case(empty($secact) AND !empty($zone) AND $etatc=="1"):
            
                $req=$conn->query("SELECT * from commercant where restapay>0 and zonecom='$zone'");
                $resultat=$req->fetchAll();
                $i=0;
                foreach($resultat as $lig){
                    $i+=1;?> <?php
                }
                if($i>0){?>
                    
                    <h3><?php echo $i." COMPTES ROUGES DANS LA ZONE "?><span><?php echo $zone;?></span></h3>
                    <?php
                    afficher($resultat);
                }else{ ?>
                    <h3><?php echo " AUCUN COMPTE ROUGE  DANS LA ZONE "?><span><?php echo $zone;?></span></h3><?php    
                }
            
            
            break;
        
        case(!empty($secact) AND empty($zone) AND $etatc=="0"):
            
                $req=$conn->query("SELECT * from commercant where restapay=0 and secactcom='$secact'");
                $resultat=$req->fetchAll();
                $i=0;
                foreach($resultat as $lig){
                    $i+=1;?> <?php
                }
                if($i>0){?>
                    
                    <h3><?php echo $i." COMPTES VERTS DANS LE SECTEUR D'ACTIVITE "?><span><?php echo $secact;?></span></h3>
                    <?php
                    afficher($resultat);
                }else{ ?>
                    <h3><?php echo " AUCUN COMPTE VERT DANS LE SECTEUR D'ACTIVITE "?><span><?php echo $secact;?></span></h3><?php    
                }
            break;
        
        case(!empty($secact) AND empty($zone) AND $etatc=="1"):
            
                $req=$conn->query("SELECT * from commercant where restapay>0 and secactcom='$secact'");
                $resultat=$req->fetchAll();
                $i=0;
                foreach($resultat as $lig){
                    $i+=1;?> <?php
                }
                if($i>0){?>
                    
                    <h3><?php echo $i." COMPTES ROUGES DANS LE SECTEUR D'ACTIVITE "?><span><?php echo $secact;?></span></h3>
                    <?php
                    afficher($resultat);
                }else{ ?>
                    <h3><?php echo " AUCUN COMPTE ROUGE  DANS LE SECTEUR  D'ACTIVITE "?><span><?php echo $secact;?></span></h3><?php    
                }
              
            break;

        case(!empty($secact) AND !empty($zone) AND $etatc=="0"):
            
                $req=$conn->query("SELECT * from commercant where restapay=0 and zonecom='$zone' and secactcom='$secact'");
                $resultat=$req->fetchAll();
                $i=0;
                foreach($resultat as $lig){
                    $i+=1;?> <?php
                }
                if($i>0){?>
                    
                    <h3><?php echo $i." COMPTES VERTS DANS LA ZONE "?><span><?php echo $zone;?></span><span><?php echo" ET DANS SECTEUR D'ACTIVITE "?><span><?php echo $secact;?></h3>
                    <?php
                    afficher($resultat);
                }else{ ?>
                    <h3><?php echo " AUCUN COMPTE VERT DANS LA ZONE "?><span><?php echo $zone;?><?php echo" ET DANS SECTEUR D'ACTIVITE "?><span><?php echo $secact;?></h3><?php    
                }
            break;

        case(!empty($secact) AND !empty($zone) AND $etatc=="1"):
            
                $req=$conn->query("SELECT * from commercant where restapay>0 and zonecom='$zone' and secactcom='$secact'");
                $resultat=$req->fetchAll();
                $i=0;
                foreach($resultat as $lig){
                    $i+=1;?> <?php
                }
                if($i>0){?>
                    
                    <h3><?php echo $i." COMPTES ROUGES DANS LA ZONE "?><span><?php echo $zone;?></span><span><?php echo $zone;?></span><?php echo" ET DANS SECTEUR D'ACTIVITE "?><span><?php echo $secact;?></h3>
                    <?php
                    afficher($resultat);
                }else{ ?>
                    <h3><?php echo " AUCUN COMPTE ROUGE  DANS LA ZONE "?><span><?php echo $zone;?></span><span><?php echo $zone;?></span><?php echo" ET DANS SECTEUR D'ACTIVITE "?><span><?php echo $secact;?></h3><?php    
                }
            
                
            break;

        case(!empty($secact) AND empty($zone) AND $etatc=="0"):
            
                $req=$conn->query("SELECT * from commercant where restapay=0  and secactcom='$secact'");
                $resultat=$req->fetchAll();
                $i=0;
                foreach($resultat as $lig){
                        
                    $i+=1;?> <?php
                }
                if($i>0){?>
                            
                    <h3><?php echo $i." COMPTES ROUGES DANS LA ZONE "?><span><?php echo $zone;?></span><?php echo" ET DANS SECTEUR D'ACTIVITE "?><span><?php echo $secact;?></h3>
                    <?php
                    afficher($resultat);
                }else{ ?>
                    <h3><?php echo " AUCUN COMPTE ROUGE  DANS LA ZONE "?><span><?php echo $zone;?></span><span><?php echo $zone;?></span><?php echo" ET DANS SECTEUR D'ACTIVITE "?><span><?php echo $secact;?></h3><?php    
                }
            
                        
            break;
        
        case(!empty($secact) AND empty($zone) AND $etatc=="1"):
            
                $req=$conn->query("SELECT * from commercant where restapay>0  and secactcom='$secact'");
                $resultat=$req->fetchAll();
                $i=0;
                foreach($resultat as $lig){
                    $i+=1;?> <?php
                }
                if($i>0){?>
                        
                    <h3><?php echo $i." COMPTES ROUGES DANS LA ZONE "?><span><?php echo $zone;?></span><?php echo" ET DANS SECTEUR D'ACTIVITE "?><span><?php echo $secact;?></h3>
                    <?php
                    afficher($resultat);
                }else{ ?>
                    <h3><?php echo " AUCUN COMPTE ROUGE  DANS LA ZONE "?><span><?php echo $zone;?></span><span><?php echo $zone;?></span><?php echo" ET DANS SECTEUR D'ACTIVITE "?><span><?php echo $secact;?></h3><?php    
                }
            
                    
            break;
        
        case(!empty($secact) AND !empty($zone) AND $etatc=="0"):
            
                $req=$conn->query("SELECT * from commercant where restapay= 0 and zonecom='$zone' and secactcom='$secact'");
                $resultat=$req->fetchAll();
                $i=0;
                foreach($resultat as $lig){
                    $i+=1;?> <?php
                }
                if($i>0){?>
                        
                    <h3><?php echo $i." COMPTES ROUGES DANS LA ZONE "?><span><?php echo $zone;?></span><span><?php echo $zone;?></span><?php echo" ET DANS SECTEUR D'ACTIVITE "?><span><?php echo $secact;?></h3>
                    <?php
                    afficher($resultat);
                }else{ ?>
                    <h3><?php echo " AUCUN COMPTE ROUGE  DANS LA ZONE "?><span><?php echo $zone;?></span><span><?php echo $zone;?></span><?php echo" ET DANS SECTEUR D'ACTIVITE "?><span><?php echo $secact;?></h3><?php    
                }
            
                    
            break;
        case($etatc=="0"):
            
            $req=$conn->query("SELECT * from commercant where restapay= 0");
            $resultat=$req->fetchAll();
            $i=0;
            foreach($resultat as $lig){
                $i+=1;?> <?php
            }
            if($i>0){?>
                        
                <h3><?php echo $i." COMPTES VERTS  "?></h3>
                <?php
                afficher($resultat);
            }else{ ?>
                <h3><?php echo " AUCUN COMPTE VERT "?></h3><?php    
            }
            
                    
        break;

        case(empty($secact) AND empty($zone) AND empty($etatc)):?>
            <h3>AUCUN CRITERE DE FILTRAGE DE DONNEES CHOISI</h3><?php
                    
            break;

        
    }


    }
?>

</div>

<script src="js/bootstrap.js"></script>
</body>
</html>