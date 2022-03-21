<?php
 

    include('connex.php');
    include('menuvers.php');
    $coderecup=$_GET['codevers'];
    echo $coderecup;


    //RECHERCHE DU NUMERO DE COMPTE AVANT SUPPRESSION DU VERSEMENT POUR AFFICHAGE
    $req="SELECT * from versement where codevers = '$coderecup'";
    $result = $conn->query($req);
    $ligne = $result->fetch();
    $numcompterecup=$ligne['numcompte'];
    echo $numcompterecup;
    
    //$numcompterecup=$ligne['numcompte'];
    //echo $ligne['numcompte'];
    //$req=$conn->prepare("SELECT numcompte from versement where codevers=?");
    //$req->execute(array($coderecup));

    /*$req="SELECT * from versement where codevers = $coderecup ";
    $res=$conn->query($req);
    $resu=$res->fetch();
    echo $resu['numcompte'];*/
    
    if(isset($coderecup)){

        $req=$conn->prepare("DELETE from versement where codevers=?");
        $req->execute(array($coderecup));
        $msg="VERSEMENT ".$coderecup." SUPPRIME";
    }


?>

<!DOCTYPE html>
<html>
<head>
<title>RECHERCHE VERSEMENT</title>
<meta charset='utf-8'>
<meta name="viewport" content="width=device-width initial-scale=1.0">
<link rel="stylesheet" href="css/bootstrap.css"/>

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
    span{
        color: greenyellow;
    }

</style>

</head>




<body>
    
    <h3>
    <?php 
        if(isset($msg)){
            $msg="VERSEMENT ".$coderecup." SUPPRIME";
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
    <?php 
        $coderecup=$_GET['codevers'];

        $req2 = "SELECT * from versement where numcompte='$numcompterecup'";
        $result2 = $conn->query($req2);
        $ligne2 = $result2->fetchAll();?>
        <div class="container-fluid" id="cont"> 
            <table class="table table-hover table-stripped">
            <thead>
                <tr>
                    
                    <th scope="col">NUM COMPTE</th>
                    <th scope="col">CODE VERS</th>
                    <th scope="col">DATE</th>
                    <th scope="col">TAXE</th>
                    <th scope="col">VERSEMENT</th>
                    <th scope="col">RESTE A PAYER</th>
                    
                    
                    
                </tr>
            </thead> <?php
            foreach($ligne2 as $lig2) { ?>
                <tr>
                
                    
                    <td><?php echo $lig2['numcompte']; ?></td>
                    <td><?php echo $lig2['codevers']; ?></td>
                    <td><?php echo $lig2['datevers']; ?></td>
                    
                    <td><?php echo $lig2['taxe']; ?></td>
                    <td><?php echo $lig2['montvers']; ?></td>
                    <td id="rest"><?php echo $lig2['restapay']; ?></td>
                    
                    

                </tr>
            <?php
            }?>
            </table>
        </div>

        <script src="js/bootstrap.js"></script>
   
</body>
</html>