<?php
/**
 * Le template qui affiche tous les posts par défaut.
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
	while ( have_posts() ) :
		the_post();

		/**
		 * permet de charger un morceau de template
		 * @link https://developer.wordpress.org/reference/functions/get_template_part/
		 */
		get_template_part( 'template-parts/content', get_post_type() );

		// Si les commentaires sont ouverts ou si nous avons au moins un commentaire, chargez le modèle de commentaire.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile; // Fin de la boucle.
	?>

<?php
/**
 * get_footer() charge le template de pied de page.
 * @link https://developer.wordpress.org/reference/functions/get_footer/
 */
get_footer();
