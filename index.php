<?php
/*
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "saurabhdawaredb";
*/

$servername = "sql209.epizy.com";
$username = "epiz_21145490";
$password = "saurabhdawarecf";
$dbname = "epiz_21145490_saurabhdawaredb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// 4572726187 .cf
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-110471991-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-110471991-1');
</script>
  <meta charset="utf-8">
  <title>SketchOver</title>
  <!--OG meta tags-->
  <meta name="og:title" content="SketchOver"/>
  <meta name="og:type" content="webapp"/>
  <meta name="og:url" content="http://www.saurabhdaware.cf/webapps/SketchOver/"/>
  <meta name="og:image" content="http://res.cloudinary.com/saurabhdaware/image/upload/q_72/v1513185751/saurabhdawaretk/SketchOverLogo.png"/>
  <meta name="og:site_name" content="SketchOver"/>
  <meta name="og:description" content="A web-application where you can draw or write whatever you want"/>
  <meta name="og:email" content="me@saurabhdaware.cf"/>
  <!---->
  <meta name="keywords" content="SketchOver, Sketch, Over, webapplication, webapps, Sketchpad, Saurabh, Daware, Saurabh Daware, Website, PWA, Progressive Web Applications, Progressive Web Apps"/>
  <meta name="description" content="SketchOver is a web-application where you can draw or write whatever you want">
  <meta name="url" content="http://www.saurabhdaware.cf/webapps/SketchOver/">
  <meta name="author" content="Saurabh, me@saurabhdaware.cf">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="manifest" href="manifest.json">
  <link rel="icon" sizes="192x192" href="http://res.cloudinary.com/saurabhdaware/image/upload/q_72/v1513185751/saurabhdawaretk/SketchOverLogo.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <meta name="theme-color" content="#09f">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    html,body{height:100%;}
    a{text-decoration:none;}
    .cover{
      background:url(http://res.cloudinary.com/saurabhdaware/image/upload/q_37/v1512712205/saurabhdawaretk/sketchover.jpg);
      background-position:center;
      height:50%;
      width:100%;
      background-size:cover;
    }
    .container-ka-container{width:300px;}
    .container{
      width:300px;overflow:hidden;
    }
    .container-panel{height:40px}
    .container-image{width:300px;height:auto;;}
    .coverOverlay{height:100%;width:100;background-color:#000;opacity:0.8}
    .text-startdrawing{position:absolute;z-index:1;top:200px;left:0;right:0;padding:auto;}
    .underline{height:1px;width:80%;background-color:#000;}
    .footer
    {
        background-color: black !important;
        color:#555 !important;
        margin-bottom:0px !important;
    }

    .foot{color:#555}
    .foot:hover{text-decoration:none;color:#fff}
    #hiddenPosts{display:none;}
    @media (max-width:768px) {
      .cover{height:90%;}
    }
  </style>
  <script>
    $(document).ready(function(){
        $("a").on('click', function(event) {
        if (this.hash !== "") {
          event.preventDefault();
          var hash = this.hash;
          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 800, function(){
          });
        }
      });
    });
  </script>
</head>
<body>
  <?php
  $flag=0;
    if(isset($_GET["like"]))
    {
      $sql3 = "SELECT filename FROM sketchoverlikes WHERE ip='".$_SERVER["REMOTE_ADDR"]."'";
      $result = $conn->query($sql3);
      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            if($_GET["like"]===$row["filename"])
            {
              echo "<script>alert('Like is already recorded from the same ip');</script>";
              $flag=1;
            }
          }
        }
        if($flag==1)
        {echo "<script>window.location.href = 'index.php' ;</script> ";exit(0);}
        $filename = $_GET["like"];
        $sql = "UPDATE sketchover SET likes=likes+1 WHERE filename='".$filename."'" ;
        if(($conn->query($sql))===true)
        {
          echo "<script></script>";
        }
        $sql1 = "INSERT INTO sketchoverlikes VALUES('".$_SERVER["REMOTE_ADDR"]."','".$filename."');";
        if(($conn->query($sql1))===true)
        {
          echo "<script></script>";
        }
      }
    else {
      echo "";
    }
   ?>
<div class="cover" style="overflow:hidden !important;">
  <div class="coverOverlay"></div>
  <center><div class="text-startdrawing"><a href="draw.php" class="w3-xlarge w3-btn w3-border w3-border-blue w3-text-white">Open Sketchpad</a></div></center>
  <center><a href="#content" class="w3-xxlarge w3-text-white w3-hide-large" style="position:relative;bottom:100px;right:0;left:0;margin:auto;"><i class="fa fa-angle-double-down"></i></a></center>
</div>
<br><br><br>
<div class="w3-row" id="content"><center>
  <?php
  $countrow = 0;
  $l=1;
  $sql = "SELECT * FROM sketchover ORDER BY uploadtime DESC";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
  ?>
  <div class="w3-third">
    <div class="container-ka-container w3-card-4">
      <div class="container">
        <a href="Data/<?php echo $row["filename"] ?>.png"><img class="container-image" src="Data/<?php echo $row["filename"] ?>.png"></a>
      </div>
      <div class="container-panel w3-black w3-large w3-display-container ">
        <a class="w3-display-left" href="index.php?like=<?php echo $row["filename"] ?>"><i class="fa fa-thumbs-o-up w3-padding" id="<?php echo $row["filename"] ?>"></i><?php echo $row["likes"] ?></a>
        <a class="w3-display-right"><small><small>- <?php echo $row["name"] ?> &nbsp; &nbsp;</small></small></a>
      </div>
    </div>
    <br><br>
  </div>
  <?php
  $countrow++;
  if($countrow==3*$l)
  {
    $l++;
    ?></center>
    </div>
    <?php
    if($countrow==6)
    {
      ?>
      <center><a class='w3-button w3-blue w3-text-white w3-large w3-border w3-border-black' style='cursor:pointer' onclick="displayPosts();this.style.display= 'none';">See More</a></center>
      <div class='w3-animate-bottom' id='hiddenPosts'>
        <?php
    }
    ?>
    <div class="w3-row"><center>
    <?php
  }
      }
    }
    ?>
  </center>
</div>
</div><!--ROW ENDING-->
<br><br><br>
<br><br><br>
<center><h2><b>TOP 3</b></h2></center><br><center><div class="underline"></div></center><br><br>
<div class="w3-row" id="content"><center>
  <?php
  $countrow = 0;
  $l=1;
  $sql = "SELECT * FROM sketchover ORDER BY likes DESC LIMIT 3";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
  ?>
  <div class="w3-third">
    <div class="container-ka-container w3-card-4">
      <div class="container">
        <a href="Data/<?php echo $row["filename"] ?>.png"><img class="container-image" src="Data/<?php echo $row["filename"] ?>.png"></a>
      </div>
      <div class="container-panel w3-black w3-large w3-display-container">
        <!--<a class="w3-display-left" href="index.php?like=<?php// echo $row["filename"] ?>"><i class="fa fa-thumbs-o-up w3-padding" id="<?php //echo $row["filename"] ?>"></i><?php// echo $row["likes"] ?></a>-->
        <a class="w3-display-left"><small>&nbsp; &nbsp;<?php echo $row["name"] ?> </small></a>
      </div>
    </div>
    <br><br>
  </div>
  <?php
  $countrow++;
  if($countrow==3*$l)
  {
    $l++;
    ?></center>
    </div>
    <div class="w3-row"><center>
    <?php
  }
      }
    }
    ?>
  </center>
</div><!--ROW ENDING-->
<br><br><br>
<!--FOOTER start-->
<div class="w3-container w3-black footer w3-center"><br><br>
  <span class="w3-xxlarge w3-text-white">SketchOver</span><br><center><div class="underline w3-blue"></div></center><br>
    <a class="w3-large w3-text-blue w3-hover-text-white" href="draw.php">Sketchpad</a> | <a class="w3-large w3-text-blue w3-hover-text-white" href="http://www.saurabhdaware.cf/">Home</a> | <a href="mailto:me@saurabhdaware.cf" class="w3-large w3-text-blue w3-hover-text-white">Email</a><br><br>
    <span class="w3-text-grey w3-small">Developed by <a class="w3-text-white" href="http://www.saurabhdaware.cf">Saurabh Daware</a></span>
    <br><div class="w3-medium">
          <a href="http://www.facebook.com/saurabh.daware.9/" class="fa fa-facebook"></a>
          <a href="http://www.twitter.com/S4UR48H/" class="fa fa-twitter"></a>
          <a href="http://www.linkedin.com/in/echosaurabh" class="fa fa-linkedin"></a>
          <a href="http://www.instagram.com/saurabhcodes" class="fa fa-instagram"></a><br>
        </div>
      <br><br>
</div>
<!--FOOTER end-->
 <?php
 $sql2 = "SELECT filename FROM sketchoverlikes WHERE ip='".$_SERVER["REMOTE_ADDR"]."'";
 $result = $conn->query($sql2);
 if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
       echo "<script>document.getElementById('".$row["filename"]."').style.color = '#09f'; </script>";
     }
   }
 ?>
 <script>
  function displayPosts(){
    document.getElementById("hiddenPosts").style.display = "block";
  }
 </script>
</body>
</html>
