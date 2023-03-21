<?php

require_once("logic/utils.php");
require_once("logic/classes/WP_Bootstrap_Navwalker.php");

function my_theme_enqueue_styles() {
	wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', array(), 
		'1.1.0' );
	
	wp_enqueue_style( 
		'materialicons', 
		get_template_directory_uri() . '/libs/materialdesign-icons/css/materialdesignicons.min.css', 
		array('style'), 
		'1.0.0' 
	);
	
	wp_enqueue_style( 
		'bootstrap', 
		get_template_directory_uri() . '/bootstrap/bootstrap.min.css', 
		array('style'), 
		'1.0.0' 
	);
	
	wp_enqueue_style( 
		'bootstrap-grid', 
		get_template_directory_uri() . '/bootstrap/bootstrap-grid.min.css', 
		array('bootstrap'), 
		'1.0.0' 
	);
	
	wp_enqueue_style( 
		'bootstrap-utilities', 
		get_template_directory_uri() . '/bootstrap/bootstrap-utilities.min.css', 
		array('bootstrap-grid'), 
		'1.0.0' 
	);
	
	wp_enqueue_style( 
		'all', 
		get_template_directory_uri() . '/css/all.min.css', 
		array('bootstrap-utilities'), 
		'1.0.0' 
	);
}

function my_theme_scripts() {
		wp_register_script( 'bootstrap', get_template_directory_uri() . '/bootstrap/bootstrap.min.js', array("jquery"), '1.0.0', true );
		wp_register_script( 'main', get_template_directory_uri() . '/js/dist/all.min.js', array('bootstrap'), '1.0.0', true );

		wp_enqueue_script( 'bootstrap' );
		wp_enqueue_script( 'main' );
}

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
add_action( 'wp_enqueue_scripts', 'my_theme_scripts' );

function register_my_menu() {
	register_nav_menu('primary', __('Primary Menu', 'bootstrap5wptheme'));
}
add_action('after_setup_theme', 'register_my_menu');

function mytheme_add_settings_section() {
	add_settings_section(
		'mytheme_section',
		'Настройки телефона',
		'mytheme_section_callback',
		'general'
	);
}

add_action( 'admin_init', 'mytheme_add_settings_section' );

function mytheme_section_callback() {
	echo '<p>Введите номер телефона:</p>';
}

function mytheme_add_settings_field() {
	add_settings_field(
		'mytheme_phone_number',
		'Номер телефона',
		'mytheme_phone_number_callback',
		'general',
		'mytheme_section'
	);
}

add_action( 'admin_init', 'mytheme_add_settings_field' );

function mytheme_phone_number_callback() {
	$value = get_option( 'mytheme_phone_number' );
	echo '<input type="text" name="mytheme_phone_number" value="' . esc_attr( $value ) . '" />';
}

function mytheme_register_settings() {
	register_setting(
		'general',
		'mytheme_phone_number'
	);
}

add_action( 'admin_init', 'mytheme_register_settings' );

function in_cart($product_id) {
	$cart_contents = WC()->cart->get_cart_contents();
	foreach ($cart_contents as $cart_item) {
    if($cart_item['data'] -> get_id() == $product_id) {
    	return true;
    }
	}

	return false;
}

function mytheme_product_tag_template( $template, $template_name, $template_path ) {
  if ( 'taxonomy-product_tag.php' == $template_name ) {
    $template = get_stylesheet_directory() . '/taxonomy-product_tag.php';
  }
  return $template;
}

add_filter( 'woocommerce_locate_template', 'mytheme_product_tag_template', 10, 3 );
