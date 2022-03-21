<?php
    


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
    include("menucom.php");

    if(isset($_POST['valider'])){
        
        @$nomcom = strtoupper($_POST['nomcom']);
        @$numcom= $_POST['numcom'];
        @$melcom = strtoupper($_POST['melcom']);
        @$photocom = $_FILES["image"]["name"];
        @$sexecom= $_POST['sexecom'];
        @$zonecom = $_POST['zonecom'];
        @$secactcom= $_POST['secactcom'];
        @$codeag = $_POST['codeag'];
       

        if(!empty($_POST['nomcom'])AND !empty($_POST['numcom']) AND !empty($_FILES["image"]["name"])
            AND !empty($_POST['melcom'])AND !empty($_POST['sexecom'])AND !empty($_POST['zonecom'])AND !empty($_POST['secactcom'])AND !empty($_POST['codeag'])){
           //VERIFCATION PRESENCE
            
            

                if(is_numeric($_POST['numcom'])){

                    if(filter_var($_POST['melcom'],FILTER_VALIDATE_EMAIL)){
                        //$pseudolong = strlen($codeag);

                            
                        $stmt = $conn->prepare("INSERT INTO commercant (nomcom, numcom, melcom,  photocom, sexecom, zonecom, secactcom, codeag)
                                VALUES (:nomcom, :numcom, :melcom, :photocom, :sexecom, :zonecom, :secactcom, :codeag)");
                        
                        $stmt->bindParam(':nomcom', $nomcom);
                        $stmt->bindParam(':numcom', $numcom);
                        $stmt->bindParam(':melcom', $melcom);
                        $stmt->bindParam(':photocom', $photocom);
                        $stmt->bindParam(':sexecom', $sexecom);
                        $stmt->bindParam(':zonecom', $zonecom);
                        $stmt->bindParam(':secactcom', $secactcom);
                        $stmt->bindParam(':codeag', $codeag);     
                        
                        
                        @$nomcom = strtoupper($_POST['nomcom']);
                        @$numcom= $_POST['numcom'];
                        @$melcom = strtoupper($_POST['melcom']);
                        @$photocom = $_FILES["image"]["name"];
                        @$sexecom= $_POST['sexecom'];
                        @$zonecom = $_POST['zonecom'];
                        @$secactcom= $_POST['secactcom'];
                        @$codeag = $_POST['codeag'];
                                        
                        $stmt->execute();
                        $msg="NOUVEAU COMMERCANT ENREGISTRE";
                        @$ok="OK";
                                // $_SESSION['autoriser']="util";
                                // $_SESSION['pseudo']= $sm;
                        
                        $reqidcom=$conn->prepare("SELECT idcom from commercant where nomcom = ? and numcom =?");
                        $reqidcom->execute(array($_POST['nomcom'], $_POST['numcom']));
                        $rest= $reqidcom->fetch();
                        $idrec=$rest['idcom'];
                        $code = 10000+intval($rest['idcom']);
                        //echo "C".$code;
                        $codecom = "A".$code;
                        $numcompte = "C".$code;
                        $restapay = 0;
                        $reqgen=$conn->prepare("UPDATE commercant SET codecom = :codecom, numcompte = :numcompte, restapay = :restapay
                                                where idcom = $idrec");
                        $reqgen->bindParam(':codecom', $codecom);
                        $reqgen->bindParam(':numcompte', $numcompte);
                        $reqgen->bindParam(':restapay', $restapay);

                        $codecom = "A".$code;
                        $numcompte = "C".$code;
                        $restapay = 0;
                        $reqgen->execute();
                        $msg2="Code commercant:".$codecom;
                        $msg3="Numero compte:".$numcompte;

                    }
                    else{
                        $msg="Entrer un email correct";
                    }

                }
                else{
                            
                    $msg = "Le contact telephonique doit etre un nombre";
                }
    
            
        }else{
            @$msg = "REMPLIR TOUS LES CHAMPS";
        }

    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}


$req = "SELECT * from zonee";
$result = $conn->query($req);
$ligne = $result->fetchAll();

$req1 = "SELECT * from agent";
$result1 = $conn->query($req1);
$ligne1 = $result1->fetchAll();

$req2 = "SELECT * from secteuract";
$result2 = $conn->query($req2);
$ligne2 = $result2->fetchAll();


  $conn = null;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENREGISTREMENT COMMERCANT</title>
    <link rel="stylesheet" href="css/bootstrap.css"/>
<style>
        
    form{
        display : flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        margin-top: 10px;
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
    form .inputs input[type="text"], input[type="mail"], select, input[type="file"]{
        padding: 10px;
        border-radius: 5px;
        border: none;
        background-color: #f2f2f2;
        margin-bottom: 10px;
        outline: blue;
        width: 300px;
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
        margin-top: 20px;
        padding: 10px 15px;
        border: none;
        border-radius: 10px;
        font-size: 20px;
        color: #fff;
        background-color: #eb7371;
        cursor: pointer;
        outline: none;
        font-weight: bold;
        width: 300px;
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
	<form method="POST" enctype="multipart/form-data">
        <h1>NOUVEAU COMMERCANT</h1>
       
        <div class="inputs">
        
        
        <input type="text" name="nomcom" value= "<?php if(isset($nomcom)){ echo $nomcom;}?>" placeholder="Nom et Prenom du commercant ">
        <input type="text" name="numcom" value= "<?php if(isset($numcom)){ echo $numcom;}?>" placeholder="Contact du commercant">
        <input type="mail" name="melcom" value= "<?php if(isset($melcom)){ echo $melcom;}?>"  placeholder="Email du commercant">
        <input type="file" name="image"/>
        <select name="sexecom">
            <option value="">---SEXE---</option>
            <option value="M">M</option>
            <option value="F">F</option>
        </select>
        <select name="zonecom">
       
            <option value="">---Zone d'activites---</option>
            
                <?php foreach($ligne as $lig){?>
                <option value="<?= $lig['nomzo']; ?>"><?= $lig['nomzo']; ?></option>
                <?php } ?>
        </select>
        <select name="secactcom">
       
            <option value="">---secteur d'activites---</option>
            
                <?php foreach($ligne2 as $lig2){?>
                <option value="<?= $lig2['nomsecact']; ?>"><?= $lig2['nomsecact']; ?></option>
                <?php } ?>
        </select>
        <select name="codeag">
       
            <option value="">---nom de l'agent collecteur---</option>
            
                <?php foreach($ligne1 as $lig1){?>
                <option value="<?= $lig1['nomag']; ?>"><?= $lig1['nomag']; ?></option>
                <?php } ?>
        </select>

            
        </div>
        
        
        <div align="center">
            <button type="submit" name="valider">ENREGISTRER</button>

        </div>
    </form>
    <script src="js/bootstrap.js"></script>
   
</body>
</html>
