<?php
/**
 * Template part pour afficger les posts
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

	$title 		  = get_the_title();							// récupère le titre
	$dateObject = get_field_object('date');			// récupère la date
	$img 		 	  = get_the_post_thumbnail( $post_id, 'square' ); // récupère l'image mise en avant en utilisant un format carré.
	$excerpt 	  = get_the_excerpt();						// récupère l'extrait
	$content 	  = get_the_content();						// récupère le contenu
	$taxonomies = get_post_taxonomies();				// récupère toutes les taxonomies du post
	/**
	 * Script pour formater la date
	 * locate_template() est l'équivalent de get_template_part() mais permet de récupérer les variables du fichier php et de les passer au template.
	 * @link https://developer.wordpress.org/reference/functions/locate_template/
	 */
	include(locate_template('template-parts/format-date.php'));

?>

<div class="grid">
	<div class="duotone single__img">
		<?php echo $img; ?>
	</div>
	<header class="single__header">
		
		<h1 class="single__title"><?php echo $title; ?></h1>
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
	</header>
</div>
<p class="single__excerpt">
	<?php echo $excerpt; ?>
</p>
<div class="gutemberg">
	<?php echo $content; ?>
</div>
