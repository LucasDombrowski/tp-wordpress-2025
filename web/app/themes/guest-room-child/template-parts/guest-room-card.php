<?php

use GuestRoomChild\Classes\GuestRoomUtils;
?>
<a 
class="<?=GuestRoomUtils::prefix_classes('card')?>"
href="<?=get_the_permalink()?>">
    <div class="<?=GuestRoomUtils::prefix_classes('card-image')?>">
        <img 
        src="<?=get_the_post_thumbnail_url()?>" 
        alt="<?=get_the_title()?>" 
        class="<?=GuestRoomUtils::prefix_classes('card-image')?>">
    </div>
    <div class="<?=GuestRoomUtils::prefix_classes('card-content')?>">
        <h3 class="<?=GuestRoomUtils::prefix_classes('card-title')?>"><?=get_the_title()?></h3>
        <p class="<?=GuestRoomUtils::prefix_classes('card-excerpt')?>"><?=get_the_excerpt()?></p>
    </div>
</a>