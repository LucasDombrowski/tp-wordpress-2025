<?php

/**
 * The GuestRoomSingleSection class provides the single section methods for the Guest Room Child Theme.
 */

namespace GuestRoomChild\Classes\Components;

use GuestRoomChild\Classes\GuestRoomUtils;
use GuestRoomChild\Enums\GuestRoomChildTexts;

class GuestRoomSingleSection{
    protected const TEXT_DOMAIN = GuestRoomChildTexts::TEXT_DOMAIN->value;
    protected const SINGLE_SECTION_PREFIX = GuestRoomChildTexts::SINGLE_SECTION_PREFIX->value;
    public static function open_section(string $title){
        $single_section_prefix = self::SINGLE_SECTION_PREFIX;
        ?>
        <section class="<?=GuestRoomUtils::prefix_classes($single_section_prefix."content")?>">
            <h2 class="<?=GuestRoomUtils::prefix_classes($single_section_prefix."title")?>"><?=__($title,self::TEXT_DOMAIN)?></h2>
            <div class="<?=GuestRoomUtils::prefix_classes($single_section_prefix."inner")?>">
        <?php
    }

    public static function close_section(){
        ?>
            </div>
        </section>
        <?php
    }

    public static function open_subsection(string $title){
        $single_section_prefix = self::SINGLE_SECTION_PREFIX;
        ?>
        <div class="<?=GuestRoomUtils::prefix_classes($single_section_prefix."subsection")?>">
            <h3 class="<?=GuestRoomUtils::prefix_classes($single_section_prefix."subtitle")?>"><?=__($title,self::TEXT_DOMAIN)?></h3>
            <div class="<?=GuestRoomUtils::prefix_classes($single_section_prefix."subinner")?>">
        <?php
    }

    public static function close_subsection(){
        ?>
            </div>
        </div>
        <?php
    }
}