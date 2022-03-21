<?php
//session_start();
//if($_SESSION['pseudo']=="TEKI"){
    
//}else{
    

    include('connex.php');
    include('menuvers.php');
    $coderecup=$_GET['codecom'];
    /*$req=$conn->query("SELECT * from commercant where codecom='$coderecup'");
    $resultat=$req->fetchAll();
    $i=0;
        foreach($resultat as $lig){
            $i+=1;?> <br><?php
        }
    if($i>0){?>
        <div class="container-fluid" id="cont">
            <table class="table table-hover table-stripped">
                <thead>
                <tr>
                    <th scope="col">CODE</th>
                    <th scope="col">NUM COMPTE</th>
                    <th scope="col">CODE VERSEMENT</th>
                    <th scope="col">DATE</th>
                    <th scope="col">TAXE</th>
                    <th scope="col">MONTANT VERSE</th>
                    <th scope="col">RESTE A PAYER</th>
                    
                    

                </tr>
                </thead><?php
                foreach($reqresult as $lig){?>
                <tbody>
                <tr>
            
                    <td><br><?php echo $lig['codecom']; ?></td>
                    <td><br><?php echo $lig['numcompte']; ?></td>
                    <td><br><?php echo $lig['nomcom']; ?></td>
                    <td><br><?php echo $lig['numcom']; ?></td>
                    <td><br><?php echo $lig['sexecom']; ?></td>
                    <td><img src="<?php echo $lig['photocom'];?>" width="50px" alt="rien"></td>
                    <td><br><?php echo $lig['zonecom']; ?></td>
                    <td><br><?php echo $lig['secactcom']; ?></td>
                    <td id="rest"><br><?php echo $lig['restapay']; ?></td>
                    

                </tr> </tbody>
                <?php
                }?>
               
            </table>
        </div><?php
    }
//}*/
?>

<!-- <!DOCTYPE html> -->
<!DOCTYPE html>
<html>
<head>
<title>RECHERCHE VERSEMENT</title>
<meta charset='utf-8'>
<meta name="viewport" content="width=device-width initial-scale=1.0">
<link rel="stylesheet" href="css/bootstrap.css"/>
</head>
<style>
    img{
        width: 50px;
        height: 50px;
        border-radius: 50px;
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
</style>

<body>
    <?php
    $req=$conn->query("SELECT * from commercant where codecom='$coderecup'");
    $resultat=$req->fetchAll();
    $i=0;
        
    ?>
        <div class="container-fluid" id="cont">
            <table class="table table-hover table-stripped">
                <thead>
                <tr>
                
                    <th scope="col">NUM COMPTE</th>
                    <th scope="col">CODE</th>
                    <th scope="col">NOM ET PRENOM</th>
                    <th scope="col">CONTACT</th>
                    <th scope="col">PHOTO</th>
                    <th scope="col">SEXE</th>
                    <th scope="col">ZONE</th>
                    <th scope="col">SECTEUR ACT</th>
                    <th scope="col">RESTE A PAYER</th>
                    

                </tr>
                </thead><?php
                foreach($resultat as $lig){?>
                <tbody>
                <tr>
            
                    
                    <td><br><?php echo $lig['numcompte']; ?></td>
                    <td><br><?php echo $lig['codecom']; ?></td>
                    <td><br><?php echo $lig['nomcom']; ?></td>
                    <td><br><?php echo $lig['numcom']; ?></td>
                    
                    <td><img src="<?php echo $lig['photocom'];?>" width="50px" alt="rien"></td>
                    <td><br><?php echo $lig['sexecom']; ?></td>
                    <td><br><?php echo $lig['zonecom']; ?></td>
                    <td><br><?php echo $lig['secactcom']; ?></td>
                    <td id="rest"><br><?php echo $lig['restapay']; ?></td>
                    

                </tr> 
                <?php
                }?>
               </tbody>
            </table>
        </div><?php
    

    $req=$conn->query("SELECT * from versement where codecom='$coderecup'");
    $resultat=$req->fetchAll();
    $i=0;
        foreach($resultat as $lig){
            $i+=1;
        }?>
    <h3><?php echo $i." ";?> VERSEMENTS DANS LE COMPTE IMPOTS <?php echo $lig['numcompte'];?></h3>

    <div class="container-fluid" id="cont">
        <table class="table table-hover table-stripped">
            <thead>
            <tr>
                <th scope="col">CODE</th>
                <th scope="col">NUM COMPTE</th>
                <th scope="col">CODE VERSEMENT</th>
                <th scope="col">DATE</th>
                <th scope="col">TAXE</th>
                <th scope="col">MONTANT VERSE</th>
                <th scope="col">RESTE A PAYER</th>
                
                <th scope="col">ACTION</th>

            </tr>
            </thead><?php
    foreach($resultat as $lig){?>
        <tbody>
            <tr>
            
                <td><?php echo $lig['codecom']; ?></td>
                <td><?php echo $lig['numcompte']; ?></td>
                <td><?php echo $lig['codevers']; ?></td>   
                <td><?php echo $lig['datevers']; ?></td>
                <td><?php echo $lig['taxe']; ?></td>
                <td><?php echo $lig['montvers']; ?></td>
                <td id="rest"><?php echo $lig['restapay']; ?></td>
                <td><button type="submit" name="mod" id="mod"><a href="modifvers.php?codevers=<?=$lig['codevers']; ?>">MOD</a></button>
                <button type="submit" name="sup" id="sup"><a href="supvers.php?codevers=<?=$lig['codevers']; ?>" onclick="return confirm('ETES VOUS SUR DE VOULOIR SUPPRIMMER CE VERSEMENT?');">SUP</a></button></td>

            </tr><?php
    }?>
    </tbody>
</table>
</div>
    
<script src="js/bootstrap.js"></script>
</body>
</html>