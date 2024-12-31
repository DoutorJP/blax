<html>
<?php
session_start();
require_once("pdo-conn.php");

if($_SERVER["REQUEST_METHOD"] !== "POST"){
  exit("POST resquest method required");
}
if(empty($_FILES)){
  exit("$_FILES is empty");
}
if($_FILES["ufile"]["error"] !== UPLOAD_ERR_OK){
  switch($_FILES["image"]["error"]){
  case UPLOAD_ERR_PARTIAL: 
    exit("File only partially uploaded");
  case UPLOAD_ERR_NO_FILE:
    exit("No file uploaded");
  case UPLOAD_ERR_EXTENSION: 
    exit("File upload stopped by extension");
  case UPLOAD_ERR_NO_TMP_DIR: 
    exit("Temporary file directory not found");
  case UPLOAD_ERR_CANT_WRITE:
    exit("Cant write file");
  default: 
    break;
  }
}

$username = $_POST["uname"];
$filename = $_FILES["ufile"]["name"];
$filesize = (float)$_FILES["ufile"]["size"] / 1024;
$filesize = floor($filesize);
$destination = __DIR__ . "/uploads/" . $filename;
if(!move_uploaded_file($_FILES["ufile"]["tmp_name"], $destination)){
  exit("cant move uploaded file");
  }

else{
  echo "File <b>" . $filename . "</b> uploaded by <b>" . $username . "</b> sucessfully! <br> Size: " . $filesize . " KB <br>";
}

// Inserting file in database

$sql = "INSERT INTO `files` (`filename`, `path`, `size`, `author`, `date`, `id`) VALUES (?,?,?,?,?, NULL);";
$pdo->prepare($sql)->execute([$filename, $destination, $filesize, $username, date("Y-m-d")])

?>
<p id="countdown">Returning to home in </p>
<script>

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function countdown(){
var n = document.getElementById("countdown");
for (let i = 10; i > 0; i--) {
  n.append(i+"... ");
    await sleep(1000);
}
n.append("returning...");
console.log(window.location.replace("http://localhost/blax-main/"));
}
//countdown();

</script>

</html>