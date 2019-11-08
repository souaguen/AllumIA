<?php
spl_autoload_register(function ($class) {
    require $class.".php";
});
$game = new Play([0, 5, 3]);
