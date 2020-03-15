<?php
/**
 * Le template qui affiche toutes les pages par défaut.
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * get_header() charge le template d'en-tête.
 * @link https://developer.wordpress.org/reference/functions/get_header/
 */

get_header();
?>

	<?php
	/**
	 * La boucle de wordpress
	 * @link https://developer.wordpress.org/themes/basics/the-loop/
	 */
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();

			/**
			 * permet de charger un morceau de template
			 * @link https://developer.wordpress.org/reference/functions/get_template_part/
			 * Ici, il s'agit du fichier 'content-page.php'
			 */
			get_template_part( 'template-parts/card' );

		endwhile; // Fin de la boucle.
	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>

<?php
/**
 * get_footer() charge le template de pied de page.
 * @link https://developer.wordpress.org/reference/functions/get_footer/
 */
get_footer();