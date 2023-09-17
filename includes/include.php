<?php
spl_autoload_register('autoload');

function autoload($className)
{
    $folders = ['errors','ORM'];
    foreach ($folders as $folder){
        if (file_exists("$folder/$className.php")){
            require_once "$folder/$className.php";
        }
    }
}