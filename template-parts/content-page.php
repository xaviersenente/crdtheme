<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package crdtheme
 */

?>
<?php get_template_part( 'template-parts/hero' ) ?>

<div class="main-column">
	<?php the_content(); ?>
</div>

<?php if( is_page( 'Inscription' ) ) {
	echo do_shortcode('[contact-form-7 id="320" title="Formulaire de pré-inscription" html_class="main-column"]');
} ?>

<?php
	if ( is_page( 'Contact' ) ) : 

		$location = get_field( 'infos_adresse', 'infos' );

		if ( $location ) : ?>
    
		<div class="map">
			<div class="map__marker" data-lat="<?php echo esc_attr( $location['lat'] ); ?>" data-lng="<?php echo esc_attr( $location['lng'] ); ?>">
				<div class="map__infoWindows infoWindows">
					<div class="infoWindows__img">
						<?php the_post_thumbnail( 'square' ); ?>
					</div>
					<div class="infoWindows__infos">
						<p><strong><?php bloginfo( 'name' ) ?></strong></p>
						<p><?php echo $location['street_number'] . ' ' . $location['street_name'] . ' ' . $location['post_code'] . ' ' . $location['city']?></p>
					</div>
				</div>
				
			</div>
		</div>

<?php 
		endif; 
	endif; ?>

