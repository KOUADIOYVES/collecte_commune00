<?php
 
    include('connex.php');
    include('menuagent.php');
    $coderecup=$_GET['codeag'];

    $req = "SELECT * from zonee";
    $result = $conn->query($req);
    $ligne = $result->fetchAll();

    $req1 = "SELECT * from agent";
    $result1 = $conn->query($req1);
    $ligne1 = $result1->fetchAll();

    $req2 = "SELECT * from secteuract";
    $result2 = $conn->query($req2);
    $ligne2 = $result2->fetchAll();


    if(isset($coderecup)){
        
        //RECUPERATION DES INFO DU COM
        $req=$conn->prepare("SELECT * from agent where codeag=?");
        $req->execute(array($coderecup));
        $resultcom=$req->fetch();
        
        //AFFICHE LES INFO DU COM
        $codeag=$resultcom['codeag'];
        $nomag=$resultcom['nomag'];
        $numag=$resultcom['numag'];
        $melag=$resultcom['melag'];
        $sexeag=$resultcom['sexeag'];
        $zoneag=$resultcom['zoneag']; 
        
        
        if(isset($_POST['valider'])){
            if(is_numeric($_POST['numag'])){
                if(filter_var($_POST['melag'], FILTER_VALIDATE_EMAIL)){
                    @$nomag = strtoupper($_POST['nomag']);
                    @$numag= $_POST['numag'];
                    @$melag = strtoupper($_POST['melag']);
                    @$sexeag= $_POST['sexeag'];
                    @$zoneag = $_POST['zoneag'];
                    
                    $req=$conn->prepare("UPDATE agent set nomag=?, numag=?, melag=?, sexeag=?, zoneag=?
                     where codeag=? ");
                    $req->execute(array($nomag, $numag, $melag, $sexeag, $zoneag));
                    $msg="MODIFICATIONS ENREGISTREES";
                    @$ok="OK";
                }else{
                    $msg="Email incorrect";
                }
            }else{
                $msg="Le contact doit comporter que des chiffres";
            }
            
        }

        
    }else{
        $msg="AGENT INEXISTANT";
    }
    if(isset($_POST['liste'])){
        header("location:menuagent.php");
    }

?>

<!DOCTYPE html>
<html>
<head>
<title>MODIFICATION D'UN AGENT</title>
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
    form .inputs input[type="text"], input[type="mail"], select{
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
        width: 300px;
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
    #liste{
        background-color: green;
        width: 300px;
    }
    form{
       
        background-color: red;
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
    
	<form method="POST">
        <h1>MODIFICATION AGENT</h1>
       
        <div class="inputs">
        
        
        <input type="text" name="nomag" value= "<?php echo $nomag;?>" placeholder="Nom et Prenom de l'agent ">
        <input type="text" name="numag" value= "<?php echo $numag;?>" placeholder="Contact de l'agent">
        <input type="mail" name="melag" value= "<?php echo $melag;?>"  placeholder="Email de l'agent">
        <select name="sexecom">
            <option value="<?php echo $sexeag;?>"><?php echo $sexeag;?></option>
            <option value="M">M</option>
            <option value="F">F</option>
        </select>
        <select name="zoneag">
       
            <option value="<?php echo $zoneag;?>"><?php echo $zoneag;?></option>
            
                <?php foreach($ligne as $lig){?>
                <option value="<?= $lig['nomzo']; ?>"><?= $lig['nomzo']; ?></option>
                <?php } ?>
        </select>
        
            
        </div>
        
        <?php 
        if(@$ok!="OK"){?>
            <div align="center">
                <button type="submit" name="valider">Valider</button>

            </div><?php
        }else{?>
            <div align="center">
                <button class="btn btn-primary" id= "liste" type="submit" name="liste">LISTE COMMERCANT</button>

            </div><?php    
        }?>
    </form>
    
    <script src="js/bootstrap.js"></script>
</body>
</html>