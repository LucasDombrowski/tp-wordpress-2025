<?php

use GuestRoomChild\Classes\GuestRoomUtils;

if(isset($args['items']) && is_array($args['items'])): ?>
<ul class="<?=GuestRoomUtils::prefix_classes("card-tags")?>">
    <?php foreach($args['items'] as $item): $item->render("li"); endforeach; ?>
</ul>
<?php endif; ?>