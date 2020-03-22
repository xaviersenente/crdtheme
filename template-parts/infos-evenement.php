<?php 
  $taxonomies = get_post_taxonomies();				// récupère toutes les taxonomies du post
  $dateObject = get_field_object('date');			// récupère la date

  /**
   * Script pour formater la date
   * locate_template() est l'équivalent de get_template_part() mais permet de récupérer les variables du fichier php et de les passer au template.
   * @link https://developer.wordpress.org/reference/functions/locate_template/
   */
  include(locate_template('template-parts/format-date.php'));
?>

<ul class="infos">
  <li class="infos__row">
    <span class="infos__label"><?php echo $dateObject['label'] ?></span>
    <span class="infos__value"><?php echo $date; ?></span>
  </li>
  <?php foreach ( $taxonomies as $taxonomy ) :
        /**
         * On retourne un objet de chaque taxonomie pour pouvoir récupérer leur nom.
         * @link https://developer.wordpress.org/reference/functions/get_taxonomy/
         */
        $taxonomyName = get_taxonomy( $taxonomy );
        /**
         * Renvoie la liste des termes d'une taxonomie
         * @link https://developer.wordpress.org/reference/functions/get_terms/
         */
        $terms = get_terms( $taxonomy ); ?>
    <li class="infos__row">
      <span class="infos__label"><?php echo $taxonomyName->label; ?></span>
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
  <?php endforeach; ?>
</ul>