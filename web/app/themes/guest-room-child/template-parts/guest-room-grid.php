<?php

use GuestRoomChild\Classes\GuestRoomUtils;
?>
<div class="<?=GuestRoomUtils::prefix_classes('grid'.(isset($args['class']) ? ' '.sanitize_text_field($args['class']) : ''))?>">
    <?php
    if(isset($args['query']) && $args['query']->have_posts()){
        $query = $args['query'];
        while($query->have_posts()): $query->the_post();
            GuestRoomUtils::get_template_part('guest-room-card');
        endwhile;
    } else if(have_posts()){
        while(have_posts()): the_post();
            GuestRoomUtils::get_template_part('guest-room-card');
        endwhile;
    }
    ?>
</div>