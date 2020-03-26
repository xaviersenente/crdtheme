<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package crdtheme
 */

get_header();
?>

	<?php
	if ( have_posts() ) :
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
	endif;
	?>


<?php
get_footer();
