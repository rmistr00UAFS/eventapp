<?php
include_once("config.php");
require_once("./functions/read.php");
require_once("./functions/write.php");
require_once("./functions/display.php");

?>



<!DOCTYPE html>
<html lang="en">
<!--Home page for user if not in creator mode here they will see all events nearby-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventHub</title>
    <link rel="stylesheet" href="bootstrap-2.css">
</head>

<body>
 <div class="row">
<?php


$r=reviewsByID($mysqli,2);






// echo "<script>console.log('PHP Output: " . addslashes($userFname) . "');</script>";


while ($row = $r->fetch_assoc()) {
                    $comment= $row['COMMENT'];
                    $userid=$row['USERID'];
                    $stars=$row['STARS'];
$user=getUserById($mysqli,$userid);

$userFname = $user['F_NAME'];
$userLname = $user['L_NAME'];


echo '<div class=Fname">' . displayStars($stars) . '</div>';
echo '<div class=Fname">' . $userFname . '</div>';
echo '<div class="Lname">' . $userLname . '</div>';
echo '<div class="comment">' . $comment . '</div>';


};


?>
</div>



<script>

</script>


</body>



</html>
