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

	<section class="section -marginBottom">
    <div class="grid">
      <div class="section__cards">
      <?php
				if ( is_post_type_archive( 'site' ) ) {
					$args = array(
						'post_type' => 'site'
					);
				} elseif ( is_post_type_archive( 'event' ) ) {
					$today = date('Y-m-d H:i:s');
					$args = array(
						'post_type' => 'event',
						'posts_per_page' => 9,
						'meta_key' => 'date',
						'orderby' => 'meta_value',
						'order' => 'ASC',
						'meta_query' => array(
							array(
								'key' => 'date',
								'value' => $today,
								'compare' => '>='
							)
						)
					);
				}
        
        query_posts( $args );

        if(have_posts()) :
          while(have_posts()) : the_post(); 
          
          get_template_part('template-parts/card', 'card');

          endwhile;
        else :

          get_template_part( 'template-parts/content', 'none' );
      
        endif;
      ?>
      </div>
    </div>
  </section>

<?php
/**
 * get_footer() charge le template de pied de page.
 * @link https://developer.wordpress.org/reference/functions/get_footer/
 */
get_footer();