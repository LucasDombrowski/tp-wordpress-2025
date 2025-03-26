<?php

/**
 * The template for displaying Archive pages.
 *
 * @package GeneratePress
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

use GuestRoomChild\Classes\GuestRoomUtils;
use GuestRoomChild\Enums\GuestRoomChildTexts;

get_header(); ?>

<div <?php generate_do_attr('content', [
			"class" => GuestRoomUtils::prefix_classes("content-area-archive") . " "
		]); ?>>
	<main <?php generate_do_attr('main', [
				"class" => GuestRoomUtils::prefix_classes("main-archive") . " "
			]); ?>>
		<?php
		/**
		 * generate_before_main_content hook.
		 *
		 * @since 0.1
		 */

		do_action('generate_before_main_content');

		if (generate_has_default_loop()) {
			if (have_posts()) :

		?>
				<h1 class="<?= GuestRoomUtils::prefix_classes('archive-title') ?>">
					<?= _e(GuestRoomChildTexts::PLURAL_LABEL->value, GuestRoomChildTexts::TEXT_DOMAIN->value) ?>
				</h1>
				<div class="<?= GuestRoomUtils::prefix_classes('archive-filters') ?>">
					<?php GuestRoomUtils::get_template_part('guest-room-filters'); ?>
				</div>
		<?php

				/**
				 * generate_before_loop hook.
				 *
				 * @since 3.1.0
				 */
				do_action('generate_before_loop', 'archive');

				GuestRoomUtils::get_template_part('guest-room-grid');

				/**
				 * generate_after_loop hook.
				 *
				 * @since 2.3
				 */
				do_action('generate_after_loop', 'archive');

			else :

				generate_do_template_part('none');

			endif;
		}

		/**
		 * generate_after_main_content hook.
		 *
		 * @since 0.1
		 */
		do_action('generate_after_main_content');
		?>
	</main>
</div>

<?php
/**
 * generate_after_primary_content_area hook.
 *
 * @since 2.0
 */
do_action('generate_after_primary_content_area');

get_footer();
