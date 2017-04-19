<?php
/*
Plugin Name: Trestle Default Settings
Description: Alters WordPress settings and defines custom functions. For use with <a href="https://github.com/jspellman814/trestle-theme-wp">trestle-theme-wp</a>.
Version:     1.0
Author:      TrestleMedia
Author URI: https://trestlemedia.com
*/

if (!defined('ABSPATH')) {
  exit;
} // Exit if accessed directly

/**
 * Disable theme file editor
 */
if (!defined('DISALLOW_FILE_EDIT')) {
    define('DISALLOW_FILE_EDIT', true);
}

/**
 * Registers an editor stylesheet for the theme.
 */
add_action('admin_init', 'custom_add_editor_styles');
function custom_add_editor_styles()
{
    add_editor_style('editor-style.css');
}

/**
 * Set Yoast meta box priority as low, after custom fields
 **/
add_filter('wpseo_metabox_prio', 'yoasttobottom');
function yoasttobottom()
{
    return 'low';
}

/**
 * Check if post content is empty
 * http://blog.room34.com/archives/5360
 */
function empty_content($str)
{
    return trim(str_replace('&nbsp;', '', strip_tags($str))) == '';
}

/**
 * Filter the "read more" excerpt string link to the post.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
add_filter('excerpt_more', 'tm_excerpt_more');
function tm_excerpt_more($more)
{
    return ' <a class="more-link" href="' . get_the_permalink() . '" rel="nofollow">MORE</a>';
}
