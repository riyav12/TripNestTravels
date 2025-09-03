<?php
/**
 * Cleaned Add to wishlist template — icon only, no text
 */
if ( ! defined( 'YITH_WCWL' ) ) {
	exit;
}

global $product;
?>

<div
	class="yith-wcwl-add-to-wishlist add-to-wishlist-<?php echo esc_attr( $product_id ); ?> <?php echo esc_attr( $container_classes ); ?> wishlist-fragment on-first-load"
	data-fragment-ref="<?php echo esc_attr( $product_id ); ?>"
	data-fragment-options="<?php echo wc_esc_json( wp_json_encode( $fragment_options ) ); ?>"
>
	<?php if ( ! $ajax_loading ) : ?>
		<?php if ( ! $disable_wishlist || is_user_logged_in() ) : ?>

			<!-- ADD TO WISHLIST -->
			<?php
			// Load only icon, no label
			$icon_only = str_replace( array( $label, $browse_wishlist_text, $already_in_wishslist_text, $product_added_text ), '', $icon );
			echo yith_wcwl_kses_icon( $icon );
			?>

		<?php else : ?>
			<?php
			$login_url = add_query_arg(
				array(
					'wishlist_notice' => 'true',
					'add_to_wishlist' => $product_id,
				),
				get_permalink( wc_get_page_id( 'myaccount' ) )
			);
			?>
			<div class="yith-wcwl-add-button">
				<a
					href="<?php echo esc_url( $login_url ); ?>"
					class="disabled_item <?php echo esc_attr( str_replace( array( 'add_to_wishlist', 'single_add_to_wishlist' ), '', $link_classes ) ); ?>"
					rel="nofollow"
				>
					<?php echo yith_wcwl_kses_icon( $icon ); ?>
				</a>
			</div>
		<?php endif; ?>
	<?php endif; ?>
</div>
