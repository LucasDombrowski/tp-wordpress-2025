<?php
/**
 * Dynamic rendering of the 'Related Guest Rooms' block.
 * Displays guest rooms associated with selected taxonomy terms.
 */

use GuestRoomChild\Classes\Components\GuestRoomSingleSection;
use GuestRoomChild\Classes\GuestRoomUtils;
use GuestRoomPlugin\Enums\GuestRoomTexts;

// Get the current post ID
$post_id = get_the_ID();

// Get the taxonomy selected in the block attributes
$taxonomy = isset($attributes['taxonomy']) ? $attributes['taxonomy'] : '';

// If no taxonomy is selected, return an empty string
if (empty($taxonomy)) {
    return ''; // No taxonomy selected, so no content is displayed
}

// Get the terms associated with the current post in the selected taxonomy
$terms = wp_get_post_terms( $post_id, $taxonomy );

// If no terms are found, return an empty string
if ( empty( $terms ) ) {
    return ''; // No terms found, so no content is displayed
}

// Extract the term IDs for the tax query
$term_ids = wp_list_pluck( $terms, 'term_id' );

// Get the block attributes (numberOfRooms, orderBy)
$number_of_rooms = isset( $attributes['numberOfRooms'] ) ? $attributes['numberOfRooms'] : 3;
$order_by = isset( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'date';

// Arguments for the WP_Query
$args = array(
    'post_type'      => GuestRoomTexts::POST_TYPE_SLUG->value, // Use the defined constant instead of hardcoding 'guest-room'
    'posts_per_page' => $number_of_rooms, // Number of rooms to display
    'orderby'        => $order_by, // Sorting criteria
    'post__not_in'   => array( $post_id ), // Exclude the current post
    'tax_query'      => array(
        array(
            'taxonomy' => $taxonomy,
            'field'    => 'term_id',
            'terms'    => $term_ids,
            'operator' => 'IN', // Matches rooms that have these terms
        ),
    ),
);

// Execute the query to fetch the guest rooms
$query = new WP_Query( $args );

// Check if we have posts and display them
if ($query->have_posts()) {
    GuestRoomSingleSection::open_subsection('Related Guest Rooms');
    GuestRoomUtils::get_template_part('guest-room-grid', '', ['query' => $query, 'class' => 'single']);
    GuestRoomSingleSection::close_subsection();
}

// Reset the query after custom WP_Query
wp_reset_postdata();
