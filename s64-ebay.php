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
/* ADD SHORTCODE(S)											 */
/*************************************************************/

add_shortcode("s64-ebay", "s64ebay_handler");

/*************************************************************/
/* SHORTCODE HANDLER(S)										 */
/*************************************************************/

function s64ebay_handler($atts) 
{
  	$s64ebay_output = s64ebay_function($atts);
  	return $s64ebay_output;
}

/*************************************************************/
/* SHORTCODE FUNCTION(S)									 */
/*************************************************************/

function s64ebay_function($atts) 
{
	extract(shortcode_atts(array('width' => '', 'height' => '',), $atts ));
  	return '<p>Width:"'. $width .'"</p><p>Height:"'. $height .'"</p>';
}
















?>