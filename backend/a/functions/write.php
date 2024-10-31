<?php

function createReview($mysqli,$reviewID,$userID, $eventID, $comment, $stars){
    $stmt = $mysqli->prepare("INSERT INTO `REVIEWS` (`REVIEWID`, `USERID`, `EVENTID`, `COMMENT`, `STARS`) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iiisi", $reviewID, $userID, $eventID, $comment, $stars);


    $stmt->execute();


}




?>
