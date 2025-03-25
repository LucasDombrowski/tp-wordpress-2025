<?php

/**
 * The GuestRoomFields class provides the fields for the Guest Room custom post type with the ACF Codifier plugin.
 */

namespace GuestRoomPlugin\Classes\Fields;

use GuestRoomPlugin\Classes\GuestRoomMetaQuery;
use GuestRoomPlugin\Enums\GuestRoomFieldInstances;
use GuestRoomPlugin\Enums\GuestRoomTexts;
use WP_Query;

class GuestRoomFields
{
    private const TEXT_DOMAIN = GuestRoomTexts::TEXT_DOMAIN->value;
    private const FIELDS_GROUP_TITLE = GuestRoomTexts::FIELDS_GROUP_TITLE->value;
    private const FIELDS_GROUP_KEY = GuestRoomTexts::FIELDS_GROUP_KEY->value;

    /**
     * @var array<\Geniem\ACF\Field>
     */
    public array $fields = [];

    public function __construct()
    {
        $native_fields = array_map(function (GuestRoomFieldInstances $guest_room_field_instance) {
            return $guest_room_field_instance->acf_codifier_instance();
        }, GuestRoomFieldInstances::cases());
        $fields = apply_filters($this::FIELDS_GROUP_KEY . "_instances", $native_fields);
        $this->fields = $fields;
    }

    /**
     * Register the fields for the Guest Room custom post type.
     */
    public function register()
    {
        $fields_group = $this->register_fields_group();
        foreach ($this->fields as $field) {
            $fields_group->add_field($field);
        }
        add_action('pre_get_posts', [$this, 'edit_archive_query']);
        $meta_queries = $this->get_meta_queries_instances();
        foreach($meta_queries as $meta_query){
            $meta_query->register();
        }
    }

    /**
     * Register the rule group for the Guest Room custom post type.
     */
    private function create_rules_group(): \Geniem\ACF\RuleGroup
    {
        $rules_group = new \Geniem\ACF\RuleGroup();
        $rules_group->add_rule('post_type', '==', GuestRoomTexts::POST_TYPE_SLUG->value);
        return $rules_group;
    }

    /** 
     * Register the fields group for the Guest Room custom post type.
     */
    private function register_fields_group(): \Geniem\ACF\Group
    {
        $fields_group = new \Geniem\ACF\Group(__($this::FIELDS_GROUP_TITLE, $this::TEXT_DOMAIN));
        $fields_group->set_key($this::FIELDS_GROUP_KEY);
        $rules_group = $this->create_rules_group();
        $fields_group->add_rule_group($rules_group);
        $fields_group->register();
        return $fields_group;
    }
    
    public static function get_field_meta_queries(\Geniem\ACF\Field $field){
        $key = $field->get_key();
        $meta_queries = [];
        switch($field->get_type()){
            case 'number':
                $comparisons = [
                    $key."_min" => [
                        "comparison" => '>=',
                        "label"=> __('Minimum '.$field->get_label(), GuestRoomTexts::TEXT_DOMAIN->value)
                    ],
                    $key."_max" => [
                        "comparison" => '<=',
                        "label"=> __('Maximum '.$field->get_label(), GuestRoomTexts::TEXT_DOMAIN->value)
                    ]
                ];
                foreach($comparisons as $meta_key => $comparison){
                    $meta_queries[] = new GuestRoomMetaQuery($comparison["label"], $meta_key, $comparison["comparison"], $key, 'NUMERIC');
                }
                break;
            default:
                break;
        }
        return $meta_queries;
    }
    
    public function get_meta_queries_instances(){
        $meta_queries = [];
        foreach($this->fields as $field){
            $field_meta_queries = $this->get_field_meta_queries($field);
            $meta_queries = array_merge($meta_queries, $field_meta_queries);
        }
        return $meta_queries;
    }

    /**
     * Edit the guest room post type archive query.
     */
    public function edit_archive_query(WP_Query $query)
    {
        if (is_post_type_archive(GuestRoomTexts::POST_TYPE_SLUG->value) && $query->is_main_query()) {
            $meta_queries = $this->get_meta_queries_instances();
            $meta_queries = array_map(function (GuestRoomMetaQuery $meta_query) {
                return $meta_query->get_meta_query();
            }, $meta_queries);
            $meta_queries = array_filter($meta_queries);
            $query->set('meta_query', $meta_queries);
        }
    }
}
