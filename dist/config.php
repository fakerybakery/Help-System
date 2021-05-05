<?php
/*query


CREATE TABLE `help` (
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `text` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `help` (`name`, `url`, `text`) VALUES
('Demo Doc', 'demo-doc', 'This is a demo doc. You can use custom HTML. <a href="">Reload page (custom HTML!)</a>');

ALTER TABLE `help`
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `url` (`url`);
COMMIT;

*/
if (!empty($_POST['host']) && !empty($_POST['uname']) && !empty($_POST['db'])) {
    $host = $_POST['host'];
    $uname = $_POST['uname'];
    $pword = $_POST['pword'];
    $db = $_POST['db'];
    //create help table
    $con = mysqli_connect($host,$uname,$pword,$db);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    mysqli_query($con, 'CREATE TABLE `help` (
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `text` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `help` (`name`, `url`, `text`) VALUES
(\'Demo Doc\', \'demo-doc\', \'This is a demo doc. You can use custom HTML. <a href="">Reload page (custom HTML!)</a>\');

ALTER TABLE `help`
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `url` (`url`);
COMMIT;');
    mysqli_close($con);
    //end create help table
    
    $myfile = fopen("functions.php", "w") or die("Unable to open file!");
    $txt = '<?php
$host = \'' . $host . '\';
$uname = \'' . $uname . '\';
$pword = \'' . $pword . '\';
$db = \'' . $db . '\';
$conn = mysqli_connect($host,$uname,$pword,$db);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
';
    fwrite($myfile, $txt);
    fclose($myfile);
  
  $file_pointer = "config.php"; 
   
// Use unlink() function to delete a file 
if (!unlink($file_pointer)) { 
    echo ("Config File cannot be deleted."); 
} 
else { 
//deleted
    header('Location: index.php');
  exit;
} 

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Configuration</title>
    <style>
        label {
            font-family: monospace;
        }

    </style>
</head>

<body>
    <h1>Configuration</h1>
    <p>NOTE: Please, make sure that you do not already have a MYSQL table called "help".</p>
    <form action="" method="post">
        <label for="host">MYSQL Hostname</label>
        <input type="text" name="host" id="host" value="localhost" placeholder="localhost" required>
        <br>
        <label for="uname">Username - - -</label>
        <input type="text" name="uname" id="uname" placeholder="myname" required>
        <br>
        <label for="pword">Your Password-</label>
        <input type="password" name="pword" id="pword" placeholder="Password">
        <br>
        <label for="db">Database - - -</label>
        <input type="text" name="db" id="db" placeholder="Database" required>
        <br>
        <button type="submit">Configurate</button>
    </form>
    <p>Works on PHP8</p>
</body>

</html>
