<?php
/*
Plugin Name: Post Icon
Description: Плагін добавляє іконку до заголовка статті
Plugin URI:
Author: Петро
Author URI:
*/
require __DIR__ . '/autoload.php';

$page_options = new core\PageOptions();
$post_icon = new core\PostIcon();
