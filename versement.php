<?php


//session_start();
include("menuvers.php");
?>
 <?php

/*@$servername = "localhost";
@$username = "root";
@$password = "";
@$dbname = "site00";*/

try {
    /*$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);*/

    //VERIFICATION
    include("connex.php");

    if(isset($_POST['valider']))
    {
        
        @$codecom = $_POST['codecom'];
        @$numcompte = $_POST['numcompte'];
        @$datevers= $_POST['datevers'];
        @$taxe = $_POST['taxe'];
        @$montvers= $_POST['montvers'];
        
       

        if(!empty($_POST['codecom'])AND !empty($_POST['numcompte']) AND !empty($_POST['datevers'])
            AND !empty($_POST['taxe'])AND !empty($_POST['montvers'])){
           //RECHERCHE NUMCOMPTE DU COMMERCANT
            $reqnumcompte=$conn->prepare("SELECT * from commercant where codecom = ?");
            $reqnumcompte->execute(array($_POST['codecom']));
            $rest= $reqnumcompte->fetch();
            
            @$numcompte = $rest['numcompte'];
            @$restapay = $rest['restapay'];
            @$test=$reqnumcompte->rowcount();
            echo $test;
            if($test==0){
                $msg="CE COMPTE N'EXISTE PAS";
            }else{
                $restapay = (intval($taxe) - intval($montvers));
                echo $numcompte;
                echo $restapay;
                                    
                $stmt = $conn->prepare("INSERT INTO versement (codecom, numcompte, datevers, taxe, montvers, restapay)
                        VALUES (:codecom, :numcompte, :datevers, :taxe, :montvers, :restapay)");
                            
                $stmt->bindParam(':codecom', $codecom);
                $stmt->bindParam(':numcompte', $numcompte);
                $stmt->bindParam(':datevers', $datevers);
                $stmt->bindParam(':taxe', $taxe);
                $stmt->bindParam(':montvers', $montvers);
                $stmt->bindParam(':restapay', $restapay);
                
                            
                @$codecom = $_POST['codecom'];
                @$numcompte = $_POST['numcompte'];
                @$datevers= $_POST['datevers'];
                @$taxe = $_POST['taxe'];
                @$montvers= $_POST['montvers'];
                                            
                $stmt->execute();
                //$msg="NOUVEAU COMMERCANT ENREGISTRE";
                //@$ok="OK";
                                    // $_SESSION['autoriser']="util";
                                    // $_SESSION['pseudo']= $sm;
                            
                //$reqidvers=$conn->prepare("SELECT idvers from versement order by idvers desc limit 1");
                //$reqidvers->execute();
                //$rest= $reqidvers->fetch();
                //$idvers=$rest['idvers'];
                //$code = 10000+intval($rest['idvers']);
                                    //echo "C".$code;
                //$codevers = "V".$code;

                //RECHERCHE DU DERNIER iD VERS POUR ATTRIBUER UN CODE
                $idversrec = $conn->lastInsertId();
                echo $idversrec;
                $code = 10000+intval($idversrec);
                $codevers = "V".$code;
                $reqgen=$conn->prepare("UPDATE versement SET codevers = :codevers where idvers = $idversrec");
                $reqgen->bindParam(':codevers', $codevers);
            
                $reqgen->execute();  
                //RECHERCHE DU COMMERCANT POUR INCREMENTER SON RESTE A PAYER
                
                $reqidcom=$conn->prepare("SELECT * from commercant where codecom = ?");
                $reqidcom->execute(array($_POST['codecom']));
                $rest1= $reqidcom->fetch();
                $idrec1=$rest1['idcom'];
                @$restapay00=$rest1['restapay'];
                $restapay1 = intval($restapay) + intval($restapay00);
                
                $reqgen1=$conn->prepare("UPDATE commercant SET restapay = :restapay where idcom = $idrec1");
                $reqgen1->bindParam(':restapay', $restapay1);

                $reqgen1->execute(); 
                $msg="VERSEMENT ENREGISTRE";
                $msg2="CODE VERSEMENT:".$codevers;
                $ok="OK";
            }
                    
        }else{
            @$msg = "REMPLIR TOUS LES CHAMPS";
        }

    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}



  $conn = null;
?>


<!DOCTYPE html>
<html>
<head>
<title>ENREGISTREMENT D'UN VERSEMENT</title>
<meta charset='utf-8'>
<meta name="viewport" content="width=device-width initial-scale=1.0">

<style>
    
    form{
        display : flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        margin-top: 0px;
        background-color: #fff;
        padding: 10px 10px;
        min-width: 300px;
    }
    form h1{
        color: #eb7371;
        text-align: center;
    }
    form .inputs{
        display:flex ;
        flex-direction:column ;
    }
    form .inputs input[type="text"], input[type="date"], select{
        padding: 15px;
        border-radius: 5px;
        border: none;
        background-color: #f2f2f2;
        margin-bottom: 15px;
        outline: none;
        width: 250px;
    }
    form p{
        text-align: center;
        font-size: 14px;
        margin-bottom: 20px;
        color: #878787;
    }
    form p.new{
        
        font-size: 14px;
        margin-bottom: 20px;
        color: #eb7371;
    }
    form button{
        padding: 15px auto;
        border: none;
        border-radius: 10px;
        font-size: 20px;
        color: #fff;
        background-color: #eb7371;
        cursor: pointer;
        outline: none;
        font-weight: bold;
        width: 250px;
        height: 40px;
        text-align: center;
    }
    h3{
        background-color: #91df83;
        color: white;
        text-align: center;
        margin-top: 0px;
    }
    h2{
        background-color: blue;
        color: white;
        text-align: center;
        margin-top: 0px;
    }
    
    
</style>

</head>




<body>
    <h3>
        <?php 
            if(isset($msg)){
            echo @$msg;
            }
        ?>
    </h3>
    <h2>
        <?php 
            if(@$ok=="OK"){
            echo @$msg2;?>
            <span><?php
            echo @$msg3;
            }
        ?>
    </h2>
    
	<form method="POST">
        <h1>ENREGISTREMENT VERSEMENT</h1>
       
        <div class="inputs">
        
        
        <input type="text" name="codecom" value= "<?php if(isset($codecom)){ echo $codecom;}?>" placeholder="Code du commercant ">
        <input type="text" name="numcompte" value= "<?php if(isset($numcompte)){ echo $numcompte;}?>" placeholder="Numero du compte ">
        <input type="date" name="datevers" value= "<?php if(isset($datevers)){ echo $datevers;}?>" placeholder="Date du versement">
        <input type="text" name="taxe" value= "<?php if(isset($taxe)){ echo $taxe;}?>"  placeholder="Montant de la taxe">
        <input type="text" name="montvers" value= "<?php if(isset($montvers)){ echo $montvers;}?>"  placeholder="Montant verse">
        
                    
        </div>
        
        
        <div align="center">
            <button type="submit" name="valider">ENREGISTRER</button>

        </div>
    </form>
    
   
</body>
</html>
