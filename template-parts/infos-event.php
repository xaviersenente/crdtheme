<?php 
  /**
   * Format d'affichage de la date
   * @link http://php.net/manual/fr/function.date.php
   * La fonction strtotime() essaye de lire une date au format anglais fournie par le paramètre time, et de la transformer en timestamp Unix
   * @link http://php.net/manual/fr/function.strtotime.php
   * date_i18n() renvoie la date au format local, ici, en français
   * @link https://codex.wordpress.org/Function_Reference/date_i18n
   */
  $dateformat    = 'l j F Y \à G\hi';
  $unixtimestamp = strtotime( $args['dateObject']['value'] );
  $date          = date_i18n( $dateformat, $unixtimestamp );

  
  
?>

<ul class="infos">
  <li class="infos__row">
    <span class="infos__label"><?php echo $args['dateObject']['label'] ?></span>
    <span class="infos__value"><?php echo $date; ?></span>
  </li>
  <?php 
    foreach ( $args['taxonomies'] as $taxonomy ) :
      /**
       * On retourne un objet de chaque taxonomie pour pouvoir récupérer leur nom.
       * @link https://developer.wordpress.org/reference/functions/get_taxonomy/
       */
      $taxonomyObject = get_taxonomy( $taxonomy );
      
      /**
       * Renvoie la liste des termes d'une taxonomie qui sont associés à la page.
       * @link https://developer.wordpress.org/reference/functions/get_the_terms/
       */
      $terms = get_the_terms( get_the_ID(), $taxonomy );

      if ( $terms ) : ?>
    <li class="infos__row">
      <span class="infos__label"><?php echo $taxonomyObject->label; ?></span>
      <span class="infos__value"> 
        <?php foreach ( $terms as $term ) :
          /**
           * On récupère le lien du terme 
           * @link https://developer.wordpress.org/reference/functions/get_term_link/
           */ 
          $term_link = get_term_link( $term ); ?>
          <a class="infos__link" href="<?php echo $term_link; ?>"><?php echo $term->name; ?></a>
        <?php endforeach; ?>
      </span>
    </li>
    <?php endif; ?>
  <?php endforeach; ?>
</ul>