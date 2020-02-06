<?php
session_start();
 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: welcomeEmployer.php");
    exit;
}
require_once "config.php";





    
    $sql1 = "SELECT * FROM employer WHERE username='".$_SESSION['username']."'";
    $sth = $link->query($sql1);
    $result=mysqli_fetch_array($sth);

    
    $getit = mysqli_query($link,$sql1);
    $row = mysqli_fetch_array($getit);
    echo "<script>console.log('".$row['prezime']."');</script>";
    $idEmployer=$row['idEmployer'];


    $username = $email = $ime = $prezime = $telefon  = $password = $confirm_password = "";
    $username_err = $email_err = $ime_err = $prezime_err = $telefon_err = $password_err = $confirm_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){


 
    if(empty(trim($_POST["username"]))){
        $username_err = "Molimo Vas unesite korisničko ime.";
    } else{
        $sql = "SELECT idEmployee FROM employee WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = trim($_POST["username"]);
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Please sign up.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Error.";
            }
        }
         
        mysqli_stmt_close($stmt);
    }
    if(empty(trim($_POST["email"]))){
        $email_err = "Please fill field.";     
    } else{
        $email = trim($_POST["email"]);
    }
    
    if(empty(trim($_POST["ime"]))){
        $ime_err = "Please fill field.";     
    } else{
        $ime = trim($_POST["ime"]);
    }

    if(empty(trim($_POST["prezime"]))){
        $prezime_err = "Please fill field.";     
    } else{
        $prezime = trim($_POST["prezime"]);
    }

    if(empty(trim($_POST["telefon"]))){
        $telefon_err = "Please fill field.";     
    } else{
        $telefon = trim($_POST["telefon"]);
    }
    
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please fill field.";     
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please fill field.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Error.";
        }
    }
    
    if(empty($username_err) && empty($email_err)  && empty($ime_err) && empty($prezime_err) && empty($telefon_err) && empty($termin_err) && empty($password_err)  && empty($confirm_password_err)){
        
        $sql = "INSERT INTO employee (idEmployer,ime, prezime, email, password, telefon, username) VALUES (?,?,?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            $param_idEmployer=$idEmployer;
            $param_username = $username;
            $param_email = $email;
            $param_ime = $ime;
            $param_prezime= $prezime;
            $param_telefon = $telefon;
            

            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            mysqli_stmt_bind_param($stmt, "sssssss",$param_idEmployer, $param_ime, $param_prezime, $param_email, $param_password, $param_telefon,  $param_username);
            
            if(mysqli_stmt_execute($stmt)){
                header("location: welcomeEmployer.php");
            } else{
                echo "Greška! Molimo Vas pokušajte ponovo.";
            }
        }
         
        mysqli_stmt_close($stmt);
    }
    
    mysqli_close($link);
}


?>

<!doctype html>
<html lang="en">
  <head>
    <title>Nitro &mdash; Website Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
    
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  

  <div id="overlayer"></div>
  <div class="loader">
    <div class="spinner-border text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>


  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
   
    
    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

      <div class="container">
        <div class="row align-items-center">
          
          <div class="col-6 col-xl-2">
            <h1 class="mb-0 site-logo"><a href="index.html" class="h2 mb-0">Nitro<span class="text-primary">.</span> </a></h1>
          </div>

          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li><a href="index.html" class="nav-link">Home</a></li>
                <li><a href="logout.php" class="nav-link">Sign out</a></li>
                <li><a href="logout.html" class="nav-link">Add employee</a></li>

                
              </ul>
            </nav>
          </div>


          <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3"></span></a></div>

        </div>
      </div>
      
    </header>

  
     
    <div class="site-blocks-cover overlay" style="background-image: url(images/hero_2.jpg);" data-aos="fade" id="home-section">

      <div class="container">
        <div class="row align-items-center justify-content-center">

          
          <div class="col-md-8 mt-lg-5 text-center">
            <h1 class="text-uppercase" data-aos="fade-up">Welcome</h1>
            <p class="mb-5 desc"  data-aos="fade-up" data-aos-delay="100">Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio soluta eius error.</p>
           
          </div>
            
        </div>
      </div>

      <a href="#about-section" class="mouse smoothscroll">
        <span class="mouse-icon">
          <span class="mouse-wheel"></span>
        </span>
      </a>
    </div>  
              <br>
              <div id="register" style="width: 600px; margin-left: 50px;">
                         <h2>Insert new employee</h2>
                    
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                            <label>Username</label>
                            <br>
                            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                            <span class="help-block"><?php echo $username_err; ?></span>
                        </div>   

                     
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>E mail </label>
                             <br>
                            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $email_err; ?></span>
                        </div>  
                        <div class="form-group <?php echo (!empty($ime_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                             <br>
                            <input type="text" name="ime" class="form-control" value="<?php echo $ime; ?>">
                            <span class="help-block"><?php echo $ime_err; ?></span>
                        </div>  
                        <div class="form-group <?php echo (!empty($prezime_err)) ? 'has-error' : ''; ?>">
                            <label>Surname</label>
                             <br>
                            <input type="text" name="prezime" class="form-control" value="<?php echo $prezime; ?>">
                            <span class="help-block"><?php echo $prezime_err; ?></span>
                        </div>  
                        <div class="form-group <?php echo (!empty($telefon_err)) ? 'has-error' : ''; ?>">
                            <label>Phone</label>
                             <br>
                            <input type="text" name="telefon" class="form-control" value="<?php echo $telefon; ?>">
                            <span class="help-block"><?php echo $telefon_err; ?></span>
                        </div>
                         
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label>Pssword</label>
                             <br>
                            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                            <span class="help-block"><?php echo $password_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                            <label>Confirm password</label>
                             <br>
                            <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                            <span class="help-block"><?php echo $confirm_password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Add">
                            
                        </div>
                       
                    </form>
                   </div>

   
    
    <footer class="site-footer">
      <div class="container">
        
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
              <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="#" target="_blank" >Fonovci</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
        
            </div>
          </div>
          
        </div>
      </div>
    </footer>

  </div> <!-- .site-wrap -->

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/isotope.pkgd.min.js"></script>

  <script>
    function myFunction() {
     
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");

    
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[3];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
    </script>
  <script src="js/main.js"></script>
    
  </body>
</html>