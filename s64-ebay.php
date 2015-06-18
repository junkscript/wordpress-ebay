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
add_action( 'wp_enqueue_scripts', 'load_jquery' );
add_action( 'wp_enqueue_scripts', 'add_slider_script' ); // LOAD UNSLIDER


function load_jquery() {
    if ( ! wp_script_is( 'jquery', 'enqueued' )) {

        //Enqueue
        wp_enqueue_script( 'jquery' );

    }
}


function add_slider_script() 
{
  wp_register_style('slider_style', plugins_url('css/slick.css', __FILE__));
  wp_register_script('slider_script', plugins_url('js/slick.min.js', __FILE__), array('jquery'),'1.0', true);
  wp_register_script('s64_script', plugins_url('js/s64-script.js', __FILE__), array('jquery'),'1.0', true);

  wp_enqueue_style('slider_style');
  wp_enqueue_script('slider_script');
  wp_enqueue_script('s64_script');
}


/*************************************************************/
/* PLUGIN SETTINGS PAGE */
/*************************************************************/

function update_s64_ebay_affiliate_id() 
{
	// REGISTER GROUP 
  	register_setting( 's64-ebay-setting-1', 's64-ebay-affiliate-id' );
  	register_setting( 's64-ebay-setting-1', 's64-ebay-api-key' );
    register_setting( 's64-ebay-setting-1', 's64-ebay-custom-css' );
}
 
function s64_ebay_setup_menu()
{
	// ADD SETTINGS PAGE
    add_menu_page( 'SUPER64 ebay plugin', '<span style="color:white">SUPER</span><span style="color:red;">64</span> - eBay Plugin', 'manage_options', 's64-ebay', 's64_settings_init', plugin_dir_url( __FILE__ ) . 'images/ebay.png' );

}	
 
function s64_settings_init()
{      
	// CREATE SETTINGS PAGE HTML
	// FIELDS: AFFILIATE ID, API KEY, CSS
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
        <tr valign="top">
        <th scope="row">eBay API Key:</th>
	      <td><input type="text" name="s64-ebay-api-key" value="<?php echo get_option( 's64-ebay-api-key' ); ?>"/></td>
        </tr>
        <tr valign="top">
	      <th scope="row">Custom CSS:</th>
        <td>
          <textarea name="s64-ebay-custom-css" rows="10" cols="50"><?php echo get_option( 's64-ebay-custom-css' ); ?></textarea>
        </td>
        </tr>
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
	// GET SAVED OPTIONS FROM PLUGIN ADMIN AREA
	$publisher_id = get_option( 's64-ebay-affiliate-id' );
  $api_key = get_option( 's64-ebay-api-key' );
  $custom_css = get_option( 's64-ebay-custom-css' );

	// SHORTCODE EXTRACTION
	$shortcode = shortcode_atts(
        array(
          'global_id'=>'EBAY-GB', // Default to ebay.co.uk
          'keywords' => get_the_title(), // Default to the title of the post
          'count' => '3', // Default to 3 wide 1 high
          'hide_title' => Null,
          'categories' => Null,
          'condition' => Null,
          'exclude_category' => Null,
          'exclude_seller' => Null,
          'free_shipping' => Null,
          'fixed_price' => Null,
          'min_price' => Null,
          'max_price' => Null,
          'outlet_only' => Null,
          'sellers' => Null
        ),
        $atts
      );

  // Quit if there's a problem querying ebay.
  try {
    $query = findItemsAdvancedQuery($publisher_id, $api_key, $shortcode);
    $ebay_response = searchEbay($query);
  }catch(Exception $ex) {
    return Null; # TODO: Should we return Null or some HTML if there's a problem?
  }

  // Make and return the HTML.
  $hide_title = init_bool($shortcode['hide_title']);
  $item_ul = ebayResponseToHTML($ebay_response, $hide_title);  # The eBay items in a <ul> html list.
  $css = "<style>$custom_css</style>";  # This plugins css.



  return $css . $item_ul;
}
