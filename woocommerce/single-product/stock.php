<?php
/**
 * Single Product stock.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/stock.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$icon_class = '';

switch ($class) {
	case 'out-of-stock';
		$icon_class = 'la la-times-circle text-danger';
		break;
	case 'available-on-backorder':
		$icon_class = 'la la-pause-circle text-warning';
		break;
	case 'in-stock':
		$icon_class = 'la la-check-circle text-success';
		break;
}
	


?>
<p class="stock <?php echo esc_attr( $class ); ?>"><i class="<?php echo $icon_class; ?>"></i> <?php echo wp_kses_post( $availability ); ?></p>
