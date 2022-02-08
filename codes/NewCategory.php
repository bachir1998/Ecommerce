<?php
	session_start();
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <title>Site commercial </title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/navbar-static/">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/checkout/">
   
    <!-- Bootstrap core CSS -->
   <link href="../css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../css/auth.css"/>
   <script src="../css/jquery-3.4.1.min.js"></script>
   <script src="../css/bootstrap.js"></script>


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="../css/navbar-top.css" rel="stylesheet">
    <link href="../css/footer.css" rel="stylesheet">
  </head>
  <body>
    
      <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">E-Commerce</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
            
            </ul>
            <form class="d-flex">
              <ul class="navbar-nav me-auto mb-2 mb-md-0">
                  <li class="nav-item">
                      <a class="nav-link active link" aria-current="page" href="accueil.php">Accueil</a>
                  </li>

                  <li class="nav-item">
                    <a  class="nav-link  link"  href="#">A Propos</a>
                  </li>

                <li class="nav-item">
                  <a  class="nav-link  link float"  href="#">Contacts</a>
                </li>

                <div class="dropdown">
                  <button style="margin-right:65px;" class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    S'Inscrire
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li class="dropdown-header">En tant que :</li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="InscriptionCommercant.php">Commercant</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="InscriptionClient.php">Client</a></li>
                  </ul>
                </div>
                
                <div class="dropdown">
                  <button style="margin-right:65px;" class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Se connecter
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li class="dropdown-header">En tant que :</li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="LoginCommercant.php">Commercant</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="LoginClient.php">Client</a></li>
                  </ul>
                </div>
                
                  
              </ul>
        
          </form>
          </div>
        </div>
      </nav>

      <main class="container">
          
          <div class="row">
            
              <div class='design col-lg-10' style=' margin-left : 0%;'> 
                <form method='post' action='NewCategory.php' class=" formul col-lg-5 login-form" style='box-shadow : 0px 2px 3px black'>
                  <fieldset>
                    <legend style='font-weight : bold; font-size : 30px;'>Add Category Name</legend>
                    <div class="yes"   style='color : green; font-size: 20px; display : none'>Catégorie ajoutée</div>
                    <div class="err" style='color : red; font-size: 20px; display : none'>Erreur lors de l'ajout, réessayez</div>
                    <div class="errnull" style='color : red; font-size: 20px; display : none'>Veuillez renseignez le nom de la catégorie</div>
                    <div class="alert" style='color : orange; font-size: 20px; display : none'>Vous avez déjà ajouté une catégorie qui porte ce nom</div>
                    
                    <input  class='form-control' required type="text" name="categoryname" placeholder='Renseignez un nom de caatégorie parlant...'/><br/>
                    <br/><br/>
                    <input   class='sub form-control btn btn-primary' type='submit' value='Ajouter' />
                  </fieldset>
                 </form>
              </div>

            <?php

                if(isset($_POST['categoryname'])){
                  $email = $_SESSION['email'];
                  $categoryname = $_POST['categoryname'];
                
                    $dsn = 'mysql:host=localhost;dbname=ecommerce';
                    $bdd= new PDO($dsn, 'root', '');	
                    
                    $verify = false;
                    $requete = "select * from category";
                    $res = $bdd -> query($requete);
                    
                    $ligne = $res -> fetch();
                    while($ligne)
                    {
                        if(($email == $ligne['email']) and ($categoryname == $ligne['categoryname']))
                        {
                            $verify = true;
                            break;
                        }
                        else
                            $ligne = $res -> fetch();
                    }

                    if($verify == true)
                    {
                        echo "<script>
                        $('.alert').slideDown('slow');
                        </script>";
                        
                    }
                    else
                    {
                       
                            $req = "insert into category (categoryname,email)
                                    values ('$categoryname','$email')";

                            $stmt=$bdd->prepare($req);
                            if(!empty($categoryname))
                            {
                                $stmt->bindParam(':categoryname', $categoryname);
                                $stmt->bindParam(':email', $email);
                                if($stmt->execute())
                                {
                                    echo "<script>
                                    $('.yes').slideDown('slow');
                                   </script>";
                                
                                }

                                else
                                {
                                    echo "<script>
                                    $('.err').slideDown('slow');
                                   </script>";
                                }
                            }
                            else
                            {
                                echo "<script>
                                $('.errnull').slideDown('slow');
                               </script>";
                              
                               
                            }
                        
                    }


                }
                    
            ?>
            <script type="text/javascript">
                    
                    $(".txtb input").on("focus",function()
                    {
                        $(this).addClass("focus"); 
                    });

                    $(".txtb input").on("blur",function()
                    {
                        if($(this).val() == "")
                        $(this).removeClass("focus"); 
                    });


                    </script>


            <script>

            $(".design ").hide(0,'linear')

            $(".design").slideDown(3000,'linear');
              

              
            </script>



          </div>
        
      </main>

      <!-- FOOTER -->
      <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
      <footer style="margin-top: 15%;" id="footer" class="foot">
        <div class="footer-top  footer-default">
          <br/>
            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-4 col-md-6 footer-info"> 
                        <h3 style="animation: flash 1.4s linear infinite;margin-top:2%;letter-spacing:5px;">FASTISOFT</h3>
                      
                    </div>
                  
                    <div style= "margin-top:10px" class="col-lg-2 col-md-6 footer-links">
                        <h4> Liens utiles <h4>
                            <ul>
                                <li><a href="#">Link</a></li>
                                <li><a href="#">Link</a></li>
                                <li><a href="#">Link</a></li>
                                <li><a href="#">Link</a></li>
                                <li><a href="#">Link</a></li>
                            </ul>
                    </div>
              
                    <div style= "margin-top:10px" class="col-lg-3 col-md-6 footer-contact"> 
                        <h4> Contactez-nous</h4>
                        <p>
                            Bambilor   Rue:6 <br/>
                            Bambilor,  Dakar<br/>
                            Sénégal<br/>
                            <strong>Téléphone:</strong>+221 78 140 12 17<br/> 
                            <strong>Em@il:</strong>BabacarNdong@gmail.com<br/>
                        </p>
            
                        <div class="social-links">
                            <a href="#" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#" class="twitter"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="twitter"><i class="fa fa-instagram"></i></a> 
                            <a href="#" class="twitter"><i class="fa fa-google-plus"></i></a>
                            <a href="#" class="twitter"><i class="fa fa-linkedin"></i></a>      
                        </div> 
                    </div>  

                    <div style= "margin-top:10px" class="col-lg-3 col-md-6 footer-newsletter">
                        <h4>Our Nemsletter</h4>
                        <p> ________ ________ ________ ________ _________
                        ________  _______ _________  _______  _______
                        ________ _________ ___________</p>
                        <form accept="" mthod="post">
                            <input type="email"  name="email"/><input type="submit" value="s'abonner"/>
                        </form>
                    </div>
        
                </div>
            </div>
        </div>
      
        <div class="container">
            <div class="copyright">
                &copy; Copyright<strong>WebsiteName</strong>. Tout Droits Reservés
            </div>
            <div class="credits">
                Designed by <a href="#">WebsiteName</a>
            </div>
        </div>
      </footer>

      <script src="../css/bootstrap.bundle.min.js"></script>



      
  </body>
</html>
