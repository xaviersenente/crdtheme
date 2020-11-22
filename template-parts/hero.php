<?php 

  $hero       = get_field('header_archive_default', 'header_archives');
  $hero_event = get_field('header_archive_event', 'header_archives');
  $hero_site  = get_field('header_archive_site', 'header_archives');

  if ( is_post_type_archive( 'event' ) ) {
    $img_archive    = $hero_event['img_header_archive'];
    $chapo_archive  = $hero_event['chapo_header_archive'];
  } elseif ( is_post_type_archive( 'site' ) ) {
    $img_archive    = $hero_site['img_header_archive'];
    $chapo_archive  = $hero_site['chapo_header_archive'];
  } else {
    $img_archive    = $hero['img_header_archive'];
    $chapo_archive  = $hero['chapo_header_archive'];
  }
?>

<div class="grid -fullHeight wrapper -withoutMargin hero">
  <header class="hero__header">
    <h1 class="hero__title">
      <?php crdtheme_display_page_title(); ?>
    </h1>

    <?php 
      /**
       * Les "conditional tags" sont utilisées pour modifier l'affichage du contenu 
       * en fonction des conditions auxquelles la page actuelle correspond.
       * @link https://developer.wordpress.org/themes/basics/conditional-tags/#the-front-page
       */
      if ( is_front_page() ) : ?>

      <h3 class="hero__subTitle">
        <?php echo html_entity_decode( get_bloginfo( 'description' ) ); ?>
      </h3>
        
    <?php endif ?>
  </header>

  <div class="hero__chapo chapo <?php if ( is_front_page() ) { echo '-col3'; } ?>">

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

          <h3 class="chapo__title">
            <a class="chapo__link" href="<?php echo $itemMenuLink; ?>">
            <img class="style-svg" src="<?php echo $itemMenuSvg['url']; ?>" alt="Icone <?php echo $itemMenuTxt; ?>">
            <?php echo $itemMenuTxt; ?>
            </a>
          </h3>

        <?php 
        endwhile; 
      endif; 
    else : 

      if ( is_archive() )       $chapo = $chapo_archive;
      elseif ( is_tax() )       $chapo = the_archive_description();
      elseif ( is_search() )    $chapo = sprintf( __( 'Résultats de la recherche pour : %s' ), strip_tags( get_query_var( 's' ) ) );
      elseif ( has_excerpt() )  $chapo = get_the_excerpt();

      if ( !empty( $chapo ) ) echo '<p class="chapo__text">' . $chapo . '</p>';
      
    endif; ?>
  </div>

  <?php 
  /**
   * Affiche l'image sur les pages d'archive
   * @link https://developer.wordpress.org/reference/functions/the_post_thumbnail/
   */

  if ( is_archive() && ! is_post_type_archive( 'site' ) ) : ?>

    <div class="duotone hero__img">
      <?php echo wp_get_attachment_image( $img_archive, 'full' ); ?>
    </div>

  <?php elseif ( is_archive() && is_post_type_archive( 'site' ) ) : ?>

    <div class="hero__map map" data-zoom="13">
    <?php 
      $markers = array(
        'post_type' => 'site'
      );
      query_posts( $markers );

      while ( have_posts() ) : the_post();

        $marker = get_field( 'adresse_site' ); ?>
          <div class="map__marker" data-lat="<?php echo esc_attr( $marker['lat'] ); ?>" data-lng="<?php echo esc_attr( $marker['lng'] ); ?>"></div>
      <?php endwhile; 
      wp_reset_query();?>
    </div>

  <?php else : ?>

    <div class="duotone hero__img">
      <?php 
        if( has_post_thumbnail() ) the_post_thumbnail( 'full' ); 
        else echo wp_get_attachment_image( $img_archive, 'full' ); 
      ?>
    </div>

  <?php endif; ?>

  <?php if ( is_front_page() ) : ?>
    <div class="hero__patterns rellax" data-rellax-speed="-5">
      <svg viewBox="0 0 1260 700" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g class="curveLines">
          <path d="M714.82,146.75c-45.82,0-83-40.88-83-91.32A97.76,97.76,0,0,1,644.1,7.66" />
          <path d="M983.41,153.39a32.38,32.38,0,1,0,0-64.75h-37" />
          <path d="M826.91,15.58H976.29c56.85,0,102.94,46.28,102.94,103.36S1033.14,222.3,976.29,222.3H931.34" />
          <path d="M928.58,334H1016c50.33,0,92.48,39.34,103.49,92.16" />
          <path d="M847.66,174.15a26.57,26.57,0,1,0-26.56-26.57A26.56,26.56,0,0,0,847.66,174.15Z" />
          <path d="M847.66,222.3c42.17,0,76.36-33.64,76.36-75.13S889.83,72,847.66,72s-76.36,33.64-76.36,75.14" />
          <path d="M165.4,185.77a74.7,74.7,0,1,1-149.4,0" />
          <path d="M798.69,223.13H725.58A83.8,83.8,0,0,0,641.82,307" />
          <path d="M871.31,384.19a32.38,32.38,0,1,0,32.79,32.38V384.19" />
          <path d="M1071.76,537.57c0,46.43,38.08,84.06,85.07,84.06s85.08-37.63,85.08-84.06V447.29" />
          <path d="M1027.45,576.8h-4.22a43.59,43.59,0,1,1,0-87.17H1156a43.59,43.59,0,1,1,0,87.17h-1.3" />
          <path d="M946.43,384.19H1000A64.93,64.93,0,0,1,1065.11,449" />
          <path d="M418.62,338.11a34.07,34.07,0,1,1-34.07-34.45H494.08" />
          <path d="M505.7,226.45H469.75a47.19,47.19,0,0,0-47.05,47.32" />
          <path d="M537.65,190.75V303.66" />
          <path d="M743.91,375.18v10.95a28.12,28.12,0,0,1-56.24,0v-9.07a27.91,27.91,0,0,0-55.81,0v11.16" />
          <path d="M820.68,685.55a34,34,0,1,0-34.44-34A34.25,34.25,0,0,0,820.68,685.55Z" />
          <path d="M536.8,96.94q0,12.45.05,24.91" />
          <path d="M536.8,49.62q0,12.45.05,24.91" />
          <path d="M809.87,493q0,12.45,0,24.9" />
          <path d="M868.8,493q0,12.45,0,24.9" />
          <path d="M927.73,493q0,12.45,0,24.9" />
        </g>
      </svg>
    </div>
  <?php endif; ?>

</div>