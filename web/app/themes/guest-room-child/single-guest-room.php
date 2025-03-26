<?php
/**
 * The Template for displaying all single posts.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use GuestRoomChild\Classes\GuestRoomUtils;

get_header(); ?>

	<div <?php generate_do_attr( 'content', [
		'class' => GuestRoomUtils::prefix_classes( 'content-area-single' ) . ' ',
	] ); ?>>
		<main <?php generate_do_attr( 'main', [
			'class' => GuestRoomUtils::prefix_classes( 'main-single' ) . ' ',
		] ); ?>>
			<?php
			/**
			 * generate_before_main_content hook.
			 *
			 * @since 0.1
			 */

;

			do_action( 'generate_before_main_content' );

			if ( generate_has_default_loop() ) {
				if(have_posts()){
                    GuestRoomUtils::get_template_part('guest-room-content');
                }
			}

			/**
			 * generate_after_main_content hook.
			 *
			 * @since 0.1
			 */
			do_action( 'generate_after_main_content' );
			?>
		</main>
	</div>

	<?php
	/**
	 * generate_after_primary_content_area hook.
	 *
	 * @since 2.0
	 */
	do_action( 'generate_after_primary_content_area' );
    
	get_footer();
