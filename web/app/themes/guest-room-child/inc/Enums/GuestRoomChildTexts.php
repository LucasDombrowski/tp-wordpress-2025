<?php

/**
 * The GuestRoomChildTexts enum provides the core texts of the Guest Room Child Theme.
 */

namespace GuestRoomChild\Enums;

enum GuestRoomChildTexts : string{
    case THEME_PREFIX = 'gr-child';
    case TEXT_DOMAIN = 'guest-room-child';
    case PLURAL_LABEL = 'Rooms';
    case SINGULAR_LABEL = 'Room';
    case READ_MORE = 'Read more';
    case CARD_PREFIX = 'card-';
    case SINGLE_PREFIX = 'single-';
    case SINGLE_SECTION_PREFIX = 'single-section-';
}