<?php
/**
 * Translations for Shrink The Web - Website Thumbnails tinymce plugin
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( '_WP_Editors' ) ) {
    require( ABSPATH . WPINC . '/class-wp-editor.php' );
}


$strings = 'tinyMCE.addI18n(
    "' . _WP_Editors::$mce_locale . '.wpthumbtinymce",
	{
		website_thumbnails: "' . esc_js( __( 'Website Thumbnails', 'shrinktheweb-website-preview-plugin' ) ) . '",
		shrink_the_web_website_thumbnails: "' . esc_js( __( 'Shrink The Web - Website Thumbnails', 'shrinktheweb-website-preview-plugin' ) ) . '",
		website_url: "' . esc_js( __( 'Website Url', 'shrinktheweb-website-preview-plugin' ) ) . '",
		website_url_empty: "' . esc_js( __( 'Website URL is empty!', 'shrinktheweb-website-preview-plugin' ) ) . '",
		website_url_tooltip: "' . esc_js( __( 'Website Url', 'shrinktheweb-website-preview-plugin' ) ) . '",
		shortcode_syntax: "' . esc_js( __( 'Shortcode Syntax', 'shrinktheweb-website-preview-plugin' ) ) . '",
		thumb: "' . esc_js( '[thumb]' ) . '",
		stwthumb: "' . esc_js( '[stwthumb]' ) . '",
		create_link: "' . esc_js( __( 'Create link?', 'shrinktheweb-website-preview-plugin' ) ) . '",
		alt: "' . esc_js( __( 'Alt attribute', 'shrinktheweb-website-preview-plugin' ) ) . '",
		alt_tooltip: "' . esc_js( __( 'Alt attribute', 'shrinktheweb-website-preview-plugin' ) ) . '",
		title: "' . esc_js( __( 'Title attribute', 'shrinktheweb-website-preview-plugin' ) ) . '",
		title_tooltip: "' . esc_js( __( 'Title attribute', 'shrinktheweb-website-preview-plugin' ) ) . '",
		no: "' . esc_js( __( 'No', 'shrinktheweb-website-preview-plugin' ) ) . '",
		yes: "' . esc_js( __( 'Yes', 'shrinktheweb-website-preview-plugin' ) ) . '",
		size: "' . esc_js( __( 'Size', 'shrinktheweb-website-preview-plugin' ) ) . '",
		mcr: "' . esc_js( __( 'Micro', 'shrinktheweb-website-preview-plugin' ).' (75x56)' ) . '",
		tny: "' . esc_js( __( 'Tiny', 'shrinktheweb-website-preview-plugin' ).' (90x68)' ) . '",
		vsm: "' . esc_js( __( 'Very Small', 'shrinktheweb-website-preview-plugin' ).' (100x75)' ) . '",
		sm: "' . esc_js( __( 'Small', 'shrinktheweb-website-preview-plugin' ).' (120x90)' ) . '",
		lg: "' . esc_js( __( 'Large', 'shrinktheweb-website-preview-plugin' ).' (200x150)' ) . '",
		xlg: "' . esc_js( __( 'Extra Large', 'shrinktheweb-website-preview-plugin' ).' (320x240)' ) . '",
		custom: "' . esc_js( __( 'Custom', 'shrinktheweb-website-preview-plugin' ) ) . '",
		custom_size: "' . esc_js( __( 'Custom size', 'shrinktheweb-website-preview-plugin' ) ) . '",
		custom_size_tooltip: "' . esc_js( __( 'Custom size attribute, which can be a number e.g. 500 or both width and height e.g. 640x320.', 'shrinktheweb-website-preview-plugin' ) ) . '",
		custom_filename: "' . esc_js( __( 'Custom filename', 'shrinktheweb-website-preview-plugin' ) ) . '",
		custom_filename_tooltip: "' . esc_js( __( 'Custom filename attribute, which can contain letters, numbers, hyphens and underscores.', 'shrinktheweb-website-preview-plugin' ) ) . '",
		full_length: "' . esc_js( __( 'Full length', 'shrinktheweb-website-preview-plugin' ) ) . '",
		screen: "' . esc_js( __( 'Screen', 'shrinktheweb-website-preview-plugin' ) ) . '",
		screen_tooltip: "' . esc_js( __( 'Screen attribute to set custom thumbnail creator\'s browser size, e.g. 1280x960.', 'shrinktheweb-website-preview-plugin' ) ) . '"
	}
)';