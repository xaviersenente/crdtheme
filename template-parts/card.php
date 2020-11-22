<?php
  $dateformat    = 'l j F Y \à G\hi';
  $unixtimestamp = strtotime( get_field('date') );
  $date          = date_i18n( $dateformat, $unixtimestamp );
 ?>

<article class="card">
  <?php if( has_post_thumbnail() ): ?>
    <div class="duotone card__img">
      <?php the_post_thumbnail( 'large' ); ?>
    </div>
  <?php endif; ?>
  <h3 class="card__title">
    <a class="card__titleLink" href="<?php the_permalink(); ?>">
      <?php the_title(); ?>      
    </a>
  </h3>
  <div class="card__caption">
    <?php if( get_field('date') ): ?>
      <p class="card__date"><?php echo $date; ?></p>
    <?php endif; ?>
    <?php if( has_excerpt() ): ?>
      <p class="card__excerpt"><?php echo get_the_excerpt(); ?></p>
    <?php endif; ?>
    <a class="card__link morelink" href="<?php the_permalink(); ?>">
      <?php echo esc_html__( "Plus d'info", 'text-domain' )?>
    </a>
  </div>
</article>