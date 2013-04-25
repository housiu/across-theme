<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<p><?php _e( 'Your cart is currently empty.', 'woocommerce' ) ?></p>

<?php do_action('woocommerce_cart_is_empty'); ?>

<?php 
/*
	<p><a class="button" href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>"><?php _e( '&larr; Return To Shop', 'woocommerce' ) ?></a></p>
*/
?>
<?php $events_page_id = get_option ( 'dbem_events_page' ); ?>
<p><a class="button" href="<?php echo get_post_permalink($events_page_id); ?>"><?php _e( '&larr; Return To Event List', 'woocommerce' ) ?></a></p>