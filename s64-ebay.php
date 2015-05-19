<?php
/*
Plugin Name: Super64 Ebay
Plugin URI: http://www.super64.net/ebay-plugin
Description: Super64 Ebay
Version: 0.1 BETA
Author: Christopher Emms and Alex Harvey
Author URI: http://www.super64.net/
*/

/*
Super64 Ebay (Wordpress Plugin)
Copyright (C) Christopher Emms and Alex Harvey
Contact us at http://www.super64.net/

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

/*************************************************************/
/* INCLUDE EXTERNAL FUNCTIONS */
/*************************************************************/

include_once( plugin_dir_path( __FILE__ ) . 'ebay/functions.php');


/*************************************************************/
/* ACTION FUNCTION(S) */
/*************************************************************/

add_action('admin_menu', 's64_ebay_setup_menu');
add_action( 'admin_init', 'update_s64_ebay_affiliate_id' );

/*************************************************************/
/* PLUGIN SETTINGS PAGE */
/*************************************************************/

function update_s64_ebay_affiliate_id() 
{
	// REGISTER GROUP 
  	register_setting( 's64-ebay-setting-1', 's64-ebay-affiliate-id' );
}
 
function s64_ebay_setup_menu()
{
	// ADD SETTINGS PAGE
    add_menu_page( 'SUPER64 ebay plugin', '<span style="color:white">SUPER</span><span style="color:red;">64</span> - eBay Plugin', 'manage_options', 's64-ebay', 's64_settings_init' );
}
 
function s64_settings_init()
{      
	// CREATE SETTINGS PAGE HTML
	// ONE FIELD (EBAY AFFILIATE ID)
	// STORED IN WP-OPTIONS TO RETRIEVE LATER
	// (SEE SHORTCODE FUNCTION )
?>

	<h1>SUPER64 - eBay Plugin Settings</h1>
    <h2>Please make sure to enter all details for the plugin to work etc..</h2>
    <form method="post" action="options.php">
	    <?php settings_fields( 's64-ebay-setting-1' ); ?>
	    <?php do_settings_sections( 's64-ebay-setting-1' ); ?>
	    <table class="form-table">
	      <tr valign="top">
	      <th scope="row">eBay Affiliate ID:</th>
	      <td><input type="text" name="s64-ebay-affiliate-id" value="<?php echo get_option( 's64-ebay-affiliate-id' ); ?>"/></td>
	      </tr>
	    </table>
	    <?php submit_button(); ?>
	</form>

<?php
}



/*************************************************************/
/* ADD SHORTCODE(S) */
/*************************************************************/

add_shortcode("s64-ebay", "s64ebay_handler");

/*************************************************************/
/* SHORTCODE HANDLER(S) */
/*************************************************************/

function s64ebay_handler($atts) 
{
  	$s64ebay_output = s64ebay_function($atts);
  	return $s64ebay_output;
}

/*************************************************************/
/* SHORTCODE FUNCTION(S) */
/*************************************************************/

function s64ebay_function($atts) 
{
	// TEST EXTERNAL PHP 
	$test_paragraph = test_function();

	// GET SAVED OPTIONS FROM
	// PLUGIN ADMIN AREA
	$s64_ebay_id = get_option( 's64-ebay-affiliate-id' );

	// SHORTCODE EXTRACTION
	extract(shortcode_atts(array('width' => '', 'height' => '',), $atts ));

  	return '<p>Width:"'. $width .'"</p><p>Height:"'. $height .'"</p>' . 
  	'<br /><br />'. $test_paragraph .'<br /><br />' . 
  	'<p><strong>eBay Affiliate ID:</strong> ' .$s64_ebay_id. '</p>';
}







?>