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

    public function __construct(\Geniem\ACF\Field $field, GuestRoomMetaQuery $meta_query){
        $this->field = $field;
        $this->meta_query = $meta_query;
    }

    public function render(){
        ?>
        <div class="<?=GuestRoomUtils::prefix_classes('filters-field')?>">
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
        $label = $meta_query->label;
        $name = $meta_query->query_key;
        $value = $meta_query->get_value();
        ?>
        <label for="<?=$name?>"><?=$label?></label>
        <input type="number" name="<?=$name?>" id="<?=$name?>" value="<?=$value?>">
        <?php
    }
}