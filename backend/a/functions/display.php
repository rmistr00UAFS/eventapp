<?php


                function displayStars($num) {
                $maxStars = 5; // maximum stars to show
                $fullStar = "⭐";
                $emptyStar = "☆";

                    // Make sure the number doesn't exceed the max
                $num = min($num, $maxStars);

                    // Generate full stars
                $stars = str_repeat($fullStar, $num);

                    // Add empty stars for the remaining
                $stars .= str_repeat($emptyStar, $maxStars - $num);
                    return $stars;
                }






?>
