<?php
/**
 * Template part pour afficger les posts
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
?>

<div class="grid">
	<div class="duotone single__img">
		<?php the_post_thumbnail( 'square' ); ?>
	</div>
	<header class="single__header">
		
		<?php the_title( '<h1 class="single__title">', '</h1>' ); ?>

		<?php if( is_singular( 'event' ) ) {
			set_query_var('taxonomies', get_post_taxonomies());    // récupère toutes les taxonomies du post
			set_query_var('dateObject', get_field_object('date')); // récupère la date
			set_query_var( 'date', get_field( 'date' ) );

			get_template_part( 'template-parts/infos-event' );

		} elseif( is_singular( 'site' ) ) {
			set_query_var('directeur', get_field_object('directeur_site'));
			set_query_var('adresse', get_field_object('adresse_site'));
			set_query_var('horaires', get_field_object('horaires_site'));
	
			get_template_part( 'template-parts/infos-site' );
		} ?>

	</header>
</div>
<p class="single__excerpt">
	<?php echo get_the_excerpt(); ?>
</p>
<div class="gutemberg">
	<?php the_content(); ?>
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
