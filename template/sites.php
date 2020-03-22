<?php
/*
Template Name: Sites
*/

get_header(); ?>

  <?php get_template_part( 'template-parts/hero', 'hero' ) ?>

  <section class="section -marginBottom">
    <div class="grid">
      <div class="section__cards">
      <?php
        $today = date('Y-m-d H:i:s');
        $args = array(
          'post_type' => 'site'
        );
        
        query_posts( $args );

        if(have_posts()) :
          while(have_posts()) : the_post(); 
          
          get_template_part('template-parts/card', 'card');

          endwhile;
        endif;
        // Reset Query
        wp_reset_query();
      ?>
      </div>
    </div>
  </section>

<?php
get_footer();
