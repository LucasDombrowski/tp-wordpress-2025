<?php

/*
The Guest Room Plugin Texts enum class provides a list of text strings used throughout the Guest Room Plugin.
*/

namespace GuestRoomPlugin\Enums;

enum GuestRoomTexts: string {
    case PLUGIN_NAME = 'Guest Room Plugin';
    case PLUGIN_SLUG = 'guest-room-plugin';
    case TEXT_DOMAIN = 'guest-room-plugin-domain';
    case SINGULAR_LABEL = 'Guest Room';
    case PLURAL_LABEL = 'Guest Rooms';
    case POST_TYPE_SLUG = 'guest-room';
    case FIELDS_GROUP_TITLE = 'Guest Room Fields';
    case FIELDS_GROUP_KEY = 'guest_room_fields';
    case PREFIX = 'gr_';
    case BEDS_TYPE_SLUG = 'bed-type';
    case BEDS_TYPE_SINGULAR_LABEL = 'Bed Type';
    case BEDS_TYPE_PLURAL_LABEL = 'Bed Types';
    case PRICE_RANGE_SLUG = 'price-range';
    case PRICE_RANGE_SINGULAR_LABEL = 'Price Range';
    case PRICE_RANGE_PLURAL_LABEL = 'Price Ranges';
    case VIEWS_COUNT_SLUG = 'views-count';
    case VIEWS_COUNT_LABEL = 'Views Count';
}