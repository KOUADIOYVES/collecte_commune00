<?php
 session_start();
 if($_SESSION['pseudo']=="util"){
     
 }else{
     header("location:connex_agent.php");
 }

    include('connex.php');
    include('menuag.php');
    $coderecup=$_GET['codecom'];

    $req = "SELECT * from zonee";
    $result = $conn->query($req);
    $ligne = $result->fetchAll();

    $req1 = "SELECT * from agent";
    $result1 = $conn->query($req1);
    $ligne1 = $result1->fetchAll();

    if(isset($coderecup)){
        
        //RECUPERATION DES INFO DU COM
        $req=$conn->prepare("SELECT * from commercant where codecom=?");
        $req->execute(array($coderecup));
        $resultcom=$req->fetch();
        
        //AFFICHE LES INFO DU COM
        $codecom=$resultcom['codecom'];
        $nomcom=$resultcom['nomcom'];
        $numcom=$resultcom['numcom'];
        $melcom=$resultcom['melcom'];
        $sexecom=$resultcom['sexecom'];
        $zonecom=$resultcom['zonecom']; 
        $secactcom=$resultcom['secactcom']; 
        $codeag=$resultcom['codeag'];
        $restapay=$resultcom['restapay'];
        
        if(isset($_POST['valider'])){
            if(is_numeric($_POST['numcom'])){
                if(filter_var($_POST['melcom'], FILTER_VALIDATE_EMAIL)){
                    @$nomcom = strtoupper($_POST['nomcom']);
                    @$numcom= $_POST['numcom'];
                    @$melcom = strtoupper($_POST['melcom']);
                    @$sexecom= $_POST['sexecom'];
                    @$zonecom = $_POST['zonecom'];
                    @$secactcom= $_POST['secactcom'];
                    @$codeag = $_POST['codeag'];
                    $req=$conn->prepare("UPDATE commercant set nomcom=?, numcom=?, melcom=?, sexecom=?, zonecom=?,
                        secactcom=?, codeag=? where codecom=? ");
                    $req->execute(array($nomcom, $numcom, $melcom, $sexecom, $zonecom, $secactcom, $codeag, $codecom));
                    $msg="MODIFICATIONS ENREGISTREES";
                }else{
                    $msg="Email incorrect";
                }
            }else{
                $msg="Le contact doit comporter que des chiffres";
            }
            
        }

        
    }else{
        $msg="COMMERCANT INEXISTANT";
    }
    

?>

<!DOCTYPE html>
<html>
<head>
<title>MODIFICATION D'UN COMMERCANT</title>
<meta charset='utf-8'>
<meta name="viewport" content="width=device-width initial-scale=1.0">

<style>
    body{
       
        background-color: #f5f5f5;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }
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
        width: 150px;
        height: 40px;
        text-align: center;
    }
    h3{
        background-color: red;
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
        <h1>MODIFICATION COMMERCANT</h1>
       
        <div class="inputs">
        
        
        <input type="text" name="nomcom" value= "<?php echo $nomcom;?>" placeholder="Nom et Prenom du commercant ">
        <input type="text" name="numcom" value= "<?php echo $numcom;?>" placeholder="Contact du commercant">
        <input type="mail" name="melcom" value= "<?php echo $melcom;?>"  placeholder="Email du commercant">
        <select name="sexecom">
            <option value="<?php echo $sexecom;?>"><?php echo $sexecom;?></option>
            <option value="M">M</option>
            <option value="F">F</option>
        </select>
        <select name="zonecom">
       
            <option value="<?php echo $zonecom;?>"><?php echo $zonecom;?></option>
            
                <?php foreach($ligne as $lig){?>
                <option value="<?= $lig['nomzo']; ?>"><?= $lig['nomzo']; ?></option>
                <?php } ?>
        </select>
        <select name="secactcom">
       
            <option value="<?php echo $secactcom;?>"><?php echo $secactcom;?></option>
            
                <?php foreach($ligne as $lig){?>
                <option value="<?= $lig['nomzo']; ?>"><?= $lig['nomzo']; ?></option>
                <?php } ?>
        </select>
        <select name="codeag">
       
            <option value="<?php echo $codeag;?>"><?php echo $codeag;?></option>
            
                <?php foreach($ligne1 as $lig1){?>
                <option value="<?= $lig1['nomag']; ?>"><?= $lig1['nomag']; ?></option>
                <?php } ?>
        </select>

            
        </div>
        
        
        <div align="center">
            <button type="submit" name="valider">Valider</button>

        </div>
    </form>
    
   
</body>
</html>