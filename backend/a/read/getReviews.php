<?php

function reviews($mysqli){
    $stmt = $mysqli->prepare("SELECT * FROM `REVIEWS`");
$stmt->execute();
$result = $stmt->get_result();

$reviews = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }

}
 return json_encode($reviews);
}

?>
