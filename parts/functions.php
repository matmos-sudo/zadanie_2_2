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

function validateMenuType(string $type): bool{
    $menuType = [
        'header',
        'footer'
    ];
    if(in_array($type, $menuType)){
        return true;
    }else{
        return false;
    }
}

function getMenuData(string $type): array{
    $menu = [];
    if(validateMenuType($type)){
        if($type == "header"){
            $menu = [
                'home' => [
                    'name' => 'Domov',
                    'path' => 'index.php',
                ],
                'portfolio' => [
                    'name' => 'Portfolio',
                    'path' => 'portfolio.php',
                ],
                'qna' => [
                    'name' => 'Q&A',
                    'path' => 'qna.php',
                ],
                'kontakt' => [
                    'name' => 'Kontakt',
                    'path' => 'kontakt.php',
                ]

            ];
        }
    }
    return $menu;
}

function printMenu(array $menu){
    foreach($menu as $menuName => $menuData){
        echo '<li><a href="' . $menuData['path'] . '">' . $menuName . '</a></li>';
    }
}

function preparePortfolio(int $numberOfRows =2, int $numberOfColumns = 4): array{
    $portfolio = [];
    $colIndex = 1;
    for($i = 0; $i < $numberOfRows; $i++) {
        for($j = 0; $j < $numberOfColumns; $j++) {
            $portfolio[$i][$j] = $colIndex;
            $colIndex++;
        }
    }
    return $portfolio;
}

function finishPortfolio(){
    $portfolio = preparePortfolio();
    foreach($portfolio as $row => $col){
        echo '<div class="row">';
        foreach($col as $index){
            echo '<div class="col-25 portfolio text-white text-center" id="portfolio-'.$index.'"> Web Stranka '.$index.'
            </div>';
        }
        echo '</div>';
    }
}
