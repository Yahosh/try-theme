<?php

/**
 * Adds custom query variable
 */
function custom_query_vars() {
	global $wp;
	$wp->add_query_var("custom");
}
add_action( 'init', 'custom_query_vars' );

/**
 * Adds custom rules to wp_rewrite for pretty URLs
 */
function custom_rewrite_rules( $rules ) {
	$custom['custom/(.+)$'] = 'index.php?custom=$matches[1]';
	return $custom + $rules;
}
add_filter( "rewrite_rules_array", "custom_rewrite_rules" );

/**
 * Load custom template when custom query variable is present
 */
function custom_template( $template ) {	
	if( get_query_var("custom") ) {
		add_filter( 'body_class', 'custom_body_class' );
		return TEMPLATEPATH . "/custom.php";
	} else {
		return $template;
	}
}
add_filter( "template_include", "custom_template" );

/**
 * Adds custom body class when custom template is loaded
 */
function custom_body_class( $classes ) {
	$classes[] = "page-template-custom-php";
	return $classes;
}