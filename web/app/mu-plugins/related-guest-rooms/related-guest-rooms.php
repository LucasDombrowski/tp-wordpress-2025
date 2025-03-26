<?php
/**
 * Plugin Name:       Related Guest Rooms
 * Description:       A Gutemberg block to display the guest rooms with the same selected taxonomy terms.
 * Version:           1.0.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            Lucas Dombrowski
 * Author URI:		  https://lucasdombrowski.com
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       related-guest-rooms
 *
 * @package CreateBlock
 */

use GuestRoomPlugin\Enums\GuestRoomTexts;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_related_guest_rooms_block_init() {
	if ( function_exists( 'wp_register_block_types_from_metadata_collection' ) ) { // Function introduced in WordPress 6.8.
		wp_register_block_types_from_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
	} else {
		if ( function_exists( 'wp_register_block_metadata_collection' ) ) { // Function introduced in WordPress 6.7.
			wp_register_block_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
		}
		$manifest_data = require __DIR__ . '/build/blocks-manifest.php';
		foreach ( array_keys( $manifest_data ) as $block_type ) {
			register_block_type( __DIR__ . "/build/{$block_type}" );
		}
	}
}

add_action( 'init', 'create_block_related_guest_rooms_block_init' );

function related_guest_rooms_localize_block_editor_assets(){
	wp_localize_script(
		'create-block-related-guest-rooms-editor-script',
		'guestRoomData',
		[
			'postTypeSlug' => GuestRoomTexts::POST_TYPE_SLUG->value,
		]
	);
}

add_action('enqueue_block_editor_assets', 'related_guest_rooms_localize_block_editor_assets');
