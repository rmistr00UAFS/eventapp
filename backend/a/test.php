<?php
include_once("./config.php");
require_once("./functions/read.php");
require_once("./functions/write.php");
require_once("./functions/display.php");
require_once("./components/event.php");

// # Will display errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$eventID = isset($_GET['id']) ? intval($_GET['id']) : 0;
$event = eventByID($mysqli, $eventID)->fetch_assoc();


session_start();
if (isset($_SESSION['user_id']))
{
  $user_id = $_SESSION['user_id'];
}
else
{
  header("Location: SE.php");
  exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<!--Home page for user if not in creator mode here they will see all events nearby-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <style>


    </style>
</head>

<body>

<?php


$event=eventById($mysqli,2)->fetch_assoc();

eventCard($mysqli,$event);


?>
</div>



<script>


</script>


</body>



</html>
