<?php
 use GuestRoomChild\Classes\Components\Filters\GuestRoomFiltersField;
use GuestRoomChild\Classes\GuestRoomUtils;
use GuestRoomPlugin\Classes\Fields\GuestRoomFields;
 use GuestRoomChild\Enums\GuestRoomChildTexts;
use GuestRoomPlugin\Enums\GuestRoomTexts;

 ?>
<form method="get" action="<?=get_post_type_archive_link(GuestRoomTexts::POST_TYPE_SLUG->value)?>" class="<?=GuestRoomUtils::prefix_classes('filters-form')?>">
    <?php
    $guestRoomFields = new GuestRoomFields();
    $fields = $guestRoomFields->fields;
    ?>
    <div class="<?=GuestRoomUtils::prefix_classes('filters-fields')?>">
        <?php
        foreach ($fields as $field) {
            $meta_queries = $guestRoomFields::get_field_meta_queries($field);
            foreach ($meta_queries as $meta_query) {
                (new GuestRoomFiltersField($field, $meta_query))->render();
            }
        }
        ?>
    </div>
    <button type="submit">
        <?php _e('Filter '.GuestRoomChildTexts::PLURAL_LABEL->value, GuestRoomChildTexts::TEXT_DOMAIN->value) ?>
    </button>
</form>