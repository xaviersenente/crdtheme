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

