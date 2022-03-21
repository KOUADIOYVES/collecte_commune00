<?php
session_start();
include("menuag1.php");


@$servername = "localhost";
@$username = "root";
@$password = "";
@$dbname = "collecte00";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //VERIFICATION

    if(isset($_POST['valider']))
    {
       
        $pu = htmlspecialchars($_POST['pseudoag']);
        $mu = sha1($_POST['mdpag']);
        
       

        if(!empty($_POST['pseudoag']) AND !empty($_POST['mdpag'])){
            $pu = $_POST['pseudoag'];
            $mu = $_POST['mdpag'];
            $requtil=$conn->prepare("SELECT * from agent where pseudoag = ? AND mdpag = ?");
            $requtil->execute(array($_POST['pseudoag'],$_POST['mdpag']));
            $nbreutil=$requtil->rowCount();
            if($nbreutil>0){
               $msg="BIENVENU";
               $_SESSION['pseudo']="util";
               //$_SESSION['pseudo']=$pu;
               header("location: menuag1.php");
            }else{
               $msg="MAUVAIS PSEUDO OU MOT DE PASSE";
            }
            //echo $_SESSION['idutil'];
            //header(location);
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
<title>ACCUEIL</title>
<meta charset='utf-8'>
<meta name="viewport" content="width=device-width initial-scale=1.0">

<style>
    
    form{
        display : flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        margin-top: 5px;
        background-color: #fff;
        padding: 40px 60px;
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
    form .inputs input[type="text"], input[type="date"] , input[type="password"]{
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
        padding: 15px 25px;
        border: none;
        border-radius: 10px;
        font-size: 20px;
        color: #fff;
        background-color: #eb7371;
        cursor: pointer;
        outline: none;
        font-weight: bold;
        
    }
    h3{
        background-color: red;
        color: white;
        text-align: center;
    }
    form a{
        text-align: center;
        margin-bottom: 40px;
    }
</style>

</head>




<body>
	<form method="POST">
        <h1>CONNEXION AGENT</h1>
       
        <div class="inputs">
        
        
        <input type="text" name="pseudoag" value= "<?php if(isset($pu)){ echo $pu;}?>"  placeholder="pseudo">
        <input type="password" name="mdpag" placeholder="Mot de passe">
       
            
        </div>
        
        
        <div align="center">
            <button type="submit" name="valider">Valider</button>

        </div>
    </form>
    <?php 
        if(isset($msg)){?>
        <h3><?php echo @$msg;?></h3><?php
        }
        
    ?>
   
</body>
</html>
