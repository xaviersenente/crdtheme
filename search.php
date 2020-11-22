<?php
/**
 * The template for displaying search results pages
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 * @package crdtheme
 */

get_header();
?>

<?php get_template_part( 'template-parts/hero', 'hero' ) ?>

	<div class="main-column">

		<?php if ( have_posts() ) : 
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'search' );

			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</div>

<?php
get_footer();
