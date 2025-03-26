<?php

/**
 * The GuestRoomCardTag class provides the card tag methods for the Guest Room Child Theme.
 */

namespace GuestRoomChild\Classes\Components;

use GuestRoomChild\Classes\GuestRoomUtils;

class GuestRoomCardTag{
    public string $icon_class;
    public string $tag_text;

    public function __construct(string $icon_class, string $tag_text){
        $this->icon_class = $icon_class;
        $this->tag_text = $tag_text;
    }

    public function render(string $container_element = "div"){
        echo "<$container_element class='".GuestRoomUtils::prefix_classes("card-tag")."'>";
        ?>
       <i class="<?=GuestRoomUtils::prefix_classes("card-tag-icon")?> <?=$this->icon_class?>"></i>
       <span class="<?=GuestRoomUtils::prefix_classes("card-tag-text")?>"><?=$this->tag_text?></span>
        <?php
        echo "</$container_element>";
    }
}