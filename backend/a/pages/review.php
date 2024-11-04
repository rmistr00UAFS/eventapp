<?php
include_once("../config.php");
require_once("../functions/read.php");
require_once("../functions/write.php");
require_once("../functions/display.php");


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
    <title>EventHub</title>
    <link rel="stylesheet" href="bootstrap-2.css">

     <style>
        #/*replyForm {
            position:fixed;
            background:red;
            top:0;right:0;*/
        }
    </style>
</head>

<body>

<?php

echo '<a href="http://localhost/a/ES.php" class="button-link">
                    <button
                    class="btn btn-primary" style="margin-left: 5%;"
                    >HOME
                    </button></a>';
?>

<div class="event">
<?php
        echo '<h1>' . htmlspecialchars($event['EVENT_NAME']) . '</h1>';
?>
</div>

 <div class="reviews">



<?php


echo '<input type="hidden" id="userid" value="'.$event['CREATOR'].'">';


if($eventID>0){




$reviews=reviewsByID($mysqli,$eventID);


while ($review = $reviews->fetch_assoc()) {
                    $comment= $review['COMMENT'];
                    $userid=$review['USERID'];
                    $stars=$review['STARS'];

$user=getUserById($mysqli,$userid);
$userFname = $user['F_NAME'];
$userLname = $user['L_NAME'];


echo '
<div class="review">
<div class=Fname">' . displayStars($stars) . '</div>
<div class=Fname">' . $userFname . '</div>
<div class="Lname">' . $userLname . '</div>
<div class="comment">' . $comment . '</div>

</div>
' ;



$replies= getRepliesByReviewID($mysqli, $review['REVIEWID']);
while ($reply = $replies->fetch_assoc()) {
  $creator=getUserById($mysqli,$event['CREATOR']);

$creatorfn = $creator['F_NAME'];
$creatorln = $creator['L_NAME'];


echo '<div class="reply">
<div class=Fname">' . $creatorfn . '</div>
<div class="Lname">' . $creatorln. '</div>
<div class="reply-text">'.$reply['REPLY'].'</div>
<div class="creator-details">

</div>
</div>';
}



if($user_id==$event['CREATOR']){

 echo '<button id="replyFormButton-'.$review['REVIEWID'].'"  onclick="toggleReplyForm('.$review['REVIEWID'].')">Reply</button>';


echo '<div id="replyForm-'.$review['REVIEWID'].'" style="display:none">



        <label for="reply">Reply:</label>
        <textarea name="reply" id="reply-'.$review['REVIEWID'].'" rows="4" required></textarea>
        <button onclick="submitReply('.$review['REVIEWID'].')">Submit Reply</button>
        <button onclick="toggleReplyForm('.$review['REVIEWID'].')">cancel</button>

</div>';

};


};







};


?>
</div>



<script>
 function toggleReplyForm(reviewid) {
            var form = document.getElementById(`replyForm-${reviewid}`);
            form.style.display = form.style.display === "none" ? "block" : "none"

              var form = document.getElementById(`replyFormButton-${reviewid}`);
            form.style.display = form.style.display === "none" ? "block" : "none"
        }

        function submitReply(reviewid){
    var reply = document.getElementById(`reply-${reviewid}`).value;
        var userid = document.getElementById("userid").value;



       fetch("../write/reply.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({reply,reviewid,userid}),
    }).then(response => response.text()).then(x=>{
        console.log(x)
            location.reload(); // This will reload the current page

    })

            }



</script>


</body>



</html>
