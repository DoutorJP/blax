<?php
session_start();
require_once("pdo-conn.php");
?>
<html>
  <head>
    <title>balx</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
    <meta http-equiv="refresh" content="120">
    <style>
      tr {
        border-bottom: 10px solid #000000;
      }
      tr:nth-child(even) {
      background-color: #D6EEEE;
  
  
}
  tr:hover {background-color:rgb(236, 255, 152);}
    </style>
  </head>
  <body >
    <h1 id="titulo">balx</h1>
    <h3>Submit a file</h3>
    <form action="handler.php" id="nf" method="post" enctype="multipart/form-data" accept=".pdf">
      <label for="uname">Username (optional):</label>
      <input type="text" id="uname" name="uname"><br>
      <input type="file" id="ufile" name="ufile"><br>
      <input onclick="getData()" type="submit" value="submit">
    </form>

    <address>
      <a href="mailto:anon@gentoo"></a>
    </address>
    <table>
      <tr>
        <th>File</th>
        <th>Size</th>
        <th>Author</th>
        <th>Date</th>
      </tr>
<h3>Search for files</h3>
<div>
  <form action="" id="searchform" method="post">
    <label for="slabel">Search for files</label>
    <input type="text" name="sfile" id="sfile">
    <p id="errorp"></p>
  </form>
  <button onclick="checkButtonText()" style="margin: 5px;">Search</button>
</div>
<br>
  <?php


$basicSQL = "SELECT * FROM files WHERE size != 0";
$recordSet = $pdo->query($basicSQL);

while ($row = $recordSet->fetch()){
  echo '<tr><td><a href="'.$row["path"].'">'.$row["filename"].'</a></td><td>'.$row["size"].'</td><td>'.$row["author"].'</td><td>'.$row["date"].'</tr>';
}


?>
    </table>
</body>
</html>
<script>
  /*
    var user = document.forms["nf"]["uname"].value;
    var file = document.forms["nf"]["ufile"].value;
    var obj = new Object();
    obj.username = user;
    obj.filepath = file;
    var jsonString= JSON.stringify(obj);
    console.log(jsonString);
    */
   function checkButtonText(){
    var text = document.getElementById("sfile");
    var error = document.getElementById("errorp");
    error.innerHTML = "Checking for " + text.innerText;

   }
</script>
