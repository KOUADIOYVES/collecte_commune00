<?php
 
    include('connex.php');
    include('menuag.php');
    $coderecup=$_GET['codecom'];

    
    if(isset($coderecup)){

        $req=$conn->prepare("DELETE from commercant where codecom=?");
        $req->execute(array($coderecup));
        }      


?>

<!DOCTYPE html>
<html>
<head>
<title>SUPPRESSION D'UN COMMERCANT</title>
<meta charset='utf-8'>
<meta name="viewport" content="width=device-width initial-scale=1.0">

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
    #search{
        width: 300px;
        margin-left: 40px;
        margin-top: 90px;
        height: 40px;
        box-shadow: 0 10px 10px rgba(0,0,255,0.15);
        border-radius: 15px;
    }
    div.confirme{
        width: 300px;
        margin: 100px auto;
        display: flex;
        flex-direction: row;
        height: 40px;
        box-shadow: 0 10px 10px rgba(0,0,255,0.15);
        border-radius: 15px;
        background-color: blue;
        color: white;
        font-weight: bold;
        border: 1px solid white;
        cursor: pointer;
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
    <?php 
        $req2 = "SELECT * from commercant";
        $result2 = $conn->query($req2);
        $ligne2 = $result2->fetchAll();?>
        <table>
        <thead>
            <tr>
                <th scope="col">CODE</th>
                <th scope="col">NUM COMPTE</th>
                <th scope="col">NOM ET PRENOM</th>
                <th scope="col">CONTACT</th>
                
                <th scope="col">SEXE</th>
                <th scope="col">ZONE</th>
                <th scope="col">SECTEUR ACT</th>
                <th scope="col">RESTE A PAYER</th>
                <th scope="col">ACTION</th>

            </tr>
        </thead> <?php
        foreach($ligne2 as $lig2) { ?>
            <tr>
            
                <td><?php echo $lig2['codecom']; ?></td>
                <td><?php echo $lig2['numcompte']; ?></td>
                <td><?php echo $lig2['nomcom']; ?></td>
                <td><?php echo $lig2['numcom']; ?></td>
                
                <td><?php echo $lig2['sexecom']; ?></td>
                <td><?php echo $lig2['zonecom']; ?></td>
                <td><?php echo $lig2['secactcom']; ?></td>
                <td><?php echo $lig2['restapay']; ?></td>
                <td><button type="submit" name="mod" id="mod"><a href="modifcom.php?codecom=<?=$lig2['codecom']; ?>">MODIF</a></button>
                    <button type="submit" name="sup" id="sup"><a href="supcom1.php?codecom=<?=$lig2['codecom']; ?>">SUPP</a></button></td>


            </tr>
        <?php
        }?>
        </table>
        ?>
    
   
</body>
</html>