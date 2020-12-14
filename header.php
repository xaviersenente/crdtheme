<?php
/**
 * L'en-tête du thème
 * Ceci est le fichier d'en-tête de toutes les pages qui appellent la fonction wp_head().
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */

?>
<!DOCTYPE html>
<html <?php 
/**
 * Affiche les attributs de langue pour la balise html
 * @link https://developer.wordpress.org/reference/functions/language_attributes/
 */
  language_attributes(); ?>>
<head>
  <meta charset="<?php 
    /**
     * La fonction bloginfo() permet de récupérer les principales informations du site (nom, description, url…)
     * @link https://developer.wordpress.org/reference/functions/bloginfo/
     */
    bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

  <?php 
  /**
   * La fonction wp_head() permet de charger les styles et scripts spécifiques des plugins + ceux déclarés depuis function.php
   * @link https://developer.wordpress.org/reference/functions/wp_head/
   */
  wp_head(); 
  ?>
</head>

<body <?php 
  /**
   * body_class() affiche les noms de classe de l'élément body.
   * @link https://developer.wordpress.org/reference/functions/body_class/
   */
  body_class(); ?>>

	<header class="header headroom">
		<div class="header__start">
      <?php 
        /**
         * Détermine si le site possède un logo personnalisé.
         * @link https://developer.wordpress.org/reference/functions/has_custom_logo/
         */
        if ( has_custom_logo() ) :
          /**
           * wp_get_attachment_image_src() renvoie l'image attachée
           * @link https://developer.wordpress.org/reference/functions/wp_get_attachment_image_src/
           * 
           * get_theme_mod() récupère la valeur de modification du thème pour le thème actuel.
           * @link https://developer.wordpress.org/reference/functions/get_theme_mod/
           */
          $logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) );
        
      ?>
      <a class="header__logo" href="<?php 
        /**
         * home_url() récupère l'URL du site actuel
         * @link https://developer.wordpress.org/reference/functions/home_url/
         */
        echo esc_url( home_url( '/' ) ); ?>" aria-label="Logo du Conservatoire">
        <img src="<?php echo $logo[0]; ?>" class="style-svg"/>
      </a>
      <?php endif; ?>
    </div>
		<div class="header__end">
      <button class="header__menuBtn menuBurger" aria-label="menu" aria-expanded="false" aria-controls="mainNav">
        <span class="menuBurger__bar" aria-hidden="true"></span>
      </button>
      <?php get_search_form(); ?>
      <nav class="header__menu menu" id="mainNav" aria-label="Menu principal">
        <?php
        /**
         * wp_nav_menu() permet d'intégrer un menu de worpress avec ces paramètres
         * @link https://developer.wordpress.org/reference/functions/wp_nav_menu/
         */
        wp_nav_menu( array(
          'theme_location' => 'main-menu',
          'container'      => false,
          'menu_class'     => 'menu__list',
          'depth'          => 2,
          'walker'         => new MyCustom_Walker_Nav_Menu()
        ) );
        ?>
      </nav>
      <button class="header__search" aria-label="Rechercher">
				<svg width="24" height="24" aria-hidden="true" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="11" cy="10" r="7" stroke="#191919" stroke-width="2" />
          <path stroke="#191919" stroke-width="2" d="M17.707 17.293l3.536 3.535" />
        </svg>
      </button>
    </div>
        
	</header>

	<main>
