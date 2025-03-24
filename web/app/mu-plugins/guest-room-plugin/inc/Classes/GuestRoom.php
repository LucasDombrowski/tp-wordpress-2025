<?php

/*
The GuestRoom class provides the core functionnalities of the Guest Room plugin.
*/

namespace GuestRoomPlugin\Classes;

use GuestRoomPlugin\Classes\Fields\GuestRoomFields;
use GuestRoomPlugin\Classes\Taxonomies\GuestRoomTaxonomies;

class GuestRoom{

    /**
    * Initializes the Guest Room plugin.
    */
    public function init(){
        add_action('init', [$this, 'register']);
    }

    /**
    * Registers the Guest Room plugin.
    */
    public function register(){
        $this->register_post_type();
        $this->register_fields_group();
        $this->register_taxonomies();
    }

    /**
     * Registers the Guest Room custom post type.
     */
    public function register_post_type(){
        $guestRoomPostType = new GuestRoomPostType();
        $guestRoomPostType->register();
    }

    public function register_fields_group(){
        $guestRoomFields = new GuestRoomFields();
        $guestRoomFields->register();
    }

    public function register_taxonomies(){
        $guestRoomTaxonomies = new GuestRoomTaxonomies();
        $guestRoomTaxonomies->register();
    }
}