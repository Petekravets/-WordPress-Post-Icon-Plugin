<?php
/*
Plugin Name: Post Icon
Description: Плагін добавляє іконку до заголовка статті
Plugin URI: https://github.com/Petekravets/-WordPress-Post-Icon-Plugin
Author: Петро
Author URI: https://github.com/Petekravets
*/
require __DIR__ . '/autoload.php';

$page_options = new core\PageOptions();
$post_icon = new core\PostIcon();
