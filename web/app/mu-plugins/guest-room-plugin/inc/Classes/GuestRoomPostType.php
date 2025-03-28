<?php

/*
The GuestRoomPostType class provides functionality for registering the Guest Room custom post type.
*/

namespace GuestRoomPlugin\Classes;

use GuestRoomPlugin\Enums\GuestRoomTexts;
use WP;

class GuestRoomPostType
{
    private const KEY = GuestRoomTexts::POST_TYPE_SLUG->value;
    private const SINGULAR_LABEL = GuestRoomTexts::SINGULAR_LABEL->value;
    private const PLURAL_LABEL = GuestRoomTexts::PLURAL_LABEL->value;
    private const TEXT_DOMAIN = GuestRoomTexts::TEXT_DOMAIN->value;

    /**
     * Registers the Guest Room custom post type.
     */
    public function register()
    {
        $this->register_post_type();
        add_action('wp', [$this, 'add_to_views_count']);
        add_filter('manage_' . self::KEY . '_posts_columns', [$this, 'admin_add_views_count_column']);
        add_action('manage_' . self::KEY . '_posts_custom_column', [$this, 'admin_views_count_column_content'], 10, 2);
    }

    public function register_post_type()
    {
        register_post_type(
            self::KEY,
            [
                'labels' => [
                    'name' => _x(self::PLURAL_LABEL, 'Post Type General Name', self::TEXT_DOMAIN),
                    'singular_name' => _x(self::SINGULAR_LABEL, 'Post Type Singular Name', self::TEXT_DOMAIN),
                    'menu_name' => _x(self::PLURAL_LABEL, 'Admin Menu text', self::TEXT_DOMAIN),
                    'name_admin_bar' => _x(self::SINGULAR_LABEL, 'Add New on Toolbar', self::TEXT_DOMAIN),
                    'add_new' => __('Add New', self::TEXT_DOMAIN),
                    'add_new_item' => __('Add New ' . self::SINGULAR_LABEL, self::TEXT_DOMAIN),
                    'new_item' => __('New ' . self::SINGULAR_LABEL, self::TEXT_DOMAIN),
                    'edit_item' => __('Edit ' . self::SINGULAR_LABEL, self::TEXT_DOMAIN),
                    'view_item' => __('View ' . self::SINGULAR_LABEL, self::TEXT_DOMAIN),
                    'all_items' => __('All ' . self::PLURAL_LABEL, self::TEXT_DOMAIN),
                    'search_items' => __('Search ' . self::PLURAL_LABEL, self::TEXT_DOMAIN),
                    'parent_item_colon' => __('Parent ' . self::SINGULAR_LABEL . ':', self::TEXT_DOMAIN),
                    'not_found' => __('No ' . self::PLURAL_LABEL . ' found.', self::TEXT_DOMAIN),
                    'not_found_in_trash' => __('No ' . self::PLURAL_LABEL . ' found in Trash.', self::TEXT_DOMAIN),
                ],
                'public' => true,
                "menu_icon" => "dashicons-admin-home",
                'has_archive' => true,
                "show_in_rest" => true,
                'rewrite' => ['slug' => self::KEY],
                'supports' => ['title', 'excerpt', 'editor', 'thumbnail'],
            ]
        );
    }

    /**
     * Returns the URL of the Guest Room archive page.
     */
    public static function get_archive_page()
    {
        return get_post_type_archive_link(self::KEY);
    }

    public function add_to_views_count(WP $wp)
    {
        if(is_singular(self::KEY)){
            $views_count = $this->get_views_count(get_the_ID()) + 1;
            $this->update_views_count(get_the_ID(), $views_count);
        }
    }

    public function admin_add_views_count_column($columns)
    {
        $columns[GuestRoomTexts::VIEWS_COUNT_SLUG->value] = __('Views Count', self::TEXT_DOMAIN);
        return $columns;
    }

    public function get_views_count(int $post_id): int
    {
        return (int)get_post_meta($post_id, GuestRoomTexts::VIEWS_COUNT_SLUG->value, true) ?? 0;
    }

    public function update_views_count(int $post_id, int $count)
    {
        update_post_meta($post_id, GuestRoomTexts::VIEWS_COUNT_SLUG->value, $count);
    }

    public function admin_views_count_column_content($column, $post_id)
    {
        if ($column === GuestRoomTexts::VIEWS_COUNT_SLUG->value) {
            echo $this->get_views_count($post_id);
        }
    }
}