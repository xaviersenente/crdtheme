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
	if ( is_search() ) {
		echo '<p>' . esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'crdtheme' ) . '</p>';
	} else {
		echo '<p>' . esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'crdtheme' ) . '</p>';
	} ?>

	<div class="searchFormPage">
		<form class="searchFormPage__form" action="<?php echo esc_url( site_url() ); ?>" method="get">
			<label class="sr-only" for="searchForm">Rechercher</label>
			<input class="searchFormPage__input" type="search" name="s" placeholder="Rechercher…" value="<?php the_search_query(); ?>">
			<button class="searchFormPage__submit btn -dark" type="submit">
				Rechercher
			</button>
		</form>
	</div>
</div>
