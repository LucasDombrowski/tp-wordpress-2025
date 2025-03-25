<?php

use GuestRoomChild\Classes\GuestRoomUtils;
?>
<div class="<?=GuestRoomUtils::prefix_classes('grid')?>">
    <?php
    while(have_posts()): the_post();
        GuestRoomUtils::get_template_part('guest-room-card');
    endwhile;
    ?>
</div>