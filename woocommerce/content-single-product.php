<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary col-12 col-md-6">
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );
		?>
	</div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>

<script id="replaceSliderTriggerIcon">
(function replaceSliderTriggerIcon() {
    const maxTries = 50;
    let iconTries = 0;
	let sizeChartTries = 0;

    function replaceIcon(icon) {
        icon
            .html('&nbsp;') // replace magnifying glass character
            .addClass('la la-search-plus fs-4'); // add line-aweseom magnifying +
    }
    function findImageIcon() {
        iconTries++;
        const icon = jQuery('a.woocommerce-product-gallery__trigger span');
        if ( !icon || !icon.length ) {
            if (iconTries > maxTries) {
                return;
            }
            setTimeout(() => {
                findImageIcon();
            }, 100);
            return;
        }

        replaceIcon(icon);
    }

	function styleSizeChartLink(link) {
		const icon = jQuery('<i class="fa fa-tshirt"></i>');
		link 
			.addClass('text-secondary btn btn-outline-primary')
			.prepend(icon)
		;
	}
	function findSizeChartLink() {
        sizeChartTries++;
        const link = jQuery('.single_variation_wrap a[onclick^="Printful_Product_Size_Guide.onSizeGuideClick()"]');
        console.log(link);
        if ( !link || !link.length ) {
            if (sizeChartTries > maxTries) {
                return;
            }
            setTimeout(() => {
                findSizeChartLink();
            }, 100);
            return;
        }

        styleSizeChartLink(link);
	}

    window.document.addEventListener('DOMContentLoaded', function() {
        findImageIcon();
		findSizeChartLink();
    });
})();
</script>