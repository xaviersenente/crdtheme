<?php

if( function_exists('acf_add_options_page') ) {
	/**
	 * Ajoute une page d'options au menu d'administration.
	 * Les pages d'options sont utilisées pour stocker les paramètres globaux. 
	 * Ces paramètres ne sont pas liés à une publication spécifique, mais sont stockés dans la table wp_options.
	 * @link https://www.advancedcustomfields.com/resources/acf_add_options_page/
	 */
	acf_add_options_page([
		'page_title' => 'Infos générales',
		'menu_title' => 'Options',
		'menu_slug' => 'infos-site',
		'capability' => 'edit_posts',
		'position' => 3,
		'icon_url' => false,
		'redirect' => false,
		'post_id' => 'infos',
		'autoload' => false,
		'update_button' => 'Mettre à jour',
	]);

	acf_add_options_sub_page(array(
		'page_title' 	=> 'En-têtes des pages archives',
		'menu_title'	=> 'En-têtes archives',
		'parent_slug'	=> 'infos-site',
		'update_button' => 'Mettre à jour',
		'post_id' => 'header_archives',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Sous-menu enseignements',
		'menu_title'	=> 'Enseignements',
		'parent_slug'	=> 'infos-site',
		'update_button' => 'Mettre à jour',
		'post_id' => 'header_enseignements',
	));
}

/* Pour activer la carte Google map */
function google_map_api() {
  acf_update_setting('google_api_key', 'AIzaSyChc9PPkTuh3w_BmUT4RgWYMZUK194x5P4');
}

/* Ajout d'un filtre pour les types de contenu. */
// function acf_load_cpt_field_choices( $field ) {
    
// 	$args = array(
// 		'public'   => true,
// 		'_builtin' => false
//   );
// 	$choices = get_post_types( $args );

// 	// loop through array and add to field 'choices'
// 	if( is_array($choices) ) {
// 		foreach( $choices as $choice ) {
// 			$field['choices'][ $choice ] = $choice;
// 		}
// 	}
	
// 	return $field;
	
// }