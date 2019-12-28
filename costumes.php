<?php
/**
 * Costumes
 *
 * @package           Costumes
 * @author            Andrea Canton
 * @copyright         2020 Andrea Canton
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:         Costumes
 * Description:         Create custom type for costumes
 * Version:             1.0.0
 * Requires at least:   5.2
 * Requires PHP:        7.2
 * Author:              Andrea Canton
 * Author URI:          http://andreacanton.com/
 * License:             GPL v2 or later
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:         costumes
 * Domain Path:         /languages
 */

function ac_costumes_setup_post_type() {

    register_post_type( 'ac_costumes', array(
        'labels'      => array(
            'name'                  => __('Costumes', 'costumes'),
            'singular_name'         => __('Costume', 'costumes'),
            'add_new'               => __('Add Costume', 'costumes'),
            'add_new_item'          => __('Add New Costume', 'costumes'),
            'edit_item'             => __('Edit Costume', 'costumes'),
            'new_item'              => __('New Costume', 'costumes'),
            'view_item'             => __('View Costume', 'costumes'),
            'view_items'            => __('View Costumes', 'costumes'),
            'search_items'          => __('Search Costumes', 'costumes'),
            'not_found'             => __('No Costumes found', 'costumes'),
            'not_found_in_trash'    => __('No Costumes found in Trash', 'costumes'),
            'all_items'             => __('All Costumes', 'costumes'),

        ),
        'description'   => __('Manage costumes', 'costumes'),
        'public'        => true,
        'has_archive'   => false,
        'rewrite'       => array( 'slug' => 'costumes' ),
        'supports'      => array('title', 'thumbnail'),
        'menu_icon'     => 'dashicons-format-gallery'
    ) );

}
add_action( 'init', 'ac_costumes_setup_post_type' );

function ac_costumes_loaded() {
    $plugin_rel_path = basename( dirname( __FILE__ ) ) . '/languages'; /* Relative to WP_PLUGIN_DIR */
    load_plugin_textdomain( 'costumes', false, $plugin_rel_path );
}
add_action('plugins_loaded', 'ac_costumes_loaded');

function ac_costumes_install() {
    // trigger our function that registers the custom post type
    ac_costumes_setup_post_type();

    // clear the permalinks after the post type has been registered
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'ac_costumes_install' );


function ac_costumes_deactivation() {
    // unregister the post type, so the rules are no longer in memory
    unregister_post_type( 'ac_costumes' );
    // clear the permalinks to remove our post type's rules from the database
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'ac_costumes_deactivation' );