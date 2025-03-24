<?php

/**
 * The GuestRoomFields class provides the fields for the Guest Room custom post type with the ACF Codifier plugin.
 */

namespace GuestRoomPlugin\Classes\Fields;

use GuestRoomPlugin\Enums\GuestRoomFieldInstances;
use GuestRoomPlugin\Enums\GuestRoomTexts;

class GuestRoomFields{
    private const TEXT_DOMAIN = GuestRoomTexts::TEXT_DOMAIN->value;
    private const FIELDS_GROUP_TITLE = GuestRoomTexts::FIELDS_GROUP_TITLE->value;
    private const FIELDS_GROUP_KEY = GuestRoomTexts::FIELDS_GROUP_KEY->value;
    /**
     * @var array<\Geniem\ACF\Field>
     */
    private array $fields = [];

    public function __construct(){
        $native_fields = array_map(function(GuestRoomFieldInstances $guest_room_field_instance){
            return $guest_room_field_instance->acf_codifier_instance();
        }, GuestRoomFieldInstances::cases());
        $fields = apply_filters($this::FIELDS_GROUP_KEY."_instances", $native_fields);
        $this->fields = $fields;
        $this->register();
    }

    /**
     * Register the fields for the Guest Room custom post type.
     */
    public function register(){
        $fields_group = $this->register_fields_group();
        foreach($this->fields as $field){
            $fields_group->add_field($field);
        }
    }

    /**
     * Register the rule group for the Guest Room custom post type.
     */
     private function create_rules_group() : \Geniem\ACF\RuleGroup{
        $rules_group = new \Geniem\ACF\RuleGroup();
        $rules_group->add_rule('post_type', '==', GuestRoomTexts::POST_TYPE_SLUG->value);
        return $rules_group;
     }

    /** 
     * Register the fields group for the Guest Room custom post type.
     */
     private function register_fields_group() : \Geniem\ACF\Group{
        $fields_group = new \Geniem\ACF\Group(__($this::FIELDS_GROUP_TITLE, $this::TEXT_DOMAIN));
        $fields_group->set_key($this::FIELDS_GROUP_KEY);
        $rules_group = $this->create_rules_group();
        $fields_group->add_rule_group($rules_group);
        $fields_group->register();
        return $fields_group;
     }
}