<?php

spl_autoload_register('autoloader_func');
function autoloader_func($class)
{
    if($class == 'WP_Filesystem_direct') {
        return;
    }
    $plugin_directory = dirname(__FILE__) . '/';
    $path = str_replace('\\', '/', $class) . '.php';

    if ( file_exists( $plugin_directory.$path ) ) {
        require_once $plugin_directory.$path;
    }

}
