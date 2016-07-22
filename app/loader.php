<?php

// Register router/service autoloader
spl_autoload_register(function ($class) {
    $filename = "$class.php";
    
    //print_r($filename);
    //echo '</br>';
    //print_r(__DIR__ . '/../core/encrypt/' . $filename);

    if (file_exists(__DIR__ . '/router/' . $filename)) {
        include __DIR__ . '/router/' . $filename;
    } else if (file_exists(__DIR__ . '/service/' . $filename)) {
        include __DIR__ . '/service/' . $filename;
    }else if (file_exists(__DIR__ . '/../core/encrypt/' . $filename)) {
        include __DIR__ . '/../core/encrypt/' . $filename;
    }
    
    
});