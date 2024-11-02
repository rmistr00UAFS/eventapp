<?php


function createReview($mysqli,$reviewID,$userID, $eventID, $comment, $stars){
    $stmt = $mysqli->prepare("INSERT INTO `REVIEWS` (`REVIEWID`, `USERID`, `EVENTID`, `COMMENT`, `STARS`) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iiisi", $reviewID, $userID, $eventID, $comment, $stars);


    $stmt->execute();


}


function createReply($mysqli,$replyID, $reviewID, $eventID, $reply){
    $stmt = $mysqli->prepare("INSERT INTO `REPLY` (`REPLYID`, `REVIEWID`, `USERID`, `REPLY`) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $replyID, $reviewID, $eventID, $reply);


    $stmt->execute();

}


?>
