<?php
/*
Template Name: Home
*/

get_header(); ?>

  <?php 
    /**
     * get_template_part() permet de charger un morceau de template.
     * Utile lorsque le même code est utilisé à plusieurs endroits du thème.
     * @link https://developer.wordpress.org/reference/functions/get_template_part/
     */
  get_template_part( 'template-parts/hero', 'hero' ) ?>

  <?php 
  /**
   * @link https://www.advancedcustomfields.com/resources/flexible-content/
   */
  if( have_rows('section') ):
    while( have_rows('section') ): the_row();
      if( get_row_layout() == 'section_chiffres' ): 
        $chapo    = get_sub_field('chapo_section_chiffres');
        $ctaBtn   = get_sub_field('cta_btn_section_chiffres');
        $ctaTxt   = get_sub_field('cta_txt_section_chiffres');
        $ctaLink  = get_sub_field('cta_link_section_chiffres');
        $image    = get_sub_field('image_section_chiffres');
        $chiffres = 'chiffres_section_chiffres';
        ?>
        <section class="crd">
        <div class="crd__wrapper grid">
          <header class="crd__header rellax" data-rellax-speed="5">
            <p class="crd__content"><?php echo $chapo; ?></p>
            <?php if( $ctaBtn ): ?>
            <div class="crd__link">
              <a class="btn" href="<?php echo $ctaLink; ?>">
                <svg class="btn__arrow" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M23.354 12.354a.5.5 0 000-.708l-3.182-3.182a.5.5 0 10-.707.708L22.293 12l-2.828 2.828a.5.5 0 10.707.708l3.182-3.182zM0 12.5h23v-1H0v1z" fill="#1C1514" />
                </svg>
                <?php echo $ctaTxt; ?>
              </a>
            </div>
            <?php endif; ?>
          </header>
          <?php if( have_rows( $chiffres ) ): ?>
            <div class="crd__stats">
            <?php while( have_rows( $chiffres ) ) : the_row(); 
              $chiffre = get_sub_field('chiffre_section_chiffres');
              $label   = get_sub_field('label_section_chiffres');
            ?>
              <div class="stat">
                <div class="stat__chiffre"><?php echo $chiffre; ?></div>
                <div class="stat__text"><?php echo $label; ?></div>
              </div>
            <?php endwhile; ?>
            </div>
          <?php endif;?>
          <div class="crd__bg rellax" data-rellax-speed="5"></div>
          <div class="crd__img">
            <?php echo wp_get_attachment_image($image['ID'], 'full'); ?>
          </div>
        </div>
      </section>

      <?php elseif( get_row_layout() == 'section_cpt' ): 
        $title   = get_sub_field('titre_section_cpt');
        $chapo   = get_sub_field('chapo_section_cpt');
        $ctaBtn  = get_sub_field('cta_btn_section_cpt');
        $ctaTxt  = get_sub_field('cta_txt_section_cpt');
        $ctaLink = get_sub_field('cta_link_section_cpt');
        $cptBtn  = get_sub_field('display_section_cpt');
        $cptType = get_sub_field('content_type_section_cpt');
        ?>
        <section class="section">
        <div class="grid -withHeader">
          <header class="section__header">
            <h2 class="section__title"><?php echo $title; ?></h2>
            <p class="section__intro"><?php echo $chapo; ?></p>
          </header>
          <?php if( $ctaBtn ): ?>
          <div class="section__link">
            <a class="btn" href="<?php echo $ctaLink; ?>">
              <svg class="btn__arrow" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M23.354 12.354a.5.5 0 000-.708l-3.182-3.182a.5.5 0 10-.707.708L22.293 12l-2.828 2.828a.5.5 0 10.707.708l3.182-3.182zM0 12.5h23v-1H0v1z" fill="#1C1514" />
              </svg>
              <?php echo $ctaTxt; ?>
            </a>
          </div>
          <?php endif; ?>
          <?php if( $cptBtn ): ?>
          <div class="section__cards">
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
          </div>
          <?php endif; ?>
        </div>
      </section>
      <?php elseif( get_row_layout() == 'section_img_bg' ):
        $title   = get_sub_field('titre_section_img_bg');
        $chapo   = get_sub_field('chapo_section_img_bg');
        $ctaBtn  = get_sub_field('cta_btn_section_img_bg');
        $ctaTxt  = get_sub_field('cta_txt_section_img_bg');
        $ctaLink = get_sub_field('cta_link_section_img_bg');
        $image   = get_sub_field('image_section_img_bg');
        ?>
        <section class="section -bg">
        <div class="grid -withHeader -inverse">
          <header class="section__header -inverse">
            <h2 class="section__title"><?php echo $title; ?></h2>
            <p class="section__intro">
            <?php echo $chapo; ?>
            </p>
          </header>
          <?php if( $ctaBtn ): ?>
          <div class="section__link">
            <a class="btn -inverse" href="<?php echo $ctaLink; ?>">
              <svg class="btn__arrow" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M23.354 12.354a.5.5 0 000-.708l-3.182-3.182a.5.5 0 10-.707.708L22.293 12l-2.828 2.828a.5.5 0 10.707.708l3.182-3.182zM0 12.5h23v-1H0v1z" fill="#1C1514" />
              </svg>
              <?php echo $ctaTxt; ?>
            </a>
          </div>
          <?php endif; ?>
        </div>
        <div class="duotone section__img">
          <?php echo wp_get_attachment_image($image['ID'], 'full'); ?>
        </div>
      </section>
      <?php endif; ?>
    <?php endwhile; ?>
  <?php endif; ?>

<?php
get_footer();
