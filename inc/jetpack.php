<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package ladyfest tln 15
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function lft_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'lft_jetpack_setup' );
