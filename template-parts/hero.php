<div class="hero">
	<div class="grid -hero">
		<header class="hero__header">
      <?php 
        /**
         * Les "conditional tags" sont utilisées pour modifier l'affichage du contenu en fonction des conditions auxquelles la page actuelle correspond.
         * @link https://developer.wordpress.org/themes/basics/conditional-tags/#the-front-page
         */
        if ( is_front_page() ) : ?>

        <h1 class="hero__title">
          <?php echo html_entity_decode( get_bloginfo( 'name' ) ); ?>
        </h1>
        <h3 class="hero__subTitle">
          <?php echo html_entity_decode( get_bloginfo( 'description' ) ); ?>
        </h3>
         
      <?php 
        /**
         * @link https://developer.wordpress.org/themes/basics/conditional-tags/#a-taxonomy-page
         */
        elseif ( is_tax() ) :
          /**
           * Affiche le titre de l'archive en fonction de l'objet interrogé.
           * @link https://developer.wordpress.org/reference/functions/the_archive_title/
           */
          the_archive_title( '<h1 class="page-title">', '</h1>' );
        else :
          /**
           * Ajoute le titre de la page ou post courant(e)
           * @link https://developer.wordpress.org/reference/functions/the_title/
           */
          the_title( '<h1 class="hero__title">', '</h1>' );
        endif
      ?>
		</header>

		<div class="hero__cw <?php if ( is_front_page() ) { echo '-g3col'; } ?>">

      <?php if ( is_front_page() ) :
        /**
         * Boucle du repéteur d'ACF
         * @link https://www.advancedcustomfields.com/resources/repeater/
         */
        if( have_rows( 'item_menu' ) ):
          while ( have_rows( 'item_menu' ) ) : the_row();
            $itemMenuSvg  = get_sub_field( 'item_menu_svg' );
            $itemMenuTxt  = get_sub_field( 'item_menu_txt' );
            $itemMenuLink = get_sub_field( 'item_menu_link' );
      ?>

        <h3 class="hero__cwTitle">
          <a class="hero__cwLink" href="<?php echo $itemMenuLink; ?>">
          <img class="style-svg" src="<?php echo $itemMenuSvg['url']; ?>" alt="Icone <?php echo $itemMenuTxt; ?>">
          <?php echo $itemMenuTxt; ?>
          </a>
        </h3>

      <?php endwhile; 
          endif; 
        elseif ( is_tax() ) :
          /**
           * Affiche la description de la page d'archive
           * @link https://developer.wordpress.org/reference/functions/the_archive_description/
           */
          the_archive_description( '<p class="hero__cwIntro">', '</p>' );
        else : 
          /**
           * @link https://developer.wordpress.org/themes/basics/conditional-tags/#has-an-excerpt
           */
          if ( has_excerpt() ) : ?>

        <p class="hero__cwIntro"><?php echo get_the_excerpt(); ?></p>

      <?php endif; ?>
    <?php endif; ?>
		</div>
	</div>

  <?php if ( is_page( 'sites' ) ) : ?>

  <div class="hero__map map">
    <?php
    $markers = array(
      'post_type' => 'site'
    );
    query_posts( $markers );

    while ( have_posts() ) : the_post();

    $marker = get_field( 'adresse_site' );

    ?>
    <div class="map__marker" data-lat="<?php echo esc_attr( $marker['lat'] ); ?>" data-lng="<?php echo esc_attr( $marker['lng'] ); ?>"></div>

    <?php endwhile;
    // Reset Query
    wp_reset_query();
    ?>
  </div>

  <?php else : ?>

	<div class="duotone hero__img">
    <?php 
    if ( has_post_thumbnail() ) :
      /**
       * Affiche l'image mise en avant
       * @link https://developer.wordpress.org/reference/functions/the_post_thumbnail/
       */
      the_post_thumbnail( 'full' );
    endif; ?>
	</div>

  <?php endif; ?>

</div>