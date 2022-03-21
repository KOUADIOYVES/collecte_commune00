<?php
//session_start();
//include("menu.php");
session_start();
    if($_SESSION['autoriser']!="util"){
        header("location:connex_agent.php");
    }

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
    include("menuagent.php");

    if(isset($_POST['valider']))
    {
        
        @$nomag = strtoupper($_POST['nomag']);
        @$numag= ($_POST['numag']);
        @$melag = strtoupper($_POST['melag']);
        @$zoneag = strtoupper($_POST['zoneag']);
        @$pseudoag = strtoupper($_POST['pseudoag']);
        @$photocom = $_FILES["image"]["name"];
        @$mdpag = $_POST['mdpag'];
        @$mdpag1 = $_POST['mdpag1'];

        if(!empty($_POST['nomag'])AND !empty($_POST['numag'])
            AND !empty($_POST['melag'])AND !empty($_POST['zoneag'])AND !empty($_POST['pseudoag']) AND !empty($_POST['mdpag'])){
           //VERIFCATION PRESENCE
            
            $reqcode=$conn->prepare("SELECT * from agent where nomag = ?");
            $reqcode->execute(array($_POST['nomag']));
            $nbrecode = $reqcode->rowCount();
            if($nbrecode==0){

                if(is_numeric($_POST['numag'])){

                    if(filter_var($_POST['melag'],FILTER_VALIDATE_EMAIL)){
                        //$pseudolong = strlen($pseudoag);

                        $pseudolong = strlen($_POST['pseudoag']);
                        if($pseudolong <= 250){

                            $reqpseudo=$conn->prepare("SELECT * from agent where pseudoag = ?");
                            $reqpseudo->execute(array($_POST['pseudoag']));
                            $nbrepseudo = $reqpseudo->rowCount();
                            if($nbrepseudo==0){
                                @$mdpag = $_POST['mdpag'];
                                @$mdpag1 = $_POST['mdpag1'];

                                if($mdpag==$mdpag1){
                                    $stmt = $conn->prepare("INSERT INTO agent ( nomag, numag, melag, zoneag, pseudoag, mdpag)
                                            VALUES ( :nomag, :numag, :melag, :zoneag, :pseudoag, :mdpag)");
                                    
                                    $stmt->bindParam(':nomag', $nomag);
                                    $stmt->bindParam(':numag', $numag);
                                    $stmt->bindParam(':melag', $melag);
                                    $stmt->bindParam(':zoneag', $zoneag);
                                    $stmt->bindParam(':pseudoag', $pseudoag);
                                    $stmt->bindParam(':mdpag', $mdpag);
            
                            // insert another row
                                    
                                    @$nomag = strtoupper($_POST['nomag']);
                                    @$numag = $_POST['numag'];
                                    @$melag = strtoupper($_POST['melag']);
                                    @$zoneag = strtoupper($_POST['zoneag']);
                                    @$pseudoag = strtoupper($_POST['pseudoag']);
                                    @$mdpag = $_POST['mdpag'];
                                    @$mdpag1 = $_POST['mdpag1'];

                                    $stmt->execute();
                                    $msg="AGENT BIEN ENREGISTRE";
                                    @$var="OK";
                                    $idagrec = $conn->lastInsertId();
                                echo $idagrec;
                                $code = 100+intval($idagrec);
                                $codeag = "G".$code;
                                $reqgen=$conn->prepare("UPDATE agent SET codeag = :codeag where idag = $idagrec");
                                $reqgen->bindParam(':codeag', $codeag);
                            
                                $reqgen->execute();  

                                // $_SESSION['autoriser']="util";
                                // $_SESSION['pseudo']= $sm;
                                    

                                }
                                else{
                                $msg="Veuiller saisir le meme mot de passe";
                                }
                            
                            }
                            else{
                                $msg="Ce pseudo existe deja";
                            }

                        }
                        else{
                            
                            $msg = "votre pseudo ne doit pas depasser 10 caractere";
                        }
                    }else{
                        $msg="Entrer un email correct";
                    }
                }else{
                    //$msg = "votre pseudo ne doit pas depasser 10 caractere";
                    $msg="Le contact telephonique doit etre un nombre";
                }
            }else{
                $msg="Ce code est deja attribue";
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
<title>INSCRIPTION D'UN AGENT</title>
<meta charset='utf-8'>
<meta name="viewport" content="width=device-width initial-scale=1.0">
<link rel="stylesheet" href="css/bootstrap.css"/>
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
    form .inputs input[type="text"], input[type="password"], input[type="file"], input[type="mail"]{
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
        padding: 5px 5px;
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
        background-color: red;
        color: white;
        text-align: center;
        margin-top: 0px;
    }
    h4{
        color: green;
        margin-left: 90%;
    }
</style>

</head>




<body>
    <?php
    //if(@$var=="OK"){?>
        
    <?php
    //}
    ?>

    <h3>
    <?php 
        if(isset($msg)){
        echo @$msg;
        }
    ?>
    </h3>
	<form method="POST" enctype="multipart/form-data">
        <h1>ENREGISTREMENT AGENT</h1>
       
        <div class="inputs">
        
        <input type="text" name="nomag" value= "<?php if(isset($nomag)){ echo $nomag;}?>" placeholder="Nom et Prenom de l'agent ">
        <input type="text" name="numag" value= "<?php if(isset($numag)){ echo $numag;}?>" placeholder="Contact de l'agent">
        <input type="mail" name="melag" value= "<?php if(isset($melag)){ echo $melag;}?>"  placeholder="Email de l'agent">
        <input type="text" name="zoneag" value= "<?php if(isset($zoneag)){ echo $zoneag;}?>" placeholder="Zone de l'agent">
        <input type="file" name="image"/>
        <input type="text" name="pseudoag" value= "<?php if(isset($pseudoag)){ echo $pseudoag;}?>" placeholder="pseudo de l'agent">
        
        <input type="password" name="mdpag" placeholder="Mot de passe de l'agent">
        <input type="password" name="mdpag1"  placeholder="Repeter Mot de passe de l'agent">
            
        </div>
        
        
        <div align="center">
            <button type="submit" name="valider">Valider</button>

        </div>
    </form>
    
   
</body>
</html>
