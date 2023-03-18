<?php

require_once("logic/classes/WP_Bootstrap_Navwalker.php");

function my_theme_enqueue_styles() {
	wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css' );
	
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
		wp_register_script( 'bootstrap-bundle', get_template_directory_uri() . '/bootstrap/bootstrap.bundle.min.js', array("bootstrap"), '1.0.0', true );
		// wp_register_script( 'bootstrap-esm', get_template_directory_uri() . '/js/bootstrap.esm.min.js', array("bootstrap-bundle"), '1.0.0', true );
		wp_register_script( 'main', get_template_directory_uri() . '/js/dist/all.min.js', array('bootstrap-bundle'), '1.0.0', true );

		wp_enqueue_script( 'bootstrap' );
		wp_enqueue_script( 'bootstrap-bundle' );
		// wp_enqueue_script( 'bootstrap-esm' );
		wp_enqueue_script( 'main' );
}

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
add_action( 'wp_enqueue_scripts', 'my_theme_scripts' );

// Регистрируем меню
function register_my_menu() {
	register_nav_menu('primary', __('Primary Menu', 'bootstrap5wptheme'));
}
add_action('after_setup_theme', 'register_my_menu');
