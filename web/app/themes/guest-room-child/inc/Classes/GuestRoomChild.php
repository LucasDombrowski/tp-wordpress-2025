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
       $utils->register_style('style', 'style.css', ["generate-style"]);
       wp_dequeue_style("generate-child");
       $utils->enqueue_style('style');
    }

    public function register_styles(){
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles'],100);
    }
}