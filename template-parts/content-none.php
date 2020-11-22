<?php
/**
 * Template part for displaying a message that posts cannot be found
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package crdtheme
 */

?>

<div class="main-column">
	<h2 class="page-title"><?php esc_html_e( 'Nothing Found', 'crdtheme' ); ?></h2>
	<?php
	if ( is_search() ) :
		?>

		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'crdtheme' ); ?></p>
		<?php
		// get_search_form();
		get_template_part('template-parts/searchform-page', 'searchform');

	else :
		?>

		<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'crdtheme' ); ?></p>
		<?php
		// get_search_form();
		get_template_part('template-parts/searchform-page', 'searchform');

	endif;
	?>
</div>
