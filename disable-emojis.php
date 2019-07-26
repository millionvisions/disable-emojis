<?php declare( strict_types = 1 );

/*
 * Plugin Name:     Disable Emojis
 * Plugin URI:      https://github.com/millionvisions/disable-emojis/
 * Author:          MillionVisions
 * Author URI:      https://github.com/millionvisions
 * License:         MIT
 * License URI:     https://github.com/millionvisions/portfolio-theme/blob/master/LICENSE
 * Text Domain:     mv-disable-emojis
 * Version:         0.1.0
 */

/*
 * This file is part of the 'disable-emojis' package.
 *
 * (c) MillionVisions
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace MillionVisions\DisableEmojis;

// return if access directly
defined( 'ABSPATH' ) or die;

/**
 * @since   0.1.0
 *
 * @hooked  action  init
 *
 * @return  void
 */
function remove_action_hooks() : void {
    \remove_action( 'admin_print_scripts',  'print_emoji_detection_script' );
    \remove_action( 'admin_print_styles',   'print_emoji_styles' );
    \remove_action( 'wp_head',              'print_emoji_detection_script', 7 );
    \remove_action( 'wp_print_styles',      'print_emoji_styles' );
}

\add_action( 'init', __NAMESPACE__ . '\\remove_action_hooks' );

/**
 * @since   0.1.0
 *
 * @hooked  action  init
 *
 * @return  void
 */
function remove_filter_hooks() : void {
    \remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    \remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    \remove_filter( 'wp_mail',          'wp_staticize_emoji_for_email' );
}

\add_action( 'init', __NAMESPACE__ . '\\remove_filter_hooks' );

/**
 * @since   0.1.0
 *
 * @hooked  filter  tiny_mce_plugins
 *
 * @param   array   $plugins
 * @return  array
 */
function remove_tiny_mce_plugin( array $plugins ) : array {

    return array_diff( $plugins, [ 'wpemoji' ] );
}

\add_filter( 'tiny_mce_plugins', __NAMESPACE__ . '\\remove_tiny_mce_plugin' );
