<?php


session_start();
if($_SESSION['pseudo']=="util"){
    
}else{
    header("location:connex_agent.php");
}



include("menuag1.php");
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

    if(isset($_POST['valider'])){
        
        @$nomsecact = strtoupper($_POST['nomsecact']);
        
        
        if(!empty($_POST['nomzo']) ){
           //VERIFCATION PRESENCE
            
            $reqnomzo=$conn->prepare("SELECT * from secteuract where nomsecact = ?");
            $reqnomzo->execute(array($_POST['nomsecact']));
            $nbrenomzo = $reqnomzo->rowCount();
            if($nbrenomzo==0){
                
                $stmt = $conn->prepare("INSERT INTO secteuract (nomsecact) values (:nomsecact)");
                $stmt->bindParam(':nomsecact', $nomsecact);
                
                
                        // insert another row
                @$nomzo = strtoupper($_POST['nomsecact']);
               

                $stmt->execute();
                $msg="VSECTEUR D'ACTIVITE A BIEN ETE CREE";
                                @$var="OK";
                               // $_SESSION['autoriser']="util";
                               // $_SESSION['pseudo']= $sm;
                                

            }else{
                $msg="Nom de secteur deja attribue";
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
<title>ENREGISTREMENT D'UN SECTEUR D'ACTIVITE</title>
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
    form .inputs input[type="text"], input[type="password"]{
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
	<form method="POST">
        <h1>ENREGISTREMENT SECTEUR D'ACTIVITE</h1>
       
        <div class="inputs">
        
        <input type="text" name="nomsecact" value= "<?php if(isset($nomsecact)){ echo $nomsecact;}?>" placeholder="Nom de la zone ">
                
            
        </div>
        
        
        <div align="center">
            <button type="submit" name="valider">Valider</button>

        </div>
    </form>
    
   
</body>
</html>
