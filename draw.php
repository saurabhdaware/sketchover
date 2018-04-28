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
  <meta charset="utf-8">
  <title>SketchOver Web</title>
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
  <meta name="theme-color" content="#09f">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <style>
    html,body{height:100% !important;width:100%;overflow:hidden;}
    .u-full-width{width:100%;}
    .w3-bar-item{height:100% !important;}
    #sketchpad{overflow:hidden;cursor:crosshair;background-color:#fff;}
    .sizerange{padding:7px 16px !important;}
    #hiddenelements,#downarrow{display:none;}

    @media (max-width:768px) {
      #sketchpad{padding:0 !important;margin:0 !important;}
      .sizerange{padding:7px 1px !important;}
    }
    @media (min-width: 1000px) and (max-width : 1500px){
      #sketchpad{height:100% !important;width:100% !important;}
    }
    canvas{border: 1px solid #333;width:100% !important}
  </style>
</head>
<body>
  <div style="position:fixed;bottom:0;width:100%;">
  <div class="w3-bar w3-black w3-animate-bottom">
    <a class="w3-bar-item w3-button w3-indigo w3-border w3-border-black" style="width:20%"><input type="color" style="width:70%;" value="#000000" id="line-color-input"> <b></a>
    <a class="w3-bar-item sizerange w3-blue w3-border w3-border-black" style="width:20%;"><input type="range" value="5" id="line-size-input"></a>
    <a class="w3-bar-item w3-button u-full-width w3-button w3-red w3-border w3-border-black" id="undo" style="width:20%"><i class="fa fa-undo"></i></a>
    <a class="w3-bar-item w3-button u-full-width w3-button w3-grey w3-border w3-border-black" id="clear" style="width:20%"><b>CLR</b></a>
    <a id="uparrow" class="w3-bar-item w3-button u-full-width w3-button w3-light-grey w3-border w3-border-black" onclick="hideShow('block');this.style.display='none';" style="width:20%">
      <i class="fa fa-arrow-up"></i>
    </a>
    <a id="downarrow" class="w3-bar-item w3-button u-full-width w3-button w3-light-grey" onclick="hideShow('none');this.style.display='none';" style="width:20%">
      <i class="fa fa-arrow-down"></i>
    </a>
  </div>
  <div class="w3-animate-left" id="hiddenelements">
    <div class="w3-bar w3-black">
      <a class="w3-bar-item w3-button w3-grey w3-border w3-border-black" style="width:60%;padding:8px 1px"><b>Background: </b><input type="color" value="#ffffff" id="bg-color-input"> <b></a>
      <a class="w3-bar-item w3-button u-full-width w3-button w3-green" id="redo" style="width:20%"><i class="fa fa-repeat"></i></a>
      <a type="button" class="w3-bar-item w3-button u-full-width w3-button w3-cyan w3-border w3-border-black" onclick="take_screenshot();document.getElementById('id01').style.display = 'block';" style="width:20%">
        <small><small>Share</small></small>
      </a>
    </div>
  </div>
</div>
  <div class="w3-light-grey" style="height:100% !important;width:100%;">
    <div style="width:100%;" id="sketchpad"></div>
  </div>
  <div id="id01" class="w3-modal">
      <div class="w3-modal-content w3-card-4">

        <header class="w3-container w3-blue">
          <span onclick="document.getElementById('id01').style.display='none'"
          class="w3-button w3-display-topright">&times;</span>
          <h3>Share drawing</h3>
        </header>

        <div class="w3-container">
          <form action="" method="post">
            <input type="hidden" name="data" id="canvastoimg">
            <b>Name: </b><input type="text" id="username" name="filenme" placeholder="Enter your name..." class="w3-input"><br>
            <input type="submit" name="share" class="w3-button w3-border w3-border-blue w3-light-grey" value="Share"><br><br>
            <p id="errormsg" class="w3-text-red w3-medium">Name should be less than 15 characters and more than 3 characters</p><br><br>
          </form>
        </div>

        <footer class="w3-container w3-blue w3-text-light-grey w3-small">
          <p id="textnote">Note:If you click share your drawing will be shared on SketchOver along with your name.</p>
        </footer>

      </div>
  </div>

   <script>
         function take_screenshot()
         {
            html2canvas([document.getElementById("sketchpad") ],{
               onrendered: function(canvas)
               {
                   var img = canvas.toDataURL("image/png");
                   document.getElementById("canvastoimg").value = img;
               }
            });
         }
   </script>
   <?php
   if(isset($_POST['share']))
   {
      $filenamedb = $_POST['filenme']."".$_SERVER['REQUEST_TIME'];
      $sql = "INSERT INTO sketchover VALUES('".$_POST['filenme']."','".$filenamedb."','".$_SERVER['REQUEST_TIME']."','0');";
       if ($conn->query($sql) === TRUE) {
         echo "<script>alert('File shared'); </script>";
          $data = $_POST['data'];
          $file = "Data/".$filenamedb.".png";
          $uri =  substr($data,strpos($data,",")+1);
          file_put_contents('./'.$file, base64_decode($uri));
          echo $file;
          echo "<script>window.location.href='http://www.saurabhdaware.cf/webapps/SketchOver/index.php' ; </script>";
          exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
  } ?>
    <!-- Scripts
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <script src="responsive-sketchpad.js"></script>
  <script>
  function hideShow(dis){
    document.getElementById('hiddenelements').style.display = dis;
    document.getElementById('downarrow').style.display = dis;
    if(dis=='none')
    {
      document.getElementById('uparrow').style.display = 'block';
    }
  }
  document.getElementById("bg-color-input").oninput = setBgColor;
  function setBgColor(){
    document.getElementById("sketchpad").style.backgroundColor = document.getElementById("bg-color-input").value;
  }

    var el = document.getElementById('sketchpad');
    var pad = new Sketchpad(el);

    // setLineColor
    function setLineColor(e) {
        var color = e.target.value;
        if (!color.startsWith('#')) {
            color = '#' + color;
        }
        pad.setLineColor(color);
    }
    document.getElementById('line-color-input').oninput = setLineColor;

    // setLineSize
    function setLineSize(e) {
        var size = e.target.value;
        pad.setLineSize(size);
    }
    document.getElementById('line-size-input').oninput = setLineSize;

    // undo
    function undo() {
        pad.undo();
    }
    document.getElementById('undo').onclick = undo;

    // redo
    function redo() {
        pad.redo();
    }
    document.getElementById('redo').onclick = redo;

    // clear
    function clear() {
        pad.clear();
    }
    document.getElementById('clear').onclick = clear;

    // resize
    window.onresize = function (e) {
      pad.resize(el.offsetWidth);
    }
  </script>

<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>
</html>
