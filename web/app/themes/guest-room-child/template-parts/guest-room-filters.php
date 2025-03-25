<?php
 use GuestRoomChild\Classes\Components\Filters\GuestRoomFiltersField;
 use GuestRoomPlugin\Classes\Fields\GuestRoomFields;
 use GuestRoomChild\Enums\GuestRoomChildTexts;
 ?>
<form method="get" action="">
    <?php
    $guestRoomFields = new GuestRoomFields();
    $fields = $guestRoomFields->fields;
    foreach ($fields as $field) {
        $meta_queries = $guestRoomFields::get_field_meta_queries($field);
        foreach ($meta_queries as $meta_query) {
            (new GuestRoomFiltersField($field, $meta_query))->render();
        }
    }
    ?>
    <button type="submit">
        <?php _e('Filter '.GuestRoomChildTexts::PLURAL_LABEL->value, GuestRoomChildTexts::TEXT_DOMAIN->value) ?>
    </button>
</form>