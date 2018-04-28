<?php
/*$servername = "localhost";
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
<?php
    if(isset($_GET['data']))
    {
      $filenamedb = $_GET['filenme']."".$_SERVER['REQUEST_TIME'];
      $sql = "INSERT INTO sketchover VALUES('".$_GET['filenme']."','".$filenamedb."','".$_SERVER['REQUEST_TIME']."','0');";
        if ($conn->query($sql) === TRUE) {
           $data = $_GET['data'];
           $file = "Data/".$filenamedb.".png";
           $uri =  substr($data,strpos($data,",")+1);
           file_put_contents('./'.$file, base64_decode($uri));
           echo $file;
           exit();
     } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
     }

     $conn->close();
    }
?>
