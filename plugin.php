<?php
/*
	Plugin Name: Genesis Support for Google Tag Manager for Wordpress
	Plugin URI: http://dazzet/google-tag-manager-support-on-genesis-framework
	Description: Adds support for Duracell Tommy GTM plugin on genesis powered sites
	Author: Mario Yepes <marioy47@gmail.com>
	Author URI: http://www.dazzet.co/

	Version: 0.0.1

	License: GNU General Public License v2.0 (or later)
	License URI: http://www.opensource.org/licenses/gpl-license.php
*/

/**
 * Main class that takes care of everything 
 *
 * @package Genesis GTM4WP
 * @since 1.0
 */
class Genesis_Gtm4wp {
	
	/** Constructor */
	function __construct() {
		
		register_activation_hook( __FILE__, array( $this, 'activation_hook' ) );
		
		add_action( 'genesis_before', array($this, 'gtm4wp_action'), 9);
	
	}
	
	/**
	 * Runs appon activation. Verifies that Genesis >= 2.0 is activated
	 */
	function activation_hook() {

		if ( ! defined( 'PARENT_THEME_VERSION' ) || ! version_compare( PARENT_THEME_VERSION, '2.0.0', '>=' ) ) {
			deactivate_plugins( plugin_basename( __FILE__ ) ); /** Deactivate ourself */
			wp_die( sprintf( __( 'Sorry, you cannot activate without <a href="%s">Genesis %s</a> or greater', 'genesis-gtm4wp' ), 'http://my.studiopress.com/', '2.0.0' ) );
		}
		
	}

	function gtm4wp_action() {
		if (current_filter() == 'genesis_before' && function_exists('gtm4wp_the_gtm_tag')) {
			gtm4wp_the_gtm_tag();
		}
	}
	
	
}

$Genesis_Gtm4wp = new Genesis_Gtm4wp;