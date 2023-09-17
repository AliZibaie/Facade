<?php
$models = array_slice(scandir('migrations'), 2);

foreach ($models as $model){
    $class = substr("$model",0,strpos("$model", '.php') );
    require_once "migrations/$class.php";
    $class::up();
}