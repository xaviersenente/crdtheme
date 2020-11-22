<?php
/**
 * Le template qui affiche toutes les pages par défaut.
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * get_header() charge le template d'en-tête.
 * @link https://developer.wordpress.org/reference/functions/get_header/
 */

get_header(); ?>

	<?php get_template_part( 'template-parts/hero', 'hero' ) ?>

	<?php
		if(have_posts()) : ?>
		<div class="grid wrapper">
			<?php	while(have_posts()) : the_post(); 
			
				get_template_part('template-parts/card', 'card');

			endwhile; ?>
		</div>
		<?php	
		the_posts_pagination(); 
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