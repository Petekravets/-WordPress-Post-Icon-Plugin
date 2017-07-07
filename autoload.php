<?php
spl_autoload_register( 'autoloader' );
function autoloader($class)
{
    require __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
}