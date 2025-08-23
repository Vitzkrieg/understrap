<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) : ?>

	<div class="woocommerce-tabs wc-tabs-wrapper my-5">
		<ul class="nav nav-tabs" role="tablist" id="product-tabs">
			<?php
				$tab_counter = 0;
				foreach ( $product_tabs as $key => $product_tab ) :
			?>
			<?php $active_class = ($tab_counter === 0) ? 'active' : ''; ?>
				<li class="nav-item <?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="presentation" >
					<a class="nav-link <?php echo esc_attr( $active_class ); ?>" href="#tab-<?php echo esc_attr( $key ); ?>" data-bs-toggle="tab" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
						<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
					</a>
				</li>
			<?php
				$tab_counter++;
				endforeach;
			?>
		</ul>
		<div class="tab-content" id="product-tabs-content">
			<?php 
				$tab_counter = 0;
				foreach ( $product_tabs as $key => $product_tab ) :
			?>
			<div class="tab-pane fade<?php echo ($tab_counter === 0) ? ' show active' : ''; ?>" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
				<?php
				if ( isset( $product_tab['callback'] ) ) {
					call_user_func( $product_tab['callback'], $key, $product_tab );
				}
				?>
			</div>
			<?php
				$tab_counter++;
				endforeach;
			?>
			</div>
		<?php do_action( 'woocommerce_product_after_tabs' ); ?>
	</div>

<?php endif; ?>
