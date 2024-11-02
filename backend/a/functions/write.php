<?php


function createReview($mysqli,$userID, $eventID, $comment, $stars){
    $stmt = $mysqli->prepare("INSERT INTO `REVIEWS` ( `USERID`, `EVENTID`, `COMMENT`, `STARS`) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iisi", $userID, $eventID, $comment, $stars);


    $stmt->execute();


}


function createReply($mysqli, $reviewID, $eventID, $reply){
    $stmt = $mysqli->prepare("INSERT INTO `REPLY` ( `REVIEWID`, `USERID`, `REPLY`) VALUES ( ?, ?, ?)");
    $stmt->bind_param("iis", $reviewID, $eventID, $reply);


    $stmt->execute();

}


?>
