<?php
 

    include('connex.php');
    include('menuvers.php');
    $coderecup=$_GET['codevers'];

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
        
        //RECUPERATION DES INFO DU VERSE?ENT
        $req=$conn->prepare("SELECT * from versement where codevers=?");
        $req->execute(array($coderecup));
        $resultvers=$req->fetch();
        
        //AFFICHE LES INFO DU VERSEMENT
        $numcompte=$resultvers['numcompte'];
        $datevers=$resultvers['datevers'];
        $taxe=$resultvers['taxe'];
        $montvers=$resultvers['montvers'];
        $codevers=$resultvers['codevers'];
        $restapayI=$resultvers['restapay'];
        $codecom=$resultvers['codecom'];
        
        if(isset($_POST['valider'])){
            if(is_numeric($_POST['taxe']) AND is_numeric($_POST['taxe'])){
                @$datevers = $_POST['datevers'];
                @$taxe= $_POST['taxe'];
                    
                    
                @$montvers = $_POST['montvers'];
                $restapay=intval($taxe)-intval($montvers);
                $req=$conn->prepare("UPDATE versement set datevers=?, taxe=?, montvers=?, restapay=? where codevers=? ");
                $req->execute(array($datevers, $taxe, $montvers, $restapay, $codevers));
                $msg="MODIFICATIONS ENREGISTREES";
                
                //RECHERCHE DU COM POUR RECTIFIER SON RESTAPAY
                $restapayF=intval($restapayI)-intval($restapay);
                $reqr="SELECT * from commercant where codecom='$codecom'";
                $resulr=$conn->query($reqr);
                $resultr=$resulr->fetch();
                $restapayrecup=$resultr['restapay'];
                $restapay0=intval($restapayrecup)-intval($restapayF);
                $reqcom=$conn->prepare("UPDATE commercant set restapay=? where codecom=? ");
                $reqcom->execute(array($restapay0, $codecom));
                
            }else{
                $msg="Les montants doivent comporter que des chiffres";
            }
            
        }

        
    
    }
    

?>

<!DOCTYPE html>
<html>
<head>
<title>RECHERCHE VERSEMENT</title>
<meta charset='utf-8'>
<meta name="viewport" content="width=device-width initial-scale=1.0">
<link rel="stylesheet" href="css/bootstrap.css"/>
</head>
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
        <h1>MODIFICATION VERSEMENT</h1>
       
        <div class="inputs">
        
        <input type="text" name="numcompte" value= "<?php echo $numcompte;?>" disabled >
        <input type="date" name="datevers" value= "<?php echo $datevers;?>" placeholder="Date du versement ">
        <input type="text" name="taxe" value= "<?php echo $taxe;?>" placeholder="Montant de la taxe">
        <input type="text" name="montvers" value= "<?php echo $montvers;?>"  placeholder="Montant verse">
        
        </div>
        
        
        <div align="center">
            <button type="submit" name="valider">Valider</button>

        </div>
    </form>
    
    <script src="js/bootstrap.js"></script>

</body>
</html>