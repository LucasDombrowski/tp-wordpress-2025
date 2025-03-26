<?php

/**
 * The GuestRoomFiltersField class provides the filters field for the Guest Room Child Theme.
 */

namespace GuestRoomChild\Classes\Components\Filters;

use GuestRoomChild\Classes\GuestRoomUtils;
use GuestRoomPlugin\Classes\GuestRoomMetaQuery;

class GuestRoomFiltersField{
    private \Geniem\ACF\Field $field;
    private GuestRoomMetaQuery $meta_query;
    public $input_class;

    public function __construct(\Geniem\ACF\Field $field, GuestRoomMetaQuery $meta_query){
        $this->field = $field;
        $this->meta_query = $meta_query;
        $this->input_class = GuestRoomUtils::prefix_classes('filters-field-input');
    }

    public function render(){
        ?>
        <div class="<?=GuestRoomUtils::prefix_classes('filters-field')?>">
            <label for="<?=$this->meta_query->query_key?>" class="<?=GuestRoomUtils::prefix_classes('filters-field-label')?>"><?=$this->meta_query->label?></label>
            <?php
            switch($this->field->get_type()){
                case 'number':
                    $this->render_number_field();
                    break;
                default:
                    break;
            }
            ?>
        </div>
        <?php
    }

    public function render_number_field(){
        $meta_query = $this->meta_query;
        $name = $meta_query->query_key;
        $value = $meta_query->get_value();
        ?>
        <input type="number" name="<?=$name?>" id="<?=$name?>" value="<?=$value?>" class="<?=$this->input_class?>">
        <?php
    }
}