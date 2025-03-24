<?php

/**
 * Guest Room Plugin
 *
 * @package       Guest Room
 * @author        Lucas Dombrowski
 *
 * @wordpress-plugin
 * Plugin Name:       Guest Room Plugin
 * Description:       A plugin for the Guest Room website.
 * Version:           1.0.0
 * Author:            Lucas Dombrowski
 * Author URI:        https://lucasdombrowski.com
 * Text Domain:       guest-room-plugin-domain
 * Domain Path:       /lang
 */

use GuestRoomPlugin\Classes\GuestRoom;

//Initialize the Guest Room plugin

(new GuestRoom)->init();