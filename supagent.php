<?php
 
    include('connex.php');
    include('menuagent.php');
    $coderecup=$_GET['codeag'];

    if(isset($coderecup)){
        
        
        
        $req=$conn->prepare("DELETE from agent where codeag=?");
        $req->execute(array($coderecup));
        //$ok="OK";
        @$msg="COMMERCANT ".$coderecup." SUPPRIME";

        
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
     
    
    <div class="container-fluid">
        <?php
        $req2 = "SELECT codeag, nomag, numag, sexeag, zoneag,  photoag from agent";
        $result2 = $conn->query($req2);
        $ligne2 = $result2->fetchAll();?>
            
            <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col">CODE</th>
                    
                    <th scope="col">NOM ET PRENOM</th>
                    <th scope="col">CONTACT</th>
                    
                    <th scope="col">SEXE</th>
                    <th scope="col">ZONE</th>
                    <th scope="col">PHOTO</th>
                </tr>
            </thead> <?php
            foreach($ligne2 as $lig2) { ?>
                <tr>
                
                    <td><?php echo $lig2['codeag']; ?></td>
                    
                    <td><?php echo $lig2['nomcom']; ?></td>
                    <td><?php echo $lig2['numag']; ?></td>
                    <td><?php echo $lig2['sexecom']; ?></td>
                    <td><?php echo $lig2['zonecom']; ?></td>
                    <td><img src="<?php echo $lig2['photocom'];?>" width="50px" alt="rien"></td>
                   
                    
                    

                </tr>
            <?php
            }?>
            </table>
            
    
   
</body>
</html>