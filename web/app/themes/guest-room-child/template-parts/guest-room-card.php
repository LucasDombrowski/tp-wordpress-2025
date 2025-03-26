<?php

use GuestRoomChild\Classes\Components\GuestRoomCardTag;
use GuestRoomChild\Classes\GuestRoomUtils;
use GuestRoomChild\Enums\GuestRoomChildTexts;
use GuestRoomPlugin\Classes\Taxonomies\GuestRoomTaxonomies;
use GuestRoomPlugin\Enums\GuestRoomFieldInstances;
use GuestRoomPlugin\Enums\GuestRoomTexts;
$card_prefix = GuestRoomChildTexts::CARD_PREFIX->value;
?>
<a
    class="<?= GuestRoomUtils::prefix_classes($card_prefix."container") ?>"
    href="<?= get_the_permalink() ?>">
    <div class="<?= GuestRoomUtils::prefix_classes($card_prefix."first-row") ?>">
        <img
            src="<?= get_the_post_thumbnail_url() ?>"
            alt="<?= get_the_title() ?>"
            class="<?= GuestRoomUtils::prefix_classes($card_prefix."image") ?>">
        <div class="<?= GuestRoomUtils::prefix_classes($card_prefix."content") ?>">
            <h3 class="<?= GuestRoomUtils::prefix_classes($card_prefix."title") ?>">
                <?= get_the_title() ?>
            </h3>
            <?php GuestRoomUtils::get_template_part("guest-room-card-tags","",[
                "items" => [
                    new GuestRoomCardTag("fa-solid fa-bed",GuestRoomFieldInstances::BEDS_COUNT->value()),
                    new GuestRoomCardTag("fa-solid fa-bed",GuestRoomTaxonomies::get_post_terms(get_the_ID(), GuestRoomTexts::BEDS_TYPE_SLUG->value, ', ')),
                    new GuestRoomCardTag("fa-solid fa-euro-sign",GuestRoomTaxonomies::get_post_terms(get_the_ID(), GuestRoomTexts::PRICE_RANGE_SLUG->value, ', '))
                ]
            ]); 
            ?>
            <div class="<?= GuestRoomUtils::prefix_classes($card_prefix."excerpt") ?>">
                <?php the_excerpt() ?>
            </div>
            <button class="<?= GuestRoomUtils::prefix_classes($card_prefix."button") ?>">
                <?= __("View Room", GuestRoomChildTexts::TEXT_DOMAIN->value) ?>
            </button>
        </div>
    </div>
    <div class="<?= GuestRoomUtils::prefix_classes($card_prefix."second-row") ?>">
        <span class="<?= GuestRoomUtils::prefix_classes($card_prefix."price") ?>">
            <?= GuestRoomFieldInstances::PRICE->value() ?> €
        </span>
        <span class="<?= GuestRoomUtils::prefix_classes($card_prefix."price-text") ?>">
            <?=__("per night", GuestRoomChildTexts::TEXT_DOMAIN->value)?>
        </span>
    </div>
</a>