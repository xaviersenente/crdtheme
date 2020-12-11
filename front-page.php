<?php get_header(); ?>

<?php
	if ( have_posts() ) :
		/**
		 * La boucle de wordpress
		 * @link https://developer.wordpress.org/themes/basics/the-loop/
		 */
		while ( have_posts() ) :
			the_post();
      get_template_part( 'template-parts/hero', 'hero' );

      /**
       * @link https://www.advancedcustomfields.com/resources/flexible-content/
       */
      if( have_rows('section') ):
        while( have_rows('section') ): the_row();

          // Section présentation CRD avec chiffres
          if( get_row_layout() == 'section_chiffres' ): 
            $chapo    = get_sub_field('chapo_section_chiffres');
            $ctaBtn   = get_sub_field('cta_btn_section_chiffres');
            $ctaTxt   = get_sub_field('cta_txt_section_chiffres');
            $ctaLink  = get_sub_field('cta_link_section_chiffres');
            $image    = get_sub_field('image_section_chiffres');
            $chiffres = 'chiffres_section_chiffres';
            ?>

            <section class="grid crd">
              <div class="crd__img">
                <?php echo wp_get_attachment_image($image['ID'], 'full'); ?>
              </div>
              <header class="crd__header">
                <p class="crd__title"><?php echo $chapo; ?></p>
                <?php if( $ctaBtn ): ?>
                  <a class="crd__link btn" href="<?php echo $ctaLink; ?>">
                    <svg class="btn__arrow" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M23.354 12.354a.5.5 0 000-.708l-3.182-3.182a.5.5 0 10-.707.708L22.293 12l-2.828 2.828a.5.5 0 10.707.708l3.182-3.182zM0 12.5h23v-1H0v1z" fill="#1C1514" />
                    </svg>
                    <?php echo $ctaTxt; ?>
                  </a>
                <?php endif; ?>
              </header>
              <?php if( have_rows( $chiffres ) ): ?>
                <div class="crd__stats">
                  <?php while( have_rows( $chiffres ) ) : the_row(); 
                    $chiffre = get_sub_field('chiffre_section_chiffres');
                    $label   = get_sub_field('label_section_chiffres');
                  ?>
                    <p class="stat">
                      <span class="stat__chiffre"><?php echo $chiffre; ?></span>
                      <span class="stat__text"><?php echo $label; ?></span>
                    </p>
                  <?php endwhile; ?>
                </div>
              <?php endif;?>
              <div class="crd__bg"></div>
            </section>

            <?php 
              // Section type de contenu (Agenda ou sites)
              elseif( get_row_layout() == 'section_cpt' ): 
                $title   = get_sub_field('titre_section_cpt');
                $chapo   = get_sub_field('chapo_section_cpt');
                $ctaBtn  = get_sub_field('cta_btn_section_cpt');
                $ctaTxt  = get_sub_field('cta_txt_section_cpt');
                $ctaLink = get_sub_field('cta_link_section_cpt');
                $cptBtn  = get_sub_field('display_section_cpt');
                $cptType = get_sub_field('content_type_section_cpt');
              ?>

            <section class="grid -withHeader section">
              <header class="section__header">
                <h2 class="section__title"><?php echo $title; ?></h2>
                <p class="section__intro"><?php echo $chapo; ?></p>
              </header>
              <?php if( $ctaBtn ): ?>
              <a class="section__link btn" href="<?php echo $ctaLink; ?>">
                <svg class="btn__arrow" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M23.354 12.354a.5.5 0 000-.708l-3.182-3.182a.5.5 0 10-.707.708L22.293 12l-2.828 2.828a.5.5 0 10.707.708l3.182-3.182zM0 12.5h23v-1H0v1z" fill="#1C1514" />
                </svg>
                <?php echo $ctaTxt; ?>
              </a>
              <?php endif; ?>
              <?php if( $cptBtn ): ?>
              <?php
                if( $cptType['value'] == 'events' ) {
                  $today = date('Y-m-d H:i:s');
                  $args = array(
                    'post_type' => 'event',
                    'posts_per_page' => 3,
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
                } else {
                  $args = array(
                    'post_type' => 'site',
                    'posts_per_page' => 3,
                    'orderby' => 'meta_value',
                    'order' => 'ASC'
                  );
                }
                /**
                 * query_posts() configure la boucle avec des paramètres de requête personnalisés
                 * @link https://developer.wordpress.org/reference/functions/query_posts/
                 */
                query_posts( $args );

                if(have_posts()) :
                  while(have_posts()) : the_post(); 
                  
                  get_template_part('template-parts/card', 'card');

                  endwhile;
                endif;
                /**
                 * Détruit la requête précédente et configure une nouvelle requête.
                 * @link https://developer.wordpress.org/reference/functions/wp_reset_query/
                 */
                wp_reset_query();
              ?>
              <?php endif; ?>
            </section>

            <?php 
              // Section inscription
              elseif( get_row_layout() == 'section_img_bg' ):
                $title   = get_sub_field('titre_section_img_bg');
                $chapo   = get_sub_field('chapo_section_img_bg');
                $ctaBtn  = get_sub_field('cta_btn_section_img_bg');
                $ctaTxt  = get_sub_field('cta_txt_section_img_bg');
                $ctaLink = get_sub_field('cta_link_section_img_bg');
                $image   = get_sub_field('image_section_img_bg');
              ?>

            <section class="grid -withHeader -inverse -withoutMargin section -bg">
              <header class="section__header -inverse">
                <h2 class="section__title"><?php echo $title; ?></h2>
                <p class="section__intro">
                <?php echo $chapo; ?>
                </p>
              </header>
              <?php if( $ctaBtn ): ?>
              <a class="section__link btn -outlined" href="<?php echo $ctaLink; ?>">
                <svg class="btn__arrow" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M23.354 12.354a.5.5 0 000-.708l-3.182-3.182a.5.5 0 10-.707.708L22.293 12l-2.828 2.828a.5.5 0 10.707.708l3.182-3.182zM0 12.5h23v-1H0v1z" fill="#1C1514" />
                </svg>
                <?php echo $ctaTxt; ?>
              </a>
              <?php endif; ?>
              <div class="duotone section__img">
                <?php echo wp_get_attachment_image($image['ID'], 'full'); ?>
              </div>
            </section>
            
          <?php endif; ?>
        <?php endwhile; ?>
      <?php endif; ?>
    <?php endwhile; ?>
  <?php endif; ?>

<?php
get_footer();
