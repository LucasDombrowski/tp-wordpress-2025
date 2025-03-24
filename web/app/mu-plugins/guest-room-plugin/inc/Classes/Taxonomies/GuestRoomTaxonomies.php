<?php

/**
 * The GuestRoomTaxonomies class provides the core functionalities of the Guest Room Taxonomies.
 */

namespace GuestRoomPlugin\Classes\Taxonomies;

use GuestRoomPlugin\Enums\GuestRoomTexts;

class GuestRoomTaxonomies{
    /**
     * @var array<GuestRoomTaxonomy>
     */
    public $taxonomies = [];

    public function __construct(){
        $taxonomies = [
            new GuestRoomTaxonomy(
                GuestRoomTexts::BEDS_TYPE_SLUG->value,
                GuestRoomTexts::BEDS_TYPE_SINGULAR_LABEL->value,
                GuestRoomTexts::BEDS_TYPE_PLURAL_LABEL->value,
                true
            ),
            new GuestRoomTaxonomy(
                GuestRoomTexts::PRICE_RANGE_SLUG->value,
                GuestRoomTexts::PRICE_RANGE_SINGULAR_LABEL->value,
                GuestRoomTexts::PRICE_RANGE_PLURAL_LABEL->value,
                false
            )
        ];
        $taxonomies = apply_filters(GuestRoomTexts::POST_TYPE_SLUG->value . '_taxonomies', $taxonomies);
        $this->taxonomies = $taxonomies;
    }

    public function register(){
        foreach($this->taxonomies as $taxonomy){
            $taxonomy->register();
        }
    }

}