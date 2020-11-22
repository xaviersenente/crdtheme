<?php
/**
 * All add_action() calls.
 */

// Initialisation des fonctions personnalisées du thème.
add_action( 'after_setup_theme', 'crdtheme_setup' );

// Add Gutenberg script.
add_action( 'enqueue_block_editor_assets', 'crdtheme_gutenberg_gallery_block' );

// Register the menu locations.
add_action( 'init', 'crdtheme_register_menus' );

// File d'attente des styles et des scripts
add_action( 'wp_enqueue_scripts', 'crdtheme_scripts_styles' );

// Pour activer la carte Google map
add_action('acf/init', 'google_map_api');

add_action( 'pre_get_posts', 'crdtheme_custom_query_vars' );