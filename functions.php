<?php
/**
 * Fonction du thèmes
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

if ( ! function_exists( 'crdtheme_setup' ) ) :
	/**
	 * Configure les valeurs par défaut du thème et enregistre la prise en charge de diverses fonctionnalités WordPress.
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
		
		/**
		 * Enregistre la prise en charge de certaines fonctionnalités pour un type de publication.
		 * @link https://developer.wordpress.org/reference/functions/add_post_type_support/
		 */
		// permet la prise en charge des extraits.
		add_post_type_support( 'page', 'excerpt' );

		/**
		 * Enregistre les emplacements du menu de navigation pour un thème.
		 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
		 */
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'crdtheme' )
		) );
		
	}
endif;
/**
 * add_action() accroche une fonction à une action spécifique.
 * @link https://developer.wordpress.org/reference/functions/add_action/
 * @param string 'after_setup_theme' => Se déclenche après le chargement du thème.
 */
add_action( 'after_setup_theme', 'crdtheme_setup' );


/**
 * File d'attente des scripts et des styles.
 */
function crdtheme_scripts() {
	/**
	 * wp_enqueue_style() et wp_enqueue_script() permettent de charger respectivement une feuille de style et un script. 
	 * Cette action s'effectue depuis la fonction wp_head() ou wp_footer()
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/
	 * @link https://developer.wordpress.org/themes/basics/including-css-javascript/
	 */
	wp_enqueue_style( 'crdtheme-style', get_stylesheet_uri() );

	wp_enqueue_script( 'crdtheme-vendors', get_template_directory_uri() . '/js/vendors.js');
	wp_enqueue_script( 'crdtheme-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '', true );

}
/**
 * @param string 'wp_enqueue_scripts' => Se déclenche lorsque les scripts et les styles sont mis en file d'attente.
 */
add_action( 'wp_enqueue_scripts', 'crdtheme_scripts' );

/**
 * On définit les blocs disponnibles dans l'éditeur Gutenberg
 * et on désactive certaines de ses fonctionnalités
 */
function crdtheme_gutenberg_blocks() {
  return array(
		'core/paragraph',
		'core/heading',
		'core/quote',
		'core/list',
    'core/image',
    'core/gallery',
    'core/table',
  );
}
/**
 * accroche une fonction ou une méthode à une action de filtrage spécifique.
 * @param string 'allowed_block_types' => Filtre les types de bloc autorisés par Gutenberg.
 */
add_filter( 'allowed_block_types', 'crdtheme_gutenberg_blocks' );

// Désactive les tailles de police manuelles
add_theme_support( 'disable-custom-font-sizes' );

// Désactive les couleurs personnalisables
add_theme_support( 'disable-custom-colors' );

// supprime la palette de couleurs
add_theme_support( 'editor-color-palette' );

/**
 * La fonction add_image_size peprmet de définir de nouvelles tailles d'image
 * @link https://developer.wordpress.org/reference/functions/add_image_size/
 */

add_image_size( 'square', 1024, 1024, true);


if( function_exists('acf_add_options_page') ) {
	/**
	 * Ajoute une page d'options au menu d'administration.
	 * Les pages d'options sont utilisées pour stocker les paramètres globaux. 
	 * Ces paramètres ne sont pas liés à une publication spécifique, mais sont stockés dans la table wp_options.
	 * @link https://www.advancedcustomfields.com/resources/acf_add_options_page/
	 */
	acf_add_options_page([
		'page_title' => 'Infos générales',
		'menu_title' => 'Infos',
		'menu_slug' => 'infos-site',
		'capability' => 'edit_posts',
		'parent_slug' => '',
		'position' => 3,
		'icon_url' => false,
		'redirect' => false,
		'post_id' => 'infos',
		'autoload' => false,
		'update_button' => 'Mettre à jour',
	]);
}

/* Pour activer la carte Google map */
function google_map_api() {
  acf_update_setting('google_api_key', 'AIzaSyCOKyUna7aQ62jzqgj0szNLExpgDGHThV4');
}
add_action('acf/init', 'google_map_api');

/**
 * La classe Walker_Nav_Menu permet de personnaliser le rendu des menus de wordpress
 * @link https://developer.wordpress.org/reference/classes/walker_nav_menu/
 */
class WPDocs_Walker_Nav_Menu extends Walker_Nav_Menu {

	private $menuClass 						 = 'menu__list';
	private $menuItemClass 				 = 'menu__item';
	private $menuItemCurrentClass  = '-current';
	private $menuItemDropdownClass = '-hasDropdown';
	private $menuItemBtn					 = '-btn';
	private $menuLinkClass 				 = 'menu__link';
	private $submenuClass 				 = 'submenu__list';
	private $submenuItemClass 		 = 'submenu__item';
 
	/**
	 * Starts the list before the elements are added.
	 *
	 * Adds classes to the unordered list sub-menus.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
			// Depth-dependent classes.
			$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
			$display_depth = ( $depth + 1); // because it counts the first submenu as 0
			$classes = array( $this->submenuClass );
			$class_names = implode( ' ', $classes );

			// Build HTML for output.
			$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
	}

	/**
	 * Start the element output.
	 *
	 * Adds main/sub-classes to the list items and links.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 * @param int    $id     Current item ID.
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

		// Depth-dependent classes.
		$depth_classes = array(
			( $depth == 0 ? $this->menuItemClass : $this->submenuItemClass ),
		);
		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

		// Passed classes.
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$myClasses = array();
		//print_r($args->walker->has_children);
		if ( isset( $args->walker->has_children ) && $args->walker->has_children ) {
			$myClasses[] = $this->menuItemDropdownClass;
		}
		if ( in_array( 'current-menu-item', $classes, true ) || in_array( 'current-menu-parent', $classes, true ) ) {
			$myClasses[] = 'active';
		}
		if ( in_array( $this->menuItemBtn, $classes, true ) ) {
			$myClasses[] = $this->menuItemBtn;
		}
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $myClasses ), $item ) ) );

		// Build HTML.
		$output .= $indent . '<li class="' . $depth_class_names . ' ' . $class_names . '">';

		// Link attributes.
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= ' class="'.$this->menuLinkClass.'"';

		// Build HTML output and pass through the proper filter.
		$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after,
			$args->after
		);
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}


function crdtheme_gutenberg_gallery_block() {
	wp_enqueue_script('gutenberg-gallery-block', get_theme_file_uri( '/js/block.js' ), ['wp-blocks']);
}
add_action( 'enqueue_block_editor_assets', 'crdtheme_gutenberg_gallery_block' );

