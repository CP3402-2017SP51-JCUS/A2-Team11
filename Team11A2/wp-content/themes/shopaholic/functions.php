<?php
/**
 * shopaholic engine room
 *
 * @package shopaholic
 */

 /**
  * Assign the Storefront version to a var
  */
 $theme              = wp_get_theme( 'shopaholic' );
 $storefront_version = $theme['Version'];
 
 /**
  * Initialize all the things.
  */
require 'inc/class-shopaholic.php';
 
require 'inc/shopaholic-functions.php';
require 'inc/shopaholic-template-functions.php';
require 'inc/shopaholic-template-hooks.php';
require 'inc/customizer/class-shopaholic-customizer.php';
require 'inc/tgm/class-tgm-plugin-activation.php';

if ( shopaholic_is_woocommerce_activated() ) {
 require 'inc/woocommerce/shopaholic-woocommerce-template-hooks.php';
}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woothemes/theme-customisations
 */