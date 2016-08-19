<!DOCTYPE html>
<head>
<title>WhiteCore Grid Manager</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<script src="https://use.fontawesome.com/96c26a4572.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<meta charset="iso-8859-1" />
<style type="text/css">
body
{
background-color: #DADADA;
}
</style>
</head>
<body>
<nav class="navbar navbar-inverse navbar-static-top animate">
  <div class="container"> 
  <ul class="nav navbar-nav">
   <li>  <a class="navbar-brand" href="index.php"><b>WhiteCore Grid Manager</b></a></li>
  <li><a href="index.php">Home</a></li></li>
   <li><a href="?a=start">Start Grid</a></li></li>
      <li><a href="?a=stop">Stop Grid</a></li></li>
      <li><a href="?a=restart">Restart Grid</a></li></li>
      <li><a href="?a=backup">Backup</a></li></li>
      <li><a href="?a=backup_mysql">Backup Database</a></li></li>
    </ul>
  </div>
</nav>
<?php
include("config.php");
require("classes/class.ssh2.php");
$ssh = new SSH2(SSH_HOST,SSH_PORT);	
$ssh->auth(SSH_USER, SSH_PASS);
$a = isset($_GET['a']) ? $_GET['a'] : '';
if($a == "start")
{
$ssh->exec("cd ". WC_PATH . "&& ./run_gridmode_html.sh");
echo $ssh->output();
}
else if($a == "stop")
{
$ssh->exec("cd ". WC_PATH . "&&  ./stop_grid.sh");
echo $ssh->output();
}
else if($a == "restart")
{
echo "Restarting Grid";
$ssh->exec("cd ". WC_PATH . "&&  ./stop_grid.sh");
echo $ssh->output();
$ssh->exec("cd ". WC_PATH . "&& ./run_gridmode_html.sh");
echo $ssh->output();
}
else if($a == "backup")
{
echo "Starting backup in background.";
$ssh->exec("cd " .WC_ROOT. " && sudo screen -AmdS backup tar czf backup.$(date +%Y%m%d-%H%M%S).tar.gz .");
}
else if($a == "backup_mysql")
{
echo "Starting MySQL backup in background.";
$ssh->exec("cd ". WC_PATH . "&& screen -AmdS backupdb ./backup_db.sh");
}
else
{
echo '<div class="row2" style ="background-color: #2ba6cb;" width=30%>';
$ssh->exec("screen -ls | grep Sim");
$check1 = $ssh->output();
if (strpos($check1, 'Sim') !== false) 
{
echo "<font color='lime'>Sim Server Running</font><br />";
}
else
{
echo "<font color='red'>Sim server Stopped</font><br />";
}
echo "<hr>";
$ssh->exec("screen -ls | grep Grid");
$check2 = $ssh->output();
if (strpos($check2, 'Grid') !== false) 
{
echo "<font color='lime'>Grid Server Running</font><br />";
}
else
{
echo "<font color='red'>Grid server Stopped</font><br />";
}
echo "</div>";
echo "<br><br>";
}
?>