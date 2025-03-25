<?php

/**
 * The GuestRoomTaxonomy class provides the core functionalities of a Guest Room Taxonomy.
 */

namespace GuestRoomPlugin\Classes\Taxonomies;

use GuestRoomPlugin\Enums\GuestRoomTexts;

class GuestRoomTaxonomy{
    private string $slug;
    private string $singular_label;
    private string $plural_label;
    private bool $hierarchical;
    private const TEXT_DOMAIN = GuestRoomTexts::TEXT_DOMAIN->value;
    private const POST_TYPE = GuestRoomTexts::POST_TYPE_SLUG->value;

    /**
     * Initializes the Guest Room Taxonomy with the provided parameters.
     * 
     * @param string $slug The slug of the taxonomy.
     * @param string $singular_label The singular label of the taxonomy.
     * @param string $plural_label The plural label of the taxonomy.
     * @param bool $hierarchical Whether the taxonomy is hierarchical.
     */
    public function __construct(string $slug, string $singular_label, string $plural_label, bool $hierarchical = true){
        $this->slug = $slug;
        $this->singular_label = $singular_label;
        $this->plural_label = $plural_label;
        $this->hierarchical = $hierarchical;
    }

    /**
     * Registers the Guest Room Taxonomy for the Guest Room post type with every labels.
     */
    public function register(){
        $labels = [
            'name' => _x($this->plural_label, 'Taxonomy general name', self::TEXT_DOMAIN),
            'singular_name' => _x($this->singular_label, 'Taxonomy singular name', self::TEXT_DOMAIN),
            'search_items' => __('Search ' . $this->plural_label, self::TEXT_DOMAIN),
            'all_items' => __('All ' . $this->plural_label, self::TEXT_DOMAIN),
            'parent_item' => __('Parent ' . $this->singular_label, self::TEXT_DOMAIN),
            'parent_item_colon' => __('Parent ' . $this->singular_label . ':', self::TEXT_DOMAIN),
            'edit_item' => __('Edit ' . $this->singular_label, self::TEXT_DOMAIN),
            'update_item' => __('Update ' . $this->singular_label, self::TEXT_DOMAIN),
            'add_new_item' => __('Add New ' . $this->singular_label, self::TEXT_DOMAIN),
            'new_item_name' => __('New ' . $this->singular_label . ' Name', self::TEXT_DOMAIN),
            'menu_name' => __($this->plural_label, self::TEXT_DOMAIN),
        ];

        $args = [
            'hierarchical' => $this->hierarchical,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => ['slug' => $this->slug],
        ];

        register_taxonomy($this->slug, $this::POST_TYPE, $args);
    }
}