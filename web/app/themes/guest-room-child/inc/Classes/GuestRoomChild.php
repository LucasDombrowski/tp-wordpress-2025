<?php

/**
 * The GuestRoomChild class provides the core functionalities of the Guest Room Child Theme.
 */

namespace GuestRoomChild\Classes;

use GuestRoomChild\Enums\GuestRoomChildTexts;
use GuestRoomPlugin\Classes\GuestRoom;

class GuestRoomChild{
    public function register(){
        $this->register_styles();
    }

    public function enqueue_styles(){
       $utils = new GuestRoomUtils(); 
       $parent_style_tag = GuestRoomChildTexts::THEME_PREFIX->value . '-parent-style';
       wp_register_style($parent_style_tag, GuestRoomUtils::parent_theme_uri() . '/style.css');
       $utils->register_style('style', 'style.css', [$parent_style_tag]);
       $utils->enqueue_style('style');
    }

    public function register_styles(){
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
    }
}