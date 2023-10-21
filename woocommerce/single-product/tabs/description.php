<?php
/**
 * Description tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.0.0
 */

defined( 'ABSPATH' ) || exit;

global $post;

$content = get_post_meta($post->ID, 'wc_tab1_editor', true);
if($content){

?>
			<div class="wc-tab_inner">
				<div class="post_content clearfix">
					<?php echo apply_filters('the_content', $content ); ?>
				</div>
			</div>
<?php

}
