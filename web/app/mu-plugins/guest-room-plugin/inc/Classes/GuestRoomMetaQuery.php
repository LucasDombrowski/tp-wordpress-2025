<?php

/**
 * The GuestRoomMetaQuery class provides the meta query for the Guest Room Plugin.
 */

namespace GuestRoomPlugin\Classes;

 class GuestRoomMetaQuery{
    public string $label;
    public string $query_key;
    public string $compare;
    public string $key;
    public string $type;

    public function __construct(string $label, string $query_key, string $compare, string $key, string $type){
        $this->label = $label;
        $this->query_key = $query_key;
        $this->compare = $compare;
        $this->key = $key;
        $this->type = $type;
    }

    public function register(){
        add_filter('query_vars', [$this, 'add_query_var']);
    }

    public function add_query_var($current_vars){
        $current_vars[] = $this->query_key;
        return $current_vars;
    }

    public function get_value(){
        return get_query_var($this->query_key);
    }

    public function get_meta_query(){
        $query_var = $this->get_value();
        if($query_var){
            return [
                'key' => $this->key,
                'value' => $query_var,
                'compare' => $this->compare,
                'type' => $this->type
            ];
        }
        return null;
    }
 }