<?php
require('../functions.php')
$db = mysqli_connect($host, $uname, $pword, $db);
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

$records = mysqli_query($db, "select * from help where url = '" . $_GET['name'] . "'"); // fetch data from database




while ($data = mysqli_fetch_array($records)) { 
    
    
$url = $data['url'];
$name = $data['name'];
$title = $data['name'];
$text = $data['text'];

mkdir($url);



$myfile = fopen($url . '/index.php', "w") or die("Unable to find article! Please try again later!");
$header = '<html>
<head>
  <title>' . $name . '</title>
<style>*{font-family:Arial;text-align:center;}img,video,audio{max-width:75%;}</style>
</head>
<body>
<form method="post" action="/help/">
<h3>More help...</h3>
  <input type="text" name="search" autofocus value="' . $name . '">
  <input type="submit" value="Search"/>
</form>
<h2>' . $name . '</h2>';
$txt = str_replace("\n", '<br>', $text);
$footer = '<br><br><br>
<a href="/" style="color:blue;">Homepage</a><span> - </span><a href="../../" style="color:blue;">More Articles</a>
</body>
</html>';
fwrite($myfile, $header . $txt . $footer);
fclose($myfile);
header('Location: ' . $url);
