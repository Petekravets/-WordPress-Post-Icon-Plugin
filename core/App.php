<?php

namespace core;


abstract class App
{

    protected $option;

    public function __construct()
    {
        add_action( 'wp_enqueue_scripts', [$this, 'post_icon_styles']);
        $this->option = get_option('pi_options');
    }

    /**
     * Підключення файлу стилів нашого плагіну
     */
    public function post_icon_styles() {
        wp_register_style( 'pi_style', plugins_url('../css/pi_style.css', __FILE__));
        wp_enqueue_style( 'pi_style');
    }
}