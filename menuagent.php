<?php
    session_start();
    if($_SESSION['pseudo']=="util"){
        
    }else{
        header("location:connex_agent.php");
    }

?>






<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MENU BOOTSTRAP</title>
    <link rel="stylesheet" href="css/bootstrap.css"/>

    <style>
        body{
            background-image: url(collecte.jpg);
            background-size: 50% 50%;
            background-repeat: repeat;
        }
        .container-fluid{
            background-color: #0d6efd;
            color: white;
            font-weight: bold;
        }
        .nav-item{
            color: white;
        }
        #navbardropdown, .btn, #btn{
            color: white;
            width: 220px;
            text-align: center;
        }
        .btn:hover{
            color: red;
        }
        #navbardropdown:hover{
            background-color: black;
            color: yellow;
        }
        a.navbar-brand{
            height: 65px;
            padding-top: 0.2rem;
            
        }
       
    </style>
    
</head>
<body background="photo.jpg">
<header class="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="logo.jpg" width="50px" alt="logo"/></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active"  href="menuag1.php" id="navbarDropdown">MENU PRINCIPAL</a>
                        </li>
                        
                        <li class="nav-item ">
                            <a class="nav-link" href="agent.php" id="navbarDropdown" >
                NOUVEAU AGENT</a>
                            
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="listeagent.php" id="navbarDropdown" >
                LISTE AGENT</a>
                            
                        </li>
                        
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <button class="btn" id="btn"><a id="btn" href="deconnexion.php">DECONNEXION</a></button>
                    </ul>

                </div>
            </div>
        </nav>
    </header>








    <script src="js/bootstrap.js"></script>
</body>
</html>