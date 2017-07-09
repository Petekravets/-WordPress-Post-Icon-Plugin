<?php
/**
 * Created by PhpStorm.
 * User: Peter
 * Date: 07.07.2017
 * Time: 17:35
 */

namespace core;

class PageOptions extends App
{

    public function __construct()
    {
        parent::__construct();
        add_action('admin_menu', [$this, 'pi_option_menu']);
        add_action('admin_init', [$this, 'pi_options']);
        register_uninstall_hook(__FILE__, [$this, 'pi_delete_options']);
    }

    /*
     * Callback-метод
     * Регістрація сторінки настройок Post Icon
     */
    public function pi_option_menu()
    {
        add_options_page('Post Icon', 'Post Icon', 'manage_options', 'post_icon_options', [$this, 'pi_option_page']);
    }

    /**
     * Callback-метод
     * Регістрація полів сторінки-настройок
     */
    public function pi_options()
    {
        //$option_group, $option_name
        register_setting('post_icon_group', 'pi_options', 'validate_fields');

        //$id, $title, $callback, $page
        add_settings_section('pi_section_options', 'Опції плагіна Post Icon', '', 'post_icon_options');

        //$id, $title, $callback, $page
        add_settings_field('pi_options_ids', 'ID постів для яких виводити іконку', [$this, 'display_ids_option'], 'post_icon_options', 'pi_section_options');
        add_settings_field('pi_options_class', 'Клас іконки', [$this, 'display_class_option'], 'post_icon_options', 'pi_section_options');
        add_settings_field('pi_options_active', 'Активувати опцію?', [$this, 'display_active_option'], 'post_icon_options', 'pi_section_options');
        add_settings_field('pi_options_position', 'Позиція іконки', [$this, 'display_position_option'], 'post_icon_options', 'pi_section_options');
    }

    /**
     * Callback-метод
     * Вивід форми в сторінці настройок
     */
    public function pi_option_page()
    {
        ?>
        <div class="wrap">
            <form action="options.php" method="post">
                <?php
                settings_fields('post_icon_group');
                do_settings_sections('post_icon_options') ;
                submit_button();
                ?>
            </form>
        </div>
        <?
    }

    /**
     * Callback-метод
     * Поле вводу ID-постів, які повині містити іконки
     */
    public function display_ids_option()
    {
        echo '<input type="text" name="pi_options[pi_options_ids]" id="pi_options_ids" value="'.
                esc_attr($this->option['pi_options_ids'])
            .'" class="regular_text">';
    }

    /**
     * Callback-метод
     * Поле виводу для класу іконки
     */
    public function display_class_option()
    {
        echo '<input type="text" name="pi_options[pi_options_class]" id="pi_options_class" value="' .
                esc_attr($this->option['pi_options_class']) .
            '" class="regular_text">';
    }

    /**
     *
     * Поле виводу чекбокса для активації іконок
     */
    public function display_active_option()
    {
        echo '<input type="checkbox" name="pi_options[pi_options_active]" id="pi_options_active" value="1" '.
                checked($this->option['pi_options_active'], true, 0)
            . ' class="regular_text">';
    }

    /**
     * Callback-метод
     * Поле виводу місця розташування іконки
     */
    public function display_position_option()
    {
        ?>
        <select name="pi_options[pi_options_position]" id="pi_options_position" >
            <option value="left" <?php selected($this->option['pi_options_position'], 'left');?>">Зліва</option>
            <option value="right" <?php selected($this->option['pi_options_position'], 'right')?>">Справа</option>
        </select>
    <?php }

    /**
     * Callback-метод
     * Видаляємо всі теги з полів вводу на адмін-сторінці
     * @param $options
     * @return array
     */
    public function validate_fields($options)
    {
        $sanitize = [];
        foreach ($options as $key => $value) {
            $sanitize[$key] = strip_tags($value);
        }
        return $sanitize;
    }
}
