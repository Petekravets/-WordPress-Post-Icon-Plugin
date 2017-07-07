<?php

namespace core;


class PostIcon extends App
{
    public function __construct()
    {
        parent::__construct();
        add_filter('the_title', [$this, 'add_icon_to_title']);
    }

    /**
     * Добавлення іконки до заголовка
     * @param string $title
     * @return string
     */
    public function add_icon_to_title($title)
    {
        $ids = explode(',', $this->option['pi_options_ids']);
        if(!$this->activateIcon() ||  !in_array(get_the_ID(), $ids)) {
            return $title;
        }

        $position = $this->option['pi_options_position'];
        $icon = '<span class="'. $this->option['pi_options_class'] . ' ' . $position .'"></span>';
        if($position == 'left') {
            return $icon.$title;
        } else if($position == 'right') {
            return $title.$icon;
        }
    }

    /**
     * Перевірка на статус чекбокса "Активувати"
     * @return mixed
     */
    private function activateIcon()
    {
        return $this->option['pi_options_active'];
    }
}