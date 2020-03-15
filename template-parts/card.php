<?php
  $image      = get_the_post_thumbnail( $post_id, '');  // récupère l'image mise en avant
  $permalink  = get_permalink();      // Récupère le lien du post
  $title      = get_the_title();      // récupère le titre
  $excerpt    = get_the_excerpt();    // récupère l'extrait

  /**
	 * Script pour formater la date
	 * locate_template() est l'équivalent de get_template_part() mais permet de récupérer les variables du fichier php et de les passer au template.
	 * @link https://developer.wordpress.org/reference/functions/locate_template/
	 */
  include(locate_template('template-parts/format-date.php'));
 ?>

<article class="card">
  <?php if( $image ): ?>
    <div class="duotone card__img">
      <?php echo $image; ?>
    </div>
  <?php endif; ?>
  <h3 class="card__title">
    <a class="card__titleLink" href="<?php echo $permalink; ?>">
      <?php echo $title; ?>
    </a>
  </h3>
  <div class="card__caption">
    <?php if( get_field('date') ): ?>
      <p class="card__date"><?php echo $date; ?></p>
    <?php endif; ?>
    <?php if( $excerpt ): ?>
      <p class="card__excerpt"><?php echo $excerpt; ?></p>
    <?php endif; ?>
    <a class="card__link" href="<?php echo $permalink; ?>">
      <?php echo esc_html__( "Plus d'info", 'text-domain' )?>
    </a>
  </div>
</article>