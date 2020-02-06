<?php
session_start();
 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: employer.php");
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
    $idEmployee=$_REQUEST['idEmployee'];


    $datumM=$nazivM= "";
    $datumM_err =$nazivM_err= "";
    
 

if(isset($_POST['save']))
{    
     $datumM = $_POST['datumM'];
     $nazivM = $_POST['nazivM'];
     $timeM=$_POST['timeM'];
     $sqlupit1="SELECT * FROM tipm WHERE nazivM='$nazivM'";
    $result1 = mysqli_query($link,$sqlupit1);
    $row1 = mysqli_fetch_array($result1);
    $idTipM=$row1['idTipM'];
     
     $sql = "INSERT INTO meeting (idEmployer,idEmployee,datumM,idTipM, azuriran,timeM) VALUES ('$idEmployer','$idEmployee','$datumM','$idTipM','ne','$timeM')";
     if (mysqli_query($link, $sql)) {
        header("Location: welcomeEmployer.php"); 
     } else {
        echo "Greška!
" . mysqli_error($link);
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
                <li><a href="addEmployee.php" class="nav-link">Add employee</a></li>

                
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
              <div id="register" style="margin-left: 50px;">
                         <h2>New meeting</h2>
                   
                   <form method="post" >
                             <div>
                              <br>
                            <label>Meeting</label>
                            <br>

                            <select name="nazivM">
                              <option value="Group meeting">Group meeting</option>
                              <option value="Individual meeting">Individual meeting</option>
                              <option value="Team Building">Team Building</option>

                              <option value="End of the month">End of the month</option>
                              <option value="End of the year">End of the year</option>
                              <option value="End of the week">End of the week</option>

                             
                              

                            </select>
                            <input style="-webkit-border-radius: 200px;
border-radius: 200px;" type="hidden" name="selected_text" id="selected_text" value="" />
    
                        </div> 
                        <br>  
                        Date:<br
                        <br>
                        <input type="date" name="datumM">
                        <br>
                        
                        <label>Time</label>
                        <br>

                            <select name="timeM">
                              <option value="8:30">8:30</option>
                              <option value="9:00">9:00</option>
                              <option value="9:30">9:30</option>

                              <option value="10:00">10:00</option>
                              <option value="11:30">11:30</option>
                              <option value="12:00">12:00</option>
                              <option value="12:30">12:30</option>
                              <option value="12:00">13:00</option>
                              <option value="12:30">13:30</option>
                              <option value="12:00">14:00</option>
                              <option value="12:30">14:30</option>
                              <option value="12:00">16:00</option>
                              <option value="12:30">16:30</option>
                              <option value="12:00">17:00</option>
                              <option value="12:30">17:30</option>

                             
                              

                            </select>
                            <input type="hidden" name="selected_text" id="selected_text" value="" />
                            <br>
                        <input type="submit" style="-webkit-border-radius: 200px;
border-radius: 200px; background-color: #007bff; color: white;" name="save" value="Add">
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