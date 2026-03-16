<?php
function pozdrav(){
    $hour = date('H');
    if ($hour < 12) {
        echo "<h1>Dobry rano</h1>";
    } elseif ($hour < 18) {
        echo "<h1>Dobry den</h1>";
    } else {
        echo "<h1>Dobry vecer</h1>";
    }
}
function generateSlides($dir) {
    $files = glob($dir . "/*.jpg");
    $json = file_get_contents("data/data.json");
    $data = json_decode($json, true);
    $text = $data["text_banner"];

    foreach ($files as $file) {
        echo '<div class="slide fade">';
        echo '<img src="' . $file . '">';
        echo '<div class="slide-text">';

        echo ($text[basename($file)]);
        echo '</div>';
        echo '</div>';
    }
}
function insertQnA(){
    $json = file_get_contents("data/data.json");
    $data = json_decode($json, true);
    $otazky = $data["otazky"];
    $odpovede = $data["odpovede"];
    for($i = 0; $i < count($otazky); $i++) {
        echo '<div class="accordion">';
            echo '<div class="question">';
                echo $otazky[$i];
        echo '</div>';
            echo '<div class="answer">';
                echo $odpovede[$i];
            echo '</div>';
        echo '</div>';
    }
    echo '</section>';
}

