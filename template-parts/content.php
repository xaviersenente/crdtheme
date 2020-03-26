<?php
/**
 * Template part pour afficger les posts
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

	$title 		  = get_the_title();							// récupère le titre
	$img 		 	  = get_the_post_thumbnail( $post_id, 'square' ); // récupère l'image mise en avant en utilisant un format carré.
	$excerpt 	  = get_the_excerpt();						// récupère l'extrait
	$content 	  = get_the_content();						// récupère le contenu

?>

<div class="grid">
	<div class="duotone single__img">
		<?php echo $img; ?>
	</div>
	<header class="single__header">
		
		<h1 class="single__title"><?php echo $title; ?></h1>

		<?php if( is_singular( 'event' ) ) {
			include(locate_template( 'template-parts/infos-event.php' ));
		} elseif( is_singular( 'site' ) ) {
			include(locate_template( 'template-parts/infos-site.php' ));
		} ?>

	</header>
</div>
<p class="single__excerpt">
	<?php echo $excerpt; ?>
</p>
<div class="gutemberg">
	<?php echo $content; ?>
</div>

<?php
	if( is_singular('site') ): 

		$location = get_field('adresse_site');

		if( !empty($location) ): ?>
    
		<div class="map">
			<div class="map__marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>">
				<div class="map__infoWindows infoWindows">
					<div class="infoWindows__img">
						<?php echo $img; ?>
					</div>
					<div class="infoWindows__infos">
						<h3><?php echo get_the_title(); ?></h3>
						<p><?php echo $location['address']; ?></p>
					</div>
				</div>
				
			</div>
		</div>

	<?php 
			endif; 
		endif; ?>
