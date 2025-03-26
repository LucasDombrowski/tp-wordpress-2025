<?php

use GuestRoomChild\Classes\Components\GuestRoomSingleSection;
use GuestRoomChild\Classes\GuestRoomUtils;
use GuestRoomChild\Enums\GuestRoomChildTexts;
use GuestRoomPlugin\Classes\Taxonomies\GuestRoomTaxonomies;
use GuestRoomPlugin\Enums\GuestRoomFieldInstances;
use GuestRoomPlugin\Enums\GuestRoomTexts;

$single_prefix = GuestRoomChildTexts::SINGLE_PREFIX->value;
?>
<div class="<?= GuestRoomUtils::prefix_classes($single_prefix . "content-container") ?>">
    <img
        src="<?= get_the_post_thumbnail_url() ?>"
        alt="<?= get_the_title() ?>"
        class="<?= GuestRoomUtils::prefix_classes($single_prefix . "image") ?>">
    <div class="<?= GuestRoomUtils::prefix_classes($single_prefix . "content") ?>">
        <h1 class="<?= GuestRoomUtils::prefix_classes($single_prefix . "title") ?>">
            <?= get_the_title() ?>
        </h1>
        <?= GuestRoomSingleSection::open_section("Informations") ?>
        <ul class="<?= GuestRoomUtils::prefix_classes($single_prefix . "infos ".$single_prefix."items-list") ?>">
            <li class="<?= GuestRoomUtils::prefix_classes($single_prefix . "infos-row") ?>">
                <i class="fa-solid fa-bed"></i>
                <span>(<?= GuestRoomFieldInstances::BEDS_COUNT->label() ?>) : <?= GuestRoomFieldInstances::BEDS_COUNT->value() ?></span>
            </li>
            <li class="<?= GuestRoomUtils::prefix_classes($single_prefix . "infos-row") ?>">
                <i class="fa-solid fa-euro-sign"></i>
                <span>(<?=GuestRoomFieldInstances::PRICE->label()?>) : <?= GuestRoomFieldInstances::PRICE->value() ?></span>
            </li>
        </ul>
        <?= GuestRoomSingleSection::close_section() ?>
        <?= GuestRoomSingleSection::open_section("Classifications") ?>
        <ul class="<?= GuestRoomUtils::prefix_classes($single_prefix . "taxonomies ".$single_prefix."items-list") ?>">
            <?php
            $guest_room_taxonomies_instance = new GuestRoomTaxonomies();
            $taxonomies = $guest_room_taxonomies_instance->taxonomies;
            foreach ($taxonomies as $taxonomy) {
                $terms = GuestRoomTaxonomies::get_post_terms(get_the_ID(), $taxonomy->slug, ', ');
                $singular_label = __($taxonomy->singular_label, GuestRoomTexts::TEXT_DOMAIN->value);
                $plural_label = __($taxonomy->plural_label, GuestRoomTexts::TEXT_DOMAIN->value);
                $label = count(explode(",",$terms)) > 1 ? $plural_label : $singular_label;
                $value = $label . " : " . $terms;
            ?>
                <li class="<?= GuestRoomUtils::prefix_classes($single_prefix . "taxonomy") ?>">
                    <?= $value ?>
                </li>
            <?php
            }
            ?>
        </ul>
        <?= GuestRoomSingleSection::close_section() ?>
        <?= GuestRoomSingleSection::open_section("Description") ?>
        <div class="<?= GuestRoomUtils::prefix_classes($single_prefix . "content-inner") ?>">
            <?= the_content() ?>
        </div>
        <?= GuestRoomSingleSection::close_section() ?>
    </div>
</div>