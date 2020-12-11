<?php
/**
 * Fonctions qui ne sont pas appelées à partir des templates 
 * et qui ne peuvent pas être regroupées dans un autre fichier.
 */

function crdtheme_setup() {

  /**
   * Charge les chaînes traduites du thème
   * @link https://developer.wordpress.org/reference/functions/load_theme_textdomain/
   * 
   * get_template_directory() renvoie l'url du répertoire du thème
   * @link https://developer.wordpress.org/reference/functions/get_template_directory/
   */
  load_theme_textdomain( 'crdtheme', get_template_directory() . '/languages' );
  
  /**
   * add_theme_support() enregistre la prise en charge du thème pour des fonctionnalités données.
   * @link https://developer.wordpress.org/reference/functions/add_theme_support/
   */

  // permet aux plugins et aux thèmes de gérer la balise de titre du document.
  add_theme_support( 'title-tag' );

  // permet la prise en charge des images mises en avant.
  add_theme_support( 'post-thumbnails' );

  // permet de rendre le code valide pour HTML5.
  add_theme_support(
    'html5',
    array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
      'style',
      'script',
    )
  );

  /**
   * permet la prise en charge d'un logo personnalisé.
   * @link https://developer.wordpress.org/themes/functionality/custom-logo/
   */
  add_theme_support( 'custom-logo', array(
    'height'      => 250,
    'width'       => 250,
    'flex-width'  => true,
    'flex-height' => true,
  ) );

  // Désactive les tailles de police et couleurs pour Gutenberg
  add_theme_support( 'disable-custom-font-sizes' );
  add_theme_support( 'disable-custom-colors' );
  add_theme_support( 'editor-color-palette' );

  /**
   * Enregistre la prise en charge de certaines fonctionnalités pour un type de publication.
   * @link https://developer.wordpress.org/reference/functions/add_post_type_support/
   */
  // permet la prise en charge des extraits.
  add_post_type_support( 'page', 'excerpt' );

  /**
   * La fonction add_image_size peprmet de définir de nouvelles tailles d'image
   * @link https://developer.wordpress.org/reference/functions/add_image_size/
   */
  add_image_size( 'square', 1024, 1024, true);
  add_image_size( 'paysage', 1024, 680, true);

}

/**
 * File d'attente des scripts et des styles.
 */
function crdtheme_scripts_styles() {
	/**
	 * wp_enqueue_style() et wp_enqueue_script() permettent de charger respectivement une feuille de style et un script. 
	 * Cette action s'effectue depuis la fonction wp_head() ou wp_footer()
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/
	 * @link https://developer.wordpress.org/themes/basics/including-css-javascript/
	 */

	wp_enqueue_style( 'crd-style', get_template_directory_uri() . '/dist/css/style.css' );

	wp_enqueue_script( 'crd-vendors', get_template_directory_uri() . '/dist/js/vendors.js');
	wp_enqueue_script( 'crd-scripts', get_template_directory_uri() . '/dist/js/scripts.js', array(), '', true );

	wp_register_script( 'googlemap', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyChc9PPkTuh3w_BmUT4RgWYMZUK194x5P4' , '', null , true );
	wp_register_script( 'gmap', get_template_directory_uri() . '/dist/js/gmap.js' , '', null, true );

	wp_localize_script( 'gmap', 'themeUri', get_template_directory_uri() );
	
	if (is_singular( 'site' ) || is_post_type_archive( 'site' ) || is_page( 'Contact' )) {
		wp_enqueue_script( 'googlemap' );
		wp_enqueue_script( 'gmap' );
	}

}

/**
 * Enregistre les emplacements du menu de navigation pour un thème.
 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
 */
function crdtheme_register_menus() {
  register_nav_menus( array(
    'main-menu' => esc_html__( 'En-tête de page', 'crdtheme' ),
    'footer-menu' => esc_html__( 'Pied de page', 'crdtheme' )
  ) );
}

/**
 * @link https://presscustomizr.com/snippet/three-techniques-to-alter-the-query-in-wordpress/
 */
function crdtheme_custom_query_vars( $query ) {
  // global $wp_query;
  if ( $query->is_main_query() ) {

    if ( is_post_type_archive( 'event' ) || is_tax( 'location' ) || is_tax( 'cat_event' ) ) {
      $today = date('Y-m-d H:i:s');
      $query->set( 'posts_per_page', 6 );
      $query->set( 'meta_key', 'date' );
      $query->set( 'orderby', 'meta_value' );
      $query->set( 'order', 'ASC' );
      $query->set( 'meta_query', array(
        array(
          'key' => 'date',
          'value' => $today,
          'compare' => '>='
        )
      ));
    }

  }
  return $query;
}
